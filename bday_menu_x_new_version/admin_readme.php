<?php
/*
+---------------------------------------------------------------+
|        Birthday Menu for e107 v7xx - by Father Barry
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
include_lan(e_PLUGIN . "bday_menu/languages/readme/" . e_LANGUAGE . ".php");
require_once("plugin.php");
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
$welcome_text = "
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2'>" . BDAY_RR01 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . BDAY_RR02 . "</td>
		<td class='forumheader3'>" .$eplug_name . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . BDAY_RR04 . "</td>
		<td class='forumheader3'>" . $eplug_author . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . BDAY_RR06 . "</td>
		<td class='forumheader3'>" .$eplug_version . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . BDAY_RR08 . "</td>
		<td class='forumheader3'>" . BDAY_RR09 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . BDAY_RR10 . "</td>
		<td class='forumheader3'>" . BDAY_RR11 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . BDAY_RR12 . "</td>
		<td class='forumheader3'>" . BDAY_RR13 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . BDAY_RR14 . "</td>
		<td class='forumheader3'>" . BDAY_RR15 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . BDAY_RR16 . "</td>
		<td class='forumheader3'>" . BDAY_RR17 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . BDAY_RR25 . "</td>
		<td class='forumheader3'><span style='color:#ff4444;'>" . BDAY_RR24 . "</span></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
		<strong>" . BDAY_RR18 . "</strong><br /><br />" . BDAY_RR19 . "<br /><br />
		<strong>" . BDAY_RR20 . "</strong><br /><br />" . BDAY_RR21 . "<br /><br />
		<strong>" . BDAY_RR22 . "</strong><br /><br />" . BDAY_RR23 . "
		</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";
// readme;
$ns->tablerender(BDAY_RR01, $welcome_text);
require_once(e_ADMIN . "footer.php");

?>