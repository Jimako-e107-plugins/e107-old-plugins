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
| $Source: e:\_repository\e107_plugins/bugtracker3/handlers/bugtracker3_filter.php,v $
| $Revision: 1.1.2.1 $
| $Date: 2006/11/11 17:02:12 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Bugtracker3 Filter
 */
class bugtracker3Filter {
   var $filter;   // App version row from database

   /**
    * Constructor
    * @param   a filter row (array) from the database table, or false to create an empty object
    */
   function bugtracker3Filter($row=false) {
      if (false !== $row) {
         $this->filter = $row;
      }
   }

   // Getters
   function getId() {
      return (isset($this->filter)) ? $this->filter["bugtracker3_filter_id"] : "";
   }
   function getOwner() {
      return (isset($this->filter)) ? $this->filter["bugtracker3_filter_owner"] : "";
   }
   function getName() {
      $text .= "";
      if (isset($this->filter)) {
         if ($this->ispublic()) {
            $text .= "(".BUG_LAN_LABEL_FILTER_PUBLIC.") ";
         }
         $text .= $this->filter["bugtracker3_filter_name"];
      }

      return $text;
   }
   function getDescription() {
      return (isset($this->filter)) ? $this->filter["bugtracker3_filter_description"] : "";
   }
   function getPublic() {
      return (isset($this->filter)) ? $this->filter["bugtracker3_filter_public"] : "";
   }
   function getBugOwnerId() {
      return (isset($this->filter)) ? $this->filter["bugtracker3_filter_bug_owner_id"] : false;
   }
   function getCategories() {
      return (isset($this->filter)) ? $this->filter["bugtracker3_filter_categories"] : false;
   }
   function getPriorities() {
      return (isset($this->filter)) ? $this->filter["bugtracker3_filter_priorities"] : false;
   }
   function getResolutions() {
      return (isset($this->filter)) ? $this->filter["bugtracker3_filter_resolutions"] : false;
   }
   function getStatuses() {
      return (isset($this->filter)) ? $this->filter["bugtracker3_filter_statuses"] : false;
   }

   function isPublic() {
      return (isset($this->filter)) ? $this->filter["bugtracker3_filter_public"]==1 ? true : false : "";
   }
}
?>