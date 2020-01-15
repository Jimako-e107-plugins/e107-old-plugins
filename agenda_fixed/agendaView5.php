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
| $Source: e:\_repository\e107_plugins/agenda/agendaView5.php,v $
| $Revision: 1.6 $
| $Date: 2006/05/02 22:04:28 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   $text .= "<div style='width:100%'>";
   $text .= agendaDrawNavigation($agenda->getDateDS()+($agenda->getOneDay()*2), $agenda->getDateDS()-($agenda->getOneDay()*2), '&nbsp;');

   // Show the untimed entries for today
   $entries1u = false;
   $entries2u = false;
   $entries1t = false;
   $entries2t = false;

   $text .= "<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'><tr>";
   $tmp = $agenda->getDayName($agenda->getDateDS(), true);
   $tmp .= "&nbsp;".date("j", $agenda->getDateDS());
   $tmp .= "&nbsp;".$agenda->getMonthName($agenda->getDateDS(), true);
   $tmp .= "&nbsp;".date("Y", $agenda->getDateDS());
   $text .= "<td class='".$agenda->getPrefHeaderCSS()."' style='text-align:center'>".$tmp."</td>";
   $tmp = $agenda->getDayName($agenda->getDateDS()+$agenda->getOneDay(), true);
   $tmp .= "&nbsp;".date("j", $agenda->getDateDS()+$agenda->getOneDay());
   $tmp .= "&nbsp;".$agenda->getMonthName($agenda->getDateDS()+$agenda->getOneDay(), true);
   $tmp .= "&nbsp;".date("Y", $agenda->getDateDS()+$agenda->getOneDay());
   $text .= "<td class='".$agenda->getPrefHeaderCSS()."' style='text-align:center'>".$tmp."</td></tr><tr>";
   $text .= "<td class='".$agenda->getPrefDayWithEntriesCSS()."' style='width:50%'>";
   if ($agenda->hasUntimed($agenda->getDateDS())) {
      $ix = 0;
      while ($event = $agenda->getEvent($agenda->getDateDS(), $ix++)) {
         if ($event->isUntimed()) {
            $text .= "<div style='padding-bottom:3px;'>".$event->drawLink()."</div>";;
            $entries1u = true;
         }
      }
   }
   if (!$entries1u) {
      $text .= "&nbsp";
   }
   $text .= "</td><td class='".$agenda->getPrefDayWithEntriesCSS()."' style='width:50%'>";
   if ($agenda->hasUntimed($agenda->getDateDS()+$agenda->getOneDay())) {
      $ix = 0;
      while ($event = $agenda->getEvent($agenda->getDateDS()+$agenda->getOneDay(), $ix++)) {
         if ($event->isUntimed()) {
            $text .= "<div style='padding-bottom:3px;'>".$event->drawLink()."</div>";;
            $entries2u = true;
         }
      }
   }
   if (!$entries2u) {
      $text .= "&nbsp;";
   }
   $text .= "</td></tr>";

   // Show the timed entries for today
   $ix = 0;
   $dayentries0 = array("","","","","","","","","","","","","","","","","","","","","","","","");
   while ($event = $agenda->getEvent($agenda->getDateDS(), $ix++)) {
      if ($event->isTimed()) {
         $dayentries0[date("G", $event->getAgnStart())] .= "<div style='padding-bottom:3px;'>".$event->drawLink()."</div>";
         $entries = true;
      }
   }
   $ix = 0;
   $dayentries1 = array("","","","","","","","","","","","","","","","","","","","","","","","");
   while ($event = $agenda->getEvent($agenda->getDateDS()+$agenda->getOneDay(), $ix++)) {
      if ($event->isTimed()) {
         $dayentries1[date("G", $event->getAgnStart())] .= "<div style='padding-bottom:3px;'>".$event->drawLink()."</div>";
         $entries = true;
      }
   }

   $text .= "</table><table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";
   $hour = 0;
   for ($hour=0; $hour<24; $hour++) {
      $text .= "<tr>";
      if (strlen($dayentries0[$hour]) > 0) {
         $text .= "<td class='".$agenda->getPrefTodayCSS()." smalltext' style='text-align:right;width:4%;' valign='top'>".$hour.":00</td>";
         $text .= "<td class='".$agenda->getPrefTodayCSS()."' style='width:46%'>";
         $text .= $dayentries0[$hour]."</td>";
         $entries1t = true;
      } else {
         if ($pref["agenda_compress_day"] != "Y" || strlen($dayentries1[$hour]) > 0) {
            $text .= "<td class='".$agenda->getPrefDayCSS()." smalltext' style='text-align:right;width:4%;' valign='top'>".$hour.":00</td>";
            $text .= "<td class='".$agenda->getPrefDayCSS()." smalltext' style='width:46%'>&nbsp;</td>";
         }
      }
      if (strlen($dayentries1[$hour]) > 0) {
         $text .= "<td class='".$agenda->getPrefTodayCSS()." smalltext' style='text-align:right;width:4%;' valign='top'>".$hour.":00</td>";
         $text .= "<td class='".$agenda->getPrefTodayCSS()."' style='width:46%'>";
         $text .= $dayentries1[$hour]."</td>";
         $entries2t = true;
      } else {
         if ($pref["agenda_compress_day"] != "Y" || strlen($dayentries0[$hour]) > 0) {
            $text .= "<td class='".$agenda->getPrefDayCSS()." smalltext' style='text-align:right;width:4%;' valign='top'>".$hour.":00</td>";
            $text .= "<td class='".$agenda->getPrefDayCSS()." smalltext' style='width:46%'>&nbsp;</td>";
         }
      }
      $text .= "</tr>";
   }

   if ($pref["agenda_compress_day"] == "Y" && ((!$entries1u && !$entries1t) || (!$entries2u && !$entries2t))) {
      if (!$entries1u && !$entries1t && !$entries2u && !$entries2t) {
         $text .= "<tr><td class='".$agenda->getPrefDayCSS()."' style='text-align:center;width:50%;' valign='top'>".AGENDA_LAN_30."</td>";
         $text .= "    <td class='".$agenda->getPrefDayCSS()."' style='text-align:center;width:50%;' valign='top'>".AGENDA_LAN_30."</td></tr>";
      } else if (!$entries1t && !$entries2t) {
         if ($entries1u) {
            $text .= "<tr><td class='".$agenda->getPrefDayCSS()."' style='text-align:center;width:50%;' valign='top'>&nbsp;</td>";
         } else {
            $text .= "<tr><td class='".$agenda->getPrefDayCSS()."' style='text-align:center;width:50%;' valign='top'>".AGENDA_LAN_30."</td>";
         }
         if ($entries2u) {
            $text .= "    <td class='".$agenda->getPrefDayCSS()."' style='text-align:center;width:50%;' valign='top'>&nbsp;</td></tr>";
         } else {
            $text .= "    <td class='".$agenda->getPrefDayCSS()."' style='text-align:center;width:50%;' valign='top'>".AGENDA_LAN_30."</td></tr>";
         }
      } else {
         if ($entries1t || $entries1u) {
            $text .= "<tr><td class='".$agenda->getPrefDayCSS()."' style='text-align:center;width:50%;' valign='top' colspan='2'>&nbsp;</td>";
         } else {
            $text .= "<tr><td class='".$agenda->getPrefDayCSS()."' style='text-align:center;width:50%;' valign='top' colspan='2'>".AGENDA_LAN_30."</td>";
         }
         if ($entries2t || $entries2u) {
            $text .= "    <td class='".$agenda->getPrefDayCSS()."' style='text-align:center;width:50%;' valign='top' colspan='2'>&nbsp;</td></tr>";
         } else {
            $text .= "    <td class='".$agenda->getPrefDayCSS()."' style='text-align:center;width:50%;' valign='top' colspan='2'>".AGENDA_LAN_30."</td></tr>";
         }
      }


   }
   $text .= "</table></div>";
?>