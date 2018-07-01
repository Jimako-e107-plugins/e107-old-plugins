<?php
/**
 * $Id: recommend.php,v 1.5 2009/10/22 17:28:26 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.5 $
 * Last Modified: $Date: 2009/10/22 17:28:26 $
 *
 * Change Log:
 * $Log: recommend.php,v $
 * Revision 1.5  2009/10/22 17:28:26  michiel
 * - Implemented conditions
 * - Processing action upong changing the recommendation state
 * - Members can view the recommendations they've submitted themselves
 *
 * Revision 1.4  2009/07/14 19:29:04  michiel
 * CVS Merge
 *
 * Revision 1.3.2.1  2009/07/13 21:54:07  michiel
 * - using own css style
 * - integrated deprecated rankshow_class into template/shortcode
 *
 * Revision 1.3  2009/06/28 15:05:53  michiel
 * Merged from dev_01_03
 *
 * Revision 1.2.2.1  2009/06/28 02:33:50  michiel
 * Rank System links on rank, medal and recommendation pages
 *
 * Revision 1.2  2009/06/26 09:23:09  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.1  2009/06/19 13:47:17  michiel
 * Made XHTML compliant
 *
 * Revision 1.1  2009/03/28 13:01:39  michiel
 * Initial CVS revision
 *
 *  
 */
require_once('../../class2.php');
if (!defined('e107_INIT'))
{
    exit;
}
if (!defined("USER_WIDTH"))
{
    define(USER_WIDTH, "width:100%;");
}

include_lan(e_PLUGIN . 'rank_system/languages/' . e_LANGUAGE . '.php');
include_lan(e_PLUGIN . 'rank_system/languages/admin/' . e_LANGUAGE . '.php');
require_once(e_PLUGIN . 'rank_system/includes/rank_class.php');
require_once(e_PLUGIN . 'rank_system/includes/recomm_class.php');
require_once(e_PLUGIN.'rank_system/includes/rank_system_shortcodes.php');

$title = RANKS_RM_01;
define('e_PAGETITLE', $title);

require_once(HEADERF);
if (file_exists(THEME."ranks_template.php")) {
	require_once(THEME."ranks_template.php");
} else {
	require_once(e_PLUGIN."rank_system/templates/ranks_template.php");
}

global $rank_obj, $RANK_PREF;
if (!$rank_obj) {
	$rank_obj = new rank;
}

if (!check_class($RANK_PREF['rank_recomclass'])) {
	$rank_text = RANKS_RM_02;
	$ns->tablerender($title, $rank_text);
	require_once(FOOTERF);
	exit;
}

$recomm = new recommend();

if (isset($_POST['nextstep']) )
{
    $recomm_action = $_POST['recomm_action'];
} else {
	$recomm_action = "";
}

if (isset($_POST['showown']) || (isset($_POST['view']) && !check_class($RANK_PREF['rank_recviewclass']))) {
	$recomm_action = "showown";
}

if (isset($_POST['view']) ) {
	
	$rank_text = '
		<form method="post" action="' . e_SELF . '" id="recomm_form" >
		 	<table class="rsborder" style="' . USER_WIDTH . '">
		 		<tr>
		 			<td class="rscaption" colspan="4" style="text-align:left">' . RANKS_RM_13 . '</td>
		 		</tr>
		 		<tr>
		 			<td class="rsheader3" style="width:25%">' . RANKS_RM_13 . '</td>
		 			
		 			<td class="rsheader3" style="width:15%">
		 				<input type="radio" name="view_source" class="rsbox" value="'.RANKS_RM_14.'" /> ' .RANKS_RM_14.'<br />
		 				<input type="radio" name="view_source" class="rsbox" value="'.RANKS_RM_15.'" /> ' .RANKS_RM_15.'<br />
		 				<input type="radio" checked="checked" name="view_source" class="rsbox" value="'.RANKS_RM_21.'" /> ' .RANKS_RM_21.'
		 			</td>
		 			
		 			<td class="rsheader3" style="width:50%">' . $recomm->getMemberBox(0, true) .'</td>
		 			
		 			<td class="rsheader3" style="width:10%;text-align:center">
	 					<input type="hidden" name="recomm_action" value="show" />
		 				<input type="submit" class="rsbutton" name="nextstep" value="' . RANKS_RM_16 . '" />
		 			</td>
		 		</tr>
		 	</table>
		</form>';
}

