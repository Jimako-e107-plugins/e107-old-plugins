<?php

$text .= ujSearch();

function ujSearch() {
   global $search_info, $key, $pref, $query;
   $sql = new db();
   $gen2 = new convert;

   $nothingfound = true;
   $linkprefix = "<img src=\"".THEME."images/bullet2.gif\" alt=\"bullet\" /> <b><a href=\"".e_PLUGIN."userjournals_menu/userjournals.php?";

   $search_info[$key]['qtype'] = $pref["userjournals_page_title"];

   if ($sql->db_Select("userjournals", "*", "(userjournals_subject REGEXP('".$query."') OR userjournals_entry REGEXP('".$query."')) AND userjournals_is_blog_desc=0 AND userjournals_is_published=0 ORDER BY userjournals_timestamp DESC")) {
      $nothingfound = false;
      while($row = $sql -> db_Fetch()){
         extract($row);
         $que = parsesearch($userjournals_subject, $query)." (".$gen2->convert_date($userjournals_timestamp, "short").")";
         $ans = parsesearch($userjournals_entry, $query);
         if (eregi($query, $userjournals_subject)) {
            $text .= $linkprefix."blog.$userjournals_id\">$que</a></b><br /><span class=\"smalltext\">".UJ57."</span><br />$ans<br /><br />";
         }
         if (eregi($query, $userjournals_entry)) {
            $text .= $linkprefix."blog.$userjournals_id\">$que</a></b><br /><span class=\"smalltext\">".UJ58."</span><br />$ans<br /><br />";
         }
      }
   }

   if ($sql->db_Select("userjournals", "*", "userjournals_entry REGEXP('".$query."') AND userjournals_is_blog_desc=1 ORDER BY userjournals_timestamp DESC")) {
      $nothingfound = false;
      while($row = $sql -> db_Fetch()){
         extract($row);
         $que = parsesearch($userjournals_username, $query)." (".$gen2->convert_date($userjournals_timestamp, "short").")";
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
