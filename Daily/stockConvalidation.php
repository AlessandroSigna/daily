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
		if( isset($_SESSION['tagliaErr'])){} else { $_SESSION['tagliaErr']=""; }
		if( isset($_SESSION['qtyErr'])){} else { $_SESSION['qtyErr']=""; }

		
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{

			if (empty($_POST['id_maglia'])) 
			{
				$_SESSION['codErr'] = "Campo obbligatorio";
				header("location: /Daily/stock.php?".session_id());
				exit();

			}
			else 
			{ 
				$codice = (int)($_POST['id_maglia']); 
				{
					$query=$mysqli->query("SELECT * FROM prodotto WHERE codice_prodotto='$codice'");
					if (mysqli_num_rows($query)==0)
					{
						$_SESSION['codErr'] = "Prodotto non trovato";
						header("location: /Daily/stock.php?".session_id());						
						exit();
					}
				}
			}

			if (empty($_POST['taglia'])) 
			{
				$_SESSION['tagliaErr'] = "Campo obbligatorio";
				header("location: /Daily/stock.php?".session_id());
				exit();

			}

			if (empty($_POST['qty'])) 
			{
				$_SESSION['qtyErr'] = "Campo obbligatorio";
				header("location: /Daily/stock.php?".session_id());
				exit();

			}
			else 
			{ 
				$numero = (int)($_POST['qty']); 
				{
					if ($numero<=0)
					{				
						$_SESSION['qtyErr'] = "Il numero di magliette deve essere strettamente positivo";
						header("location: /Daily/stock.php?".session_id());
						exit();		
					}
				}
			}

		}
		$exists=$mysqli->query("SELECT * FROM magazzino WHERE ref_prodotto='$codice' && taglia_prodotto='$_POST[taglia]'");
		if (mysqli_num_rows($exists)>0)
		{

			$aggiorna=$mysqli->query("UPDATE magazzino SET qty_disponibile=$numero+qty_disponibile WHERE ref_prodotto='$codice' && taglia_prodotto='$_POST[taglia]'");
			header("location: /Daily/admin.php?".session_id());
			exit();

		}
		$var=substr($_POST['taglia'],0,3);

		$aggiungi=$mysqli->query("INSERT INTO magazzino (ref_prodotto, qty_disponibile, taglia_prodotto) VALUES ($codice,$numero,'$var')");
		header("location: /Daily/admin.php?".session_id());
		exit();



		function test_input($data) {
				$data=trim($data);
				$data=stripslashes($data);
				$data=htmlspecialchars($data);
				return $data;
			}
		?>
		
	
	</body>
</html>