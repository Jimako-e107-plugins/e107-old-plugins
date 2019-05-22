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
| $Source: e:\_repository\e107_plugins/bugtracker3/handlers/bugtracker3_status_info.php,v $
| $Revision: 1.1 $
| $Date: 2006/11/07 23:51:19 $
| $Author: Neil $
+---------------------------------------------------------------+
*/

// Status Info levels
define("STATUS_DEBUG",  "DEBUG");
define("STATUS_INFO",   "INFO");
define("STATUS_WARN",   "WARN");
define("STATUS_ERROR",  "ERROR");
define("STATUS_FATAL",  "FATAL");

/**
 * Model Object for an Bugtracker3 error
 * Holds information relating to errors and warnings
 */
class bugtracker3StatusInfo {
   var $level;       // Status level
   var $messages;    // array of messages

   /**
    * Constructor
    * @param $level status level, defaults to STATUS_ERROR - refer to STATUS_* constants
    */
   function bugtracker3StatusInfo($level=STATUS_ERROR) {
      $this->level = $level;
      $this->messages = array();
   }

   function getLevel() {
      return $this->level;
   }
   function getLevelDescription() {
      switch ($this->level) {
         case STATUS_DEBUG : {
            return BUG_LAN_MSG_DEBUG;
         }
         case STATUS_INFO : {
            return BUG_LAN_MSG_INFORMATION;
         }
         case STATUS_WARN : {
            return BUG_LAN_MSG_WARNING;
         }
         case STATUS_ERROR : {
            return BUG_LAN_MSG_ERROR;
         }
         case STATUS_FATAL : {
            return BUG_LAN_MSG_FATAL;
         }
         default : {
            return "";
         }
      }
   }
   function getMessageCount() {
      return count($this->messages);
   }
   function getMessage($ix) {
      return $this->messages[$ix]["message"];
   }
   function getAdditionalDetails($ix) {
      return $this->messages[$ix]["additional"];
   }
   function hasAdditionalDetails($ix) {
      return (isset($this->messages[$ix]["additional"]));
   }

   function addMessage($message, $additionalDetails=false) {
      $this->messages[]["message"] = $message;
      if (false !== $additionalDetails) {
         return $this->messages[count($this->messages)-1]["additional"] = $additionalDetails;
      }
   }
   function addMissingMandatory($fieldName) {
      return $this->messages[]["message"] = $fieldName." is mandatory";
   }
}
?>