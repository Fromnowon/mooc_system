<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div{
            margin: 10px;
            background-color: red;
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
<div class="div1"></div>
<div class="div2"></div>
<div class="div3" id="test"></div>
<div class="div4"></div>
<script>
    $(".div1").on("click",function () {
        $(".div1").nextAll("#test").css("background-color","blue");
    })
</script>
</body>
</html>