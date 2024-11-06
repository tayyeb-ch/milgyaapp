<?php

	ob_start();

	session_start();

	$connection = mysqli_connect("localhost", "root", "", "milgyawebapp_db");

	if (!$connection) {
		echo "Problem Establishing Connection to Database.";
	}

?>