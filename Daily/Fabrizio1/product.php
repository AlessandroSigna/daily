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
						<li id="rightContent">Bentornato, '.$_SESSION["nomeUtente"].' '.$_SESSION["cognomeUtente"].'</a></li>
					';
				}

			?>
			
		</ul>
		</header>

		<form method="get" autocomplete="off" id="Search" action="/Daily/search.php">
			<input type="text" placeholder="Cerca.." name="search">
		</form>

		<div id="resultPageProduct">
			<?php 
			$_SESSION['idProduct']=$_GET['id'];
			$id=$_SESSION['idProduct'];
			if (isset($_SESSION['size'])){} else { $_SESSION['size']=$_GET['size']; }
			if (isset($_SESSION['QTY'])){} else { $_SESSION['QTY']=$_GET['selectQTY']; }
			$size=$_SESSION['size'];
			$QTY=$_SESSION['QTY'];
			$query = $mysqli->query( " SELECT * FROM prodotto JOIN magazzino ON prodotto.codice_prodotto=magazzino.ref_prodotto WHERE (  codice_prodotto='$id' AND taglia_prodotto='$size')"); 

			$row = $query->fetch_array ( MYSQLI_ASSOC );
			echo 
			'

				<div id="containerDetail">
				<div class="productDetail">
						<a><img src="'.$row["immagine_prodotto"].'"></a></div>
				<div class="descDetail">
						<a><img src="images/siteContent/'.$row["modello_prodotto"].'.png"></a>
						<a id="titolo">'.$row["nome_prodotto"].' '.$row["colore_prodotto"].' '.$row["modello_prodotto"].' </a><br>
						<a id="dettagliProdotto">Prezzo:  </a>'; if($row["sconto_prodotto"]!=0) { $newPrice=($row["prezzo_prodotto"]-(($row["prezzo_prodotto"]/100)*$row["sconto_prodotto"])); $newPrice=number_format($newPrice,2);
							echo '<a id="taglio">EUR '.$row["prezzo_prodotto"].'</a><br><a id="dettagliProdotto">Prezzo scontato:  </a><a id="sconto">EUR '.$newPrice.'<a id="dettagliProdotto">('.$row["sconto_prodotto"].'%)</a></a>'; } 
							else{ echo '<a id="Prezzo">EUR '.$row["prezzo_prodotto"].'</a>';} echo' Spedizione GRATUITA<br>
						Tutti i prezzi includono l\'IVA.<br><br>
						<a id="dettagliProdotto">Taglia:  </a><br><br>

						<form method="get" action="/Daily/sizeControl.php">
						<select name="shirtSize">
						 <option '; if($_SESSION['size']=="XXS"){echo'selected ';} echo'value="XXS">XXS</option>
						 <option '; if($_SESSION['size']=="XS"){echo'selected ';} echo'value="XS">XS</option>
  						 <option '; if($_SESSION['size']=="S"){echo'selected ';} echo'value="S">S</option>
 						 <option '; if($_SESSION['size']=="M"){echo'selected ';} echo'value="M">M</option>
						 <option '; if($_SESSION['size']=="L"){echo'selected ';} echo'value="L">L</option>
						 <option '; if($_SESSION['size']=="XL"){echo'selected ';} echo'value="XL">XL</option>
						 <option '; if($_SESSION['size']=="XXL"){echo'selected ';} echo'value="XXL">XXL</option>
						</select>
						<input type="submit" value="Seleziona la taglia">
						</form>
							<br>
						<form method="get" action="/Daily/QTYControl.php">
						<select name="selectQTY">
						 <option '; if($_SESSION['QTY']==1){echo'selected ';} echo'value="1">1</option>
						 <option '; if($_SESSION['QTY']==2){echo'selected ';} echo'value="2">2</option>
  						 <option '; if($_SESSION['QTY']==3){echo'selected ';} echo'value="3">3</option>
						</select>
						<input type="submit" value="Seleziona la quantità">
						</form>
					
						<a id='; if($row["qty_disponibile"]>5){ echo'"disponibilitaGreen">Disponibilità: '.$row["qty_disponibile"].'</a><br>';} elseif($row["qty_disponibile"]==0){ echo'"disponibilitaBlack">Disponibilità: '.$row["qty_disponibile"].'</a><br>';} else { echo'"disponibilitaRed">Disponibilità: soltanto '.$row["qty_disponibile"].' rimasti</a><br>';}

						echo'
						<a id="alert"> Attenzione! Conferma Taglia e Quantità con l\'apposito pulsante prima di procedere con l\'acquisto. </a>
						<form method="get" action="/Daily/insertInCart.php" id="buy">
						<input type="submit" '; if($row["qty_disponibile"]-$QTY<0){echo 'disabled value="La quantità richiesta non è disponibile in magazzino">';} else{ echo 'value="Aggiungi al carrello">';} echo '<br><br>

						<a id="dettagliTitolo">Dettagli prodotto:</a><br>
						<a id="dettagliProdotto">Colore: </a> '.$row["colore_prodotto"].'<br><br>
						<a id="dettagliProdotto">Descrizione: </a><br> '.$row["descrizione_prodotto"].'<br>

					</div>
				</div>
				
			';

			?>
			<br><br><br><br><br><br><br><br><br><br><br>
		_______________________________________________________________________________________________________________________________________________
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