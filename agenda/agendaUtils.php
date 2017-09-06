<?php
function getFormattedDate($ds, $fullText=false, $showTime=false) {
   global $agenda;
   $date = "";
   if ($showTime) {
      $date = date("H:i, ", $ds);
   }
   $date .= $agenda->getDayName($ds, $fullText);
   $date .= date(" d ", $ds);
   $date .= $agenda->getMonthName($ds, $fullText);
   $date .= date(" Y", $ds);
   return $date;
}

function agendaGetDayEntries($day_ds) {
   global $agenda, $agn_sql1;

   // Get timed entries for the day
   $qry = $agenda->getSQL($day_ds, 1);
   $qry .= "order by e.agn_start asc, e.agn_end asc, e.agn_priority asc";

   $agn_sql1->db_Select_gen($qry, $agenda->isDebug());
   $dayentries = array("","","","","","","","","","","","","","","","","","","","","","","","");

   while ($agn_erow = $agn_sql1->db_Fetch()) {
      $dayentries[date("G", $agn_erow["agn_start"])] .= "<div style='padding-bottom:3px;'>".agendaDrawEntryLink($agn_erow)."</div>";
      $entries = true;
   }

   return $dayentries;
}

function agendaSetFilterSQL() {
   global $agenda, $agn_sql1, $agn_field, $currentUser;
   if ($currentUser) {  // Only logged on users can use filter
      $agn_sql1->db_Select($agenda->getUserTable(), "*", " WHERE usr_id=".$currentUser["user_id"], true, $agenda->isDebug());
      if ($agn_urow = $agn_sql1->db_Fetch()) {
         extract($agn_urow, EXTR_OVERWRITE);
      } else {
         // No user preferences yet, nothing to do
         return;
      }
//      if ($usr_filter_state == 0) {
//         // Filter is turned off, nothing to do
//         return;
//      }

      $filter = explode(";", $usr_filter);
      $agenda->setFilter("");

      for ($i=0; $i<count($filter); $i++) {
         $qry = array();
         $tmp = explode(":", $filter[$i]);
         $fieldname = str_replace("usr_", "agn_", $agn_field[$tmp[0]]["name"]);
         $tmp = explode(",", $tmp[1]);
         for ($j=0; $j<count($tmp); $j++) {
            if (strlen($tmp[$j]) > 0) {
               $qry[] = "strtolower($".$fieldname.")!='".strtolower($tmp[$j])."'";
            }
         }
         if (count($qry) > 0) {
            //$agenda->setFilter($agenda->getFilter()." and (".implode(" and ", $qry).")");
            $agenda->setFilter($agenda->getFilter()." && (".implode(" && ", $qry).")");
         }
      }
      //print "<br>".$agenda->getFilter()."<br>";
   }
}

