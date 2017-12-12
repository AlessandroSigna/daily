<?php include "connect.php" ?>
<?php session_start(); ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Categorie - Daily</title>
		<link rel="stylesheet" type="text/css" href="index_style.css"/>
		<link rel="shortcut icon" href="images/siteContent/icon.png">
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

		<form method="get" autocomplete="off" id="Search" action="/Daily/search.php"> 
			<input type="text" placeholder="Cerca.." name="search">
		</form>
		
		<div id="resultPage">

			<div class="gallery">
				<a href="/Daily/search.php?search=Classic+Summer"><img src="images/siteContent/ClassicSummerShirt.png"></a>
				<div class="desc">La maglia per antonomasia. Stile classico e senza tempo per un'estate dai mille colori.</div>
			</div>
			<div class="gallery">
				<a href="/Daily/search.php?search=Vintage+Summer"><img src="images/siteContent/VintageSummerShirt.png"></a>
				<div class="desc">Lo stile sta nel dettaglio... E Vintage Summer è quello che fa per te per stupire gli amici.</div>
			</div>
			<div class="gallery">
				<a href="/Daily/search.php?search=Classic+Winter"><img src="images/siteContent/ClassicWinterShirt.png"></a>
				<div class="desc">Proteggiti dal freddo con semplicità e colore: Classic Winter è quello che stai cercando.</div>
			</div>
			<div class="gallery">
				<a href="/Daily/search.php?search=Vintage+Winter""><img src="images/siteContent/VintageWinterShirt.png"></a>
				<div class="desc">L'inverno non ti permetterà di abbandonare lo stile, pur rimanendo nel comfort.</div>
			</div>

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