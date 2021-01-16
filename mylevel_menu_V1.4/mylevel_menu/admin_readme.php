<?php
/*
+---------------------------------------------------------------+
|        MyLevel Menu for e107 v7xx - by Father Barry
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
include_lan(e_PLUGIN . "mylevel_menu/languages/readme/" . e_LANGUAGE . ".php");
require_once(e_PLUGIN."mylevel_menu/plugin.php");
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
$articulate_text="
<table class='fborder' style='".ADMIN_WIDTH."'>
	<tr>
		<td class='fcaption' colspan='2'>".MYLEVEL_R01."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".MYLEVEL_R02."</td>
		<td class='forumheader3'>".$eplug_name."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".MYLEVEL_R04."</td>
		<td class='forumheader3'>".MYLEVEL_R05."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".MYLEVEL_R06."</td>
		<td class='forumheader3'>".$eplug_version."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".MYLEVEL_R08."</td>
		<td class='forumheader3'>".MYLEVEL_R09."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".MYLEVEL_R10."</td>
		<td class='forumheader3'>".MYLEVEL_R11."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".MYLEVEL_R12."</td>
		<td class='forumheader3'>".MYLEVEL_R13."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".MYLEVEL_R14."</td>
		<td class='forumheader3'>".MYLEVEL_R15."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".MYLEVEL_R16."</td>
		<td class='forumheader3'>".MYLEVEL_R17."</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
		<strong>".MYLEVEL_R18."</strong><br /><br />".MYLEVEL_R19."<br /><br />
		<strong>".MYLEVEL_R20."</strong><br /><br />".MYLEVEL_R21."<br /><br />
		<strong>".MYLEVEL_R22."</strong><br /><br />".MYLEVEL_R23."
		</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";

#readme;


$ns->tablerender(MYLEVEL_R01, $articulate_text);

require_once(e_ADMIN . "footer.php");


?>