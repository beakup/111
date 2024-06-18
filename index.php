<?php
//启动新会话或重用现有回话。记录登录信息，便于用户输入后做校验.session存储单一用户的信息，对所有页面可用
session_start();

if(isset($_SESSION['userid'])){
    unset($_SESSION['userid']);//unset释放在SESSION中注册的单个变量
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>图书管理系统 登录</title>

        <link rel="stylesheet" href="./layui/css/layui.css" media="all">
        <script src="./layui/js/layui.all.js" media="all"></script>
    </head>
    <body style="width:100%;height: 100%;background-image: url(img/0.jpg);background-size: auto 100%;overflow:hidden;">
    <div style="width: 550px;margin: 200px auto;border: 1px solid;background-color:rgba(255,255,255,0.7);">
        <h1 style="text-align: center;;margin-top: 5px">登录图书管理系统</h1>
        <br>
        <br>
        <br>
        <!-- 表单 ,action定义提交数据的地址文件-->
        <form name="addForm" class="layui-form" action="login.php" method="post" style="padding-right: 80px;">
            <!-- 表单项 -->
            <div class="layui-form-item"> 
                <label class="layui-form-label" style="font-size: 15px;">用户名 </label>
                <div class="layui-input-block">
                    <input type="text" name="account"  placeholder="请输入用户名" required lay-verify="required"
                        autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label" style="font-size: 15px;">密码 </label>
                <div class="layui-input-block">
                    <input type="password" name="pass" placeholder="请输入密码" required lay-verify="required"
                        autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="">
                <label class="layui-form-label" style="font-size: 15px;">验证码 </label>
                <div>
                    <input type="text" name="captcha" placeholder="请输入验证码" style="width:100px; height:30px;">
                    <img src="code.php" alt="" id="code_img">
                    <a href="" id="change">看不清，换一张</a>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label" style="font-size: 15px;">登录方式</label>
                <div class="layui-input-block">
                    <!-- radio单选，checkbox复选 -->
                    <input type="radio" name="role" value="stu" title="用户" checked>
                    <input type="radio" name="role" value="admin" title="管理员">
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" type="submit" id="denglu">登录</button>
                    <button class="layui-btn layui-btn-warm" onclick="window.location.href='register.php'">注册</button>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        layui.use(['form', 'laydate'], function () {
        });
        var change = document.getElementById("change");
        var img = document.getElementById("code_img");
        change.onclick = function()
        {
            img.src="code.php?t="+new Date();//增加一个随机参数，防止图片缓存
            return false;//阻止超链接的跳转动作
        }
    </script>
    <script type="text/javascript">
        // 正常显示单选框
        layui.use('form',function(){
            const form = layui.form;
            form.render();
        });
    </script>
    
    </body>
</html>