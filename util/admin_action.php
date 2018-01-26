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
        sqlUsers($conn, $_POST['page'], $_POST['action']);
        break;
    }
    case 'edit_add': {
        editOrSave($conn, $date, $_POST['action']);
        break;
    }
    case 'course_status': {
        sqlCourse($conn, $_POST['page'], $_POST['action'], $date);
        break;
    }
    case 'logout': {
        $_SESSION = [];
        session_destroy();
        header("Location: ../login.php");
        break;
    }

}
function sqlCourse($conn, $page, $action, $date)
{
    //修改
    if ($action == 'course_edit') {
        $id = $_POST['id'];
        $flag = $_POST['flag'];//数值
        $subject = $_POST['subject'];
        $title = $_POST['title'];
        $introduction = $_POST['introduction'];
        $sql = "update course set flag='$flag',subject='$subject',title='$title',introduction='$introduction',edit_date='$date' where id='$id'";
        if (mysqli_query($conn, $sql))
            echo $date;
        else
            echo $sql;//检查sql语句
        mysqli_close($conn);
        exit();
    }


    //表头
    $form_head = '<div id="form_content"><table class="table table-bordered table-responsive"  id="course_status">' .
        '<thead id=\'result\'><tr><th>id</th><th>审核状态</th><th>路径</th><th>封面</th><th>所属id</th><th>上传时间</th><th>年级</th><th>科目</th>' .
        '<th>标题</th><th>介绍</th><th>浏览量</th><th>评分</th><th>评分（格式化）</th><th>评分数</th><th>赞</th><th>踩</th><th>最后编辑</th></thead>';

    //查询函数
    $rs = sqlResult($conn, $page, 'course');

    //表格主体
    $form_main = '';
    $i = 0;//行数
    $j = 0;//列数
    foreach ($rs as $val) {
        $form_main .= '<tr>';
        foreach ($val as $key => $val_row) {
            if ($key == 'edit_date') $val_row = '暂无';
            if ($key == 'flag') {
                switch ($val_row) {
                    case '-1':
                        $val_row = '<span value="-1">屏蔽</span>';
                        break;
                    case '0':
                        $val_row = '<span value="0">正常</span>';
                        break;
                    case '1':
                        $val_row = '<span value="1">审核中</span>';
                        break;
                }
            }
            if ($key == 'rating' || $key == 'rating_show') {
                if ($val_row == '' || $val_row == null) $val_row = '暂无';
            }
            if (!is_numeric($key)) {
                $form_main .= "<td class=" . $key . ">" . $val_row . "</td>";
                $j++;
            }
        }
        $form_main .= "</tr>";
        $i++;
    }
    $j /= $i;
    //补全
    while ($i < 10) {
        $form_main .= "<tr>";
        $x = 0;
        while ($x < $j) {
            $form_main .= '<td><span style="visibility: hidden">0</span></td>';
            $x++;
        }
        $form_main .= "</tr>";
        $i++;
    }

    if ($action == 'page') {
        echo $form_main;
        mysqli_close($conn);
        exit();
    }

    //页码
    $total_data = mysqli_num_rows(mysqli_query($conn, "select * from course"));
    $total_page = ceil($total_data / 10);
    $page_html = '<nav aria-label="Page navigation"><ul class="pagination" id="page_btn">';
    $i = 1;
    while ($i <= $total_page) {
        $page_html .= "<li><a href='javascript:void(0)' onclick='loadCourseData($i,\"page\")'>$i</a></li>";
        $i++;
    }
    $page_html .= "</ul></nav>";

    // echo $form_main;
    echo $form_head . $form_main . '</table></div>' . $page_html;
    mysqli_close($conn);
}

