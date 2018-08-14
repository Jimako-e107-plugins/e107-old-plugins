<?php

//PLUGIN INFO------------------------------------------------------------------------------------------------+

  $eplug_name        = "Another Online Menu";
  $eplug_version     = "1.5";
  $eplug_author      = "Richard Perry";
  $eplug_url         = "http://www.greycube.com";
  $eplug_email       = "use_forum";
  $eplug_description = "Another Online Menu";
  $eplug_compatible  = "e107v7";
  $eplug_readme      = "";
  $eplug_compliant   = TRUE;
  $eplug_module      = FALSE;

//PLUGIN FOLDER----------------------------------------------------------------------------------------------+

  $eplug_folder     = "aonline_menu";

//PLUGIN MENU FILE-------------------------------------------------------------------------------------------+

  $eplug_menu_name  = "aonline_menu";

//PLUGIN ADMIN AREA FILE-------------------------------------------------------------------------------------+

  $eplug_conffile   = "aonline_admin.php";

//PLUGIN ICONS AND CAPTION-----------------------------------------------------------------------------------+

  $eplug_logo       = "images/icon_large.png";
  $eplug_icon       = $eplug_folder."/icon_large.png";
  $eplug_icon_small = $eplug_folder."/icon_small.png";
  $eplug_caption    = 'Configure';

//DEFAULT PREFERENCES----------------------------------------------------------------------------------------+

  $eplug_prefs = array("aonline_settings" => base64_encode(serialize(array("max_lastseen"  => "5",
                                                                           "max_newusers"  => "5",
                                                                           "max_user_name" => "16",
                                                                           "max_url_name"  => "12",
                                                                           "menu_width"    => "160"))));

//MYSQL TABLES TO BE CREATED---------------------------------------------------------------------------------+

  $eplug_table_names = "";

//MYSQL TABLE STRUCTURE--------------------------------------------------------------------------------------+

  $eplug_tables = "";

//LINK TO BE CREATED ON SITE MENU--------------------------------------------------------------------------+

  $eplug_link      = FALSE;
  $eplug_link_name = "$eplug_name";
  $eplug_link_url  = e_PLUGIN."$eplug_folder/";

//MESSAGE WHEN PLUGIN IS INSTALLED-------------------------------------------------------------------------+

  $eplug_done = "Plugin is now Installed.";

//SAME AS ABOVE BUT ONLY RUN WHEN CHOOSING UPGRADE---------------------------------------------------------+

  $upgrade_add_prefs    = $eplug_prefs;
  $upgrade_remove_prefs = "";
  $upgrade_alter_tables = "";
  $eplug_upgrade_done   = "";

//---------------------------------------------------------------------------------------------------------+

?>