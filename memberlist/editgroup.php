<?php
/**
 * $Id: editgroup.php 25 2010-09-13 19:41:48Z michiel $
 * 
 * Memberlist plugin for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2010
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 11 sep. 2010
 * $HeadURL: svn://ubusrv/echo2/MemberList/frontliners.eu/fl_plugins/memberlist/editgroup.php $
 * 
 * Revision: $LastChangedRevision: 25 $
 * Last Modified: $LastChangedDate: 2010-09-13 21:41:48 +0200 (ma, 13 sep 2010) $
 *
 */
require_once('../../class2.php');
if (!defined('e107_INIT')) {
    exit;
}
if (!defined("USER_WIDTH")) {
    define(USER_WIDTH, "width:100%;");
}

if (file_exists(e_PLUGIN . 'memberlist/languages/' . e_LANGUAGE . '.php')) {
	include_lan(e_PLUGIN . 'memberlist/languages/' . e_LANGUAGE . '.php');
} else {
	include_lan(e_PLUGIN . 'memberlist/languages/English.php');
}

$title = LAN_MBL_EU01;
define('e_PAGETITLE', $title);
require_once(HEADERF);

require_once(e_PLUGIN . 'memberlist/includes/memberlist_class.php');
global $sql, $MBL_PREF, $mbl_obj, $tp, $ns, $gstyle_obj;
if (!$mbl_obj) {
	$mbl_obj = new memberlist();
}

if (file_exists(THEME."memberlist_template.php")) {
	require_once(THEME."memberlist_template.php");
} else {
	require_once(e_PLUGIN."memberlist/templates/memberlist_template.php");
}
require_once(e_PLUGIN.'memberlist/includes/memberlist_shortcodes.php');

if ($_POST) {
	$user_id = $_POST['user_id'];
	$action = $_POST['action'];
} else if (e_QUERY) {
	$tmp = explode(".", e_QUERY);
	$user_id = intval(varset($tmp[0],0));
	$action = varset($tmp[1],"edit");
	unset($tmp);
} else {
	$user_id = 0;
	$action = "edit";
}

if (isset($_POST['cncledit'])) {
	$ref = e_BASE."/user.php?id.$user_id";
    header('location:' . $ref);
    exit;
}

if ($user_id == 0 || !check_class($MBL_PREF['editclass']) || !$sql->db_Select("user", "user_name, user_class", "user_id = $user_id")) {
	$ns->tablerender($title, LAN_MBL_EU02);
	require_once(FOOTERF);
	exit;
}
extract($sql->db_Fetch());

$mbl_text = "";
$mbl_msg = "";

if ($action == "save") {
	if ($MBL_PREF['adminlog']) {
		global $admin_log;

		$old = explode(",", $user_class);
		
		$new = $_POST['mbl_groups'];
		$list = explode(",", $MBL_PREF['groups']);
		$added = "";
		$removed = "";
		while (list($key, $cls)=each($list)) {
			if ($cls == e_UC_ADMIN) {
				$cName = LAN_MBL_OV10;
			} else {
				$sql->db_Select("userclass_classes", "userclass_name", "userclass_id = $cls");
				$row = $sql->db_Fetch();
				$cName = $row['userclass_name'];
			}
			
			if (!in_array($cls, $old) && in_array($cls, $new)) {
				$added .= ($added != "" ? ", " : "") . $cName; 
			} else if (in_array($cls, $old) && !in_array($cls, $new)) {
				$removed .= ($removed != "" ? ", " : "") . $cName; 
			} 
			
			if ($_POST['primgrp'] == $cls) $primName = $cName;
		}
		
		if ($added == "") $added = "-";
		if ($removed == "") $removed = "-";
		
		$msg = LAN_MBL_LO01 . "$user_name \n".LAN_MBL_LO02." $added\n".LAN_MBL_LO03." $removed\n".LAN_MBL_LO04." $primName";
		$admin_log->log_event(LAN_MBL,$msg,E_LOG_PLUGIN); 
	}
	
	
	$result = $mbl_obj->updateUser($_POST['mbl_groups'], $_POST['primgrp'], $user_id); 
	if ($result === true) {
		$ref = e_BASE."/user.php?id.$user_id";
	    header('location:' . $ref);
	    exit;
	}
	
	$mbl_msg = $result;
	$action = "edit";
}

if ($action == "edit") {
	$cList = $mbl_obj->getUserStat($user_id);
	
	$mbl_text .= "
		<form method='post' action='" . e_SELF . "' id='dataform' >
			<input type='hidden' name='action' value='save'/>
			<input type='hidden' name='user_id' value='$user_id'/>
	";
	
	$mbl_text .= $tp->parsetemplate($EDIT_HEADER, true, $mbl_shortcodes);
	
	while (list($cID, $class)=each($cList)) {
		$cName = $class['name'];
		$cSelected = $class['active'];
		$cPrimary = $class['primary'];
		$cDisabled = $class['disabled'];
		
		$mbl_text .= $tp->parsetemplate($EDIT_ROW, true, $mbl_shortcodes);
	}
	$mbl_text .= $tp->parsetemplate($EDIT_FOOTER, true, $mbl_shortcodes);
	$mbl_text .= "</form>";
}

$ns->tablerender($title, $mbl_text);
require_once(FOOTERF);



?>