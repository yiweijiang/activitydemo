<?php include 'sqlcmd.php';?>
<?php 
	session_start();
	$name=$_POST['Register_name'];//post獲取表單裡的name
	$email=$_POST['Register_email'];//post獲取表單裡的email
	$phone=$_POST['Register_phone'];//post獲取表單裡的phone
	$password=$_POST['Register_password'];//post獲取表單裡的password
    
	$sql = "SELECT * FROM member WHERE mEmail='$email'";
	$result = sqlcmd($sql);

	if ($result->num_rows>0) {
		$_SESSION["error"] = '此Email已存在';
		header('Location:index.php');
	}else{
		$sql ="INSERT INTO member (mid, mName, mEmail, mPhone, mPassword) VALUES (NULL, '$name', '$email', '$phone', '$password')";
		$result = sqlcmd($sql);

		unset($_SESSION["error"]);
		$_SESSION["userAccount"] = $name;
		$_SESSION["email"] = $email;
		$_SESSION["phone"] = $phone;
		$_SESSION["password"] = $password;		
		sleep(1);
		header('Location:index.php'); //回index.php
	}

?>