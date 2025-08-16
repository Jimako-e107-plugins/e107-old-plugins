<?php
/*
+ -----------------------------------------------------------------+
| e107: Join Us 1.0                                                |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/
if (!(defined('JOIN_ADMIN') && preg_match("/admin.php\?AddCM/i", $_SERVER['REQUEST_URI']))
	 && 
	!(defined('JOIN_MOD') && preg_match("/joinus.php\?AddCM/i", $_SERVER['REQUEST_URI']) && in_array(USERNAME, $conf['specialprivs']) && USER)) {
    die ("Access denied.");
}

$aid = intval($_GET['aid']);
$sql->db_Select("clan_applications", "*", "aid='$aid'");
$row = $sql->db_Fetch();
	$username = $row['username'];
	$email = $row['email'];
	$xfire = $row['xfire'];
	$steam = $row['steam'];
	$location = $row['location'];

$sql->db_Select("user", "user_id", "user_name='$username'");
$row = $sql->db_Fetch();
$userid = $row['user_id'];
	
$sql->db_Insert("clan_members_info", array("userid" => $userid, "xfire" => $xfire, "steam" => $steam, "location" => $location, "joindate" => time()));
	
$result = $sql->db_Delete("clan_applications", "aid='$aid'");
$ns->tablerender(_JOINUS,_USRADDEDTOCMLIST."<br /><br /><a href='".($incfile !=""?$incfile.".php?Mod":"admin.php")."'>"._BACKTOAPPS."</a>");
?>