<?php 
	session_start();
	function alert($msg) {
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}
	$temp = '';
	if (isset($_SESSION["userAccount"])) {
		$temp = $_SESSION["userAccount"];
	}

	if(isset($_SESSION["error"])) {
		alert($_SESSION["error"]);
		$_SESSION["userAccount"] = "";
		$temp = "";
		session_destroy();
		echo "<script type='text/javascript'>";
		echo "window.location.href='index.php'";
		echo "</script>";
	}else{
		if(isset($_SESSION["password"])){
			//alert('歡迎'.$_SESSION["userAccount"].'登入');
			unset($_SESSION["password"]);
		}
	}
	if (isset($_SESSION["create_act"])) {
			header("refresh:0");
			alert('成功建立活動');
			unset($_SESSION["create_act"]);
	}
?>	
<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
	<title>index</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
	<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/148866/reset.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/sidebar.css">
	<style type="text/css">
		
	</style>

</head>
<body>
	<?php include_once 'navbar.php';?>

	<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:block" id="mySidebar">
		<button class="w3-bar-item w3-button w3-large"
		onclick="w3_close()">Close &times;</button>
		<br>
		<br>
		<a href="#" class="w3-bar-item w3-button">歡迎! <?php echo $temp; ?></a>
		<a href="logout.php" class="w3-bar-item w3-button">登出</a>
		<p>_______________________</p>
		<a href="index.php" class="w3-bar-item w3-button">最新活動</a>
		<a href="index.php" class="w3-bar-item w3-button">熱門活動</a>
		<a href="calendar.php" class="w3-bar-item w3-button">我的活動</a>
		<br>
		<a href="form.php" class="w3-bar-item w3-button">舉辦活動</a>
	</div>

	<button id="openNav" class="w3-button w3-light-grey w3-xlarge" style="display:none" onclick="w3_open()">&#9776;</button>

	<div class="main w3-row-padding" id="main">
		<button onclick="myFunction('Demo1')" class="w3-button w3-block w3-grey w3-left-align">
		篩選</button>
		<div id="Demo1" class="w3-hide w3-border">
			<div class="w3-bar w3-border w3-light-grey" id="act_filter">
				<a href="#" class="w3-bar-item w3-button w3-border-right" id="全部" onclick="test('全部',10)">全部</a>
				<a href="#" class="w3-bar-item w3-button w3-border-right" id="旅遊玩樂" onclick="test('旅遊玩樂',0)">旅遊玩樂</a>
				<a href="#" class="w3-bar-item w3-button w3-border-right" id="體驗活動" onclick="test('體驗活動',1)">體驗活動</a>
				<a href="#" class="w3-bar-item w3-button w3-border-right" id="美食" onclick="test('美食',2)">美食</a>
				<a href="#" class="w3-bar-item w3-button w3-border-right" id="攝影" onclick="test('攝影',3)">攝影</a>
				<a href="#" class="w3-bar-item w3-button w3-border-right" id="課程講座" onclick="test('課程講座',4)">課程講座</a>
				<a href="#" class="w3-bar-item w3-button w3-border-right" id="競賽" onclick="test('競賽',5)">競賽</a>
				<a href="#" class="w3-bar-item w3-button w3-border-right" id="路跑" onclick="test('路跑',6)">路跑</a>
				<a href="#" class="w3-bar-item w3-button w3-border-right" id="登山健行" onclick="test('登山健行',7)">登山健行</a>
				<a href="#" class="w3-bar-item w3-button w3-border-right" id="志工相關" onclick="test('志工相關',8)">志工相關</a>
				<a href="#" class="w3-bar-item w3-button w3-border-right" id="其他" onclick="test('其他',9)">其他</a>
			</div>
		</div>
		<br>
		<br>

		<div id="demo"></div>
		<div id="total">
		<?php
			include 'sqlcmd.php';
			$sql = "SELECT * FROM activity";
			$result = sqlcmd($sql);
			foreach($result as $row) {
				echo '
				<div class="w3-container w3-col s3">
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
		</div>
	</div>

	<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()">Close &times;</button>
  <a href="#" class="w3-bar-item w3-button">Link 1</a>
  <a href="#" class="w3-bar-item w3-button">Link 2</a>
  <a href="#" class="w3-bar-item w3-button">Link 3</a>
</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/index.js"></script>

</body>

</html>

<script type="text/javascript">
	var check = [0,0,0,0,0,0,0,0,0,0,0];

	window.onload=function (){
		console.log('');
		<?php
			//session_start();
			unset($_SESSION["filter_title"]);
		?>
	}

	function test(str,id) {
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {

	    if (this.readyState == 4 && this.status == 200) {
			document.getElementById("demo").innerHTML = this.responseText;
			//console.log(check);
			if (check[id]==0) {
				if (id==10) {
					$('#total').show();
					$('#demo').hide();
					$('#act_filter > a').css("background", "#f1f1f1");
					$('#'+str).css("background", "#DDD");
					check = [0,0,0,0,0,0,0,0,0,0,1];

				}else{
					$('#total').hide();
					$('#demo').show();
					$('#'+str).css("background", "#DDD");
					$('#全部').css("background", "#f1f1f1");
					check[10] = 0;
					check[id] = check[id] + 1;					
				}

			}else{
				if (id==10) {
					$('#total').hide();
					$('#demo').show();
					$('#'+str).css("background", "#f1f1f1");
					check[id] = check[id] - 1;
				}else{
					$('#'+str).css("background", "#f1f1f1");
					check[id] = check[id] - 1;					
					
				}
			}
	    }
	  };
	  xhttp.open("GET", "filterdata.php?value=" + str, true);
	  xhttp.send();
	}

	function join_activity(str){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if (confirm("確定要參加活動?")){
					alert(this.responseText);
				}
			}
		};
		xhttp.open("GET", "joinactivity.php?id=" + str, true);
	  	xhttp.send();	
	}

	function detail_activity(str){
		window.location.href='msg.php?id=' + str;
	}

	function myFunction(id) {
		var x = document.getElementById(id);
		if (x.className.indexOf("w3-show") == -1) {
			x.className += " w3-show";
		} else { 
			x.className = x.className.replace(" w3-show", "");
		}
	}
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
