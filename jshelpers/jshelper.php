<?php
/*
+---------------------------------------------------------------+
| JSHelper by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: /CVS_Repository/jshelpers/jshelper.php,v $
| $Revision: 1.8 $
| $Date: 2008/11/16 21:45:40 $
| $Author: Owner $
+---------------------------------------------------------------+
*/
if (!defined("e107_INIT")) {
   exit;
}

//TODO upgrade to 0.7.9+ check using $pref["plug_installed"]
if (!$sql->db_Select("plugin", "*", "plugin_path = 'jshelpers' AND plugin_installflag = '1' ")) {
   // Plugin not installed
   return;
}

global $prefs;
$jshelper_path     = e_PLUGIN."jshelpers/";
$jshelper_src_path = e_PLUGIN."jshelpers/src/";
require_once($jshelper_path."constants.php");
include_lan($jshelper_path."languages/".e_LANGUAGE.".php");

if (!class_exists("JSHelper")) {
   class JSHelper {
      var $_scriptIncluded;
      var $_calls    = array();
      var $_includes = array();
      var $_requires = array();

      /**
       * Constructor
       */
      function JSHelper() {
         $this->_scriptIncluded = false;
      }

      /**
       * Register an intent to use a JavaScript file/framework after the DOM has loaded.
       * The JavaScript file(s) will be laoded at the end of the page.
       */
      function js_include($id) {
         $this->_includes[$id] = true;
      }

      /**
       * Register an intent to use a JavaScript file/framework after the DOM has loaded.
       * The JavaScript file(s) will be laoded at the end of the page.
       */
      function js_require($id) {
         $this->_requires[$id] = true;
      }

      /**
       * Allows plugins to register a function to be called before JavaScript framework/library files are included
       *
       * @param $function the function to be called
       * @param $include  full path to a PHP source file to be included before the function call.
       */
      function registerPre($function, $include="") {
         $this->_calls["pre"][] = new JSHelperCall($function, $include);
      }

      /**
       * Allows plugins to register a function to be called after JavaScript framework/library files are included
       *
       * @param $function the function to be called
       * @param $include  full path to a PHP source file to be included before the function call.
       */
      function registerPost($function, $include="") {
         $this->_calls["post"][] = new JSHelperCall($function, $include);
      }

      /**
       * Generate markup to include framework and library source files
       * @private
       */
      function _scriptInclude() {
         global $jshelper_path, $jshelper_src_path, $footer_js;
         // Make sure we only execute this once
         if (!$this->_scriptIncluded) {
            $qs = Array();
            $this->_includePrePost("pre");
            //if ($prefs["jshelper_firebug_mode"]) {
            //   echo "<script src='".$jshelper_src_path."firebug/firebug.js' type='text/javascript'></script>\n";
            //} else {
            //   echo "<script src='".$jshelper_src_path."firebug/firebugx.js' type='text/javascript'></script>\n";
            //}

            // HEAD scripts
            $qs = Array();
            foreach ($this->_requires as $script=>$bool) {
               // Include JSHelper JavaScript
               echo "<script src='".$jshelper_path."jsinclude.php?$script' type='text/javascript'></script>\n";
            }

            // Footer scripts
            $qs = Array();
            foreach ($this->_includes as $script=>$bool) {
               $footer_js[] = $jshelper_path."jsinclude.php?$script";
            }

            $this->_includePrePost("post");
            $this->_scriptIncluded = true;
         }
      }

      /**
       * Perform any pre- or post- actions
       *
       * @param $prepost the actions to be performed ("pre" or "post")
       * @private
       */
      function _includePrePost($prepost) {
         foreach($this->_calls[$prepost] as $call) {
            if (file_exists($call->_include)) {
               include_once($call->_include);
            }
            if (function_exists($call->_function)) {
               $func = $call->_function;
               $func();
            }
         }
      }
   }
   class JSHelperCall {
      var $_include;
      var $_function;

      function JSHelperCall($function, $include="") {
         $this->_include = $include;
         $this->_function = $function;
      }
   }

   global $jshelper;
   $jshelper = new JSHelper();
}
?>