else if ($recomm_action == 'show') {
	$target = intval($_POST['recomm_target']);
	$vsrc = $_POST['view_source'];
	
	if ($vsrc != RANKS_RM_21) {
		$subtit = RANKS_RM_13 . " " . $vsrc . " " . $recomm->getMemberName($target, true);
	} else {
		$subtit = RANKS_RM_13;
	}
	
	$rank_text .='
	 	<table class="rsborder" style="' . USER_WIDTH . '">
 		<tr>
 			<td class="rscaption" colspan="4" style="text-align:center">' . $subtit . '</td>
 		</tr>
 	';
	
	
	if ($vsrc == RANKS_RM_14) {
		$head = RANKS_RM_15;
		$stmt = "recomm_source=$target and recomm_state = 0";
		$name = 'recomm_target';
	} else if ($vsrc == RANKS_RM_15) {
		$head = RANKS_RM_14;
		$stmt = "recomm_target=$target and recomm_state = 0";
		$name = 'recomm_source';
	} else {
		$head = RANKS_RM_15;
		$stmt = "1=1";
		$name = 'recomm_target';
	}
	
	if ($sql->db_Select("rank_recommend", "*", $stmt." order by recomm_date")) {
	    $recList = $sql->db_getList();
	    
		$rank_text .='
	 		<tr>
	 			<td class="rsheader2" style="width:25%;text-align:left"><strong>' . $head . '</strong></td>
	 			<td class="rsheader2" style="width:25%;text-align:left"><strong>' . RANKS_RM_01 . '</strong></td>
	 			<td class="rsheader2" style="width:40%;text-align:left"><strong>' . RANKS_RM_09 . '</strong></td>
	 			<td class="rsheader2" style="width:10%;text-align:left"><strong>' . RANKS_RM_18 . '</strong></td>
	 		</tr>
	    ';
	    
		foreach($recList as $rec) {
			$rank_text .='
		 		<tr>
		 			<td class="rsheader3" style="text-align:left">' . $recomm->getMemberName($rec[$name],true) . '</td>
		 			<td class="rsheader3" style="text-align:left">' . $recomm->getRecommendLine($rec['recomm_type'], $rec['recomm_for']) . '</td>
		 			<td class="rsheader3" style="text-align:left">' . $tp->toHTML($rec['recomm_remarks']) . '</td>
		 			<td class="rsheader3" style="text-align:left">' . date("d-M-y H:i" ,$rec['recomm_date']) . '</td>
		 		</tr>
		    ';
		}
		
	} else {
		$rank_text .= '
			<tr>
	 			<td class="rsheader1" colspan="4" style="text-align:center">' 
					. RANKS_RM_19 . ' ' . $vsrc . ' ' .RANKS_RM_20 .'
	 			</td>
			</tr>
		';
	}
	
 	$rank_text .='</table>';
}

else if ($recomm_action == 'showown') {
	$subtit = RANKS_RM_13 . " " . RANKS_RM_14 . " " . $recomm->getMemberName(USERID, true);
	
	$rank_text .='
	 	<table class="rsborder" style="' . USER_WIDTH . '">
 		<tr>
 			<td class="rscaption" colspan="5" style="text-align:center">' . $subtit . '</td>
 		</tr>
 	';
	
	if ($sql->db_Select("rank_recommend", "*", "recomm_source=".USERID." order by recomm_date")) {
	    $recList = $sql->db_getList();
	    
		$rank_text .='
	 		<tr>
	 			<td class="rsheader2" style="width:20%;text-align:left"><strong>' . RANKS_RM_15 . '</strong></td>
	 			<td class="rsheader2" style="width:20%;text-align:left"><strong>' . RANKS_RM_01 . '</strong></td>
	 			<td class="rsheader2" style="width:40%;text-align:left"><strong>' . RANKS_RM_09 . '</strong></td>
	 			<td class="rsheader2" style="width:10%;text-align:left"><strong>' . RANKS_RM_18 . '</strong></td>
	 			<td class="rsheader2" style="width:10%;text-align:left"><strong>' . RANKS_RM_22 . '</strong></td>
	 		</tr>
	    ';
	    
		foreach($recList as $rec) {
			$rank_text .='
		 		<tr>
		 			<td class="rsheader3" style="text-align:left">' . $recomm->getMemberName($rec['recomm_target'],true) . '</td>
		 			<td class="rsheader3" style="text-align:left">' . $recomm->getRecommendLine($rec['recomm_type'], $rec['recomm_for']) . '</td>
		 			<td class="rsheader3" style="text-align:left">' . $tp->toHTML($rec['recomm_remarks']) . '</td>
		 			<td class="rsheader3" style="text-align:left">' . date("d-M-y H:i" ,$rec['recomm_date']) . '</td>
		 			<td class="rsheader3" style="text-align:center">' . $recomm->getStateName($rec['recomm_state']) . '</td>
		 		</tr>
		    ';
		}
		
	} else {
		$rank_text .= '
			<tr>
	 			<td class="rsheader1" colspan="4" style="text-align:center">' 
					. RANKS_RM_23 .'
	 			</td>
			</tr>
		';
	}
	
 	$rank_text .='</table>';
}



