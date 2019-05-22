CREATE TABLE bugtracker3_apps (
  bugtracker3_apps_id int(10) unsigned NOT NULL auto_increment,
  bugtracker3_apps_name varchar(255) NOT NULL default '',
  bugtracker3_apps_icon varchar(255) NOT NULL default '',
  bugtracker3_apps_description text NOT NULL,
  bugtracker3_apps_type tinyint(3) unsigned NOT NULL default '0',
  bugtracker3_apps_current_version int(10) unsigned NOT NULL default '0',
  bugtracker3_apps_visible tinyint(1) unsigned NOT NULL default '0',
  bugtracker3_apps_closed tinyint(1) unsigned NOT NULL default '0',
  bugtracker3_apps_postclass tinyint(3) unsigned NOT NULL default '0',
  bugtracker3_apps_editclass tinyint(3) unsigned NOT NULL default '0',
  bugtracker3_apps_userclass tinyint(3) unsigned NOT NULL default '0',
  bugtracker3_apps_owner int(10) unsigned NOT NULL default '0',
  bugtracker3_apps_categories varchar(255) NOT NULL default '',
  bugtracker3_apps_category_default int(10) unsigned NOT NULL default '0',
  bugtracker3_apps_priorities varchar(255) NOT NULL default '',
  bugtracker3_apps_priority_default int(10) unsigned NOT NULL default '0',
  bugtracker3_apps_resolutions varchar(255) NOT NULL default '',
  bugtracker3_apps_resolution_default int(10) unsigned NOT NULL default '0',
  bugtracker3_apps_statuses varchar(255) NOT NULL default '',
  bugtracker3_apps_status_default int(10) unsigned NOT NULL default '0',
  bugtracker3_apps_template varchar(50) NOT NULL default '',
  PRIMARY KEY  (bugtracker3_apps_id)
) TYPE=MyISAM;
CREATE TABLE bugtracker3_app_versions (
  bugtracker3_appver_id int(10) unsigned NOT NULL auto_increment,
  bugtracker3_appver_app_id int(10) NOT NULL default '0',
  bugtracker3_appver_version varchar(255) NOT NULL default '',
  bugtracker3_appver_description text NOT NULL,
  KEY bugtracker3_appver_id (bugtracker3_appver_id)
) TYPE=MyISAM;
CREATE TABLE bugtracker3_bugs (
  bugtracker3_bugs_id int(10) unsigned NOT NULL auto_increment,
  bugtracker3_bugs_timestamp int(10) unsigned NOT NULL default '0',
  bugtracker3_bugs_update_timestamp int(10) unsigned NOT NULL default '0',
  bugtracker3_bugs_summary varchar(255) NOT NULL default '',
  bugtracker3_bugs_poster int(10) unsigned NOT NULL default '0',
  bugtracker3_bugs_last_update_poster int(10) unsigned NOT NULL default '0',
  bugtracker3_bugs_owner int(10) unsigned NOT NULL default '0',
  bugtracker3_bugs_deleted tinyint(1) NOT NULL default '0',
  bugtracker3_bugs_application_id int(10) unsigned NOT NULL default '0',
  bugtracker3_bugs_found_in_version int(10) unsigned NOT NULL default '0',
  bugtracker3_bugs_fixed_in_version int(10) unsigned NOT NULL default '0',
  bugtracker3_bugs_category int(10) NOT NULL default '0',
  bugtracker3_bugs_description text NOT NULL,
  bugtracker3_bugs_priority int(10) unsigned NOT NULL default '0',
  bugtracker3_bugs_resolution int(10) unsigned NOT NULL default '0',
  bugtracker3_bugs_status int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (bugtracker3_bugs_id)
) TYPE=MyISAM;
CREATE TABLE bugtracker3_developer_comments (
  bugtracker3_devc_timestamp int(10) unsigned NOT NULL default '0',
  bugtracker3_devc_bugid int(10) unsigned NOT NULL default '0',
  bugtracker3_devc_poster int(10) unsigned NOT NULL default '0',
  bugtracker3_devc_comment text NOT NULL
) TYPE=MyISAM;
CREATE TABLE bugtracker3_categories (
  bugtracker3_category_id int(10) unsigned NOT NULL auto_increment,
  bugtracker3_category_name varchar(50) NOT NULL default '',
  bugtracker3_category_description text NOT NULL,
  bugtracker3_category_order tinyint(3) unsigned NOT NULL default '0',
  KEY bugtracker3_category_id (bugtracker3_category_id)
) TYPE=MyISAM;
CREATE TABLE bugtracker3_priorities (
  bugtracker3_priority_id int(10) unsigned NOT NULL auto_increment,
  bugtracker3_priority_name varchar(50) NOT NULL default '',
  bugtracker3_priority_description text NOT NULL,
  bugtracker3_priority_color varchar(6) NOT NULL default '',
  bugtracker3_priority_order tinyint(3) unsigned NOT NULL default '0',
  KEY bugtracker3_priority_id (bugtracker3_priority_id)
) TYPE=MyISAM;
CREATE TABLE bugtracker3_resolutions (
  bugtracker3_resolution_id int(10) unsigned NOT NULL auto_increment,
  bugtracker3_resolution_name varchar(50) NOT NULL default '',
  bugtracker3_resolution_description text NOT NULL,
  bugtracker3_resolution_order tinyint(3) unsigned NOT NULL default '0',
  KEY bugtracker3_resolution_id (bugtracker3_resolution_id)
) TYPE=MyISAM;
CREATE TABLE bugtracker3_statuses (
  bugtracker3_status_id int(10) unsigned NOT NULL auto_increment,
  bugtracker3_status_name varchar(50) NOT NULL default '',
  bugtracker3_status_description text NOT NULL,
  bugtracker3_status_order tinyint(3) unsigned NOT NULL default '0',
  KEY bugtracker3_status_id (bugtracker3_status_id)
) TYPE=MyISAM;
CREATE TABLE bugtracker3_relationships (
  bugtracker3_rels_primary_id int(10) unsigned NOT NULL default '0',
  bugtracker3_rels_secondary_id int(10) unsigned NOT NULL default '0',
  bugtracker3_rels_relationship tinyint(3) unsigned NOT NULL default '0',
  KEY bugtracker3_rels_primary_id (bugtracker3_rels_primary_id),
  KEY bugtracker3_rels_secondary_id (bugtracker3_rels_secondary_id)
) TYPE=MyISAM;
CREATE TABLE bugtracker3_filters (
  bugtracker3_filter_id int(10) unsigned NOT NULL auto_increment,
  bugtracker3_filter_owner int(10) NOT NULL default '0',
  bugtracker3_filter_name varchar(50) NOT NULL default '',
  bugtracker3_filter_description text NOT NULL,
  bugtracker3_filter_public char(1) NOT NULL default '',
  bugtracker3_filter_bug_owner_id int(10) NOT NULL default '0',
  bugtracker3_filter_categories text NOT NULL,
  bugtracker3_filter_priorities text NOT NULL,
  bugtracker3_filter_resolutions text NOT NULL,
  bugtracker3_filter_statuses text NOT NULL,
  KEY bugtracker3_filter_id (bugtracker3_filter_id)
) TYPE=MyISAM;
CREATE TABLE bugtracker3_user_prefs (
  bugtracker3_user_prefs_id int(10) unsigned NOT NULL auto_increment,
  bugtracker3_user_prefs_filter int(10) NOT NULL default '0',
  KEY bugtracker3_user_prefs_id (bugtracker3_user_prefs_id)
) TYPE=MyISAM;
