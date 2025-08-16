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

if (!defined('WARS_ADMIN') or !preg_match("/admin\.php/i", $_SERVER['REQUEST_URI'])) {
    die ("You can't access this file directly...");
}
//Screens
$TrackDir=opendir("images/Screens");
	while ($file = readdir($TrackDir)) {  
		if(!in_array($file, array(".", "..", "index.php", ".htaccess", "thumbs"))){ 
			if(!$sql->db_Count("clan_wars_screens", "(*)", "WHERE url='$file'")){
				if(file_exists("images/Screens/$file")){
					unlink("images/Screens/$file");
				}
			}
		} 
	}  	
closedir($TrackDir);

//thumbs
$TrackDir=opendir("images/Screens/thumbs");
	while ($file = readdir($TrackDir)) {  
		if(!in_array($file,array(".", "..", "index.php", ".htaccess"))){

			if(!$sql->db_Count("clan_wars_screens", "(*)", "WHERE url='$file'")){
				if(file_exists("images/Screens/thumbs/$file")){
					unlink("images/Screens/thumbs/$file");
				}
			}
		} 
	}  	
closedir($TrackDir);

$sql1 = new db;
$sql->db_Select("clan_wars_lineup");
	while($clrow = $sql->db_Fetch()){
		$clwid = $clrow['wid'];
		if($sql1->db_Count("clan_wars", "(*)", "where wid='$clwid'") == 0){
			$sql1->db_Delete("clan_wars_lineup", "wid='$clwid'");
		}
	}
	
$sql->db_Select("clan_wars_maps");
	while($clrow = $sql->db_Fetch()){
		$clwid = $clrow['wid'];
		if($sql1->db_Count("clan_wars", "(*)", "where wid='$clwid'") == 0){
			$sql1->db_Delete("clan_wars_maps", "wid='$clwid'");
		}
	}
	
$sql->db_Select("clan_wars_comments");
	while($clrow = $sql->db_Fetch()){
		$clwid = $clrow['wid'];
		if($sql1->db_Count("clan_wars", "(*)", "where wid='$clwid'") == 0){
			$sql1->db_Delete("clan_wars_comments", "wid='$clwid'");
		}
	}

$sql->db_Select("clan_wars_screens");
	while($clrow = $sql->db_Fetch()){
		$clwid = $clrow['wid'];
		if($sql1->db_Count("clan_wars", "(*)", "where wid='$clwid'") == 0){
			$sql1->db_Delete("clan_wars_screens", "wid='$clwid'");
		}
	}


$sql->db_Update("clan_wars_config", "lastclean='".time()."'");
?>