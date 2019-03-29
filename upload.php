<?php
//upload procedure
require('inc/const.php');
if (isset($_POST['upload'])) {
    $fileName = $_FILES["file"]["name"];
    $fileTmpLoc = $_FILES["file"]["tmp_name"];
    $fileType = $_FILES["file"]["type"];
    $fileSize = $_FILES["file"]["size"];
    $fileErrorMsg = $_FILES["file"]["error"];
    $location = $_POST['subfolder'];
    if (!$fileTmpLoc) {
        header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=nofile');
    } elseif ($fileErrorMsg == 1) {
        header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=uploaderror');
    } elseif ($fileSize > 45000000) {
        @unlink($fileTmpLoc);
        header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=big');
    } else {
        //checking if subfolder directory exists
        if (empty($location) || !isset($location) || $location === "" || $location === "uploads/") {
          preg_match_all('/[A-Za-z0-1]*\.[a-zA-Z0-1]*/', $fileName, $matches);
          $ext = end($matches);
          $removed = array_pop($matches);
          array_pop($removed);
          $kek = implode($removed);
          $deez = end($ext);

          $i = 0;
          $fn = $fileName;
          if (count($removed)<=1) {
            $exp = explode(".",$fileName);
            $end = end($exp);
            while (file_exists("uploads/".$fn)) {
                $i++;
                $fn = reset($exp)."_".$i.".".$end;
            }
            $name = $fn;
            $moveResult = move_uploaded_file($fileTmpLoc, $location . "/". $name);
          }else{
            while (file_exists("uploads/".$fn)) {
              $i++;
              // add number to actual filename
              $fn = $kek."_".$i.$deez;
            }
            $name = $fn;
            $moveResult = move_uploaded_file($fileTmpLoc, "uploads/". $name);
          }
            if ($moveResult != true) {
                @unlink($fileTmpLoc);
                header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=uploaderror');
            }
            header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=success');
        } else {
            if (!is_dir("uploads/".$location)) {
                header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=FDE');
            }
            preg_match_all('/[A-Za-z0-1]*\.[a-zA-Z0-1]*/', $fileName, $matches);
            $ext = end($matches);
            $removed = array_pop($matches);
            array_pop($removed);
            $kek = implode($removed);
            $deez = end($ext);

            $i = 0;
            $fn = $fileName;
            if (count($removed)<=1) {
              $exp = explode(".",$fileName);
              $end = end($exp);
              while (file_exists($location.$fn)) {
                  $i++;
                  $fn = reset($exp)."_".$i.".".$end;
              }
              $name = $fn;
              $moveResult = move_uploaded_file($fileTmpLoc, $location . "/". $name);
            }else{
              while (file_exists($location.$fn)) {
                $i++;
                // add number to actual filename
                $fn = $kek."_".$i.$deez;
              }
              $name = $fn;
              $moveResult = move_uploaded_file($fileTmpLoc, $location . "/". $name);
            }
            if ($moveResult != true) {
                @unlink($fileTmpLoc);
                header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=uploaderror');
                exit();
            }
            header('location: ' . URL . '?page=0&sort=name&type=desc&folder='.$location.'&message=success');
            exit();
        }
    }
} else {
    header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=UAC');
}
