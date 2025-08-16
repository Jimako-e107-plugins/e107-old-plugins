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
$comment = htmlentities(mysql_real_escape_string($_GET['comment']));
$usrinfo = get_user_data(USERID);

if($comment !="" && $cid > 0 && ($userid == USERID or $usrinfo["user_perms"] == "0")){
	$result = $sql->db_Update("clan_members_comments", "comment='$comment' WHERE cid='$cid'");						
	print '1';		
}

		
?>