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
| $Source: e:\_repository\e107_plugins/auction/languages/admin/English.php,v $
| $Revision: 1.2 $
| $Date: 2008/06/28 05:47:12 $
| $Author: Neil $
+---------------------------------------------------------------+
*/

define("AUC_ADMIN_MENU_10",                    "Preferences");
define("AUC_ADMIN_MENU_20",                    "Menus");
define("AUC_ADMIN_MENU_25",                    "Notifications");
define("AUC_ADMIN_MENU_30",                    "Auctions");
define("AUC_ADMIN_MENU_99",                    "Read Me");

// Auction ordering
define("AUC_LAN_AUCTION_ORDER_VALUE_0",         "Date created (ID) ascending");
define("AUC_LAN_AUCTION_ORDER_VALUE_1",         "Date created (ID) descending");
define("AUC_LAN_AUCTION_ORDER_VALUE_2",         "Name ascending");
define("AUC_LAN_AUCTION_ORDER_VALUE_3",         "Name descending");

define("AUC_ADMIN_TEMPLATE_TYPE_APPS",         "auctions");
define("AUC_ADMIN_TEMPLATE_TYPE_APP",          "app");
define("AUC_ADMIN_TEMPLATE_TYPE_USE_GLOBAL",   "Use global template");

define("AUC_ADMIN_PREFS_AUCTIONS_PER_PAGE",    "Auctions per page");
define("AUC_ADMIN_PREFS_AUCTIONS_PER_PAGE_1",  "");
define("AUC_ADMIN_PREFS_AUCTIONS_PER_PAGE_2",  "The number of auctions that will be listed on a the auctions list page before paging is invoked.");
define("AUC_ADMIN_PREFS_LOTS_PER_PAGE",        "Lots per page");
define("AUC_ADMIN_PREFS_LOTS_PER_PAGE_1",      "");
define("AUC_ADMIN_PREFS_LOTS_PER_PAGE_2",      "The number of lots that will be listed on the lots list page before paging is invoked.");
define("AUC_ADMIN_PREFS_NOTIFY_BID",           "Bids");
define("AUC_ADMIN_PREFS_NOTIFY_BID_1",         "");
define("AUC_ADMIN_PREFS_NOTIFY_BID_2",         "Select the notification preference for when a bid is placed");
define("AUC_ADMIN_PREFS_NOTIFY_OWNER",         "Preferences for Auction Owner");
define("AUC_ADMIN_PREFS_NOTIFY_POSTER",        "Preferences for Bidders");
define("AUC_ADMIN_PREFS_ORDER",                "Auction list order");
define("AUC_ADMIN_PREFS_ORDER_1",              "");
define("AUC_ADMIN_PREFS_ORDER_2",              "Select the order to display the auctions on the main auctions list page");
define("AUC_ADMIN_PREFS_PAGE_TITLE",           "Page title");
define("AUC_ADMIN_PREFS_PAGE_TITLE_1",         "");
define("AUC_ADMIN_PREFS_PAGE_TITLE_2",         "Title prefix that will be displayed at the top of each page");
define("AUC_ADMIN_PREFS_SEPARATOR",            "Breadcrumb separator");
define("AUC_ADMIN_PREFS_SEPARATOR_1",          "");
define("AUC_ADMIN_PREFS_SEPARATOR_2",          "Used to separate the different elements of the page title when displayed as a bredcrumb trail");
define("AUC_ADMIN_PREFS_TEMPLATE",             "Global Template");
define("AUC_ADMIN_PREFS_TEMPLATE_1",           "");
define("AUC_ADMIN_PREFS_TEMPLATE_2",           "The template to be used for all pages not relating to a single auction and all auctions that use the global template.");
define("AUC_ADMIN_PREFS_TOOLTIPS",             "Tooltips");
define("AUC_ADMIN_PREFS_TOOLTIPS_1",           "");
define("AUC_ADMIN_PREFS_TOOLTIPS_2",           "Turns tooltip display on or off");
define("AUC_ADMIN_PREFS_USE_BBCODES",          "BB codes");
define("AUC_ADMIN_PREFS_USE_BBCODES_1",        "");
define("AUC_ADMIN_PREFS_USE_BBCODES_2",        "Select a an option to allow BB codes to be posted with auction descriptions.");
define("AUC_ADMIN_PREFS_USE_BBCODES_KEY_0",    "None");
define("AUC_ADMIN_PREFS_USE_BBCODES_KEY_1",    "Standard");
define("AUC_ADMIN_PREFS_USE_BBCODES_KEY_2",    "Standard with tooltips");
define("AUC_ADMIN_PREFS_USE_EMOTES",           "Allow emoticons");
define("AUC_ADMIN_PREFS_USE_EMOTES_1",         "");
define("AUC_ADMIN_PREFS_USE_EMOTES_2",         "Check to allow emoticons to be posted with auction descriptions.");
define("AUC_ADMIN_PREFS_VIEW_CLASS",           "Auction access");
define("AUC_ADMIN_PREFS_VIEW_CLASS_1",         "");
define("AUC_ADMIN_PREFS_VIEW_CLASS_2",         "Select the userclass for users who are allowed to access Auction pages. Note: individual auction access can be futher restricted on the Auctions admin page.");

