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
| $Source: e:\_repository\e107_plugins/e107helpers_developer/languages/admin/English.php,v $
| $Revision: 1.1 $
| $Date: 2007/01/10 23:59:08 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Menu pages
define("EHD_LAN_ADMIN_MENU_10",           "Introduction");
define("EHD_LAN_ADMIN_MENU_11",           "Text");
define("EHD_LAN_ADMIN_MENU_12",           "Lists");
define("EHD_LAN_ADMIN_MENU_13",           "Buttons");
define("EHD_LAN_ADMIN_MENU_14",           "Calendar");
define("EHD_LAN_ADMIN_MENU_15",           "Custom");
define("EHD_LAN_ADMIN_MENU_50",           "Database");
define("EHD_LAN_ADMIN_MENU_51",           "Database (batch)");
define("EHD_LAN_ADMIN_MENU_52",           "Batch prefs");
define("EHD_LAN_ADMIN_MENU_53",           "File upload");
define("EHD_LAN_ADMIN_MENU_99",           "Read Me");

// Help text
define("EHD_LAN_ADMIN_HELP_10",           "<p>An introduction to this plugin.</p><p>Note that the labels for the fields on the following pages are the tag names for the fields that are used to define the type of field to be displayed. For example, on the <a href='admin_prefs.php?11'>Text</a> page the label <strong>decimal</strong> is the tag name for a field that only allows decimal values to be input.</p>");
define("EHD_LAN_ADMIN_HELP_11",           "<p>Text input fields come in several flavours that allow some basic data validation, for example, <strong>decimal</strong> or <strong>numeric</strong>.</p>");
define("EHD_LAN_ADMIN_HELP_12",           "<p>List fields can be used to select one or more values from a list of items.</p><p>The list data can be supplied by the programmer or, in some cases, will be obtained by e107 Helper - for example the <strong>accesstable</strong> list will list all userclasses without the programmer having to supply them.</p>");
define("EHD_LAN_ADMIN_HELP_13",           "<p>Checkboxes and radio buttons are used to denote a selection of one or more items - a kind of specialised list.</p><p>Standard buttons can also be included but the functionality behind the button must be supplied by the programmer</p><p>The <strong>Save Preferences</strong> button is supplied by default and does not need to be defined (though it can be ommitted and a custom button supplied if required).</p>");
define("EHD_LAN_ADMIN_HELP_14",           "<p>Calendar fields are used to input dates and times. Dates utilise the DHTML Date seelctor popup (supplied with e107).</p>");
define("EHD_LAN_ADMIN_HELP_15",           "<p>Custom fields are fields that are not standard HTML input controls.</p><p>Generally, they provide specific funtionality that makes life a little bit easier for the user.</p>");
define("EHD_LAN_ADMIN_HELP_50",           "<p>Add, edit and delete database records for a single table.</p><p>The drop down list of items at the top of the page is generated automtically from the database table definition (in the XML file) and the handling of the <strong>Create</strong>, <strong>Edit</strong> and <strong>Delete</strong> buttons is handled by e107 Helper.</p><p>Notice too that the drop down list is sorted by Name (descending) and shows both the item ID and Name values.</p>");
define("EHD_LAN_ADMIN_HELP_51",           "<p>Add, edit and delete database records for a single table.</p><p>The drop down list is sorted by Name (ascending) and only shows the Name field value.</p><p>On this page, the number of batch items that can be input is hard coded in the XML file as 3, but can be overridded using the <a href='admin_prefs.php?52'>Batch prefs</a> page.</p><p>Also, only the 1st batch item (which is mandatory) and any 'ticked' batch items are processed - other batch items (unticked) are ignored, even if they have values.</p><p>Notice also that when the edit button is selected to edit an item only one item is displayed, batch groups are not displayed in edit mode.</p>");
define("EHD_LAN_ADMIN_HELP_52",           "<p>On this page the administrator is allowed to choose how many batch groups appear on the <a href='admin_prefs.php?51'>Database (batch)</a> page.</p><p>Additionally, the fields that appear in the batch groups can be selected. For example, the userclass field could be left unticked to allow input of multiple items all for the same userclass.</p><p>The values are stroed as e107 preferences. The programmer must supply an XML file for these fields, the <strong>Number of batch groups</strong> preference is referenced in the XML for the data input form and each of the fields must jhave a corresponding preference here which is named the same as the field with '_pref' appended for this to work correctly.<p>");
define("EHD_LAN_ADMIN_HELP_53",           "<p>This form shows the file upload field in use. It uses the same database as the other admin pages for this plugin.</p><p>Notice that when an item is edited the upload field is converted to a drop down list that shows the files in the upload directory.</p><p>The directory to be used for file uploads must exists and must be writeable.</p><p>Notice also that this page does not show the userclass field to show that not all database table columns need to be defined (as long as they have a default value in the definition of the table).<p>");
define("EHD_LAN_ADMIN_HELP_99",           "<p>Plugin details and information.</p>");

