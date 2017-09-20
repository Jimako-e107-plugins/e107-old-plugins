CREATE TABLE glossary (
  glo_id int(10) unsigned NOT NULL auto_increment,
  glo_name varchar(100) NOT NULL default '',
  glo_description text NOT NULL,
  glo_author varchar(30) NOT NULL default '',
  glo_datestamp int(10) unsigned NOT NULL default '0',
  glo_approved tinyint(1) unsigned NOT NULL default '0',
  glo_linked tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (glo_id)
) ENGINE=MyISAM;
