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
include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '_admin_gold_system.php');
if (isset($_POST['updatesettings']))
{
    // save settings
    // menu options
    #$GOLD_PREF['gold_mshop'] = intval($_POST['gold_mshop']);
    $GOLD_PREF['gold_mbuy'] = intval($_POST['gold_mbuy']);
    $GOLD_PREF['gold_mdonate'] = intval($_POST['gold_mdonate']);
    $GOLD_PREF['gold_mhistory'] = intval($_POST['gold_mhistory']);
    $GOLD_PREF['gold_msummary'] = intval($_POST['gold_msummary']);
    $GOLD_PREF['gold_mrichest'] = intval($_POST['gold_mrichest']);
    $GOLD_PREF['gold_showpresent'] = intval($_POST['gold_showpresent']);
    $GOLD_PREF['gold_expanding'] = intval($_POST['gold_expanding']);
    $gold_obj->save_prefs();
}

$gold_text = '
<form method="post" action="' . e_SELF . '" id="dataform" >
	<table class="fborder" style="' . ADMIN_WIDTH . '">
	<tr>
		<td class="fcaption" colspan="2" style="text-align:left">' . ADLAN_GS_MS01 . '</td>
	</tr>
		<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_MS12 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="checkbox" class="tbox" name="gold_expanding" value="1" ' . ($GOLD_PREF["gold_expanding"] == 1?'checked="checked"':'') . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_MS13 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="checkbox" class="tbox" name="gold_showpresent" value="1" ' . ($GOLD_PREF["gold_showpresent"] == 1?'checked="checked"':'') . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_MS04 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="checkbox" class="tbox" name="gold_mdonate" value="1" ' . ($GOLD_PREF["gold_mdonate"] == 1?'checked="checked"':'') . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_MS05 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="checkbox" class="tbox" name="gold_mbuy" value="1" ' . ($GOLD_PREF["gold_mbuy"] == 1?'checked="checked"':'') . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_MS06 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="checkbox" class="tbox" name="gold_mhistory" value="1" ' . ($GOLD_PREF["gold_mhistory"] == 1?'checked="checked"':'') . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_MS09 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="checkbox" class="tbox" name="gold_msummary" value="1" ' . ($GOLD_PREF["gold_msummary"] == 1?'checked="checked"':'') . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_MS10 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_mrichest" style="width:30px;" value="'.$GOLD_PREF["gold_mrichest"].'" />
		</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="2" style="text-align:left">
			<input type="submit" class="button" name="updatesettings" value="' . ADLAN_GS_MS02 . '" />
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