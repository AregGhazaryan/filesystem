<?php
// alert system
if (isset($_GET['message'])) {
  switch ($_GET['message']) {
    case "nofile":
        echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>You haven\'t selected any file!</div>';
    break;
    case "uploaderror":
        echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>There was an error while uploading your file, please try again later!</div>';
    break;
    case "big":
        echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>Your uploaded file extends 45MB!</div>';
    break;
    case "success":
        echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>Your file has been successfuly uploaded!</div>';
    break;
    case "renex":
        echo '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>Your file wasn\'t renamed, file name already exists!</div>';
    break;
    case "UAC":
        echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>Unauthorized Access!</div>';
    break;
    case "noname":
        echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>You haven\'t typed any name!</div>';
    break;
    case "rename":
        echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>Rename Successful!</div>';
    break;
    case "deleted":
        echo '<div class="alert alert-info" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>File Deleted!</div>';
    break;
    case "invalid":
        echo '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>Your file wasn\'t been renamed, new file name contains invalid characters!</div>';
    break;
    case "long":
        echo '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>Your file wasn\'t renamed, new file name exceeds 50 characters!</div>';
    break;
    case "folder":
        echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>Folder has been successfuly created!</div>';
    break;
    case "foldernoname":
        echo '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>Folder wasn\'t created, folder name was empty!</div>';
    break;
    case "foldertoolong":
        echo '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>Folder wasn\'t created, new folder name exceeds 20 characters!</div>';
    break;
    case "folderwrong":
        echo '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>New folder wasn\'t created, folder name is empty!</div>';
    break;
    case "folderdelete":
        echo '<div class="alert alert-info" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>Folder and its contents have been successfuly deleted!</div>';
    break;
    case "folderrename":
        echo '<div class="alert alert-info" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>Folder successfuly renamed!</div>';
    break;
    case "FDE":
        echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>Your file wasn\'t saved, selected subfolder doesn\'t exist!</div>';
    break;
    case "foldernamex":
        echo '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>New folder wasn\'t saved,another folder with the same name already exist!</div>';
    break;
  }
}
