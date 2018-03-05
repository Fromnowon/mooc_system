<?php
//准备阶段
session_start();
if (!isset($_GET['action'])) {
    //非法访问
    echo '非法访问';
    exit();
}

include('../util/conn.php');

switch ($_GET['action']){
    case 'newpost':{
        newPost();
        break;
    }
}

function newPost(){
    $title=$_POST['title'];
    $content=$_POST['content'];
}