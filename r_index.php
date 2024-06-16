<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysql_connect.php');

$sql="select name from userinfo where id='{$userid}';";
$res=mysqli_query($dbc,$sql);
$result=mysqli_fetch_array($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <!-- Bootstrap核心CSS文件 -->
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery文件。需要在bootstrap.min.js之前引入 -->
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Bootstrap核心JavaScript文件 -->
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/r_index.css">
    <style>
        body{
            width: 100%;
            height: 100vh;
            overflow: hidden;
            background-size:cover;
            color: antiquewhite;

        }
        #gonggao{
            position: absolute;
            left: 40%;
            top: 50%;
        }
        .navbar{
            position: fixed;
            top: 0;
            width: 100vw;
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
            <li class="active"><a href="r_index.php">首页</a></li>
            <li><a href="r_querybook.php">书籍查询</a></li>
            <li><a href="r_lendinfo.php">我的借阅</a></li>
            <li><a href="r_info.php">个人信息</a></li>
            <li><a href="index.php">退出</a></li>
        </ul>
    </div>
    <h3 style="text-align: center" id="text"></h3>
</body>
<script>
    // 逐字显示文本
    function start(){
        // 块级作用域变量
        let str = '书籍是人类进步的阶梯。'
        let str_ = ''
        let i = 0
        // getElementById读取页面元素，document.getElementById得到一个对象
        let content = document.getElementById('text')
        // setInterval定时器，.setInterval(调用函数，延时时间);
        let timer = setInterval(()=>{
            if(str_.length<str.length){
                str_ += str[i++]
                content.innerText = str_+'|'                 
            }else{ 
                // clearInterval()是结束定时器的循环调用函数
                clearInterval(timer)
                content.innerHTML = '<p>'+str_+'</p>'
            }
        },100) 
    }
    start()
    // 点击menu图片，显示侧边栏
    let menu_pic=document.getElementById('menu_pic')
    let aside=document.getElementById('aside')
    menu_pic.addEventListener('click',()=>{
        aside.style.display="block"
        aside.className='asides'
    })
    let close_btn=document.getElementById('close_btn')
    close_btn.addEventListener('click',()=>{
        aside.style.display='none'
    })
</script>
</html>
