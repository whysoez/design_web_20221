<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/php.css">    <title>update category</title>
</head>
<body>
    <nav class="navbar navbar-inverse">
    <div class="container-fluid ">
        <div class="navbar-header">
        <!-- <a class="navbar-brand" href="#">Trang chủ</a> -->
        </div>
        <ul class="nav navbar-nav">
        <li class="active"><a href="cate.php">Danh mục</a></li>
        <li><a href="news.php">Tin tức</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </div>
    </nav>
    <div class="container">
        <h1 style = "text-align: center;">Trang cập nhật danh mục tin tức</h1>
            <div class="row">
                <div class="col-8">
                    <form action="handleCate.php" method="post">
                        <?php
                        include 'config.php';
                            $cateId = $_GET['id'];
                            $sql = "SELECT * FROM category where cateId=$cateId";
                            $result = $conn->query($sql);
                    
                            if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<input type='hidden' name='cateId' value=".$cateId.">".
                                "<div><strong>Nhập tên danh mục</strong></div>";
                                echo "<input type='text' class='form-control' name='cateName' value='".$row['cateName']."'>".
                                "<div><strong>Nhập trạng thái</strong></div>";
                                echo "<input type='radio' name='status' value=1> Hiện"; 
                                echo "<input type='radio' name='status' value=0> Ẩn";
                            }
                            } else {
                            echo "0 results";
                            }
                        ?>
                        <br><br>
                        <input type="submit" name = "update" value="Cập nhật" class="btn btn-primary">
                        <input type="submit" name = "cancel" value="Hủy" class="btn btn-danger">
                    </form>
                </div>
                <div class="col-4"></div>
            </div>
    </div>
</body>
</html>
