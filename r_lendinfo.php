<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysql_connect.php');

$sql="select name from userinfo where id={$userid}";
$res=mysqli_query($dbc,$sql);
$result=mysqli_fetch_array($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的借阅</title>
    <!-- Bootstrap核心CSS文件 -->
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery文件。需要在bootstrap.min.js之前引入 -->
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Bootstrap核心JavaScript文件 -->
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/style.css"/>
    <link rel="stylesheet" href="./css/r_lend.css"/>
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
            <li class="active"><a href="r_lendinfo.php">我的借阅</a></li>
            <li><a href="r_info.php">个人信息</a></li>
            <li><a href="index.php">退出</a></li>
        </ul>
    </div>

    <table>
        <caption>已借阅书籍</caption>
        <tr>
            <th>图书ID</th>
            <th>书名</th>
        </tr>
        <?php
        $sqla="select books.book_id,books.name from lendinfo,books where r_id='{$userid}' and lendinfo.book_id=books.book_id";
        $resa=mysqli_query($dbc,$sqla);
        foreach ($resa as $row){
            echo "<tr>";
            echo "<td>{$row['book_id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "</tr>";
        };
        ?>
    </table>
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