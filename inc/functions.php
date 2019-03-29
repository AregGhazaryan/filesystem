<?php
//sorting functions
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
//function to create pagination links
function CreatePageName(){
  if ($_GET['sort']==="date" && $_GET['type']==="desc") {
    echo "?sort=date&type=desc";
  }elseif($_GET['sort']=="date" && $_GET['type']=="asc"){
    echo "?sort=date&type=asc";
  }elseif($_GET['sort']=="name" && $_GET['type']=="desc"){
    echo "?sort=name&type=desc";
  }elseif($_GET['sort']=="name" && $_GET['type']=="asc"){
    echo "?sort=name&type=asc";
  }elseif($_GET['sort']=="size" && $_GET['type']=="desc"){
    echo "?sort=size&type=desc";
  }elseif($_GET['sort']=="size" && $_GET['type']=="asc"){
    echo "?sort=size&type=asc";
  }elseif($_GET['sort']=="type" && $_GET['type']=="asc"){
    echo "?sort=type&type=asc";
  }elseif($_GET['sort']=="type" && $_GET['type']=="desc"){
    echo "?sort=type&type=desc";
  }
}
//Creating icons inside the table using switches and fontawesome
function CreateIcon($select){
  $select = explode(".",$select);
  $select = end($select);
  switch ($select) {
    case 'zip':
      echo '<i class="fas fa-file-archive"></i>';
    break;
    case 'bmp':
    case 'jpg':
    case 'jpeg':
    case 'gif':
    case 'png':
        echo '<i class="fas fa-file-image"></i>';
    break;
    case 'mp3':
    case 'wav':
    case 'flac':
        echo '<i class="fas fa-music"></i>';
    break;
    case 'wmv':
    case 'mp4':
    case 'avi':
        echo '<i class="fas fa-file-video"></i>';
    break;
    case 'php':
    case 'js':
    case 'html':
    case 'json':
    case 'doc':
    case 'txt':
    case 'sql':
        echo '<i class="fas fa-scroll"></i>';
    break;
    case 'exe':
        echo '<i class="fab fa-windows"></i>';
    break;
    default:
        echo '<i class="fas fa-file"></i>';
    break;
  }
}
