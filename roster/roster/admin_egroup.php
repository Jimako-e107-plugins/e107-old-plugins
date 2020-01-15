<?php

// incude e107 class file, it's required
require_once("../../class2.php");

//style for our table
$eplug_css = "html/style.css";

// check if user is admin, if not redirect to home page
if (!getperms("P")) {
	header("location:".e_HTTP."index.php");
	exit;
}

// include language file
include_lan(e_PLUGIN."roster/languages/admin/".e_LANGUAGE.".php");

// include admin header
require_once(e_ADMIN."auth.php");

// Set the active menu option for admin_menu.php
$pageid = 'editgroup';

//admin html file
require_once("html/admin/roster_adminegroup.php");
$html = new adminegroup_html;

$text = $html->egroup_header();

switch($_GET['action']){
	case 'edit':
		$text .= $html->egroup_form($_GET['g_id']);
	break;
	case 'do_edit':
		if($_POST['do_order']){
			foreach($_POST['g_order'] as $g_id=>$order){
				$sql->db_Update("roster_groups", "roster_group_order='".$order."' WHERE roster_group_id='".$g_id."'");
			}

			$text .= $html->egroup_updated();
		}else if($_POST['do_edit']){
			$group_name = $tp->toDB($_POST['g_name']);

			$sql->db_Update("roster_groups", "roster_group_name='".$group_name."' WHERE roster_group_id='".$_GET['g_id']."'");
			$text .= $html->egroup_success($group_name);
		}else{
			$text .= $html->egroup_show();
		}
	break;
	default:
		$text .= $html->egroup_show();
}

$text .= $html->egroup_footer();

// output the text
$ns->tablerender(roster_LAN_ADMIN_EGROUP_TITLE, $text);

require_once(e_ADMIN."footer.php");

?>