$(function () {
    var player = videojs('course_player');
    var courseID = $(".course_title").find('span').attr('value');
    //其他
    setMisc(courseID);
    //笔记相关
    noteHandler(player, courseID);
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

function noteHandler(player, courseID) {
    var note_pop = $(".note_pop");
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

function setMisc(courseID) {
    //初始化评分
    var initialRating = $(".live-rating").text();
    if (initialRating == '') initialRating = 0;
    $(".course_rating_star").starRating({
        starSize: 28,
        emptyColor: 'white',
        ratedColor: 'red',
        initialRating: initialRating,
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

    //新增回复
    $(".reply_new").find('button').on('click', function () {
        var content = $(this).parent().prevAll('textarea').val();
        var btn = $(this);
        btn.attr('disabled', true);
        $.ajax({
            type: "post",
            url: "../util/action.php?action=reply",
            data: {courseID: courseID, content: content, action: 'new_reply'},
            dataType: "html",
            success: function (msg) {
                var t = $(".reply_floor");

                //修改新增项标记
                var old_floor = t.children(':first-child');
                if (old_floor.length != 0) {
                    var new_floor = parseInt(old_floor.attr('floor')) + 1;
                    t.prepend(msg);
                    old_floor.prev().find('.new_floor_flag').prepend(new_floor + '楼');
                    old_floor.prev().attr('floor', new_floor);
                } else {
                    t.prepend(msg);
                    var this_floor = t.children(':first-child');
                    this_floor.find('.new_floor_flag').prepend('1楼');
                    this_floor.attr('floor', 1);
                }

                var append = t.find('.reply_table').first();
                t.prev().find('textarea').val('');
                animate_auto(append, 'fadeInLeft', 1000);
                //各种绑定
                setReplyBtn(append.find('.reply_btn'));
                replyToReply(append);
                setReplyTo(append.find('.replytoreply'));

                btn.removeAttr('disabled');
                //console.log(msg);
            },
            error: function (msg) {
                alert("ERROR!");
                console.log("error:" + msg);
            }
        });
    })

    //控制回复框
    setReplyBtn($(".reply_btn"));

    //回复楼中楼
    replyToReply($(".reply_edit"));

    //更多讨论
    replyHandler($(".more_reply"), "#t");
    //更多楼中楼
    replyHandler($(".more_toreply"), "#f");

    //绑定“回复TA”
    setReplyTo($(".replytoreply"));
}

function setReplyTo(obj) {
    obj.unbind().on('click', function () {
        var btn = $(this);
        var name = btn.parent().prev().children('span').text();//获取TA的名字
        var t = btn.parents('tbody').find('.reply_btn');//获取所在楼层的“参与讨论”
        //console.log(t.parent().next().next().css('height'));
        if (parseInt(t.parent().next().next().css('height')) == 0)
            t.trigger('click');
        var textarea = t.parent().next().next().find('textarea');
        textarea.val('回复 ' + name + ' ' + textarea.val());
        textarea.focus();
    })
}

function setReplyBtn(obj) {
    obj.unbind().on('click', function () {
        var btn = $(this);
        var reply_div = $(this).parent().next().next();
        if (parseInt(reply_div.css('height')) == 0) {
            reply_div.animate({height: 200}, 500, function () {
                btn.text('收起编辑框');
                btn.parent().parent().find('textarea').focus();
            });
        } else {
            reply_div.animate({height: 0}, 500, function () {
                btn.text('参与讨论');
            });
        }
    })
}

function replyHandler(obj, selector) {
    obj.on('click', function () {
        var now = parseInt($(this).attr('now'));
        var max = parseInt($(this).attr('max'));
        $(selector + now).nextUntil(selector + (now + 5 + 1)).css('display', '');
        now += 5;
        $(this).attr('now', now);
        if (now >= max) {
            $(this).css('display', 'none');
        }
    })
}

function replyToReply(obj) {
    obj.find('button').on('click', function () {
        var btn = $(this);
        btn.attr('disabled', true);
        data = {
            content: btn.prevAll('textarea').val(),
            id: btn.parents('.reply_table').attr('flag'),
            action: 'toreply'
        };
        $.ajax({
            type: "post",
            url: "../util/action.php?action=reply",
            data: data,
            dataType: "html",
            success: function (msg) {
                btn.parents('tr').after(msg);
                btn.prevAll('textarea').val('');
                animate_auto(btn.parents('tr').next(), 'fadeInLeft', 1000);
                btn.removeAttr('disabled');
                btn.parents('tr').find('.reply_btn').trigger('click');
                setReplyTo($(".replytoreply"));
                //console.log(msg);
            },
            error: function (msg) {
                alert("ERROR!");
                console.log("error:" + msg);
            }
        });
    })
}