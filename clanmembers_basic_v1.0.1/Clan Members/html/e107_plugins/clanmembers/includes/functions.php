<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members Basic 1.0                                     |
| =============================                                    |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

function VisibleInfo($infoname){
	global $conf;
	$listorder = unserialize($conf['listorder']);
	$profileorder = unserialize($conf['profileorder']);
	if(in_array($infoname, $listorder['show']) or in_array($infoname, $profileorder['show'])){
		return true;
	}else{
		return false;
	}
}

function is_clanmember($uname){
	global $sql;
	if(intval($uname)>0){
		$rows = $sql->db_Count("clan_members_info", "(*)", "WHERE userid='$uname'");
	}else{
		$rows = $sql->db_Count("clan_members_info i, ".MPREFIX."user u", "(*)", "WHERE u.user_id=i.userid AND u.user_name='$uname'");
	}
	if($rows == 1){
		return true;
	}else{
		return false;
	}
}

function cm_getuserid($uname){
	global $sql;
	$sql->db_Select("user", "userid", "user_name='$uname'");
	$row = $sql->db_Fetch();
	return $row['user_id'];
}

function cm_getuser_name($userid){
	global $sql;
	$sql->db_Select("user", "user_name", "user_id='$userid'");
	$row = $sql->db_Fetch();
	return $row['user_name'];
}

?>