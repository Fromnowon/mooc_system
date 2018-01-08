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

    <link href="css/loading.css" rel="stylesheet">
    <script src="js/login_js.js" type="text/javascript"></script>
    <script type="text/javascript" src="./util/util_js.js"></script>
    <link href="css/login_css.css" rel="stylesheet">

</head>
<body style="visibility: hidden">

<div id="container">
    <div id="output"></div>
</div>
<!--登录模块-->
<div id="login">
    <img class="img-responsive login_logo" src="resource/doge.png"/>
    <div id="login_form">
        <input id="login_username" type="text" class="form-control login_input" placeholder="用户名">
        &nbsp;&nbsp;&nbsp;<span style="color: red;visibility: hidden">* 长度小于3字符</span>
        <input id="login_password" type="password" class="form-control login_input" placeholder="密码">
        &nbsp;&nbsp;&nbsp;<span style="color: red;visibility: hidden">* 长度小于3字符</span>
        <br/>
        <div id="checkbox_div">
            <table>
                <tr>
                    <td>
                        <div>
                            <label class="demo--label">
                                <input id="login_checkbox_remember" value="enable" class="demo--radio" type="checkbox"
                                       name="demo-checkbox1">
                                <span class="demo--checkbox demo--radioInput"></span>记住密码
                            </label>
                            <label class="demo--label">
                                <input id="login_checkbox_logintoadmin" value="enable" class="demo--radio"
                                       type="checkbox" name="demo-checkbox2">
                                <span class="demo--checkbox demo--radioInput"></span>登录后台
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
include './util/loading.php';
?>
</body>
</html>