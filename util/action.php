<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2018/1/4
 * Time: 16:55
 */
//准备阶段
session_start();
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
        $login_checkbox = $_POST['logintoadmin'];
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
    case 'course_upload': {
        courseUpload($conn, $date);
        break;
    }
    case 'note': {
        noteHandler($conn, $date);
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
        if ($checkbox) {
            //登录到后台
            if ($result['flag'] < 1) {
                //无权限，拒绝请求
                echo 'REFUSED';
                mysqli_close($conn);
                exit();
            }
            mysqli_close($conn);
            echo 'ADMIN';
            //header("Location: ../admin/admin_index.php");
        } else {
            mysqli_close($conn);
            echo 'NORMAL';
            //登录到前台主页
            //header("Location: ../index.php");
        }
    } else {
        mysqli_close($conn);
        exit('WRONG');
    }
}

//注册函数
function register($conn, $username, $password, $email, $school, $contact, $date)
{
    //echo 'OK';exit();
    $sql = "insert into user (username,password,email,contact,school,reg_date) values ('$username','$password','$email','$contact','$school','$date')";
    if (mysqli_query($conn, $sql))
        echo 'OK';
    else
        echo 'ERROR';
    mysqli_close($conn);
}

//上传函数
function courseUpload($conn, $date)
{
    $course = $_FILES['course_upload'];
    if (!empty($course)) {//判断上传内容是否为空
        if ($course['error'] > 0) {//判断上传错误信息
            echo "上传错误：";
            switch ($course['error']) {
                case 1:
                    echo "上传文件大小超出配置文件规定值";
                    break;
                case 2:
                    echo "上传文件大小超出表单中的约定值";
                    break;
                case 3:
                    echo "上传文件不全";
                    break;
                case 4:
                    echo "没有上传文件";
                    break;
                default:
                    echo $course['error'];
            }
        } else {
            list($maintype, $subtype) = explode("/", $course['type']);
            $allow_arr = ['avi', 'mp4', 'flv', 'mov', 'mkv'];
            if (!in_array($subtype, $allow_arr)) {//如果要限制文件格式，就去掉注释
                echo "上传文件格式不正确";
            } else {
                if (!is_dir("../resource/courses")) {//判断指定目录是否存在
                    mkdir("../resource/courses");//创建目录
                }
                $path = '../resource/courses/' . time() . strtolower(strstr($course['name'], "."));//定义上传文件名和存储位置
                if (is_uploaded_file($course['tmp_name'])) {//判断文件上传是否为HTTP POST上传
                    if (!move_uploaded_file($course['tmp_name'], $path)) {//执行上传操作
                        echo "上传失败";
                    } else {
                        //echo "文件:" . time() . strtolower(strstr($course['name'], ".")) . "上传成功，大小为：" . $course['size'] . "字节";
                        //入库
                        $upload_arr = [$_POST['upload_title'], $_POST['upload_introduction'], $_POST['upload_subject']];
                        $sql = "insert into course (path,uploader_id,upload_date,subject,title,introduction) values ('" . substr($path, 2) . "','" . $_SESSION['userinfo']['uid'] . "','$date','$upload_arr[2]','$upload_arr[0]','$upload_arr[1]')";
                        if (mysqli_query($conn, $sql)) {
                            echo '<p style="color: green">上传成功！</p>';
                        } else {
                            //echo $sql;
                            echo '<p style="color: red">上传发生错误，请联系管理员</p>';
                        }
                    }
                } else {
                    echo "上传文件：" . $course['name'] . "不合法";
                }
            }
        }
    }
    mysqli_close($conn);
}

//笔记函数
function noteHandler($conn, $date)
{
    switch ($_POST['action']) {
        case 'save': {
            session_start();
            $userinfo = $_SESSION['userinfo'];
            $uid = $userinfo['uid'];
            $courseID = $_POST['courseID'];
            $time = $_POST['time'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $sql = "insert into note (relate_user_id,relate_course_id,note_time,title,content,creat_time) values ('" . $uid . "','" . $courseID . "','" . $time . "','" . $title . "','" . $content . "','" . $date . "')";
            if (mysqli_query($conn, $sql)) {
                //拼接笔记html
                $p1 = '<div class="panel panel-default">
    <div class="panel-heading" role="tab">
        <h4 class="panel-title">
            <div class="note_mark" style="display: none">';
                $p2 = '<p class="id">' . mysqli_insert_id($conn) . '</p>' . '<p class="mark_time">' . $time . '</p>' . '<p class="mark_courseid">' . $_POST['courseID'] . '</p>' . '<p class="mark_userid">' . $uid . '</p>';
                $t = floor($time);//向下取整
                $s = $time % 60;//秒
                $m = floor($time / 60);//分
                $h = floor($time / 3600);//时
                $p3_t = ($h == 0 ? '' : '0' . $h . ':') . ($m < 10 ? ('0' . $m) : $m) . ':' . ($s < 10 ? ('0' . $s) : $s);
                $p3 = '</div><a href="javascript:void(0)"><span class="glyphicon glyphicon-play note_play" aria-hidden="true">'
                    . $p3_t . '</span></a>';

                $p4 = '<span>&nbsp;&nbsp;</span>
            <a class="collapsed" role="button" data-toggle="collapse" href="#collapse' . mysqli_insert_id($conn) . '" aria-expanded="false">'
                    . $title
                    . '</a><a class="note_del" href="javascript:void(0)" style="color: red;float: right">删除</a></h4></div>'
                    . '<div id="collapse' . mysqli_insert_id($conn) . '" class="panel-collapse collapse" role="tabpanel">';

                $p5 = '<div class="panel-body">'
                    . $content
                    . '</div></div></div>';

                //输出
                echo $p1 . $p2 . $p3 . $p4 . $p5;
            } else
                echo $sql;//error
            break;
        }
        case 'delete': {
            $id = $_POST['id'];
            echo $sql = "delete from note where id='" . $id . "'";
            mysqli_query($conn, $sql);
            echo 'OK';
            break;
        }
        default: {
            echo 'ERROR';
        }
    }
    mysqli_close($conn);
}