<?php
session_start();
include ('mysql_connect.php');
$userid=$_SESSION['userid'];

$sql="select name from userinfo where id={$userid}";
$res=mysqli_query($dbc,$sql);
$result=mysqli_fetch_array($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书馆管理系统 密码修改</title>
    <!-- Bootstrap核心CSS文件 -->
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery文件。需要在bootstrap.min.js之前引入 -->
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Bootstrap核心JavaScript文件 -->
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/style.css"/>
    <style>
        .btn{
            padding: 5px 20px;
            background-color: royalblue;
            color: white;
            border: transparent;
            margin: 0 10px;
        }
        .btn:hover{
            background-color: rgb(33, 81, 224);
            color: white;
        }
        form span{
            text-align: left; 
            margin-left: -200px;
            line-height: 50px;
        }
    </style>
</head>
<body>
    <!-- 导航栏 -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="containers">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">我的图书借阅管理</a>
            </div>
            <div class="menu">
                <img id="menu_pic" src="./img/menu.png" alt="">
            </div>
        </div>
    </nav>
    <!-- 侧边导航 -->
    <div id="aside">
        <!-- 关闭符 -->
        <div class="close"><div id="close_btn">×</div></div>

        <div class="user">
            <div class="user_photo">
                <img class="tupian" src="./img/3.png" alt="">
            </div>
            <div class="user_txt">
                <p>用户名：<?php echo $result['name'];  ?></p>
                <p><a href="r_repass.php">密码修改</a></p>
            </div>
        </div>
        <ul class="navs">
            <li><a href="r_index.php">首页</a></li>
            <li><a href="r_querybook.php">书籍查询</a></li>
            <li><a href="r_lendinfo.php">我的借阅</a></li>
            <li><a href="r_info.php">个人信息</a></li>
            <li><a href="index.php">退出</a></li>
        </ul>
    </div>
    <form action="r_repass.php" method="post"  style="text-align: center">
        <label><span>密码：</span><br/><input type="password" name="pass1" placeholder="请输入新的密码" class="form-control"></label><br/><br/><br/>
        <label><span>重复密码：</span><br/><input type="password" name="pass2" placeholder="确认新的密码" class="form-control"></label><br/><br/>
        <input type="submit" value="提交" class="btn btn-default">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $passa = $_POST["pass1"];
        $passb = $_POST["pass2"];
        if($passa==$passb){
            $sql="update userinfo set passwd='{$passa}' where id={$userid}";
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
</body>
<script>
    // 点击menu图片，显示侧边栏
    // getElementById读取页面元素，document.getElementById得到一个对象
    let menu_pic=document.getElementById('menu_pic')
    let aside=document.getElementById('aside')
    menu_pic.addEventListener('click',()=>{
        aside.style.display="block"
        aside.className='asides'
        menu_pic.style.display='none'
    })
    let close_btn=document.getElementById('close_btn')
    close_btn.addEventListener('click',()=>{
        aside.style.display='none'
        menu_pic.style.display='block'
    })
</script>
</html>