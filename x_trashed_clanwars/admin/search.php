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

if (!((defined('WARS_ADMIN') or defined('WARS_SPEC')) && (preg_match("/admin\.php\?Search/i", $_SERVER['REQUEST_URI']) or preg_match("/clanwars\.php\?Search/i", $_SERVER['REQUEST_URI'])))) {
    die ("You can't access this file directly...");
}

$q = $_GET['q'];

$items = array();
if($_GET['type'] == 'opp_tag'){
	$sql->db_Select("clan_wars", "opp_tag", "GROUP BY opp_tag ORDER BY opp_tag", "");
		while($row = $sql->db_Fetch()){
			$items[$row['opp_tag']] = $row['opp_tag'];
		}		
}elseif($_GET['type'] == 'opp_name'){
	$sql->db_Select("clan_wars", "opp_name", "GROUP BY opp_name ORDER BY opp_name", "");
		while($row = $sql->db_Fetch()){
			$items[$row['opp_name']] = $row['opp_name'];
		}		
}elseif($_GET['type'] == 'opp_url'){
	$sql->db_Select("clan_wars", "opp_url", "GROUP BY opp_url ORDER BY opp_url", "");
		while($row = $sql->db_Fetch()){
			$items[$row['opp_url']] = $row['opp_url'];
		}		
}elseif($_GET['type'] == 'style'){
	$sql->db_Select("clan_wars", "style", "GROUP BY style ORDER BY style", "");
		while($row = $sql->db_Fetch()){
			$items[$row['style']] = $row['style'];
		}		
}elseif($_GET['type'] == 'mapname'){
	$gid = intval($_GET['gid']);
	$sql->db_Select("clan_wars_maps", "name", ($gid > 0?"WHERE gid='$gid' ":"")."GROUP BY name ORDER BY name", "");
		while($row = $sql->db_Fetch()){
			$items[$row['name']] = $row['name'];
		}		
}elseif($_GET['type'] == 'gametype'){
	$sql->db_Select("clan_wars_maplink", "gametype", "GROUP BY gametype ORDER BY gametype", "");
		while($row = $sql->db_Fetch()){
			$items[$row['gametype']] = $row['gametype'];
		}		
}elseif($_GET['type'] == 'player'){
	$sql->db_Select("clan_wars_lineup", "member", "GROUP BY member ORDER BY member", "");
		while($row = $sql->db_Fetch()){
			if(intval($row['member']) == 0)
			$items[$row['member']] = $row['member'];
		}
	$sql->db_Select("user", "user_name", "ORDER BY user_name", "");
		while($row = $sql->db_Fetch()){
			$items[$row['user_name']] = $row['username'];
		}	
}elseif($_GET['type'] == 'userlist'){
	$sql->db_Select("user", "user_name", "ORDER BY user_name", "");
		while($row = $sql->db_Fetch()){
			$items[$row['user_name']] = $row['username'];
		}		
}
$q = str_replace(" ","",$q);
if($q !=""){
	foreach ($items as $key=>$value) {
		if (strpos(strtolower($key), $q) !== false) {
			echo "$key((keyvalsep))$value\n";
		}
	}
}
?>