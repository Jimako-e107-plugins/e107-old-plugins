<?php
/**
 * e107 Helper English language file
 * <b>CVS Details:</b>
 * <ul>
 * <li>$Source: k:\Websites\_repository\e107_plugins/e107helpers/languages/English.php,v $</li>
 * <li>$Date: 2008/08/24 20:51:40 $</li>
 * </ul>
 * @author     $Author: Owner $
 * @version    $Revision: 1.9.2.2 $
 * @copyright  Released under the terms and conditions of the GNU General Public License (http://gnu.org).
 * @package e107Helper
 */

// **********************************************************************
// Some of these should not be in here as they are constants not language
// **********************************************************************


/**
 * English Language defines
 */

// prevent defines from appearing in phpDocs
/**#@+
 * @access private
 */

/**
 * General defines - DO NOT CHANGE text in {...}
 */
define("HELPER_LAN_01", "e107 Helper Project");
define("HELPER_LAN_02", "Helper classes and methods for plugin writers.");
define("HELPER_LAN_03", "Preferences have been saved");
define("HELPER_LAN_04", "Choose...");
define("HELPER_LAN_05", "Save Preferences");
define("HELPER_LAN_06", "Update successfull");
define("HELPER_LAN_07", "Upgrade successfull");
define("HELPER_LAN_08", "Documentation for this plugin can be found in the e107 wiki");
define("HELPER_LAN_09", "Database insert successfull");
define("HELPER_LAN_10", "Database update successfull");
define("HELPER_LAN_11", "Database delete successfull");
define("HELPER_LAN_12", "Database insert failed");
define("HELPER_LAN_13", "Database update failed");
define("HELPER_LAN_14", "Database delete failed");
define("HELPER_LAN_15", "Are you sure you want to delete this item");
define("HELPER_LAN_16", "Batch Item {ITEMNO}");
define("HELPER_LAN_17", "Database insert(s) successfull - {ITEMS} record(s) inserted");
define("HELPER_LAN_18", "Click to edit");
define("HELPER_LAN_19", "Available");
define("HELPER_LAN_20", "Selected");

// Batch processing
define("HELPER_LAN_BATCH_1", "Number of batch groups");
define("HELPER_LAN_BATCH_2", "Tick each fields below that should appear in the repeating group");
define("HELPER_LAN_BATCH_3", "Setting the value to 1 turns off batch processing.");

define("HELPER_LAN_CREATE",         "Create");
define("HELPER_LAN_UPDATE",         "Update");
define("HELPER_LAN_EDIT",           "Edit");
define("HELPER_LAN_DELETE",         "Delete");
define("HELPER_LAN_PRINT",          "Print");
define("HELPER_LAN_EMPTY",          "There are no entries");
define("HELPER_LAN_EXISTING",       "Existing entries");
define("HELPER_LAN_DELETE_CONFIRM", "Are you sure you want to delete this entry?");

// Admin menu
define("HELPER_LAN_ADMIN_MENU_TITLE", "Preferences");

define("HELPER_LAN_ADMIN_PAGE_0_NAME", "Read Me");
define("HELPER_LAN_ADMIN_PAGE_0_LINK", "admin_readme.php");
define("HELPER_LAN_ADMIN_PAGE_0_ID",   "readme");

define("HELPER_LAN_ADMIN_PAGE_1_NAME", "Logger");
define("HELPER_LAN_ADMIN_PAGE_1_LINK", "admin_logger_prefs.php");
define("HELPER_LAN_ADMIN_PAGE_1_ID",   "loggerprefs");

define("HELPER_LAN_ADMIN_PAGE_2_NAME", "CSS Styles");
define("HELPER_LAN_ADMIN_PAGE_2_LINK", "admin_style_prefs.php");
define("HELPER_LAN_ADMIN_PAGE_2_ID",   "styleprefs");

/**
 * Validation messages
 */
