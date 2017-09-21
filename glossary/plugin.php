<?php
/**
 * Glossary by Shirka (www.shirka.org)
 *
 * A plugin for the e107 Website System (http://e107.org)
 *
 * ©Andre DUCLOS 2006
 * http://www.shirka.org
 * duclos@shirka.org
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/plugin.php,v $
 * $Revision: 1.12 $
 * $Date: 2006/08/30 12:48:50 $
 * $Author: duclos $
 */

if (!defined('e107_INIT')) { exit; }

// Name of the plugin's folder
$eplug_folder					= "glossary";

require_once(e_PLUGIN.$eplug_folder."/glossary_ver.php");

include_lan(e_PLUGIN.$eplug_folder."/languages/".e_LANGUAGE."/Lan_".basename(__FILE__));

// Plugin info
$eplug_name						= "LAN_GLOSSARY_PLUGIN_01";
$eplug_version				= GLOSSARY_VER;
$eplug_author					= "Andre DUCLOS (shirka)";
$eplug_url						= "http://www.shirka.org";
$eplug_email					= "duclos@shirka.org";
$eplug_description		= LAN_GLOSSARY_PLUGIN_02;
$eplug_compatible			= "e107v7+";
$eplug_readme					= "admin_readme.php";
$eplug_compliant			= TRUE;

// Mane of menu item for plugin
$eplug_menu_name			= "glossary_menu";

// Name of the admin configuration file
$eplug_conffile				= "admin_config.php";

// Icon image and caption text
$eplug_icon						= $eplug_folder."/images/icon_32.png";
$eplug_icon_small			= $eplug_folder."/images/icon_16.png";
$eplug_caption				= LAN_GLOSSARY_PLUGIN_03;
$eplug_logo						= $eplug_folder."/images/icon_32.png";

// List of preferences
$eplug_array_pref			= array(
	'tohtml_hook'		=> 'glossary',
);

$eplug_prefs			= array(
	// General Options
	'glossary_linkword'							=> '0',
	'glossary_submit'								=> '0',
	'glossary_submit_class'					=> '255',	// 0:Everybody, 252:Guests(public), 253:Members, 255:No One(inactive)
	'glossary_submit_directpost'		=> '0',
	'glossary_submit_htmlarea'			=> '0',
	'glossary_emailprint'						=> '0',

	// Page Options
	'glossary_page_title'						=> LAN_GLOSSARY_PLUGIN_07,
	'glossary_page_caption_nav'			=> LAN_GLOSSARY_PLUGIN_08,
	'glossary_page_link_submit'			=> '1',
	'glossary_page_link_rendertype'	=> '0',

	// Menu Options
	'glossary_menu_caption'					=> LAN_GLOSSARY_PLUGIN_01,
	'glossary_menu_caption_nav'			=> LAN_GLOSSARY_PLUGIN_08,
	'glossary_menu_link_frontpage'	=> '1',
	'glossary_menu_link_submit'			=> '1',
	'glossary_menu_link_rendertype'	=> '0',
	'glossary_menu_lastword'				=> '1',
	'glossary_menu_number'					=> '1',
);

// List of comment_type ids used by this plugin
// Compatibility with 0.7.5
$eplug_comment_ids		= "";

// List of bbcode
// Compatibility with 0.7.5
$eplug_bb							= "";

// List of Shortcode
// Compatibility with 0.7.5
$eplug_sc							= "";

$eplug_userclass			= "";
$eplug_userclass_description = "";

// Compatibility with 0.705
$eplug_rss						= "";

$eplug_module					= TRUE;
$eplug_status					= TRUE;
$eplug_latest					= TRUE;

// List of table names
$eplug_sql           = file_get_contents(e_PLUGIN.$eplug_folder."/glossary_sql.php");
$ret                 = preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
$eplug_table_names   = $matches[1];

// List of sql requests to create tables
$eplug_tables        = explode(";", str_replace("CREATE TABLE ", "CREATE TABLE ".MPREFIX, $eplug_sql));
for ($i=0; $i<count($eplug_tables); $i++)
{
	$eplug_tables[$i] .= ";";
}

// Get rid of last (empty) entry
array_pop($eplug_tables);

// sample types
// TODO: Use a xml file
global $tp;
array_push($eplug_tables, "INSERT INTO ".MPREFIX."glossary (glo_id, glo_name, glo_description, glo_author, glo_datestamp, glo_approved, glo_linked) VALUES (1, '".$tp->toDB(LAN_GLOSSARY_EXAMPLE_WRD_01)."', '".$tp->toDB(LAN_GLOSSARY_EXAMPLE_DEF_01)."', '".USERID.".".USERNAME."', '".time()."', '1', '0');");
array_push($eplug_tables, "INSERT INTO ".MPREFIX."glossary (glo_id, glo_name, glo_description, glo_author, glo_datestamp, glo_approved, glo_linked) VALUES (2, '".$tp->toDB(LAN_GLOSSARY_EXAMPLE_WRD_02)."', '".$tp->toDB(LAN_GLOSSARY_EXAMPLE_DEF_02)."', '".USERID.".".USERNAME."', '".time()."', '1', '0');");

// RSS for e107 < 0.706
$eplug_rss['glossary'] = array(
	"query"					=> "SELECT * FROM #glossary WHERE glo_approved = '1' ORDER BY glo_datestamp DESC LIMIT 0, 9",
	"author"				=> "",
	"author_email"	=> "",
	"itemid"				=> "glo_id",
	"link"					=> $eplug_folder."/glossaire.php#",
	"title"					=> "glo_name",
	"description"		=> "glo_description",
	"categoryid"		=> "0",
	"categoryname"	=> "",
	"categorylink"	=> "0",
	"datestamp"			=> "glo_datestamp",
	"enc_url"				=> "0",
	"enc_leng"			=> "0",
	"enc_type"			=> "0"
);

// Create a link in main menu (yes=TRUE, no=FALSE)
$eplug_link						=	TRUE;
$eplug_link_name			= LAN_GLOSSARY_PLUGIN_04;
$eplug_link_url				= e_PLUGIN.$eplug_folder."/glossaire.php";
$eplug_link_icon			= "";
$eplug_link_perms			= "Everyone"; // Everyone, Guest, Member, Admin 

// Text to display after plugin successfully installed
$eplug_done						= LAN_GLOSSARY_PLUGIN_05;
$eplug_uninstall_done = "";

// Upgrading ...
$upgrade_add_prefs		= "";
$upgrade_remove_prefs	= "";

$upgrade_add_user_prefs = "";
$upgrade_remove_user_prefs;

$upgrade_add_eplug_sc	= "";
$upgrade_remove_eplug_sc = "";

$upgrade_add_eplug_bb = "";
$upgrade_remove_eplug_bb = "";

$upgrade_alter_tables	= "";

$eplug_upgrade_done		= LAN_GLOSSARY_PLUGIN_06.$eplug_version;
/*
if (!function_exists('forum_install'))
{
	function glossary_install()
	{
		global $sql;

		$sql -> db_Update("user", "user_forums='0'");
	}
}

if(!function_exists("glossary_uninstall"))
{
	//Remove prefs and menu entry during uninstall
	function glossary_uninstall()
	{
		global $sql;

		$sql->db_Delete("core", "e107_name = 'glossary_prefs'");
		$sql->db_Delete("menus", "menu_name = 'glossary_menu'");
	}
}

if (!function_exists('forum_upgrade'))
{
	function glossary_upgrade()
	{
		global $sql;

		$sql -> db_Update("user", "user_forums='0'");
	}
}
*/
?>