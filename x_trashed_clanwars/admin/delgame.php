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

if (!defined('WARS_ADMIN') or !preg_match("/admin\.php\?DelGame/i", $_SERVER['REQUEST_URI'])) {
	die ("Access Denied");
}

$gid = intval($_GET['gid']);
$result = $sql->db_Delete("clan_games", "gid='$gid'");
$sql->db_Delete("clan_members_gamelink", "gid='$gid'");
if($result){
	print '1';
}
?>