function agendaDrawEntryLink($agn_erow, $full=true, $withdate=false, $includeBreak=false) {
   global $agenda, $pref, $e107Helper;

   extract($agn_erow, EXTR_OVERWRITE);

   // Assume we will be showing this item
   $text = "<span";
   if ($agenda->isFiltered($agn_erow)) {
      $text .= " id='agenda_entry_$agn_id'";
      if ($agenda->isFilterOn()) {
         $text .= " style='display:none'";
      }
   }
   $text .= ">";
   $style = $agn_complete ? " style='text-decoration:line-through;'" : "";
   if ($pref["agenda_detailed_tooltips"] == "Y") {
      $tmp = "$cat_name: $agn_details";
      if (strlen($agn_location) > 0) {
         $tmp .= " ($agn_location)";
      }
      if (strlen($agn_owner) > 0) {
         $tmp .= " - $agn_owner";
      }
   } else {
      $tmp = $agn_details;
   }

   if (!$agenda->isPrint()) {
      $text .= "<a href='".e_SELF."?viewitem.".$agenda->getP2().".$agn_id.".$agenda->getDateDS()."'$style title='$tmp'>";
   }

   if ($withdate) {
      $text .= date("d-m-Y", $agn_start)." : "; // ."-".date("d-m-Y", $agn_end)." : ";
   }


   if ($full || $pref["agenda_icons_in_compact_views"] == "Y") {
      if (strlen($cat_icon) > 0) {
         $tmp = str_replace("../../".e_IMAGE, e_IMAGE_ABS, $cat_icon);
         $text .= "<img src='$tmp' alt='*' border='0' align='middle' /> ";
      }
   }

   $iconsize = getimagesize($tmp);
   if ($typ_timed && ($full || $pref["agenda_time_in_compact_views"] == "Y")) {
      $text .= agendaDrawStartEndTime($agn_start, $agn_end, $full);
      $text .= " ";
   }
   $title = $full || strlen($agn_title) <= $pref["agenda_short_title_length"] ? $agn_title : substr($agn_title, 0, $pref["agenda_short_title_length"])."...";
   $text .= $e107Helper->tp_toHTML($title);
   if ($agn_private == 1) {
      $text .= " <span class='smalltext'>(".AGENDA_LAN_156.")</span>";
   }
   if ($full && $agn_priority > 0) {
      $text .= " <span class='smalltext'>($agn_priority)</span>";
   }
   if ($full && strlen($agn_details) > 0) {
      $text .= "<br /><span class='smalltext' style='margin-left:".($iconsize[1]+6)."px;'>$agn_details</span>";
   }
   if ($full && strlen($agn_location) > 0) {
      $text .= "<br /><span class='smalltext' style='margin-left:".($iconsize[1]+6)."px;'>$agn_location</span>";
   }

   if (!$agenda->isPrint()) {
      $text .= "</a>";
   }

   $text .= "<br/></span>";
   return $text;
}

function agendaDrawStartEndTime($start, $end, $full=true) {
   global $agenda;
   if ($full && $end > 0) {
      if ($end > $start+$agenda->getOneDay()) {
         return date("H:i", $start)."-".date("H:i (d-M-Y)", $end); // TODO language
      } else {
         return date("H:i", $start)."-".date("H:i", $end);
      }
   } else {
      return date("H:i", $start);
   }
   return "&nbsp;";
}

