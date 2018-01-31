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


//动态设置元素高度
$(window).resize(function () {
    var clientheight = $(this).height();
    var clientwidth = $(this).width();
    $("#container").css('height', $(this).height());
    var login_form = $("#login");
    login_form.css('left', clientwidth / 2 - 155).css('top', clientheight * 0.12);
    login_bg(login_form);

    var footer = $("footer");
    footer.css('height', 30);
    //footer.css('padding-top', footer.height() * 0.4);


});

function uiSet() {
    var clientheight = $(window).height();
    var clientwidth = $(window).width();
    var login_form = $("#login");
    login_form.css('left', clientwidth / 2 - 155).css('top', clientheight * 0.07);
    $("#container").css('height', clientheight);
    var footer = $("footer");
    footer.css('height', 30);

    login_bg(login_form);

}

function login_bg(login_form) {
    //login背景
    $(".login_bg").css({
        'width': login_form.width() + 10,
        'height': login_form.height() + 20,
        'z-index': 1,
        'top': login_form.offset().top - 10,
        'left': login_form.offset().left
    });
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
        var reg_realname = $("#reg_realname");
        var reg_mail = $("#reg_mail");
        var reg_school = $("#reg_school");
        var reg_contact = $("#reg_contact");
        //拿到提示span
        var reg_tip = $(this).prevAll('span');
        //简单校验
        if (reg_username.val().length < 3 || reg_password.val().length < 3) {
            alert('用户名或密码长度必须不小于3，请检查');
        } else if (reg_realname.val().length < 1) {
            alert('写个名字或者昵称吧');
        }
        else {
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
                    reg_realname: reg_realname.val(),
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
                        $("#submit_btn").attr('disabled', false);
                        ;
                        //启用注册按钮
                        $("#reg_submit").attr('disabled', false);
                        ;
                    }
                    else
                        alert('ERROR!请联系管理员');
                    console.log(msg);
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
    $("body").css('visibility', 'visible');

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

    //读取cookie
    if (Cookies.get('username') != undefined) {
        $("#login_username").val(Cookies.get('username'));
        $("#login_password").val(Cookies.get('password'));
        $("#login_checkbox_remember").prop('checked','checked');
        $("#submit_btn").removeAttr('disabled');
    }
}

//异步登录
function ajaxLogin() {
    if (typeof($("#submit_btn").attr("disabled")) != "undefined") return false;
    var login_username = $("#login_username").val();
    var login_password = $("#login_password").val();

    //记住用户信息
    if ($("#login_checkbox_remember").is(":checked")) {
        Cookies.set('username', login_username, {expires: 7});
        Cookies.set('password', login_password, {expires: 7});
    } else {
        Cookies.remove('username');
        Cookies.remove('password');
    }

    if ($("#login_checkbox_logintoadmin").is(':checked'))
        var logintoadmin = 1;
    else
        var logintoadmin = 0;
    $.ajax({
        type: "post",
        url: "./util/action.php?action=login",
        data: {login_username: login_username, login_password: login_password, logintoadmin: logintoadmin},
        dataType: "html",
        success: function (msg) {
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
                    console.log(msg);
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
