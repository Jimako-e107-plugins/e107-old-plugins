<?php
/*
+---------------------------------------------------------------+
|        Tournaments plugin for e107 v0.7
|
|        A plugin for the e107 website system
|        http://www.e107.org/
|
|        ©Stratos Geroulis
|        http://www.stratosector.net/
|        stratosg@stratosector.net
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Find User";
$eplug_version = "1.0";
$eplug_author = "stratosg";
$eplug_logo = "";
$eplug_url = "http://www.stratosector.net/";
$eplug_email = "stratosg@stratosector.net";
$eplug_description = "A simple plugin to search users via part (or whole) of their username.";
$eplug_compatible = "e107v7+";
$eplug_readme = "readme.txt";        // leave blank if no readme file

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "find_user";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = "";
$eplug_caption =  "";

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array();

$eplug_tables = array();

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = "Find User";
$eplug_link_url = "e107_plugins/find_user/index.php";


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Installation completed successfuly.<br>I would really appreciate it if you visit my site and leave a comment or a post on the forum about how you like it and where you use it.";


?>