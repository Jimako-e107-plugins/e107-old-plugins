CREATE TABLE rank_category (
  category_id int(5) unsigned NOT NULL auto_increment,
  category_name varchar(50) NOT NULL,
  category_class text NOT NULL,
  category_age tinyint(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (category_id)
) TYPE=MyISAM;
CREATE TABLE rank_ranks (
  rank_id int(5) unsigned NOT NULL auto_increment,
  rank_order int(5) unsigned NOT NULL,
  rank_category int(5) unsigned NOT NULL,
  rank_name varchar(50) NOT NULL,
  rank_img varchar(50) NOT NULL,
  rank_points int(4) unsigned NOT NULL,
  rank_wage int(5) NOT NULL default '0',
  rank_reserved char(1) NOT NULL DEFAULT 'F',
  PRIMARY KEY (rank_id),
  UNIQUE KEY rank_order (rank_order)
) TYPE=MyISAM;
CREATE TABLE rank_users (
  user_userid int(10) unsigned NOT NULL,
  user_rankid int(5) unsigned NOT NULL DEFAULT '0',
  user_values text NOT NULL DEFAULT '',
  rank_points int(10) NOT NULL DEFAULT '0',
  rank_medal int(5) unsigned NOT NULL DEFAULT '0',
  freeze_penalty char(1) NOT NULL DEFAULT 'F',
  freeze_rank char(1) NOT NULL DEFAULT 'F',
  user_lastcheck int(10) unsigned NOT NULL DEFAULT '0',
  user_prison char(1) NOT NULL DEFAULT 'F',
  prison_comment text,
  user_probation char(1) NOT NULL DEFAULT 'F',
  probation_comment text,
  user_kicked char(1) NOT NULL DEFAULT 'F',
  kicked_comment text,
  exclude_agelimit char(1) NOT NULL DEFAULT 'F',
  wage_last int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (user_userid)
) TYPE=MyISAM;
CREATE TABLE rank_medal_category (
  med_cat_id int(5) unsigned NOT NULL auto_increment,
  med_cat_name varchar(50) NOT NULL,
  PRIMARY KEY (med_cat_id)
) TYPE=MyISAM;
CREATE TABLE rank_medals (
  medal_id int(5) unsigned NOT NULL auto_increment,
  medal_type tinyint(2) unsigned NOT NULL,
  medal_order int(5) unsigned NOT NULL,
  medal_category int(5) unsigned NOT NULL,
  medal_name varchar(50) NOT NULL,
  medal_img varchar(50) NOT NULL,
  medal_img2 varchar(50) NOT NULL,
  medal_description text,
  medal_goal int(3) unsigned NOT NULL DEFAULT '0',
  medal_reserved char(1) NOT NULL default 'F',
  medal_bonus int(3) unsigned NOT NULL DEFAULT '0',
  medal_reward int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (medal_id),
  UNIQUE KEY medal_order (medal_order)
) TYPE=MyISAM;
CREATE TABLE rank_medal_goal (
  med_goal_id int(3) unsigned NOT NULL auto_increment,
  med_goal_name varchar(50) NOT NULL,
  med_goal_target varchar(30) NOT NULL,
  med_goal_type varchar(10) NOT NULL default 'int',
  med_goal_value int(10) unsigned NOT NULL,
  PRIMARY KEY (med_goal_id)
) TYPE=MyISAM;
CREATE TABLE rank_medal_users (
  med_user_index int(10) unsigned NOT NULL auto_increment,
  med_user_id int(10) unsigned NOT NULL,
  med_user_medal int(5) unsigned NOT NULL,
  med_user_date int(10) unsigned NOT NULL DEFAULT '0',
  med_user_remarks text,
  PRIMARY KEY (med_user_index),
  UNIQUE KEY user_medal (med_user_id,med_user_medal),
  KEY med_user_id (med_user_id)
) TYPE=MyISAM;
CREATE TABLE rank_recommend (
  recomm_id int(10) unsigned NOT NULL auto_increment,
  recomm_source int(10) unsigned NOT NULL,
  recomm_target int(10) unsigned NOT NULL,
  recomm_type tinyint(2) unsigned NOT NULL,
  recomm_for int(5) unsigned NOT NULL,
  recomm_date int(10) unsigned NOT NULL DEFAULT '0',
  recomm_remarks text,
  recomm_state tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (recomm_id),
  KEY target_id (recomm_target)
) TYPE=MyISAM;
CREATE TABLE rank_condition (
  condit_id int(10) unsigned NOT NULL auto_increment,
  condit_order int(5) unsigned NOT NULL,
  condit_name varchar(50) NOT NULL,
  condit_negative char(1) NOT NULL DEFAULT 'F',
  condit_hastext char(1) NOT NULL DEFAULT 'F',
  condit_maxval int(5) unsigned NOT NULL DEFAULT '0',
  condit_factor varchar(50) NOT NULL default '',
  condit_onbar varchar(255) NOT NULL,
  condit_offbar varchar(255) NOT NULL,
  condit_trigger varchar(100) NOT NULL,
  condit_enabled char(1) NOT NULL DEFAULT 'F',
  condit_descript text NOT NULL DEFAULT '',
  PRIMARY KEY (condit_id),
  UNIQUE KEY condit_order (condit_order),
  KEY trigger_id (condit_trigger),
  KEY enabled (condit_enabled)
) TYPE=MyISAM;
