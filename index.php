<?php
//entire head tag, url constant and initialization include
include 'inc/head.php';
require('inc/const.php');
require('inc/initialize.php')
?>
  <body>
<!-- Folder creation modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Create A New Folder</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="modal-group" action="main.php" method="post">
        <div class="form-group">
          <label for="foldername">Folder Name</label>
          <small class="form-text text-muted">Only letters and numbers will be saved, some symbols will be filtered</small>
          <input class="form-control" name="foldername" type="text" maxlength="20" placeholder="Type folder name here" required>
        </div>
  <div class="form-group">
    <input type="hidden" name="folder" value="<?php echo $_GET['folder']?>">
</div>
      </div>
      <div class="modal-footer">
        <div class="buttons">
        <button type="button" class="btn btn-secondary modal-btn" data-dismiss="modal">Close</button>
        <button type="submit" class="btn-m-l btn btn-primary modal-btn" name="newfolder">Save changes</button>
      </div>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- End of folder creation modal -->
<!-- File Upload Modal -->
<div class="modal fade" id="uploadmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">New File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-inline" enctype="multipart/form-data" action="upload.php" method="post">
        <div class="form-group">
          <div class="custom-file form-inline">
            <label for="exampleFormControlSelect1">Optional : &nbsp</label>
            <input type="file" class="custom-file-input" name="file" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
          </div>
        </div>
        <div class="form-group upload-second">
        <label for="exampleFormControlSelect1">Optional : Type the name of the subfolder</label>
        <small class="form-text text-muted">Example. "folder/subfolder" without quotations. not case sensitive</small>
        <small class="form-text text-muted">Not typing any folder name will save the file on current folder thats opened</small>
      </div>
      <input type='text' name="subfolder" class="form-control" value="<?php echo $_GET['folder'];?>">
      </div>
      <div class="modal-footer">
        <div class="buttons">
            <button type="button" class="modal-btn btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="modal-btn btn-m-l btn btn-primary" type="submit" name="upload">Save changes</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End of File Upload Modal -->
<?php
  //Navigation and alert messages include
    include 'inc/navbar.php';
    include 'inc/messages.php';
?>
<!-- Back button -->
<?php
if ($_GET['folder'] != 'uploads/') {
    $folder = $_GET['folder'];
    $boom = explode("/", $folder);
    $ready= [];
    foreach ($boom as $piece => $value) {
        $value = trim($value);
        if (!empty($value)) {
            $ready[] = $value;
        }
    }
    $picker = array_slice($ready, 0, -1);
    $string = implode("/", $picker);
    echo '<div class="navbar navbar-light bg-light"><div class="directories row">
<a class="backbtn" href="?page=0&sort=name&type=asc&folder='.$string.'/"><i class="fas fa-arrow-circle-left"></i></a></div></div>';
}
?>
 <table class="table text-center">
   <thead>
   <tr>
     <th scope="col">#</th>
     <th scope="col">
<!-- Checking which sort method is used and assigning a link to an anchor tag, column onclick sorting functionality -->
       <a href="
<?php
if (isset($_GET['sort'])) {
    if ($_GET['sort']=='name' && $_GET['type']=='desc') {
        echo "?sort=name&type=asc&page=".$_GET['page']."&folder=".$_GET['folder'];
    } elseif ($_GET['sort']=='name' && $_GET['type']=='asc') {
        echo "?sort=name&type=desc&page=".$_GET['page']."&folder=".$_GET['folder'];
    } else {
        echo '?sort=name&type=desc&page='.$_GET['page']."&folder=".$_GET['folder'];
    }
} else {
    echo '?sort=name&type=desc&page='.$_GET['page']."&folder=".$_GET['folder'];
}
?>
">File Name</a></th>
     <th scope="col"><a href="
<?php
if (isset($_GET['sort'])) {
    if ($_GET['sort']=='size' && $_GET['type']=='desc') {
        echo "?sort=size&type=asc&page=".$_GET['page']."&folder=".$_GET['folder'];
    } elseif ($_GET['sort']=='size' && $_GET['type']=='asc') {
        echo "?sort=size&type=desc&page=".$_GET['page']."&folder=".$_GET['folder'];
    } else {
        echo '?sort=size&type=desc&page='.$_GET['page']."&folder=".$_GET['folder'];
    }
} else {
    echo '?sort=name&type=desc&page='.$_GET['page']."&folder=".$_GET['folder'];
}?>
 ">Size</a></th>
     <th scope="col"><a href="
<?php
  if (isset($_GET['sort'])) {
      if ($_GET['sort']=='date' && $_GET['type']=='desc') {
          echo "?sort=date&type=asc&page=".$_GET['page']."&folder=".$_GET['folder'];
      } elseif ($_GET['sort']=='date' && $_GET['type']=='asc') {
          echo "?sort=date&type=desc&page=".$_GET['page']."&folder=".$_GET['folder'];
      } else {
          echo '?sort=date&type=desc&page='.$_GET['page']."&folder=".$_GET['folder'];
      }
  } else {
      echo '?sort=date&type=desc&page='.$_GET['page']."&folder=".$_GET['folder'];
  }?>
  ">Date Created</th>
     <th scope="col"><a href="
