$(function () {
    $('#newpost').on('click', function () {
        $("#new_post").modal();
    })

    newPost();
})

function newPost() {
    $("#new_post_submit").on('click', function () {
        var title = $(".new_post_title").val();
        var content = msg_handler($(".new_post_content").val());
        $.ajax({
            type: "post",
            url: "postHandler.php?action=newpost",
            data: {title: title, content: content},
            dataType: "text",
            success: function (msg) {
                //console.log(msg);
                if (msg == 'ok') {
                    alert('发表主题成功！');
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