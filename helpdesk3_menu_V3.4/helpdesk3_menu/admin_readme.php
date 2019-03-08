<?php
// **************************************************************************
// *
// *  Helpdesk for e107 v7xx
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
include_lan(e_PLUGIN . "helpdesk3_menu/languages/readme/" . e_LANGUAGE . "_helpdesk_readme.php");
require_once(e_PLUGIN . "helpdesk3_menu/plugin.php");
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
$HDU_text = "
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2'>" . $eplug_name . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . HDU_R02 . "</td>
		<td class='forumheader3'>" . $eplug_name . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . HDU_R04 . "</td>
		<td class='forumheader3'>" . $eplug_author . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . HDU_R06 . "</td>
		<td class='forumheader3'>" . $eplug_version . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . HDU_R08 . "</td>
		<td class='forumheader3'>" . HDU_R09 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . HDU_R10 . "</td>
		<td class='forumheader3'>" . HDU_R11 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . HDU_R12 . "</td>
		<td class='forumheader3'>" . HDU_R13 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . HDU_R14 . "</td>
		<td class='forumheader3'>" . HDU_R15 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . HDU_R16 . "</td>
		<td class='forumheader3'>" . HDU_R17 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . HDU_R25 . "</td>
		<td class='forumheader3'><span style='color:#ff4444;'>" . HDU_R24 . "</span></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
		<strong>" . HDU_R18 . "</strong><br /><br />" . HDU_R19 . "<br /><br />
		<strong>" . HDU_R20 . "</strong><br /><br />" . HDU_R21 . "<br /><br />
		<strong>" . HDU_R22 . "</strong><br /><br />" . HDU_R23 . "
		</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";
// readme;
$ns->tablerender($eplug_name, $HDU_text);
require_once(e_ADMIN . "footer.php");

?>