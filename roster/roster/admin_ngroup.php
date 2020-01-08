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
$pageid = 'newgroup';

//admin html file
require_once("html/admin/roster_adminngroup.php");
$html = new adminngroup_html;

$text = $html->ngroup_header();

switch($_GET['action']){
	case 'do_add':
		if($_POST['submit']){
			$group_name = $tp->toDB($_POST['g_name']);
			$groups_q = $sql->db_Select("roster_groups", "*", "roster_group_id!='0' ORDER BY roster_group_order DESC LIMIT 1");
			$groups_a = $sql->db_Fetch(MYSQL_ASSOC);
			$group_order = $groups_a['roster_group_order'] + 1;

			$sql->db_Insert("roster_groups", "'', '".$group_name."', '".$group_order."'");
			$text .= $html->ngroup_success($group_name);
		}else{
			$text .= $html->ngroup_form();
		}
	break;
	default:
		$text .= $html->ngroup_form();
}

$text .= $html->ngroup_footer();

// output the text
$ns->tablerender(roster_LAN_ADMIN_NGROUP_TITLE, $text);

require_once(e_ADMIN."footer.php");

?>