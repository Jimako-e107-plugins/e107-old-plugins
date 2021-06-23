<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members Basic 1.0                                     |
| =============================                                    |
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
$sql1 = new db;
$sql->db_Select("clan_members_config", "lastclean");
$row = $sql->db_Fetch();
$lastclean = $row['lastclean'];
if($lastclean < time() - 24*60*60){
	$sql->db_Update("clan_members_config", "lastclean='".time()."'");
	
	//Clean Files	
	//Games
	$TrackDir=opendir("images/Games");
	while ($file = readdir($TrackDir)) {  
		if($file != "." && $file != ".."){ 
			if($sql->db_Count("clan_games", "(*)", "WHERE banner='$file' or icon='$file'") == 0){
				if(file_exists("images/Games/$file")){
					unlink("images/Games/$file");
				}
			}
		} 
	}  
	
	closedir($TrackDir);
	
	//Teams
	$TrackDir=opendir("images/Teams");
	while ($file = readdir($TrackDir)) {  
		if($file != "." && $file != ".."){ 
			if($sql->db_Count("clan_teams", "(*)", "WHERE banner='$file' or icon='$file'") == 0){
				if(file_exists("images/Teams/$file")){
					unlink("images/Teams/$file");
				}
			}
		} 
	}  
	
	closedir($TrackDir);
	
	//UserImages
	$TrackDir=opendir("images/UserImages");
	while ($file = readdir($TrackDir)) {  
		if($file != "." && $file != ".."){ 
			if($sql->db_Count("clan_members_info", "(*)", "WHERE avatar='$file'") == 0){
				if(file_exists("images/UserImages/$file")){
					unlink("images/UserImages/$file");
				}
			}
		} 
	}  
	
	closedir($TrackDir);
}
	
	
	
//Check members_member table
$sql->db_Select("clan_members_gamelink");
	while($row = $sql->db_Fetch()){
		$match = $sql1->db_Count("clan_members_info", "(*)", "WHERE userid='".$row['userid']."'");
		if($match == 0){
			$sql1->db_Delete("clan_members_gamelink", "id='".$row['id']."'");
		}
		
	}	
//Check members_teamlink table
$sql->db_Select("clan_members_teamlink");
	while($row = $sql->db_Fetch()){
		$match = $sql1->db_Count("clan_members_info", "(*)", "WHERE userid='".$row['userid']."'");
		if($match == 0){
			$sql1->db_Delete("clan_members_teamlink", "id='".$row['id']."'");
		}
		
	}
		
?>