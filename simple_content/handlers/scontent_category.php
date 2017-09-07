<?php
/*
+---------------------------------------------------------------+
| SimpleContent by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:/_repository/e107_plugins/simple_content/handlers/scontent_category.php,v $
| $Revision: 1.1 $
| $Date: 2008/05/26 23:14:53 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Simple Content Category
 */
class SimpleContentCategory {
   var $category; // A row from the simple content categories table

   /**
    * Constructor
    * @param $row a row from the categories table
    */
   function SimpleContentCategory($row) {
      $this->debug = false;
      $this->category = $row;
   }

   // Getters
   function getId() {
      return $this->category["scontent_cat_id"];
   }
   function getName() {
      return $this->category["scontent_cat_name"];
   }
   function getIcon() {
      return $this->category["scontent_cat_icon"];
   }
   function getDescription() {
      return $this->category["scontent_cat_description"];
   }
   function getGroupId() {
      return $this->category["scontent_cat_group_id"];
   }
   function getLabel($label) {
      return $this->category["scontent_cat_label_f".$label];
   }
}
?>