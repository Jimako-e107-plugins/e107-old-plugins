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
| $Source: E:/cvs/cvsrepo/agenda/admin_import.php,v $
| $Revision: 1.13 $
| $Date: 2006/02/14 23:12:37 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   require_once("../../class2.php");
   if (!getperms("P")) {
      header("location:".e_BASE."index.php");
   }
   require_once(e_ADMIN."auth.php");
   require(e_PLUGIN."agenda/agenda_variables.php");

   $configtitle   = AGENDA_LAN_ADMIN_05;
   $pageid        = "import";

   $fieldcapt[]   = AGENDA_LAN_ADMIN_PREFS_20_0;
   $fieldnote[]   = AGENDA_LAN_ADMIN_PREFS_20_1;
   $fieldname[]   = "agenda_verbose";
   $fieldtype[]   = "checkbox2";
   $fieldvalu[]   = "Y:".AGENDA_LAN_ADMIN_PREFS_20_2;
   $fielddflt[]   = "Y";

   $fieldcapt[]   = AGENDA_LAN_ADMIN_PREFS_21_0;
   $fieldnote[]   = AGENDA_LAN_ADMIN_PREFS_21_1;
   $fieldname[]   = "agenda_empty_db";
   $fieldtype[]   = "checkbox2";
   $fieldvalu[]   = "Y:".AGENDA_LAN_ADMIN_PREFS_21_2;
   $fielddflt[]   = "";

   $fieldcapt[]   = AGENDA_LAN_ADMIN_PREFS_22_0;
   $fieldnote[]   = AGENDA_LAN_ADMIN_PREFS_22_1;
   $fieldname[]   = "agenda_import_calendar";
   $fieldtype[]   = "checkbox2";
   $fieldvalu[]   = "Y:".AGENDA_LAN_ADMIN_PREFS_22_2;
   $fielddflt[]   = "Y";

   $fieldcapt[]   = AGENDA_LAN_ADMIN_PREFS_23_0;
   $fieldnote[]   = AGENDA_LAN_ADMIN_PREFS_23_1;
   $fieldname[]   = "agenda_import_ecalendar";
   $fieldtype[]   = "checkbox2";
   $fieldvalu[]   = "Y:".AGENDA_LAN_ADMIN_PREFS_23_2;
   $fielddflt[]   = "";

   $fieldcapt[]   = AGENDA_LAN_ADMIN_PREFS_24_0;
   $fieldnote[]   = AGENDA_LAN_ADMIN_PREFS_24_1;
   $fieldname[]   = "agenda_import_timed_type";
   $fieldtype[]   = "dropdown2";
   $fieldvalu[]   = $agenda->GetTypesList();
   $fielddflt[]   = "1";

   $fieldcapt[]   = AGENDA_LAN_ADMIN_PREFS_25_0;
   $fieldnote[]   = AGENDA_LAN_ADMIN_PREFS_25_1;
   $fieldname[]   = "agenda_import_untimed_type";
   $fieldtype[]   = "dropdown2";
   $fieldvalu[]   = $agenda->GetTypesList();
   $fielddflt[]   = "2";

   $tables = array($agenda->getAgendaTable(), $agenda->getCategoryTable(), $agenda->getUserTable());

   $rs = new agenda_form;
   $verbose = isset($_POST["agenda_verbose"]) ? true : false;
   $errors = false;


