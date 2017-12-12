<?php session_start(); ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Pannello amministratore - Daily</title>
		<link rel="stylesheet" type="text/css" href="signup_style.css"/>
				<link rel="icon" href="images/siteContent/icon.png">
	</head>
	<?php 
	if (!$_SESSION['amministratore'])
	{
		header("location: /Daily/index.php?".session_id());
	}?>
	<body>
		<ul id="Navigazione">
			<li id="LogoId"><a id="Logo" href="/Daily/"><img src="images/siteContent/logocyan.png"></a></li>
		</ul>

		<form method="post" autocomplete="off" action="/Daily/adminRedirect.php" id="signup">
			<a id="CreateAccount">Amministrazione</a><br><br>				
				Seleziona la funzione desiderata:<br>
				<select name="domanda">
 				 <option value="1">Inserisci Sconti</option>
  				 <option value="2">Nomina nuovo amministratore</option>
 				 <option value="3">Inserisci oggetto</option>
 				 <option value="4">Rifornisci Magazzino</option>
 				 <option value="5">Banna Utente</option>
				</select>
				<input type="submit" value="Procedi">
		</form>
		<br><br><br><br><br>
		<footer></footer>
	</body>
</html>