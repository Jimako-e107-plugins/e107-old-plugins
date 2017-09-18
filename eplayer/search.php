<?php

require_once(e_PLUGIN."eplayer/eplayer_variables.php");

$search_info[$key]['qtype'] = $pref['eplayer_title'];
$clipsPerPage               = $pref['eplayer_clips_per_page'];
$nothingfound = false;

$linkprefix = "<img src=\"".THEME."images/bullet2.gif\" alt=\"bullet\" /> <b><a href=\"".e_PLUGIN."eplayer/eplayer.php?";
if ($results = $sql->db_Select("eplayer", "*", "title REGEXP('".$query."') OR description REGEXP('".$query."') ORDER BY id DESC ")){
   while($row = $sql -> db_Fetch()){
      extract($row);
      //if (eregxi($query, $title)) {
      if (preg_match("%".$query."%i", $title)) {
         $que = parsesearch($title, $query);
         $ans = parsesearch($description, $query);
         $text .= $linkprefix."view.$id.0.$clipsPerPage\">$que</a></b><br /><span class=\"smalltext\">".EPLAYER_LAN_28."</span><br />$ans<br /><br />";
      }
      //if (eregxi($query, $description)){
      if (preg_match("%".$query."%i", $description)){
         $que = parsesearch($title, $query);
         $ans = parsesearch($description, $query);
         $text .= $linkprefix."view.$id.0.$clipsPerPage\">$que</a></b><br /><span class=\"smalltext\">".EPLAYER_LAN_29."</span><br />$ans<br /><br />";
      }
   }
}

if ($results = $sql->db_Select("eplayer_category", "*", "name REGEXP('".$query."') OR description REGEXP('".$query."') ORDER BY id DESC ")){
   while($row = $sql -> db_Fetch()){
      extract($row);
      //if (eregxi($query, $name)) {
      if (preg_match("%".$query."%i", $name)) {
         $que = parsesearch($name, $query);
         $ans = parsesearch($description, $query);
         $text .= $linkprefix."cat.$id.0.$clipsPerPage\">$que</a></b><br /><span class=\"smalltext\">".EPLAYER_LAN_30."</span><br />$ans<br /><br />";
      }
      //if (eregxi($query, $description)){
      if (preg_match("%".$query."%i", $description)){
         $que = parsesearch($name, $query);
         $ans = parsesearch($description, $query);
         $text .= $linkprefix."cat.$id.0.$clipsPerPage\">$que</a></b><br /><span class=\"smalltext\">".EPLAYER_LAN_31."</span><br />$ans<br /><br />";
      }
   }
}

if ($nothingfound) {
   $text .= LAN_198;
}
?>