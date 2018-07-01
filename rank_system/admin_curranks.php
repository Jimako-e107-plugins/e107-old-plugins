<?php
/**
 * $Id: admin_curranks.php,v 1.5 2010/01/29 23:39:30 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.5 $
 * Last Modified: $Date: 2010/01/29 23:39:30 $
 *
 * Change Log:
 * $Log: admin_curranks.php,v $
 * Revision 1.5  2010/01/29 23:39:30  michiel
 * BugFix: current list order was ignored when going to the next page
 *
 * Revision 1.4  2009/10/22 15:03:35  michiel
 * Implemented customizable conditions
 *
 * Revision 1.3  2009/07/14 19:28:59  michiel
 * CVS Merge
 *
 * Revision 1.2.6.2  2009/07/13 18:50:24  michiel
 * - Added Sending of PM
 * - Moved save function into rank_class
 *
 * Revision 1.2.6.1  2009/07/05 20:30:22  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.2.8.1  2009/06/30 20:10:17  michiel
 * Fixed weird apache/php (?) bug: white line after ?> mark (at end of file) could lead into not parsing the code
 *
 * Revision 1.2  2009/06/26 09:22:58  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.2  2009/06/19 13:47:17  michiel
 * Made XHTML compliant
 *
 * Revision 1.1.2.1  2009/05/20 18:37:46  michiel
 * implemented Medal Bonus
 *
 * Revision 1.1  2009/03/28 13:01:36  michiel
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
global $rank_obj, $RANK_PREF;
if (!$rank_obj) {
	$rank_obj = new rank;
}

$readonly = (getperms('0') || check_class($RANK_PREF['rank_plugclass']) ? false : true);

$rank_from = 0;

if (isset($_POST['rank_filter']) || isset($_POST['rank_update']) || isset($_POST['revalidate']))
{
    $rank_from = intval($_POST['rank_from']);
    $rank_uid = intval($_POST['rank_uid']);
    $rank_action = $_POST['rank_action'];
    $rank_order = $_POST['rank_order'];
    $rank_invert = $_POST['rank_invert'];
}
else
{
    $rank_tmp = explode('.', e_QUERY);
    $rank_from = intval($rank_tmp[0]);
    $rank_action = $rank_tmp[1];
    $rank_uid = intval($rank_tmp[2]);
    $rank_order = intval($rank_tmp[2]);
    $rank_invert = intval($rank_tmp[3]);
}

if (isset($_POST['rank_user']))
{
    $rank_user = '%' . $_POST['rank_user'] . '%';
}
else
{
    $rank_user = '%';
}

if (isset($_POST['revalidate'])) {
	$rank_obj->validateAll();
	$rank_msg = ADLAN_RS_M016;
//	$rank_action = "show";
}

if (isset($_POST['details'])) {
	$rank_action = "details";
}
if (isset($_POST['show'])) {
	$rank_action = "show";
}

if ($rank_action == 'save') {
	$rank_obj->save_POST($rank_uid, $_POST);
	
	$rank_msg = ADLAN_RS_UPDOK . " [".$_POST['user_name']."]";
	$rank_action = 'show';
}


if (!$readonly && $rank_action == 'edit') {
	$query = "select ru.*, u.user_name from #rank_users ru, #user u where ru.user_userid=$rank_uid and u.user_id=ru.user_userid";
    $sql->db_Select_gen($query, false);
    extract($sql->db_Fetch());
    $user_values = unserialize($user_values);
    
    $sql->db_Select("rank_condition", "*", "condit_enabled = 'T' order by condit_order");
    $condList = $sql->db_getList();

    $rank_text = '
<form method="post" action="' . e_SELF . '" id="rank_form" >
	<div>
		<input type="hidden" name="rank_from" value="' . $rank_from . '" />
		<input type="hidden" name="rank_uid" value="' . $rank_uid . '" />
		<input type="hidden" name="user_name" value="' . $user_name . '" />
		<input type="hidden" name="rank_action" value="save" />
	</div>
 	<table class="fborder" style="' . ADMIN_WIDTH . '">
 		<tr>
 			<td class="fcaption" colspan="3" style="text-align:left">' . ADLAN_RS_M001 . ' ['.$user_name.']</td>
 		</tr>
 		<tr>
 			<td class="forumheader2" colspan="3" style="text-align:left"><b>' . $rank_msg . '</b>&nbsp;</td>
 		</tr>
 		
 		<tr>
 			<td class="forumheader2" colspan="3" style="text-align:center"><strong>' . ADLAN_RS_M024 . '</strong></td>
 		</tr>
 		<tr>
 			<td class="forumheader3" style="width:30%">' . ADLAN_RS_M004 . '</td>
 			<td class="forumheader3" colspan=2 style="width:70%">';

    	if (!$sql->db_Select("rank_ranks"))
		{
			$rank_text .= ADLAN_RS_DEF24;
		}
		else
		{
			$rank_text .= "\t<select name='user_rankid' class='tbox'>\n";

			while ($row = $sql->db_Fetch())
			{
				extract($row);
				$sel = ($user_rankid == $rank_id) ? "selected='selected'" : "";
				$rank_text .= "<option value='$rank_id' {$sel}>$rank_name</option>\n";
			}
			$rank_text .= "</select>";
		}
		
    $rank_text .= ' <i>'. ADLAN_RS_M013 . '</i></td>
 		</tr>
 		<tr>
 			<td class="forumheader3" style="width:30%">' . ADLAN_RS_M009. '</td>
 			<td class="forumheader3" style="width:10%">
 				<input type="checkbox" name="freeze_rank" '.($freeze_rank == "T" ? 'checked="checked"' : '""').' />
 			</td>
 			<td class="forumheader3" style="width:70%">' . RANKS_ED_12 . '
 				<input type="checkbox" name="exclude_agelimit" '.($exclude_agelimit == "T" ? 'checked="checked"' : '""').' />
 			</td>
 		</tr>
 		<tr>
 			<td class="forumheader3" style="width:30%">' . ADLAN_RS_M010. '</td>
 			<td class="forumheader3" style="width:10%">
 				<input type="checkbox" name="freeze_penalty" '.($freeze_penalty == "T" ? 'checked="checked"' : '""').' />
 			</td>
 			<td class="forumheader3" style="width:60%">' . ADLAN_RS_M012. '
 				<input type="checkbox" name="reset_penalty" />
 			</td>
 		</tr>
 		
 		<tr>
 			<td class="forumheader2" colspan="3" style="text-align:center"><strong>' . ADLAN_RS_M025 . '</strong></td>
 		</tr>
 	';
 	
    
    foreach ($condList as $cond) {
    	extract($cond);
    	$rank_text .= '
	 		<tr>
	 			<td class="forumheader3" style="width:30%">' . $tp->toHTML($condit_name) . '</td>
    	';
    	
    	//textbox?
    	$rank_text .= ($condit_hastext == "T" 
    		? '<td class="forumheader3" style="width:5%">'
    		: '<td class="forumheader3" colspan="2" style="width:70%">'); 
    	
    	//Positive or negative
    	$rank_text .= ($condit_negative == "T" ? '-' : '+');
    	
    	//Automatic?
    	if ($condit_trigger != "trigger_manual") {
    		$rank_text .= $user_values[$condit_id.'_value'] . ' <i>'.ADLAN_RS_M011."</i>";
    	} else {
    		$rank_text .= getValueBox($condit_id."_value", $condit_maxval, $user_values[$condit_id.'_value']); 
    	}
    	
    	$rank_text .= '</td>';
    	
    	//textbox?
    	if ($condit_hastext == "T") {
    		$rank_text .= '
	 			<td class="forumheader3" style="width:65%">' . RANKS_08 . '<br />
	 				<textarea class="tbox" rows="4" cols="60" style="width:80%" name="'.$condit_id.'_text" >' . $tp->toForm($user_values[$condit_id.'_text']). '</textarea>
	 			</td>
    		';
    	}
    	
    	$rank_text .= "</tr>";
    }
 		
    $rank_text .= '
 		<tr>
 			<td class="forumheader2" colspan="3" style="text-align:center"><strong>' . ADLAN_RS_M026 . '</strong></td>
 		</tr>
    	<tr>
 			<td class="forumheader3" style="width:30%">' . RANKS_09 . '</td>
 			<td class="forumheader3" style="width:5%">
 				<input type="checkbox" name="user_prison" '.($user_prison == "T" ? 'checked="checked"' : '""').' />
 			</td>
 			<td class="forumheader3" style="width:65%">' . RANKS_08 . '<br />
 				<textarea class="tbox" rows="4" cols="60" style="width:80%" name="prison_comment" >' . $prison_comment . '</textarea>
 			</td>
 		</tr>
 		<tr>
 			<td class="forumheader3" style="width:30%">' . RANKS_10 . '</td>
 			<td class="forumheader3" style="width:5%">
 				<input type="checkbox" name="user_probation" '.($user_probation == "T" ? 'checked="checked"' : '""').' />
 			</td>
 			<td class="forumheader3" style="width:65%">' . RANKS_08 . '<br />
 				<textarea class="tbox" rows="4" cols="60" style="width:80%" name="probation_comment" >' . $probation_comment . '</textarea>
 			</td>
 		</tr>
 		<tr>
 			<td class="forumheader3" style="width:30%">' . RANKS_11 . '</td>
 			<td class="forumheader3" style="width:5%">
 				<input type="checkbox" name="user_kicked" '.($user_kicked == "T" ? 'checked="checked"' : '""').' />
 			</td>
 			<td class="forumheader3" style="width:65%">' . RANKS_08 . '<br />
 				<textarea class="tbox" rows="4" cols="60" style="width:80%" name="kicked_comment" >' . $kicked_comment . '</textarea>
 			</td>
 		</tr>
 		
 		<tr>
 			<td class="forumheader2" colspan="3" style="text-align:center">
 				<input type="submit" class="button" name="rank_update" value="' . ADLAN_RS_UPD . '" />
 			</td>
 		</tr>
 	</table>
</form>';
}

if ($rank_action == 'details') {
	
	$rank_arg = "select count(user_userid) as rank_count from #rank_users r, #user u where u.user_id = r.user_userid and user_name like '{$rank_user}'";
    $sql->db_Select_gen($rank_arg, false);
    extract($sql->db_Fetch());
    
    $cond_count = $sql->db_Count("rank_condition", "(*)", " WHERE condit_enabled = 'T'");
    $sql->db_Select("rank_condition", "condit_id, condit_name, condit_negative", "condit_enabled = 'T' order by condit_order");
    $condList = $sql->db_getList();

    $rank_arg = "select ru.*,u.user_name, r.rank_name from #rank_users ru, #user u, #rank_ranks r where u.user_id=ru.user_userid and r.rank_id = ru.user_rankid and user_name like '{$rank_user}' order by ".getOrder($rank_order, $rank_invert)." limit $rank_from,25";
    $sql->db_Select_gen($rank_arg, false);
    
    $colspan = $cond_count + 2;
    $rank_text = '
<form method="post" action="' . e_SELF . '" id="rank_form" >
	<div>
		<input type="hidden" name="rank_from" value="' . $rank_from . '" />
		<input type="hidden" name="rank_action" value="details" />
	</div>
	<table class="fborder" style="' . ADMIN_WIDTH . '">
		<tr>
			<td class="fcaption" colspan="'.$colspan.'" style="text-align:left">' . ADLAN_RS_M020 . '</td>
		</tr>
		<tr>
			<td class="forumheader2" colspan="'.$colspan.'" style="text-align:center"><b>' . $rank_msg . '</b>&nbsp;</td>
		</tr>
		<tr>
			<td class="forumheader2" style="width:20%;text-align:center;">'.
				getOrderLink(ADLAN_RS_M003, 1, "details")
			.'</td>';
			
	$counter = 0;
	foreach ($condList as $cond) {
		$rank_text .= '
				<td class="forumheader2" style="text-align:center;">
					<strong>'.$tp->toHTML($cond['condit_name']).'</strong>
				</td>
		';
		$inxs[++$counter] = $cond['condit_id'];
		$pre[$counter] = ($cond['condit_negative'] == "T" ? "-" : "");
	}
			
	$rank_text .= '
			<td class="forumheader2" style="width:5%;text-align:center;"><strong>&nbsp;</strong></td>
		</tr>	';
    while ($rank_row = $sql->db_Fetch()) {
    	$values = unserialize($rank_row['user_values']);
    	
        $rank_text .= '
		<tr>
			<td class="forumheader3" style="text-align:left;" >
				<a href="/user.php?id.'. $rank_row['user_userid'] . '">' . $rank_row['user_name'] . '</a>
			</td>
		';
        
        for ($lus = 1; $lus <= $cond_count; $lus++) {
        	$key = $inxs[$lus]."_value";
        	$rank_text .= '
        		<td class="forumheader3" style="text-align:right;">
        			'.$pre[$lus].$values[$key] .'
        		</td>
        	';
        }
			
		$rank_text .= '
			<td class="forumheader3" style="text-align:center;" >
			';
			
        	if (!$readonly) {
        		$rank_text .= '<a href="' . e_SELF . '?' . $rank_from . '.edit.' . $rank_row['user_userid'] . '" ><img src="' . e_IMAGE . 'admin_images/edit_16.png" alt="' . ADLAN_RS_M006 . '" title="' . ADLAN_RS_M006 . '" /></a>';
        	}
        	$rank_text .= '</td></tr>';
    }
    $action = 'details';
    $parms = $rank_count . ',25,' . $rank_from . ',' . e_SELF . '?' . '[FROM].' . $action;
    $rank_nextprev = $tp->parseTemplate("{NEXTPREV={$parms}}") . '';

    $rank_text .= '
		<tr>
			<td class="forumheader2" colspan="'.$colspan.'" style="text-align:center">' . ADLAN_RS_M007 . '&nbsp;
				<input type="text" class="tbox" style="width:140px;" name="rank_user" value="' . $_POST['rank_user'] . '" /> &nbsp;&nbsp;
				<input type="submit" class="button" name="rank_update" value="' . ADLAN_RS_M008 . '" /></td>
		</tr>
	<tr>
		<td class="forumheader2" colspan="'.$colspan.'" style="text-align:left">' . $rank_nextprev . '&nbsp;</td>
	</tr>
 	<tr>
		<td class="forumheader2" colspan="'.$colspan.'" style="text-align:left">
			<input type="submit" class="button" name="show" value="' . ADLAN_RS_M023 . '" />
			<input type="submit" class="button" name="revalidate" value="' . ADLAN_RS_M015 . '" />
		</td>
	</tr>
	
	<tr>
		<td class="fcaption" colspan="'.$colspan.'" style="text-align:left">&nbsp;</td>
	</tr>
	</table>
</form>';
    
}


if ($rank_action == '' || $rank_action == 'show') {
	
	$rank_arg = "select count(user_userid) as rank_count from #rank_users r, #user u where u.user_id = r.user_userid and user_name like '{$rank_user}'";
    $sql->db_Select_gen($rank_arg, false);
    extract($sql->db_Fetch());

    $rank_arg = "select ru.*,u.user_name, r.rank_name from #rank_users ru, #user u, #rank_ranks r where u.user_id=ru.user_userid and r.rank_id = ru.user_rankid and user_name like '{$rank_user}' order by ".getOrder($rank_order, $rank_invert)." limit $rank_from,25";
    $sql->db_Select_gen($rank_arg, false);
    
    $rank_text = '
<form method="post" action="' . e_SELF . '" id="rank_form" >
	<div>
		<input type="hidden" name="rank_from" value="' . $rank_from . '" />
	</div>
	<table class="fborder" style="' . ADMIN_WIDTH . '">
		<tr>
			<td class="fcaption" colspan="9" style="text-align:left">' . ADLAN_RS_M022 . '</td>
		</tr>
		<tr>
			<td class="forumheader2" colspan="9" style="text-align:center"><b>' . $rank_msg . '</b>&nbsp;</td>
		</tr>
		<tr>
			<td class="forumheader2" style="width:5%;text-align:center;" >'.
				getOrderLink(ADLAN_RS_M002, 2)
			.'</td>
			
			<td class="forumheader2" style="width:20%;text-align:center;">'.
				getOrderLink(ADLAN_RS_M003, 1)
			.'</td>
			
			<td class="forumheader2" style="width:20%;text-align:center;">'.
				getOrderLink(ADLAN_RS_M004, 0)
			.'</td>
			
			<td class="forumheader2" style="width:10%;text-align:center;">'.
				getOrderLink(ADLAN_RS_M018, 3)
			.'</td>
			
			<td class="forumheader2" style="width:10%;text-align:center;">'.
				getOrderLink(ADLAN_RS_M021, 11)
			.'</td>
			
			<td class="forumheader2" style="width:5%;text-align:center;">'.
				getOrderLink(ADLAN_RS_M009, 9)
			.'</td>
			
			<td class="forumheader2" style="width:5%;text-align:center;">'.
				getOrderLink(ADLAN_RS_M010, 10)
			.'</td>
			
			<td class="forumheader2" style="width:20%;text-align:center;"><strong>' . ADLAN_RS_M014 . '</strong></td>
			<td class="forumheader2" style="width:5%;text-align:center;"><strong>&nbsp;</strong></td>
		</tr>	';
    while ($rank_row = $sql->db_Fetch())
    {
        $rank_text .= '
		<tr>
			<td class="forumheader3" style="text-align:right;" >' . $rank_row['user_userid'] . '</td>
			<td class="forumheader3" style="text-align:left;" >
				<a href="/user.php?id.'. $rank_row['user_userid'] . '">' . $rank_row['user_name'] . '</a></td>
			<td class="forumheader3" style="text-align:left;" >' . $rank_row['rank_name'] . '</td>
			<td class="forumheader3" style="text-align:right;" >' . $rank_row['rank_points'] . '</td>
			<td class="forumheader3" style="text-align:right;" >' . $rank_row['rank_medal'] . '</td>
			<td class="forumheader3" style="text-align:center;" >' . ($rank_row['freeze_rank'] == "T" ? ADLAN_RS_DEF26 : ADLAN_RS_DEF27) . '</td>
			<td class="forumheader3" style="text-align:center;" >' . ($rank_row['freeze_penalty'] == "T" ? ADLAN_RS_DEF26 : ADLAN_RS_DEF27) . '</td>';

        	$spec = "";
        	if ($rank_row['exclude_agelimit'] == "T") {
        		$spec .= ADLAN_RS_M017; 
        	}

        	if ($rank_row['user_prison'] == "T") {
	       		if ($spec != "") {
        			$spec .= "<br />";
        		}
        		$spec .= RANKS_09; 
        	}
        	if ($rank_row['user_probation'] == "T") {
        		if ($spec != "") {
        			$spec .= "<br />";
        		}
        		$spec .= RANKS_10; 
        	}
        	if ($rank_row['user_kicked'] == "T") {
        		if ($spec != "") {
        			$spec .= "<br />";
        		}
        		$spec .= RANKS_11; 
        	}
        
        	$rank_text .= '
			<td class="forumheader3" style="text-align:center;" >' . $spec . '</td>
			<td class="forumheader3" style="text-align:center;" >
			';
			
        	if (!$readonly) {
        		$rank_text .= '<a href="' . e_SELF . '?' . $rank_from . '.edit.' . $rank_row['user_userid'] . '" ><img src="' . e_IMAGE . 'admin_images/edit_16.png" alt="' . ADLAN_RS_M006 . '" title="' . ADLAN_RS_M006 . '" /></a>';
        	}
        	$rank_text .= '</td></tr>';
    }
    $action = 'show';
    $parms = $rank_count . ',25,' . $rank_from . ',' . e_SELF . '?' . '[FROM].' . $action . "." . $rank_order . "." . $rank_invert;
    $rank_nextprev = $tp->parseTemplate("{NEXTPREV={$parms}}") . '';

    $rank_text .= '
		<tr>
			<td class="forumheader2" colspan="9" style="text-align:center">' . ADLAN_RS_M007 . '&nbsp;
				<input type="text" class="tbox" style="width:140px;" name="rank_user" value="' . $_POST['rank_user'] . '" /> &nbsp;&nbsp;
				<input type="submit" class="button" name="rank_update" value="' . ADLAN_RS_M008 . '" /></td>
		</tr>
	<tr>
		<td class="forumheader2" colspan="9" style="text-align:left">' . $rank_nextprev . '&nbsp;</td>
	</tr>
 	<tr>
		<td class="forumheader2" colspan="9" style="text-align:left">
			<input type="submit" class="button" name="details" value="' . ADLAN_RS_M019 . '" />
			<input type="submit" class="button" name="revalidate" value="' . ADLAN_RS_M015 . '" />
		</td>
	</tr>
	
	<tr>
		<td class="fcaption" colspan="9" style="text-align:left">&nbsp;</td>
	</tr>
	</table>
</form>';
    
}
$ns->tablerender(ADLAN_RS, $rank_text);
require_once(e_ADMIN . 'footer.php');

function getValueBox($name, $maxval, $curval) {
	$box = "\t<select name='$name' class='tbox'>\n";

	for ($loop = 0; $loop <= $maxval; $loop++) {
		$sel = ($curval == $loop) ? "selected='selected'" : "";
		$box .= "<option value='$loop' {$sel}>$loop</option>\n";
	}
	$box .= "</select>";
	
	return $box;
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
		 * 0	rank
		 * 1	name
		 * 2	user id
		 * 3	points
		 * 9	freeze rank
		 * 10	freeze penalty
		 * 11	Medal Bonus
		 */
		case 2: return "user_userid ".($invert ? "desc" : "asc");
		case 1:	return "user_name ".($invert ? "desc" : "asc");
		case 0:	return "user_rankid ".($invert ? "desc" : "asc").", user_name asc ";
		case 3:	return "rank_points ".($invert ? "asc" : "desc");
		case 9:	return "freeze_rank ".($invert ? "desc" : "asc");
		case 10:	return "freeze_penalty ".($invert ? "desc" : "asc");
		case 11:	return "rank_medal ".($invert ? "asc" : "desc");
		default:
			return "user_rankid asc, user_name asc ";
	}
}

?>