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

		
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{

			if (empty($_POST['nome_utente'])) {
				$_SESSION['nomeErr'] = "Campo obbligatorio";
				header("location: /Daily/signup.php?".session_id());
						exit();
			} else 
			{ 
				$nome = test_input($_POST['nome_utente']); 
				if(!preg_match("/^[a-zA-z ]*$/",$nome))
				{
					$_SESSION['nomeErr'] = "Sono permesse soltanto lettere e spazi";
					header("location: /Daily/signup.php?".session_id());
						exit();
				}
			}
			$_SESSION['nomeErr']="";

			if (empty($_POST['cognome_utente'])) {
				$_SESSION['cognomeErr'] = "Campo obbligatorio";
				header("location: /Daily/signup.php?".session_id());
						exit();
			} else 
			{ 
				$cognome = test_input($_POST['cognome_utente']);
				if(!preg_match("/^[a-zA-z ]*$/",$cognome))
				{
					$_SESSION['cognomeErr'] = "Sono permesse soltanto lettere e spazi";
					header("location: /Daily/signup.php?".session_id());
						exit();
				} 
			}
			$_SESSION['cognomeErr']="";

			if (empty($_POST['mail_utente'])) {
				$_SESSION['mailErrB'] = "Campo obbligatorio";
				header("location: /Daily/signup.php?".session_id());
						exit();
			} else 
			{ 
				$mail = test_input($_POST['mail_utente']); 
				if(!filter_var($mail, FILTER_VALIDATE_EMAIL))
				{
					$_SESSION['mailErrB'] = "Formato di email non valido";
					header("location: /Daily/signup.php?".session_id());
						exit();
				}
				$query= $mysqli->query( " SELECT * FROM cliente WHERE ( mail_cliente = '$mail')");
					if(mysqli_num_rows($query)!=0)
						{
								$_SESSION['mailErrB'] = "La mail è già presente nel nostro database";
								header("location: /Daily/signup.php?".session_id());
										exit();
						}
			}
			$_SESSION['mailErrB']="";

			if (empty($_POST['password_utente'])) {
				$_SESSION['pwdErrB'] = "Campo obbligatorio";
				header("location: /Daily/signup.php?".session_id());
										exit();
			} else 
			{ 
				$pwd = test_input($_POST['password_utente']); 
				if(strlen($pwd)<8) { 
						$_SESSION['pwdErrB'] = "La password inserita non è abbastanza lunga"; 
						header("location: /Daily/signup.php?".session_id());
										exit();
					}
				if($_POST['password_utente']!=$_POST['password_utente2']) { 
						$_SESSION['pwdErrB'] = "Le 2 password non corrispondono"; 
						header("location: /Daily/signup.php?".session_id());
										exit();
					}
			}
			$_SESSION['pwdErrB']="";

			if (empty($_POST['domanda_sicurezza'])) {
				$_SESSION['sicurezzaErr'] = "Campo obbligatorio";
				header("location: /Daily/signup.php?".session_id());
										exit();
			} else 
			{ 
				$sicurezza = test_input($_POST['domanda_sicurezza']); 
				if(!preg_match("/^[a-zA-z ]*$/",$sicurezza))
				{
					$_SESSION['sicurezzaErr'] = "La risposta deve essere nel formato: 'Nome', con il primo carattere maiuscolo. Non sono ammessi segni di punteggiatura o numeri";
					header("location: /Daily/signup.php?".session_id());
										exit();
				}
			}
			$_SESSION['sicurezzaErr']="";

			if (empty($_POST['spedizione_utente'])) {
				$_SESSION['spedizioneErr'] = "Campo obbligatorio";
				header("location: /Daily/signup.php?".session_id());
										exit();
			} else { $spedizione = test_input($_POST['spedizione_utente']); }
			$_SESSION['spedizioneErr']="";

			if (empty($_POST['citta_utente'])) {
				$_SESSION['cittaErr'] = "Campo obbligatorio";
				header("location: /Daily/signup.php?".session_id());
										exit();
			} else 
			{ 
				$citta = test_input($_POST['citta_utente']); 
				if(!preg_match("/^[a-zA-z ]*$/",$citta))
				{
					$_SESSION['cittaErr'] = "Sono permesse soltanto lettere e spazi";
					header("location: /Daily/signup.php?".session_id());
										exit();
				} 
			}
			$_SESSION['cittaErr']="";

			if (empty($_POST['telefono_utente'])) { $telefono="";}
			else
			{ 
				$telefono = test_input($_POST['telefono_utente']); 
				if(!preg_match("/^[0-9]*$/",$telefono))
				{
					$_SESSION['telefonoErr'] = "Formato telefono non valido";
					header("location: /Daily/signup.php?".session_id());
										exit();
				} 
			}
			$_SESSION['telefonoErr']="";

			if(isset($_POST['domanda']))
			{
				$domanda=$_POST['domanda'];
			}
			
			$result=$mysqli->query("INSERT INTO cliente (`mail_cliente`,`nome_cliente`,`cognome_cliente`,`password_cliente`,`spedizione_cliente`,`id_risposta`,`risposta_cliente`,`citta_cliente`,`telefono_cliente`) VALUES ('".$mail."','".$nome."','".$cognome."','".$pwd."','".$spedizione."','".$domanda."','".$sicurezza."','".$citta."','".$telefono."')");
			if($result)
			{
				header("location: /Daily/congratulations.php?".session_id());
				exit();
			}
			else
			{
				//die(mysqli_error($mysqli));
				header("location: /Daily/error.php?".session_id());
				exit();
			}

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