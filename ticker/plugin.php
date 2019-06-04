<?php

$eplug_name = "Live-Ticker";
$eplug_version = "1.0";
$eplug_author = "VeN0m";
$eplug_folder = "ticker";
$eplug_icon = $eplug_folder."/images/ticker32.png";
$eplug_icon_small = $eplug_folder."/images/ticker16.png";
$eplug_url = "";
$eplug_email = "scharfer.senf@googlemail.com";
$eplug_description = "A live ticker / blog system for short news.";
$eplug_compatible = "e107v0.7+";
$eplug_caption = false;;
$eplug_link = FALSE;
$eplug_done = "Done";
$eplug_upgrade_done = "Upgrade successful...";
$eplug_menu_name = false;
$eplug_conffile = "admin_prefs.php";
$eplug_table_names = array("ticker");

$eplug_tables = array(

   "CREATE TABLE ".MPREFIX."ticker (
  `id` int(11) NOT NULL auto_increment,
  `message` text NOT NULL,
  `timestamp` int(15) NOT NULL,
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `cat` varchar(100) NOT NULL,
  `active` int(2) NOT NULL,
  PRIMARY KEY  (`id`)

   ) TYPE=MyISAM;",

);



?>