else if ($recomm_action == '') {
	
    $rank_text = '
<form method="post" action="' . e_SELF . '" id="recomm_form" >
 	<table class="rsborder" style="' . USER_WIDTH . '">
 		<tr>
 			<td class="rscaption" colspan="2" style="text-align:left">' . RANKS_RM_01 . '</td>
 		</tr>
 		<tr>
 			<td class="rsheader3" style="width:30%">' . RANKS_RM_07 . '</td>
 			<td class="rsheader3" style="width:70%">' . $recomm->getMemberBox() .'</td>
 		</tr>
 		<tr>
 			<td class="rsheader3" style="width:30%">' . RANKS_RM_06 . '</td>
 			<td class="rsheader3" style="width:70%">' . $recomm->getTypeBox() .'</td>
 		</tr>
 		
 		<tr>
 			<td class="rsheader3" colspan="2" >&nbsp;</td>
 		</tr>
 		
 		<tr>
 			<td class="rsheader2" colspan="2" style="text-align:center">
 				<input type="hidden" name="recomm_action" value="step2"/>
 				<input type="submit" class="rsbutton" name="nextstep" value="' . RANKS_RM_08 . '" />
 			</td>
 		</tr>
 	</table>';

    $rank_text .='<br /><input type="submit" class="rsbutton" name="showown" value="' . RANKS_RM_24 . '" />';
    if (check_class($RANK_PREF['rank_recviewclass'])) {
 		$rank_text .=' <input type="submit" class="rsbutton" name="view" value="' . RANKS_RM_13 . '" />';
    }
 	
 	$rank_text .='
</form>';
}

else if ($recomm_action == 'step2') {
	$type = intval($_POST['recomm_type']);
	$target = intval($_POST['recomm_target']);
	$t_name = $recomm->getMemberName($target, true);
	
    $rank_text .= '
	<form method="post" action="' . e_SELF . '" id="recomm_form" >
	<input type="hidden" name="recomm_target" value="'.$target.'"/>
	<input type="hidden" name="recomm_type" value="'.$type.'"/>
	<input type="hidden" name="t_name" value="'.$t_name.'"/>
 	<table class="rsborder" style="' . USER_WIDTH . '"/>
 		<tr>
 			<td class="rscaption" colspan="2" style="text-align:left">' . RANKS_RM_01 . ' [' . $t_name .']</td>
 		</tr>';
 		
 		if ($type == 1) {
 			$rank_text .= '
		 		<tr>
		 			<td class="rsheader3" style="width:30%">' . RANKS_RM_03 . '</td>
		 			<td class="rsheader3" style="width:70%">' . $recomm->getLevelBox() .'</td>
		 		</tr>
 			';
 		} else if ($type == 2) {
 			$rank_text .= '
		 		<tr>
		 			<td class="rsheader3" colspan="2" >' . RANKS_RM_04 . '</td>
		 		</tr>
 			';
 		} else if ($type == 3) {
 			$rank_text .= '
		 		<tr>
		 			<td class="rsheader3" style="width:30%">' . RANKS_RM_05 . '</td>
		 			<td class="rsheader3" style="width:70%">' . $recomm->getMedalBox() .'</td>
		 		</tr>
 			';
 		}
 		
 		$rank_text .= '
 		<tr>
 			<td class="rsheader3" style="width:30%">' . RANKS_RM_09 . '</td>
 			<td class="rsheader3" style="width:70%">
 				<textarea class="rsbox" rows="5" cols="60" style="width:80%" name="recomm_remarks" ></textarea>
 			</td>
 		</tr>
 		
 		<tr>
 			<td class="rsheader3" colspan="2" >&nbsp;</td>
 		</tr>
 		
 		<tr>
 			<td class="rsheader2" colspan="2" style="text-align:center">
 				<input type="hidden" name="recomm_action" value="submit"/>
 				<input type="submit" class="rsbutton" name="nextstep" value="' . RANKS_RM_10 . '" />
 			</td>
 		</tr>
 	</table>
</form>';
}

else if ($recomm_action == 'submit') {
	$type = intval($_POST['recomm_type']);
	$target = intval($_POST['recomm_target']);
	$t_name = $_POST['t_name'];
	$r_for = intval($_POST['recomm_for']);
	$r_remarks = $tp->toDB($_POST['recomm_remarks']);
	
	if ($recomm->submitRecomm($target, $type, $r_for, $r_remarks)) {
		$msg = RANKS_RM_11;
	} else {
		$msg = RANKS_RM_12;
	}
	
    $rank_text .= '
 	<table class="rsborder" style="' . USER_WIDTH . '">
 		<tr>
 			<td class="rscaption" style="text-align:left">' . RANKS_RM_01 . ' [' . $t_name .']</td>
 		</tr>

   		<tr>
 			<td class="rsheader1" style="text-align:center">' . $msg . '</td>
 		</tr>
    
 		<tr>
 			<td class="rsheader1" &nbsp;</td>
 		</tr>
 		
 	</table>
	</form>';
}


$menu = $tp->parsetemplate($RANK_MENU, true, $rank_shortcodes);
$ns->tablerender($menu, $rank_text);

require_once(FOOTERF);

?>