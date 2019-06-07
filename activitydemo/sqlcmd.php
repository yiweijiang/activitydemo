<?php
	function sqlcmd($sql){
		$servername = "localhost";
		$username = "root";
		$password = "usbw";
		$dbname = "test";
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
	    	die("Connection failed: " . $conn->connect_error);
		}
		$result = $conn->query($sql);
		$conn->close(); 
		return $result;
	}
?>