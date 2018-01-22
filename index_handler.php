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
		                    	<h3'.$rs['title'].'</h3>
		                    	<h4>'.$rs['subject'].'</h4>
		                        <p>'.$rs['introduction'].'</p>
		                    	<a href="play/play.php?playid='.$rs['id'].'" class="btn">播放</a>
		                    </div>
		                </div>
		                <div style="text-align: center"><h4>'.$rs['title'].'</h4></div></td>';
    }
}