function agendaDrawNavigation($next, $prev, $centertext) {
   global $pref, $agenda, $agn_sql1, $agn_navformcapt, $agn_navformname, $agn_navformtype, $agn_navformvalu, $agn_navformjs;

   if (isset($pref['agenda_nav_on_main']) && $pref['agenda_nav_on_main'] == "Y") {
      $agn_monthentries  = $agn_sql1->db_Count($agenda->getAgendaTable(), "(*)", "where agn_start>=".$agenda->getTodayMonthStartDS()." and agn_end<".$agenda->getTodayMonthEndDS());

      $defaultview = ($agenda->getP1() == "view") ? $agenda->getP2() : "0";
      $colspan = 0;

      $text = "<table style='width:100%;' class='fborder' cellspacing='0' cellpadding='0' summary='*'><tr>";
      $rs = new agenda_form;
      $text .= "<td class='forumheader3' style='text-align:center;'>".$agn_navformcapt[0];
      $text .= $rs->user_extended_element_edit($agn_navformname[0]."|".$agn_navformtype[0]."|".$agn_navformvalu[0], $agenda->getP2(), $agn_navformname[0], $agn_navformjs[0]);
      $text .= "</td>";
      $colspan++;
      $text .= "<td class='forumheader3' style='text-align:center;'>".$agn_navformcapt[1];
      $text .= $rs->user_extended_element_edit($agn_navformname[1]."|".$agn_navformtype[1]."|".$agn_navformvalu[1], $agenda->getDateTxt(), $agn_navformname[1], $agn_navformjs[1]);
      $text .= "&nbsp;";
      $text .= $rs->user_extended_element_edit($agn_navformname[2]."|".$agn_navformtype[2]."|".$agn_navformvalu[2], "", $agn_navformname[2], $agn_navformjs[2]);
      $text .= "</td>";
      $colspan++;

      if (check_class($pref['agenda_add_entry'])) {
         // Add entry type combo box
         $text .= "<td class='forumheader3' style='text-align:center;'>".$agn_navformcapt[3];
         $text .= $rs->user_extended_element_edit($agn_navformname[3]."|".$agn_navformtype[3]."|".$agn_navformvalu[3], "", $agn_navformname[3], $agn_navformjs[3]);
         $text .= "&nbsp;<a class='smalltext' href='".e_SELF."?typehelp.".$agenda->getP2().".".$agenda->getP3().".".$agenda->getDateDS()."'>???</a>";
         $text .= "</td>";
         $colspan++;
      }

      if (USERNAME != "USERNAME") {
         $text .= "<td class='forumheader3' style='text-align:center;'><label for='usr_filter_state'>".AGENDA_LAN_40;
         $checked = $agenda->isFilterOn() ? "checked='checked'" : "";
         $text .= "<input type='checkbox' name='usr_filter_state' id='usr_filter_state' onclick='agendaHelper.checkFilter()' value='1'$checked/>";
         $text .= "</label></td>";
         $colspan++;
      }

      if ($pref['agenda_month_links'] == "Y") {
         $text .= "</tr><tr>";
         $text .= "<td class='forumheader3' colspan='$colspan'><table width='100%' summary='*'><tr>";

         $tmp = array();
         for ($i=1; $i<13; $i++) {
            $tmp[$i] = e_SELF."?view.".$agenda->getP2().".".$agenda->getP3().".".mktime(0,0,0,$i,$agenda->getDateNum(),$agenda->getYearNum());
         }
         $text .= "<td width='9%' style='text-align:center;'><a class='smalltext' href='".$tmp[1]."'>". substr(AGENDA_LAN_08, 0, 3)."</a></td>";
         $text .= "<td width='9%' style='text-align:center;'><a class='smalltext' href='".$tmp[2]."'>". substr(AGENDA_LAN_09, 0, 3)."</a></td>";
         $text .= "<td width='8%' style='text-align:center;'><a class='smalltext' href='".$tmp[3]."'>". substr(AGENDA_LAN_10, 0, 3)."</a></td>";
         $text .= "<td width='8%' style='text-align:center;'><a class='smalltext' href='".$tmp[4]."'>". substr(AGENDA_LAN_11, 0, 3)."</a></td>";
         $text .= "<td width='8%' style='text-align:center;'><a class='smalltext' href='".$tmp[5]."'>". substr(AGENDA_LAN_12, 0, 3)."</a></td>";
         $text .= "<td width='8%' style='text-align:center;'><a class='smalltext' href='".$tmp[6]."'>". substr(AGENDA_LAN_13, 0, 3)."</a></td>";
         $text .= "<td width='8%' style='text-align:center;'><a class='smalltext' href='".$tmp[7]."'>". substr(AGENDA_LAN_14, 0, 3)."</a></td>";
         $text .= "<td width='8%' style='text-align:center;'><a class='smalltext' href='".$tmp[8]."'>". substr(AGENDA_LAN_15, 0, 3)."</a></td>";
         $text .= "<td width='8%' style='text-align:center;'><a class='smalltext' href='".$tmp[9]."'>". substr(AGENDA_LAN_16, 0, 3)."</a></td>";
         $text .= "<td width='8%' style='text-align:center;'><a class='smalltext' href='".$tmp[10]."'>". substr(AGENDA_LAN_17, 0, 3)."</a></td>";
         $text .= "<td width='9%' style='text-align:center;'><a class='smalltext' href='".$tmp[11]."'>". substr(AGENDA_LAN_18, 0, 3)."</a></td>";
         $text .= "<td width='9%' style='text-align:center;'><a class='smalltext' href='".$tmp[12]."'>". substr(AGENDA_LAN_19, 0, 3)."</a></td>";

         $text .= "</tr></table></td>";
      }
      $text .= "</tr></table><br />";
   }

   $text  .= "<table style='width:100%;' class='fborder' cellspacing='0' cellpadding='0' summary='*'><tr>";
   if (strlen($prev) > 0) {
      $text .= "<td width='15%' class='".$agenda->getPrefHeaderCSS()."' style='text-align:center'><a class='smalltext' href='agenda.php?view.".$agenda->getP2().".".$agenda->getP3().".$prev'>&lt;&nbsp;".AGENDA_LAN_36."</a></td>";
   }
   $text .= "<th class='".$agenda->getPrefHeaderCSS()."' style='text-align:center'>$centertext</th>";
   if (strlen($next) > 0) {
     $text .= "<td width='15%' class='".$agenda->getPrefHeaderCSS()."' style='text-align:center'><a class='smalltext' href='agenda.php?view.".$agenda->getP2().".".$agenda->getP3().".$next'>".AGENDA_LAN_35."&nbsp;&gt;</a></td>";
   }
   $text .= "</tr></table>";

   return $text;
}