define("AUC_ADMIN_MENUS_SUMMARY_TITLE",        "Summary title");
define("AUC_ADMIN_MENUS_SUMMARY_TITLE_1",      "");
define("AUC_ADMIN_MENUS_SUMMARY_TITLE_2",      "Title for the overall summary menu.");
define("AUC_ADMIN_MENUS_AUCTION_TITLE",        "Auction summary title");
define("AUC_ADMIN_MENUS_AUCTION_TITLE_1",      "");
define("AUC_ADMIN_MENUS_AUCTION_TITLE_2",      "Title for the auction summary menu.");

define("AUC_ADMIN_AUCTION_NAME",               "Name");
define("AUC_ADMIN_AUCTION_NAME_1",             "");
define("AUC_ADMIN_AUCTION_NAME_2",             "");
define("AUC_ADMIN_AUCTION_ICON",               "Icon");
define("AUC_ADMIN_AUCTION_ICON_1",             "");
define("AUC_ADMIN_AUCTION_ICON_2",             "Select an icon for this application");
define("AUC_ADMIN_AUCTION_DESCRIPTION",        "Description");
define("AUC_ADMIN_AUCTION_DESCRIPTION_1",      "");
define("AUC_ADMIN_AUCTION_DESCRIPTION_2",      "");
define("AUC_ADMIN_AUCTION_START_DATE",         "Start Date");
define("AUC_ADMIN_AUCTION_START_DATE_1",       "");
define("AUC_ADMIN_AUCTION_START_DATE_2",       "The date that the auction will start");
define("AUC_ADMIN_AUCTION_END_DATE",           "End Date");
define("AUC_ADMIN_AUCTION_END_DATE_1",         "");
define("AUC_ADMIN_AUCTION_END_DATE_2",         "The date that the auction will end");
define("AUC_ADMIN_AUCTION_CLOSED",             "Closed");
define("AUC_ADMIN_AUCTION_CLOSED_1",           "");
define("AUC_ADMIN_AUCTION_CLOSED_2",           "Closed auctions can be viewed but can not have new bids posted.");
define("AUC_ADMIN_AUCTION_EDIT_CLASS",         "Edit Class");
define("AUC_ADMIN_AUCTION_EDIT_CLASS_1",       "");
define("AUC_ADMIN_AUCTION_EDIT_CLASS_2",       "Select the userclass for editors of this auction. Editors can add new and update existing lots.");
define("AUC_ADMIN_AUCTION_VIEW_CLASS",         "View Class");
define("AUC_ADMIN_AUCTION_VIEW_CLASS_1",       "");
define("AUC_ADMIN_AUCTION_VIEW_CLASS_2",       "Select the userclass that is allowed to view this auction");
define("AUC_ADMIN_AUCTION_OWNER",              "Owner");
define("AUC_ADMIN_AUCTION_OWNER_1",            "");
define("AUC_ADMIN_AUCTION_OWNER_2",            "Select an owner for this auction");
define("AUC_ADMIN_AUCTION_TEMPLATE",           "Template");
define("AUC_ADMIN_AUCTION_TEMPLATE_1",         "");
define("AUC_ADMIN_AUCTION_TEMPLATE_2",         "Select a template to be used for displaying this applications pages");
?>
