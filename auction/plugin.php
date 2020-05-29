<?php
/*
+---------------------------------------------------------------+
| Auction by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/auction/plugin.php,v $
| $Revision: 1.4 $
| $Date: 2008/06/28 05:56:33 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Plugin info ---------------------------------------------------------------
$eplug_name          = "Auction";
$eplug_version       = "1.1";
$eplug_author        = "bugrain";
$eplug_logo          = $eplug_folder."/images/icon_32.png";
$eplug_url           = "http://www.bugrain.plus.com";
$eplug_email         = "e107plugins@bugrain.plus.com";
$eplug_description   = "Auction plugin for holding online auctions";
$eplug_compatible    = "e107v0.7+";
$eplug_readme        = "readme.php";

// Name of the plugin's folder -----------------------------------------------
$eplug_folder        = "auction";

// Mane of menu item for plugin ----------------------------------------------
$eplug_menu_name     = "";

// Name of the admin configuration file --------------------------------------
$eplug_conffile      = "admin_prefs.php";

// Icon image and caption text -----------------------------------------------
$eplug_icon          = $eplug_folder."/images/icon_32.png";
$eplug_icon_small    = $eplug_folder."/images/icon_16.png";
$eplug_caption       =  "Configure Auction";

// List of preferences -------------------------------------------------------
$eplug_prefs = array(
	"auction_pagetitle"                => "Auction",
	"auction_separator"                => " :: ",
	"auction_view_class"               => 0,
	"auction_emoticons"                => 1,
	"auction_bbcodes"                  => 1,
	"auction_tooltips"                 => 1,
	"auction_global_template"          => "default",
	"auction_auctions_order"           => " order by auction_id asc",
	"auction_auctions_per_page"        => 20,
	"auction_lots_per_page"            => 20,
	"auction_menu_summary_title"       => "Auctions Summary",
	"auction_menu_auction_title"       => "Auction Summary",
	"auction_notify_owner_bid"         => 0,
	"auction_notify_bidder_bid"        => 0,
);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN.$eplug_folder."/auction_sql.php");
preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
$eplug_table_names   = $matches[1];

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = explode(";", str_replace("CREATE TABLE ", "CREATE TABLE ".MPREFIX, $eplug_sql));
for ($i=0; $i<count($eplug_tables); $i++) {
   $eplug_tables[$i] .= ";";
}
array_pop($eplug_tables); // Get rid of last (empty) entry

// Create a link in main menu (yes=TRUE, no=FALSE) ---------------------------
$eplug_link = TRUE;
$eplug_link_name = "Auction";
$eplug_link_url = e_PLUGIN.$eplug_folder."/auction.php";

// Text to display after plugin successfully installed -----------------------
$eplug_done = "Installation of <b>$eplug_name</b> version <b>$eplug_version</b> was successful...";

// ************************************************************************************************
// upgrading ...
// ************************************************************************************************
$upgrade_add_prefs      = array();
$upgrade_remove_prefs   = array();
$upgrade_alter_tables   = array();
$eplug_upgrade_done     = "Upgrade of <b>$eplug_name</b> version <b>$eplug_version</b> was successful...";;

?>