function agendaDrawDate($date) {
   global $agenda;

   $text .= "<table style='width:100%;' class='fborder' cellspacing='0' cellpadding='0' summary='*'><tr>";
   $text .= "<th class='".$agenda->getPrefHeaderCSS()."' style='text-align:center'>$date</th>";
   $text .= "</tr></table>";

   return $text;
}

function agendaDrawFormRow($rs, $item, $value="") {
   // Set default values for certain fields
   $name = $item['name'];
   $form_send = $name."|".$item['type']."|".$item['valu'];
   $text .= "<tr><td class='forumheader3'>".$item['capt']."&nbsp".$item['mand']."<br><span class='smalltext'>".$item['note']."</span></td><td class='forumheader3'>";
   if ($value == "") {
      $value = $item['pres'];
   } else {
      // Convert certain field types
      switch ($item['type']) {
         case "calendar" : {
            if (!strpos($value, "-")) {
               $value = date("d-m-Y", $value);
            }
            break;
         }
         case "calendartime" : {
            if (!strpos($value, "-")) {
               $bits = split(",", $value);
               $value = date("d-m-Y,H.i", $value);
            }
            break;
         }
         default : {
            // Nothing
         }
      }
   }

   $text .= $rs->user_extended_element_edit($form_send, $value, $name);
   $text .= "</td></tr>";
   return $text;
}

function agendaEntryAdd() {
   global $agenda, $agn_sql1, $agn_field, $agn_required_fields, $agn_required_fields_timed;

   $agn_sql1->db_Select($agenda->getTypeTable(), "*", "typ_id=".$agenda->getP5(), true, $agenda->isDebug());
   if ($trow = $agn_sql1->db_Fetch()) {
      extract($trow, EXTR_OVERWRITE);
      $allfields = array_merge($agn_required_fields, $agn_required_fields_timed[$typ_timed], array_filter(explode(",", $typ_fields), "agendaRemoveBlank"));

      $text = agendaDrawNavigation("", "", AGENDA_LAN_39." $typ_name");
      $rs = new agenda_form;
      $text .= "<div style='text-align:center'><form method='post' action='".e_SELF."?save.".$agenda->getP2().".".$agenda->getP3().".".$agenda->getP4().".".$agenda->getP5()."'>";
      $text .= "<table style='width:100%' class='fborder' summary='*'>";

      // All fields for the type
      for ($i=0; $i<count($allfields); $i++) {
         $text .= agendaDrawFormRow($rs, $agn_field[$allfields[$i]], $_POST[$agn_field[$allfields[$i]]['name']]);
      }

      $text .= "<tr style='vertical-align:top'><td colspan='2' style='text-align:center' class='".$agenda->getPrefHeaderCSS()."'>";
      $checked = isset($_POST["multiadd"]) && $_POST["multiadd"] == "Y" ? "checked" : "";
      $text .= "<label for='multiadd'><input class='tbox' type='checkbox' name='multiadd' value='Y' $checked />".AGENDA_LAN_99."</label>";
      $text .= "</td></tr>";
      $text .= "<tr style='vertical-align:top'><td colspan='2' style='text-align:center' class='".$agenda->getPrefDayCSS()."'>";
      $text .= "<input class='button tbox' type='submit' name='add' value='".AGENDA_LAN_49."' />&nbsp;";
      $text .= "</td></tr></table></form></div>";
   } else {
      $text = AGENDA_LAN_MSG_05." (".$agenda->getP5().")";
   }
   return $text;
}

