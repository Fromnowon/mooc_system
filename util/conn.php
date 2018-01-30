<?php

$conn = mysqli_connect("localhost", "root", "8ud7fh") or die("连接数据库失败" . mysqli_error($conn));
//$conn = mysqli_connect("localhost", "root", "root") or die("连接数据库失败" . mysqli_error($conn));
mysqli_select_db($conn,"mooc") or die("数据库访问错误" . mysqli_error($conn));

error_reporting(E_ALL ^ E_NOTICE);
mysqli_select_db($conn, "mooc");
mysqli_query($conn, "set names 'utf8'");
ini_set('date.timezone', 'Asia/Shanghai');
$date = date('Y-m-d H:i:s');?>