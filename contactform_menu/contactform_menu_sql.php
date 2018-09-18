CREATE TABLE contactform (
  id int(11) NOT NULL auto_increment,
  display_order tinyint(4) unsigned NOT NULL default '0',
  page_id varchar(255) NOT NULL default '1',
  title varchar(50) NOT NULL default '',
  email text NOT NULL,
  full_name text NOT NULL,
  description text NOT NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM;
CREATE TABLE contactform_pages (
  cf_page_id int(11) NOT NULL auto_increment,
  cf_page_name varchar(255) NOT NULL default '',
  cf_page_query varchar(255) NOT NULL default '',
  cf_page_userclass int(11) NOT NULL default '0',
  cf_page_description text NOT NULL,
  cf_page_sender_name char(1) NOT NULL default '2',
  cf_page_sender_email char(1) NOT NULL default '2',
  cf_page_subject char(1) NOT NULL default '2',
  cf_page_message char(1) NOT NULL default '1',
  cf_page_cc char(1) NOT NULL default '1',
  cf_page_custom text NOT NULL,
  PRIMARY KEY  (cf_page_id)
) TYPE=MyISAM;