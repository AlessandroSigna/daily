<?php	session_start(); ?>
<?php include "connect.php"; ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Benvenuto.. - Daily</title>
		<link rel="stylesheet" type="text/css" href="signup_style.css"/>
	</head>

	<body>

		<?php  
	if( isset($_SESSION['mailErrA'])){} else { $_SESSION['mailErrA']=""; }
	if( isset($_SESSION['pwdErrA'])){} else { $_SESSION['pwdErrA']=""; }
	
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
				if (empty($_POST['mail_cliente'])) {
						$_SESSION['mailErrA'] = "Campo obbligatorio";
						header("location: /Daily/signin.php?".session_id());
						exit();
					} else 
							{ 
								$mail = test_input($_POST['mail_cliente']);
									$query1= $mysqli->query( " SELECT * FROM cliente WHERE ( mail_cliente = '$mail')");
										if(mysqli_num_rows($query1)==0)
											{
												$_SESSION['mailErrA'] = "La mail non è stata riconosciuta dal sistema";
												header("location: /Daily/signin.php?".session_id());
												exit();
											}
							}

					$_SESSION['mailErrA']=" ";

				if (empty($_POST['password_cliente'])) {
						$_SESSION['pwdErrA'] = "Campo obbligatorio";
						header("location: /Daily/signin.php?".session_id());
						exit();
					} else 
							{ 
								$pwd = $_POST['password_cliente']; 
								$query2= $mysqli->query( " SELECT * FROM cliente WHERE ( mail_cliente = '$mail' AND password_cliente = '$pwd' ) ");
								if(mysqli_num_rows($query2)==0)
								{
									$_SESSION['pwdErrA'] = "La password inserita non è corretta";
									header("location: /Daily/signin.php?".session_id());
									exit();
								}
							}

					$_SESSION['pwdErrA']=" ";		

				$row = $query2->fetch_array ( MYSQLI_ASSOC );
					$result1=$row["nome_cliente"];
					$result2=$row["cognome_cliente"];
			$_SESSION['mailUtente']=$mail;
			$_SESSION['nomeUtente']=$result1;
			$_SESSION['cognomeUtente']=$result2;				
			$_SESSION['offline']=FALSE;
				header("location: /Daily/index.php?".session_id());
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