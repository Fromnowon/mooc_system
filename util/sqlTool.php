<?php
//尝试封装常用的sql查询

function select($conn, $table, $filter)
{
    //条件需手动拼凑成sql语句
    $sql = "select * from $table where $filter";
    $res = mysqli_query($conn, $sql);
    $arr = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $arr[] = $row;
    }
    return $arr;
}

function all($conn, $table, $order)
{
    $sql = "select * from  $table " . $order;
    $res = mysqli_query($conn, $sql);
    $arr = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $arr[] = $row;
    }
    return $arr;
}

function add($conn, $table, $arr)
{
    //arr需写成数组形式，且必须按顺序
    //mysqli_affected_rows返回最近一次sql操作影响的行数
    $str = array_values($arr);
    $str = implode("','", $str);
    $sql = "insert into $table values(DEFAULT ,'$str')";
    $res = mysqli_query($conn, $sql);
    if ($res && mysqli_affected_rows($conn) > 0) {
        return true;
    } else {
        return false;
    }
}

function delete($conn, $table, $where)
{
    $sql = "delete from $table where $where";
    $res = mysqli_query($conn, $sql);
    if ($res && mysqli_affected_rows($conn) > 0) {
        return true;
    } else {
        return false;
    }
}

function update($conn, $table, $update, $where)
{
    $sql = "update $table set $update where $where";
    $res = mysqli_query($conn, $sql);
    if ($res && mysqli_affected_rows($conn) > 0) {
        return true;
    } else {
        return false;
    }
}