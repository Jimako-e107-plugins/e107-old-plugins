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

$memberid = intval($_GET['memberid']);
$comment = htmlentities(mysql_real_escape_string($_GET['comment']));

if($comment !="" && USER && $memberid > 0){
	$posttime = time();
	$result = $sql->db_Insert("clan_members_comments", array("userid" => $memberid, "posterid" => USERID, "comment" => $comment, "postdate" => time()));
	if(intval($result) > 0) echo $result;
}

?>