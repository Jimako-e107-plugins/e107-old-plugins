<?php
/*
+---------------------------------------------------------------+
| Bugtracker3 by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/bugtracker3/admin_prefs_98.php,v $
| $Revision: 1.1.2.7 $
| $Date: 2006/12/09 19:03:22 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   global $bt3_errors, $sql, $sql2, $tp;
   $text = "";

   // Process the form, if submitted
   if (isset($_POST["bugtracker3_admin_prefs_98_form"]) && $_POST["bugtracker3_admin_prefs_98_form"] == "true") {
      $text = "<div class='forumheader'>";

      $bt3_errors=0;
      // Check for debug output requested
      $bt3_debug = false;
      if (isset($_POST["bugtracker3_import_debug"][0]) && $_POST["bugtracker3_import_debug"][0] == "1") {
         $bt3_debug = true;
      }

      // Empty BT3 DB if requested
      $bt3_tables = array(BUGC_APPS_TABLE,
                          BUGC_APP_VERSIONS_TABLE,
                          BUGC_BUGS_TABLE,
                          BUGC_DEVELOPER_COMMENTS_TABLE,
                          BUGC_CATEGORIES_TABLE,
                          BUGC_PRIORITIES_TABLE,
                          BUGC_RESOLUTIONS_TABLE,
                          BUGC_STATUSES_TABLE,
                          BUGC_RELATIONSHIPS_TABLE
                         );
      $text .= "<div class='forumheader2'>".BUG3_ADMIN_IMPORT_EMPTYING_DB."</div>";
      $text .= "<div class='forumheader3'>";
      foreach($bt3_tables as $bt3_table) {
         $text .= BUG3_ADMIN_IMPORT_EMPTYING." $bt3_table<br/>";
         if (false === $sql->db_Delete($bt3_table, "", $bt3_debug)) {
            $text .= getMySQLErrorInfo();
            $bt3_errors++;
         }
      }
      $text .= BUG3_ADMIN_IMPORT_EMPTYING." comments (bugtrack3)<br/>";
      if (false === $sql->db_Delete("comments", "comment_type='bugtrack3'", $bt3_debug)) {
         $text .= getMySQLErrorInfo();
         $bt3_errors++;
      }
      $text .= "</div>";

      // Get lists of all BT2 apps, categories, priorities and resolutions and bugs
      $bt3_app = array();
      $bt3_cat = array();
      $bt3_pri = array();
      $bt3_res = array();
      $bt3_sta = array();
      $bt3_bug = array();
      $bt3_rel = array();
      $text .= "<div class='forumheader2'>".BUG3_ADMIN_IMPORT_COLLECTING_INFO."</div>";
      $text .= "<div class='forumheader3'>";
      if (false !== $sql->db_Select("bugtrack2_apps", "*", "order by bugtrack2_apps_id asc", "no-where", $bt3_debug)) {
         while ($bt3_row = $sql->db_Fetch()) {
            $bt3_app[$bt3_row["bugtrack2_apps_id"]] = $bt3_row;
            $temp = explode(",", $bt3_row["bugtrack2_apps_category"]);
            $j=1;
            foreach($temp as $tmp) {
               $bt3_cat[$tmp]["name"] = $tmp;
               $bt3_cat[$tmp]["order"] = $j++;
            }
            $temp = explode(",", $bt3_row["bugtrack2_apps_priority_names"]);
            $temp2 = explode(",", $bt3_row["bugtrack2_apps_priority_colors"]);
            $i=0;
            $j=1;
            foreach($temp as $tmp) {
               $bt3_pri[$tmp]["name"] = $tmp;
               $bt3_pri[$tmp]["color"] = str_replace("#", "", $temp2[$i++]);
               $bt3_pri[$tmp]["order"] = $j++;
            }
            $temp = explode(",", $bt3_row["bugtrack2_apps_resolution"]);
            $j=1;
            foreach($temp as $tmp) {
               $bt3_res[$tmp]["name"] = $tmp;
               $bt3_res[$tmp]["order"] = $j++;
            }
            $temp = explode(",", $bt3_row["bugtrack2_apps_status"]);
            $j=1;
            foreach($temp as $tmp) {
               $bt3_sta[$tmp]["name"] = $tmp;
               $bt3_sta[$tmp]["order"] = $j++;
            }
         }
      }
      else {
         $text .= getMySQLErrorInfo();
         $bt3_errors++;
      }

      if (false !== $sql->db_Select("bugtrack2_bugs", "*", "order by bugtrack2_bugs_id asc", "no-where", $bt3_debug)) {
         while ($bt3_row = $sql->db_Fetch()) {
            $bt3_bug[$bt3_row["bugtrack2_bugs_id"]] = $bt3_row;
         }
      }
      else {
         $text .= getMySQLErrorInfo();
         $bt3_errors++;
      }

      if (false !== $sql->db_Select("bugtrack2_relationships", "*", "", "no-where", $bt3_debug)) {
         while ($bt3_row = $sql->db_Fetch()) {
            $bt3_rel[] = $bt3_row;
         }
      }
      else {
         $text .= getMySQLErrorInfo();
         $bt3_errors++;
      }

      $text .= count($bt3_app).BUG3_ADMIN_IMPORT_COLLECTING_APP."<br/>";
      $text .= count($bt3_cat).BUG3_ADMIN_IMPORT_COLLECTING_CAT."<br/>";
      $text .= count($bt3_pri).BUG3_ADMIN_IMPORT_COLLECTING_PRI."<br/>";
      $text .= count($bt3_res).BUG3_ADMIN_IMPORT_COLLECTING_RES."<br/>";
      $text .= count($bt3_sta).BUG3_ADMIN_IMPORT_COLLECTING_STA."<br/>";
      $text .= count($bt3_bug).BUG3_ADMIN_IMPORT_COLLECTING_BUG."<br/>";
      $text .= count($bt3_rel).BUG3_ADMIN_IMPORT_COLLECTING_REL."<br/>";
      $text .= "</div>";

      // Import in to BT3 DB
      $text .= "<div class='forumheader2'>".BUG3_ADMIN_IMPORT_IMPORTING."</div>";
      $text .= "<div class='forumheader3'>";

      // step 1 - import categories
      $bt3_count = 0;
      $text .= BUG3_ADMIN_IMPORT_IMPORTING_CAT."<br/>";
      $bt3_keys = array_keys($bt3_cat);
      foreach ($bt3_keys as $key) {
         $tmp = "0, '".$bt3_cat[$key]["name"]."', '', '".$bt3_cat[$key]["order"]."'";
         if ($id = $sql->db_Insert(BUGC_CATEGORIES_TABLE, $tmp, $bt3_debug)) {
            $bt3_cat[$key]["new_id"] = $id;
            $bt3_count++;
         } else {
            $text .= getMySQLErrorInfo();
         }
      }
      $text .= "...".BUG3_ADMIN_IMPORT_IMPORTED."$bt3_count<br/>";

      // step 2 - import priorities
      $bt3_count = 0;
      $text .= BUG3_ADMIN_IMPORT_IMPORTING_PRI."<br/>";
      $bt3_keys = array_keys($bt3_pri);
      foreach ($bt3_keys as $key) {
         $tmp = "0, '".$bt3_pri[$key]["name"]."', '', '".$bt3_pri[$key]["color"]."', '".$bt3_pri[$key]["order"]."'";
         if ($id = $sql->db_Insert(BUGC_PRIORITIES_TABLE, $tmp, $bt3_debug)) {
            $bt3_pri[$key]["new_id"] = $id;
            $bt3_count++;
         } else {
            $text .= getMySQLErrorInfo();
         }
      }
      $text .= "...".BUG3_ADMIN_IMPORT_IMPORTED."$bt3_count<br/>";

      // step 3 - import resolutions
      $bt3_count = 0;
      $text .= BUG3_ADMIN_IMPORT_IMPORTING_RES."<br/>";
      $bt3_keys = array_keys($bt3_res);
      foreach ($bt3_keys as $key) {
         $tmp = "0, '".$bt3_res[$key]["name"]."', '', '".$bt3_res[$key]["order"]."'";
         if ($id = $sql->db_Insert(BUGC_RESOLUTIONS_TABLE, $tmp, $bt3_debug)) {
            $bt3_res[$key]["new_id"] = $id;
            $bt3_count++;
         } else {
            $text .= getMySQLErrorInfo();
         }
      }
      $text .= "...".BUG3_ADMIN_IMPORT_IMPORTED."$bt3_count<br/>";

      // step 4 - import statuses
      $bt3_count = 0;
      $text .= BUG3_ADMIN_IMPORT_IMPORTING_STA."<br/>";
      $bt3_keys = array_keys($bt3_sta);
      foreach ($bt3_keys as $key) {
         $tmp = "0, '".$bt3_sta[$key]["name"]."', '', '".$bt3_sta[$key]["order"]."'";
         if ($id = $sql->db_Insert(BUGC_STATUSES_TABLE, $tmp, $bt3_debug)) {
            $bt3_sta[$key]["new_id"] = $id;
            $bt3_count++;
         } else {
            $text .= getMySQLErrorInfo();
         }
      }
      $text .= "...".BUG3_ADMIN_IMPORT_IMPORTED."$bt3_count<br/>";

      // step 5 - import applications
      //bugtrack2_apps_id int(10)                     = 1 id
      //bugtrack2_apps_name varchar(100)              = 2 name
      //bugtrack2_apps_description text               = 3 description
      //bugtrack2_apps_version varchar(50)            = n/a
      //bugtrack2_apps_visible tinyint(1)             = 4 visible
      //bugtrack2_apps_editclass tinyint(3)           = 5 editclass
      //bugtrack2_apps_userclass tinyint(3)           = 6 userclass
      //bugtrack2_apps_owner varchar(100)             = 7 owner
      //bugtrack2_apps_category varchar(200)          = 8 categories
      //bugtrack2_apps_priority_names varchar(200)    = 9 priorities
      //bugtrack2_apps_priority_colors varchar(200)   = n/a
      //bugtrack2_apps_priority_default tinyint(3)    = 10 priority_default
      //bugtrack2_apps_resolution varchar(200)        = 11 resolutions
      //bugtrack2_apps_resolution_default tinyint(3)  = 12 resolution_default
      //bugtrack2_apps_status varchar(200)            = 13 statuses
      //bugtrack2_apps_status_default tinyint(3)      = 14 statuses_default
      //bugtrack2_apps_template varchar(50)           = 15 template

      $bt3_count = 0;
      $text .= BUG3_ADMIN_IMPORT_IMPORTING_APP."<br/>";
      foreach ($bt3_app as $tmp) {

         $tmp_cat = explode(",", $tmp["bugtrack2_apps_category"]);
         $tmp_pri = explode(",", $tmp["bugtrack2_apps_priority_names"]);
         $tmp_res = explode(",", $tmp["bugtrack2_apps_resolution"]);
         $tmp_sta = explode(",", $tmp["bugtrack2_apps_status"]);

         $tmp["new_cat"] = array();
         foreach ($tmp_cat as $temp) {
            $tmp["new_cat"][] = $bt3_cat[$temp]["new_id"];
         }
         $tmp["new_cat"] = implode(",", $tmp["new_cat"]);

         $tmp["new_pri"] = array();
         foreach ($tmp_pri as $temp) {
            $tmp["new_pri"][] = $bt3_pri[$temp]["new_id"];
         }
         $tmp["new_pri"] = implode(",", $tmp["new_pri"]);

         $tmp["new_res"] = array();
         foreach ($tmp_res as $temp) {
            $tmp["new_res"][] = $bt3_res[$temp]["new_id"];
         }
         $tmp["new_res"] = implode(",", $tmp["new_res"]);

         $tmp["new_sta"] = array();
         foreach ($tmp_sta as $temp) {
            $tmp["new_sta"][] = $bt3_sta[$temp]["new_id"];
         }
         $tmp["new_sta"] = implode(",", $tmp["new_sta"]);

         $tmp["new_pri_def"] = $bt3_pri[$tmp_pri[$tmp["bugtrack2_apps_priority_default"]-1]]["new_id"];
         $tmp["new_res_def"] = $bt3_res[$tmp_res[$tmp["bugtrack2_apps_resolution_default"]]]["new_id"];
         $tmp["new_sta_def"] = $bt3_sta[$tmp_sta[$tmp["bugtrack2_apps_status_default"]]]["new_id"];

         // Fix some potentially bad values
         $tmp["new_pri_def"] = $tmp["new_pri_def"]!="" ? $tmp["new_pri_def"] : strtok($tmp["new_pri"], ",");
         $tmp["new_res_def"] = $tmp["new_res_def"]!="" ? $tmp["new_res_def"] : strtok($tmp["new_res"], ",");
         $tmp["new_sta_def"] = $tmp["new_sta_def"]!="" ? $tmp["new_sta_def"] : strtok($tmp["new_sta"], ",");
         $tmp["new_cat_def"] = strtok($tmp["new_cat"], ",");;
         $tmp["bugtrack2_apps_owner"] = $tmp["bugtrack2_apps_owner"]!="" ? $tmp["bugtrack2_apps_owner"] : 0;

         $temp = $tmp["bugtrack2_apps_id"].","
           ." '".$tmp["bugtrack2_apps_name"]."',"
           ." '',"
           ." '".$tmp["bugtrack2_apps_description"]."',"
           ." '0',"
           ." '0',"
           ." '".$tmp["bugtrack2_apps_visible"]."',"
           ." '0',"
           ." '".$tmp["bugtrack2_apps_editclass"]."',"
           ." '".$tmp["bugtrack2_apps_editclass"]."',"
           ." '".$tmp["bugtrack2_apps_userclass"]."',"
           ." '".strtok($tmp["bugtrack2_apps_owner"], ".")."',"
           ." '".$tmp["new_cat"]."',"
           ." '".$tmp["new_cat_def"]."',"
           ." '".$tmp["new_pri"]."',"
           ." '".$tmp["new_pri_def"]."',"
           ." '".$tmp["new_res"]."',"
           ." '".$tmp["new_res_def"]."',"
           ." '".$tmp["new_sta"]."',"
           ." '".$tmp["new_sta_def"]."',"
           ." 'default'";
         if ($id = $sql->db_Insert(BUGC_APPS_TABLE, $temp, $bt3_debug)) {
            $bt3_count++;
         } else {
            $text .= getMySQLErrorInfo();
         }
      }
      $text .= "...".BUG3_ADMIN_IMPORT_IMPORTED."$bt3_count<br/>";

      // step 6 - application versions
      $bt3_count = 0;
      $text .= BUG3_ADMIN_IMPORT_IMPORTING_APV."<br/>";
      foreach ($bt3_app as $tmp) {
         if (strlen($tmp["bugtrack2_apps_version"]) > 0) {
            $temp = "0,"
              ." '".$tmp["bugtrack2_apps_id"]."',"
              ." '".$tmp["bugtrack2_apps_version"]."',"
              ." ''";
            if (false !== $id = $sql->db_Insert(BUGC_APP_VERSIONS_TABLE, $temp, $bt3_debug)) {
               $bt3_app[$tmp["bugtrack2_apps_id"]]["version_id"] = $id;
               $bt3_count++;
            } else {
               $text .= "$res<i>".BUG3_ADMIN_IMPORT_ERROR." ".mysql_error()."</i><br/>";
               $bt3_errors++;
               if ($bt3_debug) {
                  $text .= " sql : $temp<br/>";
               }
            }
         }
      }
      $text .= "...".BUG3_ADMIN_IMPORT_IMPORTED."$bt3_count<br/>";

      // step 7 - import bugs
      //bugtrack2_bugs_id int(10)            = 1 id
      //bugtrack2_bugs_datestamp int(10)     = 2 timestamp
      //bugtrack2_bugs_poster varchar(100)   = 4 poster
      //bugtrack2_bugs_owner varchar(100)    = 5 owner
      //bugtrack2_bugs_visible tinyint(1)    = 6 deleted
      //bugtrack2_bugs_application int(10)   = 7 application_id
      //bugtrack2_bugs_category varchar(100) = 8 category
      //bugtrack2_bugs_summary varchar(200)  = 3 summary
      //bugtrack2_bugs_description text      = 9 description
      //bugtrack2_bugs_priority tinyint(3)   = 10 priority
      //bugtrack2_bugs_resolution tinyint(3) = 11 resolution
      //bugtrack2_bugs_status tinyint(3)     = 12 status
      //bugtrack2_bugs_comment text          = n/a (dev comment table)

      $bt3_count = 0;
      $text .= BUG3_ADMIN_IMPORT_IMPORTING_BUG."<br/>";
      foreach ($bt3_bug as $tmp) {
         // Fix/calculate some new values
         $tmp["new_deleted"] = $tmp["bugtrack2_bugs_visible"]=1 ? 0 : 1;
         $tmp_pri = explode(",", $bt3_app[$tmp["bugtrack2_bugs_application"]]["bugtrack2_apps_priority_names"]);
         $tmp_res = explode(",", $bt3_app[$tmp["bugtrack2_bugs_application"]]["bugtrack2_apps_resolution"]);
         $tmp_sta = explode(",", $bt3_app[$tmp["bugtrack2_bugs_application"]]["bugtrack2_apps_status"]);

         $tmp["new_pri"] = $bt3_pri[$tmp_pri[$tmp["bugtrack2_bugs_priority"]-1]]["new_id"];
         $tmp["new_res"] = $bt3_res[$tmp_res[$tmp["bugtrack2_bugs_resolution"]]]["new_id"];
         $tmp["new_sta"] = $bt3_sta[$tmp_sta[$tmp["bugtrack2_bugs_status"]]]["new_id"];

         // Fix some potentially bad values
         $tmp["bugtrack2_bugs_owner"] = $tmp["bugtrack2_bugs_owner"]!="" ? $tmp["bugtrack2_bugs_owner"] : 0;

         $temp = $tmp["bugtrack2_bugs_id"].","
           ." '".$tmp["bugtrack2_bugs_datestamp"]."',"
           ." '".time()."',"
           ." '".$tmp["bugtrack2_bugs_summary"]."',"
           ." '".strtok($tmp["bugtrack2_bugs_poster"], ".")."',"
           ." '".time()."',"
           ." '".strtok($tmp["bugtrack2_bugs_owner"], ".")."',"
           ." '".$tmp["new_deleted"]."',"
           ." '".$bt3_app[$tmp["bugtrack2_bugs_application"]]["bugtrack2_apps_id"]."',"
           ." '".$bt3_app[$tmp["bugtrack2_bugs_application"]]["version_id"]."',"
           ." '0',"
           ." '".$bt3_cat[$tmp["bugtrack2_bugs_category"]]["new_id"]."',"
           ." '".$tmp["bugtrack2_bugs_description"]."',"
           ." '".$tmp["new_pri"]."',"
           ." '".$tmp["new_res"]."',"
           ." '".$tmp["new_sta"]."'";
         if ($id = $sql->db_Insert(BUGC_BUGS_TABLE, $temp, $bt3_debug)) {
            $bt3_count++;
         } else {
            $text .= getMySQLErrorInfo();
         }
      }
      $text .= "...".BUG3_ADMIN_IMPORT_IMPORTED."$bt3_count<br/>";

      // step 8 - import relationships
      $bt3_count = 0;
      $text .= BUG3_ADMIN_IMPORT_IMPORTING_REL."<br/>";
      foreach ($bt3_rel as $tmp) {
         $temp = $bt3_bug[$tmp["bugtrack2_rels_primary_id"]]["bugtrack2_bugs_id"].","
           .$bt3_bug[$tmp["bugtrack2_rels_secondary_id"]]["bugtrack2_bugs_id"].","
           .$tmp["bugtrack2_rels_relationship"];
         if (false !== $sql->db_Insert(BUGC_RELATIONSHIPS_TABLE, $temp, $bt3_debug)) {
            $bt3_count++;
         } else {
            $text .= getMySQLErrorInfo();
         }
      }
      $text .= "...".BUG3_ADMIN_IMPORT_IMPORTED."$bt3_count<br/>";

      // step 9 - import developer comments
      $bt3_count = 0;
      $text .= BUG3_ADMIN_IMPORT_IMPORTING_DEV."<br/>";
      foreach ($bt3_bug as $tmp) {
         if (strlen($tmp["bugtrack2_bugs_comment"]) > 0) {
            $temp = "'".time()."',"
              ." '".$tmp["bugtrack2_bugs_id"]."',"
              ." '".strtok($tmp["bugtrack2_bugs_owner"], ".")."',"
              ." '".BUG3_ADMIN_IMPORT_DEVC_IMPORT.$tmp["bugtrack2_bugs_comment"]."'";
            if (false !== $sql->db_Insert(BUGC_DEVELOPER_COMMENTS_TABLE, $temp, $bt3_debug)) {
               $bt3_count++;
            } else {
               $text .= "$res<i>".BUG3_ADMIN_IMPORT_ERROR." ".mysql_error()."</i><br/>";
               $bt3_errors++;
               if ($bt3_debug) {
                  $text .= " sql : $temp<br/>";
               }
            }
         }
      }
      $text .= "...".BUG3_ADMIN_IMPORT_IMPORTED."$bt3_count<br/>";

      // step 10 - update old comment references
      if (isset($_POST["bugtracker3_convert_comments"][0]) && $_POST["bugtracker3_convert_comments"][0] == "1") {
         $bt3_count = 0;
         $bt3_comment_new_id = array();
         $text .= BUG3_ADMIN_IMPORT_COMMENTS_CONVERTING."<br/>";
         if ($sql->db_Select("comments", "*", "comment_type='bugtrack2' order by comment_id asc", true, $bt3_debug)) {
            while ($row = $sql->db_Fetch()) {
               $qry = array();
               if ($row["comment_pid"] != 0) {
                  $row["comment_pid"] = $bt3_comment_new_id[$row["comment_pid"]];
               }
               foreach ($row as $key => $value) {
                  if (!is_numeric($key)) {
                     if ($key == "comment_id") {
                        $qry[] = "0";
                     }
                     else if ($key == "comment_type") {
                        $qry[] = "'bugtrack3'";
                     } else {
                        $qry[] = "'".$tp->toDB($value)."'";
                     }
                  }
               }
               $qry = implode(",", $qry);
               if ($id = $sql2->db_Insert("comments", $qry, $bt3_debug)) {
                  $bt3_count++;
                  $bt3_comment_new_id[$row["comment_id"]] = $id;
               } else {
                  $text .= "$res<i>".BUG3_ADMIN_IMPORT_ERROR." ".mysql_error()."</i><br/>";
                  $bt3_errors++;
                  if ($bt3_debug) {
                     $text .= " sql : $temp<br/>";
                  }
               }
            }
         }
         $text .= "...".BUG3_ADMIN_IMPORT_COMMENTS_DONE."$bt3_count<br/>";
      }

      $text .= "</div>";

      // Merge applications?
      if (isset($_POST["bugtracker3_import_merge"][0]) && $_POST["bugtracker3_import_merge"][0] == "1") {
         $text .= "<div class='forumheader2'>".BUG3_ADMIN_IMPORT_MERGING."</div>";
         $text .= "<div class='forumheader3'>";
         // Get a list of all uniqe application names
         $bt3_appnames = array();
         if ($sql->db_Select(BUGC_APPS_TABLE, "distinct(bugtracker3_apps_name)", "order by bugtracker3_apps_name asc", "no-where", $bt3_debug)) {
            while ($bt3_row = $sql->db_Fetch()) {
               $bt3_appnames[] = $bt3_row["bugtracker3_apps_name"];
            }
         } else {
            $text .= getMySQLErrorInfo();
            $text .= "000";
         }
         if (count($bt3_appnames) > 0) {
            // Process each unique app name
            $sql3 = new db();
            foreach ($bt3_appnames as $appname) {
               //
               if ($res = $sql->db_Select(BUGC_APPS_TABLE, "*", "where bugtracker3_apps_name='$appname' order by bugtracker3_apps_id desc", "where", $bt3_debug)) {
                  if ($res > 1) {
                     // More than one app found with this name, find all bugs for 2nd and subsequent occurances
                     $text .= BUG3_ADMIN_IMPORT_MERGE_APP." $appname<br/>";
                     $bt3_count = 1;
                     $bt3_toapp = $sql->db_Fetch();
                     while ($bt3_fromapp = $sql->db_Fetch()) {
                        $bt3_count++;
                        // Merge app fields
                        $bt3_toapp["bugtracker3_apps_categories"] = $bt3_toapp["bugtracker3_apps_categories"].",".$bt3_fromapp["bugtracker3_apps_categories"];
                        $bt3_toapp["bugtracker3_apps_priorities"] = $bt3_toapp["bugtracker3_apps_priorities"].",".$bt3_fromapp["bugtracker3_apps_priorities"];
                        $bt3_toapp["bugtracker3_apps_resolutions"] = $bt3_toapp["bugtracker3_apps_resolutions"].",".$bt3_fromapp["bugtracker3_apps_resolutions"];
                        $bt3_toapp["bugtracker3_apps_statuses"] = $bt3_toapp["bugtracker3_apps_statuses"].",".$bt3_fromapp["bugtracker3_apps_statuses"];

                        // Merge bugs
                        if ($sql2->db_Select(BUGC_BUGS_TABLE, "*", "where bugtracker3_bugs_application_id=".$bt3_fromapp["bugtracker3_apps_id"], "where", $bt3_debug)) {
                           $bt3_count2 = 0;
                           while ($bt3_bug = $sql2->db_Fetch()) {
                              //$text .= "...".$bt3_bug["bugtracker3_bugs_summary"]."<br/>";
                              if (!$sql3->db_Update(BUGC_BUGS_TABLE, "bugtracker3_bugs_application_id=".$bt3_toapp["bugtracker3_apps_id"]." where bugtracker3_bugs_id=".$bt3_bug["bugtracker3_bugs_id"], $bt3_debug)) {
                                 $text .= getMySQLErrorInfo();
                              }
                              $bt3_count2++;
                           }
                        } else {
                           $text .= getMySQLErrorInfo();
                        }

                        // Update app version
                        if (false === $sql3->db_Update(BUGC_APP_VERSIONS_TABLE, "bugtracker3_appver_app_id=".$bt3_toapp["bugtracker3_apps_id"]." where bugtracker3_appver_app_id=".$bt3_fromapp["bugtracker3_apps_id"], $bt3_debug)) {
                           $text .= getMySQLErrorInfo();
                        }

                        // Delete merged from app
                        if (false === $sql3->db_Delete(BUGC_APPS_TABLE, "bugtracker3_apps_id=".$bt3_fromapp["bugtracker3_apps_id"], $bt3_debug)) {
                           $text .= getMySQLErrorInfo();
                        }

                     }

                     // Update app fields
                     $bt3_qry = "bugtracker3_apps_categories='".implode(",", array_unique(explode(",", $bt3_toapp["bugtracker3_apps_categories"])))."', ";
                     $bt3_qry .= "bugtracker3_apps_priorities='".implode(",", array_unique(explode(",", $bt3_toapp["bugtracker3_apps_priorities"])))."', ";
                     $bt3_qry .= "bugtracker3_apps_resolutions='".implode(",", array_unique(explode(",", $bt3_toapp["bugtracker3_apps_resolutions"])))."', ";
                     $bt3_qry .= "bugtracker3_apps_statuses='".implode(",", array_unique(explode(",", $bt3_toapp["bugtracker3_apps_statuses"])))."' ";
                     $bt3_qry .= "where bugtracker3_apps_id=".$bt3_toapp["bugtracker3_apps_id"];
                     if (false === $sql3->db_Update(BUGC_APPS_TABLE, $bt3_qry, $bt3_debug)) {
                        $text .= getMySQLErrorInfo();
                     }

                     $text .= "...".$bt3_count.BUG3_ADMIN_IMPORT_MERGE_NUM_APPS.", ".$bt3_count2.BUG3_ADMIN_IMPORT_MERGE_NUM_BUGS."<br/>";
                  }
               } else {
                  $text .= getMySQLErrorInfo();
               }
            }

         } else {
            $text .= "...".BUG3_ADMIN_IMPORT_MERGE_NOTHING."<br/>";
         }
         $text .= "</div>";
      }

      $text .= "<div class='forumheader2'>".BUG3_ADMIN_IMPORT_DONE."</div>";

      if ($bt3_errors == 0) {
         $text .= "<div class='forumheader3'>".BUG3_ADMIN_IMPORT_DONE_CHECK."</div>";
      } else {
         $text .= "<div class='forumheader3'>";
         $text .= "<img type='image' style='cursor:pointer' src='".e_IMAGE."fileinspector/warning.png'> ";
         $text .= $bt3_errors.BUG3_ADMIN_IMPORT_DONE_CHECK_ERRORS."</div>";
      }

      $text .= "</div>";
   }

   // Create a form using the helper classes
   $e107HelperForm->createFormFromXML("forms/prefs_".$pageid);
   $e107HelperForm->generateHTML(true, true);
   $text .= $e107HelperForm->getFormHTML();

function getMySQLErrorInfo() {
   global $bt3_debug, $bt3_errors;
   $text .= "<img type='image' style='cursor:pointer' src='".e_IMAGE."fileinspector/warning.png'> ";
   $text .= "<i>".BUG3_ADMIN_IMPORT_ERROR." ".mysql_error()."</i><br/>";
   $bt3_errors++;
   if ($bt3_debug) {
      $text .= " sql : $tmp<br/>";
   }
   return $text;
}
?>