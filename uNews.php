<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link bootstrap -->
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/php.css">    <title>Đào tạo HUMG</title>
    <?php
        include 'config.php';
    ?>
    <style>
        .fix-img {
            width: 60px;
            height: 60px;
            padding: 5px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid ">
        <div class="navbar-header">
        <!-- <a class="navbar-brand" href="#">Trang chủ</a> -->
        </div>
        <ul class="nav navbar-nav">
        <li><a href="cate.php">Danh mục</a></li>
        <li class="active"><a href="news.php">Tin tức</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </div>
    </nav>
    <div class="container">
        <h1 style = "text-align: center;">Trang cập nhật tin tức</h1>
        <div class="row">
            <div class="col-8">
                <form action="handleNews.php" method="post" enctype="multipart/form-data">
                    <div><strong>Chọn tên danh mục</strong></div>
                    <?php
                            $sql = "SELECT * FROM category";
                            $result = $conn->query($sql);
                            $newId = $_GET['id'];

                            if ($result->num_rows > 0) {
                                // output data of each row
                            echo "<select name='cateId'>";
                            while($row = $result->fetch_assoc()) {
                                echo "<option value ='" . $row["cateId"] . "'>" . $row["cateName"] ."</option>";
                            }
                            } else {
                            echo "0 results";
                            }
                            echo "</select>";
?>
<?php
                            $sql = "SELECT * FROM news WHERE newId= $newId";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $content = substr($row['content'],0,strlen($row['content'])-1);
                                    echo '<input type="hidden" name="avatarOld" value="'.$row['avatar'].'">';
                                    echo '<input type="hidden" name="newId" value='.$newId.'>';
                                    echo "<div><strong>Nhập tiêu đề bài viết</strong></div>";
                                    echo '<input type="text" class="form-control" name="title" id="" value="'.$row['title'].'" placeholder="Nhập tiêu đề bài viết...">
                                    <div><strong>Thêm ảnh vào bài viết:</strong></div>
                                    <input type="file" name="files[]" multiple>
                                    <div><strong>Ngày đăng bài</strong></div>
                                    <input type="date" class="form-control" value="'.$row['dateup'].'" name="dateup">
                                    <div><strong>Tác giả</strong></div>
                                    <input type="text" class="form-control" name="author" value="'.$row['author'].'" placeholder="Nhập tác giả bài viết...">
                                    <div><strong>Nhập trạng thái</strong></div>
                                    <input type="radio" name="status" value="0"> Ẩn
                                    <input type="radio" name="status" value="1"> Hiện
                                    <div><strong>Nhập nội dung bài viết</strong></div>';
                                    echo '<textarea name="content" id="" cols="30" rows="10">'.$content.'</textarea>';
                                }
                            } else {
                                echo "0 result";
                            }
                    ?>
                    
                    <script>
                        CKEDITOR.replace('content');
                    </script>
                    <script>
                        // CKEDITOR.replace('content');
                    </script>
                    <br>
                    <input type="submit" name = "update" value="Cập nhật" class="btn btn-primary">
                    <input type="submit" name = "cancel" value="Hủy" class="btn btn-danger">
                    </form>
            </div>
            <div class="col-4"></div>
        </div>
        <br>
    </div>
</body>
</html>