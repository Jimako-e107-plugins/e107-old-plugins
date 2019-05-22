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
| $Source: e:\_repository\e107_plugins/bugtracker3/handlers/bugtracker3_status.php,v $
| $Revision: 1.1 $
| $Date: 2006/11/07 23:51:19 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Bugtracker3 Status
 */
class bugtracker3Status {
   var $status;   // row from the database status table
   var $count;    // a count used for totalling bugs with this status

   /**
    * Constructor
    * @param   a status row (array) from the database table
    */
   function bugtracker3Status($row) {
      $this->status = $row;
      $this->count = 0;
   }

   // Getters
   function getId() {
      return $this->status["bugtracker3_status_id"];
   }
   function getName() {
      return $this->status["bugtracker3_status_name"];
   }
   function getDescription() {
      return $this->status["bugtracker3_status_description"];
   }
   function getOrder() {
      return $this->status["bugtracker3_status_description"];
   }
   function getCount() {
      return $this->count;
   }

   function add($val) {
      return $this->count += $val;
   }
}
?>