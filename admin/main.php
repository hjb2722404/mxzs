<?php
session_start();
include("../conf/chklogin.php");
include("../conf/system.php");
if($_GET["act"]=="logout")
{
	session_destroy();
	echo "<script>window.location.href= ".$weburl.";</script>";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $webname ;?>-系统主页</title>
<link href="public/admin.css" rel="stylesheet" type="text/css" />
<script src="public/jquery.js" type="text/javascript" language="javascript"></script>
<script src="public/admin.js" type="text/javascript" language="javascript"></script

</head>

<body>

<div id="container">

	<div id="header">
    	<div id="mainlogo"></div>
        <div id="welcome"><p>您好，管理员<?=$adminname?>,欢迎登陆明星装饰服务端管理系统，现在时间是<?=$time?></p></div>
        <div id="sysnav">
        	<ul>
            	<li><a href="main.html" target="right">系统主页</a></li>
                <li><a href="?act=logout">退出</a></li>
            
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <div id="content">
    	<div class="mainleft">
        	<div id="mainnav">
            	<ul>
                	<li><a href="admin_indexpic.html" target="right">首页图片推荐管理</a></li>
                    <li><a href="admin_banner.html" target="right">首页banner管理</a></li>
                    <li><a href="admin_article.html" target="right">装修攻略管理</a></li>
                    <li><a href="admin_picture.html" target="right">效果图管理</a></li>
                    <li><a href="admin_contact.html" target="right">留言管理</a></li>
                    <li><a href="admin_user.html" target="right">用户信息管理</a></li>
                </ul>
            </div>
        </div>
        <div class="mainright">
        	<iframe name="right" width="100%" height="100%" frameborder="0" scrolling="auto" src="main.html"></iframe>
        </div>
        <div class="clear"></div>
    </div>
    <div id="footer">
    	<center>
        
        	<h4>甘肃明星装饰工程有限公司版权所有</h4><br />
            <h5>本管理系统为明星装饰工程公司网站服务端专用管理系统，任何网站不得盗用本站创意及代码，否则我们保留追责的权利</h5>
        	
        </center>
    </div>
	<div class="clear"></div>
</div>

</body>
</html>