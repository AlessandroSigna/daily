<?php
if ($_GET) {
	if(isset($_GET['search'])){
	$name= $_GET['search'];
	/*if(empty($name)) {
		echo "//";
	} else{*/
		echo '<a id="Risposta">Mostra risultati per: '.$name.'</a>';
	/*}*/
}
}
?>