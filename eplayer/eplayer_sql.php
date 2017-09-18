CREATE TABLE eplayer_category (
   cat_id                int(10) unsigned NOT NULL auto_increment,
   cat_name              varchar(100) NOT NULL default '',
   cat_description       varchar(250) NOT NULL default '',
   cat_icon              varchar(100) NOT NULL default '',
   cat_display_order     int(10) unsigned NOT NULL default '0',
   cat_parent_category   int(10) unsigned NOT NULL default '0',
   cat_visibility        tinyint(3) unsigned NOT NULL default '0',
   cat_uploaders         tinyint(3) unsigned NOT NULL default '0',
   PRIMARY KEY  (cat_id)
) TYPE=MyISAM;
CREATE TABLE eplayer (
   id                   int(10) unsigned NOT NULL auto_increment,
   filename             varchar(200) NOT NULL default '',
   title                varchar(100) NOT NULL default '',
   category             int(10) unsigned NOT NULL default '0',
   datestamp            int(10) unsigned NOT NULL default '0',
   description          text NOT NULL,
   icon                 varchar(100) NOT NULL default '',
   width                int(10) unsigned NOT NULL default '0',
   height               int(10) unsigned NOT NULL default '0',
   owner                int(10) unsigned NOT NULL default '0',
   author               varchar(100) NOT NULL default '',
   comment              tinyint(3) NOT NULL default '1',
   timestamp            int(19) unsigned NOT NULL default '0',
   lastview             int(10) unsigned NOT NULL default '0',
   viewcount            int(10) unsigned NOT NULL default '0',
   approved             char(1) NOT NULL default '0',
   PRIMARY KEY  (id)
) TYPE=MyISAM;
