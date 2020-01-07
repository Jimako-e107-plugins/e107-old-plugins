<?php
   $menutitle  = "TagCloud Options";

   $butname[]  = "Preferences";
   $butlink[]  = "admin_config.php";
   $butid[]    = "config";

   $butname[]  = "Tag Style";
   $butlink[]  = "admin_style.php";
   $butid[]    = "style";

   $butname[]  = "Maintenance";
   $butlink[]  = "admin_maintenance.php";
   $butid[]    = "maintenance";

   $butname[]  = "Read Me";
   $butlink[]  = "admin_readme.php";
   $butid[]    = "readme";

   global $pageid;
   for ($i=0; $i<count($butname); $i++) {
      $var[$butid[$i]]['text'] = $butname[$i];
      $var[$butid[$i]]['link'] = $butlink[$i];
   };

   show_admin_menu($menutitle, $pageid, $var);
?>
