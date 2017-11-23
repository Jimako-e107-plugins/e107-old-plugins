<?php
/**
 * $Id: plugin.php 63 2010-11-07 12:42:26Z michiel $
 * 
 * Group Style plugin for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2010
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 31 aug 2010
 * $HeadURL: svn://ubusrv/echo2/MemberList/frontliners.eu/fl_plugins/memberlist/plugin.php $
 * 
 * Revision: $LastChangedRevision: 63 $
 * Last Modified: $LastChangedDate: 2010-11-07 13:42:26 +0100 (zo, 07 nov 2010) $
 *
 */
if (!defined('e107_INIT')) {
    exit;
}

// ***************************************************************
// *
// *		Title		:	Alternative Member List
// *
// *		Author		:	Michiel Horvers
// *
// *		Date		:	August 31st 2010
// *
// *		Version		:	1.1.1
// *
// *		Description	: 	Shows all of the user's unread posts
// *
// *		Revisions	:	1.0		1-09-2010	Initial revision
// *						1.1		14-09-2010	Edit screen from userprofile, 
// *											link with groupstyle plugin
// *						1.1.1	07-11-2010	Injection in user profile configurable
// *
// *		Support at	:	http://www.mhcp-software.nl
// *						http://wiki.mhcp-software.nl
// *
// ***************************************************************
include_lan(e_PLUGIN . 'memberlist/languages/admin/' . e_LANGUAGE . '.php');
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = 'MemberList';
$eplug_version = '1.1.1';
$eplug_author = 'Michiel Horvers';
$eplug_url = 'http://www.mhcp-software.nl';
$eplug_email = 'michiel@mhcp-software.nl';
$eplug_description = ADLAN_MBL_PM_02;
$eplug_compatible = 'e107v0.7.11+';
$eplug_readme = '';	// leave blank if no readme file
$eplug_status = TRUE;
$eplug_compliant=true;


// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = 'memberlist';

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = ADLAN_MBL;

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = 'admin_config.php';

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . '/images/users_32.png';
$eplug_icon_small = $eplug_folder . '/images/users_16.png';
$eplug_caption = ADLAN_MBL_PM_01;

// prefs created in class

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = ADLAN_MBL_LINK;
$eplug_link_url = e_PLUGIN.'memberlist/memberlist.php';


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = ADLAN_MBL_PM_03;

// upgrading ... //

$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$upgrade_alter_tables = "";

$eplug_upgrade_done = ADLAN_MBL_PM_04;

// Deleting plugin ...//
if (!function_exists('memberlist_uninstall')) {
    function memberlist_uninstall() {
        // get rid of the things we created
        global $sql;
        $sql->db_Delete('core', ' e107_name="memberlist" ');
    }
}

?>