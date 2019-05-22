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
| $Source: e:\_repository\e107_plugins/bugtracker3/handlers/bugtracker3_priority.php,v $
| $Revision: 1.1 $
| $Date: 2006/11/07 23:51:19 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Bugtracker3 Priority
 */
class bugtracker3Priority {
   var $priority; // row from the database priority table
   var $count;    // a count used for totalling bugs with this priority

   /**
    * Constructor
    * @param   a priority row (array) from the database table
    */
   function bugtracker3Priority($row) {
      $this->priority = $row;
      $this->count = 0;
   }

   // Getters
   function getId() {
      return $this->priority["bugtracker3_priority_id"];
   }
   function getName() {
      return $this->priority["bugtracker3_priority_name"];
   }
   function getDescription() {
      return $this->priority["bugtracker3_priority_description"];
   }
   function getOrder() {
      return $this->priority["bugtracker3_priority_description"];
   }
   function getColor() {
      return $this->priority["bugtracker3_priority_color"];
   }
   function getCount() {
      return $this->count;
   }

   function add($val) {
      return $this->count += $val;
   }
}
?>