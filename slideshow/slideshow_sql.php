CREATE TABLE slideshow (
  slideshow_id int(10) unsigned NOT NULL auto_increment,
  slideshow_name varchar(100) NOT NULL default '',
  slideshow_url varchar(150) NOT NULL default '',
  slideshow_description text NOT NULL,
  slideshow_active tinyint(3) unsigned NOT NULL default '0',
  slideshow_datestamp int(10) unsigned NOT NULL default '0',
  slideshow_thumb varchar(150) NOT NULL default '',
  slideshow_image varchar(150) NOT NULL default '',
  slideshow_visible varchar(255) NOT NULL default '0',
  PRIMARY KEY  (slideshow_id),
  KEY slideshow_datestamp (slideshow_datestamp)
) ENGINE=MyISAM;