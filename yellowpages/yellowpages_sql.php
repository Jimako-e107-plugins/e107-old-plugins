CREATE TABLE yellowpages (
  yell_id int(11) NOT NULL auto_increment,
  yell_name varchar(100) NOT NULL default '',
  yell_description text NOT NULL,
  yell_contact_name varchar(100) NOT NULL default '',
  yell_tel1 varchar(30) NOT NULL default '',
  yell_tel2 varchar(30) NOT NULL default '',
  yell_email varchar(100) NOT NULL default '',
  yell_website varchar(100) NOT NULL default '',
  yell_image varchar(100) NOT NULL default '',
  yell_category int(11) unsigned NOT NULL default '0',
  yell_approved tinyint(3) unsigned NOT NULL default '0',
  yell_submitter int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (yell_id)
) TYPE=MyISAM;
CREATE TABLE yellowpages_category (
  yell_cat_id int(11) unsigned NOT NULL auto_increment,
  yell_cat_name varchar(100) NOT NULL default '',
  yell_cat_description text NOT NULL,
  yell_cat_icon varchar(100) NOT NULL default '',
  yell_cat_parent_id int(11) unsigned NOT NULL default '0',
  yell_cat_section_id int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (yell_cat_id)
) TYPE=MyISAM;
CREATE TABLE yellowpages_section (
  yell_section_id int(11) unsigned NOT NULL auto_increment,
  yell_section_name varchar(100) NOT NULL default '',
  yell_section_url varchar(100) NOT NULL default '',
  yell_section_description text NOT NULL,
  yell_section_icon varchar(100) NOT NULL default '',
  yell_section_template varchar(100) NOT NULL default '',
  PRIMARY KEY  (yell_section_id)
) TYPE=MyISAM;