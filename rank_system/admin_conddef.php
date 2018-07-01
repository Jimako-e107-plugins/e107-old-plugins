<?php
/**
 * $Id: admin_conddef.php,v 1.3 2009/10/23 15:49:01 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 17 okt 2009 - 18:29:40
 * 
 * Revision: $Revision: 1.3 $
 * Last Modified: $Date: 2009/10/23 15:49:01 $
 *
 * Change Log:
 * $Log: admin_conddef.php,v $
 * Revision 1.3  2009/10/23 15:49:01  michiel
 * Configure Site Penalty settings
 *
 * Revision 1.2  2009/10/23 12:35:44  michiel
 * BugFix: used wrong class
 *
 * Revision 1.1  2009/10/22 15:03:36  michiel
 * Implemented customizable conditions
 *
 *  
 */
require_once("../../class2.php");
$e_wysiwyg = "wysiwyg";

if (!getperms("P")) {
	header("location:".e_BASE."index.php");
	exit;
}

require_once(e_PLUGIN."rank_system/includes/conddef_class.php");
require_once(e_PLUGIN."rank_system/includes/rank_class.php");
include_lan(e_PLUGIN . 'rank_system/languages/admin/' . e_LANGUAGE . '.php');
require_once(e_HANDLER."form_handler.php");

$rs = new form;
$conddef = new conddef; 

global $rank, $RANK_PREF, $sql;
if (!is_object($rank)) {
	$rank = new rank();
}
$rank->loadPlugins();

require_once(e_ADMIN . 'auth.php');
if (!defined('ADMIN_WIDTH')) {
    define(ADMIN_WIDTH, 'width:100%;');
}

if (e_QUERY) {
  $tmp = explode(".", e_QUERY);
  $action = $tmp[0];
  $sub_action = varset($tmp[1],'');
  $id = intval(varset($tmp[2],0));
  $sort_order = varset($tmp[2],'desc');
  $from = intval(varset($tmp[3],0));
  unset($tmp);
}

if (isset($_POST['edit_predefs'])) {
	$action = "edit_predefs";
}

if (isset($_POST['reset_penalties'])) {
	$msg = "";
	
	if ($_POST['reset_freeze'] == "set") {
		$sql->db_Update("rank_users", "freeze_penalty = 'T'");
		$msg = ADLAN_RS_CDF36;
	} else if ($_POST['reset_freeze'] == "unset") {
		$sql->db_Update("rank_users", "freeze_penalty = 'F'");
		$msg = ADLAN_RS_CDF37;
	}
	
	if (!$sql->db_Select("rank_condition", "condit_id", "condit_trigger = 'trigger_sitepen'")) {
		if ($msg == "") $msg = ADLAN_RS_CDF35;
	} else {
		extract($sql->db_Fetch());
		
		$sql->db_Select("rank_users", "user_userid, user_values");
		$usrList = $sql->db_getList();
		
		$counter = 0;
		foreach ($usrList as $usr) {
			$values = unserialize($usr['user_values']);
			if ($values[$condit_id.'_value'] > 0) {
				$values[$condit_id.'_value'] = 0;
				$values = serialize($values);
				$sql->db_Update("rank_users", "user_values = '$values' where user_userid = " . $usr['user_userid']);
				$counter++;
			}
		}
		if ($msg != "") $msg .= "<br />";
		$msg .= $counter . " " . ADLAN_RS_CDF38;
	}
	
	$conddef->show_message($msg);
	$action = "condition";
}

if (isset($_POST['update_predefs'])) {
	
	$RANK_PREF['sitpen_start'] = intval($_POST['sitpen_start']);
	$RANK_PREF['sitpen_penalty'] = intval($_POST['sitpen_penalty']);
	$RANK_PREF['sitpen_penday'] = intval($_POST['sitpen_penday']);
	$RANK_PREF['sitpen_recovery'] = intval($_POST['sitpen_recovery']);
	$rank->save_prefs();
	
	$conddef->show_message(ADLAN_RS_UPDOK);
	$action = "condition";
}

if(isset($_POST['delete'])) {
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);
}

