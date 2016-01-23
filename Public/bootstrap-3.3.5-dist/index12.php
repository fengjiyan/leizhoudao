<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>轮播放图片</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        .carousel-inner img{margin:0 auto;}
        /*.item {background: none }*/
        .carousel-control{font-size: 140px;background-image: none !important;}
    </style>
</head>
<body>
    <nav class="nav navbar-default  navbar-fixed-top" style="">
        <div class="container-fluid">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand">
                    <img src="img/mylogo.png" alt="这是网址的logo" style="height: 50px;margin-top:-15px"/>
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">首页</a></li>
                    <li><a href="#">资讯</a></li>
                    <li><a href="#">产品</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">弹出菜单 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="">菜单一</a></li>
                            <li><a href="">菜单二</a></li>
                            <li><a href="">菜单三</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="navbar-form navbar-right">

                    <input type="text" class="form-control" placeholder="请输入关键字"/>
                    <button class="btn btn-primary">搜  索</button>
                    <a href="#" class="navber-link">登陆</a>
                    <a href="#" class="navber-link">注册</a>
                </div>
            </div>
        </div>
    </nav>
    <div style="height:50px"></div>
    <div class="carousel slide" id="myCarousel">
        <ol class="carousel-indicators">
            <li class="active" data-target="#myCarousel" data-slide-to="0"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="item active" style="background:#223240">
                <img src="img/slide1.png" alt=""/>
            </div>
            <div class="item" style="background:#F5E4DC;">
                <img src="img/slide2.png" alt=""/>
            </div>
            <div class="item" style="background:#DE2A2D;">
                <img src="img/slide3.png" alt=""/>
            </div>
        </div>
        <a href="#myCarousel" data-slide="prev" class="carousel-control left">&lsaquo;</a>
        <a href="#myCarousel" data-slide="next" class="carousel-control right">&rsaquo;</a>
    </div>
</body>
</html>
 <script>
     $(function(){
         $('.carousel-control').css('line-height' ,$('.carousel-inner img').height() + 'px');
         $(window).resize(function(){
             var $height =$('.carousel-inner img').eq(0).height()||
                         $('.carousel-inner img').eq(1).height()||
                         $('.carousel-inner img').eq(2).height();
             $('.carousel-control').css('line-height' ,$height + 'px');
         });

        // console.log($('.carousel-inner img').height());
     });
 </script>