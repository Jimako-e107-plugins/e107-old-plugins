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
$eplug_admin = true;
if(!empty($_POST) && !isset($_POST['e-token']))
{
	// set e-token so it can be processed by class2
	$_POST['e-token'] = ''; // TODO - regenerate token value just after access denied?
}
require_once("../../class2.php");
$plugindir = e_PLUGIN.'clanwars/';
include_lan($plugindir.'languages/'.e_LANGUAGE.'/clanwars_admin.php');
include_lan($plugindir.'languages/'.e_LANGUAGE.'/clanwars_common.php');
if (!getperms("P"))
{
	header("location:".e_BASE."index.php");
	exit;
}

if (e_QUERY)
{
	$tmp = explode(".", e_QUERY);
	$action = $tmp[0]; //needed by auth.php
	$sub_action = varset($tmp[1]);
	$id = intval(varset($tmp[2], 0));
	unset($tmp);
}

if($action == "") $action = "Wars";
$dot = explode("&", $action);
$action = $dot[0];

$dontinc = array("DelGame", "DelTeam", "DelWar", "AddMail", "DelMail", "SaveMail", "MailStatus", "DelComment", "DelWarComments", "SaveComment", "DelAllComments", "DelScreen", "AddPlayer", "DelPlayer", "AddMap", "DelMap", "SaveMap", "Screens", "Upload", "CreateThumb", "Search", "GetInfo");

if(!in_array($action, $dontinc)) require_once(e_ADMIN.'auth.php');
require_once(e_HANDLER."userclass_class.php");
require_once(e_HANDLER."form_handler.php");
require_once(e_HANDLER."ren_help.php");

$sql -> db_Select("clan_wars_config", "*");
$conf = $sql -> db_Fetch();

define('WARS_ADMIN', true);
//Include Functions
require_once($plugindir."includes/functions.php");
if(file_exists($plugindir."admin/".strtolower($action).".php") && getperms("P")){
	include($plugindir."admin/".strtolower($action).".php");
}
if(!in_array($action, $dontinc)) require_once(e_ADMIN.'footer.php');
exit;

?>