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
    case 'login':
        {
            $login_username = $_POST['login_username'];
            $login_password = md5($_POST['login_password']);
            $login_checkbox = $_POST['logintoadmin'];
            login($conn, $login_username, $login_password, $login_checkbox);
            break;
        }
    case 'register':
        {
            register($conn, $date);
            break;
        }
    case 'course_upload':
        {
            courseUpload($conn, $date);
            break;
        }
    case 'note':
        {
            noteHandler($conn, $date);
            break;
        }
    case 'reply':
        {
            replyHandler($conn, $date);
            break;
        }
    case 'logout':
        {
            $_SESSION = [];
            session_destroy();
            header("Location: ../login.php");
            break;
        }
    default :
        {
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
function register($conn, $date)
{
    //echo 'OK';exit();
    $username = $_POST['reg_username'];
    $password = md5($_POST['reg_password']);
    $email = nullHandler($_POST['reg_mail']);
    $school = nullHandler($_POST['reg_school']);
    $contact = nullHandler($_POST['reg_contact']);
    $reg_realname = nullHandler($_POST['reg_realname']);
    $sql = "insert into user (username,password,real_name,email,contact,school,introduction,reg_date) values ('$username','$password','$reg_realname','$email','$contact','$school','暂无','$date')";
    if (mysqli_query($conn, $sql))
        echo 'OK';
    else
        echo $sql;
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
            $allow_arr = ['avi', 'mp4', 'flv', 'mov', 'mkv', 'quicktime'];
            if (!in_array($subtype, $allow_arr)) {//如果要限制文件格式，就去掉注释
                echo "上传文件格式不正确";
            } else {
                $dir = time();
//                if (!is_dir("../resource/courses")) {//判断指定目录是否存在
//                    mkdir("../resource/courses" . $dir);//创建目录
//                }
                mkdir("../resource/courses/" . $dir);//创建目录
                $filename = $dir . strtolower(strstr($course['name'], "."));//定义上传文件名
                $path = '../resource/courses/' . $dir . '/' . $filename;
                if (is_uploaded_file($course['tmp_name'])) {//判断文件上传是否为HTTP POST上传
                    if (!move_uploaded_file($course['tmp_name'], $path)) {//执行上传操作
                        echo "上传失败";
                    } else {
                        //echo "文件:" . time() . strtolower(strstr($course['name'], ".")) . "上传成功，大小为：" . $course['size'] . "字节";
                        //入库
                        //生成封面
                        $movie = new ffmpeg_movie('../resource/courses/' . $dir . '/' . $filename);
                        $ff_frame = $movie->getFrame(300);
                        $gd_image = $ff_frame->toGDImage();
                        $img = "../resource/courses/" . $dir . "/cover.jpg";
                        imagejpeg($gd_image, $img);
                        imagedestroy($gd_image);


                        $upload_arr = [nullHandler($_POST['upload_title']), nullHandler($_POST['upload_introduction']), $_POST['upload_subject'], $_POST['upload_grade']];
                        $sql = "insert into course (path,cover,uploader_id,upload_date,grade,subject,title,introduction) values ('" . $path . "','" . substr($img, 3) . "','" . $_SESSION['userinfo']['uid'] . "','$date','$upload_arr[3]','$upload_arr[2]','$upload_arr[0]','$upload_arr[1]')";
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
        case 'save':
            {
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
                    $p3 = '</div><a  title="点击从此时间点播放" href="javascript:void(0)"><span class="glyphicon glyphicon-play note_play" aria-hidden="true">'
                        . $p3_t . '</span></a>';

                    $p4 = '<span>&nbsp;&nbsp;</span>
            <a title="点击展开或收起笔记" class="collapsed" role="button" data-toggle="collapse" href="#collapse' . mysqli_insert_id($conn) . '" aria-expanded="false">'
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
        case 'delete':
            {
                $id = $_POST['id'];
                echo $sql = "delete from note where id='" . $id . "'";
                mysqli_query($conn, $sql);
                echo 'OK';
                break;
            }
        case 'rating':
            {
                $rating = $_POST['rating'];//拿到评分
                $id = $_POST['id'];
                $sql = "select * from course where id='" . $id . "'";
                $rs = mysqli_fetch_array(mysqli_query($conn, $sql));
                if ($rs['rating'] == null) {
                    $rs['rating'] = $rating;
                } else {
                    //处理显示评分
                    $t = (($rs['rating'] * $rs['rating_count']) + $rating) / ($rs['rating_count'] + 1);
                    $x = floor($t);//取整
                    $y = $t * 10 % 10;//取第一位小数
                    if ($y == 0 || $y == 5) {
                        //无需处理

                    } else {
                        if ($y > 2 && $y < 8)
                            $y = 5;
                        else if ($y < 3)
                            $y = 0;
                        else if ($y > 7) {
                            $x++;//进位
                            $y = 0;
                        }
                    }
                    $rs['rating'] = ($x * 10 + $y) / 10;
                }
                $rs['rating_count']++;
                $sql = "update course set rating='" . $t . "',rating_count='" . $rs['rating_count'] . "',rating_show='" . $rs['rating'] . "' where id='" . $id . "'";
                if (mysqli_query($conn, $sql)) {
                    echo $rs['rating'];
                } else echo $sql;
                break;
            }
        default:
            {
                echo 'ERROR';
            }
    }
    mysqli_close($conn);
}

//回复函数
function replyHandler($conn, $date)
{
    $userID = $_SESSION['userinfo']['uid'];//当前登录的用户id，即发表回复用户id

    if ($_POST['action'] == 'toreply') {
        $id = $_POST['id'];
        $content = $_POST['content'];
        $avatar = $_SESSION['userinfo']['avatar'];
        $real_name = $_SESSION['userinfo']['real_name'];
        $sql = "insert into toreply (relate_reply_id,relate_user_id,avatar,real_name,content,sub_date) values ('$id','$userID','$avatar','$real_name','$content','$date')";
        if (mysqli_query($conn, $sql)) {
            echo '<tr>
            <td colspan="2" class="toreply">
            <div><span style="font-weight: bold">' . $_SESSION['userinfo']['real_name'] . ':</span><p style="word-break: break-all">' . $content . '</p></div>
            <div><span>' . $date . '</span><a href="javascript:void(0)" style="float: right" class="replytoreply">回复TA</a></div>
            </td>
            </tr>';
        } else echo $sql;
    } else {
        $courseID = $_POST['courseID'];
        $content = $_POST['content'];

        //reply表需要写入发布者的部分信息
        $user = mysqli_fetch_array(mysqli_query($conn, "select * from user where uid='$userID'"));
        $avatar = $user['avatar'];
        $real_name = $user['real_name'];

        $sql = "insert into reply (relate_course_id,relate_user_id,avatar,real_name,content,sub_date) values ('$courseID','$userID','$avatar','$real_name','$content','$date')";
        if (mysqli_query($conn, $sql)) {
            echo '<table class="reply_table" flag="' . mysqli_insert_id($conn) . '">
            <tr>
                <td>
                    <img class="avatar" src="../resource/avatar/' . $avatar . '.png" alt="avatar">
                    <span class="reply_username">' . $real_name . '</span>
                </td>
                <td  style="text-align: right">
                    <span class="new_floor_flag">&nbsp;&nbsp;&nbsp;</span><span>发布于：<span class="time">' . $date . '</span></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="content">
                        ' . $content . '
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div style="text-align: right">
                        <a class="reply_btn">参与讨论</a>
                    </div>
                    <div></div>
                    <div class="reply_edit" style="height: 0;overflow: hidden">
                        <textarea class="form-control" rows="6" style="resize: none"></textarea>
                        <br/>
                        <button class="btn btn-sm btn-default">提交</button>
                        <span>&nbsp;&nbsp;&nbsp;</span>
                        <span style="color: blue" class="reply_edit_limit"></span>
                        <span>/200</span>
                    </div>
                    <div style="clear: both"></div>
                </td>
            </tr>
            <tr><td colspan="2"><hr></td></tr>
        </table>';
        } else echo $sql;
    }
    mysqli_close($conn);
}

//处理空值
function nullHandler($t)
{
    return $t == '' || $t == null ? '其他' : $t;
}