<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <!-- nav w3school -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/index_php.css">
    <!-- dataTable -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <title>Document</title>
    <title>Đào tạo HUMG</title>
    <?php
        include 'config.php';
    ?>
</head>
<body>
    <nav class="navbar navbar-inverse">
    <div class="container-fluid ">
        <div class="navbar-header">
        <a class="navbar-brand" href="./old/index.html">Trang chủ</a>
        </div>
        <ul class="nav navbar-nav">
        <li class="active"><a href="cate.php">Danh mục</a></li>
        <li><a href="news.php">Tin tức</a></li>
        </ul>
        <form class="navbar-form navbar-right" action="cate.php" method="get">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Cate Name" name="cateNameSearch">
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
                <form action="handleCate.php" method="post">
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
        <br>
        <div class="row">
            <h2 style = "text-align: center;">Danh sách các danh mục</h2> <br>
            <!-- hiển thị bảng data -->
            <table id="tCate" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Mã danh mục</th>
                        <th>Tên danh mục</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            $sql = "SELECT * FROM category ";
                            
                            if(isset($_GET["search"])) {
                                $s = $_GET['cateNameSearch'];
                                // echo $s;
                                $sql = "SELECT * FROM category WHERE cateName LIKE '".'%'.$s."%' ";
                            }
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
                                <a href="uCate.php?id='.$row['cateId'].'" class="btn btn-warning">Sửa</a>
                                <a href="handleCate.php?task=delete&id='.$row['cateId'].'" class="btn btn-danger">Xóa</a>
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
            $('#tCate').DataTable({
        lengthMenu: [
            [3, 10, -1],
            [3, 10, 'All'],
        ],
    });
        });
    </script>
</body>
</html>