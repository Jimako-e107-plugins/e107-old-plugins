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

if (!defined('WARS_ADMIN') or !preg_match("/admin\.php\?DelTeam/i", $_SERVER['REQUEST_URI'])) {
	die ("Access Denied");
}

$tid = intval($_GET['tid']);
$result = $sql->db_Delete("clan_teams", "tid='$tid'");
$sql->db_Delete("clan_members_teamlink", "tid='$tid'");
if($result){
	print '1';
}
?>