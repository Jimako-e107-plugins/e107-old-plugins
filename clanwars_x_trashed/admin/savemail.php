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

if (!defined('WARS_ADMIN') or !preg_match("/admin\.php\?SaveMail/i", $_SERVER['REQUEST_URI'])) {
    die ("You can't access this file directly...");
}

$mid = intval($_GET['mid']);
$uname = mysql_real_escape_string($_GET['uname']);
$address = mysql_real_escape_string($_GET['address']);

if($uname !="" && $address !=""){
	$result = $sql->db_Update("clan_wars_mail", "member='$uname', email='$address' where mid='$mid'");
	print '1';		
}
	
?>