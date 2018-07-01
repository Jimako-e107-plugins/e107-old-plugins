<?php
/**
 * $Id: edit_rank.php,v 1.5 2009/10/22 16:55:50 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.5 $
 * Last Modified: $Date: 2009/10/22 16:55:50 $
 *
 * Change Log:
 * $Log: edit_rank.php,v $
 * Revision 1.5  2009/10/22 16:55:50  michiel
 * Minor layout fix
 *
 * Revision 1.4  2009/10/22 15:03:36  michiel
 * Implemented customizable conditions
 *
 * Revision 1.3  2009/07/14 19:29:02  michiel
 * CVS Merge
 *
 * Revision 1.2.6.2  2009/07/13 22:08:21  michiel
 * using own css style
 *
 * Revision 1.2.6.1  2009/07/13 18:50:57  michiel
 * - Added Sending of PM
 * - Moved save function into rank_class
 *
 * Revision 1.2  2009/06/26 09:23:00  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.1  2009/06/19 13:47:19  michiel
 * Made XHTML compliant
 *
 * Revision 1.1  2009/03/28 13:01:37  michiel
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
require_once(e_HANDLER . 'userclass_class.php');
require_once(e_PLUGIN . 'rank_system/includes/rank_class.php');

$title = RANKS_ED_01;
define('e_PAGETITLE', $title);
require_once(HEADERF);

if (file_exists(THEME."rank_style.css")) {
	echo "<link rel='stylesheet' href='".THEME_ABS."rank_style.css' type='text/css'>";
} else {
	echo "<link rel='stylesheet' href='".e_PLUGIN_ABS."rank_system/templates/rank_style.css' type='text/css'>";
}


global $rank_obj;
if (!$rank_obj) {
	$rank_obj = new rank;
}

if (isset($_POST['rank_update']) )
{
    $rank_uid = intval($_POST['rank_uid']);
    $rank_action = $_POST['rank_action'];
} else if (isset($_POST['cancel_action']) ) {
    $rank_uid = intval($_POST['rank_uid']);
    header("Location:/user.php?id.".$rank_uid);
} else {
    $rank_tmp = explode('.', e_QUERY);
    $rank_action = $rank_tmp[0];
    $rank_uid = intval($rank_tmp[1]);
}

if (USERID == $rank_uid && $RANK_PREF['rank_modown'] != "T" ) {
	$rank_text = RANKS_ED_03;
	$ns->tablerender($title, $rank_text);
	require_once(FOOTERF);
	exit;
}

if ($rank_action == 'save') {
	$rank_obj->save_POST($rank_uid, $_POST);
	header("Location:/user.php?id.".$rank_uid);
}

if ($rank_action == 'setprobation') {

	$query = "update #rank_users SET user_probation='".$_POST['user_probation'].
			"', probation_comment='".$_POST['probation_comment'].
			"' where user_userid=".$rank_uid;
	$sql->db_Select_gen($query, false);
	$rank_obj->updateRank($rank_uid);
	if ($RANK_PREF['rank_adminlog'] == "T") {
		global $admin_log;
		$msg = '<a href=/user.php?id.'.$rank_uid.'>'.$_POST['user_name'].'</a> '.($_POST['user_probation'] == "T" ? RANKS_LOG_04 : RANKS_LOG_05);
		$admin_log->log_event('Rank System',$msg,E_LOG_PLUGIN); 
	}
	
	header("Location:/user.php?id.".$rank_uid);
}

if ($rank_action == 'setprison') {

	$query = "update #rank_users SET user_prison='".$_POST['user_prison'].
			"', prison_comment='".$_POST['prison_comment'].
			"' where user_userid=".$rank_uid;
	$sql->db_Select_gen($query, false);
	$rank_obj->updateRank($rank_uid);
	if ($RANK_PREF['rank_adminlog'] == "T") {
		global $admin_log;
		$msg = '<a href=/user.php?id.'.$rank_uid.'>'.$_POST['user_name'].'</a> '.($_POST['user_prison'] == "T" ? RANKS_LOG_02 : RANKS_LOG_03);
		$admin_log->log_event('Rank System',$msg,E_LOG_PLUGIN); 
	}
	header("Location:/user.php?id.".$rank_uid);
}

if ($rank_action == 'setkick') {

	$query = "update #rank_users SET user_kicked='".$_POST['user_kicked'].
			"', kicked_comment='".$_POST['kicked_comment'].
			"' where user_userid=".$rank_uid;
	$sql->db_Select_gen($query, false);
	$rank_obj->updateRank($rank_uid);

	if ($RANK_PREF['rank_adminlog'] == "T") {
		global $admin_log;
		$msg = '<a href=/user.php?id.'.$rank_uid.'>'.$_POST['user_name'].'</a> '.($_POST['user_kick'] == "T" ? RANKS_LOG_06 : RANKS_LOG_07);
		$admin_log->log_event('Rank System',$msg,E_LOG_PLUGIN); 
	}
		
	$banVal = ($_POST['user_kicked'] == "T" ? 1 : 0);
	$sql->db_Update("user", "user_ban=".$banVal." where user_id=".$rank_uid);
	
	header("Location:/user.php?id.".$rank_uid);
}


if ($rank_action == '' || $rank_action == 'edit') {
	if (!check_class($RANK_PREF['rank_modifyclass'])) {
		$rank_text = RANKS_ED_02;
		$ns->tablerender($title, $rank_text);
		require_once(FOOTERF);
		exit;
	}
	
	$query = "select ru.*, u.user_name from #rank_users ru, #user u where ru.user_userid=$rank_uid and u.user_id=ru.user_userid";
    $sql->db_Select_gen($query, false);
    extract($sql->db_Fetch());
    $user_values = unserialize($user_values);
    
    $sql->db_Select("rank_condition", "*", "condit_enabled = 'T' order by condit_order");
    $condList = $sql->db_getList();
	
    $rank_text = '
<form method="post" action="' . e_SELF . '" id="rank_form" >
	<div>
		<input type="hidden" name="rank_uid" value="' . $rank_uid . '" />
		<input type="hidden" name="rank_action" value="save" />
	</div>
 	<table class="rsborder" style="' . ADMIN_WIDTH . '">
 		<tr>
 			<td class="rscaption" colspan="3">' . ADLAN_RS_M001 . ' ['.$user_name.']</td>
 		</tr>
 		<tr>
 			<td class="rsheader3" style="width:30%">' . ADLAN_RS_M004 . '</td>
 			<td class="rsheader3" colspan="2" style="width:70%">';
	    if (check_class($RANK_PREF['rank_freezerankcls'])) {
	    	if (check_class($RANK_PREF['rank_reservedclass'])) {
	    		$where = "1=1 order by rank_order";
	    	} else {
	    		$where = "rank_reserved='F' order by rank_order";
	    	}
	    	
	    	if (!$sql->db_Select("rank_ranks", "*", $where))	{
				$rank_text .= ADLAN_RS_DEF24;
			}
			else {
				$rank_text .= "\t<select name='user_rankid' class='rsbox'>\n";
	
				while ($row = $sql->db_Fetch())	{
					extract($row);
					$sel = ($user_rankid == $rank_id) ? "selected='selected'" : "";
					$rank_text .= "<option value='$rank_id' {$sel}>$rank_name</option>\n";
				}
				$rank_text .= "</select>";
			}
			
	    	$rank_text .= ' <i>'. ADLAN_RS_M013 . '</i></td></tr>';
	    	if (check_class($RANK_PREF['rank_skipagecls'])) {
		    	$rank_text .= '
		    	<tr><td class="rsheader3" style="width:30%">' . ADLAN_RS_M009. '</td>
	 		<td class="rsheader3" style="width:15%">
		 		<input class="rsbox" type="checkbox" name="freeze_rank" '.($freeze_rank == "T" ? 'checked="checked"' : '""').' />
		 	</td><td class="rsheader3" style="width:55%">'. RANKS_ED_12 . '
		 		<input class="rsbox" type="checkbox" name="exclude_agelimit" '.($exclude_agelimit == "T" ? 'checked="checked"' : '""').' />';
	 	} else {
		    	$rank_text .= '
		    	<input type=hidden name="exclude_agelimit" value="'.$exclude_agelimit.'">
		    	<tr><td class="rsheader3" style="width:30%">' . ADLAN_RS_M009. '</td>
	 		<td class="rsheader3" colspan="2" style="width:70%">
	 		<input class="rsbox" type="checkbox" name="freeze_rank" '.($freeze_rank == "T" ? 'checked="checked"' : '""').' />';
	 	}
	    } else {
	    	$rank_text .= $rank_name . '
	    		<input type=hidden name="user_rankid" value='.$user_rankid. '/>
	    		<input type=hidden name="freeze_rank" value='.($freeze_rank == "T" ? 'on' : '""'). '/>
	    	';

	    	if (check_class($RANK_PREF['rank_skipagecls'])) {
		    	$rank_text .= '
		    	<tr><td class="rsheader3" style="width:30%">' . RANKS_ED_12. '</td>
		 	<td class="rsheader3" colspan="2" style="width:70%">
		 		<input class="rsbox" type="checkbox" name="exclude_agelimit" '.($exclude_agelimit == "T" ? 'checked="checked"' : '""').' />';
	 	} else {
		    	$rank_text .= '
		    	<input type=hidden name="exclude_agelimit" value="'.$exclude_agelimit.'"/>';
	 	}
	}
	$rank_text .='</td></tr>';
	

	if (check_class($RANK_PREF['rank_freezesitecls'])) {
    	$rank_text .= '
 		<tr>
 			<td class="rsheader3" style="width:30%">' . ADLAN_RS_M010. '</td>
 			<td class="rsheader3" style="width:15%">
 				<input class="rsbox" type="checkbox" name="freeze_penalty" '.($freeze_penalty == "T" ? 'checked="checked"' : '""').' />
 			</td>
 			<td class="rsheader3" style="width:55%">' . ADLAN_RS_M012. '
 				<input class="rsbox" type="checkbox" name="reset_penalty" />
 			</td>
 		</tr>
 		';
    } else {
    	$rank_text .= '
    	<input type=hidden name="freeze_penalty" value='.($freeze_penalty == "T" ? 'on' : '""'). '> 
    	<input type=hidden name="reset_penalty" value=""/>
    	';
    }
	
    foreach ($condList as $cond) {
    	extract($cond);
    	$rank_text .= '
	 		<tr>
	 			<td class="rsheader3" style="width:30%">' . $tp->toHTML($condit_name) . '</td>
    	';
    	
    	//textbox?
    	$rank_text .= ($condit_hastext == "T" 
    		? '<td class="rsheader3" style="width:5%">'
    		: '<td class="rsheader3" colspan="2" style="width:70%">'); 
    	
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
	 			<td class="rsheader3" style="width:65%">' . RANKS_08 . '<br />
	 				<textarea class="rsbox" rows="4" cols="60" style="width:80%" name="'.$condit_id.'_text" >' . $tp->toForm($user_values[$condit_id.'_text']). '</textarea>
	 			</td>
    		';
    	}
    	
    	$rank_text .= "</tr>";
    }
    
	
 		if ( ($user_prison == "T" && check_class($RANK_PREF['rank_outprisoncls'])) || ($user_prison == "F" && check_class($RANK_PREF['rank_inprisoncls']))  ) {
 			$rank_text .='
	 		<tr>
	 			<td class="rsheader3" style="width:30%">' . RANKS_09 . '</td>
	 			<td class="rsheader3" style="width:15%">
	 				<input class="rsbox" type="checkbox" name="user_prison" '.($user_prison == "T" ? 'checked="checked"' : '""').' />
	 			</td>
	 			<td class="rsheader3" style="width:55%">' . RANKS_08 . '<br />
	 				<textarea class="rsbox" rows="4" cols="60" style="width:80%" name="prison_comment" >' . $prison_comment . '</textarea>
	 			</td>
	 		</tr>';
	 	} else {
	 		$rank_text .='
	 		<input type=hidden name="user_prison" value="'.$user_prison.'">
	 		<input type=hidden name="prison_comment" value="'.$prison_comment.'">';
	 	}
 		if ( ($user_probation == "T" && check_class($RANK_PREF['rank_outprobationcls'])) || ($user_probation == "F" && check_class($RANK_PREF['rank_inprobationcls']))  ) {
 			$rank_text .='
	 		<tr>
 			<td class="rsheader3" style="width:30%">' . RANKS_10 . '</td>
 			<td class="rsheader3" style="width:15%">
 				<input type="checkbox" name="user_probation" '.($user_probation == "T" ? 'checked="checked"' : '""').' />
 			</td>
 			<td class="rsheader3" style="width:55%">' . RANKS_08 . '<br />
 				<textarea class="rsbox" rows="4" cols="60" style="width:80%" name="probation_comment" >' . $probation_comment . '</textarea>
 			</td>
	 		</tr>';
	 	} else {
	 		$rank_text .='
	 		<input type=hidden name="user_probation" value="'.$user_probation.'"/>
	 		<input type=hidden name="probation_comment" value="'.$probation_comment.'"/>';
	 	}
 		if (check_class($RANK_PREF['rank_outprobationcls'])) {
 			$rank_text .='
	 		<tr>
 			<td class="rsheader3" style="width:30%">' . RANKS_11 . '</td>
 			<td class="rsheader3" style="width:15%">
 				<input class="rsbox" type="checkbox" name="user_kicked" '.($user_kicked == "T" ? 'checked="checked"' : '""').' />
 			</td>
 			<td class="rsheader3" style="width:55%">' . RANKS_08 . '<br />
 				<textarea class="rsbox" rows="4" cols="60" style="width:80%" name="kicked_comment" >' . $kicked_comment . '</textarea>
 			</td>
	 		</tr>';
	 	} else {
	 		$rank_text .='
	 		<input type=hidden name="user_kicked" value="'.$user_kicked.'"/>
	 		<input type=hidden name="kicked_comment" value="'.$kicked_comment.'"/>';
	 	}
 		
 		$rank_text .='
 		<tr>
 			<td class="rsheader2" colspan="3" style="text-align:center">
 				<input type="submit" class="rsbutton" name="rank_update" value="' . ADLAN_RS_UPD . '" />
 			</td>
 		</tr>
 	</table>
</form>';
}


if ($rank_action == 'probation') {
	$query = "select ru.*, u.user_name, r.rank_name from #rank_users ru, #user u, #rank_ranks r where ru.user_userid=$rank_uid and u.user_id=ru.user_userid and r.rank_id=ru.user_rankid";
    $sql->db_Select_gen($query, false);
    extract($sql->db_Fetch());
    
    if ($user_probation == "F") {
    	$settings['formvalue']="T";
    	$settings['buttonlabel']=RANKS_ED_08;
		if (!check_class($RANK_PREF['rank_outprobationcls'])) {
			$rank_text = RANKS_ED_10;
			$ns->tablerender($title, $rank_text);
			require_once(FOOTERF);
			exit;
		}
    } else {
		if (!check_class($RANK_PREF['rank_inprobationcls'])) {
			$rank_text = RANKS_ED_10;
			$ns->tablerender($title, $rank_text);
			require_once(FOOTERF);
			exit;
		}
    	$settings['formvalue']="F";
    	$settings['buttonlabel']=RANKS_ED_09;
    }
    
    $rank_text = '
<form method="post" action="' . e_SELF . '" id="rank_form" >
	<div>
		<input type="hidden" name="rank_uid" value="' . $rank_uid . '" />
		<input type="hidden" name="rank_action" value="setprobation" />
		<input type="hidden" name="user_probation" value="'.$settings['formvalue'].'"/>
		<input type="hidden" name="user_name" value="'.$user_name.'" />
	</div>
 	<table class="rsborder" style="' . ADMIN_WIDTH . '">
 		<tr>
 			<td class="rscaption" colspan="2">' . $settings['buttonlabel'] . ' ['.$user_name.']</td>
 		</tr>
 		<tr>
 			<td class="rsheader3" style="width:30%">' . RANKS_08 . '</td>
 			<td class="rsheader3" style="width:60%">
 				<textarea class="rsbox" rows="4" cols="60" style="width:80%" name="probation_comment" >' . $probation_comment . '</textarea>
 			</td>
 		</tr>
 		
 		<tr>
 			<td class="rsheader2" colspan="2" style="text-align:center">
 				<input type="submit" class="rsbutton" name="rank_update" value="' . $settings['buttonlabel'] . '" />
 				<input type="submit" class="rsbutton" name="cancel_action" value="' . RANKS_ED_11 . '" />
 			</td>
 		</tr>
 	</table>
</form>';
}

if ($rank_action == 'prison') {
	$query = "select ru.*, u.user_name, r.rank_name from #rank_users ru, #user u, #rank_ranks r where ru.user_userid=$rank_uid and u.user_id=ru.user_userid and r.rank_id=ru.user_rankid";
    $sql->db_Select_gen($query, false);
    extract($sql->db_Fetch());
    
    if ($user_prison == "F") {
    	$settings['formvalue']="T";
    	$settings['buttonlabel']=RANKS_ED_06;
		if (!check_class($RANK_PREF['rank_outprisoncls'])) {
			$rank_text = RANKS_ED_10;
			$ns->tablerender($title, $rank_text);
			require_once(FOOTERF);
			exit;
		}
    } else {
		if (!check_class($RANK_PREF['rank_inprisoncls'])) {
			$rank_text = RANKS_ED_10;
			$ns->tablerender($title, $rank_text);
			require_once(FOOTERF);
			exit;
		}
    	$settings['formvalue']="F";
    	$settings['buttonlabel']=RANKS_ED_07;
    }
    
    $rank_text = '
<form method="post" action="' . e_SELF . '" id="rank_form" >
	<div>
		<input type="hidden" name="rank_uid" value="' . $rank_uid . '" />
		<input type="hidden" name="rank_action" value="setprison" />
		<input type="hidden" name="user_prison" value="'.$settings['formvalue'].'"/>
		<input type="hidden" name="user_name" value="'.$user_name.'" />
	</div>
 	<table class="rsborder" style="' . ADMIN_WIDTH . '">
 		<tr>
 			<td class="rscaption" colspan="2">' . $settings['buttonlabel'] . ' ['.$user_name.']</td>
 		</tr>
 		<tr>
 			<td class="rsheader3" style="width:30%">' . RANKS_08 . '</td>
 			<td class="rsheader3" style="width:60%">
 				<textarea class="rsbox" rows="4" cols="60" style="width:80%" name="prison_comment" >' . $prison_comment . '</textarea>
 			</td>
 		</tr>
 		
 		<tr>
 			<td class="rsheader2" colspan="2" style="text-align:center">
 				<input type="submit" class="rsbutton" name="rank_update" value="' . $settings['buttonlabel'] . '" />
 				<input type="submit" class="rsbutton" name="cancel_action" value="' . RANKS_ED_11 . '" />
 			</td>
 		</tr>
 	</table>
</form>';
}

if ($rank_action == 'kick') {
	$query = "select ru.*, u.user_name, r.rank_name from #rank_users ru, #user u, #rank_ranks r where ru.user_userid=$rank_uid and u.user_id=ru.user_userid and r.rank_id=ru.user_rankid";
    $sql->db_Select_gen($query, false);
    extract($sql->db_Fetch());
    
    if ($user_kicked == "F") {
    	$settings['formvalue']="T";
    	$settings['buttonlabel']=RANKS_ED_04;
		if (!check_class($RANK_PREF['rank_kickcls'])) {
			$rank_text = RANKS_ED_10;
			$ns->tablerender($title, $rank_text);
			require_once(FOOTERF);
			exit;
		}
    } else {
		if (!check_class($RANK_PREF['rank_kickcls'])) {
			$rank_text = RANKS_ED_10;
			$ns->tablerender($title, $rank_text);
			require_once(FOOTERF);
			exit;
		}
    	$settings['formvalue']="F";
    	$settings['buttonlabel']=RANKS_ED_05;
    }
    
    $rank_text = '
<form method="post" action="' . e_SELF . '" id="rank_form" >
	<div>
		<input type="hidden" name="rank_uid" value="' . $rank_uid . '" />
		<input type="hidden" name="rank_action" value="setkick" />
		<input type="hidden" name="user_kicked" value="'.$settings['formvalue'].'"/>
		<input type="hidden" name="user_name" value="'.$user_name.'" />
	</div>
 	<table class="rsborder" style="' . ADMIN_WIDTH . '">
 		<tr>
 			<td class="rscaption" colspan="2">' . $settings['buttonlabel'] . ' ['.$user_name.']</td>
 		</tr>
 		<tr>
 			<td class="rsheader3" style="width:30%">' . RANKS_08 . '</td>
 			<td class="rsheader3" style="width:60%">
 				<textarea class="rsbox" rows="4" cols="60" style="width:80%" name="kicked_comment" >' . $kicked_comment . '</textarea>
 			</td>
 		</tr>
 		
 		<tr>
 			<td class="rsheader2" colspan="2" style="text-align:center">
 				<input type="submit" class="rsbutton" name="rank_update" value="' . $settings['buttonlabel'] . '" />
 				<input type="submit" class="rsbutton" name="cancel_action" value="' . RANKS_ED_11 . '" />
 			</td>
 		</tr>
 	</table>
</form>';
}

$ns->tablerender($title, $rank_text);
require_once(FOOTERF);

function getValueBox($name, $maxval, $curval) {
	$box = "\t<select name='$name' class='rsbox'>\n";

	for ($loop = 0; $loop <= $maxval; $loop++) {
		$sel = ($curval == $loop) ? "selected='selected'" : "";
		$box .= "<option value='$loop' $sel>$loop</option>\n";
	}
	$box .= "</select>";
	
	return $box;
}



?>