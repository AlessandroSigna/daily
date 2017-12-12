<?php session_start(); ?>
<?php include "connect.php" ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Daily - Shop Online</title>
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
				if( isset($_SESSION['amministratore'])){} else { $_SESSION['amministratore']=FALSE; }
				if( isset($_SESSION['nomeUtente'])){} else { $_SESSION['nomeUtente']=""; }
				if( isset($_SESSION['cognomeUtente'])){} else { $_SESSION['cognomeUtente']=""; }
				if( isset($_SESSION['mailErrA'])){ $_SESSION['mailErrA']=""; } else { $_SESSION['mailErrA']=""; }
				if( isset($_SESSION['pwdErrA'])){ $_SESSION['pwdErrA']=""; } else { $_SESSION['pwdErrA']=""; }
				if( isset($_SESSION['nomeErr'])){ $_SESSION['nomeErr']=""; } else { $_SESSION['nomeErr']=""; }
				if( isset($_SESSION['cognomeErr'])){ $_SESSION['cognomeErr']=""; } else { $_SESSION['cognomeErr']=""; }
				if( isset($_SESSION['mailErrB'])){ $_SESSION['mailErrB']=""; } else { $_SESSION['mailErrB']=""; }
				if( isset($_SESSION['pwdErrB'])){ $_SESSION['pwdErrB']=""; } else { $_SESSION['pwdErrB']=""; }
				if( isset($_SESSION['sicurezzaErr'])){ $_SESSION['sicurezzaErr']=""; } else { $_SESSION['sicurezzaErr']=""; }
				if( isset($_SESSION['spedizioneErr'])){ $_SESSION['spedizioneErr']=""; } else { $_SESSION['spedizioneErr']=""; }
				if( isset($_SESSION['cittaErr'])){ $_SESSION['cittaErr']=""; } else { $_SESSION['cittaErr']=""; }
				if( isset($_SESSION['telefonoErr'])){ $_SESSION['telefonoErr']=""; } else { $_SESSION['telefonoErr']=""; }
				if (isset($_SESSION['size'])){} else { $_SESSION['size']="M"; }
				if (isset($_SESSION['QTY'])){} else { $_SESSION['QTY']=1; }
					$size=$_SESSION['size'];
					$QTY=$_SESSION['QTY'];
				
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
						<li style="float:right"><a id="Logo" href="/Daily/cart.php?'.session_id().'"><img src="images/siteContent/cartIco.png"></a></li>
						<li style="float:right"><a id="Logo" href="/Daily/user.php?'.session_id().'"><img src="images/siteContent/userIco.png"></a></li>
						<li id="rightContent">Bentornato, '.$_SESSION["nomeUtente"].' '.$_SESSION["cognomeUtente"].'</li>
					';
					if($_SESSION['amministratore'])
					{
					echo
					' 	<li style="float:right"><a id="Lista" href="/Daily/administrator.php?'.session_id().'">Amministrazione</a></li>
					';
					}
				}

			?>
			
		</ul>
		</header>

		<form method="get" autocomplete="off" id="Search" action="/Daily/search.php">
			<input type="text" placeholder="Cerca.." name="search">
		</form>

		<div id="resultPage">
		<?php echo '<h1>Prodotti più acquistati</h1>'; 

		$query = $mysqli->query( " SELECT * FROM prodotto /*condizione su storico acquisti count*/ ");
		$count=0;
		while ( $row = $query->fetch_array ( MYSQLI_ASSOC ) AND $count<4)
{	
	echo 
			'
				<div class="gallery">
						<a href="/Daily/product.php?id='.$row["codice_prodotto"].'&size='.$size.'&qty='.$QTY.'"><img src="'.$row["immagine_prodotto"].'"></a>
				<div class="desc">
						<a id="titolo" href="/Daily/product.php?id='.$row["codice_prodotto"].'&size='.$size.'&qty='.$QTY.'">'.$row["nome_prodotto"].' '.$row["colore_prodotto"].' '.$row["modello_prodotto"].' </a><br><br>
					</div>
				</div>
				
			';
	$count=$count+1;


}

		?>
		<?php echo '<h1>Prodotti in sconto</h1>'; 

		$query = $mysqli->query( " SELECT * FROM prodotto WHERE sconto_prodotto!=0 ORDER BY RAND()");
		$count=0;
		while ( $row = $query->fetch_array ( MYSQLI_ASSOC ) AND $count<4)
{	
	echo 
			'
				<div class="gallery">
						<a href="/Daily/product.php?id='.$row["codice_prodotto"].'&size='.$size.'&qty='.$QTY.'"><img src="'.$row["immagine_prodotto"].'"></a>
				<div class="desc">
						<a id="titolo" href="/Daily/product.php?id='.$row["codice_prodotto"].'&size='.$size.'&qty='.$QTY.'">'.$row["nome_prodotto"].' '.$row["colore_prodotto"].' '.$row["modello_prodotto"].' </a><br>';
						$newPrice=($row["prezzo_prodotto"]-(($row["prezzo_prodotto"]/100)*$row["sconto_prodotto"])); 
						$newPrice=number_format($newPrice,2); 
						echo'<a id="taglio">EUR '.$row["prezzo_prodotto"].'</a><br>
							<a id="sconto">EUR '.$newPrice.'</a><br>
					</div>
				</div>
				
			';
	$count=$count+1;


}

		?>
		<?php  if($_SESSION['offline']==FALSE) {
			echo '<h1>Scelti per te</h1>'; 
		
				$query = $mysqli->query( " SELECT * FROM prodotto /*condizione su storico acquisti count*/ ");
				$count=0;
				while ( $row = $query->fetch_array ( MYSQLI_ASSOC ) AND $count<4)
		{	
			echo 
					'
						<div class="gallery">
								<a href="/Daily/product.php?id='.$row["codice_prodotto"].'&size='.$size.'&qty='.$QTY.'"><img src="'.$row["immagine_prodotto"].'"></a>
						<div class="desc">
								<a id="titolo" href="/Daily/product.php?id='.$row["codice_prodotto"].'&size='.$size.'&qty='.$QTY.'">'.$row["nome_prodotto"].' '.$row["colore_prodotto"].' '.$row["modello_prodotto"].' </a><br><br>
							</div>
						</div>
						
					';
			$count=$count+1;
		}


}

		?><br><br>

			<a id="logoFine"><img src="images/siteContent/logocyan.png"></a>
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