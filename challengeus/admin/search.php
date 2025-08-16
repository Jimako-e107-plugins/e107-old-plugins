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

if (!(defined('CHAL_ADMIN') && preg_match("/admin.php\?Search/i", $_SERVER['REQUEST_URI'])) && !(defined('CHAL_MOD') && preg_match("/challengeus.php\?Search/i", $_SERVER['REQUEST_URI']))) {
    die ("Access Denied.");
}

$q = $_GET['q'];

$items = array();

$sql->db_Select("user", "user_name", "ORDER BY user_name", "");
	while($row = $sql->db_Fetch()){
		$items[$row['user_name']] = $row['username'];
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