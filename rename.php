<!-- rename view  -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Rename File</title>
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
<script src="js/bootstrap.min.js"></script>
  </head>
  <body>
<?php
require('inc/const.php');
if (isset($_GET['name'])) {
  if($_GET['name']==''){
    header('location: ' . URL);
  }else{
    echo '<form action="main.php" method="POST"><div class="card">
    <input name="oldname" type="hidden" value="'.$_GET['name'].'">
    <input class="form-control" type="text" placeholder="'.$_GET['name'].'" readonly>
    <div class="card-body">
      <input type="text" maxlength="50" class="form-control" name="newname" placeholder="Type new name here" required>
      <br>
      <input name="rename" type="submit" class="btn btn-success" class="btn btn-success" value="Submit">
    </div>
  </div>
    </form>';
  }
}
?>
  </body>
</html>
