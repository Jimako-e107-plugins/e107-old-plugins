<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/
if(!defined("e107_INIT")) 
{
	require_once("class2.php");
}

if (strstr(e_QUERY, "untrack"))
{
	$tmp1 = explode(".", e_QUERY);
	$tmp = str_replace("-".$tmp1[1]."-", "", USERREALM);
	$sql->db_Update("user", "user_realm='".$tp -> toDB($tmp, true)."' WHERE user_id='".USERID."' ");
	header("location:".e_SELF."?track");
	exit;
}

require_once(HEADERF);
$qry = array("CREATE TABLE IF NOT EXISTS ".MPREFIX."clan_members_awardlink (
	  id int(11) NOT NULL AUTO_INCREMENT,
	  userid int(11) NOT NULL,
	  award int(11) NOT NULL,
	  awardtime int(15) NOT NULL,
	  PRIMARY KEY (id))",
	  "CREATE TABLE IF NOT EXISTS ".MPREFIX."clan_members_awards (
	  rid int(11) NOT NULL AUTO_INCREMENT,
	  title varchar(40) NOT NULL,
	  description text NOT NULL,
	  image varchar(50) NOT NULL,
	  position int(11) NOT NULL,
	  PRIMARY KEY (rid))",
	   "CREATE TABLE IF NOT EXISTS ".MPREFIX."clan_members_gallery (
	  id int(11) NOT NULL AUTO_INCREMENT,
	  userid int(11) NOT NULL,
	  url varchar(50) NOT NULL,
	  PRIMARY KEY (id))",
      "CREATE TABLE IF NOT EXISTS ".MPREFIX."clan_members_ranks (
	  rid int(11) NOT NULL AUTO_INCREMENT,
	  rank varchar(100) NOT NULL DEFAULT '',
	  rimage varchar(100) NOT NULL DEFAULT '',
	  rankorder int(2) NOT NULL DEFAULT '0',
	  PRIMARY KEY (rid))",
	  "ALTER TABLE ".MPREFIX."clan_members_config ADD inactiveafter INT(3) NOT NULL DEFAULT '0' AFTER leftsidewidth",
	  "UPDATE ".MPREFIX."clan_members_config SET version='1.01'");

$error = false;
for($i=0;$i<count($qry);$i++){
	if(!$sql->db_Query($qry[$i])) $error = true;
}
@unlink(e_PLUGIN."clanmembers/e_help.php");

if($error){
	$ns->tablerender("e107 Clan Members","Error while updating...");
}else{
	$ns->tablerender("e107 Clan Members","You successfully upgraded to the full version of the Clan Members plugin!");
}

require_once(FOOTERF);
exit;
?>