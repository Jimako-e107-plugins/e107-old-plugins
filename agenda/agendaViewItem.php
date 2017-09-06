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
| $Source: e:\_repository\e107_plugins/agenda/agendaViewItem.php,v $
| $Revision: 1.26 $
| $Date: 2006/11/29 01:17:01 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   $text .= "<div style='width:100%'>";
   $tmp = $agenda->getDayName($agenda->getDateDS(), true);
   $tmp .= "&nbsp;".date("j", $agenda->getDateDS());
   $tmp .= "&nbsp;".$agenda->getMonthName($agenda->getDateDS(), true);
   $tmp .= "&nbsp;".date("Y", $agenda->getDateDS());

   $qry = $agenda->getTableJoin()."where e.agn_id=".$agenda->getP3();

   if ($agn_sql1->db_Select_gen($qry, $agenda->isDebug()) && $agn_erow = $agn_sql1->db_Fetch()) {
      extract($agn_erow, EXTR_OVERWRITE);

      $agn_fulltitle = $agn_title;
      if (strlen($cat_icon) > 0) {
         $agn_fulltitle = "<img src='$cat_icon' border='0' align='middle' alt='*'/>&nbsp;".$agn_title;
      }

      if (strlen($cat_name) > 0) {
         $agn_fulltitle .= " ($cat_name)";
      }

      $text .= agendaDrawNavigation("", "", $agn_fulltitle);
      $text .= "<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0' summary='*'>";

      if ($agn_private == 1 && !ADMIN && $agn_author != USERID) {
         $text .= "<tr><td class='forumheader3'>".AGENDA_LAN_96."</td></tr>";
      } else {
         // Fields that are always displayed depending on whether the entry type is timed or not
         for ($i=0; $i<count($agn_required_fields_timed[$typ_timed]); $i++) {
            $rs = new agenda_form;
            $field = $agn_field[$agn_required_fields_timed[$typ_timed][$i]];
            if ($typ_timed) {
               $text .= age_DrawField($field["capt"], getFormattedDate($$field["name"], true, true));
            } else {
               $text .= age_DrawField($field["capt"], getFormattedDate($$field["name"], true, false));
            }
         }

         // Optional fields defined for the type
         $fields = array_filter(explode(",", $typ_fields), "agendaRemoveBlank");
         for ($i=0; $i<count($fields); $i++) {
            switch ($agn_field[$fields[$i]]['name']) {
               case "agn_start" : {
                  if ($typ_timed) {
                     $text .= age_DrawField(AGENDA_LAN_FIELD_03_0, getFormattedDate($agn_start, true, true));
                  } else {
                     $text .= age_DrawField(AGENDA_LAN_FIELD_01_0, getFormattedDate($agn_start, true, false));
                  }
                  break;
               }
               case "agn_end" : {
                  if ($typ_timed) {
                     $text .= age_DrawField(AGENDA_LAN_FIELD_04_0, getFormattedDate($agn_end, true, true));
                  } else {
                     $text .= age_DrawField(AGENDA_LAN_FIELD_02_0, getFormattedDate($agn_end, true, false));
                  }
                  break;
               }
               case "agn_location" : {
                  if (strlen($agn_location) && $pref["agenda_link_to_google_maps"] == "Y") {
                     $agn_location = $agn_location." <a href='http://maps.google.com/?q=".urlencode($agn_location)."' target='new'>[Google map]</a>";
                  }
                  $text .= age_DrawField(AGENDA_LAN_FIELD_06_0, $agn_location);

                  break;
               }
               case "agn_diary_code" : {
                  $text .= age_DrawField(AGENDA_LAN_FIELD_14_0, $agenda->getDiaryCodeDescription($agn_diary_code));
                  break;
               }
               case "agn_details" : {
                  $text .= age_DrawField(AGENDA_LAN_FIELD_07_0, $e107Helper->tp_toHTML($agn_details, true));
                  break;
               }
               case "agn_priority" : {
                  $text .= age_DrawField(AGENDA_LAN_FIELD_08_0, $agn_priority);
                  break;
               }
               case "agn_owner" : {
                  $tmp = explode(".", $agn_owner);
                  if (ereg("[0-9]+", $tmp[0])) {
                     $tmp = "<a href='".e_BASE."user.php?id.".$tmp[0]."'>".$tmp[1]."</a>";
                  } else {
                     $tmp = $agn_owner;
                  }
                  $text .= age_DrawField(AGENDA_LAN_FIELD_09_0, $tmp);
                  break;
               }
               case "agn_contact_email" : {
                  if (strlen($agn_contact_email) > 0) {
                     $text .= age_DrawField(AGENDA_LAN_FIELD_11_0, $e107Helper->tp_toHTML($agn_contact_email));
                  }
                  break;
               }
               case "agn_forum_thread" : {
                  if (strlen($agn_forum_thread) > 0) {
                     $agn_link_url = $agn_forum_thread;
                  	if (!strstr($agn_link_url, "http:")) {
		                  $agn_link_url = e_BASE.$agn_link_url;
   	   	            $agn_new = $pref["agenda_locallink_in_new_window"] == "Y" ? " target='_new'" : "";
		               } else {
		                  $agn_new = $pref["agenda_weblink_in_new_window"] == "Y" ? " target='_new'" : "";
		               }
                     $text .= age_DrawField(AGENDA_LAN_FIELD_15_0, "<a href='$agn_link_url'$agn_new>".AGENDA_LAN_91." '$agn_forum_thread'</a>");
                  }
                  break;
               }
               case "agn_private" : {
                  $text .= age_DrawField(AGENDA_LAN_FIELD_12_0, $agn_private ? "Private" : "Public");
                  break;
               }
               case "agn_complete" : {
                  $text .= age_DrawField(AGENDA_LAN_FIELD_13_0, $agn_complete ? "Complete" : "Incomplete");
                  break;
               }
               case "agn_question" : {
                  if ($agn_question > 0) {
                     $reg_answers = explode("\n", $reg_answers);
                     $field = "&nbsp;&nbsp;";
                     if (USER) {
                        if (($agn_end !=-1 && $agn_end > time()) || $agn_start >time()) {
                           switch ($reg_field_type) {
                              case 0: {
                                 for ($j=0; $j<count($reg_answers); $j++) {
                                    $checked = ($j==0) ? " checked='true'" : "";
                                    $field .= "<input type='radio' id='agenda_answer$j' name='agenda_answer' value='$j'$checked/>$reg_answers[$j]";
                                 }
                                 break;
                              }
                              case 1: {
                                 $field .= "<select size='1' id='agenda_answer' name='agenda_answer'>";
                                 for ($j=0; $j<count($reg_answers); $j++) {
                                    $selected = ($j==0) ? " selected" : "";
                                    $field .= "<option value='$j'$selected>$reg_answers[$j]</option>";
                                 }
                                 $field .= "</select>";
                                 break;
                              }
                           }
                           $button .= "&nbsp;&nbsp;<input class='button' type='button' value='".AGENDA_LAN_127."' onclick='agendaRegister();'/>";
                           $button .= "&nbsp;&nbsp;<input class='button' type='button' value='".AGENDA_LAN_136."' onclick='agendaDeregister();'/>";
                           if (ADMIN || check_class($typ_admin)) {
                              $button .= "&nbsp;&nbsp;<input class='button' type='button' value='".AGENDA_LAN_160."' onclick='expandit(\"email_table\")'/>";
                           }
                        } else {
                           // No registration for events that are in the past.
                           $buttons = "";
                        }
                     } else {
                        $button .= "<br />".AGENDA_LAN_129."";
                     }
                     $email = "";
                     if (ADMIN || check_class($typ_admin)) {
                        $email .= "<table id='email_table' class='forumheader smalltext' style='display:none;'>";
                        $email .= "<tr><td class=''>".AGENDA_LAN_163."</td><td class=''><select id='email_to' class='tbox'>";
                        $email .= "<option value='allreg'>".AGENDA_LAN_163_1."</option>";
                        //$email .= "<option value='allunreg'>".AGENDA_LAN_163_2."</option>";
                        for ($j=0; $j<count($reg_answers); $j++) {
                           $email .= "<option value='$j'>".AGENDA_LAN_163_3."$reg_answers[$j]</option>";
                        }
                        $email .= "</select></td></tr>";
                        $email .= "<tr><td class=''>".AGENDA_LAN_167."</td><td class=''><input class='tbox' type='text', id='email_subject' size='40' value='".$agn_title."'/></td></tr>";
                        $email .= "<tr><td class=''>".AGENDA_LAN_162."</td><td class=''><textarea class='tbox' id='email_message' cols='40' rows='5'></textarea></td></tr>";
                        $email .= "<tr><td class='' colspan='2'><input class='button' type='button' value='".AGENDA_LAN_161."' onclick='agendaEMail(".$agenda->getP3().");'/></td></tr>";
                        $email .= "</table></div>";
                     }

                     $regtext = "<div>$reg_question $field $button";
                     $regtext .= "<div id='agenda_reg_answers'>".$agenda->getRegistrationUserResponses($agenda->getP3(), true)."</div></div>";
                     $regtext .= "<div style='text-align:center;'>$email</div>";
                     $text .= age_DrawField(AGENDA_LAN_FIELD_16_0, $regtext);
                  }
                  break;
               }
               case "agn_data1" : {
                  if (strlen($pref["agenda_custom_field_1_name"])) {
                     $text .= age_DrawField($pref["agenda_custom_field_1_name"], $agn_data1);
                  }
                  break;
               }
               case "agn_data2" : {
                  if (strlen($pref["agenda_custom_field_2_name"])) {
                     $text .= age_DrawField($pref["agenda_custom_field_2_name"], $agn_data2);
                  }
                  break;
               }
               case "agn_data3" : {
                  if (strlen($pref["agenda_custom_field_3_name"])) {
                     $text .= age_DrawField($pref["agenda_custom_field_3_name"], $agn_data3);
                  }
                  break;
               }
               case "agn_data4" : {
                  if (strlen($pref["agenda_custom_field_4_name"])) {
                     $text .= age_DrawField($pref["agenda_custom_field_4_name"], $agn_data4);
                  }
                  break;
               }
               default : {
                  // A field we don't know how to handle
                  break;
               }
            }
         }
         // Other fields (not inputtable by user)
         if (ADMIN || check_class($typ_admin)){
            preg_match("/^([0-9]+).(.+)$/", $agn_author, $tmp);
            $tmp = "<a href='".e_BASE."user.php?id.".$tmp[1]."'>".$tmp[2]."</a>";
            $text .= age_DrawField(AGENDA_LAN_FIELD_17_0, $tmp);
         }

         $text .= "<tr><td colspan='2' class='forumheader2' style='text-align:right'>";
         $text .= "<input type='button' class='button' value='".AGENDA_LAN_98."' onclick='document.location=\"".e_SELF."?view.".$agenda->getP2().".".$agenda->getP3().".".$agenda->getDateDS()."\";'/>";
         //$text .= "<input class='button' type='button' value='print' onclick='document.location=\"".e_SELF."?print.".$agenda->getP2().".".$agenda->getP3().".".$agenda->getDateDS()."\";' />";
         if (ADMIN || check_class($typ_admin)){
            $text .= "&nbsp;&nbsp;<input class='button' type='button' value='".AGENDA_LAN_50."' onclick='document.location=\"".e_SELF."?edit.".$agenda->getP2().".".$agenda->getP3().".".$agenda->getDateDS()."\";'/>";
            $text .= "&nbsp;&nbsp;<input class='button' type='button' value='".AGENDA_LAN_37."' onclick='agendaConfirmDelete(\"".AGENDA_LAN_122."\", \"".e_SELF."?delete.".$agenda->getP2().".".$agenda->getP3().".".$agenda->getDateDS()."\");'/>";
            $text .= "&nbsp;&nbsp;<input class='button' type='button' value='".AGENDA_LAN_121."' onclick='document.location=\"".e_SELF."?changetype.".$agenda->getP2().".".$agenda->getP3().".".$agenda->getDateDS()."\";'/>";
         }
         $text .= "</td></tr>";

         if ($agenda->isDebug()) {
            $text .= "<tr><td colspan='2'><br><br><hr><center>Admin Debug info<center><hr></td></tr>";
            $text .= age_DrawField("id             ", "value from DB=".$agn_id            );
            $text .= age_DrawField("title          ", "value from DB=".$agn_title         );
            $text .= age_DrawField("category       ", "value from DB=".$agn_category      );
            $text .= age_DrawField("start          ", "value from DB=".$agn_start         );
            $text .= age_DrawField("end            ", "value from DB=".$agn_end           );
            $text .= age_DrawField("location       ", "value from DB=".$agn_location      );
            $text .= age_DrawField("details        ", "value from DB=".$agn_details       );
            $text .= age_DrawField("author         ", "value from DB=".$agn_author        );
            $text .= age_DrawField("owner          ", "value from DB=".$agn_owner         );
            $text .= age_DrawField("contact_email  ", "value from DB=".$agn_contact_email );
            $text .= age_DrawField("priority       ", "value from DB=".$agn_priority      );
            $text .= age_DrawField("forum thread   ", "value from DB=".$agn_forum_thread  );
            $text .= age_DrawField("data1          ", "value from DB=".$agn_data1         );
            $text .= age_DrawField("data2          ", "value from DB=".$agn_data2         );
            $text .= age_DrawField("data3          ", "value from DB=".$agn_data3         );
            $text .= age_DrawField("data4          ", "value from DB=".$agn_data4         );
            $text .= age_DrawField("datestamp      ", "value from DB=".$agn_datestamp     );
            $text .= age_DrawField("cat_id         ", "value from DB=".$cat_id            );
            $text .= age_DrawField("cat_name       ", "value from DB=".$cat_name          );
            $text .= age_DrawField("cat_description", "value from DB=".$cat_description   );
            $text .= age_DrawField("cat_icon       ", "value from DB=".$cat_icon          );
            $text .= age_DrawField("typ_id         ", "value from DB=".$typ_id            );
            $text .= age_DrawField("typ_name       ", "value from DB=".$typ_name          );
            $text .= age_DrawField("typ_description", "value from DB=".$typ_description   );
            $text .= age_DrawField("typ_timed      ", "value from DB=".$typ_timed         );
            $text .= age_DrawField("typ_fields     ", "value from DB=".$typ_fields        );
            $text .= age_DrawField("reg_question   ", "value from DB=".$reg_question      );
            $text .= age_DrawField("reg_field_type ", "value from DB=".$reg_field_type    );
            $text .= age_DrawField("reg_answers    ", "value from DB=".$reg_answers       );
         }
      }

      if ($pref["agenda_ratings"] == "Y") {
         $text .= "<tr><td style='text-align:right;' colspan='2'><br/>";
         $text .= $GLOBALS["e107Helper"]->getRating("agenda", $agenda->getP3());
         $text .= "</td></tr>";
      }

      if ($pref["agenda_comments"] == "Y") {
         $text .= "<tr><td colspan='2'><br/>";
         $text .= $GLOBALS["e107Helper"]->getComment("agenda", $agenda->getP3());
         $text .= "</td></tr>";
      }

      $text .= "</table></div>";
   } else {
      $text .= agendaDrawNavigation("", "", AGENDA_LAN_96);
      $text .= "<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0' summary='*'>";
      $text .= "<tr><td class='forumheader3'>Error: Item ".$agenda->getP3()." Not found</td></tr>";
      $text .= "</table></div>";
   }

function age_DrawField($left, $right) {
   if (strlen($right) > 0) {
      $text .= "<tr>";
      $text .= "<td class='forumheader3' style='width:15%;'>$left</td>";
      $text .= "<td class='forumheader2'>$right</td>";
      $text .= "</tr>";
   }
   return $text;
}
?>