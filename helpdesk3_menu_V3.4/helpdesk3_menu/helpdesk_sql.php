CREATE TABLE hdu_helpdesk (
  hdudesk_id int(10) unsigned NOT NULL auto_increment,
  hdudesk_name varchar(30) default NULL,
  hdudesk_class int(10) unsigned NOT NULL default '0',
  hdudesk_email varchar(100) NOT NULL default '',
  hdudesk_order int(10) unsigned NOT NULL default '0',
  hdudesk_lastupdate int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY  (hdudesk_id),
  KEY hdures_id (hdudesk_id),
  KEY helpdesk_name (hdudesk_name)
 ) TYPE=MyISAM;
CREATE TABLE hdu_comments (
  hduc_id int(10) unsigned NOT NULL auto_increment,
  hduc_ticketid int(10) unsigned NOT NULL default '0',
  hduc_poster varchar(100) NOT NULL default '',
  hduc_posterid int(10) unsigned NOT NULL default '0',
  hduc_date int(10) unsigned NOT NULL default '0',
  hduc_status tinyint(1) unsigned NOT NULL default '0',
  hduc_comment text,
  PRIMARY KEY  (hduc_id)
  ) TYPE=MyISAM;
CREATE TABLE hdu_categories (
  hducat_id int(10) unsigned NOT NULL auto_increment,
  hducat_category varchar(30) default NULL,
  hducat_order int(10) unsigned NOT NULL default '0',
  hducat_helpdesk int(10) unsigned NOT NULL default '0',
  hducat_lastupdate int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY  (hducat_id)
  ) TYPE=MyISAM;
CREATE TABLE hdu_fixes (
  hdufix_id int(10) unsigned NOT NULL auto_increment,
  hdufix_fix varchar(30) default NULL,
  hdufix_fixcost decimal(8,2) NOT NULL default '0.00',
  hdufix_order int(10) unsigned NOT NULL default '0',
  hdufix_lastupdate int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY  (hdufix_id)
  ) TYPE=MyISAM;
CREATE TABLE hdu_resolve (
  hdures_id int(10) unsigned NOT NULL auto_increment,
  hdures_resolution varchar(30) default NULL,
  hdures_order int(10) unsigned NOT NULL default '0',
  hdures_help varchar(100) NOT NULL default '',
  hdures_closed tinyint(3) unsigned NOT NULL default '0',
  hdures_lastupdate int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY  (hdures_id),
  KEY hdures_id (hdures_id)
  ) TYPE=MyISAM;
CREATE TABLE hdunit (
  hdu_id int(10) unsigned NOT NULL auto_increment,
  hdu_datestamp int(10) unsigned NOT NULL default '0',
  hdu_poster varchar(100) NOT NULL default '',
  hdu_posterid int(10) unsigned NOT NULL default '0',
  hdu_category int(10) unsigned NOT NULL default '0',
  hdu_summary varchar(50) NOT NULL default '',
  hdu_description text NOT NULL,
  hdu_priority tinyint(3) unsigned NOT NULL default '0',
  hdu_resolution  int(10) unsigned NOT NULL default '0',
  hdu_email varchar(100) NOT NULL default '',
  hdu_allocated int(10) unsigned NOT NULL default '0',
  hdu_tech int(10) unsigned NOT NULL default '0',
  hdu_lastchanged int(10) unsigned NOT NULL default '0',
  hdu_closed int(10) unsigned NOT NULL default '0',
  hdu_tagno varchar(20) NOT NULL default '',
  hdu_return tinyint(3) unsigned NOT NULL default '0',
  hdu_lastcomment int(10) unsigned NOT NULL default '0',
  hdu_fix int(10) unsigned NOT NULL default '0',
  hdu_fixother text,
  hdu_fixcost decimal(8,2) NOT NULL default '0.00',
  hdu_notifyme tinyint(3) unsigned NOT NULL default '0',
  hdu_distance int(10) unsigned NOT NULL default '0',
  hdu_drate decimal(8,2) NOT NULL default '0.00',
  hdu_dcost decimal(8,2) NOT NULL default '0.00',
  hdu_hours decimal(8,2) NOT NULL default '0.00',
  hdu_hrate decimal(8,2) NOT NULL default '0.00',
  hdu_hcost decimal(8,2) NOT NULL default '0.00',
  hdu_callout decimal(8,2) NOT NULL default '0.00',
  hdu_eqptcost decimal(8,2) not null default '0.00',
  hdu_totalcost decimal(8,2) not null default '0.00',
  PRIMARY KEY  (hdu_id),
  KEY hdu_closed (hdu_closed),
  KEY hdu_allocated (hdu_allocated),
  KEY hdu_category (hdu_category),
  KEY hdu_resolution (hdu_resolution),
  KEY hdu_tech (hdu_tech)
  ) TYPE=MyISAM;