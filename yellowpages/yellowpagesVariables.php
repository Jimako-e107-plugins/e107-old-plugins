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
| $Source: e:\_repository\e107_plugins/yellowpages/yellowpagesVariables.php,v $
| $Revision: 1.2.2.2 $
| $Date: 2007/02/07 00:24:50 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   // Constant values - shouldn't change during execution
   define("YELL_NAME",           "Yellow Pages");
   define("YELL_VER",            "2.0b1");
   define("YELL_MAIN_TABLE",     "yellowpages");
   define("YELL_CATEGORY_TABLE", "yellowpages_category");

   $yell_directory      = e_PLUGIN."yellowpages";
   $yell_main_page      = "$yell_directory/yellowpages.php";
   $yell_debug          = false;

   if (file_exists("$yell_directory/languages/".e_LANGUAGE.".php")) {
      require_once("$yell_directory/languages/".e_LANGUAGE.".php");
   } else {
      require_once("$yell_directory/languages/English.php");
   }

   // Include the e107 Helper classes
   if (file_exists(e_PLUGIN."e107helpers/e107Helper.php")) {
      require_once(e_PLUGIN."e107helpers/e107Helper.php");
   } else {
      print "Fatal error, cannot find e107Helper class";
   }

   $yell_sql1   = new db();
   $yell_sql2   = new db();
   $yell_sql3   = new db();

   $yell_categories = yellGetCategroies();
   $temp    = explode(".", e_QUERY);
   $yell_p1 = $temp[0];
   $yell_p2 = $temp[1];

function yellGetCategroies() {
   global $yell_sql1;

   $sql   = new db();
   $sql->db_Select(YELL_CATEGORY_TABLE, "yell_cat_id, yell_cat_name", " order by yell_cat_name asc", "");
   $yell_categories = array();
   while ($row = $sql->db_Fetch()) {
      $yell_categories[] = "$row[0]:$row[1]";
   }

   return $yell_categories;
}

function yell_cb_catSection($params) {
   extract($params);

   $sql = new e107HelperDB();
   $sql->db_Select(YELP_SECTIONS_TABLE, "yell_section_id, yell_section_name", " order by yell_section_name asc", "");
   $sections = array(array("0","Default"));
   while ($row = $sql->db_Fetch()) {
      $sections[] = array($row[0], $row[1]);
   }

   return $sections;
}

function yell_cb_parentCategory($params) {
   extract($params);

   $sql = new e107HelperDB();
   $sql->db_Select(YELP_CATEGORIES_TABLE, "yell_cat_id, yell_cat_name, yell_cat_parent_id", " order by yell_cat_name asc", "");
   $categories = array(array("0","None"));
   while ($row = $sql->db_Fetch()) {
      //// Only include categories that don't have a parent (i.e. omit subcategories) if requested
      //if ($all || $row[2] == 0) {
         $categories[] = array($row[0], $row[1]);
      //}
   }

   return $categories;
}
?>