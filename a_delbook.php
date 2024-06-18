<?php
//记录登录信息，便于用户输入后做校验
session_start();
$userid=$_SESSION['userid'];
include ('mysql_connect.php');//引入


$delid=$_GET['id'];//读取
$sqla="select state a from books where book_id={$delid};";
$resa=mysqli_query($dbc,$sqla);
$resulta=mysqli_fetch_array($resa);

if($resulta['a']==1) {
    $sql = "delete from books where book_id={$delid} ;";
    $res = mysqli_query($dbc, $sql);

    if ($res == 1) {
        echo "<script>alert('删除成功！')</script>";
        echo "<script>window.location.href='a_books.php'</script>";
    }
    else {
        echo "删除失败！";
        echo "<script>window.location.href='a_books.php'</script>";
    }
}
else {
    echo "<script>alert('不能删除该图书！')</script>";
    echo "<script>window.location.href='a_books.php'</script>";
}

?>
