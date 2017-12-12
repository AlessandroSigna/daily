<?php session_start(); ?>
<?php include "connect.php" ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Daily - Shop Online</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="index_style.css"/>
		<link rel="shortcut icon" href="images/siteContent/icon.png">
	</head>

	<body>
		<header>
		<ul id="Navigazione">
			<li id="LogoId"><a id="Logo" href="/Daily"><img src="images/siteContent/logo.png"></a></li>
			<?php echo ' <li><a id="ListaC" href="/Daily/categories.php?'.session_id().'">CATEGORIE</a></li>' ?>
			
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
				if( isset($_SESSION['codErr'])){ $_SESSION['codErr']="";  } else { $_SESSION['codErr']=""; }
				if( isset($_SESSION['discountErr'])){ $_SESSION['discountErr']=""; } else { $_SESSION['discountErr']=""; }
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
						<li style="float:right"><a id="Logout" href="/Daily/cart.php?'.session_id().'"><img src="images/siteContent/cartIco.png"></a></li>
						<li style="float:right"><a id="Logout" href="/Daily/user.php?'.session_id().'"><img src="images/siteContent/userIco.png"></a></li>
						
					';
					if($_SESSION['amministratore'])
					{
					echo
					' 	<li style="float:right"><a id="Logout" href="/Daily/admin.php?'.session_id().'"><img src="images/siteContent/admin.png"></a></li>
					';
					}
					echo '<li id="rightContent">Bentornato, '.$_SESSION["nomeUtente"].' '.$_SESSION["cognomeUtente"].'</li>';
				}

			?>
			
		</ul>
		</header>

		<form method="get" autocomplete="off" id="Search" action="/Daily/search.php">
			<input type="text" placeholder="Cerca.." name="search">
		</form>

		<div id="resultPage">
		<?php echo '<h1>Prodotti più acquistati</h1><br><br><br><br>'; 

		$query = $mysqli->query( " SELECT * FROM prodotto JOIN storico_acquisti ON prodotto.codice_prodotto=storico_acquisti.ref_oggetto_SA GROUP BY codice_prodotto HAVING sum(qty_acquistati_SA)>=1 ORDER BY rand() LIMIT 4");	
		while ( $row = $query->fetch_array ( MYSQLI_ASSOC ))
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
}

		?>
		<?php echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><h1>Prodotti in sconto</h1><br><br><br><br>'; 

		$query = $mysqli->query( " SELECT * FROM prodotto WHERE sconto_prodotto!=0 ORDER BY RAND() LIMIT 4");

		while ( $row = $query->fetch_array ( MYSQLI_ASSOC ))
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

}

		?>
		<?php  if($_SESSION['offline']==FALSE) {
			echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><h1>Scelti per te</h1><br><br><br><br><br>'; 
		
				$query = $mysqli->query( " SELECT *
				FROM prodotto P
				WHERE LEFT(codice_prodotto,2) IN (
				SELECT LEFT (codice_prodotto,2)
				FROM storico_acquisti S2 JOIN prodotto P2 on S2.ref_oggetto_SA=P2.codice_prodotto
                WHERE S2.ref_cliente_SA='$_SESSION[mailUtente]'
				GROUP BY (LEFT(codice_prodotto,2))
				HAVING sum(qty_acquistati_SA)>= 
								ALL(SELECT SUM(qty_acquistati_SA) AS TotaleAcquisti
								FROM storico_acquisti S3 JOIN prodotto P3 on S3.ref_oggetto_SA=P3.codice_prodotto
                                WHERE S3.ref_cliente_SA='$_SESSION[mailUtente]'
                                GROUP BY LEFT (P3.codice_prodotto,2)))
				AND RIGHT (codice_prodotto,2) NOT IN (
				SELECT RIGHT (P2.codice_prodotto,2)
                FROM prodotto AS P2 JOIN  storico_acquisti S2 ON P2.codice_prodotto=S2.ref_oggetto_SA
                WHERE S2.ref_cliente_SA = '$_SESSION[mailUtente]' AND LEFT(P.codice_prodotto,2)=LEFT(P2.codice_prodotto,2)  )
				ORDER BY rand()
				LIMIT 4;");//FINE SQL
				while ( $row = $query->fetch_array ( MYSQLI_ASSOC ))
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