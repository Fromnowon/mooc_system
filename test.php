<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>首页</title>
    <link rel="stylesheet" href="css/animate.css">
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/semantic.min.css">
    <script src="js/semantic.min.js"></script>
    <script src="js/granim.min.js"></script>

    <style>
        body {
            overflow: hidden;
        }

        button {
            width: 200px;
        }

        #canvas-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
        }
    </style>
</head>
<body>
<div style="position: relative;z-index: 999">
    <div class="ignored info ui message animated slideInDown" style="text-align: center;border-radius: 0;border-top: 0">
        <span class="tip">剩余项目将会陆续部署到线上。</span>
        <span style="color: orange;">请尽量使用Chrome内核浏览器，IE浏览器版本号应不低于9。</>
        <span style="color: red;">未优化移动端页面！</>

    </div>
    <div style="text-align: center" class="main ui container animated fadeInUp">
        <br><br>
        <br><br>
        <button class="ui button blue">实时调研系统</button>
        <br><br>
        <button class="ui button disabled">录像存档查询系统</button>
        <br><br>
        <button class="ui button blue">微课平台(重建中)</button>
        <br><br>
        <button class="ui button orange">Online Judge</button>
        <br><br>
        <button class="ui button blue">社团管理平台</button>
        <br><br>
        <button class="ui button blue">线上聊天室</button>
        <br><br>
        <button class="ui button disabled">我的博客(建设中)</button>
        <br><br>
        <a href="javascript:void(0)" class="log" style="color: red;font-weight: bold">查看更新记录</a>
    </div>

    <div class="ui small modal modal_chat">
        <div class="content">
            <h3>测试账号：</h3>
            <p>用户名：test</p>
            <p>密码：test123</p>
        </div>
        <div class="actions">
            <div class="ui negative deny button">
                关闭
            </div>
            <div class="ui positive right labeled icon button">
                前往
                <i class="checkmark icon"></i>
            </div>
        </div>
    </div>
    <div class="ui small modal modal_log">
        <div class="content">
            <p>
            <h3>2018.11.9</h3>1、重写了微课平台登录页并上线</p>
            <p>
            <h3>2018.11.8</h3>1、重写导航页，添加多个特技；2、调研系统增加附件上传、侧边栏导航</p>
        </div>
        <div class="actions">
            <div class="ui negative deny button">
                关闭
            </div>
        </div>
    </div>
</div>

<canvas id="canvas-bg"></canvas>

<script>
$(function () {
  $('.log').click(function () {
    $('.modal_log').modal('show');
  })

  var granimInstance = new Granim({
    element: '#canvas-bg',
    name: 'granim',
    opacity: [1, 1],
    states: {
      "default-state": {
        gradients: [
          ['#1CD8D2', '#93EDC7'],
          ['#9b6999', '#d693c3']
        ],
        transitionSpeed: 5000
      }
    }
  });

  $('button').click(function () {
    switch ($(this).text()) {
      case '实时调研系统':
        window.open('./content/my_class/');
        break;
      case '微课平台(重建中)':
        window.open('./content/mooc_system/');
        break;
      case 'Online Judge':
        window.open('http://47.107.131.235');
        break;
      case '社团管理平台':
        window.open('./content/association/');
        break;
      case '线上聊天室':
        $('.modal_chat')
          .modal({
            onApprove: function () {
              window.open('./content/desktop-test/');
            }
          })
          .modal('show')
        ;
        break;
    }
  })
})
</script>
</body>
</html>