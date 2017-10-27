<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        Plugin: Tutorial Archiver
|        Version: 2.0
|        Original plugin by: Jordan 'Glasseater' Mellow, 2007
|
|        Modded and Revised by: e107 Italia in 2013
|        Email: info@e107italia.org
|        Website: www.e107italia.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+----------------------------------------------------------------------------------------------------+
*/

// admin_menu.php // Added by e107 Italia
define("TUT_ADMIN_MENUTITLE", "Tutorial Archive Options");
define("TUT_ADMIN_MENU_1", "Preferences");
define("TUT_ADMIN_MENU_2", "New Category");
define("TUT_ADMIN_MENU_3", "Remove Category");
define("TUT_ADMIN_MENU_4", "New Tutorial");
define("TUT_ADMIN_MENU_5", "Remove Tutorial");
define("TUT_ADMIN_MENU_6", "View User Submissions");
define("TUT_ADMIN_MENU_7", "View Statistics");

// admin_add.php // Added by e107 Italia
define("TUT_ADMIN_SELECT", "-- Select one --");


define("TUT_TITLE", "Tutorial Archives");
define("TUT_ADMIN_TITLE", "Tutorial Archive Management");
define("TUT_PREVIEW_TITLE", "Preview...");
define("TUT_SUBM_TITLE", "User Submission");
define("TUT_SUBM_AUTH", "Sorry, but you don't have the right permissions"); // missing string Added by e107 Italia
define("TUT_MSSG_CHANGE", "Configuration settings changed...");
if($pref['tuts_menulist'] == 'new'){
	define("TUT_MENU_TITLE", "Newest Tutorials");
}else if($pref['tuts_menulist'] == 'views'){
	define("TUT_MENU_TITLE", "Most Viewed Tutorials");
}else{
	define("TUT_MENU_TITLE", "Top Rated Tutorials");
}

define("TUT_ERROR_ADDCAT", "Error: Could not add new category to the database.");
define("TUT_SUCC_ADDCAT", "New category added successfully...");
define("TUT_ERROR_ADDTUT", "Error: Could not add new tutorial to the database.");
define("TUT_SUCC_ADDTUT", "New tutorial added successfully...");
define("TUT_ERROR_MISS", "Error: A required field was left blank...");

define("TUT_CONF_L1", "<b>Category Order Field</b><br />Choose which field catagories will be ordered by.");
define("TUT_CONF_L6", "<b>Category Order Direction</b><br />Ascending or Descending.");
define("TUT_CONF_L9", "<b>Tutorial Order Field</b><br />Choose which field tutorials will be ordered by.");
define("TUT_CONF_L12", "<b>Tutorial Order Direction</b><br />Ascending or Descending.");
define("TUT_CONF_L21", "<b>Number of Tutorials Per Page</b><br />The number of tutorials listed on a page.");
define("TUT_CONF_L16", "<b>Advanced Menu Mode</b><br />Which tutorials to show in the Advanced Menu.");
define("TUT_CONF_L20", "<b>Number in Menu</b><br />How many tutorials to show in the Advanced Menu.");
define("TUT_CONF_L24", "<b>Allow User Submissions</b>");
define("TUT_CONF_L22", "<b>Allow User Notification Email</b><br />Send an email to the user who submitted their tutorial when it has been approved.");
define("TUT_CONF_L23", "<b>Kill Submission After Timeout</b><br />Delete the submission after a given number of seconds. Leave 0 for no timeout.");

define("TUT_CONF_L2", "ID (order submitted)");
define("TUT_CONF_L3", "Title");
define("TUT_CONF_L4", "Author");
define("TUT_CONF_L5", "Tutorials Indexed");
define("TUT_CONF_L7", "Descending");
define("TUT_CONF_L8", "Ascending");
define("TUT_CONF_L10", "Views");
define("TUT_CONF_L11", "Date Accepted");
define("TUT_CONF_L17", "Newest");
define("TUT_CONF_L18", "Most Viewed");
define("TUT_CONF_L19", "Top Rated");

define("TUT_TADD_L1", "<b>Category:</b><br />Which category should the tutorial will be placed in?");
define("TUT_TADD_L2", "<b>Tutorial Title:</b><br />The title of the tutorial, make sure it is somehow related with the tutorial.");
define("TUT_TADD_L3", "<b>Short Description:</b><br />A short description of what the tutorial teaches.");
define("TUT_TADD_L4", "<b>Long Description:</b><br />The tutorial.");
define("TUT_TADD_L5", "<b>Tutorial Icon</b><br />Choose icon for this tutorial.<br />(you may also use a URL to another website)");
define("TUT_TADD_L6", "No icons found in directory...");

define("TUT_ADD_L", "<b></b><br />");

define("TUT_CADD_L1", "<b>Category Name:</b><br />What should this category's name be?");
define("TUT_CADD_L2", "<b>Category Description:</b><br />A little bit of text describing the category's content.");
define("TUT_CADD_L3", "<b>Category Icon</b><br />Choose icon for this category.<br />(you may also use a URL to another website)");
define("TUT_CADD_L4", "No icons found in directory...");

