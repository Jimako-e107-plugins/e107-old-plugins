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

if (!defined('CM_ADMIN')) {
	die ("Access Denied");
}

$tp = e107::getParser();
$sql = e107::getDb();

$rid = intval($_POST['rid']);
$rank = $tp->toDB($_POST['rank']);

$qry = "";
if(isset($_FILES['rankimage'])) { 
	//select filename and filesize
	$filename = $_FILES['rankimage']['name']; 
	if($filename !=""){	
		$filename = explode(".", $filename);
		$ext = strtolower($filename[count($filename) -1]);
		$rankimage = str_replace(" ","_",preg_replace("/[^a-zA-Z0-9\s]/", "", $rank)."-".rand(100, 999).".".$ext);
	
		if($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != "png"){
			echo"<center><br />"._ONLYIMGSALLOWED."<br /><br /></center>";
		}else{	
			//upload the file 
			move_uploaded_file($_FILES['rankimage']['tmp_name'], "images/Ranks/$rankimage"); 
			//chmod the file so everyine can see it 
			chmod("images/Ranks/$rankimage", 0777);
			$qry = ", rimage='$rankimage'";
		}
	}
}
	
	$sql->db_Update("clan_members_ranks", "rank='$rank' $qry where rid='$rid'");
	
	$text = "<center><meta http-equiv='refresh' content='1;URL=admin_old.php?Ranks' />
	<br />"._RANKUPDATED."<br /><br /></center>";
	
	$ns ->tablerender(_CLANMEMBERS, $text);
	
			
			
?>