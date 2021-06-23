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
	$memberid = intval($_GET['memberid']);
	$sql->db_Delete("clan_members_info", "userid='$memberid'");
	$sql->db_Delete("clan_members_gamelink", "userid='$memberid'");
	$sql->db_Delete("clan_members_teamlink", "userid='$memberid'");
	$sql->db_Delete("clan_members_awardlink", "userid='$memberid'");
	$sql->db_Delete("clan_members_gallery", "userid='$memberid'");

?>