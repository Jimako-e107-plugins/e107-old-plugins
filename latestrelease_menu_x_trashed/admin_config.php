<?php
/*
+---------------------------------------------------------------+
|        Latest Release Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
// Show the ADMIN header and the menu on the left.==============================
require_once("../../class2.php");
if (!getperms("P"))
{
    header("location:" . e_BASE . "index.php");
}
if (!defined('e107_INIT'))
{
    exit;
}
if (!is_object($latedl_obj))
{
    require_once(e_PLUGIN . 'latestrelease_menu/includes/latest_release_class.php');
    $latedl_obj = new latestrelease;
}

require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
// GET LANG FILE
include_lan(e_PLUGIN . "latestrelease_menu/languages/" . e_LANGUAGE . ".php");
// End of the Header.===========================================================
if (isset($_POST['updatesettings']))
{
    $LATESTRELEASE_PREF['latedl_limitdown'] = intval($_POST['latedl_limitdown']);
    $LATESTRELEASE_PREF['latedl_maxchars'] = intval($_POST['latedl_maxchars']);
    $LATESTRELEASE_PREF['latedl_down_allow_description'] = intval($_POST['latedl_down_allow_description']);
    $LATESTRELEASE_PREF['latedl_dlcat'] = intval($_POST['latedl_dlcat']);
    $LATESTRELEASE_PREF['latedl_dlbutton'] = intval($_POST['latedl_dlbutton']);
    $LATESTRELEASE_PREF['latedl_dlsize'] = intval($_POST['latedl_dlsize']);
    $LATESTRELEASE_PREF['latedl_dlauth'] = intval($_POST['latedl_dlauth']);
    $LATESTRELEASE_PREF['latedl_dlcount'] = intval($_POST['latedl_dlcount']);
    $LATESTRELEASE_PREF['latedl_dlstamp'] = intval($_POST['latedl_dlstamp']);
    $LATESTRELEASE_PREF['latedl_dp'] = $tp->toDB($_POST['latedl_dp']);
    $LATESTRELEASE_PREF['latedl_thou'] = $tp->toDB($_POST['latedl_thou']);
    $LATESTRELEASE_PREF['latedl_expand'] = intval($_POST['latedl_expand']);
    $LATESTRELEASE_PREF['latedl_thou'] = (empty($LATESTRELEASE_PREF['latedl_thou'])?",":$LATESTRELEASE_PREF['latedl_thou']);
    $LATESTRELEASE_PREF['latedl_dp'] = (empty($LATESTRELEASE_PREF['latedl_dp'])?".":$LATESTRELEASE_PREF['latedl_dp']);
    $LATESTRELEASE_PREF['latedl_class'] = (empty($LATESTRELEASE_PREF['latedl_class'])?"forumheader3":$LATESTRELEASE_PREF['latedl_class']);
    $LATESTRELEASE_PREF['latedl_top'] = intval($_POST['latedl_top']);

    $latedl_obj->save_prefs();
    $e107cache->clear("nq_latestrel");
    $latedl_message = "<tr><td class='forumheader3' colspan='2'><strong>" . LATESTRELEASE_MENU_LAN_24 . "</strong></td></tr>";
}

$latedl_limitdown = $LATESTRELEASE_PREF['latedl_limitdown'];
$latedl_maxchars = $LATESTRELEASE_PREF['latedl_maxchars'];
$latedl_down_allow_description = $LATESTRELEASE_PREF['latedl_down_allow_description'];

$latedl_text = "
<div style='text-align:center'>
	<form method='post' action='" . e_SELF . "' id='latestdlform'>
		<table style='" . ADMIN_WIDTH . "' class='fborder'>
			<tr style='vertical-align:top'>
				<td colspan='2'  style='text-align:left' class='fcaption'>" . LATESTRELEASE_MENU_LAN_23 . "</td>
			</tr>$latedl_message
			<tr>
				<td style='width:40%' align='left' class='forumheader3'>" . LATESTRELEASE_MENU_LAN_22 . "</td>
				<td style='width:60%' align='left' class='forumheader3'>
					<input class='tbox' type='text' name='latedl_limitdown' value='" . $latedl_limitdown . "' />
				</td>
			</tr>
			<tr>
				<td style='width:40%' align='left' class='forumheader3'>" . LATESTRELEASE_MENU_LAN_21 . " </td>
				<td style='width:60%' align='left' class='forumheader3'>
					<input class='tbox' type='text' name='latedl_maxchars' value='" . $latedl_maxchars . "' />
				</td>
			</tr>
						<tr>
				<td style='width:40%' class='forumheader3'>" . LATESTRELEASE_MENU_LAN_47 . ":</td>
				<td style='width:60%' class='forumheader3'>
					<input name='latedl_dlcat' type='radio' value='0' " . ($LATESTRELEASE_PREF['latedl_dlcat'] <> 1?" checked='checked' ":"") . " />" . LATESTRELEASE_MENU_LAN_16 . "&nbsp;&nbsp;
					<input name='latedl_dlcat' type='radio' value='1' " . ($LATESTRELEASE_PREF['latedl_dlcat'] == 1?" checked='checked' ":"") . " />" . LATESTRELEASE_MENU_LAN_17 . "
 				</td>
 			</tr>
			<tr>
				<td style='width:40%' class='forumheader3'>" . LATESTRELEASE_MENU_LAN_27 . ":</td>
				<td style='width:60%' class='forumheader3'>
					<input name='latedl_dlauth' type='radio' value='0' " . ($LATESTRELEASE_PREF['latedl_dlauth'] <> 1?" checked='checked' ":"") . " />" . LATESTRELEASE_MENU_LAN_16 . "&nbsp;&nbsp;
					<input name='latedl_dlauth' type='radio' value='1' " . ($LATESTRELEASE_PREF['latedl_dlauth'] == 1?" checked='checked' ":"") . " />" . LATESTRELEASE_MENU_LAN_17 . "
 				</td>
 			</tr>
			<tr>
				<td style='width:40%' class='forumheader3'>" . LATESTRELEASE_MENU_LAN_18 . ":</td>
				<td style='width:60%' class='forumheader3'>
					<input name='latedl_down_allow_description' type='radio' value='0' " . ($LATESTRELEASE_PREF['latedl_down_allow_description'] <> 1?" checked='checked' ":"") . " />" . LATESTRELEASE_MENU_LAN_16 . "&nbsp;&nbsp;
					<input name='latedl_down_allow_description' type='radio' value='1' " . ($LATESTRELEASE_PREF['latedl_down_allow_description'] == 1?" checked='checked' ":"") . " />" . LATESTRELEASE_MENU_LAN_17 . "
 				</td>
			</tr>
			<tr>
				<td style='width:40%' class='forumheader3'>" . LATESTRELEASE_MENU_LAN_25 . ":</td>
				<td style='width:60%' class='forumheader3'>
					<input name='latedl_dlbutton' type='radio' value='0' " . ($LATESTRELEASE_PREF['latedl_dlbutton'] <> 1?" checked='checked' ":"") . " />" . LATESTRELEASE_MENU_LAN_16 . "&nbsp;&nbsp;
					<input name='latedl_dlbutton' type='radio' value='1' " . ($LATESTRELEASE_PREF['latedl_dlbutton'] == 1?" checked='checked' ":"") . " />" . LATESTRELEASE_MENU_LAN_17 . "
 				</td>
			</tr>
			<tr>
				<td style='width:40%' class='forumheader3'>" . LATESTRELEASE_MENU_LAN_26 . ":</td>
				<td style='width:60%' class='forumheader3'>
					<input name='latedl_dlsize' type='radio' value='0' " . ($LATESTRELEASE_PREF['latedl_dlsize'] <> 1?" checked='checked' ":"") . " />" . LATESTRELEASE_MENU_LAN_16 . "&nbsp;&nbsp;
					<input name='latedl_dlsize' type='radio' value='1' " . ($LATESTRELEASE_PREF['latedl_dlsize'] == 1?" checked='checked' ":"") . " />" . LATESTRELEASE_MENU_LAN_17 . "
 				</td>
			</tr>

			<tr>
				<td style='width:40%' class='forumheader3'>" . LATESTRELEASE_MENU_LAN_19 . ":</td>
				<td style='width:60%' class='forumheader3'>
					<input name='latedl_dlcount' type='radio' value='0' " . ($LATESTRELEASE_PREF['latedl_dlcount'] <> 1?" checked='checked' ":"") . " />" . LATESTRELEASE_MENU_LAN_16 . "&nbsp;&nbsp;
					<input name='latedl_dlcount' type='radio' value='1' " . ($LATESTRELEASE_PREF['latedl_dlcount'] == 1?" checked='checked' ":"") . " />" . LATESTRELEASE_MENU_LAN_17 . "
 				</td>
			</tr>
			<tr>
				<td style='width:40%' class='forumheader3'>" . LATESTRELEASE_MENU_LAN_28 . ":</td>
				<td style='width:60%' class='forumheader3'>
					<input name='latedl_dlstamp' type='radio' value='0' " . ($LATESTRELEASE_PREF['latedl_dlstamp'] <> 1?" checked='checked' ":"") . " />" . LATESTRELEASE_MENU_LAN_16 . "&nbsp;&nbsp;
					<input name='latedl_dlstamp' type='radio' value='1' " . ($LATESTRELEASE_PREF['latedl_dlstamp'] == 1?" checked='checked' ":"") . " />" . LATESTRELEASE_MENU_LAN_17 . "
 				</td>
			</tr>
			<tr>
				<td style='width:40%' align='left' class='forumheader3'>" . LATESTRELEASE_MENU_LAN_31 . "</td>
				<td style='width:60%' align='left' class='forumheader3'>
					<input class='tbox' type='text' name='latedl_dp' value='" . $tp->toFORM($LATESTRELEASE_PREF['latedl_dp']) . "' />
				</td>
			</tr>
			<tr>
				<td style='width:40%' align='left' class='forumheader3'>" . LATESTRELEASE_MENU_LAN_32 . "</td>
				<td style='width:60%' align='left' class='forumheader3'>
					<input class='tbox' type='text' name='latedl_thou' value='" . $tp->toFORM($LATESTRELEASE_PREF['latedl_thou']) . "' />
				</td>
			</tr>
			<tr>
				<td style='width:40%' align='left' class='forumheader3'>" . LATESTRELEASE_MENU_LAN_33 . "</td>
				<td style='width:60%' align='left' class='forumheader3'>
					<input class='tbox' size='30' type='text' name='latedl_class' value='" . $LATESTRELEASE_PREF['latedl_class'] . "' />
				</td>
			</tr>
			<tr>
				<td style='width:40%' align='left' class='forumheader3'>" . LATESTRELEASE_MENU_LAN_44 . "</td>
				<td style='width:60%' align='left' class='forumheader3'>
					<input class='tbox' size='30' type='text' name='latedl_top' value='" . $LATESTRELEASE_PREF['latedl_top'] . "' />
				</td>
			</tr>
			<tr>
				<td style='width:40%' align='left' class='forumheader3'>" . LATESTRELEASE_MENU_LAN_37 . "</td>
				<td style='width:60%' align='left' class='forumheader3'>
					<input class='tbox' type='checkbox' name='latedl_expand' value='1' " . ($LATESTRELEASE_PREF['latedl_expand'] > 0?"checked='checked'":"") . "' />
				</td>
			</tr>
			<tr style='vertical-align:top'>
				<td colspan='2'  style='text-align:left' class='fcaption'>
					<input class='button' type='submit' name='updatesettings' value='" . LATESTRELEASE_MENU_LAN_20 . "' />
				</td>
			</tr>

		</table>
	</form>
</div>";

$ns->tablerender(LATESTRELEASE_MENU_LAN_23, $latedl_text);

require_once(e_ADMIN . "footer.php");
