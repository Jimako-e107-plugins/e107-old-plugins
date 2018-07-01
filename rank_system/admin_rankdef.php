<?php
/**
 * $Id: admin_rankdef.php,v 1.2 2009/07/14 19:29:00 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.2 $
 * Last Modified: $Date: 2009/07/14 19:29:00 $
 *
 * Change Log:
 * $Log: admin_rankdef.php,v $
 * Revision 1.2  2009/07/14 19:29:00  michiel
 * CVS Merge
 *
 * Revision 1.1.8.1  2009/07/05 20:30:24  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.1.10.1  2009/06/30 20:10:16  michiel
 * Fixed weird apache/php (?) bug: white line after ?> mark (at end of file) could lead into not parsing the code
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

require_once(e_PLUGIN."rank_system/includes/rankdef_class.php");
include_lan(e_PLUGIN . 'rank_system/languages/admin/' . e_LANGUAGE . '.php');
require_once(e_HANDLER."form_handler.php");

$rs = new form;
$rankdef = new rankdef; 

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

if ($delete == "rank" && $del_id) {
	$sql->db_Select("rank_ranks", "rank_order, rank_name", "rank_id=".$del_id);
	$row = $sql->db_Fetch();
	if ($sql->db_Delete("rank_ranks", "rank_id='$del_id' ")) {
		$rankdef->remove_rank($row['rank_order']);
		$rankdef->show_message(ADLAN_RS_DEF28." ".$row['rank_name']." ".ADLAN_RS_DEF2);
		unset($delete, $del_id);
	}
}

if (isset($_POST['create_rank'])) {
	if ($_POST['rank_name']) {
		$_POST['rank_name'] = $tp->toDB($_POST['rank_name']);
		$_POST['rank_reserved'] = ($_POST['rank_reserved'] <> "") ? "T" : "F";
		$rankdef->insert_rank($_POST['rank_order']);
		$sql->db_Insert("rank_ranks", "'0', ".$_POST['rank_order'].", ".$_POST['rank_category'].", '".$_POST['rank_name']."', '".$_POST['rank_img']."', ".$_POST['rank_points'].", ".$_POST['rank_wage'].", '".$_POST['rank_reserved']."'");
		$rankdef->show_message(ADLAN_RS_DEF28." ".ADLAN_RS_DEF3);
	}
}

if (isset($_POST['update_rank'])) {
	if ($_POST['rank_name']) {
		$_POST['rank_name'] = $tp->toDB($_POST['rank_name']);
		$_POST['rank_reserved'] = ($_POST['rank_reserved'] <> "") ? "T" : "F";
		$sql->db_Update("rank_ranks", "rank_order=99 WHERE rank_id='".$_POST['rank_id']."'");
		$rankdef->remove_rank($_POST['old_order']);
		$rankdef->insert_rank($_POST['rank_order']);
		$sql->db_Update("rank_ranks", "rank_order=".$_POST['rank_order'].", rank_category=".$_POST['rank_category'].", rank_name='".$_POST['rank_name']."', rank_img='".$_POST['rank_img']."', rank_points=".$_POST['rank_points'].", rank_wage=".$_POST['rank_wage'].", rank_reserved='".$_POST['rank_reserved']."' WHERE rank_id='".$_POST['rank_id']."'");
		$rankdef->show_message(ADLAN_RS_DEF28." ".ADLAN_RS_DEF4);
	}
}

if (!e_QUERY || $action == 'rank') {
	$rankdef->show_ranks($sub_action, $id);
}

require_once(e_ADMIN . 'footer.php');

?>