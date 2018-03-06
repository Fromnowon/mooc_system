$(function () {
    postReply();
})

function postReply() {
    $('.post_reply_btn').on('click', function () {
        var content = msg_handler($('.post_reply').val());
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