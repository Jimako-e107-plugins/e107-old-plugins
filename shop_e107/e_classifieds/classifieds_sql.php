 CREATE TABLE eclassf_ads (
  eclassf_id int(11) NOT NULL auto_increment,
  eclassf_name varchar(50) default NULL,
  eclassf_desc varchar(100) default NULL,
  eclassf_category int(10) unsigned NOT NULL default '0',
  eclassf_thumbnail varchar(100) default NULL,
  eclassf_details text,
  eclassf_approved int(10) unsigned NOT NULL default '0',
  eclassf_user varchar(100) default NULL,
  eclassf_phone varchar(30) default NULL,
  eclassf_email varchar(100) default NULL,
  eclassf_expires int(10) unsigned NOT NULL default '0',
  elcassf_posted int(10) unsigned NOT NULL default '0',
  eclassf_lastupdated int(10) unsigned NOT NULL default '0',
  eclassf_price varchar(20) default '0',
  eclassf_views int(10) unsigned NOT NULL default '0',
  eclassf_counter varchar(50) default '',
  eclassf_gallery tinyint(3) not null default '0',
  eclassf_location varchar(100) default NULL,
  PRIMARY KEY  (eclassf_id),
  KEY name (eclassf_name),
  KEY descript (eclassf_desc),
  KEY category (eclassf_category)
  ) ENGINE=MyISAM;
 CREATE TABLE eclassf_cats (
  eclassf_catid int(11) NOT NULL auto_increment,
  eclassf_catname varchar(50) default NULL,
  eclassf_catdesc varchar(100) default NULL,
  eclassf_catclass int(10) unsigned NOT NULL default '0',
  eclassf_caticon varchar(50) default '',
  PRIMARY KEY  (eclassf_catid),
  KEY catname (eclassf_catname)
  ) ENGINE=MyISAM;
 CREATE TABLE eclassf_subcats (
  eclassf_subid int(11) NOT NULL auto_increment,
  eclassf_categoryid int(10) unsigned NOT NULL default '0',
  eclassf_subname varchar(50) default NULL,
  eclassf_subicon varchar(50) default '',
  PRIMARY KEY  (eclassf_subid),
  KEY subname (eclassf_subname)
  ) ENGINE=MyISAM;