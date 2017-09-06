CREATE TABLE e107helpers_developer_1 (
  ehd_1_id int(11) unsigned NOT NULL auto_increment,
  ehd_1_name varchar(255) NOT NULL default '',
  ehd_1_file text,
  ehd_1_description text,
  ehd_1_userclass tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (ehd_1_id)
) TYPE=MyISAM;
