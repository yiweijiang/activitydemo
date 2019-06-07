<?php include 'sqlcmd.php';?>

<?php
	session_start();
	$a_name = $_POST[activity_name];
	$a_type = $_POST[activity_type];
	$a_date = $_POST[activity_date];
	$a_time = $_POST[activity_time];
	$a_side = $_POST[activity_side];
	$a_position = $_POST[activity_position];
	$a_email = $_SESSION["email"];
	$a_content = $_POST[content];
	$_SESSION["create_act"] = True;

	$sql = "INSERT INTO activity (a_id, a_name, a_type, a_date, a_time, a_side, a_position, a_email, a_content) VALUES (NULL, '$a_name', '$a_type', '$a_date', '$a_time', '$a_side', '$a_position', '$a_email', '$a_content')";
	$result = sqlcmd($sql);


	$sql = "SELECT a_id from activity ORDER BY a_id DESC LIMIT 1";
	$a_id = sqlcmd($sql)->fetch_assoc()['a_id'];

	$sql ="INSERT INTO join_activity (j_id, a_id, j_email) VALUES (NULL, '$a_id', '$a_email')";
	$result = sqlcmd($sql);

    header('Location:index.php');
?>