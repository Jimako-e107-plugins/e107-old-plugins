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

if (!defined('WARS_ADMIN') or !preg_match("/admin\.php\?DelWar/i", $_SERVER['REQUEST_URI'])) {
    die ("You can't access this file directly...");
}

	$wid = intval($_GET['wid']);
	$sql->db_Select("clan_wars_screens", "*", "wid='$wid'");
		while ($row = $sql->db_Fetch()) {
			$url = $row['url'];
			if(file_exists("images/Screens/".$url) && $url !=""){
				@unlink("images/Screens/$url");
			}if(file_exists("images/Screens/thumbs/".$url) && $url !=""){
				@unlink("images/Screens/thumbs/$url");
			}
		}

	$sql->db_Delete("clan_wars_screens", "wid='$wid'");
	$sql->db_Delete("clan_wars_comments", "wid='$wid'");
	$sql->db_Delete("clan_wars_lineup", "wid='$wid'");
	$sql->db_Delete("clan_wars_maps", "wid='$wid'");
	$result = $sql->db_Delete("clan_wars", "wid='$wid'");
	
	if($result){
		echo '1';
	}

	
?>