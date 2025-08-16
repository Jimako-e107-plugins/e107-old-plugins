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

if (!defined('CM_ADMIN')) {
	die ("Access Denied");
}

$cid = intval($_GET['cid']);
$userid = intval($_GET['userid']);
$memberid = intval($_GET['memberid']);
$usrinfo = get_user_data(USERID);

if($cid > 0 && ($userid == USERID or $usrinfo["user_perms"] == "0")){
	$result = $sql->db_Delete("clan_members_comments", "cid='$cid' AND userid='$memberid'");
	if($result){
		print '1';
	}
}

?>