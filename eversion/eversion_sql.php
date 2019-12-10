CREATE TABLE eversion (
  eversion_id int(10) unsigned NOT NULL auto_increment,
  eversion_name varchar(50) default '',
  eversion_title varchar(100) default '',
  eversion_major int(10) unsigned not null default '0',
  eversion_minor int(10) unsigned not null default '0',
  eversion_beta int(10) unsigned not null default '0',
  eversion_date int(10) unsigned not null default '0',
  eversion_author varchar(100) default '',
  eversion_revisions text NOT NULL,
  eversion_comments text not null,
  eversion_dlpath varchar(200) default '',
  eversion_updated int(10) unsigned not null default '0',
  eversion_category int(10) unsigned not null default '0',
  eversion_support varchar(200) default '',
  eversion_icon varchar(50) default '',
  eversion_bugtrack varchar(200) default '',
  PRIMARY KEY  (eversion_id)
) ENGINE=MyISAM;
