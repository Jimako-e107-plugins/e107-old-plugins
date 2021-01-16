<?php
// **************************************************************************
// *
// *  googletranslate for e107 v7xx
// *
// **************************************************************************
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
include_lan(e_PLUGIN . "googletranslate_menu/languages/readme/" . e_LANGUAGE . ".php");
require_once(e_PLUGIN . "googletranslate_menu/plugin.php");
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
$GTRANS_text = "
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2'>" . $eplug_name . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . GTRANS_R02 . "</td>
		<td class='forumheader3'>" . $eplug_name . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . GTRANS_R04 . "</td>
		<td class='forumheader3'>" . $eplug_author . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . GTRANS_R06 . "</td>
		<td class='forumheader3'>" . $eplug_version . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . GTRANS_R08 . "</td>
		<td class='forumheader3'>" . GTRANS_R09 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . GTRANS_R10 . "</td>
		<td class='forumheader3'>" . GTRANS_R11 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . GTRANS_R12 . "</td>
		<td class='forumheader3'>" . GTRANS_R13 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . GTRANS_R14 . "</td>
		<td class='forumheader3'>" . GTRANS_R15 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . GTRANS_R16 . "</td>
		<td class='forumheader3'>" . GTRANS_R17 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . GTRANS_R25 . "</td>
		<td class='forumheader3'><span style='color:#ff4444;'>" . GTRANS_R24 . "</span></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
		<strong>" . GTRANS_R18 . "</strong><br /><br />" . GTRANS_R19 . "<br /><br />
		<strong>" . GTRANS_R20 . "</strong><br /><br />" . GTRANS_R21 . "<br /><br />
		<strong>" . GTRANS_R22 . "</strong><br /><br />" . GTRANS_R23 . "
		</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";
// readme;
$ns->tablerender($eplug_name, $GTRANS_text);
require_once(e_ADMIN . "footer.php");

?>