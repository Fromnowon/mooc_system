var editor;
$(function () {
    newPost();

    $('#newpost').click(function () {
        if ($(this).hasClass('editing')) {
            //关闭编辑器
            $(this).removeClass('editing negative').addClass('primary').html("<i class='icon edit'></i>发表主题");
            $('.bbs_editor').fadeOut(function () {
                $('#editor').html('');
            });

        } else {
            //打开编辑器
            var E = window.wangEditor;
            editor = new E('#editor');
            // 或者 var editor = new E( document.getElementById('editor') )
            editor.create();
            $('.bbs_editor').fadeIn(200);
            //滚到编辑器头部
            $('html,body').animate({'scrollTop': $('.new_post_content').offset().top}, 500, function () {
                $('.post_title_input').focus();
            });
            $(this).removeClass('primary').addClass('negative editing').html("<i class='icon remove'></i>取消编辑");
        }
    })

})

function newPost() {
    $("#new_post_submit").on('click', function () {
        var title = $(".post_title_input").val();
        var content = editor.txt.html();
        if (title == '' || title == null) {
            alert('请输入标题');
            return;
        } else if (editor.txt.text() == '' || editor.txt.text() == null) {
            alert('请输入内容');
            return;
        }
        $.ajax({
            type: "post",
            url: "postHandler.php?action=newpost",
            data: {title: title, content: content},
            dataType: "text",
            success: function (msg) {
                //console.log(msg);
                if (msg == 'ok') {
                    window.location.reload();
                } else alert('发生错误！');
            },
            error: function (msg) {
                alert("ERROR!");
                console.log(msg);
            }
        });
    })
}