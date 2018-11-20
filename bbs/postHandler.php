<?php
//准备阶段
session_start();
if (!isset($_GET['action'])) {
    //非法访问
    echo '非法访问';
    exit();
}

include('../util/conn.php');
include('../util/sqlTool.php');

switch ($_GET['action']) {
    case 'newpost':
        {
            newPost($conn, $date);
            break;
        }
    case 'postreply':
        {
            postReply($conn, $date);
            break;
        }
}

function newPost($conn, $date)
{
    $title = $_POST['title'];
    $content = htmlspecialchars($_POST['content']);
    $r = add($conn, 'bbs',
        [$_SESSION['userinfo']['uid'], $title, $content, 0, 0, $date, $date, 1]
    );
    if ($r) echo 'ok';
    else echo 'error';
    mysqli_close($conn);
}

function postReply($conn, $date)
{
    $id = $_POST['id'];
    $content = $_POST['content'];
    $r = add($conn, 'bbs_reply', [$id, $_SESSION['userinfo']['uid'], $content, $date]);
    update($conn, "bbs", "reply=reply+1, last_reply_date='" . $date . "'", "id=$id");
    if ($r) echo 'ok';
    else echo 'error';
    mysqli_close($conn);
}