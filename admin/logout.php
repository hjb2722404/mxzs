<?php
	session_start();
	$logout=unset($_SESSION["adminname"]);
	if($logout)
	{
	echo "<script>window.location.href='http://www.gsnewcity.cn/';</script>";
	}
?>