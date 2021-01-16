<?php
/*
+---------------------------------------------------------------+
|        e_Version for e107 v7xx - by Father Barry
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
include_lan(e_PLUGIN . "e_version/languages/readme/" . e_LANGUAGE . ".php");
require_once(e_PLUGIN . "e_version/plugin.php");
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%");
}
$articulate_text="
<table class='fborder'  style='".ADMIN_WIDTH."' >
	<tr>
		<td class='fcaption' colspan='2'>".EVERSION_R01."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".EVERSION_R02."</td>
		<td class='forumheader3'>".$eplug_name."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".EVERSION_R04."</td>
		<td class='forumheader3'>".$eplug_author."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".EVERSION_R06."</td>
		<td class='forumheader3'>".$eplug_version."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".EVERSION_R08."</td>
		<td class='forumheader3'>".EVERSION_R09."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".EVERSION_R10."</td>
		<td class='forumheader3'>".EVERSION_R11."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".EVERSION_R12."</td>
		<td class='forumheader3'>".EVERSION_R13."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".EVERSION_R14."</td>
		<td class='forumheader3'>".EVERSION_R15."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".EVERSION_R16."</td>
		<td class='forumheader3'>".EVERSION_R17."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . EVERSION_R25 . "</td>
		<td class='forumheader3'><span style='color:#ff4444;'>" . EVERSION_R24 . "</span></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
		<strong>".EVERSION_R18."</strong><br /><br />".EVERSION_R19."<br /><br />
		<strong>".EVERSION_R20."</strong><br /><br />".EVERSION_R21."<br /><br />
		<strong>".EVERSION_R22."</strong><br /><br />".EVERSION_R23."
		</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";

#readme;


$ns->tablerender(EVERSION_A2, $articulate_text);

require_once(e_ADMIN . "footer.php");


?>