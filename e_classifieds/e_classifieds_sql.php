CREATE TABLE eclassf_ads (
  eclassf_cid int(11) NOT NULL auto_increment,
  eclassf_cname varchar(250) default NULL,
  eclassf_cdesc varchar(250) default NULL,
  eclassf_ccat int(10) unsigned NOT NULL default '0',
  eclassf_cpic varchar(250) default NULL,
  eclassf_cdetails TEXT,
  eclassf_capproved int(10) unsigned NOT NULL default '0',
  eclassf_cuser varchar(250) default NULL,
  eclassf_cph varchar(250) default NULL,
  eclassf_cemail varchar(250) default NULL,
  eclassf_ccdate int(10) unsigned NOT NULL default '0',
  eclassf_cpdate int(10) unsigned NOT NULL default '0',
  eclassf_last int(10) unsigned NOT NULL default '0',
  eclassf_price varchar(20) default '0',
  eclassf_views int(10) unsigned NOT NULL default '0',
  eclassf_counter varchar(50) default '',
  PRIMARY KEY  (eclassf_cid),
  UNIQUE KEY id (eclassf_cid)
) TYPE=MyISAM;
CREATE TABLE eclassf_cats (
  eclassf_catid int(11) NOT NULL auto_increment,
  eclassf_catname varchar(250) default NULL,
  eclassf_catdesc varchar(250) default NULL,
  eclassf_catclass int(10) unsigned NOT NULL default '0',
  eclassf_caticon varchar(50) default '',
  PRIMARY KEY  (eclassf_catid),
  UNIQUE KEY id (eclassf_catid)
) TYPE=MyISAM;
CREATE TABLE eclassf_subcats (
  eclassf_subid int(11) NOT NULL auto_increment,
  eclassf_ccatid int(10) unsigned NOT NULL default '0',
  eclassf_subname varchar(250) default NULL,
  eclassf_subicon varchar(50) default '',
  PRIMARY KEY  (eclassf_subid),
  UNIQUE KEY id (eclassf_subid)
) TYPE=MyISAM