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
			<?php echo ' <li><a id="Lista" href="/Daily/categories.php?'.session_id().'">CATEGORIE</a></li>' ?>

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
						<li style="float:right"><a id="Logo" href="/Daily/cart.php?'.session_id().'"><img src="images/siteContent/cartIco.png"></a></li>
						<li style="float:right"><a id="Logo" href="/Daily/user.php?'.session_id().'"><img src="images/siteContent/userIco.png"></a></li>
						<li id="rightContent">Benvenuto, '.$_SESSION["nomeUtente"].' '.$_SESSION["cognomeUtente"].'</a></li>
					';
				}

			?>
		</ul>
		</header>

		<div id="map" style="width: 800px;height:400px;background-color:yellow; margin: 60px 60px; margin-left: 27%"></div>
				<script>			
			function myMap() {
		var uluru= { lat: -25.68, lng:131.044};
		var map= new google.maps.Map(document.getElementById('map'), { zoom:4, center: uluru});
		var marker = new google.maps.Marker({position: uluru, map:map});
		}
		</script>

		<script src="https//maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script>	


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