function sqlUsers($conn, $page, $action)
{
    //表头
    $form_head = '<div id="form_content"><table class="table table-bordered table-responsive"  id="user_status">' .
        '<thead id=\'result\'><tr><th>id</th><th>用户名</th><th>姓名(昵称)</th><th>性别</th><th>邮箱</th><th>联系方式</th>' .
        '<th>学校</th><th>注册时间</th><th>简介</th><th>身份</th><th>状态</th>' .
        '<th>科目</th><th>上传数</th><th>标签</th><th>赞</th><th>踩</th><th>最后编辑</th></tr></thead>';
    //echo $form_search_html.$table_head_html.$page_html;

    //搜索
    if ($action == 'user_search') {
        $filter_arr = ['ALL', 'username', 'real_name', 'school', 'email'];
        $filter = $_POST['filter'];
        $search_key = $_POST['search_key'];
        $num = 10;//每页数据量
        $num_start = ($page - 1) * 10;//每页第一条数据位置
        if ($filter == '0') {
            $sql = "select * from user where username like '%$search_key%' or real_name like '%$search_key%'" .
                " or school like '%$search_key%' or email like '%$search_key%' limit $num_start,$num";
//            echo $sql;
//            exit();
            $check_query = mysqli_query($conn, $sql);
            $rs = array();
            while ($r = mysqli_fetch_array($check_query)) {
                $rs[count($rs)] = $r;
            }
            //若无结果直接返回
            if (count($rs, COUNT_NORMAL) == 0) {
                echo $form_head . '<tr style="text-align: center;font-size: 18px"><td colspan="17" style="color: red">无结果匹配</td></tr>' . '</table></div>';
                exit();
            }
        } else {
            $sql = "select * from user where $filter_arr[$filter] like '%$search_key%' limit $num_start,$num";
//            echo $sql;
//            exit();
            $check_query = mysqli_query($conn, $sql);
            $rs = array();
            while ($r = mysqli_fetch_array($check_query)) {
                $rs[count($rs)] = $r;
            }
            //若无结果直接返回
            if (count($rs, COUNT_NORMAL) == 0) {
                echo $form_head . '<tr style="text-align: center;font-weight: bold;font-size: 18px"><td colspan="17" style="color: red">无结果匹配</td></tr>' . '</table></div>';
                exit();
            }
        }
        //重新生成页码
        if ($filter == '0') {
            $total_data = mysqli_num_rows(mysqli_query($conn, "select * from user where username like '%$search_key%' or real_name like '%$search_key%'" .
                " or school like '%$search_key%' or email like '%$search_key%'"));
        } else {
            $total_data = mysqli_num_rows(mysqli_query($conn, "select * from user where $filter_arr[$filter] like '%$search_key%'"));
        }
        $total_page = ceil($total_data / 10);
        $page_html = '<nav aria-label="Page navigation"><ul class="pagination" id="page_btn">';
        //page_btn.children().remove();
        $i = 1;
        while ($i <= $total_page) {
            $page_html .= "<li><a href='javascript:void(0)' onclick='userSearch($i)'>$i</a></li>";
            $i++;
        }
    } else {
        $rs = sqlResult($conn, $page, 'user');
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
                        $val_row = '<span value="0">普通用户</span>';
                        break;
                    case 1;
                        $val_row = '<span value="1">管理员</span>';
                        break;
                    case 2;
                        $val_row = '<span value="2">网站维护人</span>';
                        break;
                    default:
                        $val_row = '<span value="-1">未知</span>';
                        break;
                }
            }
            if ($key == 'status') {
                switch ($val_row) {
                    case 0:
                        $val_row = '<span value="0">封禁</span>';
                        break;
                    case 1;
                        $val_row = '<span value="1">正常</span>';
                        break;
                    case 2;
                        $val_row = '<span value="2">禁止上传</span>';
                        break;
                    case 3;
                        $val_row = '<span value="3">禁止发言</span>';
                        break;
                    default:
                        $val_row = '<span value="-1">未知</span>';
                        break;
                }
            }
            if ($key == 'gender') {
                switch ($val_row) {
                    case 0:
                        $val_row = '<span value="0">保密</span>';
                        break;
                    case 1;
                        $val_row = '<span value="1">男</span>';
                        break;
                    case 2;
                        $val_row = '<span value="2">女</span>';
                        break;
                    default:
                        $val_row = '<span value="-1">未知</span>';
                        break;
                }
            }
            if ($key == 'subject') {
                $val_row = '<span value="' . $val_row . '">' . $val_row . '</span>';
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
    while ($i < 10) {
        $form_main .= "<tr>";
        $x = 0;
        while ($x < $j) {
            $form_main .= '<td><span style="visibility: hidden">0</span></td>';
            $x++;
        }
        $form_main .= "</tr>";
        $i++;
    }

    //若是分页或查询，则提前返回
    if ($action == 'page') {
        echo $form_main;
        mysqli_close($conn);
        exit();
    }
    if ($action == 'user_search') {
        echo $form_head . $form_main . '</table></div>' . $page_html;
        mysqli_close($conn);
        exit();
    }

    //“新增”按钮
    $addBtn = "<div id='form_misc'><div><br/></div><button type='button' class='btn btn-success' onclick='editData(\"new\",null,null)'>
<span class='glyphicon glyphicon-plus'></span>新增</button><div><br/></div>";

    //搜索模块
    $user_form_search_html = '<div">
        <div class="input-group" style="width: 300px;float: left">
            <input type="text" id="user_form_search_key" class="form-control" placeholder="关键词">
            <div class="input-group-btn">
                <button id="user_form_search_button" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false" filter="0"><span>综合</span><span class="caret" style="margin-left: 5px"></span></button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a class="user_form_search_list" filter="1" href="javascript:void(0)">用户名</a></li>
                    <li><a class="user_form_search_list" filter="2" href="javascript:void(0)">姓名</a></li>
                    <li><a class="user_form_search_list" filter="3" href="javascript:void(0)">学校</a></li>
                    <li><a class="user_form_search_list" filter="4" href="javascript:void(0)">邮箱</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a class="user_form_search_list"  filter="0" href="javascript:void(0)">综合</a></li>
                </ul>
            </div>
        </div>
    <button class="btn btn-primary" id="user_form_search" style="float: left;margin-left: 10px">查询</button>
</div></div><br/><br/>';
    $user_form_search_js = '<script>$(".user_form_search_list").on("click",function() {
                            var ts=$("#user_form_search_button");
                            ts.children(":first-child").html($(this).html());
                            ts.attr("filter",$(this).attr("filter"));
                            })</script>';

    //页码
    $total_data = mysqli_num_rows(mysqli_query($conn, "select * from user"));
    $total_page = ceil($total_data / 10);
    $page_html = '<nav aria-label="Page navigation"><ul class="pagination" id="page_btn">';
    //page_btn.children().remove();
    $i = 1;
    while ($i <= $total_page) {
        $page_html .= "<li><a href='javascript:void(0)' onclick='loadData($i,\"page\")'>$i</a></li>";
        $i++;
    }
    $page_html .= "</ul></nav>";

    //完全拼接
    echo $user_form_search_html . $addBtn . $user_form_search_js . $form_head . $form_main . '</table></div>' . $page_html;
    mysqli_close($conn);
}

