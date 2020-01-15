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
| $Source: E:/cvs/cvsrepo/agenda/agendaView11.php,v $
| $Revision: 1.2 $
| $Date: 2005/11/11 20:09:49 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   $text .= "<div style='width:100%'>";
   $tmp = $agenda->getDayName($agenda->getTodayDS(), true);
   $tmp .= "&nbsp;".date("j", $agenda->getTodayDS());
   $tmp .= "&nbsp;".$agenda->getMonthName($agenda->getTodayDS(), true);
   $tmp .= "&nbsp;".date("Y", $agenda->getTodayDS());
   if (!$agenda->isPrint()) {
      $text .= agendaDrawNavigation("", "", $tmp);
   } else {
      $text .= agendaDrawDate($tmp);
   }

   $text .= "<table style='width:100%'><tr><td valign='top'>";
   $text .= "<table style='width:100%'>";

   $text .= "<tr><td valign='top'>";
   $text .= $agenda->persViewSummary();
   $text .= "</td></tr>";
   $text .= "<tr><td valign='top'>";
   $text .= $agenda->persViewUpcoming();
   $text .= "</td></tr>";
   $text .= "<tr><td valign='top'>";
   $text .= $agenda->persViewRegistrations();
   $text .= "</td></tr>";

   $text .= "</table>";

   $text .= "</td><td valign='top'>";

   $text .= "<table style='width:100%'>";

   $text .= "<tr><td valign='top'>";
   $text .= $agenda->persViewSubscriptions();
   $text .= "</td></tr>";
   $text .= "<tr><td valign='top'>";
   $text .= $agenda->persViewFilter();
   $text .= "</td></tr>";

   $text .= "</td></tr></table>";

   $text .= "</table>";
   $text .= "<div class='smalltext' style='text-align:right'>".AGENDA_LAN_139."</div>";


   $text .= "</div>";
   //if (!$agenda->isPrint()) {
   //   $text .= "<a href='../../print.php?plugin:agenda.".$agenda->getP1().".".$agenda->getP2().".".$agenda->getP3().".".$agenda->getP4().".".$agenda->getP5()."' target='_blank'>".AGENDA_LAN_125."</a>";
   //}
?>