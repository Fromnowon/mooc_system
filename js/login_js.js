$(function () {
    //初始化布局
    uiSet();
    //实时校验表单
    formCheck();
    // 注册模块
    regModule();
    //杂项
    setMisc();

})
window.onbeforeunload = function (event) {
    setLoading('visible');
}

//遮罩控制
function setLoading(str) {
    var loading = $('#loading');
    loading.css('visibility', str);
}

//动态设置元素高度
$(window).resize(function () {
    var clientheight = $(this).height();
    var clientwidth = $(this).width();
    $("#container").css('height', $(this).height());
    var login_form = $("#login");
    login_form.css('left', clientwidth / 2 - 155).css('top', clientheight * 0.15);

    var footer = $("footer");
    footer.css('height', clientheight / 10);
    footer.css('padding-top', footer.height() * 0.4);

    var loading = $('#loading');
    loading.css('height', clientheight);
    loading.css('width', clientwidth);
});

function uiSet() {
    var clientheight = $(window).height();
    var clientwidth = $(window).width();
    var login_form = $("#login");
    var loading = $('#loading');
    login_form.css('left', clientwidth / 2 - 155).css('top', clientheight * 0.15);
    $("#container").css('height', clientheight);
    var footer = $("footer");
    footer.css('height', clientheight / 10);
    footer.css('padding-top', footer.height() * 0.4);
    //加载遮罩
    loading.css('height', clientheight);
    loading.css('width', clientwidth);
}

function formCheck() {
    var btn = $("#submit_btn");
    var login_username = $("#login_username");
    var login_password = $("#login_password");
    btn.attr('disabled', true);
    login_username.bind('blur keyup input', function () {
        tipHandler(login_username, login_password, 3);
        //console.log('username' + login_username.val().length);
    });
    login_password.bind('blur keyup input', function () {
        tipHandler(login_password, login_username, 3);
        //console.log('password' + login_password.val().length);
    });

    function tipHandler(object1, object2, min) {
        if (object1.val().length > 0 && object1.val().length < min) {
            btn.attr('disabled', true);
            object1.next().css('visibility', 'visible');
        }
        else {
            object1.next().css('visibility', 'hidden');
            if (object2.val().length >= min && object1.val().length >= min) {
                btn.attr('disabled', false);
                //btn.removeAttr('disabled');
            }
        }
    }
}

function regModule() {
    //控制弹出框可见状态
    $("#reg_btn").on("click", function () {
        $('#reg_modal').modal({backdrop: 'static'});
    });
    //绑定提交按钮
    $("#reg_submit").on('click', function () {
        //取出表单数据
        var reg_username = $("#reg_username");
        var reg_password = $("#reg_password");
        var reg_mail = $("#reg_mail");
        var reg_school = $("#reg_school");
        var reg_contact = $("#reg_contact");
        //拿到提示span
        var reg_tip = $(this).prevAll('span');
        //简单校验
        if (reg_username.val().length < 3 || reg_password.val().length < 3) {
            alert('用户名或密码长度必须不小于3，请检查');
        } else {
            //显示提交提示并防止重复提交
            reg_tip.html('正在提交，请稍候...');
            $(this).attr('disabled', true);
            //静默提交注册
            $.ajax({
                type: "post",
                url: "./util/action.php?action=register",
                data: {
                    reg_username: reg_username.val(),
                    reg_password: reg_password.val(),
                    reg_mail: reg_mail.val(),
                    reg_school: reg_school.val(),
                    reg_contact: reg_contact.val()
                },
                dataType: "text",
                success: function (msg) {
                    if (msg == 'OK') {
                        reg_tip.html('');
                        alert('注册成功！\n将为您自动填写登录信息');
                        //注册成功后自动填充数据
                        $("#login_username").val(reg_username.val());
                        $("#login_password").val(reg_password.val());
                        //关闭注册框,清空注册表单，并启用登陆按钮
                        $('#reg_modal').modal('hide');
                        $("#reg_form").find('input').val('');
                        $("#submit_btn").attr('disabled', false);;
                        //启用注册按钮
                        $("#reg_submit").attr('disabled', false);;
                    }
                    else
                        alert('ERROR!请联系管理员');
                },
                error: function (msg) {
                    alert("ERROR!");
                    //console.log("error:" + msg);
                }
            });
        }
    })
}

function setMisc() {
    //动态背景
    var victor = new Victor("container", "output");
    victor(["#18bbff", "#00486b"]).set();

    $("body").css('visibility', 'visible');
    $(".login_logo").hover(function () {
        $(this).shake(10, 20, 2000);
    }, function () {
        $(this).stop();
    })

    //处理回车
    //用户名回车跳到下一行
    $('#login_username').bind('keypress', function (event) {
        if (event.keyCode == "13") {
            $("#login_password").focus();
        }
    });
    //密码回车判断是否可以提交
    $('#login_password').bind('keypress', function (event) {
        //console.log($("#submit_btn").attr("disabled"));
        if (event.keyCode == "13") {
            var btn = $("#submit_btn");
            if (!btn.attr("disabled"))
                btn.trigger('click');
        }
    });
    //用户名密码都无焦点时回车判断提交
    $(document).bind('keypress', function (event) {
        if (!$('#login_username').is(':focus') && !$('#login_password').is(':focus') && !$("#submit_btn").attr("disabled")) {
            if (event.keyCode == "13") {
                $("#submit_btn").trigger('click');
            }
        }
    });

}

//异步登录
function ajaxLogin() {
    setLoading('visible');
    var login_username = $("#login_username").val();
    var login_password = $("#login_password").val();
    var logintoadmin = 0;
    if ($("#login_checkbox_logintoadmin").is(':checked')) logintoadmin = 1;
    else logintoadmin = 0;
    $.ajax({
        type: "post",
        url: "./util/action.php?action=login",
        data: {login_username: login_username, login_password: login_password, logintoadmin: logintoadmin},
        dataType: "html",
        success: function (msg) {
            setLoading('hidden');
            switch (msg) {
                case 'REFUSED': {
                    alert('您的账户没有管理权限');
                    break;
                }
                case 'WRONG': {
                    alert('用户名或密码错误');
                    break;
                }
                case 'NORMAL': {
                    $(location).attr('href', 'index.php');
                    break;
                }
                case 'ADMIN': {
                    $(location).attr('href', 'admin/admin_index.php');
                    break;
                }
                default: {
                    alert('未知错误');
                    break;
                }
            }
            //alert(msg);
            //console.log("DONE:" + msg);
        },
        error: function (msg) {
            alert(msg);
            //console.log("error:" + msg);
        }
    });
}

//抖动函数
jQuery.fn.shake = function (intShakes /*Amount of shakes*/, intDistance /*Shake distance*/, intDuration /*Time duration*/) {
    this.each(function () {
        var jqNode = $(this);
        jqNode.css({position: 'relative'});
        for (var x = 1; x <= intShakes; x++) {
            jqNode.animate({left: intDistance}, (((intDuration / intShakes) / 2)))
                .animate({left: 0}, (((intDuration / intShakes) / 2)))
        }
    });
    return this;
}