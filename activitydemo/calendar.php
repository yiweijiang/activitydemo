<?php include 'sqlcmd.php';
	session_start();

	if (!$_SESSION["email"]) {
      $_SESSION["error"] = '請先登入';
      echo "<script type='text/javascript'>";
      echo "window.location.href='index.php'";
      echo "</script>"; 
    }

	$a_email = $_SESSION["email"];
	$sql = "SELECT a_id FROM join_activity WHERE j_email='$a_email'"; 
	$result = sqlcmd($sql);
	$data = array();
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()) {
			$sql = "SELECT * FROM activity WHERE a_id=" . $row['a_id']; 
			$r = sqlcmd($sql)->fetch_assoc();
			switch ($r['a_type']) {
				case "旅遊玩樂":
			        $color = "Tomato";
			        break;
			    case "體驗活動":
			        $color = "Orange";
			        break;
			    case "美食":
			        $color = "DodgerBlue";
			        break;
			    case "攝影":
			        $color = "MediumSeaGreen";
			        break;
			    case "課程講座":
			        $color = "Gray";
			        break;
			    case "競賽":
			        $color = "SlateBlue";
			        break;
			    case "路跑":
			        $color = "Violet";
			        break;
			    case "登山健行":
			        $color = "LightGray";
			        break;
			    case "志工相關":
			        $color = "red";
			        break;
			    default:
			        $color = "lightblue";
			}

		    $data[] = array(
		    	"color"=>$color,
		    	"title"=>$r["a_name"],
		    	"start"=>$r["a_date"],
		    	"time"=>$r["a_time"],
		    	#"url"=>"http://google.com/",
		    	"url"=>"msg.php?id=" . $r["a_id"],
		    	"content"=>$r["a_content"]
		    );
	    }
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- jQuery v1.9.1 -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
	<!-- Moment.js v2.20.0 -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.0/moment.min.js"></script>
	<!-- FullCalendar v3.8.1 -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.1/fullcalendar.min.css" rel="stylesheet"  />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.1/fullcalendar.print.css" rel="stylesheet" media="print">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.1/fullcalendar.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


	<meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
	<title>我的活動</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
	<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/148866/reset.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/sidebar.css">


	<style type="text/css">
		#calendar{
			width: 85%;
			margin:0px auto;
			font-size: large;
		}
	</style>

</head>
<body>
	<? include_once 'navbar.php';?>

	<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:block" id="mySidebar">
		<button class="w3-bar-item w3-button w3-large"
		onclick="w3_close()">Close &times;</button>
		<br>
		<br>
		<a href="#" class="w3-bar-item w3-button">歡迎! <?php echo $_SESSION["userAccount"]; ?></a>
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
		<div id="calendar"></div>
	</div>
  	<script type="text/javascript">

  		var utc = new Date().toJSON().slice(0,10).replace(/-/g,'-');
  		var tempArray = <?php echo json_encode($data,JSON_UNESCAPED_UNICODE); ?>;
  		console.log(utc);
	  	$("#calendar").fullCalendar({
	  		// 參數設定[註1]
	  		header: { // 頂部排版
	  			left: "prev,next today", // 左邊放置上一頁、下一頁和今天
	  			center: "title", // 中間放置標題
	  			right: "month,listMonth" // 右邊放置月、周、天
	  		},
	  		defaultDate: utc,//"2018-12-12", // 起始日期
	  		weekends: true, // 顯示星期六跟星期日
		    eventRender: function(eventObj, $el) {
		      $el.popover({
		        title: '時間 : '+eventObj.time,
		        content: '內容：'+eventObj.content,
		        trigger: 'hover',
		        placement: 'right',
		        container: 'body'
		      });
		    },
	  		//editable: true,  // 啟動拖曳調整日期
	  		events: tempArray,
	  		height: 820
	  	});

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
 	<br>
</body>