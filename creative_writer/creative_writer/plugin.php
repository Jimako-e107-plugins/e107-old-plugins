<?php
// ***************************************************************
// *
// *		Title		:	Creative Writer
// *
// *		Author		:	Barry Keal
// *
// *		Date		:	25 December 2006
// *
// *		Version		:	1.01
// *
// *		Description	: 	Creative Writing
// *
// *		Revisions	:	25 December 2006
// *
// *		Support at	:	www.keal.me.uk
// *
// ***************************************************************
include_lan(e_PLUGIN . "creative_writer/languages/" . e_LANGUAGE . ".php");
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Creative Writer";
$eplug_version = "1.1.2";
$eplug_author = "Father Barry";
$eplug_url = "http://keal.me.uk";
$eplug_email = "";
$eplug_description = "Creative Writing Publisher";
$eplug_compatible = "e107v7";
$eplug_readme = "readme.pdf";	// leave blank if no readme file
$eplug_compliant=TRUE;
$eplug_status = TRUE;
$eplug_latest = true;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "creative_writer";

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = CWRITER_A1;

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon_small = $eplug_folder."/images/cwriter_16.png";
$eplug_icon = $eplug_folder."/images/cwriter_32.png";
$eplug_caption =  CWRITER_A64;

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs =array(
"cwriter_approval"=>255,
"cwriter_read"=>255,
"cwriter_create"=>255,
"cwriter_admin"=>255,
"cwriter_terms"=>"Don't write anything I don't like",
"cwriter_perpage"=>15,
"cwriter_pich"=>200,
"cwriter_picw"=>200,
"cwriter_currency"=>"&pound;",
"cwriter_metad"=>"Description",
"cwriter_metak"=>"Father barry's plugin,creative writer",
"cwriter_thumbs"=>1,
"cwriter_icons"=>1,
"cwriter_thumbheight"=>100,
"cwriter_userating"=>1,
"cwriter_usecomments"=>1,
"cwriter_dformat"=>"d-m-y"
);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array(
	"cw_book", "cw_category","cw_chapters","cw_genre","cw_review","cw_biography"
);

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array(
"CREATE TABLE ".MPREFIX."cw_book (
  cw_book_id int(11) unsigned NOT NULL auto_increment,
  cw_book_title varchar(50) NOT NULL default '',
  cw_book_summary varchar(200) default NULL,
  cw_book_logo varchar(100) default NULL,
  cw_book_author varchar(100) NOT NULL default '0.anon',
  cw_book_category int(11) unsigned NOT NULL default '0',
  cw_book_genre int(11) unsigned NOT NULL default '0',
  cw_book_characters text,
  cw_book_created int(11) unsigned NOT NULL default '0',
  cw_book_lastupdate int(11) unsigned NOT NULL default '0',
  cw_book_complete tinyint(3) unsigned NOT NULL default '0',
  cw_book_chapters int(11) unsigned NOT NULL default '0',
  cw_book_series int(11) unsigned NOT NULL default '0',
  cw_book_wordcount int(11) unsigned NOT NULL default '0',
  cw_book_warnings text,
  cw_book_views int(11) unsigned NOT NULL default '0',
  cw_book_disclaimer text NOT NULL,
  cw_book_rate tinyint(3) unsigned NOT NULL default '0',
  cw_book_review tinyint(3) unsigned NOT NULL default '0',
  cw_book_comments tinyint(3) unsigned NOT NULL default '0',
  cw_book_price decimal(10,2) unsigned NOT NULL default '0.00',
  cw_book_visible tinyint(3) unsigned NOT NULL default '0',
  cw_book_approved tinyint(3) unsigned NOT NULL default '0',
  cw_book_unique int(11) unsigned NOT NULL default '0',
  cw_book_viewers text NOT NULL,
  cw_book_language varchar(11) NOT NULL default 'English',
  PRIMARY KEY  (cw_book_id),
  KEY cw_book_title (cw_book_title),
  KEY cw_book_summary (cw_book_summary)
) TYPE=MyISAM;",
"CREATE TABLE ".MPREFIX."cw_category (
  cw_category_id int(11) unsigned NOT NULL auto_increment,
  cw_category_name varchar(50) NOT NULL default '',
  cw_category_icon varchar(100) default NULL,
  cw_category_lastupdated int(11) unsigned NOT NULL default '0',
  cw_category_class int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (cw_category_id),
  KEY cw_category_name (cw_category_name)
) TYPE=MyISAM;
",
"CREATE TABLE ".MPREFIX."cw_chapters (
  cw_chapter_id int(11) unsigned NOT NULL auto_increment,
  cw_chapter_title varchar(100) NOT NULL default '',
  cw_chapter_number int(11) unsigned NOT NULL default '0',
  cw_chapter_body mediumtext,
  cw_chapter_created int(11) unsigned NOT NULL default '0',
  cw_chapter_lastupdate int(11) unsigned NOT NULL default '0',
  cw_chapter_book int(11) unsigned NOT NULL default '0',
  cw_chapter_author varchar(100) NOT NULL default '',
  cw_chapter_wordcount int(11) unsigned NOT NULL default '0',
  cw_chapter_views int(11) unsigned NOT NULL default '0',
  cw_chapter_payfor tinyint(3) unsigned NOT NULL default '0',
  cw_chapter_prev int(11) unsigned NOT NULL default '0',
  cw_chapter_next int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (cw_chapter_id),
  KEY cw_chapter_title (cw_chapter_title)
) TYPE=MyISAM;",
"CREATE TABLE ".MPREFIX."cw_genre (
  cw_genre_id int(11) unsigned NOT NULL auto_increment,
  cw_genre_name varchar(40) NOT NULL default '',
  cw_genre_icon varchar(100) default NULL,
  cw_genre_lastupdated int(11) unsigned default NULL,
  PRIMARY KEY  (cw_genre_id),
  KEY cw_genre_name (cw_genre_name)
) TYPE=MyISAM;",
"CREATE TABLE ".MPREFIX."cw_review (
  cw_review_id int(11) unsigned NOT NULL auto_increment,
  cw_review_book int(11) unsigned default NULL,
  cw_reviewer varchar(100) NOT NULL default '',
  cw_review text,
  cw_review_rate tinyint(3) unsigned NOT NULL default '0',
  cw_review_posted int(11) unsigned default NULL,
  PRIMARY KEY  (cw_review_id)
) TYPE=MyISAM;
",
"CREATE TABLE ".MPREFIX."cw_biography (
  cw_bio_id int(11) unsigned NOT NULL default '0',
  cw_bio_name varchar(100) NOT NULL default '',
  cw_bio_picture varchar(100) default NULL,
  cw_bio_biography text,
  cw_bio_email varchar(100) default NULL,
  cw_bio_contact text,
  PRIMARY KEY  (cw_bio_id)
) TYPE=MyISAM;");


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = CWRITER_A1;
$eplug_link_url = e_PLUGIN."creative_writer/cwriter.php";


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = CWRITER_A65;
// upgrading ... //

$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$upgrade_alter_tables = "";

$eplug_upgrade_done = "";
?>