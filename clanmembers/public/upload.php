<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('CM_PUB') && $conf['enablegallery']) {
    die ("Access Denied");
}

$userid = 0;
$memberid = intval($_GET['memberid']);
if($memberid > 0 && ADMIN){
	$userid = $memberid;
	$return = "clanmembers.php?gallery&memberid=$userid";
}else{
	$userid = USERID;
	$return = "clanmembers.php?gallery";
}

if(!is_clanmember($userid)){
	header("Location: clanmembers.php");
	die();
}

$user_name = cm_getuser_name($userid);

//Check if theres a file selected
if(isset($_FILES['newimage'])) {
	if($conf['galfilesize'] == 0 || $_FILES['newimage']['size'] <= ($conf['galfilesize'] * 1024)){
		//select filename and filesize
		$filename = $_FILES['newimage']['name']; 
		if($filename !=""){		
		
			$filename = explode(".", $filename);
			$ext = strtolower($filename[count($filename) -1]);
			$image = $user_name."-".rand(1, 99999).".".$ext;		
			
			if($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != "png"){
				echo"<center><br />"._ONLYIMGSALLOWED."<br /><br /></center>";
				header("Refresh: 2;url=$return");
			}else{		
				//upload the file 
				move_uploaded_file($_FILES['newimage']['tmp_name'], "images/Gallery/".$image); 
				chmod("images/Gallery/".$image, 0777); 
				
				$sql->db_Insert("clan_members_gallery", array("userid" => $userid, "url" => $image));
				header("Location: $return");

			}	
		}
	}else{
		echo"<center><br />"._IMGNOTUPLMAXSIZE.$conf['galfilesize']."kB.<br /><br /></center>";
		header("Refresh: 3;url=$return");
	}
}



?>