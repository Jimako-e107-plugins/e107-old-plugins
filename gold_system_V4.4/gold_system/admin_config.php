<?php
/*
+---------------------------------------------------------------+
|        Gold System for e107 v7xx - by Father Barry
|			Based on the original by AznDevil
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
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

require_once(e_HANDLER.'userclass_class.php');
include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '_admin_gold_system.php');
if (isset($_POST['updatesettings']))
{
    $_POST['gold_arcloc'] = trim($_POST['gold_arcloc']);
    if (substr($_POST['gold_arcloc'], -1) == '/' || substr($_POST['gold_arcloc'], -1) == "\\")
    {
        // strip any training slash
        $_POST['gold_arcloc'] = substr($_POST['gold_arcloc'], 0, -1);
    }
    // save settings
    $GOLD_PREF['gold_arcade_type'] = $tp->toDB($_POST['gold_arcade_type']);
    $GOLD_PREF['gold_currency_name'] = $tp->toDB($_POST['gold_currency_name']);
    $GOLD_PREF['gold_currency_decimal'] = intval($_POST['gold_currency_decimal']);
    $GOLD_PREF['gold_currency_abrev'] = $tp->toDB($_POST['gold_currency_abrev']);
    $GOLD_PREF['gold_currency_point'] = $tp->toDB($_POST['gold_currency_point']);
    $GOLD_PREF['gold_currency_thou'] = $tp->toDB($_POST['gold_currency_thou']);
    $GOLD_PREF['gold_currency_formation'] = $tp->toDB($_POST['gold_currency_formation']);
    $GOLD_PREF['gold_starting'] = $tp->toDB($_POST['gold_starting']);
    $GOLD_PREF['gold_chatbox'] = $tp->toDB($_POST['gold_chatbox']);
    $GOLD_PREF['gold_comment'] = $tp->toDB($_POST['gold_comment']);
    $GOLD_PREF['gold_referrer'] = $tp->toDB($_POST['gold_referrer']);
    $GOLD_PREF['gold_linkcost'] = $tp->toDB($_POST['gold_linkcost']);
    $GOLD_PREF['gold_linkaction'] = $tp->toDB($_POST['gold_linkaction']);
    $GOLD_PREF['gold_news'] = $tp->toDB($_POST['gold_news']);
    $GOLD_PREF['gold_score'] = $tp->toDB($_POST['gold_score']);
    $GOLD_PREF['gold_visit'] = $tp->toDB($_POST['gold_visit']);
    $GOLD_PREF['gold_tarnish'] = $tp->toDB($_POST['gold_tarnish']);
    $GOLD_PREF['gold_tarnishwait'] = intval($_POST['gold_tarnishwait']);
    $GOLD_PREF['gold_tarnishmax'] = intval($_POST['gold_tarnishmax']);
    $GOLD_PREF['gold_numchar'] = intval($_POST['gold_numchar']);
    $GOLD_PREF['gold_usrcost'] = $tp->toDB($_POST['gold_usrcost']);
    $GOLD_PREF['gold_arcloc'] = $tp->toDB($_POST['gold_arcloc']);
    $GOLD_PREF['gold_arcpass'] = $tp->toDB($_POST['gold_arcpass']);
    $GOLD_PREF['gold_exempt_usersettings'] = intval($_POST['gold_exempt_usersettings']);
    $GOLD_PREF['gold_maxdonatepermonth'] = intval($_POST['gold_maxdonatepermonth']);
    $GOLD_PREF['gold_pdftrans'] = intval($_POST['gold_pdftrans']);
    // menu options
    $gold_obj->save_prefs();

    if (!isset($GOLD_PREF['gold_currency_name']))
    {
        $gold_msg = ADLAN_GS_1;
    } elseif (!isset($GOLD_PREF['gold_currency_abrev']))
    {
        $gold_msg = ADLAN_GS_2;
    } elseif (!is_numeric($GOLD_PREF['gold_currency_decimal']))
    {
        $gold_msg = ADLAN_GS_89;
    } elseif (!is_numeric($GOLD_PREF['gold_starting']))
    {
        $gold_msg = ADLAN_GS_3;
    } elseif (!is_numeric($GOLD_PREF['gold_chatbox']))
    {
        $gold_msg = ADLAN_GS_4;
    } elseif (!is_numeric($GOLD_PREF['gold_newthread']))
    {
        $gold_msg = ADLAN_GS_5;
    } elseif (!is_numeric($GOLD_PREF['gold_reply']))
    {
        $gold_msg = ADLAN_GS_6;
    } elseif (!is_numeric($GOLD_PREF['gold_comment']))
    {
        $gold_msg = ADLAN_GS_7;
    } elseif (!is_numeric($GOLD_PREF['gold_referrer']))
    {
        $gold_msg = ADLAN_GS_8;
    }
    else
    {
        $gold_msg = ADLAN_GS_10;
    }
}
// if archive directory specified then check it is writable
if (!empty($GOLD_PREF['gold_arcloc']))
{
    $gold_fp = fopen($GOLD_PREF['gold_arcloc'] . '/index.htm', 'w+');
    if (!$gold_fp)
    {
        $gold_msg .= '<br />Cannot write to archive directory. Check path and permissions.';
    }
}

$gold_text = '
<form method="post" action="' . e_SELF . '" id="dataform" >
	<table class="fborder" style="' . ADMIN_WIDTH . '">
	<tr>
		<td class="fcaption" colspan="2" style="text-align:left">' . ADLAN_GS_C1 . '</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="2" style="text-align:left"><b>' . $gold_msg . '</b>&nbsp;</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_36 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_currency_name" value="' . $GOLD_PREF['gold_currency_name'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_88 . '</td>
		<td class="forumheader3" style="width:70%">
			<select name="gold_currency_decimal" class="tbox">
				<option value="0" ' . ($GOLD_PREF['gold_currency_decimal'] == 0?'selected="selected"':'') . '>0 </option>
				<option value="1" ' . ($GOLD_PREF['gold_currency_decimal'] == 1?'selected="selected"':'') . '>1 </option>
				<option value="2" ' . ($GOLD_PREF['gold_currency_decimal'] == 2?'selected="selected"':'') . '>2 </option>
			</select>
		</td>
	</tr>
		<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_C01 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_currency_point" value="' . $GOLD_PREF['gold_currency_point'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_C02 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_currency_thou" value="' . $GOLD_PREF['gold_currency_thou'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_37 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_currency_abrev" value="' . $GOLD_PREF['gold_currency_abrev'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_67 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="radio" ' . ($GOLD_PREF['gold_currency_formation'] == 'prefix'?'checked="checked"':'') . ' name="gold_currency_formation" class="tbox" value="prefix" /> ' . ADLAN_GS_68 . '<br />
			<input type="radio" ' . ($GOLD_PREF['gold_currency_formation'] != 'prefix'?'checked="checked"':'') . ' name="gold_currency_formation" class="tbox"  value="suffix" /> ' . ADLAN_GS_69 . '
		</td>
	</tr>

	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_C14 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_numchar" value="' . $GOLD_PREF['gold_numchar'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_38 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_starting" value="' . $GOLD_PREF['gold_starting'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_C17 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="radio" ' . ($GOLD_PREF['gold_pdftrans'] == 0?'checked="checked"':'') . ' name="gold_pdftrans" class="tbox" value="0" /> ' . ADLAN_GS_C18 . '<br />
			<input type="radio" ' . ($GOLD_PREF['gold_pdftrans'] == 1?'checked="checked"':'') . ' name="gold_pdftrans" class="tbox" value="1" /> ' . ADLAN_GS_C19 . '
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_C15 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_arcloc" style="width:80%" value="' . $tp->toFORM($GOLD_PREF['gold_arcloc']) . '" /><br />' . ADLAN_GS_C16 . ' <input type="text" class="tbox" name="gold_arcpass" style="width:35%" value="' . $tp->toFORM($GOLD_PREF['gold_arcpass']) . '" />
		</td>
	</tr>
	';
// $gold_text .= '
// <tr>
// <td class="forumheader3" style="width:30%">' . ADLAN_GS_85 . '</td>
// <td class="forumheader3" style="width:70%">
// <input type="radio" name="gold_arcade_type" class="tbox" value="krooze" '.($GOLD_PREF['gold_arcade_type'] == 'krooze'?'checked="checked"':'').'  /> ' . ADLAN_GS_86 . '<br />
// <input type="radio" '.($GOLD_PREF['gold_arcade_type'] != 'krooze'?'checked="checked"':'').' name="gold_arcade_type" class="tbox" value="auto" /> ' . ADLAN_GS_87 . '
// </td>
// </tr>
// <tr>
// <td class="forumheader3" style="width:30%">' . ADLAN_GS_46 . '</td>
// <td class="forumheader3" style="width:70%"><input type="text" class="tbox" name="gold_score" value="' . $GOLD_PREF['gold_score'] . '" /></td>
// </tr>';
$gold_text .= '

	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_39 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_chatbox" value="' . $GOLD_PREF['gold_chatbox'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_42 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_comment" value="' . $GOLD_PREF['gold_comment'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_43 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_referrer" value="' . $GOLD_PREF['gold_referrer'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_44 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_news" value="' . $GOLD_PREF['gold_news'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_C10 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_usrcost" value="' . $GOLD_PREF['gold_usrcost'] . '" />
		</td>
	</tr>
		<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_C13 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_maxdonatepermonth" value="' . $GOLD_PREF['gold_maxdonatepermonth'] . '" />
		</td>
	</tr>
		<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_C03 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="radio" ' . ($GOLD_PREF['gold_linkaction'] == 1?'checked="checked"':'') . ' name="gold_linkaction" class="tbox" value="1" /> ' . ADLAN_GS_C04 . '<br />
			<input type="radio" ' . ($GOLD_PREF['gold_linkaction'] == 0?'checked="checked"':'') . ' name="gold_linkaction" class="tbox" value="0" /> ' . ADLAN_GS_C05 . '
		</td>
	</tr>
		<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_45 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_linkcost" value="' . $GOLD_PREF['gold_linkcost'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="2" style="text-align:left">&nbsp;</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_C06 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_visit" value="' . $GOLD_PREF['gold_visit'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_C08 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_tarnishwait" value="' . $GOLD_PREF['gold_tarnishwait'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_C09 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_tarnishmax" value="' . $GOLD_PREF['gold_tarnishmax'] . '" />
		</td>
	</tr>
		<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_C07 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_tarnish" value="' . $GOLD_PREF['gold_tarnish'] . '" />
		</td>
	</tr>
		<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_C12 . '</td>
		<td class="forumheader3" style="width:70%">' .r_userclass('gold_exempt_usersettings', $GOLD_PREF['gold_exempt_usersettings'], 'off', 'nobody,member,admin,main,classes') . '
		</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="2" style="text-align:left">
			<input type="submit" class="button" name="updatesettings" value="' . ADLAN_GS_18 . '" />
		</td>
	</tr>
	<tr>
		<td class="fcaption" colspan="2" style="text-align:left">&nbsp;</td>
	</tr>
</table>
</form>';
$ns->tablerender(ADLAN_GS, $gold_text);
require_once(e_ADMIN . 'footer.php');

?>