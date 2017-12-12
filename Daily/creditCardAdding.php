<?php session_start(); ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Inserisci dati carta di Credito - Daily</title>
		<link rel="stylesheet" type="text/css" href="signup_style.css"/>
				<link rel="icon" href="images/siteContent/icon.png">
	</head>

	<body>

		<ul id="Navigazione">
			<li id="LogoId"><a id="Logo" href="/Daily/"><img src="images/siteContent/logocyan.png"></a></li>
		</ul>
		<form method="post" autocomplete="off" action=<?php echo ' "/Daily/creditCardConvalidation.php?'.session_id().'"'; ?> id="signup">
			<a id="CreateAccount"> Inserisci le tue credenziali </a><br><br>
	
				Codice carta di credito:<br>
				<?php if( isset($_SESSION['CCErr'])){} else { $_SESSION['CCErr']=""; }
						echo '<p id="error">'.$_SESSION['CCErr'].'</p><br>'; ?>
				<input type="text" name="codice_carta_di_credito"><br><br>
				Mese di Scadenza<br>
 				<select name="mese">
  				<option value="01">01</option>
  				<option value="02">02</option>
  				<option value="03">03</option>
  				<option value="04">04</option>
  				<option value="05">05</option>
  				<option value="06">06</option>
  				<option value="07">07</option>
  				<option value="08">08</option>
  				<option value="09">09</option>
  				<option value="10">10</option>
  				<option value="11">11</option>
  				<option value="12">12</option>
  				</select><br><br>
				Anno Scadenza:<br>
 				<select name="anno">
  				<option value="17">2017</option>
  				<option value="18">2018</option>
  				<option value="19">2019</option>
  				<option value="20">2020</option>
  				<option value="21">2021</option>
  				<option value="22">2022</option>
  				</select><br><br>
				Credit Valutation Value:<br>
				<?php if( isset($_SESSION['cardErr'])){} else { $_SESSION['cardErr']=""; }
						echo '<p id="error">'.$_SESSION['cardErr'].'</p><br>'; ?>
				<input type="text" name="CCV"><br><br>
				Inserisci l'indirizzo di fatturazione:
				<?php if( isset($_SESSION['indErr'])){} else { $_SESSION['indErr']=""; }
						echo '<p id="error">'.$_SESSION['indErr'].'</p><br>'; ?>
				<input type="text" name="indirizzo">
				Aggiornare/Salvare i dati della carta di credito?<br><br>
 				<input type="radio" name="card_save" value="Si"> SI<br>
  				<input type="radio" name="card_save" value="No"> NO<br><br>
				<input type="submit" value="Inserisci dati"><br><br><br>
				<img id="cards" src="images/siteContent/cc.jpg" alt="Carte di credito accettate">

			<br><br>
			
			<br><br>
		</form>
		<br><br><br><br><br>
		<footer></footer>
	</body>
</html>