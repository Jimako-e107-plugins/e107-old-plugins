<?php



//TAGCLOUD PLUGIN COPYRIGHT 2007-2008 jezza101
//www.jezza101.co.uk
//Plugin released in good faith and has been tested by many users however I make no guarantee of its
//suitability for your site.  Please test carefully!

//If you use this plugin, please link back to my site somewhere from yours :)


if (!defined('e107_INIT')) { exit; }


$eplug_name = "tagcloud";
$eplug_version = "2.0.0";
$eplug_author = "Jezza101";
$eplug_folder = "tagcloud";

$eplug_icon = $eplug_folder."/images/icon_32.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";

$eplug_url = "http://www.jezza101.co.uk";
$eplug_email = "jezza101@gmail.com";
$eplug_description = "Top Tag tagclouds for e107!";
$eplug_compatible = "e107v0.7+";
$eplug_readme = "admin_readme.php";
$eplug_compliant = FALSE;
$eplug_menu_name = "Tagcloud";
$eplug_caption = "Tagcloud";
$eplug_status = TRUE;

$eplug_conffile = "admin_config.php";

$eplug_caption = "Configure Tagcloud";
$eplug_done = "Installation Successful...";
$eplug_upgrade_done = "Upgrade successful...";

// List of comment_type ids used by this plugin. -----------------------------
$eplug_comment_ids = array("tagcloud");

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
	'tags_number'      => 20,
                             //this id was created for this plugin, you may need your own if it doesnt work..??
	'tags_appid'       => 'VKCuaD7V34HTGSO3aBm8IUivZlqds.CA_w3_KlX6jDhBb82jL7NI1qE6P70tUAOUNGs-',
	'tags_update'      => 0,
	'tags_peritem'     => 5,
	'tags_preview'     => 200,
        'tags_style_cloud' => '',
        'tags_style_item'  => '',
        'tags_style_link'  => '',
        'tags_max_size'    => 250,
        'tags_min_size'    => 100,
        'tags_overwrite'   => 0,
        'tags_credit'      => 1,
        'tags_adminmod'    => 0,
        'tags_usermod'     => 0,
        'tags_autogen'     => 0,
        'tags_emetaforum'  => 1,
        'tags_max_colour'  => 'ffffff',
        'tags_min_colour'  => 'ffffff',
        'tags_tagspace'    => '_',
        'tags_seolink'     => 'tags-',
        'tags_fileext'     => '.html',
        'tags_menuname'    => 'Tagcloud',
        'tags_emetanews'   => 1,
        'tags_errortag'    => 200,
        'tags_cumwidth'    => 100,
        'tags_cumheight'   => 200,
        'tags_cumcolour'   => '000000',
        'tags_cumbackcolour'   => 'ffffff',
        'tags_cumtransparent'  => 0,
        'tags_cumspeed'    => 100
);

// List of table names -----------------------------------------------------------------------------------------------

$eplug_table_names = array(
"tag_main","tag_config"
);

$eplug_tables = array("
CREATE TABLE ".MPREFIX."tag_main (
`Tag_ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`Tag_Item_ID` INT NOT NULL,
`Tag_Type` VARCHAR( 8 ) NOT NULL,
`Tag_Name` VARCHAR( 50 ) NOT NULL,
`Tag_Rank` INT NULL,
`Tag_Created` INT NULL ,
INDEX ( `Tag_Item_ID` , `Tag_Type`)
) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."tag_config (
`Tag_Config_ID`                    INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`Tag_Config_Flag`                  INT NOT NULL,
`Tag_Config_CloudFlag`             INT NOT NULL,
`Tag_Config_OnOffFlag`             INT NOT NULL,
`Tag_Config_Type`                  varchar(20) NOT NULL
) ENGINE=MYISAM;",
"INSERT INTO ".MPREFIX."tag_config VALUES (NULL, '1','1','1', 'news');",
"INSERT INTO ".MPREFIX."tag_config VALUES (NULL, '1','1','1', 'page');",
"INSERT INTO ".MPREFIX."tag_config VALUES (NULL, '0','1','1', 'forum');",
"INSERT INTO ".MPREFIX."tag_config VALUES (NULL, '0','1','1', 'download');",
"INSERT INTO ".MPREFIX."tag_config VALUES (NULL, '0','1','1', 'content');"
);

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = FALSE;

//myplugin_install()

$upgrade_alter_tables = array(

"DROP TABLE ".MPREFIX."tag_config;",
"
CREATE TABLE ".MPREFIX."tag_config (
`Tag_Config_ID`                    INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`Tag_Config_Flag`                  INT NOT NULL,
`Tag_Config_CloudFlag`             INT NOT NULL,
`Tag_Config_OnOffFlag`             INT NOT NULL,
`Tag_Config_Type`                  varchar(20) NOT NULL
) ENGINE=MyISAM;",
"INSERT INTO ".MPREFIX."tag_config VALUES (NULL, '1','1','1', 'news');",
"INSERT INTO ".MPREFIX."tag_config VALUES (NULL, '1','1','1', 'page');",
"INSERT INTO ".MPREFIX."tag_config VALUES (NULL, '0','1','1', 'forum');",
"INSERT INTO ".MPREFIX."tag_config VALUES (NULL, '0','1','1', 'download');",
"INSERT INTO ".MPREFIX."tag_config VALUES (NULL, '0','1','1', 'content');"
);

//myplugin_uninstall()


?>

