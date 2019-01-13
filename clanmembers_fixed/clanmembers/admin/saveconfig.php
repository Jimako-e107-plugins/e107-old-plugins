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

if (!defined('CM_ADMIN')) {
	die ("Access Denied");
}

$orderorder = $_POST['orderorder'];
$neworder = $_POST['neworder'];
$profileorder = $_POST['profileorder'];
$info = $_POST['info'];
$profile = $_POST['profile'];
$style = intval($_POST['style']);
$xshow_opened = intval($_POST['xshow_opened']);
$xallowchangeinfo = intval($_POST['xallowchangeinfo']);
$xallowupimage = intval($_POST['xallowupimage']);
$maxwidth = intval($_POST['maxwidth']);
$maxheight = intval($_POST['maxheight']);
$cmtitle = mysql_real_escape_string($_POST['cmtitle']);
$titlealign = mysql_real_escape_string($_POST['titlealign']);
$banneralign = mysql_real_escape_string($_POST['banneralign']);
$xshow_gname = intval($_POST['xshow_gname']);
$padding = intval($_POST['padding']);
$maxfilesize = intval($_POST['maxfilesize']);
$xmembersperrow = intval($_POST['xmembersperrow']);
$xrank_per_game = intval($_POST['xrank_per_game']);
$joinformat = mysql_real_escape_string($_POST['joinformat']);
$birthformat = mysql_real_escape_string($_POST['birthformat']);
$enableprofile = intval($_POST['enableprofile']);
$enablehardware = intval($_POST['enablehardware']);
$enablegallery = intval($_POST['enablegallery']);
$showawards = intval($_POST['showawards']);
$maximages = intval($_POST['maximages']);
$galfilesize = intval($_POST['galfilesize']);
$thumbwidth = intval($_POST['thumbwidth']);
$showuserimage = intval($_POST['showuserimage']);
$profileimgwidth = intval($_POST['profileimgwidth']);
$profileimgheight = intval($_POST['profileimgheight']);
$listwidth = mysql_real_escape_string($_POST['listwidth']);
$leftboxwidth = intval($_POST['leftboxwidth']);
$leftsidewidth = intval($_POST['leftsidewidth']);
$gamesorteams = mysql_real_escape_string($_POST['gamesorteams']);
$profilealign = mysql_real_escape_string($_POST['profilealign']);
$gamesmemberswars = intval($_POST['gamesmemberswars']);
$teamsmemberswars = intval($_POST['teamsmemberswars']);
$showlastwars = intval($_POST['showlastwars']);
$userimgsrc = intval($_POST['userimgsrc']);
$guestviewcontactinfo = intval($_POST['guestviewcontactinfo']);
$profiletoguests = intval($_POST['profiletoguests']);
$changeatdot = intval($_POST['changeatdot']);
$showview = intval($_POST['showview']);
$showcontactlist = intval($_POST['showcontactlist']);
$inactiveafter = intval($_POST['inactiveafter']);

//Clan Members Order
if($orderorder !=""){
	$listorder = "";
	$orderorder = str_replace("ordertable[]=","",$orderorder);
	$orderorder = explode("&",$orderorder);
	for($i=0;$i<count($orderorder);$i++){
		$listorder .= ($i>0?"-":"").$orderorder[$i]."|".$_POST['order'.$orderorder[$i]];
	}
	$result = $sql->db_Update("clan_members_config",  "memberorder='".$listorder."'");
}

//Clan Members List
if($neworder !=""){
	$listorder = array();
	$neworder = str_replace("infotable[]=","",$neworder);
	$neworder = explode("&",$neworder);
	$listorder['show']= array();
	$listorder['hide']= array();
	for($i=0;$i<count($neworder);$i++){
		$listorder[(($info[$neworder[$i]] or $neworder[$i] == "Username")?'show':'hide')][] = $neworder[$i];
	}
	$result = $sql->db_Update("clan_members_config", "listorder='".serialize($listorder)."'");
}

//Clan Members Profile
if($profileorder !=""){
	$listorder = array();
	$profileorder = str_replace("profiletable[]=","",$profileorder);
	$profileorder = explode("&",$profileorder);
	$listorder['show']= array();
	$listorder['hide']= array();
	for($i=0;$i<count($profileorder);$i++){
		$listorder[(($profile[$profileorder[$i]] or $profileorder[$i] == "Username")?'show':'hide')][] = $profileorder[$i];
	}
	$result = $sql->db_Update("clan_members_config", "profileorder='".serialize($listorder)."'");
}


//General Settings
$sql->db_Update("clan_members_config", "show_opened='$xshow_opened', style='$style', allowchangeinfo='$xallowchangeinfo', allowupimage='$xallowupimage', maxwidth='$maxwidth', maxheight='$maxheight', titlealign='$titlealign', show_gname='$xshow_gname', padding='$padding', maxfilesize='$maxfilesize', membersperrow='$xmembersperrow', rank_per_game='$xrank_per_game', joinformat='$joinformat', birthformat='$birthformat', enableprofile='$enableprofile', enablehardware='$enablehardware', enablegallery='$enablegallery', showawards='$showawards', maximages='$maximages', galfilesize='$galfilesize', thumbwidth='$thumbwidth', showuserimage='$showuserimage', profileimgwidth='$profileimgwidth', profileimgheight='$profileimgheight', listwidth='$listwidth', profiletoguests='$profiletoguests', profilealign='$profilealign', leftsidewidth='$leftsidewidth', gamesorteams='$gamesorteams', cmtitle='$cmtitle', guestviewcontactinfo='$guestviewcontactinfo', changeatdot='$changeatdot', showview='$showview', showcontactlist='$showcontactlist', inactiveafter='$inactiveafter'");

if(file_exists("admin/saveconfig_custom.php")){
	define('CUSTOM_CONFIG',true);
	include "admin/saveconfig_custom.php";
}

$text = "<meta http-equiv='refresh' content='1;URL=admin_old.php?Config' />
<center><br />"._CONFIGUPDATED."<br /><br /></center>";

$ns->tablerender("", $text);

?>