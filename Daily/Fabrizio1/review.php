<?php session_start(); ?>

<!DOCTYPE html>
<?php include "connect.php"; ?>
<html>
	<head>
		<title>Daily - Shop Online</title>
		<link rel="stylesheet" type="text/css" href="signup_style.css"/>
	</head>

	<body>

	<div id="resultPage">

		<?php echo ' Complimenti <a style="font-style:italic">' .$_SESSION['nomeUtente'].'!</a><br><br>' ?> 
			Ecco le tue nuove credenziali:<br><br><br>
			<?php 
					$myQuery=$mysqli->query(" SELECT * FROM cliente WHERE mail_cliente='$_SESSION[mailUtente]' ");
					$row=$myQuery->fetch_array(MYSQLI_ASSOC);
					$nome=$row['nome_cliente'];
					$cognome=$row['cognome_cliente'];
					$mail=$row['mail_cliente'];
					$pwd=$row['password_cliente'];
					$indirizzo=$row['spedizione_cliente'];
					$citta=$row['citta_cliente'];
					echo 'Nome:		<a style="font-style:italic">'.$nome.'</a><br>Cognome:		<a style="font-style:italic">'.$cognome.'</a><br>Email:		<a style="font-style:italic">'.$mail.'</a><br>Password:		<a style="font-style:italic">'.$_SESSION['passwordTemporanea'].'</a><br>Indirizzo di spedizione:		<a style="font-style:italic">'.$indirizzo. ' , '.$citta.'		<br><br>

						_____________________________________________________________________________________<br>
			<a id="Logo" href="/Daily/index.php?'.session_id().'"><img src="images/siteContent/homepage.png"></a>';
			$_SESSION['passwordTemporanea']="";
			?>

		</div>

	</body>
		<br><br><br><br><br>
		<footer></footer>
	</body>
</html>