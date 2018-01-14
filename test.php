<?php
include 'util/conn.php';
$test = '我是值';
var_dump($conn);
echo '<br>';
var_dump($test);
echo '~~~~~~~~~~~~~~~~~以上是直接输出~~~~~~~~~~~~~~~~~~~<br>';
function test($x, $y)
{
    var_dump($conn);
    echo '<br>';
    var_dump($test);
    echo '~~~~~~~~~~~~~~~~~以上是直接调用~~~~~~~~~~~~~~~~~<br>';
    global $conn,$test;
    var_dump($conn);
    echo '<br>';
    var_dump($test);
    echo '~~~~~~~~~~~~~~~~~~以上是申明全局变量~~~~~~~~~~~~~~~~<br>';
    var_dump($GLOBALS['conn']);
    echo '<br>';
    var_dump($GLOBALS['test']);
    echo '~~~~~~~~~~~~~~~~~~~以上是调用全局数组~~~~~~~~~~~~~~~~~~<br>';
}

test($conn, $test);