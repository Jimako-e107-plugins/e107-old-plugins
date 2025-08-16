<?php
// **************************************************************************
// *
// *  Newslinks for e107 v7xx
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
include_lan(e_PLUGIN . "newslink/languages/readme/" . e_LANGUAGE . ".php");
require_once(e_PLUGIN . "newslink/plugin.php");
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
$REVIEWER_text = "
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2'>" . $eplug_name . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . NEWSLINK_R02 . "</td>
		<td class='forumheader3'>" . $eplug_name . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . NEWSLINK_R04 . "</td>
		<td class='forumheader3'>" . $eplug_author . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . NEWSLINK_R06 . "</td>
		<td class='forumheader3'>" . $eplug_version . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . NEWSLINK_R08 . "</td>
		<td class='forumheader3'>" . NEWSLINK_R09 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . NEWSLINK_R10 . "</td>
		<td class='forumheader3'>" . NEWSLINK_R11 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . NEWSLINK_R12 . "</td>
		<td class='forumheader3'>" . NEWSLINK_R13 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . NEWSLINK_R14 . "</td>
		<td class='forumheader3'>" . NEWSLINK_R15 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . NEWSLINK_R16 . "</td>
		<td class='forumheader3'>" . NEWSLINK_R17 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . NEWSLINK_R25 . "</td>
		<td class='forumheader3'><span style='color:#ff4444;'>" . NEWSLINK_R24 . "</span></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
		<strong>" . NEWSLINK_R18 . "</strong><br /><br />" . NEWSLINK_R19 . "<br /><br />
		<strong>" . NEWSLINK_R20 . "</strong><br /><br />" . NEWSLINK_R21 . "<br /><br />
		<strong>" . NEWSLINK_R22 . "</strong><br /><br />" . NEWSLINK_R23 . "
		</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";
// readme;
$ns->tablerender($eplug_name, $REVIEWER_text);
require_once(e_ADMIN . "footer.php");

?>