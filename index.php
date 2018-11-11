<?php
include 'index_handler.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="js/jquery.form.min.js" type="text/javascript"></script>
    <!--    <link href="css/bootstrap.min.css" rel="stylesheet">-->
    <!--    <script src="js/bootstrap.min.js" type="text/javascript"></script>-->
    <script src="util/util_js.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/demo.css"/>
    <link rel="stylesheet" type="text/css" href="css/index_search.css"/>
    <script src="js/hubslider.min.js" type="text/javascript"></script>
    <link href="css/hub-slider.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/hover-effects.css" rel="stylesheet">
    <script src="js/jquery.gradientify.min.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>
    <script src="js/semantic.min.js" type="text/javascript"></script>
    <link href="css/semantic.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">

    <script src="js/index_js.js" type="text/javascript"></script>
    <link href="css/index_css.css" rel="stylesheet">
</head>
<body>
<div class="content">
    <!--    <div class="search_bg"></div>-->
    <div class="ui menu fixed header_menu borderless">
        <div class="header item">
            <img src="resource/doge.png" alt="logo" style="width: 36px;margin-right: 20px"/>
            <span style="font-size: 22px">校内微课平台</span>
        </div>
        <div class="right menu">
            <div class="item">

                <form class="search__form" action="search/search.php?action=key_search" method="post">
                    <div class="ui icon input">
                        <input type="text" id="search-input" class="search__input" name="search" placeholder="Search..."
                               style="min-width: 300px">
                        <i class="search link icon"></i>
                        <script>
                        $('.search.link.icon').click(function () {
                          $('.search__form').submit();
                        })
                        </script>
                    </div>
                </form>
            </div>
        </div>
        <div class="right menu">

            <!--            --><?php
            //            $r = "<div class='item'><img class='change_avatar' title='点击更换头像' src='resource/avatar/" . $_SESSION['userinfo']['avatar'] . ".png'>" .
            //                "<span style='font-size: 24px'>" . $_SESSION['userinfo']['username'] . "</span></div>" .
            //                "<div class='item'><a class='ui button green small upload_btn' href='upload/upload.php' style='font-size: 14px;'>上传视频</a></div>";
            //            if ($_SESSION['userinfo']['flag'] == 0) $r .= "<style>.upload_btn{display: none}</style>";
            //            echo $r;
            //            ?>
            <!---->
            <!--            <a class="item" href="util/action.php?action=logout">-->
            <!--                注销-->
            <!--            </a>-->

            <div class="ui text right menu" style="margin-right: 20px;">
                <div class="ui buttons" style="height: 38px">
                    <div class="ui button"
                         style="min-width: 100px"><?php echo $_SESSION['userinfo']['username']; ?></div>
                    <div class="ui floating dropdown icon button">
                        <i class="dropdown icon"></i>
                        <div class="menu">
                            <div class="item"><i class="edit icon"></i><a href='upload/upload.php' style="color: black">上传视频</a>
                            </div>
                            <div class="ui divider"></div>
                            <div class="item"><i class="power off icon"></i><span style="color: red;font-weight: bold">注销</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="content_div">
        <div class="ui horizontal large attached menu">
            <div class="ui container">
                <a class="item">
                    所有课程
                </a>
                <div class="ui pointing dropdown link item">
                    高一
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <div class="item">
                            <i class="dropdown icon"></i>
                            <span class="text">文科</span>
                            <div class="menu">
                                <div class="item">ddddddd</div>
                                <div class="item">ddddddd</div>
                                <div class="item">ddddddd</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="dropdown icon"></i>
                            <span class="text">理科</span>
                            <div class="menu">
                                <div class="item">ddddddd</div>
                                <div class="item">ddddddd</div>
                                <div class="item">ddddddd</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="dropdown icon"></i>
                            <span class="text">其他</span>
                            <div class="menu">
                                <div class="item">ddddddd</div>
                                <div class="item">ddddddd</div>
                                <div class="item">ddddddd</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui pointing dropdown link item">
                    高二
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <div class="item">
                            <i class="dropdown icon"></i>
                            <span class="text">文科</span>
                            <div class="menu">
                                <div class="item">ddddddd</div>
                                <div class="item">ddddddd</div>
                                <div class="item">ddddddd</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="dropdown icon"></i>
                            <span class="text">理科</span>
                            <div class="menu">
                                <div class="item">ddddddd</div>
                                <div class="item">ddddddd</div>
                                <div class="item">ddddddd</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="dropdown icon"></i>
                            <span class="text">其他</span>
                            <div class="menu">
                                <div class="item">ddddddd</div>
                                <div class="item">ddddddd</div>
                                <div class="item">ddddddd</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui pointing dropdown link item">
                    高三
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <div class="item">
                            <i class="dropdown icon"></i>
                            <span class="text">文科</span>
                            <div class="menu">
                                <div class="item">ddddddd</div>
                                <div class="item">ddddddd</div>
                                <div class="item">ddddddd</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="dropdown icon"></i>
                            <span class="text">理科</span>
                            <div class="menu">
                                <div class="item">ddddddd</div>
                                <div class="item">ddddddd</div>
                                <div class="item">ddddddd</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="dropdown icon"></i>
                            <span class="text">其他</span>
                            <div class="menu">
                                <div class="item">ddddddd</div>
                                <div class="item">ddddddd</div>
                                <div class="item">ddddddd</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ui pointing dropdown link item">
                    其他
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <div class="item">ddddddd</div>
                        <div class="item">ddddddd</div>
                        <div class="item">ddddddd</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content_main">

            <!--展示最新上传的5个-->
            <br>
            <h4 class="ui horizontal divider header"><i class="tag icon"></i> 最新上传： </h4>
            <div class="newest_list card_list">
                <?php newest(); ?>
            </div>

            <div style="clear: both;"></div>
            <h4 class="ui horizontal divider header"><i class="tag icon"></i> 最多观看： </h4>
            <!--最多点击的5个-->
            <div class="card_list">
                <?php hottest(); ?>
            </div>
            <div style="clear: both;">
            </div>
            <hr>
            <!-- 论坛部分-->
            <div class="input-group-btn" style="display: none">
                <button id="user_form_search_button" type="button" class="btn btn-default dropdown-toggle"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false" filter="1"><span>最新发布</span><span class="caret"
                                                                                style="margin-left: 5px"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="bbs_list" filter="1" href="javascript:void(0)">最新发布</a></li>
                    <li><a class="bbs_list" filter="2" href="javascript:void(0)">最新回复</a></li>
                    <li><a class="bbs_list" filter="3" href="javascript:void(0)">最多点击</a></li>
                    <li><a class="bbs_list" filter="4" href="javascript:void(0)">最多回复</a></li>
                </ul>
            </div>
            <div class="bbs_prev" style="margin-top: 10px">
                <h3>最新主题：</h3>
                <table class="bbs_prev_content table table-striped">
                    <tr style="font-size: 18px;font-weight: bold">
                        <td>标题</td>
                        <td>发帖者</td>
                        <td>回复/点击</td>
                        <td>创建时间</td>
                        <td>最后回复</td>
                    </tr>
                    <?php
                    include 'util/sqlTool.php';
                    $content = '';
                    $rs = all($conn, 'bbs', 'ORDER BY create_date DESC LIMIT 5');
                    foreach ($rs as $post) {
                        $user_rs = select($conn, 'user', "uid={$post['uid']}");
                        $content .= "<tr>
                        <td class='title'>
                            <a href='bbs/post_detail.php?postid={$post['id']}'>{$post['title']}</a>
                        </td>
                        <td class='username'>
                            {$user_rs[0]['username']}
                        </td>
                        <td class='partake'>
                            {$post['reply']}" . " / " . "{$post['view']}
                        </td>
                        <td class='create_date'>
                            {$post['create_date']}
                        </td>
                        <td class='last_date'>
                            {$post['last_reply_date']}
                        </td>
                    </tr>";
                    }
                    echo $content;
                    ?>
                    <tr>
                        <td colspan="5" style="text-align: center">
                            <a target="_blank" href="bbs/bbs_index.php">点击进入完整讨论板块</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="hide modal fade" id="change_avatar_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">选择头像</h4>
            </div>
            <div class="modal-body">
                <table class="change_avatar_list">
                    <tr>
                        <td><img class="change_avatar_list_avatar" value="1" src="resource/avatar/1.png"
                                 style="transform: scale(0.95)"></td>
                        <td><img class="change_avatar_list_avatar" value="2" src="resource/avatar/2.png"></td>
                        <td><img class="change_avatar_list_avatar" value="3" src="resource/avatar/3.png"></td>
                    </tr>
                    <tr>
                        <td><img class="change_avatar_list_avatar" value="4" src="resource/avatar/4.png"></td>
                        <td><img class="change_avatar_list_avatar" value="5" src="resource/avatar/5.png"></td>
                        <td><img class="change_avatar_list_avatar" value="6" src="resource/avatar/6.png"></td>
                    </tr>
                    <tr>
                        <td><img class="change_avatar_list_avatar" value="7" src="resource/avatar/7.png"
                                 style="transform: scale(0.9)"></td>
                        <td><img class="change_avatar_list_avatar" value="8" src="resource/avatar/8.png"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" id="change_avatar_submit">确定</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="hide modal fade" id="about_me" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">关于本站</h4>
            </div>
            <div class="modal-body">
                <div>
                    <?php
                    $sql = 'select * from course';
                    $num_course = mysqli_num_rows(mysqli_query($conn, $sql));
                    echo "<p style='font-size: 18px'>课程总数：<span style='color: #2e6da4;font-weight: bold'>" . $num_course . "</span></p>";
                    ?>
                    <?php
                    $sql = 'select * from user';
                    $num_user = mysqli_num_rows(mysqli_query($conn, $sql));
                    echo "<p style='font-size: 18px'>用户总数：<span style='color: #2e6da4;font-weight: bold'>" . $num_user . "</span></p>";
                    ?>
                    <p>平台版本：<span>1.18.0330</span></p>
                </div>
                <div>
                    <hr>
                    <br>
                    <p>更新日志：</p>
                    <p>2018.3.30 版本号1.18.0330</p>
                    <p>
                        1、轮播右侧增加随机视频显示；
                        2、bug修复
                    </p>
                    <br>
                    <p>2018.3.27 版本号1.18.0327</p>
                    <p>
                        1、替换网站logo，并在相应位置予以显示；
                        2、重写分类导航和更换轮播组件；
                        3、若干界面微调；
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>