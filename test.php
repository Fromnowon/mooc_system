<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="play/js/plyr.js" type="text/javascript"></script>
    <link href="play/css/plyr.css" rel="stylesheet">
</head>
<body>
<video controls id="test">
    <?php
    echo '<source src="http://movietrailers.apple.com/movies/disney/a-wrinkle-in-time/a-wrinkle-in-time-trailer-1_h640w.mov"
            type="video/mp4"/>';
    ?>
</video>
<button id="testbtn">test</button>
</body>
<script>
    var player = plyr.setup('#test')[0];
    $("#testbtn").on('click', function () {
        player.seek(10);
    })
</script>
</html>