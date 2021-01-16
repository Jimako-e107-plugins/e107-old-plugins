<?php
// ***************************************************************
// *
// *		Title		:	MyLevel Menu
// *
// *		Author		:	Barry Keal
// *
// *		Date		:	13 Sept 2007
// *
// *		Version		:	1.2
// *
// *		Description	: 	User Level Meter
// *
// *		Revisions	:	 13 Sept 2007 Initial Design
// *
// *		Support at	:	www.keal.me.uk
// *
// ***************************************************************
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
include_lan(e_PLUGIN . 'mylevel_menu/languages/' . e_LANGUAGE . '.php');
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = 'My Level Menu';
$eplug_version = '1.4';
$eplug_author = 'Father Barry';
$eplug_url = 'http://keal.me.uk';
$eplug_email = '';
$eplug_description = MYLEVEL_A24;
$eplug_compatible = 'e107v7';
$eplug_readme = 'admin_readme.php'; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = true;
$eplug_latest = false;
// Name of the plugin"s folder -------------------------------------------------------------------------------------
$eplug_folder = 'mylevel_menu';
// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = 'mylevel Menu';
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = 'admin_config.php';
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon_small = $eplug_folder . '/images/mylevel_16.png';
$eplug_icon = $eplug_folder . '/images/mylevel_32.png';
$eplug_caption = MYLEVEL_1;
// List of preferences -----------------------------------------------------------------------------------------------
// now done in class
// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array('mylevel');
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array('
CREATE TABLE ' . MPREFIX . 'mylevel (
  mylevel_id int(11) unsigned NOT NULL default "0",
  mylevel_level tinyint(3) unsigned NOT NULL default "1",
  mylevel_comment varchar(150) default "",
  mylevel_contribution int(11) unsigned NOT NULL default "1",
  PRIMARY KEY  (mylevel_id)
) ENGINE=MyISAM;','
insert into ' . MPREFIX . 'mylevel (mylevel_id) SELECT user_id from ' . MPREFIX . 'user;',
'update ' . MPREFIX . 'mylevel set mylevel_contribution = (select ( (user_forums*5) + (user_comments*5) + (user_chats * 2) +(user_visits/4))  from ' . MPREFIX . 'user where mylevel_id=user_id) ',
'update ' . MPREFIX . 'mylevel set mylevel_contribution = 1 where mylevel_contribution=0');
// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = false;
$eplug_link_name = '';
$eplug_link_url = '';
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = MYLEVEL_A20;
// upgrading ... //
$upgrade_add_prefs = '';

$upgrade_remove_prefs = '';

$upgrade_alter_tables = '';

$eplug_upgrade_done = MYLEVEL_A21;

if (!function_exists('mylevel_menu_uninstall'))
{
    function mylevel_menu_uninstall()
    {
        global $sql;

        $sql->db_Delete('core', ' e107_name="mylevel" ');
    }
}

?>