<?php
/*	$Id: admin.php 841 2010-01-20 12:26:25Z secretr $ */

/* Admin Menu */
define('CLW_LANADM_M', 'Administration Menu');
define('CLW_LANADM_M1', 'Help &amp; contribution');
define('CLW_LANADM_M2', 'Settings');
//define('CLW_LANADM_M3', 'Readme');
define('CLW_LANADM_M4', 'Widget List');
define('CLW_LANADM_M5', 'Manage');

/* Admin System Messages */
define('CLW_LANSYSMSG', 'System message');
define('CLW_LANSYSMSG_1', 'Settings updated');
define('CLW_LANSYSMSG_2', 'Unknown event! No action taken.');
define('CLW_LANSYSMSG_3', 'Page not found!');
define('CLW_LANSYSMSG_5', 'No Installed widgets yet!');
define('CLW_LANSYSMSG_6', 'No widgets yet!');
define('CLW_LANSYSMSG_UPDATE', 'Item updated');
define('CLW_LANSYSMSG_NA', 'n/a');
define('CLW_LANSYSMSG_CONFIRM', 'Are you sure you want to uninstall this widget?');
define('CLW_LANSYSMSG_CACHE_WARN', ' is not writeable! This could lead to serious performance issues!');

/* Help & Contribute page */
define('CLW_LANHELP', 'Help &amp; Contribution tips');
define('CLW_LANHELP_QUESTION', 'Q:');
define('CLW_LANHELP_ANSWER', 'A:');

define('CLW_LANHELP_1', 'I\'m in trouble! Who can help me?');
define('CLW_LANHELP_1a', 'If you think the problem comes with our plugin, you are more than welcome on');
define('CLW_LANHELP_2', 'I have a suggestion about this plugin! Is there anyone who\'ll listen to me?');
define('CLW_LANHELP_2a', 'All requests regarding our plugins &amp; themes will be very carefully reviewed. Come and post your ideas on our forums at');
define('CLW_LANHELP_3', 'You guys are great! How can I contribute to your projects &amp; themes?');
define('CLW_LANHELP_3a', 'Nothing is more easy than that! Join us at %s% and share all improvements you\'ve made, post a link to us on your site or just give us your feedback.');
define('CLW_LANHELP_3b', 'Of course you could always donate a small sum using the donate button on our home page ;)');

/* Widget list */
define('CLW_LANLIST_INSTALLED', 'List of all installed Widgets');
define('CLW_LANLIST_NOTINSTALLED', 'List of all available but not installed Widgets');

define('CLW_LANLIST_1', 'Author');
define('CLW_LANLIST_2', 'Version');
define('CLW_LANLIST_3', 'Website');
define('CLW_LANLIST_4', 'Install');
define('CLW_LANLIST_5', 'Uninstall');
define('CLW_LANLIST_6', 'Configure');

define('CLW_LANLIST_50', 'Email not available');

/* Widget manager */
define('CLW_LANMANAGE_1', 'Ooops - widget already isntalled?');
define('CLW_LANMANAGE_2', 'Ooops - widget you are trying to install is missing!');
define('CLW_LANMANAGE_3', 'Ooops - widget can\'t be installed! Pre-install action failed.');
define('CLW_LANMANAGE_4', 'successfully installed!');
define('CLW_LANMANAGE_5', 'Ooops - widget you are trying to uninstall is missing!');
define('CLW_LANMANAGE_6', 'Ooops - Pre-uninstall action failed.');
define('CLW_LANMANAGE_7', 'successfully uninstalled!');
define('CLW_LANMANAGE_8', 'Uninstallation failed!');
define('CLW_LANMANAGE_9', 'Installation failed!');
define('CLW_LANMANAGE_10', 'Manage');
define('CLW_LANMANAGE_11', 'Installation Warning!');
define('CLW_LANMANAGE_12', 'Unable to install required BBcodes');
define('CLW_LANMANAGE_12a', 'source');
define('CLW_LANMANAGE_12b', 'destination');
define('CLW_LANMANAGE_12c', ' is missing');
define('CLW_LANMANAGE_12d', ' already exists');
define('CLW_LANMANAGE_12e', ' copy failed');
define('CLW_LANMANAGE_12f', ' deletion failed');
define('CLW_LANMANAGE_13', 'The following files were not copied: ');
define('CLW_LANMANAGE_14', 'Uninstallation Warning!');
define('CLW_LANMANAGE_15', 'The following files were not deleted: ');


/* Config */
define('CLW_LANCONFIG_1', 'Global Configuration');
define('CLW_LANCONFIG_2', 'Javascript Server Cache (do not disable if you don\'t understand this!)');
define('CLW_LANCONFIG_3', 'Debug');
define('CLW_LANCONFIG_4', 'Settings saved');
define('CLW_LANCONFIG_5', 'Enable e107 0.8 Compatible Mod');
define('CLW_LANCONFIG_6', 'Include e107 0.8 Compatible Mod frontend stylesheet');
define('CLW_LANCONFIG_7', 'Include e107 0.8 Compatible Mod administration stylesheet (recommended)');
define('CLW_LANCONFIG_8', '0.8 Compatible Mod is required by one or more currently installed widgets, so it can\'t be disabled at this time.');
define('CLW_LANCONFIG_9', '<strong>%s</strong> requires 0.8 Compatible Mod.');

//1.01
define('CLW_LANMANAGE_16', 'Ooops - widget you are trying to update is missing!');
define('CLW_LANMANAGE_17', 'successfully updated!');
define('CLW_LANMANAGE_18', 'Update failed!');
define('CLW_LANMANAGE_19', 'Ooops - widget can\'t be updated! Pre-update action failed.');
define('CLW_LANMANAGE_20', 'Please refer to widget\'s author for more information.');

define('CLW_LANLIST_7', 'Update');
define('CLW_LANLIST_8', 'License');
define('CLW_LANLIST_9', 'License URL');
define('CLW_LANLIST_10', 'Version missmatch - downgrade is not supported yet!');

//v1.02 - preference validation
define('CLW_LANPREFV_1', '<strong>&quot;%s&quot;</strong> validation error: %s'); //error template
define('CLW_LANPREFV_2', 'Settings successfully saved'); 
define('CLW_LANPREFV_3', 'Please make required changes and try again. Settings NOT saved!');
define('CLW_LANPREFV_4', 'Factory Settings successfully restored and saved'); 

//v1.5
define('CLW_LANCONFIG_10', 'Javascript Compression (do not disable if you don\'t understand this!)');
define('CLW_LANCONFIG_11', 'Clear Server Cache');
define('CLW_LANCONFIG_11a', 'Server Cache cleared');
define('CLW_LANCONFIG_12', 'Clear All Cache');
define('CLW_LANCONFIG_12a', 'Browser and server cache cleared');