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
| $Source: e:/_repository/e107_plugins/simple_content/handlers/scontent_item.php,v $
| $Revision: 1.1 $
| $Date: 2008/05/26 23:14:53 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Simple Content Items
 */
class SimpleContentItem {
   var $item;  // A row from the simple content items table
   var $cat;   // A row from the simple content categories table

   /**
    * Constructor
    * @param $row    a row from the items table
    * @param $catrow a row from the categories table
    */
   function SimpleContentItem($row, $catrow=false) {
      $this->debug = false;
      $this->item = $row;
   }

   // Getters
   function getId() {
      return $this->item["scontent_item_id"];
   }
   function getName() {
      return $this->item["scontent_item_name"];
   }
   function getDescription() {
      return $this->item["scontent_item_description"];
   }
   function getCategoryId() {
      return $this->item["scontent_item_cat_id"];
   }
   function getField($field) {
      return $this->item["scontent_item_f".$field];
   }

   function getCategory() {
      return $this->category;
   }
   function setCategory($cat) {
      $this->category = $cat;
   }
}
?>