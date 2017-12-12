<?php session_start(); ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Il tuo profilo - Daily</title>
		<link rel="stylesheet" type="text/css" href="index_style.css"/>
				<link rel="icon" href="images/siteContent/icon.png">
	</head>

	<body>
		<header>
		<ul id="Navigazione">
			<li id="LogoId"><a id="Logo" href="/Daily/"><img src="images/siteContent/logo.png"></a></li>
			<li><a id="ListaC" href="/Daily/categories.php">CATEGORIE</a></li>
			
			<?php
				if( isset($_SESSION['offline'])){} else { $_SESSION['offline']=TRUE; }
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
					' 	<li style="float:right"><a id="Logout" href="/Daily/logout.php?'.session_id().'"><img src="images/siteContent/logoutIco.png"></a></li>
						<li style="float:right"><a id="Logout" href="/Daily/cart.php?'.session_id().'"><img src="images/siteContent/cartIco.png"></a></li>
						<li style="float:right"><a id="Logout" href="/Daily/user.php?'.session_id().'"><img src="images/siteContent/userIco.png"></a></li>
						<li id="rightContent">Benvenuto, '.$_SESSION["nomeUtente"].' '.$_SESSION["cognomeUtente"].'</a></li>
						
					';
				}

			?>
			
		</ul>
		</header>

		<form method="get" autocomplete="off" id="Search" action="/Daily/search.php">
			<input type="text" placeholder="Cerca.." name="search">
		</form>
		
		<div id="resultPage">
				<?php
				echo '
				<div class="gallery">
					<a href="/Daily/settings.php?'.session_id().'"><img id="userImg" src="images/siteContent/settings.png"></a>
					<div class="desc">Modifica Impostazioni</div>
				</div>
				<div class="gallery">
					<a href="/Daily/history.php?'.session_id().'"><img id="userImg" src="images/siteContent/history.png"></a>
					<div class="desc">Cronologia acquisti</div>
				</div>
				<div class="gallery">
					<a href="/Daily/creditCard.php?'.session_id().'"><img id="userImg" src="images/siteContent/addPayment.png"></a>
					<div class="desc">Modifica Metodi di Pagamento</div>
				</div>
				<div class="gallery">
					<a href="/Daily/logout.php?'.session_id().'"><img id="userImg" src="images/siteContent/logout.png"></a>
					<div class="desc">Logout</div>
				</div>
					';
				?>
			<a id="logoFine"><img src="images/siteContent/logocyan.png"></a>
			<br><br>
		</div>
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