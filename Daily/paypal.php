<?php session_start(); ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Accedi - Daily</title>
		<link rel="stylesheet" type="text/css" href="signup_style.css"/>
				<link rel="icon" href="images/siteContent/icon.png">
	</head>

	<body>

		<ul id="Navigazione">
			<li id="LogoId"><a id="Logo" href="/Daily/"><img src="images/siteContent/logocyan.png"></a></li>
		</ul>
		<form method="post" autocomplete="off" action=<?php echo ' "/Daily/paypalConvalidation.php?'.session_id().'"'; ?> id="signup">
			<a id="CreateAccount"> Inserisci le tue credenziali Paypal </a><br><br>
				<img id="cards" src="images/siteContent/paypal2.png" alt="Paypal">
				Username<br>
				<?php if( isset($_SESSION['mailErrA'])){} else { $_SESSION['mailErrA']=""; }
						echo '<p id="error">'.$_SESSION['mailErrA'].'</p><br>'; ?>
				<input type="text" name="mail_cliente"><br><br>
				Password<br>
				<?php if( isset($_SESSION['pwdErrA'])){} else { $_SESSION['pwdErrA']=""; }
						echo '<p id="error">'.$_SESSION['pwdErrA'].'</p><br>'; ?>
				<input type="password" name="password_cliente"><br><br>
				<input type="submit" value="Procedi all'acquisto">
			<br><br>
			<br><br>
		</form>
		<br><br><br><br><br>
		<footer></footer>
	</body>
</html>