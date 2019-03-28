<?php
//checking if none of the methods are present and assigning them to url
if (!isset($_GET['page']) || !isset($_GET['sort']) || !isset($_GET['type']) || !isset($_GET['folder']) || $_GET['folder']==="/" || $_GET['folder']==="\\" || $_GET['folder']==="uploads") {
    header('location: ' . URL .'?page=0&sort=name&type=asc&folder=uploads/');
}
//Checking if core direcotry doesnt exists and creating it
if(!is_dir("uploads")){
  mkdir("uploads");
}

//function which checks if / is missing on folder get parameter and adding it
function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
}
if (isset($_GET['folder'])) {
  if (!endsWith($_GET['folder'], "/")) {
    $boom = explode("/", $_GET['folder']);
    $newurl = end($boom);
    header('location: ' . URL .$newurl.'/');
  }
}
//if directory was not found it redirects to main folder
if(isset($_GET['folder'])){
  if(!is_dir($_GET['folder'])){
    header('location: /?page=0&sort=name&type=asc&folder=uploads/');
  }
}
