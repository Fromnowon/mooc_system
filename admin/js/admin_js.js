$(function () {
    //时间模块
    setTimeShow();
    setInterval(function () {
        setTimeShow();
    }, 1000);

    //实现"用户监控"
    userStatus();

    //绑定各种按钮
    setBtn();

    //布局相关
    setMisc();
})

$(window).resize(function () {
    setUI($(this));
})

function setMisc() {
    setUI($(window));
    $('#user_edit_modal').on('hidden.bs.modal', function (e) {
        initEditModal();
    })
}

function setUI(obj) {
    var clientheight = obj.height();
    var clientwidth = obj.width();
    var loading = $('#loading');
    loading.css('height', clientheight);
    loading.css('width', clientwidth);
    $(".left_menu").css('height', clientheight);
}

function setBtn() {
}

function setLoading(toggle) {
    $("#loading").css('visibility', toggle);
}

function userStatus() {
    //点击了用户管理
    $("#user_status").on('click', function () {
        loadData(1, 'init');
    })
}

function setTimeShow() {
    $(".date").html(new Date().Format("yyyy-MM-dd"));
    $(".time").html("星期" + "日一二三四五六".charAt(new Date().getDay()) + ' ' + new Date().Format("HH:mm:ss"));
}

function loadData(page, action) {
    setLoading('visible');
    $.ajax({
        type: "post",
        url: "../util/admin_action.php?admin_action=user_status",
        //点击用户页面即显示第一页,动作标记为初始表格
        data: {page: page, action: action},
        dataType: "html",
        success: function (msg) {
            //alert("DONE!");
            if (action == 'init')
                $("#ajax_content").html(msg);
            else
                $("#result").next().empty().append(msg);
            setLoading('hidden');
            //console.log("DONE:" + msg);
        },
        error: function (msg) {
            alert("ERROR!");
            //console.log("error:" + msg);
        }
    });
}

function editData(action) {
    $("#user_edit_modal").modal({backdrop: 'static'});
    $("#data_edit_btn").unbind().on('click', function () {
        //简单校验
        if ($("#edit_username").val() == '' || $("#edit_password").val() == '') {
            alert('用户名或密码不能为空！');
            return false;
        }
        $(this).attr('disabled', true);
        //新增数据
        if (action == 'new') {
            var data = {
                action: action,
                username: $("#edit_username").val(),
                password: $("#edit_password").val(),
                flag: $("#edit_flag option:selected").val(),
                status: $("#edit_status option:selected").val(),
                realname: $("#edit_realname").val(),
                gender: $("#edit_gender option:selected").val(),
                contact: $("#edit_contact").val(),
                school: $("#edit_school").val(),
                introduction: $("#edit_introduction").val()
            };
        } else {

        }
        $.ajax({
            type: "post",
            url: "../util/admin_action.php?admin_action=edit_add",
            data: data,
            dataType: "text",
            success: function (msg) {
                switch (msg) {
                    case 'CONFLICT': {
                        alert('用户名已被占用，请重新输入');
                        break;
                    }
                    case 'ERROR': {
                        alert('服务器抽风，请联系管理员');
                        break;
                    }
                    case 'OK': {
                        alert("are you ok?Let's go");
                        $("#user_edit_modal").modal('hide');
                        initEditModal();
                        loadData(1, 'page');
                        break;
                    }
                    default: {
                        alert('未知错误，烫烫烫烫烫烫烫烫');
                        break;
                    }
                }
                $("#data_edit_btn").attr('disabled', false);
                //alert("DONE!");
                console.log("DONE:" + msg);
            },
            error: function (msg) {
                alert("ERROR!");
                //console.log("error:" + msg);
            }
        });
    })
}

function initEditModal() {
    var form = $("#user_edit_modal");
    form.find('input').val('');
    form.find('textarea').val('');
    $("#edit_status").val('1');
    $("#edit_gender").val('0');
    $("#edit_flag").val('0');
}