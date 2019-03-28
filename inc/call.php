<?php
//include for calling sorting functions
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
