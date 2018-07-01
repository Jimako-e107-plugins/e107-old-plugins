<?php
/**
 * $Id: admin_currecomm.php,v 1.3 2009/10/24 20:15:34 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.3 $
 * Last Modified: $Date: 2009/10/24 20:15:34 $
 *
 * Change Log:
 * $Log: admin_currecomm.php,v $
 * Revision 1.3  2009/10/24 20:15:34  michiel
 * Grouped recommendation for same user and type
 *
 * Revision 1.2  2009/10/22 17:28:26  michiel
 * - Implemented conditions
 * - Processing action upong changing the recommendation state
 * - Members can view the recommendations they've submitted themselves
 *
 * Revision 1.1  2009/03/28 13:01:42  michiel
 * Initial CVS revision
 *
 *  
 */
require_once('../../class2.php');
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms('P'))
{
    header('location:' . e_HTTP . 'index.php');
    exit;
}
require_once(e_ADMIN . 'auth.php');
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, 'width:100%;');
}
include_lan(e_PLUGIN . 'rank_system/languages/admin/' . e_LANGUAGE . '.php');
include_lan(e_PLUGIN . 'rank_system/languages/' . e_LANGUAGE . '.php');

require_once(e_PLUGIN . 'rank_system/includes/rank_class.php');
require_once(e_PLUGIN . 'rank_system/includes/recomm_class.php');
global $rank_obj, $recomm;
if (!$rank_obj) {
	$rank_obj = new rank;
}
if (!$recomm) {
	$recomm = new recommend();
}

$rank_from = 0;

if (isset($_POST['update'])) {
    $rank_from = intval($_POST['rank_from']);
    $rank_uid = intval($_POST['rank_uid']);
    $rank_action = $_POST['rank_action'];
    $rank_order = $_POST['rank_order'];
    $rank_invert = $_POST['rank_invert'];
} else {
    $rank_tmp = explode('.', e_QUERY);
    $rank_from = intval($rank_tmp[0]);
    $rank_action = $rank_tmp[1];
    $rank_id = intval($rank_tmp[2]);
    $rank_order = intval($rank_tmp[2]);
    $rank_invert = intval($rank_tmp[3]);
}

if (isset($_POST['update'])) {
	
	while (list($recomm_id, $recomm_state) = each($_POST['recomm_state'])) {
		$recomm->processState($recomm_id, $recomm_state);
		
		//update all other records belonging to the same group
		if ($sql->db_Select("rank_recommend", "recomm_target, recomm_type, recomm_for", "recomm_id = $recomm_id")) {
			extract($sql->db_Fetch());
			$sql->db_Update("rank_recommend", "recomm_state=$recomm_state where recomm_state = 0 and recomm_target = $recomm_target and recomm_type = $recomm_type and recomm_for = $recomm_for");
		}
	}
	
	$rank_msg = ADLAN_RS_UPDOK;
	$rank_action = "show";
	
}


if ($rank_action == 'delete') {
	if ($sql->db_Delete("rank_recommend", "recomm_id=$rank_id")) {
		$rank_msg = ADLAN_RS_RM15;
	} else {
		$rank_msg = ADLAN_RS_RM16;
	}
	
	$rank_action = "show";
}

