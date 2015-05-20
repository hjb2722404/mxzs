<?php
/**
 * Created by PhpStorm.
 * User: hjb2722404
 * Date: 2015/5/19
 * Time: 19:34
 */
header("Content-type:text/html; charset=utf-8");
session_start();
include("../conf/system.php");
include("../conf/mysql_class.php");
include("../conf/server_class.php");

$regName = $_POST['regName'];
$regPwd = $_POST['regPwd'];
$regPhone = $_POST['regPhone'];

if($_SESSION["username"]==$regName){
    echo "<script>alert('您已经登陆，无需再次注册');window.location.href='".$weburl."home/index.html';</script>";
}

else{

    $pwd = pwd_encode($regPwd);

    $insert=$db->insert("mx_user","(username,userpwd,phone)","('$regName','$pwd','$regPhone')");

    $row = $db->af_rows();

    if($row>0){
        echo "<script>alert('您已经成功注册，请在返回首页后登陆');window.location.href='".$weburl."home/index.html';</script>";
    }
    else{
        echo "<script>alert('注册失败，请联系管理员');window.location.href='".$weburl."home/index.html';</script>";
    }

}
