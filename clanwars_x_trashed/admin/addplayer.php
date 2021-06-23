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

if (!((defined('WARS_ADMIN') or defined('WARS_SPEC')) && (preg_match("/admin\.php\?AddPlayer/i", $_SERVER['REQUEST_URI']) or preg_match("/clanwars\.php\?AddPlayer/i", $_SERVER['REQUEST_URI'])))) {
    die ("You can't access this file directly...");
}

$wid = intval($_GET['wid']);
$avail = intval($_GET['avail']);
$warstatus = intval($_GET['warstatus']);
$playername = mysql_real_escape_string($_GET['playername']);
if(cw_getuser_id($playername)>0) $playername = cw_getuser_id($playername);

if($playername !="" && $wid > 0){
	$sql->db_Select("clan_wars_lineup", "pid, available", "wid='$wid' and member='$playername'");
	if($sql->db_Rows()){
		if($warstatus == 1){
			$row = $sql->db_Fetch();
			if($row['available'] == 0){
				$result = $sql->db_Update("clan_wars_lineup", "available='2' WHERE pid='".$row['pid']."'");		
				if($result){
					echo "updated".$row['pid'];
				}
			}
		}else{			
			echo "inlineup";
		}
	}else{		
		$result = $sql->db_Insert("clan_wars_lineup", array("member" => $playername, "wid" => $wid, "available" => $avail));		
		echo $result;
	}
}
exit;
?>