<?php
session_start();
if (!isset($_SESSION['userinfo'])) {
    header("Location:../login.php");
}
//返回顶部块
function headerInfo()
{
    $userinfo = "<div class='play_userinfo_avatar'><a class='history'>观看历史</a><img src='../avatar/" . $_SESSION['userinfo']['avatar'] . ".png'>";
    echo $userinfo . '<p class="play_userinfo_name">' . $_SESSION['userinfo']['username'] . '</p></div>';

}

include '../util/conn.php';
$courseID = $_GET['playid'];
$sql = "select * from course where id='" . $courseID . "'";
$rs = mysqli_fetch_array(mysqli_query($conn, $sql));
//返回标题
function titleInfo()
{
    global $courseID;
    global $rs;
    if ($rs['title'] == '' || $rs['title'] == null) echo "<span value='$courseID'>未命名</span>";
    else echo "<span value='$courseID'>" . $rs['title'] . "</span>";
}

//返回视频地址
function courseSource()
{
    global $rs;
    echo '<source src="http://172.96.222.54' . $rs['path'] . '"type="video/mp4"/>';
}

?>
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
<div class="play_header fadeInDown animated">
    <a href="../index.php">返回</a>
    <div class="play_userinfo">
        <?php headerInfo(); ?>
    </div>
</div>
<div class="play">
    <div class="title">
        <h2 class="course_title"><?php titleInfo(); ?></h2>
    </div>
    <table class="play_table">
        <tr>
            <td class="player_bg  fadeInLeft animated">
                <div class="player">
                    <video width="900px" id="course_player" class="video-js vjs-big-play-centered"
                           controls preload="none"
                           data-setup='{ "aspectRatio":"640:267", "playbackRates": [1, 1.5, 2] }'>
                        <?php courseSource() ?>
                    </video>
                </div>
            <td>
                <div class="note fadeInRight animated">
                    <div class="note_main">
                        <div class="note_content_show">

                        </div>
                        <button class="btn btn-primary" id="new_note">添加</button>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="info">
    <div class="teacher_info fadeInRight animated"></div>
    <div class="course_info fadeInLeft animated"></div>
</div>
<div class="reply  fadeInRight animated">

</div>
<div class="note_pop" style="display: none">
    <input type="text" class="form-control note_title" placeholder="标题">
    <textarea class="form-control note_content" rows="4" style="resize: none" placeholder="内容"></textarea>
    <div style="text-align: right">
        <a href="javascript:void(0)" class="note_pop_dismiss">取消</a>
        <span>&nbsp;&nbsp;&nbsp;</span>
        <button class="btn btn-default btn-sm note_save">保存</button>
    </div>
</div>
</body>
</html>