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
    <title>图书管理系统 全部图书</title>
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
        #query{
            width: 90%;
            height: 40px;
            display: flex;
            justify-content: center;
            margin-top: 20px;
            margin-bottom: 40px;
        }
        #query label{
            width: 60%;
            height: 100%;
        }
        #query label input{
            height: 100%;
            border-radius: 0; 
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }
        #query input[type=submit]{
            width: 5%;
            height: 100%;
            background: rgb(65,105,225);
            color: white;
            border-radius: 0;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            border: none;
        }
        .table{
            width: 90%;
            background-color: rgba(255,255,255,0.85);
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
            background-color: silver;
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
            <form  id="query" action="a_book.php" method="POST">
                <div id="query">
                    <label ><input  name="bookquery" type="text" placeholder="请输入要查询的书名" class="form-control"></label>
                    <input type="submit" value="查询" class="btn btn-default">
                </div>
            </form>
            <!-- 表格，带悬停效果 -->
            <table  class="table table-bordered table-hover">
                <!-- 标题行 -->
                <thead>
                <tr>
                    <th>书号</th>
                    <th>书名</th>
                    <th>作者</th>
                    <th>出版社</th>
                    <th>简介</th>
                    <th>语言</th>
                    <th>分类</th>
                    <th>状态</th>

                    <th>操作</th>
                    <th>操作</th>
                    <th>操作</th>
                </tr>
                </thead>

                <tbody>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                    // submit后，获取form的信息
                    $gjc = $_POST["bookquery"];
                    $sql="select book_id,name,author,publish,introduction,language,class,state 
                        from books
                        where name like '%{$gjc}%';";
                }
                else{
                    $sql="select * from books;";
                }

                $res=mysqli_query($dbc,$sql);
                // 遍历
                foreach ($res as $row){
                    echo "<tr>";
                    echo "<td>{$row['book_id']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['author']}</td>";
                    echo "<td>{$row['publish']}</td>";
                    echo "<td>{$row['introduction']}</td>";
                    echo "<td>{$row['language']}</td>";
                    echo "<td>{$row['class']}</td>";
                    if($row['state']==1) echo "<td>可借阅</td>";
                    else if($row['state']==0) echo "<td>无库存</td>";
                    // href中?后是向另一个页面传的值,可由$_GET直接读取
                    echo "<td><a href='a_updatebook.php?id={$row['book_id']}'>修改</a></td>";
                    echo "<td><a href='a_delbook.php?id={$row['book_id']}'>删除</a></td>";
                    if($row['state']==1)echo "<td><a href='a_lendbook.php?id={$row['book_id']}'>借书</a></td>";
                    if($row['state']==0)echo "<td><a href='a_backbook.php?id={$row['book_id']}'>还书</a></td>";
                    echo "</tr>";
                };
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>