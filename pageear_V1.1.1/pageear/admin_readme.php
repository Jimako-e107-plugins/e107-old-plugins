<?php
// **************************************************************************
// *
// *  pageear for e107 v7xx
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
include_lan(e_PLUGIN . "pageear/languages/readme/" . e_LANGUAGE . ".php");
require_once(e_PLUGIN . "pageear/plugin.php");
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
$pageear_text = "
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2'>" . $eplug_name . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . PAGEEAR_R02 . "</td>
		<td class='forumheader3'>" . $eplug_name . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . PAGEEAR_R04 . "</td>
		<td class='forumheader3'>" . $eplug_author . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . PAGEEAR_R06 . "</td>
		<td class='forumheader3'>" . $eplug_version . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . PAGEEAR_R08 . "</td>
		<td class='forumheader3'>" . PAGEEAR_R09 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . PAGEEAR_R10 . "</td>
		<td class='forumheader3'>" . PAGEEAR_R11 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . PAGEEAR_R12 . "</td>
		<td class='forumheader3'>" . PAGEEAR_R13 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . PAGEEAR_R14 . "</td>
		<td class='forumheader3'>" . PAGEEAR_R15 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . PAGEEAR_R16 . "</td>
		<td class='forumheader3'>" . PAGEEAR_R17 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . PAGEEAR_R25 . "</td>
		<td class='forumheader3'><span style='color:#ff4444;'>" . PAGEEAR_R24 . "</span></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
		<strong>" . PAGEEAR_R18 . "</strong><br /><br />" . PAGEEAR_R19 . "<br /><br />
		<strong>" . PAGEEAR_R20 . "</strong><br /><br />" . PAGEEAR_R21 . "<br /><br />
		<strong>" . PAGEEAR_R22 . "</strong><br /><br />" . PAGEEAR_R23 . "
		</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";
// readme;
$ns->tablerender($eplug_name, $pageear_text);
require_once(e_ADMIN . "footer.php");

?>