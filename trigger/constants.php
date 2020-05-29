<?php
/*
+---------------------------------------------------------------+
| PSilo by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Copyright 2007, Neil Harrison (AKA bugrain)
|
| $Source: e:\_repository\e107_plugins/trigger/constants.php,v $
| $Revision: 1.5 $
| $Date: 2008/06/28 09:40:29 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
define("TRIGGERC_NAME",    "Trigger");
define("TRIGGERC_VERSION", "1.21");

define("TRIGGERC_ADMIN_PAGE", "admin_prefs.php");
$trigger_adminmenu = array(
   "TRIGGERC_ADMIN_PAGE_10" => array("text" => TRIGGER_LAN_ADMIN_MENU_10, "link" => TRIGGERC_ADMIN_PAGE."?10", "form" => true),
   "TRIGGERC_ADMIN_PAGE_30" => array("text" => TRIGGER_LAN_ADMIN_MENU_30, "link" => TRIGGERC_ADMIN_PAGE."?30", "form" => true),
   "TRIGGERC_ADMIN_PAGE_20" => array("text" => TRIGGER_LAN_ADMIN_MENU_20, "link" => TRIGGERC_ADMIN_PAGE."?20", "form" => true),
   "TRIGGERC_ADMIN_PAGE_98" => array("text" => TRIGGER_LAN_ADMIN_MENU_98, "link" => TRIGGERC_ADMIN_PAGE."?98", "form" => true),
   "TRIGGERC_ADMIN_PAGE_99" => array("text" => TRIGGER_LAN_ADMIN_MENU_99, "link" => TRIGGERC_ADMIN_PAGE."?99", "form" => false),
);

?>