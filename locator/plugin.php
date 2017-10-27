<?php
/*
+------------------------------------------------------------------------------+
| Locator - a plugin by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/

// if e107 is not running we won't run this plugin program
if (!defined('e107_INIT')) { exit; }

// determine the plugin directory as a global variable
global $PLUGINS_DIRECTORY;

// Get language file (assume that the English language file is always present)
$lan_file = e_PLUGIN."locator/languages/".e_LANGUAGE.".php";
include_lan($lan_file);

// Set the current installed version of Locator into variable $current_version
if ($pref['plug_installed']['locator'] != "") {
  $current_version = trim($pref['plug_installed']['locator']);
} else { // For old e107 versions look-up the plugin table
  $mydb = new db;
  $mydb->db_Select("plugin", "*", "plugin_name='Locator' and plugin_installflag='1'", true);
  if($row = $mydb->db_Fetch()) {
    $current_version = trim($row['plugin_version']);
  }
}

// read the database names array of this plugin from the includes/config file
@include_once("includes/config.php"); // Sometimes require_once blanked out Plugin Manager

$eplug_name = "Locator";
$eplug_version = "1.3";
$eplug_author = "nlstart";
$eplug_url = LOCATOR_LAN_URL;
$eplug_email = "nlstart@webstartinternet.com";
$eplug_description = LOCATOR_LAN_DESCR;
$eplug_compatible = "e107v0.7+";
$eplug_compliant = FALSE;
$eplug_readme = "readme.txt";

$eplug_folder = "locator";
$eplug_menu_name = "locator";
$eplug_conffile = "admin_config.php";
$eplug_icon = $eplug_folder."/images/logo_32.png";
$eplug_icon_small = $eplug_folder."/images/logo_16.png";
$eplug_caption = LOCATOR_LAN_CAPTION;


// List of preferences -----------------------------------------------------------------------------------------------
// this stores a default value(s) in the preferences. 0 = Off , 1= On
// Preferences are saved with plugin folder name as prefix to make preferences unique and recognisable
$eplug_prefs = array(
		$eplug_folder."_name" => "Locator",
    $eplug_folder."_image_path" => "images/",
    $eplug_folder."_default_sort" => "locator_order",
    $eplug_folder."_printheader" => "1",
    $eplug_folder."_maptype" => "1",
    $eplug_folder."_zoomfactor" => "9",
    $eplug_folder."_submit_class" => "255"
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

// Add pre-defined Mapquest countries defined as active into the plugin table array
array_push($eplug_tables,
    "INSERT INTO ".MPREFIX.DB_TABLE_LOCATOR_COUNTRY." VALUES
    (1, 'AL', 'Albania', '2'),
    (2, 'DZ', 'Algeria', '2'),
    (3, 'AS', 'American Samoa', '2'),
    (4, 'AD', 'Andorra', '2'),
    (5, 'AO', 'Angola', '2'),
    (6, 'AI', 'Anguilla', '2'),
    (7, 'AG', 'Antigua and Barbuda', '2'),
    (8, 'AR', 'Argentina', '2'),
    (9, 'AM', 'Armenia', '2'),
    (10, 'AW', 'Aruba', '2'),
    (11, 'AU', 'Australia', '2'),
    (12, 'AT', 'Austria', '2'),
    (13, 'AZ', 'Azerbaijan', '2'),
    (14, 'BS', 'Bahamas', '2'),
    (15, 'BH', 'Bahrain', '2'),
    (16, 'BD', 'Bangladesh', '2'),
    (17, 'BB', 'Barbados', '2'),
    (18, 'BY', 'Belarus', '2'),
    (19, 'BE', 'Belgium', '2'),
    (20, 'BZ', 'Belize', '2'),
    (21, 'BJ', 'Benin', '2'),
    (22, 'BM', 'Bermuda', '2'),
    (23, 'BT', 'Bhutan', '2'),
    (24, 'BO', 'Bolivia', '2'),
    (25, 'BA', 'Bosnia and Herzegovina', '2'),
    (26, 'BW', 'Botswana', '2'),
    (27, 'BV', 'Bouvet Island', '2'),
    (28, 'BR', 'Brazil', '2'),
    (29, 'IO', 'British Indian Ocean Territory', '2'),
    (30, 'VG', 'British Virgin Islands', '2'),
    (31, 'BN', 'Brunei', '2'),
    (32, 'BG', 'Bulgaria', '2'),
    (33, 'BF', 'Burkina Faso', '2'),
    (34, 'BI', 'Burundi', '2'),
    (35, 'KH', 'Cambodia', '2'),
    (36, 'CM', 'Cameroon', '2'),
    (37, 'CV', 'Cape Verde', '2'),
    (38, 'KY', 'Cayman Islands', '2'),
    (39, 'CF', 'Central African Republic', '2'),
    (40, 'TD', 'Chad', '2'),
    (41, 'CL', 'Chile', '2'),
    (42, 'CN', 'China', '2'),
    (43, 'CX', 'Christmas Island', '2'),
    (44, 'CC', 'Cocos (Keeling) Islands', '2'),
    (45, 'CO', 'Colombia', '2'),
    (46, 'KM', 'Comoros', '2'),
    (47, 'CG', 'Congo', '2'),
    (48, 'CD', 'Congo - Democratic Republic of', '2'),
    (49, 'CK', 'Cook Islands', '2'),
    (50, 'CR', 'Costa Rica', '2'),
    (51, 'CI', 'Cote d''Ivoire', '2'),
    (52, 'HR', 'Croatia', '2'),
    (53, 'CU', 'Cuba', '2'),
    (54, 'CY', 'Cyprus', '2'),
    (55, 'CZ', 'Czech Republic', '2'),
    (56, 'DK', 'Denmark', '2'),
    (57, 'DJ', 'Djibouti', '2'),
    (58, 'DM', 'Dominica', '2'),
    (59, 'DO', 'Dominican Republic', '2'),
    (60, 'TP', 'East Timor', '2'),
    (61, 'EC', 'Ecuador', '2'),
    (62, 'EG', 'Egypt', '2'),
    (63, 'SV', 'El Salvador', '2'),
    (64, 'GQ', 'Equitorial Guinea', '2'),
    (65, 'ER', 'Eritrea', '2'),
    (66, 'EE', 'Estonia', '2'),
    (67, 'ET', 'Ethiopia', '2'),
    (68, 'FK', 'Falkland Islands (Islas Malvinas)', '2'),
    (69, 'FO', 'Faroe Islands', '2'),
    (70, 'FJ', 'Fiji', '2'),
    (71, 'FI', 'Finland', '2'),
    (72, 'FR', 'France', '2'),
    (73, 'GF', 'French Guyana', '2'),
    (74, 'PF', 'French Polynesia', '2'),
    (75, 'TF', 'French Southern and Antarctic Lands', '2'),
    (76, 'GA', 'Gabon', '2'),
    (77, 'GM', 'Gambia', '2'),
    (78, 'GZ', 'Gaza Strip', '2'),
    (79, 'GE', 'Georgia', '2'),
    (80, 'DE', 'Germany', '2'),
    (81, 'GH', 'Ghana', '2'),
    (82, 'GI', 'Gibraltar', '2'),
    (83, 'GR', 'Greece', '2'),
    (84, 'GL', 'Greenland', '2'),
    (85, 'GD', 'Grenada', '2'),
    (86, 'GP', 'Guadeloupe', '2'),
    (87, 'GU', 'Guam', '2'),
    (88, 'GT', 'Guatemala', '2'),
    (89, 'GN', 'Guinea', '2'),
    (90, 'GW', 'Guinea-Bissau', '2'),
    (91, 'GY', 'Guyana', '2'),
    (92, 'HT', 'Haiti', '2'),
    (93, 'HM', 'Heard Island and McDonald Islands', '2'),
    (94, 'VA', 'Holy See (Vatican City)', '2'),
    (95, 'HN', 'Honduras', '2'),
    (96, 'HK', 'Hong Kong', '2'),
    (97, 'HU', 'Hungary', '2'),
    (98, 'IS', 'Iceland', '2'),
    (99, 'IN', 'India', '2'),
    (100, 'ID', 'Indonesia', '2'),
    (101, 'IR', 'Iran', '2'),
    (102, 'IQ', 'Iraq', '2'),
    (103, 'IE', 'Ireland', '2'),
    (104, 'IL', 'Israel', '2'),
    (105, 'IT', 'Italy', '2'),
    (106, 'JM', 'Jamaica', '2'),
    (107, 'JP', 'Japan', '2'),
    (108, 'JO', 'Jordan', '2'),
    (109, 'KZ', 'Kazakhstan', '2'),
    (110, 'KE', 'Kenya', '2'),
    (111, 'KI', 'Kiribati', '2'),
    (112, 'KW', 'Kuwait', '2'),
    (113, 'KG', 'Kyrgyzstan', '2'),
    (114, 'LA', 'Laos', '2'),
    (115, 'LV', 'Latvia', '2'),
    (116, 'LB', 'Lebanon', '2'),
    (117, 'LS', 'Lesotho', '2'),
    (118, 'LR', 'Liberia', '2'),
    (119, 'LY', 'Libya', '2'),
    (120, 'LI', 'Liechtenstein', '2'),
    (121, 'LT', 'Lithuania', '2'),
    (122, 'LU', 'Luxembourg', '2'),
    (123, 'MO', 'Macau', '2'),
    (124, 'MK', 'Macedonia - The Former Yugoslav Republic of', '2'),
    (125, 'MG', 'Madagascar', '2'),
    (126, 'MW', 'Malawi', '2'),
    (127, 'MY', 'Malaysia', '2'),
    (128, 'MV', 'Maldives', '2'),
    (129, 'ML', 'Mali', '2'),
    (130, 'MT', 'Malta', '2'),
    (131, 'MH', 'Marshall Islands', '2'),
    (132, 'MQ', 'Martinique', '2'),
    (133, 'MR', 'Mauritania', '2'),
    (134, 'MU', 'Mauritius', '2'),
    (135, 'YT', 'Mayotte', '2'),
    (136, 'MX', 'Mexico', '2'),
    (137, 'FM', 'Micronesia - Federated States of', '2'),
    (138, 'MD', 'Moldova', '2'),
    (139, 'MC', 'Monaco', '2'),
    (140, 'MN', 'Mongolia', '2'),
    (141, 'MS', 'Montserrat', '2'),
    (142, 'MA', 'Morocco', '2'),
    (143, 'MZ', 'Mozambique', '2'),
    (144, 'MM', 'Myanmar', '2'),
    (145, 'NA', 'Namibia', '2'),
    (146, 'NR', 'Naura', '2'),
    (147, 'NP', 'Nepal', '2'),
    (148, 'NL', 'Netherlands', '2'),
    (149, 'AN', 'Netherlands Antilles', '2'),
    (150, 'NC', 'New Caledonia', '2'),
    (151, 'NZ', 'New Zealand', '2'),
    (152, 'NI', 'Nicaragua', '2'),
    (153, 'NE', 'Niger', '2'),
    (154, 'NG', 'Nigeria', '2'),
    (155, 'NU', 'Niue', '2'),
    (156, 'NF', 'Norfolk Island', '2'),
    (157, 'KP', 'North Korea', '2'),
    (158, 'MP', 'Northern Mariana Islands', '2'),
    (159, 'NO', 'Norway', '2'),
    (160, 'OM', 'Oman', '2'),
    (161, 'PK', 'Pakistan', '2'),
    (162, 'PW', 'Palau', '2'),
    (163, 'PA', 'Panama', '2'),
    (164, 'PG', 'Papua New Guinea', '2'),
    (165, 'PY', 'Paraguay', '2'),
    (166, 'PE', 'Peru', '2'),
    (167, 'PH', 'Philippines', '2'),
    (168, 'PN', 'Pitcairn Islands', '2'),
    (169, 'PL', 'Poland', '2'),
    (170, 'PT', 'Portugal', '2'),
    (171, 'PR', 'Puerto Rico', '2'),
    (172, 'QA', 'Qatar', '2'),
    (173, 'RE', 'Reunion', '2'),
    (174, 'RO', 'Romania', '2'),
    (175, 'RU', 'Russia', '2'),
    (176, 'RW', 'Rwanda', '2'),
    (177, 'KN', 'Saint Kitts and Nevis', '2'),
    (178, 'LC', 'Saint Lucia', '2'),
    (179, 'VC', 'Saint Vincent and the Grenadines', '2'),
    (180, 'WS', 'Samoa', '2'),
    (181, 'SM', 'San Marino', '2'),
    (182, 'ST', 'Sao Tome and Principe', '2'),
    (183, 'SA', 'Saudi Arabia', '2'),
    (184, 'SN', 'Senegal', '2'),
    (185, 'CS', 'Serbia and Montenegro', '2'),
    (186, 'SC', 'Seychelles', '2'),
    (187, 'SL', 'Sierra Leone', '2'),
    (188, 'SG', 'Singapore', '2'),
    (189, 'SK', 'Slovakia', '2'),
    (190, 'SI', 'Slovenia', '2'),
    (191, 'SB', 'Solomon Islands', '2'),
    (192, 'SO', 'Somalia', '2'),
    (193, 'ZA', 'South Africa', '2'),
    (194, 'GS', 'South Georgia and the South Sandwich Islands', '2'),
    (195, 'KR', 'South Korea', '2'),
    (196, 'ES', 'Spain', '2'),
    (197, 'LK', 'Sri Lanka', '2'),
    (198, 'SH', 'St. Helena', '2'),
    (199, 'PM', 'St. Pierre and Miquelon', '2'),
    (200, 'SD', 'Sudan', '2'),
    (201, 'SR', 'Suriname', '2'),
    (202, 'SJ', 'Svalbard', '2'),
    (203, 'SZ', 'Swaziland', '2'),
    (204, 'SE', 'Sweden', '2'),
    (205, 'CH', 'Switzerland', '2'),
    (206, 'SY', 'Syria', '2'),
    (207, 'TW', 'Taiwan', '2'),
    (208, 'TJ', 'Tajikistan', '2'),
    (209, 'TZ', 'Tanzania', '2'),
    (210, 'TH', 'Thailand', '2'),
    (211, 'TG', 'Togo', '2'),
    (212, 'TK', 'Tokelau', '2'),
    (213, 'TO', 'Tonga', '2'),
    (214, 'TT', 'Trinidad and Tobago', '2'),
    (215, 'TN', 'Tunisia', '2'),
    (216, 'TR', 'Turkey', '2'),
    (217, 'TM', 'Turkmenistan', '2'),
    (218, 'TC', 'Turks and Caicos Islands', '2'),
    (219, 'TV', 'Tuvalu', '2'),
    (220, 'UG', 'Uganda', '2'),
    (221, 'UA', 'Ukraine', '2'),
    (222, 'AE', 'United Arab Emirates', '2'),
    (223, 'GB', 'United Kingdom', '2'),
    (224, 'VI', 'United States Virgin Islands', '2'),
    (225, 'UY', 'Uruguay', '2'),
    (226, 'UZ', 'Uzbekistan', '2'),
    (227, 'VU', 'Vanuatu', '2'),
    (228, 'VE', 'Venezuela', '2'),
    (229, 'VN', 'Vietnam', '2'),
    (230, 'WF', 'Wallis and Futuna', '2'),
    (231, 'PS', 'West Bank', '2'),
    (232, 'EH', 'Western Sahara', '2'),
    (233, 'YE', 'Yemen', '2'),
    (234, 'ZM', 'Zambia', '2'),
    (235, 'ZW', 'Zimbabwe', '2'),
    (236, 'US', 'United States of America', '2')
    ");

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = LOCATOR_LAN_LINK_NAME;
// $plugins_directory can be named differently than the default e107_plugins in the e107_config
$eplug_link_url = $PLUGINS_DIRECTORY."locator/locator.php";
$eplug_done = LOCATOR_LAN_DONE1." ".$eplug_name." v".$eplug_version." ".LOCATOR_LAN_DONE2;

// upgrading ...
if ($current_version == "1.0" || $current_version == "1.1") {
  $upgrade_add_prefs = "";
} else {
  $upgrade_add_prefs = array($eplug_folder."_submit_class" => "255"); // Set location submission to 'No one (inactive)'
}
$upgrade_remove_prefs = "";

if ($current_version == "1.0" || $current_version == "1.1") {
  // upgrade from locator 1.0/1.1
  $upgrade_alter_tables = "";
} else { // upgrade from older locator versions
  $upgrade_alter_tables = array(
  "ALTER TABLE ".MPREFIX."locator_sites ADD locator_open_mo varchar(255) default NULL AFTER locator_active_status;",
  "ALTER TABLE ".MPREFIX."locator_sites ADD locator_open_tu varchar(255) default NULL AFTER locator_open_mo;",
  "ALTER TABLE ".MPREFIX."locator_sites ADD locator_open_we varchar(255) default NULL AFTER locator_open_tu;",
  "ALTER TABLE ".MPREFIX."locator_sites ADD locator_open_th varchar(255) default NULL AFTER locator_open_we;",
  "ALTER TABLE ".MPREFIX."locator_sites ADD locator_open_fr varchar(255) default NULL AFTER locator_open_th;",
  "ALTER TABLE ".MPREFIX."locator_sites ADD locator_open_sa varchar(255) default NULL AFTER locator_open_fr;",
  "ALTER TABLE ".MPREFIX."locator_sites ADD locator_open_su varchar(255) default NULL AFTER locator_open_sa;",
  "ALTER TABLE ".MPREFIX."locator_sites ADD locator_open_remarks varchar(255) default NULL AFTER locator_open_su;",
  "ALTER TABLE ".MPREFIX."locator_country CHANGE locator_country_id locator_country_id int(10) NOT NULL auto_increment;",
  "ALTER TABLE ".MPREFIX."locator_cat CHANGE locator_cat_id locator_cat_id int(10) NOT NULL auto_increment;",
  "ALTER TABLE ".MPREFIX."locator_cat CHANGE locator_catorder locator_catorder int(11) NOT NULL default '1';",
  "ALTER TABLE ".MPREFIX."locator_cat ADD locator_cat_class int(11) NOT NULL AFTER locator_catorder;",
  "CREATE TABLE ".MPREFIX."locator_sub_sites (
    locator_sub_id int(10) NOT NULL auto_increment,
    locator_sub_client varchar(255) default NULL,
    locator_sub_address1 varchar(255) default NULL,
    locator_sub_address2 varchar(255) default NULL,
    locator_sub_address3 varchar(255) default NULL,
    locator_sub_zipcode varchar(255) default NULL,
    locator_sub_city varchar(255) default NULL,
    locator_sub_county varchar(255) default NULL,
    locator_sub_state varchar(255) default NULL,
    locator_sub_country varchar(255) default NULL,
    locator_sub_sitename varchar(255) default NULL,
    locator_sub_manager1 varchar(255) default NULL,
    locator_sub_manager2 varchar(255) default NULL,
    locator_sub_telephone1 varchar(255) default NULL,
    locator_sub_telephone2 varchar(255) default NULL,
    locator_sub_fax1 varchar(255) default NULL,
    locator_sub_fax2 varchar(255) default NULL,
    locator_sub_email1 varchar(255) default NULL,
    locator_sub_email2 varchar(255) default NULL,
    locator_sub_latitude varchar(255) default NULL,
    locator_sub_longtitude varchar(255) default NULL,
    locator_sub_groundelevation varchar(255) default NULL,
    locator_sub_verified varchar(255) default NULL,
    locator_sub_cat varchar(255) default NULL,
    locator_sub_status varchar(255) default NULL,
    locator_sub_description1 varchar(255) default NULL,
    locator_sub_description2 varchar(255) default NULL,
    locator_sub_url1 varchar(255) default NULL,
    locator_sub_url2 varchar(255) default NULL,
    locator_sub_catid int(10) default NULL,
    locator_sub_order varchar(255) default NULL,
    locator_sub_active_status varchar(255) default NULL,
    locator_sub_open_mo varchar(255) default NULL,
    locator_sub_open_tu varchar(255) default NULL,
    locator_sub_open_we varchar(255) default NULL,
    locator_sub_open_th varchar(255) default NULL,
    locator_sub_open_fr varchar(255) default NULL,
    locator_sub_open_sa varchar(255) default NULL,
    locator_sub_open_su varchar(255) default NULL,
    locator_sub_open_remarks varchar(255) default NULL,
    locator_sub_datestamp int(10) NOT NULL default '0',
    locator_sub_ip varchar(15) NOT NULL default '',
    locator_sub_auth tinyint(3) NOT NULL default '0',
    locator_sub_name varchar(100) default NULL,
    locator_sub_email varchar(100) default NULL,
    PRIMARY KEY  (locator_sub_id)
    ) ENGINE=MyISAM"
  );
}
    
if (isset($current_version)) {
  $eplug_upgrade_done = LOCATOR_LAN_UPGRADE." ".LOCATOR_LAN_FROM." $eplug_name v$current_version ".LOCATOR_LAN_TO." v$eplug_version";
} else {
  $eplug_upgrade_done = LOCATOR_LAN_UPGRADE." ".$eplug_name." v".$eplug_version.".";
}
?>