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
    <title>图书管理系统 增加读者</title>
    <!-- Bootstrap核心CSS文件 -->
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery文件。需要在bootstrap.min.js之前引入 -->
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Bootstrap核心JavaScript文件 -->
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- 链接样式表 -->
    <link rel="stylesheet" href="./css/a_style.css"/>
    <style>
        #login{
            width: 500px;
        }
        .input-group-addon{
            background-color: blue;
            border: none;
            color: white;
        }
        .btn{
            padding: 10px 20px;
            margin: 0 20px;
            border: none;
            background-color: blue;
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
                        <li class="dropdown active">
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
            <form action="a_addreader.php" method="POST" style="text-align: center" class="bs-example bs-example-form" role="form">
                <div id="login">
                    <div class="input-group"><span class="input-group-addon">ID</span><input name="id" type="text" placeholder="请输入id" class="form-control"></div><br/>
                    <div class="input-group"><span class="input-group-addon">姓名</span><input name="name" type="text" placeholder="请输入姓名" class="form-control"></div><br/>
                    <div class="input-group"><span class="input-group-addon">性别</span><input name="sex" type="text" placeholder="请输入性别" class="form-control"></div><br/>
                    <div class="input-group"><span class="input-group-addon">生日</span><input name="birth" type="text" placeholder="请输入生日" class="form-control"></div><br/>
                    <div class="input-group"><span class="input-group-addon">地址</span><input name="address" type="text" placeholder="请输入地址" class="form-control"></div><br/>
                    <div class="input-group"><span class="input-group-addon">电话</span><input name="tel" type="text" placeholder="请输入电话" class="form-control"></div><br/>
                    <input type="submit" value="添加" class="btn btn-default">
                </div>
            </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $id = $_POST["id"];
            $name= $_POST["name"];
            $sex = $_POST["sex"];
            $bir= $_POST["birth"];
            $add= $_POST["address"];
            $tel = $_POST["tel"];
            $sqla="insert into user VALUES ($id ,'{$name}','{$sex}','{$bir}','{$add}','{$tel}')";
            $sqlb="insert into userinfo (id,name) VALUES($id ,'{$name}');";
            $resa=mysqli_query($dbc,$sqla);
            $resb=mysqli_query($dbc,$sqlb);
            if($resa==1&&$resb==1){
                echo "<script>alert('添加成功,初始密码为111111')</script>";
                echo "<script>window.location.href='a_reader.php'</script>";
            }
            else{
                echo "<script>alert('添加失败,请重试！');</script>";
            }
        }
        ?>
        </div>
    </div>
</body>
</html>
