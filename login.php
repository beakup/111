<?php
include ('mysql_connect.php');//引入

session_start();//记录登录信息，便于用户输入后做校验

error_reporting(0);//关闭php错误报告

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = trim($_POST["captcha"]);
    $acco = $_POST["account"];
    $pw = $_POST["pass"];
}
if($_POST['role']=='admin'){
    // strtolower函数，将字符串转换为小写字母。
    if(strtolower($code)==strtolower($_SESSION['authcode'])){
        $adsql="select * from admin where admin_id={$acco} and password='{$pw}'";
        $adres=mysqli_query($dbc,$adsql);
    }
    else{
        echo "<script>alert('验证码错误!');window.location='index.php';</script>";
    }
}

if($_POST['role']=='stu'){
    if(strtolower($code)==strtolower($_SESSION['authcode'])){
        $resql="select * from userinfo where id={$acco} and passwd='{$pw}'";
        $reres=mysqli_query($dbc,$resql);
    }
    else{
        echo "<script>alert('验证码错误!');window.location='index.php';</script>";
    }
}

if(mysqli_num_rows($adres)==1 ){
    session_start();
    $_SESSION['userid']=$acco;
    echo "<script>window.location='a_index.php'</script>";

}else if(mysqli_num_rows($reres)==1){
    session_start();
    $_SESSION['userid']=$acco;

    echo "<script>window.location='r_index.php'</script>";
}else{
    echo "<script>alert('用户名或密码错误，请重新输入!');window.location='index.php';</script>";
}
?>