<?php
/**
 * $Id: admin_config.php 62 2010-11-07 12:41:59Z michiel $
 * 
 * Memberlist plugin for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2010
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 4 sep. 2010
 * $HeadURL: svn://ubusrv/echo2/MemberList/frontliners.eu/fl_plugins/memberlist/admin_config.php $
 * 
 * Revision: $LastChangedRevision: 62 $
 * Last Modified: $LastChangedDate: 2010-11-07 13:41:59 +0100 (zo, 07 nov 2010) $
 *
 */
require_once('../../class2.php');

if (!defined('e107_INIT')) {
    exit;
}

if (!getperms('P')) {
    header('location:' . e_HTTP . 'index.php');
    exit;
}

require_once(e_ADMIN . 'auth.php');

if (!defined('ADMIN_WIDTH')) {
    define(ADMIN_WIDTH, 'width:100%;');
}

if (file_exists(e_PLUGIN . 'memberlist/languages/admin/' . e_LANGUAGE . '.php')) {
	include_lan(e_PLUGIN . 'memberlist/languages/admin/' . e_LANGUAGE . '.php');
} else {
	include_lan(e_PLUGIN . 'memberlist/languages/admin/English.php');
}
global $MBL_PREF;

require_once(e_PLUGIN . 'memberlist/includes/memberlist_class.php');
require_once(e_HANDLER . 'userclass_class.php');

$mbl = new memberlist();

if (isset($_POST['updatesettings'])) {
	$MBL_PREF['list_pagesize'] = intval($_POST['list_pagesize']);
	$MBL_PREF['editclass'] = intval($_POST['editclass']);
	$MBL_PREF['adminlog'] = intval($_POST['adminlog']);
	$MBL_PREF['usrprofpos'] = $_POST['usrprofpos'];
	$MBL_PREF['usrprofile'] = $_POST['usrprofile'];
	
	$classcount = count($_POST['mbl_groups'])-1;
	$MBL_PREF['groups'] = "";
	for($a = 0; $a <= $classcount; $a++) {
		$MBL_PREF['groups'] .= $_POST['mbl_groups'][$a];
		$MBL_PREF['groups'] .= ($a < $classcount ) ? "," : "";
	}
	
	
    // save settings
    $mbl->save_prefs();

    $mbl_msg = ADLAN_MBL_UPDOK;
}

$mbl_text = '
<form method="post" action="' . e_SELF . '" id="dataform" >
	<table class="fborder" style="' . ADMIN_WIDTH . '">
	<tr>
		<td class="fcaption" colspan="3" style="text-align:left">' . ADLAN_MBL_MC01 . '</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="3" style="text-align:center"><b>' . $mbl_msg . '</b>&nbsp;</td>
	</tr>

	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_MBL_MC02 . '</td>
		<td class="forumheader3" colspan="2" style="width:70%">
			<input type="text" class="tbox" name="list_pagesize" value="'. $MBL_PREF['list_pagesize'] . '" size="2" maxlength="2" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_MBL_MC05 . '</td>
		<td class="forumheader3" colspan="2" style="width:70%">'
			. r_userclass('editclass', $MBL_PREF['editclass'], 'off', 'main,admin,classes') . '
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_MBL_MC06 . '</td>
		<td class="forumheader3" colspan="2" style="width:70%">
			<input type="checkbox" class="tbox" name="adminlog" value="1" '.($MBL_PREF['adminlog'] ? 'checked="checked"' : '').' /> 
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_MBL_MC07 . '</td>
		<td class="forumheader3" colspan="2" style="width:70%">
			'.getUserTmplPosBox($MBL_PREF['usrprofpos']).'
			'.getUserTmplBox($MBL_PREF['usrprofile']).'
		</td>
	</tr>
	
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_MBL_MC03 . '</td>
		<td class="forumheader3" colspan="2" style="width:70%">
';

$class = getClasses();
$clsArr = explode(",", $MBL_PREF['groups']);
for($a = 0; $a <= (count($class)-1); $a++) {
	
	$checked = (in_array($class[$a][0], $clsArr) ? "checked='checked'" : ""); 
	$mbl_text .= "<input type='checkbox' name='mbl_groups[]' value='".$class[$a][0]."' $checked />".$class[$a][1]." ";
	if ($class[$a][2]) $mbl_text .= " - ".$class[$a][2];
	$mbl_text .= "<br/>";
}
			
$mbl_text .= '</td>
	</tr>
	
	<tr>
		<td class="forumheader2" colspan="3" style="text-align:left">
			<input type="submit" class="button" name="updatesettings" value="' . ADLAN_MBL_UPD . '" />
		</td>
	</tr>

	<tr>
		<td class="fcaption" colspan="3" style="text-align:left">&nbsp;</td>
	</tr>
</table>
</form>';
$ns->tablerender(ADLAN_MBL, $mbl_text);
require_once(e_ADMIN . 'footer.php');


function getClasses() {
	global $sql;
	$sql->db_Select("userclass_classes", "*", "order by userclass_name", 'nowhere');
	$c = 1;
	
	$class[0][0] = e_UC_ADMIN;
	$class[0][1] = ADLAN_MBL_MC04;
	$class[0][2] = "";
	
	while ($row = $sql->db_Fetch()) {
		$class[$c][0] = $row['userclass_id'];
		$class[$c][1] = $row['userclass_name'];
		$class[$c][2] = $row['userclass_description'];
		$c++;
	}

	return $class;
}

function getUserTmplBox($currval) {
	$box = "<select class='tbox' name='usrprofile'>\n";

	$box .= "<option value='' ".($currval == '' ? "selected='selected'" : "") ." >".ADLAN_MBL_MC08."</option>\n";
	$box .= "<option value='USER_RATING' ".($currval == 'USER_RATING' ? "selected='selected'" : "") ." >".ADLAN_MBL_MC09."</option>\n";
	$box .= "<option value='USER_SIGNATURE' ".($currval == 'USER_SIGNATURE' ? "selected='selected'" : "") ." >".ADLAN_MBL_MC10."</option>\n";
	$box .= "<option value='USER_EXTENDED_ALL' ".($currval == 'USER_EXTENDED_ALL' ? "selected='selected'" : "") ." >".ADLAN_MBL_MC11."</option>\n";
	$box .= "<option value='USER_UPDATE_LINK' ".($currval == 'USER_UPDATE_LINK' ? "selected='selected'" : "") ." >".ADLAN_MBL_MC12."</option>\n";
	$box .= "<option value='PROFILE_COMMENTS' ".($currval == 'PROFILE_COMMENTS' ? "selected='selected'" : "") ." >".ADLAN_MBL_MC13."</option>\n";
	
	$box .= "</select>\n";
	
	return $box;
}

function getUserTmplPosBox($currval) {
	$box = "<select class='tbox' name='usrprofpos'>\n";

	$box .= "<option value='pre' ".($currval == 'pre' ? "selected='selected'" : "") ." >".ADLAN_MBL_MC14."</option>\n";
	$box .= "<option value='post' ".($currval == 'post' ? "selected='selected'" : "") ." >".ADLAN_MBL_MC15."</option>\n";
	
	$box .= "</select>\n";
	
	return $box;
}


?>