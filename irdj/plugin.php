 <?php

########################################
# IRDJ (e107) BY MARTINJ  | VERSION 1.2 | January 2008		#
# For e107 website system - e107.org | http://www.irdj.co.uk		#
# email martinleeds AT googlemail.com					#
########################################

  if (!defined('e107_INIT')) { exit; }
 
 // Plugin info  
 $eplug_name    = "IRDJ";
 $eplug_version = "1.2";
 $eplug_author  = "Martinj";
 $eplug_url = "http://www.martinj.co.uk";
 $eplug_email = "martinleeds@googlemail.com";
 
 $eplug_description="IRDJ - DJ Schedule & Profile management system for Internet Radio websites.";
 $eplug_compatible  = "e107 v0.7+";
 $eplug_readme      = "readme.txt";        
 
 // Name of the plugin's folder
 $eplug_folder = "irdj";
 
 // Mane of menu item for plugin  
 $eplug_menu_name = "irdj_menu";
 
$eplug_icon = $eplug_folder."/icon_32.png";
$eplug_icon_small = $eplug_folder."/icon_16.png";
 
 // Name of the admin configuration file  
 $eplug_conffile = "irdj_admin.php";
 
 // List of preferences 
 $eplug_prefs       = "";
 $eplug_table_names = ""; 
 
 // Create a link in main menu (yes=TRUE, no=FALSE) 
$eplug_link = TRUE;
$eplug_link_name = "Schedule";
$eplug_link_url = e_PLUGIN."irdj/irdj_page.php";
$eplug_link_perms = "Everyone"; // Optional: Guest, Member, Admin, Everyone

// List of sql requests to create tables 
$eplug_tables = array("DROP TABLE IF EXISTS ".$mySQLprefix."irdjprofile_admin", 
"DROP TABLE IF EXISTS ".$mySQLprefix."irdj_config", 
"DROP TABLE IF EXISTS ".$mySQLprefix."irdj", 
"DROP TABLE IF EXISTS ".$mySQLprefix."irdj_config",
"CREATE TABLE ".$mySQLprefix."irdj
(
id int NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
day int(11),
time varchar(20),
dj_name varchar(30),
genre varchar(60),
link varchar(60)
)", "CREATE TABLE ".$mySQLprefix."irdj_config 
(
show_genre int(11) default '1',
show_border int(11) default '1',
show_links int(11) default '0',
page_text text
)",
"INSERT INTO ".$mySQLprefix."irdj_config VALUES (1, 1, 0, '')",
"CREATE TABLE ".$mySQLprefix."irdjprofile_admin 
(
id int NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
dj_id int(11),
dj_name varchar(60),
dj_intro text,
dj_body text,
dj_age varchar(3),
dj_location varchar(30),
dj_genre varchar(50),
dj_photo varchar(60),
dj_theme int(11) default '0'
)");

 // Text to display after plugin successfully installed 
 $eplug_done           = "Installation Successful.. now goto the admin area to enter your schedule info!!  .... ";
 $eplug_uninstall_done = "Uninstalled Successfully..";
 
 ?>