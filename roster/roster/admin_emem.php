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
$pageid = 'editmember';

//admin html file
require_once("html/admin/roster_adminemem.php");
$html = new adminemem_html;

$text = $html->emem_header();

switch($_GET['action']){
	case 'edit':
		$text .= $html->emem_form($_GET['m_id']);
	break;
	case 'do_edit':
		if($_POST['submit']){
			if($_POST['delete_member']){
				$sql->db_Delete("roster_members", "roster_member_id='".$_GET['m_id']."'");
				$text .= $html->emem_deleted();
			}else{
	      			foreach($_POST as $key=>$value){
	      				$_POST[$key] = $tp->toDB($value);
	      			}
	      			
	      			$rank = explode(",", $_POST['m_rank']);
	      
	      			list ($month, $day, $year) = preg_split("/[\\/-]/", $_POST['m_enlisted']);
	      			$enlisted = mktime(0, 0, 0, $month, $day, $year);
	      
	      			list ($month2, $day2, $year2) = preg_split("/[\\/-]/", $_POST['m_rankdate']);
	      			$rankdate = mktime(0, 0, 0, $month2, $day2, $year2);
	      			
	      			$sql->db_Update("roster_members", "roster_member_name='".$_POST['m_name']."', roster_member_enlisted='".$enlisted."', roster_member_rank='".$_POST['m_rank']."', roster_member_ranknum='".$rank[3]."', roster_member_rankdate='".$rankdate."', roster_member_group='".$_POST['m_group']."', roster_member_serial='".$_POST['m_serial']."', roster_member_unit='".$_POST['m_uassign']."', roster_member_unitreport='".$_POST['m_ureport']."', roster_member_duty='".$_POST['m_dassign']."', roster_member_dutyreport='".$_POST['m_dreport']."', roster_member_status='".$_POST['m_status']."', roster_member_pfile='".$_POST['m_pfile']."', roster_member_location='".$_POST['m_loc']."', roster_member_xfire='".$_POST['m_xfire']."' WHERE roster_member_id='".$_GET['m_id']."'");
	      			$text .= $html->emem_edited();
			}
      		}else{
      			$text .= $html->emem_show();
      		}
	break;
	default:
		$text .= $html->emem_show();
}

$text .= $html->emem_footer();

// output the text
$ns->tablerender(roster_LAN_ADMIN_EMEM_TITLE, $text);

require_once(e_ADMIN."footer.php");

?>