<?php 
// Include the database configuration file 
include 'config.php'; 
     
if(isset($_POST['submit'])){ 

    // var data to mysql
    $cateId= $_POST["cateId"];
    $title= $_POST["title"];
    $avatar= '';
    $dateup= $_POST["dateup"];
    $author= $_POST["author"];
    $content= $_POST["content"];
    $status = $_POST["status"];
    // File upload configuration 
    $targetDir = "upload/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
    $fileNames = array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 
        $t = '';
        foreach($_FILES['files']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
            $t .= $targetFilePath . '*';
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath);
            }else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            }
        } 
        // split * end string
        $avatar = substr($t,0,strlen($t)-1);
        // insert data to mysql
        $sql = "INSERT INTO news (cateId, title, avatar, dateup, author, content, status)
        VALUES ($cateId,N'$title',N'$avatar','$dateup',N'$author',N'$content',$status)";
        if (mysqli_query($conn, $sql)) {
            header("location:news.php");
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        } 
    }else{ 
        $statusMsg = 'Tên AttributeName đã chọn không có.'; 
    }
} 

if(isset($_GET['task']) && $_GET['task']=="delete") {
    $newId = $_GET['id'];
    $sql = "delete from news where newId= $newId";
    if (mysqli_query($conn, $sql)) {
        header("location:news.php");
        echo "Delete record successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if(isset($_POST['update'])) {
    $newId = $_POST['newId'];
    $cateId = $_POST['cateId'];
    $title = $_POST['title'];
    $avatar= '1111';
    $dateup = $_POST['dateup'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    $status = $_POST['status'];
    $sql = "update news set cateId= $cateId, title= N'$title', avatar= $avatar, dateup= N'$dateup', 
    author= N'$author', content= N'$content', status= $status where newId= $newId";
    if (mysqli_query($conn, $sql)) {
        echo "Update record successfully";
        header("location:news.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if(isset($_POST['cancel'])) {
    header("location:news.php");
}
 
?>