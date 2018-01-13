$(function () {
    var player = videojs('course_player');
    $(".course_rating_star").starRating({
        starSize: 28,
        emptyColor: 'white',
        ratedColor: 'red',
        initialRating: 3.5,
        onHover: function (currentIndex, currentRating, $el) {
            $('.live-rating').text(currentIndex);
        },
        onLeave: function (currentIndex, currentRating, $el) {
            $('.live-rating').text(currentRating);
        },
        callback: function (currentRating, $el) {
            // do something after rating
            $.ajax({
                type: "post",
                url: "../util/action.php?action=note",
                data: {action: 'rating', rating: currentRating, id: $(".course_title").children().attr('value')},
                dataType: "html",
                success: function (msg) {
                    //console.log("DONE:" + msg);
                    $('.live-rating').text(msg);
                    $(".course_rating_star").starRating('setRating', msg);
                    $(".course_rating_count").children().html(parseInt($(".course_rating_count").children().html()) + 1);
                },
                error: function (msg) {
                    alert("ERROR!");
                    console.log("error:" + msg);
                }
            });
        }
    });
    //笔记相关
    noteHandler(player);

    //笔记初始化
    noteInit($(".panel-default"), player);
})

function noteInit(note, player) {
    //绑定删除事件
    note.find(".note_del").unbind().on('click', function () {
        var t = $(this).parents('.panel-default');
        animate_auto(t, 'fadeOutRight', 1000, function () {
            t.remove();
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
    //新增笔记
    $("#new_note").unbind().on('click', function () {
        //绑定取消按钮
        $(".note_pop_dismiss").unbind().on('click', function () {
            $("#new_note").html('添加笔记');
            if (player.currentTime() != 0) player.play();
            animate_auto(note_pop, 'bounceOut', 1000, function () {
                note_pop.css('display', 'none');
                // note_pop.children('input').val('');
                // note_pop.children('textarea').val('');
            });
        });
        //判断笔记弹窗是否已经显示
        if (note_pop.css('display') == 'none') {
            player.pause();
            $(this).html('取消添加');
            var note_pop_position = [$(this).offset().top, $(this).offset().left];
            note_pop.css({'display': '', 'top': note_pop_position[0] + 40, 'left': note_pop_position[1]});
            animate_auto(note_pop, 'bounceIn', 1000);
        } else {
            if (player.currentTime() != 0) player.play();
            $(this).html('添加笔记');
            animate_auto(note_pop, 'bounceOut', 1000, function () {
                note_pop.css('display', 'none');
            });
        }


    });
    //保存笔记
    $(".note_save").unbind().on('click', function () {
        var btn = $(this);
        $(".note_pop_dismiss").trigger('click');//模拟点击“取消”
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
                btn.prevAll('input').val('');
                btn.prevAll('textarea').val('');
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
    //清空笔记
    $(".note_pop_clear").unbind().on('click', function () {
        note_pop.children('input').val('');
        note_pop.children('textarea').val('');
    })
}