if ($rank_action == '' || $rank_action == 'show') {

    
    $rank_text = '
<form method="post" action="' . e_SELF . '" id="rank_form" >
	<div>
		<input type="hidden" name="rank_from" value="' . $rank_from . '" />
		<input type="hidden" name="rank_order" value="' . $rank_order . '" />
		<input type="hidden" name="rank_invert" value="' . $rank_invert . '" />
	</div>
	<table class="fborder" style="' . ADMIN_WIDTH . '">
	';
    
    $rank_text .= tableHeader(true);
    
    //First all open recommendations.. group by same target and type
    if ($sql->db_Select("rank_recommend", "*", "recomm_state = 0 group by recomm_target, recomm_type, recomm_for order by ".getOrder($rank_order, $rank_invert))) {
	    $recList = $sql->db_getList();
	    foreach($recList as $rec) {
	    	extract($rec);
	    	//get new list, this time with all records for this recommendation
	    	$groupCount = $sql->db_Count("rank_recommend", "(*)", " where recomm_state = 0 and recomm_target = $recomm_target and recomm_type = $recomm_type and recomm_for = $recomm_for");
	    	$sql->db_Select("rank_recommend", "*", "recomm_state = 0 and recomm_target = $recomm_target and recomm_type = $recomm_type and recomm_for = $recomm_for order by ".getOrder($rank_order, $rank_invert));
	    	$groupList = $sql->db_getList();
	    	$isFirst = true;
	    	foreach ($groupList as $group) {
	        	$rank_text .= tableRow($group, ($isFirst ? $groupCount : 0));
	        	$isFirst = false;
	    	}
	    }
	    $rank_text .= '
		 	<tr>
				<td class="forumheader2" colspan="7" style="text-align:right"></td>
				<td class="forumheader2" style="text-align:center">
					<input type="submit" class="button" name="update" value="' . ADLAN_RS_RM14 . '" />
				</td>
				<td class="forumheader2" style="text-align:right">&nbsp;</td>
			</tr>
	    ';
    } else {
    	$rank_text .= '
    		<tr>
    			<td colspan="9" class="forumheader2" style="text-align:center">'.ADLAN_RS_RM21.'</td>
    		</tr>
    	';
    }
    
    $rank_text .= tableHeader(false);
    
	$rank_count = $sql->db_Count("rank_recommend", "(*)", " WHERE recomm_state > 0");
    $sql->db_Select("rank_recommend", "*", "recomm_state > 0 order by ".getOrder($rank_order, $rank_invert)." LIMIT $rank_from, 10");
    $recList = $sql->db_getList();
			
    foreach($recList as $rec) {
        $rank_text .= tableRow($rec);
    }
    $action = 'show';
    $parms = $rank_count . ',10,' . $rank_from . ',' . e_SELF . '?' . '[FROM].' . $action;
    $rank_nextprev = $tp->parseTemplate("{NEXTPREV={$parms}}") . '';

    $rank_text .= '
	<tr>
		<td class="forumheader2" colspan="9" style="text-align:left">' . $rank_nextprev . '&nbsp;</td>
	</tr>
	
	<tr>
		<td class="fcaption" colspan="13" style="text-align:left">&nbsp;</td>
	</tr>
	</table>
</form>';
    
}
$ns->tablerender(ADLAN_RS, $rank_text);
require_once(e_ADMIN . 'footer.php');

function tableHeader($isOpen) {
	global $rank_msg;
	
	if ($isOpen) {
		$subtit = ADLAN_RS_RM10;
		$msgfld = '
			<tr>
				<td class="forumheader2" colspan="9" style="text-align:center"><b>' . $rank_msg . '</b>&nbsp;</td>
			</tr>
		';
		$tableHeader = "";
	} else {
		$subtit = ADLAN_RS_RM20;
		$msgfld = "";
		$tableHeader = '
			<tr>
				<td class="forumheader2" colspan="9" style="text-align:center">&nbsp;</td>
			</tr>
		';
	}
	
	$tableHeader .= '
		<tr>
			<td class="fcaption" colspan="9" style="text-align:left">' . $subtit . ' ' . ADLAN_RS_RM01 . '</td>
		</tr>
		'.$msgfld.'
	
		<tr>
			<td class="forumheader2" style="width:5%;text-align:center;" >'.
				getOrderLink(ADLAN_RS_RM02, 6)
			.'</td> 

			<td class="forumheader2" style="width:15%;text-align:center;" >'.
				getOrderLink(ADLAN_RS_RM03, 2)
			.'</td>

    		<td class="forumheader2" style="width:15%;text-align:center;" >'.
				getOrderLink(ADLAN_RS_RM04, 1)
			.'</td>
    		
    		<td class="forumheader2" style="width:10%;text-align:center;" >'.
				getOrderLink(ADLAN_RS_RM05, 3)
			.'</td>
    		
    		<td class="forumheader2" style="width:10%;text-align:center;" >'.
				getOrderLink(ADLAN_RS_RM06, 4)
			.'</td>
    		
    		
			<td class="forumheader2" style="width:25%;text-align:center;"><Strong>' . ADLAN_RS_RM07 . '</strong></td>
			
			<td class="forumheader2" style="width:5%;text-align:center;" >'.
				getOrderLink(ADLAN_RS_RM08, 5)
			.'</td>
			
			<td class="forumheader2" style="width:10%;text-align:center;" >'.
				getOrderLink(ADLAN_RS_RM09, 0)
			.'</td>
    		
			<td class="forumheader2" style="width:5%;text-align:center;">&nbsp;</td>
		</tr>
	';

	return $tableHeader;
}

