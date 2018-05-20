<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Public News               #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/



$eplug_name = "AACGC Public News";
$eplug_version = "1.9";
$eplug_author = "M@CH!N3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Allows users, guests, or userclasses submit news posts and lists them on pages and menus.";
$eplug_compatible = "";
$eplug_readme = "";
$eplug_compliant = FALSE;
$eplug_module = FALSE;
$eplug_status = FALSE;
$eplug_latest = FALSE;


$eplug_folder      = "aacgc_pnews";

$eplug_menu_name   = "pnews_menu";

$eplug_conffile    = "admin_main.php";

$eplug_logo        = "";
$eplug_icon        = e_PLUGIN."aacgc_pnews/images/icon_32.png";
$eplug_icon_small  = e_PLUGIN."aacgc_pnews/images/icon_16.png";
$eplug_icon_custom = e_PLUGIN."aacgc_pnews/images/icon_64.png";

$eplug_caption     = "AACGC Public News";  

$eplug_prefs = array(
"pnews_cat_header" => "Public News",
"pnews_cat_headerfsize" => "5",
"pnews_cat_intro" => "Public News Area",
"pnews_cat_introfsize" => "2",
"pnews_cat_catfsize" => "3",
"pnews_cat_shownewssec" => "1",
"pnews_cat_newstfsize" => "2",
"pnews_cat_newsimgsize" => "50",
"pnews_cat_infochoice" => "summary",
"pnews_cat_newsdesclimit" => "200",
"pnews_cat_newscount" => "5",
"pnews_cat_newssecheight" => "200",
"pnews_catm_menutitle" => "Public News Categories",
"pnews_catm_menuheight" => "200",
"pnews_catm_catfsize" => "3",
"pnews_catm_shownews" => "0",
"pnews_catm_newstfsize" => "1",
"pnews_catm_newsimgsize" => "30",
"pnews_catm_newscount" => "5",
"pnews_news_catfsize" => "5",
"pnews_news_newstfsize" => "3",
"pnews_news_newsimgsize" => "100",
"pnews_news_infochoice" => "summary",
"pnews_news_newsdesclimit" => "200",
"pnews_newsm_menutitle" => "Public News",
"pnews_newsm_menuheight" => "200",
"pnews_newsm_newscount" => "10",
"pnews_newsm_newstfsize" => "3",
"pnews_newsm_newsimgsize" => "100",
"pnews_newsm_newsdesclimit" => "200",
"pnews_newsm_infochoice" => "summary",
"pnews_det_newstfsize" => "5",
"pnews_det_newsimgsize" => "200",
"pnews_archm_menutitle" => "Public News Archive",
"pnews_archm_menuheight" => "200",
"pnews_archm_newscount" => "25",
"pnews_archm_newstfsize" => "1",
"pnews_archm_newsimgsize" => "25",
"pnews_enable_theme" => "1",
"pnews_enable_submit" => "0",
"pnews_enable_useredit" => "1",
"pnews_userclass" => "members",
"pnews_moderators" => "",
"pnews_filesize" => "500000",
"pnews_pmuser" => "1",
"pnews_sum_limit" => "200",
"pnews_shownewssec" => "1",
"pnews_enable_pmnote" => "1",
"pnews_showemptysum" => "1",
"pnews_dateformat" => "M d, Y h:ia",
"pnews_dateoffset" => "+0",
);

$eplug_table_names = array("aacgc_pnews", "aacgc_pnews_cat", "aacgc_pnews_submitted", "aacgc_pnews_comments", "aacgc_pnews_counter");

$eplug_tables = array(
"CREATE TABLE ".MPREFIX."aacgc_pnews(news_id int(11) NOT NULL auto_increment,news_title varchar(100) NOT NULL,news_sum text NOT NULL,news_desc text NOT NULL,news_img varchar(120) NOT NULL,news_cat int(10) unsigned NOT NULL,news_author int(5) NOT NULL,news_date text NOT NULL, PRIMARY KEY  (news_id)) ENGINE=MyISAM;",
"CREATE TABLE ".MPREFIX."aacgc_pnews_cat(news_cat_id int(11) NOT NULL auto_increment,news_cat_title varchar(100) NOT NULL,news_cat_desc text NOT NULL, PRIMARY KEY  (news_cat_id)) ENGINE=MyISAM;",
"CREATE TABLE ".MPREFIX."aacgc_pnews_submitted(news_sub_id int(11) NOT NULL auto_increment,news_sub_title varchar(100) NOT NULL,news_sub_sum text NOT NULL,news_sub_desc text NOT NULL,news_sub_img varchar(120) NOT NULL,news_sub_cat int(10) unsigned NOT NULL,news_sub_author int(5) NOT NULL,news_sub_date text NOT NULL, PRIMARY KEY  (news_sub_id)) ENGINE=MyISAM;",
"CREATE TABLE ".MPREFIX."aacgc_pnews_comments(news_com_id int(11) NOT NULL auto_increment,news_com_comment text NOT NULL,news_com_newsid int(10) unsigned NOT NULL,news_com_author int(5) NOT NULL,news_com_date text NOT NULL, PRIMARY KEY  (news_com_id)) ENGINE=MyISAM;",
"CREATE TABLE ".MPREFIX."aacgc_pnews_counter(countid int(11) NOT NULL auto_increment,counter int(11) NOT NULL default '1',page text default NULL,visitor varchar(30) default NULL, PRIMARY KEY  (countid)) ENGINE=MyISAM;",
);

$eplug_link      = TRUE;
$eplug_link_name = "Public News";
$eplug_link_url  = e_PLUGIN."aacgc_pnews/News_Categories.php";

$eplug_done = "Install Complete";
$eplug_upgrade_done = "Upgrade Complete";

$upgrade_alter_tables = "";

$upgrade_remove_prefs = "";
$upgrade_add_prefs = "";

?>
