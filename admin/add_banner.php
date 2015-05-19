<?php
	session_start();
	include("../conf/chklogin.php");
	include("../conf/system.php");
	include("../conf/mysql_class.php");
	include("../conf/server_class.php");
	
	$type=intval($_GET['type']);
	$path=$_GET['path'];
	$tid=intval($_GET['id']);
	$ttitle=$_GET['title'];
	    
	switch($type){
	
		case 0 :
			
			$typename="首页推荐";
			break;
		
		case 2 :
		
			$typename="推荐小店";
			break;
			
		case 3 :
		
			$typename="促销商品";
			break;
			
		case 4 :
		
			$typename="最新活动";
			break;
			
		case 5 :
		
			$typename="折扣楼盘";
			break;
			
		case 6 :
		
			$typename="积分商城";
			break;
			
		case 7 :
		
			$typename="优惠券";
			break;
	}

	$select=$db->select("app_banner","where type='$typename' and tid='$tid'");

	$row=$db->rows($select);
	
	if($row>0)
	{
		echo "<script>alert('已被推荐过！');window.history.go(-1);</script>";
	}
	
	else
	{
		$insert=$db->insert("app_banner","(type,path,tid,ttitle)","('$typename','$path','$tid','$ttitle')");
		$rows=$db->af_rows();
		if($rows>0)
		{
			echo "<script>alert('推荐成功');window.history.go(-1);</script>";
		}
	}

?>