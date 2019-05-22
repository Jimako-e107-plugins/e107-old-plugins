<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        code adapted from code adapted by Tim Cas (timca@volja.net)
|        who adapted it from original code by Lolo Irie (lolo@touchatou.com)
|
|        ©Steve Dunstan 2001-2007
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Link Request";
$eplug_version = "0.1";
$eplug_author = "Roger A. Lareau";
$eplug_logo = "button.png";
$eplug_url = "http://www.NRAmember.com";
$eplug_email = "NRAmember@NRAmember.com";
$eplug_description = "An email request form for adding a link to your site, modified from the Contact Us plugin by Tim Cas, which was a modified SimpleContact plugin by EagleUK.";
$eplug_compatible = "e107 v .616 and v0.7+";
$eplug_readme = "readme.txt";        // leave blank if no readme file

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "linkrequest";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "linkrequest_conf.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/icon.gif";
$eplug_caption =  "Configure Link Request";

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
	"sc_class" => "0" // this is the default class of users who can access the link request form.
);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array(
);

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array(
);

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = "Link Request";
$eplug_link_url = e_PLUGIN."linkrequest/index.php";

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Installation Successful...";

// upgrading ... //
$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$upgrade_alter_tables = "";

$eplug_upgrade_done = "";
?>