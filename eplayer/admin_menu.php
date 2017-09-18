<?php
/*
+---------------------------------------------------------------+
| ePlayer by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/eplayer/admin_menu.php,v $
| $Revision: 1.8 $
| $Date: 2007/01/24 00:01:56 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   require_once(e_PLUGIN."eplayer/eplayer_variables.php");

   $menutitle  = EPLAYER_LAN_NAME;

   $butname[]  = EPLAYER_LAN_MENU_00;
   $butlink[]  = "admin_media_local.php";
   $butid[]    = "media_local";

   $butname[]  = EPLAYER_LAN_MENU_03;
   $butlink[]  = "admin_media_remote.php";
   $butid[]    = "media_remote";

   $butname[]  = EPLAYER_LAN_MENU_04;
   $butlink[]  = "admin_image_local.php";
   $butid[]    = "image_local";

   $butname[]  = EPLAYER_LAN_MENU_05;
   $butlink[]  = "admin_image_remote.php";
   $butid[]    = "image_remote";

   $butname[]  = EPLAYER_LAN_MENU_01;
   $butlink[]  = "admin_categories.php";
   $butid[]    = "categories";

   $butname[]  = EPLAYER_LAN_MENU_02;
   $butlink[]  = "admin_prefs.php";
   $butid[]    = "prefs";

   $butname[]  = EPLAYER_LAN_MENU_06;
   $butlink[]  = "admin_viewer_prefs.php";
   $butid[]    = "viewerprefs";

   global $pageid;
   for ($i=0; $i<count($butname); $i++) {
      $var[$butid[$i]]['text'] = $butname[$i];
      $var[$butid[$i]]['link'] = $butlink[$i];
   };

   show_admin_menu($menutitle, $pageid, $var);
?>