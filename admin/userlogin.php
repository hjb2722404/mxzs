<?php
/**
 * Created by PhpStorm.
 * User: hjb2722404
 * Date: 2015/5/19
 * Time: 19:50
 */
header("Content-type:text/html; charset=utf-8");
session_start();
include("../conf/system.php");
include("../conf/mysql_class.php");
include("../conf/server_class.php");

$loginName = $_POST['username'];
$loginPwd = $_POST['userpwd'];

if($_SESSION["username"]==$loginName){
    echo "<script>alert('您已经登陆，无需再次注册');window.location.href='".$weburl."home/index.html';</script>";
}

else{
    $pwd = pwd_encode($loginPwd);

    $select = $db->select("mx_user","where username = '$loginName' and userpwd = '$pwd'");

    $row = $db->rows($select);

    if($row>0){
        $_SESSION["username"]=$loginName;
        echo "<script>alert('".$loginName."欢迎登陆');window.location.href='".$weburl."home/index.html';</script>";
    }
    else{
        echo "<script>alert('用户名或密码错误');window.location.href='".$weburl."home/index.html';</script>";
    }
}