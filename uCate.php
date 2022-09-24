<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>update category</title>
</head>
<body>
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
