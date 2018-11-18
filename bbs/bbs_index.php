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

    <script src="../util/util_js.js" type="text/javascript"></script>
    <link href="css/bbs.css" rel="stylesheet">
    <script src="js/bbs.js" type="text/javascript"></script>
</head>
<body>
<?php
//print_r($_SESSION['userinfo']);
?>
<div class="container">
    <?php
    echo "<br><p>当前登录用户：<span style='font-weight: bold'>{$_SESSION['userinfo']['username']}</span></p>";
    ?>
    <button class="btn btn-success" id="newpost" style="margin: 10px 0">发表主题</button>
    <div class="posts_list">
        <?php
        $r = all($conn, 'bbs', 'ORDER BY last_reply_date DESC');
        $post_list = '<table class="table table-striped">
                      <tr style="font-size: 18px;font-weight: bold">
                        <td>标题</td>
                        <td>发帖者</td>
                        <td>回复/点击</td>
                        <td>发表时间</td>
                        <td>最后回复</td>
                      </tr>';
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
</div>

<!-- Modal -->
<div class="modal fade" id="new_post" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">编辑内容</h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control new_post_title" placeholder="标题">
                <br>
                <textarea class="form-control new_post_content" rows="8" placeholder="内容"
                          style="resize: none"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                <button type="button" class="btn btn-primary" id="new_post_submit">提交</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>