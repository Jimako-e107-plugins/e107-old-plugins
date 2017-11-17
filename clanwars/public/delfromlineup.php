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

if (!defined('WARS_PUB') or stristr($_SERVER['SCRIPT_NAME'], "delfromlineup.php")) {
    die ("You can't access this file directly...");
}

$wid = intval($_GET['wid']);
$sql->db_Select("clan_wars", "*", "wid='$wid'");
$row = $sql->db_Fetch();
	$team = $row['team'];
	$game = $row['game'];
	$wholineup = $row['wholineup'];
	
if(canlineup(($wholineup == 1?$team:$game), $wholineup)){
	$result = $sql->db_Delete("clan_wars_lineup", "wid='$wid' AND member='".USERID."'");
	if($result){
		print '1';
	}
}
		
?>