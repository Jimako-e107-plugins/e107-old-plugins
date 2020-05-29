<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        ©Steve Dunstan 2001-2006
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/my_little_shop/plugin.php $
|		$Revision: 1.00 $
|		$Date: 2007/06/10 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("handler/constanten.php");
$lan_file = e_PLUGIN.PLUG_FOLDER."languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN.PLUG_FOLDER."languages/German.php");

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name =  MLS_LAN_SYS_0;//" Plugin Name";
$eplug_version = MLS_VERSION; //Plugin Version
$eplug_author = "***RuSsE***";//" Plugin- Autor Name";
$eplug_logo = "button.png";
$eplug_url = "http://www.e107.4xa.de";// Plugin- Autor Website;
$eplug_email = "e107@4xa.de";// Plugin- Autor eMail
$eplug_description = MLS_LAN_SYS_2; // Plugin Beschreibung 
$eplug_compatible = "e107v0.11";
$eplug_readme = "readme.txt";// readme file
$eplug_compliant = TRUE;

// Find current version for upgrade stuff
include_once("../../class2.php");
$MSL_SQL = new db;
$MSL_SQL->db_Select("plugin", "plugin_version", "plugin_name='".$eplug_name."' AND plugin_installflag > 0");
if(list($MLSVers) = $MSL_SQL->db_Fetch()) {
	$MLSVers = preg_replace("/[a-zA-z\s]/", '', $MLSVers);
} else {
	$MLSVers = 0;
}

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder ="my_little_shop";//Plugin Verzeichniss

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = MLS_LAN_SYS_3;// Plugin menu Name

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin/admin_home.php";  // Admin- Startseite.

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/icon_32.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";
$eplug_caption =  MLS_LAN_SYS_4;//"Configure your Shop";

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
		"my_little_shop_men_shmall" => 1, 
		"my_little_shop_men_row" => 2,
		"my_little_shop_men_col" => 2,
		"my_little_shop_kat_row" => 2,
		"my_little_shop_kat_col" => 2,
		"my_little_shop_lager" => 3,
		"my_little_shop_begruesung" => "".MLS_LAN_SYS_8.""
);


// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("mls_category", "mls_hersteller", "mls_steuer", "mls_products", "mls_zubehoer", "mls_kunde_data", "mls_auftrag", "mls_temp", "mls_positionen");


// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array("CREATE TABLE ".MPREFIX."mls_category (
  mls_category_id int(10) unsigned NOT NULL auto_increment,
  mls_category_name varchar(100) NOT NULL default '',
  mls_parend_category_id int(10) unsigned NOT NULL default '0',
  mls_category_steuer_id int(10) unsigned NOT NULL default '0',
  mls_category_text text NOT NULL default '',
  mls_category_enable tinyint(1) NOT NULL default '1',
  mls_category_color varchar(10) NOT NULL default '',
  mls_category_dir varchar(50) NOT NULL default '',
  mls_category_image varchar(50) NOT NULL default '',
  PRIMARY KEY  (mls_category_id)
) TYPE=MyISAM",

"CREATE TABLE ".MPREFIX."mls_hersteller (
  mls_hersteller_id int(10) unsigned NOT NULL auto_increment,
  mls_hersteller_name varchar(100) NOT NULL default '',
  mls_hersteller_url varchar(100) NOT NULL default '',
  mls_hersteller_text text NOT NULL default '',
  mls_hersteller_enable tinyint(1) NOT NULL default '1',
  mls_hersteller_color varchar(10) NOT NULL default '',
  mls_hersteller_dir varchar(50) NOT NULL default '',
  mls_hersteller_image varchar(50) NOT NULL default '',
  PRIMARY KEY  (mls_hersteller_id)
) TYPE=MyISAM",


"CREATE TABLE ".MPREFIX."mls_steuer (
  mls_steuer_id int(10) unsigned NOT NULL auto_increment,
  mls_steuer_name varchar(100) NOT NULL default '',
  mls_steuer_wert int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (mls_steuer_id)
) TYPE=MyISAM",


"CREATE TABLE ".MPREFIX."mls_products (
  mls_products_id int(10) unsigned NOT NULL auto_increment,
  mls_products_name varchar(100) NOT NULL default '',
  mls_products_category_id int(10) unsigned NOT NULL default '0',
  mls_products_hersteller_id int(10) unsigned NOT NULL default '0',
  mls_products_parend_id int(10) unsigned NOT NULL default '0',
  mls_products_price DOUBLE( 7, 2 ) UNSIGNED NOT NULL DEFAULT '0', 
  mls_products_lager int(10) unsigned NOT NULL default '0',
  mls_products_text text NOT NULL default '',
  mls_products_text2 text NOT NULL default '',
  mls_products_enable tinyint(1) NOT NULL default '1',
  mls_products_color varchar(10) NOT NULL default '',
  mls_products_image varchar(50) NOT NULL default '',
  mls_products_pref varchar(50) default NULL,
  mls_products_date varchar(12) default NULL,
  PRIMARY KEY  (mls_products_id),
  FOREIGN KEY(mls_products_category_id) REFERENCES ".MPREFIX."mls_category(mls_category_id),
  FOREIGN KEY(mls_products_hersteller_id) REFERENCES ".MPREFIX."mls_hersteller(mls_hersteller_id)
) TYPE=MyISAM",

