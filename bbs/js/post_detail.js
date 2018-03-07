$(function () {
    //新增回复
    postReply();

    //回复某层
    replyTo();
})

function replyTo() {
    $(".reply_to").on('click', function () {
        var name = $(this).attr('name');
        var editor = $(".post_reply");
        var text_old = editor.val();
        editor.val('回复 '+name+' ：\n'+text_old);
        editor.focus();
    })
}

function postReply() {
    $('.post_reply_btn').on('click', function () {
        var content = msg_handler($('.post_reply').val());
        if (content==''||content==null){
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