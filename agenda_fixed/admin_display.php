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
| $Source: e:\_repository\e107_plugins/agenda/admin_display.php,v $
| $Revision: 1.12 $
| $Date: 2006/11/29 01:17:00 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   require_once("../../class2.php");
   if (!getperms("P")) {
      header("location:".e_BASE."index.php");
   }
   require_once(e_ADMIN."auth.php");
   require(e_PLUGIN."agenda/agenda_variables.php");

   $preftitle  = AGENDA_LAN_ADMIN_06;
   $pageid     = "display";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_16_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_16_1;
   $prefname[] = "agenda_page_title";
   $preftype[] = "text";
   $prefvalu[] = AGENDA_LAN_NAME.",40,40";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_13_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_13_1;
   $prefname[] = "agenda_nav_menu_title";
   $preftype[] = "text";
   $prefvalu[] = AGENDA_LAN_NAME.",40,40";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_32_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_32_1;
   $prefname[] = "agenda_subs_menu_title";
   $preftype[] = "text";
   $prefvalu[] = AGENDA_LAN_110.",40,40";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_15_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_15_1;
   $prefname[] = "agenda_nav_on_main";
   $preftype[] = "checkbox2";
   $prefvalu[] = "Y:".AGENDA_LAN_ADMIN_PREFS_15_2;

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_26_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_26_1;
   $prefname[] = "agenda_month_links";
   $preftype[] = "checkbox2";
   $prefvalu[] = "Y:".AGENDA_LAN_ADMIN_PREFS_26_2;

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_09_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_09_1;
   $prefname[] = "agenda_header_css";
   $preftype[] = "text";
   $prefvalu[] = "forumheader,30,30";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_10_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_10_1;
   $prefname[] = "agenda_day_css";
   $preftype[] = "text";
   $prefvalu[] = "forumheader2,30,30";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_11_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_11_1;
   $prefname[] = "agenda_today_css";
   $preftype[] = "text";
   $prefvalu[] = "indent,30,30";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_12_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_12_1;
   $prefname[] = "agenda_day_with_entries_css";
   $preftype[] = "text";
   $prefvalu[] = "forumheader3,30,30";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_07_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_07_1;
   $prefname[] = "agenda_dayname_length";
   $preftype[] = "dropdown";
   $prefvalu[] = "1,2,3";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_37_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_37_1;
   $prefname[] = "agenda_detailed_tooltips";
   $preftype[] = "checkbox2";
   $prefvalu[] = "Y:".AGENDA_LAN_ADMIN_PREFS_37_2;

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_39_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_39_1;
   $prefname[] = "agenda_locallink_in_new_window";
   $preftype[] = "checkbox2";
   $prefvalu[] = "Y:".AGENDA_LAN_ADMIN_PREFS_39_2;

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_40_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_40_1;
   $prefname[] = "agenda_weblink_in_new_window";
   $preftype[] = "checkbox2";
   $prefvalu[] = "Y:".AGENDA_LAN_ADMIN_PREFS_40_2;

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_41_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_41_1;
   $prefname[] = "agenda_icons_in_menu";
   $preftype[] = "checkbox2";
   $prefvalu[] = "Y:".AGENDA_LAN_ADMIN_PREFS_41_2;


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