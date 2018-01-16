//抖动函数
jQuery.fn.shake = function (intShakes /*Amount of shakes*/, intDistance /*Shake distance*/, intDuration /*Time duration*/) {
    this.each(function () {
        var jqNode = $(this);
        jqNode.css({position: 'relative'});
        for (var x = 1; x <= intShakes; x++) {
            jqNode.animate({left: intDistance}, (((intDuration / intShakes) / 2)))
                .animate({left: 0}, (((intDuration / intShakes) / 2)))
        }
    });
    return this;
}

//遮罩控制
function setLoading(str) {
    var loading = $('#loading');
    loading.css('visibility', str);
}

// 对Date的扩展，将 Date 转化为指定格式的String
// 月(M)、日(d)、小时(h)、分(m)、秒(s)、季度(q) 可以用 1-2 个占位符，
// 年(y)可以用 1-4 个占位符，毫秒(S)只能用 1 个占位符(是 1-3 位的数字)
Date.prototype.Format = function (fmt) { //author: meizz
    var o = {
        "M+": this.getMonth() + 1, //月份
        "d+": this.getDate(), //日
        "H+": this.getHours(), //小时
        "m+": this.getMinutes(), //分
        "s+": this.getSeconds(), //秒
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度
        "S": this.getMilliseconds() //毫秒
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
        if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}

//获取json长度
function getJsonLength(jsonObj) {
    var Length = 0;
    for (var item in jsonObj) {
        Length++;
    }
    return Length;
}

//秒转时分
function formatSeconds(value) {
    var theTime = parseInt(value);// 秒
    var theTime1 = 0;// 分
    var theTime2 = 0;// 小时
// alert(theTime);
    if (theTime > 60) {
        theTime1 = parseInt(theTime / 60);
        theTime = parseInt(theTime % 60);
// alert(theTime1+"-"+theTime);
        if (theTime1 > 60) {
            theTime2 = parseInt(theTime1 / 60);
            theTime1 = parseInt(theTime1 % 60);
        }
    }
    var result = "" + parseInt(theTime) + "秒";
    if (theTime1 > 0) {
        result = "" + parseInt(theTime1) + "分" + result;
    }
    if (theTime2 > 0) {
        result = "" + parseInt(theTime2) + "小时" + result;
    }
    return result;
}

//添加动画并自动删除
function animate_auto(obj, type, duration, function_down) {
    if (obj.addClass(type + ' animated')) {
        setTimeout(function () {
            if ($.isFunction(function_down)) function_down();
            obj.removeClass(type + ' animated');
        }, duration);
    }
}

//即时限制输入字数
function textLimit(textObj, infoObj) {
    //留言框字数限制
    var text = textObj.val();
    var counter = text.length;
    infoObj.text(counter);
    textObj.on('blur keyup input', function () {
        var text = textObj.val();
        var counter = text.length;
        infoObj.text(counter);
        // console.log($("#msg_data").val());
        if (counter >= 200) {
            textObj.val(textObj.val().substr(0, 200));
            infoObj.css({"color": "red", "font-weight": "bold"});
        }
        else infoObj.removeAttr("style");
    });
}