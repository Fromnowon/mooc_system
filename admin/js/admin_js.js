$(function () {
    //时间模块
    setTimeShow();
    setInterval(function () {
        setTimeShow();
    }, 1000);

    //实现"用户监控"
    userStatus();

    //绑定各种按钮
    setBtn();

    //布局相关
    setMisc();
})

$(window).resize(function () {
    setMisc();
})

function setMisc() {
    var clientheight = $(this).height();
    var clientwidth = $(this).width();
    var loading = $('#loading');
    loading.css('height', clientheight);
    loading.css('width', clientwidth);
}

function setBtn() {

}

function setLoading(toggle) {
    $("#loading").css('visibility', toggle);
}

function userStatus() {
    //点击了用户管理
    $("#user_status").on('click', function () {
        setLoading('visible');
        $.ajax({
            type: "post",
            url: "../util/admin_action.php?admin_action=user_status",
            dataType: "json",
            success: function (msg) {
                //alert("DONE!");
                //输出
                usersShow(msg);
                setLoading('hidden');
                console.log("DONE:" + msg);
            },
            error: function (msg) {
                alert("ERROR!");
                console.log("error:" + msg);
            }
        });

    })
}

function setTimeShow() {
    $(".date").html(new Date().Format("yyyy-MM-dd"));
    $(".time").html("星期" + "日一二三四五六".charAt(new Date().getDay()) + ' ' + new Date().Format("HH:mm:ss"));
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

function usersShow(msg) {
    //搜索框
    var form_search_html = ("<div id=\"form_search\"><div class=\"input-group col-lg-3\" style=\"float: right\">\n" +
        "<input type=\"text\" class=\"form-control\" placeholder=\"用户名、姓名、邮箱等\">\n" +
        "<span class=\"input-group-btn\">\n" +
        "<button class=\"btn btn-default\" type=\"button\">查询</button>\n" +
        "</span>\n" +
        "</div></div><br/><br/><br/>");
    //处理页码
    var total_data = getJsonLength(msg);
    var total_page = Math.ceil(total_data / 10);
    var page = 1;

    //实例化页码按钮
    var page_html = "<nav aria-label=\"Page navigation\"><ul class=\"pagination\" id=\"page_btn\">";
    //page_btn.children().remove();
    var i = 1;
    while (i <= total_page) {
        page_html += "<li><a href='javascript:void(0)'>" + i + "</a></li>";
        //page_btn.append("<li><a href='javascript:void(0)'>" + i + "</a></li>");
        i++;
    }
    page_html += "</ul></nav>";
    //实例化表头
    var table_html = "<div id=\"form_content\"><table class='table table-bordered table-responsive'  id='user_status'>" +
        '<thead id=\'result\'><tr><th>id</th><th>用户名</th><th>邮箱</th><th>联系方式</th><th>性别</th><th>名字</th>' +
        '<th>学校</th><th>注册时间</th><th>简介</th><th>身份</th><th>状态</th>' +
        '<th>科目</th><th>上传数</th><th>标签</th><th>赞</th><th>踩</th></tr></thead>' +
        '</table></div>';
    //加载
    $("#ajax_content").html(form_search_html + table_html + page_html);
    //马上显示第一页
    showUserData(1, msg, total_data);
    //分页显示
    $("#ajax_content").find('a').on('click', function () {
        showUserData($(this).html(), msg, total_data);
    })
}

function showUserData(a, json, total_data) {
    var result = '';
    var page_current = a;
    var i = 0;
    for (i = ((page_current - 1) * 10); i < (page_current * 10); i++) {
        result += "<tr>";
        for (var key in json[i]) {
            var tmp = json[i][key];
            if (tmp == '' || tmp == null) tmp = '暂无';
            if (key == 'password' || key == 'avatar' || key == 'like_id' || key == 'dislike_id') {
                //啥都不做
            } else {
                result += "<td class=" + key + ">" + tmp + "</td>";
            }
        }
        //补全
        if (i >= total_data) {
            var j = 0;
            while (j < 16) {
                result += "<td><span style='visibility: hidden'>0</span></td>";
                j++;
            }
        }
        result += "</tr>";
    }
    //追加前清除原有数据
    var result_div = $("#result");
    result_div.siblings().remove();
    result_div.after(result);
}

//获取json长度
function getJsonLength(jsonObj) {
    var Length = 0;
    for (var item in jsonObj) {
        Length++;
    }
    return Length;
}