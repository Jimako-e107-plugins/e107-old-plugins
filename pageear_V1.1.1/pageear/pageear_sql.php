 CREATE TABLE pageear_clickthru (
  pageear_clickthru_id int(10) unsigned NOT NULL auto_increment,
  pageear_clickthru_name varchar(50) default NULL,
  pageear_clickthru_large varchar(50) default NULL,
  pageear_clickthru_small varchar(50) default NULL,
  pageear_clickthru_client varchar(100) default NULL,
  pageear_clickthru_active tinyint(3) unsigned NOT NULL default '0',
  pageear_clickthru_shows int(10) unsigned NOT NULL default '0',
  pageear_clickthru_clicks int(10) unsigned NOT NULL default '0',
  pageear_clickthru_purchased int(10) unsigned NOT NULL default '0',
  pageear_clickthru_purchasedate int(10) unsigned NOT NULL default '0',
  pageear_clickthru_expires int(10) unsigned NOT NULL default '0',
  pageear_clickthru_link varchar(100) default NULL,
  pageear_clickthru_ips text,
  PRIMARY KEY  (pageear_clickthru_id)
  ) TYPE=MyISAM;