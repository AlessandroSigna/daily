<?php session_start(); ?>
<?php include "connect.php" ?>

<?php
		$result=$mysqli->query("UPDATE magazzino SET qty_disponibile=qty_disponibile+'$_GET[qty]' WHERE ( ref_prodotto='$_GET[oggetto]' AND taglia_prodotto='$_GET[taglia]')");
			if($result)
			{
				$result2=$mysqli->query("DELETE FROM carrello WHERE ( ref_cliente='$_SESSION[mailUtente]' AND ref_oggetto='$_GET[oggetto]' AND taglia_acquistata='$_GET[taglia]')");
				header("location:/Daily/cart.php");
				exit();
			}
			else
			{
				die(mysqli_error($mysqli));
			}

			
?>