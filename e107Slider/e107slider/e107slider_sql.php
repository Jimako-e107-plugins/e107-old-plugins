CREATE TABLE e107slider (
   id int(11) unsigned NOT NULL auto_increment,
   caption text NOT NULL,
   image varchar(256) NOT NULL default '',
   link varchar(256) NOT NULL default '',
   PRIMARY KEY (id)
) TYPE=MyISAM;