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
| $Source: e:\_repository\e107_plugins/agenda/agendaView0.php,v $
| $Revision: 1.12 $
| $Date: 2006/11/29 01:17:01 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   $text .= "<div style='width:100%'>";
   if (!$agenda->isPrint()) {
      $text .= agendaDrawNavigation($agenda->getDateDS()+$agenda->getOneDay(), $agenda->getDateDS()-$agenda->getOneDay(), getFormattedDate($agenda->getDateDS(), true));
   } else {
      $text .= agendaDrawDate($tmp);
   }

   $entries = false;

   // Show the untimed entries for today
   if ($agenda->hasUntimed($agenda->getDateDS())) {
      $ix = 0;
      $text .= "<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0' border='1'><tr><td class='".$agenda->getPrefDayWithEntriesCSS()."'>";
      while ($event = $agenda->getEvent($agenda->getDateDS(), $ix++)) {
         if ($event->isUntimed()) {
            $text .= "<div style='padding-bottom:3px;'>".$event->drawLink()."</div>";;
            $entries = true;
         }
      }
      $text .= "</td></tr></table>";
   }

   // Show the timed entries for today
   $ix = 0;
   $dayentries = array("","","","","","","","","","","","","","","","","","","","","","","","");
   while ($event = $agenda->getEvent($agenda->getDateDS(), $ix++)) {
      if ($event->isTimed()) {
         $dayentries[date("G", $event->getAgnStart())] .= "<div style='padding-bottom:3px;'>".$event->drawLink()."</div>";
         $entries = true;
      }
   }

   $hour = 0;
   $text .= "<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0' border='1'>";
   for ($hour=0; $hour<24; $hour++) {
      if (strlen($dayentries[$hour]) > 0) {
         $text .= "<tr><td class='".$agenda->getPrefTodayCSS()." smalltext' style='text-align:right' valign='top'>".$hour.":00</td>";
         $text .= "<td class='".$agenda->getPrefTodayCSS()."' colspan='2' style='width:90%'>";
         $text .= $dayentries[$hour]."</td></tr>";
         $entries = true;
      } else {
         if ($pref["agenda_compress_day"] != "Y") {
            $text .= "<tr><td class='".$agenda->getPrefDayCSS()." smalltext' style='text-align:right' valign='top'>".$hour.":00</td>";
            $text .= "<td class='".$agenda->getPrefDayCSS()." smalltext' style='width:90%'>&nbsp;</td></tr>";
         }
      }
   }

   if (!$entries && $pref["agenda_compress_day"] == "Y") {
      $text .= "<tr><td class='".$agenda->getPrefDayCSS()."' style='text-align:center' valign='top'>$entries".AGENDA_LAN_30."</td></tr>";
   }

   $text .= "</table></div>";
   if (!$agenda->isPrint()) {
      $text .= "<a href='../../print.php?plugin:agenda.".$agenda->getP1().".".$agenda->getP2().".".$agenda->getP3().".".$agenda->getP4().".".$agenda->getP5()."' target='_blank'>".AGENDA_LAN_125."</a>";
   }
?>