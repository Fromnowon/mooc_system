<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <script src="js/index_js.js" type="text/javascript"></script>
    <link href="css/index_css.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <?php
    session_start();
    if (!isset($_SESSION['userinfo'])) {
        header("Location:login.php");
    } else {
        echo '<h3>欢迎您，' . $_SESSION['userinfo']['username'] . '</h3>';
    }
    ?>
    <div class="upload">
        <a href="./upload/upload.php" class="btn btn-primary">上传视频</a>
    </div>
</div>

</body>
</html>