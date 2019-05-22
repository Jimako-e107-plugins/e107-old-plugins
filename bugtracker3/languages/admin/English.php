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
| $Source: e:\_repository\e107_plugins/bugtracker3/languages/admin/English.php,v $
| $Revision: 1.1.2.13 $
| $Date: 2006/11/27 23:38:32 $
| $Author: Neil $
+---------------------------------------------------------------+
*/

// config pages here
$configpages[]="General settings";
$configpages[]="-";
$configpages[]="Applications";
$configpages[]="Add Application";

// normal language here
define("BUG3_ADMIN_OPTIONS", "Options");

// unknown command error
define("BUG3_ADMIN_UNKNOWNCOMMAND", "Unknown Command! This error should not occur.");

// Define (new) admin stuff here
define("BUG3_ADMIN_MENU",                       BUG3_ADMIN_PLUGIN." Options");

define("BUG3_ADMIN_MENU_10",                    "Preferences");
define("BUG3_ADMIN_MENU_20",                    "Menus");
define("BUG3_ADMIN_MENU_25",                    "Notifications");
define("BUG3_ADMIN_MENU_30",                    "Applications");
define("BUG3_ADMIN_MENU_40",                    "Categories");
define("BUG3_ADMIN_MENU_50",                    "Priorities");
define("BUG3_ADMIN_MENU_55",                    "Resolutions");
define("BUG3_ADMIN_MENU_60",                    "Statuses");
define("BUG3_ADMIN_MENU_70",                    "Application versions");
define("BUG3_ADMIN_MENU_98",                    "Import from Bugtracker2");
define("BUG3_ADMIN_MENU_99",                    "Read Me");

// Application ordering
define("BUG_LAN_APPS_ORDER_VALUE_0",            "Date created (ID) ascending");
define("BUG_LAN_APPS_ORDER_VALUE_1",            "Date created (ID) descending");
define("BUG_LAN_APPS_ORDER_VALUE_2",            "Name ascending");
define("BUG_LAN_APPS_ORDER_VALUE_3",            "Name descending");

define("BUG3_ADMIN_TEMPLATE_TYPE_APPS",         "apps");
define("BUG3_ADMIN_TEMPLATE_TYPE_APP",          "app");
define("BUG3_ADMIN_TEMPLATE_TYPE_USE_GLOBAL",   "Use global template");