// Admin prefs page 10
define("EHD_LAN_ADMIN_PREFS_10_01",       "What is this plugin?");
define("EHD_LAN_ADMIN_PREFS_10_02",       "Basically, it's a series of pages that are designed to show some of the features of The e107 Helper Project plugin.");
define("EHD_LAN_ADMIN_PREFS_10_03",       "The Helper plugin is written and maintained by me, bugrain. It's aim is to allow quicker development of e107 plugins by bringing together common functionality in one place.");
define("EHD_LAN_ADMIN_PREFS_10_04",       "Have a look through the rest of these pages to see what can be accomplished, then have a look a the PHP code that generates the pages to see how it's done - you'll find plenty of comments in the code to explain what's being done.");
define("EHD_LAN_ADMIN_PREFS_10_05",       "Most of the pages, if submitted, will save the field values are e107 preferences. A few of the pages demonstrate database access and so save values in database tables.");
define("EHD_LAN_ADMIN_PREFS_10_06",       "Note: some of the code in this plugin is there to demonstrate the Helper plugin and some of it is just there to make this plugin work. Feel free to copy the way I've organised the code. However, I make no claim that this is the best way to write an e107 plugin - but it works for me.");

define("EHD_LAN_ADMIN_PREFS_50_01",       "About these admin pages");
define("EHD_LAN_ADMIN_PREFS_50_02",       "Demonstration of text fields - text, numeric, textarea.");
define("EHD_LAN_ADMIN_PREFS_50_03",       "Demonstration of lists fields - lists, multiple select lists, drop down lists.");
define("EHD_LAN_ADMIN_PREFS_50_04",       "Demonstration of buttons - buttons, checkboxes, radio buttons.");
define("EHD_LAN_ADMIN_PREFS_50_05",       "Demonstration of calendar fields - date, time.");
define("EHD_LAN_ADMIN_PREFS_50_06",       "Demonstration of other custom fields - colour picker, image selector");
define("EHD_LAN_ADMIN_PREFS_50_07",       "Demonstration of a simple page to manage database entries - standard create, update and delete processing.");
define("EHD_LAN_ADMIN_PREFS_50_08",       "Demonstration of a database entries management page that allows batch entering of data.");
define("EHD_LAN_ADMIN_PREFS_50_09",       "Preference settings for the database batch page.");
define("EHD_LAN_ADMIN_PREFS_50_10",       "Demonstration of a database entries page that allows file uploading.");

