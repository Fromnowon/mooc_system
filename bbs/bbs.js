$(function () {
    $('#newpost').on('click', function () {
        $("#new_post").modal();
    })

    newPost();
})

function newPost() {
    $("#new_post_submit").on('click', function () {
        var title = $(".new_post_title").text();
        var content = $(".new_post_content").text();
        $.ajax({
            type: "post",
            url: "postHandler.php?action=newpost",
            data: {title: title, content: content},
            dataType: "text",
            success: function (msg) {
                //console.log(msg);
                alert('发表主题成功！');
                window.location.reload();
            },
            error: function (msg) {
                alert("ERROR!");
                //console.log(msg);
            }
        });
    })
}