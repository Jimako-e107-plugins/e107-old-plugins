<?php
//***************************************************************
//*
//*		Title		:	Meeting Room Booking System (MRBS))
// 					: Original program mrbs.sourceforge.net
//*					: Modified for use on e107 by B Keal
//*
//*		Modified by	:	Barry Keal
//*
//*		Date		:	11 March 2004
//*
//*		Version		:	1.01
//*
//*		Description	: 	Room Booking System
//*
//*		Revisions	:
//*
//***************************************************************

## First port of MRBS to e107

//**************************************************************************
//*
//*  MRBS configuration for e107 v6xx
//*
//**************************************************************************
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Room Booking System two";
$eplug_version = "1.03";
$eplug_author = "ian beaver";
$eplug_logo = "/images/rooms.png";
$eplug_url = "";
$eplug_email = "rooms@keal.org.uk";
$eplug_description = "Meeting Room Booking System.";
$eplug_compatible = "e107v6";
$eplug_readme = "readme.txt";	// leave blank if no readme file

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "Bookroom";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "BMRBS";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/rooms.png";
$eplug_caption =  "Configure Meeting Room Bookings Plugin";

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
	"mrbs_adminclass"=>"",
	"mrbs_viewclass"=>"",
	"mrbs_bookclass"=>"",
	"mrbs_frameheight"=>"1000",
	"mrbs_sendconfirm"=>"1",
	"mrbs_admin"=>"",
	"mrbs_admin_email" => "ian.beaver@mgeups.com",
	"mrbs_company" => "",
	"mrbs_resolution" => "1800",
	"mrbs_morningstarts" => "7",
	"mrbs_eveningends"=> "19",
	"mrbs_eveningends_minutes" => "0",
	"mrbs_weekstarts" => "0",
	"mrbs_dateformat" => "0",
	"mrbs_twentyfourhour_format" => "1",
	"mrbs_max_rep_entrys" => "366",
	"mrbs_default_report_days" => "60",
	"mrbs_refresh_rate" => "0",
	"mrbs_area_list_format" => "list",
	"mrbs_monthly_view_brief_description" => "TRUE",
	"mrbs_view_week_number" => "FALSE",
	"mrbs_typeA" => "Demo",
	"mrbs_typeB" => "Conferance",
	"mrbs_typeC" => "",
	"mrbs_typeD" => "",
	"mrbs_typeE" => "",
	"mrbs_typeF" => "",
	"mrbs_typeG" => "",
	"mrbs_typeH" => "",
	"mrbs_typeI" => "",
	"mrbs_typeJ" => "",
	"mrbs_userdef1"=>"Projector",
	"mrbs_userdef2"=>"",
	"mrbs_userdef3"=>"",
	"mrbs_userdef4"=>"",
	"mrbs_userdef5"=>"",

);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("mrbs_area","mrbs_room","mrbs_entry","mrbs_repeat");

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array("CREATE TABLE ".MPREFIX."mrbs_area
(	id int(10) NOT NULL auto_increment,
  area_name varchar(30) DEFAULT NULL,
 area_admin_email text,
  PRIMARY KEY (id)
) TYPE=MyISAM;",

"CREATE TABLE ".MPREFIX."mrbs_room
(
  id          int(10) NOT NULL auto_increment,
  area_id     int (10) DEFAULT 0 NOT NULL,
  room_name   varchar(25) DEFAULT '' NULL,
  description varchar(60) DEFAULT '' NULL,
  capacity    int(10) DEFAULT 0 NOT NULL,
  room_admin_email text,
  PRIMARY KEY (id)
) TYPE=MyISAM;",

"CREATE TABLE ".MPREFIX."mrbs_entry
(
  id          int(10)  NOT NULL auto_increment,
  start_time  int(10) DEFAULT 0 NOT NULL,
  end_time    int(10) DEFAULT 0 NOT NULL,
  entry_type  int(10) DEFAULT 0 NOT NULL,
  repeat_id   int(10) DEFAULT 0 NOT NULL,
  room_id     int(10) DEFAULT 1 NOT NULL,
  timestamp   timestamp,
  create_by   varchar(25) DEFAULT '' NOT NULL,
  name        varchar(80) DEFAULT '' NOT NULL,
  type        char DEFAULT 'E' NOT NULL,
  description text,
  userdef1 tinyint default 0 not null,
  userdef2 tinyint default 0 not null,
  userdef3 tinyint default 0 not null,
  userdef4 tinyint default 0 not null,
  userdef5 tinyint default 0 not null,

  PRIMARY KEY (id),
  KEY idxStartTime (start_time),
  KEY idxEndTime   (end_time)

) TYPE=MyISAM;",
"CREATE TABLE ".MPREFIX."mrbs_repeat
(
  id          int DEFAULT '0' NOT NULL auto_increment,
  start_time  int DEFAULT '0' NOT NULL,
  end_time    int DEFAULT '0' NOT NULL,
  rep_type    int DEFAULT '0' NOT NULL,
  end_date    int DEFAULT '0' NOT NULL,
  rep_opt     varchar(32) DEFAULT '' NOT NULL,
  room_id     int DEFAULT '1' NOT NULL,
  timestamp   timestamp,
  create_by   varchar(25) DEFAULT '' NOT NULL,
  name        varchar(80) DEFAULT '' NOT NULL,
  type        char DEFAULT 'E' NOT NULL,
  description text,
  rep_num_weeks tinyint DEFAULT '' NULL,

  PRIMARY KEY (id)

) TYPE=MyISAM;"
);


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = "Room Booking";
$eplug_link_url = e_PLUGIN."mrbs/mrbs.php";


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "A link in your main navigation menu has been created to the main Room Booking screen. Before using you MUST configure the system";

// upgrading ... //

$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = "";

?>