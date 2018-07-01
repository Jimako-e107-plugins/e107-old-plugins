<?php
/**
 * $Id: admin_config.php,v 1.5 2009/10/22 15:04:33 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.5 $
 * Last Modified: $Date: 2009/10/22 15:04:33 $
 *
 * Change Log:
 * $Log: admin_config.php,v $
 * Revision 1.5  2009/10/22 15:04:33  michiel
 * - removed autoprobation/-prison
 * - added level bar settings
 *
 * Revision 1.4  2009/07/14 19:29:04  michiel
 * CVS Merge
 *
 * Revision 1.3.2.1  2009/07/13 18:49:44  michiel
 * Added Sending of PM
 *
 * Revision 1.3  2009/06/28 15:05:52  michiel
 * Merged from dev_01_03
 *
 * Revision 1.2.2.2  2009/06/28 14:15:46  michiel
 * updated default settings
 *
 * Revision 1.2.2.1  2009/06/28 02:32:25  michiel
 * - Position of rank image in forum is configurable
 * - Medal/Ribbon counts can be shown in forum
 *
 * Revision 1.2  2009/06/26 09:23:05  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.3  2009/06/19 13:47:20  michiel
 * Made XHTML compliant
 *
 * Revision 1.1.2.2  2009/06/12 16:29:13  michiel
 * RELEASE 1.2
 *
 * Revision 1.1.2.1  2009/06/12 15:12:51  michiel
 * RELEASE 1.2
 *
 * Revision 1.1  2009/03/28 13:01:43  michiel
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

/*
 * First check if this is a new install..
 * If so, offer to get started with a lot of default settings
 */
if (isset($_POST['importdefs'])) {
	$def_sql = file_get_contents(e_PLUGIN . "rank_system/includes/def_settings_sql.php");
	$importQry = explode(';', str_replace('INSERT INTO ', 'INSERT INTO ' . MPREFIX, $def_sql));
	$rank_text = '
		<form method="post" action="' . e_SELF . '" id="newinst" >
			<table class="fborder" style="' . ADMIN_WIDTH . '">
				<tr>
					<td class="fcaption" style="text-align:left">' . ADLAN_RS_NI01 . '</td>
				</tr>
				<tr>
					<td class="forumheader2" style="text-align:center">
	';
	
	$fail = false;
	foreach ($importQry as $query) {
		if ($query != '' && !$sql->db_Select_gen($query, false)) {
			$fail = true;
		}
	}
	
	if ($fail) {
		$rank_text .= ADLAN_RS_NI06;
	} else {
		$rank_text .= ADLAN_RS_NI05;
		$rank->validateAll();
	}
	$rank_text .= '
					</td>
				</tr>
				<tr>
					<td class="forumheader2" style="text-align:center">
						<input type="submit" class="button" name="continue" value="' . ADLAN_RS_NI07 . '" />
					</td>
				</tr>
			</table>
		</form>
	';
	$ns->tablerender(ADLAN_RS, $rank_text);
	require_once(e_ADMIN . 'footer.php');
	exit;
	
}
if ($sql->db_Count("rank_ranks") == 0 && !isset($_POST['skipdefs'])) {
	$rank_text = '
		<form method="post" action="' . e_SELF . '" id="newinst" >
			<table class="fborder" style="' . ADMIN_WIDTH . '">
				<tr>
					<td class="fcaption" style="text-align:left">' . ADLAN_RS_NI01 . '</td>
				</tr>
				<tr>
					<td class="forumheader2" style="text-align:center">' . ADLAN_RS_NI02 . '</td>
				</tr>
				<tr>
					<td class="forumheader2" style="text-align:center">
						<input type="submit" class="button" name="importdefs" value="' . ADLAN_RS_NI03 . '" />
						<input type="submit" class="button" name="skipdefs" value="' . ADLAN_RS_NI04 . '" />
					</td>
				</tr>
			</table>
		</form>
	';
	
	$ns->tablerender(ADLAN_RS, $rank_text);
	require_once(e_ADMIN . 'footer.php');
	exit;
}
//*/

require_once(e_PLUGIN . 'rank_system/includes/rank_class.php');
require_once(e_HANDLER . 'userclass_class.php');

$rank = new rank();

