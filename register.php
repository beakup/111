<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理员注册</title>
    <!-- 链接样式表,layui框架导入 -->
    <link rel="stylesheet" href="./layui/css/layui.css"/>
    <script src="./layui/js/layui.js"></script>
</head>
<body style="background-image: url(img/8.jpg);background-repeat: no-repeat;background-size: 100%;width:100%;height: 100%;overflow-y:hidden;">
<div style="width: 550px;margin: 220px auto;border: 1px solid;background-color:rgba(255,255,255,0.8);">
    <h1 style="text-align: center;">管理员注册界面</h1>
    <br>
    <br>
    <br>
    <form name="addForm" class="layui-form" action="register.php" method="post" style="padding-right: 80px;">
        <div class="layui-form-item">
            <label class="layui-form-label" style="font-size: 15px;">账号</label>
            <div class="layui-input-block">
                <input type="text" name="aid" required lay-verify="required" placeholder="请输入账号(用户名)" maxlength="11" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label" style="font-size: 15px;">姓名</label>
            <div class="layui-input-block">
                <input type="text" name="nam" required lay-verify="required" placeholder="请输入姓名" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label" style="font-size: 15px;">密码</label>
            <div class="layui-input-block">
                <input type="password" name="pwd" required lay-verify="required" placeholder="请输入密码"
                       autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">确认密码</label>
            <div class="layui-input-block">
                <input type="password" name="cpwd" required lay-verify="required" placeholder="请确认密码" autocomplete="off" class="layui-input">
            </div>
        </div>


        <div style="height: 50px;"></div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <a class="layui-btn" href="index.php">返回登录</a>
                <button  type="submit" class="layui-btn" lay-submit lay-filter="formDemo">注册</button>
            </div>
        </div>
    </div>
    </form>
</div>

<script>
    layui.use(['form', 'laydate'], function () {
        var form = layui.form;
        var laydate = layui.laydate;
    });
</script>
</body>
</html>

<?php

include ('mysql_connect.php');

  if (empty($_POST)) {
    return;
  }

  if ($_POST['aid'] == '' || $_POST['pwd'] == '' || $_POST['cpwd'] == ''|| $_POST['nam'] == '') {
    echo "<script>alert('请填完所有项!!')</script>";
    return;
  }

  if ($_POST['pwd'] != $_POST['cpwd']) {
    echo "<script>alert('密码不一致!!')</script>";
    return;
  }

  $aid = $_POST['aid'];
  $pwd = $_POST['pwd'];
  $nam = $_POST['nam'];

  $sql = "INSERT INTO admin (admin_id, password,name) VALUES ('$aid', '$pwd','$nam')";
  $res =mysqli_query($dbc,$sql);

    if($res == 1){
    echo "<script>alert('注册成功!');window.location='index.php';</script>";
  }
  else {
    echo "<script>alert('注册失败!');</script>";
  }
 
  $dbc->close();
?>