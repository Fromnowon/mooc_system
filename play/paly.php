<?php
include 'playHandler.php';
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
    <script src="js/jquery.star-rating-svg.min.js" type="text/javascript"></script>
    <link href="css/star-rating-svg.css" rel="stylesheet">

    <link href="./css/play_css.css" rel="stylesheet">
    <script src="./js/play_js.js" type="text/javascript"></script>
</head>
<body>
<div>
    <div class="play_header fadeInDown animated">
        <a href="../index.php">返回</a>
        <div class="play_userinfo">
            <?php headerInfo(); ?>
        </div>
    </div>
    <div class="play">
        <table class="play_table">
            <tr>
                <td>
                    <div class="title">
                        <h2 class="course_title"><?php titleInfo(); ?></h2>
                    </div>
                </td>
            </tr>
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
                    <div class="note fadeInRight animated" style="overflow-y: auto;overflow-x: hidden;display: block">
                        <div class="note_main">
                            <button class="btn btn-primary" id="new_note">添加笔记</button>
                            <div class="note_content_show">
                                <?php loadNote() ?>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="info" style="display: block">
        <div class="course_info fadeInLeft animated">
            <?php courseInfo(); ?>
        </div>
        <div style="height: 10px"></div>
        <div class="teacher_info fadeInRight animated">
            <?php teacherInfo(); ?>
        </div>
    </div>
    <div class="reply fadeInUp animated" style="display: block">
        <div class="reply_new" style="width: 70%;margin: 30px auto 30px">
            <textarea class="form-control" rows="6" style="resize: none"></textarea>
            <br/>
            <div style="text-align: right">
                <button class="btn btn-primary">发表回复</button>
            </div>
            <br/>
        </div>
        <div class="reply_floor">
            <?php loadReply(); ?>
        </div>
    </div>

    <div class="note_pop" style="display: none">
        <input type="text" class="form-control note_title" placeholder="标题">
        <textarea class="form-control note_content" rows="4" style="resize: none" placeholder="内容"></textarea>
        <div style="text-align: right">
            <a href="javascript:void(0)" class="note_pop_clear" style="color: red">清空</a>
            <span>&nbsp;&nbsp;&nbsp;</span>
            <a href="javascript:void(0)" class="note_pop_dismiss">取消</a>
            <span>&nbsp;&nbsp;&nbsp;</span>
            <button class="btn btn-default btn-sm note_save">保存</button>
        </div>
    </div>
</div>

</body>
</html>