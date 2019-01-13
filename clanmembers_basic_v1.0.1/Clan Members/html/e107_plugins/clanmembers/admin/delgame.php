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

$gid = intval($_GET['gid']);
$result = $sql->db_Delete("clan_games", "gid='$gid'");
$sql->db_Delete("clan_members_gamelink", "gid='$gid'");
if($result){
	print '1';
}
?>