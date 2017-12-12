<?php session_start(); ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Recupera la tua Password - Daily</title>
		<link rel="stylesheet" type="text/css" href="signup_style.css"/>
				<link rel="icon" href="images/siteContent/icon.png">
	</head>

	<body>
		<ul id="Navigazione">
			<li id="LogoId"><a id="Logo" href="/Daily/"><img src="images/siteContent/logocyan.png"></a></li>
		</ul>

		<form method="post" autocomplete="off" action="/Daily/passRecoveryConvalidation.php" id="signup"> 
			<a id="CreateAccount"> Recupera la tua password Daily </a><br><br>
				La tua e-mail:<br>
				<?php if( isset($_SESSION['mailErrB'])){} else { $_SESSION['mailErrB']=""; }
						echo '<p id="error">'.$_SESSION['mailErrB'].'</p><br>'; ?>
				<input type="text" name="mail_utente"><br><br>
				Seleziona la domanda di sicurezza e scrivi la risposta di sicurezza:<br>
				<select name="domanda">
 				 <option value="1">Nome da nubile di tua madre</option>
  				 <option value="2">Il tuo soprannome da bambino/a</option>
 				 <option value="3">Nome della tua professoressa preferita</option>
				</select>
				<?php if( isset($_SESSION['sicurezzaErr'])){} else { $_SESSION['sicurezzaErr']=""; }
						echo '<p id="error">'.$_SESSION['sicurezzaErr'].'</p><br>'; ?>
				<input type="text" name="domanda_sicurezza"><br><br>
				<input type="submit" value="Recupera Password">
		</form>
		<br><br><br><br><br>
		<footer></footer>
	</body>
</html>