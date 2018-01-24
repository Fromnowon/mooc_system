<?php
/**
 * Created by PhpStorm.
 * User: ZZH
 * Date: 2018/1/21
 * Time: 22:21
 */
include 'util/conn.php';
session_start();
if (!isset($_SESSION['userinfo'])) {
    header("Location:login.php");
}
function newest()
{
    global $conn;
    $sql = "select * from course order by upload_date desc limit 5";
    $r = mysqli_query($conn, $sql);
    while ($rs = mysqli_fetch_array($r)) {
        echo '<td><div class="port-1 effect-1">
		                	<div class="image-box">
		                    	<img src="' . $rs['cover'] . '" alt="Image-1" style="width: 260px;height: 160px">
		                    </div>
		                    <div class="text-desc">
		                    <p style="display: none">'.$rs['id'].'</p>
		                    <a href="javascript:void(0)" class="fa fa-info-circle fa-lg"></a>
		                    	<span class="label label-primary" style="font-size: 14px">'.$rs['subject'].'</span>
		                    	<p style="line-height: 30px">上传时间：'.$rs['upload_date'].'</p>
		                        <p style="font-size: 16px;">简介：'.$rs['introduction'].'</p>
		                    	<a href="play/play.php?playid='.$rs['id'].'" class="btn" style="width: 100px;margin-top: 5px">播放</a>
		                    </div>
		                </div>
		                <div style="text-align: center"><h4>'.$rs['title'].'</h4></div></td>';
    }
}

function hottest(){
    global $conn;
    $sql = "select * from course order by views desc limit 5";
    $r = mysqli_query($conn, $sql);
    while ($rs = mysqli_fetch_array($r)) {
        echo '<td><div class="port-1 effect-1">
		                	<div class="image-box">
		                    	<img src="' . $rs['cover'] . '" alt="Image-1" style="width: 260px;height: 160px">
		                    </div>
		                    <div class="text-desc">
		                    <p style="display: none">'.$rs['id'].'</p>
		                    <a href="javascript:void(0)" class="fa fa-info-circle fa-lg"></a>
		                    	<span class="label label-primary" style="font-size: 14px">'.$rs['subject'].'</span>
		                    	<p style="line-height: 30px">上传时间：'.$rs['upload_date'].'</p>
		                        <p style="font-size: 16px;">简介：'.$rs['introduction'].'</p>
		                    	<a href="play/play.php?playid='.$rs['id'].'" class="btn" style="width: 100px;margin-top: 5px">播放</a>
		                    </div>
		                </div>
		                <div style="text-align: center"><h4>'.$rs['title'].'</h4></div></td>';
    }
}