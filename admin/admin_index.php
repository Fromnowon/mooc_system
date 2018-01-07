<!DOCTYPE>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>后台管理系统</title>

    <script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/menu.js"></script>
    <link type="text/css" rel="stylesheet" href="./css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="./css/style.css"/>
    <link type="text/css" rel="stylesheet" href="./css/admin_css.css"/>
    <script type="text/javascript" src="./js/admin_js.js"></script>
    <script type="text/javascript" src="../util/util_js.js"></script>
    <link href="../css/loading.css" rel="stylesheet">
</head>

<body>
<div id="output"></div>
<?php
session_start();
$userinfo = $_SESSION['userinfo'];
if (!isset($userinfo['username'])) {
    //echo "<script language='JavaScript'>alert('非法访问，请登录！');</script>";
    //echo '点击此处 <a href="../login.php">返回</a> 重试';
    header("Location: ../login.php");
    exit();
} else if ($userinfo['flag'] < 1) {
    //echo "<script language='JavaScript'>alert('您的账号没有管理权限！');</script>";
    //echo '点击此处 <a href="../login.php">返回</a> 重试';
    header("Location: ../login.php");
    exit();
}
?>
<div id="header">
    <div class="logo">后台管理系统</div>
    <div class="navigation">
        <ul>
            <li>欢迎您！</li>
            <li><a href=""><?php echo $userinfo['username'] ?></a></li>
            <li><a href="">修改密码</a></li>
            <li><a href="">设置</a></li>
            <li><a href="../util/admin_action.php?admin_action=logout">退出</a></li>
        </ul>
    </div>
</div>
<div id="content">

    <div class="left_menu">
        <div id="userinfo">
            <div><img src="../avatar/<?php echo $userinfo['avatar'] ?>.png"></div>
            <p class="identity">身份：
                <?php
                if ($userinfo['flag'] == 1)
                    echo '管理员';
                else echo '超级管理员';
                ?>
            </p>
            <br/>
            <p class="date"></p>
            <p class="time"></p>
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
                    <a id="user_status" href="javascript:void(0)">状态监控</a>
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
        <div>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <strong>注意！</strong> 你的每个动作都可能会引起严重后果，请谨慎操作
            </div>
        </div>
        <div id="ajax_content">

        </div>

    </div>
</div>
<div id="footer"><p>Copyright© 2018 版权所有</p></div>
<script>navList(12);</script>
<!--加载遮罩-->
<?php
include '../util/loading.php';
?>
</body>
</html>
