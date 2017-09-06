<?php

// To Do : See e107HelperForm_class.php

/**
 * e107 Logger Helper class
 * <b>CVS Details:</b>
 * <ul>
 * <li>$Source: e:\_repository\e107_plugins/e107helpers/e107HelperLogger_class.php,v $</li>
 * <li>$Date: 2008/05/29 22:05:23 $</li>
 * </ul>
 * @author     $Author: Neil $
 * @version    $Revision: 1.3.6.2 $
 * @copyright  Released under the terms and conditions of the GNU General Public License (http://gnu.org).
 * @package e107HelperLogger
 */

/**
 * Logger level defines
 */
define("HELPER_LOGGER_OFF",            0);
define("HELPER_LOGGER_FATAL",          1);
define("HELPER_LOGGER_ERROR",          2);
define("HELPER_LOGGER_WARN",           3);
define("HELPER_LOGGER_INFO",           4);
define("HELPER_LOGGER_DEBUG",          5);
define("HELPER_LOGGER_TRACE",          6);

/**
 * Helpe defines for use by the PHP eval() function
 */
define("HELPER_LOGGER_TRACE_METHOD_ENTRY", "if (\$this->_logger->isTrace()) {\$this->_logger->trace(HELPER_LOGGER_METHOD_ENTRY);}");
define("HELPER_LOGGER_TRACE_METHOD_EXIT",  "if (\$this->_logger->isTrace()) {\$this->_logger->trace(HELPER_LOGGER_METHOD_EXIT);}");

/**
 * A Helper class for the e107 CMS system.
 * Factory class for creating a logger
 *
 * @package e107HelperLogger
 */
class e107HelperLoggerFactory {
   /**#@+
    * @access private
    */
   var $_loggers;       // An array of loggers
   /**#@-*/


   /**
    * Constructor
    */
   function __construct() {
      $this->_loggers = array();
   }

   /**
    * Get a new logger
    * @param   string   a unique name for the logger
    * @return  object   an instance of a logger
    */
   function getLogger($name) {
      $name = "e107HelperLogger";   // Only have one logger for the time being, need to configure admin pages before introducing multiple loggers
      $this->_loggers[$name] = new e107HelperLogger($name);
      return $this->_loggers[$name];
   }
}

/**
 * A private Helper class for the e107 CMS system.
 * This is the class that does the actual logging for a particular logger
 *
 * @package e107Helper
 * @subpackage e107HelperLogger
 */
class e107HelperLogger {
   /**#@+
    * @access private
    */
   var $_name;          // The loggers name
   var $_level;         // The current logger level

   var $_file;          // Name of file to write debuf info to
   /**#@-*/

   /**
    * Constructor
    */
   function e107HelperLogger($name) {
      global $pref;
      $this->_loggers   = array();
      $this->_level     = $pref["helper_logger_level"];
   }

   // *********************************************************************************************
   // Public setter methods
   // *********************************************************************************************

   /**
    * Set logger level.
    * @param int the logger level to set
    */
   function setLevel($new) {
      $this->_level     = $new;
   }

   // *********************************************************************************************
   // Public getter methods
   // *********************************************************************************************

   /**
    * Get the current logger level
    * @return  int   the current logger level
    */
   function getLevel() {
      return $this->_level;
   }

   // *********************************************************************************************
   // Public loggging methods
   // *********************************************************************************************

   /**
    * Generate a FATAL message
    * @param   string   message prefix
    * @param   string   message
    */
   function fatal($prefix, $text) {
      if ($this->_level >= HELPER_LOGGER_FATAL) {
         $this->_message($prefix, $text);
      }
   }

   /**
    * Generate an ERROR message
    * @param   string   message prefix
    * @param   string   message
    */
   function error($prefix, $text) {
      if ($this->_level >= HELPER_LOGGER_ERROR) {
         $this->_message($prefix, $text);
      }
   }

   /**
    * Generate a WARN message
    * @param   string   message prefix
    * @param   string   message
    */
   function warn($prefix, $text="") {
      if ($this->_level >= HELPER_LOGGER_WARN) {
         $this->_message($prefix, $text);
      }
   }

   /**
    * Generate an INFO message
    * @param   string   message prefix
    * @param   string   message
    */
   function info($prefix, $text) {
      if ($this->_level >= HELPER_LOGGER_INFO) {
         $this->_message($prefix, $text);
      }
   }

   /**
    * Generate a DEBUG message
    * @param   string   message prefix
    * @param   string   message
    */
   function debug($prefix, $text) {
      if ($this->_level >= HELPER_LOGGER_DEBUG) {
         $this->_message($prefix, $text);
      }
   }

   /**
    * Generate a TRACE message
    * @param   string   message prefix
    * @param   string   message
    */
   function trace($prefix, $text) {
      if ($this->_level >= HELPER_LOGGER_TRACE) {
         $this->_message($prefix, $text);
      }
   }

