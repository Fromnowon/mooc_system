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
    var clientheight = $(this).height();
    var clientwidth = $(this).width();
    var loading = $('#loading');
    loading.css('height', clientheight);
    loading.css('width', clientwidth);
    $(".left_menu").css('height', clientheight);
})

function setMisc() {
    var clientheight = $(window).height();
    var clientwidth = $(window).width();
    var loading = $('#loading');
    loading.css('height', clientheight);
    loading.css('width', clientwidth);
    $(".left_menu").css('height', clientheight);
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
            console.log("DONE:" + msg);
        },
        error: function (msg) {
            alert("ERROR!");
            console.log("error:" + msg);
        }
    });
}

//新增按钮
function addData() {

}
