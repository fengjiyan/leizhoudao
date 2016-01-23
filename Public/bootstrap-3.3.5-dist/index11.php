<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>第一次使用bootstrap</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
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
    <div style="height: 70px"></div>
    <div class="container-fluid">
        <div class="list-group" >

              <div class="col-md-9">
                  <?php for($i = 0;$i<8;$i++) :?>
                <div class="list-group-item" style="border:none;color: #8c8c8c">
                    <a href="#"><h4>ajQuery之Bootstrap基础精解视频课程</h4></a>
                    <p>
                        <smal>发布时间:2015-12-7</smal>
                        <smal class="pull-right">
                            点击率 <span class="badge">20</span>
                        </smal>
                    </p>
                    <p>Bootstrap是一款强大的UI库，是目前最受欢迎的前端框架。Bootstrap 基于 HTML、CSS、JAVASCRIPT 的，简洁灵活，使得 Web 开发更加快捷。本教程将讲解 Bootstrap 框架的基础，通过学习这些内容，使学员能够轻松地创建 Web 项目。该教程通过简单有用的实例讲解包含 Bootstrap 基本结构、Bootstrap CSS、Bootstrap 布局组件和 ...
                        适用人群：Boostrap初学者，前端开发者</p>
                    <p>
                        <span class="badge">新闻</span> <span class="badge">学习</span> <span class="badge">资讯</span>
                    </p>
                </div>
                <div style="border:1px dotted #ccc"></div>
                  <?php endfor;?>
                  <div class="text-center">
                      <ul class="pagination">
                          <li><a href="">&lt;&lt;</a></li>
                          <li><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="">&gt;&gt;</a></li>
                      </ul>
                  </div>
            </div>

                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            推荐新闻
                        </div>
                        <div class="panel-body">
                            <strong class="panel-title"><a class="text-muted" href="#">李炎恢动开发之Bootstrap视频教程</a></strong>
                            <p>Bootstrap是一款强大的UI库，是目前最受欢迎的...</p>
                        </div>
                    </div>
                    <div class="panel panel-default panel-info">
                        <div class="panel-heading">
                            热点资讯 <span class="pull-right"><a href="#" class="text-muted">更多&gt;&gt;</a></span>
                        </div>
                            <ul class="list-group" >
                                <?php for($i = 0;$i<8;$i++) :?>
                                <li class="list-group-item" style="border:0;line-height: 15px;"><a class="text-muted" href="#">非要试大陆决心定奉陪到底</a></li>
                                <?php endfor;?>
                            </ul>
                    </div>
                    <div class="panel panel-default panel-primary">
                        <div class="panel-heading">
                            推荐视频 <span class="pull-right"><a href="#" class="text-muted">更多&gt;&gt;</a></span>
                        </div>
                            <ul class="media-list" style="margin:10px">
                                <?php for($i = 0;$i<3;$i++) :?>
                                <li>
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="img/2.png" alt="" class="media-object"/>
                                        </div>
                                        <div class="media-body">
                                            <strong><a href="#">大力推荐互联网发展</a></strong>
                                            <p>该教程通过简单有用的实例讲解包含 Bootst..</p>
                                        </div>
                                    </div>
<!--                                    <div style="border-bottom: 1px dashed #ccc"></div>-->
                                </li>
                                <?php endfor;?>
                            </ul>
                    </div>
                    <a href="#" class="thumbnail">
                        <img src="img/pic.png" alt=""/>
                    </a>
                </div>
        </div>
    </div>

    <footer class="navbar-default text-center navbar-fixed-bottom">这是底部</footer>
    <div style="height: 1500px;"></div>
</body>
</html>
 <script>
    $('#mytab a:last').tab('show');
 </script>