define("BUG3_ADMIN_PREFS_ADMIN_EDIT",           "Admin edit");
define("BUG3_ADMIN_PREFS_ADMIN_EDIT_1",         "");
define("BUG3_ADMIN_PREFS_ADMIN_EDIT_2",         "Checking this allows all admins view and edit privileges to all applications and bugs, overriding any other userlcass settings.");
define("BUG3_ADMIN_PREFS_AJAX",                 "Ajax");
define("BUG3_ADMIN_PREFS_AJAX_1",               "");
define("BUG3_ADMIN_PREFS_AJAX_2",               "Enables Ajax functionlity for page navigation, this can improve performance and reduce server load");
define("BUG3_ADMIN_PREFS_APPS_PER_PAGE",        "Applications per page");
define("BUG3_ADMIN_PREFS_APPS_PER_PAGE_1",      "");
define("BUG3_ADMIN_PREFS_APPS_PER_PAGE_2",      "The number of applications that will be listed on a the applications list page before paging is invoked.");
define("BUG3_ADMIN_PREFS_BUGS_PER_PAGE",        "Bugs per page");
define("BUG3_ADMIN_PREFS_BUGS_PER_PAGE_1",      "");
define("BUG3_ADMIN_PREFS_BUGS_PER_PAGE_2",      "The number of bugs that will be listed on a the Bugs list page before paging is invoked.");
define("BUG3_ADMIN_PREFS_GLOBALCLASS",          "Bugtracker access");
define("BUG3_ADMIN_PREFS_GLOBALCLASS_1",        "");
define("BUG3_ADMIN_PREFS_GLOBALCLASS_2",        "Select the userclass for users who are allowed to access Bugtracker3. Note: individual application access can be futher restricted on the Applications admin page.");
define("BUG3_ADMIN_PREFS_NOTIFY_NEW",           "New bugs");
define("BUG3_ADMIN_PREFS_NOTIFY_NEW_1",         "");
define("BUG3_ADMIN_PREFS_NOTIFY_NEW_2",         "Select the notification preference for new bugs");
define("BUG3_ADMIN_PREFS_NOTIFY_EDIT",          "Bugs updates");
define("BUG3_ADMIN_PREFS_NOTIFY_EDIT_1",        "");
define("BUG3_ADMIN_PREFS_NOTIFY_EDIT_2",        "Select the notification preference for bug updates");
define("BUG3_ADMIN_PREFS_NOTIFY_OWNER",         "Preferences for Application Owner");
define("BUG3_ADMIN_PREFS_NOTIFY_POSTER",        "Preferences for Bug Poster");
define("BUG3_ADMIN_PREFS_NOTIFY_COMMENT",       "Comments");
define("BUG3_ADMIN_PREFS_NOTIFY_COMMENT_1",     "");
define("BUG3_ADMIN_PREFS_NOTIFY_COMMENT_2",     "Select the notification preference for comments being added to a bug");
define("BUG3_ADMIN_PREFS_NOTIFY_DEV_COMMENT",   "Developer Comemnts");
define("BUG3_ADMIN_PREFS_NOTIFY_DEV_COMMENT_1", "");
define("BUG3_ADMIN_PREFS_NOTIFY_DEV_COMMENT_2", "Select the notification preference for developer comments being added to a bug");
define("BUG3_ADMIN_PREFS_ORDER",                "Application list order");
define("BUG3_ADMIN_PREFS_ORDER_1",              "");
define("BUG3_ADMIN_PREFS_ORDER_2",              "Select the order to display the applications on the main application list page");
define("BUG3_ADMIN_PREFS_PAGE_TITLE",           "Page title");
define("BUG3_ADMIN_PREFS_PAGE_TITLE_1",         "");
define("BUG3_ADMIN_PREFS_PAGE_TITLE_2",         "Title prefix that will be displayed at the top of each page");
define("BUG3_ADMIN_PREFS_SEPARATOR",            "Breadcrumb separator");
define("BUG3_ADMIN_PREFS_SEPARATOR_1",          "");
define("BUG3_ADMIN_PREFS_SEPARATOR_2",          "Used to seperate the different elements of the page title when displayed as a bredcrumb trail");
define("BUG3_ADMIN_PREFS_TEMPLATE",             "Global Template");
define("BUG3_ADMIN_PREFS_TEMPLATE_1",           "");
define("BUG3_ADMIN_PREFS_TEMPLATE_2",           "The template to be used for all pages not relating to a single application and all applications that use the global template.");
define("BUG3_ADMIN_PREFS_TOOLTIPS",             "Tooltips");
define("BUG3_ADMIN_PREFS_TOOLTIPS_1",           "");
define("BUG3_ADMIN_PREFS_TOOLTIPS_2",           "Turns tooltip display on or off");
define("BUG3_ADMIN_PREFS_USE_BBCODES",          "BB codes");
define("BUG3_ADMIN_PREFS_USE_BBCODES_1",        "");
define("BUG3_ADMIN_PREFS_USE_BBCODES_2",        "Select a an option to allow BB codes to be posted with bug descriptions and developers comments.");
define("BUG3_ADMIN_PREFS_USE_BBCODES_KEY_0",    "None");
define("BUG3_ADMIN_PREFS_USE_BBCODES_KEY_1",    "Standard");
define("BUG3_ADMIN_PREFS_USE_BBCODES_KEY_2",    "Standard with tooltips");
define("BUG3_ADMIN_PREFS_USE_EMOTES",           "Allow emoticons");
define("BUG3_ADMIN_PREFS_USE_EMOTES_1",         "");
define("BUG3_ADMIN_PREFS_USE_EMOTES_2",         "Check to allow emoticons to be posted with bug descriptions and developers comments.");

define("BUG3_ADMIN_MENUS_SUMMARY_TITLE",        "Summary title");
define("BUG3_ADMIN_MENUS_SUMMARY_TITLE_1",      "");
define("BUG3_ADMIN_MENUS_SUMMARY_TITLE_2",      "Title for the overall summary menu.");
define("BUG3_ADMIN_MENUS_APPLICATION_TITLE",    "Application title");
define("BUG3_ADMIN_MENUS_APPLICATION_TITLE_1",  "");
define("BUG3_ADMIN_MENUS_APPLICATION_TITLE_2",  "Title for the application summary menu.");

