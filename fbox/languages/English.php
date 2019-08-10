<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Email: office@clabteam.com
|        Organization: Corllete® Lab Copyright 2007 Corllete ltd. - www.clabteam.com
|        $Id: English.php 671 2007-11-16 12:16:55Z secretr $
|        License: GNU GENERAL PUBLIC LICENSE - http://www.gnu.org/licenses/gpl.txt
+----------------------------------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

//Plugin Info
define('FBOX_LANADM', 'Corllete Lab Feature Box');
define('FBOX_LANADM_0', 'SecretR @Corllete Lab');
define('FBOX_LANADM_1', 'http://www.clabteam.com');
define('FBOX_LANADM_2', 'm.yovchev@clabteam.com');
define('FBOX_LANADM_3', 'This is plugin is advanced version of the core Feature Box module. It\'s aimed to give more flexibility to theme developers and of course of your own site content.<br />Theme developer\'s info can be found in <strong>readme.txt</strong> or at <strong>www.free-source.net</strong>');
define('FBOX_LANADM_4', 'Advanced Feature Box');
define('FBOX_LANADM_5', 'Installation Successful..');

//admin
define('FBOX_LANSYSMSG', 'System message');
define('FBOX_LANSYSMSG_1', 'Settings updated');
define('FBOX_LANSYSMSG_2', 'Unknown event! No action taken.');
define('FBOX_LANSYSMSG_3', 'Page not found!');
define('FBOX_LANSYSMSG_4', 'Item not found!');
define('FBOX_LANSYSMSG_5', 'No Items yet!');
define('FBOX_LANSYSMSG_UPDATE', 'Item updated');
define('FBOX_LANSYSMSG_NA', 'n/a');
define('FBOX_LANSYSMSG_CONFIRM', 'Are you sure you want to delete this item?');

define('FBOX_LANADM_M', 'Administration Menu');
define('FBOX_LANADM_M1', 'Help &amp; contribution');
define('FBOX_LANADM_M2', 'Settings');
define('FBOX_LANADM_M3', 'Readme');
define('FBOX_LANADM_M4', 'Create');
define('FBOX_LANADM_M5', 'List');

//settings
define('FBOX_LANCONF', 'Plugin Settings');
define('FBOX_LANCONF_1', 'Front-end global access permissions');
define('FBOX_LANCONF_1a', 'Choose Nobody to disable the plugin');
define('FBOX_LANCONF_2', 'Default menu template');
define('FBOX_LANCONF_2a', 'Used in <strong>fbox</strong> menu if no item template is specified');
define('FBOX_LANCONF_3', 'Enable Ajax');
define('FBOX_LANCONF_3a', 'Used in <strong>fbox</strong> menu');
define('FBOX_LANCONF_4', 'Menu template');
define('FBOX_LANCONF_4a', 'Override per item choosen template with this one in <strong>fbox</strong> menu (leave empty to disable)');

define('FBOX_LANCONF_DEFAULT', 'Default');
define('FBOX_LANCONF_ALTERNATE', 'Alternate');
define('FBOX_LANCONF_NONE', 'Don\'t override');

//create | edit
define('FBOX_LANMNG', 'Manage Content');
define('FBOX_LANMNG_1', 'Title');
define('FBOX_LANMNG_2', 'Text');
define('FBOX_LANMNG_3', 'Item visibility permissions');
define('FBOX_LANMNG_4', 'Page Filter - page match rules (one page/url per line) - show this item only on the following pages');
define('FBOX_LANMNG_5', 'Item template');
define('FBOX_LANMNG_6', 'Default on Page (enter exact match url e.g. &quot;{e_PLUGIN}sgallery/gallery.php&quot; or &quot;{e_BASE}download.php&quot;');
define('FBOX_LANMNG_7', 'Choose image for this item (optional - depends on current template)<br />You can copy additional images to fbox/templates/tmp_images or your_theme/fbox/tmpl_images folders');
define('FBOX_LANMNG_8', 'Plugin images');
define('FBOX_LANMNG_9', 'Theme images');

//lsit
define('FBOX_LANLIST', 'Item List');
define('FBOX_LANLIST_1', 'Title');
define('FBOX_LANLIST_2', 'Visibility');
define('FBOX_LANLIST_3', 'Default Page');
define('FBOX_LANLIST_4', 'Page Filter');
define('FBOX_LANLIST_5', 'Actions');
define('FBOX_LANLIST_6', 'show/hide');

//help & contribute page
define('FBOX_LANHELP', 'Help &amp; Contribution tips');
define('FBOX_LANHELP_QUESTION', 'Q:');
define('FBOX_LANHELP_ANSWER', 'A:');

define('FBOX_LANHELP_1', 'I\'m in trouble! Who can help me?');
define('FBOX_LANHELP_1a', 'If you think the problem comes with our plugin, you are more than welcome on');
define('FBOX_LANHELP_2', 'I have a suggestion about this plugin! Is there anyone who\'ll listen to me?');
define('FBOX_LANHELP_2a', 'All requests regarding our plugins &amp; themes will be very carefully reviewed. Come and post your ideas on our forums at');
define('FBOX_LANHELP_3', 'You guys are great! How can I contribute to your projects &amp; themes?');
define('FBOX_LANHELP_3a', 'Nothing is more easy than that! Join us at %s% and share all improvements you\'ve made, post a link to us on your site or just give us your feedback.');
define('FBOX_LANHELP_3b', 'Of course you could always donate a small sum using the donate button on our home page ;)');

//readme page
define('FBOX_LANREADME', 'Preview of the content of readme.txt');

//fbox menu
define('FBOX_MENU_1', 'Did you know?');
define('FBOX_LODING', 'Loading, please wait...');
?>