<?php
/*
+---------------------------------------------------------------+
| Contact Form by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/contactform_menu/languages/English.php,v $
| $Revision: 1.1.2.5 $
| $Date: 2006/12/27 23:36:49 $
| $Author: Neil $
+---------------------------------------------------------------+
*/

define("CONTACTFORM_DESC", "A configurable contact form to allow website visitors to e-mail you without exposing e-mail addresses.");

define("CONTACTFORM_00", "Send message to");
define("CONTACTFORM_01", "Your name");
define("CONTACTFORM_02", "Your E-Mail address");
define("CONTACTFORM_03", "Subject");
define("CONTACTFORM_04", "Message");
define("CONTACTFORM_05", "Send to me");
define("CONTACTFORM_06", " check this box to send a copy of the e-mail to yourself");
define("CONTACTFORM_07", "Send message");
define("CONTACTFORM_08", "Reset Form");
define("CONTACTFORM_09", "Contact Us");
define("CONTACTFORM_10", "You are not authorized to use the ".CONTACTFORM_09." form.");
define("CONTACTFORM_11", "Your message has been sent, thank you for contacting us.<br>We will reply to your e-mail as soon as we are able.");
define("CONTACTFORM_12", "There was a problem sending the message. Please try again.");
define("CONTACTFORM_13", "The following field(s) are mandatory:");
define("CONTACTFORM_14", "The following field(s) are invalid:");
define("CONTACTFORM_15", "Your settings have been saved.");
define("CONTACTFORM_16", "Fields marked with an * are mandatory");
define("CONTACTFORM_17", "No subject");
define("CONTACTFORM_18", "anonymous@mystery.com");
define("CONTACTFORM_19", "Anonymous");
define("CONTACTFORM_20", "No message entered");
define("CONTACTFORM_21", "There was a problem validating your E-Mail address");
define("CONTACTFORM_22", "Contact Details");
define("CONTACTFORM_23", "repeat the security number");
define("CONTACTFORM_24", "The security number entered did not match the displayed security number");
define("CONTACTFORM_25", "Your details will be logged to prevent misuse of this facility.");
define("CONTACTFORM_26", "IP address");
define("CONTACTFORM_27", "Hostname");
define("CONTACTFORM_28", "Sender details:");
define("CONTACTFORM_29", "Select a recipient...:");
define("CONTACTFORM_30", " Default page");
define("CONTACTFORM_31", "This page has a blank query string and is used for E-Mails to be shown on the default page.");
define("CONTACTFORM_32", "anonymous@mystery.com");
define("CONTACTFORM_33", "Anonymous");

define("CONTACTFORM_MENU_00", "E-Mails");
define("CONTACTFORM_MENU_01", "Preferences");
define("CONTACTFORM_MENU_02", "Fields");
define("CONTACTFORM_MENU_03", "Read Me");
define("CONTACTFORM_MENU_04", "Pages");

define("CONTACTFORM_PREF_00", CONTACTFORM_NAME." - ".CONTACTFORM_MENU_00);
define("CONTACTFORM_PREF_01", CONTACTFORM_NAME." - ".CONTACTFORM_MENU_01);
define("CONTACTFORM_PREF_02", CONTACTFORM_NAME." - ".CONTACTFORM_MENU_02);
define("CONTACTFORM_PREF_03", CONTACTFORM_NAME." - ".CONTACTFORM_MENU_03);
define("CONTACTFORM_PREF_04", CONTACTFORM_NAME." - ".CONTACTFORM_MENU_04);

