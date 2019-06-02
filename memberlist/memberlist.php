<?php
/**
 * $Id: memberlist.php 42 2010-09-28 21:39:01Z michiel $
 * 
 * Memberlist plugin for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2010
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 4 sep. 2010
 * $HeadURL: svn://ubusrv/echo2/MemberList/frontliners.eu/fl_plugins/memberlist/memberlist.php $
 * 
 * Revision: $LastChangedRevision: 42 $
 * Last Modified: $LastChangedDate: 2010-09-28 23:39:01 +0200 (di, 28 sep 2010) $
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

require_once(e_PLUGIN.'memberlist/includes/dtstamp.php');
$dt = new dtstamp();

$title = LAN_MBL;
define('e_PAGETITLE', $title);
require_once(HEADERF);

require_once(e_PLUGIN . 'memberlist/includes/memberlist_class.php');
global $sql, $MBL_PREF, $mbl_obj, $tp, $ns;
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
	$action = $_POST['action'];
	$from = $_POST['from'];
	$order = $_POST['order'];
	$invert = $_POST['invert'];
	$banned = $_POST['banned'];
	$filter = $_POST['filter'];
	$prevflt = $_POST['prevflt'];
} else if (e_QUERY) {
	$tmp = explode(".", e_QUERY);
	$action = $tmp[0];
	$from = intval(varset($tmp[1],0));
	$order = intval(varset($tmp[2],0));
	$invert = intval(varset($tmp[3],0));
	$banned = intval(varset($tmp[4],0));
	$filter = intval(varset($tmp[5],0));
	$prevflt = intval(varset($tmp[6],0));
	unset($tmp);
} else {
	$action = "show";
	$from = 0;
	$order = 0;
	$invert = 0;
	$banned = 0;
	$filter = 0;
	$prevflt = 0;
}

$mbl_text = "";

//TODO admins can filter banned
$banned = false;

//Only admins can view banned members here
if ($banned && !ADMIN) {
	$banned = false;
}

//validate filter
if (!$mbl_obj->isAllowed($filter)) {
	$filter = 0;
}
if ($prevflt != $filter) {
	//Changed filter... reset 'from'
	$from = 0;
	$prevflt = $filter;
}

if ($action == "show" || $action == "") {
	$captionlist = array (
		"id" => getOrderLink(LAN_MBL_OV01, 1)
		,"name" => getOrderLink(LAN_MBL_OV02, 0)
		,"groups" => LAN_MBL_OV03
		,"lastvisit" => getOrderLink(LAN_MBL_OV04, 2)
		,"joined" => getOrderLink(LAN_MBL_OV05, 3)
	);
	
	$clsList = loadClasses();
	$showList = explode(",", $MBL_PREF['groups']);
	
	$mbl_text .= $tp->parsetemplate($LIST_HEADER, true, $mbl_shortcodes);
	
	$filtercheck = "";
	if ($filter == e_UC_ADMIN) {
		$filtercheck = " AND user_admin = 1 ";
	} else if ($filter > 0) {
		$filtercheck = "
			AND (
				user_class = '$filter'
				OR user_class like '$filter,%'
				OR user_class like '%,$filter'
				OR user_class like '%,$filter,%'
			) 
		";
	}
	
	$bancheck = ($banned ? "" : " AND user_ban != 1 ");
	$count = $sql->db_Count("user", "(user_id)", " WHERE 1=1 $bancheck $filtercheck");
	
	$query = "
		SELECT
			user_id
			,user_name
			,user_lastvisit
			,user_join
			,user_email
			,user_hideemail
			,user_admin
			,user_ban
			,user_class
		FROM
			#user
		WHERE
			1=1
			$bancheck
			$filtercheck
		ORDER BY
			".getOrder($order, $invert)."
		LIMIT $from,".$MBL_PREF['list_pagesize']."
	";
	
	if ($sql->db_Select_gen($query)) {
		$uList = $sql->db_getList();
	
		foreach ($uList as $user) {
			$groups = getUserGroups($user['user_class'], $user['user_admin']);
			$mbl_text .= $tp->parsetemplate($LIST_ROW, true, $mbl_shortcodes);
		}
	} else {
		$mbl_text .= $tp->parsetemplate($LIST_EMPTY, true, $mbl_shortcodes);
	}

	$ban = ($banned ? '1' : '0');
    $parms = $count . ",".$MBL_PREF['list_pagesize'].",$from," . e_SELF . "?$action.[FROM].$order.$invert.$ban.$filter.$prevflt";
    $nextprev = $tp->parseTemplate("{NEXTPREV={$parms}}") . '';
    $filterbox = getFilterbox();
    
    $mbl_text .= $tp->parsetemplate($LIST_FOOTER, true, $mbl_shortcodes);
}

$ns->tablerender(LAN_MBL, $mbl_text);
require_once(FOOTERF);

function getUserClasses($user) {
	global $classlist;
	
	$retval = "";
	$list = explode(",", $user['user_class']);
	foreach($list as $class) {
		$tmp[] = $classlist[$class];
	}
	if ($user['user_admin']) {
		$tmp[] = $classlist[e_UC_ADMIN];
	}
	sort($tmp);
	foreach($tmp as $class) {
		if ($retval != "") $retval .= ", ";
		$retval .= ($class == $classlist[$user['user_primary']] ? "<strong>$class</strong>" : $class);
	}
	
	return $retval;
}

function getOrderLink($title, $curOrd, $action = "show") {
	global $order, $invert, $from, $banned, $filter, $prevflt;
	
	$ban = ($banned ? '1' : '0');

	$start = 0;
	
	if ($order == $curOrd) {
		$img = '<img src="'.e_PLUGIN.'memberlist/images/sort'.($invert ? 'dn' : 'up').'.png" border="0" />';
	} else {
		$img = '';
	}
	
	$link = "
		<a href='".e_SELF."?$action.$start.$curOrd.".($order == $curOrd && !$invert ? 1 : 0).".$ban.$filter.$prevflt'>
			<strong>$title</strong></a>
	".$img;
	
	return $link;
}

function getOrder($order, $invert = false) {
	switch ($order) {
		/*
		 * 0	name
		 * 1	id
		 * 2	last visit
		 * 3	joined
		 */
		case 0:	return " user_name ".($invert ? "desc" : "asc");
		case 1:	return " user_id ".($invert ? "desc" : "asc");
		case 2:	return " user_lastvisit ".($invert ? "desc" : "asc")." , user_name ";
		case 3:	return " user_join ".($invert ? "desc" : "asc")." , user_name ";
		
		default:
			return " user_name ".($invert ? "desc" : "asc");
	}
}

