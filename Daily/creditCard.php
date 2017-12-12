<?php session_start(); ?>
<?php include "connect.php"; ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Daily - Shop Online</title>
		<link rel="stylesheet" type="text/css" href="signup_style.css"/>
	</head>

	<body>

	<div id="resultPage">
			<?php
			$query=$mysqli->query("SELECT * FROM cliente WHERE mail_cliente='$_SESSION[mailUtente]'");
			$row=$query->fetch_array(MYSQLI_ASSOC);
			if (empty($row['codice_carta_cliente']))
			{
				header("location: /Daily/creditCardAdding.php?".session_id());
			}
			else
			{
				$read=substr($row['codice_carta_cliente'],0,4 );
				$ready=substr($row['codice_carta_cliente'],12,4 );
				echo 
				'
					Ciao '.$_SESSION['nomeUtente']. ' Hai già inserito i dati della carta di credito <b> '.$read.' - xxxx - xxxx - '.$ready.'<br></b> Scegli un opzione:<br><br><form action="/Daily/creditCardAdding.php"><input type="submit" value="Modifica dati"></form>
			<form action="/Daily/purchased.php"><input type="submit" value="Procedi all\'acquisto"></form>
				';

			}

			?>
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