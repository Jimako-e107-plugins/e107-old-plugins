CREATE TABLE agenda (
 agn_id int(11) unsigned NOT NULL auto_increment,
 agn_title varchar(200) NOT NULL default '',
 agn_type tinyint(2) unsigned NOT NULL default '0',
 agn_category int(11) unsigned NOT NULL default '0',
 agn_start int(10) NOT NULL default '0',
 agn_end int(10) NOT NULL default '-1',
 agn_diary_code char(5) NOT NULL default '',
 agn_location varchar(200) NOT NULL default '',
 agn_details text,
 agn_author varchar(100) NOT NULL default '',
 agn_owner varchar(100) NOT NULL default '',
 agn_contact_email varchar(200) NOT NULL default '',
 agn_priority tinyint(2) unsigned NOT NULL default '0',
 agn_private tinyint(2) unsigned NOT NULL default '0',
 agn_complete tinyint(2) unsigned NOT NULL default '0',
 agn_question tinyint(2) unsigned NOT NULL default '0',
 agn_responses text,
 agn_forum_thread varchar(200) NOT NULL default '',
 agn_data1 varchar(200) NOT NULL default '',
 agn_data2 varchar(200) NOT NULL default '',
 agn_data3 varchar(200) NOT NULL default '',
 agn_data4 varchar(200) NOT NULL default '',
 agn_datestamp int(10) unsigned NOT NULL default '0',
 PRIMARY KEY  (agn_id)
) TYPE=MyISAM;
CREATE TABLE agenda_category (
 cat_id int(11) unsigned NOT NULL auto_increment,
 cat_name varchar(100) NOT NULL default '',
 cat_description text NOT NULL,
 cat_icon varchar(100) NOT NULL default '',
 cat_visibility tinyint(3) unsigned NOT NULL default '0',
 cat_subs tinyint(3) unsigned NOT NULL default '0',
 cat_class int(10) unsigned NOT NULL default '0',
 cat_ahead tinyint(3) unsigned NOT NULL default '0',
 cat_msg1 text,
 cat_msg2 text,
 cat_notify tinyint(3) unsigned NOT NULL default '0',
 cat_last int(10) unsigned NOT NULL default '0',
 cat_today int(10) unsigned NOT NULL default '0',
 PRIMARY KEY  (cat_id)
) TYPE=MyISAM;
CREATE TABLE agenda_subs (
 subs_id int(10) unsigned NOT NULL auto_increment,
 subs_userid int(10) unsigned NOT NULL default '0',
 subs_cat int(10) unsigned NOT NULL default '0',
 PRIMARY KEY  (subs_id)
) TYPE=MyISAM;
CREATE TABLE agenda_type (
 typ_id int(11) unsigned NOT NULL auto_increment,
 typ_name varchar(100) NOT NULL default '',
 typ_description text NOT NULL,
 typ_timed tinyint(2) unsigned NOT NULL default '0',
 typ_floating tinyint(2) unsigned NOT NULL default '0',
 typ_recurring tinyint(2) unsigned NOT NULL default '0',
 typ_fields varchar(200) NOT NULL default '',
 typ_user tinyint(3) unsigned NOT NULL default '0',
 typ_admin tinyint(3) unsigned NOT NULL default '0',
 PRIMARY KEY  (typ_id)
) TYPE=MyISAM;
CREATE TABLE agenda_user (
 usr_id int(11) unsigned NOT NULL auto_increment,
 usr_filter_state tinyint(2) unsigned NOT NULL default '0',
 usr_filter text NOT NULL,
 usr_personal_view text NOT NULL,
 PRIMARY KEY  (usr_id)
) TYPE=MyISAM;
CREATE TABLE agenda_registration (
 reg_id int(11) unsigned NOT NULL auto_increment,
 reg_question varchar(100) NOT NULL default '',
 reg_field_type tinyint(2) unsigned NOT NULL default '0',
 reg_answers text NOT NULL,
 PRIMARY KEY  (reg_id)
) TYPE=MyISAM;