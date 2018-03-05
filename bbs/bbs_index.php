<?php
session_start();
if (!isset($_SESSION['userinfo'])) {
    header("Location:../login.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>讨论版</title>
    <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>

    <link href="bbs.css" rel="stylesheet">
    <script src="bbs.js" type="text/javascript"></script>
</head>
<body>
<?php
print_r($_SESSION['userinfo']);
?>
<div class="container">
    <button class="btn btn-success" id="newpost">发表主题</button>
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