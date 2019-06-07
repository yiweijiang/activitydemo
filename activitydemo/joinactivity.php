<?php include 'sqlcmd.php';?>
<?php
	session_start();
	$m_email = "";
	if (isset($_SESSION["email"])) {
		$m_email = $_SESSION["email"];
	}

	$id = $_REQUEST["id"];

	$sql = "SELECT * FROM join_activity WHERE j_email='$m_email' and a_id='$id'";
	$result = sqlcmd($sql);
	if (!isset($_SESSION["email"])) {
		echo '請先登入';
	}else{
		if ($result->num_rows>0) {
			echo '你已經參加這項活動';
		}else{
			$sql ="INSERT INTO join_activity (j_id, a_id, j_email) VALUES (NULL, '$id', '$m_email')";
			$result = sqlcmd($sql);
			echo "已成功加入";
		}
	}
?>