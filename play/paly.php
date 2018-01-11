<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>播放页面</title>
    <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../util/util_js.js" type="text/javascript"></script>
    <link href="css/video-js.min.css" rel="stylesheet">
    <script src="js/video.min.js" type="text/javascript"></script>
    <link href="../css/animate.css" rel="stylesheet">

    <link href="./css/play_css.css" rel="stylesheet">
    <script src="./js/play_js.js" type="text/javascript"></script>
</head>
<body>
<div class="play_header bounceInUp animated">
    <a href="../index.php">返回</a>
    <div class="play_userinfo">

        <?php
        session_start();
        if (!isset($_SESSION['userinfo'])) {
            header("Location:../login.php");
        } else {
            $userinfo = "<div class='play_userinfo_avatar'><a class='history'>观看历史</a><img src='../avatar/" . $_SESSION['userinfo']['avatar'] . ".png'>";
            echo $userinfo . '<p class="play_userinfo_name">' . $_SESSION['userinfo']['username'] . '</p></div>';
        }
        ?>

    </div>
</div>
<div class="play">
    <div class="title">
        <h2 class="course_title">论持久战——深度解析</h2>
    </div>
    <table class="play_table">
        <tr>
            <td>
                <div class="player bounceInLeft animated">
                    <video width="900px" id="myPlayer" class="video-js vjs-big-play-centered"
                           controls preload="none"
                           data-setup='{ "aspectRatio":"640:267", "playbackRates": [1, 1.5, 2] }'>
                        <source src="http://172.96.222.54<?php
                        include '../util/conn.php';
                        $sql="select * from course where id='".$_GET['playid']."'";
                        echo mysqli_fetch_array(mysqli_query($conn,$sql))['path'];
                        //echo $sql;
                        mysqli_close($conn);
                        ?>" type='video/mp4'/>
                    </video>
                </div>
            </td>
            <td>
                <div class="note bounceInRight animated">做笔记的区域</div>
            </td>
        </tr>
    </table>
</div>
<div class="info">
    <div class="teacher_info bounceInRight animated"></div>
    <div class="course_info bounceInLeft animated"></div>
</div>
<div class="reply  bounceInRight animated">

</div>
</body>
</html>