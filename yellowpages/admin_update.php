<?php
/*
+---------------------------------------------------------------+
| Yellow Pages by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/yellowpages/admin_update.php,v $
| $Revision: 1.1 $
| $Date: 2007/01/24 19:35:17 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   // class2.php is the heart of e107, always include it first to give access to e107 constants and variables
   require_once("../../class2.php");

   // Include auth.php rather than header.php ensures an admin user is logged in
   require_once(e_ADMIN."auth.php");

   // Include the variables file
   require_once(e_PLUGIN."yellowpages/yellowpagesVariables.php");

   // Check to see if the current user has admin permissions for this plugin
   if (!getperms("P")) {
      // No permissions set, redirect to site front page
      header("location:".e_BASE."index.php");
      exit;
   }

   $text = update_1_0_to_1_1();

   $caption = YELL_NAME;

   $ns->tablerender($caption, $text);
   require_once(e_ADMIN."footer.php");

function update_1_0_to_1_1() {
   $sql1 = new db;
   $sql2 = new db;

   $text = "<ul><strong>Upgrading Category icons</strong>";
   $sql1->db_Select(YELL_CATEGORY_TABLE, "yell_cat_id, yell_cat_name, yell_cat_icon", " order by yell_cat_name asc", "");
   while ($row = $sql1->db_Fetch()) {
      extract($row);
      if (strpos($yell_cat_icon, e_IMAGE) === 0) {
         $newicon = substr($yell_cat_icon, strlen(e_IMAGE));
         $res = $sql2->db_Update(YELL_CATEGORY_TABLE, "yell_cat_icon='$newicon' WHERE yell_cat_id=$yell_cat_id");
         if ($res) {
            $text .= "<li>Updated icon for '$yell_cat_name' from '$yell_cat_icon' to '$newicon'</li>";
         } else {
            $text .= "<li>*** Failed: Updated icon for '$yell_cat_name' from '$yell_cat_icon' to '$newicon'<br/>(".mysql_error().")</li>";
         }
      } else {
         $text .= "<li>Note: icon for '$yell_cat_name' ($yell_cat_icon) does not need updating</li>";
      }
   }
   $text .= "</ul>";

   $text .= "<ul><strong>Upgrading Entry icons</strong>";
   $sql1->db_Select(YELL_MAIN_TABLE, "yell_id, yell_name, yell_image", " order by yell_name asc", "");
   while ($row = $sql1->db_Fetch()) {
      extract($row);
      if (strpos($yell_image, e_FILE) === 0) {
         $newimage = substr($yell_image, strlen(e_FILE));
         $res = $sql2->db_Update(YELL_MAIN_TABLE, "yell_image='$newimage' WHERE yell_id=$yell_id");
         if ($res) {
            $text .= "<li>Updated icon for '$yell_name' from '$yell_image' to '$newimage'</li>";
         } else {
            $text .= "<li>*** Failed: Updated icon for '$yell_name' from '$yell_image' to '$newimage'<br/>(".mysql_error().")</li>";
         }
      } else {
         $text .= "<li>Note: icon for '$yell_name' ($yell_image) does not need updating</li>";
      }
   }
   $text .= "</ul>";

   return $text;
}
?>