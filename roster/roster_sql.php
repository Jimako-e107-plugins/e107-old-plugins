CREATE TABLE roster_groups (
  roster_group_id int(10) NOT NULL auto_increment,
  roster_group_name varchar(255) NOT NULL,
  roster_group_order int(10) NOT NULL,
  PRIMARY KEY  (roster_group_id)
) TYPE=MyISAM;

CREATE TABLE roster_members (
  roster_member_id int(10) NOT NULL auto_increment,
  roster_member_name varchar(255) NOT NULL,
  roster_member_enlisted varchar(255) NOT NULL,
  roster_member_rank varchar(255) NOT NULL,
  roster_member_ranknum int(10) NOT NULL,
  roster_member_rankdate varchar(255) NOT NULL,
  roster_member_group int(10) NOT NULL,
  roster_member_serial varchar(255) NOT NULL,
  roster_member_unit varchar(255) NOT NULL,
  roster_member_unitreport varchar(255) NOT NULL,
  roster_member_duty varchar(255) NOT NULL,
  roster_member_dutyreport varchar(255) NOT NULL,
  roster_member_status varchar(255) NOT NULL,
  roster_member_pfile text NOT NULL,
  roster_member_location varchar(255) NOT NULL,
  roster_member_xfire varchar(255) NOT NULL,
  roster_member_awardss text NOT NULL,
  PRIMARY KEY (roster_member_id)
) TYPE=MyISAM;

