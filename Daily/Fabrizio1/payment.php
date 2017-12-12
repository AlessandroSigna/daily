<?php session_start(); ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Pagamento - Daily</title>
		<link rel="stylesheet" type="text/css" href="signup_style.css"/>
				<link rel="icon" href="images/siteContent/icon.png">
	</head>

	<body>

		<ul id="Navigazione">
			<li id="LogoId"><a id="Logo" href="/Daily/"><img src="images/siteContent/logocyan.png"></a></li>
		</ul>
		<div id="containerP">
			<a id="CreateAccount"> Seleziona il metodo di pagamento </a><br><br>
	
				<?php echo '<a id="pMethod" href="/Daily/on_delivery.php?'.session_id().'"><img src="images/siteContent/onDelivery.png"></a>
				<a id="pMethod" href="/Daily/paypal.php?'.session_id().'"><img src="images/siteContent/paypal.png"></a>
				<a id="pMethod" href="/Daily/creditcard.php?'.session_id().'"><img src="images/siteContent/creditCard.png"></a><br><br>'; ?>
		</div>
		<br><br><br><br><br>
		<footer></footer>
	</body>
</html>