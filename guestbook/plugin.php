<?php
  /*
  +---------------------------------------------------------------+
  |
  |	e107 website system
  |	GUESTBOOK PLUGIN V4.0
  |
  |	Released under the terms and conditions of the
  |	GNU General Public License Version 2 (http://gnu.org).
  |
  +---------------------------------------------------------------+
  | original: ©Andrew Rockwell 2003
  |	      http://2sdw.com
  |           chavo@2sdw.com
  +---------------------------------------------------------------+
  | updates:  ©Richard Perry 2005
  |           http://www.greycube.com
  |           code@greycube.com
  +---------------------------------------------------------------+
  | updates:  ©Titanik 2007
  |          http://upc.utc.sk
  |           tomasss@inmail.sk
  +---------------------------------------------------------------+
  | updates:  ©Smarti October 2007
  |          http://www.platinwebservice.de
  |           webmaster@platinwebservice.de
  +---------------------------------------------------------------+
  */

  @include_once(e_PLUGIN."guestbook/languages/".e_LANGUAGE.".php");
  @include_once(e_PLUGIN."guestbook/languages/English.php");

// --------- Plugin Info -----------------------------------------+

  $eplug_name        = GB_LAN_ADM_NAME;
  $eplug_version     = "4.02";
  $eplug_author      = "Chavo & Rich & Titanik<br> new functions by Smarti";
  $eplug_url         = "http://upc.utc.sk";
  $eplug_email       = "tomasss@inmail.sk";
  $eplug_description = GB_LAN_ADM_NAME;
  $eplug_compatible  = "e107v7";
  $eplug_readme      = "readme.txt";
  $eplug_compliant   = TRUE;
  $eplug_module      = FALSE;
  $eplug_status		 = TRUE;
  $eplug_notify		 = TRUE;
  $eplug_latest		 = TRUE;

  $eplug_folder      = "guestbook";
  $eplug_menu_name   = GB_LAN_ADM_NAME;
  $eplug_conffile    = "admin_guestbook.php";

  $eplug_logo        = "icon_large.png";
  $eplug_icon        = "$eplug_folder/icon_large.png";
  $eplug_icon_small  = "$eplug_folder/icon_small.png";
  $eplug_caption     = 'Configure Guestbook';  

// ------- Preferences --------------------------------------------+

  $eplug_prefs = array(

  "guestbook_version"   => $eplug_version,
  "guestbook_posts"   => "10",
  "guestbook_enclose" => "1",
  "guestbook_title"   => GB_LAN_ADM_NAME,
  "guestbook_bbcode"  => "0",
  "guestbook_repeat"  => "0",
  "guestbook_nolinks" => "1",
  "guestbook_hideurl" => "1",
  "guestbook_securecode" => "0",
  "guestbook_edittime" => "5",
  "guestbook_moderator_class" => 254,
  "guestbook_moderate" => "1"

  );

// MYSQL Tables ---------------------------------------------------+

  $eplug_table_names = array("guestbook");

// MYSQL Tables Structure -----------------------------------------+

  $eplug_tables = array(
  
  "CREATE TABLE ".MPREFIX."guestbook (

  `id`      int(11)      NOT NULL auto_increment,
  `name`    varchar(128) NOT NULL default '',
  `email`   varchar(128) NOT NULL default '',
  `url`     varchar(128) NOT NULL default '',
  `date`    int(11)      NOT NULL default '0',
  `ip`		varchar(15)	 NOT NULL default '',
  `host`    varchar(128) NOT NULL default '',
  `comment` text         NOT NULL default '',
  `user`    int(11)      NOT NULL default '0',
  `block`	int(1)		 NOT NULL default '0',

   PRIMARY KEY  (id)) TYPE=MyISAM;");

// Link in Site Menu ---------------------------------------------+

  $eplug_link      = TRUE;
  $eplug_link_name = GB_LAN_ADM_NAME;
  $eplug_link_url  = e_PLUGIN."$eplug_folder/guestbook.php";

//MESSAGE WHEN PLUGIN IS INSTALLED--------------------------------+

  $eplug_done = GB_LAN_DONE;

//SAME AS ABOVE BUT ONLY RUN WHEN CHOOSING UPGRADE----------------+
if(!isset($pref["guestbook_version"]) || $pref["guestbook_version"]<"3.72") {
  $upgrade_add_prefs    = array("guestbook_version"   => $eplug_version);
  $upgrade_remove_prefs = array("guestbook_hideprofile");
  
  $upgrade_alter_tables = array();
if (!isset($pref["guestbook_version"]) || $eplug_version < "4.0" || $eplug_version < "v4.0") {
   $gbtemp = array(
   	  "ALTER TABLE ".MPREFIX."guestbook ADD ip varchar(15) NOT NULL default '' AFTER date;",
      "ALTER TABLE ".MPREFIX."guestbook ADD block int(1) NOT NULL default '0' AFTER user;",
   );
   $upgrade_alter_tables = array_merge($upgrade_alter_tables, $gbtemp);
}


global $sql;
if($sql -> db_Update("guestbook", "block='1'"))
  $eplug_upgrade_done   = GB_LAN_UPDONE;
}

//---------------------------------------------------------------------------------------------------------+

?>
