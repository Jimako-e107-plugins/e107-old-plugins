<?php
/*
--------------------------------------------------------------------------------

	Title: ClanSystem
	$Author: kamers $
	$Date: 2007-03-21 23:33:09 -0400 (Wed, 21 Mar 2007) $
	Version: 0.1
	$Revision: 7 $
	Description: Complete Clan Management Plugin

--------------------------------------------------------------------------------
*/

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "ClanSystem";
$eplug_version = "0.1";
$eplug_author = "Sherwood McGowan & Shannon Kamer";
$eplug_url = "";
$eplug_email = "";
$eplug_description = "Complete Clan Management Plugin";
$eplug_compatible = "e107v0.7+";
$eplug_readme = "";

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "clansystem";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_index.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = "";
$eplug_icon_small = "";
$eplug_caption = "";

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs =  array();

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("clansystem_member","clansystem_role","clansystem_rank","clansystem_squad",
		"clansystem_squad_roster","clansystem_clan","clansystem_award","clansystem_award_given",
		"clansystem_map","clansystem_map_entry","clansystem_game","clansystem_game_mode",
		"clansystem_join_request","clansystem_join_request_comment","clansystem_challenge",
		"clansystem_challenge_round","clansystem_challenge_stat","clansystem_challenge_stat_type",
		"clansystem_challenge_type","clansystem_member_status");

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array(
"CREATE TABLE " .MPREFIX."clansystem_member (
  member_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  member_join_date DATE NOT NULL,
  member_status_id INTEGER UNSIGNED NULL,
  member_rank_id INTEGER UNSIGNED NULL,
  e107_user_id INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(member_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_role (
  role_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  role_member_admin TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_member_rank TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_member_rank_squad TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_member_kick TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_squads_admin_all TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_admin_own TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_roster_all TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_roster_own TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_join_requests_view TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_join_requests_comment TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_join_requests_decide TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_awards_admin TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_awards_create TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_awards_edit TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_clan_admin TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_clan_admin_own TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_challenge_admin TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_challenge_reject TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_challenge_comment TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_challenge_delete TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_challenge_edit_own TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_games_admin TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  role_game_modes_admin TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  e107_userclass_id INTEGER UNSIGNED NULL,
  PRIMARY KEY(role_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_rank (
  rank_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  rank_name VARCHAR(50) NOT NULL,
  rank_image TEXT NOT NULL,
  rank_order INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(rank_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_squad (
  squad_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  squad_name VARCHAR(50) NOT NULL,
  squad_description TEXT NULL,
  squad_image TEXT NULL,
  PRIMARY KEY(squad_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_squad_roster (
  squad_roster_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  member_id INTEGER UNSIGNED NOT NULL,
  squad_id INTEGER UNSIGNED NOT NULL,
  squad_roster_joindate DATE NOT NULL,
  PRIMARY KEY(squad_roster_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_clan (
  clan_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  clan_name VARCHAR(50) NULL,
  clan_description TEXT NULL,
  clan_image TEXT NULL,
  clan_url TEXT NULL,
  clan_site_owner TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  clan_tag VARCHAR(50) NOT NULL,
  PRIMARY KEY(clan_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_award (
  award_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  award_name VARCHAR(50) NOT NULL,
  award_description TEXT NOT NULL,
  award_image TEXT NOT NULL,
  award_url TEXT NULL,
  award_type ENUM('Internal','External') NULL,
  PRIMARY KEY(award_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_award_given (
  award_given_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  award_id INTEGER UNSIGNED NOT NULL,
  award_given_member_id INTEGER UNSIGNED NOT NULL,
  award_given_reason TEXT NOT NULL,
  award_given_date DATE NOT NULL,
  PRIMARY KEY(award_given_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_map_entry (
  map_entry_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  map_id INTEGER UNSIGNED NULL,
  game_mode_id INTEGER UNSIGNED NULL,
  PRIMARY KEY(map_entry_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_game_mode (
  game_mode_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  game_mode_name VARCHAR(50) NULL,
  game_mode_description TEXT NULL,
  game_mode_image TEXT NULL,
  PRIMARY KEY(game_mode_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_map (
  map_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  map_name VARCHAR(50) NULL,
  map_description TEXT NULL,
  map_image TEXT NULL,
  PRIMARY KEY(map_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_game (
  game_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  game_name VARCHAR(50) NOT NULL,
  game_description TEXT NOT NULL,
  game_url TEXT NULL,
  game_image TEXT NULL,
  PRIMARY KEY(game_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_join_request_comment (
  join_request_comment_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  join_request_id INTEGER UNSIGNED NOT NULL,
  join_request_comment_date DATE NOT NULL,
  join_request_member_id INTEGER UNSIGNED NOT NULL,
  join_request_comment_text TEXT NOT NULL,
  join_request_comment_public TINYINT(1) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY(join_request_comment_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_join_request (
  join_request_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  e107_user_id INTEGER UNSIGNED NOT NULL,
  join_request_referral_member_id INTEGER UNSIGNED NULL,
  join_request_reason VARCHAR(254) NULL,
  join_request_bio TEXT NULL,
  join_request_date DATE NOT NULL,
  join_request_status ENUM('Queued','Rejected','Accepted') NOT NULL,
  join_request_status_date DATE NOT NULL,
  PRIMARY KEY(join_request_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_challenge (
  challenge_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  challenge_name VARCHAR(50) NOT NULL,
  challenge_description TEXT NOT NULL,
  challenge_clan_id INTEGER UNSIGNED NOT NULL,
  challenge_type_id INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(challenge_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_challenge_round (
  challenge_round_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  challenge_id INTEGER UNSIGNED NOT NULL,
  game_id INTEGER UNSIGNED NOT NULL,
  map_id INTEGER UNSIGNED NOT NULL,
  game_mode_id INTEGER UNSIGNED NOT NULL,
  challenge_round_score_us SMALLINT UNSIGNED NOT NULL,
  challenge_round_score_them SMALLINT UNSIGNED NOT NULL,
  challenge_round_win TINYINT(1) UNSIGNED NOT NULL,
  PRIMARY KEY(challenge_round_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_challenge_stat (
  challenge_stat_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  member_id INTEGER UNSIGNED NULL,
  challenge_round_id INTEGER UNSIGNED NULL,
  challenge_stat_type_id INTEGER UNSIGNED NULL,
  challenge_stat_total SMALLINT UNSIGNED NULL,
  PRIMARY KEY(challenge_stat_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_challenge_stat_type (
  challenge_stat_type_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  challenge_stat_type_name VARCHAR(50) NOT NULL,
  challenge_stat_type_description TEXT NOT NULL,
  challenge_stat_type_image TEXT NULL,
  PRIMARY KEY(challenge_stat_type_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_challenge_type (
  challenge_type_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  challenge_type_name VARCHAR(50) NOT NULL,
  challenge_type_description TEXT NOT NULL,
  PRIMARY KEY(challenge_type_id)
);",
"CREATE TABLE " .MPREFIX."clansystem_member_status (
  member_status_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  member_status_name VARCHAR(50) NOT NULL,
  member_status_order INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(member_status_id)
);",
"INSERT INTO ".MPREFIX."clansystem_clan VALUES (1, 'Clan Name', 'Clan Description', '', '', 1, '.:ClanTag:.');",
"INSERT INTO ".MPREFIX."clansystem_member_status VALUES (1, 'Active', 1);",
"INSERT INTO ".MPREFIX."clansystem_member_status VALUES (2, 'Inactive', 2);",
"INSERT INTO ".MPREFIX."clansystem_member_status VALUES (3, 'Vacation', 3);"
);

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = false;
$eplug_link_name = "";
$eplug_link_url = "";

// Add Sub-Menu Items to Clan System Menu
if(!function_exists('clansystem_install'))
{
	function clansystem_install()
	{
		$sql1 = new db;

		$cs_plugin_name = "ClanSystem";
		$cs_plugin_link_name = "Clan System";
		$cs_plugin_dir = str_replace("../", "", e_PLUGIN)."clansystem";

		$sql1->db_Select("plugin", "*", "plugin_name='$cs_plugin_name'");

		$row1 = $sql1->db_Fetch();
		extract($row1);
		if(!$plugin_installflag)
		{
			$sql1->db_Select("links", "*", "ORDER BY link_order DESC", false);
			$row1 = $sql1->db_Fetch();
			extract($row1);

			$sql1->db_Insert("links", array("link_name"=>"$cs_plugin_link_name", "link_category"=>1, "link_order"=>$link_order + 1));
			$sql1->db_Select("links", "*", "link_name='$cs_plugin_link_name'");

			if($row2 = $sql1->db_Fetch())
			{
				extract($row2);
				$sql1->db_Insert("links", array("link_name"=>"Join Clan", "link_url"=>"$cs_plugin_dir/clansystem_join.php", "link_category"=>1, "link_parent"=>$link_id));
				$sql1->db_Insert("links", array("link_name"=>"Join Requests", "link_url"=>"$cs_plugin_dir/clansystem_join_requests.php", "link_category"=>1, "link_parent"=>$link_id));
			}
		}
	}
}

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done .= "ClanSystem Installation Completed.";

// upgrading ... //
$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$upgrade_alter_tables = "";

$eplug_upgrade_done = "";


?>