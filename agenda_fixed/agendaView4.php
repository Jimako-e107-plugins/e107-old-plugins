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
| $Source: e:\_repository\e107_plugins/agenda/agendaView4.php,v $
| $Revision: 1.9 $
| $Date: 2006/11/29 01:17:01 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   if (!$agenda->isPrint()) {
      $text .= agendaDrawNavigation((mktime(0,0,0,$agenda->getMonthNum(),0,$agenda->getYearNum()+1)), mktime(0,0,0,$agenda->getMonthNum(),0,$agenda->getYearNum()-1), $agenda->getYearNum());
   } else {
      $text .= agendaDrawDate($tmp);
   }
	 
   for ($month=0; $month<12; $month++) {
      if (intval($month/3)*3 == $month/3*3) {
         $text .= "<div style='width:100%'><table width='100%'><tr><td valign='top'>";
      } else {
         $text .= "</td><td valign='top'>";
      }

      $text .= "<table class='fborder table-small-calendar'><tr>";
      // Display month
      $text .= "<td colspan='7' class='".$agenda->getPrefHeaderCSS()."' style='text-align:center'><span class='smalltext'>".$agenda->getMonthNameFromNum($month, true)."</span></td>";
      $text .= "</tr><tr>";

      // Display day column headers
      foreach ($agenda->getDays() as $day) {
         $text .= "<td class='".$agenda->getPrefHeaderCSS()."' style='text-align:center'><span class='smalltext'>". substr($day, 0, $pref["agenda_dayname_length"])."</span></td>";
      }
      $text .= "</tr><tr>";

      $dayInWeek = 1;

      // Display blank entries before month start
      for ($count=0; $count<$agenda->getMonthFirstDayOffset(mktime(0,0,0,$month+1,1,$agenda->getYearNum())); $count++) {
         $text .= "<td class='smalltext'> </td>";
         $dayInWeek++;
      }

      // Display month days
      $firstrow = true;
      for ($count=1; $count<32; $count++) {
         $thisday = mktime(0,0,0,$month+1,$count,$agenda->getYearNum());
         $thisdayarray = getdate($thisday);

         // Check it's a day in the current month
         if ($thisdayarray['mon'] == $month+1) {
            if ($pref['agenda_week_start'] == $thisdayarray['wday'] && !$firstrow) {
               $text .= "</tr><tr>";
               $dayInWeek = 1;
            } else {
               $firstrow = false;
               $dayInWeek++;
            }

            $entries = $agenda->countEvents($thisday);

            if ($agenda->getTodayYearNum() == $agenda->getYearNum() && $agenda->getTodayMonthNum() == $month+1 && $agenda->getTodayDayNum() == $count) {
               $class = $agenda->getPrefTodayCSS();
            } else if ($entries) {
               $class = $agenda->getPrefDayWithEntriesCSS();
            } else {
               $class = $agenda->getPrefDayCSS();
            }

            $linktitle = $entries > 0 ? "title='$entries".AGENDA_LAN_21."'" : "";
            $text .= "<td class='smalltext $class' style='text-align:center;width:14%;cursor:pointer;' $linktitle";
            $text .= "onclick='javascript:document.location=\"".$agenda->getPathToAgenda()."?view.3.0.01-".($month+1)."-".$agenda->getYearNum()."\"'>";
            if ($entries) {
               $text .= "<span style='font-weight:bold'>$count</span></td>";
            } else {
               $text .= "<span>$count</span></td>";
            }
         }
      }

      // Display blank entries after month end
      for ($count=$dayInWeek; $count<7; $count++) {
         $text .= "<td class='smalltext'> </td>";
      }

      $text .= "</tr></table>";

      if (intval(($month+1)/3)*3 == ($month+1)/3*3) {
         $text .= "</td></tr></table></div>";
      }
   }

   if (!$agenda->isPrint()) {
      $text .= "<a href='../../print.php?plugin:agenda.".$agenda->getP1().".".$agenda->getP2().".".$agenda->getP3().".".$agenda->getP4().".".$agenda->getP5()."' target='_blank'>".AGENDA_LAN_125."</a>";
   }

?>