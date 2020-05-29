<?php
/*
+---------------------------------------------------------------+
| Yellowpages by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/yellowpages/handlers/yellowpages_category.php,v $
| $Revision: 1.1.2.1 $
| $Date: 2007/02/07 00:22:12 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for a Category
 */
class yelpCategory {
   var $category;    // A category row
   var $childcount;  // Number of child categories of this category
   var $children;    // Array of immediate children of this category
   var $itemcount;   // Number of entries belonging to this category
   var $items;       // Array of items belonging to this category

   /**
    * Constructor
    * @param $row a row from the yellowpages categories table
    */
   function yelpCategory($row) {
      $this->category = $row;
      $this->children = array();
      $this->childcount = 0;
      $this->itemcount = 0;
   }

   // Getters
   function getId() {
      return $this->category["yell_cat_id"];
   }
   function getName() {
      return $this->category["yell_cat_name"];
   }
   function getDescription() {
      return $this->category["yell_cat_description"];
   }
   function getIcon() {
      return $this->category["yell_cat_icon"];
   }
   function getParentId() {
      return $this->category["yell_cat_parent_id"];
   }
   function getSectionId() {
      return $this->category["yell_cat_section_id"];
   }
   function getChildCount() {
      return $this->childcount;
   }
   function getItemCount() {
      return $this->itemcount;
   }

   // Setters
   function addChildId($id) {
      $this->children[$id] = true;
      $this->childcount++;
   }
   function setItemCount($count) {
      $this->itemcount = $count;
   }
}
?>