<?php
/*
+---------------------------------------------------------------+
| Election by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/election/handlers/election_constants_admin.php,v $
| $Revision: 1.2 $
| $Date: 2007/01/07 14:23:27 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Files
define("ELECC_ADMIN_PAGE",           "admin_prefs.php");
$election_adminmenu = array(
   "ELECC_ADMIN_PAGE_10" => array("text" => ELEC_ADMIN_MENU_10, "link" => ELECC_ADMIN_PAGE."?10", "form" => true),
   "ELECC_ADMIN_PAGE_20" => array("text" => ELEC_ADMIN_MENU_20, "link" => ELECC_ADMIN_PAGE."?20", "form" => true),
   "ELECC_ADMIN_PAGE_30" => array("text" => ELEC_ADMIN_MENU_30, "link" => ELECC_ADMIN_PAGE."?30", "form" => true),
   "ELECC_ADMIN_PAGE_50" => array("text" => ELEC_ADMIN_MENU_50, "link" => ELECC_ADMIN_PAGE."?50", "form" => true),
   "ELECC_ADMIN_PAGE_99" => array("text" => ELEC_ADMIN_MENU_99, "link" => ELECC_ADMIN_PAGE."?99", "form" => false),
);

?>