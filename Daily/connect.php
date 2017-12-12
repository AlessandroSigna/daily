<?php
	$mysqli = new mysqli("127.0.0.1:3306","root","","DailyCollection");
	if ( $mysqli->connect_error) 
	{
		die("FAILED TO CONNECT TO SQL DATABASE");
	}

?>