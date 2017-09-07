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
| $Source: e:/_repository/e107_plugins/simple_content/handlers/scontent_group.php,v $
| $Revision: 1.1 $
| $Date: 2008/05/26 23:14:53 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Simple Content Group
 */
class SimpleContentGroup {
   var $group; // A row from the simple content groups table

   /**
    * Constructor
    * @param $row a row from the groups table
    */
   function SimpleContentGroup($row) {
      $this->debug = false;
      $this->group = $row;
   }

   // Getters
   function getId() {
      return $this->group["scontent_group_id"];
   }
   function getName() {
      return $this->group["scontent_group_name"];
   }
   function getIcon() {
      return $this->group["scontent_group_icon"];
   }
   function getDescription() {
      return $this->group["scontent_group_description"];
   }
   function getStartDate() {
      return $this->group["scontent_group_start_date"];
   }
   function getEndDate() {
      return $this->group["scontent_group_end_date"];
   }
   function getViewClass() {
      return $this->group["scontent_group_view_class"];
   }
   function getTemplate() {
      return $this->group["scontent_group_template"];
   }
   // Utility methods
   function isOpen() {
      return $this->getStartDate() < time() && time() < $this->getEndDate();
   }
   function isFinished() {
      return time() > $this->getEndDate();
   }
}
?>