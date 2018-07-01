<?php
/**
 * $Id: rank_user_template.php,v 1.5 2009/10/22 15:03:37 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.5 $
 * Last Modified: $Date: 2009/10/22 15:03:37 $
 *
 * Change Log:
 * $Log: rank_user_template.php,v $
 * Revision 1.5  2009/10/22 15:03:37  michiel
 * Implemented customizable conditions
 *
 * Revision 1.4  2009/07/14 19:29:15  michiel
 * CVS Merge
 *
 * Revision 1.3.2.1  2009/07/13 21:54:02  michiel
 * - using own css style
 * - integrated deprecated rankshow_class into template/shortcode
 *
 * Revision 1.3  2009/06/28 15:06:14  michiel
 * Merged from dev_01_03
 *
 * Revision 1.2.2.1  2009/06/28 02:35:55  michiel
 * forum templates have been separated from user profile templates
 *
 * Revision 1.2  2009/06/26 09:23:40  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.1  2009/06/19 13:47:15  michiel
 * Made XHTML compliant
 *
 * Revision 1.1  2009/03/28 13:01:51  michiel
 * Initial CVS revision
 *
 *  
 */
if (!defined('e107_INIT')) {
    exit;
}
if (!defined("USER_WIDTH")) {
    define(USER_WIDTH, "width:100%;");
}

if (file_exists(THEME."rank_style.css")) {
	echo "<link rel='stylesheet' href='".THEME_ABS."rank_style.css' type='text/css'>";
} else {
	echo "<link rel='stylesheet' href='".e_PLUGIN_ABS."rank_system/templates/rank_style.css' type='text/css'>";
}

global $rank_shortcodes;

$RANK_USER_HEADER = "
<tr>
	<td style='width:30%' class='forumheader3'>
	
		<table style='width:100%'>
			<tr>
				<td class='forumheader3' rowspan='4' style='width:50%;text-align:center;border-left: 0px; border-top: 0px; border-bottom: 0px;'>
					<img src='{RANK_IMAGE}' border='0' alt='{RANK_NAME}'/>
					<br /><strong>{RANK_NAME}</strong>
				</td>
				<td class='forumheader3' style='width:25%;'>" . RANKS_UP_01 . "</td>
				<td class='forumheader3' style='width:25%;text-align:right;'>{RANK_POINTS}</td>
			</tr>
			<tr>
				<td class='forumheader3'>" . RANKS_UP_02 . "</td>
				<td class='forumheader3' style='text-align:right;'>{MED_BONUS}</td>
			</tr>
			<tr>
				<td class='forumheader3'><strong>" . RANKS_UP_03 . "</strong></td>
				<td class='forumheader3' style='text-align:right;'><strong>{TOT_POINTS}</strong></td>
			</tr>
			<tr>
				<td class='forumheader3'>" . RANKS_UP_04 . "</td>
				<td class='forumheader3' style='text-align:center;'>{RANK_NEXT}</td>
			</tr>
		</table>
	
	
	</td>
	<td style='width:70%' class='forumheader3'>
		<table style='width:100%'>
			<tr>
				<td style='width:30%'><div align='center'><strong>-</strong></div></td>
				<td style='width:40%'><div align='center'>{EDIT_RANK}{PROBATE_BUTTON}{PRISON_BUTTON}{KICK_BUTTON}</div></td>
				<td style='width:30%'><div align='center'><strong>+</strong></div></td>
			</tr>
	";


$RANK_USER_CONDITION = "
			<tr>
				<td style='width:30%'><div align='right'>{CONDIT_VALUE=-}</div></td>
				<td style='width:40%'><div align='center'><strong>{CONDIT_NAME=link}</strong></div></td>
				<td style='width:30%'><div align='left'>{CONDIT_VALUE=+}</div></td>
			</tr>
";

$RANK_USER_FOOTER = "
		</table>
	</td>
</tr>
";

$MEDAL_USER_PROFILE = "
<tr>
	<td style='width:30%' class='forumheader3'><center>{RIBBON_IMAGES}</center></td>
	<td style='width:70%' class='forumheader3'><center>{MEDAL_IMAGES}{EDIT_MEDALS}</center></td>
</tr>
";
    
?>