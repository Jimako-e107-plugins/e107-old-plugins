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
| $Source: e:\_repository\e107_plugins/agenda/agendaView9.php,v $
| $Revision: 1.3 $
| $Date: 2006/11/29 01:17:01 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   $text .= "<div style='width:100%'>";
   $text .= agendaDrawNavigation("", "", getFormattedDate($agenda->getDateDS(), true));

   $text .= "<form method='post' action='".e_SELF."?setfilter.".$agenda->getP2().".".$agenda->getP3().".".$agenda->getP4()."' id='agendafilterform'>";
   $text .= "<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";
   $text .= "<tr><td colspan='2' class='".$agenda->getPrefHeaderCSS()."'>".AGENDA_LAN_42."</td></tr>";

   $rs = new agenda_form;
   $filter = array();
   $usr_filter_state = "";
   if ($currentUser) {
      $agn_sql1->db_Select($agenda->getUserTable(), "*", "usr_id=".$currentUser["user_id"], true, $agenda->isDebug());
      if ($agn_urow = $agn_sql1->db_Fetch()) {
         extract($agn_urow);
         $filters = explode(";", $usr_filter);
         for ($i=0; $i<count($filters); $i++) {
            $tmp = explode(":", $filters[$i]);
            $filter[$tmp[0]] = $tmp[1];
         }
      }
   }

   for ($i=0; $i<count($agn_filter_fields); $i++) {
      $text .= agendaDrawFormRow($rs, $agn_field[$agn_filter_fields[$i]], $filter[$agn_filter_fields[$i]]);
   }

   $text .= "<tr><td class='forumheader3' style='text-align:center;' colspan='2'><input class='button' type='submit' id='setfilter' name='setfilter' value='".AGENDA_LAN_45."' /></td></tr>";

   $text .= "</table></form></div>";
?>