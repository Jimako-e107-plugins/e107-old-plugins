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
| $Source: E:/cvs/cvsrepo/agenda/admin_subs.php,v $
| $Revision: 1.4 $
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

   $preftitle  = AGENDA_LAN_ADMIN_11;
   $pageid     = "subs";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_33_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_33_1;
   $prefname[] = "agenda_allow_subscriptions";
   $preftype[] = "checkbox2";
   $prefvalu[] = "Y:".AGENDA_LAN_ADMIN_PREFS_33_2;

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_34_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_34_1;
   $prefname[] = "agenda_subs_from_name";
   $preftype[] = "text";
   $prefvalu[] = $pref['siteadmin'].",40,100";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_35_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_35_1;
   $prefname[] = "agenda_subs_from_email";
   $preftype[] = "text";
   $prefvalu[] = $pref['siteadminemail'].",40,100";

   $prefcapt[] = AGENDA_LAN_ADMIN_PREFS_36_0;
   $prefnote[] = AGENDA_LAN_ADMIN_PREFS_36_1;
   $prefname[] = "agenda_subs_subject_prefix";
   $preftype[] = "text";
   $prefvalu[] = ",40,100";

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