   // *********************************************************************************************
   // Private helper methods
   // *********************************************************************************************

   /**
    * Generates the log message
    * @param   string   log message prefix (see Helper constants in langueage file)
    * @param   mixed    message or value to be displayed
    */
   function _message($prefix, $msg="") {
      $randomid = "logger_".rand();
      $bt = debug_backtrace();
      switch ($prefix) {
         case HELPER_LOGGER_METHOD_ENTRY :
         case HELPER_LOGGER_METHOD_EXIT : {
            $msg = $bt[3]["function"]."(";
            for ($i=0; $i<count($bt[3]["args"]); $i++) {
               $msg .= $i >0 ? ", " : "";
               $msg .= $bt[3]["args"][$i];
            }
            $msg .= ")";
            break;
         }
         default : {
            if (!isset($msg)) {
               $msg = HELPER_DEBUG_VALUE_NOT_SET;
            } else if (is_bool($msg)) {
               $msg = $msg ? "true" : "false";
            }
         }
      }
      print "<div onclick='expandit(\"".$randomid."\");'><span style='font-family:monospace;'>$prefix :</span> $msg</div><div id='$randomid' style='display:none'><pre>";
      //print_r($bt[0]);
      //print_r($bt[1]);
      print_r($bt[2]);
      print_r($bt[3]);
      print "</pre></div>";
   }

   // *********************************************************************************************
   // Public helper methods
   // *********************************************************************************************

   /**
    * Is logging level at least FATAL
    * @return  bool  true if debug level is set to FATAL or greater
    */
   function isFatal() {
      return $this->_level >= HELPER_LOGGER_FATAL;
   }

   /**
    * Is logging level at least ERROR
    * @return  bool  true if debug level is set to ERROR or greater
    */
   function isError() {
      return $this->_level >= HELPER_LOGGER_ERROR;
   }

   /**
    * Is logging level at least WARN
    * @return  bool  true if debug level is set to WARNor greater
    */
   function isWarn() {
      return $this->_level >= HELPER_LOGGER_WARN;
   }

   /**
    * Is logging level at least INFO
    * @return  bool  true if debug level is set to INFO or greater
    */
   function isInfo() {
      return $this->_level >= HELPER_LOGGER_INFO;
   }

   /**
    * Is logging level at least DEBUG
    * @return  bool  true if debug level is set to DEBUG or greater
    */
   function isDebug() {
      return $this->_level >= HELPER_LOGGER_DEBUG;
   }

   /**
    * Is logging level at least TRACE
    * @return  bool  true if debug level is set to TRACE or greater
    */
   function isTrace() {
      return $this->_level >= HELPER_LOGGER_TRACE;
   }

   /**
    * <p>General log function - logs details of the current class/function/line to the e107 time logging
    * list, log can be viewed using the URL paramter "[debug=time]".</p>
    * @see http://wiki.e107.org/?title=E107_debug
    * @param $prefix    string to be prepended to the logged text, defaults to empty string
    * @param $backtrace return array from a call to debug_backtrace(), only needed by this class
    *                   as it will be grabbed if not supplied
    * @param $variable  name of a variable whose value is to be logged
    * @param $value     the value of the variable
    */
   function log($prefix="", $backtrace=false, $variable=false, $value=false) {
      global $sql;
      if (!$backtrace) {
         $backtrace = debug_backtrace();
      }
      $text = isset($backtrace[1]["class"]) ? $backtrace[1]["class"]."->" : "";
      $text .= $backtrace[1]["function"]."() @ ".$backtrace[0]["line"];
      if ($variable && $value) {
         $text .= "<br/> $variable=$value";
      } else if ($variable) {
         $text .= "<br/> $variable";
      }
      //TODO ".$backtrace[1]["args"]."
      //var_dump($backtrace);
      $sql->db_Mark_Time($prefix.$text);
   }

   /**
    * Log entry to a function
    * @param $prefix    string to be prepended to the logged text, defaults to "[logEntry] "
    */
   function logEntry($prefix="[logEntry] ") {
      $this->log($prefix, debug_backtrace());
   }

   /**
    * Log exit from a function
    * @param $prefix    string to be prepended to the logged text, defaults to "[logExit] "
    */
   function logExit($prefix="[logExit] ") {
      $this->log($prefix, debug_backtrace());
   }

   /**
    * Log the current time
    */
   function logTime() {
      $this->log($prefix, debug_backtrace(), "current time", microtime(true));
   }

   /**
    * Log the value of a variable
    * @param $variable  then name of the variable to be logged
    * @param $value     then value of the variable to be logged
    */
   function logValue($variable, $value) {
      $this->log($prefix, debug_backtrace(), $variable, $value);
   }

}
?>