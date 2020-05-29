<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/log/plugin.php $
|     $Revision: 11678 $
|     $Id: plugin.php 11678 2010-08-22 00:43:45Z e107coders $
|     $Author: e107coders $
+----------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
include_lan(e_PLUGIN."timeout_popup/languages/admin/".e_LANGUAGE.".php");
$eplug_name = LAN_TIMEPOP_H01;
$eplug_version = "1.1";
$eplug_author = "bugrain";
$eplug_url = "http://www.bugrain.com";
$eplug_email = "e107plugins@bugrain.plus.com";
$eplug_description = LAN_TIMEPOP_C01;
$eplug_compatible = "e107v0.7+";
$eplug_readme = "";
$eplug_folder = "timeout_popup";
$eplug_menu_name = "";
$eplug_conffile = "admin_config.php";
$eplug_icon = $eplug_folder."/images/timePop_32.png";
$eplug_icon_small = $eplug_folder."/images/timePop_16.png";
$eplug_caption = LAN_TIMEPOP_H02;
$eplug_prefTable = "menu_pref";
$eplug_prefs = array(
	"timePop_class"   => 0,
	"timePop_timeout" => 0,
	"timePop_message" => LAN_TIMEPOP_C03,
);
$eplug_done = LAN_TIMEPOP_C02;
?>