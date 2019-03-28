<?php
// **************************************************************************
// *
// *  FAQ for e107 v7xx
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
include_lan(e_PLUGIN . "faq/languages/readme/" . e_LANGUAGE . ".php");
require_once("plugin.php");
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
$welcome_text = "
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2'>" . FAQ_R01 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . FAQ_R02 . "</td>
		<td class='forumheader3'>" .$eplug_name . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . FAQ_R04 . "</td>
		<td class='forumheader3'>" . $eplug_author . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . FAQ_R06 . "</td>
		<td class='forumheader3'>" .$eplug_version . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . FAQ_R08 . "</td>
		<td class='forumheader3'>" . FAQ_R09 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . FAQ_R10 . "</td>
		<td class='forumheader3'>" . FAQ_R11 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . FAQ_R12 . "</td>
		<td class='forumheader3'>" . FAQ_R13 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . FAQ_R14 . "</td>
		<td class='forumheader3'>" . FAQ_R15 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . FAQ_R16 . "</td>
		<td class='forumheader3'>" . FAQ_R17 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . FAQ_R25 . "</td>
		<td class='forumheader3'><span style='color:#ff4444;'>" . FAQ_R24 . "</span></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
		<strong>" . FAQ_R18 . "</strong><br /><br />" . FAQ_R19 . "<br /><br />
		<strong>" . FAQ_R20 . "</strong><br /><br />" . FAQ_R21 . "<br /><br />
		<strong>" . FAQ_R22 . "</strong><br /><br />" . FAQ_R23 . "
		</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";
// readme;
$ns->tablerender(FAQ_R01, $welcome_text);
require_once(e_ADMIN . "footer.php");

?>