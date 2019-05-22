<?php
// ***************************************************************
// *
// *		Title		:	Corporate Phone Directory
// *
// *		Author		:	Barry Keal
// *
// *		Date		:	6 May 2004
// *
// *		Version		:	1.6
// *
// *		Description	: 	Corporate phone directory
// *
// *		Revisions	:	06 May 2004 Initial design
// *                    :   18 Apr 2005 Massive mods to version 1.1
// *					:	23 Oct 2006 Added images to directory
// *					:	 3 Nov 2006 Added address fields for when not using sites
// *					:	23 Jan 2007 Added clear button to name field
// *
// ***************************************************************
// Plugin info -------------------------------------------------------------------------------------------------------

$eplug_name = "Phone Directory";
$eplug_version = "1.6";
$eplug_author = "Father Barry";
$eplug_logo = "images/pdir_32.png";
$eplug_url = "www.keal.me.uk";
$eplug_email = "";
$eplug_description = "This plugin is a Phone and Contact Directory";
$eplug_compatible = "e107v7";
$eplug_readme = "readme.pdf"; // leave blank if no readme file
$eplug_compliant = TRUE;
$eplug_status = true;
$eplug_latest = false;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "phonedir";
// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/pdir_32.png";
$eplug_icon_small = $eplug_folder."/images/pdir_16.png";
$eplug_caption = "Phone Directory";
// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array("phonedir_perpage" => 10,
    "phonedir_userclass" => 0,
    "phonedir_perpage" => 10,
    "phonedir_usesite" => 1,
    "phonedir_usedept" => 1,
    "phonedir_usejob" => 1,
    "phonedir_useoffice" => 1,
    "phonedir_metadesc" => "Father Barry's phone directory plugin",
    "phonedir_metakey" => "phone,directory, plugin,phone directory plugin",
    "phonedir_usephoto" => 1,
    "phonedir_photoh" => "100px",
    "phonedir_photow" => "100px"

    );
// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("pd_categories", "pd_department", "pd_directory", "pd_jobtitle","pd_sites");
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array("CREATE TABLE " . MPREFIX . "pd_categories (
  pd_cat_id int(10) unsigned NOT NULL auto_increment,
  pd_cat_desc varchar(30) default NULL,
  pd_cat_viewclass int(10) unsigned default '0' NOT NULL,
  pd_cat_updated int(10) unsigned default '0' NOT NULL,
  pd_cat_order int(10) unsigned default '0' NOT NULL,
  pd_cat_updateby varchar(100) default NULL,
  PRIMARY KEY  (pd_cat_id)
  ) TYPE=MyISAM;",
    "CREATE TABLE " . MPREFIX . "pd_department (
  pd_dept_id int(10) unsigned NOT NULL auto_increment,
  pd_dept_name varchar(40) default NULL,
  pd_dept_mgr varchar(20) default NULL,
  pd_dept_phone varchar(20) default NULL,
  pd_dept_fax varchar(20) default NULL,
  pd_dept_comment varchar(200) default NULL,
  pd_dept_email varchar(100) default NULL,
  pd_dept_phonecentrex varchar(20) default NULL,
  pd_dept_faxcentrex varchar(20) default NULL,
  pd_dept_updated int(10) unsigned default '0' NOT NULL,
  pd_dept_updateby varchar(100) default NULL,
  PRIMARY KEY  (pd_dept_id)
) TYPE=MyISAM;",
    "CREATE TABLE " . MPREFIX . "pd_directory (
  pd_id int(10) NOT NULL auto_increment,
  pd_last_name varchar(40) default NULL,
  pd_first_name varchar(40) default NULL,
  pd_work_phone varchar(20) default NULL,
  pd_fax varchar(20) default NULL,
  pd_mobile varchar(20) default NULL,
  pd_department int(10) unsigned default '0' NOT NULL,
  pd_site int(10) unsigned default '0' NOT NULL,
  pd_email varchar(160) default NULL,
  pd_comments text,
  pd_centrex varchar(10) default NULL,
  pd_dir_cat int(10) unsigned default '0' NOT NULL,
  pd_officed tinyint(1) unsigned default '1' NOT NULL,
  pd_jobtitle int(10) unsigned default '0' NOT NULL,
  pd_updated int(10) unsigned default '0' NOT NULL,
  pd_updatedby varchar(100) default NULL,
  pd_picture varchar(200) default NULL,
  pd_address1 varchar(50) default NULL,
  pd_address2 varchar(50) default NULL,
  pd_town varchar(50) default NULL,
  pd_county varchar(50) default NULL,
  pd_postcode varchar(20) default NULL,
  pd_country varchar(50) default NULL,
  PRIMARY KEY  (pd_id)
) TYPE=MyISAM;",
    "CREATE TABLE " . MPREFIX . "pd_jobtitle (
  pd_job_id int(10) unsigned NOT NULL auto_increment,
  pd_job_title varchar(40) default NULL,
  pd_job_updated int(10) unsigned default '0' NOT NULL,
  pd_job_updatedby varchar(100) default NULL,
  PRIMARY KEY  (pd_job_id)
) TYPE=MyISAM;",
    "CREATE TABLE " . MPREFIX . "pd_sites (
  pd_site_id int(10) unsigned NOT NULL auto_increment,
  pd_site_name varchar(25) default NULL,
  pd_site_address1 varchar(30) default NULL,
  pd_site_address2 varchar(30) default NULL,
  pd_site_town varchar(25) default NULL,
  pd_site_postcode varchar(10) default NULL,
  pd_site_phone varchar(15) default NULL,
  pd_site_fax varchar(15) default NULL,
  pd_site_comment varchar(200) default NULL,
  pd_site_faxcentrex varchar(10) default NULL,
  pd_site_phonecentrex varchar(10) default NULL,
  pd_site_county varchar(15) default NULL,
  pd_site_mapurl varchar(250) default NULL,
  pd_site_updated int(10) unsigned default '0' NOT NULL,
  pd_site_updatedby varchar(100) default NULL,
  PRIMARY KEY  (pd_site_id)
) TYPE=MyISAM;"
    );
// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = true;

$eplug_link_name = "Phone Directory";
$eplug_link_url = e_PLUGIN . "phonedir/phonedir.php";
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Goto the admin section and modify your phone directory settings.";
// upgrading ... //
$upgrade_add_prefs = array("phonedir_usephoto" => 1);
$upgrade_remove_prefs = "";
$upgrade_alter_tables = array(
"alter table #pd_directory add column pd_address1 varchar(50) default NULL",
"alter table #pd_directory add column pd_address2 varchar(50) default NULL",
"alter table #pd_directory add column pd_town varchar(50) default NULL",
"alter table #pd_directory add column pd_county varchar(50) default NULL",
"alter table #pd_directory add column pd_postcode varchar(20) default NULL",
"alter table #pd_directory add column pd_country varchar(50) default NULL"
);
$eplug_upgrade_done = "Goto the admin section and modify your phone directory settings.";

?>