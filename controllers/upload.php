<?php
require_once "../model/model.php";
require "common.php";
?><h3><a href="/~e2101365/php/proman/views">To Homepage</a><br></h3><?php
/* if (isset($_GET['task_id'])) {
    $task_id = get_task($_GET['task_id']);
} */



if(isset($_POST["submit"])) {
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  if (isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];
}
  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 9000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

    // Check if the directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0775, true);
      }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    
     ?> <img src="<?php echo $target_file; ?>" alt="Uploaded Image"> <?php

     add_file($target_file, $task_id);
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
   
  }
}
?>
