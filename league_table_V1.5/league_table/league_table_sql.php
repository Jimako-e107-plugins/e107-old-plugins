CREATE TABLE league_team (
  league_team_id int(11) unsigned NOT NULL auto_increment,
  league_team_name varchar(50) default NULL,
  league_team_played int(11) NOT NULL default '0',
  league_team_won int(11) NOT NULL default '0',
  league_team_lost int(11) NOT NULL default '0',
  league_team_drawn int(11) NOT NULL default '0',
  league_team_scored int(11) NOT NULL default '0',
  league_team_conceeded int(11) NOT NULL default '0',
  league_team_points decimal(5,1) unsigned NOT NULL default '0.0',
  league_team_show int(11) NOT NULL default '1',
  league_team_league int(11) unsigned NOT NULL default '0',
  league_team_bonus int(11) NOT NULL default '0',
  PRIMARY KEY  (league_team_id)
) TYPE=MyISAM;

CREATE TABLE league_leagues (
  league_league_id int(11) unsigned NOT NULL auto_increment,
  league_league_name varchar(50) default NULL,
  league_league_order tinyint(3) NOT NULL default '0',
  league_league_last varchar(20) default '0',
  league_league_open tinyint(3) NOT NULL default '0',
  league_league_openmenu tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (league_league_id)
) TYPE=MyISAM;