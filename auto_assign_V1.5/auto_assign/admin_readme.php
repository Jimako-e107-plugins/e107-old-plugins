<?php
/*
+---------------------------------------------------------------+
|	Auto Assign Plugin for e107
|
|	Copyright (C) Father Barry Keal 2003 - 2008
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
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
include_lan(e_PLUGIN . "auto_assign/languages/readme/" . e_LANGUAGE . ".php");
require_once("plugin.php");
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
$welcome_text = "
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2'>" . AUTOASSIGN_R01 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . AUTOASSIGN_R02 . "</td>
		<td class='forumheader3'>" .$eplug_name . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . AUTOASSIGN_R04 . "</td>
		<td class='forumheader3'>" . $eplug_author . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . AUTOASSIGN_R06 . "</td>
		<td class='forumheader3'>" .$eplug_version . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . AUTOASSIGN_R08 . "</td>
		<td class='forumheader3'>" . AUTOASSIGN_R09 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . AUTOASSIGN_R10 . "</td>
		<td class='forumheader3'>" . AUTOASSIGN_R11 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . AUTOASSIGN_R12 . "</td>
		<td class='forumheader3'>" . AUTOASSIGN_R13 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . AUTOASSIGN_R14 . "</td>
		<td class='forumheader3'>" . AUTOASSIGN_R15 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . AUTOASSIGN_R16 . "</td>
		<td class='forumheader3'>" . AUTOASSIGN_R17 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . AUTOASSIGN_R25 . "</td>
		<td class='forumheader3'><span style='color:#ff4444;'>" . AUTOASSIGN_R24 . "</span></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
		<strong>" . AUTOASSIGN_R18 . "</strong><br /><br />" . AUTOASSIGN_R19 . "<br /><br />
		<strong>" . AUTOASSIGN_R20 . "</strong><br /><br />" . AUTOASSIGN_R21 . "<br /><br />
		<strong>" . AUTOASSIGN_R22 . "</strong><br /><br />" . AUTOASSIGN_R23 . "
		</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";
// readme;
$ns->tablerender($eplug_name, $welcome_text);
require_once(e_ADMIN . "footer.php");

?>