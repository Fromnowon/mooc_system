<?php
/**
 * Created by PhpStorm.
 * User: ZZH
 * Date: 2018/1/6
 * Time: 11:46
 */
//准备阶段
if (!isset($_GET['admin_action'])) {
    //非法访问
    echo 'No action received.';
    exit();
}
include('conn.php');
switch ($_GET['admin_action']) {
    case 'user_status': {
        //返回查询数据，注意判断动作类型
        allUsers($conn, $_POST['page'], $_POST['action']);
        break;
    }
    case 'edit_add': {
        editOrSave($conn, $date);
        break;
    }
    case 'logout': {
        $_SESSION = [];
        session_destroy();
        header("Location: ../login.php");
        break;
    }

}
function allUsers($conn, $page, $action)
{
    //查询
    $num = 10;//每页数据量
    $num_start = ($page - 1) * 10;//每页第一条数据位置
    $check_query = mysqli_query($conn, "select * from user limit $num_start,$num");
    $rs = array();
    while ($r = mysqli_fetch_array($check_query)) {
        $rs[count($rs)] = $r;
    }

    /*准备拼接html*/

    //表格主体
    $form_main = '';
    $i = 0;//行数
    $j = 0;//列数
    foreach ($rs as $val) {
        $form_main .= '<tr>';
        foreach ($val as $key => $val_row) {
            if ($val_row == '' || $val_row == null) $val_row = '暂无';
            if ($key == 'flag') {
                switch ($val_row) {
                    case 0:
                        $val_row = '普通用户';
                        break;
                    case 1;
                        $val_row = '管理员';
                        break;
                    case 2;
                        $val_row = '网站维护人';
                        break;
                    default:
                        $val_row = '未知';
                        break;
                }
            }
            if ($key == 'status') {
                switch ($val_row) {
                    case 0:
                        $val_row = '封禁';
                        break;
                    case 1;
                        $val_row = '正常';
                        break;
                    case 2;
                        $val_row = '禁止上传';
                        break;
                    case 3;
                        $val_row = '禁止发言';
                        break;
                    default:
                        $val_row = '未知';
                        break;
                }
            }
            if ($key == 'gender') {
                switch ($val_row) {
                    case 0:
                        $val_row = '保密';
                        break;
                    case 1;
                        $val_row = '男';
                        break;
                    case 2;
                        $val_row = '女';
                        break;
                    default:
                        $val_row = '未知';
                        break;
                }
            }
            if ($key == 'password' || $key == 'avatar' || $key == 'like_id' || $key == 'dislike_id' || is_numeric($key)) {
                //啥都不做
            } else {
                $form_main .= "<td class=" . $key . ">" . $val_row . "</td>";
                $j++;
            }
        }
        $form_main .= "</tr>";
        $i++;
    }
    $j /= $i;
    //补全
    while ($i < $num) {
        $form_main .= "<tr>";
        $x = 0;
        while ($x < $j) {
            $form_main .= '<td><span style="visibility: hidden">0</span></td>';
            $x++;
        }
        $form_main .= "</tr>";
        $i++;
    }

    //若是分页，则只返回表格主体
    if ($action == 'page') {
        echo $form_main;
        mysqli_close($conn);
        exit();
    }

    //“新增”按钮
    $addBtn = "<div id='form_misc'><button type='button' class='btn btn-success' onclick='editData(\"new\")'>
<span class='glyphicon glyphicon-plus'></span>新增</button>";

    //搜索框
    $form_search_html = '<div class="input-group col-lg-3" style="float: right">' .
        '<input type="text" class="form-control" placeholder="用户名、姓名、邮箱等">' .
        '<span class="input-group-btn">' .
        '<button class="btn btn-default" type="button">查询</button></span></div></div><br/><br/>';
    //页码
    $total_data = mysqli_num_rows(mysqli_query($conn, "select * from user"));;
    $total_page = ceil($total_data / 10);
    $page_html = '<nav aria-label="Page navigation"><ul class="pagination" id="page_btn">';
    //page_btn.children().remove();
    $i = 1;
    while ($i <= $total_page) {
        $page_html .= "<li><a href='javascript:void(0)' onclick='loadData($i,\"page\")'>$i</a></li>";
        $i++;
    }
    $page_html .= "</ul></nav>";
    //表头
    $form_head = '<div id="form_content"><table class="table table-bordered table-responsive"  id="user_status">' .
        '<thead id=\'result\'><tr><th>id</th><th>用户名</th><th>邮箱</th><th>联系方式</th><th>名字</th><th>性别</th>' .
        '<th>学校</th><th>注册时间</th><th>简介</th><th>身份</th><th>状态</th>' .
        '<th>科目</th><th>上传数</th><th>标签</th><th>赞</th><th>踩</th></tr></thead>';
    //echo $form_search_html.$table_head_html.$page_html;

    //完全拼接
    echo $addBtn . $form_search_html . $form_head . $form_main . '</table></div>' . $page_html;
    mysqli_close($conn);
}

function editOrSave($conn, $date)
{
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $flag = $_POST['flag'];
    $status = $_POST['status'];
    $realname = $_POST['realname'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $school = $_POST['school'];
    $introduction = $_POST['introduction'];
    if ($_POST['action'] == 'new') {
        //查重
        if (mysqli_num_rows(mysqli_query($conn, "select * from user where username='$username'")) > 0) {
            echo "CONFLICT";
            mysqli_close($conn);
            exit();
        }
        $sql = "insert into user (username,password,flag,status,real_name,gender,contact,school,introduction,reg_date)" .
            "values ('$username','$password','$flag','$status','$realname','$gender','$contact','$school','$introduction','$date')";
        if (mysqli_query($conn, $sql))
            echo 'OK';
        else
            echo 'ERROR';
        mysqli_close($conn);
    }
}