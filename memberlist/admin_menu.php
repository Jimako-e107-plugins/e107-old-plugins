<?php
/**
 * $Id: admin_menu.php 10 2010-09-07 23:13:51Z michiel $
 * 
 * Memberlist plugin for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2010
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 4 sep. 2010
 * $HeadURL: svn://ubusrv/echo2/MemberList/frontliners.eu/fl_plugins/memberlist/admin_menu.php $
 * 
 * Revision: $LastChangedRevision: 10 $
 * Last Modified: $LastChangedDate: 2010-09-08 01:13:51 +0200 (wo, 08 sep 2010) $
 *
 */
if (!defined('e107_INIT')) {
    exit;
}
if (file_exists(e_PLUGIN . 'memberlist/languages/admin/' . e_LANGUAGE . '.php')) {
	include_lan(e_PLUGIN . 'memberlist/languages/admin/' . e_LANGUAGE . '.php');
} else {
	include_lan(e_PLUGIN . 'memberlist/languages/admin/English.php');
}
global $MBL_PREF;

$action = basename($_SERVER['PHP_SELF'], '.php');

$var['admin_config']['text'] = ADLAN_MBL_MM01;
$var['admin_config']['link'] = 'admin_config.php';


show_admin_menu(ADLAN_MBL_MM, $action, $var);

?>