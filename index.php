<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Đào tạo HUMG</title>
    <?php
        include 'config.php';
    ?>
</head>
<body>
    <div class="container">
        <h1 style = "text-align: center;">Trang quản trị danh mục tin tức</h1>
        <div class="row">
            <div class="col-8">
                <form action="ccate.php" method="post">
                    <div><strong>Nhập tên danh mục</strong></div>
                    <input type="text" class="form-control" name="cateName">
                    <div><strong>Nhập trạng thái</strong></div>
                    <input type="radio" name="status" value="0"> Ẩn
                    <input type="radio" name="status" value="1"> Hiện <br><br>
                    <input type="submit" name = "insertcate" value="thêm mới" class="btn btn-primary">
                    </form>
            </div>
            <div class="col-4"></div>
        </div>
        <br>
        <div class="row">
            <div style = "margin: 0px auto 20px; font-size: 32px;">
            <strong>Danh sách các danh mục</strong>
            </div>
            <!-- hiển thị bảng data -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mã danh mục</th>
                        <th>Tên danh mục</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                            $sql = "SELECT * FROM category";
                            $result = $conn->query($sql);
                    
                            if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $s = "hiển thị";
                                if($row["status"]==0){
                                    $s = "ẩn";
                                }
                                echo "<tr>" 
                                . "<td>" . $row["cateId"]. "</td>" . 
                                "<td>" . $row["cateName"]. "</td>" . 
                                "<td>" . $s . "</td>" . 
                                '<td>
                                <a href="#" class="btn btn-warning">Sửa</a>
                                <a href="#" class="btn btn-danger">Xóa</a>
                                </td>' 
                                . "</tr>";
                            }
                            } else {
                            echo "0 results";
                            }
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
        <ul class="pagination justify-content-center">
            <li class="page-item" name="pagin"><a class="page-link" href="javascript:void(0);">Previous</a></li>
            <li class="page-item" name="pagin"><a class="page-link" href="javascript:void(0);">1</a></li>
            <li class="page-item" name="pagin"><a class="page-link" href="javascript:void(0);">2</a></li>
            <li class="page-item" name="pagin"><a class="page-link" href="javascript:void(0);">3</a></li>
            <li class="page-item" name="pagin"><a class="page-link" href="javascript:void(0);">4</a></li>
            <li class="page-item" name="pagin"><a class="page-link" href="javascript:void(0);">5</a></li>
            <li class="page-item" name="pagin"><a class="page-link" href="javascript:void(0);">Next</a></li>
        </ul>
    </div>
</body>
</html>