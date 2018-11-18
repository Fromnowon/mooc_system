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
    $content = "<h3>{$r[0]['title']}</h3>";
    $content .= "<table class='post_table'>
<tr>
<td style='width: 100px'>

<table>
<tr>
<td style='text-align: center'><img class='user_avatar' src='../resource/avatar/" . $user_rs[0]['avatar'] . ".png'></td>
</tr>
<tr>
<td style='text-align: center;padding-top: 10px'>
<p>{$user_rs[0]['username']}</p>
</td>
</tr>
</table>

</td>
<td class='post_content_table' valign='top' style='position: relative'>
<p class='post_content'>{$r[0]['content']}</p>
<p class='position'>楼主</p>
<p class='create_date'>发表于：{$r[0]['create_date']}</p>
</td>
</tr>
</table>";

    //加载回复
    $rs = select($conn, 'bbs_reply', "relate_id=$id");
    $count = 2;
    foreach ($rs as $reply) {
        $user_rs = select($conn, 'user', "uid={$reply['uid']}");
        $content .= "<table class='post_table'>
<tr>
<td style='width: 100px'>

<table>
<tr>
<td style='text-align: center'><img class='user_avatar' src='../resource/avatar/" . $user_rs[0]['avatar'] . ".png'></td>
</tr>
<tr>
<td style='text-align: center;padding-top: 10px'>
<p>{$user_rs[0]['username']}</p>
</td>
</tr>
</table>

</td>
<td class='post_content_table' valign='top' style='position: relative'>
<p class='post_content'>{$reply['content']}</p>
<p class='position'><span><a name='{$user_rs[0]['username']}' class='reply_to' href='javascript:void(0)'>回复TA</a>&nbsp;&nbsp;&nbsp;</span>$count" . "楼</p>
<p class='create_date'>发表于：{$reply['date']}</p>
</td>
</tr>
</table>";
        $count++;
    }
    echo $content;
    ?>
    <!--回复框-->
    <div style="margin: 20px 0">
        <textarea class="form-control post_reply" rows="8" style="resize: none"></textarea>
        <button class="btn btn-primary post_reply_btn" style="width: 100px;margin:20px 0">回复</button>
    </div>
</div>
</body>
</html>