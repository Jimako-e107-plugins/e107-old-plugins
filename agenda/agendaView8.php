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
| $Source: E:/cvs/cvsrepo/agenda/agendaView8.php,v $
| $Revision: 1.2 $
| $Date: 2005/11/13 16:03:44 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   $text .= "<div style='width:100%'>";
   $text .= agendaDrawNavigation("", "", AGENDA_LAN_111);

   if (isset($_POST['setsubs'])) {
      $cats = $_POST['event_list'];
      $subs = $_POST['event_subd'];
      $agn_sql1->db_Delete("agenda_subs", " WHERE subs_userid='".USERID."'");
      foreach($cats as $ix) {
         if ($subs[$ix]) {
            $agn_sql1->db_Insert("agenda_subs", "0, '".USERID."', '".$ix."'");
         }
      }
   }

   $text .= "<form method='post' action='".e_SELF."?subs.".$agenda->getP2().".".$agenda->getP3().".".$agenda->getP4().".".$agenda->getP5()."' id='agendasubsform'>";
   $text .= "<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";
   $text .= "<tr><td colspan='3' class='".$agenda->getPrefDayCSS()."'>@@@@@</td></tr>";

   // Get a list of categories currently subscribed to by this user
   $subs = array();
   $agn_sql1->db_Select($agenda->getSubsTable(), "subs_cat", " WHERE subs_userid='".USERID."'", true, $agenda->isDebug());
   while ($agn_srow = $agn_sql1->db_Fetch()) {
      extract($agn_srow);
      $subs[] = $subs_cat;
   }

   // Get list of categories that have subscriptions and are visible to this member
   if ($agn_sql1->db_Select($agenda->getCategoryTable(), "*", " WHERE cat_subs>0 and find_in_set(cat_class,'".$e107Helper->getUserClassList()."') order by cat_name asc", true, $agenda->isDebug())) {

      $optsubs = 0;
      $autosubs = 0;

      while ($agn_crow = $agn_sql1->db_Fetch()) {
         extract($agn_crow);
         $text .= "<tr>";
         $text .= "<td class='".$agenda->getPrefTodayCSS()."' style='text-align:center;width:10%;'>";
         $text .= "<img src='$cat_icon' border='0' align='middle' /></td>";
         $text .= "<td class='".$agenda->getPrefTodayCSS()."'>";
         if ($cat_subs == 1 || $cat_subs == 3) {
            $text .= "<input type='hidden' name='event_list[]' value='".$cat_id."' />";
            $text .= "<label for='event_subd".$cat_id."'>";
            $checked = in_array($cat_id, $subs) ? "checked='checked'" : "";
            $text .= "<input type='checkbox' class='tbox' value='1' id='event_subd".$cat_id."' name='event_subd[$cat_id]' ".$checked." />";
            if ($checked) {
               $optsubs++;
            }
         }
         $text .= "$cat_name</label>";
         if ($cat_subs == 2 || $cat_subs == 4) {
            $text .= "<br /><span class='smalltext'>".AGENDA_LAN_117."</span>";
         }
         if ($cat_subs == 3 || $cat_subs == 4) {
            $text .= "<br /><span class='smalltext'>".AGENDA_LAN_126."</span>";
            $autosubs++;
         }
         $text .= "</td><td class='".$agenda->getPrefTodayCSS()."'>$cat_description&nbsp;";
         if ($cat_notify == 0) {
            $text .= "<span class='smalltext'>".AGENDA_LAN_150."</span>";
         }
         elseif ($cat_notify == 1) {
            $text .= "<span class='smalltext'>".AGENDA_LAN_152."$cat_ahead".AGENDA_LAN_153."</span>";
         }
         elseif ($cat_notify == 2) {
            $text .= "<span class='smalltext'>".AGENDA_LAN_151."</span>";
         }
         elseif ($cat_notify == 3) {
            $text .= "<span class='smalltext'>".AGENDA_LAN_152."$cat_ahead".AGENDA_LAN_153."</span>";
         }
         $text .= "</td></tr>";
      }
      $text .= "<tr style='vertical-align:top'><td colspan='3' style='text-align:center' class='".$agenda->getPrefTodayCSS()."'>";
      $text .= "<input class='button' type='submit' name='setsubs' value='".AGENDA_LAN_115."' /></td></tr>";

      $text2 = "<div style='text-align:center'>";
      $text2 .= "<div class=''>";
      $text2 .= AGENDA_LAN_112." $optsubs ".AGENDA_LAN_113." $autosubs ".AGENDA_LAN_118;
      $text2 .= "</div>";
      $text2 .= "</div>";
      $text = str_replace("@@@@@", $text2, $text);
   } else {
      $text .= "<tr><td class='".$agenda->getPrefTodayCSS()."' colspan='2'>" . AGENDA_LAN_114 . "</td></tr>";
   }

   $text .= "</table></form></div>";
?>