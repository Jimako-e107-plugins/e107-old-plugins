<?php
/*
+---------------------------------------------------------------+
| Agenda by bugrain (www.bugrain.plus.com)
| see plugin.php for version information
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: E:/cvs/cvsrepo/agenda/admin_menu.php,v $
| $Revision: 1.6 $
| $Date: 2005/10/02 13:13:42 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   global $pageid;

   require(e_PLUGIN."agenda/agenda_variables.php");

   $menutitle = AGENDA_LAN_ADMIN_MENU_00;

   $butname[] = AGENDA_LAN_ADMIN_MENU_03;
   $butlink[] = "admin_prefs.php";
   $butid[]   = "prefs";

   $butname[] = AGENDA_LAN_ADMIN_MENU_06;
   $butlink[] = "admin_display.php";
   $butid[]   = "display";

   $butname[] = AGENDA_LAN_ADMIN_MENU_07;
   $butlink[] = "admin_view.php";
   $butid[]   = "view";

//   $butname[] = AGENDA_LAN_ADMIN_MENU_01;
//   $butlink[] = "admin_entries.php";
//   $butid[]   = "entries";

   $butname[] = AGENDA_LAN_ADMIN_MENU_02;
   $butlink[] = "admin_categories.php";
   $butid[]   = "categories";

   $butname[] = AGENDA_LAN_ADMIN_MENU_12;
   $butlink[] = "admin_reg.php";
   $butid[]   = "reg";

   $butname[] = AGENDA_LAN_ADMIN_MENU_11;
   $butlink[] = "admin_subs.php";
   $butid[]   = "subs";

   $butname[] = AGENDA_LAN_ADMIN_MENU_04;
   $butlink[] = "admin_types.php";
   $butid[]   = "types";

   $butname[] = AGENDA_LAN_ADMIN_MENU_08;
   $butlink[] = "admin_custom_fields.php";
   $butid[]   = "custom_fields";

   $butname[] = AGENDA_LAN_ADMIN_MENU_05;
   $butlink[] = "admin_import.php";
   $butid[]   = "import";

   $butname[] = AGENDA_LAN_ADMIN_MENU_09;
   $butlink[] = "admin_readme.php";
   $butid[]   = "readme";

   $butname[] = AGENDA_LAN_ADMIN_MENU_10;
   $butlink[] = "admin_docs.php";
   $butid[]   = "docs";

   for ($i=0; $i<count($butname); $i++) {
      $var[$butid[$i]]['text'] = $butname[$i];
      $var[$butid[$i]]['link'] = $butlink[$i];
   };

   show_admin_menu($menutitle, $pageid, $var);
?>