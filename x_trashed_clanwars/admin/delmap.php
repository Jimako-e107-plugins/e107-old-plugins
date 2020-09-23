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

if (!((defined('WARS_ADMIN') or defined('WARS_SPEC')) && (preg_match("/admin\.php\?DelMap/i", $_SERVER['REQUEST_URI']) or preg_match("/clanwars\.php\?DelMap/i", $_SERVER['REQUEST_URI'])))) {
    die ("You can't access this file directly...");
}

$lid = intval($_GET['lid']);
$mid = intval($_GET['mid']);

if($lid > 0){
	$result = $sql->db_Delete("clan_wars_maplink", "lid='$lid'");
}elseif($mid > 0){
	$result = $sql->db_Delete("clan_wars_maps", "mid='$mid'");
	$sql->db_Delete("clan_wars_maplink", "mapname='$mid'");
}
if($result){
	print '1';
}
		
?>