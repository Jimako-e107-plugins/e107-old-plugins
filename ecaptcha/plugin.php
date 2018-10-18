<?php

//PLUGIN INFO------------------------------------------------------------------------------------------------+

  $eplug_name        = "eCaptcha";
  $eplug_version     = "3.5";
  $eplug_author      = "Richard Perry";
  $eplug_url         = "http://www.greycube.com";
  $eplug_email       = "use_forum";
  $eplug_description = "Plugin";
  $eplug_compatible  = "e107v7";
  $eplug_readme      = "http://www.greycube.com/help/readme/ecaptcha/";
  $eplug_compliant   = FALSE;
  $eplug_module      = TRUE;

//PLUGIN FOLDER----------------------------------------------------------------------------------------------+

  $eplug_folder      = "ecaptcha";

//PLUGIN MENU FILE-------------------------------------------------------------------------------------------+

  $eplug_menu_name   = "ecaptcha";

//PLUGIN ADMIN AREA FILE-------------------------------------------------------------------------------------+

  $eplug_conffile    = "ecaptcha_admin.php";

//PLUGIN ICONS AND CAPTION-----------------------------------------------------------------------------------+

  $eplug_logo        = "icon_large.png";
  $eplug_icon        = "{$eplug_folder}/icon_{$eplug_folder}_32x32.png";
  $eplug_icon_small  = "{$eplug_folder}/icon_{$eplug_folder}_16x16.png";
  $eplug_caption     = "Configure";

//DEFAULT PREFERENCES----------------------------------------------------------------------------------------+

  $eplug_prefs = array(

  "ecaptcha_notify_check"           => "0",
  "ecaptcha_type_signup"            => "",
  "ecaptcha_type_guests"            => "invisible",
  "ecaptcha_type_members"           => "",
  "ecaptcha_login"                  => "1",
  "ecaptcha_fpw"                    => "1",
  "ecaptcha_contactform"            => "0",
  "ecaptcha_cookie"                 => "1",
  "ecaptcha_links_comments_guests"  => "0",
  "ecaptcha_links_forum_guests"     => "1",
  "ecaptcha_links_comments_members" => "0",
  "ecaptcha_links_forum_members"    => "4",
  "ecaptcha_style"                  => "0",
  "ecaptcha_immunity"               => "0",
  "ecaptcha_ajax"                   => "0",
  "ecaptcha_hotfix_charset"         => "0",
  "ecaptcha_file_bypass"            => "1",
  "ecaptcha_length_min"             => "3",
  "ecaptcha_length_max"             => "5",
  "ecaptcha_recaptcha_public"       => "",
  "ecaptcha_recaptcha_private"      => "");

//MYSQL TABLES TO BE CREATED---------------------------------------------------------------------------------+

  $eplug_table_names = array("ecaptcha");

//MYSQL TABLE STRUCTURE--------------------------------------------------------------------------------------+

  $eplug_tables = array(

  "CREATE TABLE ".MPREFIX."ecaptcha (

  `key`         varchar(128) NOT NULL default '',
  `code`        varchar(128) NOT NULL default '',
  `post`        mediumtext   NOT NULL default '',
  `ip`          varchar(128) NOT NULL default '',
  `timestamp`   int(11)      NOT NULL default '0'

  ) ENGINE=MyISAM;");

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

  unset($upgrade_add_prefs['ecaptcha_recaptcha_public']);
  unset($upgrade_add_prefs['ecaptcha_recaptcha_private']);

//---------------------------------------------------------------------------------------------------------+

?>