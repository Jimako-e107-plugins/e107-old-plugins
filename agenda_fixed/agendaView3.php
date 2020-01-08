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
| $Source: e:\_repository\e107_plugins/agenda/agendaView3.php,v $
| $Revision: 1.15 $
| $Date: 2006/11/29 01:17:01 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   $tmp = $agenda->getMonthName($agenda->getDateDS(), true)." ".$agenda->getYearNum();
   if (!$agenda->isPrint()) {
      $text .= agendaDrawNavigation((mktime(0,0,0,$agenda->getMonthNum()+2,0,$agenda->getYearNum())), mktime(0,0,0,$agenda->getMonthNum(),0,$agenda->getYearNum()), $tmp);
   } else {
      $text .= agendaDrawDate($tmp);
   }

   $text .= "<div style='width:100%'>";

   // Display day column headers
   $text .= "<table cellpadding='0' cellspacing='0' style='width:100%' class='fborder' border='1' summary='*'><tr><td class='".$agenda->getPrefHeaderCSS()."'><span class='smalltext'>wk</span></td>";
   foreach ($agenda->getDays() as $thisday) {
      $text .= "<td class='".$agenda->getPrefHeaderCSS()."' style='text-align:center'><span class='smalltext'>". substr($thisday, 0, $pref["agenda_dayname_length"])."</span></td>";
   }
   $text .= "</tr><tr>";
   // Display blank entries before month start
   for ($count=0; $count<=$agenda->getMonthFirstDayOffset() && $agenda->getMonthFirstDayOffset()>0; $count++) {
      $text .= "<td> </td>";
   }

   // Display month days
   $colnum = $count; // Used to track end of week (new row in table)
   for ($count=1; $count<32; $count++) {
      $thisday = mktime(0,0,0, date("m", $agenda->getMonthStartDS()), $count, $agenda->getYearNum());
      $thisdayarray = getdate($thisday);

      // Check it's a day in the current month
      if ($thisdayarray['mon'] == $agenda->getMonthNum()) {
         if ($pref['agenda_week_start'] == $thisdayarray['wday'] && ($colnum <= 1 || $colnum >= 7)) {
            $week = date("W", $thisday);
            $text .= "</tr><tr><td class='".$agenda->getPrefDayCSS()."' style='width:2%;'><span class='smalltext'>$week</span></td>";
            $colnum = 1;
         } else {
            $colnum++;
         }

         $ix = 0;
         $event = $agenda->getEvent($thisday, $ix++);

         $thisdayheader = $count;
         if ($event) {
            $thisdayheader = "<span style='font-weight:bold'>$count</span>";
         }

         if ($agenda->getTodayDayNum() == $count && $agenda->getTodayMonthNum() == $agenda->getMonthNum() && $agenda->getTodayYearNum() == $agenda->getYearNum()) {
            $class = $agenda->getPrefTodayCSS();
            $thisdayheader .= "<span class='smalltext'>&nbsp;".AGENDA_LAN_32."</span>";
         } else if ($event) {
            $class = $agenda->getPrefDayWithEntriesCSS();
         } else {
            $class = $agenda->getPrefDayCSS();
         }

         $text .= "<td class='$class' style='text-align:left;width:14%;height:70px;' valign='top'";
         if (!$agenda->isPrint()) {
            //$text .= " onclick='document.location=\"".$agenda->getPathToAgenda()."?view.0.".$agenda->getP3().".$thisday\"'";
         }
         $text .= ">";

         $linktitle = $event ? "title='".$agenda->countEvents($thisday).AGENDA_LAN_21."'" : "";
         if (!$agenda->isPrint()) {
            $text .= "<a $linktitle href='".e_SELF."?view.0.".$agenda->getP3().".".$thisday."'>";
         }
         $text .= $thisdayheader;
         if (!$agenda->isPrint()) {
            $text .= "</a>";
            //$text .= "<span style='cursor:pointer;' title='Quick Add' onclick='agendaHelper.agendaQuickAddInit(event, $thisday);'>+</span>";
         }
         $text .= "<br/>";

         if ($event) {
            $text .= "<span class='smalltext'>";
            do {
               $text .= $event->drawLink(false);
            } while ($event = $agenda->getEvent($thisday, $ix++));
            $text .= "</span>";
         }

         $text .= "</td>\n";
      }
   }

   // Display blank entries after month end
   for ($count=$colnum; $count<7; $count++) {
      $text .= "<td> </td>";
   }


   $text .= "</tr></table></div>";

   if (!$agenda->isPrint()) {
      $text .= "<a href='../../print.php?plugin:agenda.".$agenda->getP1().".".$agenda->getP2().".".$agenda->getP3().".".$agenda->getP4().".".$agenda->getP5()."' target='_blank'>".AGENDA_LAN_125."</a>";
   }
?>