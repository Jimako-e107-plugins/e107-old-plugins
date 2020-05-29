<?php
/*
+---------------------------------------------------------------+
| Auction by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/auction/handlers/auction_constants_admin.php,v $
| $Revision: 1.1 $
| $Date: 2006/12/05 00:11:52 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Files
define("AUCC_ADMIN_PAGE",           "admin_prefs.php");
$auc3_adminmenu = array(
   "AUCC_ADMIN_PAGE_10" => array("text" => AUC_ADMIN_MENU_10, "link" => AUCC_ADMIN_PAGE."?10", "form" => true),
   "AUCC_ADMIN_PAGE_20" => array("text" => AUC_ADMIN_MENU_20, "link" => AUCC_ADMIN_PAGE."?20", "form" => true),
   "AUCC_ADMIN_PAGE_25" => array("text" => AUC_ADMIN_MENU_25, "link" => AUCC_ADMIN_PAGE."?25", "form" => true),
   "AUCC_ADMIN_PAGE_30" => array("text" => AUC_ADMIN_MENU_30, "link" => AUCC_ADMIN_PAGE."?30", "form" => true),
   "AUCC_ADMIN_PAGE_99" => array("text" => AUC_ADMIN_MENU_99, "link" => AUCC_ADMIN_PAGE."?99", "form" => false),
);

?>