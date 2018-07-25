<?php
/*
+---------------------------------------------------------------+
|	e_Classifieds Plugin for e107
|
|	Barry
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "e_Classifieds";
$eplug_version = "1.11";
$eplug_author = "Father Barry";

$eplug_url = "http://www.keal.me.uk/";
$eplug_email = "";
$eplug_description = "A basic classified ads plugin";
$eplug_compatible = "e107v7";
$eplug_readme = "readme.pdf"; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = true;
$eplug_latest = true;
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "e_classifieds";
// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/icon_32.png";
$eplug_icon_small = $eplug_folder . "/images/icon_16.png";
$eplug_caption = "Classified Ads Configuration";
// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array("eclassf_email" => "youremail@yourdomain.com",
    "eclassf_approval" => "yes",
    "eclassf_valid" => "14",
    "eclassf_read" => "0",
    "eclassf_admin" => "253",
    "eclassf_useremail" => "1",
    "eclassf_pictype" => "1",
    "eclassf_perpage" => "10",
    "eclassf_create" => "0",
    "eclassf_picw" => "100",
    "eclassf_pich" => "100",
    "eclassf_currency" => "£",
    "eclassf_icons" => "1",
    "eclassf_thumbs" => "1",
    "eclassf_thumbheight" => "50",
    "eclassf_counter" => "text",
    "eclassf_userating" => 1,
    "eclassf_dformat" => "d-m-Y",
    "eclassf_subdrop" => 1,
    "eclassf_metad" => "Father Barry's e_classifieds plugin for the e107 CMS system",
    "eclassf_metak" => "father barry,barry keal,e107 plugin,e107 plugins,bazzer",
    "eclassf_terms" => "Only suitable material will be allowed. Adverts will be checked. This site is not responsible for the goods or services");
// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("eclassf_ads", "eclassf_cats", "eclassf_subcats");
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array("create table " . MPREFIX . "eclassf_ads (
eclassf_cid int auto_increment not null,
eclassf_cname varchar(250),
eclassf_cdesc varchar(250),
eclassf_ccat int(10) unsigned not null default 0,
eclassf_cpic varchar(250),
eclassf_cdetails text NULL,
eclassf_capproved int(10) unsigned not null default 0,
eclassf_cuser varchar(250),
eclassf_cph varchar(250),
eclassf_cemail varchar(250),
eclassf_ccdate int(10) unsigned not null default 0,
eclassf_cpdate int(10) unsigned not null default 0,
eclassf_last int(10) unsigned not null default 0,
eclassf_price varchar(20) null default '0',
eclassf_views int(10) unsigned not null default 0,
eclassf_counter varchar(50) null default '',
primary key(eclassf_cid),
unique id(eclassf_cid)
) TYPE=MyISAM;",
    "create table " . MPREFIX . "eclassf_cats (
eclassf_catid int auto_increment not null,
eclassf_catname varchar(250),
eclassf_catdesc varchar(250),
eclassf_catclass int(10) unsigned not null default '0',
eclassf_caticon varchar(50) null default '',
primary key(eclassf_catid),
unique id(eclassf_catid)
) TYPE=MyISAM;",
    "create table " . MPREFIX . "eclassf_subcats (
eclassf_subid int auto_increment not null,
eclassf_ccatid int(10) unsigned not null default 0,
eclassf_subname varchar(250),
eclassf_subicon varchar(50) null default '',
primary key(eclassf_subid),
unique id(eclassf_subid)
) TYPE=MyISAM;");
// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = true;
$eplug_link_name = "Classifieds";
$eplug_link_url = e_PLUGIN . "e_classifieds/classifieds.php";
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Please add your categories and items";
// upgrading ...
$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$upgrade_alter_tables = "";

$eplug_upgrade_done = "";
if (!function_exists("e_classifieds_uninstall"))
{
    function e_classifieds_uninstall()
    {
        global $sql;
        $sql->db_Delete("rate", "rate_table='classifieds'");
    }
}

?>