define("BUG3_ADMIN_APP_NAME",                   "Name");
define("BUG3_ADMIN_APP_NAME_1",                 "");
define("BUG3_ADMIN_APP_NAME_2",                 "");
define("BUG3_ADMIN_APP_DESCRIPTION",            "Description");
define("BUG3_ADMIN_APP_DESCRIPTION_1",          "");
define("BUG3_ADMIN_APP_DESCRIPTION_2",          "");
define("BUG3_ADMIN_APP_ICON",                   "Icon");
define("BUG3_ADMIN_APP_ICON_1",                 "");
define("BUG3_ADMIN_APP_ICON_2",                 "Select an icon for this application");
define("BUG3_ADMIN_APP_TYPE",                   "Type");
define("BUG3_ADMIN_APP_TYPE_1",                 "");
define("BUG3_ADMIN_APP_TYPE_2",                 "An indication of the application type - different types can have different template entries");
define("BUG3_ADMIN_APP_CURRENT_VER",            "Current version");
define("BUG3_ADMIN_APP_CURRENT_VER_1",          "");
define("BUG3_ADMIN_APP_CURRENT_VER_2",          "Select this current version for this application, normally this is the most recently released version");
define("BUG3_ADMIN_APP_VISIBLE",                "Visibile");
define("BUG3_ADMIN_APP_VISIBLE_1",              "");
define("BUG3_ADMIN_APP_VISIBLE_2",              "When you uncheck this, only Admins, Owners and Edit Class members see this Application");
define("BUG3_ADMIN_APP_CLOSED",                 "Closed");
define("BUG3_ADMIN_APP_CLOSED_1",               "");
define("BUG3_ADMIN_APP_CLOSED_2",               "Closed applications can not have new bugs posted to them. Existing bugs can still be edited.");
define("BUG3_ADMIN_APP_POSTCLASS",              "Post Class");
define("BUG3_ADMIN_APP_POSTCLASS_1",            "");
define("BUG3_ADMIN_APP_POSTCLASS_2",            "Select the userclass that is allowed to post bugs for this application");
define("BUG3_ADMIN_APP_EDITCLASS",              "Developer Class");
define("BUG3_ADMIN_APP_EDITCLASS_1",            "");
define("BUG3_ADMIN_APP_EDITCLASS_2",            "Select the userclass for developers of this application. Developers can edit bugs, manage relationships and add developer comments.");
define("BUG3_ADMIN_APP_USERCLASS",              "View Class");
define("BUG3_ADMIN_APP_USERCLASS_1",            "");
define("BUG3_ADMIN_APP_USERCLASS_2",            "Select the userclass that is allowed to view this application");
define("BUG3_ADMIN_APP_OWNER",                  "Owner");
define("BUG3_ADMIN_APP_OWNER_1",                "");
define("BUG3_ADMIN_APP_OWNER_2",                "Select an owner for this application");
define("BUG3_ADMIN_APP_CATEGORY",               "Categories");
define("BUG3_ADMIN_APP_CATEGORY_1",             "");
define("BUG3_ADMIN_APP_CATEGORY_2",             "Select the categories to be allowed for this application");
define("BUG3_ADMIN_APP_CATEGORY_DEFAULT",       "Default Category");
define("BUG3_ADMIN_APP_CATEGORY_DEFAULT_1",     "");
define("BUG3_ADMIN_APP_CATEGORY_DEFAULT_2",     "");
define("BUG3_ADMIN_APP_PRIORITY_NAMES",         "Priorities");
define("BUG3_ADMIN_APP_PRIORITY_NAMES_1",       "");
define("BUG3_ADMIN_APP_PRIORITY_NAMES_2",       "Select the priorities to be allowed for this application");
define("BUG3_ADMIN_APP_PRIORITY_DEFAULT",       "Default Priority");
define("BUG3_ADMIN_APP_PRIORITY_DEFAULT_1",     "");
define("BUG3_ADMIN_APP_PRIORITY_DEFAULT_2",     "");
define("BUG3_ADMIN_APP_RESOLUTION",             "Resolutions");
define("BUG3_ADMIN_APP_RESOLUTION_1",           "");
define("BUG3_ADMIN_APP_RESOLUTION_2",           "Select the resolutions to be allowed for this application");
define("BUG3_ADMIN_APP_RESOLUTION_DEFAULT",     "Default Resolution");
define("BUG3_ADMIN_APP_RESOLUTION_DEFAULT_1",   "");
define("BUG3_ADMIN_APP_RESOLUTION_DEFAULT_2",   "");
define("BUG3_ADMIN_APP_STATUS",                 "Status");
define("BUG3_ADMIN_APP_STATUS_1",               "");
define("BUG3_ADMIN_APP_STATUS_2",               "Select the statuses to be allowed for this application");
define("BUG3_ADMIN_APP_STATUS_DEFAULT",         "Default Status");
define("BUG3_ADMIN_APP_STATUS_DEFAULT_1",       "");
define("BUG3_ADMIN_APP_STATUS_DEFAULT_2",       "");
define("BUG3_ADMIN_APP_TEMPLATE",               "Template");
define("BUG3_ADMIN_APP_TEMPLATE_1",             "");
define("BUG3_ADMIN_APP_TEMPLATE_2",             "Select a template to be used for displaying this applications pages");
define("BUG3_ADMIN_APP_DEFAULTS",               "Default values for bugs");

