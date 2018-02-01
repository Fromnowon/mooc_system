<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/26
 * Time: 9:53
 */
include '../util/conn.php';
switch ($_GET['action']) {
    case 'tag_search':
        {
            tag_search();
            break;
        }
    case 'search_key':
        {
            search_key();
            break;
        }
}
function tag_search()
{
    global $conn;
    $result = '';
    $data = json_decode(stripslashes($_POST['data']), true);
    $sql = 'select * from course';
    $flag = 0;//控制where和and
    $flag_subject = 0;
    $filter = '';
    foreach ($data as $val) {
        if ($val['name'] == 'grade') {
            if ($flag == 0) {
                $sql .= " where (grade='" . $val['value'] . "'";
                $flag++;
                $filter .= '<span class="label label-success">' . $val['value'] . '</span>';
            } else {
                $sql .= " or grade='" . $val['value'] . "'";
                $flag++;
                $filter .= '+<span class="label label-success">' . $val['value'] . '</span>';
            }
        } else if ($val['name'] == 'subject') {
            if ($flag != 0 && $flag_subject == 0) {
                $sql .= ') and (';
                $flag_subject = 1;
                $flag = 0;
                $filter .= ' / ';
            } else if ($flag == 0) {
                $sql .= ' where (';
                $flag_subject = 1;
            }
            if ($flag == 0) {
                $sql .= " subject='" . $val['value'] . "'";
                $flag++;
                $filter .= '<span class="label label-info">' . $val['value'] . '</span>';
            } else {
                $sql .= " or subject='" . $val['value'] . "'";
                $flag++;
                $filter .= '+<span class="label label-info">' . $val['value'] . '</span>';
            }
        }
    }
    if ($flag != 0) $sql .= ')';
    else $filter='<span class="label label-danger">无限制</span>';
    $r = mysqli_query($conn, $sql);
    if (mysqli_num_rows($r) == 0) {
        echo '<table><tr><td style="font-size: 20px">当前检索条件：' . $filter . '<hr></td></tr><tr><td><p style="color: red;font-size: 24px">无匹配结果！</p></td></tr></table>';
        mysqli_close($conn);
        exit();
    }
    $count = 1;
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
    echo '<script >console.log("' . $sql . '");</script><p style="font-size: 20px">当前检索条件：' . $filter . '</p><hr><table><tr>' . $result . '</tr></table>';
    mysqli_close($conn);
}

function search_key()
{
    global $conn;
    $search_key = $_POST['data'];
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
    $count = 1;
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
        $count++;
    }
    if ($result_html == '') echo '<table><tr><td style="font-size: 20px">当前搜索关键词：<span class="label label-primary">' . $search_key . '</span><hr></td></tr><tr><td><p style="color: red;font-size: 24px">无匹配结果！</p></td></tr></table>';
    else echo '<p style="font-size: 20px">当前搜索关键词：<span class="label label-primary">' . $search_key . '</span></p><hr><table><tr>' . $result_html . '</tr></table>';
    mysqli_close($conn);
}