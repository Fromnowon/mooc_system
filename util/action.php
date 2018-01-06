<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2018/1/4
 * Time: 16:55
 */
//准备阶段
if (!isset($_GET['action'])) {
    //非法访问
    echo 'No action received.';
    exit();
}
include('conn.php');

switch ($_GET['action']) {
    case 'login': {
        $login_username = $_POST['login_username'];
        $login_password = md5($_POST['login_password']);
        $login_checkbox = $_POST['login_checkbox'];
        login($conn, $login_username, $login_password, $login_checkbox);
        break;
    }
    case 'register': {
        $reg_username = $_POST['reg_username'];
        $reg_password = md5($_POST['reg_password']);
        $reg_mail = $_POST['reg_mail'];
        $reg_school = $_POST['reg_school'];
        $reg_contact = $_POST['reg_contact'];
        register($conn, $reg_username, $reg_password, $reg_mail, $reg_school, $reg_contact, $date);
        break;
    }
    default : {
        echo 'Error';
        mysqli_close($conn);
        break;
    }
}
//登录函数
function login($conn, $username, $password, $checkbox)
{
    $check_query = mysqli_query($conn, "select * from user where username='$username' and password='$password'");
    if ($result = mysqli_fetch_assoc($check_query)) {
        //登录成功
        session_start();
        $_SESSION['userinfo'] = $result;
        /*$_SESSION['username'] = $username;
        $_SESSION['flag'] = $result['flag'];*/
        if (isset($checkbox[count($checkbox) - 1])) {
            //登录到后台
            if ($result['flag'] < 1) {
                echo '对不起，您的账户没有管理员权限，' . '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
                mysqli_close($conn);
                exit();
            }
            mysqli_close($conn);
            header("Location: ../admin/admin_index.php");
        } else {
            mysqli_close($conn);
            //登录到前台主页
            header("Location: ../index.php");
        }
    } else {
        mysqli_close($conn);
        exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
    }
}

//注册函数
function register($conn, $username, $password, $mail, $school, $contact, $date)
{
    //echo 'OK';exit();
    $sql = "insert into user (username,password,mail,contact,school,reg_date) values ('$username','$password','$mail','$contact','$school','$date')";
    if (mysqli_query($conn, $sql))
        echo 'OK';
    else
        echo 'ERROR';
    mysqli_close($conn);
}
