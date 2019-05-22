<?
/*
+---------------------------------------------------------------+
| Bugtracker3 by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/bugtracker3/handlers/bugtracker3_category.php,v $
| $Revision: 1.1 $
| $Date: 2006/11/07 23:51:18 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Bugtracker3 Category
 */
class bugtracker3Category {
   var $category; // row from the database category table
   var $count;    // a count used for totalling bugs with this category

   /**
    * Constructor
    * @param   a category row (array) from the database table
    */
   function bugtracker3Category($row) {
      $this->category = $row;
      $this->count = 0;
   }

   // Getters
   function getId() {
      return $this->category["bugtracker3_category_id"];
   }
   function getName() {
      return $this->category["bugtracker3_category_name"];
   }
   function getDescription() {
      return $this->category["bugtracker3_category_description"];
   }
   function getOrder() {
      return $this->category["bugtracker3_category_description"];
   }
   function getCount() {
      return $this->count;
   }

   function add($val) {
      return $this->count += $val;
   }
}
?>