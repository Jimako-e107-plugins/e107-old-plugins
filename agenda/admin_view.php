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
| $Source: E:/cvs/cvsrepo/agenda/admin_view.php,v $
| $Revision: 1.11 $
| $Date: 2005/11/09 18:34:24 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   require_once("../../class2.php");
   if (!getperms("P")) {
      header("location:".e_BASE."index.php");
   }
   require_once(e_ADMIN."auth.php");
   require(e_PLUGIN."agenda/agenda_variables.php");

   $preftitle  = AGENDA_LAN_ADMIN_07;
   $pageid     = "view";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_03_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_03_1;
   $prefname[] = "agenda_compress_day";
   $preftype[] = "checkbox2";
   $prefvalu[] = "Y:".AGENDA_LAN_ADMIN_PREFS_03_2;

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_04_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_04_1;
   $prefname[] = "agenda_compress_week";
   $preftype[] = "checkbox2";
   $prefvalu[] = "Y:".AGENDA_LAN_ADMIN_PREFS_04_2;

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_05_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_05_1;
   $prefname[] = "agenda_compress_month1";
   $preftype[] = "checkbox2";
   $prefvalu[] = "Y:".AGENDA_LAN_ADMIN_PREFS_05_2;

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_08_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_08_1;
   $prefname[] = "agenda_short_title_length";
   $preftype[] = "text";
   $prefvalu[] = "15,3,3";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_17_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_17_1;
   $prefname[] = "agenda_icons_in_compact_views";
   $preftype[] = "checkbox2";
   $prefvalu[] = "Y:".AGENDA_LAN_ADMIN_PREFS_17_2;

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_18_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_18_1;
   $prefname[] = "agenda_time_in_compact_views";
   $preftype[] = "checkbox2";
   $prefvalu[] = "Y:".AGENDA_LAN_ADMIN_PREFS_18_2;

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_38_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_38_1;
   $prefname[] = "agenda_recent_adds_limit";
   $preftype[] = "text";
   $prefvalu[] = "15,3,3";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_42_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_42_1;
   $prefname[] = "agenda_upcoming_events_title";
   $preftype[] = "text";
   $prefvalu[] = "Upcoming Events,50,50";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_43_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_43_1;
   $prefname[] = "agenda_upcoming_events_limit";
   $preftype[] = "text";
   $prefvalu[] = "10,3,3";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_45_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_45_1;
   $prefname[] = "agenda_multiple_weeks";
   $preftype[] = "text";
   $prefvalu[] = "4,2,2";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_46_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_46_1;
   $prefname[] = "agenda_next_weeks";
   $preftype[] = "text";
   $prefvalu[] = "4,2,2";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_49_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_49_1;
   $prefname[] = "agenda_link_to_google_maps";
   $preftype[] = "checkbox2";
   $prefvalu[] = "Y:".AGENDA_LAN_ADMIN_PREFS_49_2;

   if(IsSet($_POST['updatesettings'])){
      $count = count($prefname);
      for ($i=0; $i<$count; $i++) {
         $namehere = $prefname[$i];
         $pref[$namehere] = $_POST[$namehere];
      };
      save_prefs();
      $message = AGENDA_LAN_22;
   }

   if($message){
      $ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");
   }

   $rs = new agenda_form;

   /*if (file_exists(e_PLUGIN."updatecheckerx/updatechecker.php")) {
      require_once(e_PLUGIN."updatecheckerx/updatechecker.php");
      $text .= updateChecker(AGENDA_LAN_NAME, AGENDA_LAN_VER, "http://www.bugrain.plus.com/e107plugins/agenda.ver", "|");
   } */

   if (!file_exists(e_PLUGIN."e107helpers/calendar/calendar_class.php")) {
      $text .= "<div style='text-align:center'>";
      $text .= AGENDA_LAN_104;
      $text .= AGENDA_LAN_105;
      $text .= "</div>";
   }

   $text .= "<div style='text-align:center'><form method='post' action='".e_SELF."'><table style='width:94%' class='fborder'>";

   for ($i=0; $i<count($prefcapt); $i++) {
      $form_send = $prefname[$i] . "|" .$preftype[$i]."|".$prefvalu[$i];
      $text .= "<tr><td class='forumheader3'>".$prefcapt[$i]."<br><span class='smalltext'>".$prefnote[$i]."</span></td><td class='forumheader3'>";
      $name = $prefname[$i];
      $text .= $rs->user_extended_element_edit($form_send,$pref[$name],$name);
      $text .= "</td></tr>";
   };

   $text .= "<tr style='vertical-align:top'><td colspan='2' style='text-align:center' class='forumheader'>
      <input class='button' type='submit' name='updatesettings' value='".AGENDA_LAN_29."' /></td></tr></table></form></div>";

   $ns->tablerender($preftitle, $text);

   require_once(e_ADMIN."footer.php");

?>