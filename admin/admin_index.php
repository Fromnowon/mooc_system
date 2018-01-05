<!DOCTYPE>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>后台管理系统</title>

    <script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="./js/menu.js"></script>
    <link type="text/css" rel="stylesheet" href="./css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="./css/style.css"/>
    <link type="text/css" rel="stylesheet" href="./css/admin_css.css"/>
    <script type="text/javascript" src="./js/admin_js.js"></script>
</head>

<body>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script language='JavaScript'>alert('非法访问，请登录！');</script>";
    echo '点击此处 <a href="../login.php">返回</a> 重试';
    exit();
}
?>
<div id="header">
    <div class="logo">后台管理系统</div>
    <div class="navigation">
        <ul>
            <li>欢迎您！</li>
            <li><a href=""><?php echo $_SESSION['username'] ?></a></li>
            <li><a href="">修改密码</a></li>
            <li><a href="">设置</a></li>
            <li><a href="">退出</a></li>
        </ul>
    </div>
</div>
<div id="content">

    <div class="left_menu">
        <div id="userinfo" style="height: 200px;border: 3px red solid;margin: 10px 10px 50px 10px">
            这里准备放头像，用户组，hello什么的
        </div>

        <ul id="nav_dot">
            <li>
                <h4 class="M1"><span></span>课程管理</h4>
                <div class="list-item none">
                    <a href=''>状态监控</a>
                    <a href=''>占位</a>
                    <a href=''>占位</a>
                    <a href=''>占位</a>
                </div>
            </li>
            <li>
                <h4 class="M5"><span></span>课程审核</h4>
                <div class="list-item none">
                    <a href=''>上传审核</a>
                    <a href=''>申精审核</a>
                    <a href=''>举报审核</a>
                    <a href=''>占位</a>
                    <a href=''>占位</a>
                </div>
            </li>
            <li>
                <h4 class="M9"><span></span>留言管理</h4>
                <div class="list-item none">
                    <a href=''>留言浏览</a>
                    <a href=''>留言审核</a>
                    <a href=''>占位</a>
                </div>
            </li>
            <li>
                <h4 class="M10"><span></span>用户管理</h4>
                <div class="list-item none">
                    <a href=''>状态监控</a>
                    <a href=''>黑名单</a>
                    <a href=''>管理员</a>
                </div>
            </li>
            <li>
                <h4 class="M5" style="visibility: hidden"><span></span>调研问卷</h4>
                <div class="list-item none">
                    <a href=''>调研问卷1</a>
                    <a href=''>调研问卷2</a>
                    <a href=''>调研问卷3</a>
                </div>
            </li>
            <li>
                <h4 class="M6" style="visibility: hidden"><span></span>数据统计</h4>
                <div class="list-item none">
                    <a href=''>数据统计1</a>
                    <a href=''>数据统计2</a>
                    <a href=''>数据统计3</a>
                </div>
            </li>
            <li>
                <h4 class="M7" style="visibility: hidden"><span></span>奖励管理</h4>
                <div class="list-item none">
                    <a href=''>奖励管理1</a>
                    <a href=''>奖励管理2</a>
                    <a href=''>奖励管理3</a>
                </div>
            </li>
            <li>
                <h4 class="M8" style="visibility: hidden"><span></span>字典维护</h4>
                <div class="list-item none">
                    <a href=''>字典维护1</a>
                    <a href=''>字典维护2</a>
                    <a href=''>字典维护3</a>
                    <a href=''>字典维护4</a>
                    <a href=''>字典维护5</a>
                    <a href=''>字典维护6</a>
                    <a href=''>字典维护7</a>
                    <a href=''>字典维护8</a>
                    <a href=''>字典维护9</a>
                    <a href=''>字典维护4</a>
                    <a href=''>字典维护5</a>
                    <a href=''>字典维护6</a>
                    <a href=''>字典维护7</a>
                    <a href=''>字典维护8</a>
                    <a href=''>字典维护9</a>
                </div>
            </li>
            <li>
                <h4 class="M9" style="visibility: hidden"><span></span>内容管理</h4>
                <div class="list-item none">
                    <a href=''>内容管理1</a>
                    <a href=''>内容管理2</a>
                    <a href=''>内容管理3</a>
                </div>
            </li>
            <li>
                <h4 class="M10" style="visibility: hidden"><span></span>系统管理</h4>
                <div class="list-item none">
                    <a href=''>系统管理1</a>
                    <a href=''>系统管理2</a>
                    <a href=''>系统管理3</a>
                </div>
            </li>
        </ul>
    </div>
    <div id="right_content">
        这边就是显示对应功能内容区域
    </div>
</div>
<div id="footer"><p>Copyright© 2018 版权所有</p></div>
<script>navList(12);</script>
</body>
</html>
