<?php session_start(); ?>
<?php include "connect.php"; ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Benvenuto.. - Daily</title>
		<link rel="stylesheet" type="text/css" href="signup_style.css"/>
	</head>

	<body>
		<?php  
		if( isset($_SESSION['discountErr'])){} else { $_SESSION['discountErr']=""; }
		if( isset($_SESSION['codErr'])){} else { $_SESSION['codErr']=""; }

		
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{

			if (empty($_POST['id_maglia'])) 
			{
				$_SESSION['codErr'] = "Campo obbligatorio";
				header("location: /Daily/discount.php?".session_id());
				exit();

			}
			else 
			{ 
				$codice = test_input($_POST['id_maglia']); 
				{
					$query=$mysqli->query("SELECT * FROM prodotto WHERE codice_prodotto='$codice'");
					if (mysqli_num_rows($query)==0)
					{
						$_SESSION['codErr'] = "Prodotto non trovato";
						header("location: /Daily/discount.php?".session_id());						
						exit();
					}
				}
			}

			if (empty($_POST['sconto'])) 
			{
				$_SESSION['discountErr'] = "Campo obbligatorio";
				header("location: /Daily/discount.php?".session_id());
				exit();

			}
			else 
			{ 
				$discount=(float)$_POST['sconto'];
				{
					if ($discount<0 || $discount>100)
					{
						$_SESSION['discountErr'] = "Formato sconto non valido";
						header("location: /Daily/discount.php?".session_id());	
						exit();	
					}
				}
			}
		

		
		}
		$aggiorna=$mysqli->query("UPDATE prodotto SET sconto_prodotto='$discount' WHERE codice_prodotto='$codice'");
		header("location: /Daily/admin.php?".session_id());



		function test_input($data) {
				$data=trim($data);
				$data=stripslashes($data);
				$data=htmlspecialchars($data);
				return $data;
			}
		?>
		
	
	</body>
</html>