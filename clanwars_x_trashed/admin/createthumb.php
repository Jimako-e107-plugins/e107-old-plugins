<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Wars 1.0                                              |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!((defined('WARS_ADMIN') or defined('WARS_SPEC')) && (preg_match("/admin\.php\?CreateThumb/i", $_SERVER['REQUEST_URI']) or preg_match("/clanwars\.php\?CreateThumb/i", $_SERVER['REQUEST_URI'])))) {
    die ("You can't access this file directly...");
}



$wid = intval($_GET['wid']);
$url = basename($_GET['url']);

if($url !="" && $conf['createthumbs']){
	$name = "images/Screens/$url";
	$filename = "images/Screens/thumbs/$url";
	
	$new_w = 200; //New width
	if($conf['thumbwidth'] > 200){
		$new_w = $conf['thumbwidth'];	
	}
	
	$system=explode('.',$name);
	if (preg_match('/jpg|jpeg/',$system[1])){
		$src_img=imagecreatefromjpeg($name);
	}elseif (preg_match('/png/',$system[1])){
		$src_img=imagecreatefrompng($name);
	}elseif (preg_match('/gif/',$system[1])){
		$src_img=imagecreatefromgif($name);
	}else{
		$src_img = "";
	}	
	
	if($src_img !=""){
	
		$old_x=imageSX($src_img);
		$old_y=imageSY($src_img);
		
		if($old_x > $new_w){
		
			$thumb_w=$new_w;
			$thumb_h=$new_w*($old_y/$old_x);
			
			$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
			
			imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 	
			
			if (preg_match('/jpg|jpeg/',$system[1])){
				imagejpeg($dst_img,$filename); 
			}elseif (preg_match('/png/',$system[1])){
				imagepng($dst_img,$filename); 
			}elseif (preg_match('/gif/',$system[1])){
				imagegif($dst_img,$filename); 
			}
			
			imagedestroy($dst_img); 
			imagedestroy($src_img); 
		}
	}
}

if(ADMIN){
	header("Location: admin.php?Screens&wid=$wid");
}else{
	header("Location: clanwars.php?Screens&wid=$wid");
}
?>