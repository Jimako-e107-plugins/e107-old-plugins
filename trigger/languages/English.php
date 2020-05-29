<?php
/*
+---------------------------------------------------------------+
| Trigger by bugrain (www.bugrain.plus.com)
| see plugin.php for version information
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/trigger/languages/English.php,v $
| $Revision: 1.5 $
| $Date: 2008/06/28 09:40:30 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// check English/admin/lan_admin.php for a list of common terms that you
// can use in your ADMIN area.
// By using these terms, your plugin will already be translated in many cases.

// Misc
define("TRIGGER_LAN_01",            "in");

// News post to forum
define("TRIGGER_LAN_N2F_01",        "News item posted");
define("TRIGGER_LAN_N2F_02",        "Click to discuss this news item in the forums");
define("TRIGGER_LAN_N2F_03",        "New Forum thread For This News Item");
define("TRIGGER_LAN_N2F_04",        "Subject");
define("TRIGGER_LAN_N2F_05",        "Forum");
define("TRIGGER_LAN_N2F_06",        "Post");
define("TRIGGER_LAN_N2F_07",        "Submit new thread");

define("TRIGGER_LAN_100",           "Installation successful...");
define("TRIGGER_LAN_101",           "Upgrade successful...");

define("TRIGGER_LAN_201",           "Upload auto approve - success");
define("TRIGGER_LAN_202",           "Upload auto approve - failure");
define("TRIGGER_LAN_203",           "Upload auto approve - error");

define("TRIGGER_LAN_ADMIN_MENU_10", "News to forum");
define("TRIGGER_LAN_ADMIN_MENU_20", "File uploads");
define("TRIGGER_LAN_ADMIN_MENU_30", "Submitted news");
define("TRIGGER_LAN_ADMIN_MENU_98", "Preferences");
define("TRIGGER_LAN_ADMIN_MENU_99", "Read me");

define("TRIGGER_LAN_PREFS_10_1",    "Enable");
define("TRIGGER_LAN_PREFS_10_1p",   "");
define("TRIGGER_LAN_PREFS_10_1h",   "Check this box to enable this trigger");
define("TRIGGER_LAN_PREFS_10_2",    "Forum text");
define("TRIGGER_LAN_PREFS_10_2p",   "");
define("TRIGGER_LAN_PREFS_10_2h",   "Text to be pre-pended to the forum post");
define("TRIGGER_LAN_PREFS_10_3",    "Forum");
define("TRIGGER_LAN_PREFS_10_3p",   "");
define("TRIGGER_LAN_PREFS_10_3h",   "The forum to post to");
define("TRIGGER_LAN_PREFS_10_4",    "Auto post");
define("TRIGGER_LAN_PREFS_10_4p",   "");
define("TRIGGER_LAN_PREFS_10_4h",   "Check this box to automatically post to the forum. When not checked, a form will be displayed to allow input of details to be posted to the forum.");
define("TRIGGER_LAN_PREFS_10_5",    "Link text");
define("TRIGGER_LAN_PREFS_10_5p",   "");
define("TRIGGER_LAN_PREFS_10_5h",   "Text to be appended to news post linking to the forum thread. Set blank for no link.");
define("TRIGGER_LAN_PREFS_10_6",    "Include News Summary");
define("TRIGGER_LAN_PREFS_10_6p",   "");
define("TRIGGER_LAN_PREFS_10_6h",   "Include the news summary text in the forum post.");
define("TRIGGER_LAN_PREFS_10_7",    "Include News body");
define("TRIGGER_LAN_PREFS_10_7p",   "");
define("TRIGGER_LAN_PREFS_10_7h",   "Length of news body text to include in the forum post, set to 'blank' to include all body text or '0' to include no body text.");
define("TRIGGER_LAN_PREFS_10_8",    "Continuation text");
define("TRIGGER_LAN_PREFS_10_8p",   "");
define("TRIGGER_LAN_PREFS_10_8h",   "Text to be appended to news body if it is truncated (e.g. '[more]', '...').");
define("TRIGGER_LAN_PREFS_10_9",    "Included extended news");
define("TRIGGER_LAN_PREFS_10_9p",   "");
define("TRIGGER_LAN_PREFS_10_9h",   "Length of extended news text to include in the forum post, set to 'blank' to include all body text or '0' to include no extended bews text.");
define("TRIGGER_LAN_PREFS_10_10",   "Extended continuation text");
define("TRIGGER_LAN_PREFS_10_10p",  "");
define("TRIGGER_LAN_PREFS_10_10h",  "Text to be appended to extended news text if it is truncated (e.g. '[more]', '...').");

define("TRIGGER_LAN_PREFS_20_1",    "Enable");
define("TRIGGER_LAN_PREFS_20_1p",   "");
define("TRIGGER_LAN_PREFS_20_1h",   "Check this box to enable this trigger");
define("TRIGGER_LAN_PREFS_20_2",    "Auto-approve");
define("TRIGGER_LAN_PREFS_20_2p",   "");
define("TRIGGER_LAN_PREFS_20_2h",   "Select the user class for auto-approval");
define("TRIGGER_LAN_PREFS_20_3",    "May be downloaded by");
define("TRIGGER_LAN_PREFS_20_3p",   "");
define("TRIGGER_LAN_PREFS_20_3h",   "Select the user class that can download auto-approvel uploads");
define("TRIGGER_LAN_PREFS_20_4",    "Download visible to");
define("TRIGGER_LAN_PREFS_20_4p",   "");
define("TRIGGER_LAN_PREFS_20_4h",   "Select the user class that auto-approved uploads are visible to");
define("TRIGGER_LAN_PREFS_20_5",    "Status");
define("TRIGGER_LAN_PREFS_20_5p",   "");
define("TRIGGER_LAN_PREFS_20_5h",   "Select the status of auto approved uploads");
define("TRIGGER_LAN_PREFS_20_6",    "Allow comments");
define("TRIGGER_LAN_PREFS_20_6p",   "");
define("TRIGGER_LAN_PREFS_20_6h",   "Tick to allow comments for auto-approved uploads");
define("TRIGGER_LAN_PREFS_20_7",    "Remove after auto-approve");
define("TRIGGER_LAN_PREFS_20_7p",   "");
define("TRIGGER_LAN_PREFS_20_7h",   "Tick to remove the file from the upload list after auto-approval");

define("TRIGGER_LAN_PREFS_30_1",    "Enable");
define("TRIGGER_LAN_PREFS_30_1p",   "");
define("TRIGGER_LAN_PREFS_30_1h",   "Check this box to enable this trigger");
define("TRIGGER_LAN_PREFS_30_2",    "Submit userclass");
define("TRIGGER_LAN_PREFS_30_2p",   "");
define("TRIGGER_LAN_PREFS_30_2h",   "Userclass of the users whos posts will be automatically approved");
define("TRIGGER_LAN_PREFS_30_3",    "View userclass");
define("TRIGGER_LAN_PREFS_30_3p",   "");
define("TRIGGER_LAN_PREFS_30_3h",   "Userclass for users who can view the posted news item.");
define("TRIGGER_LAN_PREFS_30_4",    "Append text");
define("TRIGGER_LAN_PREFS_30_4p",   "");
define("TRIGGER_LAN_PREFS_30_4h",   "Text to be appended to the news post. Set blank for no text.");
define("TRIGGER_LAN_PREFS_30_5",    "Append poster");
define("TRIGGER_LAN_PREFS_30_5p",   "");
define("TRIGGER_LAN_PREFS_30_5h",   "Append details of poster to news item");
define("TRIGGER_LAN_PREFS_30_6",    "Allow comments");
define("TRIGGER_LAN_PREFS_30_6p",   "");
define("TRIGGER_LAN_PREFS_30_6h",   "Allow comments to be posted against the news item");
define("TRIGGER_LAN_PREFS_30_7",    "Delete submitted");
define("TRIGGER_LAN_PREFS_30_7p",   "");
define("TRIGGER_LAN_PREFS_30_7h",   "Delete the submitted news details from the sbumitted news table.");
define("TRIGGER_LAN_PREFS_30_8",    "Approve message");
define("TRIGGER_LAN_PREFS_30_8p",   "");
define("TRIGGER_LAN_PREFS_30_8h",   "Text to be displayed to the user when submitted news is ato approved.");

define("TRIGGER_LAN_PREFS_98_1",    "Seperator");
define("TRIGGER_LAN_PREFS_98_1p",   "");
define("TRIGGER_LAN_PREFS_98_1h",   "");

define("TRIGGER_LAN_HELP_00_0",     "Help");

define("TRIGGER_LAN_HELP_10_0",     TRIGGER_LAN_ADMIN_MENU_10);
define("TRIGGER_LAN_HELP_10_1",     "Use this page to set the preferences for posting an entry to the forum when a news item is posted.");

define("TRIGGER_LAN_HELP_98_0",     TRIGGER_LAN_ADMIN_MENU_98);
define("TRIGGER_LAN_HELP_98_1",     "General preferences for Trigger.");
?>