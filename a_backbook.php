<?php
//记录登录信息，便于用户输入后做校验
session_start();
$userid=$_SESSION['userid'];
include ('mysql_connect.php');//引入

$bookid=$_GET['id'];//读取


$sql="update books set state=1 where book_id='{$bookid}';";
$sqla="delete from lendinfo where book_id='{$bookid}'";

$res=mysqli_query($dbc,$sql);
$resa=mysqli_query($dbc,$sqla);

if($res==1 && $resa==1) echo"<script>alert('还书成功！');window.location.href='a_books.php'; </script>";
else echo"<script>alert('还书失败！');window.location.href='a_books.php'; </script>";
?>