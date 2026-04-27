<?php
/*
*************************************
*        PPGallery					*
*									*
*        (C)Oyabunstyle.de			*
*        http://oyabunstyle.de		*
*        info@oyabunstyle.de		*
*************************************
*/
if (!defined('e107_INIT')) { exit; }
include_lan(e_PLUGIN."ppgallery/languages/".e_LANGUAGE."/plugin.php");
 
// Plugin info  
$eplug_name    = "PPGallery";
$eplug_version = "1.1";
$eplug_author  = "Oyabunstyle";
$eplug_url = "http://oyabunstyle.de";
$eplug_email = "info@oyabunstyle.de";

$eplug_description = PPLAN_01;
$eplug_compatible  = "e107 v0.7+";
$eplug_readme      = "readme.php";

// Name of the plugin's folder
$eplug_folder = "ppgallery";

// Name of menu item for plugin  
$eplug_menu_name = "PPGallery";

// Name of the admin configuration file  
$eplug_conffile = "admin.php";

// Icon image and caption text
$eplug_icon = $eplug_folder."/stuff/32.png";
$eplug_icon_small = $eplug_folder."/stuff/16.png";
$eplug_logo = $eplug_folder."/stuff/32.png";
$eplug_caption = "PPGallery";

// List of preferences 
$eplug_prefs       = "";
$eplug_table_names = ""; 

// Create a link in main menu (yes=TRUE, no=FALSE) 
$eplug_link = TRUE;
$eplug_link_name  = "PPGallery";
$eplug_link_url = e_PLUGIN."ppgallery/index.php";
$eplug_link_perms = "Everyone";

// Text to display after plugin successfully installed 
$eplug_done           = "Installation Successful..";
$eplug_uninstall_done = "Uninstalled Successfully..";

// List of sql requests to create tables 
$eplug_tables = array(
"CREATE TABLE IF NOT EXISTS ".MPREFIX."ppgallery_pref (
	width			varchar(255)	DEFAULT NULL,
	pshow			varchar(255)	DEFAULT NULL,
	zshow			varchar(255)	DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;",
"CREATE TABLE IF NOT EXISTS ".MPREFIX."ppgallery_gallerys (
	gallery			int(10)			UNSIGNED NOT NULL auto_increment,
	name			varchar(255)	DEFAULT NULL,
	description		text			DEFAULT NULL,
	viewclass		int(10)			DEFAULT NULL,
	addclass		int(10)			DEFAULT NULL,
	adminclass		int(10)			NOT NULL DEFAULT  '250',
	gorder			int(10)			DEFAULT NULL,
	PRIMARY KEY (gallery)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;",
"CREATE TABLE IF NOT EXISTS ".MPREFIX."ppgallery_images (
	image			int(10)			UNSIGNED NOT NULL auto_increment,
	is_gallery		int(10)			DEFAULT NULL,
	source			varchar(255)	DEFAULT NULL,
	owner			int(10)			DEFAULT NULL,
	description		text			DEFAULT NULL,
	checked			VARCHAR(50)		NOT NULL DEFAULT  '0',
	PRIMARY KEY (image)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;",
"INSERT INTO ".MPREFIX."ppgallery_pref (width,pshow,zshow) VALUES ('150','12','3')",
);

// List of sql requests to delete values 
if (!function_exists("ppgallery_uninstall")) {
   function ppgallery_uninstall() {
      global $sql;
      $sql->db_Delete("ppgallery_gallerys", "gallery > '0'");
	  $sql->db_Delete("ppgallery_images", "image > '0'");
	  $sql->db_Delete("ppgallery_pref", "width > '0'");
   }
}
?>