CREATE TABLE aprom (
  aprom_id int(10) unsigned NOT NULL auto_increment,
  aprom_method char(10) default '>=',
  aprom_basis tinyint(3) unsigned NOT NULL default '0',
  aprom_level int(11) unsigned NOT NULL default '0',
  aprom_from int(11) unsigned NOT NULL default '255',
  aprom_to int(11) unsigned NOT NULL default '255',
  aprom_notify tinyint(3) unsigned NOT NULL default '0',
  aprom_order int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (aprom_id)
 ) TYPE=MyISAM;
