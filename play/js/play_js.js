$(function () {
    var player = videojs('course_player');

    //笔记相关
    noteHandler(player);

    //笔记初始化
    noteInit($(".panel-default"), player);
})

function noteInit(note, player) {
    //绑定删除事件
    note.find(".note_del").unbind().on('click', function () {
        animate_auto(note, 'fadeOutRight', 1000, function () {
            note.remove();
        });
        $.ajax({
            type: "post",
            url: "../util/action.php?action=note",
            data: {action: 'delete', id: note.find('.id').html()},
            dataType: "text",
            success: function (msg) {
                console.log(msg);
            },
            error: function (msg) {
                alert("ERROR!");
                console.log(msg);
            }
        });
    })
    //绑定定位播放
    note.find(".note_play").unbind().on('click', function () {
        var time = $(this).parents('.panel-default').find('.mark_time').html();//笔记对应时间点
        console.log(time);
        if (player.paused) {
            player.play();
            player.currentTime(time);
        } else player.currentTime(time);

    })
}

function noteHandler(player) {
    var note_pop = $(".note_pop");
    var courseID = $(".course_title").find('span').attr('value');
    //console.log(courrseID);
    $("#new_note").unbind().on('click', function () {
        //绑定取消按钮
        $(".note_pop_dismiss").unbind().on('click', function () {
            animate_auto(note_pop, 'fadeOut', 1000, function () {
                note_pop.css('display', 'none');
                note_pop.children('input').val('');
                note_pop.children('textarea').val('');
            });
        });
        //暂停视频，获取时间节点，弹窗
        player.pause();
        //alert($(this).offset().top+'||'+$(this).offset().left+'||'+note_time);
        var note_pop_position = [$(this).offset().top, $(this).offset().left];
        note_pop.css({'display': '', 'top': note_pop_position[0] + 40, 'left': note_pop_position[1]});
        animate_auto(note_pop, 'fadeIn', 1000);
    });
    $(".note_save").on('click', function () {
        var btn = $(this);
        data = {
            action: 'save',
            courseID: courseID,
            title: $(".note_title").val(),
            content: $(".note_content").val(),
            time: player.currentTime()
        };
        $.ajax({
            type: "post",
            url: "../util/action.php?action=note",
            data: data,
            dataType: "text",
            success: function (msg) {
                //console.log("DONE:" + msg);
                btn.prevAll('a').trigger('click');//模拟点击“取消”
                //添加结果
                var t = $(".note_content_show");
                t.prepend(msg);
                animate_auto(t.children(":first-child"), 'fadeInRight', 1000);
                noteInit(t, player);
            },
            error: function (msg) {
                alert("ERROR!");
                console.log("error:" + msg);
            }
        });

    })
}