if ($delete == "condition" && $del_id) {
	$sql->db_Select("rank_condition", "condit_order, condit_name", "condit_id=".$del_id);
	$row = $sql->db_Fetch();
	if ($sql->db_Delete("rank_condition", "condit_id='$del_id' ")) {
		$conddef->remove_condition($row['condit_order']);
		$conddef->show_message(ADLAN_RS_CDF17." ".$row['condit_name']." ".ADLAN_RS_CDF18);
		unset($delete, $del_id);
	}
}

if (isset($_POST['create_condit'])) {
	if ($_POST['condit_name']) {
		$_POST['condit_name'] = $tp->toDB($_POST['condit_name']);
		$_POST['condit_negative'] = ($_POST['condit_negative'] <> "") ? "T" : "F";
		$_POST['condit_enabled'] = ($_POST['condit_enabled'] <> "") ? "T" : "F";
		$_POST['condit_hastext'] = ($_POST['condit_hastext'] <> "") ? "T" : "F";
		$_POST['condit_maxval'] = intval($_POST['condit_maxval']);
		$_POST['condit_descript'] = $tp->toDB($_POST['condit_descript']);
		
		$conddef->insert_condition($_POST['condit_order']);
		$sql->db_Insert("rank_condition", 
			"'0'"
			.", ".$_POST['condit_order']
			.", '".$_POST['condit_name']."'"
			.", '".$_POST['condit_negative']."'"
			.", '".$_POST['condit_hastext']."'"
			.", ".$_POST['condit_maxval']
			.", '".$_POST['condit_factor']."'"
			.", '".$_POST['condit_onbar']."'"
			.", '".$_POST['condit_offbar']."'"
			.", '".$_POST['condit_trigger']."'"
			.", '".$_POST['condit_enabled']."'"
			.", '".$_POST['condit_descript']."'"
		);
		$conddef->show_message(ADLAN_RS_CDF17." ".ADLAN_RS_CDF19);
	}
}

if (isset($_POST['update_condit'])) {
	if ($_POST['condit_name']) {
		$_POST['condit_name'] = $tp->toDB($_POST['condit_name']);
		$_POST['condit_negative'] = ($_POST['condit_negative'] <> "") ? "T" : "F";
		$_POST['condit_hastext'] = ($_POST['condit_hastext'] <> "") ? "T" : "F";
		$_POST['condit_enabled'] = ($_POST['condit_enabled'] <> "") ? "T" : "F";
		$_POST['condit_maxval'] = intval($_POST['condit_maxval']);
		$_POST['condit_descript'] = $tp->toDB($_POST['condit_descript']);
		
		$sql->db_Update("rank_condition", "condit_order=99 WHERE condit_id='".$_POST['condit_id']."'");
		$conddef->remove_condition($_POST['old_order']);
		$conddef->insert_condition($_POST['condit_order']);
		
		$sql->db_Update("rank_condition", 
			"condit_order = ".$_POST['condit_order']
			.", condit_name = '".$_POST['condit_name']."'"
			.", condit_negative = '".$_POST['condit_negative']."'"
			.", condit_hastext = '".$_POST['condit_hastext']."'"
			.", condit_maxval = ".$_POST['condit_maxval']
			.", condit_factor = '".$_POST['condit_factor']."'"
			.", condit_onbar = '".$_POST['condit_onbar']."'"
			.", condit_offbar = '".$_POST['condit_offbar']."'"
			.", condit_trigger = '".$_POST['condit_trigger']."'"
			.", condit_enabled = '".$_POST['condit_enabled']."'"
			.", condit_descript = '".$_POST['condit_descript']."'"
			
			." where condit_id = ".$_POST['condit_id']
		);
		$conddef->show_message(ADLAN_RS_CDF17." ".ADLAN_RS_CDF20);
	}
}

if ($action == 'edit_predefs') {
	$conddef->edit_predefined();
}

if ($action == "" || $action == 'condition') {
	$conddef->show_conditions($sub_action, $id);
}



require_once(e_ADMIN . 'footer.php');

?>
