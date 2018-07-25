CREATE TABLE gold_system_history (
  gold_hist_id bigint(11) unsigned NOT NULL auto_increment,
  gold_hist_user_id int(11) unsigned NOT NULL default '0',
  gold_hist_date int(11) unsigned NOT NULL default '0',
  gold_hist_type text,
  gold_hist_amount decimal(14,2) NOT NULL default '0.00',
  gold_hist_who int(11) unsigned NOT NULL default '0',
  gold_hist_comment text,
  gold_hist_plugin varchar(100) default NULL,
  gold_hist_forum_post int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (gold_hist_id),
  KEY gold_hist_userid (gold_hist_user_id),
  KEY gold_hist_who (gold_hist_who)
) TYPE=MyISAM;
CREATE TABLE gold_system (
  gold_id bigint(11) unsigned NOT NULL default '0',
  gold_balance decimal(14,2) NOT NULL default '0.00',
  gold_spent decimal(14,2)  NOT NULL default '0.00',
  gold_credit decimal(14,2) NOT NULL default '0.00' ,
  gold_inv text,
  gold_orb text,
  gold_additional text,
  PRIMARY KEY  (gold_id)
) TYPE=MyISAM ;

