<?php
/*
+---------------------------------------------------------------+
+---------------------------------------------------------------+
*/
   $menutitle  = JOURNAL_A0;

   $butname[]  = JOURNAL_MENU_00;
   $butlink[]  = "admin_conf.php";
   $butid[]    = JOURNAL_MENU_00;

   $butname[]  = JOURNAL_MENU_01;
   $butlink[]  = "admin_categories.php";
   $butid[]    = JOURNAL_MENU_01;

   $butname[]  = JOURNAL_MENU_98;
   $butlink[]  = "admin_convert_comments.php";
   $butid[]    = JOURNAL_MENU_98;

   $butname[]  = JOURNAL_MENU_99;
   $butlink[]  = "admin_readme.php";
   $butid[]    = JOURNAL_MENU_99;

   global $pageid;
   for ($i=0; $i<count($butname); $i++) {
      $var[$butid[$i]]['text'] = $butname[$i];
      $var[$butid[$i]]['link'] = $butlink[$i];
   };

   show_admin_menu($menutitle, $pageid, $var);
?>