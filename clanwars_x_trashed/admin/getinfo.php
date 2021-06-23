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

if (!((defined('WARS_ADMIN') or defined('WARS_SPEC')) && (preg_match("/admin\.php\?GetInfo/i", $_SERVER['REQUEST_URI']) or preg_match("/clanwars\.php\?GetInfo/i", $_SERVER['REQUEST_URI'])))) {
    die ("You can't access this file directly...");
}
$param = mysql_real_escape_string($_GET['param']);
if($_GET['type'] == 'tag'){
	$sql->db_Select("clan_wars", "opp_name, opp_url, opp_country", "opp_tag='$param' ORDER BY wid DESC LIMIT 1");
	$row = $sql->db_Fetch();
	echo $row['opp_name']."((oppinfseperator))".$row['opp_url']."((oppinfseperator))".$row['opp_country'];
}elseif($_GET['type'] == 'name'){
	$sql->db_Select("clan_wars", "opp_tag, opp_url, opp_country", "opp_name='$param' ORDER BY wid DESC LIMIT 1");	
	$row = $sql->db_Fetch();
	echo $row['opp_tag']."((oppinfseperator))".$row['opp_url']."((oppinfseperator))".$row['opp_country'];
}
	
?>