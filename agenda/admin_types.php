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
| $Source: E:/cvs/cvsrepo/agenda/admin_types.php,v $
| $Revision: 1.7 $
| $Date: 2005/10/02 13:13:43 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   require_once("../../class2.php");
   if (!getperms("P")) {
      header("location:".e_BASE."index.php");
   }
   require_once(e_ADMIN."auth.php");
   require(e_PLUGIN."agenda/agenda_variables.php");

   $configtitle      = AGENDA_LAN_ADMIN_04;
   $primaryid        = "typ_id";
   $pageid           = "types";
   $show_preset      = false;

   $fieldcapt[] = AGENDA_LAN_ADMIN_TYPE_00_0;
   $fieldnote[] = AGENDA_LAN_ADMIN_TYPE_00_1;
   $fieldname[] = "typ_name";
   $fieldtype[] = "text";
   $fieldvalu[] = ",50,100";
   $fieldmand[] = "*";

   $fieldcapt[] = AGENDA_LAN_ADMIN_TYPE_01_0;
   $fieldnote[] = AGENDA_LAN_ADMIN_TYPE_01_1;
   $fieldname[] = "typ_description";
   $fieldtype[] = "textarea";
   $fieldvalu[] = ",98%,100px";
   $fieldmand[] = "";

   $fieldcapt[] = AGENDA_LAN_ADMIN_TYPE_02_0;
   $fieldnote[] = AGENDA_LAN_ADMIN_TYPE_02_1;
   $fieldname[] = "typ_timed";
   $fieldtype[] = "checkbox2";
   $fieldvalu[] = "1:".AGENDA_LAN_ADMIN_TYPE_02_2;
   $fieldmand[] = "";

   $fieldcapt[] = AGENDA_LAN_ADMIN_TYPE_06_0;
   $fieldnote[] = AGENDA_LAN_ADMIN_TYPE_06_1;
   $fieldname[] = "typ_floating";
   $fieldtype[] = "checkbox2";
   $fieldvalu[] = "1:".AGENDA_LAN_ADMIN_TYPE_06_2;
   $fieldmand[] = "";

   $fieldcapt[] = AGENDA_LAN_ADMIN_TYPE_07_0;
   $fieldnote[] = AGENDA_LAN_ADMIN_TYPE_07_1;
   $fieldname[] = "typ_recurring";
   $fieldtype[] = "checkbox2";
   $fieldvalu[] = "1:".AGENDA_LAN_ADMIN_TYPE_07_2;
   $fieldmand[] = "";

   $fieldcapt[] = AGENDA_LAN_ADMIN_TYPE_03_0;
   $fieldnote[] = AGENDA_LAN_ADMIN_TYPE_03_1;
   $fieldname[] = "typ_fields";
   $fieldtype[] = "multilist2";
   unset($tmp);
   for ($i=0; $i<count($agn_optional_fields); $i++) {
      $tmp[] = $agn_optional_fields[$i].":".$agn_field[$agn_optional_fields[$i]]['capt'];
   }
   // Add custom fields if set
   for ($i=1; $i<5; $i++) {
      if (strlen($pref["agenda_custom_field_".$i."_name"]) > 0) {
         $tmp[] = "100$i:".$pref["agenda_custom_field_".$i."_name"];
      }
   }
   $fieldvalu[] = implode(",", $tmp);
   $fieldmand[] = "";

   $fieldcapt[] = AGENDA_LAN_ADMIN_TYPE_04_0;
   $fieldnote[] = AGENDA_LAN_ADMIN_TYPE_04_1;
   $fieldname[] = "typ_user";
   $fieldtype[] = "accesstable";
   $fieldvalu[] = "";

   $fieldcapt[] = AGENDA_LAN_ADMIN_TYPE_05_0;
   $fieldnote[] = AGENDA_LAN_ADMIN_TYPE_05_1;
   $fieldname[] = "typ_admin";
   $fieldtype[] = "accesstable";
   $fieldvalu[] = "";


