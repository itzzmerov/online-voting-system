<?php
	$conn = new mysqli('localhost', 'root', '', 'evox_voting');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>