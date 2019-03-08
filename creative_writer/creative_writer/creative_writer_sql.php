CREATE TABLE cw_book (
cw_book_id int(11) unsigned NOT NULL auto_increment,
  cw_book_title varchar(50) NOT NULL default '',
  cw_book_summary varchar(200) default NULL,
  cw_book_logo varchar(100) default NULL,
  cw_book_author varchar(100) NOT NULL default '0.anon',
  cw_book_category int(11) unsigned NOT NULL default '0',
  cw_book_genre int(11) unsigned NOT NULL default '0',
  cw_book_characters text,
  cw_book_created int(11) unsigned NOT NULL default '0',
  cw_book_lastupdate int(11) unsigned NOT NULL default '0',
  cw_book_complete tinyint(3) unsigned NOT NULL default '0',
  cw_book_chapters int(11) unsigned NOT NULL default '0',
  cw_book_series int(11) unsigned NOT NULL default '0',
  cw_book_wordcount int(11) unsigned NOT NULL default '0',
  cw_book_warnings text,
  cw_book_views int(11) unsigned NOT NULL default '0',
  cw_book_disclaimer text NOT NULL,
  cw_book_rate tinyint(3) unsigned NOT NULL default '0',
  cw_book_review tinyint(3) unsigned NOT NULL default '0',
  cw_book_comments tinyint(3) unsigned NOT NULL default '0',
  cw_book_price decimal(10,2) unsigned NOT NULL default '0.00',
  cw_book_visible tinyint(3) unsigned NOT NULL default '0',
  cw_book_approved tinyint(3) unsigned NOT NULL default '0',
  cw_book_unique int(11) unsigned NOT NULL default '0',
  cw_book_viewers text NOT NULL,
  cw_book_language varchar(11) NOT NULL default 'English',
  PRIMARY KEY  (cw_book_id),
  KEY cw_book_title (cw_book_title),
  KEY cw_book_summary (cw_book_summary)
) TYPE=MyISAM;
CREATE TABLE cw_category (
  cw_category_id int(11) unsigned NOT NULL auto_increment,
  cw_category_name varchar(50) NOT NULL default '',
  cw_category_icon varchar(100) default NULL,
  cw_category_lastupdated int(11) unsigned NOT NULL default '0',
  cw_category_class int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (cw_category_id),
  KEY cw_category_name (cw_category_name)
) TYPE=MyISAM;
CREATE TABLE cw_chapters (
  cw_chapter_id int(11) unsigned NOT NULL auto_increment,
  cw_chapter_title varchar(100) NOT NULL default '',
  cw_chapter_number int(11) unsigned NOT NULL default '0',
  cw_chapter_body mediumtext,
  cw_chapter_created int(11) unsigned NOT NULL default '0',
  cw_chapter_lastupdate int(11) unsigned NOT NULL default '0',
  cw_chapter_book int(11) unsigned NOT NULL default '0',
  cw_chapter_author varchar(100) NOT NULL default '',
  cw_chapter_wordcount int(11) unsigned NOT NULL default '0',
  cw_chapter_views int(11) unsigned NOT NULL default '0',
  cw_chapter_payfor tinyint(3) unsigned NOT NULL default '0',
  cw_chapter_prev int(11) unsigned NOT NULL default '0',
  cw_chapter_next int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (cw_chapter_id),
  KEY cw_chapter_title (cw_chapter_title)
) TYPE=MyISAM;
CREATE TABLE cw_genre (
  cw_genre_id int(11) unsigned NOT NULL auto_increment,
  cw_genre_name varchar(40) NOT NULL default '',
  cw_genre_icon varchar(100) default NULL,
  cw_genre_lastupdated int(11) unsigned default NULL,
  PRIMARY KEY  (cw_genre_id),
  KEY cw_genre_name (cw_genre_name)
) TYPE=MyISAM;
CREATE TABLE cw_review (
  cw_review_id int(11) unsigned NOT NULL auto_increment,
  cw_review_book int(11) unsigned default NULL,
  cw_reviewer varchar(100) NOT NULL default '',
  cw_review text,
  cw_review_rate tinyint(3) unsigned NOT NULL default '0',
  cw_review_posted int(11) unsigned default NULL,
  PRIMARY KEY  (cw_review_id)
) TYPE=MyISAM;
CREATE TABLE cw_biography (
  cw_bio_id int(11) unsigned NOT NULL default '0',
  cw_bio_name varchar(100) NOT NULL default '',
  cw_bio_picture varchar(100) default NULL,
  cw_bio_biography text,
  cw_bio_email varchar(100) default NULL,
  cw_bio_contact text,
  PRIMARY KEY  (cw_bio_id)
) TYPE=MyISAM;