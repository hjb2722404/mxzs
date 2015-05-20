<?php
//应用名称：新城市APP服务端
//程序名称：服务端公共服务操作类
//作者：bobking
//编写日期：2014-08-27

	function pwd_encode($password){
	
	
		$pwd = substr(md5(md5($password)),5,16);
		return $pwd;
	}

//**********************************************//
	
	function gbk2utf8($data){
	if(is_array($data)){
	return array_map('gbk2utf8', $data);
	}
	return iconv('gbk','utf-8',$data);
	}
	
	
	function decodeUnicode($str) {
		return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', create_function( '$matches', 'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");' ), $str); 
	}
//**********************************************//
//				获取type所对应表名
//**********************************************//

	function gettable($typeint){
	
		$type=intval($typeint);
		
		switch($type){
	
		case 0 :
			
			$tabname="mx_article";
			break;
			
		case 1 :
			
			$tabname="mx_picture";
			break;
		
		case 2 :
		
			$tabname="mx_contact";
			break;
			
		case 3 :
		
			$tabname="mx_user";
			break;
			
		case 4 :
		
			$tabname="mx_banner";
			break;
			
		case 5 :
		
			$tabname="mx_indexpic";
			break;

	
	}
		
	return $tabname;
	
	
	}

//**********************************************//
//				图片上传类
//**********************************************//
function upimg($img){
	
		$upfile =$img;
		$name = time().$upfile["name"];
		$type = $upfile["type"];
		$size = $upfile["size"];
		$tmp_name = $upfile["tmp_name"];
		
		switch($type){
		
			case "image/pjpeg" : $oktype = true;
			break;
			
			case "image/jpeg" : $oktype = true;
			break;
			
			case "image/gif" : $oktype = true;
			break;
			
			case "image/png" : $oktype = true;
		
		}
		
		if($oktype){
		
			
			$error = $upfile["error"];	
			move_uploaded_file($tmp_name,"upload/".$name);
			$destination = "upload/".$name;	
			if($error == 0){
			//	echo "success";		
			}elseif($error == 1)
			{
				echo "too big";
			}elseif($error==2)
			{
				echo "too weight";
			}elseif($error==3)
			{
				echo "a part of success";
			}elseif($error==4)
			{
				echo "no uploaded file";
			}else
			{
				echo "0 size";
			}
		}
		else{
		
			echo "check type";
		}
		return $destination;
	}
	

//**********************************************//
//				HTML特殊字符替换类
//**********************************************//

function ReplaceSpecialChar($C_char){
  $C_char=str_replace("&amp;","&",$C_char); 
 // $C_char=str_replace("&nbsp;"," ",$C_char); 
 // $C_char=str_replace("&lt;","<",$C_char);
 // $C_char=str_replace("&gt;",">",$C_char);
	return $C_char;//返回处理结果
}


//**********************************************//

function remove_xss($val) {
   // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
   // this prevents some character re-spacing such as <java\0script>
   // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
   $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);
   // straight replacements, the user should never need these since they're normal characters
   // this prevents like <IMG SRC=@avascript:alert('XSS')>
   $search = 'abcdefghijklmnopqrstuvwxyz';
   $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $search .= '1234567890!@#$%^&*()';
   $search .= '~`";:?+/={}[]-_|\'\\';
   for ($i = 0; $i < strlen($search); $i++) {
      // ;? matches the ;, which is optional
      // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars
      // @ @ search for the hex values
      $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
      // @ @ 0{0,7} matches '0' zero to seven times
      $val = preg_replace('/(�{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
   }
   // now the only remaining whitespace attacks are \t, \n, and \r
   $ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
   $ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
   $ra = array_merge($ra1, $ra2);
   $found = true; // keep replacing as long as the previous round replaced something
   while ($found == true) {
      $val_before = $val;
      for ($i = 0; $i < sizeof($ra); $i++) {
         $pattern = '/';
         for ($j = 0; $j < strlen($ra[$i]); $j++) {
            if ($j > 0) {
               $pattern .= '(';
               $pattern .= '(&#[xX]0{0,8}([9ab]);)';
               $pattern .= '|';
               $pattern .= '|(�{0,8}([9|10|13]);)';
               $pattern .= ')*';
            }
            $pattern .= $ra[$i][$j];
         }
         $pattern .= '/i';
         $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag
         $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
         if ($val_before == $val) {
            // no replacements were made, so exit the loop
            $found = false;
         }
      }
   }
   return $val;
}

