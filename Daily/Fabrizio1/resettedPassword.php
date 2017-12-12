<?php session_start(); ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Daily - Shop Online</title>
		<link rel="stylesheet" type="text/css" href="signup_style.css"/>
	</head>

	<body>
	<?php if( isset($_SESSION['mailErrA'])){ $_SESSION['mailErrA']=""; } else { $_SESSION['mailErrA']=""; }
				if( isset($_SESSION['pwdErrA'])){ $_SESSION['pwdErrA']=""; } else { $_SESSION['pwdErrA']=""; } ?>
	<div id="resultPage">
			La procedura di recupero password è avvenuta correttamente.<br><br>
			La tua nuova password è: <?php echo ' '.$_SESSION['passwordTemporanea'].'<br><br>' ?>
			Seleziona una delle opzioni per continuare:<br><br><br>
			<?php echo '<a id="Logo" href="/Daily/index.php?'.session_id().'"><img src="images/siteContent/homepage.png"></a><a id="Logo" href="/Daily/signin.php?'.session_id().'"><img src="images/siteContent/signup.png"></a>'; $_SESSION['passwordTemporanea']=""; ?>
			<br><br><br>
			_________________________________________________________________________________
			<a id="logoFine"><img src="images/siteContent/logocyan.png"></a>
		</div>

	</body>
		<br><br><br><br><br>
		<footer>
		<ul id="NavigazioneFooter">
			<li><a id="ListaFooter" href="/Daily/map.php">Mappa Negozi<br><img src="images/siteContent/logo.png"></a></li>
			<li id="Content">Contatti<br>
			<a id="Contatti">
				Fabrizio Lo Presti, Via Montecarlo 7, 90146, Palermo (IT) <br>|| fabrizioxxx@xxx.com || 329xxxxxxx<br>
				Lorenzo Ganci, Via Ferdinando Palasciano 24, 90146, Palermo (IT) <br>|| lorenzoxxx@xxx.com || 333xxxxxxx
			</a></li>
		</ul></footer>
	</body>
</html>