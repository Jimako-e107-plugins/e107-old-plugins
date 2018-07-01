<?php
/**
 * $Id: admin_medaldef.php,v 1.5 2009/10/22 15:00:19 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.5 $
 * Last Modified: $Date: 2009/10/22 15:00:19 $
 *
 * Change Log:
 * $Log: admin_medaldef.php,v $
 * Revision 1.5  2009/10/22 15:00:19  michiel
 * Using cache
 *
 * Revision 1.4  2009/07/14 19:29:04  michiel
 * CVS Merge
 *
 * Revision 1.3.2.3  2009/07/13 18:50:44  michiel
 * Added medal reward
 *
 * Revision 1.3.2.2  2009/07/12 12:39:43  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.3.4.2  2009/07/12 11:46:21  michiel
 * BugFix: Delete granted medals too, upon deleting a medal
 *
 * Revision 1.3.4.1  2009/06/30 20:10:19  michiel
 * Fixed weird apache/php (?) bug: white line after ?> mark (at end of file) could lead into not parsing the code
 *
 * Revision 1.3  2009/06/28 15:05:53  michiel
 * Merged from dev_01_03
 *
 * Revision 1.2.2.1  2009/06/27 15:48:09  michiel
 * - BugFix: insert / update of medals and ribbons failed when medal bonus field wasn't filled
 * - Added 2nd image for medals and ribbons
 *
 * Revision 1.2  2009/06/26 09:23:09  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.1  2009/05/20 18:37:46  michiel
 * implemented Medal Bonus
 *
 * Revision 1.1  2009/03/28 13:01:42  michiel
 * Initial CVS revision
 *
 *  
 */
require_once("../../class2.php");

if (!getperms("P")) {
	header("location:".e_BASE."index.php");
	exit;
}

global $sql, $e107cache;

require_once(e_PLUGIN."rank_system/includes/meddef_class.php");
include_lan(e_PLUGIN . 'rank_system/languages/admin/' . e_LANGUAGE . '.php');
$meddef = new meddef; 

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

if ($delete == "medal" && $del_id) {
	$sql->db_Select("rank_medals", "medal_type, medal_order, medal_name", "medal_id=".$del_id);
	$row = $sql->db_Fetch();
	if ($sql->db_Delete("rank_medals", "medal_id='$del_id' ")) {
		$meddef->remove_medal($row['medal_order']);
		/*
		 * BugFix @v1.3.1
		 * Delete user's medals too
		 */
		$sql->db_Delete("rank_medal_users", "med_user_medal = $del_id");
		$meddef->show_message(ADLAN_RS_MDF15." ".$row['medal_name']." ".ADLAN_RS_MDF16);
		unset($delete, $del_id);
	}
	$e107cache->clear("rank_medribs");
}

if (isset($_POST['create_medal'])) {
	if ($_POST['medal_name']) {
		$_POST['medal_name'] = $tp->toDB($_POST['medal_name']);
		$_POST['medal_reserved'] = ($_POST['medal_reserved'] <> "") ? "T" : "F";
		
		$meddef->insert_medal($_POST['medal_order']);
		/*
		 * BugFix @v1.3
		 * Query failed when the 'medal bonus' field wasn't filled.
		 * Now it will be 0 when not filled
		 */
		$sql->db_Insert("rank_medals", 
			"0".
			", ".$_POST['medal_type'].
			", ".$_POST['medal_order'].
			", ".$_POST['medal_category'].
			", '".$_POST['medal_name']."'".
			", '".$_POST['medal_img']."'".
			", '".$_POST['medal_img2']."'".
			", '".$_POST['medal_description']."'".
			", ".$_POST['medal_goal'].
			", '".$_POST['medal_reserved']."'".
			", ".intval($_POST['medal_bonus']).
			", ".intval($_POST['medal_reward'])
		);
		$meddef->show_message(ADLAN_RS_MDF15." ".ADLAN_RS_MDF17);
	}
	$action = 'medal';
	$e107cache->clear("rank_medribs");
}

if (isset($_POST['update_medal'])) {
	if ($_POST['medal_name']) {
		$_POST['medal_name'] = $tp->toDB($_POST['medal_name']);
		$_POST['medal_reserved'] = ($_POST['medal_reserved'] <> "") ? "T" : "F";
		$sql->db_Update("rank_medals", "medal_order=99 WHERE medal_id='".$_POST['medal_id']."'");
		$meddef->remove_medal($_POST['old_order']);
		$meddef->insert_medal($_POST['medal_order']);
		/*
		 * BugFix @v1.3
		 * Query failed when the 'medal bonus' field wasn't filled.
		 * Now it will be 0 when not filled
		 */
		$sql->db_Update("rank_medals", 
			"medal_type=".$_POST['medal_type'].
			", medal_order=".$_POST['medal_order'].
			", medal_category=".$_POST['medal_category'].
			", medal_name='".$_POST['medal_name']."'".
			", medal_img='".$_POST['medal_img']."'".
			", medal_img2='".$_POST['medal_img2']."'".
			", medal_description='".$_POST['medal_description']."'".
			", medal_goal=".$_POST['medal_goal'].
			", medal_reserved='".$_POST['medal_reserved']."'".
			", medal_bonus=".intval($_POST['medal_bonus']).
			", medal_reward=".intval($_POST['medal_reward']).
			" WHERE medal_id=".$_POST['medal_id']
		);
		$meddef->show_message(ADLAN_RS_MDF15." ".ADLAN_RS_MDF18);
	}
	$action = 'medal';
	$e107cache->clear("rank_medribs");
}

if (!e_QUERY || $action == 'medal') {
	$meddef->show_medals($sub_action, $id);
}

require_once(e_ADMIN . 'footer.php');

?>