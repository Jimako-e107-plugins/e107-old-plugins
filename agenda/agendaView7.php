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
| $Source: E:/cvs/cvsrepo/agenda/agendaView7.php,v $
| $Revision: 1.8 $
| $Date: 2005/11/09 23:30:49 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   $tmp = str_replace("@@@@@", $pref['agenda_multiple_weeks'], AGENDA_LAN_VIEW_07);
   if (!$agenda->isPrint()) {
      $text .= agendaDrawNavigation("", "", $tmp);
   } else {
      $text .= agendaDrawDate($tmp);
   }

   $text .= "<div style='width:100%'>";

   // Display day column headers
   $text .= "<table cellpadding='0' cellspacing='0' style='width:100%' class='fborder' border='1'><tr><td class='".$agenda->getPrefHeaderCSS()."'><span class='smalltext'>wk</span></td>";
   foreach ($agenda->getDays() as $thisday) {
      $text .= "<td class='".$agenda->getPrefHeaderCSS()."' style='text-align:center'><span class='smalltext'>". substr($thisday, 0, $pref["agenda_dayname_length"])."</span></td>";
   }
   $text .= "</tr><tr >";

   // Display month days
   $colnum = 1; // Used to track end of week (new row in HTML table)
   for ($count=0; $count<($pref['agenda_multiple_weeks']*7); $count++) {
      $thisday = mktime(0,0,0, date("m", $agenda->getTodayWeekStartDS()), date("d", $agenda->getTodayWeekStartDS()) + $count, date("Y", $agenda->getTodayWeekStartDS()));
      $thisdayarray = getdate($thisday);

      if ($pref['agenda_week_start'] == $thisdayarray['wday'] && ($colnum == 1 || $colnum >= 7)) {
         $week = date("W", $thisday);
         $text .= "</tr><tr><td class='".$agenda->getPrefDayCSS()."' style='width:2%;'><span class='smalltext'>$week</span></td>";
         $colnum = 1;
      } else {
         $colnum++;
      }

      $ix = 0;
      $event = $agenda->getEvent($thisday, $ix++);

      $thisdayheader = date("d", $thisday);
      if ($event) {
         $thisdayheader = "<span style='font-weight:bold'>".date("d", $thisday)."</span>";
      }

      if ($agenda->getTodayDS() == $thisday) {
         $class = $agenda->getPrefTodayCSS();
         $thisdayheader .= "<span class='smalltext'>&nbsp;".AGENDA_LAN_32."</span>";
      } else if ($event) {
         $class = $agenda->getPrefDayWithEntriesCSS();
      } else {
         $class = $agenda->getPrefDayCSS();
      }

      $thisdayheader .= "<br/>";
      $text .= "<td class='$class' style='text-align:left;width:14%;height:70px;cursor:pointer;' valign='top'";
      if (!$agenda->isPrint()) {
         $text .= " onclick='javascript:document.location=\"".$agenda->getPathToAgenda()."?view.0.".$agenda->getP3().".$thisday\"'";
      }
      $text .= ">";

      $linktitle = $event ? "title='$entries".AGENDA_LAN_21."'" : "";
      if (!$agenda->isPrint()) {
         $text .= "<a $linktitle href='".e_SELF."?view.0.".$agenda->getP3().".".$thisday."'>";
      }
      $text .= $thisdayheader;
      if (!$agenda->isPrint()) {
         $text .= "</a>";
      }

      if ($event) {
         $text .= "<span class='smalltext'>";
         do {
            $text .= $event->drawLink(false);
         } while ($event = $agenda->getEvent($thisday, $ix++));
         $text .= "</a></span>";
      }

      $text .= "</td>\n";
   }

   $text .= "</tr></table></div>";
   if (!$agenda->isPrint()) {
      $text .= "<a href='../../print.php?plugin:agenda.".$agenda->getP1().".".$agenda->getP2().".".$agenda->getP3().".".$agenda->getP4().".".$agenda->getP5()."' target='_blank'>".AGENDA_LAN_125."</a>";
   }
?>