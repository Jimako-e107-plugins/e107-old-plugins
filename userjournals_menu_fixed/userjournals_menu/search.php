<?php

$text .= ujSearch();

function ujSearch() {
   global $search_info, $key, $query;
   $sql = new db();

   $plugPrefs = e107::pref('userjournals_menu');

   $nothingfound = true;
   $linkprefix = "<img src=\"".THEME_ABS."images/bullet2.gif\" alt=\"bullet\" /> <b><a href=\"".e_PLUGIN_ABS."userjournals_menu/userjournals.php?";

   $search_info[$key]['qtype'] = $plugPrefs["userjournals_page_title"];

   if ($sql->db_Select("userjournals", "*", "(userjournals_subject REGEXP('".$query."') OR userjournals_entry REGEXP('".$query."')) AND userjournals_is_blog_desc=0 AND userjournals_is_published=0 ORDER BY userjournals_timestamp DESC")) {
      $nothingfound = false;
      while($row = $sql -> db_Fetch()){
         extract($row);
         $time = e107::getDate()->convert_date($userjournals_timestamp, "short");
         $que = parsesearch($userjournals_subject, $query)." (".$time.")";
         $ans = parsesearch($userjournals_entry, $query);
		 if (preg_match('/'.$query.'/i', $userjournals_subject, $matches)) {
            $text .= $linkprefix."blog.$userjournals_id\">$que</a></b><br /><span class=\"smalltext\">".UJ57."</span><br />$ans<br /><br />";
		 }
		 if (preg_match('/'.$query.'/i', $userjournals_entry, $matches)) {
            $text .= $linkprefix."blog.$userjournals_id\">$que</a></b><br /><span class=\"smalltext\">".UJ58."</span><br />$ans<br /><br />";
         }
      }
   }

   if ($sql->db_Select("userjournals", "*", "userjournals_entry REGEXP('".$query."') AND userjournals_is_blog_desc=1 ORDER BY userjournals_timestamp DESC")) {
      $nothingfound = false;
      while($row = $sql -> db_Fetch()){
         extract($row);
         $que = parsesearch($userjournals_username, $query)." (".e107::getDate()->convert_date($userjournals_timestamp, "short").")";
         $ans = parsesearch($userjournals_entry, $query);
         $text .= $linkprefix."blogger.$userjournals_userid.$userjournals_username\">$que</a></b><br /><span class=\"smalltext\">".UJ59."</span><br />$ans<br /><br />";
      }
   }

   if ($nothingfound) {
      $text .= UJ56;
   }

   return $text;
}
?>
