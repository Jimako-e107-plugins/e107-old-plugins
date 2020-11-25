<?php

/*
* e107 website system
*
* Copyright (C) 2008-2013 e107 Inc (e107.org)
* Released under the terms and conditions of the
* GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
*
* e107 Userjournals Plugin
*
* #######################################
* #     e107 website system plugin      #
* #     by Jimako                    	 #
* #     https://www.e107sk.com          #
* #######################################
*/ 

/*
+---------------------------------------------------------------+
|        UserJournals plugin for e107 website system
|
|        ©Del Rudolph 2003
|        http://www.downinit.com/
|        del@downinit.com
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+

$eplug_author        = "Del Rudolph, SKiTZ716, bkwon, bugrain";

*/

define("JOURNAL_VERSION","1.1"); // Do not change this unless you really are updating the plugin

define("LAN_JOURNAL_A0",    	"UserJournals");
define("LAN_JOURNAL_A0_SUM",   "UserJournals plugin for e107 website system");
define("LAN_JOURNAL_A0_DESC",   "This plugin allows the e107 CMS to support individual journals for registered/logged-in users. Each user gets their own journal, and can write, edit, and delete their entries. Admin has the option of totally disabling User Journals, as well as restricting access to logged-in users only.");
define("JOURNAL_A1",    "Update Settings");
define("JOURNAL_A2",    "Settings Saved");
define("JOURNAL_A3",    "Activate");
define("JOURNAL_A3_P",  "Use this option to turn all User Journal functionality on or off");
define("JOURNAL_A4",    "This option will convert comments made with a pre v0.4 version of UserJournals. It only needs to be run once and it will remove the comments from the User Journals database table and move them to the standard e107 comments table.");
define("JOURNAL_A5",    "Click here to convert comments");
define("JOURNAL_A6",    "Allow Comments");
define("JOURNAL_A6_P",  "Select the user class that can post comments");
define("JOURNAL_A7",    "Comment Poster can edit comment");
define("JOURNAL_A7_P",  "Select this option to allow comment posters to edit their own comments");
 
define("JOURNAL_A11",   "Writers");
define("JOURNAL_A11_P", "Select the user class that is allowed to write journals");
define("JOURNAL_A12",   "Readers");
define("JOURNAL_A12_P", "Select the user class that is allowed to read journals. Note, journal writers are automatically readers");
define("JOURNAL_A13",   "Page title");
define("JOURNAL_A13_P", "Title of the main User Journals page");
define("JOURNAL_A14",   "Menu Title");
define("JOURNAL_A14_P", "Title of the User Journals menu");
define("JOURNAL_A15",   "Allow ratings");
define("JOURNAL_A15_P", "Select the user class that can post ratings");
define("JOURNAL_A16",   "There are no comments to convert.");
define("JOURNAL_A17",   "Comments have been converted.");
define("JOURNAL_A18",   "WARNING: You should back up your 'userjournals' and 'comments' table before performing this conversion, just in case.");
define("JOURNAL_A19",   "Menu Subject length");
define("JOURNAL_A19_P", "The length of the subject text in the bloggers recent blogs list");
define("JOURNAL_A20",   "Preview Text Length");
define("JOURNAL_A20_P", "The length of text to be displayed when previewing a blog on the bloggers page");
define("JOURNAL_A21",   "Number Of Recent Entries");
define("JOURNAL_A21_P", "The number of recent blogs to display in the bloggers recent blogs list");
define("JOURNAL_A22",   "Show RSS feeds");
define("JOURNAL_A22_P", "Tick to show links to the blog RSS feeds on the blog menu");
define("JOURNAL_A23",   "Show Now Playing");
define("JOURNAL_A23_P", "Tick to show Now Playing field when writing blogs");
define("JOURNAL_A24",   "Show Mood");
define("JOURNAL_A24_P", "Tick to show the Mood field when writing blogs");
define("JOURNAL_A25",   "Show Categories");
define("JOURNAL_A25_P", "Tick to show the Categories field when writing blogs");
define("JOURNAL_A25_0", "No categories");
define("JOURNAL_A25_1", "Categories in main blog menu");
define("JOURNAL_A25_2", "Categories in separate menu");
define("JOURNAL_A26",   "Description");
define("JOURNAL_A26_P", "A description for this category");
define("JOURNAL_A27",   "Icon");
define("JOURNAL_A27_P", "Select an icon for this category");
define("JOURNAL_A28",   "Parent");
define("JOURNAL_A28_P", "Select a parent for this category");
define("JOURNAL_A29",   "Category Menu Title");
define("JOURNAL_A29_P", "Title of the User Journals Category menu");
define("JOURNAL_A30",   "Template");
define("JOURNAL_A30_P", "Select a template");
define("JOURNAL_A31",   "Number of bloggers listed in Bloggers menu");
define("JOURNAL_A31_P", "Limits the number of bloggers listed in the Bloggers menu, 0 means no limit");
define("JOURNAL_A32",   "Number of bloggers listed on main page");
define("JOURNAL_A32_P", "Limits the number of bloggers listed on the main Bloggers page, 0 means no limit. Paging links will be displayed if there are more bloggers than this value.");
define("JOURNAL_A33",   "Number of blogs listed on a blog page");
define("JOURNAL_A33_P", "Limits the number of blogs listed on a blog page, 0 means no limit. Paging links will be displayed if there are more blogs than this value.");
define("JOURNAL_A34",   "Allow Blog reporting");
define("JOURNAL_A34_P", "Allows site members to report blogs to the site admin.");
define("JOURNAL_A34_0", "Off");
define("JOURNAL_A34_1", "Log to Admin Log database table");
define("JOURNAL_A34_2", "E-Mail site admin");
define("JOURNAL_A34_3", "Log to admin Log and E-Mail site admin");

define("LAN_JOURNAL_MENU_00",  "Preferences");
define("JOURNAL_MENU_01",  "Categories");
define("JOURNAL_MENU_01_ADD",  "Add New Category");
define("JOURNAL_MENU_98",  "Convert comments");
define("JOURNAL_MENU_99",  "Read Me");
?>
