<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/vector.js" type="text/javascript"></script>

    <link href="css/loading.css" rel="stylesheet">
    <script src="js/login_js.js" type="text/javascript"></script>
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
        <br/><br/>
        <div id="checkbox_div">
            <table>
                <tr>
                    <td>
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success">
                                <input type="checkbox" id="login_checkbox_remember" value="enable" autocomplete="off">记住密码
                            </label>
                            <label class="btn btn-success">
                                <input type="checkbox" id="login_checkbox_logintoadmin" value="enable"
                                       autocomplete="off">登录后台
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
include('register.php');
?>
<div id="footer">
    <footer>2018 Designed by ZZH</footer>
</div>
<div id="loading" style="visibility: hidden">
    <div id="loading_main">
        <div class="loading">
            <div><span></span></div>
            <div><span></span></div>
            <div><span></span></div>
        </div>
        <br/><br/><br/><br/><br/><br/><br/><br/>
        <div id="load">
            <div>G</div>
            <div>N</div>
            <div>I</div>
            <div>D</div>
            <div>A</div>
            <div>O</div>
            <div>L</div>
        </div>
    </div>
</div>
</body>
</html>