<?php session_start();
if (!isset($_SESSION['userinfo'])) {
    header("Location:login.php");
} ?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>首页</title>
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="util/util_js.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/demo.css"/>
    <link rel="stylesheet" type="text/css" href="css/style2.css"/>
    <script src="js/jquery.optiscroll.min.js" type="text/javascript"></script>
    <link href="css/optiscroll.css" rel="stylesheet">

    <script src="js/index_js.js" type="text/javascript"></script>
    <link href="css/index_css.css?v=133" rel="stylesheet">
</head>
<body>
<div class="content">
    <div class="search_bg">
    </div>
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
                            <form class="search__form" action="">
                                <input id="search-input" class="search__input" name="search" type="search"
                                       placeholder=""
                                       autocomplete="off" autocorrect="off" autocapitalize="off"
                                       spellcheck="false"/>
                                <button class="btn btn--search">
                                    <svg class="icon icon--search">
                                        <use xlink:href="#icon-search"></use>
                                    </svg>
                                </button>
                            </form>
                            <div class="search__suggestion" style="color: white;">
                                <h3>瞧瞧我们给您推荐的？</h3>
                                <div style="font-weight: bold">
                                    <a href="">杨教授亲身示范电击疗法</a><br>
                                    <a href="">美日又联合军演了</a><br>
                                    <a href="">他改变了中国</a><br>
                                    <a href="">更多。。。</a><br>
                                    <div style="clear: both"></div>
                                </div>
                            </div>
                        </div>
                        <script src="js/demo2.js" type="text/javascript"></script>
                    </div>
                </td>
                <td class="info_td">
                    <div class="userinfo">
                        <p>
                            <?php
                            if (!isset($_SESSION['userinfo'])) {
                                header("Location:login.php");
                            } else {
                                echo "<img src='resource/avatar/" . $_SESSION['userinfo']['avatar'] . ".png'><span>" . $_SESSION['userinfo']['username'] . "</span>";
                            } ?>
                            <a href="">注销</a>
                        </p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="open_search_content" style="opacity: 0;">
        <div style="width: 200px;height: 54px;text-align:center;position: absolute;z-index: 50;top: 0;left:0;font-size: 26px">
            <p style="color: cornflowerblue;line-height: 54px">返回</p>
        </div>
        <div style="position: absolute;z-index: 50;top: 1%;left:45%;font-size: 26px">
            <span>搜你所想</span>
        </div>
    </div>
    <div class="content_main optiscroll">
        <div class="test1" style="height: 300px;background: pink">dsadadasd</div>
        <div class="test" style="height: 300px;background: blue"></div>
        <div class="test" style="height: 300px;background: black"></div>
        <div class="test" style="height: 300px;background: white"></div>
    </div>
</body>
</html>