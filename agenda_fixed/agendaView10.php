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
| $Source: e:\_repository\e107_plugins/agenda/agendaView10.php,v $
| $Revision: 1.4 $
| $Date: 2006/11/29 01:17:01 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   $rs = new agenda_form;
   $text .= "<div style='width:100%'>";
   $text .= agendaDrawNavigation("", "", getFormattedDate($agenda->getDateDS(), true));

   $text .= "<form method='post' action='".e_SELF."?search.".$agenda->getP2().".".$agenda->getP3().".".$agenda->getP4()."' id='agendasearchform'>";
   $text .= "<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";
   $text .= "<tr><td colspan='2' class='".$agenda->getPrefHeaderCSS()."'>".AGENDA_LAN_93."</td></tr>";

   $text .= "<tr><td class='".$agenda->getPrefDayCSS()."' colspan='2'>".AGENDA_LAN_97."</td></tr>";

   for ($i=0; $i<count($agn_search_fields); $i++) {
      $text .= agendaDrawFormRow($rs, $agn_field[$agn_search_fields[$i]], $_POST[$agn_field[$agn_search_fields[$i]]["name"]]);
   }

   $text .= "<tr><td class='forumheader3' style='text-align:center;' colspan='2'><input class='button' type='submit' id='search' name='search' value='".AGENDA_LAN_94."' /></td></tr>";

   if (isset($_POST["search"])) {
      // Construct the SQL
      extract($_POST, EXTR_OVERWRITE);
      $prefix = " where";

      if (strlen($usr_title)) {
         $qry .= "$prefix e.agn_title like '%$usr_title%'";
         $prefix = " and";
      }

      if (strlen($usr_category) > 0) {
         $qry .= "$prefix e.agn_category='$usr_category'";
         $prefix = " and";
      }

      if (strlen($usr_start) > 0) {
         $tmp = explode("-", $usr_start);
         $tmp = mktime(0, 0, 0, $tmp[1], $tmp[0], $tmp[2]);
         if ($tmp != -1) {
            $qry .= "$prefix e.agn_start>='$tmp'";
            $prefix = " and";
          }
      }

      if (strlen($usr_end) > 0) {
         $tmp = explode("-", $usr_end);
         $tmp = mktime(23, 59, 59, $tmp[1], $tmp[0], $tmp[2]);
         if ($tmp != -1) {
            $qry .= "$prefix e.agn_start<='$tmp'";
            $prefix = " and";
         }
      }

      if (strlen($usr_location) > 0) {
         $qry .= "$prefix e.agn_location like '%$usr_location%'";
         $prefix = " and";
      }

      if (strlen($usr_details) > 0) {
         $qry .= "$prefix e.agn_details like '%$usr_details%'";
         $prefix = " and";
      }

      if (strlen($usr_owner) > 0) {
         $qry .= "$prefix e.agn_owner like '%$usr_owner%'";
         $prefix = " and";
      }

      if (strlen($qry) > 0) {
         $qry = $agenda->getTableJoin()." $qry order by e.agn_start asc, e.agn_end asc, e.agn_priority asc";
         $count = 0;
         if ($agn_sql1->db_Select_gen($qry, false)) {
            $text .= "<tr><td class='".$agenda->getPrefHeaderCSS()."' colspan='2'>".AGENDA_LAN_134;
            if ($agenda->isFilterOn()) {
               $text .= "<br/><span class='smalltext'>".AGENDA_LAN_135."</span>";
            }
            $text .= "</td></tr>";
            $text .= "<tr><td class='".$agenda->getPrefDayWithEntriesCSS()."' colspan='2'>";
            while ($agn_erow = $agn_sql1->db_Fetch()) {
               extract($agn_erow);
               if (($agn_private == 0 || ADMIN || $agn_author == USERID) && check_class($cat_visibility)) {
                  $text .= "<div style='padding-bottom:3px;'>".agendaDrawEntryLink($agn_erow, true, true)."</div>";
                  $count++;
               }
            }
            $text .= "</td></tr>";
         }
         if ($count == 0) {
            $text .= "<tr><td class='".$agenda->getPrefDayCSS()."' colspan='2'>".AGENDA_LAN_96."</td></tr>";
         }
      }
   }

   $text .= "</table></form></div>";
?>