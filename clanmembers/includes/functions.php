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
$sqlf = new db;
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
	global $sqlf;
	if(intval($uname)>0){
		$rows = $sqlf->db_Count("clan_members_info", "(*)", "WHERE userid='$uname'");
	}else{
		$rows = $sqlf->db_Count("clan_members_info i, ".MPREFIX."user u", "(*)", "WHERE u.user_id=i.userid AND u.user_name='$uname'");
	}
	if($rows == 1){
		return true;
	}else{
		return false;
	}
}

function cm_getuserid($uname){
	global $sqlf;
	$sqlf->db_Select("user", "user_id", "user_name='$uname'");
	$row = $sqlf->db_Fetch();
	return $row['user_id'];
}

function cm_getuser_name($userid){
	global $sqlf;
	$sqlf->db_Select("user", "user_name", "user_id='$userid'");
	$row = $sqlf->db_Fetch();
	return $row['user_name'];
}

?>