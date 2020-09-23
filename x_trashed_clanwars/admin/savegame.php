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

if (!defined('WARS_ADMIN') or !preg_match("/admin\.php\?SaveGame/i", $_SERVER['REQUEST_URI'])) {
	die ("Access Denied");
}

$gid = intval($_POST['gid']);
$abbr = mysql_real_escape_string($_POST['abbr']);
$gname = mysql_real_escape_string($_POST['gname']);
$delbanner = intval($_POST['delbanner']);
$delicon = intval($_POST['delicon']);
$inmembers = intval($_POST['inmembers']);
$inwars = intval($_POST['inwars']);

if(intval($_POST['delbanner']) == 1){
	$sql->db_Update("clan_games", "banner='' WHERE gid='$gid'");	
}if(intval($_POST['delicon']) == 1){
	$sql->db_Update("clan_games", "icon='' WHERE gid='$gid'");	
}
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
			$text = "<center><br />"._WONLYTYPESALLOWED."<br /><br /></center>";
		}else{		
			//upload the file 
			move_uploaded_file($_FILES['gamebanner']['tmp_name'], e_IMAGE."clan/games/$banner"); 
			chmod(e_IMAGE."clan/games/$banner", 0777); 
			$sql->db_Update("clan_games", "banner='$banner' WHERE gid='$gid'");	
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
			$text = "<center><br />"._WONLYTYPESALLOWED."<br /><br /></center>";
		}else{		
			//upload the file 
			move_uploaded_file($_FILES['gameicon']['tmp_name'], e_IMAGE."clan/games/$icon"); 
			chmod(e_IMAGE."clan/games/$icon", 0777); 
			$sql->db_Update("clan_games", "icon='$icon' WHERE gid='$gid'");	
		}
	}
}


//Update Members
$sql1 = new db;
$sql->db_Select("clan_members_info", "userid", "Order BY userid ASC", "");
while($row = $sql->db_Fetch()){
	if(intval($_POST["add".$row['userid']]) == 1){
		$match = $sql1->db_Count("clan_members_gamelink", "(*)", "WHERE userid='".$row['userid']."' and gid='$gid'");
		if($match == 0){
			$sql1->db_Insert("clan_members_gamelink", array("gid" => $gid, "userid" => $row['userid']));
		}
	}else{
		$sql1->db_Delete("clan_members_gamelink", "gid='$gid' and userid='".$row['userid']."'");
	}
	
}


if($gname !=""){
	$result = $sql->db_Update("clan_games", "abbr='$abbr', gname='$gname', inmembers='$inmembers', inwars='$inwars' WHERE gid='$gid'");
	$text .= "<center><br />"._GAMEUPDATED."<br /><br /></center>";
	header("Refresh:1;url=admin.php?Games");
	
}else{
	$text .= "<center><br />"._WFILLINNAME."<br /><br /></center>";
	header("Refresh:2;url=admin.php?Games");
}
	
$ns->tablerender(_CLANWARS, $text);
	
?>