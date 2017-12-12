<?php session_start(); ?>
<?php include "connect.php"; ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Benvenuto.. - Daily</title>
		<link rel="stylesheet" type="text/css" href="passRecovery_style.css"/>
	</head>

	<body>
		<?php  

		if( isset($_SESSION['pwdErrB'])){} else { $_SESSION['pwdErrB']=""; }
		if( isset($_SESSION['sicurezzaErr'])){} else { $_SESSION['sicurezzaErr']=""; }

		//$nome=$cognome=$mail=$pwd=$sicurezza=$spedizione=$citta=$telefono="";
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{

			$nDomanda=$_POST['domanda'];
			switch ($nDomanda) {
				case 1:
					header("location: /Daily/discount.php?".session_id());
					break;
				case 2:
					header("location: /Daily/newAdmin.php?".session_id());
					break;
				case 3:
					header("location: /Daily/newShirt.php?".session_id());
					break;
				case 4:
					header("location: /Daily/stock.php?".session_id());
					break;
				case 5:
					header("location: /Daily/ban.php?".session_id());
					break;
				default:
					header("location: /Daily/admin.php?".session_id());
					break;
			}
		}

	
		?>
		
	
	</body>
</html>