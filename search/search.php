<?php
include 'searchHandler.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>搜索页</title>
    <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="js/jquery-labelauty.js" type="text/javascript"></script>
    <link href="css/jquery-labelauty.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="css/hover-effects.css" rel="stylesheet">

    <script src="js/search_js.js" type="text/javascript"></script>
    <link href="css/search_css.css" rel="stylesheet">
</head>
<body>
<div class="content">
    <div class="search_key">
        <form id="search_key_form" method="post" style="display: inline-block">
            <h3 style="display: inline;font-size: 20px">
                关键词检索:</h3>
            <input type="text" class="form-control" name="search"
                   style="display: inline-block;width: 200px;margin-left: 20px">
            <button class="btn btn-primary search_key_btn" type="submit" style="width: 100px;margin-left: 20px">搜索</button>
        </form>
        <a href="../index.php" style="float: right;padding-right: 50px;font-size: 20px">返回主页</a>
    </div>
    <hr>
    <div class="search_tag">
        <form id="tag_search_form" style="margin-top: -20px" method="post">
            <table>
                <tr>
                    <td><h4>年级：</h4></td>
                    <td>
                        <ul class="grade">
                            <li><input type="checkbox" class="all-grade" checked name="all-grade" value="所有"
                                       data-labelauty="所有"></li>
                            <li><input type="checkbox" class="grade-m" name="grade" value="高一" data-labelauty="高一">
                            </li>
                            <li><input type="checkbox" class="grade-m" name="grade" value="高二" data-labelauty="高二">
                            </li>
                            <li><input type="checkbox" class="grade-m" name="grade" value="高三" data-labelauty="高三">
                            </li>
                            <li><input type="checkbox" class="grade-m" name="grade" value="其他" data-labelauty="其他">
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td><h4>科目：</h4></td>
                    <td>
                        <ul class="subject">
                            <li><input type="checkbox" class="all-subject" checked name="all-subject" value="所有"
                                       data-labelauty="所有"></li>

                        </ul>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <ul style="margin-top: -10px">
                            <li><input type="checkbox" class="subject-m" name="subject" value="语文"
                                       data-labelauty="语文"></li>
                            <li><input type="checkbox" class="subject-m" name="subject" value="数学"
                                       data-labelauty="数学"></li>
                            <li><input type="checkbox" class="subject-m" name="subject" value="英语"
                                       data-labelauty="英语"></li>
                            <li><input type="checkbox" class="subject-m" name="subject" value="物理"
                                       data-labelauty="物理"></li>
                            <li><input type="checkbox" class="subject-m" name="subject" value="化学"
                                       data-labelauty="化学"></li>
                            <li><input type="checkbox" class="subject-m" name="subject" value="生物"
                                       data-labelauty="生物"></li>
                            <li><input type="checkbox" class="subject-m" name="subject" value="政治"
                                       data-labelauty="政治"></li>
                            <li><input type="checkbox" class="subject-m" name="subject" value="历史"
                                       data-labelauty="历史"></li>
                            <li><input type="checkbox" class="subject-m" name="subject" value="地理"
                                       data-labelauty="地理"></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <ul style="margin-top: -10px">
                            <li><input type="checkbox" class="subject-m" name="subject" value="信息技术"
                                       data-labelauty="信息技术"></li>
                            <li><input type="checkbox" class="subject-m" name="subject" value="通用技术"
                                       data-labelauty="通用技术"></li>
                            <li><input type="checkbox" class="subject-m" name="subject" value="其他"
                                       data-labelauty="其他"></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <ul style="margin-top: 0">
                            <li>
                                <button type="submit" class="btn btn-primary tag_search_btn" style="width: 100px">检索</button>
                            </li>
                        </ul>
                    </td>
                </tr>
            </table>
        </form>
        <hr>
    </div>
    <div class="search_result">
        <table>
            <tr><?php search_result(); ?></tr>
        </table>
    </div>
</div>

</body>
</html>
