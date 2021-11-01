<?php
/*
+ ----------------------------------------------------------------------------+
|    e107 website system
|
|    ©Steve Dunstan 2001-2002
|    http://e107.org
|    jalist@e107.org
|
|    Released under the terms and conditions of the
|    GNU General Public License (http://gnu.org).
|
|    $Source: /cvsroot/e107/e107_0.7/e107_plugins/pagerestriction/languages/English.php,v $
|    $Revision: 1.0 $
|    $Date: 2006/07/23 08:03:58 $
|    $Author: lisa_ $
+----------------------------------------------------------------------------+
*/

define("LAN_PAGERESTRICTION_PLUGIN_1", "Allow to restrict access to pages.");
define("LAN_PAGERESTRICTION_PLUGIN_2", "Configure Page Restriction");
define("LAN_PAGERESTRICTION_PLUGIN_3", "The Page Restriction plugin is now installed. To configure Page Restriction follow this link.");

define("LAN_PAGERESTRICTION_1", "installed plugins");
define("LAN_PAGERESTRICTION_2", "uninstalled plugins");
define("LAN_PAGERESTRICTION_3", "custom pages");
define("LAN_PAGERESTRICTION_4", "plugin");
define("LAN_PAGERESTRICTION_5", "page");
define("LAN_PAGERESTRICTION_6", "current class");
define("LAN_PAGERESTRICTION_7", "update");
define("LAN_PAGERESTRICTION_8", "Page Restriction Configuration");
define("LAN_PAGERESTRICTION_9", "Page Restriction succesfully saved");
define("LAN_PAGERESTRICTION_10", "enter page");
define("LAN_PAGERESTRICTION_11", "add new Page Restriction");
define("LAN_PAGERESTRICTION_12", "updating options ...");
define("LAN_PAGERESTRICTION_13", "options");
define("LAN_PAGERESTRICTION_14", "redirect invalid requests to this url");

define("LAN_PAGERESTRICTION_HELP_0", "Page Restriction Help");
define("LAN_PAGERESTRICTION_HELP_1", "
<b>plugins</b><br />
You can define the page restriction for both installed and uninstalled plugins by choosing the userclass in the select box for the plugin.
<br /><br />
<b>custom pages</b><br />
enter the full name of the custom page name with the '.php' extension (eg 'stats.php' and not 'stats')<br />
<br />you can enter a page with a full url and query : 'news.php?cat.2'<br />
<br />if you select the option 'Everyone (Public)', that page will be removed from the page restriction plugin and the page will be accessable for everyone.<br /><br />if the provided page is part of a plugin you already defined a page restriction for in the above plugin section, the 'page' setting will be used over the 'plugin' setting.
<br /><br />
<b>options</b><br />
you can define a redirection url to redirect users to who do not have enough permission to view the page or plugin. If you leave this field empty, those users will be redirected to the frontpage.
");


?>