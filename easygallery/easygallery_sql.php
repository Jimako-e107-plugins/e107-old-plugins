CREATE TABLE eg_comment (
 	id int(11) NOT NULL auto_increment,
	path varchar(200) NOT NULL default '',
	image varchar(80) NOT NULL default '',
	PRIMARY KEY (id),
	UNIQUE KEY ref (path,image)
) TYPE=MyISAM;