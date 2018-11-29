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
  $('.cover_img').css({width: width_ * 0.18, height: width_ * 0.1})

  //滚动条到顶部取消导航栏阴影
  $(window).scroll(function () {
    if ($(document).scrollTop() <= 0) {
      $('.header_menu').css('box-shadow', 'unset');
      $('.to_top').fadeOut();
    } else {
      $('.header_menu').removeAttr('style');
      $('.to_top').fadeIn();
    }
  });

  //轮播
  $('#my-slider').sliderPro({
    width: 960,
    height: 500,
    arrows: true,
    buttons: true,
    fullScreen: false
  });

  //用户信息
  $('.user_info_btn').click(function () {
    $('.user_info').modal({
      closable: false,
      autofocus:false
    }).modal('show')
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