<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台登录</title>
    <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">


    <script src="../js/admin_login_js.js" type="text/javascript"></script>
    <link href="../css/admin_login_css.css" rel="stylesheet">


</head>
<body>
<div id="container">
    <div id="index_pic">

    </div>


</div>
<div id="login">
    <div id="form_bg"></div>
    <form action="../util/action.php?action=login" method="post">
        <input id="username" type="text" class="form-control login_input" name="username" placeholder="用户名">
        &nbsp;&nbsp;&nbsp;<span style="color: red;visibility: hidden">* 长度小于6字符</span>
        <input id="password" type="password" class="form-control login_input" name="password" placeholder="密码">
        &nbsp;&nbsp;&nbsp;<span style="color: red;visibility: hidden">* 长度小于6字符</span>
        <br/>
        <div id="checkbox_div">
            <table>
                <tr>
                    <td>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="">
                                记住密码
                            </label></div>
                    </td>
                    <td>
                        <div class="checkbox">
                            <label>&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" value="">
                                管理员登录
                            </label></div>
                    </td>
                </tr>
            </table>


        </div>
        <div id="btn_div">
            <a id="reg_btn" class="btn btn-default">注册</a>
            <button id="submit_btn" type="submit" class="btn btn-success">登录</button>
        </div>
    </form>
</div>
<div id="footer">
    <footer>2018 Designed by ZZH</footer>
</div>
</body>
</html>