<?php
if (isset($_GET['sort'])) {
      if ($_GET['sort']=='type' && $_GET['type']=='desc') {
          echo "?sort=type&type=asc&page=".$_GET['page']."&folder=".$_GET['folder'];
      } elseif ($_GET['sort']=='type' && $_GET['type']=='asc') {
          echo "?sort=type&type=desc&page=".$_GET['page']."&folder=".$_GET['folder'];
      } else {
          echo '?sort=type&type=desc&page='.$_GET['page']."&folder=".$_GET['folder'];
      }
  } else {
      echo '?sort=type&type=desc&page='.$_GET['page']."&folder=".$_GET['folder'];
  }?>
  ">Type</th>
     <th scope="col">Actions</th>
   </tr>
 </thead>
<!-- Core file loader and pagination -->
<?php
  $GLOBALS['limit'] = 8;
  $GLOBALS['page'] = (int)$_GET['page']?:0;
  $GLOBALS['skip'] = $GLOBALS['limit'] * $GLOBALS['page'];
function LoadFiles($dir)
{
    $handler =  opendir($dir);
    $Files = array();
    if (!$handler) {
        die('Cannot list files for ' . $dir);
    }
    $blacklist = array('.', '..', 'css', 'index.php', 'main.php', 'rename.php', 'upload.php', 'favicon.png');
    $GLOBALS['skipped'] = 0;
    while ($Filename = readdir($handler)) {
        if ($Filename == '.' || $Filename == '..') {
            continue;
        }
        if (!in_array($Files, $blacklist)) {
            $GLOBALS['skipped']++;
        }
        $LastModified = filemtime($dir . $Filename);
        $filesize = filesize($dir.$Filename);
        $filextension = explode(".", $Filename);
        $filetp = end($filextension);
        $Files[] = array($dir . $Filename, $LastModified, $filesize, $filetp);
    }
    return $Files;
}
//include for sorting functions
$Files = LoadFiles($_GET['folder']);
include 'inc/functions.php';
// Checking which sort method is used and calling proper sorting function using call.php
// include 'inc/call.php';
$count = 1;?>
<!-- Cycling through files and displaying them -->
<?php
$arrlen = count($Files);
if ($arrlen > $GLOBALS['limit']) {
  $length = $GLOBALS['page'] + $GLOBALS['limit'];
  $offset = $GLOBALS['page'] - $GLOBALS['limit'];
  $Files = array_slice($Files,$GLOBALS['skip'],$length,true);
}
 ?>
<?php foreach ($Files as $source):?>
<tr>
  <td><?php
   echo $count; $count++;?></td>
  <td class="title-container text-left"><a href="
    <?php
   if (is_dir($source[0])) {
       echo '?page=0&sort=name&type=desc&folder='.$source[0]."/";
   } else {
       echo $source[0];
   }?>">
  <span class="icon">
     <?php
  //checking extension and appying an icon, using function which is located inside functions.php
 $ext = explode(".", $source[0]);
  $end = end($ext);
  if (is_dir($end)) {
      $extension = explode("/", $source[0]);
      $select = end($extension);
      echo '<i class="fas fa-folder"></i></span>' . $select;
  } else {
      $extension = explode("/", $source[0]);
      $select = end($extension);
      CreateIcon($select); ?></span><?php
     echo $select;
  }
  ?></a>
</td>
  <td>
    <!-- Calculating file size -->
<?php
  $path = $source[0];
  $size = filesize($path);
  $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
  $power = $size > 0 ? floor(log($size, 1024)) : 0;
  echo number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power]; ?></td>
  <td><?php echo date("F d Y H:i:s", filemtime($source[0]));?></td>
  <td><?php  $ext = explode(".", $source[0]);
  $end = end($ext);
  if (is_dir($end)) {
      echo 'Folder';
  } else {
      echo end($ext);
  }
  ?></td>
  <td class="actions"><?php echo '<a class="btn btn-success" href="rename.php?name='.substr($source[0], 8).'">Rename</a><form action="main.php" method="POST"><input type="hidden" name="location" value="'.$_GET['folder'].'"><button class="btn btn-danger" type="submit" name="del" value="'.substr($source[0], 8).'">Delete</button></form>';?></td>
</tr>
<?php endforeach; ?>
<!-- Endpoint of pagination -->
<?php
 $pages = (int)$GLOBALS['skipped'] / $GLOBALS['limit'];
 if ($GLOBALS['skipped'] % $GLOBALS['limit']) {
     $pages ++;
 }
     $pagination = 0;
     echo "<ul class='pagination'>";
 for ($i = 0; $i <= $pages; $i++) {
     $pagination++;
     $class = '';
     if ($page == $i) {
         $class = 'class="active"';
     } ?>
 <li class="page-item"><a class="page-link" href="<?php
 //Checking which method is present and assiging a value to pagination so it wont break, calling a function for that which is located inside functions.php
  CreatePageName(); ?>&page=<?= $i ?><?php echo '&folder=' . $_GET['folder']; ?>" <?= $class ?>><?= $pagination ?></a></li><?php
 }
?>
  <script src="js/assets.js"></script>
  </table>
  </body>
</html>