define("EHD_LAN_ADMIN_PREFS_01_0",        "accesstable");
define("EHD_LAN_ADMIN_PREFS_01_1",        "Access tables are used to select a user class");
define("EHD_LAN_ADMIN_PREFS_01_2",        "Normally used to ensure only a specific user class has access to the plugin or aspects of the plugin");
define("EHD_LAN_ADMIN_PREFS_02_0",        "calendar");
define("EHD_LAN_ADMIN_PREFS_02_1",        "Using the DHTML Calendar class");
define("EHD_LAN_ADMIN_PREFS_02_2",        "User can type in a date or click the calendar icon and select a date");
define("EHD_LAN_ADMIN_PREFS_03_0",        "calendartime");
define("EHD_LAN_ADMIN_PREFS_03_1",        "Combines calendar and time tags in to one");
define("EHD_LAN_ADMIN_PREFS_03_2",        "");
define("EHD_LAN_ADMIN_PREFS_04_0",        "checkbox");
define("EHD_LAN_ADMIN_PREFS_04_1",        "Checkboxes are used as a switch");
define("EHD_LAN_ADMIN_PREFS_04_2",        "Suitable for boolean or flag type fields that can be either on or off");
define("EHD_LAN_ADMIN_PREFS_05_0",        "color");
define("EHD_LAN_ADMIN_PREFS_05_1",        "Used to select a colour");
define("EHD_LAN_ADMIN_PREFS_05_2",        "User can type a colour code or click the button and select a colour from the palette");
define("EHD_LAN_ADMIN_PREFS_06_0",        "date");
define("EHD_LAN_ADMIN_PREFS_06_1",        "");
define("EHD_LAN_ADMIN_PREFS_06_2",        "");
define("EHD_LAN_ADMIN_PREFS_07_0",        "datestamp");
define("EHD_LAN_ADMIN_PREFS_07_1",        "");
define("EHD_LAN_ADMIN_PREFS_07_2",        "");
define("EHD_LAN_ADMIN_PREFS_08_0",        "diarycode");
define("EHD_LAN_ADMIN_PREFS_08_1",        "");
define("EHD_LAN_ADMIN_PREFS_08_2",        "");
define("EHD_LAN_ADMIN_PREFS_09_0",        "dir");
define("EHD_LAN_ADMIN_PREFS_09_1",        "A list of directories (folders)");
define("EHD_LAN_ADMIN_PREFS_09_2",        "Useful to allow selection of a directory for, say, which icons set to use");
define("EHD_LAN_ADMIN_PREFS_10_0",        "image");
define("EHD_LAN_ADMIN_PREFS_10_1",        "A set of images in a specific directory");
define("EHD_LAN_ADMIN_PREFS_10_2",        "User can type an image path or click choose and click an image to populate the text field with the path to that image");
define("EHD_LAN_ADMIN_PREFS_11_0",        "list");
define("EHD_LAN_ADMIN_PREFS_11_1",        "A list with default size of 1");
define("EHD_LAN_ADMIN_PREFS_11_2",        "When a list has a size of 1 the browser will normally render it as a drop down list");
define("EHD_LAN_ADMIN_PREFS_11_VALUE_0",  "Option 1");
define("EHD_LAN_ADMIN_PREFS_11_VALUE_1",  "Option 2");
define("EHD_LAN_ADMIN_PREFS_12_0",        "radio");
define("EHD_LAN_ADMIN_PREFS_12_1",        "Radio buttons are used to allow one choice from a set of options");
define("EHD_LAN_ADMIN_PREFS_12_2",        "Suitable when there are only a few options, use a list for many options or where multiple selections are required");
define("EHD_LAN_ADMIN_PREFS_12_VALUE_0",  "Option 1");
define("EHD_LAN_ADMIN_PREFS_12_VALUE_1",  "Option 2");
define("EHD_LAN_ADMIN_PREFS_12_VALUE_2",  "Option 3");
define("EHD_LAN_ADMIN_PREFS_13_0",        "table");
define("EHD_LAN_ADMIN_PREFS_13_1",        "Information read from a database table");
define("EHD_LAN_ADMIN_PREFS_13_2",        "This example shows the first 10 user names from the user table (ordered by user name)");
define("EHD_LAN_ADMIN_PREFS_14_0",        "text");
define("EHD_LAN_ADMIN_PREFS_14_1",        "A basic text field");
define("EHD_LAN_ADMIN_PREFS_14_2",        "For obtaining a single line of text");
define("EHD_LAN_ADMIN_PREFS_15_0",        "textarea");
define("EHD_LAN_ADMIN_PREFS_15_1",        "A basic textare with a style width of 50%");
define("EHD_LAN_ADMIN_PREFS_15_2",        "For obtaining text that can include line breaks/returns");
define("EHD_LAN_ADMIN_PREFS_16_0",        "list");
define("EHD_LAN_ADMIN_PREFS_16_1",        "This list is multiple select");
define("EHD_LAN_ADMIN_PREFS_16_2",        "Useful when zero, one or more selections can be made");
define("EHD_LAN_ADMIN_PREFS_16_VALUE_0",  "Option 1");
define("EHD_LAN_ADMIN_PREFS_16_VALUE_1",  "Option 2");
define("EHD_LAN_ADMIN_PREFS_17_0",        "time");
define("EHD_LAN_ADMIN_PREFS_17_1",        "");
define("EHD_LAN_ADMIN_PREFS_17_2",        "");
define("EHD_LAN_ADMIN_PREFS_18_0",        "button");
define("EHD_LAN_ADMIN_PREFS_18_1",        "With example click and mouseover events");
define("EHD_LAN_ADMIN_PREFS_18_2",        "Moving the mouse over this button and clicking this button both display a JavaScrip alert");
define("EHD_LAN_ADMIN_PREFS_19_0",        "list");
define("EHD_LAN_ADMIN_PREFS_19_1",        "A list with a size of 3 and a style width of 75%");
define("EHD_LAN_ADMIN_PREFS_19_2",        "Lists with a size &gt;1 will be rendered as a list box");
define("EHD_LAN_ADMIN_PREFS_19_VALUE_0",  "Option 1");
define("EHD_LAN_ADMIN_PREFS_19_VALUE_1",  "Option 2");
define("EHD_LAN_ADMIN_PREFS_22_0",        "Submit example");
define("EHD_LAN_ADMIN_PREFS_23_0",        "numeric");
define("EHD_LAN_ADMIN_PREFS_23_1",        "Can only accept numbers");
define("EHD_LAN_ADMIN_PREFS_23_2",        "Field is invalid if anything other than 0-9 is entered");
define("EHD_LAN_ADMIN_PREFS_24_0",        "filelist");
define("EHD_LAN_ADMIN_PREFS_24_1",        "Allows a file to be selected");
define("EHD_LAN_ADMIN_PREFS_24_2",        "Used to select a file from a specific directory");
define("EHD_LAN_ADMIN_PREFS_25_0",        "integer");
define("EHD_LAN_ADMIN_PREFS_25_1",        "Can only accept integers");
define("EHD_LAN_ADMIN_PREFS_25_2",        "Field is invalid if anything other +/- followed by 0-9 is entered, +/- is optional");
define("EHD_LAN_ADMIN_PREFS_26_0",        "decimal");
define("EHD_LAN_ADMIN_PREFS_26_1",        "Can only accept decimals");
define("EHD_LAN_ADMIN_PREFS_26_2",        "Field is invalid if anything other than +/- followed by 0-9, decimal point 0-9 entered, +/- and decimal places are optional");
define("EHD_LAN_ADMIN_PREFS_27_0",        "");
define("EHD_LAN_ADMIN_PREFS_27_1",        "");
define("EHD_LAN_ADMIN_PREFS_27_2",        "");

define("EHD_LAN_ADMIN_DB_01_0",           "Name");
define("EHD_LAN_ADMIN_DB_01_1",           "A name for this item");
define("EHD_LAN_ADMIN_DB_01_2",           "");
define("EHD_LAN_ADMIN_DB_02_0",           "File");
define("EHD_LAN_ADMIN_DB_02_1",           "The file name");
define("EHD_LAN_ADMIN_DB_02_2",           "");
define("EHD_LAN_ADMIN_DB_03_0",           "Description");
define("EHD_LAN_ADMIN_DB_03_1",           "A description of the item");
define("EHD_LAN_ADMIN_DB_03_2",           "");
define("EHD_LAN_ADMIN_DB_04_0",           "Number of batch groups");
define("EHD_LAN_ADMIN_DB_04_1",           "");
define("EHD_LAN_ADMIN_DB_04_2",           "");
define("EHD_LAN_ADMIN_DB_05_0",           "Tick each field that should appear in the repeating group part of the Candidates admin page. Setting the value to 1 turns off batch processing.");
define("EHD_LAN_ADMIN_DB_06_0",           "Userclass");
define("EHD_LAN_ADMIN_DB_06_1",           "");
define("EHD_LAN_ADMIN_DB_06_2",           "");
?>