if (isset($_POST['updatesettings']))
{
	$RANK_PREF['rank_viewclass'] = intval($_POST['rank_viewclass']);
	$RANK_PREF['rank_plugclass'] = intval($_POST['rank_plugclass']);
	$RANK_PREF['rank_modifyclass'] = intval($_POST['rank_modifyclass']);
	$RANK_PREF['rank_reservedclass'] = intval($_POST['rank_reservedclass']);
	$RANK_PREF['rank_freezerankcls'] = intval($_POST['rank_freezerankcls']);
	$RANK_PREF['rank_freezesitecls'] = intval($_POST['rank_freezesitecls']);
	$RANK_PREF['rank_inprisoncls'] = intval($_POST['rank_inprisoncls']);
	$RANK_PREF['rank_outprisoncls'] = intval($_POST['rank_outprisoncls']);
	$RANK_PREF['rank_inprobationcls'] = intval($_POST['rank_inprobationcls']);
	$RANK_PREF['rank_outprobationcls'] = intval($_POST['rank_outprobationcls']);
	$RANK_PREF['rank_kickcls'] = intval($_POST['rank_kickcls']);
	$RANK_PREF['rank_skipagecls'] = intval($_POST['rank_skipagecls']);
	// Auto probation/prison is disabled since v1.5
	$RANK_PREF['rank_modown'] = $_POST['rank_modown'];
	$RANK_PREF['rank_barheight'] = intval($_POST['rank_barheight']);
	$RANK_PREF['rank_integrateKick'] = $_POST['rank_integrateKick'];
	$RANK_PREF['rank_adminlog'] = $_POST['rank_adminlog'];
	$RANK_PREF['rank_forumimg'] = $_POST['rank_forumimg'];
	$RANK_PREF['rank_forumwidth'] = intval($_POST['rank_forumwidth']);
	$RANK_PREF['rank_forumheight'] = intval($_POST['rank_forumheight']);
	$RANK_PREF['medal_modifyclass'] = intval($_POST['medal_modifyclass']);
	$RANK_PREF['medal_modreservedclass'] = intval($_POST['medal_modreservedclass']);
	$RANK_PREF['rank_recomclass'] = intval($_POST['rank_recomclass']);
	$RANK_PREF['rank_recviewclass'] = intval($_POST['rank_recviewclass']);
	$RANK_PREF['rank_newprob'] = ($_POST['rank_newprob'] == 'T' ? "T" : "F");
	$RANK_PREF['rank_newpris'] = ($_POST['rank_newpris'] == 'T' ? "T" : "F");
	$RANK_PREF['rank_forumbreak'] = $_POST['rank_forumbreak'];
	$RANK_PREF['rank_forumstat'] = $_POST['rank_forumstat'];
	$RANK_PREF['rank_frmimgoffset'] = $_POST['rank_frmimgoffset'];
	$RANK_PREF['rank_frmstatoffset'] = $_POST['rank_frmstatoffset'];
	$RANK_PREF['rank_sendpm'] = intval($_POST['rank_sendpm']);
	$RANK_PREF['rank_pmsender'] = intval($_POST['rank_pmsender']);
	$RANK_PREF['rank_lvlstyle'] = intval($_POST['rank_lvlstyle']);
	$RANK_PREF['rank_lvlupwidth'] = intval($_POST['rank_lvlupwidth']);
	$RANK_PREF['rank_lvlovwidth'] = intval($_POST['rank_lvlovwidth']);
	
	
	$classcount = count($_POST['rank_probusrcls'])-1;
	$RANK_PREF['rank_probusrcls'] = "";
	for($a = 0; $a <= $classcount; $a++) {
		$RANK_PREF['rank_probusrcls'] .= $_POST['rank_probusrcls'][$a];
		$RANK_PREF['rank_probusrcls'] .= ($a < $classcount ) ? "," : "";
	}
	$classcount = count($_POST['rank_prisusrcls'])-1;
	$RANK_PREF['rank_prisusrcls'] = "";
	for($a = 0; $a <= $classcount; $a++) {
		$RANK_PREF['rank_prisusrcls'] .= $_POST['rank_prisusrcls'][$a];
		$RANK_PREF['rank_prisusrcls'] .= ($a < $classcount ) ? "," : "";
	}
	
	
    // save settings
    $rank->save_prefs();

    $rank_msg = ADLAN_RS_UPDOK;
}

$rank_text = '
<form method="post" action="' . e_SELF . '" id="dataform" >
	<table class="fborder" style="' . ADMIN_WIDTH . '">
	<tr>
		<td class="fcaption" colspan="3" style="text-align:left">' . ADLAN_RS_C1 . '</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="3" style="text-align:center"><b>' . $rank_msg . '</b>&nbsp;</td>
	</tr>
	';

