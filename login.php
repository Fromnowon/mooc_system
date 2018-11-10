<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
    <title>登录</title>
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="js/vector.js" type="text/javascript"></script>
    <script src="js/js.cookie.min.js" type="text/javascript"></script>
    <script src="js/semantic.min.js" type="text/javascript"></script>
    <link href="css/semantic.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">

    <script src="js/login_js.js" type="text/javascript"></script>
    <script type="text/javascript" src="./util/util_js.js"></script>
    <link href="css/login_css.css" rel="stylesheet">

</head>
<body style="visibility: hidden;overflow: hidden">
<div class="ui segment login_loader">
    <div class="ui active inverted dimmer">
        <div class="ui text loader">登录中...</div>
    </div>
    <p></p>
</div>
<!--登录模块-->
<!--<div class="login_bg"></div>-->
<div style="padding: 20px">
    <table>
        <tr>
            <td>
                <img class="img-responsive login_logo" src="resource/doge.png"/>
            </td>
            <td>
                <span style="font-size: 36px;padding-left: 20px">校内微课平台</span>
            </td>
        </tr>
    </table>
</div>
<div id="login">
    <div id="login_form">
        <div>
            <table style="margin: 0 auto">
                <tr>
                    <td>
                        <div class="ui left icon input">
                            <input id="login_username" type="text" class="form-control login_input" placeholder="用户名">
                            <i class="user icon"></i>
                        </div>
                        <span style="color: red;visibility: hidden">* 长度小于3字符</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="ui left icon input">
                            <input id="login_password" type="password" class="form-control login_input"
                                   placeholder="密码">
                            <i class="key icon"></i>
                        </div>
                        <span style="color: red;visibility: hidden">* 长度小于3字符</span>
                    </td>
                </tr>
            </table>
        </div>
        <div id="checkbox_div">
            <table>
                <tr>
                    <td>
                        <div>
                            <div class="ui checkbox">
                                <input id="login_checkbox_remember" value="enable" type="checkbox" tabindex="0" class="hidden">
                                <label>记住密码</label>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="ui checkbox">
                                <input id="login_checkbox_logintoadmin" value="enable" type="checkbox" tabindex="0" class="hidden">
                                <label>登录后台</label>
                            </div>
                        </div>
                        <br>
                    </td>
                </tr>
            </table>

        </div>
        <div id="btn_div">
            <a id="reg_btn" class="ui button green">注册</a>
            <a id="submit_btn" class="ui button primary" onclick="ajaxLogin()"> 登录</a>
        </div>
    </div>
</div>
<!--注册模块-->
<div class="ui modal small" id="reg_modal">
    <div class="header">
        注册
    </div>
    <div class="content">
        <form class="ui form" id="reg_form">
            <div class="field">
                <label class="form-label"><span style="color: red">* </span>用户名：</label>
                <input id="reg_username" type="text" placeholder="必填（长度不少于5）">
            </div>
            <div class="field">
                <label class="form-label"><span style="color: red">* </span>密码：</label>
                <input id="reg_password" type="password" class="form-control" placeholder="必填（长度不少于5）">
            </div>
            <div class="field">
                <label class="form-label"><span style="color: red">* </span>姓名（昵称）：</label>
                <input id="reg_realname" type="text" class="form-control" placeholder="必填">
            </div>
            <div class="field">
                <label class="form-label">邮箱：</label>
                <input id="reg_mail" type="text" class="form-control" placeholder="选填">
            </div>
            <div class="field">
                <label class="form-label">所在学校：</label>
                <input id="reg_school" type="text" class="form-control" placeholder="选填">
            </div>
            <div class="field">
                <label class="form-label">联系方式：</label>
                <input id="reg_contatct" type="text" class="form-control" placeholder="选填">
            </div>
            <div class="field">
                <div style="font-size: 14px;" class="hide">
                    <input type="checkbox" name="reg_teacher" value="1">
                    <span>我是教师<span style="color: red">（需审核）</span></span>
                </div>
            </div>
        </form>
    </div>
        <div class="actions" style="padding: 1.5rem 1rem;">
            <div class="ui negative deny button">
                关闭
            </div>
            <div class="ui button primary" id="reg_submit">提交</div>
        </div>
