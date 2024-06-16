<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysql_connect.php');

$bookid=$_GET['id'];
$sql="select id from userinfo where id={$userid}";
$res=mysqli_query($dbc,$sql);
$result=mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书馆管理系统 图书借阅</title>
    <!-- Bootstrap核心CSS文件 -->
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery文件。需要在bootstrap.min.js之前引入 -->
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Bootstrap核心JavaScript文件 -->
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/style.css"/>
    <link rel="stylesheet" href="./css/a_style.css"/>
    <style>
        .input-group-addon{
            background: rgb(65,105,225);
            border: none;
            color: white;
        }
        .btn{
            padding: 10px 20px;
            margin: 0 20px;
            border: none;
            background: rgb(65,105,225);
            color: white;
        }
    </style>

</head>
<body>
<div style="padding: 180px 550px 10px;text-align: center">
<form  action="r_lendbook.php?tsid=<?php echo $bookid; ?>" method="POST" class="bs-example bs-example-form" role="form">
    <div id="login">
        <div class="input-group"><span class="input-group-addon">借阅人</span><input  name="borrower" type="text" placeholder="请输入读者ID" class="form-control" value="<?php echo $result['id']; ?>"></div><br><br>
        <input type="submit" value="借阅" class="btn btn-default">
    </div>
</form>
</div>
</body>
</html>
<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $bid=$_GET['tsid'];
        $rid=$_POST['borrower'];

        $sqla="insert into lendinfo(book_id,r_id) values ({$bid},{$rid});";
        $sqlb="update books set state=0 where book_id={$bid};";
        $resa=mysqli_query($dbc,$sqla);
        $resb=mysqli_query($dbc,$sqlb);
        if($resa==1 && $resb==1)
            echo"<script>alert('借阅成功！');window.location.href='r_index.php'; </script>";
        else echo"<script>alert('借阅失败！');window.location.href='r_querybook.php'; </script>";
    }
?>