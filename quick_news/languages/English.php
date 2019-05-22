<?
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     ©Ricardo Uceda 2007
|     http://www.ion-labs.com
|     ionlabs@gmail.com
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: e107_plugins/quick_news/languages/English.php,v $
|     $Revision: 1.0 $
|     $Author: Ricardo Uceda $
+----------------------------------------------------------------------------+
*/

define("QUICKNEWS_TITLE", "Latest News");

define("QUICKNEWS_LAN01", "Quick News");
define("QUICKNEWS_LAN02", "This plugin lets you create a list of quick news, such as <q>latest news</q>. To activate please go to your menus screen and select the quick_news into one of your menu areas.");
define("QUICKNEWS_LAN03", "Configure Quick News");
define("QUICKNEWS_LAN04", "Quick News plugin has been successfully installed. To add news and configure, return to the main admin page and click on the Quick News icon in the plugin section.");
define("QUICKNEWS_LAN05", "There isn't any news right now...");

define("QUICKNEWS_ERR01", "Incorrect configuration settings detected, default values used. Please, refresh this page.<br />");
define("QUICKNEWS_ERR02", "An invalid identifier was supplied.<br />");
define("QUICKNEWS_ERR10", "Error while trying to do an insert!");
define("QUICKNEWS_ERR11", "Error while trying to modify the text status!");
define("QUICKNEWS_ERR12", "Error while trying to delete the text!");
define("QUICKNEWS_ERR13", "Error while trying to save preferences!");
define("QUICKNEWS_ERR14", "Error while trying to modify the text!");

define("QUICKNEWS_INF01", "There isn't any news right now.");
define("QUICKNEWS_INF02", "Text status successfully changed.");
define("QUICKNEWS_INF03", "Text successfully deleted.");
define("QUICKNEWS_INF04", "Preferences successfully saved.");
define("QUICKNEWS_INF05", "Preferences not saved because of identical values.");
define("QUICKNEWS_INF06", "Text successfully modified.");

define("QUICKNEWS_CFG01", "Quick News Menu");
define("QUICKNEWS_CFG02", "View news");
define("QUICKNEWS_CFG03", "Add news");
define("QUICKNEWS_CFG04", "Preferences");
define("QUICKNEWS_CFG05", "Help");
define("QUICKNEWS_CFG06", "Text");
define("QUICKNEWS_CFG07", "Status");
define("QUICKNEWS_CFG08", "Options");
define("QUICKNEWS_CFG09", "Change status");
define("QUICKNEWS_CFG10", "Delete entry");
define("QUICKNEWS_CFG11", "Do you really want to delete this entry?");
define("QUICKNEWS_CFG12", "Public");
define("QUICKNEWS_CFG13", "Private");
define("QUICKNEWS_CFG14", "Enabled Plugin&#0063;");
define("QUICKNEWS_CFG15", "Stop on mouse over&#0063;");
define("QUICKNEWS_CFG16", "Yes");
define("QUICKNEWS_CFG17", "No");
define("QUICKNEWS_CFG18", "Direction");
define("QUICKNEWS_CFG19", "Enabled");
define("QUICKNEWS_CFG20", "Disabled");
define("QUICKNEWS_CFG21", "Up");
define("QUICKNEWS_CFG22", "Down");
define("QUICKNEWS_CFG23", "Left");
define("QUICKNEWS_CFG24", "Right");
define("QUICKNEWS_CFG25", "Speed");
define("QUICKNEWS_CFG26", "Effect");
define("QUICKNEWS_CFG27", "Height");
define("QUICKNEWS_CFG28", "Marquee");
define("QUICKNEWS_CFG29", "Fade");
define("QUICKNEWS_CFG30", "Edit text");
define("QUICKNEWS_CFG40", "Modify");
define("QUICKNEWS_CFG50", "Send");

define("QUICKNEWS_ADD01", "Add entry");
define("QUICKNEWS_ADD02", "Text");
define("QUICKNEWS_ADD03", "Text added successfully.");

define("QUICKNEWS_HLP01", "Help");
define("QUICKNEWS_HLP02", "<h3>Frequently Asked Questions</h3>
<ul>
	<li style='font-weight:bold;'>
		What effect do you think I should use&#0063;
	</li>
	<li style='list-style-type:none;'>
		Fade, it requires JavaScript, but most modern browsers support it. The marquee tag is not valid according to the HTML or XHTML specifications.<br />
	</li>
	<br />
	<li style='font-weight:bold;'>
		How do I start using this plugin&#0063;
	</li>
	<li style='list-style-type:none;'>
		To activate please go to your menus screen and add quick_news into one of your menu areas.<br />
		Now you just have to add a new entry from the plugin menu.<br />
	</li>
	<br />
	<li style='font-weight:bold;'>
		What speed value can I use&#0063;
	</li>
	<li style='list-style-type:none;'>
		From 1 to 5, with 1 being the fastest and 5 the slowest.<br />
	</li>
	<br />
	<li style='font-weight:bold;'>
		I have several news with marquee effect, and they are too close to each other, Can I separate them&#0063;
	</li>
	<li style='list-style-type:none;'>
		Yes, with up or down direction, edit your CSS-Theme, and add the following line:<br />
		<div style='padding-left:20px;'>#qnscr span { display: block; margin: 18px 0px; }</div>
		With left or right direction, edit your CSS-Theme, and add the following line:<br />
		<div style='padding-left:20px;'>#qnscr span { margin: 0px 28px; }</div>
	</li>
	<br />
	<li style='font-weight:bold;'>
		How can I change the menu title&#0063;
	</li>
	<li style='list-style-type:none;'>
		You should edit the language plugin file and change the first definition: QUICKNEWS_TITLE.<br />
	</li>
	<br />
	<li style='font-weight:bold;'>
		How can I add a link into the message&#0063;
	</li>
	<li style='list-style-type:none;'>
		You need to use HTML code. An example:<br />
		<div style='padding-left:20px;'>Click &lt;a href='http://www.google.com/'&gt;here&lt;/a&gt; to go to google.</div>
	</li>
	<br />
	<li style='font-weight:bold;'>
		The fade effect does not work at all.
	</li>
	<li style='list-style-type:none;'>
		Enable JavaScript in your web browser to see the effect.<br />
	</li>
<ul>");
?>
