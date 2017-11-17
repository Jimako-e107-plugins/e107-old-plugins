<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('CM_ADMIN')) {
	die ("Access Denied");
}

$neworder = $_POST['neworder'];
if($neworder !=""){
	$neworder = str_replace("rankstable[]=&","",$neworder);
	$neworder = str_replace("rankstable[]=","",$neworder);
	$neworder = explode("&",$neworder);
	
	for($i=1;$i<=count($neworder);$i++){
		$result = $sql->db_Update("clan_members_ranks", "rankorder='$i' WHERE rid='".$neworder[$i-1]."'");
	}

}
?>