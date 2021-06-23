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

if (!defined('WARS_ADMIN') or !preg_match("/admin\.php\?DelAllComments/i", $_SERVER['REQUEST_URI'])) {
    die ("You can't access this file directly...");
}
				
$result = $sql->db_Delete("clan_wars_comments");

if($result){
	echo '1';
}

	
?>