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
$pageid = 'newmember';

//admin html file
require_once("html/admin/roster_adminnmem.php");
$html = new adminnmem_html;

$text = $html->nmem_header();

switch($_GET['action']){
	case 'do_add':
		if($_POST['submit']){
			foreach($_POST as $key=>$value){
				$_POST[$key] = $tp->toDB($value);
			}
			
			$rank = explode(",", $_POST['m_rank']);

			list ($month, $day, $year) = preg_split("/[\\/-]/", $_POST['m_enlisted']);
			$enlisted = mktime(0, 0, 0, $month, $day, $year);

			list ($month2, $day2, $year2) = preg_split("/[\\/-]/", $_POST['m_rankdate']);
			$rankdate = mktime(0, 0, 0, $month2, $day2, $year2);

			$sql->db_Insert("roster_members", "'', '".$_POST['m_name']."', '".$enlisted."', '".$_POST['m_rank']."', '".$rank[3]."', '".$rankdate."', '".$_POST['m_group']."', '".$_POST['m_serial']."', '".$_POST['m_uassign']."', '".$_POST['m_ureport']."', '".$_POST['m_dassign']."', '".$_POST['m_dreport']."', '".$_POST['m_status']."', '".$_POST['m_pfile']."', '".$_POST['m_loc']."', '".$_POST['m_xfire']."', ''");
			$text .= $html->nmem_success();
		}else{
			$text .= $html->nmem_form();
		}
	break;
	default:
		$text .= $html->nmem_form();
}

$text .= $html->nmem_footer();

// output the text
$ns->tablerender(roster_LAN_ADMIN_NMEM_TITLE, $text);

require_once(e_ADMIN."footer.php");

?>