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

if (!((defined('WARS_ADMIN') or defined('WARS_SPEC')) && (preg_match("/admin\.php\?DelScreen/i", $_SERVER['REQUEST_URI']) or preg_match("/clanwars\.php\?DelScreen/i", $_SERVER['REQUEST_URI'])))) {
    die ("You can't access this file directly...");
}

$sid = intval($_GET['sid']);
$sql->db_Select("clan_wars_screens", "*", "sid='$sid'");
$row = $sql->db_Fetch();
	$url = $row['url'];
	if($url !="" && file_exists("images/Screenshot/$url")){
		 unlink("images/Screenshot/$url");
	}if($url !="" && file_exists("images/Screenshot/thumbs/$url")){
		 unlink("images/Screenshot/thumbs/$url");
	}
	
$result = $sql->db_Delete("clan_wars_screens", "sid='$sid'");	

if($result){
	print '1';
}

		
?>