define("CONTACTFORM_PREF_CONFIG_00_0", "Mandatory symbol");
define("CONTACTFORM_PREF_CONFIG_00_1", "Select the symbol to be used for the mandatory field marker");
define("CONTACTFORM_PREF_CONFIG_01_0", "Mandatory color");
define("CONTACTFORM_PREF_CONFIG_01_1", "Select the color to be used for the mandatory field marker");
define("CONTACTFORM_PREF_CONFIG_02_0", "'Send To' as columns");
define("CONTACTFORM_PREF_CONFIG_02_1", "Displays the ".CONTACTFORM_00." list in columns. Useful to line up names/titles.");
define("CONTACTFORM_PREF_CONFIG_03_0", "Visibility");
define("CONTACTFORM_PREF_CONFIG_03_1", "Select which type of user can use the form. This is a global setting, individual pages can have a more restrictive setting as required.");
define("CONTACTFORM_PREF_CONFIG_04_0", "Subject prefix");
define("CONTACTFORM_PREF_CONFIG_04_1", "Any text entered here will be pre-pended to the subject line of the e-mail");
define("CONTACTFORM_PREF_CONFIG_05",   "");
define("CONTACTFORM_PREF_CONFIG_06",   "");
define("CONTACTFORM_PREF_CONFIG_07_0", "");
define("CONTACTFORM_PREF_CONFIG_07_1", "");
define("CONTACTFORM_PREF_CONFIG_08_0", "");
define("CONTACTFORM_PREF_CONFIG_08_1", "");
define("CONTACTFORM_PREF_CONFIG_09_0", "Confirmation message");
define("CONTACTFORM_PREF_CONFIG_09_1", "A message that is displayed to the user after an e-mail has been sent");
define("CONTACTFORM_PREF_CONFIG_10_0", "Debug mode");
define("CONTACTFORM_PREF_CONFIG_10_1", "Turn on debug mode, not to be used for live sites");
define("CONTACTFORM_PREF_CONFIG_11_0", "WYSIWYG Message Area");
define("CONTACTFORM_PREF_CONFIG_11_1", "Show the message text area using the e107 WYSIWYG editor (this must also be switched on in e107's settings).");
define("CONTACTFORM_PREF_CONFIG_12_0", "Show contact details");
define("CONTACTFORM_PREF_CONFIG_12_1", "Show the contact details defined by e107's Settings. Contact details are taken from the standard e107 Site Contact details");
define("CONTACTFORM_PREF_CONFIG_12_L0", "Do not show");
define("CONTACTFORM_PREF_CONFIG_12_L1", "Above form");
define("CONTACTFORM_PREF_CONFIG_12_L2", "Below form");
define("CONTACTFORM_PREF_CONFIG_13_0", "Image code verification");
define("CONTACTFORM_PREF_CONFIG_13_1", "Check to turn image code verifcation on. Image code verification helps reduce spam from the Contact Form plugin.");
define("CONTACTFORM_PREF_CONFIG_14_0", "Track IP Addresses");
define("CONTACTFORM_PREF_CONFIG_14_1", "Check to turn IP address tracking. When switched on, a record is written to the Admin log each time an e-mail is sent from the plugin.");
define("CONTACTFORM_PREF_CONFIG_15_0", "Default from e-mail");
define("CONTACTFORM_PREF_CONFIG_15_1", "Default from e-mail address when no e-mail address is supplied");
define("CONTACTFORM_PREF_CONFIG_16_0", "Default from name");
define("CONTACTFORM_PREF_CONFIG_16_1", "Default from name address when no name is supplied");

define("CONTACTFORM_PREF_FIELDS_05_0", "Custom field 1");
define("CONTACTFORM_PREF_FIELDS_05_1", "Custom field 1 name, leave blank for no field");
define("CONTACTFORM_PREF_FIELDS_06_0", "Custom field 2");
define("CONTACTFORM_PREF_FIELDS_06_1", "Custom field 2 name, leave blank for no field");
define("CONTACTFORM_PREF_FIELDS_07_0", "Custom field 3");
define("CONTACTFORM_PREF_FIELDS_07_1", "Custom field 3 name, leave blank for no field");
define("CONTACTFORM_PREF_FIELDS_08_0", "Custom field 4");
define("CONTACTFORM_PREF_FIELDS_08_1", "Custom field 4 name, leave blank for no field");
define("CONTACTFORM_PREF_FIELDS_10_0", "Deprecated fields");
define("CONTACTFORM_PREF_FIELDS_11_0", "The following custom fields are deprecated and no longer displayed by default, please use the new <b>Custom fields</b> field (see the <i>Pages</i> admin page) instead. They can be added to the template if needed, please refer to the <a href='http://wiki.e107.org/?title=Contact_Form'>Contact Form wiki page</a>.");

define("CONTACTFORM_PREF_DISPLAY_00", "Hide");
define("CONTACTFORM_PREF_DISPLAY_01", "Show");
define("CONTACTFORM_PREF_DISPLAY_02", "Mandatory");