// general
define("HELPER_LAN_ERR_VAL_01", "The following errors were detected:");
define("HELPER_LAN_ERR_VAL_02", "this field is mandatory and must be entered");
define("HELPER_LAN_ERR_VAL_03", "the field must have at least <min> characters");
define("HELPER_LAN_ERR_VAL_04", "the field must have no more than <max> characters");
define("HELPER_LAN_ERR_VAL_05", "the field must be equal to or greater than <min>");
define("HELPER_LAN_ERR_VAL_06", "the field must be equal to or less than <max>");
// calendar tags
define("HELPER_LAN_ERR_VAL_CALENDAR_01", "invalid date value");
// color tags
define("HELPER_LAN_ERR_VAL_COLOR_01", "invalid colour code");
// decimal tags
define("HELPER_LAN_ERR_VAL_DECIMAL_01", "invalid decimal value");
// integer tags
define("HELPER_LAN_ERR_VAL_INTEGER_01", "invalid integer value");
// numeric tags
define("HELPER_LAN_ERR_VAL_NUMERIC_01", "invalid numeric value");
// custom fields
define("HELPER_LAN_ERR_VAL_CUSTOM_01", "The name field is mandatory and must be entered");
// upload tags
define("HELPER_LAN_ERR_VAL_UPLOAD_01", "Failed to find upload file");
define("HELPER_LAN_ERR_VAL_UPLOAD_02", "Failed to move uploaded file");
define("HELPER_LAN_ERR_VAL_UPLOAD_03", "No file selected");
define("HELPER_LAN_ERR_VAL_UPLOAD_04", "Invalid (empty) file selected");
define("HELPER_LAN_ERR_VAL_UPLOAD_05", "The filetype");
define("HELPER_LAN_ERR_VAL_UPLOAD_06", "is not allowed - the file has been deleted");
define("HELPER_LAN_ERR_VAL_UPLOAD_07", "File exceeds specified maximum size limit of {SIZELIMIT} - the file has been deleted.");

/**
 * Help text
 */
// Custom field fields
define("HELPER_LAN_CF_FIELD_SELECT_TYPE", "Select the field type to create");

define("HELPER_LAN_CF_FIELD_TEXT",        "Text");
define("HELPER_LAN_CF_FIELD_TEXTAREA",    "Textarea");
define("HELPER_LAN_CF_FIELD_SELECT",      "Select (list or dropdown)");
define("HELPER_LAN_CF_FIELD_DATE",        "Date");
define("HELPER_LAN_CF_FIELD_CHECKBOX",    "Checkbox");
define("HELPER_LAN_CF_FIELD_RADIO",       "Radio button(s)");

define("HELPER_LAN_CF_LABEL_NAME",        "Name");
define("HELPER_LAN_CF_LABEL_LABEL",       "Label");
define("HELPER_LAN_CF_LABEL_CSS_FIELD",   "CSS Class For Field");
define("HELPER_LAN_CF_LABEL_CSS_LABEL",   "CSS Class For Label");
define("HELPER_LAN_CF_LABEL_SIZE",        "Size");
define("HELPER_LAN_CF_LABEL_MAX_LEN",     "Maximum Length");
define("HELPER_LAN_CF_LABEL_MANDATORY",   "Mandatory");
define("HELPER_LAN_CF_LABEL_ROWS",        "Rows");
define("HELPER_LAN_CF_LABEL_COLS_WIDTH",  "Columns/Width");
define("HELPER_LAN_CF_LABEL_FIRST_ROW",   "First row");
define("HELPER_LAN_CF_LABEL_OPTIONS",     "Options");
define("HELPER_LAN_CF_LABEL_YEAR_FROM",   "Year From");
define("HELPER_LAN_CF_LABEL_YEAR_TO",     "Year To");
define("HELPER_LAN_CF_LABEL_VALUE",       "Value");
define("HELPER_LAN_CF_LABEL_TEXT",        "Text");
define("HELPER_LAN_CF_LABEL_TEXT_VALUE",  "Text/Value");

