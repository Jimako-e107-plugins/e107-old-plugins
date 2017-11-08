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
if (!(defined('CHAL_ADMIN') && preg_match("/admin\.php\?DelChallenge/i", $_SERVER['REQUEST_URI']))){
    die ("Access denied.");
}

$cid = intval($_GET['cid']);
$result = $sql->db_Delete("clan_challenges", "cid='$cid'");
if($result){
	print '1';
}
exit;
?>