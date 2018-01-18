$(function () {
    //初始化ui
    setUI();
});

function setUI() {
    var width = $(window).width();
    var height = $(window).height();
    $(".logo_td").css('width', width / 3);
    $(".info_td").css('width', width / 3);
    $(".search_td").css('width', 2 * width / 3);

    var content = $(".content_div");
    content.css('height', height - 20);
    content.optiscroll();

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