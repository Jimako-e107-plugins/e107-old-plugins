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
| $Source: e:\_repository\e107_plugins/e107helpers_developer/handlers/e107helpers_developer_constants.php,v $
| $Revision: 1.1 $
| $Date: 2007/01/10 23:59:07 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Files & Directories
define("EHDC_PLUGIN_DIR",           e_PLUGIN."e107helpers_developer/");
define("EHDC_HANDLERS_DIR",         EHDC_PLUGIN_DIR."handlers/");
define("EHDC_LANGUAGE_DIR",         EHDC_PLUGIN_DIR."languages/");
define("EHDC_ADMIN_LANGUAGE_DIR",   EHDC_PLUGIN_DIR."languages/admin/");
define("EHDC_SELF",                 EHDC_PLUGIN_DIR."e107helpers_developer.php");

// Load the language file
include_lan(EHDC_LANGUAGE_DIR.e_LANGUAGE.".php");

// Load the admin language file if in an admin page
if (strpos(e_SELF, "admin_") !== false) {
   include_lan(EHDC_ADMIN_LANGUAGE_DIR.e_LANGUAGE.".php");
   require_once(e_PLUGIN."e107helpers_developer/handlers/e107helpers_developer_constants_admin.php");
}

// Database table names
define("EHDC_TABLE_1",              "e107helpers_developer_1");
define("EHDC_UPLOAD_TABLE",         "e107helpers_developer_upload");
?>