<?php session_start(); ?>
<?php include "connect.php"; ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Benvenuto.. - Daily</title>
		<link rel="stylesheet" type="text/css" href="passRecovery_style.css"/>
	</head>

	<body>
		<?php  

		if( isset($_SESSION['pwdErrB'])){} else { $_SESSION['pwdErrB']=""; }
		if( isset($_SESSION['sicurezzaErr'])){} else { $_SESSION['sicurezzaErr']=""; }

		//$nome=$cognome=$mail=$pwd=$sicurezza=$spedizione=$citta=$telefono="";
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			if (empty($_POST['mail_utente'])) {
				$_SESSION['mailErrB'] = "Campo obbligatorio";
				header("location: /Daily/passRecovery.php?".session_id());
						exit();
			} else 
			{ 
				$mail = test_input($_POST['mail_utente']); 
				if(!filter_var($mail, FILTER_VALIDATE_EMAIL))
				{
					$_SESSION['mailErrB'] = "Formato di email non valido";
					header("location: /Daily/passRecovery.php?".session_id());
						exit();
				}
				$query= $mysqli->query( " SELECT * FROM cliente WHERE ( mail_cliente = '$mail')");
					if(mysqli_num_rows($query)==0)
						{
								$_SESSION['mailErrB'] = "La mail non è presente nel nostro database";
								header("location: /Daily/passRecovery.php?".session_id());
										exit();
						}
				$row=$query->fetch_array(MYSQLI_ASSOC);
				$mail=$row["mail_cliente"];
				$num=$row["id_risposta"];
				$risp=test_input($row["risposta_cliente"]);

			}
			$_SESSION['mailErrB']="";
			$nDomanda=test_input($_POST['domanda']);
			if (empty($_POST['domanda_sicurezza'])) {
				$_SESSION['sicurezzaErr'] = "Campo obbligatorio";
				header("location: /Daily/passRecovery.php?".session_id());
										exit();
			} else 
			{ 
				$sicurezza = test_input($_POST['domanda_sicurezza']); 
				if(!preg_match("/^[a-zA-z ]*$/",$sicurezza))
				{
					$_SESSION['sicurezzaErr'] = "La risposta deve essere nel formato: 'Nome', con il primo carattere maiuscolo. Non sono ammessi segni di punteggiatura o numeri";
					header("location: /Daily/passRecovery.php?".session_id());
										exit();
				}
			}
			if($num!=$nDomanda || $risp!=$sicurezza)
			{
					$_SESSION['sicurezzaErr'] = "Risposta di sicurezza sbagliata";
					header("location: /Daily/passRecovery.php?".session_id());
					exit();

			}
			else
			{
					$newPass=stringaRandom(8);
					$_SESSION[passwordTemporanea]=$newPass;
					$newPassEncoded=md5($newPass);
					$result=$mysqli->query("UPDATE cliente  SET password_cliente = '$newPassEncoded'  WHERE mail_cliente='$mail'");
			}

			$_SESSION['sicurezzaErr']="";
			
			if($result)
			{
				header("location: /Daily/resettedPassword.php?".session_id());
				exit();
			}
			else
			{
				header("location: /Daily/error.php?".session_id());
				exit();
			}

		}

		function stringaRandom($lunghezza){
		// lista di caratteri che comporranno la stringa random
		$caratteriPossibli = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		// inizializzo la stringa random
		$stringa = "";
		$i = 0;
		while ($i < $lunghezza)
		{
			$stringa.=substr($caratteriPossibli,rand(0,strlen($caratteriPossibli)-1),1);
			$i++;
		}
		return $stringa;
		}


		function test_input($data) {
				$data=trim($data);
				$data=stripslashes($data);
				$data=htmlspecialchars($data);
				return $data;
			}
		?>
		
	
	</body>
</html>