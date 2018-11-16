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
                                            <button class="small ui positive button" style="width: 120px" onclick="(function() {
                                              window.open('play/play.php?playid=' + {$rs['id']});
                                            })()"><i
                                                        class="icon play"></i>播放
                                            </button>
                                        </div>
                                        <br>
                                        <div>
                                            <button class="small ui button" style="width: 120px"><i
                                                        class="icon plus"></i>加入列表
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img class="cover_img" style="width: 224px;height: 130px;" src="{$rs['cover']}">
                        </div>
                        <div class="content">
                            <a class="header">{$rs['title']}</a>
                            <div class="meta">
                                <span class="date">上传时间：{$rs['upload_date']}</span>
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