</div>
<div id="footer">
    <footer>2018 Designed by ZZH</footer>
</div>

<canvas id="Mycanvas"></canvas>
<script>
    //定义画布宽高和生成点的个数
    var WIDTH = window.innerWidth, HEIGHT = window.innerHeight, POINT = 25;

    var canvas = document.getElementById('Mycanvas');
    canvas.width = WIDTH,
        canvas.height = HEIGHT;
    var context = canvas.getContext('2d');
    context.strokeStyle = 'rgba(0,0,0,0.02)',
        context.strokeWidth = 1,
        context.fillStyle = 'rgba(0,0,0,0.05)';
    var circleArr = [];

    //线条：开始xy坐标，结束xy坐标，线条透明度
    function Line(x, y, _x, _y, o) {
        this.beginX = x,
            this.beginY = y,
            this.closeX = _x,
            this.closeY = _y,
            this.o = o;
    }

    //点：圆心xy坐标，半径，每帧移动xy的距离
    function Circle(x, y, r, moveX, moveY) {
        this.x = x,
            this.y = y,
            this.r = r,
            this.moveX = moveX,
            this.moveY = moveY;
    }

    //生成max和min之间的随机数
    function num(max, _min) {
        var min = arguments[1] || 0;
        return Math.floor(Math.random() * (max - min + 1) + min);
    }

    // 绘制原点
    function drawCricle(cxt, x, y, r, moveX, moveY) {
        var circle = new Circle(x, y, r, moveX, moveY)
        cxt.beginPath()
        cxt.arc(circle.x, circle.y, circle.r, 0, 2 * Math.PI)
        cxt.closePath()
        cxt.fill();
        return circle;
    }

    //绘制线条
    function drawLine(cxt, x, y, _x, _y, o) {
        var line = new Line(x, y, _x, _y, o)
        cxt.beginPath()
        cxt.strokeStyle = 'rgba(0,0,0,' + o + ')'
        cxt.moveTo(line.beginX, line.beginY)
        cxt.lineTo(line.closeX, line.closeY)
        cxt.closePath()
        cxt.stroke();

    }

    //初始化生成原点
    function init() {
        circleArr = [];
        for (var i = 0; i < POINT; i++) {
            circleArr.push(drawCricle(context, num(WIDTH), num(HEIGHT), num(15, 2), num(10, -10) / 40, num(10, -10) / 40));
        }
        draw();
    }

    //每帧绘制
    function draw() {
        context.clearRect(0, 0, canvas.width, canvas.height);
        for (var i = 0; i < POINT; i++) {
            drawCricle(context, circleArr[i].x, circleArr[i].y, circleArr[i].r);
        }
        for (var i = 0; i < POINT; i++) {
            for (var j = 0; j < POINT; j++) {
                if (i + j < POINT) {
                    var A = Math.abs(circleArr[i + j].x - circleArr[i].x),
                        B = Math.abs(circleArr[i + j].y - circleArr[i].y);
                    var lineLength = Math.sqrt(A * A + B * B);
                    var C = 1 / lineLength * 7 - 0.009;
                    var lineOpacity = C > 0.03 ? 0.03 : C;
                    if (lineOpacity > 0) {
                        drawLine(context, circleArr[i].x, circleArr[i].y, circleArr[i + j].x, circleArr[i + j].y, lineOpacity);
                    }
                }
            }
        }
    }

    //调用执行
    window.onload = function () {
        init();
        setInterval(function () {
            for (var i = 0; i < POINT; i++) {
                var cir = circleArr[i];
                cir.x += cir.moveX;
                cir.y += cir.moveY;
                if (cir.x > WIDTH) cir.x = 0;
                else if (cir.x < 0) cir.x = WIDTH;
                if (cir.y > HEIGHT) cir.y = 0;
                else if (cir.y < 0) cir.y = HEIGHT;

            }
            draw();
        }, 16);
    }

</script>
</body>
</html>