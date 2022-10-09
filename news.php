<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link bootstrap  ckEditor-->
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
       <!-- nav w3school -->
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/index_php.css">
    <!-- dataTable -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">    <title>Đào tạo HUMG</title>
    <?php
        include 'config.php';
    ?>
    <style>
        .fix-img {
            width: 50px;
            height: 50px;
            padding: 5px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-inverse nav_sticky">
    <div class="container-fluid ">
        <div class="navbar-header">
        <a class="navbar-brand" href="./old/index.html">Trang chủ</a>
        </div>
        <ul class="nav navbar-nav">
        <li><a href="cate.php">Danh mục</a></li>
        <li class="active"><a href="news.php">Tin tức</a></li>
        </ul>
        <form class="navbar-form navbar-right" action="news.php" method="get">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Title New" name="titleSearch">
            <div class="input-group-btn">
            <button class="btn btn-default" type="submit" name = "search">
                <i class="glyphicon glyphicon-search"></i>
            </button>
            </div>
        </div>
        </form>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </div>
    </nav>
    <div class="container">
        <h1 style = "text-align: center;">Trang quản trị danh mục tin tức</h1>
        <div class="row">
            <div class="col-8">
                <form action="handleNews.php" method="post" enctype="multipart/form-data">
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
        <h2 style = "text-align: center;">Danh sách các bài viết</h2> <br>
            <!-- hiển thị bảng data -->
            <table id="tNews" class="table table-striped" style="width:100%">
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
                        <?php
                            $sql = "SELECT * FROM news";

                            // thêm mới phần tìm kiếm
                            if(isset($_GET["search"])) {
                                $s = $_GET['titleSearch'];
                                // echo $s;
                                $sql = "SELECT * FROM news WHERE title LIKE '".'%'.$s."%' ";
                            }

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
                                        '<td style="display:flex">
                                        <a href="uNews.php?id='.$row['newId'].'" class="btn btn-warning">Sửa</a>
                                        <a href="handleNews.php?task=delete&id='.$row['newId'].'" class="btn btn-danger">Xóa</a>
                                        </td>' 
                                    . "</tr>";
                            }
                            } else {
                            echo "0 results";
                            }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#tNews').DataTable({
        lengthMenu: [
            [3, 10, -1],
            [3, 10, 'All'],
        ],
    });
        });
    </script>
</body>
</html>