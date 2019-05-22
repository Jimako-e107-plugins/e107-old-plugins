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
| $Source: e:\_repository\e107_plugins/auction/handlers/auction_constants.php,v $
| $Revision: 1.1 $
| $Date: 2006/12/05 00:11:52 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Files & Directories
define("TUC_PLUGIN_DIR",           e_PLUGIN."theme_utilities/");
define("TUC_HANDLERS_DIR",         TUC_PLUGIN_DIR."handlers/");
define("TUC_LANGUAGE_DIR",         TUC_PLUGIN_DIR."languages/");
define("TUC_ADMIN_LANGUAGE_DIR",   TUC_PLUGIN_DIR."languages/admin/");

// Load the language file
include_lan(TUC_LANGUAGE_DIR.e_LANGUAGE.".php");

// Load the admin language file if in an admin page
if (strpos(e_SELF, "admin_") !== false) {
   include_lan(TUC_ADMIN_LANGUAGE_DIR.e_LANGUAGE.".php");
   require_once(TUC_HANDLERS_DIR."tu_constants_admin.php");
}

// Miscellaneous
define(TUC_CONFIG_DIR,              "/tu_config/");
define(TUC_CONFIG_FILE,             TUC_CONFIG_DIR."/tu_config.php");

?>