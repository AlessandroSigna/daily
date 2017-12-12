<?php session_start(); ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Daily - Shop Online</title>
		<link rel="stylesheet" type="text/css" href="signup_style.css"/>
		<link rel="shortcut icon" href="images/siteContent/icon.png">
	</head>

	<body>
	<?php 
	$mailUser=$_SESSION['mailUtente'];

	define('FPDF_FONTPATH','./font/');
	include "connect.php"; 
	require('fpdf.php');

	$p = new fpdf();

	$p->AddPage();
	$p->SetFont('Arial','B',13);
	$p->Image('C:\Users\User\Documents\Daily\images\siteContent\logocyan.png', 70,5);
	$p->Image('C:\Users\User\Documents\Daily\images\siteContent\intestazione.png', 80,25);
	$qry=$mysqli->query("SELECT * FROM storico_acquisti WHERE codice_fatturazione = (SELECT MAX(codice_fatturazione) FROM storico_acquisti)");
	$result=$qry->fetch_array(MYSQLI_ASSOC);
	$numeroFattura=($result['codice_fatturazione'])+1;
	$query=$mysqli->query( "SELECT * FROM carrello JOIN prodotto ON prodotto.codice_prodotto=carrello.ref_oggetto WHERE ref_cliente='$_SESSION[mailUtente]'");
	$p->Multicell(300,50,"");
	$p->Multicell(0,10,"Fattura numero $numeroFattura");

	$y=$p->GetY();
	$x=$p->GetX();
	$p->SetXY($x,$y);
	$p->MultiCell(30,15, "Id Prodotto",1);
	$x=$p->GetX();
	$p->SetXY($x+30,$y);
	$p->MultiCell(100,15, "QTY Dettagli Prodotto",1);
	$x=$p->GetX();
	$p->SetXY($x+130,$y);
	$p->MultiCell(30,15, "Prezzo Unit.",1);	
	$p->SetXY(170,$y);

	$p->MultiCell(25,15, "Tot.",1);
	$totAcquisto=0;
	$p->SetFont('Arial','',13);
	//PER OGNI ARTIOCOLO IN CARRELLO
	while($row=$query->fetch_array(MYSQLI_ASSOC))
	{

		$y=$p->GetY();
		$prezzoEffettivo=round($row['prezzo_prodotto']-($row['sconto_prodotto'])*($row['prezzo_prodotto']/100),2); //CALCOLA L'EFFETTIVO SE C'E' UNO SCONTO
		$prezzototale= round(($prezzoEffettivo)*($row['qty_acquistata']),1); //PREZZO DI OGNI CAPO PER LA QUANTITA' ACQUISTATA
		$totAcquisto+=$prezzototale;
		$x=$p->GetX();
		$p->SetXY($x,$y);
		$p->MultiCell(30,15, "$row[codice_prodotto]",1);
		$x=$p->GetX();
		$p->SetXY($x+30,$y);
		$p->MultiCell(100,15, "  $row[qty_acquistata]     $row[nome_prodotto] $row[modello_prodotto] $row[colore_prodotto] $row[taglia_acquistata]",1);
		$x=$p->GetX();
		$p->SetXY($x+130,$y);

		$p->MultiCell(30,15, "$prezzoEffettivo",1);
		$p->SetXY(170,$y);
		$p->MultiCell(25,15, "$prezzototale ",1);

	}
	$p->SetXY(170,$y+15);
	$p->MultiCell(25,15, "$totAcquisto ",1);
	$query2=$mysqli->query( "SELECT * FROM carrello JOIN cliente ON cliente.mail_cliente=carrello.ref_cliente WHERE ref_cliente='$_SESSION[mailUtente]'");
	$riga=$query2->fetch_array(MYSQLI_ASSOC);
	$p->SetFont('Arial','',10);
	$temp=$numeroFattura;
	$numeroFattura.=".pdf";
	if ($riga['fatturazione_cliente']!='')
	{
		$p->MultiCell(0,10, "$riga[nome_cliente] $riga[cognome_cliente], $riga[fatturazione_cliente], $riga[citta_cliente]",0, 'R');
	}
	else
	{
		$p->MultiCell(0,10, "$riga[nome_cliente] $riga[cognome_cliente], Indirizzo di spedizione: $riga[spedizione_cliente], $riga[citta_cliente]",0, 'R');

	}
	$query=$mysqli->query( "SELECT * FROM carrello JOIN prodotto ON prodotto.codice_prodotto=carrello.ref_oggetto WHERE ref_cliente='$_SESSION[mailUtente]'");
	$data=date("d/m/Y");
	while($row=$query->fetch_array(MYSQLI_ASSOC))
	{
		$prezzoEffettivo=$row['prezzo_prodotto']-($row['sconto_prodotto'])*($row['prezzo_prodotto']/100);
		$result=$mysqli->query("INSERT INTO storico_acquisti (`codice_fatturazione`,`data_acquisto`,`ref_cliente_SA`,`ref_oggetto_SA`, `qty_acquistati_SA`,`prezzo_acquistati_SA`,`taglia_acquistati_SA`) VALUES ('$temp','$data','$mailUser','$row[codice_prodotto]','$row[qty_acquistata]','$prezzoEffettivo','$row[taglia_acquistata]')");
	}
	$destroy=$mysqli->query("DELETE FROM carrello WHERE ref_cliente='$_SESSION[mailUtente]'");
	$p->output('F',$numeroFattura ); 
	$_SESSION['nomeFile']="href=/Daily/$numeroFattura";
	?>
	<div id="resultPage">
			<?php echo 'Complimenti '.$_SESSION['nomeUtente'].', il tuo acquisto è stato approvato<br><br>'?>
			Seleziona una delle opzioni per continuare:<br><br><br>
			<?php 
			echo '<a id="Logo" href="/Daily/index.php?'.session_id().'"><img src="images/siteContent/homepage.png"></a><a id="Logo" '.$_SESSION['nomeFile'].'><img src="images/siteContent/receipt.png"></a>';	
			?>
			<br><br><br>
			_________________________________________________________________________________
			<a id="logoFine"><img src="images/siteContent/logocyan.png"></a>
		</div>

	</body>
		<br><br><br><br><br>
		<footer>
		<ul id="NavigazioneFooter">
			<li><a id="ListaFooter" href="/Daily/map.php">Mappa Negozi<br><img src="images/siteContent/logo.png"></a></li>
			<li id="Content">Contatti<br>
			<a id="Contatti">
				Fabrizio Lo Presti, Via Montecarlo 7, 90146, Palermo (IT) <br>|| fabrizioxxx@xxx.com || 329xxxxxxx<br>
				Lorenzo Ganci, Via Ferdinando Palasciano 24, 90146, Palermo (IT) <br>|| lorenzoxxx@xxx.com || 333xxxxxxx
			</a></li>
		</ul></footer>
	</body>
</html>