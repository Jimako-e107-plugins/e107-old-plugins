<?php
/*
+---------------------------------------------------------------+
| ePlayer by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/eplayer/admin_media_common.php,v $
| $Revision: 1.20 $
| $Date: 2007/01/24 00:04:18 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   if (!getperms("P")) {
      header("location:".e_BASE."index.php");
   }
   require_once(e_ADMIN."auth.php");
   require_once(e_PLUGIN."eplayer/eplayer_variables.php");
   require_once(e_PLUGIN."eplayer/eplayer_utils.php");

   $debug = false;

   if ($pageid == "media_local") {
      $configtitle   = EPLAYER_LAN_ADMIN_00;
      $ep_existing_sql = " filename like '..%' and filename not like '%.jpg' and filename not like '%.jpeg' and filename not like '%.png' and filename not like '%.gif' order by title asc";
   } else if ($pageid == "media_remote") {
      $configtitle   = EPLAYER_LAN_ADMIN_03;
      $ep_existing_sql = " filename like '%://%' and filename not like '%.jpg' and filename not like '%.jpeg' and filename not like '%.png' and filename not like '%.gif' order by title asc";
   } else if ($pageid == "image_local") {
      $configtitle   = EPLAYER_LAN_ADMIN_04;
      $ep_existing_sql = " filename like '..%' and (filename like '%.jpg' or filename like '%.jpeg' or filename like '%.png' or filename like '%.gif' or filename like '%.bmp') order by title asc";
   } else {
      $configtitle   = EPLAYER_LAN_ADMIN_05;
      $ep_existing_sql = " filename like '%://%' and (filename like '%.jpg' or filename like '%.jpeg' or filename like '%.png' or filename like '%.gif' or filename like '%.bmp') order by title asc";
   }

   $eplayertable  = "eplayer";
   $categorytable = "eplayer_category";
   $primaryid     = "id";
   $e_wysiwyg     = "";
   $show_preset   = FALSE;

   $sql->db_Select($categorytable, "*", " order by cat_name asc", "");
   $categories = "";
   if (list($id, $name, $description, $icon) = $sql->db_Fetch()) {
      $categories .= "$id:$name";
      while (list($id, $name, $description, $icon) = $sql->db_Fetch()) {
         $categories .= ",$id:$name";
      }
   }

   if (strpos($pageid, "local") > 0) {
      if ($pageid == "media_local") {
         $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_03_0;
         $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_03_1;
         //$fieldvalu[] = eplayerGetFiles(e_xFILE, $pref["eplayer_media_dir"]);    
         $fieldvalu[] = eplayerGetFiles(e_MEDIA, $pref["eplayer_media_dir"]);  
      } else {
         $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_11_0;
         $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_11_1;
         //$fieldvalu[] = eplayerGetFiles(e_xFILE, $pref["eplayer_image_dir"]);;
         $fieldvalu[] = eplayerGetFiles(e_MEDIA, $pref["eplayer_image_dir"]);
      }
      $fieldname[] = "filename";
      $fieldtype[] = "dropdown2";
      $fieldmand[] = "*";
   } else {
      if ($pageid == "media_remote") {
         $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_10_0;
         $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_10_1;
      } else {
         $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_12_0;
         $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_12_1;
      }
      $fieldname[] = "filename";
      $fieldtype[] = "text";
      $fieldvalu[] = "http://,50,200";
      $fieldmand[] = "*";
   }

   $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_00_0;
   $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_00_1;
   $fieldname[] = "title";
   $fieldtype[] = "text";
   $fieldvalu[] = ",50,100";
   $fieldmand[] = "*";

   $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_02_0;
   $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_02_1;
   $fieldname[] = "category";
   $fieldtype[] = "dropdown2";
   $fieldvalu[] = $categories;
   $fieldmand[] = "*";

   $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_08_0;
   $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_08_1;
   $fieldname[] = "datestamp";
   $fieldtype[] = "datestamp";
   $fieldvalu[] = "2000";
   $fieldmand[] = "";

   $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_01_0;
   $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_01_1;
   $fieldname[] = "description";
   $fieldtype[] = "textarea";
   $fieldvalu[] = ",90%,100px";
   $fieldmand[] = "";

   $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_04_0;
   $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_04_1;
   $fieldname[] = "icon";
   $fieldtype[] = "image";
   $fieldvalu[] = e_IMAGE.$pref["eplayer_icon_dir"]."/";
   $fieldmand[] = "";

   if ($pageid == "media_local" || $pageid == "media_remote") {
      $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_05_0;
      $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_05_1;
      $fieldname[] = "width";
      $fieldtype[] = "text";
      $fieldvalu[] = $pref["eplayer_default_width"].",4,4";
      $fieldmand[] = "";

      $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_06_0;
      $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_06_1;
      $fieldname[] = "height";
      $fieldtype[] = "text";
      $fieldvalu[] = $pref["eplayer_default_height"].",4,4";
      $fieldmand[] = "";
   } else {
      $fieldcapt[] = "";
      $fieldnote[] = "";
      $fieldname[] = "width";
      $fieldtype[] = "hidden";
      $fieldvalu[] = "0";
      $fieldmand[] = "";

      $fieldcapt[] = "";
      $fieldnote[] = "";
      $fieldname[] = "height";
      $fieldtype[] = "hidden";
      $fieldvalu[] = "0";
      $fieldmand[] = "";
   }

   $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_09_0;
   $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_09_1;
   $fieldname[] = "author";
   $fieldtype[] = "text";
   $fieldvalu[] = USERNAME.",50,100";
   $fieldmand[] = "";

   $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_07_0;
   $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_07_1;
   $fieldname[] = "comment";
   $fieldtype[] = "checkbox";
   $fieldvalu[] = "1";
   $fieldmand[] = "";

   $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_15_0;
   $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_15_1;
   $fieldname[] = "approved";
   $fieldtype[] = "checkbox";
   $fieldvalu[] = "0";
   $fieldmand[] = "";

//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------

   // -------- Presets. ------------  // always load before auth.php
   if ($show_preset) {
      require_once(e_HANDLER."preset_class.php");
      $pst = new e_preset;
      $pst->form = "adminform"; // form id of the form that will have it's values saved.
      $pst->page = e_SELF; // display preset options on which page(s).
      $pst->id = "admin_".$eplayertable;
   }

   if ($categories=="") {
      $ns->tablerender($configtitle, EPLAYER_LAN_ADMIN_MEDIA_13);
      require_once(e_ADMIN."footer.php");
      return;
   }

   require_once(e_ADMIN."auth.php");
   require_once("form_handler.php");
   $rs = new oldform;

   // Page config checks
   $toapprove = isset($_POST['toapprove']) && !isset($_POST['showall']) ? true : false;
   // Validation checks
   if (isset($_POST['add']) || isset($_POST['update'])) {
      if (strlen($_POST['filename']) == 0) {
         $message .= "File name ".EPLAYER_LAN_ADMIN_MEDIA_12;
      }
      if (strlen($_POST['title']) == 0) {
         $message .= "Title ".EPLAYER_LAN_ADMIN_MEDIA_12;
      }
   }

   // Data is valid so try and add
   if (!isset($message) && isset($_POST['add'])) {
      if ($debug) print "<br>".print_r($_POST)."<br>";
      $count = count($fieldname);
      $colstr = array();
      $inpstr = array();
      for ($i=0; $i<$count; $i++) {
         if ($fieldname[$i] == "datestamp" && $pref["eplayer_use_exif"] == "1") {
            if (function_exists(exif_read_data)) {
               $exif = exif_read_data($rs->getfieldvalue($fieldname[0], $fieldtype[0], $debug), 0, true);
               if ($exif && isset($exif['EXIF']['DateTimeOriginal'])) {
                  $tmp = $exif['EXIF']['DateTimeOriginal'];
                  $inpstr[] = "'".mktime(substr($tmp,11,2), substr($tmp,14,2), substr($tmp,17,2), substr($tmp,5,2), substr($tmp,8,2), substr($tmp,0,4))."'";
               } else {
                  $inpstr[] = "'".$rs->getfieldvalue($fieldname[$i], $fieldtype[$i], $debug)."'";
               }
            } else {
               $inpstr[] = "'".$rs->getfieldvalue($fieldname[$i], $fieldtype[$i], $debug)."'";
            }
         } else {
            $inpstr[] = "'".$rs->getfieldvalue($fieldname[$i], $fieldtype[$i], $debug)."'";
         }
         $colstr[] = $fieldname[$i];
      }
      $colstr[]   = "timestamp";
      $inpstr[]   = "'".time()."'";
      $colstr[]   = "lastview";
      $inpstr[]   = "'0'";
      $colstr[]   = "viewcount";
      $inpstr[]   = "'0'";

      //$query = "INSERT INTO ".MPREFIX."{$eplayertable} (".implode(", ", $colstr).") values (".implode(", ", $inpstr).")";
      $query = "(".implode(", ", $colstr).") values (".implode(", ", $inpstr).")";

      $mysql = new e107HelperDB();
//      $temp = $sql->db_Select_gen($query, $debug);
      $temp = $mysql->db_InsertPart($eplayertable, $query);
      if (false !== $temp) {
         $message = EPLAYER_LAN_ADMIN_MEDIA_06;
         unset($_POST['add']);
      } else {
         $message = EPLAYER_LAN_ADMIN_MEDIA_07;
      }
   }

   // Data is valid so try and update
   if (!isset($message) && isset($_POST['update'])) {
      if ($debug) print "<br>".print_r($_POST)."<br>";
      $count = count($fieldname);
      for ($i=0; $i<$count; $i++) {
         if ($fieldname[$i] == "datestamp" && $pref["eplayer_use_exif"] == "1") {
            if (function_exists(exif_read_data)) {
               $exif = exif_read_data($rs->getfieldvalue($fieldname[0], $fieldtype[0], $debug), 0, true);
               if ($exif && isset($exif['EXIF']['DateTimeOriginal'])) {
                  $tmp = $exif['EXIF']['DateTimeOriginal'];
                  $inpstr .= $fieldname[$i]."='".mktime(substr($tmp,11,2), substr($tmp,14,2), substr($tmp,17,2), substr($tmp,5,2), substr($tmp,8,2), substr($tmp,0,4))."', ";
               } else {
                  $inpstr .= $fieldname[$i]."='".$rs->getfieldvalue($fieldname[$i], $fieldtype[$i], $debug)."', ";
               }
            } else {
               $inpstr .= $fieldname[$i]."='".$rs->getfieldvalue($fieldname[$i], $fieldtype[$i], $debug)."', ";
            }
         } else {
            $inpstr .= $fieldname[$i]."='".$rs->getfieldvalue($fieldname[$i], $fieldtype[$i], $debug)."', ";
         }
      }
      $query .= $inpstr."timestamp=".time();
      if ($sql->db_Update($eplayertable, "$query WHERE $primaryid='".$_POST[$primaryid]."'", $debug)) {
         $message = EPLAYER_LAN_ADMIN_MEDIA_04;
         unset($_POST['update']);
      } else {
         if ($debug) print "<br>".mysql_error()."<br>";
         $message = EPLAYER_LAN_ADMIN_MEDIA_05;
      }
   }

   // Get details from DB if Edit, otherwise set from POST data
   if (isset($_POST['edit'])) {
      $sql -> db_Select($eplayertable, "*", " $primaryid='".$_POST['existing']."' ");
      $row = $sql->db_Fetch();
   } else {
      if (isset($_POST['add']) || isset($_POST['update'])) {
         $row = $_POST;
      }
   }

   // Try the delete
   if (isset($_POST['delete'])) {
      if ($debug) print "<br>".print_r($_POST)."<br>";
      $message = ($sql -> db_Delete($eplayertable, "$primaryid='".$_POST['existing']."' ")) ? EPLAYER_LAN_ADMIN_MEDIA_08 : EPLAYER_LAN_ADMIN_MEDIA_09;
   }

   // Draw the form
   if (file_exists(e_PLUGIN."updatechecker/updatechecker.php")) {
      require_once(e_PLUGIN."updatechecker/updatechecker.php");
      $text .= updateChecker(EPLAYER_LAN_NAME, EPLAYER_LAN_VER, "http://www.bugrain.plus.com/e107plugins/eplayer.ver", "|");
   }

   $text .= "<div style='text-align:center'><form method='post' action='".e_SELF."' id='myexistingform'>
      <table style='width:96%;margin-left:auto;margin-right:auto;' class='fborder'>";

   if (isset($message)) {
      $text .= "<tr onclick='expandit(this);' style='cursor:pointer;'><td colspan='2' class='spacer' style='text-align:center'>$message";
      $text .= "</td></tr>";
      $text .= "<tr><td colspan='2'></td></tr>";
      $text .= "<tr style='display:none;'><td colspan='2' class='spacer' style='text-align:center;'>".mysql_error()."<br/>".$query;
      $text .= "</td></tr>";
      if ($debug) print "<br>".mysql_error()."<br>";
   }

   $text .= "<tr><td colspan='2' class='forumheader' style='text-align:center'>";

   if ($toapprove) {
      $ep_existing_sql = "approved<>'0' and $ep_existing_sql";
   }
   $table_total = $sql->db_Select($eplayertable, "id, filename, title, category, approved", $ep_existing_sql, true, $debug);
   if (!$table_total) {
      $text .= EPLAYER_LAN_ADMIN_MEDIA_10;
      if ($toapprove) {
         $text .= "<br/><input class='button' type='submit' name='showall' value='".EPLAYER_LAN_ADMIN_MEDIA_15."' />";
      }
   } else {
      $text .= "<span class='defaulttext'>".EPLAYER_LAN_ADMIN_MEDIA_00.":</span>&nbsp;<select name='existing' id='existing' class='tbox'>";
      while (list($id, $filename, $title, $category, $approved) = $sql-> db_Fetch()) {
         $sql2->db_Select($categorytable, "*", "cat_id=$category");
         list($catid, $catname, $rest) = $sql2->db_Fetch();
         $approved = ($approved==0 && $approved!="") ? "" : "* ";
         $text .= "<option value='$id'>$approved$title ($catname)</option>";
      }
      $text .= "</select><br/><input class='button' type='submit' name='edit' value='".EPLAYER_LAN_ADMIN_MEDIA_01."' />&nbsp;
      <input class='button' type='submit' name='delete' value='".EPLAYER_LAN_ADMIN_MEDIA_11."' />&nbsp;";
      if ($toapprove) {
         $text .= "<input class='button' type='submit' name='showall' value='".EPLAYER_LAN_ADMIN_MEDIA_15."' />";
         $text .= "<input type='hidden' name='toapprove' value='1' />";
      } else {
         $text .= "<input class='button' type='submit' name='toapprove' value='".EPLAYER_LAN_ADMIN_MEDIA_14."' />";
      }
      $text .= "&nbsp;<input class='button' type='button' onclick='window.open(\"admin_preview.php?\"+document.getElementById(\"existing\").value);' value='".EPLAYER_LAN_ADMIN_MEDIA_16."' />";
      $text .= "</td></tr>";
   }

   $text .= "</table></form></div>";

   $text .= "<div style='text-align:center'>\n";
   $text .= "<form method='post' action='".e_SELF."' id='adminform'><table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
   for ($i=0; $i<count($fieldcapt); $i++) {
      $form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
      if ($fieldtype[$i] != "hidden") {
         $text .="<tr>
            <td style='vertical-align:top' class='forumheader3'>".$fieldcapt[$i]." ".$fieldmand[$i]."<br><span class='smalltext'>".$fieldnote[$i]."</td>
            <td class='forumheader3'>";
      }
      $text .= $rs->user_extended_element_edit($form_send, $row[$fieldname[$i]], $fieldname[$i]);
      if ($fieldtype[$i] != "hidden") {
         $text .="</td></tr>";
      }
   };

   $text .= "<tr style='vertical-align:top'><td colspan='2' style='text-align:center' class='forumheader'>";

   if (isset($_POST['edit']) || isset($_POST['update'])){
      $text .= "<input class='button' type='submit' id='update' name='update' value='".EPLAYER_LAN_ADMIN_MEDIA_02."' />
      <input type='hidden' name='$primaryid' value='".$row[$primaryid]."'>";
   } else {
      $text .= "<input class='button' type='submit' id='add' name='add' value='".EPLAYER_LAN_ADMIN_MEDIA_03."' />";
   }

   if ($toapprove) {
      $text .= "<input type='hidden' name='toapprove' value='1' />";
   }
   $text .= "</td></tr></table></form></div>";
   $ns->tablerender($configtitle, $text);

   require_once(e_ADMIN."footer.php");
?>