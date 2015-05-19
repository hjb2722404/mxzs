<?php
	session_start();
	include("../conf/chklogin.php");
	include("../conf/system.php");
	include("../conf/mysql_class.php");
	include("../conf/server_class.php");
	
	$type=$_POST["type"];
	$tabname=gettable($type);
	
		$select=$db->select($tabname,"");
		
		while($myrow=$db->myArray($select)){
			
			$arr[]=$myrow;
		}
		//$arr= gbk2utf8($arr);	
		$jsonstr = decodeUnicode(json_encode($arr));
		echo $jsonstr;
		
?>