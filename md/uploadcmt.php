<?php
  $target_dir = "../upload_files/images/md_comment";
  $inputname='img-cmnt';

  $userfile_name = $_FILES[$inputname]['name'];
  $userfile_extn = substr($userfile_name, strrpos($userfile_name, '.')+1);
  $userfile_name='md_comment'.time().'.'.$userfile_extn;
  $target_file = $target_dir .''.time().'.'.$userfile_extn;
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES[$inputname]["tmp_name"]);
      if($check !== false) {
          $mess="File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          $mess= "File is not an image.";
          $uploadOk = 0;
      }
  }

  // Check if file already exists
  if (file_exists($target_file)) {
      $mess="Sorry, file already exists.";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES[$inputname]["size"] > 500000) {
      $mess="Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  $imageFileType=strtolower($imageFileType);

  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      $mess="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      $mess="Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES[$inputname]["tmp_name"], $target_file)) {
        $mess=$userfile_name;
      } else {
        $uploadOk=0;
        $mess="Sorry, there was an error uploading your file.";
      }
  }

  $arr = array('return' => $uploadOk, 'mess' => $mess);
  echo json_encode($arr);

?>
