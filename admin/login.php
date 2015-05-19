<?php
	session_start();
	include("../conf/system.php");
	include("../conf/mysql_class.php");
	include("../conf/server_class.php");
	
	$adminname=$_POST['admin_name'];
	$adminpwd = pwd_encode($_POST["admin_pwd"]);
	


	$select = $db->select("mx_admin","where name = '$adminname' and pass = '$adminpwd' and type = 1");
	
	$row = $db->rows($select);
	
	if($row>0){
		
		$_SESSION["adminname"]=$adminname;
		echo "<script>alert('".$adminname."欢迎登陆');window.location.href='main.php';</script>";
		
	}
	else{
	
		echo "<script type='text/javascript' language='javascript' charset='utf-8'>alert('用户名或密码错误');window.location.href='http://www.gsnewcity.cn/app/appadmin/login.html';</script>";
	}
	   

	
?>