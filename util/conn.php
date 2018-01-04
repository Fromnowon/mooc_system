<?php

$conn = mysqli_connect("172.96.222.54", "root", "root") or die("连接数据库失败" . mysqli_error($conn));
mysqli_select_db($conn,"mooc") or die("数据库访问错误" . mysqli_error($conn));
?>