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

function canaddwars(){
	global $conf;
	if(USER){
		$addwarlist = explode(',',$conf['addwarlist']);
		if(in_array(USERNAME, $addwarlist)){
			return true;
		}
	}
	return false;
}

function canlineup($id = 0, $wholineup = 0, $user = USER, $userid = USERID, $username = USERNAME){
	global $conf;
	$sqlf = new db;
	if($user && $sqlf->db_Count($conf['tablename'], "(*)", "WHERE ".$conf['fieldname']."='".$username."' or ".$conf['fieldname']."='".$userid."'")>0){
		if($conf['tablename'] == "clan_members_info" && $conf['fieldname'] == "userid" && $wholineup > 0){
			if($wholineup == 1 && $id > 0){
				if($sqlf->db_Count("clan_members_teamlink", "(*)", "WHERE userid='".$userid."' AND tid='$id'")>0)
				return true;
			}elseif($wholineup == 2 && $id > 0){
				if($sqlf->db_Count("clan_members_gamelink", "(*)", "WHERE userid='".$userid."' AND gid='$id'")>0)
				return true;
			}
		}else{
			return true;
		}
	}
	return false;
}
function cansubscribe(){
	global $conf;
	$sqlf = new db;
	if(USER && $sqlf->db_Count($conf['tablename'], "(*)", "WHERE ".$conf['fieldname']."='".USERNAME."' or ".$conf['fieldname']."='".USERID."'")>0){
		return true;
	}
	return false;
}
function canviewserver(){
	return cansubscribe();
}

function cw_getuser_name($userid){
	$sqlf = new db;
	$sqlf->db_Select("user", "user_name", "user_id='$userid'");
	$row = $sqlf->db_Fetch();
	return $row['user_name'];
}

function cw_getuser_id($username){
	$sqlf = new db;
	$sqlf->db_Select("user", "user_id", "user_name='$username'");
	$row = $sqlf->db_Fetch();
	return $row['user_id'];
}

function multisort($array, $sort_by, $key1, $key2=NULL, $key3=NULL){
     // sort by ?
     foreach ($array as $pos =>  $val)
         $tmp_array[$pos] = $val[$sort_by];
     asort($tmp_array);
     
    // display however you want
     foreach ($tmp_array as $pos =>  $val){
         $return_array[$pos][$sort_by] = $array[$pos][$sort_by];
         $return_array[$pos][$key1] = $array[$pos][$key1];
         if (isset($key2)){
             $return_array[$pos][$key2] = $array[$pos][$key2];
             }
         if (isset($key3)){
             $return_array[$pos][$key3] = $array[$pos][$key3];
             }
         }
     return $return_array;
     }
 
?>