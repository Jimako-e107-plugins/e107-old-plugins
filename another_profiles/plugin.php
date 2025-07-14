<?php
/*
+---------------------------------------------------------------+
| Another Profiles Plugin v0.9.6.5
| Copyright © 2008 Istvan Csonka
| http://freedigital.hu
| support@freedigital.hu
|
|        For the e107 website system
|        ©Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
| (The original program is Alternate Profiles v2.0
| boreded.co.uk)
|
| Another Profiles Plugin comes with
| ABSOLUTELY NO WARRANTY
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
$lan_file = e_PLUGIN."another_profiles/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."another_profiles/languages/English.php");

// Plugin info
$eplug_name = "Another Profiles";
$eplug_version = "1.0.0";
$eplug_author = "Super - Ampi";
$eplug_logo = "images/logo.jpg";
$eplug_url = "http://freedigital.hu";
$eplug_email = "support@freedigital.hu";
$eplug_description = AP_ADMIN_1;
$eplug_compatible = "e107v0.7.11 ... e107v1.0.4";
$eplug_readme = "";

// Name of the plugin's folder
$eplug_folder = "another_profiles";

// Mane of menu item for plugin
$eplug_menu_name = "anotherprofiles_menu";
$eplug_menu_name = "another_lastcomments_menu";

// Name of the admin configuration file
$eplug_conffile = "admin_menu.php";

// Icon image and caption text
$eplug_icon = $eplug_folder."/images/logo.jpg";
$eplug_icon_small = $eplug_folder."/images/logo_small.jpg";
// Configure your plugin
$eplug_caption =  PLUGIN_PROFILE_2;

// List of preferences
$eplug_prefs = array(
	"profile_apcomments" => '5',
	"profile_frcol" => '4',
	"profile_allowguests" => '253',
	"profile_maxuploadsize" => '10000',
	"profile_avatarwidth" => '64',
	"profile_avatarheight" => '',
	"profile_indmaxuploadsize" => '2000',
	"profile_maxnovids" => '6',
	"profile_friends" => 'ON',
	"profile_pics" => 'ON',
	"profile_videos" => 'ON',
	"profile_commentson" => 'ON',
	"profile_stats" => 'OFF',
	"profile_buttontype" => 'No',
	"profile_redirect" => 'No',
	"profile_mp3enabled" => 'ON',
	"profile_mp3" => 'Both',
	"profile_mp3size" => '8000',
	"profile_picviewsize" => '600',
	"profile_lightbox" => 'No',
	"profile_lightwindowbox" => 'No',
	"profile_lightview" => 'No',
	"profile_clearbox" => 'No',
	"profile_memberlist" => 'No',
	"profile_maxpcomment" => '100',
	"profile_maxpiccomment" => '50',
	"profile_maxvidcomment" => '50',
	"profile_maxalbumnumber" => '6',
	"profile_maxpicnumber" => '20',
	"profile_kepekezet" => 'No',
	"profile_redirect_usersettings" => 'Yes',
	"profile_user_image" => '100',
	"profile_imagewidth" => '200',
	"profile_imageheight" => '',
	"profile_unreg" => 'No',
	"profile_fr_req_sendpm" => 'No',
	"profile_fr_req_sendemail" => 'No',
	"profile_unreg_save" => 'No',
	"profile_user_warn_support" => 'No',
	"profile_imagick_support" => 'No' ,
	"profile_member_info" => 'No',
	"profile_fr_req_sendemail_all" => '0',
	"profile_fr_req_sendpm_all" => '0',
	"profile_comments_spy_num" => '50',
	"profile_comments_spy" => '254',
	"profile_comments_spy_pic_size" => '145',
	"profile_memberlist_order" => 'ASC',
	"profile_memberlist_direction" => 'user_name',
	"profile_memberlist_accept" => '253',
	"profile_memberlist_forum_info" => 'ON',
	"profile_memberlist_comment_1_info" => 'ON',
	"profile_memberlist_comment_info" => 'ON',
	"profile_memberlist_pic_info" => 'ON',
	"profile_memberlist_vid_info" => 'ON',
	"profile_memberlist_mp3_info" => 'ON',
	"profile_memberlist_column_avatar" => 'ON',
	"profile_memberlist_column_online" => 'ON',
	"profile_memberlist_column_email" => 'ON',
	"profile_memberlist_column_join" => 'ON',
	"profile_memberlist_column_lastvisit" => 'ON',
	"profile_memberlist_column_visits" => 'ON',
	"profile_memberlist_filter" => '0',
	"profile_memberlist_column_realname" => 'OFF',
	"profile_memberlist_column_loginname" => 'OFF',
	"profile_memberlist_column_timezone" => 'OFF',
	"profile_memberlist_column_userip" => 'OFF',
	"profile_member_ext_search" => 'No',
	"profile_memberlist_color_up" => '',
	"profile_memberlist_color_down" => '',
	"profile_memberlist_class" => '',
	"profile_mp3_autoplay" => 'No',
	"profile_mp3_loop" => 'No',
	"profile_mp3_volume" => '160',
	"profile_top" => 'No',
	"profile_top_class" => '254',
	"profile_top_x" => '20',
	"profile_top_level" => 'No',
	"profile_top_forums" => 'No',
	"profile_top_comments" => 'No',
	"profile_top_chatbox" => 'No',
	"profile_top_rate" => 'No',
	"profile_top_profile" => 'No',
	"profile_top_friends" => 'No',
	"profile_top_noadmin" => 'Yes',
	"profile_memberlist_bcard" => 'line',
	"profile_bcard_column" => '3',
	"profile_top_bcard_column" => '1',
	"profile_bcard_css" => 'auto',
	"profile_updateddirection" => 'v',
	"profile_updatedtotal" => '3',
	"profile_updatedtotal_col" => '4',
	"profile_lastupdate_filter" => '253',
	"profile_piccol" => '3',
	"profile_memberlist_addtofriend" => 'No',
	"profile_private_albums" => 'No',
	"profile_videowidth" => '400',
	"profile_youtube" => 'ON',
	"profile_vimeo" => 'ON',
	"profile_metacafe" => 'ON',
	"profile_indavideo" => 'ON'
);

if ($pref['plug_installed']['another_profiles'] != '0.9.4' || $pref['plug_installed']['another_profiles'] != '0.9.5' || $pref['plug_installed']['another_profiles'] != '0.9.6' || $pref['plug_installed']['another_profiles'] != '0.9.6.1' || $pref['plug_installed']['another_profiles'] != '0.9.6.2'|| $pref['plug_installed']['another_profiles'] != '0.9.6.3' || $pref['plug_installed']['another_profiles'] != '0.9.6.4'|| $pref['plug_installed']['another_profiles'] != '1.0.0') {
	$upgrade_add_prefs = array (
	"profile_videowidth" => '400',
	"profile_youtube" => 'ON',
	"profile_vimeo" => 'ON',
	"profile_metacafe" => 'ON',
	"profile_indavideo" => 'ON'
	);
}

// List of table names
$eplug_table_names = array("another_profiles", "another_profiles_memberlist", "another_profiles_com", "another_profiles_vids");

// List of sql requests to create tables
$timestamp = time();

$eplug_tables = array("
CREATE TABLE `".MPREFIX."another_profiles` (
  `user_id` int(5) NOT NULL default '0',
  `user_custompage` text NOT NULL,
  `user_background` varchar(255) NOT NULL default '',
  `user_friends` text NOT NULL,
  `user_friends_request` text NOT NULL,
  `user_settings` varchar(50) NOT NULL default '',
  `user_simple` int(1) NOT NULL default '1',
  `user_lastviewed` text NOT NULL,
  `user_totalviews` int(10) NOT NULL default '0',
  `user_lastupdated` int(11) NOT NULL default '0',
  `user_mp3` text NOT NULL,
  PRIMARY KEY  (`user_id`)
);","
CREATE TABLE `".MPREFIX."another_profiles_memberlist` (
  `memberlist_id` int(5) NOT NULL default '0',
  `memberlist_search` varchar(200) NOT NULL default '',
  `memberlist_columns` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`memberlist_id`)
);","
INSERT INTO `".MPREFIX."another_profiles_memberlist` VALUES (
   '', '|username|email|',''
);","
CREATE TABLE `".MPREFIX."another_profiles_com` (
  `com_id` int(10) NOT NULL auto_increment,
  `com_by` int(10) NOT NULL default '0',
  `com_to` int(10) NOT NULL default '0',
  `com_message` text NOT NULL,
  `com_date` varchar(55) NOT NULL default '',
  `com_type` varchar(4) NOT NULL default '',
  `com_extra` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`com_id`)
);","
CREATE TABLE `".MPREFIX."another_profiles_vids` (
  `vid_id` int(10) NOT NULL auto_increment,
  `vid_uid` int(10) NOT NULL default '0',
  `vid_name` varchar(30) NOT NULL default '',
  `vid_desc` varchar(255) NOT NULL default '',
  `vid_embed` text NOT NULL,
  `vid_added` varchar(55) NOT NULL default '',
  PRIMARY KEY  (`vid_id`)
);");

// Create a link in main menu (yes=TRUE, no=FALSE)
$eplug_link = FALSE;

// Text to display after plugin successfully installed
// Installation Successful...
$eplug_done = PLUGIN_PROFILE_3;

//Install
if(!function_exists("another_profiles_install")) {
    function another_profiles_install() {
	$trash_file = e_PLUGIN."another_profiles/usersettings_0.7.";
	unlink($trash_file."11.php");
	unlink($trash_file."12.php");
	unlink($trash_file."13.php");
	unlink($trash_file."14.php");
	unlink($trash_file."15.php");
	unlink($trash_file."16.php");
	unlink($trash_file."17.php");
	unlink($trash_file."18.php");
	unlink($trash_file."19.php");
	unlink($trash_file."20.php");
	unlink($trash_file."21.php");
	unlink($trash_file."22.php");
	unlink($trash_file."23.php");
	unlink($trash_file."24.php");
	unlink($trash_file."25.php");
	unlink($trash_file."26.php");
	unlink(e_PLUGIN."another_profiles/usersettings_1.0.0.php");
	unlink(e_PLUGIN."another_profiles/usersettings_1.0.1.php");
	unlink(e_PLUGIN."another_profiles/usersettings_1.0.2.php");
	unlink(e_PLUGIN."another_profiles/usersettings_1.0.3.php");
	unlink(e_PLUGIN."another_profiles/usersettings_1.0.4.php");
	unlink(e_PLUGIN."another_profiles/usersettings_2.0.0_(git).php");
	unlink(e_PLUGIN."another_profiles/usersettings_2.1.2_(git).php");
	unlink(e_PLUGIN."another_profiles/usersettings_2.1.3_(git).php");
	unlink(e_PLUGIN."another_profiles/usersettings_2.1.4_(git).php");
	unlink(e_PLUGIN."another_profiles/usersettings_2.1.5_(git).php");
	unlink(e_PLUGIN."another_profiles/usersettings_2.1.6_(git).php");
	unlink(e_PLUGIN."another_profiles/useredit_0.8.0.php");
	unlink(e_PLUGIN."another_profiles/usersettings_0.8.0.php");
    }
}

//Upgrade
if(!function_exists("another_profiles_upgrade")) {
    function another_profiles_upgrade() {
	$trash_file = e_PLUGIN."another_profiles/usersettings_0.7.";
	unlink($trash_file."11.php");
	unlink($trash_file."12.php");
	unlink($trash_file."13.php");
	unlink($trash_file."14.php");
	unlink($trash_file."15.php");
	unlink($trash_file."16.php");
	unlink($trash_file."17.php");
	unlink($trash_file."18.php");
	unlink($trash_file."19.php");
	unlink($trash_file."20.php");
	unlink($trash_file."21.php");
	unlink($trash_file."22.php");
	unlink($trash_file."23.php");
	unlink($trash_file."24.php");
	unlink($trash_file."25.php");
	unlink($trash_file."26.php");
	unlink(e_PLUGIN."another_profiles/usersettings_1.0.0.php");
	unlink(e_PLUGIN."another_profiles/usersettings_1.0.1.php");
	unlink(e_PLUGIN."another_profiles/usersettings_1.0.2.php");
	unlink(e_PLUGIN."another_profiles/usersettings_1.0.3.php");
	unlink(e_PLUGIN."another_profiles/usersettings_1.0.4.php");
	unlink(e_PLUGIN."another_profiles/usersettings_2.0.0_(git).php");
	unlink(e_PLUGIN."another_profiles/usersettings_2.1.2_(git).php");
	unlink(e_PLUGIN."another_profiles/usersettings_2.1.3_(git).php");
	unlink(e_PLUGIN."another_profiles/usersettings_2.1.4_(git).php");
	unlink(e_PLUGIN."another_profiles/usersettings_2.1.5_(git).php");
	unlink(e_PLUGIN."another_profiles/usersettings_2.1.6_(git).php");
	unlink(e_PLUGIN."another_profiles/useredit_0.8.0.php");
	unlink(e_PLUGIN."another_profiles/usersettings_0.8.0.php");
    }
}

// Text to display after plugin successfully upgraded
// Upgrade successful...
$eplug_upgrade_done = PLUGIN_PROFILE_4;

// UnInstall
if(!function_exists("another_profiles_uninstall")) {
	function another_profiles_uninstall() {
		global $sql;
		$sql->db_Delete("menus", "menu_name = 'anotherprofiles_menu'");
		$sql->db_Delete("menus", "menu_name = 'another_lastcomments_menu'");
		$sql->db_Delete("menus", "menu_name = 'lastupdatedprofiles_menu'");
	}
}

?>