// ****************** Needs localizing
   if (isset($_POST["import"])) {
      $message = "<h3>Import results</h3>";

      // Empty tables if reqested to do so
      if (isset($_POST['agenda_empty_db']) && $_POST['agenda_empty_db'] == "Y") {
         $message .= "<h4>Emptying Agenda tables</h4><ul>";
         for ($i=0; $i<count($tables); $i++) {
            if ($tables[$i] != $agenda->getTypeTable()) {
               $tmp = $agn_sql1->db_Delete($tables[$i], "", $agenda->isDebug());
               if ($tmp) {
                  $message .= $verbose ? "<li>".$tables[$i]." emptied</li>" : "";
               } else {
                  $message .= "<li>".$tables[$i]." failed to empty</li>";
                  $errors = true;
               }
            }
         }
         $message .= "</ul>";
      }

      if (!$errors) {
         // Deleted data OK or not asked to do so, OK to continue with import

         // Are we importing stuff from e107 calendar menu plugin
         if (isset($_POST['agenda_import_calendar']) && $_POST['agenda_import_calendar'] == "Y") {
            // Import Categories
            $message .= "<h4>Importing from e107 v0.7 Calendar</h4>";
            $table_total = $agn_sql1->select("event_cat", "*", "", false, $agenda->isDebug());
            if ($table_total) {
               $message .= "Importing categories<ul>";
               while ($trow = $agn_sql1->db_Fetch()) {
                  extract($trow, EXTR_OVERWRITE);
                  if (strlen($event_cat_icon) > 0) {
                     $event_cat_icon = "../../e107_plugins/calendar_menu/images/$event_cat_icon";
                  }
                  $inputstr  = "'$event_cat_id', '$event_cat_name', '', '$event_cat_icon', 0, '$event_cat_subs', ";
                  $inputstr .= "'$event_cat_class', '$event_cat_ahead', '$event_cat_msg1', '$event_cat_msg2', ";
                  $inputstr .= "'$event_cat_notify', '$event_cat_last', '$event_cat_today'";
                  if ($agn_sql2->db_Insert($agenda->getCategoryTable(), $inputstr, $agenda->isDebug())) {
                     $message .= $verbose ? "<li>".AGENDA_LAN_90." $event_cat_name : inserted</li>" : "";
                  } else {
                     $message .= "<li>".AGENDA_LAN_90." $event_cat_name : insert failed (".mysqli_error().")</li>";
                  }
               }
               $message .= "</ul>";
            }
            // Import entries
            $table_total = $agn_sql1->select("event", "*", "", false, $agenda->isDebug());
            if ($table_total) {
               $message .= "Importing entries<ul>";
               while ($trow = $agn_sql1->db_Fetch()) {
                  extract($trow, EXTR_OVERWRITE);
                  $inputstr  = "'$event_id', '$event_title', ";
                  if ($event_allday == "1") {
                     $inputstr .= "'".$_POST["agenda_import_untimed_type"]."', ";
                  } else {
                     $inputstr .= "'".$_POST["agenda_import_timed_type"]."', ";
                  }
                  $inputstr .= "'$event_category', ";
                  $inputstr .= "'$event_start', ";
                  $inputstr .= "'$event_end', ";
                  if ($event_recurring == "1") {
                     $inputstr .= "'Y".dechex($event_rec_y).$event_rec_m."', ";
                  } else {
                     $inputstr .= "'', ";
                  }
                  $inputstr .= "'$event_location', ";
                  $inputstr .= "'$event_details', ";
                  $inputstr .= "'$event_author', ";
                  // Strip user id - we don't use it
                  $tmp = explode(".", $event_author);
                  if (ereg("[0-9]+", $tmp[0])) {
                     $inputstr .= "'".$tmp[1]."', ";
                  } else {
                     $inputstr .= "'$event_author', ";
                  }
                  $inputstr .= "'$event_contact', ";
                  $inputstr .= "'0', ";                  // priority
                  $inputstr .= "'0', ";                  // private
                  $inputstr .= "'0', ";                  // complete
                  $inputstr .= "'0', ";                  // question
                  $inputstr .= "'', ";                   // responses
                  $inputstr .= "'$event_thread', ";      //
                  $inputstr .= "'', ";                   // data 1
                  $inputstr .= "'', ";                   // data 2
                  $inputstr .= "'', ";                   // data 3
                  $inputstr .= "'', ";                   // data 4
                  $inputstr .= "'$event_datestamp'";     // timestamp

                  if ($agn_sql2->db_Insert($agenda->getAgendaTable(), $inputstr, $agenda->isDebug())) {
                     $message .= $verbose ? "<li>Event $event_title : inserted</li>" : "";
                  } else {
                     $message .= "<li>Event $event_title : insert failed (".mysqli_error().")</li>";
                  }
               }
               $message .= "</ul>";
            }
         }

         // Are we importing stuff from eCalendar plugin
         if (isset($_POST['agenda_import_ecalendar']) && $_POST['agenda_import_ecalendar'] == "Y") {
            // Import Categories
            $message .= "<h4>Importing from eCalendar plugin</h4>";
            $table_total = $agn_sql1->select("ecal_cats", "*", "", false, $agenda->isDebug());
            if ($table_total) {
               $message .= "Importing categories<ul>";
               while ($trow = $agn_sql1->db_Fetch()) {
                  extract($trow, EXTR_OVERWRITE);
                  $inputstr  = "'$event_cat_id', '$event_cat_name', '', '../../e107_plugins/calendar_menu/images/$event_cat_icon', 0, '', '', ";
                  $inputstr .= "'', '', '', '', '', ''";
                  if ($agn_sql2->db_Insert($agenda->getCategoryTable(), $inputstr, $agenda->isDebug())) {
                     $message .= $verbose ? "<li>".AGENDA_LAN_90." $event_cat_name : inserted</li>" : "";
                  } else {
                     $message .= "<li>".AGENDA_LAN_90." $event_cat_name : insert failed (".mysqli_error().")</li>";
                  }
               }
               $message .= "</ul>";
            }
            // Import entries
            $table_total = $agn_sql1->select("ecal_events", "*", "", false, $agenda->isDebug());
            if ($table_total) {
               $message .= "Importing entries<ul>";
               while ($trow = $agn_sql1->db_Fetch()) {
                  extract($trow, EXTR_OVERWRITE);
                  $inputstr  = "'$event_id', '$event_title', ";
                  if ($event_allday == "1") {
                     $inputstr .= "'".$_POST["agenda_import_untimed_type"]."', ";
                  } else {
                     $inputstr .= "'".$_POST["agenda_import_timed_type"]."', ";
                  }
                  $inputstr .= "'$event_category', ";
                  $inputstr .= "'$event_start', ";
                  $inputstr .= "'$event_end', ";
                  if ($event_recurring == "1") {
                     $inputstr .= "'Y".dechex($event_rec_y).$event_rec_m."', ";
                  } else {
                     $inputstr .= "'', ";
                  }
                  $inputstr .= "'$event_location', ";
                  $tmp1 = explode("!", $event_contact);
                  $inputstr .= "'$event_details";
                  if (strlen($tmp1[0]) > 0) {
                     $inputstr .= "\nPhone: ".$tmp1[0];
                  }
                  if (strlen($tmp1[1]) > 0) {
                     $inputstr .= "\nAddress: ".$tmp1[1];
                  }
                  $inputstr .= "', '$event_author', ";
                  // Strip user id - we don't use it
                  $tmp = explode(".", $event_author);
                  if (ereg("[0-9]+", $tmp[0])) {
                     $inputstr .= "'".$tmp[1]."', ";
                  } else {
                     $inputstr .= "'$event_author', ";
                  }
                  $tmp = explode("!", $event_email);
                  $inputstr .= "'$tmp[0]', ";
                  $inputstr .= "'0', ";                  // priority
                  $inputstr .= "'0', ";                  // private
                  $inputstr .= "'0', ";                  // complete
                  $inputstr .= "'0', ";                  // question
                  $inputstr .= "'', ";                   // responses
                  $tmp = explode(".", $event_thread);
                  $inputstr .= "'".$tmp[0]."', ";        // thread/URL
                  $inputstr .= "'', ";                   // data 1
                  $inputstr .= "'', ";                   // data 2
                  $inputstr .= "'', ";                   // data 3
                  $inputstr .= "'', ";                   // data 4
                  $inputstr .= "'$event_datestamp'";     // timestamp

                  if ($agn_sql2->db_Insert($agenda->getAgendaTable(), $inputstr, $agenda->isDebug())) {
                     $message .= $verbose ? "<li>Event $event_title : inserted</li>" : "";
                  } else {
                     $message .= "<li>Event $event_title : insert failed (".mysqli_error().")</li>";
                  }
               }
               $message .= "</ul>";
            }
         }
      }
   }
 
   $text .= "<div style='text-align:center'><form method='post' action='".e_SELF."' id='myexistingform'>
      <table style='width:100%;margin-left:auto;margin-right:auto;' class='fborder'>";

   if (isset($message)) {
      $text .= "<tr><td colspan='2' class='' style='text-align:left'>$message</td></tr>";
   }

   $text .= "<form method='post' action='".e_SELF."' id='adminform'><table class='fborder' style='margin-left:auto;margin-right:auto;width:100%'>";
   for ($i=0; $i<count($fieldcapt); $i++) {
      $form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
      $text .= "<tr>
         <td style='vertical-align:top' class='forumheader3'>".$fieldcapt[$i]." ".$fieldmand[$i]."<br /><span class='smalltext'>".$fieldnote[$i]."</span></td>
         <td class='forumheader3'>";

      $text .= $rs->user_extended_element_edit($form_send, $fielddflt[$i], $fieldname[$i]);
      $text .= "</td></tr>";
   };

   $text .= "<tr style='vertical-align:top'><td colspan='2' style='text-align:center' class='forumheader'>
      <input class='button' type='submit' name='import' value='".AGENDA_LAN_47."' /></td></tr></table></form></div>";

   $ns->tablerender($configtitle, $text);

   require_once(e_ADMIN."footer.php");

?>