//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------

   // -------- Presets. ------------  // always load before auth.php
   if ($show_preset) {
      require_once(e_HANDLER."preset_class.php");
      $pst = new e_preset;
      $pst->form = "adminform";
      $pst->page = e_SELF;
      $pst->id = "admin_".$agenda->getTypeTable();
   }

   $rs = new agenda_form;

   // Validation checks
   if (isset($_POST['add']) || isset($_POST['update'])) {
      if (strlen($_POST['typ_name']) == 0) {
         $message .= AGENDA_LAN_ADMIN_TYPE_00_MAND;
      }
   }

   // Data is valid so try and add
   if (!isset($message) && isset($_POST['add'])) {
      $count = count($fieldname);

      unset($inputstr);
      for ($i=0; $i<$count; $i++) {
         $inputstr[] = " '".$rs->getfieldvalue($fieldname[$i], $fieldtype[$i], $agenda->isDebug())."' ";
      }
      $inputstr = implode(",", $inputstr);
      if ($agn_sql1->db_Insert($agenda->getTypeTable(), "0, $inputstr", $agenda->isDebug())) {
         $message = LAN_CREATED;
         unset($_POST['add']);
      } else {
         $message = LAN_CREATED_FAILED;
      }
   }

   // Data is valid so try and update
   if (!isset($message) && isset($_POST['update'])) {
      if ($agenda->isDebug()) print "<br>".print_r($_POST)."<br>";
      $count = count($fieldname);
      for ($i=0; $i<$count; $i++) {
         $inputstr[] .= $fieldname[$i]."='".$rs->getfieldvalue($fieldname[$i], $fieldtype[$i], $agenda->isDebug())."'";
      }
      $inputstr = implode(",", $inputstr);
      if ($agn_sql1->db_Update($agenda->getTypeTable(), "$inputstr WHERE $primaryid='".$_POST[$primaryid]."'", $agenda->isDebug())) {
         $message = LAN_UPDATED;
         unset($_POST['update']);
      } else {
         print mysql_error();
         $message = LAN_UPDATED_FAILED;
      }
   }

   // Get details from DB if Edit, otherwise set from POST data
   if (isset($_POST['edit'])) {
      $agn_sql1->db_Select($agenda->getTypeTable(), "*", "$primaryid='".$_POST['existing']."'", true, $agenda->isDebug());
      $row = $agn_sql1->db_Fetch();
   } else {
      if (isset($_POST['add']) || isset($_POST['update'])) {
         $row = $_POST;
      }
   }

   // Try the delete
   if (isset($_POST['delete'])) {
      $agn_sql1->db_Select($agenda->getAgendaTable(), "*", "category='".$_POST['existing']."'", true, $agenda->isDebug());
      if (!$agn_sql1->db_Fetch()) {
         $msg = ($agn_sql1->db_Delete($agenda->getTypeTable(), "$primaryid='".$_POST['existing']."'", $agenda->isDebug())) ? LAN_DELETED : LAN_DELETED_FAILED;
      } else {
         $msg = AGENDA_LAN_ADMIN_MISC_2;
      }
      message_handler("MESSAGE", $msg);
   }

   // Draw the form
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

   $text .= "<div style='text-align:center'><form method='post' action='".e_SELF."' id='myexistingform'>
      <table style='width:100%;margin-left:auto;margin-right:auto;' class='fborder'>";

   if (isset($message)) {
      $text .= "<tr><td colspan='2' class='spacer' style='text-align:center'>$message</td></tr>";
   }

   $text .= "<tr><td colspan='2' class='forumheader' style='text-align:center'>";

   $table_total = $agn_sql1->db_Select($agenda->getTypeTable(), "*", "order by typ_name asc", "", $agenda->isDebug());
   if (!$table_total) {
      $text .= LAN_EMPTY;
   } else {
      $text .= "<span class='defaulttext'>".LAN_EXISTING."&nbsp;</span><select name='existing' class='tbox'>";
      while ($trow = $agn_sql1->db_Fetch()) {
         extract($trow, EXTR_OVERWRITE);
         $selected = $typ_id==$_POST['existing'] ? " selected" : "";
         $text .= "<option value='$typ_id'$selected>$typ_name</option>";
      }
      $text .= "</select>&nbsp;&nbsp;
               <input class='button' type='submit' name='edit'   value='".LAN_EDIT."' />
               <input class='button' type='submit' name='delete' value='".LAN_DELETE."' />
               </td></tr>";
   }

   $text .= "</table></form></div>";
   $text .= "<div style='text-align:center'>";
   $text .= "<form method='post' action='".e_SELF."' id='adminform'><table class='fborder' style='margin-left:auto;margin-right:auto;width:100%'>";
   for ($i=0; $i<count($fieldcapt); $i++) {
      $form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
      $text .= "<tr>
         <td style='vertical-align:top' class='forumheader3'>".$fieldcapt[$i]." ".$fieldmand[$i]."<br /><span class='smalltext'>".$fieldnote[$i]."</span></td>
         <td class='forumheader3'>";

      $text .= $rs->user_extended_element_edit($form_send, $row[$fieldname[$i]], $fieldname[$i]);
      $text .= "</td></tr>";
   };

   $text .= "<tr style='vertical-align:top'><td colspan='2' style='text-align:center' class='forumheader'>";

   if (isset($_POST['edit']) || isset($_POST['update'])){
      $text .= "<input class='button' type='submit' id='update' name='update' value='".LAN_UPDATE."' />
      <input type='hidden' name='$primaryid' value='".$row[$primaryid]."'>";
   } else {
      $text .= "<input class='button' type='submit' id='add' name='add' value='".LAN_CREATE."' />";
   }

   $text .= "</td></tr></table></form></div>";
   $ns->tablerender($configtitle, $text);

   require_once(e_ADMIN."footer.php");
?>