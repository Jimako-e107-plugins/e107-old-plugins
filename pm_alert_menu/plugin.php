<?php

//PLUGIN INFO------------------------------------------------------------------------------------------------+

  $eplug_name        = "PM Alert";
  $eplug_version     = "1.2";
  $eplug_author      = "Richard Perry";
  $eplug_url         = "http://www.greycube.com";
  $eplug_email       = "use_forum";
  $eplug_description = "PM Alert";
  $eplug_compatible  = "e107v7";
  $eplug_readme      = "http://www.greycube.com/help/readme/pm_alert/";
  $eplug_compliant   = TRUE;
  $eplug_module      = FALSE;

//PLUGIN FOLDER----------------------------------------------------------------------------------------------+

  $eplug_folder      = "pm_alert_menu";

//PLUGIN MENU FILE-------------------------------------------------------------------------------------------+

  $eplug_menu_name   = "pm_alert_menu";

//PLUGIN ICONS AND CAPTION-----------------------------------------------------------------------------------+

  $eplug_conffile    = "pm_alert_admin.php";

//PLUGIN ICONS AND CAPTION-----------------------------------------------------------------------------------+

  $eplug_logo        = "{$eplug_folder}/icon_pm_alert_32x32.png";
  $eplug_icon        = "{$eplug_folder}/icon_pm_alert_32x32.png";
  $eplug_icon_small  = "{$eplug_folder}/icon_pm_alert_16x16.png";
  $eplug_caption     = 'Configure';

//DEFAULT PREFERENCES----------------------------------------------------------------------------------------+

  $eplug_prefs = array(
  "pm_alert_title"  => "PM Alert",
  "pm_alert_hover"  => "CLICK TO VIEW",
  "pm_alert_ignore" => 90,
  "pm_alert_direct" => 2
  );

//MYSQL TABLES TO BE CREATED---------------------------------------------------------------------------------+

  $eplug_table_names = "";

//MYSQL TABLE STRUCTURE--------------------------------------------------------------------------------------+

  $eplug_tables = "";

//LINK TO BE CREATED ON SITE MENU--------------------------------------------------------------------------+

  $eplug_link      = FALSE;
  $eplug_link_name = $eplug_name;
  $eplug_link_url  = e_PLUGIN."{$eplug_folder}/";

//MESSAGE WHEN PLUGIN IS INSTALLED-------------------------------------------------------------------------+

  $eplug_done = "Plugin Installed.";

//SAME AS ABOVE BUT ONLY RUN WHEN CHOOSING UPGRADE---------------------------------------------------------+

  $upgrade_add_prefs    = $eplug_prefs;
  $upgrade_remove_prefs = "";
  $upgrade_alter_tables = "";
  $eplug_upgrade_done   = "";

//---------------------------------------------------------------------------------------------------------+

?>