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
| $Source: E:/cvs/cvsrepo/agenda/agendaView1.php,v $
| $Revision: 1.9 $
| $Date: 2005/11/13 15:45:04 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   $text .= "<div style='width:100%'>";
   $tmp = AGENDA_LAN_140." ".$agenda->getWeekNum().", ".$agenda->getYearNum();
   if (!$agenda->isPrint()) {
      $text .= agendaDrawNavigation($agenda->getDateDS()+$agenda->getOneWeek(), $agenda->getDateDS()-$agenda->getOneWeek(), $tmp);
   } else {
      $text .= agendaDrawDate($tmp);
   }

   $text .= "<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0' border='1'>";
   for ($count=0; $count<7; $count++) {
      $thisday = $agenda->getWeekStartDS() + ($count*$agenda->getOneDay());

      $dayname = $agenda->getDayName($thisday);
      $monthname = $agenda->getMonthName($thisday);
      $day = $dayname."&nbsp;".date("d", $thisday)."&nbsp;".$monthname;

      if ($agenda->getTodayDayNum() == date("d", $thisday) && $agenda->getTodayMonthNum() == $agenda->getMonthNum() && $agenda->getTodayYearNum() == $agenda->getYearNum()) {
         $day .= "<br /><span class='smalltext'>&nbsp;".AGENDA_LAN_32."</span>";
         $class = $agenda->getPrefTodayCSS();
      } else {
         $class = $agenda->getPrefDayCSS();
      }
      $text .= "<tr>";

      // Find any entries for this day
      $ix = 0;
      if ($event = $agenda->getEvent($thisday, $ix++)) {
         if ($agenda->getTodayDayNum() == date("d", $thisday) && $agenda->getTodayMonthNum() == $agenda->getMonthNum() && $agenda->getTodayYearNum() == $agenda->getYearNum()) {
            $class = $agenda->getPrefTodayCSS();
         } else {
            $class = $agenda->getPrefDayWithEntriesCSS();
         }

         $text .= "<td class='$class smalltext' style='text-align:center' valign='top'>$day</td>";
         $text .= "<td class='$class' colspan='3'><table width='100%'><tr>";
         while ($event) {
            $text .= "<td class='' style='width:90%'>";
            $text .= $event->drawLink();
            $text .= "</td>";
            if ($event = $agenda->getEvent($thisday, $ix++)) {
               $text .= "</tr><tr>";
            }
         }
         $text .= "</tr></table>";
      } else {
         if ($pref["agenda_compress_week"] != "Y") {
            $text .= "<td class='$class smalltext' style='text-align:center' valign='top'>$day</td>";
            $text .= "<td class='$class smalltext' style='width:90%'>&nbsp;</td>";
         }
      }
      $text .= "</tr>";
   }

   $text .= "</table></div>";

   if (!$agenda->isPrint()) {
      $text .= "<a href='../../print.php?plugin:agenda.".$agenda->getP1().".".$agenda->getP2().".".$agenda->getP3().".".$agenda->getP4().".".$agenda->getP5()."' target='_blank'>".AGENDA_LAN_125."</a>";
   }
?>