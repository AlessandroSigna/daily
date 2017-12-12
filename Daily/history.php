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

		<form method="get" autocomplete="off" id="Search" action="/Daily/search.php">
			<input type="text" placeholder="Cerca.." name="search">
		</form>
		
		<div id="resultPage">

			<?php  echo '<h1>La tua cronologia acquisti</h1><br><br><br><br>'; 

			$query = $mysqli->query( " SELECT * FROM storico_acquisti JOIN prodotto ON storico_acquisti.ref_oggetto_SA=prodotto.codice_prodotto WHERE (  ref_cliente_SA='$_SESSION[mailUtente]' )");
while ( $row = $query->fetch_array ( MYSQLI_ASSOC ) )
{	

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
						<a>'; if($row["sconto_prodotto"]!=0) { $newPrice=($row['prezzo_prodotto']- ($row['prezzo_prodotto'])*($row['sconto_prodotto']/100)); echo $newPrice.' euro ( '.$row["sconto_prodotto"].'% di sconto )</a><br>';} else {echo $row["prezzo_prodotto"].' euro </a><br>';} 
						echo '
						<a>Taglia: '.$row["taglia_acquistati_SA"].'</a><br>
						<a>Quantità: '.$row["qty_acquistati_SA"].'</a><br>
						<a>Codice Fatturazione: '.$row["codice_fatturazione"].'</a><br>
						<a>'; if($row["sconto_prodotto"]!=0) 
									{ $newPrice=($row['prezzo_prodotto']- ($row['prezzo_prodotto'])*$row['sconto_prodotto']/100);
						 			echo 'Prezzo totale: '.$row['prezzo_prodotto'].' euro';
						 			} 
						else
						  			{
						  				$newPrice=($row['prezzo_prodotto']- ($row['prezzo_prodotto'])*$row['sconto_prodotto']/100);
						  				echo 'Prezzo totale: '.$row["prezzo_prodotto"]*$row["qty_acquistati_SA"].' euro </a><br>';
						  			}
						$numeroFattura=$row["codice_fatturazione"];
						$numeroFattura.=".pdf";
						$link="href=/Daily/$numeroFattura";

						
						/Daily/removeFromCart.php
						echo'
						<form method="get" action="'.$numeroFattura.'" id="discard">
						<input type="hidden" name="oggetto" value="'.$row["ref_oggetto_SA"].'">
						<input type="hidden" name="taglia" value="'.$row["taglia_acquistati_SA"].'">
						<input type="hidden" name="qty" value="'.$row["qty_acquistati_SA"].'">
						<input type="submit" value="Vai alla fattura"><br><br>
						</form>
					</div>
				</div>
				
			';
	

}

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