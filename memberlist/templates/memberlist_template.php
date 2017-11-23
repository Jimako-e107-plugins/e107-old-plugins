<?php
/**
 * $Id: memberlist_template.php 25 2010-09-13 19:41:48Z michiel $
 * 
 * Memberlist plugin for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2010
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 4 sep. 2010
 * $HeadURL: svn://ubusrv/echo2/MemberList/frontliners.eu/fl_plugins/memberlist/templates/memberlist_template.php $
 * 
 * Revision: $LastChangedRevision: 25 $
 * Last Modified: $LastChangedDate: 2010-09-13 21:41:48 +0200 (ma, 13 sep 2010) $
 *
 */
if (!defined('e107_INIT')) {
    exit;
}
if (!defined("USER_WIDTH")) {
    define(USER_WIDTH, "width:100%;");
}

$EDIT_HEADER = "
	<table class='fborder' style='".USER_WIDTH."'>
		<tr>
			<td class='forumheader' colspan='2'>".LAN_MBL_EU03."</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2' style='text-align:center; font-size: 1.5em;' >{EDIT_USERNAME}</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader3' style='text-align:center; text-weight:bold; color: #ff4444;'>{EDIT_MSG}&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader' colspan='2'>".LAN_MBL_EU04."</td>
		</tr>
		<tr>
			<td class='fcaption' style='width:70%'>".LAN_MBL_EU05."</td>
			<td class='fcaption' style='width:30%;'>".LAN_MBL_EU06."</td>
		</tr>
";

$EDIT_ROW = "
		<tr>
			<td class='forumheader2' style='width:70%'>{EDIT_GROUPNAME}</td>
			<td class='forumheader3' style='width:30%; text-align:center;'>{EDIT_PRIMARY}</td>
		</tr>
";

$EDIT_FOOTER = "
	</table>
	{EDIT_SAVEBTN} {EDIT_CNCLBTN}
";

$LIST_HEADER = "
	<table class='fborder' style='".USER_WIDTH."'>
		<tr>
			<td style='width:5%;' class='fcaption'>{MBL_CAPTION=id}</td>
			<td style='width:25%;' class='fcaption'>{MBL_CAPTION=name}</td>
			<td style='width:20%;' class='fcaption'>{MBL_CAPTION=groups}</td>
			<td style='width:20%;' class='fcaption'>{MBL_CAPTION=lastvisit}</td>
			<td style='width:20%;' class='fcaption'>{MBL_CAPTION=joined}</td>
			<td style='width:10%;' class='fcaption'>&nbsp;</td>
		</tr>
";

$LIST_ROW = "
		<tr>
			<td style='text-align:center' class='forumheader2'>{MBL_ID}</td>
			<td class='forumheader2'>{MBL_NAME}</td>
			<td style='text-align:center' class='forumheader3'>{MBL_GROUPS}</td>
			<td style='text-align:center' class='forumheader3'>{MBL_LASTVISIT}</td>
			<td style='text-align:center' class='forumheader3'>{MBL_JOINED}</td>
			<td style='text-align:right' class='forumheader3'>{MBL_BUTTONS}</td>
		</tr>
";

$LIST_EMPTY = "
		<tr>
			<td class='forumheader2' style='text-align:center;' colspan='6'>".LAN_MBL_OV09."</td>
		</tr> 
";

$LIST_FOOTER = "
		<tr>
			<td class='fcaption' style='text-align:left' colspan='3'>{MBL_NEXTPREV}</td>
			<td class='fcaption' style='text-align:right' colspan='3'>".LAN_MBL_OV11." {MBL_FILTERBOX}</td>
		</tr>
	</table>
";

?>