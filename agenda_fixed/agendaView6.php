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
| $Source: E:/cvs/cvsrepo/agenda/agendaView6.php,v $
| $Revision: 1.8 $
| $Date: 2006/04/02 15:56:13 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   $text .= "<div style='width:100%'>";
   $text .= agendaDrawNavigation("", "", AGENDA_LAN_VIEW_06);

   // Show the untimed entries for today
   $entries = false;
   $agn_limit = $pref["agenda_recent_adds_limit"];
   if (!is_integer($agn_limit)) {
      $agn_limit = 15;
   }
   if (!ADMIN) {
      if ($pref["agenda_private_calendar"] == "Y") {
         $where .= "where e(e.agn_author='".USERID.".".USERNAME."')";
      } else {
         $where .= "where (e.agn_private=0 or (e.agn_private=1 and (e.agn_author='".USERNAME."' or e.agn_author='".USERID.".".USERNAME."')))";
      }
   }
   $qry = $agenda->getTableJoin()."$where order by e.agn_datestamp desc, e.agn_id desc limit $agn_limit";

   $altrow = false;
   if ($agn_sql1->db_Select_gen($qry, $agenda->isDebug())) {
      $text .= "<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0' summary='*'>";
      $text .= "<tr>";
      $text .= "<td class='".$agenda->getPrefTodayCSS()."'>".AGENDA_LAN_FIELD_01_0."</td>";
      $text .= "<td class='".$agenda->getPrefTodayCSS()."'>".AGENDA_LAN_FIELD_02_0."</td>";
      $text .= "<td class='".$agenda->getPrefTodayCSS()."'>".AGENDA_LAN_FIELD_07_0."</td>";
      $text .= "<td class='".$agenda->getPrefTodayCSS()."'>".AGENDA_LAN_119."</td>";
      $text .= "</tr>";
      while ($agn_erow = $agn_sql1->db_Fetch()) {
         $altrowclass = $altrow ? $agenda->getPrefDayWithEntriesCSS() : $agenda->getPrefDayCSS();
         $text .= "<tr>";
         $altrow = !$altrow;
         $text .= "<td class='$altrowclass'>".agendaTempShortDate($agn_erow["agn_start"])."</td>";
         $text .= "<td class='$altrowclass'>".agendaTempShortDate($agn_erow["agn_end"])."</td>";
         $text .= "<td class='$altrowclass'>".agendaDrawEntryLink($agn_erow)."</td>";
         $text .= "<td class='$altrowclass'>".agendaTempShortDate($agn_erow["agn_datestamp"])."</td>";
         $text .= "</tr>";
      }
      $text .= "</table>";
      $entries = true;
   }
   $text .= "</div>";

function agendaTempShortDate($ds) {
   global $agenda;
   $tmp = $agenda->getDayName($ds);
   $tmp .= "&nbsp;".date("j", $ds);
   $tmp .= "&nbsp;".$agenda->getMonthName($ds);
   $tmp .= "&nbsp;".date("y", $ds);
   return $tmp;
}
?>