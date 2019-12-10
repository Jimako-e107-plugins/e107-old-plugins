<?php
/*
+--------------------------------------------------------------------------------+
|   jbRoster - by Jesse Burns aka jburns131 aka Jakle (jburns131@jbwebware.com)
|
|   Plugin Support Site: www.jbwebware.com
|
|   A plugin designed for the e107 Website System
|   http://e107.org
|
|   For more plugins visit:
|   http://plugins.e107.org
|   http://www.e107coders.org
|
|   Released under the terms and conditions of the
|   GNU General Public License (http://gnu.org).
|
+--------------------------------------------------------------------------------+
*/

require_once("../../class2.php");
if(!getperms("P")) {
    header("location:".e_HTTP."index.php");
    exit;
}

require_once(e_ADMIN."auth.php");

$pageid = "admin_menu_11";

$text = "
================================================================================
   jbRoster - by Jesse Burns aka jburns131 aka Jakle (jburns131@jbwebware.com)

   Plugin Support Site: www.jbwebware.com

   A plugin designed for the e107 Website System
   http://e107.org

   For more plugins visit:
   http://plugins.e107.org
   http://www.e107coders.org

   Released under the terms and conditions of the
   GNU General Public License (http://gnu.org).
================================================================================

jbClan is a collection of personnel management modules.

You can use it for FPS Gaming Clans, RPG Gaming Guilds, Club Sports Teams or any other gathering of people, including company personnel, book clubs etc...

jbClan currently contains a Member Roster module and a Member Application module.



Installation:
===============

Fresh install:
===============

Upload this into your 'e107plugins' folder, then go to the 'Plugin Manager' located on your website admin page. Find the plugin in the list and click on 'Install'. You should be all set to go.

Upgrading:
===============

NOTE:
YOU CAN ONLY UPGRADE FROM jbRoster V3.01. PLEASE READ THE 'README.TXT' CAREFULY BEFORE DOING SO.

Upload this into your 'e107_plugins' folder, then go to the 'Plugin Manager' located on your website admin page. Find the plugin in the list and click on 'Upgrade'. You should be ready to go.


Changelog:
===============

Version 3.02:

    New/Added Features:
    - Added 'English' language file. Users can now create their own language files. If you take the time to create a language file, please contact me so I can add it to the standard release. Thanks!

    Altered Features:
    - Changed the way the Clan logo displays on the main roster page. I removed the borders around the logo
    - Added additional security code to help prevent agains SQL injections

    Bugs Fixed:
    - None

    Minor Changes:
    - Adjusted the spacing between Teams on the main roster page
    - Made some minor alterations to the interface

===============================================================

Version 3.01:

    New/Added Features:
    - jbRoster is now fully e107 v7+ compliant. e107 v6 is no longer supported
    - Added help text on left side of admin pages

    Altered Features:
    - Changed 'Import Members' interface. It now displays the members that you are going to import, and confirms the import before importing members
    - Changed database names and install script. These changes allow admins to install and use jbApp independently
    - Rearranged Admin Menu to reflect most users workflow

    Bugs Fixed:
    - Fixed screen corruption that occurs when you have a left and right sidebar and choose not to display 'PC Info'

    Minor Changes:
    - Many code changes to clean up code
    - Started making changes to comply with XHTML/CSS web standards

===============================================================

Version 2.20:

    New/Added Features:
    - Allows you to rename the 'Nick Name' attribute
    - Allows you to use an external image for the 'Profile Page'

    Altered Features:
    - None

    Bugs Fixed:
    - None

    Minor Changes:
    - Fixed Minor Display Issues
    - Cleaned up the code a little bit
    - Fixed some code that would prevent you from renaming your 'e107_plugins' folder

===============================================================

Version 2.1:

    New/Added Features:
    - jbRoster is now e107 v7 compliant

    Altered Features:
    - None

    Bugs Fixed:
    - None

    Minor Changes:
    - Fixed Mozilla Firefox display issues
    - Fixed other minor display issues

===============================================================

Version 2.01:

    New/Added Features:
    - None

    Altered Features:
    - None

    Bugs Fixed:
    - Fixed bug that prevents you from choosing the order of 'Leaders'
    - Fixed minor bugs and display issues

    Minor Changes:
    - Various display fixes

===============================================================

Version 2.0:

    New/Added Features:
    - You can now choose which type of organization you are, and pages with diplay dynamicaly based on organization type
    - There is now a function that will allow you to display an 'Organization Logo' on the top of the roster
    - You can now add your own Team/Member/Leader Statuses
    - You can now add your own Colors
    - You can choose which attributes you would like to display on the main roster and profile pages
    - You can now use the 'Join Date' function (it's been hidden till I could fix it up)
    - Changed the 'D.O.B' (Date of Birth) functionality. You can now edit it in the 'MM/DD/YYYY' format, yet the roster will only display the members age in years (most members don't want to display their actual b-day date)
    - This was a complete rewrite, so there are many other changes and alterations to how things were done in jbClan

    Altered Features:
    - Too many to list

    Bugs Fixed:
    - No bugs have been reported to fix

    Minor Changes:
    - Various display fixes

===============================================================

Version 1.4:

    New/Added Features:
    - None

    Altered Features:
    - None

    Bugs Fixed:
    - No bugs have been reported to fix

    Minor Changes:
    - Ajusted the cellspacing in the profile page
    - Replaced all 'Yes/No' drop down boxes with check boxes

===============================================================

Version 1.3:

    Bugs Fixed:
    - Cadet and Recruit don't show up on the roster page, located below the squads
    - The plugin will assign the 'Clan Leader' status, regardless of what status you assign to the member
    - If there you don't create 'Squad Statuses', there are missing cells in the roster squads table

    Features Added:
    - None

    Minor Changes:
    - Removed 'DSA Squads' from roster

===============================================================

Version 1.2:

    Bugs Fixed:
    - Fixed 'Squad Status' bug
    - Fixed 'Can't delete squads on the Create Games/Squads page' bug

    Features Added:
    - Web admins can now select what fields/member info is displayed on the roster member pages
    - Web admins can now choose which squads they want to display on the roster, and allow them enable/disable the 'General Members', 'Inactive Members' section of the roster.
    - Added/Fixed the side bar menu

    Minor Changes:
    - Removed the word 'Squad' that displays after the squad name on the roster and 'Manage Squads' page
    - Removed email addresses from front roster page

===============================================================

Version 1.0:

    - first release";

$text = $tp->toHTML($text, TRUE);
$title = "<b>jbRoster Read Me</b>";
$ns->tablerender($title, $text);

require_once(e_ADMIN."footer.php");
?>