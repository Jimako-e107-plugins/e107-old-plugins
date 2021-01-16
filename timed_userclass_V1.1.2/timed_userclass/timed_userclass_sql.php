CREATE TABLE tclass (
  tclass_id int(10) unsigned NOT NULL auto_increment,
  tclass_userid int(11) unsigned NOT NULL default '0',
  tclass_from int(11) unsigned NOT NULL default '255',
  tclass_to int(11) unsigned NOT NULL default '255',
  tclass_start int(11) unsigned NOT NULL default '0',
  tclass_admin tinyint(3) unsigned NOT NULL default '0',
  tclass_notify tinyint(3) unsigned NOT NULL default '0',
  tclass_lastupdate int(11) unsigned NOT NULL default '0',
  tclass_donestart tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (tclass_id)
 ) TYPE=MyISAM;
