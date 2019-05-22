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
| $Source: e:\_repository\e107_plugins/bugtracker3/handlers/bugtracker3_app_version.php,v $
| $Revision: 1.1 $
| $Date: 2006/11/07 23:51:18 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Bugtracker3 Application Version
 */
class bugtracker3AppVersion {
   var $appver;   // App version row from database

   /**
    * Constructor
    * @param   a appver row (array) from the database table, or false to create an empty object
    */
   function bugtracker3AppVersion($row=false) {
      if (false !== $row) {
         $this->appver = $row;
      }
   }

   // Getters
   function getId() {
      return (isset($this->appver)) ? $this->appver["bugtracker3_appver_id"] : "";
   }
   function getApplicationId() {
      return (isset($this->appver)) ? $this->appver["bugtracker3_appver_app_id"] : "";
   }
   function getDescription() {
      return (isset($this->appver)) ? $this->appver["bugtracker3_appver_description"] : "";
   }
   function getVersion() {
      return (isset($this->appver["bugtracker3_appver_version"])) ? $this->appver["bugtracker3_appver_version"] : "";
   }
}
?>