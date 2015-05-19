<?php
/**
 * Created by PhpStorm.
 * User: hjb2722404
 * Date: 2015/5/19
 * Time: 10:38
 */
header("Content-type:text/html; charset=utf-8");
session_start();
include("../conf/system.php");
include("../conf/mysql_class.php");
include("../conf/server_class.php");

$adminname=$_POST['admin_name'];
$adminpwd = pwd_encode($_POST["admin_pwd"]);

$select = $db->select("mx_admin","where adminname = '$adminname' and adminpwd = '$adminpwd'");

$row = $db->rows($select);

 if($row> 0){

    $_SESSION["adminname"]=$adminname;
    echo "<script>alert('".$adminname."欢迎登陆');window.location.href='".$weburl."admin/main.php';</script>";

}
else{
    echo "<script>alert('用户名或密码错误');window.location.href='".$weburl."admin/login.html';</script>";
}