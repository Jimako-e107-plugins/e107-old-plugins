<?php

if (!defined('e107_INIT')) { exit; }


   $menutitle  = "Ratings Settings";

   $butname[]  = "Ratings Manager";
   $butlink[]  = "admin_config.php";
   $butid[]    = "";

   $butname[]  = "Ratings Options";
   $butlink[]  = "admin_config.php?options";
   $butid[]    = "options";
   
   $butname[]  = "Ratings Utils";
   $butlink[]  = "admin_config.php?utils";
   $butid[]    = "utils";
   
   $butname[]  = "Help Settings";
   $butlink[]  = "admin_config.php?help";
   $butid[]    = "help";

   global $pageid;
   for ($i=0; $i<count($butname); $i++) {
      $var[$butid[$i]]['text'] = $butname[$i];
      $var[$butid[$i]]['link'] = $butlink[$i];
   };

   show_admin_menu($menutitle, $pageid, $var);


?>