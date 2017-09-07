<?php
/*
+---------------------------------------------------------------+
| SimpleContent by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:/_repository/e107_plugins/simple_content/handlers/scontent_constants_admin.php,v $
| $Revision: 1.1 $
| $Date: 2008/05/26 23:14:53 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Files
define("SCONTENTC_ADMIN_PAGE",           "admin_prefs.php");
$scontent_adminmenu = array(
   "SCONTENTC_ADMIN_PAGE_10" => array("text" => SCONTENT_LAN_ADMIN_MENU_10, "link" => SCONTENTC_ADMIN_PAGE."?10", "form" => true),
   "SCONTENTC_ADMIN_PAGE_40" => array("text" => SCONTENT_LAN_ADMIN_MENU_40, "link" => SCONTENTC_ADMIN_PAGE."?40", "form" => true),
   "SCONTENTC_ADMIN_PAGE_20" => array("text" => SCONTENT_LAN_ADMIN_MENU_20, "link" => SCONTENTC_ADMIN_PAGE."?20", "form" => true),
   "SCONTENTC_ADMIN_PAGE_30" => array("text" => SCONTENT_LAN_ADMIN_MENU_30, "link" => SCONTENTC_ADMIN_PAGE."?30", "form" => true),
   "SCONTENTC_ADMIN_PAGE_90" => array("text" => SCONTENT_LAN_ADMIN_MENU_90, "link" => SCONTENTC_ADMIN_PAGE."?90", "form" => true),
   "SCONTENTC_ADMIN_PAGE_99" => array("text" => SCONTENT_LAN_ADMIN_MENU_99, "link" => SCONTENTC_ADMIN_PAGE."?99", "form" => false),
);

?>