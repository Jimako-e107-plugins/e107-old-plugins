CREATE TABLE arcade_games (
  game_id int(10) unsigned NOT NULL auto_increment,
  game_filename varchar(100) NOT NULL default '',
  game_enable tinyint(1) NOT NULL default '0',
  game_category int(10) unsigned NOT NULL default '0',
  date_added varchar(16) NOT NULL,
  game_title varchar(64) NOT NULL,
  game_description varchar(255) default NULL,
  game_controls varchar(255) default NULL,
  display_height int(10) unsigned NOT NULL default '480',
  display_width int(10) unsigned NOT NULL default '640',
  reverse_score_order tinyint(1) NOT NULL default '0',
  times_played int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (game_id)
) TYPE=MyISAM;

CREATE TABLE arcade_scores (
  score_id int(10) unsigned NOT NULL auto_increment,
  game_id int(10) unsigned NOT NULL,
  user_id int(10) unsigned NOT NULL default '0',
  score int(11) NOT NULL,
  date_scored varchar(16) NOT NULL,
  PRIMARY KEY  (score_id)
)TYPE=MyISAM;

CREATE TABLE arcade_banlist (
  ban_id int(10) unsigned NOT NULL auto_increment,
  user_id int(10) unsigned NOT NULL,
  ban_reason varchar(255) default NULL,
  ban_date varchar(16) NOT NULL default '0',
  ban_end_date varchar(16) NOT NULL default '0',
  strike_count int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (ban_id)
  UNIQUE KEY user_id (user_id),
)TYPE=MyISAM;

CREATE TABLE arcade_categories (
  cat_id int(10) unsigned NOT NULL auto_increment,
  category_name varchar(64) NOT NULL,
  category_description varchar(255) default NULL,
  category_image varchar(100) NOT NULL default 'category.jpg',
  PRIMARY KEY  (cat_id)
  UNIQUE KEY category_name (category_name),
)TYPE=MyISAM;

CREATE TABLE arcade_champs (
  champ_id int(10) unsigned NOT NULL auto_increment,
  game_id int(10) unsigned NOT NULL,
  user_id int(10) unsigned NOT NULL,
  score varchar(16) NOT NULL,
  date_scored varchar(16) NOT NULL,
  PRIMARY KEY  (champ_id)
)TYPE=MyISAM;
