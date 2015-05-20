<?php
header("Content-type:text/html; charset=utf-8");
include("../conf/system.php");
if(!isset($_SESSION["adminname"])){
	echo "<script>alert('哦哦，您好没有登陆哦！');window.location.href='".$weburl."admin/login.html';</script>";
}
else{
	$adminname= $_SESSION["adminname"];
	$time=date('Y-m-d H:i:s',time());
}

?>