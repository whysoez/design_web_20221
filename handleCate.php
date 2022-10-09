<?php
        include 'config.php';
        if(isset($_POST["insertcate"]))
        {
            $cateName= $_POST["cateName"];
            $status = $_POST["status"];
            $sql = "INSERT INTO category (cateName, status)
            VALUES (N'$cateName',$status)";
            if (mysqli_query($conn, $sql)) {
                header("location:cate.php");
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        if(isset($_GET['task']) && $_GET['task']=="delete") {
            $cateId = $_GET['id'];
            $sql = "delete from category where cateId = $cateId";
            if (mysqli_query($conn, $sql)) {
                header("location:cate.php");
                echo "Delete record successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        if(isset($_POST['update'])) {
            $cateId = $_POST['cateId'];
            $cateName = $_POST['cateName'];
            $status = $_POST['status'];
            $sql = "update category set cateName= N'$cateName', status= $status where cateId= $cateId";
            if (mysqli_query($conn, $sql)) {
                echo "Update record successfully";
                header("location:cate.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        if(isset($_POST['cancel'])) {
            header("location:cate.php");
        }
?>