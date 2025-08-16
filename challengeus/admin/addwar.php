<?php
/*
+ -----------------------------------------------------------------+
| e107: Challenge Us 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/
if (!(defined('CHAL_ADMIN') && preg_match("/admin.php\?AddWar/i", $_SERVER['REQUEST_URI']))
	 && 
	!(defined('CHAL_MOD') && preg_match("/challengeus.php\?AddWar/i", $_SERVER['REQUEST_URI']) && in_array(USERNAME, $conf['specialprivs']) && USER)) {
    die ("Access denied.");
}
$tag = mysql_real_escape_string($_POST['clantag']);
$name = mysql_real_escape_string($_POST['clanname']);
$site = mysql_real_escape_string($_POST['clansite']);
$country = mysql_real_escape_string($_POST['country']);
$wardate = mysql_real_escape_string($_POST['chdate']);
$game = mysql_real_escape_string($_POST['game']);
$map = mysql_real_escape_string($_POST['map']);
$players = intval($_POST['players']);
$serverip = mysql_real_escape_string($_POST['serverip']);
$serverpw = mysql_real_escape_string($_POST['serverpw']);

$wid = $sql->db_Insert("clan_wars", array("status" => 0, "wardate" => $wardate, "game" => $game, "players" => $players, "serverip" => $serverip, "serverpass" => $serverpw, "opp_tag" => $tag, "opp_name" => $name, "opp_country" => $country, "opp_url" => $site, "active" => 0, "lastupdate" => time()));

$ns->tablerender(_CHALLENGE, _WARHASBEENADDED."<br /><a href='../clanwars/".($incfile!=""?"clanwars":"admin").".php?EditWar&wid=$wid&new=1'>"._EDITWAR."</a> "._OR." <a href='".($incfile !=""?$incfile:"admin").".php'>"._JUGOBACK."</a>");
		
?>