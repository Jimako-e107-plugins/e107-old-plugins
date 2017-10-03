CREATE TABLE onthisday (
  otd_id int(10) unsigned NOT NULL auto_increment,
  otd_brief varchar(200) NOT NULL default '',
  otd_day int(11) unsigned NOT NULL default '0',
  otd_month int(11) unsigned NOT NULL default '0',
  otd_year int(11) unsigned NOT NULL default '0',
  otd_full text,
  otd_poster int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (otd_id)
) TYPE=MyISAM;