$rank_text .= '
	<tr>
		<td class="forumheader2" colspan="3" style="text-align:center"><strong>'.ADLAN_RS_C16.'</strong></td>
	</tr>

	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C32 . '</td>
		<td class="forumheader3" colspan="2" style="width:70%">'
			. r_userclass('rank_viewclass', $RANK_PREF['rank_viewclass'], 'off', 'main,admin,members,classes') . '</td>
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C36 . '</td>
		<td class="forumheader3" colspan="2" style="width:70%">'
			. r_userclass('rank_plugclass', $RANK_PREF['rank_plugclass'], 'off', 'main,admin,classes') . '</td>
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C2 . '</td>
		<td class="forumheader3" colspan="2" style="width:70%">'
			. r_userclass('rank_modifyclass', $RANK_PREF['rank_modifyclass'], 'off', 'main,admin,classes') . '</td>
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C3 . '</td>
		<td class="forumheader3" colspan="2" style="width:70%">'
			. r_userclass('rank_reservedclass', $RANK_PREF['rank_reservedclass'], 'off', 'main,admin,classes') . '</td>
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C4 . '</td>
		<td class="forumheader3" colspan="2" style="width:70%">'
			. r_userclass('rank_freezerankcls', $RANK_PREF['rank_freezerankcls'], 'off', 'main,admin,classes') . '</td>
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C5 . '</td>
		<td class="forumheader3" colspan="2" style="width:70%">'
			. r_userclass('rank_freezesitecls', $RANK_PREF['rank_freezesitecls'], 'off', 'main,admin,classes') . '</td>
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C8 . '</td>
		<td class="forumheader3" style="width:35%">' . ADLAN_RS_C12
			. r_userclass('rank_inprisoncls', $RANK_PREF['rank_inprisoncls'], 'off', 'nobody,main,admin,classes') . '</td>
		</td>
		<td class="forumheader3" style="width:35%">' . ADLAN_RS_C13
			. r_userclass('rank_outprisoncls', $RANK_PREF['rank_outprisoncls'], 'off', 'nobody,main,admin,classes') . '</td>
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C9 . '</td>
		<td class="forumheader3" style="width:35%">' . ADLAN_RS_C12
			. r_userclass('rank_inprobationcls', $RANK_PREF['rank_inprobationcls'], 'off', 'nobody,main,admin,classes') . '</td>
		</td>
		<td class="forumheader3" style="width:35%">' . ADLAN_RS_C13
			. r_userclass('rank_outprobationcls', $RANK_PREF['rank_outprobationcls'], 'off', 'nobody,main,admin,classes') . '</td>
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C10 . '</td>
		<td class="forumheader3" colspan="2" style="width:35%">'
			. r_userclass('rank_kickcls', $RANK_PREF['rank_kickcls'], 'off', 'nobody,main,admin,classes') . '</td>
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C25 . '</td>
		<td class="forumheader3" colspan="2" style="width:35%">'
			. r_userclass('rank_skipagecls', $RANK_PREF['rank_skipagecls'], 'off', 'nobody,main,admin,classes') . '</td>
		</td>
	</tr>

	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C6 . '</td>
		<td class="forumheader3" colspan="2" style="width:70%">
			<input name="rank_modown" value="T" type="checkbox" class="tbox" style="border:0;" ' . ($RANK_PREF['rank_modown'] == "T"?'checked="checked"':'') . ' />		
		</td>
	</tr>
	
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C26 . '</td>
		<td class="forumheader3" style="width:35%">' 
			. r_userclass('medal_modifyclass', $RANK_PREF['medal_modifyclass'], 'off', 'nobody,main,admin,classes') . '</td>
		</td>
		<td class="forumheader3" style="width:35%">' . ADLAN_RS_C27
			. r_userclass('medal_modreservedclass', $RANK_PREF['medal_modreservedclass'], 'off', 'nobody,main,admin,classes') . '</td>
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C30 . '</td>
		<td class="forumheader3" colspan="2" style="width:35%">'
			. r_userclass('rank_recomclass', $RANK_PREF['rank_recomclass'], 'off', 'nobody,main,admin,member,classes') . '</td>
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C31 . '</td>
		<td class="forumheader3" colspan="2" style="width:35%">'
			. r_userclass('rank_recviewclass', $RANK_PREF['rank_recviewclass'], 'off', 'nobody,main,admin,member,classes') . '</td>
		</td>
	</tr>

	<tr>
		<td class="forumheader1" colspan="3" style="text-align:center">&nbsp;</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="3" style="text-align:center"><strong>'.ADLAN_RS_C17.'</strong></td>
	</tr>
	
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C20 . '</td>
		<td class="forumheader3" colspan="2" style="width:70%">
			<input name="rank_integrateKick" value="T" type="checkbox" class="tbox" style="border:0;" ' . ($RANK_PREF['rank_integrateKick'] == "T"?'checked="checked"':'') . ' />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" rowspan="2" style="width:30%">' . ADLAN_RS_C22 . '</td>
		<td class="forumheader3" style="width:35%">
		<input type="radio"' . ($RANK_PREF['rank_frmimgoffset'] == "-" ? 'checked="checked"':'') . ' name="rank_frmimgoffset" class="tbox" value="-" /> ' . ADLAN_RS_C60 . '
		<input type="radio"' . ($RANK_PREF['rank_frmimgoffset'] == "+" ? 'checked="checked"':'') . ' name="rank_frmimgoffset" class="tbox" value="+" /> ' . ADLAN_RS_C38 . '
		<br/>		
		<select name="rank_forumimg" class="tbox">\n
		<option value="-" '.($RANK_PREF['rank_forumimg'] == "-" ? 'selected="selected"' : '').'>'.ADLAN_RS_C37.'</option>\n';
			
		$frmopt = getForumOpts();
		while (list($key, $label) = each($frmopt)) {
			$sel = ($RANK_PREF['rank_forumimg'] == $key ? 'selected="selected"' : '');
			$rank_text .= "<option value='$key' $sel>$label</option>\n";
		}
		
		$rank_text .= '</select>
		</td>
		<td class="forumheader3" style="width:35%">'.ADLAN_RS_C53.'
			<select name="rank_forumbreak" class="tbox">\n
			<option value="0" '. ($RANK_PREF['rank_forumbreak'] == 0 ? 'selected="selected"' : '') . '>'.ADLAN_RS_C54.'</option>\n
			<option value="1" '. ($RANK_PREF['rank_forumbreak'] == 1 ? 'selected="selected"' : '') . '>'.ADLAN_RS_C55.'</option>\n
			<option value="2" '. ($RANK_PREF['rank_forumbreak'] == 2 ? 'selected="selected"' : '') . '>'.ADLAN_RS_C56.'</option>\n
			<option value="3" '. ($RANK_PREF['rank_forumbreak'] == 3 ? 'selected="selected"' : '') . '>'.ADLAN_RS_C57.'</option>\n
			</select>
			<br />' . ADLAN_RS_C23 . '
			<input class="tbox" type="text" name="rank_forumwidth" size="4" value="'.$RANK_PREF['rank_forumwidth'].'" maxlength="3" />
			<br />' . ADLAN_RS_C24 . '
			<input class="tbox" type="text" name="rank_forumheight" size="4" value="'.$RANK_PREF['rank_forumheight'].'" maxlength="3" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" rowspan="2" colspan="2" style="width:35%">'.ADLAN_RS_C58.'</td>
	</tr>
	
	<tr>
		<td class="forumheader3" rowspan="2" style="width:30%">' . ADLAN_RS_C59 . '</td>
	</tr>
	<tr>
		<td class="forumheader3" colspan="2">
		<input type="radio"' . ($RANK_PREF['rank_frmstatoffset'] == "-" ? 'checked="checked"':'') . ' name="rank_frmstatoffset" class="tbox" value="-" /> ' . ADLAN_RS_C60 . '
		<input type="radio"' . ($RANK_PREF['rank_frmstatoffset'] == "+" ? 'checked="checked"':'') . ' name="rank_frmstatoffset" class="tbox" value="+" /> ' . ADLAN_RS_C38 . '
		<br/>		
		<select name="rank_forumstat" class="tbox">\n
		<option value="-" '.($RANK_PREF['rank_forumstat'] == "-" ? 'selected="selected"' : '').'>'.ADLAN_RS_C37.'</option>\n';
		
		$frmopt = getForumOpts(true);
		while (list($key, $label) = each($frmopt)) {
			$sel = ($RANK_PREF['rank_forumstat'] == $key ? 'selected="selected"' : '');
			$rank_text .= "<option value='$key' $sel>$label</option>\n";
		}
		
		$rank_text .= '</select>
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C62 . '</td>
		<td class="forumheader3" style="width:35%">
			<select class="tbox" name="rank_sendpm">
				<option value="0" '. ($RANK_PREF['rank_sendpm'] == 0 ? 'selected="selected"' : "").'>'.ADLAN_RS_C63.'</option>
				<option value="1" '. ($RANK_PREF['rank_sendpm'] == 1 ? 'selected="selected"' : "").'>'.ADLAN_RS_C64.'</option>
				<option value="2" '. ($RANK_PREF['rank_sendpm'] == 2 ? 'selected="selected"' : "").'>'.ADLAN_RS_C65.'</option>
				<option value="3" '. ($RANK_PREF['rank_sendpm'] == 3 ? 'selected="selected"' : "").'>'.ADLAN_RS_C66.'</option>
			</select>
		</td>
		<td class="forumheader3" style="width:35%">' . ADLAN_RS_C67 . '
			'.getUserSelectBox("rank_pmsender", $RANK_PREF['rank_pmsender']).'
		</td>
	</tr>
	
	<tr>
		<td class="forumheader1" colspan="3" style="text-align:center">&nbsp;</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="3" style="text-align:center"><strong>'.ADLAN_RS_C18.'</strong></td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C21 . '</td>
		<td class="forumheader3" colspan="2" style="width:70%">
			<input name="rank_adminlog" value="T" type="checkbox" class="tbox" style="border:0;" ' . ($RANK_PREF['rank_adminlog'] == "T"?'checked="checked"':'') . ' />
		</td>
	</tr>
	
	<tr>
		<td class="forumheader1" colspan="3" style="text-align:center">&nbsp;</td>
	</tr>
	
	<tr>
		<td class="forumheader2" colspan="3" style="text-align:center"><strong>'.ADLAN_RS_C19.'</strong></td>
	</tr>
	
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C7 . '</td>
		<td class="forumheader3" colspan="2" style="width:70%">
			<input class="tbox" type="text" name="rank_barheight" size="4" value="'.$RANK_PREF['rank_barheight'].'" maxlength="2" /> ' . ADLAN_RS_C74 .'
		</td>
	</tr>
	
	<tr>
		<td class="forumheader3" rowspan="2" style="width:30%">' . ADLAN_RS_C69 . ' ' . ADLAN_RS_C72 . '</td>
		<td class="forumheader3" style="width:20%">
			<input type="radio" ' . ($RANK_PREF['rank_lvlstyle'] == 0 ?'checked="checked"':'') . ' name="rank_lvlstyle" class="tbox" value="0" /> ' .ADLAN_RS_C70.'
		</td>
		<td class="forumheader3" style="width:50%">
			<input class="tbox" type="text" name="rank_lvlupwidth" size="5" value="'.$RANK_PREF['rank_lvlupwidth'].'" maxlength="4" /> ' . ADLAN_RS_C74 .'
		</td>
	</tr>
	<tr>
		<td class="forumheader3" colspan="2">
			<input type="radio" ' . ($RANK_PREF['rank_lvlstyle'] == 1 ?'checked="checked"':'') . ' name="rank_lvlstyle" class="tbox" value="1" /> ' .ADLAN_RS_C71.'
		</td>
	</tr>
	
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C69 . ' ' . ADLAN_RS_C73 . '</td>
		<td class="forumheader3" colspan="2" style="width:70%">
			<input class="tbox" type="text" name="rank_lvlovwidth" size="5" value="'.$RANK_PREF['rank_lvlovwidth'].'" maxlength="4" /> ' . ADLAN_RS_C74 .'
		</td>
	</tr>
	

	<tr>
		<td class="forumheader2" colspan="3" style="text-align:center"><strong>'.ADLAN_RS_C68.'</strong></td>
	</tr>
	
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C33 . '</td>
		<td class="forumheader3" style="width:35%">' . ADLAN_RS_C34 . ' 
			<input name="rank_newprob" value="T" type="checkbox" class="tbox" style="border:0;" ' . ($RANK_PREF['rank_newprob'] == "T"?'checked="checked"':'') . ' />
		</td>
		<td class="forumheader3" style="width:35%">' . ADLAN_RS_C35 . '
			<input name="rank_newpris" value="T" type="checkbox" class="tbox" style="border:0;" ' . ($RANK_PREF['rank_newpris'] == "T"?'checked="checked"':'') . ' />
		</td>
	</tr>
	
	
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C28 . '</td>
		<td class="forumheader3" colspan="2" style="width:70%">';

		$class = getClasses();
		for($a = 0; $a <= (count($class)-1); $a++) {
		if (check_class($class[$a][0], $RANK_PREF['rank_probusrcls'])) {
			$rank_text .= "<input type='checkbox' name='rank_probusrcls[]' value='".$class[$a][0]."' checked='checked' />".$class[$a][1]." ";
		} else {
			$rank_text .= "<input type='checkbox' name='rank_probusrcls[]' value='".$class[$a][0]."' />".$class[$a][1]." ";
		}
			$rank_text .= " - ".$class[$a][2]."<br />";
		}
			
			
	$rank_text .= '</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_RS_C29 . '</td>
		<td class="forumheader3" colspan="2" style="width:70%">';

		for($a = 0; $a <= (count($class)-1); $a++) {
		if (check_class($class[$a][0], $RANK_PREF['rank_prisusrcls'])) {
			$rank_text .= "<input type='checkbox' name='rank_prisusrcls[]' value='".$class[$a][0]."' checked='checked' />".$class[$a][1]." ";
		} else {
			$rank_text .= "<input type='checkbox' name='rank_prisusrcls[]' value='".$class[$a][0]."' />".$class[$a][1]." ";
		}
			$rank_text .= " - ".$class[$a][2]."<br />";
		}
			
			
	$rank_text .= '</td>
	</tr>';
	
	if (getperms('0') || check_class($RANK_PREF['rank_plugclass'])) {
		$rank_text .='
		<tr>
			<td class="forumheader2" colspan="3" style="text-align:left">
				<input type="submit" class="button" name="updatesettings" value="' . ADLAN_RS_UPD . '" />
			</td>
		</tr>
		';
	}
	
