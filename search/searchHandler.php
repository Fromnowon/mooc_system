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
    }
}

//主页三大分栏搜索
function index_key_search()
{
    global $conn;
    $grade = $_GET['grade'];
    $subject = $_GET['subject'];
    $sql = "select * from course where grade='$grade' and subject='$subject'";
    $r = mysqli_query($conn, $sql);
    $result = '';
    $count = 0;
    while ($rs = mysqli_fetch_array($r)) {
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
        if ($count == 5) $result .= '<tr>' . $result . '</tr>';
    }
    if ($count == 0) echo '<td><p style="color: red;font-size: 24px">无匹配结果！</p></td>';
    echo $result;
    mysqli_close($conn);
}

//关键词搜索
function key_search()
{
    global $conn;
    $search_key = $_GET['search'];
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
    foreach ($result as $val) {
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
    if ($result_html == '') echo '<td><p style="color: red;font-size: 24px">无匹配结果！</p></td>';
    else echo $result_html;
    mysqli_close($conn);
}