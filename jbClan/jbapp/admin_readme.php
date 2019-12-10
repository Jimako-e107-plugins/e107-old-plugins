<?php
/*
+--------------------------------------------------------------------------------+
|   jbApp - by Jesse Burns aka jburns131 aka Jakle (jburns131@jbwebware.com)
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

$pageid = "admin_menu_04";

$text = "
===============================================================
   jbApp - by Jesse Burns aka Jakle (jburns131@jbwebware.com)

   Plugin Support Website: www.jbwebware.com

   A plugin template for the e107 Website System
   http://e107.org

   For more plugins visit: http://www.e107coders.org

===============================================================


jbClan is a collection of personnel management modules.

You can use it for FPS Gaming Clans, RPG Gaming Guilds, Club Sports Teams  or any other gathering of people, including company personnel, book clubs  etc...

jbClan currently contains a Member Roster module and a Member Application module.



Installation:
===============

Fresh install:
===============

Upload this into your 'e107_plugins' folder, then go to the 'Plugin Manager' located on your website admin page. Find the plugin in the list and click on 'Install'. You should be ready to go.

Upgrading from jbApp v3.01:
============================

NOTE:
YOU CAN ONLY UPGRADE FROM jbApp 3.01 WITH THIS VERSION.

Upload this plugin into your 'e107_plugins' folder, then go to the 'Plugin Manager' located on your website admin page. Find the plugin in the list and click 'Upgrade'. You should be ready to go.


Changelog:
===============

Version 3.02:

    New/Added Features:
    - Added the ability to add custom attributes to the application if jbRoster is not installed
    - Added the ability to add an Organization Name to the application if jbRoster is not installed
    - Added 'English' language file. Users can now create their own language files. If you take the time to create a language file, please contact me so I can add it to the standard release. Thanks!

    Altered Features:
    - Added additional security code to help prevent agains SQL injections

    Bugs Fixed:
    - Included the patch for jbApp v3.01, which fixes data corruption that occurs when sending data to jbRoster

    Minor Changes:
    - Made some minor alterations to the interface

===============================================================

Version 3.01:

    New/Added Features:
    - jbApp is now fully e107 v7 compliant, e107 v6 is no longer supported

    Altered Features:
    - jbApp is now a standalone plugin. It is still designed integrate with jbRoster, but it is no longer dependent on jbRoster. If jbRoster is not installed, jbApp will only email the application

    Bugs Fixed:
    - Fixed an error where the application info would not transfer to jbRoster

    Minor Changes:
    - Many code changes to clean up code
    - Started making changes to comply with XHTML/CSS web standards

===============================================================

Version 2.1:

    New/Added Features:
    - jbApp is now e107 v7 compliant

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
    - Change the some variables in the code that reference database interaction

    Bugs Fixed:
    - None

    Minor Changes:
    - None

===============================================================

Version 2.0:

    New/Added Features:
    - You can know decide which attrubutes you would like to display on the application

    Altered Features:
    - Changed the database interface/interaction

    Bugs Fixed:
    - No bugs have been reported to fix

    Minor Changes:
    - None

===============================================================

Version 1.3:

    New/Added Features:
    - Addressed some security issues

    Altered Features:
    - None

    Bugs Fixed:
    - No bugs have been reported to fix

    Minor Changes:
    - None

===============================================================

Version 1.2:

    New/Added Features:
    - None

    Altered Features:
    - None

    Bugs Fixed:
    - No bugs have been reported to fix

    Minor Changes:
    - Changed the subject line of the application email to: Membership Application for (Members Name)

===============================================================

Version 1.0:
    - first release";

$text = $tp->toHTML($text, TRUE);
$title = "<b>jbRoster Read Me</b>";
$ns->tablerender($title, $text);

require_once(e_ADMIN."footer.php");
?>