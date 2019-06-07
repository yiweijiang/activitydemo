<?php include 'sqlcmd.php';

	header("Content-Type:text/html; charset=utf-8");
	session_start();

	$a_id = $_REQUEST["id"];
	$_SESSION["id"] = $a_id;

	$sql = "SELECT * FROM activity WHERE a_id=" . $a_id;
	$act_result = sqlcmd($sql)->fetch_assoc();

	if (!$_SESSION["email"]) {
      $_SESSION["error"] = '請先登入';
      echo "<script type='text/javascript'>";
      echo "window.location.href='index.php'";
      echo "</script>"; 
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>活動留言板</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/sidebar.css">
</head>
<body>

	<? include_once 'navbar.php';?>

	<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:block" id="mySidebar">
		<button class="w3-bar-item w3-button w3-large"
		onclick="w3_close()">Close &times;</button>
		<br>
		<br>
		<a href="#" class="w3-bar-item w3-button">歡迎!<?php echo $_SESSION["userAccount"]; ?></a>
		<a href="logout.php" class="w3-bar-item w3-button">登出</a>
		<p>_______________________</p>
		<a href="index.php" class="w3-bar-item w3-button">最新活動</a>
		<a href="index.php" class="w3-bar-item w3-button">熱門活動</a>
		<a href="calendar.php" class="w3-bar-item w3-button">我的活動</a>
		<br>
		<a href="form.php" class="w3-bar-item w3-button">舉辦活動</a>
	</div>

	<button id="openNav" class="w3-button w3-light-grey w3-xlarge" style="display:none" onclick="w3_open()">&#9776;</button>

	<div class="main w3-row-padding" style="text-align:center;"  id="main">
		<div class="w3-container" style="width:100%;">			
			<ul class="w3-ul w3-border">
				<h2>活動名稱 :<?php echo $act_result['a_name']; ?></h2>
				<li>日期 :<?php echo $act_result['a_date']; ?></li>
				<li>時間 :<?php echo $act_result['a_time']; ?></li>
				<li>區域 :<?php echo $act_result['a_side']; ?></li>
				<li>地點 :<?php echo $act_result['a_position']; ?></li>
				<li>內容:<?php echo $act_result['a_content']; ?></li>
			</ul>
		</div>

		<br><br><br><br>

		<div class="container" style="text-align: left; width: 80%;">
			<h3 class="text-center">會員留言板</h3>
			<hr>
			

			<?php 
				$sql = "SELECT * FROM message WHERE a_id=" . $a_id;
				$result = sqlcmd($sql);
				while($row = $result->fetch_assoc()) {

					$guest_email = $row['guest_email'];

					$s = "SELECT mName FROM member WHERE mEmail='$guest_email'";
					$username = sqlcmd($s);
					

					if ($username->num_rows>0) {
						$data = $username->fetch_assoc()['mName'];
						echo '
						<div class=\"panel panel-default\">
							<div class=\"panel-heading\">' . $data . '
								<span class=\"pull-right\"> | ' . $row['date'] .  '</span>
							</div>
								<div class=\"panel-body\">' . $row['content'] .  '</div>
								<p>_______________________________</p>
						</div>
						';						
					}


				}
			?>
			<hr>
			<p class="pull-right">以 <?php echo $_SESSION["userAccount"]; ?> 的身份留言</p>
			<h4>新增留言</h4>
			<form action="msg_add.php" method="post">
				<textarea name="msg" class="form-control"></textarea>
				<br>
				<input type="submit" name="submit" value="送出" class="btn btn-primary btn-sm pull-right">
			</form>
		</div>
</body>
<script type="text/javascript">
	function w3_open() {
		document.getElementById("main").style.marginLeft = "18%";
		document.getElementById("mySidebar").style.width = "18%";
		document.getElementById("mySidebar").style.display = "block";
		document.getElementById("openNav").style.display = 'none';
	}
	function w3_close() {
		document.getElementById("main").style.marginLeft = "0%";
		document.getElementById("mySidebar").style.display = "none";
		document.getElementById("openNav").style.display = "inline-block";
	}
</script>
</html>