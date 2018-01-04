$(function () {
    //动态调整元素布局
    uiSet();
    //实时校验表单
    formCheck();


})

function formCheck() {
    var btn = $("#submit_btn");
    var username = $("#username");
    var password = $("#password");
    btn.attr('disabled', 'disabled');
    username.bind('blur keyup input', function () {
        tipHandler(username, password);
    });
    password.bind('blur keyup input', function () {
        tipHandler(password, username);
    });

    function tipHandler(object1, object2) {
        if (object1.val().length > 0 && object1.val().length < 6) {
            btn.attr('disabled', 'disabled');
            object1.next().css('visibility', 'visible');
        }
        else {
            object1.next().css('visibility', 'hidden');
            if (object2.val().length > 6) {
                btn.removeAttr('disabled');
            }
        }
    }
}
function uiSet() {
    var clientheight=$(document).height();
    var clientwidth=$(document).width();
    var login_form=$("#login");
    login_form.css('left',clientwidth/2-200).css('top',clientheight/3);
    $("#container").css('height',clientheight);
    var footer=$("footer");
    footer.css('height',clientheight/10);
    footer.css('padding-top',footer.height()*0.4);
}
//动态设置元素高度
$(window).resize(function () {
    var clientheight=$(this).height();
    var clientwidth=$(this).width();
    $("#container").css('height',$(this).height());
    var login_form=$("#login");
    login_form.css('left',clientwidth/2-150).css('top',clientheight/3);
    var footer=$("footer");
    footer.css('height',clientheight/10);
    footer.css('padding-top',footer.height()*0.4);
});