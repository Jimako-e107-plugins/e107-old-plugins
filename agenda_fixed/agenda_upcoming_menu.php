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
| $Source: e:\_repository\e107_plugins/agenda/agenda_upcoming_menu.php,v $
| $Revision: 1.14 $
| $Date: 2006/11/29 01:17:02 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   require(e_PLUGIN."agenda/agenda_variables.php");

   $limit = $pref['agenda_upcoming_events_limit'];

   $text = "";
   $day = 0;
   $curdate = "";
   global $agenda;
   while ($day < $limit) {
      $thisday = mktime(0,0,0, date("m", $agenda->getTodayMonthStartDS()), $agenda->getTodayDayNum()+$day, $agenda->getTodayYearNum());
      $ix = 0;
      while ($event = $agenda->getEvent($thisday, $ix++)) {
         // Check for date change (ignoring time)
         if (date("Ymd", $curdate) != date("Ymd", $thisday)) {
            $dayname = $agenda->getDayName($thisday);
            $monthname = $agenda->getMonthName($thisday);
            $text .= "<b>".$dayname."&nbsp;".date("d", $thisday)."&nbsp;".$monthname."&nbsp;".date("y", $thisday)."</b>";
            if ($agenda->getTodayDS() == $thisday) {
               $text .= "<span class='smalltext'>&nbsp;".AGENDA_LAN_32."</span>";
            }
            $text .= "<br />";
            $curdate = $thisday;
         }
         $text .= "<a href='".e_PLUGIN."agenda/agenda.php?viewitem.0.".$event->getAgnId()."'><img src='".$event->getCatIcon(true)."' border='0'/>&nbsp;";

		   $evs = getdate($orig_start);

         // Do we have a start time (if event is timed)
		   $time = ($typ_timed==0) ? "" : $evs['hours'].($evs['minutes'] < 9 ? ":0".$evs['minutes'] : ":".$evs['minutes']);

         $text .= $time." ".$event->getAgnTitle()."</a><br />";
      }
      $day++;
   }

   if (strlen($text) == 0) {
      $text = str_replace("@@@@@", $pref['agenda_upcoming_events_limit'], AGENDA_LAN_133);
   }
   $ns->tablerender($pref['agenda_upcoming_events_title'], $text);
?>