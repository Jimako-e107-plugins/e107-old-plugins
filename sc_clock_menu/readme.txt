/*
+---------------------------------------------------------------+
| e107 Clock Menu
| /clock_menu.php
|
| Compatible with the e107 content management system
|  http://e107.org
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
|     $Author: Crytiqal $
+---------------------------------------------------------------+
*/

Unzip the file and place the sc_clock_menu folder in the e107_plugins folder.
Deactivate the default e107 clock menu when using this alternate menu!
Activate the menu in the admin section of your website.


To change the welcome messages, do the following:

Open worldclock_menu.php with your favourite text editing program.
Find the <!-- Greeting section -->
Change the greetings between the <pre> </pre> tags.


To add additional timezones, do the following:

Open worldclock_menu.php with your favourite text editing program.
Find the <!-- Additional timezones section -->
Change the location names and the timezone tag e.g. CET, GMT etc.
Adjust the timezone offset in the strotime('').
(It is based on CET timezone)

I hope you enjoy this plugin.
Original clock made by "e107coders"
Javascript servertime script created by "Peter Klauer" (edited by Crytiqal)