function agendaEntryEdit() {
   global $agenda, $agn_sql1, $agn_field, $agn_required_fields, $agn_required_fields_timed;

   // Get the entry we are editing
   $qry = $agenda->getTableJoin()."where e.agn_id=".$agenda->getP3();
   if ($agn_sql1->db_Select_gen($qry, $agenda->isDebug()) && $agn_erow = $agn_sql1->db_Fetch()) {
      extract($agn_erow, EXTR_OVERWRITE);
      if ($agn_private == 1 && !ADMIN && $agn_author != USERID) {
         $text = agendaDrawNavigation("", "", AGENDA_LAN_96);
      } else {
         $allfields = array_merge($agn_required_fields, $agn_required_fields_timed[$typ_timed], array_filter(explode(",", $typ_fields), "agendaRemoveBlank"));

         $text = agendaDrawNavigation("", "", AGENDA_LAN_33." $typ_name");
         $text .= "<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0' summary='*'>";

         $rs = new agenda_form;
         $text .= "<div style='text-align:center'><form method='post' action='".e_SELF."?save.".$agenda->getP2().".".$agenda->getP3().".".$agenda->getP4().".".$agenda->getP5()."'>";
         $text .= "<table style='width:100%' class='fborder' summary='*'>";

         // All fields for the type
         for ($i=0; $i<count($allfields); $i++) {
            $text .= agendaDrawFormRow($rs, $agn_field[$allfields[$i]], $agn_erow[$agn_field[$allfields[$i]]['name']]);
         }

         $text .= "<tr style='vertical-align:top'><td colspan='2' style='text-align:center' class='".$agenda->getPrefDayCSS()."'>";
         $text .= "<input class='button' type='submit' name='updatesettings' value='".AGENDA_LAN_50."' />";
         $text .= "<input type='hidden' name='id' value='$agn_id' />";
         $text .= "</td></tr></table></form></div>";
      }
   } else {
      $text = AGENDA_LAN_MSG_05." (".$agenda->getP3().")";
   }
   return $text;
}

function agendaEntryChangeType($msg="") {
   global $agenda, $agn_sql1, $agn_navformname, $agn_navformtype, $agn_navformvalu, $agn_navformname, $agn_id;

   // Get the entry we are editing
   $qry = $agenda->getTableJoin()."where e.agn_id=".$agenda->getP3();
   if ($agn_sql1->db_Select_gen($qry, $agenda->isDebug()) && $agn_erow = $agn_sql1->db_Fetch()) {
      extract($agn_erow, EXTR_OVERWRITE);

      if ($agn_private == 1 && !ADMIN && $agn_author != USERID) {
         $text = agendaDrawNavigation("", "", AGENDA_LAN_96);
      } else {
         $text = agendaDrawNavigation("", "", "Change type for $agn_title (currently $typ_name)");

         $rs = new agenda_form;
         $text .= "<div style='text-align:center'><form method='post' action='".e_SELF."?updatetype.".$agenda->getP2().".".$agenda->getP3().".".$agenda->getP4().".".$agenda->getP5()."'>";
         $text .= "<table style='width:100%' class='fborder' summary='*'>";

         if (strlen(msg) > 0) {
            $text .= "<tr style='vertical-align:top'><td colspan='2' style='text-align:center' class='".$agenda->getPrefDayCSS()."'>$msg</td></tr>";
         }

         $text .= "<tr><td class='forumheader3'>Select new type</td><td class='forumheader3'>";
         $text .= $rs->user_extended_element_edit($agn_navformname[3]."|".$agn_navformtype[3]."|".$agn_navformvalu[3], "", $agn_navformname[3], "");
         $text .= "</td></tr>";

         $text .= "<tr style='vertical-align:top'><td colspan='2' style='text-align:center' class='".$agenda->getPrefDayCSS()."'>";
         $text .= "<input class='button' type='submit' name='updatesettings' value='".AGENDA_LAN_50."' />";
         $text .= "<input type='hidden' name='id' value='$agn_id' />";
         $text .= "</td></tr></table></form></div>";
      }
   } else {
      $text = AGENDA_LAN_MSG_05." (".$agenda->getP3().")";
   }
   return $text;
}

