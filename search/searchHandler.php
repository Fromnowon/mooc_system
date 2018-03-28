<?php
/**
 * Created by PhpStorm.
 * User: ZZH
 * Date: 2018/1/24
 * Time: 21:03
 */
session_start();
if (!isset($_SESSION['userinfo'])) {
    header("Location:../login.php");
}
include '../util/conn.php';
function search_result()
{
    switch ($_GET['action']) {
        case 'key_search':
            {
                key_search();
                break;
            }
        case 'index_key_search':
            {
                //主页三大分栏搜索
                index_key_search();
                break;
            }
        case 'index_key_search_all':
            {
                //所有课程
                index_key_search_all();
                break;
            }
    }
}

//主页三大分栏搜索
function index_key_search()
{
    global $conn;
    $grade = $_GET['grade'];
    $subject = $_GET['subject'];
    if($subject=="信息") $subject="信息技术";
    $sql = "select * from course where grade='$grade' and subject='$subject'";
    $r = mysqli_query($conn, $sql);
    $result = '';
    $count = 0;
    while ($rs = mysqli_fetch_array($r)) {
        if ($count % 5 == 1 && $count != 1) $result .= '</tr><tr>';
        $result .= '<td><div class="port-1 effect-2">
		                	<div class="image-box">
		                    	<img src="../' . $rs['cover'] . '" alt="Image-1" style="width: 260px;height: 160px">
		                    </div>
		                    <div class="text-desc">
		                    <p style="display: none">' . $rs['id'] . '</p>
		                    <a href="javascript:void(0)" class="fa fa-info-circle fa-lg"></a>
		                        <span class="label label-success" style="font-size: 14px">' . $rs['grade'] . '</span>
		                    	<span class="label label-primary" style="font-size: 14px">' . $rs['subject'] . '</span>
		                    	<p style="line-height: 30px">上传时间：' . $rs['upload_date'] . '</p>
		                        <p style="font-size: 16px;">简介：' . $rs['introduction'] . '</p>
		                    	<a  target="_blank" href="../play/play.php?playid=' . $rs['id'] . '" class="btn" style="width: 100px;margin-top: 5px">播放</a>
		                    </div>
		                </div>
		                <div style="text-align: center;"><h4 style="line-height: 40px">' . $rs['title'] . '</h4></div></td>';
        $count++;
    }
    if ($count == 0) echo $result . '<p style="font-size: 20px">当前检索条件：<span class="label label-info">' . $grade . '</span>+<span class="label label-info">' . $subject . '</span></p><hr><p style="color: red;font-size: 24px">无匹配结果！</p>';
    else echo '<p style="font-size: 20px">当前检索条件：<span class="label label-success">' . $grade . '</span> / <span class="label label-info">' . $subject . '</span></p><hr><table><tr>' . $result . '</tr></table>';
    mysqli_close($conn);
}

//关键词搜索
function key_search()
{
    global $conn;
    $search_key = $_POST['search'];
    $result = [];
    $id_table = [];//结果id表
    $sql1 = "select * from course where title like '%$search_key%' or subject like '%$search_key%'" .
        " or introduction like '%$search_key%'";//查询课程
    $r = mysqli_query($conn, $sql1);
    while ($rs = mysqli_fetch_array($r)) {
        $result[] = $rs;
        $id_table[] = $rs['id'];
    }
    $sql2 = "select * from user where real_name like '%$search_key%' or email like '%$search_key%'" .
        " or school like '%$search_key%'";//查询关联用户
    $r2 = mysqli_query($conn, $sql2);
    while ($rs2 = mysqli_fetch_array($r2)) {
        $uid = $rs2['uid'];
        $sql3 = "select * from course where uploader_id='$uid'";
        $r3 = mysqli_query($conn, $sql3);
        while ($rs3 = mysqli_fetch_array($r3)) {
            //检测重复
            if (in_array($rs3['id'], $id_table)) continue;
            $result[] = $rs3;
        }
    }
    //输出结果
    $result_html = '';
    $count = 0;
    foreach ($result as $val) {
        if ($count % 5 == 1 && $count != 1) $result_html .= '</tr><tr>';
        $result_html .= '<td><div class="port-1 effect-2">
		                	<div class="image-box">
		                    	<img src="../' . $val['cover'] . '" alt="Image-1" style="width: 260px;height: 160px">
		                    </div>
		                    <div class="text-desc">
		                    <p style="display: none">' . $val['id'] . '</p>
		                    <a href="javascript:void(0)" class="fa fa-info-circle fa-lg"></a>
		                        <span class="label label-success" style="font-size: 14px">' . $rs['grade'] . '</span>
		                    	<span class="label label-primary" style="font-size: 14px">' . $val['subject'] . '</span>
		                    	<p style="line-height: 30px">上传时间：' . $val['upload_date'] . '</p>
		                        <p style="font-size: 16px;">简介：' . $val['introduction'] . '</p>
		                    	<a  target="_blank" href="../play/play.php?playid=' . $val['id'] . '" class="btn" style="width: 100px;margin-top: 5px">播放</a>
		                    </div>
		                </div>
		                <div style="text-align: center"><h4 style="line-height: 40px">' . $val['title'] . '</h4></div></td>';
    }
    if ($result_html == '') echo '<table><tr><td style="font-size: 20px">当前搜索关键词：<span class="label label-primary">' . $search_key . '</span><hr></td></tr><tr><td><p style="color: red;font-size: 24px">无匹配结果！</p></td></tr></table>';
    else echo '<p style="font-size: 20px">当前搜索关键词：<span class="label label-primary">' . $search_key . '</span></p><hr><table><tr>' . $result_html . '</tr></table>';
    mysqli_close($conn);
}

//所有课程
function index_key_search_all(){
    global $conn;
    $sql = "select * from course";
    $r = mysqli_query($conn, $sql);
    $result = '';
    $count = 0;
    while ($rs = mysqli_fetch_array($r)) {
        if ($count % 5 == 1 && $count != 1) $result .= '</tr><tr>';
        $result .= '<td><div class="port-1 effect-2">
		                	<div class="image-box">
		                    	<img src="../' . $rs['cover'] . '" alt="Image-1" style="width: 260px;height: 160px">
		                    </div>
		                    <div class="text-desc">
		                    <p style="display: none">' . $rs['id'] . '</p>
		                    <a href="javascript:void(0)" class="fa fa-info-circle fa-lg"></a>
		                        <span class="label label-success" style="font-size: 14px">' . $rs['grade'] . '</span>
		                    	<span class="label label-primary" style="font-size: 14px">' . $rs['subject'] . '</span>
		                    	<p style="line-height: 30px">上传时间：' . $rs['upload_date'] . '</p>
		                        <p style="font-size: 16px;">简介：' . $rs['introduction'] . '</p>
		                    	<a  target="_blank" href="../play/play.php?playid=' . $rs['id'] . '" class="btn" style="width: 100px;margin-top: 5px">播放</a>
		                    </div>
		                </div>
		                <div style="text-align: center;"><h4 style="line-height: 40px">' . $rs['title'] . '</h4></div></td>';
        $count++;
    }
    if ($count == 0) echo $result . '<p style="font-size: 20px">当前检索条件：<span class="label label-danger">无限制</span></p><hr><p style="color: red;font-size: 24px">无匹配结果！</p>';
    else echo '<p style="font-size: 20px">当前检索条件：<span class="label label-danger">无限制</span></p><hr><table><tr>' . $result . '</tr></table>';
    mysqli_close($conn);
}