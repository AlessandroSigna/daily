<?php include "connect.php" ?>
<?php session_start(); ?>


<!DOCTYPE html>

<html>
	<head>
		<title>Ricerca - Daily</title>
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

		
		<div id="resultPage">

			<?php  echo '<h1>Il tuo carrello</h1>'; 

			$query = $mysqli->query( " SELECT * FROM prodotto JOIN carrello ON prodotto.codice_prodotto=carrello.ref_oggetto JOIN magazzino ON prodotto.codice_prodotto=magazzino.ref_prodotto WHERE (  ref_cliente='$_SESSION[mailUtente]' AND taglia_acquistata=taglia_prodotto)");
			$prezzoTotale=0;
while ( $row = $query->fetch_array ( MYSQLI_ASSOC ) )
{	
	$newPrice=($row["prezzo_prodotto"]-(($row["prezzo_prodotto"]/100)*$row["sconto_prodotto"])); 
		$newPrice=number_format($newPrice,2);
		$piecePrice=$newPrice*$row["qty_acquistata"];
	echo 
			'
				<div id="container">
				<div class="productList">
						<a><img src="'.$row["immagine_prodotto"].'"></a></div>
				<div class="descList">
						<a><img src="images/siteContent/'.$row["modello_prodotto"].'.png"></a>
						<a id="titolo">'.$row["nome_prodotto"].' '.$row["colore_prodotto"].' '.$row["modello_prodotto"].' </a><br><br>
						<a>'.$row["nome_prodotto"].' </a>
						<a>'.$row["colore_prodotto"].'</a><br>
						<a>'; if($row["sconto_prodotto"]!=0) {  echo $newPrice.' euro ( '.$row["sconto_prodotto"].'% di sconto )</a><br>';} else {echo $row["prezzo_prodotto"].' euro </a><br>';} 
						echo '
						<a>Taglia: '.$row["taglia_acquistata"].'</a><br>
						<a>Quantità: '.$row["qty_acquistata"].'</a><br>
						<a>'; if($row["sconto_prodotto"]!=0) { echo 'Prezzo totale: '.$piecePrice.' euro';} else {echo 'Prezzo totale: '.$row["prezzo_prodotto"]*$row["qty_acquistata"].' euro </a><br>';}
						$prezzoTotale=$prezzoTotale+$piecePrice;
						echo'
						<form method="get" action="/Daily/removeFromCart.php" id="discard">
						<input type="hidden" name="oggetto" value="'.$row["ref_oggetto"].'">
						<input type="hidden" name="taglia" value="'.$row["taglia_acquistata"].'">
						<input type="hidden" name="qty" value="'.$row["qty_acquistata"].'">
						<input type="submit" value="Rimuovi dal carrello"><br><br>
						</form>
					</div>
				</div>
				
			';
	

}

 echo' <div id="container"><div class="descList"><a>Prezzo totale: EUR '.$prezzoTotale.' </a><br><br>
	<form action="/Daily/payment.php"><input type="submit" value="Procedi all\'acquisto"></form></div></div>';

?>
			<br><br>
			<a id="logoFine"><img src="images/siteContent/logocyan.png"></a>
		</div>

		<footer>
			<ul id="NavigazioneFooter">
			<li><a id="ListaFooter" href="/Daily/map.php">Mappa Negozi<br><img src="images/siteContent/logo.png"></a></li>
			<li id="Content">Contatti<br>
			<p id="Contatti">
				Fabrizio Lo Presti, Via Montecarlo 7, 90146, Palermo (IT) <br>|| fabrizioxxx@xxx.com || 329xxxxxxx<br>
				Lorenzo Ganci, Via Ferdinando Palasciano 24, 90146, Palermo (IT) <br>|| lorenzoxxx@xxx.com || 333xxxxxxx
			</p></li>
		</ul>
		</footer>
	</body>
</html>