<?php	session_start(); ?>
<?php include "connect.php"; ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Benvenuto.. - Daily</title>
		<link rel="stylesheet" type="text/css" href="signup_style.css"/>
	</head>

	<body>

		<?php  
	if( isset($_SESSION['CCErr'])){} else { $_SESSION['CCErr']=""; }
	if( isset($_SESSION['cardErr'])){} else { $_SESSION['cardErr']=""; }
	
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
				if (empty($_POST['codice_carta_di_credito'])) {
						$_SESSION['CCErr'] = "Campo obbligatorio";
						header("location: /Daily/creditCardAdding.php?".session_id());
						exit();
					}
				else 
				{ 
					$cc = test_input($_POST['codice_carta_di_credito']);
					if(strlen($cc)!=16)
					{
						$_SESSION['CCErr'] = "Codice non valido";
						header("location: /Daily/creditCardAdding.php?".session_id());
						exit();
					}
				}

					$_SESSION['CCErr']="";

				if (empty($_POST['CCV'])) {
						$_SESSION['cardErr'] = "Campo obbligatorio";
						header("location: /Daily/creditCardAdding.php?".session_id());
						exit();
					} else { 
								$CVV=$_POST['CCV'];
								if (strlen($CVV)!=3)
								{
									$_SESSION['cardErr'] = "Il CCV ammette solo 3 cifre";
									header("location: /Daily/creditCardAdding.php?".session_id());
									exit();					
								}
							}


			$_SESSION['cardErr']="";	
			$isSaved=$_POST['card_save'];
			if ($isSaved=='Si')
			{
				$query=$mysqli->query("UPDATE cliente SET codice_carta_cliente=$cc WHERE mail_cliente='$_SESSION[mailUtente]'");
				$query=$mysqli->query("UPDATE cliente SET CCV_cliente=$CVV WHERE mail_cliente='$_SESSION[mailUtente]'");
				$query=$mysqli->query("UPDATE cliente SET fatturazione_cliente='$_POST[indirizzo]' WHERE mail_cliente='$_SESSION[mailUtente]'");
				$query=$mysqli->query("UPDATE cliente SET mese_scadenza='$_POST[mese]' WHERE mail_cliente='$_SESSION[mailUtente]'");	
				$query=$mysqli->query("UPDATE cliente SET anno_scadenza='$_POST[anno]' WHERE mail_cliente='$_SESSION[mailUtente]'");		
	
				header("location: /Daily/creditCardAdding.php?".session_id());
				exit();
			}
			else
			{
				header("location: /Daily/creditCardAdding.php?".session_id());
			}

				if (empty($_POST['indirizzo'])) {
						$_SESSION['indErr'] = "Campo obbligatorio";
						header("location: /Daily/creditCardAdding.php?".session_id());
						exit();
				}
		
		}

		


		function test_input($data) {
				$data=trim($data);
				$data=stripslashes($data);
				$data=htmlspecialchars($data);
				return $data;
			}

		?>
	
	</body>
</html>