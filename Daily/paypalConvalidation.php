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
						header("location: /Daily/paypal.php?".session_id());
						exit();
				}							
				if (!filter_var($_POST['mail_cliente'], FILTER_VALIDATE_EMAIL)) {

				$mail = $_POST['mail_cliente'];
				$_SESSION['mailErrA'] = "Formattazione Username non valida";
				header("location: /Daily/paypal.php?".session_id());
				exit();
				}

					$_SESSION['mailErrA']=" ";

				if (empty($_POST['password_cliente'])) {
						$_SESSION['pwdErrA'] = "Campo obbligatorio";
						header("location: /Daily/paypal.php?".session_id());
						exit();
				}

				header("location: /Daily/purchased.php?".session_id());
		}
	?>
</body>
</html>

