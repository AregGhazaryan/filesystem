<?php
if(isset($_POST['del'])){
  if($_POST['del']==""){
    header("location: /?message=UAC");
  }else{
    $filename= $_POST['del'];
    unlink("uploads/".$filename);
    header("location: /?message=deleted");
  }
}
if(isset($_POST['rename'])){
  if(isset($_POST['newname'])){
    if($_POST['newname']===""){
      header("location: /?message=noname");
    }else{
      $newname= $_POST['newname'];
      $oldname = $_POST['oldname'];
      $ext = explode(".", $oldname);
      $fileExt = end($ext);
      $dir = 'uploads/';
      $fullname = $dir . $newname .".". $fileExt;
      $oldname = $dir . $oldname;
      if(file_exists($fullname)){
        header("location: /?message=renex");
      }else{
        rename($oldname, $fullname);
        header("location: /?message=rename");
      }
    }
  }
}
if (isset($_POST['delbulk'])) {
  if(isset($_POST['checkb'])){
    $data = $_POST['checkb'];
    foreach($data as $selected){
      unlink("compressed/".$selected);
      header("location: /?page=0");
  }
}else{
  echo "No images were selected <br><a href='/?page=0'>Back</a>";
}
}
