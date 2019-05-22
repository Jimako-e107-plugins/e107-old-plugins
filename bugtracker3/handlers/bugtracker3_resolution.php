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
| $Source: e:\_repository\e107_plugins/bugtracker3/handlers/bugtracker3_resolution.php,v $
| $Revision: 1.1 $
| $Date: 2006/11/07 23:51:19 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Bugtracker3 Resolution
 */
class bugtracker3Resolution {
   var $resolution; // row from the database resolution table
   var $count;    // a count used for totalling bugs with this resolution

   /**
    * Constructor
    * @param   a resolution row (array) from the database table
    */
   function bugtracker3Resolution($row) {
      $this->resolution = $row;
      $this->count = 0;
   }

   // Getters
   function getId() {
      return $this->resolution["bugtracker3_resolution_id"];
   }
   function getName() {
      return $this->resolution["bugtracker3_resolution_name"];
   }
   function getDescription() {
      return $this->resolution["bugtracker3_resolution_description"];
   }
   function getOrder() {
      return $this->resolution["bugtracker3_resolution_description"];
   }
   function getCount() {
      return $this->count;
   }

   function add($val) {
      return $this->count += $val;
   }
}
?>