define("BUG3_ADMIN_APPVER_APP",                 "Application");
define("BUG3_ADMIN_APPVER_APP_1",               "");
define("BUG3_ADMIN_APPVER_APP_2",               "Select the application to assign a version to");
define("BUG3_ADMIN_APPVER_VERSION",             "Version");
define("BUG3_ADMIN_APPVER_VERSION_1",           "");
define("BUG3_ADMIN_APPVER_VERSION_2",           "Enter the version identifier");
define("BUG3_ADMIN_APPVER_DESCRIPTION",         "Description");
define("BUG3_ADMIN_APPVER_DESCRIPTION_1",       "");
define("BUG3_ADMIN_APPVER_DESCRIPTION_2",       "");

define("BUG3_ADMIN_CATEGORY_NAME",              "Name");
define("BUG3_ADMIN_CATEGORY_NAME_1",            "");
define("BUG3_ADMIN_CATEGORY_NAME_2",            "");
define("BUG3_ADMIN_CATEGORY_DESCRIPTION",       "Description");
define("BUG3_ADMIN_CATEGORY_DESCRIPTION_1",     "");
define("BUG3_ADMIN_CATEGORY_DESCRIPTION_2",     "");

define("BUG3_ADMIN_PRIORITY_NAME",              "Name");
define("BUG3_ADMIN_PRIORITY_NAME_1",            "");
define("BUG3_ADMIN_PRIORITY_NAME_2",            "");
define("BUG3_ADMIN_PRIORITY_DESCRIPTION",       "Description");
define("BUG3_ADMIN_PRIORITY_DESCRIPTION_1",     "");
define("BUG3_ADMIN_PRIORITY_DESCRIPTION_2",     "");
define("BUG3_ADMIN_PRIORITY_COLOR",             "Color");
define("BUG3_ADMIN_PRIORITY_COLOR_1",           "");
define("BUG3_ADMIN_PRIORITY_COLOR_2",           "Used as a backgroud colour when displaying some bug fields");
define("BUG3_ADMIN_PRIORITY_ORDER",             "Order");
define("BUG3_ADMIN_PRIORITY_ORDER_1",           "");
define("BUG3_ADMIN_PRIORITY_ORDER_2",           "A number to indicate where this priority will appear in the list of priorities");

define("BUG3_ADMIN_RESOLUTION_NAME",            "Name");
define("BUG3_ADMIN_RESOLUTION_NAME_1",          "");
define("BUG3_ADMIN_RESOLUTION_NAME_2",          "");
define("BUG3_ADMIN_RESOLUTION_DESCRIPTION",     "Description");
define("BUG3_ADMIN_RESOLUTION_DESCRIPTION_1",   "");
define("BUG3_ADMIN_RESOLUTION_DESCRIPTION_2",   "");

define("BUG3_ADMIN_STATUS_NAME",                "Name");
define("BUG3_ADMIN_STATUS_NAME_1",              "");
define("BUG3_ADMIN_STATUS_NAME_2",              "");
define("BUG3_ADMIN_STATUS_DESCRIPTION",         "Description");
define("BUG3_ADMIN_STATUS_DESCRIPTION_1",       "");
define("BUG3_ADMIN_STATUS_DESCRIPTION_2",       "");

define("BUG3_ADMIN_IMPORT_EMPTY",               "Empty Bugtracker3 DB");
define("BUG3_ADMIN_IMPORT_EMPTY_1",             "");
define("BUG3_ADMIN_IMPORT_EMPTY_2",             "Empties everything from the Bugtracker3 database before importing from bugtracker2");
define("BUG3_ADMIN_IMPORT_MERGE",               "Merge Applications");
define("BUG3_ADMIN_IMPORT_MERGE_1",             "");
define("BUG3_ADMIN_IMPORT_MERGE_2",             "Merges applications with the same name in to one application - use when you have multiple versions of the same application in Bugtracker2.");
define("BUG3_ADMIN_IMPORT_COMMENTS",            "Convert comments");
define("BUG3_ADMIN_IMPORT_COMMENTS_1",          "");
define("BUG3_ADMIN_IMPORT_COMMENTS_2",          "Copies any comments associated with Bugtracker2 bugs and associates them with the bug imported in to Bugtracker3.");
define("BUG3_ADMIN_IMPORT_DEBUG",               "Debug");
define("BUG3_ADMIN_IMPORT_DEBUG_1",             "");
define("BUG3_ADMIN_IMPORT_DEBUG_2",             "Turn debugging on, enable if you are having problems importing");
define("BUG3_ADMIN_IMPORT_GO",                  "");
define("BUG3_ADMIN_IMPORT_GO_1",                "");
define("BUG3_ADMIN_IMPORT_GO_2",                "");
define("BUG3_ADMIN_IMPORT_GO_3",                "Import");

