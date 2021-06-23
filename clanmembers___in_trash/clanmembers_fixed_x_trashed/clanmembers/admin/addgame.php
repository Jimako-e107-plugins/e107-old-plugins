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

$abbr = $tp->toDB($_POST['abbr']);
$gname = $tp->toDB($_POST['gname']);
$inmembers = intval($_POST['inmembers']);
$inwars = intval($_POST['inwars']);

$text = "";
//Check if theres a file selected
if(isset($_FILES['gamebanner'])) {	
	//check is there a new name given
	$filename = $_FILES['gamebanner']['name']; 
	if($filename !=""){
	
		$filename = explode(".", $filename);
		$ext = strtolower($filename[count($filename) -1]);
		$banner = "Banner_".preg_replace("/[^a-zA-Z0-9\s]/", "", $gname)."-".rand(100, 999).".".$ext;
		$banner = str_replace(" ", "_", $banner);
		if($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != "png"){
			$text = "<center><br />"._ONLYIMGSALLOWED."<br /><br /></center>";
		}else{		
			//upload the file 
			move_uploaded_file($_FILES['gamebanner']['tmp_name'], e_IMAGE."clan/games/$banner"); 
			//voor linux of unix hosts chmodden we het bestand naar 777 zodat iedereen um kan zien 
			chmod(e_IMAGE."clan/games/$banner", 0777);			
		}
	}
}

//Check if theres a file selected
if(isset($_FILES['gameicon'])) {	
	//check is there a new name given
	$filename = $_FILES['gameicon']['name']; 
	if($filename !=""){
	
		$filename = explode(".", $filename);
		$ext = strtolower($filename[count($filename) -1]);
		$icon = "Icon_".preg_replace("/[^a-zA-Z0-9\s]/", "", $gname)."-".rand(100, 999).".".$ext;
		$icon = str_replace(" ", "_", $icon);
		
		if($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != "png"){
			$text = "<center><br />"._ONLYIMGSALLOWED."<br /><br /></center>";
		}else{		
			//upload the file 
			move_uploaded_file($_FILES['gameicon']['tmp_name'], e_IMAGE."clan/games/$icon"); 
			//voor linux of unix hosts chmodden we het bestand naar 777 zodat iedereen um kan zien 
			chmod(e_IMAGE."clan/games/$icon", 0777); 			
		}
	}
}

$sql->select("clan_games", "position", "ORDER BY position DESC LIMIT 1", "");
$row = $sql->fetch();
$position = $row['position'] + 1;

if($gname !=""){
	$result = $sql->db_Insert("clan_games", array("abbr" => $abbr, "gname" => $gname, "banner" => $banner, "icon" => $icon, "inmembers" => $inmembers, "inwars" => $inwars, "position" => $position));
	if($result){
		$text .= "<center><br />"._GAMEHASBEENADDED."<br /><br /></center>";
		header("Refresh:1;url=admin_old.php?games");
	}else{
		$text .= "<center><br />".ERRORUPDATINGDB."<br /><br /></center>";
		header("Refresh:2;url=admin_old.php?games");
	}
}else{
	$text .= "<center><br />"._GNAMEEMPTY."<br /><br /></center>";
	header("Refresh:2;url=admin_old.php?games");
}

$ns->tablerender(_CLANMEMBERS, $text);
			
?>