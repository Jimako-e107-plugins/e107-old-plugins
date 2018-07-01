<?php
// ***************************************************************
// *
// *		Title		:	Delete Me
// *
// *		Author		:	Barry Keal
// *
// *		Date		:	10 September 2004
// *
// *		Version		:	1.04
// *
// *		Description	: 	Utility to allow users to delete their own account
// *
// *		Revisions	:
// *
// ***************************************************************
/*
+---------------------------------------------------------------+
|       Delete Me for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
}
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
require_once(e_HANDLER . "userclass_class.php");
include_lan(e_PLUGIN . "deleteme/languages/admin/" . e_LANGUAGE . ".php");
$deleteme_msg = "";
if (e_QUERY == "update")
{
    // Update rest
    $pref['deleteme_userclass'] = intval($_POST['deleteme_userclass']);
    $pref['deleteme_useseccode'] = intval($_POST['deleteme_useseccode']);
    $pref['deleteme_confirmemail'] = intval($_POST['deleteme_confirmemail']);
    $pref['deleteme_survey'] = intval($_POST['deleteme_survey']);
    $pref['deleteme_perpage'] = intval($_POST['deleteme_perpage']);
    save_prefs();
    $deleteme_msg .= DELETEME_A8 ;
}

$deleteme_text .= "
<form method='post' action='" . e_SELF . "?update' id = 'deleteme'>
	<table class='fborder' style='" . ADMIN_WIDTH . "' >
		<tr>
			<td class='fcaption' colspan='2' >" . DELETEME_A7 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2' ><strong>" . $deleteme_msg . "</strong>&nbsp;</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>" . DELETEME_A9 . "</td><td class='forumheader3'>" . r_userclass("deleteme_userclass", $pref['deleteme_userclass'],"off","nobody,member,classes") . "</td>
		</tr>";
// Use security code
$deleteme_text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>" . DELETEME_A10 . " :</td>
			<td class='forumheader3'>
				<input type='checkbox' name='deleteme_useseccode' value='1'" . ($pref['deleteme_useseccode'] == 1?" checked='checked'":"") . " class='tbox' />
			</td>
		</tr>";
// Send confirmation email to user
$deleteme_text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>" . DELETEME_A11 . " :</td>
			<td class='forumheader3'>
				<input type='checkbox' name='deleteme_confirmemail' value='1'" . ($pref['deleteme_confirmemail'] == 1?" checked='checked'":"") . " class='tbox' />
			</td>
		</tr>";
// Ask why left
$deleteme_text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>" . DELETEME_A12 . " :</td>
			<td class='forumheader3'>
				<input type='checkbox' name='deleteme_survey' value='1'" . ($pref['deleteme_survey'] == 1?" checked='checked'":"") . " class='tbox' />
			</td>
		</tr>";
// Records per page
$deleteme_text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>" . DELETEME_A13 . " :</td>
			<td class='forumheader3'>
				<input type='text' size = '4' name='deleteme_perpage' value = '" . $pref['deleteme_perpage'] . "' class='tbox' />
			</td>
		</tr>";
// Submit button
$deleteme_text .= "
		<tr>
			<td colspan='2' style='text - align: left;' class = 'fcaption'><input type='submit' name='update' value='" . DELETEME_A14 . "' class='tbox' /></td>
		</tr>
	</table>
</form>";

$ns->tablerender(DELETEME_A7, $deleteme_text);

require_once(e_ADMIN . "footer.php");

?>