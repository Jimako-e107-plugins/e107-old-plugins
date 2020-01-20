<?php
/*
+---------------------------------------------------------------+
|        for e107 website system
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "onlineinfo4_menu/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "onlineinfo4_menu/languages/admin/" . e_LANGUAGE . ".php");
} 
else
{
    include_once(e_PLUGIN . "onlineinfo4_menu/languages/admin/English.php");
} 
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = ONINF4_A1;
$eplug_version = "4.10";
$eplug_author = "Barry (Based on TheMadMonks)";
$eplug_logo = "./images/logo.png";
$eplug_url = "http://www.keal.me.uk";
$eplug_email = "online@keal.me.uk";
$eplug_description = ONINF4_A2;
$eplug_compatible = "e107v6.16";
$eplug_readme = "readme.rtf";        // leave blank if no readme file
$eplug_compliant = TRUE; 

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "onlineinfo4_menu";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "onlineinfo4_menu";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/logo.png";
$eplug_icon_small = $eplug_folder."/images/logo_16.png";
$eplug_caption =  ONINF4_A3;

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
        "onlineinfo_caption"=>"Online Info",
		"onlineinfo_pm"=>"1",
		"onlineinfo_online"=>"1",
		"onlineinfo_coppermine"=>"1",
		"onlineinfo_last"=>"1",
		"onlineinfo_lastnum"=>"5",
		"onlineinfo_guest"=>"1",
		"onlineinfo_downloads"=>"1",
		"onlineinfo_online_plug"=>"Standard",
		"onlineinfo_guestmessage"=>"0",
		"onlineinfo_guest_message"=>"Hello Guest, Want to get rid of this message? And to see more of this site that is locked out to Guests? Like Forums and lots more. So please sign up or sign in if you are already a member.",
		"onlineinfo_guest_bg"=>"#FFFF8A",
		"onlineinfo_guest_displaymode"=>"1",
		"onlineinfo_guest_displaytime"=>"60000",
		"onlineinfo_guest_flash"=>"1",
		"onlineinfo_guest_flashcolour"=>"#FFFFC0",
		"onlineinfo_guest_height"=>"100",
		"onlineinfo_guest_width"=>"500",
		"onlineinfo_show_info"=>"1",
		"onlineinfo_new_icon"=>"1",
		"onlineinfo_new_icontype"=>"new.gif",
		"onlineinfo_avatar"=>"1",
		"onlineinfo_showbdays"=>"1",
		"onlineinfo_nobdays"=>"5",
		"onlineinfo_formatbdays"=>"1",
		"onlineinfo_width"=>"95%",
		"onlineinfo_showforum"=>"1",
		"onlineinfo_forumno"=>"10",
		"onlineinfo_showvisit"=>"1",
		"onlineinfo_visitno"=>"10",
		"onlineinfo_hideforum"=>"1",
		"onlineinfo_hidevisit"=>"1",
		"onlineinfo_hidebdays"=>"1",
		"onlineinfo_hidelast"=>"1",
		"onlineinfo_showicons"=>"1",
		"onlineinfo_showadmin"=>"1",
		"onlineinfo_hidecounter"=>"1",
		"onlineinfo_hideupdates"=>"1",
		"onlineinfo_showcounter"=>"1",
		"onlineinfo_showupdates"=>"1",
		"onlineinfo_order1"=>"avatar.php",
		"onlineinfo_order2"=>"pm.php",
		"onlineinfo_order3"=>"currentlyonline.php",
		"onlineinfo_order4"=>"extrainfo.php",
		"onlineinfo_extraorder1"=>"updated.php",
		"onlineinfo_extraorder2"=>"birthday.php",
		"onlineinfo_extraorder3"=>"counter.php",
		"onlineinfo_extraorder4"=>"toppost.php",
		"onlineinfo_extraorder5"=>"topvisits.php",
		"onlineinfo_extraorder6"=>"lastvisitors.php"
		);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = "";

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = "";

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = FALSE;
$eplug_link_name = "";
$ec_dir = e_PLUGIN."";
$eplug_link_url = "";


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = ONINF4_A4;

// upgrading ... //

$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$upgrade_alter_tables = "";

$eplug_upgrade_done = "";

?>