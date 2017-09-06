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
| $Source: E:/cvs/cvsrepo/agenda/admin_prefs.php,v $
| $Revision: 1.10 $
| $Date: 2005/11/08 21:35:14 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   require_once("../../class2.php");
   if (!getperms("P")) {
      header("location:".e_BASE."index.php");
   }
   require_once(e_ADMIN."auth.php");
   require(e_PLUGIN."agenda/agenda_variables.php");

   $preftitle  = AGENDA_LAN_ADMIN_03;
   $pageid     = "prefs";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_31_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_31_1;
   $prefname[] = "agenda_view_pages";
   $preftype[] = "accesstable";
   $prefvalu[] = "";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_01_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_01_1;
   $prefname[] = "agenda_add_entry";
   $preftype[] = "accesstable";
   $prefvalu[] = "";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_02_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_02_1;
   $prefname[] = "agenda_add_category";
   $preftype[] = "accesstable";
   $prefvalu[] = "";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_06_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_06_1;
   $prefname[] = "agenda_week_start";
   $preftype[] = "dropdown2";
   $prefvalu[] = "0:".AGENDA_LAN_07.",1:".AGENDA_LAN_01;

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_14_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_14_1;
   $prefname[] = "agenda_icon_dir";
   $preftype[] = "dir";
   $prefvalu[] = e_IMAGE;

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_19_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_19_1;
   $prefname[] = "agenda_default_view";
   $preftype[] = "dropdown2";
   $prefvalu[] = $agenda->getViewsList();

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_44_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_44_1;
   $prefname[] = "agenda_private_calendar";
   $preftype[] = "checkbox2";
   $prefvalu[] = "Y:".AGENDA_LAN_ADMIN_PREFS_44_2;

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_47_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_47_1;
   $prefname[] = "agenda_comments";
   $preftype[] = "checkbox2";
   $prefvalu[] = "Y:".AGENDA_LAN_ADMIN_PREFS_47_2;

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_48_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_48_1;
   $prefname[] = "agenda_ratings";
   $preftype[] = "checkbox2";
   $prefvalu[] = "Y:".AGENDA_LAN_ADMIN_PREFS_48_2;

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_99_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_99_1;
   $prefname[] = "agenda_debug";
   $preftype[] = "checkbox2";
   $prefvalu[] = "Y:".AGENDA_LAN_ADMIN_PREFS_99_2;

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

   if (file_exists(e_PLUGIN."updatechecker/updatechecker.php")) {
      require_once(e_PLUGIN."updatechecker/updatechecker.php");
      $text .= updateChecker(AGENDA_LAN_NAME, AGENDA_LAN_VER, "http://www.bugrain.plus.com/e107plugins/agenda.ver", "|");
   }

   if (!file_exists(e_HANDLER."calendar/calendar_class.php")) {
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