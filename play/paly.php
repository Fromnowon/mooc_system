<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>播放页面</title>
    <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../util/util_js.js" type="text/javascript"></script>

    <link href="./css/play_css.css" rel="stylesheet">
    <script src="./js/play_js.js" type="text/javascript"></script>
</head>
<body>
<div class="play_header">
    <a href="">返回</a>
    <div class="paly_userinfo">

        <?php
        session_start();
        if (!isset($_SESSION['userinfo'])) {
            header("Location:login.php");
        } else {
            $userinfo = "<div class='paly_userinfo_avatar'><a class='history'>观看历史</a><img src='../avatar/" . $_SESSION['userinfo']['avatar'] . ".png'>";
            echo $userinfo . '<p class="paly_userinfo_name">' . $_SESSION['userinfo']['username'] . '</p></div>';
        }
        ?>

    </div>
</div>
<div class="play">
    <div class="player"></div>
    <div class="note"></div>
</div>
<div class="info">
    <div class="teacher_info"></div>
    <div class="course_info"></div>
</div>
</body>
</html>