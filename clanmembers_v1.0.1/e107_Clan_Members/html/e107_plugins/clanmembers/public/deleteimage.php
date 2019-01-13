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

if (!defined('CM_PUB')) {
    die ("You can't access this file directly...");
}

$id = intval($_GET['id']);
$memberid = intval($_GET['memberid']);
if($memberid > 0 && ADMIN){
	$userid = $memberid;
	$return = "clanmembers.php?gallery&memberid=$userid";
}else{
	$userid = USERID;
	$return = "clanmembers.php?gallery";
}

$sql->db_Delete("clan_members_gallery", "userid='$userid' and id='$id'");
header("Location: $return");


?>