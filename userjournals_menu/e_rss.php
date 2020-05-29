<?php
/*
+---------------------------------------------------------------+
|        UserJournals plugin for e107 website system
|
|        ©Del Rudolph 2003
|        http://www.downinit.com/
|        del@downinit.com
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

if (!defined("e107_INIT")) { exit; }

//##### create feed for admin, return array $eplug_rss_feed --------------------------------
$feed["name"]     = "userjournals name";
$feed["url"]      = "userjournals";          // the identifier for the rss feed url
$feed["topic_id"] = "";                      // the topic_id, empty on default (to select a certain category)
$feed["path"]     = "userjournals_menu";     // this is the plugin path location
$feed["text"]     = "userjournals text";
$feed["class"]    = "0";
$feed["limit"]    = "9";
//##### ------------------------------------------------------------------------------------

//##### create rss data, return as array $eplug_rss_data -----------------------------------
$rss = array();
if ($items = $sql->db_Select("userjournals", "*", "userjournals_is_comment=0 AND userjournals_is_blog_desc=0 ORDER BY userjournals_timestamp DESC LIMIT 0,".$this -> limit)) {
   $i = 0;
   while ($rowrss = $sql->db_Fetch()){
      $rss[$i]["author"]         = "1".$rowrss["userjournals_userid"];
      $rss[$i]["author_email"]   = "2"."";
      $rss[$i]["title"]          = $rowrss["userjournals_subject"];
      $rss[$i]["link"]           = $e107->base_path.$PLUGINS_DIRECTORY."userjournals_menu/userjournals.php?blog.".$rowrss["userjournals_id"];
      $rss[$i]["description"]    = $tp->html_truncate($rowrss["userjournals_entry"]);
      $rss[$i]["enc_url"]        = "";
      $rss[$i]["enc_leng"]       = "";
      $rss[$i]["enc_type"]       = "";
      $rss[$i]["category_name"]  = "6".$rowrss["userjournals_categories"];
      $rss[$i]["category_link"]  = "7".$rowrss["userjournals_categories"];
      $rss[$i]["datestamp"]      = "8".$rowrss["userjournals_timestamp"];
      $i++;
   }
}
//##### ------------------------------------------------------------------------------------

$eplug_rss_feed[] = $feed;
$eplug_rss_data[] = $rss;

?>