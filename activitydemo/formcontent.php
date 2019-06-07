<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="add_activity.css">
  
</head><body>
  <?php 
    //session_start();
    if (!$_SESSION["email"]) {
      $_SESSION["error"] = '請先登入';
      echo "<script type='text/javascript'>";
      echo "window.location.href='index.php'";
      echo "</script>"; 
    }
  ?>


  <div class="container">
    <div class="activity_create">
    <form action="getformdata.php" method="post">
      <div class="form-group">
        <label for="inputlg">活動名稱</label>
        <input class="form-control input-lg" id="activity_name" name="activity_name" type="text">
      </div>
      <div class="form-group">
        <label for="sel1">活動類別</label>
        <select class="form-control input-lg" id="activity_type" name="activity_type">
          <option>旅遊玩樂</option>
          <option>體驗活動</option>
          <option>美食</option>
          <option>攝影</option>
          <option>課程講座</option>
          <option>競賽</option>
          <option>路跑</option>
          <option>登山健行</option>
          <option>志工相關</option>
          <option>其他</option>
        </select>
      </div>
      <div class="form-group">
        <label for="inputlg">活動日期</label>
        <input class="form-control input-lg" id="activity_date" name="activity_date" type="date" required="required">
      </div>
      <div class="form-group">
        <label for="inputlg">活動時間</label>
        <input class="form-control input-lg" id="activity_time" name="activity_time" type="time" required="required">
      </div>
      <div class="form-group">
        <label for="sel1">活動地區</label>
        <select class="form-control input-lg" id="activity_side" name="activity_side">
          <option>北部</option>
          <option>中部</option>
          <option>南部</option>
          <option>東部</option>
        </select>
      </div>
      <div class="form-group">
        <label for="inputlg">活動地點</label>
        <input class="form-control input-lg" id="activity_position" name="activity_position" type="text">
      </div>
      <div class="form-group">
        <label for="sel1">備註</label><br>
        <textarea class="form-control input-lg" name="content" id="content" cols="65" rows="5"></textarea>
      </div>
 
      <script>
          function check(){
            console.log("<?php echo $_SESSION["userAccount"] ?>");
          }
      </script>

      <button type="submit" onClick="check()" class="btn btn-info btn-lg">送出</button>
    </form>
  </div>
</div>
</body></html>