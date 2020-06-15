CREATE TABLE election_elections (
  election_id int(10) unsigned NOT NULL auto_increment,
  election_name varchar(255) NOT NULL default '',
  election_description text NOT NULL,
  election_icon varchar(255) NOT NULL default '',
  election_start_date int(10) unsigned NOT NULL default '0',
  election_end_date int(10) unsigned NOT NULL default '0',
  election_closed tinyint(1) unsigned NOT NULL default '0',
  election_view_class tinyint(3) unsigned NOT NULL default '253',
  election_view_results_class tinyint(3) unsigned NOT NULL default '253',
  election_vote_class tinyint(3) unsigned NOT NULL default '253',
  election_owner int(10) unsigned NOT NULL default '0',
  election_ratings tinyint(1) unsigned NOT NULL default '0',
  election_comments tinyint(1) unsigned NOT NULL default '0',
  election_template varchar(50) NOT NULL default '',
  election_points_per_vote text NOT NULL,
  election_vote_restriction_text text NOT NULL,
  PRIMARY KEY  (election_id)
) TYPE=MyISAM;
CREATE TABLE election_candidates (
  election_candidate_id int(10) unsigned NOT NULL auto_increment,
  election_candidate_election_ids text NOT NULL,
  election_candidate_name varchar(255) NOT NULL default '',
  election_candidate_title varchar(255) NOT NULL default '',
  election_candidate_description text,
  election_candidate_icon varchar(255) NOT NULL default '',
  election_candidate_images text,
  election_candidate_template varchar(50) NOT NULL default '',
  election_candidate_link_description varchar(255) NOT NULL default '',
  election_candidate_link_url varchar(255) NOT NULL default '',
  election_candidate_vote_restriction_value varchar(255) NOT NULL default '',
  election_candidate_vote_restriction_field varchar(255) NOT NULL default '',
  PRIMARY KEY  (election_candidate_id)
) TYPE=MyISAM;
CREATE TABLE election_voters (
  election_voter_user_id int(10) unsigned NOT NULL default '0',
  election_voter_user_ip varchar(15) NOT NULL default '',
  election_voter_election_id int(10) unsigned NOT NULL default '0',
  election_voter_votes text NOT NULL,
  election_voter_timestamp int(10) unsigned NOT NULL default '0'
) TYPE=MyISAM;