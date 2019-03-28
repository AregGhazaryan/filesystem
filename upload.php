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
          $explode = explode(".", $fileName);
          $extension = end($explode);
          $fileactualname = reset($explode);
          $i = 0;
          $fn = $fileName;
          while (file_exists("uploads/".$fn)) {
              $i++;
              $fn = $i."_".$fileName;
          }
          $name = $fn;
          $moveResult = move_uploaded_file($fileTmpLoc, "uploads/". $name);
            if ($moveResult != true) {
                @unlink($fileTmpLoc);
                header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=uploaderror');
            }
            header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=success');
        } else {
            if (!is_dir("uploads/".$location)) {
                header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=FDE');
            }
            $explode = explode(".", $fileName);
            $extension = end($explode);
            $fileactualname = reset($explode);

            $i = 0;
            $fn = $fileName;

            while (file_exists($location.$fn)) {
                $i++;
                // add number to actual filename
                $fn = $i."_".$fileName;
            }

            $name = $fn;
            $moveResult = move_uploaded_file($fileTmpLoc, $location . "/". $name);
            if ($moveResult != true) {
                @unlink($fileTmpLoc);
                header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=uploaderror');
                exit();
            }
            header('location: ' . URL . '?page=0&sort=name&type=desc&folder='.$location.'/&message=success');
            exit();
        }
    }
} else {
    header('location: ' . URL . '?page=0&sort=name&type=desc&folder=uploads/&message=UAC');
}
