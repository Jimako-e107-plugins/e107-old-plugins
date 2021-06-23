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

if (!((defined('WARS_ADMIN') or defined('WARS_SPEC')) && (preg_match("/admin\.php\?Upload/i", $_SERVER['REQUEST_URI']) or preg_match("/clanwars\.php\?Upload/i", $_SERVER['REQUEST_URI'])))) {
    die ("You can't access this file directly...");
}

$wid = intval($_GET['wid']);

if(ADMIN){
	$returnurl = "admin.php?Screens&wid=$wid";
	$thumburl = "admin.php?CreateThumb&wid=$wid";
}else{
	$returnurl = "clanwars.php?Screens&wid=$wid";
	$thumburl = "clanwars.php?CreateThumb&wid=$wid";
}

?>
<link rel="stylesheet" href="<?php echo THEME;?>/style.css" />
<style type="text/css">
body{
	margin:0;
	padding:0;
	background-image:url();
	background-color:transparent;
}
div.nowrap{
	width:420px;
	display:block;
	margin:2px;
	padding:2px;
	text-align:left;
	font-weight:bold;
	border:1px solid transparent;
}
form{
	margin:0;
	padding:0;
}
</style>
<script type="text/javascript">
var i= "";
function Uploading(){
	document.getElementById('uploading').innerHTML = "<?php echo _WCREATINGTHUMB;?>" + i;
	if(i == "..."){
		i = "";
	}else{
		i += ".";
	}
	setTimeout(Uploading,300);
}
</script>
<body onLoad="Uploading()">
<?php
//Check if theres a file selected
if(!isset($_FILES['screenshot'])) { 
	header("Location:$returnurl");
}else{
	//if  the file is bigger then $screenmaxsize , it wont be accepted 
	if($_FILES['screenshot']['size'] > $conf['screenmaxsize'] && $conf['screenmaxsize'] > 0) { 
		$filesizekb = ceil($_FILES['screenshot']['size']/ 1024);
		?>
        <script type="text/javascript">
			alert("<?php echo _WFILESIZEIS." ".ceil($_FILES['screenshot']['size']/ 1024)." kB, "._WMAXALLOWEDIS." ".($conf['screenmaxsize'] / 1024)." kB";?>");
			window.location = "<?php echo $returnurl;?>";
		</script>
        <?php
	} else { 
		//check is there a new name given 
		$filename = $_FILES['screenshot']['name']; 
		if($filename ==""){
			header("Location:$returnurl");
		}else{
			$filename = explode(".", $filename);
			$ext = strtolower($filename[count($filename) -1]);
			if($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != "png"){
				?>
				<script type="text/javascript">
                	alert("<?php echo _WONLYTYPESALLOWED;?>");
					window.location = "<?php echo $returnurl;?>";
                </script>
                <?php
			}else{	
				$screenurl = "War".$wid."_Upl_".date("Ymd")."_".date("H")."".date("i")."".date("s").".$ext";
				//upload the file 
				move_uploaded_file($_FILES['screenshot']['tmp_name'], "images/Screens/tmp_$screenurl");
				chmod("images/Screens/tmp_$screenurl", 0777); 
				
				//RESIZE
				if(file_exists("images/Screens/tmp_$screenurl")){
					if($conf['resizescreens']){
						$name = "images/Screens/tmp_$screenurl";
						$filename = "images/Screens/$screenurl";
						
						$new_w = $conf['resizedwidth']; //New width
						
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
								unlink("images/Screens/tmp_$screenurl");
							}else{
								rename("images/Screens/tmp_$screenurl","images/Screens/$screenurl");
							}
						}
					}else{
						rename("images/Screens/tmp_$screenurl","images/Screens/$screenurl");
					}
					chmod("images/Screens/$screenurl", 0777); 
				}else{
					?>
					<script type="text/javascript">
                    	alert("<?php echo _WERRORUPLSCR;?>");
	 					window.location = "<?php echo $returnurl;?>";
                   </script>
                    <?php
				}				
				
				//add file to database
				$result = $sql->db_Insert("clan_wars_screens", array("url" => mysql_real_escape_string($screenurl), "wid" => intval($wid)));
				if(intval($result) == 0){
					?>
					<script type="text/javascript">
                    	alert("<?php echo _WERRORADDSCRTODB;?>");
	 					window.location = "<?php $returnurl;?>";
                    </script>
                    <?php
				}
				$sid = $result;
				if($conf['createthumbs']){
                    echo '<div class="nowrap" id="uploading" style="padding-left:100px;">'._WCREATINGTHUMB.'...</div>';
                } 
				?>
				<script type="text/javascript">
                    parent.document.getElementById("screensdiv").innerHTML = parent.document.getElementById("screensdiv").innerHTML + '<div class="mainwrap forumheader3" id="screen<?php echo $sid;?>"> <table cellpadding="2" cellspacing="0" border="0" width="100%"><tr> <td>&nbsp;<?php echo $screenurl;?></td> <td style="text-align:right;"><input type="button" class="iconpointer button" value="<?php echo _WDEL;?>" onclick="DelScreen(<?php echo $sid;?>);"></td> </tr></table> </div>';
					<?php if($conf['createthumbs']){?>
					Uploading();
					window.location = "<?php echo $thumburl."&url=".$screenurl;?>";
					<?php }else{?>					
					window.location = "<?php echo $returnurl;?>";
					<?php }?>					
                </script>

                <?php				
			}
		}
	}
}
?>
</body>