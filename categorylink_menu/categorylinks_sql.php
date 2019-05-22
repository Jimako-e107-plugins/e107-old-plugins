CREATE TABLE linkcategory (
  linkcategory_id int(11) unsigned NOT NULL auto_increment,
	linkcategory_name VARCHAR(150) NOT NULL default '',
	linkcategory_pic VARCHAR(150) NOT NULL default '',
	linkcategory_class int(11) NOT NULL default '0',
	PRIMARY KEY  (linkcategory_id)
	) TYPE=MyISAM AUTO_INCREMENT=1
	
CREATE TABLE categorylink (
  categorylink_id int(11) unsigned NOT NULL auto_increment,
  categorylink_name VARCHAR(150) NOT NULL default '',
  categorylink_link VARCHAR(150) NOT NULL default '',
  categorylink_cat VARCHAR(150) NOT NULL default '',
  categorylink_pic VARCHAR(150) NOT NULL default '',
  categorylink_class int(11) NOT NULL default '0',
  categorylink_open int(11) NOT NULL default '0',
  categorylink_css varchar(150) NOT NULL default '',
	PRIMARY KEY  (categorylink_id)
	) TYPE=MyISAM AUTO_INCREMENT=1;	
