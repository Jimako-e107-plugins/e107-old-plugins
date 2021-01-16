CREATE TABLE mylevel (
  mylevel_id int(11) unsigned NOT NULL default '0',
  mylevel_level tinyint(3) unsigned NOT NULL default '1',
  mylevel_comment varchar(150) default '',
  mylevel_contribution int(11) unsigned NOT NULL default '1',
  PRIMARY KEY  (mylevel_id)