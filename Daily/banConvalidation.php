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
		if( isset($_SESSION['banErr'])){} else { $_SESSION['banErr']=""; }


		
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{

			if (empty($_POST['banned_email'])) 
			{
				$_SESSION['banErr'] = "Campo obbligatorio";
				header("location: /Daily/ban.php?".session_id());
				exit();
				$_SESSION['banErr']="";

			}

			else 
			{ 
				$mail = $_POST['banned_email']; 
				$query=$mysqli->query("SELECT * FROM cliente WHERE mail_cliente='$mail'");
				if (mysqli_num_rows($query)==0)
				{
					$_SESSION['banErr'] = "Cliente non trovato";
					header("location: /Daily/ban.php?".session_id());						
					exit();
					$_SESSION['banErr']="";
				}
			}
			$_SESSION['banErr']="";


		}

		$del=$mysqli->query("DELETE FROM cliente where mail_cliente='$mail'");
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