<?php
/*
+---------------------------------------------------------------+
|        Inbox Email - v 2 by Mohamed Anouar Achoukhy
|        only for e107 website system
|        http://e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

include_lan(e_PLUGIN.'contact/languages/'.e_LANGUAGE.'.php');

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = LAN_CONTACT_4;
$eplug_version = "2";
$eplug_author = "Mohamed Anouar Achoukhy";
//$eplug_logo = "button.png";
$eplug_url = "";
$eplug_email = "support@naja7host.com";
$eplug_description = LAN_CONTACT_0;
$eplug_compatible = "v1.0+";
$eplug_readme = "";
$eplug_compliant = TRUE;
//$eplug_status = TRUE;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "contact";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "contact_menu";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";  // use admin_ for all admin files.

// Icon image and caption text ------------------------------------
$eplug_icon = $eplug_folder."/images/contact_32.png";
$eplug_icon_small = $eplug_folder."/images/contact_16.png";
$eplug_caption =  LAN_CONTACT_1;

// List of preferences ---------------------------------------
$eplug_prefs = array(
"contact_plugin_enable"  =>  true,
); // this stores a default value in the preferences.

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("contact");

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array("
CREATE TABLE ".MPREFIX."contact (
  contact_id int(10) unsigned NOT NULL auto_increment,
  contact_body text NOT NULL,
  contact_author_name varchar(100) NOT NULL default '',
  contact_email_send varchar(100) NOT NULL default '',
  contact_time varchar(16) NOT NULL default '',
  contact_subject varchar(100) NOT NULL default '',
  contact_mod tinyint(1) NOT NULL default '0',
  PRIMARY KEY (contact_id)
) ENGINE=MyISAM;",

);

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = LAN_CONTACT_2;

// upgrading ... //
if(!function_exists("contact_upgrade"))
{
	
	function contact_upgrade()
	{
		$upgrade_add_prefs = array(
		'contact_plugin_enable'  =>  true,
		'contact_version' => $eplug_version 
		);	
	}
}
if (($pref['plug_installed']['contact'])  == "2") {
	$upgrade_add_prefs = array(
	'contact_plugin_enable'  =>  true,
	'contact_version' => $eplug_version 
	);		
	$eplug_upgrade_done = LAN_CONTACT_3 . $eplug_version;
}
		
// $eplug_upgrade_done = LAN_CONTACT_3 . $eplug_version;

if(!function_exists("contact_uninstall"))
{
	//Remove prefs entries during uninstall
	function contact_uninstall()
	{
	$upgrade_remove_prefs = array(
		'contact_plugin_enable' ,
		'contact_caption' ,
		'contact_delay',
		'contact_mod',
		'contact_plugin_enable',
	);	
	}
}

?>
