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
    <title>讨论版</title>
    <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="../js/semantic.min.js" type="text/javascript"></script>
    <link href="../css/semantic.min.css" rel="stylesheet">
    <script src="../js/wangEditor.js" type="text/javascript"></script>
    <link href="../css/wangEditor.css" rel="stylesheet">

    <script src="../util/util_js.js" type="text/javascript"></script>
    <link href="css/bbs.css" rel="stylesheet">
    <script src="js/bbs.js" type="text/javascript"></script>
</head>
<body>
<?php
//print_r($_SESSION['userinfo']);
?>
<div class="ui container">
    <div class="posts_list">
        <?php
        $r = all($conn, 'bbs', 'ORDER BY last_reply_date DESC');
        $post_list = '<table class="table ui selectable">
                      <thead><tr>
                        <th>标题</th>
                        <th>发帖者</th>
                        <th>回复/点击</th>
                        <th>发表时间</th>
                        <th>最后回复</th>
                      </tr></thead>';
        foreach ($r as $post) {
            //查询uid对应信息
            $userinfo = select($conn, 'user', "uid={$post['uid']}");
            $post_list .= "<tr>
                        <td class='title'>
                            <a href='post_detail.php?postid={$post['id']}'>{$post['title']}</a>
                        </td>
                        <td class='username'>
                            {$userinfo[0]['username']}
                        </td>
                        <td class='partake'>
                            {$post['reply']}" . " / " . "{$post['view']}
                        </td>
                        <td class='create_date'>
                            {$post['create_date']}
                        </td>
                        <td class='last_date'>
                            {$post['last_reply_date']}
                        </td>
                    </tr>";
        }
        $post_list .= '</table>';
        echo $post_list;
        ?>
    </div>
    <br>
    <button class="ui button primary" id="newpost"><i class="icon edit"></i>发表主题</button>
    <br><br>
    <div class="bbs_editor">
        <div class="ui input labeled">
            <div class="ui label">标题</div>
            <input type="text" class="post_title_input"/>
        </div>
        <br><br>
        <div class="new_post_content" id="editor"></div>
        <br>
        <button type="button" class="ui button positive" id="new_post_submit">提交</button>
        <br><br>
    </div>
</div>

</body>
</html>