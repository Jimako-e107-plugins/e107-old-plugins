<?php
/**
 * $Id: edit_medals.php,v 1.3 2009/07/14 19:28:59 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.3 $
 * Last Modified: $Date: 2009/07/14 19:28:59 $
 *
 * Change Log:
 * $Log: edit_medals.php,v $
 * Revision 1.3  2009/07/14 19:28:59  michiel
 * CVS Merge
 *
 * Revision 1.2.6.1  2009/07/13 22:08:22  michiel
 * using own css style
 *
 * Revision 1.2  2009/06/26 09:22:58  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.1  2009/06/19 13:47:19  michiel
 * Made XHTML compliant
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
if (!defined("USER_WIDTH"))
{
    define(USER_WIDTH, "width:100%;");
}

include_lan(e_PLUGIN . 'rank_system/languages/' . e_LANGUAGE . '.php');
include_lan(e_PLUGIN . 'rank_system/languages/admin/' . e_LANGUAGE . '.php');
require_once(e_HANDLER . 'userclass_class.php');
require_once(e_PLUGIN . 'rank_system/includes/medal_class.php');

$title = RANKS_MED_12;
define('e_PAGETITLE', $title);
require_once(HEADERF);

global $medal_obj;
if (!$medal_obj) {
	$medal_obj = new medal;
}

if (isset($_POST['revoke']) || isset($_POST['grant']) || isset($_POST['save_grant']) || isset($_POST['returnProfile']) ) {
    $medal_uid = intval($_POST['medal_uid']);
    $medal_action = $_POST['medal_action'];
} else {
    $medal_tmp = explode('.', e_QUERY);
    $medal_action = $medal_tmp[0];
    $medal_uid = intval($medal_tmp[1]);
}

if (isset($_POST['returnProfile'])) {
	header("Location:/user.php?id.".$medal_uid);
}

if (USERID == $medal_uid && $RANK_PREF['rank_modown'] != "T" ) {
	$medal_text = RANKS_MED_ED_01;
	$ns->tablerender($title, $medal_text);
	require_once(FOOTERF);
	exit;
}
if (file_exists(THEME."rank_style.css")) {
	echo "<link rel='stylesheet' href='".THEME_ABS."rank_style.css' type='text/css'>";
} else {
	echo "<link rel='stylesheet' href='".e_PLUGIN_ABS."rank_system/templates/rank_style.css' type='text/css'>";
}

if(isset($_POST['revoke']))
{
	$tmp = array_keys($_POST['revoke']);
	list($revoke, $rev_id) = explode("_", $tmp[0]);
}

if ($revoke == "medal" && $rev_id) {
	$medal_obj->revokeMedalIndex($rev_id);
	$medal_msg = ADLAN_RS_MD14;
	unset($revoke, $rev_id);
	$medal_action = 'edit';
}

if(isset($_POST['grant']))
{
	$tmp = array_keys($_POST['grant']);
	list($grant, $grant_id) = explode("_", $tmp[0]);
}

if ($medal_action == 'save_grant') {
	$grant_id = $_POST['grant_id'];
	$remarks = $tp->toDB($_POST['med_user_remarks']);
	if ($grant_id > 0) {
		$medal_obj->grantMedal($grant_id, $medal_uid, $remarks);
		$medal_msg = ADLAN_RS_MD15;
	}
	unset($grant, $grant_id);
	$medal_action = 'edit';
}

if ($grant == "medal" && $grant_id) {
    $medal_text = '
	<form method="post" action="' . e_SELF . '" id="medal_form" >
		<div>
			<input type="hidden" name="medal_uid" value="' . $medal_uid . '" />
			<input type="hidden" name="user_name" value="' . $user_name . '" />
			<input type="hidden" name="grant_id" value="' . $grant_id . '" />
			<input type="hidden" name="medal_action" value="save_grant" />
		</div>
	 	<table class="rsborder" style="' . USER_WIDTH . '">
	 		<tr>
	 			<td class="rscaption" colspan="2">' . RANKS_MED_ED_06 . ' </td>
	 		</tr>

	 		<tr>
	 			<td class="rsheader2" style="width:30%;text-align:center;" >' . RANKS_MED_ED_09 . '</td>
 				<td class="rsheader2" style="width:70%">
					<textarea class="rsbox" rows="4" cols="60" style="width:80%" name="med_user_remarks" ></textarea>
				</td>
			</tr>
	 		
			<tr><td colspan=2>&nbsp;</td></tr>
		<td class="rsheader2" colspan="2" style="text-align:center">
			<input type="submit" class="rsbutton" name="save_grant" value="' . RANKS_MED_ED_06 . '" />
		</td>
    
	 	</table>
	</form>';
}

if ($medal_action == '' || $medal_action == 'edit') {
	if (!check_class($RANK_PREF['medal_modifyclass'])) {
		$medal_text = RANKS_MED_ED_02;
		$ns->tablerender($title, $medal_text);
		require_once(FOOTERF);
		exit;
	}
	
    $sql->db_Select("user", "user_name", "user_id=".$medal_uid);
    extract($sql->db_Fetch());
	
    $medal_text = '
<form method="post" action="' . e_SELF . '" id="rank_form" >
	<div>
		<input type="hidden" name="medal_uid" value="' . $medal_uid . '" />
		<input type="hidden" name="user_name" value="' . $user_name . '" />
		<input type="hidden" name="medal_action" value="save" />
	</div>
 	<table class="rsborder" style="' . USER_WIDTH . '">
 		<tr>
 			<td class="rscaption" colspan="4">' . RANKS_MED_12 . ' ['.$user_name.']</td>
 		</tr>
 		
 		<tr>
    		<td class="rsheader2" style="width:40%;text-align:center;" >' . RANKS_MED_06 . '</td>
    		<td class="rsheader2" style="width:35%;text-align:center;" >' . RANKS_MED_ED_03 . '</td>
    		<td class="rsheader2" style="width:20%;text-align:center;" >' . RANKS_MED_ED_04 . '</td>
    		<td class="rsheader2" style="width:5%;text-align:center;" >' . RANKS_MED_ED_05 . '</td>
    	</tr>';

	    if (check_class($RANK_PREF['medal_modreservedclass'])) {
	    	$reserved = "";
		} else {
			$reserved = "and medal_reserved='F'";
		}
    
    
	    $sql->db_Select("rank_medals","*","medal_goal=0 ".$reserved." order by medal_type, medal_order");
	    $medList = $sql->db_getList();
		foreach($medList as $med_row) {
			extract($med_row);
			
			$medal_text .= '
	    	<tr>
	    		<td class="rsheader2" style="text-align:center;" ><img src="' . $medal_obj->convertImage($medal_img) . '" border="0"/></td>
	    		<td class="rsheader2" style="text-align:center;" >' . $medal_name . '</td>
	    		<td class="rsheader2" style="text-align:center;" >';
			
			$index = $medal_obj->userHasMedal($medal_id, $medal_uid);
			if ($index > 0) {
				$sql->db_Select("rank_medal_users", "med_user_date", "med_user_index=".$index);
				$row = $sql->db_Fetch();
				$medal_text .= 
					date("d M Y", $row['med_user_date'])."</td>
					<td class='rsheader2' style='text-align:center;' >
					<input type='image' title='".RANKS_MED_ED_07."' name='revoke[medal_{$index}]' src='".e_PLUGIN."rank_system/images/delete.png'/>
				";
			} else {
				$medal_text .= " 
					&nbsp;</td>
					<td class='rsheader2' style='text-align:center;' >
					<input type='image' title='".RANKS_MED_ED_06."' name='grant[medal_{$medal_id}]' src='".e_PLUGIN."rank_system/images/add.gif'/>
				";
			}
			
	    	$medal_text .= '</td></tr>';
			
		}
    
 		$medal_text .='
 			<tr><td colspan=4>&nbsp;</td></tr>
 			
		 	<tr>
				<td class="rsheader2" colspan="4" style="text-align:center">
					<input type="submit" class="rsbutton" name="returnProfile" value="' . RANKS_MED_ED_08 . '" />
				</td>
			</tr>
 			
		 	</table>
		</form>';
}


$ns->tablerender($title, $medal_text);
require_once(FOOTERF);

?>