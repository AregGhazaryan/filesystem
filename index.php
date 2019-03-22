<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>File Upload</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <style>
    .navbar{
      box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important;
    }
    .alert{
      transition: 0.25s;
      box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important;
    }
    #customFile, .custom-file-label{
      width:300px;
      float:left;
      text-align: left;
    }
    .nav-form-btn{
      margin-left: 20px;
      transition: 0.25s;
    }
    .btn{
      width:100px;
      float:left;
      margin-left:20px;
    }
    .actions{
      width:20%;
    }
    .nav-form form{
      float:left;
    }
    .selector{

    }
    .selector select{
      margin-left:20px;
      display:block;
    }
    table tr{
      transition: 0.1s;
    }
    table tr:hover {
      transition: 0.15s;
      box-shadow: 0 .5rem 1rem rgba(0,0,0,.15) !important;
    }
    .btn{
      transition:0.25s;
    }
    .btn:hover{
      transition:0.25s;
    }
    .btn{
      border:none;
    }
    .btn-success{
      transition:0.25s;
    }
    .btn-success:hover{
      background-color: rgb(4, 222, 0);
      transition:0.25s;
    }
    .btn-danger{
      transition:0.25s;
      background-color:rgb(228, 0, 48);
    }
    .btn-danger:hover{
      transition:0.25s;
      background-color:rgb(255, 0, 54);
    }
    .btn-info{
      transition:0.25s;
      background-color:rgb(0, 155, 213);
    }
    .btn-info:hover{
      transition:0.25s;
      background-color:rgb(0, 186, 255);
    }
    .navbar input{
      height:38px;
    }
    </style>
  </head>
  <body>

    <div class="navbar navbar-light bg-light">
      <div class="nav-form">
        <form class="form-inline" enctype="multipart/form-data" action="upload.php" method="post">
          <div class="custom-file form-inline">
            <input type="file" class="custom-file-input" name="file" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
            <input class="nav-form-btn btn btn-success my-2 my-sm-0" type="submit" name="upload" value="Upload">
          </div>
        </form>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
          <div class="selector form-group row">
            <div class="col">
              <select name="sort" class="form-control">
                <option <?php if(isset($_GET['sort'])){if($_GET['sort']=="name"){echo "selected ";}}?>value="name">Name</option>
                <option <?php if(isset($_GET['sort'])){if($_GET['sort']=="size"){echo "selected ";}}?>value="size">Size</option>
                <option <?php if(isset($_GET['sort'])){if($_GET['sort']=="type"){echo "selected ";}}?>value="type">Type</option>
                <option <?php if(isset($_GET['sort'])){if($_GET['sort']=="date"){echo "selected ";}}?>value="date">Date</option>
              </select>
            </div>
<div class="col">
  <select name="type" class="form-control">
    <option <?php if(isset($_GET['sort'])){if($_GET['type']=="asc"){echo "selected ";}}?> value="asc">ASC</option>
    <option <?php if(isset($_GET['sort'])){if($_GET['type']=="desc"){echo "selected ";}}?>value="desc">DSC</option>
  </select>
</div>
  <button class="nav-form-btn btn btn-info my-2 my-sm-0" type="submit">Sort</button>
            </div>
        </form>
      </div>
      </div>
