var editor;
$(function () {
    //新增回复
    postReply();

    //回复某层
    replyTo();

    //初始化编辑器
    var E = window.wangEditor;
    editor = new E('#reply_editor');
    // 或者 var editor = new E( document.getElementById('editor') )
    // 自定义菜单配置
    editor.customConfig.showLinkImg = false;
    editor.customConfig.uploadImgServer = './upload'; // 上传图片到服务器
    editor.customConfig.menus = [
        'head',  // 标题
        'bold',  // 粗体
        'fontSize',  // 字号
        'italic',  // 斜体
        'underline',  // 下划线
        'strikeThrough',  // 删除线
        'foreColor',  // 文字颜色
        'backColor',  // 背景颜色
        'link',  // 插入链接
        'list',  // 列表
        'justify',  // 对齐方式
        'quote',  // 引用
        'emoticon',  // 表情
        'image',
        'table',  // 表格
        'code',  // 插入代码
        'undo',  // 撤销
        'redo'  // 重复
    ]
    editor.create();
})

function replyTo() {
    $(".reply_to").on('click', function () {
        var name = $(this).attr('name');
        var text_old = editor.txt.html();
        editor.txt.html('回复 ' + name + ' ：\n' + text_old);
    })
}

function postReply() {
    $('.post_reply_btn').on('click', function () {
        var content = msg_handler($('.post_reply').val());
        if (content == '' || content == null) {
            alert('请输入内容');
            return;
        }
        $.ajax({
            type: "post",
            url: "postHandler.php?action=postreply",
            data: {content: content, id: $('.postid').html()},
            dataType: "text",
            success: function (msg) {
                //console.log(msg);
                if (msg == 'ok') {
                    window.location.reload();
                } else alert('发生错误！');
            },
            error: function (msg) {
                alert("ERROR!");
                //console.log(msg);
            }
        });
    })
}