<?php

	include 'sqlcmd.php';
	session_start();

	$msg = $_POST[msg];
	$a_id = $_SESSION[id];
	$email = $_SESSION[email];

	//設定日期格式
	$date=date("Y-m-d");

	$sql="INSERT INTO message (msg_id, guest_email, content, date, a_id) VALUES(NULL, '$email','$msg','$date', '$a_id')";
	//對應 msg.php 新增留言區的 POST表單

	$result = sqlcmd($sql);

	//新增完畢轉回留言板
	header('Location: msg.php?id=' . $a_id);
?>