<?php
include 'config.php';
$target_dir = "./upload/";
$target_file = $target_dir . basename($_FILES["files"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["insertnew"])) {
  $check = getimagesize($_FILES["files"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
        $cateId= $_POST["cateId"];
        $title= $_POST["title"];
        $avatar= $target_file;
        $dateup= $_POST["dateup"];
        $author= $_POST["author"];
        $content= $_POST["content"];
        $status = $_POST["status"];
        $sql = "INSERT INTO news (cateId, title, avatar, dateup, author, content, status)
        VALUES ($cateId,N'$title',N'$avatar','$dateup',N'$author',N'$content',$status)";
        if (mysqli_query($conn, $sql)) {
            header("location:news.php");
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["files"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["files"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["files"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

?>