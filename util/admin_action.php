<?php
/**
 * Created by PhpStorm.
 * User: ZZH
 * Date: 2018/1/6
 * Time: 11:46
 */
//准备阶段
if (!isset($_GET['admin_action'])) {
    //非法访问
    echo 'No action received.';
    exit();
}
include('conn.php');

switch ($_GET['admin_action']) {
    case 'user_status': {
        //返回所有用户数据
        allUsers($conn);
        break;
    }
    case 'logout':{
        $_SESSION=[];
        session_destroy();
        header("Location: ../login.php");
        break;
    }
}
function allUsers($conn)
{
    $check_query = mysqli_query($conn, "select * from user");
    $rs = array();
    while ($r = mysqli_fetch_assoc($check_query)) {
        $rs[count($rs)] = $r;
    }
    echo json_encode($rs);
    //print_r($rs);
}