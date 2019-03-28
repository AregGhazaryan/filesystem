<!-- Navbar full include -->
<div class="navbar navbar-light bg-white">
  <div class="nav-form main-nav">
    <button type="button" class="btn btn-success upbutton togglebtn" data-toggle="modal" data-target="#uploadmodal">
     <i class="fas fa-upload"></i> Upload
   </button>
    <button type="button" class="btn btn-primary togglebtn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-folder-plus"></i>New Folder</button>
  </div>
  <h5>
    <!-- displaying the folder which user is currently browsing -->
    Currently Browsing : <?php
    if($_GET['folder']==="uploads/"){
      echo 'Main Folder';
    }else{
      echo substr($_GET['folder'],8);
    }
    ?>
  </h5>
  </div>
