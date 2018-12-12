<?php
include 'playHandler.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>播放页面</title>
    <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <link href="../css/semantic.min.css" rel="stylesheet">
    <script src="../js/semantic.min.js" type="text/javascript"></script>
    <script src="../util/util_js.js" type="text/javascript"></script>
    <link href="css/video-js.min.css" rel="stylesheet">
    <script src="js/video.min.js" type="text/javascript"></script>
    <link href="../css/animate.css" rel="stylesheet">
    <script src="js/jquery.star-rating-svg.min.js" type="text/javascript"></script>
    <link href="css/star-rating-svg.css" rel="stylesheet">
    <script src="js/plyr.js" type="text/javascript"></script>
    <link href="css/plyr.css" rel="stylesheet">

    <link href="./css/play_css.css" rel="stylesheet">
    <script src="./js/play_js.js" type="text/javascript"></script>
</head>
<body>
<!--<div style="width: 900px;height: 900px;position: absolute">-->
<!--    <canvas id="canvas"></canvas>-->
<!--</div>-->
<div class="container">
    <div class="hide">
        <span class="courseID"><?php echo $courseID;?></span>
    </div>
    <div style="z-index: 2;position: relative">
        <div class="player_note_div">
            <div class="player_bg slideInDown animated">
                <video id="player" class="player" poster="../<?php courseSource('cover') ?>" controls>
                    <?php courseSource('path') ?>
                    <!-- Captions are optional -->
                </video>
            </div>
        </div>

        <div class="info fadeInUp animated" style="display: block">
            <div class="course_info">
                <div style="max-width: 80%;margin: 0 auto">
                    <?php courseInfo(); ?>
                </div>
            </div>
        </div>
        <div class="reply fadeInUp animated" style="display: block">
            <div class="reply_new" style="width: 80%;margin: 30px auto 30px">
                <form class="ui reply form">
                    <div class="field">
                        <textarea style="resize: none"></textarea>
                    </div>
                    <div style="float: right">
                        <span class="reply_new_limit"></span>
                        <span> /200</span>
                    </div>

                    <div class="ui blue labeled submit icon button">
                        <i class="icon edit"></i>添加回复
                    </div>
                </form>
                <!--                <textarea class="ui reply form" rows="6" style="resize: none" placeholder="说说你的想法呗"></textarea>-->
                <!--                <br/>-->
                <!--                <div style="text-align: right">-->
                <!--                    <span style="color: blue" class="reply_new_limit"></span>-->
                <!--                    <span>/200&nbsp;&nbsp;&nbsp;</span>-->
                <!--                    <button class="btn btn-primary">发表主题</button>-->
                <!--                </div>-->
                <!--                <hr/>-->
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
</div>

</body>
</html>