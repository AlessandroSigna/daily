 <?php session_start(); ?>
<?php include "connect.php"; ?>
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
	}
	?>
	<body>
		<ul id="Navigazione">
			<li id="LogoId"><a id="Logo" href="/Daily/"><img src="images/siteContent/logocyan.png"></a></li>
		</ul>

		<form method="post" autocomplete="off" action="/Daily/newAdminConvalidation.php" id="signup">
			<a id="CreateAccount">Amministrazione</a><br><br>				
				Email Amministratore:<br>
				<?php if( isset($_SESSION['codErr'])){} else { $_SESSION['codErr']=""; }
						echo '<p id="error">'.$_SESSION['codErr'].'</p><br>'; ?>
				<input type="text" name="email_admin">
				<input type="submit" value="Procedi">
		</form>
		<br><br><br><br><br>
		<footer></footer>
	</body>
</html>