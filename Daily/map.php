<?php session_start(); ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Dove Siamo - Daily</title>
		<link rel="stylesheet" type="text/css" href="index_style.css"/>
				<link rel="icon" href="images/siteContent/icon.png">
	</head>

	<body>
		<header>
		<ul id="Navigazione">
			<li id="LogoId"><a id="Logo" href="/Daily/"><img src="images/siteContent/logo.png"></a></li>
			<?php echo ' <li><a id="ListaC" href="/Daily/categories.php?'.session_id().'">CATEGORIE</a></li>' ?>

			<?php
				if( isset($_SESSION['offline'])){} else { $_SESSION['offline']=TRUE; }
				if( isset($_SESSION['nomeUtente'])){} else { $_SESSION['nomeUtente']=""; }
				if( isset($_SESSION['cognomeUtente'])){} else { $_SESSION['cognomeUtente']=""; }
				if($_SESSION['offline']==TRUE)
				{
					echo 
					' 
						<li style="float:right"><a id="Lista" href="/Daily/signin.php?'.session_id().'">Accedi</a></li>
						<li style="float:right"><a id="Lista" href="/Daily/signup.php">Registrati</a></li>
						<li id="rightContent">Nuovo utente?</li>
					';
				}
				else
				{
					echo
					' 
						<li style="float:right"><a id="Logout" href="/Daily/logout.php?'.session_id().'"><img src="images/siteContent/logoutIco.png"></a></li>
						<li style="float:right"><a id="Logout" href="/Daily/cart.php?'.session_id().'"><img src="images/siteContent/cartIco.png"></a></li>
						<li style="float:right"><a id="Logout" href="/Daily/user.php?'.session_id().'"><img src="images/siteContent/userIco.png"></a></li>
						<li id="rightContent">Benvenuto, '.$_SESSION["nomeUtente"].' '.$_SESSION["cognomeUtente"].'</a></li>
					';
				}

			?>
		</ul>
		</header>

		<img id="mappa" src="images/siteContent/map.png">

		<footer>
			<ul id="NavigazioneFooter">
			<li><a id="ListaFooter" href="/Daily/map.php">Mappa Negozi<br><img src="images/siteContent/logo.png"></a></li>
			<li id="Content">Contatti<br>
				<a id="Contatti">
					Fabrizio Lo Presti, Via Montecarlo 7, 90146, Palermo (IT) <br>|| fabrizioxxx@xxx.com || 329xxxxxxx<br>
					Lorenzo Ganci, Via Ferdinando Palasciano 24, 90146, Palermo (IT) <br>|| lorenzoxxx@xxx.com || 333xxxxxxx
				</a></li>
			</ul>
		</footer>

	</body>
</html>