<?php
/*
+---------------------------------------------------------------+
|        Page Ear - by Barry )
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "pageear/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "pageear/languages/admin/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "pageear/languages/admin/English.php");
}
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Page Ear";
$eplug_version = "1.1";
$eplug_author = "Father Barry";
$eplug_url = "http://www.keal.me.uk";
$eplug_email = "";
$eplug_description = PAGEEAR_A10;
$eplug_compatible = "e107 v7+";
$eplug_readme = "admin_readme.php"; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = false;
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "pageear";
// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/pageear_32.png";
$eplug_icon_small = $eplug_folder . "/images/pageear_16.png";
$eplug_caption = "Page Ear";
// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
    "pageear_large" => "large.jpg",
    "pageear_small" => "small.jpg",
    "pageear_link" => "http://www.keal.me.uk",
    "pageear_simplemode" => 1,
    "pageear_showpages" => "",
    "pageear_show" => 0,
    "pageear_class" => 0,
    "PAGEEAR_Active"=>1,
    "pageear_dateform"=>"d-m-Y"
	);
// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("pageear_clickthru");
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array(
"
create table ".MPREFIX."pageear_clickthru (
pageear_clickthru_id int (10) UNSIGNED NOT NULL AUTO_INCREMENT ,
pageear_clickthru_name varchar (50) ,
pageear_clickthru_large varchar (50) ,
pageear_clickthru_small varchar (50) ,
pageear_clickthru_client varchar (100) ,
pageear_clickthru_active tinyint (3) UNSIGNED NOT NULL DEFAULT '0',
pageear_clickthru_shows int (10) UNSIGNED NOT NULL DEFAULT '0',
pageear_clickthru_clicks int (10) UNSIGNED NOT NULL DEFAULT '0',
pageear_clickthru_purchased int (10) UNSIGNED NOT NULL DEFAULT '0',
pageear_clickthru_purchasedate int (10) UNSIGNED NOT NULL DEFAULT '0',
pageear_clickthru_expires int (10) UNSIGNED NOT NULL DEFAULT '0',
pageear_clickthru_link varchar (100) ,
pageear_clickthru_ips text ,
PRIMARY KEY  (pageear_clickthru_id)
  ) TYPE=MyISAM;");
// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = false;
$eplug_link_name = "";
$eplug_link_url = "";
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = PAGEEAR_A11;
// upgrading ... //
$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$upgrade_alter_tables = "";
$eplug_upgrade_done = "";

?>

