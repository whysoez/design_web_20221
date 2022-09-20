<?php
        include 'config.php';
        if(isset($_POST["insertnew"]))
        {
            $cateId= $_POST["cateId"];
            $title= $_POST["title"];
            $avatar= $_POST["avatar"];
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
?>