<?php
	session_start();
	if (isset($_SESSION["email"])) {
		$_SESSION["error"] = '已成功登出';
	}else{
		$_SESSION["error"] = '你沒有登入';
	}
	header('Location:index.php');
?>