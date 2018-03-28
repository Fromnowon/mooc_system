<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
    <title>登录</title>
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/vector.js" type="text/javascript"></script>
    <script src="js/js.cookie.min.js" type="text/javascript"></script>

    <script src="js/login_js.js" type="text/javascript"></script>
    <script type="text/javascript" src="./util/util_js.js"></script>
    <link href="css/login_css.css" rel="stylesheet">

</head>
<body style="visibility: hidden;overflow: hidden">
<!--登录模块-->
<!--<div class="login_bg"></div>-->
<div id="login">
    <br>
    <div style="text-align: center"><p style="font-size: 24px">校内微课平台</p></div>
    <img class="img-responsive login_logo" src="resource/logo.png"/>
    <div id="login_form">
        <div>
            <table style="margin: 0 auto">
                <tr>
                    <td>
                        <div style="position: relative">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            <input id="login_username" type="text" class="form-control login_input" placeholder="用户名">
                            &nbsp;&nbsp;&nbsp;<span style="color: red;visibility: hidden">* 长度小于3字符</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="position: relative">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            <input id="login_password" type="password" class="form-control login_input"
                                   placeholder="密码">
                            &nbsp;&nbsp;&nbsp;<span style="color: red;visibility: hidden">* 长度小于3字符</span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div id="checkbox_div">
            <table>
                <tr>
                    <td>
                        <div>
                            <label class="demo--label">
                                <input id="login_checkbox_remember" value="enable" class="demo--radio" type="checkbox"
                                       name="demo-checkbox1">
                                <span class="demo--checkbox demo--radioInput"></span><span>记住密码</span>
                            </label>
                            <label class="demo--label">
                                <input id="login_checkbox_logintoadmin" value="enable" class="demo--radio"
                                       type="checkbox" name="demo-checkbox2">
                                <span class="demo--checkbox demo--radioInput"></span><span>登录后台</span>
                            </label>
                        </div>
                        <br/><br/>
                    </td>
                </tr>
            </table>

        </div>
        <div id="btn_div">
            <a id="reg_btn" class="btn btn-default">注册</a>
            <a id="submit_btn" class="btn btn-primary" onclick="ajaxLogin()"> 登录</a>
        </div>
    </div>
</div>
<!--注册模块-->
<?php
include('./util/register.php');
?>
<div id="footer">
    <footer>2018 Designed by ZZH</footer>
</div>
<?php
if (strpos($_SERVER['HTTP_USER_AGENT'], "Triden")) {
    echo '<script>
    setTimeout(function () {
        $("#ie_error").modal({backdrop: \'static\'});
    },2000);
    </script>';
}
?>
</body>
</html>