//**********************************************//
//				生成图片缩略图类				//
//**********************************************//

/**
 * 功能：php生成缩略图片的类
 */
    class ResizeImage{
        public $type;//图片类型
        public $width;//实际宽度
        public $height;//实际高度
        public $resize_width;//改变后的宽度
        public $resize_height;//改变后的高度
        public $cut;//是否裁图
        public $srcimg;//源图象 
        public $dstimg;//目标图象地址
        public $im;//临时创建的图象
        public $quality;//图片质量
        function resizeimage($img,$wid,$hei,$c,$dstpath,$quality=100){
            $this->srcimg=$img;
            $this->resize_width=$wid;
            $this->resize_height=$hei;
            $this->cut=$c;
            $this->quality=$quality;
            $this->type=strtolower(substr(strrchr($this->srcimg,'.'),1));//图片的类型
            $this->initi_img();//初始化图象
            $this -> dst_img($dstpath);//目标图象地址
            @$this->width=imagesx($this->im);
            @$this->height=imagesy($this->im);
            $this->newimg();//生成图象
            @ImageDestroy($this->im);
        }
        function newimg(){
            $resize_ratio=($this->resize_width)/($this->resize_height);//改变后的图象的比例
            @$ratio=($this->width)/($this->height);//实际图象的比例
            if(($this->cut)=='1'){//裁图
                if($img_func==='imagepng'&&(str_replace('.','',PHP_VERSION)>=512)){  //针对php版本大于5.12参数变化后的处理情况
                    $quality=9;
                }
                if($ratio>=$resize_ratio){//高度优先
                    $newimg=imagecreatetruecolor($this->resize_width,$this->resize_height);
                    imagecopyresampled($newimg,$this->im,0,0,0,0,$this->resize_width,$this->resize_height,(($this->height)*$resize_ratio),$this->height);
                    imagejpeg($newimg,$this->dstimg,$this->quality);
                }
                if($ratio<$resize_ratio){//宽度优先
                    $newimg=imagecreatetruecolor($this->resize_width,$this->resize_height);
                    imagecopyresampled($newimg,$this->im,0,0,0,0,$this->resize_width,$this->resize_height,$this->width,(($this->width)/$resize_ratio));
                    imagejpeg($newimg,$this->dstimg,$this->quality);
                }
            }else{//不裁图
                if($ratio>=$resize_ratio){
                    $newimg=imagecreatetruecolor($this->resize_width,($this->resize_width)/$ratio);
                    imagecopyresampled($newimg,$this->im,0,0,0,0,$this->resize_width,($this->resize_width)/$ratio,$this->width,$this->height);
                    imagejpeg($newimg,$this->dstimg,$this->quality);
                }
                if($ratio<$resize_ratio){
                    @$newimg=imagecreatetruecolor(($this->resize_height)*$ratio,$this->resize_height);
                    @imagecopyresampled($newimg,$this->im,0,0,0,0,($this->resize_height)*$ratio,$this->resize_height,$this->width,$this->height);
                    @imagejpeg($newimg,$this->dstimg,$this->quality);
                }
            }
        }
        function initi_img(){//初始化图象
            if($this->type=='jpg' || $this->type=='jpeg'){
                $this->im=imagecreatefromjpeg($this->srcimg);
            }
            if($this->type=='gif'){
                $this->im=imagecreatefromgif($this->srcimg);
            }
            if($this->type=='png'){
                $this->im=imagecreatefrompng($this->srcimg);
            }
            if($this->type=='wbm'){
                @$this->im=imagecreatefromwbmp($this->srcimg);
            }
            if($this->type=='bmp'){
                $this->im=$this->ImageCreateFromBMP($this->srcimg);
            }
        }
        function dst_img($dstpath){//图象目标地址
            $full_length=strlen($this->srcimg);
            $type_length=strlen($this->type);
            $name_length=$full_length-$type_length;
            $name=substr($this->srcimg,0,$name_length-1);
            $this->dstimg=$dstpath;
            //echo $this->dstimg;
        }
         
        function ImageCreateFromBMP($filename){ //自定义函数处理bmp图片
            if(!$f1=fopen($filename,"rb"))returnFALSE;
            $FILE=unpack("vfile_type/Vfile_size/Vreserved/Vbitmap_offset",fread($f1,14));
            if($FILE['file_type']!=19778)returnFALSE;
            $BMP=unpack('Vheader_size/Vwidth/Vheight/vplanes/vbits_per_pixel'.
                    '/Vcompression/Vsize_bitmap/Vhoriz_resolution'.
                    '/Vvert_resolution/Vcolors_used/Vcolors_important',fread($f1,40));
            $BMP['colors']=pow(2,$BMP['bits_per_pixel']);
            if($BMP['size_bitmap']==0)$BMP['size_bitmap']=$FILE['file_size']-$FILE['bitmap_offset'];
            $BMP['bytes_per_pixel']=$BMP['bits_per_pixel']/8;
            $BMP['bytes_per_pixel2']=ceil($BMP['bytes_per_pixel']);
            $BMP['decal']=($BMP['width']*$BMP['bytes_per_pixel']/4);
            $BMP['decal']-=floor($BMP['width']*$BMP['bytes_per_pixel']/4);
            $BMP['decal']=4-(4*$BMP['decal']);
            if($BMP['decal']==4)$BMP['decal']=0;
            $PALETTE=array();
            if($BMP['colors']<16777216)
            {
                $PALETTE=unpack('V'.$BMP['colors'],fread($f1,$BMP['colors']*4));
            }
            $IMG=fread($f1,$BMP['size_bitmap']);
            $VIDE=chr(0);
            $res=imagecreatetruecolor($BMP['width'],$BMP['height']);
            $P=0;
            $Y=$BMP['height']-1;
            while($Y>=0)
            {
                $X=0;
                while($X<$BMP['width'])
                {
                    if($BMP['bits_per_pixel']==24)
                        $COLOR=unpack("V",substr($IMG,$P,3).$VIDE);
                    elseif($BMP['bits_per_pixel']==16)
                    {
                        $COLOR=unpack("n",substr($IMG,$P,2));
                        $COLOR[1]=$PALETTE[$COLOR[1]+1];
                    }
                    elseif($BMP['bits_per_pixel']==8)
                    {
                        $COLOR=unpack("n",$VIDE.substr($IMG,$P,1));
                        $COLOR[1]=$PALETTE[$COLOR[1]+1];
                    }
                    elseif($BMP['bits_per_pixel']==4)
                    {
                        $COLOR=unpack("n",$VIDE.substr($IMG,floor($P),1));
                        if(($P*2)%2==0)$COLOR[1]=($COLOR[1]>>4);else$COLOR[1]=($COLOR[1]&0x0F);
                        $COLOR[1]=$PALETTE[$COLOR[1]+1];
                    }
                    elseif($BMP['bits_per_pixel']==1)
                    {
                        $COLOR=unpack("n",$VIDE.substr($IMG,floor($P),1));
                        if(($P*8)%8==0)$COLOR[1]=$COLOR[1]>>7;
                        elseif(($P*8)%8==1)$COLOR[1]=($COLOR[1]&0x40)>>6;
                        elseif(($P*8)%8==2)$COLOR[1]=($COLOR[1]&0x20)>>5;
                        elseif(($P*8)%8==3)$COLOR[1]=($COLOR[1]&0x10)>>4;
                        elseif(($P*8)%8==4)$COLOR[1]=($COLOR[1]&0x8)>>3;
                        elseif(($P*8)%8==5)$COLOR[1]=($COLOR[1]&0x4)>>2;
                        elseif(($P*8)%8==6)$COLOR[1]=($COLOR[1]&0x2)>>1;
                        elseif(($P*8)%8==7)$COLOR[1]=($COLOR[1]&0x1);
                        $COLOR[1]=$PALETTE[$COLOR[1]+1];
                    }
                    else
                        returnFALSE;
                    imagesetpixel($res,$X,$Y,$COLOR[1]);
                    $X++;
                    $P+=$BMP['bytes_per_pixel'];
                }
                $Y--;
                $P+=$BMP['decal'];
            }
            fclose($f1);
            return$res;
        }
         
    }
