<?php
/*
+---------------------------------------------------------------+
|        for e107 website system
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
// Plugin info -------------------------------------------------------------------------------------------------------

$lan_file = e_PLUGIN.'onlineinfo_menu/languages/admin_'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/admin_English.php');

$eplug_name = "Online Info";
$eplug_version = "8.5.1";
$eplug_author = "TheMadMonk";
$eplug_logo = "./images/logo.png";
$eplug_url = "http://www.gamingmad.com";
$eplug_email = "TheMadMonk@gamingmad.com";
$eplug_description = "Combines several plugins together and a load of other new features, including basic intergration with Coppermine Photo Gallery, Gallery2, Invision Power Board, Simple Machines Forum, Flash Chat.<br /><i>Some Java code found and used from <a href=http://www.dynamicdrive.com>DynamicDrive</a>.</i><br /><br /><b>".ONLINEINFO_HELP_18."</b><br />".ONLINEINFO_HELP_17.", ".ONLINEINFO_HELP_20.", ".ONLINEINFO_HELP_31.", ".ONLINEINFO_HELP_21.", ".ONLINEINFO_HELP_28.", ".ONLINEINFO_HELP_45.", ".ONLINEINFO_HELP_56.", ".ONLINEINFO_HELP_19.", ".ONLINEINFO_HELP_22.", ".ONLINEINFO_HELP_23.", ".ONLINEINFO_HELP_24.", ".ONLINEINFO_HELP_25.", ".ONLINEINFO_HELP_26.", ".ONLINEINFO_HELP_27."<br /><br />";
$eplug_compatible = "e107 v0.7.15";
$eplug_readme = "readme.txt";        // leave blank if no readme file
//$eplug_compliant = TRUE;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "onlineinfo_menu";

// Nane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "onlineinfo_menu";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/logo.png";
$eplug_icon_small = $eplug_folder . "/images/logo_small.png";
$eplug_caption =  "Configure Online Info";

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
        "onlineinfo_caption"=>"[Welcome User]",
		"onlineinfo_amigo"=> e_UC_MEMBER,
		"onlineinfo_amigo_hide"=>"1",
		"onlineinfo_coppermine"=>"0",
		"onlineinfo_guest"=>"1",
		"onlineinfo_downloads"=>"0",
		"onlineinfo_new_icon"=>"1",
		"onlineinfo_new_icontype"=>"new.gif",
		"onlineinfo_avatar"=>"1",
		"onlineinfo_formatbdays"=>"1",
		"onlineinfo_width"=>"95%",
		"onlineinfo_showforum"=> e_UC_MEMBER,
		"onlineinfo_forumno"=>"10",
		"onlineinfo_showicons"=>"1",
		"onlineinfo_showadmin"=>"1",
		"onlineinfo_border"=>"#000000",
		"onlineinfo_color"=>"#474642",
		"onlineinfo_guestbook"=>"0",
		"onlineinfo_hideadminarea"=>"1",
		"onlineinfo_content"=>"0",
		"onlineinfo_showregusers"=>e_UC_MEMBER,
		"onlineinfo_chatnum"=>"100",
		"onlineinfo_forumnum"=>"100",
		"onlineinfo_downloadnum"=>"30",
		"onlineinfo_guestbooknum"=>"100",
		"onlineinfo_copperminenum"=>"30",
		"onlineinfo_commentsnum"=>"100",
		"onlineinfo_copperminecommentsnum"=>"30",
		"onlineinfo_linksnum"=>"50",
		"onlineinfo_usersnum"=>"50",
		"onlineinfo_newsnum"=>"50",
		"onlineinfo_contentsnum"=>"50",
		"onlineinfo_hideuserrating"=>"1",
		"onlineinfo_userratingno"=>"10",
		"onlineinfo_whatsnewtype"=>"1",
		"onlineinfo_ibfuse"=>"0",
		"onlineinfo_ibfprefix"=>"ibf_",
		"onlineinfo_ibflocation"=>"forums",
		"onlineinfo_ibftime"=>"1",
		"onlineinfo_ibfshownum"=>"30",
		"onlineinfo_ibfpm"=>"0",
		"onlineinfo_flashchatuse"=>"0",
		"onlineinfo_flashchatprefix"=>"e107_",
		"onlineinfo_flashchatlocation"=>"chat",
		"onlineinfo_flashchatwindow"=>"e107",
		"onlineinfo_flashchatshow"=>e_UC_MEMBER,
		"onlineinfo_hideguest"=>"1",
		"onlineinfo_hideusers"=>"1",
		"onlineinfo_ibfautohide"=>"1",
		"onlineinfo_flashtext"=>"0",
		"onlineinfo_flashtext_colour"=>"red",
		"onlineinfo_chatbox"=>"1",
		"onlineinfo_forum"=>"1",
		"onlineinfo_hideadmin"=>"0",
		"onlineinfo_hideregusers"=>"0",
		"onlineinfo_showpmmsg"=>"1",
		"onlineinfo_rememberbuttons"=>"1",
		"onlineinfo_fontsize"=>"12",
		"onlineinfo_usernamefontsize"=>"12",
		"onlineinfo_ipchecker"=>"1",
		"onlineinfo_nolocations"=>"1",
		"onlineinfo_admincolour"=>"#ff0000",
		"onlineinfo_memcolour"=>"#ffffff",
		"onlineinfo_modcolour"=>"#ffff40",
		"onlineinfo_botchecker"=>"1",
		"onlineinfo_gallery2use"=>"1",
		"onlineinfo_gallery2prefix"=>"g2_",
		"onlineinfo_gallery2location"=>"gallery2",
		"onlineinfo_gallery2window"=>"e107",
		"onlineinfo_gallery2shownum"=>"10",
		"onlineinfo_smfuse"=>"0",
		"onlineinfo_smfprefix"=>"smf_",
		"onlineinfo_smflocation"=>"smf",
		"onlineinfo_smfwindow"=>"e107",
		"onlineinfo_smfshownum"=>"50",
		"onlineinfo_sound"=>"none",
		"onlineinfo_deleteme"=>"0",
		"onlineinfo_logindiag"=>"0",
		"onlineinfo_bavatar"=>"0",
		"onlineinfo_shownews"=>"1",
		"onlineinfo_youtubenum"=>"50",
		"onlineinfo_youtube"=>"0",
		"onlineinfo_forum_summary"=>"0",
		"onlineinfo_kroozearcade"=>"0",
		"onlineinfo_kroozearcadenum"=>"50",
		"onlineinfo_kroozearcadetop"=>"0",
		"onlineinfo_kroozearcadetopnum"=>"50",
		"onlineinfo_links"=>"1",
		"onlineinfo_members"=>"1",
		"onlineinfo_bugtracker3"=>"0",
		"onlineinfo_bugtracker3commentsnum"=>"50",
		"onlineinfo_hideifnonew"=>"0",
		"onlineinfo_headadmincolour"=>"#8080ff",
	"onlineinfo_sa_coppermineuse"=>"0",
	"onlineinfo_sa_coppermineprefix"=>"cpg_",
	"onlineinfo_sa_copperminelocation"=>"cpg",
	"onlineinfo_sa_copperminewindow"=>"e107",
	"onlineinfo_sa_coppermineshownum"=>"50",
	"onlineinfo_chatboxII"=>"0",
	"onlineinfo_chatIInum"=>"50",
	"onlineinfo_joke"=>"0",
	"onlineinfo_jokenum"=>"50",
	"onlineinfo_blog"=>"0",
	"onlineinfo_blognum"=>"50",
	"onlineinfo_suggestions"=>"0",
	"onlineinfo_suggestionsnum"=>"50",
	"onlineinfo_showcomments"=>"0",
	"onlineinfo_onoffcolour"=>"1",
	"onlineinfo_headadminactive"=>"1",
	"onlineinfo_adminactive"=>"1",
	"onlineinfo_memactive"=>"1",
	"onlineinfo_modactive"=>"1"
	);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array(
	"onlineinfo_friends",
	"onlineinfo_suspend",
	"onlineinfo_cache",
	"onlineinfo_read"
);

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array(
"CREATE TABLE IF NOT EXISTS ".MPREFIX."onlineinfo_friends (
  amigo_id int(10) unsigned NOT NULL auto_increment,
  amigo_user int(10) unsigned NOT NULL,
  amigo_amigo int(10) unsigned NOT NULL,
  PRIMARY KEY  (amigo_id)
) TYPE=MyISAM AUTO_INCREMENT=1;",


"CREATE TABLE IF NOT EXISTS ".MPREFIX."onlineinfo_suspend (
user_id INT NOT NULL ,
user_name varchar(100) NOT NULL default '' ,
ip varchar(20) NOT NULL default '' ,
PRIMARY KEY (user_id)
) TYPE=MyISAM;",


"CREATE TABLE IF NOT EXISTS ".MPREFIX."onlineinfo_cache (
  type varchar(50) NOT NULL default '',
  cache_name varchar(100) NOT NULL default '',
  cache text NOT NULL,
  cache_hide tinyint(1) NOT NULL default '0',
  cache_records int(11) NOT NULL default '0',
  cache_userclass int(10) NOT NULL default '0',
  cache_timestamp int(10) NOT NULL default '0',
  cache_active tinyint(1) NOT NULL default '0',
  type_order int(11) NOT NULL default '0',
  PRIMARY KEY  (type,cache_name,type_order)
) TYPE=MyISAM;",

"CREATE TABLE IF NOT EXISTS ".MPREFIX."onlineinfo_read (
  user_id int(10) NOT NULL default '0',
  news text NOT NULL,
  chatbox text NOT NULL,
  comments text NOT NULL,
  contents text NOT NULL,
  downloads text NOT NULL,
  guestbook text NOT NULL,
  pictures text NOT NULL,
  movies text NOT NULL,
  links text NOT NULL,
  sitemembers text NOT NULL,
  games text NOT NULL,
  game_top text NOT NULL,
  gallery text NOT NULL,
  ibf text NOT NULL,
  smf text NOT NULL,
  bug text NOT NULL,
  chatbox2 text NOT NULL,
  copper text NOT NULL,
  jokes text NOT NULL,
  blogs text NOT NULL,
  suggestions text NOT NULL,
  PRIMARY KEY  (user_id)
) ENGINE=MyISAM;
",

"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('birthday','Birthday Data Cache','',0,0,0,0,0,0);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('extraorder','ONLINEINFO_CACHEINFO_1','updated',0,0,253,0,0,1);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('extraorder','ONLINEINFO_CACHEINFO_2','topvisits',1,10,253,10,0,4);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('extraorder','ONLINEINFO_CACHEINFO_3','lastvisitors',1,10,253,0,0,3);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('extraorder','ONLINEINFO_CACHEINFO_4','birthday',1,10,253,1440,0,2);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('extraorder','ONLINEINFO_CACHEINFO_5','toppost',1,10,253,480,0,5);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('extraorder','ONLINEINFO_CACHEINFO_6','toppoststarter',1,10,253,480,0,6);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('extraorder','ONLINEINFO_CACHEINFO_7','toppostreplier',1,10,253,480,0,7);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('extraorder','ONLINEINFO_CACHEINFO_8','topratedmember',1,10,253,480,0,8);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('extraorder','ONLINEINFO_CACHEINFO_9','counter',0,0,0,0,0,9);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('order','ONLINEINFO_CACHEINFO_10','avatar.php',0,0,253,0,0,1);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('order','ONLINEINFO_CACHEINFO_11','fc.php',1,0,253,0,0,4);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('order','ONLINEINFO_CACHEINFO_12','pm.php',0,0,253,0,0,2);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('order','ONLINEINFO_CACHEINFO_13','amigo.php',1,0,253,0,0,5);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('order','ONLINEINFO_CACHEINFO_14','currentlyonline.php',0,0,0,0,0,3);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('order','ONLINEINFO_CACHEINFO_15','extrainfo.php',0,0,0,0,0,6);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('order','ONLINEINFO_CACHEINFO_16','tmembers.php',0,0,0,0,0,7);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('toppost','Top Poster Data Cache','',0,0,0,0,0,0);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('toppostreplier','Top Replier Data Cache','',0,0,0,0,0,0);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('toppoststarter','Top Starter Data Cache','',0,0,0,0,0,0);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('topratedmember','Top Rated Data Cache','',0,0,0,0,0,0);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('topvisits','Top Visitor Data Cache','',0,0,0,0,0,0);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('classcolour','Save the User Class Colours info','',0,0,0,0,0,0);"
);


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = FALSE;
$eplug_link_name = "";
$ec_dir = "";
$eplug_link_url = "";


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Go to the Online Info&acute;s Admin section and confirm your settings, then go to the menus screen and activate the menu";

// upgrading ... //

$ol_sql = new db();
if($ol_sql->db_Select("plugin", "plugin_version", "plugin_name='Online Info'")) {
   $ol_row = $ol_sql->db_Fetch();
} else {
   $ol_row = array("plugin_version" => "0");
}

if($ol_row["plugin_version"] == "7.20") {$eplug_upgrade_done = "Upgrade from this version not available, you will have to unistall and the install in full.";}

if($ol_row["plugin_version"] == "7.50") {

$upgrade_add_prefs = array(
	"onlineinfo_smfuse"=>"0",
	"onlineinfo_smfprefix"=>"smf_",
	"onlineinfo_smflocation"=>"smf",
	"onlineinfo_smfwindow"=>"e107",
	"onlineinfo_smfshownum"=>"50",
	"onlineinfo_sound"=>"none",
	"onlineinfo_deleteme"=>"0",
	"onlineinfo_logindiag"=>"0",
	"onlineinfo_bavatar"=>"0",
	"onlineinfo_shownews"=>"1",
	"onlineinfo_youtubenum"=>"50",
	"onlineinfo_youtube"=>"0",
	"onlineinfo_forum_summary"=>"0",
	"onlineinfo_kroozearcade"=>"0",
	"onlineinfo_kroozearcadenum"=>"50",
	"onlineinfo_kroozearcadetop"=>"0",
	"onlineinfo_kroozearcadetopnum"=>"50",
	"onlineinfo_links"=>"1",
	"onlineinfo_members"=>"1",
	"onlineinfo_bugtracker3"=>"0",
	"onlineinfo_bugtracker3commentsnum"=>"50",
	"onlineinfo_hideifnonew"=>"0",
	"onlineinfo_headadmincolour"=>"#8080ff",
	"onlineinfo_sa_coppermineuse"=>"0",
	"onlineinfo_sa_coppermineprefix"=>"cpg_",
	"onlineinfo_sa_copperminelocation"=>"cpg",
	"onlineinfo_sa_copperminewindow"=>"e107",
	"onlineinfo_sa_coppermineshownum"=>"50",
	"onlineinfo_chatboxII"=>"0",
	"onlineinfo_chatIInum"=>"50",
	"onlineinfo_joke"=>"0",
	"onlineinfo_jokenum"=>"50",
	"onlineinfo_blog"=>"0",
	"onlineinfo_blognum"=>"50",
	"onlineinfo_suggestions"=>"0",
	"onlineinfo_suggestionsnum"=>"50",
	"onlineinfo_showcomments"=>"0",
	"onlineinfo_onoffcolour"=>"1",
	"onlineinfo_headadminactive"=>"1",
	"onlineinfo_adminactive"=>"1",
	"onlineinfo_memactive"=>"1",
	"onlineinfo_modactive"=>"1"
		);

$upgrade_remove_prefs = "";

$upgrade_alter_tables = array(
"CREATE TABLE IF NOT EXISTS ".MPREFIX."onlineinfo_read (
  user_id int(10) NOT NULL default '0',
  news text NOT NULL,
  chatbox text NOT NULL,
  comments text NOT NULL,
  contents text NOT NULL,
  downloads text NOT NULL,
  guestbook text NOT NULL,
  pictures text NOT NULL,
  movies text NOT NULL,
  links text NOT NULL,
  sitemembers text NOT NULL,
  games text NOT NULL,
  game_top text NOT NULL,
  gallery text NOT NULL,
  ibf text NOT NULL,
  smf text NOT NULL,
  bug text NOT NULL,
  chatbox2 text NOT NULL,
  copper text NOT NULL,
  jokes text NOT NULL,
  blogs text NOT NULL,
  suggestions text NOT NULL,
  PRIMARY KEY  (user_id)
) ENGINE=MyISAM;
",

"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('order','ONLINEINFO_CACHEINFO_16','tmembers.php',0,0,0,0,0,7);",
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('classcolour','Save the User Class Colours info','',0,0,0,0,0,0);"
);

$eplug_upgrade_done = "Go to the Online Info&acute;s Admin section and confirm your settings as alot has changed.";
}

if($ol_row["plugin_version"] == "8.00") {
	$upgrade_add_prefs = array(
"onlineinfo_headadmincolour"=>"#8080ff",
	"onlineinfo_sa_coppermineuse"=>"0",
	"onlineinfo_sa_coppermineprefix"=>"cpg_",
	"onlineinfo_sa_copperminelocation"=>"cpg",
	"onlineinfo_sa_copperminewindow"=>"e107",
	"onlineinfo_sa_coppermineshownum"=>"50",
	"onlineinfo_chatboxII"=>"0",
	"onlineinfo_chatIInum"=>"50",
	"onlineinfo_joke"=>"0",
	"onlineinfo_jokenum"=>"50",
	"onlineinfo_blog"=>"0",
	"onlineinfo_blognum"=>"50",
	"onlineinfo_suggestions"=>"0",
	"onlineinfo_suggestionsnum"=>"50",
	"onlineinfo_showcomments"=>"0",
	"onlineinfo_onoffcolour"=>"1",
	"onlineinfo_headadminactive"=>"1",
	"onlineinfo_adminactive"=>"1",
	"onlineinfo_memactive"=>"1",
	"onlineinfo_modactive"=>"1"
);

$upgrade_alter_tables = array(
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('classcolour','Save the User Class Colours info','',0,0,0,0,0,0);",
"ALTER TABLE ".MPREFIX."onlineinfo_read ADD chatbox2 TEXT NOT NULL, ADD copper TEXT NOT NULL, ADD jokes TEXT NOT NULL, ADD blogs TEXT NOT NULL, ADD suggestions TEXT NOT NULL;"
);

$eplug_upgrade_done = "Upgrade done.";}


if($ol_row["plugin_version"] == "8.01") {
	$upgrade_add_prefs = array(
"onlineinfo_headadmincolour"=>"#8080ff",
	"onlineinfo_sa_coppermineuse"=>"0",
	"onlineinfo_sa_coppermineprefix"=>"cpg_",
	"onlineinfo_sa_copperminelocation"=>"cpg",
	"onlineinfo_sa_copperminewindow"=>"e107",
	"onlineinfo_sa_coppermineshownum"=>"50",
	"onlineinfo_chatboxII"=>"0",
	"onlineinfo_chatIInum"=>"50",
	"onlineinfo_joke"=>"0",
	"onlineinfo_jokenum"=>"50",
	"onlineinfo_blog"=>"0",
	"onlineinfo_blognum"=>"50",
	"onlineinfo_suggestions"=>"0",
	"onlineinfo_suggestionsnum"=>"50",
	"onlineinfo_showcomments"=>"0",
	"onlineinfo_onoffcolour"=>"1",
	"onlineinfo_headadminactive"=>"1",
	"onlineinfo_adminactive"=>"1",
	"onlineinfo_memactive"=>"1",
	"onlineinfo_modactive"=>"1"
);

$upgrade_alter_tables = array(
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('classcolour','Save the User Class Colours info','',0,0,0,0,0,0);",
"ALTER TABLE ".MPREFIX."onlineinfo_read ADD chatbox2 TEXT NOT NULL, ADD copper TEXT NOT NULL, ADD jokes TEXT NOT NULL, ADD blogs TEXT NOT NULL, ADD suggestions TEXT NOT NULL;"
);

$eplug_upgrade_done = "Upgrade done.";}

if($ol_row["plugin_version"] == "8.02") {

$upgrade_add_prefs = array(
"onlineinfo_headadmincolour"=>"#8080ff",
	"onlineinfo_sa_coppermineuse"=>"0",
	"onlineinfo_sa_coppermineprefix"=>"cpg_",
	"onlineinfo_sa_copperminelocation"=>"cpg",
	"onlineinfo_sa_copperminewindow"=>"e107",
	"onlineinfo_sa_coppermineshownum"=>"50",
	"onlineinfo_chatboxII"=>"0",
	"onlineinfo_chatIInum"=>"50",
	"onlineinfo_joke"=>"0",
	"onlineinfo_jokenum"=>"50",
	"onlineinfo_blog"=>"0",
	"onlineinfo_blognum"=>"50",
	"onlineinfo_suggestions"=>"0",
	"onlineinfo_suggestionsnum"=>"50",
	"onlineinfo_showcomments"=>"0",
	"onlineinfo_onoffcolour"=>"1",
	"onlineinfo_headadminactive"=>"1",
	"onlineinfo_adminactive"=>"1",
	"onlineinfo_memactive"=>"1",
	"onlineinfo_modactive"=>"1"
);

$upgrade_alter_tables = array(
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('classcolour','Save the User Class Colours info','',0,0,0,0,0,0);",
"ALTER TABLE ".MPREFIX."onlineinfo_read ADD chatbox2 TEXT NOT NULL, ADD copper TEXT NOT NULL, ADD jokes TEXT NOT NULL, ADD blogs TEXT NOT NULL, ADD suggestions TEXT NOT NULL;"
);

$eplug_upgrade_done = "Upgrade done.";

}

if($ol_row["plugin_version"] == "8.03") {


	$upgrade_add_prefs = array(
	"onlineinfo_sa_coppermineuse"=>"0",
	"onlineinfo_sa_coppermineprefix"=>"cpg_",
	"onlineinfo_sa_copperminelocation"=>"cpg",
	"onlineinfo_sa_copperminewindow"=>"e107",
	"onlineinfo_sa_coppermineshownum"=>"50",
	"onlineinfo_chatboxII"=>"0",
	"onlineinfo_chatIInum"=>"50",
	"onlineinfo_joke"=>"0",
	"onlineinfo_jokenum"=>"50",
	"onlineinfo_blog"=>"0",
	"onlineinfo_blognum"=>"50",
	"onlineinfo_suggestions"=>"0",
	"onlineinfo_suggestionsnum"=>"50",
	"onlineinfo_showcomments"=>"0",
	"onlineinfo_onoffcolour"=>"1",
	"onlineinfo_headadminactive"=>"1",
	"onlineinfo_adminactive"=>"1",
	"onlineinfo_memactive"=>"1",
	"onlineinfo_modactive"=>"1"
	);

$upgrade_alter_tables = array(
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('classcolour','Save the User Class Colours info','',0,0,0,0,0,0);",
"ALTER TABLE ".MPREFIX."onlineinfo_read ADD chatbox2 TEXT NOT NULL, ADD copper TEXT NOT NULL, ADD jokes TEXT NOT NULL, ADD blogs TEXT NOT NULL, ADD suggestions TEXT NOT NULL;"
);

$eplug_upgrade_done = "Upgrade done.";
}

if($ol_row["plugin_version"] == "8.04") {

	$upgrade_add_prefs = array(
	"onlineinfo_sa_coppermineuse"=>"0",
	"onlineinfo_sa_coppermineprefix"=>"cpg_",
	"onlineinfo_sa_copperminelocation"=>"cpg",
	"onlineinfo_sa_copperminewindow"=>"e107",
	"onlineinfo_sa_coppermineshownum"=>"50",
	"onlineinfo_chatboxII"=>"0",
	"onlineinfo_chatIInum"=>"50",
	"onlineinfo_joke"=>"0",
	"onlineinfo_jokenum"=>"50",
	"onlineinfo_blog"=>"0",
	"onlineinfo_blognum"=>"50",
	"onlineinfo_suggestions"=>"0",
	"onlineinfo_suggestionsnum"=>"50",
	"onlineinfo_showcomments"=>"0",
	"onlineinfo_onoffcolour"=>"1",
	"onlineinfo_headadminactive"=>"1",
	"onlineinfo_adminactive"=>"1",
	"onlineinfo_memactive"=>"1",
	"onlineinfo_modactive"=>"1"
	);


	$upgrade_alter_tables = array(
"INSERT INTO ".MPREFIX."onlineinfo_cache VALUES ('classcolour','Save the User Class Colours info','',0,0,0,0,0,0);",
"ALTER TABLE ".MPREFIX."onlineinfo_read ADD chatbox2 TEXT NOT NULL, ADD copper TEXT NOT NULL, ADD jokes TEXT NOT NULL, ADD blogs TEXT NOT NULL, ADD suggestions TEXT NOT NULL;"
);

$eplug_upgrade_done = "Upgrade done.";
}


/* Code for Colour table if test shows that Prefs are too slow

CREATE TABLE ".MPREFIX."onlineinfo_userclasses (
userclass_id TINYINT( 3 ) NOT NULL ,
colour VARCHAR( 7 ) NOT NULL DEFAULT '#000000',
priority INT NOT NULL DEFAULT '0',
PRIMARY KEY ( userclass_id )
)

*/



?>