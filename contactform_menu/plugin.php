<?php
/*
+---------------------------------------------------------------+
| Contact Form by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/contactform_menu/plugin.php,v $
| $Revision: 1.10.2.10 $
| $Date: 2007/07/31 22:19:25 $
| $Author: Neil $
+---------------------------------------------------------------+
*/

if (file_exists(e_PLUGIN."contactform_menu/languages/".e_LANGUAGE.".php")){
   require_once(e_PLUGIN."contactform_menu/languages/".e_LANGUAGE.".php");
} else {
   require_once(e_PLUGIN."contactform_menu/languages/English.php");
}
require_once(e_PLUGIN."contactform_menu/contactform_constants.php");

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name          = CONTACTFORM_NAME;
$eplug_version       = CONTACTFORM_VER;
$eplug_author        = "bugrain";
$eplug_folder        = "contactform_menu";
$eplug_logo          = $eplug_folder."images/icon_32.png";
$eplug_url           = "http://www.bugrain.plus.com";
$eplug_email         = "e107plugins@bugrain.plus.com";
$eplug_description   = CONTACTFORM_DESC;
$eplug_compatible    = "e107v0.7+";
$eplug_readme        = "admin_readme.php";
$eplug_compliant     = TRUE;

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name     = "contactform_menu";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile      = "admin_emails.php";  // use admin_ for all admin files.

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon          = $eplug_folder."/images/icon_32.png";
$eplug_icon_small    = $eplug_folder."/images/icon_16.png";
$eplug_caption       = "Configure Contact Form";

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
   "contactform_mandatory_symbol"      => "*",
   "contactform_mandatory_color"       => "FF0000",
   "contactform_send_to_as_colums"     => "N",
   "contactform_visibility"            => "0",
   "contactform_confirmation_message"  => CONTACTFORM_11,
   "contactform_subject_prefix"        => "",
   "contactform_custom_1"              => "",
   "contactform_custom_2"              => "",
   "contactform_custom_3"              => "",
   "contactform_custom_4"              => "",
   "contactform_htmlarea"              => "",
   "contactform_contact_details"       => "0",
   "contactform_debug"                 => "",
   "contactform_image_code_verify"     => "",
   "contactform_track_ip"              => "",
   "contactform_default_from_email"    => CONTACTFORM_32,
   "contactform_default_from_name"     => CONTACTFORM_33,
);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN.$eplug_folder."/{$eplug_folder}_sql.php");
preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
$eplug_table_names   = $matches[1];

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = explode(";", str_replace("CREATE TABLE ", "CREATE TABLE ".MPREFIX, $eplug_sql));
for ($i=0; $i<count($eplug_tables); $i++) {
   $eplug_tables[$i] .= ";";
}
array_pop($eplug_tables); // Get rid of last (empty) entry

// Extra SQL (executed after tables are created) ---------------------------------------------------------------------
$eplug_tables[] = "INSERT INTO ".MPREFIX."contactform VALUES (1, '1', '1', '".SITEADMIN."','".SITEADMINEMAIL."', '".SITEADMIN."', 'Administrator');";
$eplug_tables[] = "INSERT INTO ".MPREFIX."contactform_pages VALUES (1, '".CONTACTFORM_30."', '', '0', '".CONTACTFORM_31."');";
;

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link             = TRUE;
$eplug_link_name        = CONTACTFORM_NAME;
$eplug_link_url         = e_PLUGIN.$eplug_folder."/contactform.php";

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done             = "Installation Successful...";

// upgrading ...
$upgrade_add_prefs      = array (
   "contactform_image_code_verify"     => "",
   "contactform_track_ip"              => "",
   "contactform_default_from_email"    => CONTACTFORM_32,
   "contactform_default_from_name"     => CONTACTFORM_33,
);
$upgrade_remove_prefs   = array(
   "contactform_page_title",
   "contactform_sender_name",
   "contactform_sender_email",
   "contactform_subject",
   "contactform_message",
   "contactform_cc",
);
$upgrade_alter_tables   = array(
   "ALTER TABLE ".MPREFIX."contactform ADD page_id varchar(255) NOT NULL default '1' AFTER display_order",
   "ALTER TABLE ".MPREFIX."contactform CHANGE email email text NOT NULL",
   "CREATE TABLE ".MPREFIX."contactform_pages (
     cf_page_id int(11) NOT NULL auto_increment,
     cf_page_name varchar(255) NOT NULL default '',
     cf_page_query varchar(255) NOT NULL default '',
     cf_page_userclass int(11) NOT NULL default '0',
     cf_page_description text NOT NULL,
     cf_page_sender_name char(1) NOT NULL default '2',
     cf_page_sender_email char(1) NOT NULL default '2',
     cf_page_subject char(1) NOT NULL default '2',
     cf_page_message char(1) NOT NULL default '1',
     cf_page_cc char(1) NOT NULL default '1',
     cf_page_custom text NOT NULL,
     PRIMARY KEY  (cf_page_id)
   ) TYPE=MyISAM;",
   "INSERT INTO ".MPREFIX."contactform_pages VALUES (1, '".CONTACTFORM_30."', '', '0', '".CONTACTFORM_31."');"
);
$eplug_upgrade_done     = "Upgrade successful...";
?>