//**********************************************//
//				根据原始图生成缩略图地址类				//
//**********************************************//	
	
	function smallpath($bigpath){
			$randnum=rand(0,99999999);
			$time=md5(time());
			$name=$time."_".$randnum;
			$type = strtolower(substr(strrchr($bigpath,'.'),1));
			$picpatharr=explode('/',$bigpath);
			$picpath=$picpatharr[0];
			$smallpath=$picpath."/small/".$name.".".$type;
			return $smallpath;
	}
	
//**********************************************//
//				处理html字符串中的UE上传图片路径	//
//**********************************************//

	function repurl($str){
	
		str_replace('src="/ueditor/','src="http://www.gsnewcity.cn/ueditor/',$str);	
	}

//**********************************************//
//				根据原始图生成缩略图类				//
//**********************************************//

/**
 * 生成缩略图
 * @author yangzhiguo0903@163.com
 * @param string     源图绝对完整地址{带文件名及后缀名}
 * @param string     目标图绝对完整地址{带文件名及后缀名}
 * @param int        缩略图宽{0:此时目标高度不能为0，目标宽度为源图宽*(目标高度/源图高)}
 * @param int        缩略图高{0:此时目标宽度不能为0，目标高度为源图高*(目标宽度/源图宽)}
 * @param int        是否裁切{宽,高必须非0}
 * @param int/float  缩放{0:不缩放, 0<this<1:缩放到相应比例(此时宽高限制和裁切均失效)}
 * @return boolean
 */