define("HELPER_LAN_CF_HELP_NAME",         "The HTML name attribute for this field - must only be letters and numbers");
define("HELPER_LAN_CF_HELP_LABEL",        "The label for this field as displayed to the user");
define("HELPER_LAN_CF_HELP_CSS_FIELD",    "The CSS class name for the field");
define("HELPER_LAN_CF_HELP_CSS_LABEL",    "The CSS class name for the label");
define("HELPER_LAN_CF_HELP_SIZE",         "The size attribute for the field, e.g. width for text fields, height for list boxes");
define("HELPER_LAN_CF_HELP_MAX_LEN",      "The maximum length for the field");
define("HELPER_LAN_CF_HELP_MANDATORY",    "Check this to make the field mandatory");
define("HELPER_LAN_CF_HELP_ROWS",         "Number of rows to use");
define("HELPER_LAN_CF_HELP_COLS_WIDTH",   "Number of columns to use");
//define("HELPER_LAN_CF_HELP_COLS_WIDTH",   "Number of columns (if an integer, e.g. 10) or width (if a percentage, e.g. 90%) to use");
define("HELPER_LAN_CF_HELP_FIRST_ROW",    "Value for the first row in the list");
define("HELPER_LAN_CF_HELP_OPTIONS",      "Other list options (rows)");
define("HELPER_LAN_CF_HELP_YEAR_FROM",    "The smallest year allowed to be selected");
define("HELPER_LAN_CF_HELP_YEAR_TO",      "The bigest year allowed to be selected");
define("HELPER_LAN_CF_HELP_VALUE",        "The submitted value");
define("HELPER_LAN_CF_HELP_TEXT",         "The displayed text");
define("HELPER_LAN_CF_HELP_TEXT_VALUE",   "The displayed text/submitted value");

// Processing messages
define("HELPER_LAN_ERR_PROC_01", "*** Unknown Javascript event: ");

// Access table tag constants
define("HELPER_ACCESSTABLE_EVERYONE",        "Everyone");
define("HELPER_ACCESSTABLE_GUESTS",          "Guests only");
define("HELPER_ACCESSTABLE_MEMBERS",         "Members only");
define("HELPER_ACCESSTABLE_ADMINISTRATORS",  "Administrators only");
define("HELPER_ACCESSTABLE_NOONE",           "No One (inactive)");
define("HELPER_ACCESSTABLE_MAIN_ADMIN",      "Main Admin");
define("HELPER_ACCESSTABLE_READONLY",        "Read only");

// Rating text, use already defined values (usually e107 0.7) if they are available
if (defined("RATELAN_0")) define("HELPER_RATELAN_0", RATELAN_0); else define("HELPER_RATELAN_0", "vote");
if (defined("RATELAN_1")) define("HELPER_RATELAN_1", RATELAN_1); else define("HELPER_RATELAN_1", "votes");
if (defined("RATELAN_2")) define("HELPER_RATELAN_2", RATELAN_2); else define("HELPER_RATELAN_2", "please rate this item?<br/>");
if (defined("RATELAN_3")) define("HELPER_RATELAN_3", RATELAN_3); else define("HELPER_RATELAN_3", "thank you for your vote");
if (defined("RATELAN_4")) define("HELPER_RATELAN_4", RATELAN_4); else define("HELPER_RATELAN_4", "not rated");
if (defined("RATELAN_5")) define("HELPER_RATELAN_5", RATELAN_5); else define("HELPER_RATELAN_5", "Rate");
if (defined("RATELAN_6")) define("HELPER_RATELAN_6", RATELAN_6); else define("HELPER_RATELAN_6", "You must be logged on to rate");

