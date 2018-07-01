<?php
/**
 * $Id: admin_catdef.php,v 1.3 2010/01/29 23:38:30 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.3 $
 * Last Modified: $Date: 2010/01/29 23:38:30 $
 *
 * Change Log:
 * $Log: admin_catdef.php,v $
 * Revision 1.3  2010/01/29 23:38:30  michiel
 * BugFix: when adding a new ccategory, the classes and category name were switched around
 *
 * Revision 1.2  2009/07/14 19:29:04  michiel
 * CVS Merge
 *
 * Revision 1.1.8.1  2009/07/05 20:30:22  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.1.10.1  2009/06/30 20:10:18  michiel
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

require_once(e_PLUGIN."rank_system/includes/rankdef_class.php");
include_lan(e_PLUGIN . 'rank_system/languages/admin/' . e_LANGUAGE . '.php');
require_once(e_HANDLER."form_handler.php");
require_once(e_HANDLER . 'userclass_class.php');

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

if ($delete == "category" && $del_id) {
	if ($sql->db_Delete("rank_category", "category_id='$del_id' ")) {
		$rankdef->show_message(ADLAN_RS_DEF1." #".$del_id." ".ADLAN_RS_DEF2);
		unset($delete, $del_id);
	}
}

if (isset($_POST['create_category'])) {
	if ($_POST['category_name']) {
		$_POST['category_name'] = $tp->toDB($_POST['category_name']);
		$classcount = count($_POST['category_class'])-1;
		for($a = 0; $a <= $classcount; $a++) {
			//check_allowed($_POST['category_class'][$a]);
			$cclass .= $_POST['category_class'][$a];
			$cclass .= ($a < $classcount ) ? "," : "";
		}
		
		$sql->db_Insert("rank_category", "'0', '".$_POST['category_name']."', '".$cclass."', '".$_POST['category_age']."'");
		$rankdef->show_message(ADLAN_RS_DEF1." ".ADLAN_RS_DEF3);
	}
}

if (isset($_POST['update_category'])) {
	if ($_POST['category_name']) {
		$_POST['category_name'] = $tp->toDB($_POST['category_name']);
		$classcount = count($_POST['category_class'])-1;
		for($a = 0; $a <= $classcount; $a++) {
			//check_allowed($_POST['category_class'][$a]);
			$cclass .= $_POST['category_class'][$a];
			$cclass .= ($a < $classcount ) ? "," : "";
		}
		
		$sql->db_Update("rank_category", "category_class='".$cclass."', category_name='".$_POST['category_name']."', category_age='".$_POST['category_age']."' WHERE category_id='".$_POST['category_id']."'");
		$rankdef->show_message(ADLAN_RS_DEF1." ".ADLAN_RS_DEF4);
	}
}

if (!e_QUERY || $action == 'cat') {
	$rankdef->show_categories($sub_action, $id);
}

require_once(e_ADMIN . 'footer.php');

?>