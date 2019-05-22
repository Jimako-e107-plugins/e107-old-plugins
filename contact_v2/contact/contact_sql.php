CREATE TABLE contact (
  contact_id int(10) unsigned NOT NULL auto_increment,
  contact_body text NOT NULL,
  contact_author_name varchar(100) NOT NULL default '',
  contact_email_send varchar(100) NOT NULL default '',
  contact_time varchar(16) NOT NULL default '',
  contact_subject varchar(100) NOT NULL default '',
  contact_mod tinyint(1) NOT NULL default '0',
  PRIMARY KEY (contact_id)
) ENGINE=MyISAM;