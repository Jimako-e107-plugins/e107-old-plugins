<?phpഀ
/*ഀ
+ -----------------------------------------------------------------+ഀ
| e107: Clan Wars 1.0                                              |ഀ
| ===========================                                      |ഀ
|                                                                  |ഀ
| Copyright (c) 2011 Untergang                                     |ഀ
| http://www.udesigns.be/                                          |ഀ
|                                                                  |ഀ
| This file may not be redistributed in whole or significant part. |ഀ
+------------------------------------------------------------------+ഀ
*/ഀ
ഀ
if (!defined('WARS_PUB') or stristr($_SERVER['SCRIPT_NAME'], "delcomment.php")) {ഀ
    die ("You can't access this file directly...");ഀ
}ഀ
ഀ
$cid = intval($_GET['cid']);ഀ
$wid = intval($_GET['wid']);ഀ
ഀ
if(USERNAME !=""){ഀ
	$result = $sql->db_Delete("clan_wars_comments", "cid='$cid' AND wid='$wid' AND poster='".USERNAME."'");ഀ
	if($result){ഀ
		print '1';ഀ
	}ഀ
}ഀ
ഀ
?>