function loadClasses() {
	global $sql;
	
	$clist[e_UC_ADMIN] = LAN_MBL_OV10;
	
	if ($sql->db_Select("userclass_classes")) {
		while ($row = $sql->db_Fetch()) {
			$clist[$row['userclass_id']] = $row['userclass_name']; 
		}
	}
	
	return $clist;
}

function getUserGroups($user_class, $user_admin) {
	global $showList, $clsList;
	
	$uClslist = explode(",", $user_class);
	
	foreach ($uClslist as $uCls) {
		if (in_array($uCls, $showList)) {
			$tmp[] = $clsList[$uCls];
		}
	}
	
	if ($user_admin && in_array(e_UC_ADMIN, $showList)) $tmp[] = $clsList[e_UC_ADMIN];
	
	sort($tmp);
	
	$retval = "";
	
	foreach ($tmp as $cls) {
		if ($retval != "") $retval .= "<br/>";
		$retval .= $cls;
	}
	
	return $retval;
	
}

function getFilterbox($action = "show") {
	global $from, $order, $invert, $banned, $filter, $prevflt, $showList, $clsList;
	$ban = ($banned ? '1' : '0');
	
	$sel = ($filter == 0 ? "selected='selected'" : "");
	$box = "\n
		<select class='tbox' name='filterSelect' onchange='location.href=this.options[selectedIndex].value'>\n
		<option value='".e_SELF."?$action.$from.$order.$invert.$banned.0.$prevflt' $sel>".LAN_MBL_OV12."</option>\n
	";
	
	unset($opts);
	foreach($showList as $cls) {
		$opts[$cls] = $clsList[$cls];
	}
	asort($opts);
	
	while(list($key, $value)=each($opts)) {
		$sel = ($filter == $key ? "selected='selected'" : "");
		$box .= "<option value='".e_SELF."?$action.$from.$order.$invert.$ban.$key.$prevflt' $sel>$value</option>\n";
	}

	$box .= "</select>";
	
	return $box;
}


?>