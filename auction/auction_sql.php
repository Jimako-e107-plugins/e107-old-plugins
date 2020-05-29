CREATE TABLE auction_auctions (
  auction_id int(10) unsigned NOT NULL auto_increment,
  auction_name varchar(255) NOT NULL default '',
  auction_description text NOT NULL,
  auction_icon varchar(255) NOT NULL default '',
  auction_start_date int(10) unsigned NOT NULL default '0',
  auction_end_date int(10) unsigned NOT NULL default '0',
  auction_closed tinyint(1) unsigned NOT NULL default '0',
  auction_view_class tinyint(3) unsigned NOT NULL default '0',
  auction_edit_class tinyint(3) unsigned NOT NULL default '0',
  auction_owner int(10) unsigned NOT NULL default '0',
  auction_template varchar(50) NOT NULL default '',
  PRIMARY KEY  (auction_id)
) TYPE=MyISAM;
CREATE TABLE auction_lots (
  auction_lot_id int(10) unsigned NOT NULL auto_increment,
  auction_lot_auction_id int(10) unsigned NOT NULL default '0',
  auction_lot_title varchar(255) NOT NULL default '',
  auction_lot_description text NOT NULL,
  auction_lot_images text NOT NULL,
  auction_lot_reserve varchar(10) NOT NULL default '0',
  auction_lot_start_date int(10) unsigned NOT NULL default '0',
  auction_lot_end_date int(10) unsigned NOT NULL default '0',
  auction_lot_timestamp int(10) unsigned NOT NULL default '0',
  auction_lot_poster_id int(10) unsigned NOT NULL default '0',
  auction_lot_update_timestamp int(10) unsigned NOT NULL default '0',
  auction_lot_update_poster_id int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (auction_lot_id)
) TYPE=MyISAM;
CREATE TABLE auction_bids (
  auction_bid_timestamp int(10) unsigned NOT NULL default '0',
  auction_bid_lot_id int(10) unsigned NOT NULL default '0',
  auction_bid_bidder_id int(10) unsigned NOT NULL default '0',
  auction_bid_amount varchar(20) NOT NULL default '0',
  auction_bid_name varchar(255) NOT NULL default '',
  auction_bid_email varchar(255) NOT NULL default '',
  auction_bid_telephone varchar(25) NOT NULL default '',
  auction_bid_deleted tinyint(1) NOT NULL default '0'
) TYPE=MyISAM;