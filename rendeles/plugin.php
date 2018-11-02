<?php

$lan_file = e_PLUGIN . "rendeles/languages/".e_LANGUAGE.".php";
if (file_exists($lan_file)) require_once($lan_file);
	else require_once(e_PLUGIN . "rendeles/languages/Hungarian.php");

$eplug_name = "Rendelés";
$eplug_version = "1.0";
$eplug_author = "JoniPeti & Schwarz";
$eplug_logo = "button.png";
$eplug_url = "http://www.jonasportalstudio.hu/";
$eplug_email = "info@jonasportalstudio.hu";
$eplug_description = "Virág rendelő plugin. <br /><br />
<div style='float: right'>
  <a rel='license' href='http://creativecommons.org/licenses/by-nc-sa/2.5/hu/'>
    <img alt='Creative Commons Licenc' style='border-width:0' src='http://i.creativecommons.org/l/by-nc-sa/2.5/hu/88x31.png' />
  </a>
</div>
<div style='text-align: cxenter'>
Ez a Mű a <br />
<a rel='license' href='http://creativecommons.org/licenses/by-nc-sa/2.5/hu/'>Creative Commons <br /> Nevezd meg! - Ne add el! - Így add tovább! <br /> 2.5 Magyarország Licenc feltételeinek megfelelően szabadon felhasználható</a>.
</div>";
$eplug_compatible = "e107 v1.0.0";
$eplug_readme = "readme.txt";
$eplug_compliant = false;
$eplug_status = false;
$eplug_latest = false;

$eplug_folder = "rendeles";
$eplug_conffile = "admin_config.php";
$eplug_icon = $eplug_folder."/images/icon_32.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";
$eplug_caption = "Beállítás";

// ide jöhetnek a $pref[] változók alapértékei
$eplug_prefs = array(
	"rendeles_perpage" => 30,
	"rendeles_currency" => ".-Ft"
	);

$eplug_table_names = array("rendeles", "rendeles_rendflowers", "rendeles_customer", "rendeles_type", "rendeles_flower", "rendeles_color", "rendeles_banner", "rendeles_location");

$eplug_tables = array("CREATE TABLE " . MPREFIX . "rendeles (
	rendeles_id int(10) unsigned PRIMARY KEY NOT NULL auto_increment,
	rendeles_date_a int(10) NOT NULL DEFAULT '0',
	rendeles_date_b int(10) NOT NULL DEFAULT '0',
	rendeles_customerid int(10) NOT NULL DEFAULT '0',
	rendeles_typeid int(10) NOT NULL DEFAULT '0',
	rendeles_bannerid int(10) NOT NULL DEFAULT '0',
	rendeles_paid int(10) NOT NULL DEFAULT '0',
	rendeles_completed int(10) NOT NULL DEFAULT '0',
	rendeles_bannerscompleted int(10) NOT NULL DEFAULT '0',
	rendeles_comment text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL default '',
	rendeles_location text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL default ''
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;",

    "CREATE TABLE " . MPREFIX . "rendeles_rendflowers (
	rendeles_rendflowers_id int(10) unsigned PRIMARY KEY NOT NULL auto_increment,
	rendeles_rendflowers_rendelesid int(10) NOT NULL DEFAULT '0',
	rendeles_rendflowers_flowerid int(10) NOT NULL DEFAULT '0',
	rendeles_rendflowers_colorid int(10) NOT NULL DEFAULT '0',
	rendeles_rendflowers_darab int(10) NOT NULL DEFAULT '0'
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;",

    "CREATE TABLE " . MPREFIX . "rendeles_customer (
	rendeles_customer_id int(10) unsigned PRIMARY KEY NOT NULL auto_increment,
	rendeles_customer_name varchar(127) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL default '',
	rendeles_customer_email varchar(127) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL default '',
	rendeles_customer_address varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL default ''
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;",

    "CREATE TABLE " . MPREFIX . "rendeles_type (
	rendeles_type_id int(10) unsigned PRIMARY KEY NOT NULL auto_increment,
	rendeles_type_name varchar(127) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL default '',
	rendeles_type_price int(10) NOT NULL default '0'
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;",

    "CREATE TABLE " . MPREFIX . "rendeles_flower (
	rendeles_flower_id int(10) unsigned PRIMARY KEY NOT NULL auto_increment,
	rendeles_flower_name varchar(127) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL default '',
	rendeles_flower_size varchar(127) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL default '',
	rendeles_flower_price int(10) NOT NULL default '0'
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;",

    "CREATE TABLE " . MPREFIX . "rendeles_color (
	rendeles_color_id int(10) unsigned PRIMARY KEY NOT NULL auto_increment,
	rendeles_color_name varchar(127) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL default '',
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;",

    "CREATE TABLE " . MPREFIX . "rendeles_banner (
	rendeles_banner_id int(10) unsigned PRIMARY KEY NOT NULL auto_increment,
	rendeles_banner_banners varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL default '',
	rendeles_banner_price int(10) NOT NULL default '0'
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;"
);

// link létrehozása a főmenüben telepítés után
$eplug_link = true;
$eplug_link_name = "Rendelés";
$eplug_link_url = e_PLUGIN."rendeles/rendeles.php";

$eplug_done = "A telepítés sikeres.";

// verziófrissítés esetén 
$cdsql = new db();
if($cdsql->db_Select("plugin", "plugin_version", "plugin_path='".$eplug_folder."'"))
{
	$cdrow = $cdsql->db_Fetch();
	$cdpluginVersion = $cdrow["plugin_version"];
}
else
{
	$cdpluginVersion = 0;
}

$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$eplug_upgrade_done = "Frissítés sikeres.";

if ($cdpluginVersion == "1.0") {
	$upgrade_alter_tables = array(
	);
}

unset($cdpluginVersion);
unset($cdsql);

?>