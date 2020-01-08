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
| $Source: E:/cvs/cvsrepo/agenda/agendaView2.php,v $
| $Revision: 1.10 $
| $Date: 2005/11/09 22:40:33 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   $text .= "<div style='width:100%'>";
   $tmp = $agenda->getMonthName($agenda->getDateDS(), true)." ".$agenda->getYearNum();
   if (!$agenda->isPrint()) {
      $text .= agendaDrawNavigation((mktime(0,0,0,$agenda->getMonthNum()+2,0,$agenda->getYearNum())), mktime(0,0,0,$agenda->getMonthNum(),0,$agenda->getYearNum()), $tmp);
   } else {
      $text .= agendaDrawDate($tmp);
   }

   $text .= "<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0' border='1'>";

   for ($count=1; $count<32; $count++) {
      $thisday = mktime(0,0,0, date("m", $agenda->getMonthStartDS()), $count, $agenda->getYearNum());
      $thisdayarray = getdate($thisday);

      // Check it's a day in the current month
      if ($thisdayarray['mon'] == $agenda->getMonthNum()) {
         //$qry = $agenda->getSQL($thisday);
         //$qry .= "order by t.typ_timed asc, e.agn_start asc, e.agn_end asc, e.agn_priority asc";
         //$agn_sql1->db_Select_gen($qry, $agenda->isDebug());
         //$agn_erow = $agn_sql1->db_Fetch();
         $ix = 0;
         $event = $agenda->getEvent($thisday, $ix++);

         $text .= "<tr>";

         $dayname = $agenda->getDayName($thisday);

         $dayheader = "";
         if ($agenda->getTodayDayNum() == $count && $agenda->getTodayMonthNum() == $agenda->getMonthNum() && $agenda->getTodayYearNum() == $agenda->getYearNum()) {
            $class = $agenda->getPrefTodayCSS();
            $dayheader = "<br /><span class='smalltext'>&nbsp;".AGENDA_LAN_32."</span>";
         } else if ($event) {
            $class = $agenda->getPrefDayWithEntriesCSS();
         } else {
            $class = $agenda->getPrefDayCSS();
         }

         if ($event) {
            $text .= "<td class='$class smalltext' style='text-align:center' valign='top'>$dayname&nbsp;$count$dayheader</td>";
            $text .= "<td class='$class' colspan='3'><table width='100%'><tr>";
            while ($event) {
               $text .= "<td style='width:90%'>";
               $text .= $event->drawLink();
               $text .= "</td>";
               if ($event = $agenda->getEvent($thisday, $ix++)) {
                  $text .= "</tr><tr>";
               }
            }
            $text .= "</td></tr></table>";
         } else {
            if ($pref["agenda_compress_month1"] != "Y") {
               $text .= "<td class='$class smalltext' style='text-align:center' valign='top'>$dayname&nbsp;$count$dayheader</td>";
               $text .= "<td class='$class smalltext' style='width:90%'>&nbsp;</td>";
            }
         }
         $text .= "</tr>";
      }
   }

   $text .= "</table></div>";

   if (!$agenda->isPrint()) {
      $text .= "<a href='../../print.php?plugin:agenda.".$agenda->getP1().".".$agenda->getP2().".".$agenda->getP3().".".$agenda->getP4().".".$agenda->getP5()."' target='_blank'>".AGENDA_LAN_125."</a>";
   }
?>