<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        http://e107.org
|
|        PView Gallery by R.F. Carter
|        ronald.fuchs@hhweb.de
+---------------------------------------------------------------+
*/
// Include plugin language file, check first for site's preferred language
if (file_exists(e_PLUGIN . "pviewgallery/languages/" . e_LANGUAGE . ".php")){
include_once(e_PLUGIN."pviewgallery/languages/".e_LANGUAGE.".php");
}
else
{
include_once(e_PLUGIN . "pviewgallery/languages/German.php");
}

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "PView Gallery";
$eplug_version = "1.7B";
$eplug_author = "Ronald Fuchs (R.F. Carter)";
$eplug_folder = "pviewgallery";
$eplug_logo = $eplug_folder."images/icon_32.png";
$eplug_url = "http://hhweb.de";
$eplug_email = "ronald.fuchs@hhweb.de";
$eplug_description = LAN_INSTALL_6;
$eplug_compatible = "e107v0.716+";
$eplug_readme = "admin_readme.php";        // leave blank if no readme file
$eplug_status = true;
$eplug_latest = true;


// Find current version for upgrade stuff
include_once("../../class2.php");
$pv_SQL = new db;
$pv_SQL->db_Select("plugin", "plugin_version", "plugin_name='PView Gallery' AND plugin_installflag > 0");
if(list($pviewGalVer) = $pv_SQL->db_Fetch()) {
	$pviewGalVer = preg_replace("/[a-zA-z\s]/", '', $pviewGalVer);
} else {
	$pviewGalVer = "0";
}

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "PView Gallery";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/icon_32.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";
$eplug_caption =  "Configure PView Gallery";

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = "PView Gallery";
$eplug_link_url = e_PLUGIN . "pviewgallery/pviewgallery.php";

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = LAN_INSTALL_1;
$eplug_uninstall_done = LAN_INSTALL_2;

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("pview_album",
							"pview_config",
							"pview_gallery",
							"pview_image",
							"pview_rating",
							"pview_comment",
							"pview_cat",
							"pview_tmpip",
							"pview_featured"
							);

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array(
"CREATE TABLE `".MPREFIX."pview_album` (
  `albumId` int(10) unsigned NOT NULL auto_increment,
  `galleryId` int(10) unsigned default NULL,
  `parentAlbumId` int(10) unsigned default NULL,
  `name` varchar(60) default NULL,
  `description` mediumtext,
  `albumImage` varchar(100) default NULL,
  `permUpload` varchar(100) default NULL,
  `permEdit` varchar(100) default NULL,
  `permView` varchar(100) default NULL,
  `permCreateAlbum` varchar(100) default NULL,
  PRIMARY KEY  (`albumId`)
);",
"CREATE TABLE `".MPREFIX."pview_config` (
  `configName` varchar(25) NOT NULL default '',
  `configValue` varchar(60) default NULL,
  PRIMARY KEY  (`configName`)
);",
"CREATE TABLE `".MPREFIX."pview_gallery` (
  `galleryId` int(10) unsigned NOT NULL default '0',
  `name` varchar(60) default NULL,
  `active` tinyint(1) default NULL,
  `permEdit` varchar(100) default NULL,
  `permView` varchar(100) default NULL,
  `permCreateAlbum` varchar(100) default NULL,
  PRIMARY KEY  (`galleryId`)
);",
"CREATE TABLE `".MPREFIX."pview_image` (
  `imageId` int(10) unsigned NOT NULL auto_increment,
  `albumId` int(10) unsigned NOT NULL default '0',
  `name` varchar(60) default NULL,
  `description` mediumtext,
  `filename` varchar(100) default NULL,
  `filenameResized` varchar(100) default NULL,
  `thumbnail` varchar(100) default NULL,
  `uploaderUserId` varchar(10) default NULL,
  `uploadDate` int(11) default NULL,
  `approved` tinyint(1) default NULL,
  `permEdit` varchar(100) default NULL,
  `permView` varchar(100) default NULL,
  `views` int(10) default '0',
  `cat` int(10) default '0',
  `sendImage` tinyint(1) NOT NULL default '0',
  `externalImage` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`imageId`)
);",
"CREATE TABLE `".MPREFIX."pview_comment` (
  `commentId` int(10) unsigned NOT NULL auto_increment,
  `commente107userId` int(10) unsigned NOT NULL default '0',
  `commentDate` int(11) default NULL,
  `commentText` mediumtext,
  `commentImageId` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`commentId`)
);",
"CREATE TABLE `".MPREFIX."pview_rating` (
  `ratingId` int(10) unsigned NOT NULL auto_increment,
  `rating107userId` int(10) unsigned NOT NULL default '0',
  `ratingDate` int(11) default NULL,
  `ratingValue` int(5) default NULL,
  `ratingImageId` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`ratingId`)
);",
"CREATE TABLE `".MPREFIX."pview_tmpip` (
  `ip_addr` varchar(20) NOT NULL default '0',
  `images` mediumtext default NULL,
  `time` varchar(12) default NULL,
  PRIMARY KEY  (`ip_addr`)
);",
"CREATE TABLE `".MPREFIX."pview_cat` (
  `catId` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(60) default NULL,
  `description` mediumtext default NULL,
  `icon` varchar(250) default NULL,
  PRIMARY KEY  (`catId`)
);",
"CREATE TABLE `".MPREFIX."pview_featured` (
  `imageId` int(10) NOT NULL,
  `albumId` int(10) NOT NULL,
  `calDay` varchar(12) NOT NULL default '0',
  `isNominated` tinyint(1) NOT NULL,
  `isFeatured` tinyint(1) NOT NULL,
  PRIMARY KEY  (`imageId`,`albumId`,`calDay`)
);",

