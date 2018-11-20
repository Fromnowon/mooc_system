<?php
session_start();
if (!isset($_SESSION['userinfo'])) {
    header("Location:../login.php");
}
include '../util/conn.php';
include '../util/sqlTool.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>贴子详情</title>
    <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="../js/semantic.min.js" type="text/javascript"></script>
    <link href="../css/semantic.min.css" rel="stylesheet">
    <script src="../js/wangEditor.js" type="text/javascript"></script>
    <link href="../css/wangEditor.css" rel="stylesheet">

    <script src="../util/util_js.js" type="text/javascript"></script>
    <link href="css/post_detail.css" rel="stylesheet">
    <script src="js/post_detail.js" type="text/javascript"></script>
</head>
<body>
<div class="post_body">
    <span class="postid" style="display: none"><?php echo $_GET['postid']; ?></span>
    <div style="margin-top: 20px;font-size: 16px">
        <a class="post_back" href="javascript:void(0)"><span class="glyphicon glyphicon-chevron-left"></span>返回</a>
    </div>
    <script>
        $('.post_back').on('click', function () {
            history.back();
        })
    </script>
    <?php
    $id = $_GET['postid'];
    $r = select($conn, 'bbs', "id=$id");

    //点击数+1
    update($conn, "bbs", 'view=view+1', "id=$id");

    $user_rs = select($conn, 'user', "uid={$r[0]['uid']}");
    $r[0]['content'] = htmlspecialchars_decode($r[0]['content']);
    $content = "<h2>{$r[0]['title']}</h2>";
    $content .= "<div class='ui card' style='width: 100%'>
<div class='content'>
<img class='avatar' src='../resource/avatar/0.png' alt=''>
<span style='font-weight: bold'>{$user_rs[0]['username']}</span>
</div>
<div class='content post_content'>{$r[0]['content']}</div>
<div class='extra content' style='text-align: right'>
<span style='margin-left: 10px'>楼主</span>
<span style='margin-left: 10px;color: darkgrey'>发表于：{$r[0]['create_date']}</span>
</div>
</div>";

    //加载回复
    $rs = select($conn, 'bbs_reply', "relate_id=$id");
    $count = 2;
    $content .= "<div class='ui comments'><h3 class='ui dividing header'>回复</h3>";
    foreach ($rs as $reply) {
        $user_rs = select($conn, 'user', "uid={$reply['uid']}");
        $content .= "<div class='comment'>
<span style='font-weight: bold'>{$user_rs[0]['username']}</span>
<span style='margin-left: 10px'>{$count}楼</span>
<span style='color: darkgrey;margin-left: 10px'>发表于：{$reply['date']}</span>
<a name='{$user_rs[0]['username']}' style='margin-left: 10px' class='reply_to' href='javascript:void(0)'>回复TA</a>
<div class='post_content content'>{$reply['content']}</div>
</div>";
        $count++;
    }
    echo $content . "</div>";
    ?>
    <!--回复框-->
    <div style="margin: 20px 0">
        <div class="form-control post_reply" id="reply_editor"></div>
        <button class="btn btn-primary post_reply_btn" style="width: 100px;margin:20px 0">回复</button>
    </div>
</div>
</body>
</html>