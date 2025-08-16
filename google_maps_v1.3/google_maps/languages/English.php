<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Language File :  e107_0.7/e107_plugins/yourplugin/languages/English.php
|        Author:Juan 
|        Email: webmaster@reseau.li
|        Internet website  : http://www.reseau.li/RZO-E107/
+----------------------------------------------------------------------------------------------------+
*/ 
// check English/admin/lan_admin.php for a list of common terms that you
// can use in your ADMIN area.
// By using these terms, your plugin will already be translated in many cases.

//lan in yourplugin.php

define('LAN_YPLUG_1', "Some introductory text<br />");
define('LAN_YPLUG_2', "Some more text<br />");
define('LAN_YPLUG_3', "<b>Your Plugin</b>");
define('LAN_YPLUG_4', "The body of ");
define('LAN_YPLUG_5', "your plugin page </br>");
define('LAN_YPLUG_6', "Your Admin Preference is set to: ");
define('LAN_YPLUG_7', "On");
define('LAN_YPLUG_8', "Off");
define('LAN_YPLUG_9', "my plugin name");
define('LAN_YPLUG_10', "");
define('LAN_YPLUG_11', "");
define('LAN_YPLUG_12', "");

define('LAN_YPLUG_13', "Readme");
define('LAN_YPLUG_14', "
<br/>===============================================================
<br/> YOUR PLUGIN - v3.1 - by Cameron
  <br/> A plugin template for the e107 Website System
 <br/>http://e107.org 
 <br/>For more plugins and help visit: http://www.e107coders.org
<br/>===============================================================

<br/><br/>Changelog:<br/>
=========
Version 3.1:
<br/>- lan added in all files
<br/>- readme.php added
<br/><br/>
Version 3.0:
	<br/>- news options added - textarea, color, datestamp, directory, image, table-readonly etc. 
	<br/>- 0.7 compatible. 
	<br/>- xhtml 1.1 compliant
	<br/>- loop example added in yourplugin.php 
	<br/>- moved config out of ypsettings.php - config is now at the beginning of each script.
	<br/>- support for wysiwyg editor and presets added.
	<br/>- better use of inbuilt js functions. 
	<br/>- plugin.php-maker added to package. 
<br/><br/>
Version 2.3:
	- added accesstable
<br/><br/>
Version 2.2:
       <br/> - added textarea option in formhandler
       <br/> - fixed easy admin menu broken by v6.16
<br/><br/>
Version 2.1:
	<br/>- improved form handling.
	<br/>- added 'date' option.
	<br/>- viewdate() function added.
<br/><br/>
Version 2.0:
	<br/>- dynamic creation of admin area with a new settings file.
	<br/>- support for database tables and improved preference saving.
	<br/>- coding examples
<br/><br/>
Version 1.0:
	- first release
 
<br/><br/>

===============================================================

<br/><br/>

 <br/>Here is a simple template that you can use to 
 <br/>help you in creating a plugin for e107. 

<br/>Files Included:
<br/>===============
<br/><br/>
 Files that require configuration:
	<br/>plugin.php - The Installtion Settings for Your plugin.  
 	<br/>admin_config.php - admin configuration file. 
 	<br/>admin_pref.php - admin preference file. 
 	<br/>admin_menu.php - admin menu file. 
 	<br/>help.php - admin help file. 
	<br/>admin_pluginmaker.php - plugin.php file generator - should be removed after use. 
<br/><br/>
 Files that require some coding:	
 	<br/>yourplugin.php - your plugin's main page. 
 	<br/>yourplugin_menu.php - (Edit this if you want a menu item as well).
	<br/>admin_menu - edit to change your admin menu options. (optional may be deleted)
	<br/>admin_config - the main configuration for your admin area. 
	<br/>admin_pref - preference options. (optional may be deleted)
	<br/>help.php - help file. (optional may be deleted)
	
<br/><br/>
<br/> Optional Editing of these files:
<br/>languages/English.php - language file - used in Yourplugin.php. 
<br/>languages/admin/English.php - admin language file - used in admin area. 
<br/><br/>
 Editing not required:
 	form_handler.php - NO EDITING NECESSARY but REQUIRED for the plugin to work.
	admin_pluginmaker.php - should be removed after use. 

<br/><br/>
 <br/>Anyway, I hope you find this little template useful.. 
<br/>I am sure it can be improved upon.. but its a start. 
<br/><br/>
<br/>I have also included a photoshop file that you can edit for your 
 admin icons. 
<br/><br/>
 Thanks
<br/> Cameron
<br/>( webmaster - www.e107coders.org ) 

<br/><br/>


 If you DO NOT require a menu item.
<br/>==================================
<br/><br/>
1. rename the plugin folder to:
<br/> 'yourplugin' (ie. remove the _menu ) and delete the xxxxxxxx_menu.php file. 
 <br/><br/> 
  Note: 'yourplugin' should be replaced with a unique name of your own in all cases. 
<br/><br/>
2. edit plugin.php:
 <br/> change -   $eplug_menu_name = 'yourplugin_menu';  to $eplug_menu_name = ''; 

<br/><br/>

 If you ONLY require a menu item.
<br/>=================================
<br/><br/>
1. Delete the yourplugin.php file. 
<br/><br/>
2. Open plugin.php and edit the following line:
  <br/> $eplug_link = TRUE; 
   <br/>Change it to:
  <br/> $eplug_link = FALSE;
<br/><br/>
 accesstable instructions
 <br/>=================================
<br/><br/>
It is recommended that you use this in the preferences area only.
<br/><br/>
1) Add an option to select the visibility.  See ypsettings.php for example.
<br/><br/>
2) In your user-facing classes, use the checkclass function (see example
below) to validate access prior to showing the page...
<br/><br/> (see example on the original text) <a href='readme.txt'>readme.txt</a></b>
  ");
?>
