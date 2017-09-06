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
| $Source: E:/cvs/cvsrepo/agenda/agenda_nav_menu.php,v $
| $Revision: 1.6 $
| $Date: 2005/10/02 13:13:48 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   // Don't do anything if navigation controls are displayed on main page
   if (!isset($pref['agenda_nav_on_main']) || $pref['agenda_nav_on_main'] != "Y") {
      require(e_PLUGIN."agenda/agenda_variables.php");

      // Only show when main page loaded as it has the Javascript we need
      // and when the current user has sufficient privileges
      if (strpos(e_SELF, $agenda->getFilename()) > 0) {
         $agn_monthentries  = $agn_sql1->db_Count($agenda->getAgendaTable(), "(*)", "where start>=".$agenda->getTodayMonthStartDS()." and end<".$agenda->getTodayMonthEndDS());

         $defaultview = ($agenda->getP1() == "view") ? $agenda->getP1() : "0";

         $text = "<div style='text-align:center'>";
         $rs = new agenda_form;
         $text .= "<div style='width:100%;text-align:center;padding-bottom:5px;'>".$agn_navformcapt[0];
         $text .= $rs->user_extended_element_edit($agn_navformname[0]."|".$agn_navformtype[0]."|".$agn_navformvalu[0], $defaultview, $agn_navformname[0], $agn_navformjs[0]);
         $text .= "</div>";
         $text .= "<div style='width:100%;text-align:center;padding-bottom:5px;'>".$agn_navformcapt[1];
         $text .= $rs->user_extended_element_edit($agn_navformname[1]."|".$agn_navformtype[1]."|".$agn_navformvalu[1], date("d-m-Y", $agenda->getDateDS()), $agn_navformname[1], $agn_navformjs[1]);
         $text .= $rs->user_extended_element_edit($agn_navformname[2]."|".$agn_navformtype[2]."|".$agn_navformvalu[2], "", $agn_navformname[2], $agn_navformjs[2]);
         $text .= "</div>";
         $text .= "<hr />";

         if (check_class($pref['agenda_add_entry'])) {
            $text .= "<div style='width:100%;text-align:center;padding-bottom:5px;'>".$agn_navformcapt[3];
            $text .= $rs->user_extended_element_edit($agn_navformname[3]."|".$agn_navformtype[3]."|".$agn_navformvalu[3], "", $agn_navformname[3], $agn_navformjs[3]);
            $text .= "&nbsp;<a href='".e_SELF."?typehelp.".$agenda->getP2().".".$agenda->getP3().".".$agenda->getDateDS()."'>???</a>";
            $text .= "</div>";
         }
         $text .= "</div>";

         $text .= "<hr />";
         $text .= "<div style='width:100%;text-align:center;padding-bottom:5px;'>".$agn_navformcapt[5];
         if (USERNAME != "USERNAME") {
            $text .= $rs->user_extended_element_edit($agn_navformname[5]."|".$agn_navformtype[5]."|".$agn_navformvalu[5], "", $agn_navformname[5], $agn_navformjs[5]);
         }
         $text .= $rs->user_extended_element_edit($agn_navformname[6]."|".$agn_navformtype[6]."|".$agn_navformvalu[6], "", $agn_navformname[6], $agn_navformjs[6]);
         $text .= "</div>";

         $ns->tablerender($pref["agenda_nav_menu_title"], $text);
      }
   }
?>