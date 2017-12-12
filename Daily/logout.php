		<?php	session_start(); ?>

		<?php
		$_SESSION['offline']=TRUE;
		$_SESSION['amministratore']=FALSE;
		session_unset();
		session_destroy();
		session_abort();
		header("location: /Daily/index.php?".session_id());
		?>