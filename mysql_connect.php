<?php
//链接数据库

header("Content-Type:text/html;charset=utf8");//header() 函数向客户端发送原始的 HTTP 报头，解决中文乱码。

DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', 'wjq20020915');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'bookadmin');

$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);//创建连接
//判断连接是否失败
if(!$dbc){
    die ('Could not connect to MySQL: ' . mysqli_connect_error());
}


?>
