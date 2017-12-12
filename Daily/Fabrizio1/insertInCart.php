<?php session_start(); ?>
<?php include "connect.php" ?>

<?php
	$query = $mysqli->query( " SELECT * FROM prodotto JOIN carrello ON prodotto.codice_prodotto=carrello.ref_oggetto JOIN magazzino ON prodotto.codice_prodotto=magazzino.ref_prodotto WHERE (  ref_cliente='$_SESSION[mailUtente]' AND taglia_acquistata=taglia_prodotto)");
while ( $row = $query->fetch_array ( MYSQLI_ASSOC ) )
{
	if($row["ref_oggetto"]==$_SESSION['idProduct'] AND $row["taglia_acquistata"]==$_SESSION['size'])
	{
		$result=$mysqli->query("UPDATE carrello SET qty_acquistata=qty_acquistata+'$_SESSION[QTY]' WHERE ( ref_oggetto='$_SESSION[idProduct]' AND taglia_acquistata='$_SESSION[size]')");
			if($result)
			{
				$result2=$mysqli->query("UPDATE magazzino SET qty_disponibile=qty_disponibile-'$_SESSION[QTY]' WHERE ( ref_prodotto='$_SESSION[idProduct]' AND taglia_prodotto='$_SESSION[size]')");
				header("location:/Daily/product.php?id=".$_SESSION['idProduct']."&size=".$_SESSION['size']."&qty=".$_SESSION['QTY']);
				exit();
			}
			else
			{
				die(mysqli_error($mysqli));
			}
	}
}

			$result=$mysqli->query("INSERT INTO carrello (`ref_cliente`,`ref_oggetto`,`taglia_acquistata`,`qty_acquistata`) VALUES ('".$_SESSION['mailUtente']."','".$_SESSION['idProduct']."','".$_SESSION['size']."','". $_SESSION['QTY']."')");
			if($result)
			{
				$result2=$mysqli->query("UPDATE magazzino SET qty_disponibile=qty_disponibile-'$_SESSION[QTY]' WHERE ( ref_prodotto='$_SESSION[idProduct]' AND taglia_prodotto='$_SESSION[size]')");
				header("location:/Daily/product.php?id=".$_SESSION['idProduct']."&size=".$_SESSION['size']."&qty=".$_SESSION['QTY']);
				exit();
			}
			else
			{
				die(mysqli_error($mysqli));
			}

?>