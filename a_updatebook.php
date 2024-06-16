<?php
//记录登录信息，便于用户输入后做校验
session_start();
$userid=$_SESSION['userid'];
include ('mysql_connect.php');//引入

$bookid=$_GET['id'];//读取由前一个页面传入的值,在url中
$sqlb="select name,author,publish,introduction,language,class,state 
    from books where book_id={$bookid}";
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
    <title>图书管理系统 修改图书</title>
    <link rel="stylesheet" href="./css/a_style.css"/>
    <style>

        .input-group-addon{
            background-color: black;
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
            <div style="padding: 10px 500px 10px;">
                <form  action="a_updatebook.php?id=<?php echo $bookid; ?>" method="POST" style="text-align: center" class="bs-example bs-example-form" role="form">
                    <div id="login">
                        <div class="input-group"><span class="input-group-addon">书名</span><input value="<?php echo $resultb['name']; ?>" name="name" type="text" placeholder="请输入书名" class="form-control"></div><br/>
                        <div class="input-group"><span class="input-group-addon">作者</span><input value="<?php echo $resultb['author']; ?>" name="author" type="text" placeholder="请输入作者" class="form-control"></div><br/>
                        <div class="input-group"><span class="input-group-addon">出版社</span><input value="<?php echo $resultb['publish']; ?>"  name="publish" type="text" placeholder="请输入出版社" class="form-control"></div><br/>
                        <div class="input-group"><span class="input-group-addon">简介</span><input  value="<?php echo $resultb['introduction']; ?>" name="introduction" type="text" placeholder="请输入简介" class="form-control"></div><br/>
                        <div class="input-group"><span class="input-group-addon">语言</span><input value="<?php echo $resultb['language']; ?>" name="language" type="text" placeholder="请输入语言" class="form-control"></div><br/>
                        <div class="input-group"><span class="input-group-addon">分类号</span><input  value="<?php echo $resultb['class']; ?>" name="classe" type="text" placeholder="请输入分类" class="form-control"></div><br/>
                        <div class="input-group"><span class="input-group-addon">图书状态</span><input value="<?php echo $resultb['state']; ?>" name="state" type="text" placeholder="请输入图书状态" class="form-control"></div><br/>
                        <label><input type="submit" value="确认" class="btn btn-default"></label>
                    </div>
                </form>
            </div>
            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST"){

                $id=$_GET['id'];
                
                $name = $_POST["name"];
                $aut = $_POST["author"];
                $pub = $_POST["publish"];
                $int = $_POST["introduction"];
                $lan = $_POST["language"];
                $cla = $_POST["classe"];
                $sta= $_POST["state"];

                $sqla="update books set name='{$name}',author='{$aut}',publish='{$pub}',introduction='{$int}',
                    language='{$lan}',class='{$cla}',state='{$sta}' where book_id=$id;";
                $resa=mysqli_query($dbc,$sqla);
                if($resa==1){
                    echo "<script>alert('修改成功！')</script>";
                    echo "<script>window.location.href='a_books.php'</script>";
                }else{
                    echo "<script>alert('修改失败！请重新输入！');</script>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>