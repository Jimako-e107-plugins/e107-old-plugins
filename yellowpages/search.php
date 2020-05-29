<?php

if (file_exists(e_PLUGIN."yellowpages/language/".e_LANGUAGE.".php")){
   require_once(e_PLUGIN."yellowpages/language/".e_LANGUAGE.".php");
} else {
   require_once(e_PLUGIN."yellowpages/language/English.php");
}

//$search_info[$key]['qtype'] = $pref['yellowpages_title'];
$nothingfound = true;

$linkprefix = "<img src=\"".THEME."images/bullet2.gif\" alt=\"bullet\" /> <b><a href=\"".e_PLUGIN."yellowpages/yellowpages.php?";
$yell_sql = new db();
if ($results = $yell_sql->db_Select("yellowpages", "*", "yell_name REGEXP('".$query."') OR yell_description REGEXP('".$query."') ORDER BY yell_id DESC ")){
   while($row = $yell_sql -> db_Fetch()){
      extract($row);
      if (eregi($query, $yell_name)) {
         $que = parsesearch($yell_name, $query);
         $ans = parsesearch($yell_description, $query);
         $text .= $linkprefix."view.$yell_id\">$que</a></b><br /><span class=\"smalltext\">".YELL_09."</span><br />$ans<br /><br />";
         $nothingfound = false;
      }
      if (eregi($query, $yell_description)){
         $que = parsesearch($yell_name, $query);
         $ans = parsesearch($yell_description, $query);
         $text .= $linkprefix."view.$yell_id\">$que</a></b><br /><span class=\"smalltext\">".YELL_10."</span><br />$ans<br /><br />";
         $nothingfound = false;
      }
   }
}

if ($nothingfound) {
   $text .= LAN_198;
}
?>