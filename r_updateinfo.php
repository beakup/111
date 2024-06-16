<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysql_connect.php');


$sqlb="select * from user where id={$userid} ;";
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
    <title>个人信息修改</title>
    <link rel="stylesheet" href="./css/style.css"/>
    <link rel="stylesheet" href="./css/r_upinfo.css"/>
</head>
<body>
<div style="padding: 10px 500px 10px;">
<h1 style="text-align: center"><strong>个人信息修改</strong></h1>
    <form  action="r_updateinfo.php" method="POST" style="text-align: center" class="bs-example bs-example-form" role="form">
    <div id="login">
        <div class="input-group"><span  class="input-group-addon">姓名</span><input value="<?php echo $resultb['name']; ?>" name="name" type="text" placeholder="请输入修改的图书名" class="form-control"></div><br/>
        <div class="input-group"><span  class="input-group-addon">性别</span><input value="<?php echo $resultb['sex']; ?>" name="sex" type="text" placeholder="请输入修改的作者" class="form-control"></div><br/>
        <div class="input-group"><span  class="input-group-addon">生日</span><input value="<?php echo $resultb['birth']; ?>"  name="birth" type="text" placeholder="请输入修改的出版社" class="form-control"></div><br/>
        <div class="input-group"><span  class="input-group-addon">地址</span><input value="<?php echo $resultb['address']; ?>" name="address" type="text" placeholder="请输入修改的ISBN" class="form-control"></div><br/>
        <div class="input-group"><span  class="input-group-addon">电话</span><input  value="<?php echo $resultb['telcode']; ?>" name="telcode" type="text" placeholder="请输入新的简介" class="form-control"></div><br/>
        <label><input type="submit" value="确认" class="btn btn-default"></label>
    </div>
    </form>
</div>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $nnam = $_POST["name"];
    $nsex = $_POST["sex"];
    $nbirth = $_POST["birth"];
    $nadd = $_POST["address"];
    $nint = $_POST["telcode"];

    $sqla="update user set name='{$nnam}',sex='{$nsex}',birth='{$nbirth}',address='{$nadd}',telcode='{$nint}' where id={$userid};";
    $resa=mysqli_query($dbc,$sqla);

    $sqlc="update userinfo set name='{$nnam}' where id={$userid};";
    $resc=mysqli_query($dbc,$sqlc);
    if($resa==1&&$resc==1){

        echo "<script>alert('修改成功！')</script>";
        echo "<script>window.location.href='r_info.php'</script>";
    }else{
        echo "<script>alert('修改失败！请重新输入！');</script>";
    }
}


?>
</body>
</html>
