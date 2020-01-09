<?php

/*  TEMP FILE to see what else left to move to plugin.xml */

//TAGCLOUD PLUGIN COPYRIGHT 2007-2008 jezza101
//www.jezza101.co.uk
//Plugin released in good faith and has been tested by many users however I make no guarantee of its
//suitability for your site.  Please test carefully!

//If you use this plugin, please link back to my site somewhere from yours :)


if (!defined('e107_INIT')) { exit; }


$eplug_name = "tagcloud";
$eplug_version = "2.0.0";
$eplug_author = "Jezza101";
$eplug_folder = "tagcloud";

 

$eplug_url = "http://www.jezza101.co.uk";
$eplug_email = "jezza101@gmail.com";
$eplug_description = "Top Tag tagclouds for e107!";
$eplug_compatible = "e107v0.7+";
$eplug_readme = "admin_readme.php";
$eplug_compliant = FALSE;
$eplug_menu_name = "Tagcloud";
$eplug_caption = "Tagcloud";
$eplug_status = TRUE;

$eplug_conffile = "admin_config.php";

$eplug_caption = "Configure Tagcloud";
$eplug_done = "Installation Successful...";
$eplug_upgrade_done = "Upgrade successful...";

// List of comment_type ids used by this plugin. -----------------------------
$eplug_comment_ids = array("tagcloud");
 

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = FALSE;

 

?>

