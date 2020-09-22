<?php
	
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$db_name = 'happy_feet_demo';

	$conn = new mysqli($servername, $username, $password, $db_name);

	if($conn->connect_error){

		die("connection failed <p>" . $conn->connect_error ."</p>");

	}


?>