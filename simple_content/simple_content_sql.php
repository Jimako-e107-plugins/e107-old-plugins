CREATE TABLE scontent_groups (
  scontent_group_id int(10) unsigned NOT NULL auto_increment,
  scontent_group_name varchar(255) NOT NULL default '',
  scontent_group_description text NOT NULL,
  scontent_group_icon varchar(255) NOT NULL default '',
  scontent_group_start_date int(10) unsigned NOT NULL default '0',
  scontent_group_end_date int(10) unsigned NOT NULL default '0',
  scontent_group_closed tinyint(1) unsigned NOT NULL default '0',
  scontent_group_view_class tinyint(3) unsigned NOT NULL default '0',
  scontent_group_template text NOT NULL,
  PRIMARY KEY  (scontent_group_id)
) TYPE=MyISAM;
CREATE TABLE scontent_cats (
  scontent_cat_id int(10) unsigned NOT NULL auto_increment,
  scontent_cat_name varchar(255) NOT NULL default '',
  scontent_cat_description text NOT NULL,
  scontent_cat_group_id int(10) unsigned NOT NULL default '0',
  scontent_cat_icon varchar(255) NOT NULL default '',
  scontent_cat_start_date int(10) unsigned NOT NULL default '0',
  scontent_cat_end_date int(10) unsigned NOT NULL default '0',
  scontent_cat_closed tinyint(1) unsigned NOT NULL default '0',
  scontent_cat_view_class tinyint(3) unsigned NOT NULL default '0',
  scontent_cat_label_f1 varchar(100) NOT NULL default '',
  scontent_cat_label_f2 varchar(100) NOT NULL default '',
  scontent_cat_label_f3 varchar(100) NOT NULL default '',
  scontent_cat_label_f4 varchar(100) NOT NULL default '',
  scontent_cat_label_f5 varchar(100) NOT NULL default '',
  scontent_cat_label_f6 varchar(100) NOT NULL default '',
  scontent_cat_label_f7 varchar(100) NOT NULL default '',
  scontent_cat_label_f8 varchar(100) NOT NULL default '',
  scontent_cat_label_f9 varchar(100) NOT NULL default '',
  PRIMARY KEY  (scontent_cat_id)
) TYPE=MyISAM;
CREATE TABLE scontent_items (
  scontent_item_id int(10) unsigned NOT NULL auto_increment,
  scontent_item_name varchar(255) NOT NULL default '',
  scontent_item_cat_id int(10) unsigned NOT NULL default '0',
  scontent_item_f1 text NOT NULL,
  scontent_item_f2 text NOT NULL,
  scontent_item_f3 text NOT NULL,
  scontent_item_f4 text NOT NULL,
  scontent_item_f5 text NOT NULL,
  scontent_item_f6 text NOT NULL,
  scontent_item_f7 text NOT NULL,
  scontent_item_f8 text NOT NULL,
  scontent_item_f9 text NOT NULL,
  scontent_item_last_updated int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (scontent_item_id)
) TYPE=MyISAM;
CREATE TABLE scontent_relationships (
  scontent_rel_id int(10) unsigned NOT NULL auto_increment,
  scontent_rel_parent_item_id int(10) unsigned NOT NULL default '0',
  scontent_rel_child_item_id int(10) unsigned NOT NULL default '0',
  scontent_rel_name text NOT NULL,
  scontent_rel_description text NOT NULL,
  PRIMARY KEY  (scontent_rel_id)
) TYPE=MyISAM;
