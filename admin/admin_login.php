<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台登录</title>
    <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/admin_login_css.css" rel="stylesheet">
</head>
<body>
<div id="login">
    <form action="../util/action.php?action=login" method="post">
        <input type="text" class="form-control login_input" name="username" placeholder="用户名">
        <input type="password" class="form-control login_input" name="password" placeholder="密码">
        <button type="submit" class="btn btn-primary login_input">登录</button>
    </form>
</div>
</body>
</html>