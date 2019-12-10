<?php
/*
+--------------------------------------------------------------------------------+
|   jbRoster - by Jesse Burns aka jburns131 aka Jakle (jburns131@jbwebware.com)
|
|   Plugin Support Site: www.jbwebware.com
|
|   A plugin designed for the e107 Website System
|   http://e107.org
|
|   For more plugins visit:
|   http://plugins.e107.org
|   http://www.e107coders.org
|
|   Released under the terms and conditions of the
|   GNU General Public License (http://gnu.org).
|
+--------------------------------------------------------------------------------+
*/

// if e107 is not running we won't run this plugin program
if (!defined('e107_INIT')) {
    exit;
}

require_once("includes/config.constants.php");

$eplug_name = "jbRoster";
$eplug_version = "3.02.03";
$eplug_author = "Jesse Burns";
$eplug_url = "http://www.jbwebware.com";
$eplug_email = "jburns131@jbwebware.com";
$eplug_description = "This module will allow you to manage and display an organized group of people, be it an online gaming clan or guild, a Club Sports Team or a any type of get together, such as company personnel or a book club. I have tried to make this as flexable as possible so you can use it for almost any type of structured oranization you can think of.";
$eplug_compatible = "e107v0.7+";
$eplug_readme = "readme.txt";

$eplug_folder = "jbroster_menu";
$eplug_menu_name = "jbroster_menu";
$eplug_conffile = "admin_config.php";
$eplug_icon = $eplug_folder."/images/icon_32.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";
$eplug_caption = "Configure jbRoster";

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = "Roster";
$eplug_link_url = e_PLUGIN."jbroster_menu/jbroster.php";
$eplug_done = "Installation Successful..";

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
		"jbroster_1" => 1 // this stores a default value in the preferences.0 = off , 1= On
);

if (!isset($sql2)) {
    $sql2 = new db;
}

$sql2->db_Select("plugin", "*");
while($rows2 = $sql2->db_Fetch()){
    if (($rows2['plugin_name'] == "jbApp") && ($rows2['plugin_installflag'] == "1")) {
        $installed_jbapp = 1;
    }
}

