<?php
//记录登录信息，便于用户输入后做校验
session_start();
$userid=$_SESSION['userid'];
include ('mysql_connect.php');//引入

$r_id=$_GET['id'];

$sqlb="select * from user where id='{$r_id}'";
$resb=mysqli_query($dbc,$sqlb);
$resultb=mysqli_fetch_array($resb);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap核心CSS文件 -->
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery文件。需要在bootstrap.min.js之前引入 -->
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Bootstrap核心JavaScript文件 -->
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>图书管理系统 读者信息修改</title>
    <link rel="stylesheet" href="./css/a_style.css"/>
    <style>
        .input-group-addon{
            background: blue;
            border: none;
            color: white;
        }
        .btn{
            padding: 10px 20px;
            margin: 0 20px;
            border: none;
            background: blue;
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
            <div style="padding: 10px 500px 10px;">
                <form  action="a_updreader.php?id=<?php echo $r_id; ?>" method="POST" style="text-align: center" class="bs-example bs-example-form" role="form">
                    <div id="login">
                        <div class="input-group"><span class="input-group-addon">姓名</span><input name="nname" value="<?php echo $resultb['name'] ;?>" type="text" placeholder="请输入修改的名字" class="form-control"></div><br/>
                        <div class="input-group"><span class="input-group-addon">性别</span><input name="sex" value="<?php echo $resultb['sex'] ;?>" type="text" placeholder="请输入修改的性别" class="form-control"></div><br/>
                        <div class="input-group"><span class="input-group-addon">生日</span><input name="birth" value="<?php echo $resultb['birth'] ;?>" type="text" placeholder="请输入修改的生日" class="form-control"></div><br/>
                        <div class="input-group"><span class="input-group-addon">地址</span><input name="address" value="<?php echo $resultb['address'] ;?>" type="text" placeholder="请输入修改的地址" class="form-control"></div><br/>
                        <div class="input-group"><span class="input-group-addon">电话</span><input name="tel" value="<?php echo $resultb['telcode'] ;?>" type="text" placeholder="请输入修改的电话" class="form-control"></div><br/>
                        <input type="submit" value="确认" class="btn btn-default">
                    </div>
                </form>
            </div>

            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $r_id=$_GET['id'];

                $name= $_POST["nname"];
                $sex = $_POST["sex"];
                $bir= $_POST["birth"];
                $add= $_POST["address"];
                $tel = $_POST["tel"];

                $sqla="update user set name='{$name}',sex='{$sex}',birth='{$bir}',address='{$add}',telcode='{$tel}' where id='{$r_id}';";
                $resa=mysqli_query($dbc,$sqla);
                $sqlc="update userinfo set name='{$name}' where id='{$r_id}';";
                $resc=mysqli_query($dbc,$sqlc);

                if($resa==1){
                    echo "<script>alert('修改成功！')</script>";
                    echo "<script>window.location.href='a_reader.php'</script>";

                }else{
                    echo "<script>alert('修改失败！请重新输入！');</script>";

                }

            }
            ?>
        </div>
</body>
</html>
