CREATE TABLE deleteme_why (
  deleteme_id int(10) unsigned NOT NULL auto_increment,
  deleteme_user_id int(10) unsigned NOT NULL default '0',
  deleteme_user_name varchar(100) default '',
  deleteme_email varchar(100) default '',
  deleteme_reason_left text,
  deleteme_dateleft int(10) unsigned NOT NULL default '0',
  deleteme_ipaddress varchar(20) NOT NULL default '',
  PRIMARY KEY  (deleteme_id)
) TYPE=MyISAM COMMENT='Delete me reason why left';