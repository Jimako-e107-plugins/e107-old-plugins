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
if(!defined("e107_INIT")) 
{
	require_once("../../class2.php");
}
if (!isset($pref['plug_installed']['clanwars']))
{
	header('Location: '.e_BASE.'index.php');
	exit;
}

include_lan(e_PLUGIN.'clanwars/languages/'.e_LANGUAGE.'/clanwars.php');
include_lan(e_PLUGIN.'clanwars/languages/'.e_LANGUAGE.'/clanwars_common.php');

if (strstr(e_QUERY, "untrack"))
{
	$tmp1 = explode(".", e_QUERY);
	$tmp = str_replace("-".$tmp1[1]."-", "", USERREALM);
	$sql->db_Update("user", "user_realm='".$tp -> toDB($tmp, true)."' WHERE user_id='".USERID."' ");
	header("location:".e_SELF."?track");
	exit;
}

$action = e_QUERY;
if($action == "") $action = "main";
$dot = explode("&", $action);
$action = $dot[0];

$dontinc = array("AddWar", "AddComment", "SaveComment", "DelComment", "DelFromLineup", "AddToLineup", "Subscribe", "Unsubscribe", "DelScreen", "AddPlayer", "DelPlayer", "AddMap", "DelMap", "SaveMap", "Screens", "Upload", "CreateThumb", "Search", "GetInfo");
$incadmin = array("DelScreen", "AddPlayer", "DelPlayer", "AddMap", "DelMap", "SaveMap", "Screens", "Upload", "CreateThumb", "Search", "GetInfo");

if(!in_array($action, $dontinc)) require_once(HEADERF);

//Load Config
$sql -> db_Select("clan_wars_config", "*");
$conf = $sql -> db_Fetch();

//Include Functions
require_once(e_PLUGIN."clanwars/includes/functions.php");

//Clean up tables
$sql->db_Select("clan_wars");
	while($clrow = $sql->db_Fetch()){
		$clwid = $clrow['wid'];
		if($clrow['status']){
			$sql->db_Delete("clan_wars_lineup", "available='0' and wid='$clwid'");
			$sql->db_Update("clan_wars_lineup", "available='2' where available='1' and wid='$clwid'");
		}else{
			$sql->db_Update("clan_wars_lineup", "available='1' where available='2' and wid='$clwid'");
		}
	}
$deltime = time()-(24*60*60);
$sql->db_Delete("clan_wars_mail", "active='0' AND code!='' AND subscrtime<$deltime");

define('WARS_PUB', true);
if(canaddwars()) define('WARS_SPEC',true);
if(in_array($action, $incadmin)){
	$folder = "admin"; 
}else{
	$folder = "public";
}
if(file_exists(e_PLUGIN.'clanwars/'.$folder."/".strtolower($action).".php")) include(e_PLUGIN.'clanwars/'.$folder."/".strtolower($action).".php");

if(!in_array($action, $dontinc)) require_once(FOOTERF);
exit;
?>