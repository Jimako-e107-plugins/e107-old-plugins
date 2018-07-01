<?php
/**
 * $Id: admin_med_catdef.php,v 1.2 2009/07/14 19:29:00 michiel Exp $
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
 * $Log: admin_med_catdef.php,v $
 * Revision 1.2  2009/07/14 19:29:00  michiel
 * CVS Merge
 *
 * Revision 1.1.8.1  2009/07/05 20:30:22  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.1.10.1  2009/06/30 20:10:20  michiel
 * Fixed weird apache/php (?) bug: white line after ?> mark (at end of file) could lead into not parsing the code
 *
 * Revision 1.1  2009/03/28 13:01:41  michiel
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

if ($delete == "category" && $del_id) {
	if ($sql->db_Delete("rank_medal_category", "med_cat_id='$del_id' ")) {
		$meddef->show_message(ADLAN_RS_MDF1." #".$del_id." ".ADLAN_RS_MDF16);
		unset($delete, $del_id);
	}
}

if (isset($_POST['create_category'])) {
	if ($_POST['med_cat_name']) {
		$_POST['med_cat_name'] = $tp->toDB($_POST['med_cat_name']);
		$sql->db_Insert("rank_medal_category", "'0', '".$_POST['med_cat_name']."'");
		$meddef->show_message(ADLAN_RS_MDF1." ".ADLAN_RS_MDF17);
	}
}

if (isset($_POST['update_category'])) {
	if ($_POST['med_cat_name']) {
		$_POST['med_cat_name'] = $tp->toDB($_POST['med_cat_name']);
		$sql->db_Update("rank_medal_category", "med_cat_name='".$_POST['med_cat_name']."' where med_cat_id=".$_POST['med_cat_id']);
		$meddef->show_message(ADLAN_RS_MDF1." ".ADLAN_RS_MDF18);
	}
}

if (!e_QUERY || $action == 'cat') {
	$meddef->show_categories($sub_action, $id);
}

require_once(e_ADMIN . 'footer.php');

?>