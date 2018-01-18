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

    var content = $(".content_main");
    content.css('height', height);


    content.optiscroll();
    console.log('11111')
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