<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2018/1/13
 * Time: 13:41
 */
session_start();
if (!isset($_SESSION['userinfo'])) {
    header("Location:../login.php");
}
//返回顶部块
function headerInfo()
{
    $userinfo = "<div class='play_userinfo_avatar'><a class='history'>观看历史</a><img src='../resource/avatar/" . $_SESSION['userinfo']['avatar'] . ".png'>";
    echo $userinfo . '<p class="play_userinfo_name">' . $_SESSION['userinfo']['username'] . '</p></div>';

}

include '../util/conn.php';
$uid = $_SESSION['userinfo']['uid'];
$courseID = $_GET['playid'];

//浏览量+1
mysqli_query($conn, "update course set views=views+1 where id='$courseID'");


//返回标题
$sql = "select * from course where id='" . $courseID . "'";//注意，这行必须写在函数外
$rs = mysqli_fetch_array(mysqli_query($conn, $sql));//注意，这行必须写在函数外
if (count($rs) == 0) {
    echo '迷路啦，没有这个视频！';
    mysqli_close($conn);
    exit();
}
$uploaderID = $rs['uploader_id'];
function titleInfo()
{
    global $courseID;
    global $rs;
    if ($rs['title'] == '' || $rs['title'] == null) echo "<span value='$courseID'>未命名</span>" . "<span class='userID' style='display: none'>" . $rs['uploader_id'] . "</span>";
    else echo "<span value='$courseID'>" . $rs['title'] . "</span>" . "<span class='userID' style='display: none'>" . $rs['uploader_id'] . "</span>";
}

//返回视频地址
function courseSource()
{
    global $rs;
    echo '<source src="http://172.96.222.54' . $rs['path'] . '"type="video/mp4"/>';
}

//加载笔记
$sql = "select * from note where relate_user_id='$uid' and relate_course_id='$courseID' order by note_time desc";//进度升序//注意，这行必须写在函数外
$r = mysqli_query($conn, $sql);//注意，这行必须写在函数外
function loadNote()
{
    global $r;
    $p = '';
    while ($rs = mysqli_fetch_array($r)) {
        //拼接笔记html
        $p1 = '<div class="panel panel-default">
    <div class="panel-heading" role="tab">
        <h4 class="panel-title">
            <div class="note_mark" style="display: none">';
        $p2 = '<p class="id">' . $rs['id'] . '</p>' . '<p class="mark_time">' . $rs['note_time'] . '</p>' . '<p class="mark_courseid">' . $rs['relate_course_id'] . '</p>' . '<p class="mark_userid">' . $rs['relate_user_id'] . '</p>';
        $t = floor($rs['note_time']);//向下取整
        $s = $rs['note_time'] % 60;//秒
        $m = floor($rs['note_time'] / 60);//分
        $h = floor($rs['note_time'] / 3600);//时
        $p3_t = ($h == 0 ? '' : '0' . $h . ':') . ($m < 10 ? ('0' . $m) : $m) . ':' . ($s < 10 ? ('0' . $s) : $s);
        $p3 = '</div><a title="点击从此时间点播放" href="javascript:void(0)"><span class="glyphicon glyphicon-play note_play" aria-hidden="true">'
            . $p3_t . '</span></a>';

        $p4 = '<span>&nbsp;&nbsp;</span>
            <a  title="点击展开或收起笔记" class="collapsed" role="button" data-toggle="collapse" href="#collapse' . $rs['id'] . '" aria-expanded="false">'
            . $rs['title']
            . '</a><a class="note_del" href="javascript:void(0)" style="color: red;float: right">删除</a></h4></div>'
            . '<div id="collapse' . $rs['id'] . '" class="panel-collapse collapse" role="tabpanel">';

        $p5 = '<div class="panel-body">'
            . $rs['content']
            . '</div></div></div>';
        $p .= $p1 . $p2 . $p3 . $p4 . $p5;
    }
    echo $p;
}

//加载课程信息块
function courseInfo()
{
    global $rs;
    $course_info = '<div class="course_info_p1">
            <div class="p1_title">' . $rs['title'] . '</div>
            <div class="course_rating">
                <span class="course_rating_star"></span>
                <span class="live-rating">' . $rs['rating_show'] . '</span>
            </div>
            <div class="course_rating_count">评分数：<span>' . $rs['rating_count'] . '</span>次</div>
            <div class="course_views">浏览量：<span>' . $rs['views'] . '</span>次，</div>
        </div>
        <div class="clear"></div>
        <div class="course_info_p2">
            <p class="p2_subject">所属科目：<span>' . $rs['subject'] . '</span></p>
        </div>
        <hr/>
        <div class="course_info_p3">
            <div class="p3_content">' . $rs['introduction'] . '</div>
        </div>';
    echo $course_info;
}

//加载教师信息块
$sql_t = "select * from user where uid='" . $uploaderID . "'";
$rs_t = mysqli_fetch_array(mysqli_query($conn, $sql_t));
function teacherInfo()
{
    global $rs_t;
    $t = '<div class="teacher_info_p1">
            <table>
                <tr>
                    <td><img src="../resource/avatar/' . $rs_t['avatar'] . '.png"></td>
                    <td>
                        <div>
                            <p>' . $rs_t['real_name'] . '</p>
                            <p>' . $rs_t['school'] . '</p>
                        </div></td>
                </tr>
            </table>
            <hr/>
            <div class="teacher_info_p2">
                <p>' . $rs_t['introduction'] . '</p>
            </div>
        </div>';
    echo $t;
}

mysqli_close($conn);