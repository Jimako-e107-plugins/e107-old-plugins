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
| $Source: e:\_repository\e107_plugins/agenda/agenda_subs_menu.php,v $
| $Revision: 1.11 $
| $Date: 2006/11/29 01:17:02 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
if ($pref['agenda_allow_subscriptions'] == "Y") {
   require(e_PLUGIN."agenda/agenda_variables.php");

   if (file_exists(e_PLUGIN."agenda/languages/".e_LANGUAGE.".php")) {
      require_once(e_PLUGIN."agenda/languages/".e_LANGUAGE.".php");
   } else {
      require_once(e_PLUGIN."agenda/languages/English.php");
   }

   //// Reset everything for testing
   //// $agn_sql1->db_Update($agenda->getCategoryTable(), "cat_last=0, cat_today=0 where cat_id>0");
   //// print mysql_error();

   // Check to see if we need to send out emails for future entries
   $qry[1] = "
         select * from ".MPREFIX."agenda as a
         left join ".MPREFIX."agenda_category as c on a.agn_category=c.cat_id
         where c.cat_subs > 0
         and c.cat_last < ".$agenda->getTodayDS()."
         and c.cat_ahead > 0
         and a.agn_start >= ".$agenda->getTodayDS()."+(".$agenda->getOneDay()."*c.cat_ahead)
         and a.agn_start < ".$agenda->getTodayDS()."+(".$agenda->getOneDay()."*(c.cat_ahead+1))
         and find_in_set(c.cat_notify,'1,3')";
   // Check to see if we need to send out emails for todays entries
   $qry[2] = "
         select * from ".MPREFIX."agenda as a
         left join ".MPREFIX."agenda_category as c on a.agn_category=c.cat_id
         where c.cat_subs > 0
         and c.cat_today < ".$agenda->getTodayDS()."
         and a.agn_start >= ".$agenda->getTodayDS()."
         and a.agn_start < ".$agenda->getTodayDS()."+".$agenda->getOneDay()."
         and find_in_set(c.cat_notify,'2,3')";

   $agn_entry = array();
   for ($i=1; $i<3; $i++) {
      if ($agn_sql1->db_Select_gen($qry[$i], $agenda->isDebug())) {
         require_once(e_HANDLER . "mail.php");

         //print "<br>-----------$i";

         // Get all entries for notification
         unset($agn_entry);
         while ($agn_arow = $agn_sql1->db_Fetch()) {
            $agn_entry[] = $agn_arow;

            // Update category to show we have processed it today
            $field = $i==1 ? "cat_last" : "cat_today";
            $agn_sql2->db_Update($agenda->getCategoryTable(), "$field=".time()." where cat_id=".$agn_arow['cat_id'], $agenda->isDebug());
         }

         // Get all users for notification
         for ($j=0; $j<count($agn_entry); $j++) {
            //print "<br>title=".$agn_entry[$j]['agn_title'];
            if ($agn_entry[$j]['cat_subs'] == 1) {
               // Subscribed to - only send to subscribed users
               if ($agn_sql1->db_Select_gen("select * from ".MPREFIX."user left join ".MPREFIX.$agenda->getSubsTable()." on user_id=subs_userid where subs_cat='".$agn_entry[$j]["cat_id"]."'", $agenda->isDebug())) {
                  while ($agn_urow = $agn_sql1->db_Fetch()) {
                     // Ensure we don't send private entries to non-owners
                     $tmp = substr($agn_entry[$j]["agn_author"], 0, strpos($agn_entry[$j]["agn_author"], "."));
                     if ($agn_entry[$j]["agn_private"] == 0 || ($agn_entry[$j]["agn_private"] == 1 && $tmp == $agn_urow["user_id"])) {
                        $agn_entry[$j]["user_email"][] = $agn_urow["user_email"];
                        //print " s..".$agn_urow["user_email"]."<br>";
                     }
                  }
               }
            } else {
               // Force notification, send to all users in user class
               $usr_class = $agn_entry[$j]["cat_class"];
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
                     $tmp = substr($agn_entry[$j]["agn_author"], 0, strpos($agn_entry[$j]["agn_author"], "."));
                     if ($agn_entry[$j]["agn_private"] == 0 || ($agn_entry[$j]["agn_private"] == 1 && $tmp == $agn_urow["user_id"])) {
                        $agn_entry[$j]["user_email"][] = $agn_urow["user_email"];
                        //print " f..".$agn_urow["user_email"]."<br>";
                     }
                  }
               }
            }
         }

         for ($j=0; $j<count($agn_entry); $j++) {
            $msg = $agn_entry[$j]['cat_msg'.$i]."\n";
            if ($typ_timed) {
               $msg .= age_GetEMailLine(AGENDA_LAN_FIELD_03_0, getFormattedDate($agn_entry[$j]['agn_start'], true, true));
            } else {
               $msg .= age_GetEMailLine(AGENDA_LAN_FIELD_01_0, getFormattedDate($agn_entry[$j]['agn_start'], true, false));
            }
            if ($typ_timed) {
               $msg .= age_GetEMailLine(AGENDA_LAN_FIELD_04_0, getFormattedDate($agn_entry[$j]['agn_end'], true, true));
            } else {
               $msg .= age_GetEMailLine(AGENDA_LAN_FIELD_02_0, getFormattedDate($agn_entry[$j]['agn_end'], true, false));
            }
            $msg .= age_GetEMailLine(AGENDA_LAN_FIELD_06_0, $agn_entry[$j]['agn_location']);
            $msg .= age_GetEMailLine(AGENDA_LAN_FIELD_14_0, $agn_entry[$j]['agn_diary_code']);
            if ($agn_entry[$j]['agn_priority'] > 0) {
               $msg .= age_GetEMailLine(AGENDA_LAN_FIELD_08_0, $agn_entry[$j]['agn_priority']);
            }
            $tmp = explode(".", $agn_entry[$j]['agn_owner']);
            if (ereg("[0-9]+", $tmp[0])) {
               $tmp = $tmp[1];
            } else {
               $tmp = $agn_entry[$j]['agn_owner'];
            }
            $msg .= age_GetEMailLine(AGENDA_LAN_FIELD_09_0, $tmp);
            $msg .= age_GetEMailLine(AGENDA_LAN_FIELD_11_0, $agn_entry[$j]['agn_contact_email']);
            //$msg .= age_GetEMailLine(AGENDA_LAN_FIELD_12_0, $agn_entry[$j]['agn_private'] ? "Private" : "Public");
            //$msg .= age_GetEMailLine(AGENDA_LAN_FIELD_13_0, $agn_entry[$j]['agn_complete'] ? "Complete" : "Incomplete");
            $msg .= age_GetEMailLine($pref["agenda_custom_field_1_name"], $agn_entry[$j]['agn_data1']);
            $msg .= age_GetEMailLine($pref["agenda_custom_field_2_name"], $agn_entry[$j]['agn_data2']);
            $msg .= age_GetEMailLine($pref["agenda_custom_field_3_name"], $agn_entry[$j]['agn_data3']);
            $msg .= age_GetEMailLine($pref["agenda_custom_field_4_name"], $agn_entry[$j]['agn_data4']);
            $msg .= age_GetEMailLine(AGENDA_LAN_FIELD_07_0, "\n".$agn_entry[$j]['agn_details']);
            sendemail($pref['siteadminemail'],
                      $pref['agenda_subs_subject_prefix'].$agn_entry[$j]['agn_title'],
                      $msg,
                      $pref['siteadmin'],
                      $pref['agenda_subs_from_email'],
                      $pref['agenda_subs_from_name'],
                      "",                                         // attachments
                      "",                                         // CC
                      implode(",", $agn_entry[$j]['user_email']),
                      $pref['siteadminemail'],                    // return path
                      ""                                          // return receipt
                      );
            if ($agenda->isDebug()) {
               print "<br>Sending Subscription E-Mail<br>";
               print "To: ".$pref['siteadminemail']."<br>";
               print "Subject: ".$pref['agenda_subs_subject_prefix'].$agn_entry[$j]['agn_title']."<br>";
               print "Message: $msg<br>";
               print "To: ".$pref['siteadmin']."<br>";
               print "From: ".$pref['agenda_subs_from_email']."<br>";
               print "From: ".$pref['agenda_subs_from_name']."<br>";
               print "BCC: ".implode(",", $agn_entry[$j]['user_email'])."<br>";
               print "Return path: ".$pref['siteadminemail']."<br>";
               print "--------------------------------<br>";
            }
         }
      }
   }

   //// Only agenda users can subscribe to agenda entries
   //if (check_class($pref['agenda_view_pages'])) {
   //   require(e_PLUGIN."agenda/agenda_variables.php");
   //   $qry = "select count(*) from ".MPREFIX.$agenda->getSubsTable()." as s
   //         left join ".MPREFIX.$agenda->getCategoryTable()." as c on s.subs_cat = c.cat_id
   //         where s.subs_userid=".USERID."
   //         and (c.cat_subs=1 or c.cat_subs=3)
   //         ";
   //
   //   $agn_sql1->db_Select_gen($qry, $agenda->isDebug());
   //   $optsubs = $agn_sql1->db_Fetch();
   //   $qry = "select count(*) from ".MPREFIX.$agenda->getCategoryTable()."
   //         where find_in_set(cat_class,'".$e107Helper->getUserClassList()."')
   //         and (cat_subs=2 or cat_subs=4)
   //         ";
   //
   //   $autosubs = $agn_sql1->db_Select_gen($qry, $agenda->isDebug());
   //   $autosubs = $agn_sql1->db_Fetch();
   //
   //   $rs = new agenda_form;
   //   $text = "<div style='text-align:center'>";
   //   $text .= "<div class=''>";
   //   $text .= AGENDA_LAN_112." $optsubs[0] ".AGENDA_LAN_113." $autosubs[0] ".AGENDA_LAN_118;
   //   $text .= "</div><br />";
   //   $text .= "<div>";
   //   $text .= "<input type='button' class='button' name='agenda_subs_go' value='".AGENDA_LAN_111."' onclick='agendaShowSubs(event);' />";
   //   $text .= "</div>";
   //   $text .= "</div>";
   //
   //   $ns->tablerender($pref["agenda_subs_menu_title"], $text);
   //}
}

function age_GetEMailLine($label, $text) {
   //print "age_GetEMailLine($label, $text)<br>";
   if (strlen($label) > 0 && strlen($text) > 0) {
      return "\n$label: $text";
   }
   return "";
}
?>
