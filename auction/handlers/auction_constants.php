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
define("AUCC_PLUGIN_DIR",           e_PLUGIN."auction/");
define("AUCC_HANDLERS_DIR",         AUCC_PLUGIN_DIR."handlers/");
define("AUCC_LOT_IMAGES_DIR",       AUCC_PLUGIN_DIR."lotimages/");
define("AUCC_LANGUAGE_DIR",         AUCC_PLUGIN_DIR."languages/");
define("AUCC_ADMIN_LANGUAGE_DIR",   AUCC_PLUGIN_DIR."languages/admin/");
define("AUCC_SELF",                 AUCC_PLUGIN_DIR."auction.php");

// Load the language file
include_lan(AUCC_LANGUAGE_DIR.e_LANGUAGE.".php");

// Load the admin language file if in an admin page
if (strpos(e_SELF, "admin_") !== false) {
   include_lan(AUCC_ADMIN_LANGUAGE_DIR.e_LANGUAGE.".php");
   require_once(e_PLUGIN."auction/handlers/auction_constants_admin.php");
}

// URL parameter array indicies
define("AUCC_MODE",                       0);
define("AUCC_ID",                         1);

// Page modes
define("AUCC_APPS_PAGE",                  0);
define("AUCC_LOTS_PAGE",                  1);
define("AUCC_LOT_PAGE",                   2);
define("AUCC_SUBMIT_LOT_PAGE",            3);
define("AUCC_SUBMIT_LOT",                 4);
define("AUCC_EDIT_LOT_PAGE",              5);
define("AUCC_UPDATE_LOT",                 6);

// Database table names
define("AUCC_AUCTIONS_TABLE",             "auction_auctions");
define("AUCC_LOTS_TABLE",                 "auction_lots");
define("AUCC_BIDS_TABLE",                 "auction_bids");

// Database table order
define("AUCC_LOTS_ORDER",                 " order by auction_lot_title asc");
define("AUCC_BIDS_ORDER",                 " order by auction_bid_timestamp desc");

// Auction ordering
define("AUCC_AUCTION_ORDER_KEY_0",        " order by auction_id asc");
define("AUCC_AUCTION_ORDER_KEY_1",        " order by auction_id desc");
define("AUCC_AUCTION_ORDER_KEY_2",        " order by auction_name asc");
define("AUCC_AUCTION_ORDER_KEY_3",        " order by auction_name desc");

// Menus
define("AUCC_MENU_SUMMARY",               "AUC_MENU_SUMMARY");
define("AUCC_MENU_AUCTION",               "AUC_MENU_AUCTION");

// Notifications
define("AUCC_NOTIFY_KEY_0",               "0");
define("AUCC_NOTIFY_KEY_1",               "1");
define("AUCC_NOTIFY_KEY_2",               "2");
define("AUCC_NOTIFY_KEY_3",               "3");

// Miscellaneous
define("AUCC_POST_ARRAY",                 "auction_auc");
define("AUCC_UI",                         "ui");
define("AUCC_DB",                         "db");
define("AUCC_TRUNC",                      "truncate");
define("AUCC_ACCESS_NONE",                0);
define("AUCC_ACCESS_VIEW",                10);
define("AUCC_ACCESS_EDIT",                20);
define("AUCC_APP_TYPE_AUCS",              0);
define("AUCC_APP_TYPE_FEATURES",          1);
define("AUCC_BEFORE",                     1);
define("AUCC_TT",                         "auction_tooltip");

?>