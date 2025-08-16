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

if (!(defined('CHAL_PUB') && preg_match("/challengeus\.php/i", $_SERVER['REQUEST_URI']))){
    die ("You can't access this file directly...");
}

$q = $_GET['q'];

$items = array();

$gid = intval($_GET['gid']);
$sql->db_Select("clan_wars_maps", "name", ($gid > 0?"WHERE gid='$gid' ":"")."GROUP BY name ORDER BY name", "");
	while($row = $sql->db_Fetch()){
		$items[$row['name']] = $row['name'];
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