if (isset($installed_jbapp)) {
    // List of table names (if jbApp is installed) -----------------------------------------------------------------------
    $eplug_table_names = array(
        DB_TABLE_ROSTER_GAMES,
        DB_TABLE_ROSTER_LEADER_STATUS,
        DB_TABLE_ROSTER_MEMBER_STATUS,
        DB_TABLE_ROSTER_MEMBERS,
        DB_TABLE_ROSTER_ORG_DESIGNATIONS,
        DB_TABLE_ROSTER_ORG_TYPES,
        DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS,
        DB_TABLE_ROSTER_TEAM_MEMBERS,
        DB_TABLE_ROSTER_TEAM_STATUS,
        DB_TABLE_ROSTER_TEAMS,
        DB_TABLE_ROSTER_TEXT_COLORS
        );

    // List of sql requests to create tables (if jbApp is installed) -----------------------------------------------------
    $eplug_tables = array(
        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_GAMES." (
            game_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
            game_name varchar(200) NOT NULL default 'None',
            text_color varchar(200) NOT NULL default '#FFFFFF',
            game_order int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_LEADER_STATUS." (
            status_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
            status_name varchar(200) NOT NULL,
            text_color varchar(200) NOT NULL default '#FFFFFF',
            status_order int NOT NULL default 1,
            display int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_MEMBER_STATUS." (
            status_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
            status_name varchar(200) NOT NULL,
            text_color varchar(200) NOT NULL default '#FFFFFF',
            status_order int NOT NULL default 1,
            display int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_MEMBERS." (
            member_id int NOT NULL,
            nickname varchar(200) NOT NULL default '',
            real_name varchar(200) NOT NULL default '',
            external_image varchar(200) NOT NULL default '',
            active_external_image int NOT NULL default 1,
            member_status varchar(200) NOT NULL default 'Open Application',
            leader_status varchar(200) NOT NULL default 'None',
            leader_order int NOT NULL default 1,
            member_application_date int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_ORG_DESIGNATIONS." (
            designation_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
            designation_name varchar(200) NOT NULL default 'Clan',
            designation_order int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_ORG_TYPES." (
            organization_type_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
            organization_type int NOT NULL default 1,
            organization_name varchar(200) NOT NULL default 'Your Organization',
            organization_order int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS." (
            designation_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
            designation_name varchar(200) NOT NULL default 'Squad',
            designation_order int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_TEAM_MEMBERS." (
            member_id int NOT NULL,
            member_name varchar(200) NOT NULL default '',
            team_id int NOT NULL,
            team_name varchar(200) NOT NULL default '',
            game_id int NOT NULL,
            game_name varchar(200) NOT NULL default '',
            member_team_status varchar(200) NOT NULL default 'None',
            text_color varchar(200) NOT NULL default '#FFFFFF',
            member_team_order int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_TEAM_STATUS." (
            status_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
            status_name varchar(200) NOT NULL default 'None',
            team_id int NOT NULL,
            team_name varchar(200) NOT NULL,
            game_id int NOT NULL,
            game_name varchar(200) NOT NULL,
            text_color varchar(200) NOT NULL default '#FFFFFF',
            status_order int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_TEAMS." (
            team_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
            team_name varchar(200) NOT NULL default 'None',
            game_id int NOT NULL,
            game_name varchar(200) NOT NULL default 'None',
            text_color varchar(200) NOT NULL default '#FFFFFF',
            team_order int NOT NULL default 1,
            display int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS." (
            color_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
            color_name varchar(200) NOT NULL default 'None',
            hex_code varchar(200) NOT NULL default '#FFFFFF',
            color_order int NOT NULL default 1
        )   TYPE=MyISAM;",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_LEADER_STATUS."
            (status_name, text_color, status_order)
        VALUES
            ('None', '#FFA500', 1);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_LEADER_STATUS."
            (status_name, text_color, status_order)
        VALUES
            ('Organization Leader', '#FFA500', 2);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_LEADER_STATUS."
            (status_name, text_color, status_order)
        VALUES
            ('Organization Captain', '#FFA500', 3);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_LEADER_STATUS."
            (status_name, text_color, status_order)
        VALUES
            ('Web Admin', '#FFA500', 4);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_MEMBER_STATUS."
            (status_name, status_order)
        VALUES
            ('None', 1);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_MEMBER_STATUS."
            (status_name, status_order)
        VALUES
            ('Team Member', 2);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_MEMBER_STATUS."
            (status_name, status_order)
        VALUES
            ('General Member', 3);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_MEMBER_STATUS."
            (status_name, status_order)
        VALUES
            ('Cadet', 4);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_MEMBER_STATUS."
            (status_name, status_order)
        VALUES
            ('Recruit', 5);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_MEMBER_STATUS."
            (status_name, status_order)
        VALUES
            ('Inactive Member', 6);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_MEMBER_STATUS."
            (status_name, status_order)
        VALUES
            ('Open Application', 7);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_MEMBER_STATUS."
            (status_name, status_order)
        VALUES
            ('Closed Application', 8);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_TYPES."
            (organization_type, organization_name, organization_order)
        VALUES
            (3, 'FPS Online Gaming', 1);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_TYPES."
            (organization_type, organization_name, organization_order)
        VALUES
            (4, 'RPG Online Gaming', 2);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_TYPES."
            (organization_type, organization_name, organization_order)
        VALUES
            (5, 'Club Sports Team', 3);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_TYPES."
            (organization_type, organization_name, organization_order)
        VALUES
            (6, 'Other Type of Organization', 4);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Clan', 1);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Team', 2);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Guild', 3);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Club', 4);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Company', 5);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Squad', 1);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Fire Team', 2);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Raid', 3);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Unit', 4);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Division', 5);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Section', 6);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('White', '#FFFFFF', 1);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Silver', '#C0C0C0', 2);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Aqua', '#00FFFF', 3);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Yellow', '#FFFF00', 4);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Orange', '#FFA500', 5);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Red', '#FF0000', 6);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Brown', '#A52A2A', 7);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Purple', '#800080', 8);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Blue', '#0000FF', 9);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Green', '#008000', 10);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Black', '#000000', 11);"
    );
} else {
    // List of table names (if jbApp is not installed) -------------------------------------------------------------------
    $eplug_table_names = array(
    	DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
    	DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
    	DB_TABLE_ROSTER_GAMES,
    	DB_TABLE_ROSTER_LEADER_STATUS,
        DB_TABLE_ROSTER_MEMBER_STATUS,
        DB_TABLE_ROSTER_MEMBERS,
    	DB_TABLE_ROSTER_ORG_DESIGNATIONS,
        DB_TABLE_ROSTER_ORG_TYPES,
    	DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS,
        DB_TABLE_ROSTER_PREFERENCES,
        DB_TABLE_ROSTER_TEAM_MEMBERS,
        DB_TABLE_ROSTER_TEAM_STATUS,
        DB_TABLE_ROSTER_TEAMS,
        DB_TABLE_ROSTER_TEXT_COLORS
        );

    // List of sql requests to create tables (if jbApp not is installed) -------------------------------------------------
    $eplug_tables = array(
        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES." (
        	attribute_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
        	attribute_name varchar(200) NOT NULL default 'None',
        	organization_type int NOT NULL,
        	attribute_order int NOT NULL,
        	main_display int NOT NULL default 1,
        	profile_display int NOT NULL default 1,
        	application_display int NOT NULL default 1,
        	text_color varchar(200) NOT NULL default '#FFFFFF'
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES." (
        	member_id int NOT NULL,
        	attribute_id int NOT NULL,
        	attribute_name varchar(200) NOT NULL default 'None',
        	attribute_value varchar(1000) NOT NULL default 'None',
        	organization_type int NOT NULL,
        	main_display int NOT NULL default 1,
        	profile_display int NOT NULL default 1,
        	application_display int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_GAMES." (
            game_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
            game_name varchar(200) NOT NULL default 'None',
            text_color varchar(200) NOT NULL default '#FFFFFF',
            game_order int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_LEADER_STATUS." (
        	status_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
            status_name varchar(200) NOT NULL,
            text_color varchar(200) NOT NULL default '#FFFFFF',
            status_order int NOT NULL default 1,
        	display int NOT NULL default 1
        )   TYPE=MyISAM;",


        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_MEMBER_STATUS." (
        	status_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
            status_name varchar(200) NOT NULL,
            text_color varchar(200) NOT NULL default '#FFFFFF',
            status_order int NOT NULL default 1,
            display int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_MEMBERS." (
            member_id int NOT NULL,
            nickname varchar(200) NOT NULL default '',
            real_name varchar(200) NOT NULL default '',
        	external_image varchar(200) NOT NULL default '',
        	active_external_image int NOT NULL default 1,
            member_status varchar(200) NOT NULL default 'Open Application',
        	leader_status varchar(200) NOT NULL default 'None',
        	leader_order int NOT NULL default 1,
            member_application_date int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_ORG_DESIGNATIONS." (
        	designation_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
            designation_name varchar(200) NOT NULL default 'Clan',
            designation_order int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_ORG_TYPES." (
        	organization_type_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
            organization_type int NOT NULL default 1,
            organization_name varchar(200) NOT NULL default 'Your Organization',
            organization_order int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS." (
        	designation_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
            designation_name varchar(200) NOT NULL default 'Squad',
            designation_order int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_PREFERENCES." (
            organization_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
            organization_name varchar(200) NOT NULL default 'Your Organization',
        	organization_type int NOT NULL default 3,
            organization_designation int NOT NULL default 1,
        	organization_unit_designation int NOT NULL default 1,
            organization_logo varchar(200) NOT NULL default '',
        	organization_logo_alignment varchar(200) NOT NULL default 'center',
            organization_order int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_TEAM_MEMBERS." (
            member_id int NOT NULL,
            member_name varchar(200) NOT NULL default '',
            team_id int NOT NULL,
            team_name varchar(200) NOT NULL default '',
            game_id int NOT NULL,
            game_name varchar(200) NOT NULL default '',
            member_team_status varchar(200) NOT NULL default 'None',
            text_color varchar(200) NOT NULL default '#FFFFFF',
            member_team_order int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_TEAM_STATUS." (
            status_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
            status_name varchar(200) NOT NULL default 'None',
        	team_id int NOT NULL,
            team_name varchar(200) NOT NULL,
            game_id int NOT NULL,
            game_name varchar(200) NOT NULL,
            text_color varchar(200) NOT NULL default '#FFFFFF',
            status_order int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_TEAMS." (
            team_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
        	team_name varchar(200) NOT NULL default 'None',
            game_id int NOT NULL,
            game_name varchar(200) NOT NULL default 'None',
            text_color varchar(200) NOT NULL default '#FFFFFF',
        	team_order int NOT NULL default 1,
            display int NOT NULL default 1
        )   TYPE=MyISAM;",

        "CREATE TABLE ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS." (
        	color_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
        	color_name varchar(200) NOT NULL default 'None',
            hex_code varchar(200) NOT NULL default '#FFFFFF',
        	color_order int NOT NULL default 1
        )   TYPE=MyISAM;",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Nick Name', 1, 1);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Real Name', 1, 2);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Team Status', 1, 3);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Member Status', 1, 4);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Leader Status', 1, 5);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Desired Status', 1, 6);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Other Games I Play', 2, 7);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Email Address', 1, 8);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Xfire', 2, 9);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('AIM', 1, 10);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('MSN', 1, 11);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('YIM', 1, 12);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('ICQ', 1, 13);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Location', 1, 14);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Age', 1, 15);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Gender', 1, 16);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Player Level', 4, 17);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Player Race', 4, 18);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Player Class', 4, 19);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Player Profession', 4, 20);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Player Position', 5, 21);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Player Height', 5, 22);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Player Weight', 5, 23);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Jersey #', 5, 24);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Work/School', 1, 25);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Best Night To Play', 2, 26);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Worst Night To Play', 2, 27);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Best Time Of Day', 2, 28);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Worst Time Of Day', 2, 29);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Favorite Maps', 3, 30);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Favorite Weapons', 2, 31);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Skill Level', 2, 32);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Other Clans I Have Been In', 2, 33);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('How I Heard About', 1, 34);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('PC Manufacturer', 2, 35);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Motherboard', 2, 36);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('CPU', 2, 37);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Memory', 2, 38);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Hard Drives', 2, 39);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Video Card', 2, 40);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Sound Card', 2, 41);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Headset', 2, 42);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Monitor', 2, 43);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Keyboard', 2, 44);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Mouse', 2, 45);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Internet Connection', 2, 46);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Member Bio', 1, 47);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Application Comments', 1, 48);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES."
            (attribute_name, organization_type, attribute_order)
        VALUES
            ('Join Date', 1, 49);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_LEADER_STATUS."
            (status_name, text_color, status_order)
        VALUES
            ('None', '#FFA500', 1);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_LEADER_STATUS."
            (status_name, text_color, status_order)
        VALUES
            ('Organization Leader', '#FFA500', 2);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_LEADER_STATUS."
            (status_name, text_color, status_order)
        VALUES
            ('Organization Captain', '#FFA500', 3);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_LEADER_STATUS."
            (status_name, text_color, status_order)
        VALUES
            ('Web Admin', '#FFA500', 4);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_MEMBER_STATUS."
            (status_name, status_order)
        VALUES
            ('None', 1);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_MEMBER_STATUS."
            (status_name, status_order)
        VALUES
            ('Team Member', 2);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_MEMBER_STATUS."
            (status_name, status_order)
        VALUES
            ('General Member', 3);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_MEMBER_STATUS."
            (status_name, status_order)
        VALUES
            ('Cadet', 4);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_MEMBER_STATUS."
            (status_name, status_order)
        VALUES
            ('Recruit', 5);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_MEMBER_STATUS."
            (status_name, status_order)
        VALUES
            ('Inactive Member', 6);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_MEMBER_STATUS."
            (status_name, status_order)
        VALUES
            ('Open Application', 7);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_MEMBER_STATUS."
            (status_name, status_order)
        VALUES
            ('Closed Application', 8);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_TYPES."
            (organization_type, organization_name, organization_order)
        VALUES
            (3, 'FPS Online Gaming', 1);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_TYPES."
            (organization_type, organization_name, organization_order)
        VALUES
            (4, 'RPG Online Gaming', 2);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_TYPES."
            (organization_type, organization_name, organization_order)
        VALUES
            (5, 'Club Sports Team', 3);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_TYPES."
            (organization_type, organization_name, organization_order)
        VALUES
            (6, 'Other Type of Organization', 4);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_PREFERENCES."
            (organization_name)
        VALUES
            ('Your Organization');",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Clan', 1);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Team', 2);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Guild', 3);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Club', 4);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Company', 5);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Squad', 1);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Fire Team', 2);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Raid', 3);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Unit', 4);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Division', 5);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS."
            (designation_name, designation_order)
        VALUES
            ('Section', 6);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('White', '#FFFFFF', 1);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Silver', '#C0C0C0', 2);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Aqua', '#00FFFF', 3);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Yellow', '#FFFF00', 4);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Orange', '#FFA500', 5);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Red', '#FF0000', 6);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Brown', '#A52A2A', 7);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Purple', '#800080', 8);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Blue', '#0000FF', 9);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Green', '#008000', 10);",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_TEXT_COLORS."
            (color_name, hex_code, color_order)
        VALUES
            ('Black', '#000000', 11);"
    );
}

// upgrading ... //
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";

$eplug_upgrade_done = "Thanks for using jbRoster $eplug_version.";

?>
