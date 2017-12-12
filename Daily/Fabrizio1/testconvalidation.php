<?php session_start(); ?>
<?php include "connect.php"; ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Benvenuto.. - Daily</title>
		<link rel="stylesheet" type="text/css" href="signup_style.css"/>
	</head>

	<body>
		<?php  
		if( isset($_SESSION['nomeErr'])){} else { $_SESSION['nomeErr']=""; }
		if( isset($_SESSION['cognomeErr'])){} else { $_SESSION['cognomeErr']=""; }
		if( isset($_SESSION['mailErrB'])){} else { $_SESSION['mailErrB']=""; }
		if( isset($_SESSION['pwdErrB'])){} else { $_SESSION['pwdErrB']=""; }
		if( isset($_SESSION['sicurezzaErr'])){} else { $_SESSION['sicurezzaErr']=""; }
		if( isset($_SESSION['spedizioneErr'])){} else { $_SESSION['spedizioneErr']=""; }
		if( isset($_SESSION['cittaErr'])){} else { $_SESSION['cittaErr']=""; }
		if( isset($_SESSION['telefonoErr'])){} else { $_SESSION['telefonoErr']=""; }

		//$nome=$cognome=$mail=$pwd=$sicurezza=$spedizione=$citta=$telefono="";
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{

			if (empty($_POST['nome_utente'])) {}
			else 
			{ 
				$nome = test_input($_POST['nome_utente']); 
				if(!preg_match("/^[a-zA-z ]*$/",$nome))
				{
					$_SESSION['nomeErr'] = "Sono permesse soltanto lettere e spazi";
					header("location: /Daily/settings.php?".session_id());
						exit();
				}
				else
				{					
					$result=$mysqli->query("UPDATE cliente  SET nome_cliente = '$nome'  WHERE mail_cliente='$_SESSION[mailUtente]'");
					$_SESSION['nomeUtente']=$nome;
				}
			}
				$_SESSION['nomeErr']="";

			if (empty($_POST['cognome_utente'])) {} else 
			{ 
				$cognome = test_input($_POST['cognome_utente']);
				if(!preg_match("/^[a-zA-z ]*$/",$cognome))
				{
					$_SESSION['cognomeErr'] = "Sono permesse soltanto lettere e spazi";
					header("location: /Daily/settings.php?".session_id());
						exit();
				} 
				else
				{
					$result=$mysqli->query("UPDATE cliente  SET cognome_cliente = '$cognome'  WHERE mail_cliente='$_SESSION[mailUtente]'");	
					$_SESSION[cognomeUtente]=$cognome;
				}
			}
			$_SESSION['cognomeErr']="";

			if (empty($_POST['mail_utente'])) {} else 
			{ 
				$mail = test_input($_POST['mail_utente']); 
				if(!filter_var($mail, FILTER_VALIDATE_EMAIL))
				{
					$_SESSION['mailErrB'] = "Formato di email non valido";
					header("location: /Daily/settings.php?".session_id());
						exit();
				}
				$query= $mysqli->query( " SELECT * FROM cliente WHERE ( mail_cliente = '$mail')");
					if(mysqli_num_rows($query)!=0)
						{
								$_SESSION['mailErrB'] = "La mail è già presente nel nostro database";
								header("location: /Daily/settings.php?".session_id());
										exit();
						}
					else
					{
						$result=$mysqli->query("UPDATE cliente  SET mail_cliente = '$mail'  WHERE mail_cliente='$_SESSION[mailUtente]'");
						$_SESSION[mailUtente]=$mail;
					}
			}
			$_SESSION['mailErrB']="";

			if (empty($_POST['password_utente_vecchia'])) 
			{
				$_SESSION['pwdErrBOld']= "Campo Obbligatorio";
				header("location: /Daily/settings.php?".session_id());
				exit();
			}
			else
			{
				$pwdO=md5(test_input($_POST[password_utente_vecchia]));
				$myQuery=$mysqli->query("SELECT * FROM cliente WHERE mail_cliente='$_SESSION[mailUtente]'");
				$riga=$myQuery->fetch_array(MYSQLI_ASSOC);
				$passwordTest=$riga["password_cliente"];
				if($passwordTest!=$pwdO)
				{
					$_SESSION['pwdErrBOld']="Password Sbagliata";
					header("location: /Daily/settings.php?".session_id());
					exit();
				}
			}
			$_SESSION['pwdErrBOld']="";

			if (empty($_POST['password_utente'])) {} else 
			{ 
				$pwd = test_input($_POST['password_utente']); 
				if(strlen($pwd)<8) { 
						$_SESSION['pwdErrB'] = "La password inserita non è abbastanza lunga"; 
						header("location: /Daily/settings.php?".session_id());
										exit();
					}
				if($_POST['password_utente']!=$_POST['password_utente2']) { 
						$_SESSION['pwdErrB'] = "Le due password non corrispondono"; 
						header("location: /Daily/settings.php?".session_id());
										exit();
					}
				else{
						$_SESSION['passwordTemporanea']=$pwd;
						$pwd=md5($pwd);
						$result=$mysqli->query("UPDATE cliente  SET password_cliente = '$pwd'  WHERE mail_cliente='$_SESSION[mailUtente]'");
					}
			}
			$_SESSION['pwdErrB']="";
			if (empty($_POST['domanda_sicurezza'])) {} else 
			{ 
				$sicurezza = test_input($_POST['domanda_sicurezza']); 
				if(!preg_match("/^[a-zA-z ]*$/",$sicurezza))
				{
					$_SESSION['sicurezzaErr'] = "La risposta deve essere nel formato: 'Nome', con il primo carattere maiuscolo. Non sono ammessi segni di punteggiatura o numeri";
					header("location: /Daily/settings.php?".session_id());
					exit();
				}
				else
				{
						$result=$mysqli->query("UPDATE cliente  SET risposta_cliente = '$sicurezza'  WHERE mail_cliente='$_SESSION[mailUtente]'");
				}
			}
			$_SESSION['sicurezzaErr']="";

			if (empty($_POST['spedizione_utente'])) {} else 
			{
				$spedizione = test_input($_POST['spedizione_utente']);
				$result=$mysqli->query("UPDATE cliente  SET spedizione_cliente = '$spedizione'  WHERE mail_cliente='$_SESSION[mailUtente]'");
		    }
			$_SESSION['spedizioneErr']="";

			if (empty($_POST['citta_utente'])) {} else 
			{ 
				$citta = test_input($_POST['citta_utente']); 
				if(!preg_match("/^[a-zA-z ]*$/",$citta))
				{
					$_SESSION['cittaErr'] = "Sono permesse soltanto lettere e spazi";
					header("location: /Daily/settings.php?".session_id());
				} 
				else
				{
					$result=$mysqli->query("UPDATE cliente  SET citta_cliente = '$citta'  WHERE mail_cliente='$_SESSION[mailUtente]'");
					exit();
				}
			}
			$_SESSION['cittaErr']="";

			if (empty($_POST['telefono_utente'])) {}
			else
			{ 
				$telefono = test_input($_POST['telefono_utente']); 
				if(!preg_match("/^[0-9]*$/",$telefono))
				{
					$_SESSION['telefonoErr'] = "Formato telefono non valido";
					header("location: /Daily/settings.php?".session_id());
										exit();
				} 
				else
				{
					$result=$mysqli->query("UPDATE cliente  SET telefono_utente = '$telefono'  WHERE mail_cliente='$_SESSION[mailUtente]'");
				}
			}
			$_SESSION['telefonoErr']="";

			if(isset($_POST['domanda']))
			{
				$domanda=$_POST['domanda'];
				$result=$mysqli->query("UPDATE cliente  SET id_risposta = '$domanda'  WHERE mail_cliente='$_SESSION[mailUtente]'");
			}
		
		}
		header("location: /Daily/review.php?".session_id());



		function test_input($data) {
				$data=trim($data);
				$data=stripslashes($data);
				$data=htmlspecialchars($data);
				return $data;
			}
		?>
		
	
	</body>
</html>