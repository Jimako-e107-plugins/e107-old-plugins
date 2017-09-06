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
| $Source: e:\_repository\e107_plugins/agenda/agenda.php,v $
| $Revision: 1.32 $
| $Date: 2007/06/04 21:39:29 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   require_once("../../class2.php");
   require_once(HEADERF);
   require(e_PLUGIN."agenda/agenda_variables.php");
   require(e_PLUGIN."agenda/agendaUtils.php");

   if (!check_class($pref['agenda_view_pages'])) {
      // No access for current user
      $ns -> tablerender($pref["agenda_page_title"], AGENDA_LAN_106);
      return;
      require_once(FOOTERF);
      exit;
   }

   $text = generateJS();
   $pagetitle = isset($pref["agenda_page_title"]) && strlen($pref["agenda_page_title"]) > 0 ? $pref["agenda_page_title"] : AGENDA_LAN_NAME;

   $agn_error = "";
   switch ($agenda->getP1()) {
      case "add" : {
         if (check_class($pref['agenda_add_entry'])) {
            $text .= agendaEntryAdd();
         } else {
            $agn_error = true;
         }
         break;
      }
      case "edit" : {
         if (check_class($pref['agenda_add_entry'])) {
            $text .= agendaEntryEdit();
         } else {
            $agn_error = true;
         }
         break;
      }
      case "changetype" : {
         if (check_class($pref['agenda_add_entry'])) {
            $text .= agendaEntryChangeType();
         } else {
            $agn_error = true;
         }
         break;
      }
      case "updatetype" : {
         if (check_class($pref['agenda_add_entry'])) {
            $text .= agendaEntryUpdateType();
         } else {
            $agn_error = true;
         }
         break;
      }
      case "save" : {
         if (check_class($pref['agenda_add_entry'])) {
            // Get the form values that match DB columns
            $rs = new agenda_form;
            unset($inpstr);
            unset($colstr);
            $invalid_fields = array();

            if (isset($_POST['id'])) { // Update
               $qry = $agenda->getTableJoin()."where e.agn_id=".$agenda->getP3();
               if ($agn_sql1->db_Select_gen($qry, $agenda->isDebug()) && $agn_erow = $agn_sql1->db_Fetch()) {
                  extract($agn_erow, EXTR_OVERWRITE);
                  $allfields = array_merge($agn_required_fields, $agn_required_fields_timed[$typ_timed], array_filter(explode(",", $typ_fields), "agendaRemoveBlank"));

                  // All fields for the type
                  for ($i=0; $i<count($allfields); $i++) {
                     $field = $agn_field[$allfields[$i]];
                     $value = $rs->getfieldvalue($field["name"], $field["type"], $agenda->isDebug());
                     if (strlen($field['mand']) > 0 && strlen($value) == 0) {
                        $invalid_fields[]['field'] = $field['capt'];
                        $invalid_fields[count($invalid_fields)-1]['reason'] = AGENDA_LAN_108;
                     } elseif (!$rs->validatefieldvalue($field["name"], $field["type"], $value, $field["type"], $agenda->isDebug())) {
                        $invalid_fields[]['field'] = $field['capt'];
                        $invalid_fields[count($invalid_fields)-1]['reason'] = AGENDA_LAN_109;
                     }
                     $inpstr[] = $field['name']."='".$value."'";
                  }
                  // Control and hidden from user fields
                  $inpstr[] = "agn_author='".USERID.".".USERNAME."'";
                  $inpstr[] = "agn_datestamp='".time()."'";

                  if ($typ_floating == "1") {
                     // Check if we need to update end date for floating events
                     if ($agn_complete == "0") {
                        if (isset($_POST["agn_complete"]) && $_POST["agn_complete"] == "1") {
                           // We're marking this as complete when it wasn't before
                           $inpstr[] = "agn_end='".$agenda->getTodayDS()."'";
                        }
                     } else {
                        if (!isset($_POST["agn_complete"]) || $_POST["agn_complete"] != "1") {
                           // We're marking this as incomplete when it was previously completed
                           $inpstr[] = "agn_end='-1'";
                        }
                     }
                  }
                  if (count($invalid_fields) > 0) {
                     $agenda->setP1("edit");
                  } else {
                     $qry = implode(", ", $inpstr) . " where agn_id=".$agenda->getP3();
                     $res = $agn_sql1->db_Update($agenda->getAgendaTable(), $qry, $agenda->isDebug());
                  }
               } else {
                  $res = false;
               }
            } else { // Add new
               $agn_sql1->db_Select($agenda->getTypeTable(), "*", "typ_id=".$agenda->getP5(), true, $agenda->isDebug());
               if ($trow = $agn_sql1->db_Fetch()) {
                  extract($trow, EXTR_OVERWRITE);
                  $allfields = array_merge($agn_required_fields, $agn_required_fields_timed[$typ_timed], array_filter(explode(",", $typ_fields), "agendaRemoveBlank"));

                  // Process all fields for this type
                  for ($i=0; $i<count($allfields); $i++) {
                     $field = $agn_field[$allfields[$i]];
                     $value = $rs->getfieldvalue($field["name"], $field["type"], $agenda->isDebug());
                     if (strlen($field['mand']) > 0 && strlen($value) == 0) {
                        $invalid_fields[]['field'] = $field['capt'];
                        $invalid_fields[count($invalid_fields)-1]['reason'] = AGENDA_LAN_108;
                     } elseif (!$rs->validatefieldvalue($field["name"], $field["type"], $value, $field["type"], $agenda->isDebug())) {
                        $invalid_fields[]['field'] = $field['capt'];
                        $invalid_fields[count($invalid_fields)-1]['reason'] = AGENDA_LAN_109;
                     }
                     $colstr[] = $field["name"];
                     $inpstr[] = "'".$value."'";
                  }
               }

               // Control and hidden from user fields
               $colstr[] = "agn_type";
               $inpstr[] = "'".$agenda->getP5()."'";
               $colstr[] = "agn_author";
               $inpstr[] = "'".USERID.".".USERNAME."'";
               $colstr[] = "agn_datestamp";
               $inpstr[] = "'".time()."'";

               $qry = "(".implode(", ", $colstr).") values (".implode(", ", $inpstr).")";
               $agn_sql1 = new e107HelperDB();
               $res = $agn_sql1->db_InsertPart($agenda->getAgendaTable(), $qry, $agenda->isDebug());
               $agenda->setP3($res);
            }

            $pagetitle .= " : ".AGENDA_LAN_33." $typ_name";
            if (count($invalid_fields) > 0) {
               // Some invalid fields
               $text .= AGENDA_LAN_107."<br />";
               for ($i=0; $i<count($invalid_fields); $i++) {
                  $text .= $invalid_fields[$i]['field']." (".$invalid_fields[$i]['reason'].")<br />";
               }
               message_handler("MESSAGE", $text);
               if (isset($_POST['id'])) { // Update
                  $text = agendaEntryEdit();
               } else {
                  $text = agendaEntryAdd();
               }
            } else {
               $mysqlerror = mysqli_error();
               // Add/update was maybe OK
               agendaSendEmail(isset($_POST['id']) ? "update" : "add", $agenda->getP3());
               if ($res) {
                  $msg = AGENDA_LAN_MSG_00;
               } else {
                  $msg = "<div onclick='expandit(\"agenda_message\");' style='cursor:pointer'>".AGENDA_LAN_MSG_01."</div>";
                  $msg .= "<div id='agenda_message' class='smalltext' style='display:none'>".$mysqlerror."</div>";
               }
               message_handler("MESSAGE", $msg);
               if (isset($_POST["multiadd"]) && $_POST["multiadd"] == "Y") {
                  $text .= agendaEntryAdd();
               } else {
                  require_once(e_PLUGIN."agenda/agendaViewItem.php");
               }
            }
         } else {
            $agn_error = true;
         }

         break;
      }
      case "delete" : {
         if (check_class($pref['agenda_add_entry'])) {
            $pagetitle .= " : ".AGENDA_LAN_23;
            agendaSendEmail("delete", $agenda->getP3());
            $msg = ($agn_sql1->db_Delete($agenda->getAgendaTable(), "agn_id=".$agenda->getP3(), $agenda->isDebug())) ? AGENDA_LAN_MSG_03 : AGENDA_LAN_MSG_04;
            message_handler("MESSAGE", $msg);
            agendaSetFilterSQL();
            require_once(e_PLUGIN."agenda/agendaView".$agenda->getP2().".php");
         } else {
            $agn_error = true;
         }
         break;
      }
      case "viewitem" : {
         $pagetitle .= " : ".AGENDA_LAN_38;
         require_once(e_PLUGIN."agenda/agendaViewItem.php");
         break;
      }
      case "register" : {
         $pagetitle .= " : ".AGENDA_LAN_127;
         $agn_sql1->db_Select($agenda->getAgendaTable(), "agn_responses", "agn_id=".$agenda->getP3(), true, $agenda->isDebug());
         $agn_erow = $agn_sql1->db_Fetch();
         $agn_responses = array();
         if (strlen($agn_erow["agn_responses"])) {
            $agn_responses = explode(",", $agn_erow["agn_responses"]);
         }
         $found = false;
         for ($i=0; $i<count($agn_responses); $i++) {
            if (strstr($agn_responses[$i], USERID."=")) {
               $agn_responses[$i] = USERID."=".$agenda->getP5();
               $found = true;
            }
         }
         if (!$found) {
            if (strlen($agn_erow["agn_responses"])) {
               array_push($agn_responses, USERID."=".$agenda->getP5());
            } else {
               $agn_responses[0] = USERID."=".$agenda->getP5();
            }
         }
         $tmp = $agn_sql1->db_Update($agenda->getAgendaTable(), "agn_responses='".implode(",", $agn_responses)."' where agn_id=".$agenda->getP3(), $agenda->isDebug());
         if (!$tmp && strlen(mysqli_error())) {
            print "<br>$tmp, error: ".$agn_sql1->dbError()."..".mysqli_error();
         }
         require_once(e_PLUGIN."agenda/agendaViewItem.php");
         break;
      }
      case "setfilter" : {
         $rs = new agenda_form;
         $update = $agn_sql1->db_Select($agenda->getUserTable(), "*", "usr_id=".$currentUser["user_id"], true, $agenda->isDebug());
         for ($i=0; $i<count($agn_filter_fields); $i++) {
            $value = $rs->getfieldvalue($agn_field[$agn_filter_fields[$i]]["name"], $agn_field[$agn_filter_fields[$i]]["type"], $agenda->isDebug());
            if (strlen($value) > 0) {
               $inpstr[] = $agn_filter_fields[$i].":".$value;
            }
         }
         if ($update) {
            $qry  = "usr_filter_state='".$_POST["usr_filter_state"]."', ";
            $qry .= "usr_filter='".implode(";", $inpstr)."' where usr_id=".$currentUser["user_id"];
            $res = $agn_sql1->db_Update($agenda->getUserTable(), $qry, $agenda->isDebug());
         } else {
            $qry .= $currentUser["user_id"].", '".$_POST["usr_filter_state"]."', '".implode(";", $inpstr)."'";
            $res = $agn_sql1->db_Insert($agenda->getUserTable(), $qry, $agenda->isDebug());
         }
         agendaSetFilterSQL();
         require_once(e_PLUGIN."agenda/agendaView".$agenda->getP2().".php");

         break;
      }
      case "typehelp" : {
         $pagetitle .= " : ".AGENDA_LAN_34;
         $agn_sql1->db_Select($agenda->getTypeTable(), "*", "order by typ_name", false, $agenda->isDebug());
         $text  = "<div style='text-align:center'>";
         $text .= "<table style='width:100%' class='fborder'>";
         $text .= "<tr style='vertical-align:top'><td class='".$agenda->getPrefHeaderCSS()."'>".AGENDA_LAN_MSG_02."</td></tr>";
         while ($agn_erow = $agn_sql1->db_Fetch()) {
            $text .= "<tr style='vertical-align:top'><td class='".$agenda->getPrefDayCSS()."'><dl>";
            $fields = extract($agn_erow, EXTR_OVERWRITE);
            $text .= "<dt>$typ_name</dt><dd>$typ_description</dd></dl></td></tr>";
         }
         $text .= "</table></div>";
         break;
      }
      default : { // view
         // Set filter before we display anything
         agendaSetFilterSQL();
         require_once(e_PLUGIN."agenda/agendaView".$agenda->getP2().".php");
      }
   }

   if ($agn_error) {
      agendaSetFilterSQL();
      require_once(e_PLUGIN."agenda/agendaView".$agenda->getP2().".php");
   }

   $ns->tablerender($pagetitle, $text);

   require_once(FOOTERF);

   exit;

