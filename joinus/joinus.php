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

if(!defined("e107_INIT")) 
{
	require_once("../../class2.php");
}
if (!isset($pref['plug_installed']['joinus']))
{
	header('Location: '.e_BASE.'index.php');
	exit;
}

include_lan(e_PLUGIN.'joinus/languages/'.e_LANGUAGE.'/joinus.php');
include_lan(e_PLUGIN.'joinus/languages/'.e_LANGUAGE.'/joinus_common.php');

if (strstr(e_QUERY, "untrack"))
{
	$tmp1 = explode(".", e_QUERY);
	$tmp = str_replace("-".$tmp1[1]."-", "", USERREALM);
	$sql->db_Update("user", "user_realm='".$tp -> toDB($tmp, true)."' WHERE user_id='".USERID."' ");
	header("location:".e_SELF."?track");
	exit;
}

$action = e_QUERY;
if($action == "") $action = "Main";
$dot = explode("&", $action);
$action = $dot[0];

$sql -> db_Select("clan_joinus_config", "*");
$conf = $sql -> db_Fetch();

require_once(HEADERF);
if(USER or !$conf['mustregister']){
	if($sql->db_Count("clan_members_info", "(*)", "WHERE userid='".USERID."'") > 0 && $conf['linkmembers']){
		$text = "<center>"._AREMEMBER.".</center>";
	}else{
		if($sql->db_Count("clan_applications", "(*)", "WHERE username='".USERNAME."'") > 0){
			$text = "<center>"._HAVEAPPLIED."</center>";
		}else{
			define('JOIN_PUB', true);
			if(file_exists(e_PLUGIN."joinus/public/".strtolower($action).".php")) include(e_PLUGIN."joinus/public/".strtolower($action).".php");
			$text = "";
		}
	}
}else{
	$text = "<center>"._LOGINORREGISTER."</center>";
}

if($text) $ns->tablerender(_JOINUS, $text);

require_once(FOOTERF);
exit;
?>