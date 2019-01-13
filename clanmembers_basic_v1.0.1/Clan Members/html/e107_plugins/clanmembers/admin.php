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

$eplug_admin = true;
if(!empty($_POST) && !isset($_POST['e-token']))
{
	// set e-token so it can be processed by class2
	$_POST['e-token'] = ''; // TODO - regenerate token value just after access denied?
}
require_once("../../class2.php");
include_lan(e_PLUGIN.'clanmembers/languages/'.e_LANGUAGE.'/clanmembers_admin.php');
include_lan(e_PLUGIN.'clanmembers/languages/'.e_LANGUAGE.'/clanmembers_common.php');

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
if($action == ""){
	$action = "Members";
}else{
	$dot = explode("&", $action);
	$action = $dot[0];
}

$dontinc = array("SaveRankOrder","SaveAwardOrder","SaveGameOrder","DelRank","DelAward","DelGame","DelTeam");
if(!in_array($action, $dontinc)){
	require_once(e_ADMIN.'auth.php');
	echo '<script type="text/javascript" src="includes/jquery.min.js"></script>'."\n"
		.'<script type="text/javascript">var clanm_jq = jQuery;</script>'."\n";
}elseif(!ADMIN){
	die();	
}
require_once(e_HANDLER."userclass_class.php");
require_once(e_HANDLER."form_handler.php");
require_once(e_HANDLER."ren_help.php");

$sql -> db_Select("clan_members_config");
$conf = $sql -> db_Fetch();

include("includes/infolang.php");
include("includes/functions.php");

define('CM_ADMIN', true);
if(file_exists("admin/".strtolower($action).".php")){
	include(e_PLUGIN."clanmembers/admin/".strtolower($action).".php");
	if($action == "Members") include(e_PLUGIN."clanmembers/admin/clean.php");
}
	
if(!in_array($action, $dontinc)){
	require_once(e_ADMIN.'footer.php');
}
exit;

?>