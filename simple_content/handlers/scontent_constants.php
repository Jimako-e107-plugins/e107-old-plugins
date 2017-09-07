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
| $Source: e:/_repository/e107_plugins/simple_content/handlers/scontent_constants.php,v $
| $Revision: 1.1 $
| $Date: 2008/05/26 23:14:53 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Files & Directories
define("SCONTENTC_PLUGIN_DIR",           e_PLUGIN."simple_content/");
define("SCONTENTC_HANDLERS_DIR",         SCONTENTC_PLUGIN_DIR."handlers/");
define("SCONTENTC_LANGUAGE_DIR",         SCONTENTC_PLUGIN_DIR."languages/");
define("SCONTENTC_ADMIN_LANGUAGE_DIR",   SCONTENTC_PLUGIN_DIR."languages/admin/");
define("SCONTENTC_SELF",                 SCONTENTC_PLUGIN_DIR."scontent.php");

// Load the language file
include_lan(SCONTENTC_LANGUAGE_DIR."English.php");

// Load the admin language file if in an admin page
if (strpos(e_SELF, "admin_") !== false) {
   include_lan(SCONTENTC_ADMIN_LANGUAGE_DIR."English.php");
   require_once(SCONTENTC_PLUGIN_DIR."handlers/scontent_constants_admin.php");
}

// URL parameter array indicies
define("SCONTENTC_GROUP",                 0);
define("SCONTENTC_CATEGORY",              1);
define("SCONTENTC_ITEM",                  2);

// Pages
define("SCONTENTC_PAGE_DEFAULT",          "default");
define("SCONTENTC_PAGE_GROUPS",           "groups");
define("SCONTENTC_PAGE_CATEGORIES",       "categories");
define("SCONTENTC_PAGE_ITEMS",            "items");
define("SCONTENTC_PAGE_ITEM",             "item");

// Database table names
define("SCONTENTC_GROUPS_TABLE",          "scontent_groups");
define("SCONTENTC_CATEGORIES_TABLE",      "scontent_cats");
define("SCONTENTC_ITEMS_TABLE",           "scontent_items");
define("SCONTENTC_RELATIONSHIPS_TABLE",   "scontent_relationships");

// Database table names
define("SCONTENTC_CACHE_ID_GROUP",        "scontent_group");
define("SCONTENTC_CACHE_ID_CATEGORY",     "scontent_cat");
define("SCONTENTC_CACHE_ID_ITEM",         "scontent_item");
define("SCONTENTC_CACHE_ID_ITEM_CHILDREN","scontent_item_children");

// Database table order
define("SCONTENTC_GROUPS_ORDER",          " order by scontent_group_name asc");
define("SCONTENTC_CATEGORIES_ORDER",      " order by scontent_cat_name desc");
define("SCONTENTC_ITEMS_ORDER",           " order by scontent_item_name asc");
define("SCONTENTC_RELATIONSHIPS_ORDER",   " order by scontent_rel_name asc");

// Cache fields
define("SCONTENTC_CACHE_GROUP",           "group");
define("SCONTENTC_CACHE_CATEGORY",        "category");
define("SCONTENTC_CACHE_ITEM",            "item");
define("SCONTENTC_CACHE_RELATED_ITEM",    "related_item");
?>