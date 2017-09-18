<?php
   require_once("../../class2.php");
   if (!getperms("P")) {
      header("location:".e_BASE."index.php");
   }
   require_once(e_PLUGIN."eplayer/eplayer_variables.php");
   require_once(e_PLUGIN."eplayer/eplayer_utils.php");

   $tmp  = explode(".", e_QUERY);
   $id   = $tmp[0];

   $sql2 = new db();
   $sql2->db_Select("eplayer", "*", "id='$id'", true);
   list($id, $filename, $title, $category, $datestamp, $description, $icon, $width, $height, $author) = $sql2->db_Fetch();
   $mediaFunc = "eplayerGet".strtoupper(substr($filename, strrpos($filename, ".")+1));
   if(!function_exists($mediaFunc)) {
      $mediaFunc = "eplayerGetDefault";
   }
   $text = "<div style='text-align:center;'>$title<br/>$description<br/>";
   $text .= "<div style='border:1px solid;'>";
   $text .= call_user_func($mediaFunc, $filename, $width, $height);
   $text .= "</div></div>";
   print $text;
?>