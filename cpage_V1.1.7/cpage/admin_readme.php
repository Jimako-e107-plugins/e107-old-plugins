<?php
/*
   +---------------------------------------------------------------+
   |        Enhanced Custom Pages for e107 v7xx - by Father Barry
   |
   |        This module for the e107 .7+ website system
   |        Copyright Barry Keal 2004-2009
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
include_lan(e_PLUGIN . "cpage/languages/readme/" . e_LANGUAGE . ".php");
require_once(e_PLUGIN . "cpage/plugin.php");
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%");
}
$readme_text="
<table class='fborder'  style='".ADMIN_WIDTH."' >
	<tr>
		<td class='fcaption' colspan='2'>".README_R01."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".README_R02."</td>
		<td class='forumheader3'>".$eplug_name."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".README_R04."</td>
		<td class='forumheader3'>".$eplug_author."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".README_R06."</td>
		<td class='forumheader3'>".$eplug_version."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".README_R08."</td>
		<td class='forumheader3'>".README_R09."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".README_R10."</td>
		<td class='forumheader3'>".README_R11."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".README_R12."</td>
		<td class='forumheader3'>".README_R13."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".README_R14."</td>
		<td class='forumheader3'>".README_R15."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >".README_R16."</td>
		<td class='forumheader3'>".README_R17."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . README_R25 . "</td>
		<td class='forumheader3'><span style='color:#ff4444;'>" . README_R24 . "</span></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
		<strong>".README_R18."</strong><br /><br />".README_R19."<br /><br />
		<strong>".README_R20."</strong><br /><br />".README_R21."<br /><br />
		<strong>".README_R22."</strong><br /><br />".README_R23."
		</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";

#readme;


$ns->tablerender(README_R26, $readme_text);

require_once(e_ADMIN . "footer.php");