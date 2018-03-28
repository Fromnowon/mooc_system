<?php
include 'index_handler.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="js/jquery.form.min.js" type="text/javascript"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="util/util_js.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/demo.css"/>
    <link rel="stylesheet" type="text/css" href="css/index_search.css"/>
    <script src="js/jquery.optiscroll.min.js" type="text/javascript"></script>
    <link href="css/optiscroll.css" rel="stylesheet">
    <script src="js/hubslider.min.js" type="text/javascript"></script>
    <link href="css/hub-slider.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/hover-effects.css" rel="stylesheet">
    <script src="js/jquery.gradientify.min.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>

    <script src="js/index_js.js" type="text/javascript"></script>
    <link href="css/index_css.css?v=14" rel="stylesheet">
</head>
<body>
<div class="content">
    <div class="search_bg"></div>
    <div class="header">
        <table style="table-layout: fixed;">
            <tr>
                <td class="logo_td">
                    <div class="logo">
                        <table>
                            <tr>
                                <td><img src="resource/logo.png" alt="logo" width="50px"></td>
                                <td style="padding-left: 10px"><p>校内微课平台</p></td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td class="search_td">
                    <div class="searcher">
                        <svg class="hidden">
                            <defs>
                                <symbol id="icon-arrow" viewBox="0 0 24 24">
                                    <title>arrow</title>
                                    <polygon
                                            points="6.3,12.8 20.9,12.8 20.9,11.2 6.3,11.2 10.2,7.2 9,6 3.1,12 9,18 10.2,16.8 "></polygon>
                                </symbol>
                                <symbol id="icon-drop" viewBox="0 0 24 24">
                                    <title>drop</title>
                                    <path d="M12,21c-3.6,0-6.6-3-6.6-6.6C5.4,11,10.8,4,11.4,3.2C11.6,3.1,11.8,3,12,3s0.4,0.1,0.6,0.3c0.6,0.8,6.1,7.8,6.1,11.2C18.6,18.1,15.6,21,12,21zM12,4.8c-1.8,2.4-5.2,7.4-5.2,9.6c0,2.9,2.3,5.2,5.2,5.2s5.2-2.3,5.2-5.2C17.2,12.2,13.8,7.3,12,4.8z"></path>
                                    <path d="M12,18.2c-0.4,0-0.7-0.3-0.7-0.7s0.3-0.7,0.7-0.7c1.3,0,2.4-1.1,2.4-2.4c0-0.4,0.3-0.7,0.7-0.7c0.4,0,0.7,0.3,0.7,0.7C15.8,16.5,14.1,18.2,12,18.2z"></path>
                                </symbol>
                                <symbol id="icon-search" viewBox="0 0 24 24">
                                    <title>search</title>
                                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                                </symbol>
                                <symbol id="icon-cross" viewBox="0 0 24 24">
                                    <title>cross</title>
                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
                                </symbol>
                            </defs>
                        </svg>
                        <div class="search">
                            <button id="btn-search-close" class="btn btn--search-close"
                                    aria-label="Close search form">
                                <svg class="icon icon--cross">
                                    <use xlink:href="#icon-cross"></use>
                                </svg>
                            </button>
                            <form class="search__form" action="search/search.php?action=key_search" method="post">
                                <input id="search-input" class="search__input" name="search" type="search"
                                       placeholder=""
                                       autocomplete="off"/>
                                <button class="btn btn--search">
                                    <svg class="icon icon--search">
                                        <use xlink:href="#icon-search"></use>
                                    </svg>
                                </button>
                            </form>
                            <div class="search__suggestion" style="color: white;">
                                <h3>瞧瞧我们给您推荐的？</h3>
                                <div style="font-weight: bold;text-align: left">
                                    <br>
                                    <p>1、<span class="search_suj">解读《滕王阁序》</span>，深入了解诗人王勃</p><br>
                                    <p>2、差之毫厘谬以千里，<span class="search_suj">H2O和H2O2的区别</span></p><br>
                                    <p>3、<span class="search_suj">详解“rather than”与“other than”的不同与用法</span></p><br>
                                    <p>4、更多，敬请期待...</p><br>
                                    <div style="clear: both"></div>
                                </div>
                            </div>
                        </div>
                        <script src="js/index_search.js" type="text/javascript"></script>
                    </div>
                </td>
                <td class="info_td">
                    <div class="userinfo" style="float: right">
                        <?php
                        echo "<table style='margin-right:30px'><tr>
                                       <td><img style='padding-top:10px;' class='change_avatar' title='点击更换头像' src='resource/avatar/" . $_SESSION['userinfo']['avatar'] . ".png'></td>
                                       <td><span style='font-size: 24px'>" . $_SESSION['userinfo']['username'] . "</span></td>
                                       <td><a class=\"btn btn-success\" href=\"upload/upload.php\" style=\"font-size: 14px\">上传视频</a></td>
                                       <td><a href=\"util/action.php?action=logout\" style='font-size: 16px;padding-left: 20px'>注销</a></td>
                                       </tr></table>";
                        ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="open_search_content" style="opacity: 0;">
        <div class="search_back">
            <p>返回</p>
        </div>
        <div class="search_title">
            <span>搜你所想</span>
        </div>
    </div>
    <div class="content_div optiscroll">
        <div class="content_main">
            <table style="font-size: 22px;margin: 0 15px;">
                <tr>
                    <td class="all_courses" style="width:292px;background: #00bf00;padding: 10px;color: white"><i
                                class="fa fa-reorder"></i>&nbsp;&nbsp;&nbsp;所有课程
                    </td>
                    <td style="padding-left: 10px"><p class="go_down">讨论区</p></td>
                    <td style="padding-left: 20px"><p class="about_me">关于本站</p></td>
                </tr>
            </table>
            <div style="background: #d6d6d6;margin: 0 15px;position: relative" class="neck_layout">
                <table class="subject_tag_table">
                    <tr>
                        <td style="text-align: left;">
                            <h4 style="font-weight: bold">高一</h4>
                        </td>
                    </tr>
                    <tr value="高一">
                        <td class="subject_tag_nav">语文</td>
                        <td class="subject_tag_nav">数学</td>
                        <td class="subject_tag_nav">英语</td>
                    </tr>
                    <tr value="高一">
                        <td class="subject_tag_nav">物理</td>
                        <td class="subject_tag_nav">生物</td>
                        <td class="subject_tag_nav">化学</td>
                        <td class="subject_tag_nav">政治</td>
                        <td class="subject_tag_nav">历史</td>
                        <td class="subject_tag_nav">地理</td>
                    </tr>
                    <tr value="高一">
                        <td class="subject_tag_nav">信息</td>
                        <td class="subject_tag_nav">心理</td>
                        <td class="subject_tag_nav">其他</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;border-top: 1px white solid;" colspan="6">
                            <h4 style="font-weight: bold">高二</h4>
                        </td>
                    </tr>
                    <tr value="高二">
                        <td class="subject_tag_nav">语文</td>
                        <td class="subject_tag_nav">数学</td>
                        <td class="subject_tag_nav">英语</td>
                    </tr>
                    <tr value="高二">
                        <td class="subject_tag_nav">物理</td>
                        <td class="subject_tag_nav">生物</td>
                        <td class="subject_tag_nav">化学</td>
                        <td class="subject_tag_nav">政治</td>
                        <td class="subject_tag_nav">历史</td>
                        <td class="subject_tag_nav">地理</td>
                    </tr>
                    <tr value="高二">
                        <td class="subject_tag_nav">信息</td>
                        <td class="subject_tag_nav">心理</td>
                        <td class="subject_tag_nav">其他</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;border-top: 1px white solid;" colspan="6">
                            <h4 style="font-weight: bold">高三</h4>
                        </td>
                    </tr>
                    <tr value="高三">
                        <td class="subject_tag_nav">语文</td>
                        <td class="subject_tag_nav">数学</td>
                        <td class="subject_tag_nav">英语</td>
                    </tr>
                    <tr value="高三">
                        <td class="subject_tag_nav">物理</td>
                        <td class="subject_tag_nav">生物</td>
                        <td class="subject_tag_nav">化学</td>
                        <td class="subject_tag_nav">政治</td>
                        <td class="subject_tag_nav">历史</td>
                        <td class="subject_tag_nav">地理</td>
                    </tr>
                    <tr value="高三">
                        <td class="subject_tag_nav">信息</td>
                        <td class="subject_tag_nav">心理</td>
                        <td class="subject_tag_nav">其他</td>
                    </tr>
                </table>
                <div class="trent-slider" style="position: absolute;top:0;right: 300px">
                    <div class="t-slide current-t-slide">
                        <img src="resource/img/slider1.png" alt=""/>
                    </div>
                    <div class="t-slide">
                        <img src="resource/img/slider2.png" alt=""/>
                    </div>
                    <div class="t-slide">
                        <img src="resource/img/slider3.png" alt=""/>
                    </div>
                    <div class="t-slide">
                        <img src="resource/img/slider1.png" alt=""/>
                    </div>
                    <div class="t-slider-controls">
                        <div class="arrow right-arrow">
                            <div class="arrow-container">
                                <div class="arrow-icon"><i class="fa fa-chevron-right"
                                                           aria-hidden="true"></i></div>
                            </div>
                        </div>
                        <div class="arrow left-arrow">
                            <div class="arrow-container">
                                <div class="arrow-icon"><i class="fa fa-chevron-left"
                                                           aria-hidden="true"></i></div>
                            </div>
                        </div>
                        <div class="t-load-bar">
                            <div class="inner-load-bar"></div>
                        </div>
                        <div class="t-dots-container">
                            <div class="t-slide-dots-wrap">
                                <div class="t-slide-dots">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="status_div"
                     style="background: white;border: 1px black solid;width:300px;height: 400px;position: absolute;top:0;right: 0">
                    <p>预留区域，广告位招租</p>
                </div>
            </div>
            <!--展示最新上传的5个-->
            <br>
            <div class="video_list newest_upload">
                <table style="margin: 0 auto">
                    <tr>
                        <td><h3 style="font-weight: bold">最新上传：</h3></td>
                    </tr>
                    <tr>
                        <?php newest(); ?>
                    </tr>
                </table>
            </div>
            <br>
            <!--最多点击的5个-->
            <div class="video_list most_views">
                <table style="margin: 0 auto">
                    <tr>
                        <td><h3 style="font-weight: bold">最多点击：</h3></td>
                    </tr>
                    <tr>
                        <?php hottest(); ?>
                    </tr>
                </table>
            </div>
            <br>
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
<div class="index_bg"></div>

<!-- Modal -->
<div class="modal fade" id="change_avatar_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
<div class="modal fade" id="about_me" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                    <p>平台版本：<span>1.18.0327</span></p>
                </div>
                <div>
                    <hr>
                    <p>更新日志：</p>
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