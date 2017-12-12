<?php
if (isset($_SESSION['size'])){} else { $_SESSION['size']="M"; }
if (isset($_SESSION['QTY'])){} else { $_SESSION['QTY']=1; }
$size=$_SESSION['size'];
$QTY=$_SESSION['QTY'];

if($_GET) 
{
	$ricerca='%'.$_GET['search'].'%';
	$query = $mysqli->query( " SELECT * FROM prodotto WHERE ( keywords_prodotto LIKE '$ricerca')");

while ( $row = $query->fetch_array ( MYSQLI_ASSOC ) )
{	
	echo 
			'
				<div id="container">
				<div class="productList">
						<a href="/Daily/product.php?id='.$row["codice_prodotto"].'&size='.$size.'&qty='.$QTY.'"><img src="'.$row["immagine_prodotto"].'"></a></div>
				<div class="descList">
						<a><img src="images/siteContent/'.$row["modello_prodotto"].'.png"></a>
						<a id="titolo" href="/Daily/product.php?id='.$row["codice_prodotto"].'&size='.$size.'&qty='.$QTY.'">'.$row["nome_prodotto"].' '.$row["colore_prodotto"].' '.$row["modello_prodotto"].' </a><br><br>
						<a>'.$row["nome_prodotto"].'</a><br>
						<a>'.$row["colore_prodotto"].'</a><br>
						<a>'; if($row["sconto_prodotto"]!=0) { $newPrice=($row["prezzo_prodotto"]-(($row["prezzo_prodotto"]/100)*$row["sconto_prodotto"])); $newPrice=number_format($newPrice,2); echo $newPrice.' euro ( '.$row["sconto_prodotto"].'% di sconto )</a><br>';} else {echo $row["prezzo_prodotto"].' euro </a><br>';} 
						echo '
					</div>
				</div>
				
			';
}
}
?>