$rank_text .= '
	<tr>
		<td class="fcaption" colspan="3" style="text-align:left">&nbsp;</td>
	</tr>
</table>
</form>';
$ns->tablerender(ADLAN_RS, $rank_text);
require_once(e_ADMIN . 'footer.php');


function getClasses() {
	global $sql;
	$sql->db_Select("userclass_classes");
	$c = 0;
	while ($row = $sql->db_Fetch()) {
		if (getperms("0") || check_class($row['userclass_editclass'])) {
			$class[$c][0] = $row['userclass_id'];
			$class[$c][1] = $row['userclass_name'];
			$class[$c][2] = $row['userclass_description'];
			$c++;
		}
	}

	return $class;
}

function getForumOpts($includeImage = false) {
	$frmopt['{POSTER}'] = ADLAN_RS_C39;
	$frmopt['{AVATAR}'] = ADLAN_RS_C40;
	$frmopt['{LEVEL=pic}'] = ADLAN_RS_C41;
	$frmopt['{LEVEL=special}'] = ADLAN_RS_C42;
	$frmopt['{LEVEL=userid}'] = ADLAN_RS_C43;
	$frmopt['{JOINED}'] = ADLAN_RS_C44;
	$frmopt['{USER_EXTENDED=location.text_value}'] = ADLAN_RS_C45;
	$frmopt['{POSTS}'] = ADLAN_RS_C46;
	$frmopt['{LASTEDIT}'] = ADLAN_RS_C47;
	$frmopt['{SIGNATURE}'] = ADLAN_RS_C48;
	$frmopt['{THREADDATESTAMP}'] = ADLAN_RS_C49;
	$frmopt['{REPORTIMG}'] = ADLAN_RS_C50;
	$frmopt['{QUOTEIMG}'] = ADLAN_RS_C51;
	$frmopt['{CUSTOMTITLE}'] = ADLAN_RS_C52;
	
	if ($includeImage) {
		$frmopt['{RANK_IMAGE}'] = ADLAN_RS_C61;
	}
	
	asort($frmopt);

	return $frmopt;
}

function getUserSelectBox($fieldName, $currVal = 0) {
	global $sql;
	
	if ($currVal == 0) {
		$currVal = USERID;
	}
	$box = "<select class='tbox' name='$fieldName'>";
	
	$sql->db_Select("user", "user_id, user_name", "user_ban = 0 order by user_name");
	$list = $sql->db_getList();
	foreach ($list as $row) {
		$sel = $currVal == $row['user_id'] ? "selected='selected'" : "";
		$box .= "<option value='".$row['user_id']."' $sel>".$row['user_name']."</option>\n";
	}
	$box .= "</select>\n";
	
	return $box;
}


?>