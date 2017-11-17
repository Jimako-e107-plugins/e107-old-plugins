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

if (!defined('WARS_PUB') or stristr($_SERVER['SCRIPT_NAME'], "unsubscribe.php")) {
    die ("You can't access this file directly...");
}

$del = intval($_GET['del']);

if($del == 1){
	$result = $sql->db_Delete("clan_wars_mail", "member='".USERID."'");
}else{
	$result = $sql->db_Update("clan_wars_mail", "active='0' WHERE member='".USERID."'");
}

if($result){
	print '1';
}
	
?>