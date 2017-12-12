<?php session_start(); ?>
<?php include "connect.php" ?>

<?php
	
			$result=$mysqli->query("INSERT INTO storico_acquisti (`codice_fatturazione`,`data_acquisto`,`ref_cliente_SA`,`ref_oggetto_SA`, `qty_acquistati_SA`,`prezzo_acquistati_SA`,`taglia_acquistati_SA`) VALUES (2,'2011-04-12','fabriziolopresti@live.it',1002,2,5,'S')");
?>