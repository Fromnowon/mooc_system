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
    <script src="util/util_js.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/demo.css"/>
    <link rel="stylesheet" type="text/css" href="css/index_search.css"/>
    <script src="js/jquery.optiscroll.min.js" type="text/javascript"></script>
    <link href="css/optiscroll.css" rel="stylesheet">
    <script src="js/hubslider.min.js" type="text/javascript"></script>
    <link href="css/hub-slider.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/hover-effects.css" rel="stylesheet">

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
                        <p>校内微课平台</p>
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
                                    <p>1、<span class="search_suj">杨教授亲身示范电击疗法</span>，结果竟然......</p><br>
                                    <p>2、又来了，<span class="search_suj">美日联合军演</span></p><br>
                                    <p>3、<span class="search_suj">他改变了中国</span></p><br>
                                    <p>4、更多，敬请期待...</p><br>
                                    <div style="clear: both"></div>
                                </div>
                            </div>
                        </div>
                        <script src="js/index_search.js" type="text/javascript"></script>
                    </div>
                </td>
                <td class="info_td">
                    <div class="userinfo">
                        <p>
                            <?php
                            echo "<img src='resource/avatar/" . $_SESSION['userinfo']['avatar'] . ".png'><span>" . $_SESSION['userinfo']['username'] . "</span>";
                            ?>
                            <a href="upload/upload.php" style="color: green;">上传视频</a>
                            <a href="util/action.php?action=logout">注销</a>
                        </p>
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
            <table align="center" style="overflow: hidden;">
                <tr>
                    <td class="subject_nav" style="padding-left: 20px">
                        <table style="margin: 0 auto;">
                            <tr>
                                <td>
                                    <div class="index_tag_search">
                                        <h3>高一</h3>
                                        <div>
                                            <table style="margin: 0 auto;font-size: 18px;margin-top: 8px;"
                                                   class="subject_text">
                                                <tr>
                                                    <td>
                                                        <a href="search/search.php?action=index_key_search&grade=高一&subject=语文">语文</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高一&subject=数学">数学</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高一&subject=英语">英语</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="search/search.php?action=index_key_search&grade=高一&subject=生物">生物</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高一&subject=化学">化学</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高一&subject=物理">物理</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高一&subject=政治">政治</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高一&subject=历史">历史</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高一&subject=地理">地理</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="search/search.php?action=index_key_search&grade=高一&subject=心理">心理</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高一&subject=信息技术">信息技术</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高一&subject=其他">其他</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="index_tag_search">
                                        <h3>高二</h3>
                                        <div>
                                            <table style="margin: 0 auto;font-size: 18px;margin-top: 8px;"
                                                   class="subject_text">
                                                <tr>
                                                    <td>
                                                        <a href="search/search.php?action=index_key_search&grade=高二&subject=语文">语文</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高二&subject=数学">数学</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高二&subject=语文">英语</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="search/search.php?action=index_key_search&grade=高二&subject=生物">生物</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高二&subject=化学">化学</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高二&subject=物理">物理</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高二&subject=政治">政治</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高二&subject=历史">历史</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高二&subject=地理">地理</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="search/search.php?action=index_key_search&grade=高二&subject=通用技术">通用技术</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高二&subject=其他">其他</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="index_tag_search">
                                        <h3>高三</h3>
                                        <div>
                                            <table style="margin: 0 auto;font-size: 18px;margin-top: 8px;"
                                                   class="subject_text">
                                                <tr>
                                                    <td>
                                                        <a href="search/search.php?action=index_key_search&grade=高三&subject=语文">语文</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高三&subject=数学">数学</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高三&subject=语文">英语</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="search/search.php?action=index_key_search&grade=高三&subject=生物">生物</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高三&subject=化学">化学</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高三&subject=物理">物理</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高三&subject=政治">政治</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高三&subject=历史">历史</a>
                                                        <a href="search/search.php?action=index_key_search&grade=高三&subject=地理">地理</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="search/search.php?action=index_key_search&grade=高三&subject=其他">其他</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="slider_td">
                        <div class="hub-slider" style="height: 500px">
                            <div class="hub-slider-slides">
                                <ul style="text-align: center">
                                    <li>Slide 1</li>
                                    <li>Slide 2</li>
                                    <li>Slide 3</li>
                                </ul>
                            </div>
                            <div class="hub-slider-controls">
                                <button class="hub-slider-arrow hub-slider-arrow_prev">prev</button>
                                <button class="hub-slider-arrow hub-slider-arrow_next">next</button>
                            </div>
                        </div>
                    </td>
                </tr>
            </table sty ststy>
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
        </div>

    </div>
</div>
<div class="index_bg"></div>
</body>
</html>