<?php
/*
+ -----------------------------------------------------------------+
| e107: Join Us 1.0                                                |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/
if (!(defined('JOIN_ADMIN') && preg_match("/admin.php\?DelApp/i", $_SERVER['REQUEST_URI']))
	 && 
	!(defined('JOIN_MOD') && preg_match("/joinus.php\?DelApp/i", $_SERVER['REQUEST_URI']) && in_array(USERNAME, $conf['specialprivs']) && USER)) {
    die ("Access denied.");
}

$aid = intval($_GET['aid']);
$result = $sql->db_Delete("clan_applications", "aid='$aid'");
if($result){
	print '1';
}
exit;
?>