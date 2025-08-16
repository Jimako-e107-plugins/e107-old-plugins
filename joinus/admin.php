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
$eplug_admin = true;
if(!empty($_POST) && !isset($_POST['e-token']))
{
	// set e-token so it can be processed by class2
	$_POST['e-token'] = ''; // TODO - regenerate token value just after access denied?
}
require_once("../../class2.php");
include_lan(e_PLUGIN.'joinus/languages/'.e_LANGUAGE.'/joinus_admin.php');
include_lan(e_PLUGIN.'joinus/languages/'.e_LANGUAGE.'/joinus_common.php');
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

if($action == "") $action = "Main";
$dot = explode("&", $action);
$action = $dot[0];

if($action != "DelApp" && $action != "Search") require_once(e_ADMIN.'auth.php');
require_once(e_HANDLER."userclass_class.php");
require_once(e_HANDLER."form_handler.php");
require_once(e_HANDLER."ren_help.php");

$sql -> db_Select("clan_joinus_config", "*");
$conf = $sql -> db_Fetch();

define('JOIN_ADMIN', true);
if(file_exists(e_PLUGIN."joinus/admin/".strtolower($action).".php") && ADMIN){
	include(e_PLUGIN."joinus/admin/".strtolower($action).".php");
}
if($action != "DelApp" && $action != "Search") require_once(e_ADMIN.'footer.php');
exit;

?>