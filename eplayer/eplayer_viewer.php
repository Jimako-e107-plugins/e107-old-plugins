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
| $Source: e:\_repository\e107_plugins/eplayer/eplayer_viewer.php,v $
| $Revision: 1.2 $
| $Date: 2007/01/23 23:48:25 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   require_once("../../class2.php");
   if (!check_class($pref['eplayer_view_class'])) {
      // No access for current user
      header("location:".e_BASE."index.php");
   }

   require_once(e_PLUGIN."eplayer/eplayer_variables.php");
   require_once(e_PLUGIN."eplayer/eplayer_utils.php");

   $eplayertable  = "eplayer";
   $categorytable = "eplayer_category";
   $sql3          = new db;
   $clipsPerPage  = $pref['eplayer_clips_per_page'];

   $footer_js[]   =  e_PLUGIN."eplayer/eplayer.js";

   if(!is_object($gen)){
      $gen = new convert;
   }

   $ep_text = "";
   $ep_text .= "<table class='fborder' width='100%'>";
   $ep_text .= "<tr>";
   $ep_text .= "<td class='forumheader2' style='text-align:center;'>";
   $ep_text .= "<select id='eplayer_selection' class='tbox' onchange='eplayer.viewer(this, \"eplayer_viewer\")'>";
   $ep_text .= "<option value=''>".EPLAYER_LAN_59."</option>";

   // Parent category
   $sql->db_Select($categorytable, "*", "cat_parent_category=0 order by cat_name asc", true);
   while ($ep_row = $sql->db_Fetch()) {
      extract($ep_row);
      if (check_class($cat_visibility) || $pref["eplayer_view_show_non_visible"]==1) {
         $parentid = $cat_id;
         // Items in the main parent
         $ep_text .= "<optgroup class='smallblacktext' label='$cat_name'>";
         if ($sql3->db_Select($eplayertable, "*", "category=$cat_id")) {
            while ($ep_row = $sql3->db_Fetch()) {
               extract($ep_row);
               $ep_text .= "<option value='$id'>$title</option>";
            }
         }
         // Sub-category of the parent
         if ($sql2->db_Select($categorytable, "*", "cat_parent_category=$parentid order by cat_name asc", true)) {
            while ($ep_row = $sql2->db_Fetch()) {
               extract($ep_row);
               // Items in the sub-category
               if ($sql3->db_Select($eplayertable, "*", "category=$cat_id")) {
                  $ep_text .= "<optgroup class='smallblacktext' label='&nbsp;&nbsp;&nbsp;$cat_name'>";
                  while ($ep_row = $sql3->db_Fetch()) {
                     extract($ep_row);
                     $ep_text .= "<option value='$id'>$title</option>";
                  }
                  $ep_text .= "</optgroup>";
               }
            }
         }
         $ep_text .= "</optgroup>";
      }
   }
   $ep_text .= "</select>";
   $ep_text .= "</td>";
   $ep_text .= "</tr>";
   $ep_text .= "<tr>";
   $ep_text .= "<td class='forumheader3' style='text-align:center;'>";
   $ep_text .= "<div id='eplayer_viewer'>".EPLAYER_LAN_58."</div>";
   $ep_text .= "</td>";
   $ep_text .= "</tr>";
   $ep_text .= "</table>";

   define("PAGE_NAME", $pref['eplayer_title']);
   require_once(HEADERF);
   $ns->tablerender($pref['eplayer_title'], $ep_text);
   require_once(FOOTERF);
   exit;

?>