function tableRow($record, $rowSpan = 1) {
	global $recomm, $tp;
	extract($record);
	
    $tableRow = '
	<tr>
		<td class="forumheader3" style="text-align:center;" >' . $recomm_id . '</td>
	';
    
    if ($rowSpan > 0) {
    	$tableRow .= '
			<td rowspan="'.$rowSpan.'" class="forumheader3" style="text-align:left;" >
				<a href="/user.php?id.'. $recomm_target . '">' . $recomm->getMemberName($recomm_target, true) . '</a>
			</td>
		';
    }
    
    $tableRow .= '
		<td class="forumheader3" style="text-align:left;" >
			<a href="/user.php?id.'. $recomm_source . '">' . $recomm->getMemberName($recomm_source, true) . '</a>
		</td>
	';
    
    if ($rowSpan > 0) {
    	$tableRow .= '
			<td rowspan="'.$rowSpan.'" class="forumheader3" style="text-align:left;" >' . $recomm->getTypeName($recomm_type) . '</td>
			<td rowspan="'.$rowSpan.'" class="forumheader3" style="text-align:left;" >' . $recomm->getForName($recomm_type, $recomm_for) . '</td>
		';
    }
    
    $tableRow .= '
		<td class="forumheader3" style="text-align:left;" >' . $tp->toHTML($recomm_remarks) . '</td>
		<td class="forumheader3" style="text-align:center;" >' . date("d-M-y H:i", $recomm_date) . '</td>
	';
    
    if ($rowSpan > 0) {
    	$tableRow .= '
			<td rowspan="'.$rowSpan.'" class="forumheader3" style="text-align:center;" >' . $recomm->getStateBox($recomm_state, $recomm_id, $recomm_type) . '</td>
		';
    }

	$tableRow .= '
		<td class="forumheader3" style="text-align:center;" >
			<a href="' . e_SELF . '?' . $rank_from . '.delete.' . $recomm_id . '" ><img src="' . e_IMAGE . 'admin_images/delete_16.png" alt="' . ADLAN_RS_RM13 . '" title="' . ADLAN_RS_RM13 . '" /></a>
		</td>
	</tr>';
	
	return $tableRow;
}

function getOrderLink($title, $order, $action = "show") {
	global $rank_order, $rank_invert, $rank_from;
	
	if ($rank_order == $order) {
		$img = '<img src="'.e_PLUGIN.'rank_system/images/sort'.($rank_invert ? 'dn' : 'up').'.gif" border="0" />';
	} else {
		$img = '';
	}
	
	$link = '
		<a href="'.e_SELF.'?'.$rank_from.'.'.$action.'.'.$order.'.'.($rank_order == $order && !$rank_invert ? 1 : 0).'">
			<strong>' . $title . '</strong></a>
	'.$img;
	
	return $link;
}


function getOrder($order, $invert = false) {
	switch ($order) {
		/*
		 * 0	state
		 * 1	source
		 * 2	target
		 * 3	type
		 * 4	for
		 * 5	date
		 * 6	id
		 */
		case 6: return "recomm_id ".($invert ? "desc" : "asc");
		case 1:	return "recomm_source ".($invert ? "desc" : "asc");
		case 2:	return "recomm_target ".($invert ? "desc" : "asc");
		case 3:	return "recomm_type ".($invert ? "asc" : "desc");
		case 4:	return "recomm_for ".($invert ? "asc" : "desc");
		case 5:	return "recomm_date ".($invert ? "asc" : "desc");
		case 0:	return "recomm_state ".($invert ? "desc" : "asc");
		default:
			return "recomm_id desc";
	}
}

?>