<?php session_start(); ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Registrati - Daily</title>
		<link rel="stylesheet" type="text/css" href="signup_style.css"/>
				<link rel="icon" href="images/siteContent/icon.png">
	</head>

	<body>
		<ul id="Navigazione">
			<li id="LogoId"><a id="Logo" href="/Daily/"><img src="images/siteContent/logocyan.png"></a></li>
		</ul>
		<?php 
		if (!$_SESSION['amministratore'])
		{
			header("location: /Daily/index.php?".session_id());
		}
		?><!--
		<form method="post" autocomplete="off" action="/Daily/convalidation.php" id="signup">
			<a id="CreateAccount"> Crea il tuo Account Daily</a><br><br>
				Il tuo nome:<br>
				<?php if( isset($_SESSION['nomeErr'])){} else { $_SESSION['nomeErr']=""; }
						echo '<p id="error">'.$_SESSION['nomeErr'].'</p><br>'; ?>
				<input type="text" name="nome_utente"><br><br>
				Il tuo cognome:<br>
				<?php if( isset($_SESSION['cognomeErr'])){} else { $_SESSION['cognomeErr']=""; }
						echo '<p id="error">'.$_SESSION['cognomeErr'].'</p><br>'; ?>
				<input type="text" name="cognome_utente"><br><br>
				La tua e-mail:<br>
				<?php if( isset($_SESSION['mailErrB'])){} else { $_SESSION['mailErrB']=""; }
						echo '<p id="error">'.$_SESSION['mailErrB'].'</p><br>'; ?>
				<input type="text" name="mail_utente"><br><br>
				Inserisci la tua password:<br>
				<?php if( isset($_SESSION['pwdErrB'])){} else { $_SESSION['pwdErrB']=""; }
						echo '<p id="error">'.$_SESSION['pwdErrB'].'</p><br>'; ?>
				<input type="password" name="password_utente" placeholder="Almeno 8 caratteri alfanumerici"><br><br>
				Reinserisci la tua password:<br>
				<input type="password" name="password_utente2" placeholder="Le due password devono coincidere"><br><br>
				Seleziona la domanda di sicurezza:<br>
				<select name="domanda">
 				 <option value="1">Nome da nubile di tua madre</option>
  				 <option value="2">Il tuo soprannome da bambino/a</option>
 				 <option value="3">Nome della tua professoressa preferita</option>
				</select>
				<?php if( isset($_SESSION['sicurezzaErr'])){} else { $_SESSION['sicurezzaErr']=""; }
						echo '<p id="error">'.$_SESSION['sicurezzaErr'].'</p><br>'; ?>
				<input type="text" name="domanda_sicurezza"><br><br>
				Inserisci l'indirizzo a cui vuoi spedita la merce:<br>
				<?php if( isset($_SESSION['spedizioneErr'])){} else { $_SESSION['spedizioneErr']=""; }
						echo '<p id="error">'.$_SESSION['spedizioneErr'].'</p><br>'; ?>
				<input type="text" name="spedizione_utente"><br><br>
				Inserisci la tua città:<br>
				<?php if( isset($_SESSION['cittaErr'])){} else { $_SESSION['cittaErr']=""; }
						echo '<p id="error">'.$_SESSION['cittaErr'].'</p><br>'; ?>
				<input type="text" name="citta_utente"><br><br>
				Inserisci il tuo numero di telefono:<br>
				<?php if( isset($_SESSION['telefonoErr'])){} else { $_SESSION['telefonoErr']=""; }
						echo '<p id="error">'.$_SESSION['telefonoErr'].'</p><br>'; ?>
				<input type="text" name="telefono_utente" placeholder="Opzionale"><br><br>
				<input type="submit" value="Registrati">
		</form>-->
		<form enctype="multipart/form-data" action="upload.php" method="POST">
  		<input type="hidden" name="MAX_FILE_SIZE" value="30000">
  		Carica immagine: <br><input name="userfile" type="file"></br>
  		<input type="submit" value="Invia File">
		</form>
		<br><br><br><br><br>
		<footer></footer>
	</body>
</html>