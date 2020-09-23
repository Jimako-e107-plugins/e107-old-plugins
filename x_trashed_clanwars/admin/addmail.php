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

if (!defined('WARS_ADMIN') or !preg_match("/admin\.php\?AddMail/i", $_SERVER['REQUEST_URI'])) {
    die ("You can't access this file directly...");
}

$uname = mysql_real_escape_string($_GET['uname']);
$address = mysql_real_escape_string($_GET['address']);

if($uname !="" && $address !=""){
	if(cw_getuser_id($uname) > 0) $uname = cw_getuser_id($uname);
	$result = $sql->db_Insert("clan_wars_mail", array("member" => $uname, "email" => $address, "active" => 1, "subscrtime" => time()));
	echo $result;
}
exit;
		
?>