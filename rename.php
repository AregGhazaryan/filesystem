<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Rename File</title>
    <script
			  src="http://code.jquery.com/jquery-3.3.1.js"
			  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
			  crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </head>
  <body>
<?php
if (isset($_GET['name'])) {
  if($_GET['name']==''){
    header('location: /');
  }else{
    echo '<form action="main.php" method="POST"><div class="card">
    <input name="oldname" type="hidden" value="'.$_GET['name'].'">
    <input class="form-control" type="text" placeholder="'.$_GET['name'].'" readonly>
    <div class="card-body">
      <input type="text" class="form-control" name="newname" placeholder="Type new name here">
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
