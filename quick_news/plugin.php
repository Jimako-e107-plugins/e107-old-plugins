<?
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     ©Ricardo Uceda 2007
|     http://www.ion-labs.com
|     ionlabs@gmail.com
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: e107_plugins/quick_news/plugin.php,v $
|     $Revision: 1.0 $
|     $Author: Ricardo Uceda $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN."quick_news/languages/".e_LANGUAGE.".php");

// Plugin info ---------------------------------------------------------------
$eplug_name = QUICKNEWS_LAN01;
$eplug_version = "1.0";
$eplug_author = "Ricardo Uceda";
$eplug_url = "http://www.ion-labs.com/";
$eplug_email = "ionlabs@gmail.com";
$eplug_description = QUICKNEWS_LAN02;
$eplug_compatible = "e107v0.7+";
$eplug_readme = "";

// Name of the plugin's folder -----------------------------------------------
$eplug_folder = "quick_news";

// Name of the admin configuration file --------------------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text -----------------------------------------------
$eplug_icon = $eplug_folder."/images/icon_32.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";
$eplug_caption = QUICKNEWS_LAN03;

// List of sql requests to create tables -------------------------------------
$eplug_tables = array( 	"INSERT INTO ".MPREFIX."core VALUES ( 'quick_news_prefs', 'a:6:{s:9:\"plgstatus\";s:1:\"1\";s:9:\"behaviour\";s:1:\"0\";s:9:\"direction\";s:1:\"0\";s:6:\"speedo\";s:1:\"2\";s:6:\"height\";s:2:\"50\";s:7:\"marquee\";s:1:\"0\";}' );",
			"INSERT INTO ".MPREFIX."menus VALUES ( '', 'quick_news_menu', 0, 0, 0, '', 'quick_news/' );",
			"CREATE TABLE `".MPREFIX."quick_news` ( 
				`qnew_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
				`qnew_visible` TINYINT UNSIGNED NULL DEFAULT '1',
				`qnew_text` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
				 INDEX ( `qnew_id` )
			 ) TYPE=MyISAM ;" );

// List of table names -------------------------------------------------------
$eplug_table_names = array(
"quick_news"
);

// Create a link in main menu ------------------------------------------------
$eplug_link = FALSE;
$eplug_link_name = "";
$eplug_link_url = "";
$eplug_link_perms = "";

// Text to display after plugin successfully installed -----------------------
$eplug_done = QUICKNEWS_LAN04;

if(!function_exists("quick_news_uninstall"))
{
	//Remove quick_news table
	function quick_news_uninstall()
	{
		global $sql;
		$sql->db_Delete("core", "e107_name = 'quick_news_prefs'");
		$sql->db_Delete("menus", "menu_name = 'quick_news_menu'");
	}
}

?>
