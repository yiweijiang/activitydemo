<?php include 'sqlcmd.php';?>
<?php 
	session_start();
	$email=$_POST['Login_email'];//post獲取表單裡的name
	$password=$_POST['Login_password'];//post獲取表單裡的email
    
	$sql = "SELECT * FROM member WHERE mEmail='$email' and mPassword='$password'";
	$result = sqlcmd($sql);

	if ($result->num_rows<=0) {
		$_SESSION["error"] = '帳號或密碼錯誤';
		header('Location:index.php');
	}else{
		unset($_SESSION["error"]);
		$_SESSION["userAccount"] = $result->fetch_assoc()['mName'];
		$_SESSION["email"] = $email;
		$_SESSION["phone"] = $result->fetch_assoc()['mPhone'];
		$_SESSION["password"] = $password;		

		sleep(1);
		header('Location:index.php'); //回index.php
	}

?>