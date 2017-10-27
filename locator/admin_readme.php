<?php
/*
+------------------------------------------------------------------------------+
| Locator - a plugin by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/
// Ensure this program is loaded in admin theme before calling class2
$eplug_admin = true;

// class2.php is the heart of e107, always include it first to give access to e107 constants and variables
require_once("../../class2.php");

// Include auth.php rather than header.php ensures an admin user is logged in
require_once(e_ADMIN."auth.php");

// Check to see if the current user has admin permissions for this plugin
if (!getperms("P")) {
	// No permissions set, redirect to site front page
	header("location:".e_BASE."index.php");
	exit;
}

// Get language file (assume that the English language file is always present)
$lan_file = e_PLUGIN."locator/languages/".e_LANGUAGE.".php";
include_lan($lan_file);

// Set the active menu option for admin_menu.php
$pageid = 'admin_menu_09';

// Specify the name of the file to display
$filename = LOCATOR_ADMIN_HELP_99;
// Use file_get_contents function to open, read and close the (lowercase) file name (for Unix systems)
$text = file_get_contents(strtolower($filename));
// Use public text parse function toHTML to convert the text string to HTML output
$text = $tp->toHTML($text, TRUE);

// Return the text rendered in a table with a caption
$caption = LOCATOR_ADMIN_HELP_07;
$ns->tablerender($caption, $text);
require_once(e_ADMIN."footer.php");
?>