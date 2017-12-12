<?php session_start(); ?>

<?php
if($_GET) 
{
	$_SESSION['QTY']=$_GET['selectQTY'];
	header("location:/Daily/product.php?id=".$_SESSION['idProduct']."&size=".$_SESSION['size']."&qty=".$_SESSION['QTY']);
}
?>