<?php
/**
 * $Id: admin_readme.php,v 1.2 2009/06/26 09:23:04 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.2 $
 * Last Modified: $Date: 2009/06/26 09:23:04 $
 *
 * Change Log:
 * $Log: admin_readme.php,v $
 * Revision 1.2  2009/06/26 09:23:04  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.1  2009/06/12 15:55:45  michiel
 * RELEASE 1.2
 *
 * Revision 1.1  2009/03/28 13:01:37  michiel
 * Initial CVS revision
 *
 *  
 */
require_once('../../class2.php');
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms('P'))
{
    header('location:' . e_HTTP . 'index.php');
    exit;
}
include_lan(e_PLUGIN . 'rank_system/languages/readme/' . e_LANGUAGE . '.php');
require_once(e_ADMIN . 'auth.php');
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, 'width:100%;');
}
require(e_PLUGIN . 'rank_system/plugin.php');
$rank_text = "
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2'>" . LAN_RS_R01 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . LAN_RS_R02 . "</td>
		<td class='forumheader3'>" . $eplug_name . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . LAN_RS_R04 . "</td>
		<td class='forumheader3'>" . $eplug_author . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . LAN_RS_R06 . "</td>
		<td class='forumheader3'>" . $eplug_version . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . LAN_RS_R08 . "</td>
		<td class='forumheader3'>" . LAN_RS_R09 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . LAN_RS_R10 . "</td>
		<td class='forumheader3'>" . LAN_RS_R11 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . LAN_RS_R12 . "</td>
		<td class='forumheader3'>" . LAN_RS_R13 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . LAN_RS_R14 . "</td>
		<td class='forumheader3'>" . LAN_RS_R15 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . LAN_RS_R16 . "</td>
		<td class='forumheader3'>" . LAN_RS_R17 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
		<strong>" . LAN_RS_R24 . "</strong><br /><br />" . LAN_RS_R25 . "<br /><br />
		</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
		<strong>" . LAN_RS_R18 . "</strong><br /><br />" . LAN_RS_R19 . "<br /><br />
		<strong>" . LAN_RS_R20 . "</strong><br /><br />" . LAN_RS_R21 . "<br /><br />
		<strong>" . LAN_RS_R22 . "</strong><br /><br />" . LAN_RS_R23 . "
		</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";
// readme;
$ns->tablerender(LAN_RS_R01, $rank_text);

require_once(e_ADMIN . 'footer.php');

?>