<?php
/**
 * $Id: e_meta.php 62 2010-11-07 12:41:59Z michiel $
 * 
 * Memberlist plugin for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2010
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 7 nov. 2010
 * $HeadURL: svn://ubusrv/echo2/MemberList/frontliners.eu/fl_plugins/memberlist/e_meta.php $
 * 
 * Revision: $LastChangedRevision: 62 $
 * Last Modified: $LastChangedDate: 2010-11-07 13:41:59 +0100 (zo, 07 nov 2010) $
 *
 */
if (!defined('e107_INIT'))
{
    exit;
}
global $MBL_PREF, $pref, $PLUGINS_DIRECTORY;
if (!isset($pref['plug_installed']['memberlist'])) {
    return ;
}

if (e_PAGE == 'user.php') {
	require_once(e_PLUGIN . 'memberlist/includes/memberlist_class.php');
	if (!is_object($mbl)) {
	    $mbl = new memberlist();
	}
	
	if ($MBL_PREF['usrprofile'] == '') {
		return;
	} 
	
	$src = "{".$MBL_PREF['usrprofile']."}";
	$trg = ($MBL_PREF['usrprofpos'] == "pre" ? "{USERGROUPS}".$src : $src."{USERGROUPS}");
	$USER_FULL_TEMPLATE = str_replace($src, $trg, $USER_FULL_TEMPLATE);
}

?>