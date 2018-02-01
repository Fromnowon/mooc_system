$(function () {
    $(':input').labelauty();
    //checkbox互斥
    checkboxMutex($(".all-grade"), $(".grade-m"));
    checkboxMutex($(".all-subject"), $(".subject-m"));
    //防止出现一个条件都未选择时提交
    //当“所有”条件被取消时，判断其余子条件是否被选中


    //两个搜索功能
    searchTwo();
});

function searchTwo() {
    //分类搜索
    $("#tag_search_form").submit(function () {
        //console.log((JSON.stringify($('#tag_search_form').serializeArray())));
        var data = JSON.stringify($('#tag_search_form').serializeArray());
        $.ajax({
            type: "post", //提交方式
            dataType: "text", //数据类型
            data: {data: data},
            url: "ajaxSearch.php?action=tag_search", //请求url
            success: function (data) { //提交成功的回调函数
                //console.log(data);
                $(".search_result").html(data);
                $("#search_key_form")[0].reset();
            }
        });
        return false;
    })

    //关键词搜索
    $("#search_key_form").submit(function () {
        var data = $('#search_key_form').find('input').val();
        if (data == '' || data == null) {
            alert('请输入关键词');
            return false;
        }
        $.ajax({
            type: "post", //提交方式
            dataType: "html", //数据类型
            data: {data: data},
            url: "ajaxSearch.php?action=search_key", //请求url
            success: function (data) { //提交成功的回调函数
                $(".search_result").html(data);
                $("#tag_search_form")[0].reset();
            }
        });
        return false;
    })
}

function checkboxMutex(a, b) {
    a.change(function () {
        //不能同时选中
        if ($(this).is(':checked')) {
            b.prop('checked', false);
        }
        else {
            //当子条件都未选中时，强制选中“所有”
            if (!b.is(':checked')) {
                a.prop('checked', true);
            }
        }
    });
    b.change(function () {
        if ($(this).is(':checked')) {
            a.prop('checked', false);
        }
        else {
            //若一个子条件被取消选择，则触发一次子条件遍历
            var flag = 0;
            b.each(function (i) {
                if ($(this).is(':checked'))
                    return false;//若有子条件被选中则提前跳出
                flag = i;
            })
            if (flag == (b.length - 1)) {
                //无子条件被选中
                a.prop('checked', true);
            }
        }
    });
}