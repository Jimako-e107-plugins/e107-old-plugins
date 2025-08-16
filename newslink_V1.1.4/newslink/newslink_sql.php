CREATE TABLE newslink_newslink (
  newslink_id int(10) unsigned NOT NULL auto_increment,
  newslink_name VARCHAR(50) default NULL,
  newslink_link VARCHAR(150) default NULL,
  newslink_author VARCHAR(100) default NULL,
  newslink_body text NOT NULL,
  newslink_category int(10) unsigned NOT NULL default '0',
  newslink_approved int(10) unsigned NOT NULL default '0',
  newslink_posted int(10) unsigned NOT NULL default '0',
  newslink_views int(10) unsigned NOT NULL default '0',
  newslink_viewer text NOT NULL,
  newslink_unique int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (newslink_id)
) TYPE=MyISAM COMMENT='Newslinks main table';
CREATE TABLE newslink_category (
  newslink_category_id int(10) NOT NULL auto_increment,
  newslink_category_name VARCHAR(50) default NULL,
  newslink_category_description VARCHAR(150) default NULL,
  newslink_category_updated int(10) unsigned NOT NULL default '0',
  newslink_category_read int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (newslink_category_id)
) TYPE=MyISAM COMMENT='Newslinks categories';