<?php
/**
 * Created by PhpStorm.
 * User: hjb2722404
 * Date: 2015/5/19
 * Time: 20:27
 */
header("Content-type:text/html; charset=utf-8");
session_start();
include("../conf/system.php");
include("../conf/mysql_class.php");
include("../conf/server_class.php");
$uname = $_POST['uname'];

if($uname != ""){

    $select = $db->select("mx_user","where username = '$uname'");

    $row = $db->rows($select);

    if($row>0){
       echo "yes";
    }
    else{
        echo "no";

    }





}