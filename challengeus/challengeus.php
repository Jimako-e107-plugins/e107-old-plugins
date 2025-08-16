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
if($_GET['lan'] == "") $lan = e_LANGUAGE; else $lan = $_GET['lan'];
include_lan(e_PLUGIN.'challengeus/languages/'.$lan.'/challengeus.php');
include_lan(e_PLUGIN.'challengeus/languages/'.$lan.'/challengeus_common.php');

if (strstr(e_QUERY, "untrack"))
{
	$tmp1 = explode(".", e_QUERY);
	$tmp = str_replace("-".$tmp1[1]."-", "", USERREALM);
	$sql->db_Update("user", "user_realm='".$tp -> toDB($tmp, true)."' WHERE user_id='".USERID."' ");
	header("location:".e_SELF."?track");
	exit;
}

$sql->db_Select("clan_challenge_config", "*");
$conf = $sql->db_Fetch();
$conf['specialprivs'] = explode(",", $conf['specialprivs']);

$action = e_QUERY;
if($action == "" && in_array(USERNAME, $conf['specialprivs']) && USER) header("Location: challengeus.php?Mod");
if($action == "") $action = "Main";
$dot = explode("&", $action);
$action = $dot[0];

if($action != "Search" && $action != "DelChallenge") require_once(HEADERF);
$modfiles = array("Mod", "Challenge", "DelChallenge", "AddWar");
if(in_array($action, $modfiles) && in_array(USERNAME, $conf['specialprivs']) && USER){
	define('CHAL_MOD', true);
	$incfile = "challengeus";
	if($action == "Mod") $action = "Main";
	if(file_exists(e_PLUGIN."challengeus/admin/".strtolower($action).".php")) include(e_PLUGIN."challengeus/admin/".strtolower($action).".php");
	$text = "";
}elseif(USER or !$conf['mustregister']){
	define('CHAL_PUB', true);
	if(file_exists(e_PLUGIN."challengeus/public/".strtolower($action).".php")) include(e_PLUGIN."challengeus/public/".strtolower($action).".php");
	$text = "";
}else{
	$text = "<div style='text-align:center'>Please <a href='../../login.php'>log in</a> or <a href='../../signup.php'>register</a> first.</div>";
}

if($text) $ns->tablerender(_CHAUS, $text);

if($action != "Search" && $action != "DelChallenge") require_once(FOOTERF);
exit;
?>