<?php
/*
+ -----------------------------------------------------------------------------+
|     e107 website system - Language File.
|
|     $Source: /cvsroot/e107/e107_0.7/e107_plugins/custom_theme/admin_custom_theme_config.php,v $
|     $Revision: 1.0 $
|     $Date: 2005/06/20 13:36:44 $
|     $Author: lisa_ $
+-----------------------------------------------------------------------------+
*/


define("CUSTOMTHEME_PLUGIN_LAN_1", "Allow Plugins and Pages to use a seperate THEME file to use explicitely and uniquely for that plugin or page.");
define("CUSTOMTHEME_PLUGIN_LAN_2", "Configure Plugin Theme");
define("CUSTOMTHEME_PLUGIN_LAN_3", "The Custom_Theme plugin is now installed. To configure Custom_Theme follow this link.");

define("CUSTOMTHEME_LAN_1", "CUSTOM THEMES");
define("CUSTOMTHEME_LAN_2", "PLUGINS");
define("CUSTOMTHEME_LAN_3", "PAGES");
define("CUSTOMTHEME_LAN_4", "plugin");
define("CUSTOMTHEME_LAN_5", "page");
define("CUSTOMTHEME_LAN_6", "current theme");
define("CUSTOMTHEME_LAN_7", "update");
define("CUSTOMTHEME_LAN_8", "Custom Theme Configuration");
define("CUSTOMTHEME_LAN_9", "Custom Themes succesfully saved");
define("CUSTOMTHEME_LAN_10", "enter page");
define("CUSTOMTHEME_LAN_11", "add new custom page");
define("CUSTOMTHEME_LAN_12", "updating options ...");

define("CUSTOMTHEME_HELP_0", "custom theme help area");
define("CUSTOMTHEME_HELP_1", "
<b>CUSTOM THEMES : PLUGIN</b><br />
you can define a custom theme for each installed plugin by choosing a theme from the select box.<br />
<br />
if you select the option 'none' the normal sitetheme will be used.<br />
<br />
<br />
<b>CUSTOM THEMES : PAGES</b><br />
enter the full name of the custompage name with the '.php' extension (eg 'stats.php' and not 'stats')<br />
<br />
you can enter a page with a full url and query<br />--> 'news.php?cat.2'<br />
<br />
if you select the option 'none', that page will be removed from the custom theme plugin and the normal sitetheme will be used for that page.<br />
<br />
if the provided page is part of a plugin you already defined a theme for in the above custom themes plugin section, the custom themes:page setting will be used over the custom themes:plugin setting.
");


?>