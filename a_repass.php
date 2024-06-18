<?php
//记录登录信息，便于用户输入后做校验
session_start();
$userid=$_SESSION['userid'];
include ('mysql_connect.php');//引入

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书管理系统 修改密码</title>
    <!-- Bootstrap核心CSS文件 -->
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery文件。需要在bootstrap.min.js之前引入 -->
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Bootstrap核心JavaScript文件 -->
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- 链接样式表 -->
    <link rel="stylesheet" href="./css/a_style.css"/>
    <style>
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
                        <li class="dropdown">
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
                        <li class="active"><a href="a_repass.php">密码修改</a></li>
                        <li><a href="index.php">退出</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="right_main" style="background-image: url(img/2.jpg);background-size: 100%;">
            <form action="a_repass.php" method="post"  style="text-align: center">
                <label><input type="password" name="pass1" placeholder="请输入新的密码" class="form-control"></label><br/><br/><br/>
                <label><input type="password" name="pass2" placeholder="确认新的密码" class="form-control"></label><br/><br/>
                <input type="submit" value="提交" class="btn btn-default">
                <input type="reset" value="重置"  class="btn btn-default">
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $passa = $_POST["pass1"];
                $passb = $_POST["pass2"];
                if($passa==$passb){
                    $sql="update admin set password='{$passa}' where admin_id={$userid}";
                    $res=mysqli_query($dbc,$sql);
                    if($res==1){
                        echo "<script>alert('密码修改成功！请重新登陆！')</script>";
                        echo "<script>window.location.href='index.php'</script>";
                    }
                }else{
                    echo "<script>alert('两次输入密码不同，请重新输入！')</script>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>