// pview config, main gallery defaults
"INSERT INTO `".MPREFIX."pview_config` VALUES ('member_galleries', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('pview_name', 'PView Gallery');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('resize_images', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('max_image_width', '640');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('max_image_height', '480');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('create_thumb', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('thumb_width', '100');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('thumb_height', '100');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('keep_original_image', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('permRating', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('permComment', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('template', 'original');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('usergallery_name', 'Membergalleries');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('permCreateGallery', 'MEMBER');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('pics_per_row', '4');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('pics_per_page', '16');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('viewControl_by', 'session');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('admin_Mode', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('Rating', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('Comments', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('Comment_simple', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('ip_valid_time', '1800');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('comments_per_page', '10');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('usergallery_limit', '');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('approval', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('file_limit', '1024');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('scroll_speed', '20');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('menu_dir', 'vert');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('menu_allGal', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('force_imageSize', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('force_Width', '80');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('force_Height', '80');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('menu_pics', '2,5');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('menu_display', 'latest');",
"INSERT INTO `".MPREFIX."pview_gallery` VALUES ('0', 'main gallery', '1', '0', 'ALL', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('album_dir', 'ASC');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('menu_comm_count', '5');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('menu_comm_length', '40');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('email', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('pdf', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('print', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('permEmail', 'MEMBER');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('permPdf', 'MEMBER');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('permPrint', 'ALL');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('permBatch', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('search_lightbox', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('menu_lightbox', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('batch_use_filename', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('chmod', '');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('album_sort', 'uploadDate');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('album_details', 'name|descr|user');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('gal_cols', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('cat_sort', 'name');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('cat_details', 'name|date|album');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('user_sort', 'views');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('user_details', 'name|views|comm|rating');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('viewer_sort', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('details_link', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('gal_details', 'name|descr|info|edit');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('img_details', 'name|descr|date|size|dim|user|rating|views|cat');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('seo_links', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('center_thumbs', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('start_page', 'classic');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('permExtern', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_short', '1|1|0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_album', '3|4|1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_cat', '4|4|0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_comm', '6|4|0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_img', '5|4|1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_imgRating', '7|4|0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_imgViews', '8|4|0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_Uploader', '9|4|0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_userComm', '10|4|0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_userGals', '2|4|0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('profile_ImgCount', '8');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('profile_ImgOrder', 'RAND');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('profile_ImgCols', '4');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('profile_CommCount', '8');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('profile_CommCols', '4');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('profile_CommPreview', '20');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('profileImg_lightbox', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('profileComm_lightbox', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('img_Link_gal_extJS', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('img_Link_menu_extJS', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('img_Link_profileCom_extJS', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('img_Link_profileImg_extJS', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('img_Link_search_extJS', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('img_Link_extJS', 'noscript');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('img_Link_extJS_pview', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('feature_dir', 'vert');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('permNominate', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('Nominate', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('maxImageNom', '10');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('maxAlbumNom', '10');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('NomFeature', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_FeatureAlbum', '11|4|0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_FeatureImg', '12|4|0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('watermark', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_usergal', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_adminmode', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_orig', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_thumb', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_resize', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_opacity', '30');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_pos', 'ctr');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_decr', '1');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_typ', 'img');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_image', 'pview.gif');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_text', 'PView © USERNAME');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_color', 'FC761C');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_font', 'arial.ttf');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_fontsize', '15');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_angle', '0');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_padding', '40');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('comViewMenu', 'imgcomm');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('cacheInt', '5');",
"INSERT INTO `".MPREFIX."pview_config` VALUES ('cacheON', '0');"
);

