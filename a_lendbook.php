<?php
//记录登录信息，便于用户输入后做校验
session_start();
$userid=$_SESSION['userid'];
include ('mysql_connect.php');//引入

$bookid=$_GET['id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书馆 || 借出图书</title>
    <!-- Bootstrap核心CSS文件 -->
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery文件。需要在bootstrap.min.js之前引入 -->
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Bootstrap核心JavaScript文件 -->
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/style.css"/>
    <link rel="stylesheet" href="./css/a_style.css"/>
    <style>
        .input-group-addon{
            background: rgb(65,105,225);
            border: none;
            color: white;
        }
        .btn{
            padding: 10px 20px;
            margin: 0 20px;
            border: none;
            background: rgb(65,105,225);
            color: white;
        }
    </style>

</head>
<body>
    <div class="container">
        <!-- 侧边栏 ,静态可随页面滚动-->
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">图书管理系统</a>
                </div>
                <div>
                    <!-- 无序列表 -->
                    <ul class="nav navbar-nav">
                        <li><a href="a_index.php">首页</a></li>
                        <!-- 下拉框 -->
                        <li class="dropdown active">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">图书管理<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="a_books.php">全部图书</a></li>
                                <li><a href="a_addbook.php">增加图书</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">读者管理<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="a_reader.php">全部读者</a></li>
                                <li><a href="a_addreader.php">增加读者</a></li>
                            </ul>
                        </li>
                        <li><a href="a_repass.php">密码修改</a></li>
                        <li><a href="index.php">退出</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="right_main" style="background-image: url(img/2.jpg);background-size: 100%;">
            <div style="padding: 180px 550px 10px;text-align: center">
                <form  action="a_lendbook.php?bookid=<?php echo $bookid; ?>" method="POST" class="bs-example bs-example-form" role="form">
                    <div id="login">
                        <div class="input-group"><span class="input-group-addon">读者</span><input name="lendid" type="text" placeholder="请输入读者ID" class="form-control"></div><br><br>
                        <input type="submit" value="借阅" class="btn btn-default">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $b_id=$_GET['bookid'];
        $r_id=$_POST['lendid'];

        $sqla="insert into lendinfo(book_id,r_id) values ({$b_id},{$r_id});";
        $sql="update books set state=0 where book_id={$b_id};";
        $resa=mysqli_query($dbc,$sqla);
        $res=mysqli_query($dbc,$sql);
        if($res==1 && $resa==1) echo"<script>alert('借阅成功！');window.location.href='a_books.php'; </script>";
        else echo"<script>alert('借阅失败！');window.location.href='a_books.php'; </script>";

    };

?>
