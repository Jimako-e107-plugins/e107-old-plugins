<?php
   ob_start();
   require_once("../../class2.php");
   require(e_PLUGIN."agenda/agenda_variables.php");
   require(e_PLUGIN."agenda/agendaUtils.php");
   //$e107HelperIncludeJS = false;
   //require_once("e107Helper.php");

   class agendaAjax {
      var $_currentTypeName;

      function agendaAjax() {
         extract($_REQUEST);
         switch ($action) {
            case "addEntryForm" : {
               $this->addEntryForm($type);
               break;
            }
            case "addEntry" : {
               $this->addEntry($type, $messageid);
               break;
            }
            case "setUserFilterOptions" : {
               if (isset($types)) {
                  $this->setUserFilterOptions($types, $categories, $owners, $completed);
               }
               break;
            }
            case "setUserFilterState" : {
               if (isset($filter)) {
                  $this->setUserFilterState($filter);
               }
               break;
            }
            case "setUserRegistration" : {
               if (isset($id) && isset($answer)) {
                  $this->setUserRegistration($id, $answer);
               }
               break;
            }
            case "unsetUserRegistration" : {
               if (isset($id)) {
                  $this->unsetUserRegistration($id, $userid);
               }
               break;
            }
            case "setSubscriptions" : {
               if (isset($subs)) {
                  $this->setSubscriptions($subs);
               }
               break;
            }
            case "agendaEMail" : {
               if (isset($id) && isset($emailTo)) {
                  $this->sendEmail($id, $emailTo, $emailSubject, $emailMessage);
               }
               break;
            }
            default : {
               // Do nothing
            }
         }
      }

      function printXML($text) {
         if (!isset($_REQUEST["debug"])) {
            ob_end_clean();
            header('Content-type: text/xml');
         }
         print $text;
         exit;
      }

      function addEntry($type, $messageid) {
         global $agenda, $agendaFields;

         $allfields = $this->getFieldsForType($type);

         $colstr  = array();
         $valstr  = array();
         $errtext = "";
         if (!$agendaFields->validateFormRows($allfields, $colstr, $valstr, $errtext)) {
            $this->addEntryForm($type, $errtext, $messageid);
            return;
         }

         // Control and hidden from user fields
         //$colstr[] = "agn_type";
         //$valstr[] = "'$type'";
         //$colstr[] = "agn_author";
         //$valstr[] = "'".USERID.".".USERNAME."'";
         //$colstr[] = "agn_datestamp";
         //$valstr[] = "'".time()."'";
         $tmp['data']['agn_datestamp'] = $type;
         $tmp['data']['agn_type'] = $agenda->getP5();
				 $tmp['data']['agn_author'] = USERID.".".USERNAME;
				  
					
         $qry = "(".implode(", ", $colstr).") values (".implode(", ", $valstr).")";

         $text = "<e107helperajax>";

         $text .= "<response type='killmessage' id='$messageid'>";
         $text .= "</response>";

         $text .= "<response type='restorebody'>";
         $text .= "</response>";

         $text .= "<response type='timedmessage' msecs='3000'><![CDATA[";
         $mysql = new e107HelperDB();
         //$res = $mysql->db_InsertPart($agenda->getAgendaTable(), $tmp, $agenda->isDebug());
         $res 	= $mysql->insert($agenda->getAgendaTable(), $tmp, $agenda->isDebug());
         $text .= $res ? AGENDA_LAN_MSG_00 : AGENDA_LAN_MSG_01."(".mysqli_error().")";
         $text .= "]]></response>";

         $text .= "</e107helperajax>";

         $this->printXML($text);
      }

      function addEntryForm($type, $message="", $messageid="") {
         global $agenda, $agendaFields;

         $text = "<e107helperajax>";
         if (strlen($messageid) > 0) {
            $text .= "<response type='killmessage' id='$messageid'>";
            $text .= "</response>";
         }
         $text .= "<response type='dialog' id='agenda_quick_add'><![CDATA[";
         if ($allfields = $this->getFieldsForType($type)) {
            $text .= "<table style='border:6px groove;' class=''>";
            $text .= "<tr style='vertical-align:top'><td colspan='2' style='text-align:center' class='forumheader'>".AGENDA_LAN_39." ".$this->_currentTypeName."</td></tr>";
            if (strlen($message) >0) {
               $text .= "<tr style='vertical-align:top'><td colspan='2' style='text-align:center' class='forumheader2'>$message</td></tr>";
            }
            $text .= "<tr><td>".$agendaFields->getFormRows($allfields)."</td></tr>";
            $text .= "<tr style='vertical-align:top'><td colspan='2' style='text-align:center' class='".$agenda->getPrefDayCSS()."'>";
            $text .= "<input type='hidden' id='agenda_addentry_type' value='$type'/>";
            $text .= "<button onclick='agendaHelper.addEntry();return false;'>".AGENDA_LAN_49."</button>&nbsp;";
            $text .= "<button onclick='e107Helper.killDialog(\"agenda_quick_add\");return false;'>".AGENDA_LAN_155."</button>";
            $text .= "</td></tr></table></form>";
         } else {
            $text .= AGENDA_LAN_MSG_05." (".$type.")";
         }

         $text .= "]]></response></e107helperajax>";
         $this->printXML($text);
      }

      function setUserFilterOptions($types, $categories, $owners, $completed) {
         global $agenda;
         $sql = new db();
         $qry = "";
         $update = $sql->select($agenda->getUserTable(), "usr_id", " WHERE usr_id=".USERID, true, $agenda->isDebug());
         if (strlen($types)) {
            $qry[]  = "51:$types";
         }
         if (strlen($categories)) {
            $qry[]  = "52:$categories";
         }
         if (strlen($owners)) {
            $qry[]  = "53:$owners";
         }
         if (strlen($completed)) {
            $qry[]  = "54:$completed";
         }
         $qry = implode(";", $qry);

         if ($update) {
            $qry  = "usr_filter='$qry' WHERE usr_id=".USERID;
            $res = $sql->db_Update($agenda->getUserTable(), $qry, $agenda->isDebug());
         } else {
            $qry = USERID.", 0, '$sql', ''";
            $res = $sql->db_Insert($agenda->getUserTable(), $qry, $agenda->isDebug());
         }
         $text = "<e107helperajax>";
         if ($res === false) {
            $text .= "<response type='alert'>";
            $text .= "Failure: $qry, ".mysqli_error();
         } else {
            $text .= "<response type='timedmessage'>";
            $text .= AGENDA_LAN_138;
         }
         $text .= "</response>";
         $text .= "</e107helperajax>";
         $this->printXML($text);
      }

      function setUserFilterState($filter) {
         global $agenda;
         $sql = new db();
         $qry = "";
         $update = $sql->select($agenda->getUserTable(), "usr_id", " WHERE usr_id=".USERID, true, $agenda->isDebug());
         if ($update) {
            $qry  = "usr_filter_state='$filter'";
            $res = $sql->db_Update($agenda->getUserTable(), $qry, $agenda->isDebug());
         } else {
            $qry .= USERID.", '$filter', ''";
            $res = $sql->db_Insert($agenda->getUserTable(), $qry, $agenda->isDebug());
         }
      }

      function setUserRegistration($id, $answer) {
         global $agenda;
         $sql = new e107HelperDB();

         $sql->select($agenda->getAgendaTable(), "agn_responses", " WHERE agn_id=$id", true);
         if ($row = $sql->db_Fetch()) {
            $agn_responses = array();
            if (strlen($row["agn_responses"])) {
               $agn_responses = explode(",", $row["agn_responses"]);
            }
            $found = false;
            for ($i=0; $i<count($agn_responses); $i++) {
               $temp = explode("=", $agn_responses[$i]);
               if ($temp[0] == USERID) {
                  $agn_responses[$i] = USERID."=$answer";
                  $found = true;
                  break;
               }
            }
            if (!$found) {
               if (strlen($row["agn_responses"])) {
                  array_push($agn_responses, USERID."=$answer");
               } else {
                  $agn_responses[0] = USERID."=$answer";
               }
            }

            $this->updateRegistration($id, $agn_responses);
         } else {
            // Invalid ID?
         }
      }

      function unsetUserRegistration($id, $userid="") {
         global $agenda;
         $sql = new e107HelperDB();

         if ($userid=="") {
            $userid = USERID;
         }
         $sql->select($agenda->getAgendaTable(), "agn_responses", " WHERE agn_id=$id", true);
         if ($row = $sql->db_Fetch()) {
            $agn_responses = array();
            if (strlen($row["agn_responses"])) {
               $agn_responses = explode(",", $row["agn_responses"]);
            }
            $found = false;
            $new_responses = array();
            for ($i=0; $i<count($agn_responses); $i++) {
               $temp = explode("=", $agn_responses[$i]);
               //print $temp[0] ."..". $userid . "<br>";
               if ($temp[0] != $userid) {
                  $new_responses[] = $agn_responses[$i];
                  $found = true;
               }
            }

            $this->updateRegistration($id, $new_responses);
         } else {
            // Invalid ID?
         }
      }

      function updateRegistration($id, $responses) {
         global $agenda;
         $sql = new e107HelperDB();
         $sql->db_Update($agenda->getAgendaTable(), "agn_responses='".implode(",", $responses)."' where agn_id=$id", true, $agenda->isDebug());
         $text = "<e107helperajax>";
         $text .= "<response type='innerhtml' id='agenda_reg_answers'><![CDATA[";
         $text .= $agenda->getRegistrationUserResponses($id);
         $text .= "]]></response>";
         $text .= "</e107helperajax>";
         $this->printXML($text);
      }

      function sendEmail($id, $emailTo, $subject="", $emailMessage="") {
         global $agenda;
         $sql = new e107HelperDB();
         if ($sql->select($agenda->getAgendaTable(), "*", " WHERE agn_id=$id", true)) {
            $row = $sql->db_Fetch();
            extract($row);
            $agn_responses = strlen($agn_responses) > 0 ? explode(",", $agn_responses) : array();
            if ($emailTo=="allreg") {
               $pattern = "/^[\d]*$/";
            } else {
               $pattern = "/^$emailTo$/";
            }

            $msg = $emailMessage."\n";
            if ($typ_timed) {
               $msg .= agajax_GetEMailLine(AGENDA_LAN_FIELD_03_0, getFormattedDate($agn_start, true, true));
            } else {
               $msg .= agajax_GetEMailLine(AGENDA_LAN_FIELD_01_0, getFormattedDate($agn_start, true, false));
            }
            if ($typ_timed) {
               $msg .= agajax_GetEMailLine(AGENDA_LAN_FIELD_04_0, getFormattedDate($agn_end, true, true));
            } else {
               $msg .= agajax_GetEMailLine(AGENDA_LAN_FIELD_02_0, getFormattedDate($agn_end, true, false));
            }
            $msg .= agajax_GetEMailLine(AGENDA_LAN_FIELD_06_0, $agn_location);
            if ($agn_entry[$j]['agn_priority'] > 0) {
               $msg .= agajax_GetEMailLine(AGENDA_LAN_FIELD_08_0, $agn_priority);
            }
            $msg .= agajax_GetEMailLine(AGENDA_LAN_FIELD_07_0, "\n".$agn_details);

            require_once(e_HANDLER."mail.php");
            $ok = 0;
            $bad = 0;
            $res = "response count=".count($agn_responses)." [".implode(",",$agn_responses)."] ";
            for ($i=0; $i<count($agn_responses); $i++) {
               $split = explode("=", $agn_responses[$i]);
               if (preg_match($pattern, $split[1])) {
                  $user = get_user_data($split[0]);
      		      if (sendemail($user["user_email"], strlen($subject) ? $subject : $agn_title, $msg)) {
      		         $ok++;
      		         $res .= "id=".$split[0]." ".$user["user_email"]." ok, ";
      		      } else {
      		         $bad++;
      		         $res .= "id=".$split[0]." ".$user["user_email"]." failed, ";
      		      }
               }
            }

            $text = "<e107helperajax>";
            $text .= "<response type='alert'><![CDATA[";
            $text .= AGENDA_LAN_164." - ".AGENDA_LAN_165.":".$ok.", ".AGENDA_LAN_166.":".$bad." ($res)";
            $text .= "]]></response>";
            $text .= "</e107helperajax>";
            $this->printXML($text);
         }
      }

      function setSubscriptions($subs) {
         global $agenda;
         $sql = new e107HelperDB();
         $cats = $_POST['event_list'];
         $subs = explode(",", $subs);
         $sql->db_Delete($agenda->getSubsTable(), "subs_userid='".USERID."'");
         foreach ($subs as $sub) {
            if ($sub != 0) {
               $sql->db_Insert($agenda->getSubsTable(), "0, '".USERID."', '$sub'");
            }
         }
         $text = "<e107helperajax>";
         $text .= "<response type='timedmessage'><![CDATA[";
         $text .= AGENDA_LAN_137;
         $text .= "]]></response>";
         $text .= "</e107helperajax>";
         $this->printXML($text);
      }

      function getFieldsForType($type, $messageid="") {
         global $agenda, $agn_required_fields, $agn_required_fields_timed;
         $mysql = new e107HelperDB();
         if ($mysql->select($agenda->getTypeTable(), "typ_name, typ_fields, typ_timed", " WHERE typ_id=$type", true, $agenda->isDebug())
         && $row = $mysql->db_Fetch()) {
            extract($row, EXTR_OVERWRITE);
            $this->_currentTypeName = $typ_name;
            return array_merge($agn_required_fields, $agn_required_fields_timed[$typ_timed], array_filter(explode(",", $typ_fields), "agendaRemoveBlank"));
         } else {
            $text = "<e107helperajax>";
            if (strlen($messageid) > 0) {
               $text .= "<response type='killmessage' id='$messageid'>";
               $text .= "</response>";
            }
            //$text .= "<response type='restorebody'>";
            $text .= "<response type='killdialog' id='agenda_quick_add'>";
            $text .= "</response>";
            $text .= "<response type='timedmessage' msecs='3000'><![CDATA[";
            $text .= "Failed (".mysqli_error().")";
            $text .= "]]></response>";
            $text .= "</e107helperajax>";
            $this->printXML($text);
         }
      }
   }

   $agenda_ajax = new agendaAjax();
   exit;

function agajax_GetEMailLine($label, $text) {
   //print "agajax_GetEMailLine($label, $text)<br>";
   if (strlen($label) > 0 && strlen($text) > 0) {
      return "\n$label: $text";
   }
   return "";
}
?>