CREATE TABLE faq (
  faq_id int(10) unsigned NOT NULL auto_increment,
  faq_parent int(10) unsigned NOT NULL default '0',
  faq_question mediumtext NOT NULL,
  faq_answer longtext NOT NULL,
  faq_comment tinyint(1) unsigned NOT NULL default '0',
  faq_datestamp int(10) unsigned NOT NULL default '0',
  faq_author varchar(100) default '',
  faq_order int(6) unsigned NOT NULL default '0',
  faq_approved tinyint(3) unsigned NOT NULL default '0',
  faq_views int(10) unsigned NOT NULL default '0',
  faq_viewer TEXT,
  faq_unique int(10) unsigned NOT NULL default '0',
  faq_updated int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (faq_id),
  KEY faq_parent (faq_parent)
) TYPE=MyISAM;
CREATE TABLE faq_info (
  faq_info_id int(10) unsigned NOT NULL auto_increment,
  faq_info_title text NOT NULL,
  faq_info_about text NOT NULL,
  faq_info_parent int(10) unsigned default '0',
  faq_info_class int(3) unsigned default '0',
  faq_info_order tinyint(3) unsigned NOT NULL default '0',
  faq_info_icon varchar(200) default '',
  PRIMARY KEY  (faq_info_id),
  KEY faq_info_parent (faq_info_parent)
) TYPE=MyISAM;

