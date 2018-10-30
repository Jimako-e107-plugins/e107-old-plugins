<?php exit; ?>

CREATE TABLE sgallery (
      album_id int(10) unsigned NOT NULL auto_increment,
      cat_id int(10) unsigned NOT NULL default '0',
      sgal_user varchar(250) NOT NULL default '',
      title varchar(200) NOT NULL default '',
      album_description TEXT NOT NULL,
      dt int(10) NOT NULL default '0',
      path varchar(12) NOT NULL default '',
      thsrc varchar(50) NOT NULL default '',
      active tinyint(1) NOT NULL default '0',
      album_viewed int(10) unsigned NOT NULL default '0',
      album_ustatus tinyint(1) NOT NULL default '1' ,
      PRIMARY KEY (album_id),
      KEY sgal_user (sgal_user),
      KEY album_ustatus (album_ustatus)
) ENGINE=MyISAM;

CREATE TABLE sgallery_cats (
      cat_id int(10) unsigned NOT NULL auto_increment,
      title varchar(200) NOT NULL default '',
      cat_description text NOT NULL,
      cat_order int(10) unsigned NOT NULL default '0',
      active tinyint(1) NOT NULL default '0',
      cat_viewed int(10) unsigned NOT NULL default '0',
      PRIMARY KEY  (cat_id)
) ENGINE=MyISAM;

CREATE TABLE sgallery_submit (
      submit_id int(10) unsigned NOT NULL auto_increment,
      submit_album_id int(10) unsigned NOT NULL default '0',
      submit_user varchar(250) NOT NULL default '',
      submit_dt int(10) NOT NULL default '0',
      submit_ip varchar(20) NOT NULL default '',
      submit_picnum smallint(4) unsigned NOT NULL default '0',
      PRIMARY KEY  (submit_id),
      KEY submit_album_id (submit_album_id)
) ENGINE=MyISAM;