CREATE TABLE userjournals (
  userjournals_id int(10) unsigned NOT NULL auto_increment,
  userjournals_userid int(10) unsigned NOT NULL default '0',
  userjournals_subject varchar(64) NOT NULL default '',
  userjournals_categories varchar(100) NOT NULL default '',
  userjournals_playing varchar(50) NOT NULL default '',
  userjournals_mood enum('','happy','sad','alienated','beat_up','angry','annoyed','chicken','confused','crying','doh','evil','funny','greedy','hungry','puzzled','innocent','shocked','sick','sleepy','very_happy') NOT NULL default 'happy',
  userjournals_entry longtext NOT NULL,
  userjournals_date varchar(64) NOT NULL default '',
  userjournals_timestamp varchar(32) NOT NULL default '',
  userjournals_is_comment int(1) NOT NULL default '0',
  userjournals_comment_parent int(1) default NULL,
  userjournals_is_blog_desc int(1) NOT NULL default '0',
  userjournals_is_published int(1) NOT NULL default '0',
  PRIMARY KEY  (userjournals_id)
) TYPE=MyISAM;
CREATE TABLE userjournals_categories (
  userjournals_cat_id int(10) unsigned NOT NULL auto_increment,
  userjournals_cat_name varchar(100) NOT NULL default '',
  userjournals_cat_icon varchar(100) NOT NULL default '',
  userjournals_cat_parent_id  int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (userjournals_cat_id)
) TYPE=MyISAM;