<?php
if (isset($_GET['message'])) {
  switch ($_GET['message']) {
    case "nofile":
      echo '<div class="alert alert-danger" role="alert">You haven\'t selected any file!</div>';
      break;
      case "uploaderror":
        echo '<div class="alert alert-danger" role="alert">There was an error while uploading your file, please try again later!</div>';
        break;
        case "big":
          echo '<div class="alert alert-danger" role="alert">Your uploaded file extends 45MB!</div>';
          break;
          case "success":
            echo '<div class="alert alert-success" role="alert">Your file has been successfuly uploaded!</div>';
            break;
            case "renex":
              echo '<div class="alert alert-warning" role="alert">Your file haven\'t been renamed, file name already exists!</div>';
              break;
              case "UAC":
                echo '<div class="alert alert-danger" role="alert">Unauthorized Access!</div>';
                break;
                case "noname":
                  echo '<div class="alert alert-danger" role="alert">You haven\'t typed any name!</div>';
                  break;
                  case "rename":
                    echo '<div class="alert alert-success" role="alert">Rename Successful!</div>';
                    break;
                    case "deleted":
                      echo '<div class="alert alert-info" role="alert">File Deleted!</div>';
                      break;
  }
}
 ?>
 <table class="table text-center">
   <thead>
   <tr>
     <th scope="col">#</th>
     <th scope="col">File Name</th>
     <th scope="col">Size</th>
     <th scope="col">Date Created</th>
     <th scope="col">Type</th>
     <th scope="col">Actions</th>
   </tr>
 </thead>
 <?php

 if(isset($_GET['sort'])){

   $dir="uploads/";
 function LoadFiles($dir) {
 $Files = array();
 $handler =  opendir($dir);
 if (!$handler)
   die('Cannot list files for ' . $dir);
   while ($Filename = readdir($handler)) {
     if ($Filename == '.' || $Filename == '..')
     continue;

     $LastModified = filemtime($dir . $Filename);
     $filesize = filesize($dir.$Filename);
     $filextension = explode(".",$Filename);
     $filetp = end($filextension);
     $Files[] = array($dir . $Filename, $LastModified, $filesize, $filetp);
   }

 return $Files;
 }

 function DateCmp($a, $b) {
 return ($a[1] < $b[1]) ? -1 : 0;
 }

 function SortByDate(&$Files) {
 usort($Files, function($a, $b) {
 return $a['1'] <=> $b['1'];
 });
 }

 function SortByDateAsc(&$Files) {
 usort($Files, function($a, $b) {
 return $a['1'] <= $b['1'];
 });
 }

 function SortByNameDsc(&$Files) {
 usort($Files, function($a, $b) {
 return $a['0'] <= $b['0'];
 });
 }

 function SortByNameAsc(&$Files) {
 usort($Files, function($a, $b) {
 return $a['0'] <=> $b['0'];
 });
 }

 function SortBySizeDsc(&$Files) {
 usort($Files, function($a, $b) {
 return $a['2'] <= $b['2'];
 });
 }

 function SortBySizeAsc(&$Files) {
 usort($Files, function($a, $b) {
 return $a['2'] <=> $b['2'];
 });
 }

 function SortByTypeAsc(&$Files) {
 usort($Files, function($a, $b) {
 return $a['3'] <= $b['3'];
 });
 }

 function SortByTypeDsc(&$Files) {
 usort($Files, function($a, $b) {
 return $a['3'] <=> $b['3'];
 });
 }

 $Files = LoadFiles('uploads/');
 if ($_GET['sort']==="date" && $_GET['type']==="desc") {
   SortByDate($Files);
 }elseif($_GET['sort']=="date" && $_GET['type']=="asc"){
   SortByDateAsc($Files);
 }elseif($_GET['sort']=="name" && $_GET['type']=="desc"){
   SortByNameDsc($Files);
 }elseif($_GET['sort']=="name" && $_GET['type']=="asc"){
   SortByNameAsc($Files);
 }elseif($_GET['sort']=="size" && $_GET['type']=="desc"){
   SortBySizeDsc($Files);
 }elseif($_GET['sort']=="size" && $_GET['type']=="asc"){
   SortBySizeAsc($Files);
 }elseif($_GET['sort']=="type" && $_GET['type']=="asc"){
   SortByTypeAsc($Files);
 }elseif($_GET['sort']=="type" && $_GET['type']=="desc"){
   SortByTypeDsc($Files);
 }
 $count = 1;
 foreach($Files as $source):?>
 <tr>
   <td><?php echo $count; ?></td>
   <td><a href="<?php $count++; echo $source[0] ?>" /><?php echo substr($source[0], 8); ?></a></td>
   <td>
   <?php
           $path = $source[0];
           $size = filesize($path);
           $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
           $power = $size > 0 ? floor(log($size, 1024)) : 0;
           echo number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power]; ?></td>
           <td><?php echo date("F d Y H:i:s",filemtime($source[0]));?></td>
           <td><?php  $ext = explode(".",$source[0]); echo end($ext);?></td>
           <td class="actions"><?php echo '<a class="btn btn-success" href="rename.php?name='.substr($source[0], 8).'">Rename</a><form action="main.php" method="POST"> <button class="btn btn-danger" type="submit" name="del" value="'.substr($source[0], 8).'">Delete</button></form>';?></td>
 </tr>

<?php endforeach;
}?>
    <?php if(!isset($_GET['sort'])):
      $files = scandir('uploads');
    $files = array_diff($files, array('.', '..'));
    $count = 0;
    foreach($files as $file): ?>
    <?php $count++; ?>
    <tr>
        <td><?php echo $count;?></td><td><a href="uploads/<?php echo $file; ?>"><?php echo $file; ?></td>
        <td>
<?php
        $path = 'uploads/'.$file;
        $size = filesize($path);
        $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        echo number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power]; ?></td>
        <td><?php echo date("F d Y H:i:s",filemtime("uploads/".$file));?></td>
        <td><?php  $ext = explode(".",$file); echo end($ext);?></td>
        <td class="actions"><?php echo '<a class="btn btn-success" href="rename.php?name='.$file.'">Rename</a><form action="main.php" method="POST"> <button class="btn btn-danger" type="submit" name="del" value="'.$file.'">Delete</button></form>';?></td>
    </tr>
    <?php endforeach;

endif;
    ?>

    <script>
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>
  </table>
  </body>
</html>
