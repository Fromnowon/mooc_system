$(function () {
    //时间模块
    setTimeShow();
    setInterval(function () {
        setTimeShow();
    }, 1000);

    //实现"用户监控"
    userStatus();

    //实现课程监控
    courseStatus();

    //布局相关
    setMisc();
})

$(window).resize(function () {
    setUI();
})

function courseStatus() {
    $("#course_status").on('click', function () {
        loadCourse(1, 'init');
    })
}

function loadCourse(page, action) {
    setLoading('visible');
    $.ajax({
        type: "post",
        url: "../util/admin_action.php?admin_action=course_status",
        //点击用户页面即显示第一页,动作标记为初始表格
        data: {page: page, action: action},
        dataType: "html",
        success: function (msg) {
            //加载页面完成后绑定事件
            loadCourseComplete(msg, page, action);
            //alert("DONE!");
            //console.log("DONE:" + msg);
        },
        error: function (msg) {
            alert("ERROR!");
            //console.log("error:" + msg);
        }
    });
}

function loadCourseComplete(msg, page, action) {
    if (action == 'init')
        $("#ajax_content").html(msg);
    else
        $("#result").next().empty().append(msg);
    setLoading('hidden');

    //生成表格后绑定点击事件
    $("tr").on('click', function () {
        //打开弹窗并传递行对象、所对应数据的uid
        editData('edit', $(this).children(':first-child').html(), $(this));
    })

    //搜索按钮与搜索分页复用模块
    $("#user_form_search").on('click', function () {
        if ($("#user_form_search_key").val() == '') {
            $(this).prev().shake(2, 10, 300);
            return false;
        }
        userSearch(1);
    })
}

function setMisc() {
    setUI();
    $('#user_edit_modal').on('hidden.bs.modal', function (e) {
        initEditModal();
    })
}

function setUI() {
    var clientheight = document.body.clientHeight;
    var clientwidth = document.body.clientWidth;
    var loading = $('#loading');
    loading.css('height', clientheight);
    loading.css('width', clientwidth);
    $(".left_menu").css('height', clientheight);
    //console.log(document.body.clientHeight);
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
            //加载页面完成后绑定事件
            loadDataComplete(msg, page, action);
            //alert("DONE!");
            //console.log("DONE:" + msg);
        },
        error: function (msg) {
            alert("ERROR!");
            //console.log("error:" + msg);
        }
    });
}

function loadDataComplete(msg, page, action) {
    if (action == 'init')
        $("#ajax_content").html(msg);
    else
        $("#result").next().empty().append(msg);
    setLoading('hidden');

    //生成表格后绑定点击事件
    $("tr").on('click', function () {
        //打开弹窗并传递行对象、所对应数据的uid
        editData('edit', $(this).children(':first-child').html(), $(this));
    })

    //搜索按钮与搜索分页复用模块
    $("#user_form_search").on('click', function () {
        if ($("#user_form_search_key").val() == '') {
            $(this).prev().shake(2, 10, 300);
            return false;
        }
        userSearch(1);
    })


}

//搜索按钮与搜索分页复用模块
function userSearch(page) {
    setLoading('visible')
    var data = {
        search_key: $("#user_form_search_key").val(),
        filter: $("#user_form_search_button").attr('filter'),
        page: page,
        action: 'user_search'
    };
    $.ajax({
        type: "post",
        url: "../util/admin_action.php?admin_action=user_status",
        data: data,
        dataType: "html",
        success: function (msg) {
            //追加搜索结果
            $("nav").remove();
            $("#form_content").empty().append(msg);
            setLoading('hidden');
            $("tr").on('click', function () {
                //打开弹窗并传递行对象、所对应数据的uid
                editData('edit', $(this).children(':first-child').html(), $(this));
            })
            //alert("DONE!");
            console.log(msg);
        },
        error: function (msg) {
            alert("ERROR!");
            //console.log(msg);
        }
    });
}

function editData(action, uid, obj) {
    if (action == 'edit' && !obj.children(':first-child').hasClass('uid')) {

    }
    else $("#user_edit_modal").modal({backdrop: 'static'});
    //修改时填充数据
    if (action == 'edit') {
        $("#edit_username").val(obj.children('.username').html()).attr('disabled', true);
        //注意修改密码的处理
        $("#edit_password").attr('placeholder', '(输入新密码以覆盖)');
        $("#edit_flag").val(obj.children('.flag').children('span').attr('value'));
        $("#edit_status").val(obj.children('.status').children('span').attr('value'));
        $("#edit_realname").val(obj.children('.real_name').html());
        $("#edit_gender").val(obj.children('.gender').children('span').attr('value'));
        $("#edit_email").val(obj.children('.email').html());
        $("#edit_contact").val(obj.children('.contact').html());
        $("#edit_school").val(obj.children('.school').html());
        $("#edit_subject").val(obj.children('.subject').children('span').attr('value'));
        $("#edit_introduction").val(obj.children('.introduction').html());
    } else if (action == 'new') {
        $("#edit_username").attr('disabled', false);
        $("#edit_password").removeAttr('placeholder');
    }
    //提交按钮
    $("#data_edit_btn").unbind().on('click', function () {
        //简单校验
        if (action == 'new') {
            if ($("#edit_username").val() == '' || $("#edit_password").val() == '') {
                alert('用户名或密码不能为空！');
                return false;
            }
        } else if (action == 'edit') {
            //密码可以留空
            if ($("#edit_username").val() == '') {
                alert('用户名不能为空！');
                return false;
            }
        }
        $(this).attr('disabled', true);
        //新增数据
        var data = {
            action: action,
            username: $("#edit_username").val(),
            password: $("#edit_password").val(),
            flag: $("#edit_flag option:selected").val(),
            status: $("#edit_status option:selected").val(),
            realname: $("#edit_realname").val(),
            gender: $("#edit_gender option:selected").val(),
            email: $("#edit_email").val(),
            contact: $("#edit_contact").val(),
            school: $("#edit_school").val(),
            subject: $("#edit_subject option:selected").val(),
            introduction: $("#edit_introduction").val()
        };
        if (action == 'edit') {
            data['uid'] = uid;
            data['reg_date'] = obj.children(".reg_date").html();
            data['total'] = obj.children(".total").html();
            data['total_like'] = obj.children(".total_like").html();
            data['total_dislike'] = obj.children(".total_dislike").html();
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
                    default: {
                        alert("are you ok?Let's go");
                        $("#user_edit_modal").modal('hide');
                        initEditModal();
                        if (action == 'new') $("#user_status").trigger('click');
                        else {
                            //修改后更新那一行
                            if (obj.replaceWith(msg)) {
                                setTimeout(function () {
                                    $(".edit_complete").removeClass('edit_complete');
                                }, 2000);
                                $("#edit_complete").on('click', function () {
                                    //打开弹窗并传递行对象、所对应数据的uid
                                    editData('edit', $(this).children(':first-child').html(), $(this));
                                })
                                // var tr = $("#edit_complete");
                                // tr.css('color', 'green');
                            }
                        }
                        break;
                    }
                }
                $("#data_edit_btn").attr('disabled', false);
                //alert("DONE!");
                //console.log("DONE:" + msg);
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