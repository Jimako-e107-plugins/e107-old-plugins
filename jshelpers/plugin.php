<?php
/*
+---------------------------------------------------------------+
| JSHelper by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: /CVS_Repository/jshelpers/plugin.php,v $
| $Revision: 1.5 $
| $Date: 2008/11/16 21:52:20 $
| $Author: Owner $
+---------------------------------------------------------------+
*/
if (!defined("e107_INIT")) {
   exit;
}

$lb_path = e_PLUGIN.'jshelpers/';
include_lan($lb_path."languages/".e_LANGUAGE.".php");

$eplug_name          = JSHELPER_LAN_ADMIN_01;
$eplug_version       = "0.3b";
$eplug_author        = "bugrain";
$eplug_url           = "http://www.bugrain.plus.com";
$eplug_email         = "e107plugins@bugrain.plus.com";
$eplug_description   = JSHELPER_LAN_ADMIN_02;
$eplug_compatible    = "e107v0.7.8+";
$eplug_readme        = "admin_prefs.php?98";
$eplug_conffile      = "admin_prefs.php";
$eplug_compliant     = false;
$eplug_folder        = "jshelpers";
$eplug_icon          = $eplug_folder."/images/icon_32.png";
$eplug_icon_small    = $eplug_folder."/images/icon_16.png";
$eplug_caption       = "Configure JSHelper";
$eplug_link          = false;
$eplug_done          = JSHELPER_LAN_ADMIN_03;
$eplug_upgrade_done  = JSHELPER_LAN_ADMIN_04;
$eplug_module        = true;

$eplug_prefs = array(
   "jshelper_debug_level"     => 0,
   "jshelper_firebug_mode"    => 0,
   "jshelper_file_serving"    => 0,
);
$upgrade_add_prefs = array();
$upgrade_remove_prefs = array();

$eplug_table_names = array();
$eplug_tables = array();
$upgrade_alter_tables = array();
?>