<?php
include 'util/conn.php';
session_start();
if (!isset($_SESSION['userinfo'])) {
    header("Location:login.php");
}

function pull_list($sql)
{
    global $conn;
    $r = mysqli_query($conn, $sql);
    while ($rs = mysqli_fetch_array($r)) {
        $rs['upload_date'] = explode(' ', $rs['upload_date'])[0];
        if (explode('-', $rs['upload_date'])[0] == date('Y')) {
            $rs['upload_date'] = explode('-', $rs['upload_date'])[1] . '-' . explode('-', $rs['upload_date'])[2];
        }
        print <<<EOT
<div style="float:left;margin-top: 10px;" class="ui special cards">
                    <div class="card">
                        <div class="blurring dimmable image">
                            <div class="ui dimmer">
                                <div class="content">
                                    <div class="center">
                                        <div>
                                            <button class="mini ui positive button" style="width: 100px" onclick="(function() {
                                              window.open('play/play.php?playid=' + {$rs['id']});
                                            })()"><i class="icon play"></i>播&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;放
                                            </button>
                                        </div>
                                        <br>
                                        <div>
                                            <button class="mini ui button" style="width: 100px">
                                            <i class="icon plus"></i>加入列表
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img class="cover_img" style="width: 224px;height: 130px;" src="{$rs['cover']}">
                        </div>
                        <div class="content">
                            <a class="header"  style="overflow:hidden;text-overflow:ellipsis"><nobr>{$rs['title']}</nobr></a>
                            <div class="meta" style="margin-top: 10px">
                                <span class="date">上传时间：{$rs['upload_date']}</span><br>
                                <span class="date">观看数：222</span>
                            </div>
                        </div>
                    </div>
                </div>
EOT;

    }
}


function newest()
{
    pull_list("select * from course order by upload_date desc limit 5");
}

function hottest()
{
    pull_list("select * from course order by views desc limit 5");
}