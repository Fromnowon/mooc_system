<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2018/1/4
 * Time: 16:55
 */
//准备阶段
if ($_GET['action']==null) {
    echo 'No action recieved.';
    exit();
}
error_reporting(E_ALL ^ E_NOTICE);
include('conn.php');
mysqli_select_db($conn, "msgbox");
mysqli_query($conn, "set names 'utf8'");
ini_set('date.timezone', 'Asia/Shanghai');

switch ($_GET['action']) {
    case 'login': {
        $username = $_POST['username'];
        $password = $_POST['password'];
        login($username, $password);
        break;
    }
    default : {
        echo 'Error';
        break;
    }
}
//登录函数
function login($username, $password)
{

}

;