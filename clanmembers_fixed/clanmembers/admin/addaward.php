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

$awardtitle = mysql_real_escape_string($_POST['awardtitle']);
$awarddescription = mysql_real_escape_string($_POST['awarddescription']);

if(isset($_FILES['awardimage'])) { 
//select filename and filesize
$filename = $_FILES['awardimage']['name']; 
if($filename !=""){

	$filename = explode(".", $filename);
	$ext = strtolower($filename[count($filename) -1]);
	$awardimage = str_replace(" ","_",preg_replace("/[^a-zA-Z0-9\s]/", "", $awardtitle)."-".rand(100, 999).".$ext");	

	if($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != "png"){
		echo"<center><br />"._ONLYIMGSALLOWED."<br /><br /></center>";
	}else{	
		//upload the file 
		move_uploaded_file($_FILES['awardimage']['tmp_name'], "images/Awards/$awardimage"); 
		//chmod the file so everyine can see it 
		chmod("images/Awards/$awardimage", 0777);
	}
}
}

	$sql->db_Select("clan_members_awards", "position", "ORDER BY position DESC LIMIT 1", "");
	$row = $sql->db_Fetch();
	$position = $row['position'] + 1;
	
	$result = $sql->db_Insert("clan_members_awards", array("title" => $awardtitle, 
															"description" => $awarddescription, 
															"image" => $awardimage, 
															"position" => $position));

		if($result){
			 $text = "<center><meta http-equiv='refresh' content='1;URL=admin_old.php?Awards' />
			"._AWARDADDED;
		}else{
			$text = "<center><br />"._ERRORUPDATINGDB."<br /><br />";
		}
			
		$ns->tablerender(_CLANMEMBERS, $text);
?>