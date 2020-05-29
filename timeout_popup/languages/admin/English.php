<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL:$
|     $Revision:$
|     $Id:$
|     $Author:$
+----------------------------------------------------------------------------+
*/
//Headings
define("LAN_TIMEPOP_H01",  "Timeout Popup");
define("LAN_TIMEPOP_H02",  "Configure Timeout Popup");
define("LAN_TIMEPOP_H03",  "Timeout Popup Settings");
define("LAN_TIMEPOP_H04", "Timeout Popup Help");

// Labels
define("LAN_TIMEPOP_L01", "Timeout<br/>Time in seconds before popup is displayed, current PHP timeout is set to ");
define("LAN_TIMEPOP_L02", "Message<br/>No HTML - must be simple text");
define("LAN_TIMEPOP_L03", "Userclass<br/>Activate only for members of this userclass");

// Navigation
define("LAN_TIMEPOP_N01", "Update");

// Messages
define("LAN_TIMEPOP_M01",  "Timeout Popup settings updated");

// Copy
define("LAN_TIMEPOP_C01",  "This plugin will display a popup before the users session is about to expire if they have been inactive, giving them an opportunity to keep their session alive.");
define("LAN_TIMEPOP_C02",  "The Timeout Popup plugin has been successfully installed.");
define("LAN_TIMEPOP_C03",  "Your session with this website is about to timeout, you may lose any data if you are filling in a form.\n\nSelect \"OK\" to continue with your session and preserve your form data.");
define("LAN_TIMEPOP_C04", "<p>This plugin will alert an inactive user after a pre-determined time (defined in the plugins preferences) that their session is about to expire.</p><p>An inactive user is one who has not clicked a link or submitted a form for a period of time.</p><p>They will be given the option to click \"OK\" or \"Cancel\" in the popup. Clicking \"OK\" will keep their session alive by sending a request to the website, the response is ignored. Clicking \"Cancel\" does nothing and they will not be warned again.</p><p>This features requires that the user has JavaScript available in their browser.</p>");
?>