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

if (!defined('CM_ADMIN')) {
	die ("Access Denied");
}

$neworder = $_POST['neworder'];
$info = $_POST['info'];
$style = intval($_POST['style']);
$xshow_opened = intval($_POST['xshow_opened']);
$xallowchangeinfo = intval($_POST['xallowchangeinfo']);
$xallowupimage = intval($_POST['xallowupimage']);
$maxwidth = intval($_POST['maxwidth']);
$maxheight = intval($_POST['maxheight']);
$titlealign = mysql_real_escape_string($_POST['titlealign']);
$banneralign = mysql_real_escape_string($_POST['banneralign']);
$xshow_gname = intval($_POST['xshow_gname']);
$padding = intval($_POST['padding']);
$maxfilesize = intval($_POST['maxfilesize']);
$xmembersperrow = intval($_POST['xmembersperrow']);
$joinformat = mysql_real_escape_string($_POST['joinformat']);
$birthformat = mysql_real_escape_string($_POST['birthformat']);
$showuserimage = intval($_POST['showuserimage']);
$listwidth = mysql_real_escape_string($_POST['listwidth']);
$gamesorteams = mysql_real_escape_string($_POST['gamesorteams']);
$gamesmemberswars = intval($_POST['gamesmemberswars']);
$teamsmemberswars = intval($_POST['teamsmemberswars']);
$showlastwars = intval($_POST['showlastwars']);
$userimgsrc = intval($_POST['userimgsrc']);
$guestviewcontactinfo = intval($_POST['guestviewcontactinfo']);
$changeatdot = intval($_POST['changeatdot']);

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


//General Settings
$sql->db_Update("clan_members_config", "show_opened='$xshow_opened', style='$style', allowchangeinfo='$xallowchangeinfo', allowupimage='$xallowupimage', maxwidth='$maxwidth', maxheight='$maxheight', titlealign='$titlealign', show_gname='$xshow_gname', padding='$padding', maxfilesize='$maxfilesize', membersperrow='$xmembersperrow', joinformat='$joinformat', birthformat='$birthformat', showuserimage='$showuserimage', listwidth='$listwidth', gamesorteams='$gamesorteams', guestviewcontactinfo='$guestviewcontactinfo', changeatdot='$changeatdot'");

$text = "<meta http-equiv='refresh' content='1;URL=admin.php?Config' />
<center><br />"._CONFIGUPDATED."<br /><br /></center>";

$ns->tablerender("", $text);

?>