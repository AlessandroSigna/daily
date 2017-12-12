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
		<form method="post" autocomplete="off" action=<?php echo ' "/Daily/authentication.php?'.session_id().'"'; ?> id="signup">
			<a id="CreateAccount"> Inserisci le tue credenziali </a><br><br>
	
				E-mail:<br>
				<?php if( isset($_SESSION['mailErrA'])){} else { $_SESSION['mailErrA']=""; }
						echo '<p id="error">'.$_SESSION['mailErrA'].'</p><br>'; ?>
				<input type="text" name="mail_cliente"><br><br>
				Password:<br>
				<?php if( isset($_SESSION['pwdErrA'])){} else { $_SESSION['pwdErrA']=""; }
						echo '<p id="error">'.$_SESSION['pwdErrA'].'</p><br>'; ?>
				<input type="password" name="password_cliente"><br><br>
				<?php if(!empty($_SESSION['pwdErrA'])) {	echo '<a id="Logo" href="/Daily/passRecovery.php?'.session_id().'"><p id="lostpwd">Hai dimenticato la password?</p></a><br>'; } ?>
				<input type="submit" value="Accedi">
			<br><br>
			<a id="divider">----------------------------------------------------------------- Nuovo utente? ----------------------------------------------------------------</a>
			<br><br>
			<?php echo '<a id="toSignup" href="/Daily/signup.php?'.session_id().'"> Registrati </a><br><br>'; ?>
		</form>
		<br><br><br><br><br>
		<footer></footer>
	</body>
</html>