function generateJS() {
   global $agenda;

   $script = $GLOBALS['agenda']->getDiaryCodesJS();
   $script .= "
   );
   function agendaChangeDate() {
      if (document.getElementById('f-calendar-field-1') == '') {
         alert('".AGENDA_LAN_27."');
         return;
      }
      document.location = agendaGetNewURL('view', document.getElementById('agenda_view').value, '', document.getElementById('f-calendar-field-1').value, '');
   }
   function agendaGetNewURL(p1, p2, p3, p4, p5) {
      var query = ''+document.location;
      if ((query.indexOf('?') > 0 ) && (query.indexOf('agenda.php') > 0)) {
         var parts = query.substring(query.indexOf('?')+1).split('.');
         p2 = agendaGetURLParamValue(p2, parts[1]);
         p3 = agendaGetURLParamValue(p3, parts[2]);
         p4 = agendaGetURLParamValue(p4, parts[3]);
         p5 = agendaGetURLParamValue(p5, parts[4]);
      } else {
         p2 = agendaGetURLParamValue(p2, 0);
         p3 = agendaGetURLParamValue(p3, 0);
         p4 = agendaGetURLParamValue(p4, ".$agenda->getDateDS().");
         p5 = agendaGetURLParamValue(p5, 0);
      }
      return 'agenda.php?'+p1+'.'+p2+'.'+p3+'.'+p4+'.'+p5;
   }
   // -->
   </script>";

   return $script;
}

?>