function img2thumb($src_img, $dst_img, $width = 75, $height = 75, $cut = 0, $proportion = 0)
{
    if(!is_file($src_img))
    {
        return false;
    }
    $ot = fileext($dst_img);
    $otfunc = 'image' . ($ot == 'jpg' ? 'jpeg' : $ot);
    $srcinfo = getimagesize($src_img);
    $src_w = $srcinfo[0];
    $src_h = $srcinfo[1];
    $type  = strtolower(substr(image_type_to_extension($srcinfo[2]), 1));
    $createfun = 'imagecreatefrom' . ($type == 'jpg' ? 'jpeg' : $type);
 
    $dst_h = $height;
    $dst_w = $width;
    $x = $y = 0;
 
    /**
     * 缩略图不超过源图尺寸（前提是宽或高只有一个）
     */
    if(($width> $src_w && $height> $src_h) || ($height> $src_h && $width == 0) || ($width> $src_w && $height == 0))
    {
        $proportion = 1;
    }
    if($width> $src_w)
    {
        $dst_w = $width = $src_w;
    }
    if($height> $src_h)
    {
        $dst_h = $height = $src_h;
    }
 
    if(!$width && !$height && !$proportion)
    {
        return false;
    }
    if(!$proportion)
    {
        if($cut == 0)
        {
            if($dst_w && $dst_h)
            {
                if($dst_w/$src_w> $dst_h/$src_h)
                {
                    $dst_w = $src_w * ($dst_h / $src_h);
                    $x = 0 - ($dst_w - $width) / 2;
                }
                else
                {
                    $dst_h = $src_h * ($dst_w / $src_w);
                    $y = 0 - ($dst_h - $height) / 2;
                }
            }
            else if($dst_w xor $dst_h)
            {
                if($dst_w && !$dst_h)  //有宽无高
                {
                    $propor = $dst_w / $src_w;
                    $height = $dst_h  = $src_h * $propor;
                }
                else if(!$dst_w && $dst_h)  //有高无宽
                {
                    $propor = $dst_h / $src_h;
                    $width  = $dst_w = $src_w * $propor;
                }
            }
        }
        else
        {
            if(!$dst_h)  //裁剪时无高
            {
                $height = $dst_h = $dst_w;
            }
            if(!$dst_w)  //裁剪时无宽
            {
                $width = $dst_w = $dst_h;
            }
            $propor = min(max($dst_w / $src_w, $dst_h / $src_h), 1);
            $dst_w = (int)round($src_w * $propor);
            $dst_h = (int)round($src_h * $propor);
            $x = ($width - $dst_w) / 2;
            $y = ($height - $dst_h) / 2;
        }
    }
    else
    {
        $proportion = min($proportion, 1);
        $height = $dst_h = $src_h * $proportion;
        $width  = $dst_w = $src_w * $proportion;
    }
 
    $src = $createfun($src_img);
    $dst = imagecreatetruecolor($width ? $width : $dst_w, $height ? $height : $dst_h);
    $white = imagecolorallocate($dst, 255, 255, 255);
    imagefill($dst, 0, 0, $white);
 
    if(function_exists('imagecopyresampled'))
    {
        imagecopyresampled($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    }
    else
    {
        imagecopyresized($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    }
    $otfunc($dst, $dst_img);
    imagedestroy($dst);
    imagedestroy($src);
    return true;
}

function fileext($file)
{
    return pathinfo($file, PATHINFO_EXTENSION);
}
?>