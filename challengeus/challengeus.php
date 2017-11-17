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
if(!defined("e107_INIT")) 
{
	require_once("../../class2.php");
}
if (!isset($pref['plug_installed']['challengeus']))
{
	header('Location: '.e_BASE.'index.php');
	exit;
}

include_lan(e_PLUGIN.'challengeus/languages/'.e_LANGUAGE.'/challengeus.php');
include_lan(e_PLUGIN.'challengeus/languages/'.e_LANGUAGE.'/challengeus_common.php');

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

$sql->db_Select("clan_challenge_config", "*");
$conf = $sql->db_Fetch();

require_once(HEADERF);


if(USER or !$conf['mustregister']){
	define('CHAL_PUB', true);
	if(file_exists(e_PLUGIN."challengeus/public/".strtolower($action).".php")) include(e_PLUGIN."challengeus/public/".strtolower($action).".php");
	$text = "";
}else{
	$text = "<center>Please <a href='../../login.php'>log in</a> or <a href='../../signup.php'>register</a> first.</center>";
}



if($text) $ns->tablerender(_CHALLENGEUS, $text);

require_once(FOOTERF);
exit;
?>