define("TUT_BUTTON_VIEWICON", "View Icons");
define("TUT_BUTTON_SUBMIT", "Submit");
define("TUT_BUTTON_PREVIEW", "Preview");
define("TUT_BUTTON_RESET", "Reset");
define("TUT_BUTTON_REMOVE", "Remove");

define("TUT_VIEW_VIEWS", "views");
define("TUT_VIEW_BY", "By:");
define("TUT_VIEW_ON", "on");
define("TUT_VIEW_IN", "in");
define("TUT_VIEW_INDEXED", "tutorials");
define("TUT_VIEW_NOTUTS", "There are no tutorials indexed in this category.");

define("TUT_ACC_ACCEPT", "Accept this submission and make it publicly viewable?");
define("TUT_ACC_REJECT", "Reject this submission?");
define("TUT_ACC_REASON", "Please enter a reason for rejection.");
define("TUT_ACC_COMPL_ACCEPT", "Tutorial Successfully Accepted...");
define("TUT_ACC_FAIL_ACCEPT", "Tutorial Could Not Be Accepted...");
define("TUT_ACC_COMPL_REJECT", "Tutorial Successfully Rejected...");
define("TUT_ACC_FAIL_REJECT", "Tutorial Could Not Be Rejected...");
define("TUT_ACC_COMPL_EMAIL", "Email sent to {USERMAIL}.");
define("TUT_ACC_FAIL_EMAIL", "Email could not be sent to {USERMAIL}.");
define("TUT_ACC_SHORTDESC", "Short Description:");

define("TUT_REM_CAT_METHOD_DELETE", "Delete All");
define("TUT_REM_CAT_METHOD_MOVE", "Move to -> ");
define("TUT_REM_CAT_SUCC", "Category deleted successfully...");
define("TUT_REM_CAT_FAIL", "Category could not be deleted!");
define("TUT_REM_CAT_DEL_SUCC", "Tutorials deleted successfully...");
define("TUT_REM_CAT_DEL_FAIL", "Tutorials could not be deleted!");
define("TUT_REM_CAT_MOV_SUCC", "Tutorials moved successfully...");
define("TUT_REM_CAT_MOV_FAIL", "Tutorials could not be moved!");
define("TUT_REM_CAT_NOEXIST", "The selected category does not exist!");
define("TUT_REM_TUT_SUCC", "Tutorial deleted successfully...");
define("TUT_REM_TUT_FAIL", "Tutorial could not be deleted!");
define("TUT_REM_TUT_NOEXIST", "The selected tutorial does not exist!");

define("TUT_STATS_ICON", "Icon");
define("TUT_STATS_NAME", "Name");
define("TUT_STATS_AUTHOR", "Author");
define("TUT_STATS_VIEWS", "Views");
define("TUT_STATS_INDEXED", "Indexed");

define("TUT_SUBM_AGREE", "By submitting this tutorial you agree to take full responsibility for any plagiarism and/or copyright violations. Also, you agree that the site(s)/administrator(s) your tutorial has been submitted to has full rights to all content within the tutorial and may edit your submission. If you do not agree to these terms, do not submit this form.");
define("TUT_SUBM_THANKS", "Thank you for your submission.<br />An administrator will review it and activate it if it passes examination.");
define("TUT_SUBM_LINK", "Submit A Tutorial");

define("TUT_EMAIL_SUBJ_ACCEPT", "Your tutorial was accepted!");
define("TUT_EMAIL_SUBJ_REJECT", "Your tutorial was rejected.");
define("TUT_EMAIL_MESSAGE_ACCEPT", "Congratulations, {USERNAME}!<br />The tutorial you submitted at {SITENAME} was accepted and is now publicly viewable. <br /><br/>To view your tutorial, please click the link below. If you have any questions or concerns regarding your tutorial or its usage, please email the administrator at {ADMINEMAIL}. <br /><br />Click here to view your tutorial: {TUTLINK}<br />");
define("TUT_EMAIL_MESSAGE_REJECT", "{USERNAME}, the tutorial you submitted at {SITENAME} was rejected do to the following reason:<br /><br />{REJECTREASON}<br /><br />If you have any questions or concerns, please email the administrator at: {ADMINEMAIL}");

if (defined("RATELAN_0")) define("TUT_RATELAN_0", RATELAN_0); else define("TUT_RATELAN_0", "vote");
if (defined("RATELAN_1")) define("TUT_RATELAN_1", RATELAN_1); else define("TUT_RATELAN_1", "votes");
if (defined("RATELAN_2")) define("TUT_RATELAN_2", RATELAN_2); else define("TUT_RATELAN_2", "How do you rate this item?");
if (defined("RATELAN_3")) define("TUT_RATELAN_3", RATELAN_3); else define("TUT_RATELAN_3", "Thank you for your vote.");
if (defined("RATELAN_4")) define("TUT_RATELAN_4", RATELAN_4); else define("TUT_RATELAN_4", "Not rated.");
if (defined("RATELAN_5")) define("TUT_RATELAN_5", RATELAN_5); else define("TUT_RATELAN_5", "Rate");
?>