define("BUG3_ADMIN_IMPORT_ERROR",               "Error... ");
define("BUG3_ADMIN_IMPORT_EMPTYING_DB",         "Emptying the Bugtracker3 DB");
define("BUG3_ADMIN_IMPORT_EMPTYING",            "Emptying table... ");
define("BUG3_ADMIN_IMPORT_COLLECTING_INFO",     "Collecting information from Bugtracker2");
define("BUG3_ADMIN_IMPORT_COLLECTING_APP",      " applications found");
define("BUG3_ADMIN_IMPORT_COLLECTING_CAT",      " unique categories found");
define("BUG3_ADMIN_IMPORT_COLLECTING_PRI",      " unique priorities found");
define("BUG3_ADMIN_IMPORT_COLLECTING_RES",      " unique resolutions found");
define("BUG3_ADMIN_IMPORT_COLLECTING_STA",      " unique statuses found");
define("BUG3_ADMIN_IMPORT_COLLECTING_BUG",      " bugs found");
define("BUG3_ADMIN_IMPORT_COLLECTING_REL",      " relationships found");
define("BUG3_ADMIN_IMPORT_IMPORTING",           "Importing from Bugtracker2");
define("BUG3_ADMIN_IMPORT_IMPORTING_CAT",       "Importing categories");
define("BUG3_ADMIN_IMPORT_IMPORTING_PRI",       "Importing priorities");
define("BUG3_ADMIN_IMPORT_IMPORTING_RES",       "Importing resolutions");
define("BUG3_ADMIN_IMPORT_IMPORTING_STA",       "Importing statuses");
define("BUG3_ADMIN_IMPORT_IMPORTING_APP",       "Importing applications");
define("BUG3_ADMIN_IMPORT_IMPORTING_BUG",       "Importing bugs");
define("BUG3_ADMIN_IMPORT_IMPORTING_REL",       "Importing relationships");
define("BUG3_ADMIN_IMPORT_IMPORTING_DEV",       "Importing developer comments");
define("BUG3_ADMIN_IMPORT_IMPORTED",            "Imported ");
define("BUG3_ADMIN_IMPORT_DEVC_IMPORT",         "[Imported from Bugtracker2] ");
define("BUG3_ADMIN_IMPORT_IMPORTING_APV",       "Importing application versions");
define("BUG3_ADMIN_IMPORT_DONE",                "Importing complete");
define("BUG3_ADMIN_IMPORT_DONE_CHECK",          "Everything looks OK, but please check the above for any unexpected errors.");
define("BUG3_ADMIN_IMPORT_DONE_CHECK_ERRORS",   " error(s) - please check the above for more details. You may need to re-run with debug turned on to get more information.");
define("BUG3_ADMIN_IMPORT_MERGING",             "Merging applications");
define("BUG3_ADMIN_IMPORT_MERGE_APP",           "Merging ");
define("BUG3_ADMIN_IMPORT_MERGE_NUM_APPS",      " applications merged");
define("BUG3_ADMIN_IMPORT_MERGE_NUM_BUGS",      " bugs moved");
define("BUG3_ADMIN_IMPORT_MERGE_VERSION",       "...merging version ");
define("BUG3_ADMIN_IMPORT_MERGE_NOTHING",       "...nothing to merge");
define("BUG3_ADMIN_IMPORT_COMMENTS_CONVERTING", "Converting comments");
define("BUG3_ADMIN_IMPORT_COMMENTS_DONE",       "converted ");
//define("BUG3_ADMIN_IMPORT_",   " ");

// TODO admin help stuff
define("BUG3_ADMIN_HELP_00",                     BUG3_ADMIN_PLUGIN." Help");

define("BUG3_ADMIN_HELP_CAPT_00",                "General Preferences");
define("BUG3_ADMIN_HELP_TEXT_00",                "Use this page to set global preference options for Bugtracker3.");

define("BUG3_ADMIN_HELP_CAPT_10",                "Application Preferences");
define("BUG3_ADMIN_HELP_TEXT_10",                "Use this page to set preferences for applications list.");

define("BUG3_ADMIN_HELP_CAPT_20",                "Applications");
define("BUG3_ADMIN_HELP_TEXT_20",                "Use this page to add, update and delete applications and set the preference options for individual applications.");
?>
