$(function () {
    //杂项
    setMisc();

    //上传模块
    uploadHandler();
});

function setMisc() {
    $("#upload_file").filestyle({placeholder: "No file"});
    $(".buttonText").html('选择文件');
}

function uploadHandler() {

    var bar = $('.bar');//进度条
    var percent = $('.percent');//百分比
    var status = $('#status');//结果反馈
    $('.upload_form').ajaxForm({
        beforeSerialize: function () {
            //alert("表单数据序列化前执行的操作！");
            //$("#txt2").val("java");//如：改变元素的值
        },
        beforeSubmit: function () {
            //alert("表单提交前的操作");
            var filesize = $("input[type='file']")[0].files[0].size / 1024 / 1024;
            if (filesize > 1000) {
                alert("文件大小超过限制，最多50M");
                return false;
            }
            //if($("#txt1").val()==""){return false;}//如：验证表单数据是否为空
        },
        beforeSend: function () {
            status.empty();
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function (event, position, total, percentComplete) {//上传的过程
            //position 已上传了多少
            //total 总大小
            //已上传的百分数
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
            //console.log(percentVal, position, total);
        },
        success: function (data) {//成功
            var percentVal = '100%';
            bar.width(percentVal)
            percent.html(percentVal);
            alert(data);
        },
        error: function (err) {//失败
            alert("表单提交异常！" + err.msg);
        },
        complete: function (xhr) {//完成
            status.html(xhr.responseText);
        }
    });

}