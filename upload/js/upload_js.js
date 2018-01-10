$(function () {
    //杂项
    setMisc();

    //上传模块
    uploadHandler();
});

//显示文件大小
function showSize() {
    var filesize = $("input[type='file']")[0].files[0].size;
    $(".upload_size").html('文件大小：' + (filesize / 1024 / 1024).toFixed(2) + 'MB' + "<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>" + '预计上传耗时：' + formatSeconds(filesize / 1024 / 250));
}

function setMisc() {
    $("#upload_file").filestyle({placeholder: "No file"});
    $(".buttonText").html('选择文件');

    $(".backtoindex").on('click',function () {
        window.location.href = "../index.php";
    })
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
            if (filesize > 500) {
                alert("文件大小超过限制，最多500M");
                return false;
            }
            //if($("#txt1").val()==""){return false;}//如：验证表单数据是否为空
        },
        beforeSend: function () {
            status.empty();
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
            $(".progress").css('visibility', 'visible');
            $("#upload_btn").attr('disabled',true);
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
        },
        error: function (err) {//失败
            alert("表单提交异常！" + err.msg);
        },
        complete: function (xhr) {//完成
            status.html(xhr.responseText);
            $("#upload_btn").attr('disabled',false);
        }
    });

}