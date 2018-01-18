/**
 * main.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Copyright 2016, Codrops
 * http://www.codrops.com
 */
;(function (window) {

    'use strict';

    var closeCtrl = document.getElementById('btn-search-close'),
        searchContainer = document.querySelector('.search'),
        inputSearch = searchContainer.querySelector('.search__input');

    function init() {
        initEvents();
        $(".search_bg").css('display', 'none');
    }

    function initEvents() {
        inputSearch.addEventListener('focus', openSearch);
        closeCtrl.addEventListener('click', closeSearch);
        document.addEventListener('keyup', function (ev) {
            // escape key.
            if (ev.keyCode == 27) {
                closeSearch();
            }
        });
    }

    function openSearch() {
        searchContainer.classList.add('search--open');
        $(".search_bg").css('display', '');
        $(".logo").animate({opacity: 0}, 500);
        $(".userinfo").animate({opacity: 0}, 500);
        var open_search_content = $(".open_search_content");
        open_search_content.animate({opacity: 1}, 500);
        inputSearch.focus();

        //绑定“返回”hover事件
        $(".open_search_content").find('p').hover(function () {
            $(this).parent().css('background', 'red');
            $(this).parent().find('p').css('color','white');
        }, function () {
            $(this).parent().css('background', 'white');
            $(this).parent().find('p').css('color','cornflowerblue');
        });
        $('.search_back').unbind().on('click',function () {
            closeSearch();
        })

    }

    function closeSearch() {
        searchContainer.classList.remove('search--open');
        $(".search_bg").css('display', 'none');
        $(".logo").animate({opacity: 1}, 500);
        $(".userinfo").animate({opacity: 1}, 500);
        var open_search_content = $(".open_search_content");
        open_search_content.animate({opacity: 0}, 500);
        inputSearch.blur();
        inputSearch.value = '';
        open_search_content.find('p').unbind();
        $('.search_back').css('background', 'white');
    }

    init();

})(window);