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
		if( isset($_SESSION['codErr'])){} else { $_SESSION['codErr']=""; }
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{

			if (empty($_POST['email_admin'])) 
			{
				$_SESSION['codErr'] = "Campo obbligatorio";
				header("location: /Daily/newAdmin.php?".session_id());
				exit();

			}
			else 
			{ 
				$codice = test_input($_POST['email_admin']); 
				{
					$query=$mysqli->query("SELECT * FROM cliente WHERE mail_cliente='$codice'");
					if (mysqli_num_rows($query)==0)
					{
						$_SESSION['codErr'] = "Utente non trovato";
						header("location: /Daily/newAdmin.php?".session_id());						
						exit();
					}
				}
			}

			$_SESSION['codErr']="";
		
		}
		$aggiorna=$mysqli->query("UPDATE cliente SET amministrazione='A' WHERE mail_cliente='$codice'");
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