function agendaEntryUpdateType() {
   global $agenda, $agn_sql1;

   if (!isset($_POST["agenda_add"]) || !is_numeric($_POST["agenda_add"])) {
      return agendaEntryChangeType(AGENDA_LAN_123);
   } else {
      if ($agn_sql1->db_Update($agenda->getAgendaTable(), "agn_type=".$_POST["agenda_add"]." where agn_id=".$agenda->getP3(), $agenda->isDebug())) {
         return agendaEntryEdit();
      } else {
         return agendaEntryChangeType(AGENDA_LAN_124);
      }
   }
}

function agendaRemoveBlank($var) {
   return (strlen($var));
}

function agendaSendEmail($type, $id) {
   global $agenda, $agn_sql1, $pref;

   // Check to see if we need to send out emails for future entries
   $qry = "select * from ".MPREFIX."agenda as a
         left join ".MPREFIX."agenda_category as c on a.agn_category=c.cat_id
         where a.agn_id = $id
         and (c.cat_subs = 3 or c.cat_subs = 4)";

   if ($agn_sql1->db_Select_gen($qry, $agenda->isDebug())) {
      require_once(e_HANDLER . "mail.php");

      // Get all entries for notification
      $agn_entry = $agn_sql1->db_Fetch();

      // Get all users for notification
      //print "<br>title=".$agn_entry['agn_title'];
      if ($agn_entry['cat_subs'] == 3) {
         // Notification
         if ($agn_sql1->db_Select_gen("select * from ".MPREFIX."user left join ".MPREFIX.$agenda->getSubsTable()." on user_id=subs_userid where subs_cat='".$agn_entry["cat_id"]."'", $agenda->isDebug())) {
            while ($agn_urow = $agn_sql1->db_Fetch()) {
               // Ensure we don't send private entries to non-owners
               $tmp = substr($agn_entry["agn_author"], 0, strpos($agn_entry["agn_author"], "."));
               if ($agn_entry["agn_private"] == 0 || ($agn_entry["agn_private"] == 1 && $tmp == $agn_urow["user_id"])) {
                  $agn_entry["user_email"][] = $agn_urow["user_email"];
                  //print " s..".$agn_urow["user_email"]."<br>";
               }
            }
         }
      } else {
         // Force notification, send to all users in user class
         $usr_class = $agn_entry["cat_class"];
         if ($usr_class == e_UC_ADMIN) {
            $tmp = "where user_admin='1'";
         } else if ($usr_class == e_UC_MEMBER) {
            $tmp = "";
         } else {
            $tmp = "where user_class='$usr_class' or user_class regexp '^$usr_class,' or user_class regexp ',$usr_class,' or user_class regexp ',$usr_class'";
         }
         if ($agn_sql1->db_Select_gen("select * from ".MPREFIX."user $tmp", $agenda->isDebug())) {
            while ($agn_urow = $agn_sql1->db_Fetch()) {
               // Ensure we don't send private entries to non-owners
               $tmp = substr($agn_entry["agn_author"], 0, strpos($agn_entry["agn_author"], "."));
               if ($agn_entry["agn_private"] == 0 || ($agn_entry["agn_private"] == 1 && $tmp == $agn_urow["user_id"])) {
                  $agn_entry["user_email"][] = $agn_urow["user_email"];
                  //print " f..".$agn_urow["user_email"]."<br>";
               }
            }
         }
      }

      if (count($agn_entry["user_email"]) > 0) {
         $msg = "The following entry has been ";
         switch ($type) {
            case "add"     : $msg .= "added to ";     break;
            case "update"  : $msg .= "amended on ";   break;
            case "delete"  : $msg .= "deleted from "; break;
         }
         $msg .= "the calendar at ".$pref["siteurl"].".\n";
         $msg .= agendaGetEMailLine(AGENDA_LAN_FIELD_00_0, $agn_entry['agn_title']);
         $msg .= agendaGetEMailLine(AGENDA_LAN_FIELD_05_0, $agn_entry['cat_name']);
         $msg .= $agn_entry['cat_msg'.$i]."\n";
         if ($typ_timed) {
            $msg .= agendaGetEMailLine(AGENDA_LAN_FIELD_03_0, getFormattedDate($agn_start, true, true));
         } else {
            $msg .= agendaGetEMailLine(AGENDA_LAN_FIELD_01_0, getFormattedDate($agn_start, true, false));
         }
         if ($typ_timed) {
            $msg .= agendaGetEMailLine(AGENDA_LAN_FIELD_04_0, getFormattedDate($agn_end, true, true));
         } else {
            $msg .= agendaGetEMailLine(AGENDA_LAN_FIELD_02_0, getFormattedDate($agn_end, true, false));
         }
         $msg .= agendaGetEMailLine(AGENDA_LAN_FIELD_06_0, $agn_entry['agn_location']);
         $msg .= agendaGetEMailLine(AGENDA_LAN_FIELD_14_0, $agn_entry['agn_diary_code']);
         if ($agn_entry['agn_priority'] > 0) {
            $msg .= agendaGetEMailLine(AGENDA_LAN_FIELD_08_0, $agn_entry['agn_priority']);
         }
         $tmp = explode(".", $agn_entry['agn_owner']);
         if (ereg("[0-9]+", $tmp[0])) {
            $tmp = $tmp[1];
         } else {
            $tmp = $agn_entry['agn_owner'];
         }
         $msg .= agendaGetEMailLine(AGENDA_LAN_FIELD_09_0, $tmp);
         $msg .= agendaGetEMailLine(AGENDA_LAN_FIELD_11_0, $agn_entry['agn_contact_email']);
         //$msg .= agendaGetEMailLine(AGENDA_LAN_FIELD_12_0, $agn_entry['agn_private'] ? "Private" : "Public");
         //$msg .= agendaGetEMailLine(AGENDA_LAN_FIELD_13_0, $agn_entry['agn_complete'] ? "Complete" : "Incomplete");
         $msg .= agendaGetEMailLine($pref["agenda_custom_field_1_name"], $agn_entry['agn_data1']);
         $msg .= agendaGetEMailLine($pref["agenda_custom_field_2_name"], $agn_entry['agn_data2']);
         $msg .= agendaGetEMailLine($pref["agenda_custom_field_3_name"], $agn_entry['agn_data3']);
         $msg .= agendaGetEMailLine($pref["agenda_custom_field_4_name"], $agn_entry['agn_data4']);
         $msg .= agendaGetEMailLine(AGENDA_LAN_FIELD_07_0, "\n".$agn_entry['agn_details']);
         sendemail($pref['siteadminemail'],
                   $pref['agenda_subs_subject_prefix'].$agn_entry['agn_title'],
                   $msg,
                   $pref['siteadmin'],
                   $pref['agenda_subs_from_email'],
                   $pref['agenda_subs_from_name'],
                   "",                                         // attachments
                   "",                                         // CC
                   implode(",", $agn_entry['user_email']),
                   $pref['siteadminemail'],                    // return path
                   ""                                          // return receipt
                   );
         if ($agenda->isDebug()) {
            print "<br>Sending Notification E-Mail<br>";
            print "To: ".$pref['siteadminemail']."<br>";
            print "Subject: ".$pref['agenda_subs_subject_prefix'].$agn_entry['agn_title']."<br>";
            print "Message: $msg<br>";
            print "To: ".$pref['siteadmin']."<br>";
            print "From: ".$pref['agenda_subs_from_email']."<br>";
            print "From: ".$pref['agenda_subs_from_name']."<br>";
            print "BCC: ".implode(",", $agn_entry['user_email'])."<br>";
            print "Return path: ".$pref['siteadminemail']."<br>";
            print "--------------------------------<br>";
         }
      }
   }
}

function agendaGetEMailLine($label, $text) {
   //print "agendaGetEMailLine($label, $text)<br>";
   if (strlen($label) > 0 && strlen($text) > 0) {
      return "\n$label: $text";
   }
   return "";
}

?>