define("CONTACTFORM_PREF_EMAILS_00",   "Existing E-Mails");
define("CONTACTFORM_PREF_EMAILS_01",   "Edit");
define("CONTACTFORM_PREF_EMAILS_02",   "Update");
define("CONTACTFORM_PREF_EMAILS_03",   "Create");
define("CONTACTFORM_PREF_EMAILS_04",   "Updated");
define("CONTACTFORM_PREF_EMAILS_05",   "Update failed");
define("CONTACTFORM_PREF_EMAILS_06",   "Created");
define("CONTACTFORM_PREF_EMAILS_07",   "Create failed");
define("CONTACTFORM_PREF_EMAILS_08",   "Deleted");
define("CONTACTFORM_PREF_EMAILS_09",   "Delete failed");
define("CONTACTFORM_PREF_EMAILS_10",   "No E-Mails");
define("CONTACTFORM_PREF_EMAILS_11",   "Delete");
define("CONTACTFORM_PREF_EMAILS_00_0", "Display order");
define("CONTACTFORM_PREF_EMAILS_00_1", "The order that the entries will appear in the drop down list");
define("CONTACTFORM_PREF_EMAILS_01_0", "Title");
define("CONTACTFORM_PREF_EMAILS_01_1", "Title for this entry (e.g. webmaster)");
define("CONTACTFORM_PREF_EMAILS_02_0", "E-Mail");
define("CONTACTFORM_PREF_EMAILS_02_1", "For multiple recipients, enter one e-mail address per line");
define("CONTACTFORM_PREF_EMAILS_03_0", "Name");
define("CONTACTFORM_PREF_EMAILS_03_1", "Name for this entry such as a person or department name");
define("CONTACTFORM_PREF_EMAILS_04_0", "Description");
define("CONTACTFORM_PREF_EMAILS_04_1", "");
define("CONTACTFORM_PREF_EMAILS_05_0", "Pages");
define("CONTACTFORM_PREF_EMAILS_05_1", "Select one or more pages that this e-mail address will be displayed on.");

define("CONTACTFORM_PREF_PAGES_00_0", "Name");
define("CONTACTFORM_PREF_PAGES_00_1", "Page name");
define("CONTACTFORM_PREF_PAGES_01_0", "Userclass");
define("CONTACTFORM_PREF_PAGES_01_1", "Userclass of users who can view this page");
define("CONTACTFORM_PREF_PAGES_02_0", "Query string");
define("CONTACTFORM_PREF_PAGES_02_1", "The query string used to access this page");
define("CONTACTFORM_PREF_PAGES_03_0", "Description");
define("CONTACTFORM_PREF_PAGES_03_1", "A description for the page");
define("CONTACTFORM_PREF_PAGES_04_0", "Sender's name");
define("CONTACTFORM_PREF_PAGES_04_1", "Select the display option for the ".CONTACTFORM_01." field");
define("CONTACTFORM_PREF_PAGES_05_0", "Sender's E-Mail address");
define("CONTACTFORM_PREF_PAGES_05_1", "Select the display option for the ".CONTACTFORM_02." field");
define("CONTACTFORM_PREF_PAGES_06_0", "Subject");
define("CONTACTFORM_PREF_PAGES_06_1", "Select the display option for the ".CONTACTFORM_03." field");
define("CONTACTFORM_PREF_PAGES_07_0", "Message");
define("CONTACTFORM_PREF_PAGES_07_1", "Select the display option for the ".CONTACTFORM_04." field");
define("CONTACTFORM_PREF_PAGES_08_0", "CC");
define("CONTACTFORM_PREF_PAGES_08_1", "Select the display option for the ".CONTACTFORM_05." field. Possible opening for allowing spam, use with caution");
define("CONTACTFORM_PREF_PAGES_09_0", "Custom fields");
define("CONTACTFORM_PREF_PAGES_09_1", "Add custom fields");

define("CONTACTFORM_HELP_00", "Instructions");
define("CONTACTFORM_HELP_01", CONTACTFORM_MENU_00);
define("CONTACTFORM_HELP_02", "Use this page to add, edit and delete e-mail contacts");
define("CONTACTFORM_HELP_03", CONTACTFORM_MENU_01);
define("CONTACTFORM_HELP_04", "Use this page to set the congiguration options for the Contact form");
define("CONTACTFORM_HELP_05", CONTACTFORM_MENU_02);
define("CONTACTFORM_HELP_06", "Use this page to hide, show and make mandatory the fields on the E-Mail form");
?>