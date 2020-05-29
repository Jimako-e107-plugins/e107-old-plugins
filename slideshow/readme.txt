#==============================================================================+
#   Slideshow plugin - an e107 plugin by nlstart
#
#   Plugin Support Website: [link=external=http://e107.webstartinternet.com/]e107.webstartinternet.com[/link]
#
#   A plugin for the e107 Website System; visit [link=external=http://e107.org/]e107.org[/link]
#   For more plugins visit: [link=external=http://e107.org/plugins]e107.org/plugins[/link]
#
#==============================================================================+
Thank you for using Slideshow. You can show your appreciation and support future development by [link=https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=nlstart%40webstartinternet%2ecom&item_name=NLSTART%20Plugins&no_shipping=0&no_note=1&tax=0&currency_code=EUR&lc=EN&bn=PP%2dDonationsBF&charset=UTF%2d8]donate via PayPal[/link] to NLSTART.
Alternatively, send me something from [link=https://www.amazon.com/gp/registry/wishlist/KA5YB4XJZYCW/]my Amazon wishlist[/link] to keep me motivated!
As from 2.0: This plugin is using the jQuery javascript framework.

Purpose of the Slideshow plugin
=====================================
GOAL: Fancy slideshows
NOTE: This plugin creates menus that can be placed in any menu area of your theme.

The Slideshow plugin can also be used for custom slides; they can be defined at Admin Area > Slideshow > Create Slideshow.
The custom slides can be set active/inactive and even have the possibility to only display to certain user classes.
The number of slideshows to be displayed is limited by Admin Area > Slideshow > Config > "Number of items to be shown". However, 4 is the adviced number; otherwise a scroll bar will be visible with default css.

Available menu's:
slideshow_news		: display the latest news
slideshow_download	: display the latest downloads
slideshow_show		: display the latest slideshow entries
slideshow_easyshop	: display the latest products 
					  IMPORTANT NOTE: this menu is NOT included in the free 1.1/2.0 download; available from NLSTART shop: 
					  http://shop.webstartinternet.com/e107_plugins/easyshop/easyshop.php?prod.7 (easyshop menu is available for a small fee)

Prerequisites:
==============
* e107 core v1.0.2 (or newer) installed.
* Some themes like e.g. e107 default theme core loads prototype and scriptaculous which might collide with jQuery; please avoid a lot of different javascript frameworks.
  (the slideshow plugin uses jQuery in a no-conflict mode, so it should not collide with other frameworks like prototype and/or scriptaculous. But it is better to avoid too many different javascript frameworks on one website for performance reasons and compatability.)

1. Installation:
================
a. Upload the Locator plugin files into your 'e107_plugins' folder. Although 'Upload plugin' from the Admin section might work, uploading your plugin files by using an FTP client program is recommended.
b. When working on Linux or Unix based server set the CHMOD settings of directories to 755 and set CHMOD of all .php files to 644.
c. Login as an administrator into e107, go to Plugin Manager, install Slideshow
d. Go to Admin area > Menus and assign the slideshow menu to any of your available menu areas.

2. Updates:
===========
Admin Area > Plugin Manager > Update slideslow (when upgrading from slideshow 1.0)

Important background information
================================
Additional information can be found at the [link=external=http://wiki.e107.org/?title=News_Slideshow]e107.org Wiki 'Slideshow' page[/link].

Styling News SlideShow plugin
=============================
Q1: The arrows are gone?
A1: Yes, since v2.0 the Slideshow plugin switched to a whole new concept with jQuery javascript framework

Q2: How do I change the size of the frame, default sizes for borders, background colors etc.?
A2: Copy the css file(s) available in the slideshow/css folder to your theme folder and modify the one(s) in your theme folder. By doing so your modifications will not be overwritten by future slideshow upgrades. 
	NOTE: knowledge about CSS is required!
	NOTE2: if you do copy the css to your theme folder; also change the urls to images on lines 54 and 71, like e.g.: background:url('../../e107_plugins/slideshow/images/selected-item.gif') top left no-repeat;
	Each menu has it's own style sheet, to provide maximum flexibility in styling. Available css files:
	css/slideshow_news.css - news style 
	css/slideshow_dl.css - downloads style
	css/slideshow_shop.css - easyshop style
	css/slideshow_show.css - slideshow style
	If the stylesheet exists in your site theme folder root; the slideshow plugin will use that one. Otherwise it will use the default style show from the folder slideshow/css.

Q3: The slideshow plugin is not working for me?
A3: It might be caused by theme javascript conflicts. Other themes or plugins loading conflicting javascript framework stuff (probably from prototype and/or scriptaculous). This plugin uses the jQuery javascript framework, it has been programmed to be not conflicting with other javascript frameworks but mishaps with other javascript frameworks cannot be excluded. Try eliminating variables by using one of the default e107 themes or try de-activating your plugins one by one until the problem disappears. Contact your theme or plugin provider.
	It might be the upload has gone wrong (try re-upload with a proper FTP client like e.g. FileZilla) or your web host is not allowing you to use these techniques. Contact your web host.

Changelog:
==========
Version 2.1 (April, 2013):
 * slideshow_news_menu.php: small fixes to reset news_summary properly in reading news articles loop
 * slideshow_easyshop_menu.php : small fixes to fill the gallery_element function properly (this menu is NOT included in the free 1.1/2.x download; available from NLSTART shop)

Version 2.0 (February, 2013):
 * Redesigned and rebuild plugin; changed to jQuery scripts (obsolete 1.x files: js/history*.js, js/jd*.js, js/mootools*.js, js/remooz.js, css/jd*.css, css/layout.css, css/ReMooz.css, css/img, scripts/*)
 * admin_slideshow.php: Added possibility to maintain custom slideshow entries; that can point to any URL of your choice. Active entries will be displayed in slideshow_show menu (Admin Area > Menus).
 * slideshow_*_menu.php: all menus use e107 cache if it is enabled (Admin Area > Cache)
 * slideshow_sql.php: the database validity of Slideshow plugin can be checked (Admin Area > Database > Check database validity > Slideshow)
 * plugin.php: adjusted version for 2.0

Version 1.1 (August 27, 2009):
 * Fixes:
   - slideshow_class.php: fix for IE to prevent stacked display
   - admin_config.php: fix to accept full color code (e.g. #ffffff [was 5])
   - plugin.php: adjusted version for 1.1
 * Tested succesfully on:
   - IE6, IE7, IE8, FF, Chrome browsers.

Version 1.0 (August 26, 2009):
 * Sub-goals for release 1.0: 
   - initial version

License
=======
Slideshow 1.0, 1.1 and 2.0 are distributed as free open source code released under the terms and conditions of the [link=external=http://gnu.org/]GNU General Public License[/link].