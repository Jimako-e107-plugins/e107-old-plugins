<?php
/*
+---------------------------------------------------------------+
+---------------------------------------------------------------+
*/
   require_once("../../class2.php");
   require_once(e_ADMIN."auth.php");

   if (!getperms("P")) {
      header("location:../../index.php");
   }

   if (file_exists(e_PLUGIN."userjournals_menu/languages/admin/".e_LANGUAGE.".php")){
      include_once(e_PLUGIN."userjournals_menu/languages/admin/".e_LANGUAGE.".php");
   } else {
      include_once(e_PLUGIN."userjournals_menu/languages/admin/English.php");
   }

   if (file_exists(e_PLUGIN."userjournals_menu/languages/".e_LANGUAGE.".php")){
      include_once(e_PLUGIN."userjournals_menu/languages/".e_LANGUAGE.".php");
   } else {
      include_once(e_PLUGIN."userjournals_menu/languages/English.php");
   }

   // Include the e107 Helper classes
   if (file_exists(e_PLUGIN."e107helpers/e107Helper.php")) {
      require_once(e_PLUGIN."e107helpers/e107Helper.php");
   } else {
      print "Fatal error, cannot find e107Helper class";
   }

   $pageid = JOURNAL_MENU_98;

   $ns -> tablerender(JOURNAL_MENU_98, ujConvertComments());

   require_once(e_ADMIN."footer.php");

function ujConvertComments() {
   $sql = new db();
   $count = $sql->db_Count("userjournals", "(userjournals_id)", "WHERE userjournals_is_comment='1'");

   $text .= "<p>".JOURNAL_A4."</p>";
   if ($count == 0) {
      $text .= "<p>".JOURNAL_A16."</p>";
   } else {
      if (isset($_GET["convert"]) && $_GET["convert"]=="1") {
         $text .= "<p><strong>".JOURNAL_A18."</strong></p>";
         if ($sql->db_Select("userjournals", "*", "userjournals_is_comment=1")){
            $sql2 = new db();
            while ($row = $sql->db_Fetch()){
               extract($row);
               $sqlerror = "";
               $subject = JOURNAL_A0;
               if ($sql2->db_Select("userjournals", "userjournals_subject", "userjournals_id=".$userjournals_comment_parent)){
                  if ($row = $sql2->db_Fetch()) {
                     $subject = $row[0];
                  }
               }

               $updatesql = "'', '0', '$userjournals_comment_parent', '$subject', '$userjournals_userid.$userjournals_username', '', '$userjournals_timestamp', '$userjournals_entry', '0', '0', 'userjourna', '0'";
               //print $updatesql."<br/>";
               if ($sql2->db_Insert('comments', $updatesql, true)) {
                  print mysql_error()."<br/>";
               }
            }
         }
         $sql2->db_Delete("userjournals", "userjournals_is_comment=1");
         $text .= "<p>".JOURNAL_A17."</p>";
      } else {
         $text .= "<p><a href='".e_SELF."?convert=1'>".JOURNAL_A5."</a></p>";
      }
   }
   return $text;
}
?>
