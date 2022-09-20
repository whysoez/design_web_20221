<?php
        include 'config.php';
        if(isset($_POST["insertcate"]))
        {
            $cateName= $_POST["cateName"];
            $status = $_POST["status"];
            $sql = "INSERT INTO category (cateName, status)
            VALUES (N'$cateName',$status)";
            if (mysqli_query($conn, $sql)) {
                header("location:index.php");
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
?>