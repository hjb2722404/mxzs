<?php
	session_start();
	include("../conf/chklogin.php");
	include("../conf/system.php");
	include("../conf/mysql_class.php");
	include("../conf/server_class.php");
	
	$id = $_REQUEST['id'];
	$act=$_REQUEST['act'];
	$tabname="app_index";
	
		$select=$db->select($tabname,"where id = '$id'");
		
		$myrow=$db->myArray($select);
		if($act=="edit")
		{	
			$title=$_POST["title"];
			$author=$_POST["author"];
            $channel=$_POST["channel"];
            $cat=$_POST["cat"];
			$describ=$_POST["describ"];
			$content=$_POST["content"];
			$imgurl=$_POST['imgurl'];
			$id = $_POST["id"];
			$img = $_FILES['litpic'];
			if(is_uploaded_file($img['tmp_name']))
			{
			$destination = upimg($img);
			}
			else
			{
				$destination = $imgurl;
			}
			$update = $db->update("app_article","title = '$title' , author = '$author' , infos = '$describ' ,cid='$cat',channelid='$channel', litpic = '$destination' , detail = '$content' ","where id = '$id'");
			$row=$db->af_rows();
			if($row>0){
	
			echo "<script>alert('更新成功'); window.location.href='admin_index.html';</script>";
			}
			
		}
				
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>首页图文管理-编辑文档</title>
<link href="public/admin.css" type="text/css" rel="stylesheet" />
<script src="public/jquery.js" type="text/javascript" language="javascript"></script>
<script src="public/imgupload_preview.js" type="text/javascript" language="javascript"></script>
<script>
$(function () {
$("#up").uploadPreview({ Img: "ImgPr", Width: 120, Height: 120 });
    $("#channel").change(function(){
        var v = $("#channel").val();
        var htmlc="";
        htmlc+='<option value="0">请选择</option>';
        for(i=0;i<channel[v].length;i++){
            j=i+1;
            htmlc+= '<option value="'+j+'">'+channel[v][i]+'</option>';;
        }
        $("#cat").html(htmlc);
    });
});
</script>
</head>

<body>
<div class="admin_content">
<div class="admin_title">
    	<h3>首页图文管理-编辑文档</h3>
</div>
   <form action="?act=edit" enctype="multipart/form-data" method="post" class="form">
   		<input type="hidden" name="id" value="<?php echo $myrow['id']; ?>" />
   		<label for="index_title">文章标题：</label><input type="text" name="title" id="index_title" value="<?php echo $myrow['title']; ?>" /><br />
       <label for="channel">所属栏目：</label>
       <div >
           <select class="chennel" name="channel" id="channel">
               <option value="0">请选择</option>
               <option value="1">装修前</option>
               <option value="2">装修中</option>
               <option value="3">装修后</option>
           </select>
           <select class="cat" name="cat" id="cat">
               <option value="0">请选择</option>
           </select>
       </div>
       <br />
        <label>文章作者：</label><input type="text" name="author"  value="<?php echo $myrow['author']; ?>" /><br />
        <label>文章摘要：</label><br />
        <textarea name="describ" rows="5" cols="80"><?php echo $myrow['details']; ?></textarea><br />
        <label>缩略图：</label>
        <div id="imgdiv" style="display:block;"><img id="ImgPr" width="120" height="90" alt="请上传图片" src="<?php echo $myrow['imgurl']; ?>" /></div>
        <input type="hidden" name="imgurl" value="<?php echo $myrow['imgurl']; ?>" />
		<input type="file" id="up" name="litpic" />
<br />
        <label>文章内容：</label><br />
        
        <script id="htmlcontainer" name="content" type="text/plain">
		<?php echo $myrow['content']; ?>
	</script>
	
    <script type="text/javascript" src="../uetest/ueditor.config.js" ></script>
    <script type="text/javascript" src="../uetest/ueditor.all.js"></script>
    <script type="text/javascript">
		var ue = UE.getEditor('htmlcontainer',{
				initialFrameHeight:500
							  });
	</script>
   	
    <button  type="submit">提交文档</button>
   
   </form>
   </div>
</body>
</html>
