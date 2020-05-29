#==============================================================================+
#   News Scroller plugin - an e107 plugin by nlstart
#
#   Plugin Support Website: [link=external=http://e107.webstartinternet.com/]e107.webstartinternet.com[/link]
#
#   A plugin template for the e107 Website System; visit [link=external=http://e107.org/]e107.org[/link]
#   For more plugins visit: [link=external=http://plugins.e107.org/]plugins.e107.org[/link]
#   or [link=external=http://www.e107coders.org/]e107coders.org[/link]
#
#==============================================================================+
Thank you for using News Scroller. You can show your appreciation and support future development by [link=https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=nlstart%40webstartinternet%2ecom&item_name=NLSTART%20Plugins&no_shipping=0&no_note=1&tax=0&currency_code=EUR&lc=EN&bn=PP%2dDonationsBF&charset=UTF%2d8]donate via PayPal[/link] to NLSTART.
Alternatively, send me something from [link=https://www.amazon.com/gp/registry/wishlist/KA5YB4XJZYCW/]my Amazon wishlist[/link] to keep me motivated!


Purpose of the News Scroller plugin
=====================================
GOAL: Scroll the news
NOTE: This plugin creates menus that can be placed any menu area of your theme.

Prerequisites:
==============
* E107 core v0.7.7 (or newer) installed.

1. Installation:
================
a. Upload the News Scroller plugin files into your 'e107_plugins' folder. Although 'Upload plugin' from the Admin section might work, uploading your plugin files by using an FTP client program is recommended.
b. When working on Linux or Unix based server set the CHMOD settings of directories to 755 and set CHMOD of all .php files to 644.
c. Login as an administrator into e107, go to Plugin Manager, install News Scroller
d. Go to Admin area > Menus and assign the slideshow menu to any of your available menu areas.

2. Updates:
===========
Not applicable; no database updates since v1.0!

Important background information
================================
Additional information can be found at the [link=external=http://wiki.e107.org/?title=News_Scroller]e107.org Wiki 'News Scroller' page[/link].


Changelog:
==========
Version 1.2 (September 24, 2009):
 * Fixes:
   - news_scroller_menu.php: fixed query to show news for correct user class and start/end date/time
   - plugin.php: adjusted version for 1.2

Version 1.1 (September 02, 2009):
 * Fixes:
   - news_scroller_menu.php: added base URL for correct IE display of news icons
   - plugin.php: adjusted version for 1.1

Version 1.0 (August 24, 2009):
 * Sub-goals for release 1.0: 
   - initial version

   
License
=======
News Scroller is distributed as free open source code released under the terms and conditions of the [link=external=http://gnu.org/]GNU General Public License[/link].