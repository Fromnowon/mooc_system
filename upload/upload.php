<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>上传课程</title>
    <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../js/bootstrap.min.js" rel="stylesheet">
    <link href="./css/fileinput.min.css" rel="stylesheet">
    <link href="./js/fileinput.min.js" rel="stylesheet">
    <link href="./js/zh.js" rel="stylesheet">

    <script src="./js/upload_js.js" type="text/javascript"></script>
    <link href="./css/upload_css.css" rel="stylesheet">
</head>
<body>
<!--本页面设计思路：
    1、因为很重要，所以采用跳转独立页面处理
    2、上传过程提供进度反馈
    3、上传成功后开启预览
    -->
<div class="container-fluid">
    <div class="upload_form">
        <div>
            <h2>标题：</h2>
            <input type="text" class="form-control" placeholder="简洁明了突出亮点">
        </div>
        <div>
            <h2>简介：</h2>
            <textarea rows="6" class="form-control" placeholder="课程知识点重点难点等"></textarea>
        </div>
        <div class="form-group form-inline">
            <label for="upload_subject" class="control-label">科目：<span>&nbsp;&nbsp;</span></label>
            <select id="upload_subject" class="form-control">
                <option value="语文">语文</option>
                <option value="数学">数学</option>
                <option value="英语">英语</option>
                <option value="物理">物理</option>
                <option value="生物">生物</option>
                <option value="化学">化学</option>
                <option value="政治">政治</option>
                <option value="历史">历史</option>
                <option value="地理">地理</option>
                <option value="心理">心理</option>
                <option value="信息技术">信息技术</option>
                <option value="通用技术">通用技术</option>
                <option value="暂无">暂无</option>
            </select>
        </div>
        <div>
            <input type="file" id="course_upload" />
        </div>
    </div>
</div>
</body>
</html>
