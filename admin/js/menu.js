//导航菜单
function navList(id) {
    var $obj = $("#nav_dot"), $item = $("#J_nav_" + id);
    $item.addClass("on").parent().removeClass("none").parent().addClass("selected");
    $obj.find("h4").hover(function () {
        $(this).addClass("hover");
        //鼠标划过菜单时显示特效
        if (!$(this).parent().hasClass('selected')) {
            $(this).css('background-color', '#00a5a5');
        }
        $(this).animate({fontSize: 22}, 200);
    }, function () {
        $(this).removeClass("hover");
        $(this).animate({fontSize: 18}, 200);
        $(this).css('background-color', '');
    });
    $obj.find("a").hover(function () {
        //鼠标划过菜单时显示特效
        $(this).css('text-decoration', 'underline');
    }, function () {
        $(this).css('text-decoration', 'none');
    });
    $obj.find("h4").click(function () {
        //若被点击，清除hover色块
        $(this).css('background-color', '');
        var $div = $(this).siblings(".list-item");
        if ($(this).parent().hasClass("selected")) {
            $div.slideUp(600);
            $(this).parent().removeClass("selected");
        }
        if ($div.is(":hidden")) {
            $("#nav_dot li").find(".list-item").slideUp(600);
            $("#nav_dot li").removeClass("selected");
            $(this).parent().addClass("selected");
            $div.slideDown(600);

        } else {
            $div.slideUp(600);
        }
    });
}

