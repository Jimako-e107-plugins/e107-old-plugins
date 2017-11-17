<?php
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Last IP";
$eplug_version = "0.5";
$eplug_author = "SharkyDog";
$eplug_logo = "logo32x32.png";
$eplug_url = "http://www.sharkydog.info/";
$eplug_email = "sharkydog@e107bg.org";
$eplug_description = "Tracks last IP used by registered user";
$eplug_compatible = "e107 v0.7+";
$eplug_readme = "ReadMe.txt";

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "lastip_menu";

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "lastip_menu";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/logo32x32.png";
$eplug_icon_small = $eplug_folder."/logo16x16.png";
$eplug_caption =  "Last IP";

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
  "lastip_use_table" => "lastip_ips", // If you change this, change it in admin_config.php too.
  "lastip_list_user_table" => TRUE,
  "lastip_users_per_page" => 20,
  "lastip_ips_per_user" => 5,
  "lastip_change_date" => FALSE
);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array(
  "lastip_ips" // If you change this, change it in admin_config.php too.
);

$eplug_tables = array(
"CREATE TABLE ".MPREFIX."lastip_ips (
  user_id int(10) unsigned NOT NULL default '0',
  user_ip varchar(20) NOT NULL default '',
  user_date int(10) unsigned NOT NULL default '0',
  INDEX lip_user (user_id, user_ip)
)TYPE=MyISAM;"
);

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = FALSE;
$eplug_link_name = "";
$eplug_link_url = "";

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Done!";


$upgrade_alter_tables = "";

$upgrade_add_prefs = "";

$eplug_upgrade_done = "Upgrade done!";

?>