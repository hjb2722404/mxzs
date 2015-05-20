<?php
	session_start();
	include("../conf/chklogin.php");
	include("../conf/system.php");
	include("../conf/mysql_class.php");
	include("../conf/server_class.php");
	
	$title=$_POST["title"];
    $channel=$_POST["channel"];
    $cat=$_POST["cat"];
	$author=$_POST["author"];
	$describ=$_POST["describ"];
	$content=$_POST["content"];
	
	$img = $_FILES['litpic'];
	if(is_uploaded_file($img['tmp_name']))
	{
		$destination = upimg($img);
	}
	$add = $db->insert("mx_article","(title,author,infos,cid,channelid,litpic,detail)","('$title','$author','$describ','$cat','$channel','$destination','$content')");
	$row=$db->af_rows();
	if($row>0){
	
		echo "<script>alert('添加成功'); window.location.href='admin_article.html'</script>";
	}

?>