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

if (!defined('WARS_SPEC') or stristr($_SERVER['SCRIPT_NAME'], "addwar.php")) {
    die ("You can't access this file directly...");
}
if(canaddwars()){
	$wid = $sql->db_Insert("clan_wars", array("status" => 0, "wardate" => -1, "opp_country" => "Unknown", "active" => ($conf['requireapproval']?0:1), "lastupdate" => time(), "addedby" => USERNAME));
	header("Location: clanwars.php?EditWar&wid=$wid&add=1");
}		
?>