"CREATE TABLE ".MPREFIX."mls_zubehoer (
  mls_zubehoer_id int(10) unsigned NOT NULL auto_increment,
  mls_zubehoer_main_id int(10) unsigned NOT NULL default '0',
  mls_zubehoer_par_id int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (mls_zubehoer_id)
) TYPE=MyISAM",

"CREATE TABLE ".MPREFIX."mls_kunde_data (
  mls_kunde_data_id int(10) unsigned NOT NULL auto_increment,
  mls_kunde_data_use_id int(10) unsigned NOT NULL default '0',
  mls_kunde_data_name varchar(100) NOT NULL default '',
  mls_kunde_data_sex varchar(100) NOT NULL default '',
  mls_kunde_data_firstname varchar(100) NOT NULL default '',
  mls_kunde_data_secondname varchar(100) NOT NULL default '',
  mls_kunde_data_contry varchar(100) NOT NULL default '',
  mls_kunde_data_plz varchar(10) NOT NULL default '',
  mls_kunde_data_sity varchar(100) NOT NULL default '',
  mls_kunde_data_sreet varchar(100) NOT NULL default '',
  mls_kunde_data_mail varchar(100) NOT NULL default '',
  mls_kunde_data_telephon varchar(100) NOT NULL default '',
  mls_kunde_data_text text NOT NULL default '',
  mls_kunde_data_enable tinyint(1) NOT NULL default '0',
  mls_kunde_lifer_sex varchar(100) NOT NULL default '',
  mls_kunde_lifer_firstname varchar(100) NOT NULL default '',
  mls_kunde_lifer_secondname varchar(100) NOT NULL default '',
  mls_kunde_lifer_contry varchar(100) NOT NULL default '',
  mls_kunde_lifer_plz varchar(10) NOT NULL default '',
  mls_kunde_lifer_sity varchar(100) NOT NULL default '',
  mls_kunde_lifer_sreet varchar(100) NOT NULL default '',
  mls_kunde_data_image varchar(50) NOT NULL default '',
  mls_kunde_data_pref varchar(50) default NULL,
  PRIMARY KEY  (mls_kunde_data_id)
) TYPE=MyISAM",

"CREATE TABLE ".MPREFIX."mls_auftrag (
  mls_auftrag_id int(10) unsigned NOT NULL auto_increment,
  mls_auftrag_kunde_id int(10) unsigned NOT NULL,
  mls_auftrag_zahlung int(10) unsigned NOT NULL,
  mls_auftrag_status int(10) unsigned NOT NULL,
  mls_auftrag_color varchar(10) NOT NULL default '',
  mls_auftrag_date varchar(12) default NULL,
  mls_auftrag_date2 varchar(12) default NULL,
  mls_auftrag_date3 varchar(12) default NULL,
  PRIMARY KEY  (mls_auftrag_id),
  FOREIGN KEY(mls_auftrag_kunde_id) REFERENCES ".MPREFIX."mls_kunde_data(mls_kunde_data_id)
) TYPE=MyISAM",


"CREATE TABLE ".MPREFIX."mls_temp (
  mls_temp_id int(10) unsigned NOT NULL auto_increment,
  mls_temp_user_id int(10) unsigned NOT NULL,
  mls_temp_user_ip text NOT NULL default '',
  mls_temp_products_id int(10) unsigned NOT NULL,
  mls_temp_anzahl int(10) unsigned NOT NULL,
  mls_temp_date varchar(12) default NULL,
  PRIMARY KEY  (mls_temp_id)
) TYPE=MyISAM",


"CREATE TABLE ".MPREFIX."mls_positionen (
  mls_positionen_id int(10) unsigned NOT NULL auto_increment,
  mls_positionen_auftrag_id int(10) unsigned NOT NULL,
  mls_positionen_products_id int(10) unsigned NOT NULL,
  mls_positionen_enable tinyint(1) NOT NULL default '0',
  mls_positionen_products_anzahl int(10) unsigned NOT NULL,
  mls_positionen_price DOUBLE( 7, 2 ) UNSIGNED NOT NULL DEFAULT '0' ,
  mls_positionen_date varchar(12) default NULL,
  PRIMARY KEY  (mls_positionen_id),
  FOREIGN KEY(mls_positionen_auftrag_id) REFERENCES ".MPREFIX."mls_auftrag(mls_auftrag_id),
  FOREIGN KEY(mls_positionen_products_id) REFERENCES ".MPREFIX."mls_products(mls_products_id)
) TYPE=MyISAM");

////-------------------------------------------------

$eplug_link = true; // Soll ein Link im "Seitenlinks" erstellt werden ?
$eplug_link_name = MLS_LAN_SYS_6;//Link- Text 
$eplug_link_url = "e107_plugins/my_little_shop/sites/kategorien.php";


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = MLS_LAN_SYS_7;//"Installation Successful..";

// Upgrade Plugin
if ($MLSVers < 0.6) {
	// example for add. values:
	$upgrade_alter_tables = array("CREATE TABLE ".MPREFIX."mls_zubehoer (
  mls_zubehoer_id int(10) unsigned NOT NULL auto_increment,
  mls_zubehoer_main_id int(10) unsigned NOT NULL default '0',
  mls_zubehoer_par_id int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (mls_zubehoer_id)
) TYPE=MyISAM");
}
$eplug_upgrade_done = $eplug_name.LAN_INSTALL_3.$MLSVers.LAN_INSTALL_4.$eplug_version.LAN_INSTALL_5;

?>
