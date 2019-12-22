<?php
/*
################################################################
#
#	CHATBOX II
#
#		Billy Smith
#		http://www.vitalogix.com
#		chicks_hate_me@hotmail.com
#
#	Designed for use with the e107 website system.
#		http://e107.org
#
#	Released under the terms and conditions of the GNU GPL.
#		GNU General Public License (http://gnu.org)
#
#	Leave Acknowledgements in ALL Distributions and derivatives.
#
################################################################
*/

if (!defined('e107_INIT')) { exit; }

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Chatbox II";
$eplug_version = "1.5.1";
$eplug_author = "BillySmith";
$eplug_url = "http://www.vitalogix.com";
$eplug_email = "chicks_hate_me@hotmail.com";
$eplug_description = "Chatbox II - Chatbox and Chat Page, dynamically updated. IMPORTANT: READ the _readme.txt file before installation.";
$eplug_compatible = "e107v0.7+";
$eplug_readme = "admin_readme.php";
$eplug_status = TRUE;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "chatbox2";

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "chatbox2";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_general.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/chatbox2_32.png";
$eplug_icon_small = $eplug_folder."/images/chatbox2_16.png";

$eplug_caption = LAN_CONFIGURE; // e107 generic term.

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
  'cb2_sound_activate' => '0',
  'cb2_sound_source' => '',
  'cb2_sound_volume' => '50',
  'cb2_multipost' => '1',
  'cb2_whitespace' => '0',
  'cb2_allow_dups' => '0',
  'cb2_dup_timer' => '300',
  'cb2_enable_user_deletes' => '0',
  'cb2_enable_muting' => '0',
  'cb2_show_bullet' => '0',
  'cb2_emote' => '1',
  'cb2_user_font_color_activate' => '0',
  'cb2_initial_posts' => '25',
  'cb2_layer' => '3',
  'cb2_layer_height' => '350',
  'cb2_refresh' => '10',
  'cb2_refresh_submit' => '3',
  'cb2_show_date' => '0',
  'cb2_custom_look' => '0',
  'cb2_border_size' => '1',
  'cb2_border_color' => '660066',
  'cb2_bg_color' => 'F0F0A2',
  'cb2_name_font_color' => 'FF00FF',
  'cb2_date_font_color' => '880088',
  'cb2_msg_font_color' => '0000FF',
  'cp2_initial_posts' => '50',
  'cp2_layer' => '3',
  'cp2_layer_height' => '500',
  'cp2_refresh' => '10',
  'cp2_refresh_submit' => '3',
  'cp2_ul_top' => '1',
  'cp2_show_date' => '1',
  'cp2_custom_look' => '0',
  'cp2_border_size' => '1',
  'cp2_border_color' => '7300FF',
  'cp2_bg_color' => 'B4E1EC',
  'cp2_name_font_color' => '6ADA86',
  'cp2_date_font_color' => 'CECE00',
  'cp2_msg_font_color' => 'DD004D',
  'cb2_mod_class' => e_UC_ADMIN,
  'cb2_view_class' => e_UC_PUBLIC,
  'cb2_post_class' => e_UC_MEMBER,
  'cb2_mute_class' => 'Muted',
  'cb2_gold_enable' => '0',
  'cb2_gold_name_height' => '10'
);


// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array(
	"chatbox2"
);

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array(
	"CREATE TABLE ".MPREFIX."chatbox2 (
	cb2_id int(10) unsigned NOT NULL auto_increment,
	cb2_nick varchar(30) NOT NULL default '',
	cb2_message text NOT NULL,
	cb2_color varchar(6) NOT NULL default '',
	cb2_datestamp int(10) unsigned NOT NULL default '0',
	cb2_blocked tinyint(3) unsigned NOT NULL default '0',
	cb2_ip varchar(15) NOT NULL default '',
	PRIMARY KEY  (cb2_id)
	) TYPE=MyISAM;"
);

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = FALSE;
$eplug_link_name = '';
$eplug_link_url = '';


// upgrading ... //
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";


if (!function_exists('chatbox2_uninstall')) {
	function chatbox2_uninstall() {
		global $sql;
		$sql -> db_Update("user", "user_chats='0'");
	}
}

if (!function_exists('chatbox2_install')) {
	function chatbox2_install() {
		global $sql;
		$sql -> db_Update("user", "user_chats='0'");
	}
}

?>
