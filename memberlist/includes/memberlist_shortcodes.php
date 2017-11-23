<?php
/**
 * $Id: memberlist_shortcodes.php 26 2010-09-13 19:42:21Z michiel $
 * 
 * Memberlist plugin for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2010
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 4 sep. 2010
 * $HeadURL: svn://ubusrv/echo2/MemberList/frontliners.eu/fl_plugins/memberlist/includes/memberlist_shortcodes.php $
 * 
 * Revision: $LastChangedRevision: 26 $
 * Last Modified: $LastChangedDate: 2010-09-13 21:42:21 +0200 (ma, 13 sep 2010) $
 *
 */
if (!defined('e107_INIT')) {
    exit;
}
include_once(e_HANDLER . 'shortcode_handler.php');

$mbl_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
// * start shortcodes
/*

SC_BEGIN EDIT_CNCLBTN
	return "<input class='button' type='submit' name='cncledit' value='".LAN_MBL_CANCEL."' />";
SC_END

SC_BEGIN EDIT_GROUPNAME
	global $cID, $cName, $cSelected, $cDisabled;
	
	$sel = ($cSelected ? "checked='checked'" : "");
	$dis = ($cDisabled ? "disabled='disabled'" : "");
	return "<input class='tbox' type='checkbox' name='mbl_groups[]' value='$cID' $sel $dis /> $cName";
SC_END

SC_BEGIN EDIT_MSG
	global $mbl_msg;
	return $mbl_msg;
SC_END

SC_BEGIN EDIT_PRIMARY
	global $cID, $cPrimary;
	
	$sel = ($cPrimary ? "checked='checked'" : "");
	return "<input type='radio' $sel name='primgrp' class='tbox' value='$cID' />";
SC_END

SC_BEGIN EDIT_SAVEBTN
	return "<input class='button' type='submit' name='updatesettings' value='".LAN_MBL_UPDATE."' />";
SC_END

SC_BEGIN EDIT_USERNAME
	global $user_name;
	
	return $user_name;
SC_END

SC_BEGIN MBL_BUTTONS
	global $user;
	
	$retval = "
		<a href='".e_PLUGIN."pm/pm.php?send.".$user['user_id']."'><img src='".e_PLUGIN."memberlist/images/btn_pm.png' border='0' title='".LAN_MBL_OV06."' alt='".LAN_MBL_OV06."'/></a>
	";
	
	if (!$user['user_hideemail'] || ADMIN) {
		$tmp = explode("@", $user['user_email']);
		$retval .= "
			<a rel='external' href='javascript:window.location=\"mai\"+\"lto:\"+\"".$tmp[0]."\"+\"@\"+\"".$tmp[1]."\";self.close();' onmouseover='window.status=\"".LAN_MBL_OV07."\"; return true;' onmouseout='window.status=\"\";return true;'>
				<img src='".e_PLUGIN."memberlist/images/btn_email.png' border='0' title='".LAN_MBL_OV07."' alt='".LAN_MBL_OV07."'/>
			</a>
		";
	}
	return $retval;
SC_END

SC_BEGIN MBL_CAPTION
	global $captionlist;
	return $captionlist[$parm];
SC_END

SC_BEGIN MBL_FILTERBOX
	global $filterbox;
	return $filterbox;
SC_END

SC_BEGIN MBL_GROUPS
	global $groups;
	return $groups;
SC_END

SC_BEGIN MBL_ID
	global $user;
	
	return $user['user_id'];
SC_END

SC_BEGIN MBL_JOINED
	global $user, $dt;
	return $dt->stamp($user['user_join'], "short_break");
SC_END

SC_BEGIN MBL_LASTVISIT
	global $user, $dt;
	return ($user['user_lastvisit'] > 0 ? $dt->stamp($user['user_lastvisit'], "short_break") : "-");
SC_END

SC_BEGIN MBL_NAME
	global $user;
	
	return "<a href='/user.php?id.".$user['user_id']."' >".$user['user_name']."</a>";
SC_END

SC_BEGIN MBL_NEXTPREV
	global $nextprev;
	return $nextprev;
SC_END

*/

?>