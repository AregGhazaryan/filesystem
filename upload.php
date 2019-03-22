<?php
if (isset($_POST['upload'])) {
  $fileName = $_FILES["file"]["name"];
  $fileTmpLoc = $_FILES["file"]["tmp_name"];
  $fileType = $_FILES["file"]["type"];
  $fileSize = $_FILES["file"]["size"];
  $fileErrorMsg = $_FILES["file"]["error"];
  if (!$fileTmpLoc) {
    header('location: /?message=nofile');
  }else if ($fileErrorMsg == 1) {
      header ("location: /?message=uploaderror");
  }else if($fileSize > 45000000) {
      @unlink($fileTmpLoc);
      header ("location: /?message=big");
  }else{
    $explode = explode(".",$fileName);
    $extension = end($explode);
    $fileactualname = reset($explode);
    $name = $fileactualname . uniqid() . "." . $extension;
    $moveResult = move_uploaded_file($fileTmpLoc, "uploads/".$name);
    if ($moveResult != true) {
        @unlink($fileTmpLoc);
        header ("location: /?message=uploaderror");
    }
    header('location: /?message=success');
  }
}else{
  echo "Unauthorized Access";
}
