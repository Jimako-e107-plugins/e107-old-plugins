<?php
/*
+---------------------------------------------------------------+
| Another Profiles Plugin v0.9.2
| Copyright © 2008 Istvan Csonka
| http://freedigital.hu
| support@freedigital.hu
|
|        For the e107 website system
|        ©Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
| (The original program is Alternate Profiles v2.0
| boreded.co.uk)
|
| Another Profiles Plugin comes with
| ABSOLUTELY NO WARRANTY
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
header("location:../../index.php");
exit;
?>

CREATE TABLE another_profiles (
  user_id int(5) NOT NULL default '0',
  user_custompage text NOT NULL,
  user_background varchar(255) NOT NULL default '',
  user_friends text NOT NULL,
  user_friends_request text NOT NULL,
  user_settings varchar(50) NOT NULL default '',
  user_simple int(1) NOT NULL default '1',
  user_lastviewed text NOT NULL,
  user_totalviews int(10) NOT NULL default '0',
  user_lastupdated int(11) NOT NULL default '0',
  user_mp3 text NOT NULL,
  PRIMARY KEY  (user_id)
) TYPE=MyISAM;
CREATE TABLE another_profiles_memberlist (
  memberlist_id int(5) NOT NULL default '0',
  memberlist_search varchar(200) NOT NULL default '',
  memberlist_columns varchar(200) NOT NULL default '',
  PRIMARY KEY  (memberlist_id)
) TYPE=MyISAM;
CREATE TABLE another_profiles_com (
  com_id int(10) NOT NULL auto_increment,
  com_by int(10) NOT NULL default '0',
  com_to int(10) NOT NULL default '0',
  com_message text NOT NULL,
  com_date varchar(55) NOT NULL default '',
  com_type varchar(4) NOT NULL default '',
  com_extra varchar(255) NOT NULL default '',
  PRIMARY KEY  (com_id)
) TYPE=MyISAM;
CREATE TABLE another_profiles_vids (
  vid_id int(10) NOT NULL auto_increment,
  vid_uid int(10) NOT NULL default '0',
  vid_name varchar(30) NOT NULL default '',
  vid_desc varchar(255) NOT NULL default '',
  vid_embed text NOT NULL,
  vid_added varchar(55) NOT NULL default '',
  PRIMARY KEY  (vid_id)
) TYPE=MyISAM;
