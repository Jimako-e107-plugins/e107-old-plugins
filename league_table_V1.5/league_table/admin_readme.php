<?php
// **************************************************************************
// *
// *  League Table for e107 v7xx
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
include_lan(e_PLUGIN . "league_table/languages/readme/" . e_LANGUAGE . ".php");
require_once(e_PLUGIN . "league_table/plugin.php");
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
$LEAGUE_text = "
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2'>" . $eplug_name . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . LEAGUE_R02 . "</td>
		<td class='forumheader3'>" . $eplug_name . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . LEAGUE_R04 . "</td>
		<td class='forumheader3'>" . $eplug_author . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . LEAGUE_R06 . "</td>
		<td class='forumheader3'>" . $eplug_version . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . LEAGUE_R08 . "</td>
		<td class='forumheader3'>" . LEAGUE_R09 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . LEAGUE_R10 . "</td>
		<td class='forumheader3'>" . LEAGUE_R11 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . LEAGUE_R12 . "</td>
		<td class='forumheader3'>" . LEAGUE_R13 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . LEAGUE_R14 . "</td>
		<td class='forumheader3'>" . LEAGUE_R15 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . LEAGUE_R16 . "</td>
		<td class='forumheader3'>" . LEAGUE_R17 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . LEAGUE_R25 . "</td>
		<td class='forumheader3'><span style='color:#ff4444;'>" . LEAGUE_R24 . "</span></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
		<strong>" . LEAGUE_R18 . "</strong><br /><br />" . LEAGUE_R19 . "<br /><br />
		<strong>" . LEAGUE_R20 . "</strong><br /><br />" . LEAGUE_R21 . "<br /><br />
		<strong>" . LEAGUE_R22 . "</strong><br /><br />" . LEAGUE_R23 . "
		</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";
// readme;
$ns->tablerender($eplug_name, $LEAGUE_text);
require_once(e_ADMIN . "footer.php");

?>