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
| $Source: E:/cvs/cvsrepo/agenda/help.php,v $
| $Revision: 1.6 $
| $Date: 2005/11/08 21:35:15 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   require(e_PLUGIN."agenda/agenda_variables.php");

   $helptitle  = AGENDA_LAN_HELP_00_0;

   $helpcapt[] = AGENDA_LAN_HELP_03_0;
   $helptext[] = AGENDA_LAN_HELP_03_1;

   $helpcapt[] = AGENDA_LAN_HELP_06_0;
   $helptext[] = AGENDA_LAN_HELP_06_1;

   $helpcapt[] = AGENDA_LAN_HELP_07_0;
   $helptext[] = AGENDA_LAN_HELP_07_1;

   $helpcapt[] = AGENDA_LAN_HELP_02_0;
   $helptext[] = AGENDA_LAN_HELP_02_1;

   $helpcapt[] = AGENDA_LAN_HELP_12_0;
   $helptext[] = AGENDA_LAN_HELP_12_1;

   $helpcapt[] = AGENDA_LAN_HELP_11_0;
   $helptext[] = AGENDA_LAN_HELP_11_1;

//   $helpcapt[] = AGENDA_LAN_HELP_01_0;
//   $helptext[] = AGENDA_LAN_HELP_01_1;

   $helpcapt[] = AGENDA_LAN_HELP_04_0;
   $helptext[] = AGENDA_LAN_HELP_04_1;

   $helpcapt[] = AGENDA_LAN_HELP_08_0;
   $helptext[] = AGENDA_LAN_HELP_08_1;

   $helpcapt[] = AGENDA_LAN_HELP_05_0;
   $helptext[] = AGENDA_LAN_HELP_05_1;

   $text2 = "";
   for ($i=0; $i<count($helpcapt); $i++) {
      $text2 .= "<b>".$helpcapt[$i]."</b><br />";
   $text2 .=$helptext[$i]."<br /><br />";
   };

$ns -> tablerender($helptitle, $text2);
?>