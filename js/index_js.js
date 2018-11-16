$(function () {

    //其他
    setMiscIndex();

    //bbs下拉菜单
    bbsFilter();

    //初始化ui
    setUI();
});

$(window).resize(function () {
    setUI();
})

function bbsFilter() {
    $(".bbs_list").on('click', function () {
        var select = $(this).html();
        $(this).parents('ul').prev().children(":first-child").html(select);
    })
}

function setMiscIndex() {
    var width = $(window).width();
    var height = $(window).height();
    //semanticUI 初始化
    $('.ui.dropdown')
        .dropdown({
            on: 'hover'
        });
    $('.special.cards .image').dimmer({
        on: 'hover'
    });
    var width_ = $('.card_list').width();
    $.each($('.card_list').children(), function (index, value) {
        $(this).css({width: width_ * 0.18, 'margin-left': 0});
        if (index != 4) $(this).css({'margin-right': width_ * 0.025 - 12});
    })

    //封面尺寸
    $('.cover_img').css({width: width_ * 0.18, height: width_ * 0.09})


    //更换头像
    $(".change_avatar").on('click', function () {
        $("#change_avatar_modal").modal({backdrop: 'static'});
    })
    $(".change_avatar_list_avatar").on('click', function () {
        var all = $(".change_avatar_list_avatar");
        all.removeAttr('flag');
        all.removeClass('avatar_choose');
        $(this).attr('flag', 1);
        $(this).addClass('avatar_choose');
    })
    $("#change_avatar_submit").on('click', function () {
        $.ajax({
            type: "post",
            url: "util/action.php?action=change_avatar",
            data: {value: $(".avatar_choose").attr('value')},
            dataType: "text",
            success: function (msg) {
                //console.log(msg);
                window.location.reload();
            },
            error: function (msg) {
                alert("ERROR!");
                //console.log(msg);
            }
        });
    })

    //所有课程按钮
    $(".all_courses").on('click', function () {
        window.location.href = "search/search.php?action=index_key_search_all";
    })

    //关于按钮
    $(".about_me").on('click', function () {
        $("#about_me").modal();
    })

    //随机视频事件
    $(".random_course").on('click', function () {
        var id = $(this).attr('value');
        window.open("play/play.php?playid=" + id);
    })
}

function setUI() {
    var width = $(window).width();
    var height = $(window).height();

    //动态添加导航链接
    $(".subject_tag_nav").each(function () {
        var subject = $(this).html();
        var grade = $(this).parent().attr('value');
        $(this).html("<a href='search/search.php?action=index_key_search&grade=" + grade + "&subject=" + subject + "'>" + subject + "</a>");
    })
}