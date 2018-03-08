$(function () {
    $('body').gradientify({
        gradients: [
            {start: [49, 76, 172], stop: [242, 159, 191]},
            {start: [255, 103, 69], stop: [240, 154, 241]},
            {start: [33, 229, 241], stop: [235, 236, 117]}
        ],
        fps: 8
    });
    //初始化ui
    setUI();

    //其他
    setMiscIndex();

    //bbs下拉菜单
    bbsFilter();
});

$(window).resize(function () {
    setUI();
})

function bbsFilter() {
    $(".bbs_list").on('click',function () {
        var select=$(this).html();
        $(this).parents('ul').prev().children(":first-child").html(select);
    })
}

function setMiscIndex() {
    var width = $(window).width();
    var height = $(window).height();
    //滑动区域
    var content = $(".content_div");
    content.css('height', height);
    content.optiscroll({scrollStopDelay: 100});

    $('.hub-slider-slides ul').hubSlider({
        selector: $('li'),
        button: {
            next: $('.hub-slider-arrow_next'),
            prev: $('.hub-slider-arrow_prev')
        },
        auto: true,
        time: 5
    });

    //滚动事件
    var scroll_before;
    content.on('scrollstart', function (e) {
        scroll_before = e.detail.scrollTop;
        //console.log(scroll_before);
    })
    var scroll_after;
    content.on('scrollstop', function (e) {
        var header = $(".header");
        scroll_after = e.detail.scrollTop;
        //console.log(scroll_after);
        if (scroll_before > scroll_after) {
            header.stop(true, false).animate({opacity: 1}, 300);
        } else if (scroll_before < scroll_after) {
            header.stop(true, false).animate({opacity: 0}, 300);
        }
    });
    content.on('scrollreachtop', function () {
        //若到顶部强制停止所有动画瞬间显示
        $(".header").stop(true, true).css('opacity', 1);
    });

    //搜索建议
    $(".search_suj").on('click', function () {
        $("#search-input").val($(this).html());
    });

    //更换头像
    $(".change_avatar").on('click',function () {
        $("#change_avatar_modal").modal({backdrop: 'static'});
    })
    $(".change_avatar_list_avatar").on('click',function () {
        var all=$(".change_avatar_list_avatar");
        all.removeAttr('flag');
        all.removeClass('avatar_choose');
        $(this).attr('flag',1);
        $(this).addClass('avatar_choose');
    })
    $("#change_avatar_submit").on('click',function () {
        $.ajax({
            type: "post",
            url: "util/action.php?action=change_avatar",
            data: {value:$(".avatar_choose").attr('value')},
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
}

function setUI() {
    var width = $(window).width();
    var height = $(window).height();
    $(".logo_td").css('width', width / 3);
    $(".info_td").css('width', width / 3);
    $(".search_td").css('width', 2 * width / 3);
}

function closeSearch() {
    var searchContainer = document.querySelector('.search'),
        inputSearch = searchContainer.querySelector('.search__input');
    searchContainer.classList.remove('search--open');
    $(".search_bg").css('display', 'none');
    $(".logo").animate({opacity: 1}, 500);
    $(".userinfo").animate({opacity: 1}, 500);
    $(".open_search_content").animate({opacity: 0}, 500);
    inputSearch.blur();
    inputSearch.value = '';
}