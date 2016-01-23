<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>欢迎您的注册--雷州岛网</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/mycss.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/my.js"></script>
    <script>
        $().ready(function() {
            $("#signupForm").validate();
        });
    </script>
</head>
<body>
    <header class="container">
        <div class="login-logo">
            <a href="#"><img src="img/register-logo.png" alt=""/></a>
        </div>
        <span class="pull-right logo-text">
            我已经注册，现在就 <a href="#" class="red">登录</a>
        </span>
    </header>
    <section class="container register">
        <form action="" role="form" id="signupForm" class="form-horizontal">
            <h2>欢迎你的加入 </h2>
            <div class="form-group">
                <label for="name" class="control-label"><span class="red">* </span>用户名</label>
                <input type="text" class="form-control" placeholder="请输入用户名"/>
            </div>
            <div class="form-group">
                <label for="name" class="control-label"><span class="red">* </span>请设置密码</label>
                <input type="password" class="form-control wid250"/>
            </div>
            <div class="form-group">
                <label for="name" class="control-label"><span class="red">* </span>请确认密码</label>
                <input type="password" class="form-control wid250"/>
            </div>
            <div class="form-group">
                <label for="name" class="control-label"><span class="red">* </span>验证手机</label>
                <input type="text" class="form-control wid250"/>
            </div>
            <div class="form-group">
                <label for="name" class="control-label"><span class="red">* </span>验证码</label>
                <input type="text" class="form-control" style="width: 60px;margin-right:15px"/>
                <a href=""><img src="img/code.gif" alt=""/></a>
                <span>看不清楚？</span><a href="#">换一张</a>
            </div>
            <div class="form-group">
                <label for="name" class="control-label"><span class="red">* </span>短信验证码</label>
                <input type="text" class="form-control" style="width: 60px;margin-right:15px"/>
                <button class="btn btn-default">获取短信验证码</button>
            </div>
            <div class="form-group">
                <label for="name" class="control-label">&nbsp;</label>
                <input type="checkbox" name="" id="" checked="checked"/>我已阅读并同意 <span class="songti">&lt;&lt;</span><a href="">协议</a><span class="songti">&gt;&gt;</span>
            </div>
            <div class="form-group">
                <label for="name" class="control-label"></label>
                <button class="btn btn-warning">立即注册</button>
            </div>
        </form>
    </section>
    <footer class="container">
        <section class="text-center my-copy">
            <a href="#">关于我们</a> |
            <a href="#">广告合作</a> |
            <a href="#">联系我们</a>
            <p>版权所有@ 备案粤2015ICOH33 leizhoudao.com</p>
        </section>
    </footer>
</body>
</html>