// Upgrade Plugin
$upgrade_alter_tables = array();
if ($pviewGalVer < "0.92") {
	array_push($upgrade_alter_tables,
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('album_dir', 'ASC');"
	);
}
if ($pviewGalVer < "0.93") {
	array_push($upgrade_alter_tables,
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('menu_comm_count', '5');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('menu_comm_length', '40');"
	);
}
if ($pviewGalVer < "1.1") {
	array_push($upgrade_alter_tables,
	"ALTER TABLE #pview_image	ADD COLUMN sendImage tinyint(1) NOT NULL default '0'",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('email', '1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('pdf', '0');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('print', '1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('permEmail', 'MEMBER');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('permPdf', 'MEMBER');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('permPrint', 'ALL');"
	);	
}
if ($pviewGalVer < "1.2"){
	array_push($upgrade_alter_tables,
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('permBatch', '0');"
	);
}
if ($pviewGalVer < "1.3"){
	array_push($upgrade_alter_tables,
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('search_lightbox', '0');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('menu_lightbox', '0');"
	);
}
if ($pviewGalVer < "1.3.1"){
	array_push($upgrade_alter_tables,
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('batch_use_filename', '1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('chmod', '');"
	);
}
if ($pviewGalVer < "1.3.2"){
	array_push($upgrade_alter_tables,
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('album_sort', 'uploadDate');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('album_details', 'name|descr|user');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('gal_cols', '1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('cat_sort', 'name');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('cat_details', 'name|date|album');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('user_sort', 'views');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('user_details', 'name|views|comm|rating');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('viewer_sort', '1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('details_link', '1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('gal_details', 'name|descr|info|edit');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('img_details', 'name|descr|date|size|dim|user|rating|views|cat');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('seo_links', '1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('center_thumbs', '0');"
	);
}
if ($pviewGalVer < "1.3.3"){
	array_push($upgrade_alter_tables,
	"ALTER TABLE #pview_image	ADD COLUMN externalImage tinyint(1) NOT NULL default '0'",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('permExtern', '0');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('start_page', 'classic');"
	);
}
if ($pviewGalVer < "1.3.4"){
	array_push($upgrade_alter_tables,
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_short', '1|1|0');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_album', '3|8|1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_cat', '4|4|0');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_comm', '10|4|0');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_img', '5|8|1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_imgRating', '6|4|0');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_imgViews', '7|4|0');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_Uploader', '8|4|0');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_userComm', '9|4|0');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_userGals', '2|4|0');"
	);
}
if ($pviewGalVer < "1.4"){
	array_push($upgrade_alter_tables,
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('profile_ImgCount', '8');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('profile_ImgOrder', 'RAND');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('profile_ImgCols', '4');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('profile_CommCount', '8');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('profile_CommCols', '4');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('profile_CommPreview', '20');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('profileImg_lightbox', '0');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('profileComm_lightbox', '0');"
	);
}
if ($pviewGalVer < "1.5"){
	array_push($upgrade_alter_tables,
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('img_Link_gal_extJS', '1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('img_Link_menu_extJS', '1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('img_Link_profileCom_extJS', '1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('img_Link_profileImg_extJS', '1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('img_Link_search_extJS', '1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('img_Link_extJS', 'noscript');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('img_Link_extJS_pview', '0');"
	);
}
if ($pviewGalVer < "1.6"){
	array_push($upgrade_alter_tables,
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('feature_dir', 'vert');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('permNominate', '0');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('Nominate', '0');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('maxImageNom', '10');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('maxAlbumNom', '10');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('NomFeature', '1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_FeatureAlbum', '11|0|0');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('stat_FeatureImg', '12|0|0');",
    "INSERT INTO `".MPREFIX."pview_config` VALUES ('comViewMenu', 'comm');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('watermark', '0');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_usergal', '1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_adminmode', '0');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_orig', '1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_thumb', '0');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_resize', '1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_opacity', '30');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_pos', 'ctr');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_decr', '1');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_typ', 'img');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_image', 'pview.gif');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_text', 'PView © USERNAME');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_color', 'FC761C');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_font', 'arial.ttf');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_fontsize', '15');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_angle', '0');",
	"INSERT INTO `".MPREFIX."pview_config` VALUES ('wm_padding', '40');",
	"CREATE TABLE `".MPREFIX."pview_featured` (
	`imageId` int(10) NOT NULL,
	`albumId` int(10) NOT NULL,
	`calDay` varchar(12) NOT NULL default '0',
	`isNominated` tinyint(1) NOT NULL,
	`isFeatured` tinyint(1) NOT NULL,
	PRIMARY KEY  (`imageId`,`albumId`,`calDay`));"
	);
}
if ($pviewGalVer < "1.7"){
	array_push($upgrade_alter_tables,
    "INSERT INTO `".MPREFIX."pview_config` VALUES ('cacheInt', '5');",
    "INSERT INTO `".MPREFIX."pview_config` VALUES ('cacheON', '0');"
	);
}

$eplug_upgrade_done = $eplug_name.LAN_INSTALL_3.$pviewGalVer.LAN_INSTALL_4.$eplug_version.LAN_INSTALL_5;

?>