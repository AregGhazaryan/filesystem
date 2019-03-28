<?php
// delete functionality
require('inc/const.php');
if (isset($_POST['del'])) {
  if(is_dir('uploads/'.$_POST['del'])){
    function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }
        if (!is_dir($dir)) {
            return unlink($dir);
        }
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }
        return rmdir($dir);
    }
    deleteDirectory('uploads/'.$_POST['del']);
    header('location: ' . URL . '?page=0&sort=name&type=desc&message=folderdelete&folder='.$_POST['location']);
  }else{
    if ($_POST['del']==="") {
      header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=UAC');
    } else {
      $filename= $_POST['del'];
      unlink("uploads/".$filename);
      header('location: ' . URL . '?page=0&sort=name&type=desc&message=deleted&folder='.$_POST['location']);
    }
  }
}
//rename functionality
if (isset($_POST['rename'])) {
    if (isset($_POST['newname'])) {
      $newname= $_POST['newname'];
      $oldname = $_POST['oldname'];
      $dir = 'uploads/';
      $remove[] = "'";
      $remove[] = '"';
      $remove[] = "-";
      $remove[] = ".";
      $sanitize = str_replace($remove, "", $newname);
        if ($_POST['newname']==="") {
            header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=noname');
        }
        if(is_dir('uploads/'.$oldname)){
          $boom = explode("/",$oldname);
          if(count($boom)>1){
            $picker = array_slice($boom, 0, -1);
            $string = implode("/", $picker);
            rename($dir.$oldname, $dir.$string.'/'.$sanitize);
            header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=folderrename');
          }else{
            rename($dir.$oldname, $dir.$sanitize);
            header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=folderrename');
          }
        } else {
            $ext = explode(".", $oldname);
            $fileExt = end($ext);
            $fullname = $dir . $sanitize .".". $fileExt;
            $oldname = $dir . $oldname;
            if (file_exists($fullname)) {
                header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=renex');
            } elseif (empty($sanitize)) {
                header('location: ' . URL . '??page=0&sort=name&type=desc&folder=uploads/&message=invalid');
            } elseif (strlen($sanitize)>50) {
                header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=long');
            } else {
                rename($oldname, $fullname);
                header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=rename');
            }
        }
    }
}
//New folder functionality
if(isset($_POST['newfolder'])){
  $foldername = $_POST['foldername'];
  if(empty($foldername) || $foldername===""){
    header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=foldernoname');
  }elseif(strlen($foldername)>20){
    header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=foldertoolong');
  }elseif(is_dir($_POST['folder'].$_POST['foldername'])){
header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=foldernamex');
}else{
    $remove[] = "'";
    $remove[] = '"';
    $remove[] = "-";
    $remove[] = "/";
    $remove[] = "\\";
    $remove[] = ".";
      $spot = $_POST['folder'];
      $sanitize = str_replace($remove, "", $foldername);
      if(empty($sanitize)|| $sanitize===""){
        header('location: ' . URL . '?page=0&sort=name&type=desc&folder='.$spot.'&message=folderwrong');
      }else{
        mkdir($spot."//".$sanitize);
        header('location: ' . URL . '?page=0&sort=name&type=desc&folder='.$spot.'&message=folder');
      }
  }
}
