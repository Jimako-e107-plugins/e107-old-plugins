<?php
/*
+---------------------------------------------------------------+
| Bugtracker3 by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/bugtracker3/handlers/bugtracker3_constants.php,v $
| $Revision: 1.1.2.10 $
| $Date: 2006/11/27 23:49:57 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Files & Directories
define("BUGC_PLUGIN_DIR",           e_PLUGIN."bugtracker3/");
define("BUGC_HANDLERS_DIR",         BUGC_PLUGIN_DIR."handlers/");
define("BUGC_LANGUAGE_DIR",         BUGC_PLUGIN_DIR."languages/");
define("BUGC_ADMIN_LANGUAGE_DIR",   BUGC_PLUGIN_DIR."languages/admin/");
define("BUGC_SELF",                 BUGC_PLUGIN_DIR."bugtracker3.php");

// Load the language file
include_lan(BUGC_LANGUAGE_DIR.e_LANGUAGE.".php");

// Load the admin language file if in an admin page
if (strpos(e_SELF, "admin_") !== false) {
   include_lan(BUGC_ADMIN_LANGUAGE_DIR.e_LANGUAGE.".php");
   require_once(e_PLUGIN."bugtracker3/handlers/bugtracker3_constants_admin.php");
}

// URL parameter array indicies
define("BUGC_MODE",                       0);
define("BUGC_ID",                         1);
define("BUGC_FILTER",                     2);

// Page modes
define("BUGC_APPS_PAGE",                  0);
define("BUGC_BUGS_PAGE",                  1);
define("BUGC_BUG_PAGE",                   2);
define("BUGC_SUBMIT_BUG_PAGE",            3);
define("BUGC_SUBMIT_BUG",                 4);
define("BUGC_EDIT_BUG_PAGE",              5);
define("BUGC_UPDATE_BUG",                 6);
define("BUGC_MOVE_BUG_PAGE",              7);
define("BUGC_FILTER_PAGE",                8);
define("BUGC_STATS_PAGE",                 9);

// Database table names
define("BUGC_APPS_TABLE",                 "bugtracker3_apps");
define("BUGC_APP_VERSIONS_TABLE",         "bugtracker3_app_versions");
define("BUGC_BUGS_TABLE",                 "bugtracker3_bugs");
define("BUGC_DEVELOPER_COMMENTS_TABLE",   "bugtracker3_developer_comments");
define("BUGC_CATEGORIES_TABLE",           "bugtracker3_categories");
define("BUGC_PRIORITIES_TABLE",           "bugtracker3_priorities");
define("BUGC_RESOLUTIONS_TABLE",          "bugtracker3_resolutions");
define("BUGC_STATUSES_TABLE",             "bugtracker3_statuses");
define("BUGC_RELATIONSHIPS_TABLE",        "bugtracker3_relationships");
define("BUGC_FILTERS_TABLE",              "bugtracker3_filters");
define("BUGC_USER_PREFS_TABLE",           "bugtracker3_user_prefs");

// Application ordering
define("BUGC_APPS_ORDER_KEY_0",           " order by bugtracker3_apps_id asc");
define("BUGC_APPS_ORDER_KEY_1",           " order by bugtracker3_apps_id desc");
define("BUGC_APPS_ORDER_KEY_2",           " order by bugtracker3_apps_name asc");
define("BUGC_APPS_ORDER_KEY_3",           " order by bugtracker3_apps_name desc");

// Menus
define("BUGC_MENU_SUMMARY",               "BUG3_MENU_SUMMARY");
define("BUGC_MENU_APPLICATION",           "BUG3_MENU_APPLICATION");

// Notifications
define("BUGC_NOTIFY_KEY_0",               "0");
define("BUGC_NOTIFY_KEY_1",               "1");
define("BUGC_NOTIFY_KEY_2",               "2");
define("BUGC_NOTIFY_KEY_3",               "3");

// Miscellaneous
define("BUGC_POST_ARRAY",                 "bugtracker3_bug");
define("BUGC_UI",                         "ui");
define("BUGC_DB",                         "db");
define("BUGC_TRUNC",                      "truncate");
define("BUGC_ACCESS_NONE",                0);
define("BUGC_ACCESS_VIEW",                10);
define("BUGC_ACCESS_EDIT",                20);
define("BUGC_APP_TYPE_BUGS",              0);
define("BUGC_APP_TYPE_FEATURES",          1);
define("BUGC_BEFORE",                     1);
define("BUGC_TT",                         "bugtracker3_tooltip");

?>