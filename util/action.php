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
mysqli_select_db($conn, "mooc");
mysqli_query($conn, "set names 'utf8'");
ini_set('date.timezone', 'Asia/Shanghai');

switch ($_GET['action']) {
    case 'login': {
        $username = $_POST['username'];
        $password = $_POST['password'];
        login($conn,$username, $password);
        break;
    }
    default : {
        echo 'Error';
        break;
    }
}
//登录函数
function login($conn,$username, $password)
{
    $check_query = mysqli_query($conn,"select * from user where username='$username' and password='$password'");
    if ($result = mysqli_fetch_assoc($check_query)) {
        //登录成功
        session_start();
        $_SESSION['username'] = $_POST['username'];
        Header("refresh:3;url='../index.php'");
    } else {
        exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
    }
}