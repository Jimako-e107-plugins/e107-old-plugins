<?php
/**
 * $Id: admin_med_goaldef.php,v 1.4 2009/10/22 21:29:46 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.4 $
 * Last Modified: $Date: 2009/10/22 21:29:46 $
 * Revision: $Revision: 1.4 $
 * Last Modified: $Date: 2009/10/22 21:29:46 $
 *
 * Change Log:
 * $Log: admin_med_goaldef.php,v $
 * Revision 1.4  2009/10/22 21:29:46  michiel
 * Implemeted Time-based goals
 *
 * Revision 1.3  2009/07/14 19:29:05  michiel
 * CVS Merge
 *
 * Revision 1.2.6.2  2009/07/12 12:39:43  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.2.6.1  2009/07/05 20:30:24  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.2.8.1  2009/06/30 20:10:17  michiel
 * Fixed weird apache/php (?) bug: white line after ?> mark (at end of file) could lead into not parsing the code
 *
 * Revision 1.2.8.2  2009/07/12 11:45:22  michiel
 * BugFix: Typo in revalidate all after creating/changing a medal goal
 *
 * Revision 1.2.8.1  2009/06/30 20:10:17  michiel
 * Fixed weird apache/php (?) bug: white line after ?> mark (at end of file) could lead into not parsing the code
 *
 * Revision 1.2  2009/06/26 09:23:12  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.1  2009/04/01 19:26:38  michiel
 * Medal goal automated using e_rank.php
 *
 * Revision 1.1  2009/03/28 13:01:44  michiel
 * Initial CVS revision
 *
 *  
 */
require_once("../../class2.php");

if (!getperms("P")) {
	header("location:".e_BASE."index.php");
	exit;
}

require_once(e_PLUGIN."rank_system/includes/meddef_class.php");
require_once(e_PLUGIN."rank_system/includes/medal_class.php");
require_once(e_PLUGIN."rank_system/includes/rank_class.php");
include_lan(e_PLUGIN . 'rank_system/languages/admin/' . e_LANGUAGE . '.php');

$meddef = new meddef; 

global $rank_obj;
if (!$rank_obj) {
	$rank_obj = new rank;
}

$rank_obj->loadPlugins();

require_once(e_ADMIN . 'auth.php');
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, 'width:100%;');
}


if (e_QUERY) 
{
  $tmp = explode(".", e_QUERY);
  $action = $tmp[0];
  $sub_action = varset($tmp[1],'');
  $id = intval(varset($tmp[2],0));
  $sort_order = varset($tmp[2],'desc');
  $from = intval(varset($tmp[3],0));
  unset($tmp);
}


if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);
}

if ($delete == "goal" && $del_id) {
	if ($sql->db_Delete("rank_medal_goal", "med_goal_id='$del_id' ")) {
		$meddef->show_message(ADLAN_RS_MDF32." #".$del_id." ".ADLAN_RS_MDF16);
		unset($delete, $del_id);
	}
}

if (isset($_POST['create_goal'])) {
	if ($_POST['med_goal_name']) {
		$_POST['med_goal_name'] = $tp->toDB($_POST['med_goal_name']);
		if ($_POST['med_goal_type'] == "time") {
			$_POST['med_goal_value'] = (intval($_POST['med_goal_value']) * intval($_POST['tg_value']));
		}
		$sql->db_Insert("rank_medal_goal", "'0', '".$_POST['med_goal_name']."', '".$_POST['med_goal_target']."', '".$_POST['med_goal_type']."', ".$_POST['med_goal_value']);
		
		if ($_POST['revalidate'] == 'T') {
			/*
			 * BugFix v1.3.1
			 * one $ too many
			 */
			$medal_obj = new medal;
			$medal_obj->validateAll();
		}
		
		$meddef->show_message(ADLAN_RS_MDF32." ".ADLAN_RS_MDF17);
	}
}

if (isset($_POST['update_goal'])) {
	if ($_POST['med_goal_name']) {
		$_POST['med_goal_name'] = $tp->toDB($_POST['med_goal_name']);
		if ($_POST['med_goal_type'] == "time") {
			$_POST['med_goal_value'] = (intval($_POST['med_goal_value']) * intval($_POST['tg_value']));
		}
		$sql->db_Update("rank_medal_goal", "med_goal_name='".$_POST['med_goal_name']."', med_goal_target='".$_POST['med_goal_target']."', med_goal_type='".$_POST['med_goal_type']."', med_goal_value=".$_POST['med_goal_value']." where med_goal_id=".$_POST['med_goal_id']);
		
		if ($_POST['revalidate'] == 'T') {
			/*
			 * BugFix v1.3.1
			 * one $ too many
			 */
			$medal_obj = new medal;
			$medal_obj->validateAll();
		}
		
		$meddef->show_message(ADLAN_RS_MDF32." ".ADLAN_RS_MDF18);
	}
}

if (!e_QUERY || $action == 'goal') {
	$meddef->show_goals($sub_action, $id);
}

require_once(e_ADMIN . 'footer.php');

?>