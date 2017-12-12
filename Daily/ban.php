
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

		<form method="post" autocomplete="off" action="/Daily/banConvalidation.php" id="signup">
			<a id="CreateAccount" >Amministrazione</a><br><br>				
				Inserisci l'email dell'utente da bannare:<br><br>
			<?php 
					if( isset($_SESSION['banErr'])){} else { $_SESSION['banErr']=""; }
					echo '<p id="error">'.$_SESSION['banErr'].'</p><br>'; 
			?>
			<input type="text" name="banned_email"> <br><br>
				<input type="submit" value="Elimina">
		</form>
		<br><br><br><br><br>
		<footer></footer>
	</body>
</html>