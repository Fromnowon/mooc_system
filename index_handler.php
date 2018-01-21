<?php
/**
 * Created by PhpStorm.
 * User: ZZH
 * Date: 2018/1/21
 * Time: 22:21
 */
include 'util/conn.php';
session_start();
if (!isset($_SESSION['userinfo'])) {
    header("Location:login.php");
}
$sql = "select * from course where id=1";
$rs = mysqli_fetch_array(mysqli_query($conn, $sql));
function courseInfo($action)
{
    global $rs;
    switch ($action) {
        case 'cover':
            {
                echo '<img src="' . $rs['cover'] . '" alt="封面" style="height: 240px;width:430px;"/>';
                break;
            }
        case 'title':
            {
                echo '<h3 class="title">' . $rs['title'] . '</h3>';
                break;
            }
        case 'subject':
            {
                echo '<span class="post">科目：' . $rs['subject'] . '</span>';
                break;
            }
        default:
            {
                echo 'error';
            }
    }
}