// Logger constants
define("HELPER_LOGGER_OFF_TEXT",       "Off");
define("HELPER_LOGGER_FATAL_TEXT",     "Fatal");
define("HELPER_LOGGER_ERROR_TEXT",     "Error");
define("HELPER_LOGGER_WARN_TEXT",      "Warning");
define("HELPER_LOGGER_INFO_TEXT",      "Info");
define("HELPER_LOGGER_DEBUG_TEXT",     "Debug");
define("HELPER_LOGGER_TRACE_TEXT",     "Trace");
define("HELPER_LOGGER_METHOD_ENTRY",   "Method entry");
define("HELPER_LOGGER_METHOD_EXIT",    "Method exit");
define("HELPER_LOGGER_METHOD_PARAM",   "Method param");
define("HELPER_LOGGER_METHOD_RETURN",  "Method return");
define("HELPER_LOGGER_VARIABLE_VALUE", "..Variable value");
define("HELPER_LOGGER_VALUE_NOT_SET",  "Value not set/supplied");

define("HELPER_LOGGER_PREFS_HDR_1",    "Set Logging Options For plugins The Use The Helper Logger Functionality");
define("HELPER_LOGGER_PREFS_01_0",     "Logger level");
define("HELPER_LOGGER_PREFS_01_1",     "Select the logger level");
define("HELPER_LOGGER_PREFS_01_2",     "Logger levels are cumulative, therefore , if Warning is selected then errors of type Fatal, Error and Warn will be reported.");

define("HELPER_STYLE_PREFS_HDR_1",     "CSS Class Names Used For Displaying Text In Forms");
define("HELPER_STYLE_PREFS_HDR_2",     "Style Names And Values For Various Form Elements");
define("HELPER_STYLE_PREFS_01_0",      "Label Text");
define("HELPER_STYLE_PREFS_01_1",      "The fields label text");
define("HELPER_STYLE_PREFS_01_2",      "e.g. forumheader3");
define("HELPER_STYLE_PREFS_02_0",      "Prompt Text");
define("HELPER_STYLE_PREFS_02_1",      "The text below the fields label");
define("HELPER_STYLE_PREFS_02_2",      "e.g. smalltext");
define("HELPER_STYLE_PREFS_03_0",      "Help Text");
define("HELPER_STYLE_PREFS_03_1",      "The text below the field");
define("HELPER_STYLE_PREFS_03_2",      "e.g. smalltext");
define("HELPER_STYLE_PREFS_04_0",      "Message Text");
define("HELPER_STYLE_PREFS_04_1",      "Text displayed at the top of the form");
define("HELPER_STYLE_PREFS_04_2",      "e.g. forumheader");
define("HELPER_STYLE_PREFS_05_0",      "Error Text");
define("HELPER_STYLE_PREFS_05_1",      "Message text for fields that are in error");
define("HELPER_STYLE_PREFS_05_2",      "e.g. searchhighlight");
define("HELPER_STYLE_PREFS_06_0",      "Submit button");
define("HELPER_STYLE_PREFS_06_1",      "Style to be used to display the 'submit' button at the bottom of the form");
define("HELPER_STYLE_PREFS_06_2",      "e.g. text-align:center;");

// Status info messages
define("HELPER_LAN_MSG_DEBUG",                  "Debug");
define("HELPER_LAN_MSG_ERROR",                  "Error");
define("HELPER_LAN_MSG_WARNING",                "Warning");
define("HELPER_LAN_MSG_INFORMATION",            "Information");
define("HELPER_LAN_MSG_FATAL",                  "Fatal Error");
define("HELPER_LAN_MSG_DB_ADD",                 "There was a problem adding the details in to the database, please try again. If the problem persists, contact the site administrator.");
define("HELPER_LAN_MSG_DB_UPDATE",              "There was a problem updating the details in the database, please try again. If the problem persists, contact the site administrator.");
define("HELPER_LAN_MSG_DEL_ARE_YOU_SURE",       "Are you sure you want to this item? Once deleted it cannot be restored.");
define("HELPER_LAN_MSG_MANDATORY",              " is mandatory");
define("HELPER_LAN_MSG_INVALID",                " is invalid");
define("HELPER_LAN_MSG_INCORRECT",              " is incorrect");
define("HELPER_LAN_MSG_NUMERIC",                " must be numeric");
define("HELPER_LAN_MSG_DATE",                   " must be a date");

/**#@-*/
?>