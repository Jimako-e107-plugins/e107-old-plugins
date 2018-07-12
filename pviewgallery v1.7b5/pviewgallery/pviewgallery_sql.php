CREATE TABLE pview_album (
	albumId int(10) unsigned NOT NULL auto_increment,
	galleryId int(10) unsigned default NULL,
	parentAlbumId int(10) unsigned default NULL,
	name varchar(60) default NULL,
	description mediumtext,
	albumImage varchar(100) default NULL,
	permUpload varchar(100) default NULL,
	permEdit varchar(100) default NULL,
	permView varchar(100) default NULL,
	permCreateAlbum varchar(100) default NULL,
	PRIMARY KEY (albumId)
) TYPE=MyISAM;
CREATE TABLE pview_config (
	configName varchar(25) NOT NULL default '',
	configValue varchar(60) default NULL,
	PRIMARY KEY  (configName)
) TYPE=MyISAM;
CREATE TABLE pview_gallery (
	galleryId int(10) unsigned NOT NULL default '0',
	name varchar(60) default NULL,
	active tinyint(1) default NULL,
	permEdit varchar(100) default NULL,
	permView varchar(100) default NULL,
	permCreateAlbum varchar(100) default NULL,
	PRIMARY KEY  (galleryId)
) TYPE=MyISAM;
CREATE TABLE pview_image (
	imageId int(10) unsigned NOT NULL auto_increment,
	albumId int(10) unsigned NOT NULL default '0',
	name varchar(60) default NULL,
	description mediumtext,
	filename varchar(100) default NULL,
	filenameResized varchar(100) default NULL,
	thumbnail varchar(100) default NULL,
	uploaderUserId varchar(10) default NULL,
	uploadDate int(11) default NULL,
	approved tinyint(1) default NULL,
	permEdit varchar(100) default NULL,
	permView varchar(100) default NULL,
	views int(10) default '0',
	cat int(10) default '0',
	sendImage tinyint(1) NOT NULL default '0',
	externalImage tinyint(1) NOT NULL default '0',
	PRIMARY KEY  (imageId)
) TYPE=MyISAM;
CREATE TABLE pview_comment (
	commentId int(10) unsigned NOT NULL auto_increment,
	commente107userId int(10) unsigned NOT NULL default '0',
	commentDate int(11) default NULL,
	commentText mediumtext,
	commentImageId int(10) unsigned NOT NULL default '0',
	PRIMARY KEY  (commentId)
) TYPE=MyISAM;
CREATE TABLE pview_rating (
	ratingId int(10) unsigned NOT NULL auto_increment,
	rating107userId int(10) unsigned NOT NULL default '0',
	ratingDate int(11) default NULL,
	ratingValue int(5) default NULL,
	ratingImageId int(10) unsigned NOT NULL default '0',
	PRIMARY KEY  (ratingId)
) TYPE=MyISAM;
CREATE TABLE pview_tmpip (
	ip_addr varchar(20) NOT NULL default '0',
	images mediumtext default NULL,
	time varchar(12) default NULL,
	PRIMARY KEY  (ip_addr)
) TYPE=MyISAM;
CREATE TABLE pview_cat (
	catId int(10) unsigned NOT NULL auto_increment,
	name varchar(60) default NULL,
	description mediumtext default NULL,
	icon varchar(250) default NULL,
	PRIMARY KEY  (catId)
) TYPE=MyISAM;
CREATE TABLE pview_featured (
  imageId int(10) NOT NULL,
  albumId int(10) NOT NULL,
  calDay varchar(12) NOT NULL default '0',
  isNominated tinyint(1) NOT NULL,
  isFeatured tinyint(1) NOT NULL,
  PRIMARY KEY  (imageId,albumId,calDay)
) TYPE=MyISAM;