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

		<form method="post" autocomplete="off" action="/Daily/discountConvalidation.php" id="signup">
			<a id="CreateAccount">Amministrazione</a><br><br>				
				Codice maglietta:<br>
				<?php if( isset($_SESSION['codErr'])){} else { $_SESSION['codErr']=""; }
						echo '<p id="error">'.$_SESSION['codErr'].'</p><br>'; ?>
				<input type="text" name="id_maglia"><br><br>
				Percentuale di sconto:<br>
				<?php if( isset($_SESSION['discountErr'])){} else { $_SESSION['discountErr']=""; }
						echo '<p id="error">'.$_SESSION['discountErr'].'</p><br>'; ?>
				<input type="text" name="sconto"><br><br>
				<input type="submit" value="Procedi">
		</form>
		<br><br><br><br><br>
		<footer></footer>
	</body>
</html>