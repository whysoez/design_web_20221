<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link bootstrap -->
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Đào tạo HUMG</title>
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
    <div class="container">
        <h1 style = "text-align: center;">Trang quản trị danh mục tin tức</h1>
        <div class="row">
            <div class="col-8">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div><strong>Chọn tên danh mục</strong></div>
                    <select name="cateId" id="">
                        <?php
                            $sql = "SELECT * FROM category";
                            $result = $conn->query($sql);
                    
                            if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<option value ='" . $row["cateId"] . "'>" . $row["cateName"] ."</option>";
                            }
                            } else {
                            echo "0 results";
                            }
                        ?>
                    </select>
                    <div><strong>Nhập tiêu đề bài viết</strong></div>
                    <input type="text" class="form-control" name="title" id="" placeholder="Nhập tiêu đề bài viết...">
                    <div><strong>Thêm ảnh vào bài viết:</strong></div>
                    <input type="file" name="files[]" multiple>
                    <div><strong>Ngày đăng bài</strong></div>
                    <input type="date" class="form-control" name="dateup">
                    <div><strong>Tác giả</strong></div>
                    <input type="text" class="form-control" name="author" placeholder="Nhập tác giả bài viết...">
                    <div><strong>Nhập trạng thái</strong></div>
                    <input type="radio" name="status" value="0"> Ẩn
                    <input type="radio" name="status" value="1"> Hiện
                    <div><strong>Nhập nội dung bài viết</strong></div>
                    <textarea name="content" id="" cols="30" rows="10"></textarea>
                    <script>
                        CKEDITOR.replace('content');
                    </script>
                    <br>
                    <input type="submit" name = "submit" value="Thêm mới" class="btn btn-primary">
                    </form>
            </div>
            <div class="col-4"></div>
        </div>
        <br>
        <div class="row">
            <div style = "margin: 0px auto 20px; font-size: 32px;">
            <strong>Danh sách các bài viết</strong>
            </div>
            <!-- hiển thị bảng data -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mã bài viết</th>
                        <th>Thể loại</th>
                        <th>Tiêu đề bài viết</th>
                        <th>Ảnh</th>
                        <th>Thời gian đăng</th>
                        <th>Tác giả</th>
                        <th>Nội dung</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                            $sql = "SELECT * FROM news";
                            $result = $conn->query($sql);
                    
                            if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                // hiển thị trạng thái của records
                                $s = "hiển thị";
                                if($row["status"]==0){
                                    $s = "ẩn";
                                }
                                // $img = "./images/test/" . $row["avatar"];
                                        echo "<tr>" . 
                                        "<td>" . $row["newId"]. "</td>" . 
                                        "<td>" . $row["cateId"]. "</td>" . 
                                        "<td>" . $row["title"]. "</td>" .
                                        "<td>";
                                        
                                        $img = $row["avatar"];
                                        $arr_img = (explode('*', $img));
                                        foreach($arr_img as $i){
                                            echo "<img class='fix-img' src='./".$i. "'>";
                                        }
                                    
                                        //  ."<img class='fix-img' src='". $img. "'>". 
                                echo    "</td>" . 
                                        "<td>" . $row["dateup"]. "</td>" . 
                                        "<td>" . $row["author"]. "</td>" . 
                                        "<td>" . $row["content"]. "</td>" . 
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