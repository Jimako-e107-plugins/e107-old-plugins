<?php

//PLUGIN INFO------------------------------------------------------------------------------------------------+

  $eplug_name        = "LGSL";
  $eplug_version     = "5.x";
  $eplug_author      = "Richard Perry";
  $eplug_url         = "http://www.greycube.com";
  $eplug_email       = "use_forum";
  $eplug_description = "Live Game Server List";
  $eplug_compatible  = "e107v7";
  $eplug_readme      = "http://www.greycube.com/help/readme/lgsl/";
  $eplug_compliant   = TRUE;
  $eplug_module      = FALSE;

//PLUGIN FOLDER----------------------------------------------------------------------------------------------+

  $eplug_folder = "lgsl";

//PLUGIN MENU FILE-------------------------------------------------------------------------------------------+

  $eplug_menu_name = "lgsl_menu";

//PLUGIN ADMIN AREA FILE-------------------------------------------------------------------------------------+

  $eplug_conffile = "admin.php";

//PLUGIN ICONS AND CAPTION-----------------------------------------------------------------------------------+

  $eplug_logo       = $eplug_folder."/lgsl_files/other/icon_lgsl_32x32.png";
  $eplug_icon       = $eplug_folder."/lgsl_files/other/icon_lgsl_32x32.png";
  $eplug_icon_small = $eplug_folder."/lgsl_files/other/icon_lgsl_16x16.png";
  $eplug_caption    = 'Configure';

//DEFAULT PREFERENCES----------------------------------------------------------------------------------------+

  $eplug_prefs = "";

//MYSQL TABLES TO BE CREATED---------------------------------------------------------------------------------+

  $eplug_table_names = array
  (
  "lgsl"
  );

//MYSQL TABLE STRUCTURE--------------------------------------------------------------------------------------+

  $eplug_tables = array
  (
  "CREATE TABLE `".MPREFIX."lgsl` (

    `id`         INT     (11)  NOT NULL auto_increment,
    `type`       VARCHAR (50)  NOT NULL DEFAULT '',
    `ip`         VARCHAR (255) NOT NULL DEFAULT '',
    `c_port`     VARCHAR (5)   NOT NULL DEFAULT '0',
    `q_port`     VARCHAR (5)   NOT NULL DEFAULT '0',
    `s_port`     VARCHAR (5)   NOT NULL DEFAULT '0',
    `zone`       TINYINT (1)   NOT NULL DEFAULT '0',
    `disabled`   TINYINT (1)   NOT NULL DEFAULT '0',
    `comment`    VARCHAR (255) NOT NULL DEFAULT '',
    `status`     TINYINT (1)   NOT NULL DEFAULT '0',
    `cache`      TEXT          NOT NULL,
    `cache_time` TEXT          NOT NULL,

    PRIMARY KEY (`id`)

  ) ".(strpos(mysql_get_server_info(), "4.0") !== FALSE ? "TYPE=MyISAM;" : "ENGINE=MyISAM CHARSET=utf8 COLLATE=utf8_unicode_ci;")
  );

//LINK TO BE CREATED ON SITE MENU--------------------------------------------------------------------------+

  $eplug_link      = TRUE;
  $eplug_link_name = "$eplug_name";
  $eplug_link_url  = e_PLUGIN."$eplug_folder/";

//MESSAGE WHEN PLUGIN IS INSTALLED-------------------------------------------------------------------------+

  $eplug_done = "Plugin is now Installed.";

//SAME AS ABOVE BUT ONLY RUN WHEN CHOOSING UPGRADE---------------------------------------------------------+

  $upgrade_add_prefs    = "";
  $upgrade_remove_prefs = "";
  $upgrade_alter_tables = "";
  $eplug_upgrade_done   = "";

//---------------------------------------------------------------------------------------------------------+

?>