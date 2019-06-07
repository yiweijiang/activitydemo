<?php include 'sqlcmd.php';?>
<?php
	$value = $_REQUEST["value"];

	session_start();

	$temp["filter_title"] = array(0=>$value);
	if (isset($_SESSION["filter_title"])){
		$temp["filter_title"] = $_SESSION["filter_title"];
	}



	if ($temp["filter_title"] != array(0=>$value)) {

	//if ($_SESSION["filter_title"]) {
	//if (isset($_SESSION["filter_title"])) {

		$index = max(array_keys($temp["filter_title"])) + 1;
		if (in_array($value, $temp["filter_title"])){
			unset($temp["filter_title"][array_search($value, $temp["filter_title"])]);
		}else{
			$temp["filter_title"][$index] = $value;
		}
	}else{
		$temp["filter_title"] = array(0=>$value);
	}

	$_SESSION["filter_title"] = $temp["filter_title"];

	if ($value=='全部') {
		/*if (in_array('全部', $_SESSION["filter_title"])) {
			//unset($_SESSION["filter_title"]);
			$_SESSION["filter_title"] = array(0=>$value);
		}*/
		$_SESSION["filter_title"] = array(0=>$value);


	}
	
	$text = '';
	foreach ($_SESSION["filter_title"] as $key) {
		if ($text!='') {
			$text = $text . '  a_type=\'' . $key . '\'';
		}else{
			$text = ' WHERE a_type=\'' . $key . '\'';
		}
	}
	
	$text = explode('  ', $text);
	$text = implode(" or ", $text);

	$sql = "SELECT * FROM activity" . $text;
	$result = sqlcmd($sql);

	foreach ($result as $row) {
		echo 
		   '<div class="w3-container w3-col s3">
				<div class="card " onclick=content(' . $row['a_id'] . ')>
					<div class="divimg ">
						<img src="https://imgur.dcard.tw/O74D0mZ.jpg">
					</div>
					<div class="container">
						<h4><b>' . $row['a_name'] . '</b></h4> 
						<p>活動日期：' . $row['a_date'] . '</p> 
						<p>活動時間：' . $row['a_date'] . '</p> 
						<p>活動類別：' . $row['a_type'] . '</p>
						<p>集合地點：' . $row['a_position'] . '</p>
						<br>
					</div>
					<button onclick="join_activity(' . $row['a_id'] . ')">我要參加</button>
					<button onclick="detail_activity(' . $row['a_id'] . ')">了解詳情</button>
				</div>
			</div>';
    }
?>