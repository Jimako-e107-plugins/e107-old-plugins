<?php

//PLUGIN INFO------------------------------------------------------------------------------------------------+

  $eplug_name        = "Enemy Down Rank";
  $eplug_version     = "1.3";
  $eplug_author      = "Richard Perry";
  $eplug_url         = "http://www.greycube.com";
  $eplug_email       = "use_forum";
  $eplug_description = "Enemy Down Rank";
  $eplug_compatible  = "e107v7";
  $eplug_readme      = "readme.txt";
  $eplug_compliant   = TRUE;
  $eplug_module      = FALSE;

//PLUGIN FOLDER----------------------------------------------------------------------------------------------+

  $eplug_folder = "enemydownrank";

//PLUGIN MENU FILE-------------------------------------------------------------------------------------------+

  $eplug_menu_name = "enemydownrank";

//PLUGIN ADMIN AREA FILE-------------------------------------------------------------------------------------+

  $eplug_conffile = "enemydownrank_admin.php";

//PLUGIN ICONS AND CAPTION-----------------------------------------------------------------------------------+

  $eplug_logo       = $eplug_folder."/icon_enemydownrank_32x32.png";
  $eplug_icon       = $eplug_folder."/icon_enemydownrank_32x32.png";
  $eplug_icon_small = $eplug_folder."/icon_enemydownrank_16x16.png";
  $eplug_caption    = 'Configure';

//DEFAULT PREFERENCES----------------------------------------------------------------------------------------+

  $eplug_prefs = "";

//MYSQL TABLES TO BE CREATED---------------------------------------------------------------------------------+

  $eplug_table_names = array
  (
  "enemydownrank"
  );

//MYSQL TABLE STRUCTURE--------------------------------------------------------------------------------------+

  $eplug_tables = array
  (
  "CREATE TABLE `".MPREFIX."enemydownrank`
  (
    `id`           int     (11)  NOT NULL auto_increment,
		`timestamp`    int     (11)  NOT NULL default '0',

 		`clan_id`      varchar (255) NOT NULL default '',
		`clan_name`    varchar (255) NOT NULL default '',
    
		`ladder_id`    varchar (255) NOT NULL default '',
		`ladder_name`  varchar (255) NOT NULL default '',
		`ladder_rank`  varchar (255) NOT NULL default '',    

    PRIMARY KEY (`id`)
    
  ) TYPE=MyISAM".(strpos(mysql_get_server_info(), "4.0") !== FALSE ? ";" : " CHARSET=utf8 COLLATE=utf8_unicode_ci;")
  );

//LINK TO BE CREATED ON SITE MENU--------------------------------------------------------------------------+

  $eplug_link      = FALSE;
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
