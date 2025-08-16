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

if (!((defined('WARS_ADMIN') or defined('WARS_SPEC')) && (preg_match("/admin\.php\?DelPlayer/i", $_SERVER['REQUEST_URI']) or preg_match("/clanwars\.php\?DelPlayer/i", $_SERVER['REQUEST_URI'])))) {
    die ("You can't access this file directly...");
}

$pid = intval($_GET['pid']);

$result = $sql->db_Delete("clan_wars_lineup", "pid='$pid'");
if($result){
	print '1';
}
		
?>