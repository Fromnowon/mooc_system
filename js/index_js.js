$(function () {
    //初始化ui
    setUI();

    //其他
    setMiscIndex();
});

$(window).resize(function () {
    setUI();
})

function setMiscIndex() {
    var width = $(window).width();
    var height = $(window).height();
    //滑动区域
    var content = $(".content_div");
    content.css('height', height - 20);
    content.optiscroll({scrollStopDelay: 100});

    //搜索
    $(".btn--search").on('click', function () {
        $('.search__form').unbind().on('submit', function () {
            $(this).ajaxSubmit({
                type: 'post', // 提交方式 get/post
                url: 'your url', // 需要提交的 url
                data: {},
                success: function (data) { // data 保存提交后返回的数据，一般为 json 数据
                    // 此处可对 data 作相关处理
                    alert('提交成功！');
                    return false; // 阻止表单自动提交事件
                },
                error: function () {
                    alert('提交失败！');
                    return false; // 阻止表单自动提交事件
                }
            })
            ;
        });

    });

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

}

function setUI() {
    var width = $(window).width();
    var height = $(window).height();
    $(".logo_td").css('width', width / 3);
    $(".info_td").css('width', width / 3);
    $(".search_td").css('width', 2 * width / 3);

    //设置幻灯片居中
    $(".hub-slider ul li").css('left', width / 2 - 400);
    $(".hub-slider-controls button").css('left', width / 2 - 400);
    console.log('nice');
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