function editOrSave($conn, $date, $action)
{
    $username = $_POST['username'];
    //是否更改密码
    if ($_POST['password'] != '')
        $password = md5($_POST['password']);
    else
        $password = '';
    $uid = $_POST['uid'];
    $flag = $_POST['flag'];
    $status = $_POST['status'];
    $realname = $_POST['realname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $school = $_POST['school'];
    $subject = $_POST['subject'];
    $introduction = $_POST['introduction'];
    if ($action == 'new') {
        //查重
        if (mysqli_num_rows(mysqli_query($conn, "select * from user where username='$username'")) > 0) {
            echo "CONFLICT";
            mysqli_close($conn);
            exit();
        }
        $realname = nullHandler($realname);
        $email = nullHandler($email);
        $contact = nullHandler($contact);
        $school = nullHandler($school);
        $introduction = nullHandler($introduction);
        $sql = "insert into user (username,password,flag,status,real_name,gender,email,contact,school,subject,introduction,reg_date)" .
            "values ('$username','$password','$flag','$status','$realname','$gender','$email','$contact','$school','$subject','$introduction','$date')";
        if (mysqli_query($conn, $sql)) {
            echo 'OK';
        } else
            echo 'ERROR';
        mysqli_close($conn);
//        echo $sql;
    } else if ($action == 'edit') {
        $flag_arr = ['普通用户', '管理员', '网站维护人'];
        $status_arr = ['禁止登陆', '正常', '禁止上传', '禁止发言'];
        $gender_arr = ['保密', '男', '女'];
        if ($password == '')
            $sql = "update user set flag='$flag',status='$status',real_name='$realname',gender='$gender',email='$email',contact='$contact',school='$school',subject='$subject',introduction='$introduction',edit_date='$date' where uid='$uid'";
        else
            $sql = "update user set password='$password',flag='$flag',status='$status',real_name='$realname',gender='$gender',email='$email',contact='$contact',school='$school',subject='$subject',introduction='$introduction',edit_date='$date' where uid='$uid'";
        mysqli_query($conn, $sql);
        //返回一行
        echo '<tr id="edit_complete" class="edit_complete"><td class="uid">' . $uid . '</td><td class="username">' . $username . '</td><td class="real_name">' . $realname . '</td><td class="gender"><span value="0">' . $gender_arr[$gender] . '</span></td><td class="email">' . $email . '</td><td class="contact">' . $contact . '</td><td class="school">' . $school . '</td><td class="reg_date">' . $_POST['reg_date'] . '</td><td class="introduction">' . $introduction . '</td><td class="flag"><span value="0">' . $flag_arr[$flag] . '</span></td><td class="status"><span value="1">' . $status_arr[$status] . '</span></td><td class="subject"><span value="暂无">' . $subject . '</span></td><td class="total">' . $_POST['total'] . '</td><td class="tag">暂无</td><td class="total_like">' . $_POST['total_like'] . '</td><td class="total_dislike">' . $_POST['total_dislike'] . '</td><td class="edit_date">' . $date . '</td></tr>';

    }
    mysqli_close($conn);
}

//通用分页查询函数
function sqlResult($conn, $page, $table)
{
    $num = 10;
    $num_start = ($page - 1) * 10;
    $check_query = mysqli_query($conn, "select * from $table limit $num_start,$num");
    $rs = array();
    while ($r = mysqli_fetch_array($check_query)) {
        $rs[count($rs)] = $r;
    }
    return $rs;
}

//处理空值
function nullHandler($t)
{
    return $t == '' || $t == null ? '暂无' : $t;
}