<?php
//	session_start();
//	include("../conf/chklogin.php");
	include("../conf/server_class.php");
//	include("../conf/mysql_class.php");
/*
	$type=intval($_GET["type"]);
	$id=$_GET["id"];

	switch($type){
	
		case 0 :
			
			$tabname="app_index";
			break;
			
		case 1 :
			
			$tabname="app_banner";
			break;
		
		case 2 :
		
			$tabname="app_business";
			break;
			
		case 3 :
		
			$tabname="app_goods";
			break;
			
		case 4 :
		
			$tabname="app_activity";
			break;
			
		case 5 :
		
			$tabname="app_house";
			break;
			
		case 6 :
		
			$tabname="app_award";
			break;
			
		case 7 :
		
			$tabname="app_coupan";
			break;
			
		case 8 :
		
			$tabname="app_finds";
			break;
			
		case 9 :
		
			$tabname="app_user";
			break;
	
	}

	$del=$db->delete($tabname,"WHERE id = '$id'");
	$row=$db->af_rows();
	if(mysql_error())
	{
		$error=mysql_error();
	}
	else{
		$error="未知";
	}
	if($row>0){
	echo "<script>alert('删除成功');window.history.go(-1)</script>";
	}	
	else{
	echo "<script>alert('删除失败，失败原因是：".$error."');</script>";
	}
	*/

    $pwd = "elementadmin";

    echo pwd_encode($pwd);

?>