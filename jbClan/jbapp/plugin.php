<?php
/*
+--------------------------------------------------------------------------------+
|   jbApp - by Jesse Burns aka jburns131 aka Jakle (jburns131@jbwebware.com)
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

$eplug_name = "jbApp";
$eplug_version = "3.02.03";
$eplug_author = "Jesse Burns";
$eplug_url = "http://www.jbwebware.com";
$eplug_email = "jburns131@jbwebware.com";
$eplug_description = "This module integrates your membership application into the e107 website. This plugin is an addon to the jbRoster plugin and should only be used if you have installed jbRoster first.";
$eplug_compatible = "e107v0.7+";
$eplug_readme = "readme.txt";

$eplug_folder = "jbapp";
$eplug_menu_name = "jbapp";
$eplug_conffile = "admin_config.php";
$eplug_icon = $eplug_folder."/images/icon_32.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";
$eplug_caption = "Configure jbApp";

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = "Application";
$eplug_link_url = e_PLUGIN."jbapp/jbapp.php";
$eplug_done = "Installation Successful..";

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
		"jbapp_1" => 1 // this stores a default value in the preferences.0 = off , 1= On
);

if (!isset($sql1)) {
    $sql1 = new db;
}

$sql1->db_Select("plugin", "*");
while($rows1 = $sql1->db_Fetch()){
    if (($rows1['plugin_name'] == "jbRoster") && ($rows1['plugin_installflag'] == "1")) {
        $installed_jbroster = 1;
    }
}

if (isset($installed_jbroster)) {
    // List of table names ( If jbRoster is installed ) ------------------------------------------------------------------
    $eplug_table_names = array(
        DB_TABLE_APP_INFO);

    // List of sql requests to create tables ( If jbRoster is installed ) ------------------------------------------------
    $eplug_tables = array(
        "CREATE TABLE ".MPREFIX.DB_TABLE_APP_INFO." (
            organization_id int NOT NULL,
            organization_email varchar(200) NOT NULL default '',
            organization_disclaimer text NOT NULL default ''
        )   TYPE=MyISAM;",

        "INSERT INTO ".MPREFIX.DB_TABLE_APP_INFO."
            (organization_id, organization_disclaimer)
        VALUES
            (1, '<center>This is a basic statement of what the Organization is all about and what kind of members we are looking for.</center>');"
    );
} else {
    // List of table names ( If jbRoster is not installed ) ------------------------------------------------------------------
    $eplug_table_names = array(
        DB_TABLE_APP_INFO,
        DB_TABLE_ROSTER_PREFERENCES,
        DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
        DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES);

    // List of sql requests to create tables ( If jbRoster is not installed ) ------------------------------------------------
    $eplug_tables = array(
        "CREATE TABLE ".MPREFIX.DB_TABLE_APP_INFO." (
            organization_id int NOT NULL,
            organization_email varchar(200) NOT NULL default '',
            organization_disclaimer text NOT NULL default ''
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

        "INSERT INTO ".MPREFIX.DB_TABLE_APP_INFO."
            (organization_id, organization_disclaimer)
        VALUES
            (1, '<center>This is a basic statement of what the Organization is all about and what kind of members we are looking for.</center>');",

        "INSERT INTO ".MPREFIX.DB_TABLE_ROSTER_PREFERENCES."
            (organization_name)
        VALUES
            ('Your Organization');",

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
            ('Join Date', 1, 49);"
    );
}

// upgrading ... //
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";

$eplug_upgrade_done = "Thanks for using jbApp $eplug_version.";
?>
