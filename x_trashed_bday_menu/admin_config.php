<?php
/*
+---------------------------------------------------------------+
|        Birthday Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
// ***************************************************************
// *
// *		Plugin		:	Birthday Menu (e107 v7)
// *
// ***************************************************************
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms("P"))
{
    header("location:" . e_BASE . "index.php");
    exit;
}
include_lan(e_PLUGIN . "bday_menu/languages/" . e_LANGUAGE . "_birthday_mnu.php");

require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%;");
}
require_once(e_HANDLER . "userclass_class.php");

$caption = BDAY_LAN_2;
if (e_QUERY == "update")
{
    $pref['bday_dformat'] = intval($_POST['bday_dformat']);
    $pref['bday_sendemail'] = $tp->toDB($_POST['bday_sendemail']);
    $pref['bday_showage'] = $tp->toDB($_POST['bday_showage']);
    $pref['bday_showdate'] = intval($_POST['bday_showdate']);
    $pref['bday_numdue'] = $tp->toDB($_POST['bday_numdue']);
    $pref['bday_emailfrom'] = $tp->toDB($_POST['bday_emailfrom']);
    $pref['bday_greeting'] = $tp->toDB($_POST['bday_greeting']);
    $pref['bday_subject'] = $tp->toDB($_POST['bday_subject']);
    $pref['bday_emailaddr'] = $tp->toDB($_POST['bday_emailaddr']);
    $pref['bday_showclass'] = $tp->toDB($_POST['bday_showclass']);
    $pref['bday_avwidth'] = intval($_POST['bday_avwidth']);
    $pref['bday_pmfrom'] = intval($_POST['bday_pmfrom']);
    $pref['bday_usepm'] = intval($_POST['bday_usepm']);
    $pref['bday_usecss'] = intval($_POST['bday_usecss']);
    $pref['bday_include'] = intval($_POST['bday_include']);
    $pref['bday_exclude'] = intval($_POST['bday_exclude']);
    $pref['bday_avatar'] = intval($_POST['bday_avatar']);
    $pref['bday_demographic'] = intval($_POST['bday_demographic']);
    save_prefs();
     $e107cache->clear("nq_bdaymenu");
    $bday_msg =  BDAY_ADMIN_A5;
}

$text .= "
<form method='post' action='" . e_SELF . "?update' id='confbday'>
	<table style='" . ADMIN_WIDTH . "' class='fborder' >";
$text .= "
		<tr>
			<td class='fcaption' colspan='2'>" . BDAY_ADMIN_A1 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2'><b>" . $bday_msg . "</b>&nbsp;</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . BDAY_ADMIN_A2 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type = 'text' class = 'tbox' name = 'bday_numdue' value = '" . $tp->toFORM($pref['bday_numdue']) . "' />
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . BDAY_ADMIN_A12 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type = 'checkbox' class = 'tbox' name = 'bday_showage' value = '1' ".($pref['bday_showage'] == "1"?" checked='checked' ":"")." />
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . BDAY_ADMIN_A51 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type = 'checkbox' class = 'tbox' name = 'bday_avatar' value = '1' ".($pref['bday_avatar'] == "1"?" checked='checked' ":"")." />
			</td>
		</tr>

		<tr>
			<td style='width:30%' class='forumheader3'>" . BDAY_ADMIN_A52 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type = 'text' size='8' class = 'tbox' name = 'bday_avwidth' value = '" . $tp->toFORM($pref['bday_avwidth']) . "' /> px
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . BDAY_ADMIN_A64 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("bday_demographic", $pref['bday_demographic'], "off", 'public,nobody,member,admin, classes') . "</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . BDAY_ADMIN_A50 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type = 'checkbox' class = 'tbox' name = 'bday_showdate' value = '1' ".($pref['bday_showdate'] == "1"? " checked='checked' ":"")." />
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . BDAY_ADMIN_A4 . "</td>
			<td style='width:70%' class='forumheader3'>
				<select name='bday_dformat' class='tbox'>
					<option value='0' ".($pref['bday_dformat']==0?"selected='selected'":"")." >d M</option>
					<option value='1' ".($pref['bday_dformat']==1?"selected='selected'":"")." >d M Y</option>
					<option value='2' ".($pref['bday_dformat']==2?"selected='selected'":"")." >M d</option>
					<option value='3' ".($pref['bday_dformat']==3?"selected='selected'":"")." >M d Y</option>
					<option value='4' ".($pref['bday_dformat']==4?"selected='selected'":"")." >Y M d</option>

					<option value='5' ".($pref['bday_dformat']==5?"selected='selected'":"")." >d mmm Y</option>
					<option value='6' ".($pref['bday_dformat']==6?"selected='selected'":"")." >d MMM Y</option>
					<option value='7' ".($pref['bday_dformat']==7?"selected='selected'":"")." >mmm d Y</option>
					<option value='8' ".($pref['bday_dformat']==8?"selected='selected'":"")." >MMM d Y</option>

					<option value='9' ".($pref['bday_dformat']==9?"selected='selected'":"")." >dth mmm Y</option>
					<option value='10' ".($pref['bday_dformat']==10?"selected='selected'":"")." >dth MMM Y</option>
					<option value='11' ".($pref['bday_dformat']==11?"selected='selected'":"")." >mmm dth Y</option>
					<option value='12' ".($pref['bday_dformat']==12?"selected='selected'":"")." >MMM dth Y</option>

					<option value='13' ".($pref['bday_dformat']==13?"selected='selected'":"")." >d mmm </option>
					<option value='14' ".($pref['bday_dformat']==14?"selected='selected'":"")." >d MMM </option>
					<option value='15' ".($pref['bday_dformat']==15?"selected='selected'":"")." >mmm d </option>
					<option value='16' ".($pref['bday_dformat']==16?"selected='selected'":"")." >MMM d </option>

					<option value='17' ".($pref['bday_dformat']==17?"selected='selected'":"")." >dth mmm </option>
					<option value='18' ".($pref['bday_dformat']==18?"selected='selected'":"")." >dth MMM </option>
					<option value='19' ".($pref['bday_dformat']==19?"selected='selected'":"")." >mmm dth </option>
					<option value='20' ".($pref['bday_dformat']==20?"selected='selected'":"")." >MMM dth </option>
		 		</select>
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . BDAY_ADMIN_A8 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type = 'checkbox' class = 'tbox' name = 'bday_sendemail' value = '1' ".($pref['bday_sendemail'] == "1"?" checked='checked' ":"")." />
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . BDAY_ADMIN_A7 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type = 'text' size='30' class = 'tbox' name = 'bday_emailfrom' value = '" . $tp->toFORM($pref['bday_emailfrom']) . "' />
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . BDAY_ADMIN_A10 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type = 'text' size='30' class = 'tbox' name = 'bday_subject' value = '" . $tp->toFORM($pref['bday_subject']) . "' />
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . BDAY_ADMIN_A11 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type = 'text' size='30' class = 'tbox' name = 'bday_emailaddr' value = '" . $tp->toFORM($pref['bday_emailaddr']) . "' />
			</td>
		</tr>
		<tr>
			<td  style='width:30%;vertical-align:top;' class='forumheader3'>" . BDAY_ADMIN_A9 . "</td>
			<td style='width:70%' class='forumheader3'>
				<textarea class = 'tbox' name = 'bday_greeting' rows='6' cols='70' >" . $tp->toFORM($pref['bday_greeting']) . "</textarea>
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . BDAY_ADMIN_A35 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("bday_showclass", $pref['bday_showclass'], "off", 'public,nobody,member,admin, classes') . "</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . BDAY_ADMIN_A41 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("bday_exclude", $pref['bday_exclude'], "off", "nobody,admin,classes") . "</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . BDAY_ADMIN_A40 . "</td>
			<td style='width:70%' class='forumheader3'><input type='checkbox' class='tbox' value='1' name='bday_usecss' " . ($pref['bday_usecss'] > 0?"checked='checked'":"") . " /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . BDAY_ADMIN_A38 . "</td>
			<td style='width:70%' class='forumheader3'><input type='checkbox' class='tbox' value='1' name='bday_usepm' " . ($pref['bday_usepm'] > 0?"checked='checked'":"") . " /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . BDAY_ADMIN_A39 . "</td>
			<td style='width:70%' class='forumheader3'>
				<select class='tbox' name='bday_pmfrom'>";
// Sort out admin/main admin class in selection
if ($sql->db_Select("user", "user_id,user_name", "nowhere", false))
{
    while ($autoassign_row = $sql->db_Fetch())
    {
        extract($autoassign_row);
        $text .= "<option value='$user_id' " . ($user_id == $pref['bday_pmfrom']?"selected='selected'":"") . ">" . $tp->toFORM($user_name) . "</option>";
    } // while
}
else
{
    $text .= "<option value='0' >Select admin class and save first</option>";
}
// Submit button
$text .= "
				</select>
			</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2' style='text-align:left;'><input type='submit' name='update' value='" . BDAY_ADMIN_A3 . "' class='button' /></td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2'>&nbsp;</td>
		</tr>
	</table>
</form>";
$ns->tablerender($caption, $text);
require_once(e_ADMIN . "footer.php");
