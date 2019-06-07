<?php
	$server = "localhost";//主機
	$username = "root";//資料庫使用者名稱
	$password = "usbw";//資料庫密碼
	$dbname = "test";//資料庫

	$conn = new mysqli($server, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}else{
		print_r("connect success");
	}
?>