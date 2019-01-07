<?php
   $menutitle  = "Forum Thanks Button Options";

   $butname[]  = LAN_AT11;
   $butlink[]  = "admin_readme.php";
   $butid[]    = "readme";

   $butname[]  = LAN_AT12;
   $butlink[]  = "admin_config.php";
   $butid[]    = "config";

   if (getperms("6")) {
   $butname[]  = LAN_AT13;
   $butlink[]  = "filemanager.php";
   $butid[]    = "filemanager";
   }
   
   $butname[]  = LAN_AT14;
   $butlink[]  = "admin_moderate.php";
   $butid[]    = "moderate";
   
  

   global $pageid;
   for ($i=0; $i<count($butname); $i++) {
      $var[$butid[$i]]['text'] = $butname[$i];
      $var[$butid[$i]]['link'] = $butlink[$i];
   };

   show_admin_menu($menutitle, $pageid, $var);
?>
