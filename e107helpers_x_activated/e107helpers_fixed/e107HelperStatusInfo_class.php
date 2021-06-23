<?php
/*
+---------------------------------------------------------------+
| e107Helper by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: k:\Websites\_repository\e107_plugins/e107helpers/e107HelperStatusInfo_class.php,v $
| $Revision: 1.1.2.2 $
| $Date: 2008/08/24 20:47:40 $
| $Author: Owner $
+---------------------------------------------------------------+
*/

// Status Info levels
define("STATUS_DEBUG",  "DEBUG");
define("STATUS_INFO",   "INFO");
define("STATUS_WARN",   "WARN");
define("STATUS_ERROR",  "ERROR");
define("STATUS_FATAL",  "FATAL");

/**
 * Model Object for a League manager warning/error
 * Holds information relating to errors and warnings
 */
class e107HelperStatusInfo {
   var $level;       // Status level
   var $messages;    // array of messages

   /**
    * Constructor
    * @param $level status level, defaults to STATUS_ERROR - refer to STATUS_* constants
    */
   function __construct($level=STATUS_ERROR) {
      $this->level = $level;
      $this->messages = array();
   }

   function getLevel() {
      return $this->level;
   }
   function getLevelDescription() {
      switch ($this->level) {
         case STATUS_DEBUG : {
            return HELPER_LAN_MSG_DEBUG;
         }
         case STATUS_INFO : {
            return HELPER_LAN_MSG_INFORMATION;
         }
         case STATUS_WARN : {
            return HELPER_LAN_MSG_WARNING;
         }
         case STATUS_ERROR : {
            return HELPER_LAN_MSG_ERROR;
         }
         case STATUS_FATAL : {
            return HELPER_LAN_MSG_FATAL;
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
   function getAllMessages() {
      // TODO make this in to a template/shortcode to allow custom layout
      $text = "";
      for ($i=0; $i<$this->getMessageCount(); $i++) {
         $text .= $this->getMessage($i)."\n";
         if ($this->hasAdditionalDetails($i)) {
            $text .= "(".$this->getAdditionalDetails($i).")\n";
         }
      }
      return $text;
   }

   function addMessage($message, $additionalDetails=false) {
      $this->messages[]["message"] = $message;
      if (false !== $additionalDetails) {
         return $this->messages[count($this->messages)-1]["additional"] = $additionalDetails;
      }
   }
   function addMissingMandatory($fieldName) {
      return $this->messages[]["message"] = $fieldName.HELPER_LAN_MSG_MANDATORY;
   }
}
?>