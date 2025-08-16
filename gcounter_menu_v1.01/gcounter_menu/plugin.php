<?php
//***************************************************************
//* 
//*		Title		:	Graphical Counter Menu
//*		
//*		Author		:	Barry Keal
//*
//*		Date		:	1 December 2004
//*
//*		Version		:	1.01
//*
//*		Description	: 	Graphical Counter Menu
//*
//*****************************************************************
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Graphical Counter";
$eplug_version = "1.01";
$eplug_author = "Bazzer";
$eplug_logo = "/images/gcount.png";
$eplug_url = "";
$eplug_email = "";
$eplug_description = "Graphical Counter Menu";
$eplug_compatible = "e107 v617+";
$eplug_readme = "readme.rtf";	// leave blank if no readme file
$eplug_compliant = TRUE; 

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "gcounter_menu";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "gcounter_menu";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "adminconfig.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/gcount.png";
$eplug_caption =  "Configure Graphical Counter Menu";

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
	"gcount_mode"=>"1",
	"gcount_random"=>"0",
	"gcount_current"=>"1"
);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("gcount_digits");

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array(
"CREATE TABLE ".MPREFIX."gcount_digits (
  gcount_digit_id int(10) unsigned NOT NULL auto_increment,
  gcount_digit_name varchar(50) NOT NULL default '',
  gcount_digit_postfix varchar(20) NOT NULL default '',
  gcount_digit_width int(10) unsigned NOT NULL default '0',
  gcount_digit_height int(10) unsigned NOT NULL default '0',
  gcount_digit_pad tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (gcount_digit_id),
  UNIQUE KEY gcount_digit_id (gcount_digit_id),
  KEY gcount_digit_id_2 (gcount_digit_id)
) TYPE=MyISAM COMMENT='gcount digit information';",
"INSERT INTO ".MPREFIX."gcount_digits (gcount_digit_id, gcount_digit_name, gcount_digit_postfix, gcount_digit_width, gcount_digit_height, gcount_digit_pad) VALUES(\"1\", \"Jelly\", \"JELLY.GIF\", \"24\", \"35\", \"6\");",
"INSERT INTO ".MPREFIX."gcount_digits (gcount_digit_id, gcount_digit_name, gcount_digit_postfix, gcount_digit_width, gcount_digit_height, gcount_digit_pad) VALUES(\"2\", \"Blocks\", \"CB.GIF\", \"40\", \"40\", \"5\");",
"INSERT INTO ".MPREFIX."gcount_digits (gcount_digit_id, gcount_digit_name, gcount_digit_postfix, gcount_digit_width, gcount_digit_height, gcount_digit_pad) VALUES(\"4\", \"Calculator\", \"HP41.GIF\", \"30\", \"40\", \"5\");",
"INSERT INTO ".MPREFIX."gcount_digits (gcount_digit_id, gcount_digit_name, gcount_digit_postfix, gcount_digit_width, gcount_digit_height, gcount_digit_pad) VALUES(\"5\", \"CRT\", \"CRT.GIF\", \"17\", \"28\", \"6\");",
"INSERT INTO ".MPREFIX."gcount_digits (gcount_digit_id, gcount_digit_name, gcount_digit_postfix, gcount_digit_width, gcount_digit_height, gcount_digit_pad) VALUES(\"6\", \"Flame\", \"FLAME.GIF\", \"30\", \"40\", \"5\");",
"INSERT INTO ".MPREFIX."gcount_digits (gcount_digit_id, gcount_digit_name, gcount_digit_postfix, gcount_digit_width, gcount_digit_height, gcount_digit_pad) VALUES(\"7\", \"Floppy\", \"FLOPPY.GIF\", \"36\", \"32\", \"5\");",
"INSERT INTO ".MPREFIX."gcount_digits (gcount_digit_id, gcount_digit_name, gcount_digit_postfix, gcount_digit_width, gcount_digit_height, gcount_digit_pad) VALUES(\"8\", \"Katt 028\", \"KATT028.GIF\", \"34\", \"44\", \"5\");",
"INSERT INTO ".MPREFIX."gcount_digits (gcount_digit_id, gcount_digit_name, gcount_digit_postfix, gcount_digit_width, gcount_digit_height, gcount_digit_pad) VALUES(\"9\", \"Katt 127\", \"KATT127.GIF\", \"23\", \"42\", \"5\");",
"INSERT INTO ".MPREFIX."gcount_digits (gcount_digit_id, gcount_digit_name, gcount_digit_postfix, gcount_digit_width, gcount_digit_height, gcount_digit_pad) VALUES(\"10\", \"Xmas Tree\", \"TREE.GIF\", \"35\", \"50\", \"5\");",
"INSERT INTO ".MPREFIX."gcount_digits (gcount_digit_id, gcount_digit_name, gcount_digit_postfix, gcount_digit_width, gcount_digit_height, gcount_digit_pad) VALUES(\"11\", \"ZX80 Keyboard\", \"ZX80.GIF\", \"42\", \"31\", \"4\");",
"INSERT INTO ".MPREFIX."gcount_digits (gcount_digit_id, gcount_digit_name, gcount_digit_postfix, gcount_digit_width, gcount_digit_height, gcount_digit_pad) VALUES(\"12\", \"Snowman\", \"SNOWM.GIF\", \"27\", \"37\", \"5\");",
"INSERT INTO ".MPREFIX."gcount_digits (gcount_digit_id, gcount_digit_name, gcount_digit_postfix, gcount_digit_width, gcount_digit_height, gcount_digit_pad) VALUES(\"13\", \"Hearts\", \"HEART.GIF\", \"27\", \"37\", \"5\");",
"INSERT INTO ".MPREFIX."gcount_digits (gcount_digit_id, gcount_digit_name, gcount_digit_postfix, gcount_digit_width, gcount_digit_height, gcount_digit_pad) VALUES(\"14\", \"Turf\", \"TURF.GIF\", \"29\", \"40\", \"5\");");


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = false;
$eplug_link_name = "";
$eplug_link_url = "";


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Go to the administration page to configure, then activate the menu";

// upgrading ... //

$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";
// 
$upgrade_alter_tables = "";

$eplug_upgrade_done = "";

?>	