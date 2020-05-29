<?php
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
if (!isset($tp)) {
   $tp = new e_parse();
   $tp->e_sc = new e_shortcode();
}
global $userjournals_shortcodes;
$userjournals_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
require_once(e_FILE."shortcode/batch/user_shortcodes.php");
$userjournals_shortcodes = array_merge($userjournals_shortcodes, $user_shortcodes);
/*

// ---------------------------------------------------------------------------------------------------------------------------------------------------
SC_BEGIN UJ_BLOGGER_NAME
   global $uj_blog;
   $text = "";
   if ($row = get_user_data($uj_blog["userjournals_userid"])) {
      $text = $row["user_name"];
   }
   return $text;
SC_END

SC_BEGIN UJ_BLOGGER_TIMESTAMP
   global $uj_blog;
   $gen2 = new convert();
   return $gen2->convert_date($uj_blog["userjournals_timestamp"], "long");
SC_END

SC_BEGIN UJ_BLOGGER_LINK
   global $uj_blog;
   return "<a href='".e_PLUGIN."userjournals_menu/userjournals.php?blogger.".$uj_blog["userjournals_userid"]."'>".UJ90."</a>";
SC_END

SC_BEGIN UJ_BLOGGER_MENU_LINK
   global $uj_blog;
   $gen2 = new convert();
   if ($row = get_user_data($uj_blog["userjournals_userid"])) {
      return "<a href='".e_PLUGIN."userjournals_menu/userjournals.php?blogger.".$uj_blog["userjournals_userid"]."'>".$row["user_name"]."</a><br/>".$gen2->convert_date($uj_blog["userjournals_timestamp"], "short");
   }
   return "";
SC_END

SC_BEGIN UJ_BLOGGER_PICTURE
   global $pref, $tp, $uj_synopsis, $user, $user_shortcodes;
   $text = "";
   if (isset($pref['photo_upload']) && $pref['photo_upload']) {
      if ($user = get_user_data($uj_synopsis["userjournals_userid"])) {
         $text = $tp->parseTemplate("{USER_PICTURE}", TRUE, $user_shortcodes);
         if ($text == "LAN_408") {
            $text = "";
         }
      }
   }
   return $text;
SC_END

SC_BEGIN UJ_BLOGGER_SYNOPSIS
   global $e107Helper, $uj_synopsis;
   return $e107Helper->tp_toHTML($uj_synopsis["userjournals_entry"], true);
SC_END

SC_BEGIN UJ_BLOG_LINK
   global $uj_blog;
   return "<a href='".e_PLUGIN."userjournals_menu/userjournals.php?blog.".$uj_blog["userjournals_id"]."'>".UJ48."</a>";
SC_END

SC_BEGIN UJ_BLOG_MOOD
   global $uj_blog;
   $text = "";
   if (strlen($uj_blog["userjournals_mood"]) > 0) {
      $text = "<img src='".e_PLUGIN."userjournals_menu/images/".$uj_blog["userjournals_mood"].".gif' alt='*'/>";
   }
   return $text;
SC_END

SC_BEGIN UJ_BLOG_SUBJECT
   global $uj_blog;
   return $uj_blog["userjournals_subject"];
SC_END

SC_BEGIN UJ_BLOG_DATE
   global $uj_blog;
   $gen2 = new convert();
   $text = "";
   parse_str($parm, $parms);
   if (array_key_exists("label", $parms)) {
      $text .= UJ46;
   }
   $text .= $gen2->convert_date($uj_blog["userjournals_timestamp"], "short");
   return $text;
SC_END

SC_BEGIN UJ_BLOG_CATEGORIES
   global $pref, $tp, $uj_blog, $uj_categories, $uj_category, $userJournals;
   $text = "";
   if ($pref["userjournals_show_cats"] != 0 && strlen($uj_blog["userjournals_categories"]) > 0) {
      parse_str($parm, $parms);
      if (array_key_exists("label", $parms)) {
         $text .= UJ91.": ";
      }
      $userjournals_categories = explode(",", $uj_blog["userjournals_categories"]);
      for ($i=0; $i<count($userjournals_categories); $i++) {
         $uj_category = $uj_categories[$userjournals_categories[$i]];
         $text .= $tp->parseTemplate("{UJ_CATEGORY_LINK}", FALSE, $userjournals_shortcodes);

         if ($i<count($userjournals_categories)-1) {
            $text .= ", ";
         }
      }
   }
   return $text;
SC_END

SC_BEGIN UJ_BLOG_NOW_PLAYING
   global $uj_blog;
   $text = "";
   if (!$limit && strlen($uj_blog["userjournals_playing"]) > 0) {
      parse_str($parm, $parms);
      if (array_key_exists("label", $parms)) {
         $text .= UJ41." ";
      }
      $text .= $uj_blog["userjournals_playing"];
   }
   return $text;
SC_END

SC_BEGIN UJ_BLOG_EDIT_LINK
   global $uj_blog;
   $text = "";
   if ($uj_blog["userjournals_userid"] == USERID) {
      $text .= "<a href='".e_PLUGIN."userjournals_menu/userjournals.php?edit.".$uj_blog["userjournals_id"]."'>".UJ4."</a>";
   }
   return $text;
SC_END

SC_BEGIN UJ_BLOG_DELETE_LINK
   global $uj_blog;
   $text = "";
   if ($uj_blog["userjournals_userid"] == USERID || ADMIN) {
      $text .= "<a href='#' onclick='e107Helper.confirmDelete(\"".UJ60."\", \"".e_PLUGIN."userjournals_menu/userjournals.php?delete.".$uj_blog["userjournals_id"]."\");'>".UJ19."</a>";
   }
   return $text;
SC_END

SC_BEGIN UJ_BLOG_REPORT_LINK
   global $uj_blog;
   $text = "";
   if (USERID && $pref['userjournals_report_blog']) {
      $text .= "<a href='".e_PLUGIN."userjournals_menu/userjournals.php?report.".$uj_blog["userjournals_id"]."'>".UJ101."</a>";
   }
   return $text;
SC_END

SC_BEGIN UJ_BLOG_BLOGGER_LINK
   global $uj_blog;
   $user = get_user_data($uj_blog["userjournals_userid"]);
   return "<a href='".e_PLUGIN."userjournals_menu/userjournals.php?blogger.".$uj_blog["userjournals_userid"]."'>".$user["user_name"]." ".UJ1."</a>";
SC_END

SC_BEGIN UJ_BLOG_ENTRY
   global $e107Helper, $uj_blog;
   $text = $e107Helper->tp_toHTML($uj_blog["userjournals_entry"], true);
   return $text;
SC_END

SC_BEGIN UJ_BLOG_ENTRY_SHORT
   global $e107Helper, $pref, $tp, $uj_blog;
   $text = $e107Helper->tp_toHTML($uj_blog["userjournals_entry"], true);
   // use this when e107 helkpers 0.7+ released $userjournals_entry = $e107Helper->tp_toHTML($userjournals_entry, true, $limit, "");
   $text = $tp->html_truncate($text, $pref["userjournals_len_preview"], "...");
   return $text;
SC_END

SC_BEGIN UJ_BLOG_RATINGS
   global $e107Helper, $pref, $uj_blog;
   $text = "";
   if (check_class($pref["userjournals_allowratings"])) {
      $text .= $e107Helper->getRating2("userjourna", $uj_blog["userjournals_id"]);
   }
   return $text;
SC_END

SC_BEGIN UJ_BLOG_COMMENTS
   global $e107Helper, $pref, $uj_blog;
   $text = "";
   if (check_class($pref["userjournals_allowcomments"])) {
      $text .= $e107Helper->getComment("userjourna", $uj_blog["userjournals_id"]);
   }
   return $text;
SC_END

SC_BEGIN UJ_BLOG_COMMENTS_TOTAL
   global $e107Helper, $pref, $uj_blog;
   $text = "";
   parse_str($parm, $parms);
   if (array_key_exists("label", $parms)) {
      $text .= UJ30." ";
   }
   if (check_class($pref["userjournals_allowcomments"])) {
      $text .= $e107Helper->getCommentTotal("userjourna", $uj_blog["userjournals_id"]);
   }
   return $text;
SC_END

SC_BEGIN UJ_CATEGORY_LIST
   global $uj_categories;
   return $uj_categories;
SC_END

SC_BEGIN UJ_CATEGORY_LIST_HEADING
   return UJ98;
SC_END

SC_BEGIN UJ_CATEGORY_LINK
   global $uj_category;
   return "<a href='".e_PLUGIN."userjournals_menu/userjournals.php?cat.".$uj_category["userjournals_cat_id"]."'>".$uj_category["userjournals_cat_name"]."</a>";
SC_END

SC_BEGIN UJ_CATEGORY_MENU_LINK
   global $uj_category;
   return "<a href='".e_PLUGIN."userjournals_menu/userjournals.php?cat.".$uj_category["userjournals_cat_id"]."'>".$uj_category["userjournals_cat_name"]."</a>";
SC_END

SC_BEGIN UJ_CATEGORY_START
   return " ";
SC_END

SC_BEGIN UJ_CATEGORY_END
   return " ";
SC_END

SC_BEGIN UJ_CATEGORY_ICON
   global $uj_category;
   $text = "";
   if (strlen($uj_category["userjournals_cat_icon"]) > 0 && file_exists(e_IMAGE.$uj_category["userjournals_cat_icon"])) {
      $text .= "<img src='".e_IMAGE.$uj_category["userjournals_cat_icon"]."'> ";
   }
   return $text;
SC_END

SC_BEGIN UJ_MENU_READER
   global $pref, $sql, $tp, $uj_blog, $userjournals_shortcodes, $UJ_BLOGGER_LIST;
   $text = "";
   if (check_class($pref["userjournals_readers"]) || check_class($pref["userjournals_writers"])) {
      $text .= "<a href='".e_PLUGIN."userjournals_menu/userjournals.php?allblogs'>".UJ61."</a><br/>";
      $text .= "<a href='".e_PLUGIN."userjournals_menu/userjournals.php'>".UJ50."</a><br/>";
      if ($pref["userjournals_show_cats"] == 1) {
         $text .= "<a href='".e_PLUGIN."userjournals_menu/userjournals.php?allcats'>".UJ92."</a><br/>";
      }
   }
   return $text;
SC_END

SC_BEGIN UJ_MENU_READER_CATEGORIES
   global $pref, $sql, $tp, $uj_categories, $uj_category, $uj_blog, $userjournals_shortcodes, $UJ_BLOGGER_LIST;
   $text = "";
   if (check_class($pref["userjournals_readers"]) || check_class($pref["userjournals_writers"])) {
      if ($pref["userjournals_show_cats"] == 1) {
         $keys = array_keys($uj_categories);
         foreach ($keys as $key) {
            $uj_category = $uj_categories[$key];
            $text .= $tp->parseTemplate("{UJ_CATEGORY_MENU_LINK}", FALSE, $userjournals_shortcodes);
         }
      }
   }
   return $text;
SC_END

SC_BEGIN UJ_MENU_READER_BLOGGERS
   global $pref, $tp, $uj_blog, $userjournals_shortcodes;
   $sql2 = new db();
   $text = "";
   if (check_class($pref["userjournals_readers"]) || check_class($pref["userjournals_writers"])) {
      $limit = "";
      if (isset($pref["userjournals_bloggers_menu_max"]) && $pref["userjournals_bloggers_menu_max"] > 0) {
         $limit = "limit ".$pref["userjournals_bloggers_menu_max"];
      }
      if ($count = $sql2->db_Select("userjournals", "distinct(userjournals_userid) as id, max(userjournals_timestamp) as ts", "userjournals_is_comment=0 AND userjournals_is_blog_desc=0 AND userjournals_is_published=0 group by id order by ts desc $limit")){
         while($uj_blog = $sql2->db_Fetch()) {
            $text .= $tp->parseTemplate("{UJ_BLOGGER_MENU_LINK}", FALSE, $userjournals_shortcodes);
         }
      } else {
         $text .= UJ28;
      }
   }
   return $text;
SC_END

SC_BEGIN UJ_RSS
   global $pref, $tp, $userjournals_shortcodes;
   $text = "";
   if ($pref["userjournals_show_rss"] == 1) {
      $text .= $tp->parseTemplate("{UJ_RSS_1}", FALSE, $userjournals_shortcodes);
      $text .= $tp->parseTemplate("{UJ_RSS_2}", FALSE, $userjournals_shortcodes);
      $text .= $tp->parseTemplate("{UJ_RSS_3}", FALSE, $userjournals_shortcodes);
   }
   return $text;
SC_END

SC_BEGIN UJ_RSS_1
   return "<a href='".e_PLUGIN."rss_menu/rss.php?userjournals.1'><img src='".e_PLUGIN."rss_menu/images/rss1.png' alt='rss1'/></a>";
SC_END

SC_BEGIN UJ_RSS_2
   return "<a href='".e_PLUGIN."rss_menu/rss.php?userjournals.2'><img src='".e_PLUGIN."rss_menu/images/rss2.png' alt='rss2'/></a>";
SC_END

SC_BEGIN UJ_RSS_3
   return "<a href='".e_PLUGIN."rss_menu/rss.php?userjournals.3'><img src='".e_PLUGIN."rss_menu/images/rss3.png' alt='rdf'/></a>";
SC_END

SC_BEGIN UJ_MENU_WRITER_OPTIONS
   global $pref, $sql, $tp, $uj_blog, $userjournals_shortcodes;
   $text = "";
   if (check_class($pref["userjournals_writers"])) {
      $text .= "&bull;<a href='".e_PLUGIN."userjournals_menu/userjournals.php?blogger.".USERID."'>".UJ11."</a><br/>";
      $text .= "&bull;<a href='".e_PLUGIN."userjournals_menu/userjournals.php?add'>".UJ10."</a><br/>";
      $text .= "&bull;<a href='".e_PLUGIN."userjournals_menu/userjournals.php?synopsis'>".UJ52."</a><br/>";
   }
   return $text;
SC_END

SC_BEGIN UJ_MENU_WRITER_RECENT
   global $pref, $sql, $tp, $uj_blog, $userjournals_shortcodes;
   $gen2 = new convert;
   $text ="";
   if ($sql->db_Select("userjournals", "*", "userjournals_userid='".USERID."' AND userjournals_is_comment=0 AND userjournals_is_blog_desc=0 AND userjournals_is_published=0 ORDER BY userjournals_timestamp DESC LIMIT ".$pref["userjournals_recent_entries"])){
      while($row = $sql->db_Fetch()){
         extract($row);
         if (strlen($userjournals_subject) > $pref["userjournals_len_subject"]){
            $userjournals_subject = substr($userjournals_subject,0,$pref["userjournals_len_subject"])." ...";
         }
         $text .= "&bull;<a href='".e_PLUGIN."userjournals_menu/userjournals.php?blog.$userjournals_id'>$userjournals_subject</a><br/>";
         $text .= "<div style='padding-left:8px;'>".$gen2->convert_date($userjournals_timestamp, "short")."</div>";
      }
   } else {
      $text .= UJ28."<br/>";
   }
   return $text;
SC_END


SC_BEGIN UJ_MENU_WRITER_UNPUBLISHED
   global $pref, $sql, $tp, $uj_blog, $userjournals_shortcodes;
   $gen2 = new convert;
   $text ="";
   if ($sql->db_Select("userjournals", "*", "userjournals_userid='".USERID."' AND userjournals_is_comment=0 AND userjournals_is_blog_desc=0 AND userjournals_is_published=1 ORDER BY userjournals_timestamp DESC LIMIT ".$pref["userjournals_recent_entries"])){
      while($row = $sql->db_Fetch()){
         extract($row);
         if (strlen($userjournals_subject) > $pref["userjournals_len_subject"]){
            $userjournals_subject = substr($userjournals_subject,0,$pref["userjournals_len_subject"])." ...";
         }
         $text .= "&bull;<a href='".e_PLUGIN."userjournals_menu/userjournals.php?edit.$userjournals_id'>$userjournals_subject</a><br/>";
         $text .= "<div style='padding-left:8px;'>".$gen2->convert_date($userjournals_timestamp, "short")."</div>";
      }
   } else {
      $text .= UJ67;
   }
   return $text;
SC_END

SC_BEGIN UJ_MESSAGE
   global $uj_message;
   return $uj_message;
SC_END

SC_BEGIN UJ_MESSAGE_EXTRA
   global $uj_message2;
   $text = "";
   if ($uj_message2 !== false) {
      $text = $uj_message2;
   }
   $uj_message2 = "";
   return $text;
SC_END

*/
?>
