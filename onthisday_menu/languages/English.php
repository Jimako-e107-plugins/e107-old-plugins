<?php
/*
+---------------------------------------------------------------+
|        On This Day Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
define(OTDLAN_CAP, "On This Day ...");
define(OTD_MORE,"[more]");
define(OTD_MONTHLIST,",January,February,March,April,May,June,July,August,September,October,November,December");

// This is the string displayed if "showifempty" is set:
define(OTDLAN_DEFAULT, "Nothing much happened.");

define(OTD_01, "You are not permitted to view this information");
define(OTD_02, "Every year");
define(OTD_03, "In");
define(OTD_04, "On This Day");


define(OTD_MONTHS,",January,February,March,April,May,June,July,August,September,October,November,December");

define(OTD_H01,"On This Day Menu");
define(OTD_H02,"Preferences");
define(OTD_H03,"User Class");
define(OTD_H04,"Which user class will see the menu and full details");
define(OTD_H05,"Show menu on empty days");
define(OTD_H06,"Display the menu even when there are no events on that day.");
define(OTD_H07,"Characters in Menu");
define(OTD_H08,"The maximum number of characters to display in the menu (excess is shown as [more])");
define(OTD_H09,"Date Format");
define(OTD_H10,"The format of the date in the menu");

define(OTD_H11,"Event Entries");
define(OTD_H12,"Calendar Control");
define(OTD_H13,"Use the calendar to move to the day you wish to edit. Click on Add for a new event. Click the corresponding Edit or Delete icon for that action");
define(OTD_H14,"Title");
define(OTD_H15,"A brief description of this event (max 200 chars)");
define(OTD_H16,"Event Date");
define(OTD_H17,"Enter the day and month plus, optionally, the year of the event.");
define(OTD_H18,"Full Text");
define(OTD_H19,"An extended description of the event");


define(OTD_H21,"Import Export Events");
define(OTD_H22,"Available files");
define(OTD_H23,"Select the file to import. CVS must be in the format specified.ICal files must be specified with .ics extention");
define(OTD_H24,"Export to CVS");
define(OTD_H25,"Name of the file to export to (include the .cvs in the file name)");
define(OTD_H26,"Event Date");
define(OTD_H27,"Enter the day and month plus, optionally, the year of the event.");
define(OTD_H28,"Full Text");
define(OTD_H29,"An extended description of the event");
define(OTD_H30,"Check for updates");
define(OTD_H31,"Check for the author's web site for updates");

define(OTD_A01,"On This Day Menu");
define(OTD_A02,"Preferences");
define(OTD_A03,"Entries");

define(OTD_A04,"Settings saved");
define(OTD_A05,"On This Day Menu Preferences");
define(OTD_A06,"Show menu on empty days");
define(OTD_A07,"Yes");
define(OTD_A08,"No");
define(OTD_A09,"Save Changes");
define(OTD_A10,"Read Class");
define(OTD_A11,"Editing events on");

define(OTD_A12,"Title");
define(OTD_A13,"Day");
define(OTD_A14,"Month");
define(OTD_A15,"Year");
define(OTD_A16,"Full Text");
define(OTD_A17,"Event Date");
define(OTD_A18,"Maximum characters in menu");
define(OTD_A19,"Date format");
define(OTD_A20,"Import/Export");
define(OTD_A21,"Add New");
define(OTD_A22,"Edit this record");
define(OTD_A23,"Delete this record");
define(OTD_A24,"This day's Events");
define(OTD_A25,"You have no events defined");
define(OTD_A26,"You are about to delete the following record");
define(OTD_A27,"Click OK to delete or cancel to exit.");
define(OTD_A28,"OK");
define(OTD_A29,"Cancel");
define(OTD_A30,"Delete Entry");

define(OTD_A31,"Day");
define(OTD_A32,"Month");
define(OTD_A33,"Year");


define(OTD_A40,"Import Export Events");
define(OTD_A41,"Available CSV and ICS files");
define(OTD_A42,"Import");
define(OTD_A43,"Export");
define(OTD_A44,"CSV Data needs to be in the form <br />&nbsp;&nbsp;&nbsp;Brief Text (unformatted max length 200 characters)<br />&nbsp;&nbsp;&nbsp;Date (YYYY-MM-DD)<br />&nbsp;&nbsp;&nbsp;Full text. (With XHTML formatting max length 4096 characters)<br />The separator is , and each field should be surrounded by a double quote (\") ");
define(OTD_A45,"Import files");
define(OTD_A46,"Export File to CVS");
define(OTD_A47,"Export file name");
define(OTD_A48,"Select File");
define(OTD_A49,"Imported");
define(OTD_A50,"You must specify a file to import");
define(OTD_A51,"Unable to open the file");
define(OTD_A52,"You must specify a file to export to");
define(OTD_A53,"Unable to write the file. Check the csv folder is writable (chmod 777 for example).");
define(OTD_A54,"Read Me");
define(OTD_A55,"Check for Updates");
define(OTD_A56,"Submit class");
define(OTD_A57,"Admin class");
define(OTD_A58,"Allow show all");
define(OTD_A59,"Saved");
define(OTD_A60,"Not all necessary fields completed");
define(OTD_A61,"An identical event exists");
define(OTD_A62,"On this Day");
define(OTD_A63,"Unable to create entry");
define(OTD_A64,"Unable to save entry");

define(OTD_001,"Manage Entries");
define(OTD_002,"On This Day Menu");
define(OTD_003,"New entry");
define(OTD_004,"Edited Entry");
define(OTD_005,"On this day entry updated by");
define(OTD_006,"Entry title");
define(OTD_007,"Entry was for");
define(OTD_008,"New On this day Entry");
define(OTD_009,"On this day Entry updated");
define(OTD_010,"Found in");
define(OTD_011,"Entry");
define(OTD_012,"Occurs on");
define(OTD_013,"Edit");
define(OTD_014,"Delete");
define(OTD_015,"Full Details");

define(OTD_P01,"Configure On This Day Menu");
define(OTD_P02,"Displays events that happened today.");
define(OTD_P03,"Installation Successful..");
define(OTD_P04, "On This Day");

define(OTD_G01, "On This Day");
define(OTD_G02, "On This Day settings saved");
define(OTD_G03, "Reward for posting an entry");
define(OTD_G04, "Save Changes");
define(OTD_G05, "Credit for creating an On This Day Entry");
