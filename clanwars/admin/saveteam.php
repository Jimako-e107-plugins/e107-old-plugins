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

if (!defined('WARS_ADMIN') or !preg_match("/admin\.php\?SaveTeam/i", $_SERVER['REQUEST_URI'])) {
	die ("Access Denied");
}

$tid = intval($_POST['tid']);
$team_tag = mysql_real_escape_string($_POST['team_tag']);
$team_name = mysql_real_escape_string($_POST['team_name']);
$team_country = mysql_real_escape_string($_POST['team_country']);
$delbanner = intval($_POST['delbanner']);
$delicon = intval($_POST['delicon']);
$inmembers = intval($_POST['inmembers']);
$inwars = intval($_POST['inwars']);
if($team_country == "") $team_country = "Unknown";

if(intval($_POST['delbanner']) == 1){
	$sql->db_Update("clan_teams", "banner='' WHERE tid='$tid'");	
}if(intval($_POST['delicon']) == 1){
	$sql->db_Update("clan_teams", "icon='' WHERE tid='$tid'");	
}
$text = "";
//Check if theres a file selected
if(isset($_FILES['teambanner'])) {	
	//check is there a new name given
	$filename = $_FILES['teambanner']['name']; 
	if($filename !=""){
	
		$filename = explode(".", $filename);
		$ext = strtolower($filename[count($filename) -1]);
		$banner = "Banner_".preg_replace("/[^a-zA-Z0-9\s]/", "", $team_name)."-".rand(100, 999).".".$ext;
		$banner = str_replace(" ", "_", $banner);
		
		if($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != "png"){
			$text = "<center><br />"._WONLYTYPESALLOWED."<br /><br /></center>";
		}else{		
			//upload the file 
			move_uploaded_file($_FILES['teambanner']['tmp_name'], e_IMAGE."clan/teams/$banner"); 
			chmod(e_IMAGE."clan/teams/$banner", 0777); 
			$sql->db_Update("clan_teams", "banner='$banner' WHERE tid='$tid'");	
		}
	}
}

//Check if theres a file selected
if(isset($_FILES['teamicon'])) {	
	//check is there a new name given
	$filename = $_FILES['teamicon']['name']; 
	if($filename !=""){
	
		$filename = explode(".", $filename);
		$ext = strtolower($filename[count($filename) -1]);
		$icon = "Icon_".preg_replace("/[^a-zA-Z0-9\s]/", "", $team_name)."-".rand(100, 999).".".$ext;
		$icon = str_replace(" ", "_", $icon);
		
		if($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != "png"){
			$text = "<center><br />"._WONLYTYPESALLOWED."<br /><br /></center>";
		}else{		
			//upload the file 
			move_uploaded_file($_FILES['teamicon']['tmp_name'], e_IMAGE."clan/teams/$icon"); 
			chmod(e_IMAGE."clan/teams/$icon", 0777); 
			$sql->db_Update("clan_teams", "icon='$icon' WHERE tid='$tid'");	
		}
	}
}

if($team_tag !="" && $team_name !=""){
	$result = $sql->db_Update("clan_teams", "team_tag='$team_tag', team_name='$team_name', team_country='$team_country', inmembers='$inmembers', inwars='$inwars' WHERE tid='$tid'");
	$text .= "<center><br />"._TEAMUPDATED."<br /><br /></center>";
	header("Refresh:1;url=admin.php?Teams");
	
}else{
	$text .= "<center><br />"._TEAMNAMEANDTAGEMPTY."<br /><br /></center>";
	header("Refresh:2;url=admin.php?Teams");
}
	
$ns->tablerender(_CLANWARS, $text);
	
?>