<?php
/*
+---------------------------------------------------------------+
|	For e107 website system
|	Slideshow plugin
|	© nlstart
+---------------------------------------------------------------+
*/
// Plugin info --------------------------------------------------
$eplug_name = "Slideshow";
$eplug_version = "2.1";
$eplug_author = "nlstart";
$eplug_logo = "images/logo_32.png";
$eplug_url = "http://e107.webstartinternet.com";
$eplug_email = "nlstart@webstartinternet.com";
$eplug_description = "Slideshow menus";
$eplug_compatible = "e107v7+";
$eplug_readme = "readme.txt";

// XHTML compliant ----------------------------------------------
$eplug_compliant = TRUE;

// Status and latest menu ---------------------------------------
$eplug_status = FALSE;
$eplug_latest = FALSE;

// Name of the plugin's folder ----------------------------------
$eplug_folder = "slideshow";

// Name of menu item for plugin ---------------------------------
$eplug_menu_name = "Slideshow";

// Name of the admin configuration file -------------------------
$eplug_conffile = "admin_slideshow.php";

// Icon image and caption text ----------------------------------
$eplug_icon = $eplug_folder."/images/logo_32.png";
$eplug_icon_small = $eplug_folder."/images/logo_16.png";
$eplug_caption =  "Slideshow Menu's";

// List of preferences ------------------------------------------
$eplug_prefs = array(
	"slideshow_news_title"   => 'Latest news',
	"slideshow_download_title"   => 'Latest downloads',
	"slideshow_shows" => 4,
	"slideshow_summary" => 100,
	"slideshow_delay" => 5000
);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN."{$eplug_folder}/{$eplug_folder}_sql.php");
preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
$eplug_table_names   = $matches[1];

// List of sql requests to create tables -----------------------------------------------------------------------------
// Apply create instructions for every table you defined in locator_sql.php --------------------------------------
// MPREFIX must be used because database prefix can be customized instead of default e107_
$eplug_tables = explode(";", str_replace("CREATE TABLE ", "CREATE TABLE ".MPREFIX, $eplug_sql));
for ($i=0; $i<count($eplug_tables); $i++) {
   $eplug_tables[$i] .= ";";
}
array_pop($eplug_tables); // Get rid of last (empty) entry

// Create a link in main menu (yes=TRUE, no=FALSE) ---------------
$eplug_link = FALSE;
$eplug_link_name = "";
$eplug_link_url = "";

// Create a userclass  -------------------------------------------
$eplug_userclass = "";
$eplug_userclass_description = "";

// Text to display after plugin successfully installed -----------
$eplug_done = $eplug_name." is successfully installed.";

// upgrading ... 
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = array(
"CREATE TABLE ".MPREFIX."slideshow (slideshow_id int(10) unsigned NOT NULL auto_increment, slideshow_name varchar(100) NOT NULL default '', slideshow_url varchar(150) NOT NULL default '', slideshow_description text NOT NULL, slideshow_active tinyint(3) unsigned NOT NULL default '0', slideshow_datestamp int(10) unsigned NOT NULL default '0', slideshow_thumb varchar(150) NOT NULL default '', slideshow_image varchar(150) NOT NULL default '', slideshow_visible varchar(255) NOT NULL default '0', PRIMARY KEY (slideshow_id), KEY slideshow_datestamp (slideshow_datestamp) ) ENGINE=MyISAM;"
);

if ( ! function_exists('slideshow_upgrade') ) 
{  // The above line prevents the plugin from being declared twice
	function slideshow_upgrade() 
	{ // This function is executed by the e107 Plugin Manager before any upgrading action
		if (!file_exists(e_IMAGE.'slideshowimages/'))
		{	// Create folder for slideshow images 
			mkdir(e_IMAGE."slideshowimages");
		}
		if (!file_exists(e_IMAGE.'slideshowthumbs/'))
		{	// Create folder for slideshow thumbnail images 
			mkdir(e_IMAGE."slideshowthumbs");
		}
		if (!file_exists(e_IMAGE.'slideshowimages/index.html'))
		{	// Create empty index file for slideshowimages folder to protect from unauthorized viewing
			file_put_contents (e_IMAGE."slideshowimages/index.html", "");
		}
		if (!file_exists(e_IMAGE.'slideshowthumbs/index.html'))
		{	// Create empty index file for slideshowthumbs folder to protect from unauthorized viewing
			file_put_contents (e_IMAGE."slideshowthumbs/index.html", "");
		}
	} 
	function slideshow_install() 
	{ // This function is executed by the e107 Plugin Manager before any install action
		slideshow_upgrade();
	}
}

$eplug_upgrade_done = "Upgrading ".$eplug_name." to ".$eplug_version." is successfully done.";
?>