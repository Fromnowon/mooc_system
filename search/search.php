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
        <form action="search.php?action=key_search" method="post">
            <h3 style="display: inline;font-size: 20px">
                关键词检索:</h3>
            <input type="text" class="form-control" name="search" style="display: inline-block;width: 200px;margin-left: 20px">
            <button class="btn btn-primary" type="submit" style="width: 100px;margin-left: 20px">搜索</button>
        </form>
    </div>
    <hr>
    <div class="search_tag">
        <form action="" style="margin-top: -20px">
            <table>
                <tr>
                    <td><h4>年级：</h4></td>
                    <td>
                        <ul class="grade">
                            <li><input type="checkbox" name="all-grade" data-labelauty="所有"></li>
                            <li><input type="checkbox" name="grade" data-labelauty="高一"></li>
                            <li><input type="checkbox" name="grade" data-labelauty="高二"></li>
                            <li><input type="checkbox" name="grade" data-labelauty="高三"></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td><h4>科目：</h4></td>
                    <td>
                        <ul class="subject">
                            <li><input type="checkbox" name="all-subject" data-labelauty="所有"></li>

                        </ul>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <ul style="margin-top: -10px">
                            <li><input type="checkbox" name="subject" data-labelauty="语文"></li>
                            <li><input type="checkbox" name="subject" data-labelauty="数学"></li>
                            <li><input type="checkbox" name="subject" data-labelauty="英语"></li>
                            <li><input type="checkbox" name="subject" data-labelauty="物理"></li>
                            <li><input type="checkbox" name="subject" data-labelauty="化学"></li>
                            <li><input type="checkbox" name="subject" data-labelauty="生物"></li>
                            <li><input type="checkbox" name="subject" data-labelauty="政治"></li>
                            <li><input type="checkbox" name="subject" data-labelauty="历史"></li>
                            <li><input type="checkbox" name="subject" data-labelauty="地理"></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <ul style="margin-top: -10px">
                            <li><input type="checkbox" name="subject" data-labelauty="信息技术"></li>
                            <li><input type="checkbox" name="subject" data-labelauty="通用技术"></li>
                            <li><input type="checkbox" name="subject" data-labelauty="其他"></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <ul style="margin-top: 0">
                            <li>
                                <button type="submit" class="btn btn-primary" style="width: 100px">检索</button>
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
            <?php search_result(); ?>
        </table>
    </div>
</div>

</body>
</html>
