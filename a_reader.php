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
    <title>图书管理系统 全部读者</title>
    <!-- Bootstrap核心CSS文件 -->
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery文件。需要在bootstrap.min.js之前引入 -->
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Bootstrap核心JavaScript文件 -->
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- 链接样式表 -->
    <link rel="stylesheet" href="./css/a_style.css"/>
    <style>
        .right_main{
            flex-wrap: wrap;
            overflow-y: scroll;
        }
        .right_main::-webkit-scrollbar{
            display: none;
        }
       .table{
            width: 90%;
            background-color: rgba(255,255,255,0.85);
        }
        #query{
            width: 70%;
            height: 40px;
            display: flex;
            justify-content: center;
            margin-top: 20px;
            margin-bottom: 40px;
        }
        #query label{
            width: 75%;
            height: 40px;
        }
        th{
            white-space: nowrap;
            background: white;
            padding: 10px 20px;
        }
        .table-hover>thead>tr:hover{
            color: black;
        }
        .table-hover>tbody>tr:hover{
            background: rgb(65,105,225);
            color: white;
        }
        .table-hover>tbody>tr:hover a{
            color: white;
        }
        .table-hover>tbody>tr:first-of-type:hover a{
            color: black;
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
            <form id="query" action="a_reader.php" method="POST">
                <div id="query">
                    <label ><input  name="readerquery" type="text" placeholder="请输入读者姓名" class="form-control"></label>
                    <input type="submit" value="查询" class="btn btn-default">
                </div>
            </form>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>生日</th>
                    <th>居住地</th>
                    <th>电话</th>
                    <th>操作</th>
                </tr>
                </thead>

                <tbody>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                    $gjc = $_POST["readerquery"];

                    $sql="select id, name,sex,birth,address,telcode
                        from user
                        where name like '%{$gjc}%' ;";

                }
                else{
                    $sql="select * from user;";
                }
                $res=mysqli_query($dbc,$sql);
                foreach ($res as $row){
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['sex']}</td>";
                    echo "<td>{$row['birth']}</td>";
                    echo "<td>{$row['address']}</td>";
                    echo "<td>{$row['telcode']}</td>";
                    echo "<td><a href='a_updreader.php?id={$row['id']}'>修改</a></td>";
                    echo "</tr>";
                };
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>