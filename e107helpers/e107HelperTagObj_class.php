<?php

// To Do : See e107HelperForm_class.php

/**
 * e107 Tag Object Helper class
 * <b>CVS Details:</b>
 * <ul>
 * <li>$Source: /CVS_Repository/e107helpers/e107HelperTagObj_class.php,v $</li>
 * <li>$Date: 2007/08/01 23:36:32 $</li>
 * </ul>
 * @author     $Author: Neil $
 * @version    $Revision: 1.11 $
 * @copyright  Released under the terms and conditions of the GNU General Public License (http://gnu.org).
 * @package e107HelperForm
 */

/**
 * A private Helper class for the e107 CMS system.
 * Used by the e107HelperForm class.
 * Each tag object holds enough information to render the tag on the screen.
 * Tag data can be validated and error messages set. Validation rules are based on the tag type and
 * on optional supplied rules.
 * Note: this class is normally instansiated by the e107HelperForm class.
 *
 * @package e107HelperForm
 */
class e107HelperTagObj {
   /**#@+
    * @access private
    */
   var $_tagType;             // The type of the tag
   var $_formName;            // The name of the form that this tag is part of

   var $_ix;                  // Index of current instance of this tag (when batch forms are being used
   var $_class;               // CSS class(es) for the tag
   var $_callback;            // Callback function for formatting values
   var $_callbackClass;       // Callback class for formatting values
   var $_listCallback;        // List callback function for formatting lists
   var $_listCallbackClass;   // List callback class for formatting lists
   var $_params;              // Callback function parameters
   var $_breaks;              // Insert breaks (true) or not (false) between multi-control controls (e.g. radio buttons)
   var $_nopath;              // Include path name in file names (true) or not (false)
   var $_dir;                 // Base directory for filesystem based tags
   var $_help;                // Some help for the tag
   var $_html;                // Custom HTML
   var $_label;               // A label for the tag
   var $_mandatory;           // Mandatory flag
   var $_maxLen;              // maximum length for the tag
   var $_maxVal;              // maximum value for the tag
   var $_minLen;              // minimum length for the tag
   var $_minVal;              // minimum value for the tag
   var $_dateFormat;          // PHP Date format string
   var $_prompt;              // Some prompt text for the tag
   var $_sequence;            // A sequence number for multi-part tags (e.g radio buttons) used to name IDs
   var $_subdir;              // Sub directory for filesystem based tags

   var $_default;             // Default value for the tag
   var $_attributes;          // Array of attributes for this tag
   var $_styles;              // Array of style attributes for this tag
   var $_values;              // Array holding value for the tag

   var $_change;              // Event handler Javascriopt for the change event
   var $_click;               // Event handler Javascriopt for the click event
   var $_focus;               // Event handler Javascriopt for the focus event
   var $_blur;                // Event handler Javascriopt for the blur event
   var $_mouseover;           // Event handler Javascriopt for the mouseover event

   var $_bbcodes;             // Show BB Code toolbar for a textarea
   var $_omittedClasses;     // Set to true to show standard classes in accesstable (default) otherwise false

   var $_message;             // Array of error message (one per index), normally from validation

   var $_logger;              // A reference to the logging object
   /**#@-*/

   /**
    * Constructor
    */
   function __construct($tagType, $formName) {
      $this->_logger          = $GLOBALS["e107HelperLoggerFactory"]->getLogger(get_class($this));
      $this->_logger->setLevel(HELPER_LOGGER_OFF);
      $this->_tagType         = $tagType;
      $this->_formName        = $formName;
      $this->_ix              = 0;
      $this->_class           = "";
      $this->_callback        = "";
      $this->_callbackClass   = "";
      $this->_params          = array();
      $this->_breaks          = false;
      $this->_nopath          = false;
      $this->_dir             = "";
      $this->_help            = "";
      $this->_html            = "";
      $this->_label           = "";
      $this->_maxLen          = "";
      $this->_maxVal          = "";
      $this->_minLen          = "";
      $this->_minVal          = "";
      $this->_dateFormat      = "";
      $this->_batchTag        = false;
      $this->_includeBlank    = false;
      $this->_mandatory       = false;
      $this->_prompt          = "";
      $this->_sequence        = 0;
      $this->_subdir          = "";
      //$this->_default         = false;
      $this->_attributes      = array();
      $this->_styles          = array();
      $this->_values          = array();
      $this->_change          = "";
      $this->_click           = "";
      $this->_focus           = "";
      $this->_blur            = "";
      $this->_mouseover       = "";
      $this->_bbcodes         = 0;
      $this->_omittedClasses  = array();
      $this->_message         = array();
   }

   // *********************************************************************************************
   // Public setter methods
   // *********************************************************************************************

   /*
    * Add CSS class(es).
    * @param $new the CSS class(es) (if more than one, separate by spaces)
    */
   function addCSSClass($new) {
      $this->_class = $new;
   }

   /*
    * Add some help text.
    * Help text is normally display adjacent or beneath the actual control
    * @param $new the help text
    */
   function addHelp($new) {
      $this->_help = $new;
   }

   /*
    * Add a label
    * @param $new the label text
    */
   function addLabel($new) {
      $this->_label = $new;
   }

   /*
    * Add some prompt text.
    * Prompt text is normally displayed below the label (often in a different font)
    * @param $new the prompt text
    */
   function addPrompt($new) {
      $this->_prompt = $new;
   }

   /*
    * Add an attribute to the tag
    */
   function addAttribute($att, $value) {
      $tempArray = array($att => $value);
      $this->_attributes = array_merge($this->_attributes, $tempArray);
   }

   /*
    * Add a style attribute to the tag
    */
   function addStyle($att, $value) {
      $tempArray = array($att => $value);
      $this->_styles = array_merge($this->_styles, $tempArray);
   }

   /*
    * Add a value to the tag
    */
   function addValue($value, $text="") {
      if ("" != $text) {
         $value = array($value, $text);
      }
      $this->_values[] = $value;
   }

   /*
    * Set BB Code mode for textareas
    */
   function setBBCodes($new) {
      $this->_bbcodes = $new;
   }

   /*
    * Set a userclasses to omitted from accesstables
    */
   function omitClass($new) {
      $this->_omittedClasses[] = $new;
   }

   /*
    * Set a flag to indicate that this field is part of a repeating group
    */
   function setBatchTag($new) {
      $this->_batchTag = $new;
   }

   /*
    * Set custom HTML used to render this tag
    */
   function setCustomHTML($new) {
      $this->_html = $new;
   }

   /*
    *
    * @param
    * @return
    */
   function setCallback($class, $func) {
      $this->_callbackClass = $class;
      $this->_callback = $func;
   }

   /*
    *
    * @param
    * @return
    */
   function setListCallback($class, $func) {
      $this->_listCallbackClass = $class;
      $this->_listCallback = $func;
   }

   /*
    *
    * @param
    * @return
    */
   function setCallbackParam($name, $value) {
      $tempArray = array($name => $value);
      $this->_params = array_merge($this->_params, $tempArray);
   }

   /**
    * Add a default value to the tag
    * <p>Only allow the first call to set default. This allows for an already set preference value
    * to not be overwritten by a hard coded value from an API call or XML form definition.</p>
    * @param $new    the default value
    * @param $force  force the value as the default value
    */
   function setDefault($new, $force=false) {
      if (!isset($this->_default) || $force===true) {
         $this->_default = $new;
      }
   }

   /*
    *
    * @param
    * @return
    */
   function setBreaks($value) {
      $this->_breaks = $value ? true : false;
   }

   /*
    *
    * @param
    * @return
    */
   function setNoPath($value) {
      $this->_nopath = $value ? true : false;
   }

   /*
    *
    * @param
    * @return
    */
   function setDir($value) {
      $value = (strrpos($value, "/")+1) == strlen($value) ? $value : "$value/";
      $this->_dir = $value;
   }

   /*
    *
    * @param
    * @return
    */
   function setIX($ix) {
      $this->_ix = $ix;
   }

   /*
    *
    * @param
    * @return
    */
   function setSubDir($value) {
      $value = (strrpos($value, "/")+1) == strlen($value) ? $value : "$value/";
      $this->_subdir = $value;
   }

   /*
    * Add JavaScrip for an event
    */
   function addJavaScript($event, $js) {
      $js = str_replace("'", '"', $js);
      switch ($event) {
         case "change" : {
            $this->_change = $js;
            break;
         }
         case "click" : {
            $this->_click = $js;
            break;
         }
         case "focus" : {
            $this->_focus = $js;
            break;
         }
         case "blur" : {
            $this->_blur = $js;
            break;
         }
         case "mouseover" : {
            $this->_mouseover = $js;
            break;
         }
         default : {
            $text .= HELPER_LAN_ERR_PROC_01.$event;
         }
      }
   }

   /*
    * Set the mandatory flag
    * @param $new boolean flag to indicate mandatoriness (sp?)
    */
   function setMandatory($new) {
      $this->_mandatory = $new;
   }

   /**
    * Set the maximum length for the tag
    * @param string the name of the field to set the length for
    * @param int the maximum length
    */
   function setMaxLength($new) {
      $this->_maxLen = $new;
   }

   /**
    * Set the maximum value for the tag
    * @param string the name of the field to set the value for
    * @param int the maximum value
    */
   function setMaxValue($new) {
      $this->_maxVal = $new;
   }

   /**
    * Set the minimum length for the field
    * @param string the name of the field to set the length for
    * @param int the minimum length
    */
   function setMinLength($new) {
      $this->_minLen = $new;
   }

   /**
    * Set the minimum value for the field
    * @param string the name of the field to set the value for
    * @param int the minimum value
    */
   function setMinValue($new) {
      $this->_minVal = $new;
   }

   /**
    * Set the date format for a date field
    * @param string the name of the field to set the length for
    * @param string PHP date formatting string (see http://uk2.php.net/manual/en/function.date.php)
    */
   function setDateFormat($new) {
      $this->_dateFormat = $new;
   }

   /**
    * Set whether or not a blank entry is required
    * <p>Used for list style tags to allow a 'no-selection' type value</p>
    * @param boolean set to true if a blank entry is required
    */
   function setIncludeBlank($new) {
      $this->_includeBlank = $new;
   }

   // *********************************************************************************************
   // Public getter methods
   // *********************************************************************************************

   /*
    *
    * @param
    * @return
    */
   function getName($pre="", $post="") {
      return $pre.$this->_attributes["name"].$post;
   }

   /*
    *
    * @param
    * @return
    */
   function getBreaks() {
      return $this->_breaks;
   }

   /*
    *
    * @param
    * @return
    */
   function getNoPath() {
      return $this->_nopath;
   }

   /*
    *
    * @param
    * @return
    */
   function getDir() {
      return $this->_dir.$this->_subdir;
   }

   /*
    *
    * @param
    * @return
    */
   function getDefault($asAtt=true) {
      if (strlen($this->_default) > 0) {
         if ($asAtt) {
            return " value='".$this->_default."'";
         } else {
            return $this->_default;
         }
      }

      return "";
   }

   /*
    *
    * @param
    * @return
    */
   function getError() {
      return $this->_label." : ".$this->_message[$this->_getIX()];
   }

   /*
    *
    * @param
    * @return
    */
   function getHelp() {
      return $this->_help;
   }

   /*
    * Determine if the field is mandatory
    * @return true, if the field is mandatory
    */
   function getMandatory() {
      return $this->_mandatory;
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function getID($post="", $asAtt=false, $withix=false) {
      $text = $withix ? $this->_attributes["id"]."_".$this->_getIX().$post : $this->_attributes["id"].$post;
      return $asAtt ? " id='".$text."'" : $text;
   }

   /*
    *
    * @param
    * @return
    */
   function getLabel() {
      return $this->_label;
   }

   /*
    *
    * @param
    * @return
    */
   function getPrompt() {
      return $this->_prompt;
   }

   /**
    * Get the value attribute of this tag
    * @param   bool     to indicate if return value should be decorated with HTML value attibute (true, the default) or not (false)
    * @return  string   the value of this tag
    */
   function getValue($asAtt=true) {
      if ($this->_logger->isTrace()) {
         $this->_logger->trace(HELPER_LOGGER_METHOD_ENTRY, "getValue()");
      }

      $value = "";

      if ($asAtt) {
         $value = " value='".$this->_values[0]."'";
      } else {
         $value = $this->_values[0];
      }

      if ($this->_logger->isTrace()) {
         $this->_logger->trace(HELPER_LOGGER_METHOD_EXIT, "getValue()");
         $this->_logger->trace(HELPER_LOGGER_METHOD_RETURN, $value);
      }
      return $value;
   }

   /**
    * Get the current value of this tag (looks for user input before returning current value)
    * @param   bool     to indicate if return value should be decorated with HTML value attibute (true, the default) or not (false)
    * @return  string   the value of this tag
    */
   function getCurrentValue($asAtt=true) {
      if ($this->_logger->isTrace()) {
         $this->_logger->trace(HELPER_LOGGER_METHOD_ENTRY, "getCurrentValue()");
      }

      $value = "";

      // Always use user input data if form has been submitted (for refreshing form when there are errors)
      if (isset($_REQUEST[$this->_formName])){
         if (isset($_REQUEST[$this->_attributes["name"]][$this->_getIX()])
          || isset($_FILES[$this->_attributes["name"]]["name"][$this->_getIX()]))
         {
            if ($asAtt) {
               $value = " value='".$this->_getUserInput()."'";
            } else {
               $value = $this->_getUserInput();
            }
         } else {
            // Form was submitted but this field was not - checkbox or similar so no value, use default
            $value = $this->getDefault(false);
         }
      } else {
         if ($this->_getCallback()) {
            // Allow the application to set the values at runtime
            if ($this->_getCallbackClass()) {
               $this->setDefault(call_user_func(array($this->_getCallbackClass(), $this->_getCallback()), $this->_getParams()));
            } else {
               $this->setDefault(call_user_func($this->_getCallback(), $this->_getParams()));
            }
         }
         if ($asAtt) {
            $value = $this->getDefault();
         } else {
            $value = $this->getDefault(false);
         }
      }

      if ($this->_logger->isTrace()) {
         $this->_logger->trace(HELPER_LOGGER_METHOD_EXIT, "getCurrentValue()");
         $this->_logger->trace(HELPER_LOGGER_METHOD_RETURN, $value);
      }

      return $value;
   }

   // *********************************************************************************************
   // HTML Generation methods
   // *********************************************************************************************

   /**
    *
    * @param
    * @return
    */
   function getTag($formmode) {
      global $e107Helper;

      if ($this->_logger->isTrace()) {
         $this->_logger->trace(HELPER_LOGGER_METHOD_ENTRY, "getTag() for ".$this->_tagType);
      }

      // Weed out any custom tags
      if (strlen($this->_getCustomHTML()) > 0) {
         return $this->_getCustomHTML();
      }

      $text = "";
      switch ($this->_tagType) {
         case "accesstable" : {
            $text .= $this->_accesstableTag();
            break;
         }
         case "autotext" : {
            //print_r($_REQUEST);
            $text .= "<input type='text'";
            $text .= $this->_getAttributeSet();
            $text .= $this->getCurrentValue();
            $text .= "/>";
            $text .= "<script type='text/javascript'>\n";
            $text .= "e107HelperAutoSuggest.add(document.getElementById('".$this->getID()."_".$this->_getIX()."'), 'teamselectionAjax.php');\n";
            //$text .= "e107HelperEvents.bindHandler(window, 'unload', e107HelperAutoSuggest.add);\n";
            $text .= "</script>\n";
            break;
         }
         case "batchitemstart" : {
            $id = $this->_attributes["id"];
            $this->_attributes["id"] = $this->_attributes["id"].$this->_getIX();
            $text = "<div";
            $text .= $this->_getClass();
            $text .= ">";
            $text .= "<label for='".$this->getID()."'";
            $text .= ">";
            if ($this->_getIX()==0) {
               // 1st batch field is always 'mandatory'
               $text .= "<input type='hidden'";
               $text .= $this->_getAttributeSet();
               $text .= " value='1'";
               $text .= "/>";
            } else {
               $checked = $this->getCurrentValue(false)==1 ? " checked='checked'" : "";
               $text .= "<input type='checkbox'";
               $text .= str_replace("{ITEMNO}", $this->_getIX(), $this->_getAttributeSet());
               $text .= " value='1'";
               $text .= "$checked/>";
            }
            $text .= str_replace("{ITEMNO}", $this->_getIX()+1, $this->getHelp());
            $text .= "</label></div>\n";
            $this->_attributes["id"] = $id;
            break;
         }
         case "button" : {
            $text .= $this->_buttonTag();
            break;
         }
         case "calendar" : {
            $text .= $this->_calendarTag();
            break;
         }
         case "calendartime" : {
            $text .= $this->_calendarTag();
            $text .= "&nbsp;&nbsp;&nbsp;";
            $text .= $this->_timeTag(true);
            break;
         }
         case "checkbox" : {
            $text .= "<input type='checkbox'";
            $text .= $this->_getAttributeSet();
            $text .= $this->getValue();
            $checked = ($this->getValue(false) == $this->getCurrentValue(false)) ? " checked='true'" : "";
            $text .= "$checked/>";
            break;
         }
         case "color" : {
            $text = $this->_colorTag();
            break;
         }
         case "customfields" : {
            $text = $this->_customFieldsTag();
            break;
         }
         case "dirlist" : {
            $text .= $this->_dirTag();
            break;
         }
         case "file" : {
            // Force the field name to a well known name in case multiple file fields are being used ??? is this a good idea?
            //$this->_attributes["name"] = $this->_attributes["name"]."[]";
            //$this->_attributes["name"] = "helperuploadfile";
            if ($formmode == HELPER_FORM_MODE_DB_EDIT) {
               $this->setIncludeBlank(true);
               $this->addAttribute("size", "1");
               $text .= $this->_fileTag();
            } else {
               $text .= "<input type='file'";
               $text .= $this->_getAttributeSet();
               $text .= $this->getCurrentValue();
               $text .= "/>";
            }
            break;
         }
         case "filelist" : {
            $text .= $this->_fileTag();
            break;
         }
         case "hidden" : {
            $text .= $this->_hiddenTag();
            break;
         }
         case "image" : {
            $text .= $this->_imageTag();
            break;
         }
         case "list" : {
            $text .= $this->_listTag();
            break;
         }
         case "radio" : {
            $text .= $this->_radioTag();
            break;
         }
         case "submit" :
            $text .= "<input type='submit'";
            $text .= $this->_getAttributeSet();
            $text .= $this->getValue();
            $text .= $this->_getJavaScript();
            $text .= "/>";
            break;
         case "table" : {
            $text .= $this->_tableTag();
            break;
         }
         case "decimal" :
         case "integer" :
         case "numeric" :
         case "text" : {
            //print_r($_REQUEST);
            $text .= "<input type='text'";
            $text .= $this->_getAttributeSet();
            $text .= $this->getCurrentValue();
            $text .= "/>";
            break;
         }
         case "textarea" : {
            $text .= $this->_textareaTag();
            break;
         }
         case "time" : {
            $text .= $this->_timeTag(false);
            break;
         }
         case "upload" : {
            $text .= $this->_uploadTag(false);
            break;
         }
         default : {
            $text .= "*** Unknown tag type (".$this->_tagType.")***";
            break;
         }
      }

      if ($this->_logger->isTrace()) {
         $this->_logger->trace(HELPER_LOGGER_METHOD_EXIT, "getTag()");
         $this->_logger->trace(HELPER_LOGGER_METHOD_RETURN, $text);
      }
      return $text;
   }

   /*
    *
    * @param
    * @return
    */
   function _getIX() {
      return $this->_ix;
   }

   function _getAttributeSet() {
      $text .= $this->_getClass();
      $text .= $this->_getAttributes();
      $text .= $this->_getStyles();
      $text .= $this->_getJavascript();
      return $text;
   }

   function _accesstableTag() {
      global $sql;
      $savedValues = $this->_values;
      if (!$this->_isClassOmitted(e_UC_PUBLIC)) {
         $this->addValue(e_UC_PUBLIC,   HELPER_ACCESSTABLE_EVERYONE);
      }
      //if (!$this->_isClassOmitted(e_UC_MAINADMIN)) {
      //   $this->addValue(e_UC_MAINADMIN,   HELPER_ACCESSTABLE_MAIN_ADMIN);
      //}
      if (!$this->_isClassOmitted(e_UC_NOBODY)) {
         $this->addValue(e_UC_NOBODY,   HELPER_ACCESSTABLE_NOONE);
      }
      if (!$this->_isClassOmitted(e_UC_READONLY)) {
         $this->addValue(e_UC_READONLY,   HELPER_ACCESSTABLE_READONLY);
      }
      if (!$this->_isClassOmitted(e_UC_GUEST)) {
         $this->addValue(e_UC_GUEST,   HELPER_ACCESSTABLE_GUESTS);
      }
      if (!$this->_isClassOmitted(e_UC_MEMBER)) {
         $this->addValue(e_UC_MEMBER,   HELPER_ACCESSTABLE_MEMBERS);
      }
      if (!$this->_isClassOmitted(e_UC_ADMIN)) {
         $this->addValue(e_UC_ADMIN,   HELPER_ACCESSTABLE_ADMINISTRATORS);
      }
      $sql->db_Select("userclass_classes", "userclass_id, userclass_name", " ORDER BY userclass_name", false);
      while($row = $sql->db_Fetch()) {
         $this->addValue($row[0], $row[1]);
      }
      $text = $this->_listTag();
      $this->_values = $savedValues;
      return $text;
   }

   function _buttonTag() {
      $text .= "<input type='button'";
      $text .= $this->_getAttributeSet();
      $text .= $this->getValue();
      $text .= $this->_getJavaScript();
      $text .= "/>";
      return $text;
   }

   /*
    *
    * @param
    * @return
    */
   function _calendarTag() {
      if (class_exists("DHTML_Calendar")) {
         $cal = new DHTML_Calendar();
         $options['firstDay']   = 1;
         $options['showsTime']  = false;
         $options['showOthers'] = true;
         $options['weekNumbers']= true;
         $options['ifFormat']   = "%d-%m-%Y";
         $attrib['class']       = $this->_getClass(false);
         $attrib['size']        = "13";
         $attrib['maxlength']   = "10";
         $attrib['name']        = $this->getID()."[".$this->_getIX()."]";
         if (strlen($this->getCurrentValue(false)) > 0) {
            $attrib['value']       = date("d-m-Y", $this->getCurrentValue(false));
         } else {
            $attrib['value']       = date("d-m-Y", time());
         }
         return $cal->make_input_field($options, $attrib);
      } else {
         $text .= "<input type='text size='10' id='f-calendar-field-1'";
         $text .= $this->_getClass();
         $text .= $this->getID();
         $text .= date("d-m-Y", $this->getCurrentValue(false));
         $text .= "/>";
         return $text;
      }
   }

   /*
    *
    * @param
    * @return
    */
   function _colorTag() {
      $name = $this->getID();
      $dbvalue = $this->getCurrentValue(false);
      $dbvalue = $dbvalue == "" ? "000000" : $dbvalue;

      $text .= "<span style=\"background-color:#$dbvalue;border:1px solid black;height:25px\">";
      $text .= "<span id=\"ColorPreview_".$name."\" style=\"border:1px;height: 100%; width: 28px\">&nbsp;&nbsp;&nbsp;&nbsp;</span></span>";
      $text .= "&nbsp;#<input class='tbox' type=\"text\" name=\"".$name."[]\" id=\"".$name."\" value=\"".$dbvalue."\" size='15' onblur=\"e107HelperColor.view('".$name."',this.value)\" />
                &nbsp;<input class='button' type='button' value='".HELPER_LAN_04."' onclick='expandit(\"".$name."_color\")' />";

      $colors1 = array ("00", "22", "44", "66", "88", "AA", "CC", "EE");
      $colors2 = array ("00", "33", "66", "99", "CC", "FF");

      $text .= "<div style='display:none;' id='".$name."_color' onclick='this.style.display=\"none\"'>
          <table style='background-color:#000000;border:0px;cursor:pointer;' summary='Color palette'>";

      for ($i=0; $i<6; $i++ ) {
         for ($j=0; $j<6; $j+=2 ) {
            $text .= "<tr>";
            for ($k=0; $k<6; $k++ ) {
               $text .= "<td style='width:30px;height:10px;background-color:";
               $color = $colors2[$i].$colors2[$j].$colors2[$k];
               $text .= "#$color' onmouseover=\"e107HelperColor.view('".$name."','$color')\" onclick=\"e107HelperColor.set('".$name."','$color')\" ></td>";
               $text .= "<td style='width:30px;height:10px;background-color:";
               $color = $colors2[$i].$colors2[$j+1].$colors2[$k];
               $text .= "#$color' onmouseover=\"e107HelperColor.view('".$name."','$color')\" onclick=\"e107HelperColor.set('".$name."','$color')\" ></td>";
            }
            $text .= "</tr>";
         }
      }

      $text .= "</table></div>\n";
      return $text;
   }

   /*
    *
    * @param
    * @return
    */
   function _customFieldsTag() {
      global $e107Helper;
      if ($this->getCurrentValue(false) != "") {
         $customfields = new e107HelperCustomField($this->getCurrentValue(false), $this->getID());
      } else {
         $customfields = new e107HelperCustomField("", $this->getID());
      }
      $text = $this->_hiddenTag();
      $text .= "<div id='".$this->getID()."_".$this->_getIX()."_div' style='text-align:left;'>";
      $text .= $customfields->getFieldList($this->_getIX());
      $text .= "</div>";
      $text .= "<a href='javascript:e107HelperAjax.addCustomField(\"".e_PLUGIN."e107helpers/e107HelperAjax.php\", \"".$customfields->getID()."_".$this->_getIX()."\", 1)'>Add field</a>";
      $text .= "&nbsp;/&nbsp;<a href='javascript:e107HelperAjax.showCustomField(\"".e_PLUGIN."e107helpers/e107HelperAjax.php"."\", \"".$customfields->getID()."_".$this->_getIX()."\")'>Show fields</a>";
      $text .= "&nbsp;/&nbsp;<a href='javascript:e107HelperAjax.resetCustomField(\"".e_PLUGIN."e107helpers/e107HelperAjax.php"."\", \"".$customfields->getID()."_".$this->_getIX()."\")'>Reset fields</a>";
      return $text;
   }

   function _dirTag() {
      $savedValues = $this->_values;
      $folder = $this->getDir();
      $handle=opendir($folder);
      while ($file = readdir($handle)) {
         if (is_dir($folder.$file) && $file !='CVS' && $file != "." && $file != ".." && $file != "/" ) {
            $this->addValue($file);
         }
      }
      closedir($handle);
      $text = $this->_listTag();
      $this->_values = $savedValues;
      return $text;
   }

   function _fileTag() {
      $savedValues = $this->_values;
      $folder = $this->getDir();
      $handle=opendir($folder);
      while ($file = readdir($handle)) {
         if (!is_dir($folder.$file)) {
            if ($this->getNoPath()) {
               $this->addValue($file, $file);
            } else {
               $this->addValue($folder.$file, $file);
            }
         }
      }
      closedir($handle);
      $text = $this->_listTag();
      $this->_values = $savedValues;
      return $text;
   }

   function _hiddenTag() {
      $text = "<input type='hidden'";
      $text .= $this->_getAttributeSet();
      $text .= $this->getCurrentValue();
      $text .= "/>";
      return $text;
   }

   function _imageTag() {
      global $e107Helper;

      $nopath = $this->getNoPath();

      // Get the directory names to set the default
      preg_match("?".$this->getDir()."(.*)/.*\..*?", $this->getCurrentValue(false), $match);
      $currentFullDir = $this->getDir().$match[1];
      $currentSubDir = $match[1];

      // The text field to contain the image path
      $text .= "<input type='text'";
      $text .= $this->_getAttributeSet();
      $text .= $this->getCurrentValue();
      $text .= "/>";
      $text .= "&nbsp;&nbsp;<input type ='button' class='button' value='".HELPER_LAN_04."' onclick='expandit(\"".$this->getID("_box", false, true)."\")' />";

      // Select new directory for image set drop down
      $dirlist = $e107Helper->getDirList($this->getDir());
      if (count($dirlist) > 0) {
         $text .= "&nbsp;&nbsp;";
         $dirlisttag = new e107HelperTagObj("dirlist", $this->_formName);
         $dirlisttag->addAttribute("name", $this->_attributes["name"]."_dir");
         $dirlisttag->addAttribute("id", $this->_attributes["id"]."_dir");
         $dirlisttag->setDir($this->getDir());
         $dirlisttag->addCSSClass($this->_getClass(false));
         $dirlisttag->addJavaScript("change", "e107HelperAjax.refreshImageTag(this, \"".e_PLUGIN."e107helpers/e107HelperAjax.php\", \"".$this->getID("", false, true)."\", \"".$this->getDir()."\")");
         $dirlisttag->setDefault($currentSubDir);
         $text .= $dirlisttag->getTag();
      }

      // Div with images in for selection - selection populates text field with image, including pathe without e_IMAGE prefix
      $text .= "<div";
      $text .= $this->getID("_box", true, true);
      $text .= " style='display:none'>";
      $imagelist = $e107Helper->getFileList($currentFullDir);
      foreach ($imagelist as $key=>$image) {
         if ($nopath) {
            $temp = "{$image}";
         } else {
            $temp = "{$currentFullDir}{$image}";
         }
         $text .= "<a href='javascript:e107Helper.addTextToField(\"{$temp}\",\"".$this->getID("", false, true)."\")'>";
         $text .= "<img src='{$currentFullDir}/{$image}' style='border:0px' alt='*' /></a> ";
      }
      $text .= "</div>";
      return $text;
   }

   function _listTag() {
      $text .= "<select";
      $text .= $this->_getAttributeSet();
      $text .= ">";
      if ($this->_getListCallback()) {
         // Allow the application to set the values at runtime
         if ($this->_getListCallbackClass()) {
            if (eval("global "."$".$this->_getListCallbackClass().";return isset($".$this->_getListCallbackClass().");")) {
               // there is a global variable named after the class, call functions of that class to allow use of $this in callbacks
               $params = $this->_getParams();
               $this->_values = eval("global "."$".$this->_getListCallbackClass().";return $".$this->_getListCallbackClass()."->".$this->_getListCallback()."(\$params, \"".$this->getCurrentValue(false)."\");");
            } else {
               // No global, just call the method as a static function of the class
               $this->_values = call_user_func(array($this->_getListCallbackClass(), $this->_getListCallback()), $this->_getParams(), $this->getCurrentValue(false));
            }
         } else {
            $this->_values = call_user_func($this->_getListCallback(), $this->_getParams());
         }
      }
      $keys = array_keys($this->_values);
      $currentValues = explode(",", $this->getCurrentValue(false));
      if ($this->_includeBlank() !== false) {
         // need to include a 'blank' entry, if value is 'true' then the value really is blank
         // otherwise the 'blank' value is the supplied value from the include blank tag
         if ($this->_includeBlank == "true") {
            $text .= "<option value=''></option>";
         } else {
            $text .= "<option value='".$this->_includeBlank()."'></option>";
         }
      }
      foreach ($keys as $key) {
         $listValue = $listText = $this->_values[$key];
         if (is_array($this->_values[$key])) {
            $listValue = $this->_values[$key][0];
            $listText = $this->_values[$key][1];
         }
         $selected = "";
         for ($i=0; $i<count($currentValues); $i++) {
            if ($listValue == $currentValues[$i]) {
               $selected = " selected='true'";
               break;
            }
         }
         $text .= "<option value='$listValue'$selected>$listText</option>";
      }
      $text .= "</select>";
      return $text;
   }

   function _radioTag() {
      $sequence = 0;
      $id = $this->_attributes["id"];
      $keys = array_keys($this->_values);
      foreach ($keys as $key) {
         // Make sure id's are unique where they need to be (i.e. multiple fields with the same name such as radio buttons)
         $this->_attributes["id"] = $id."_".$sequence;
         $text .= "<label for='";
         $text .= $this->getID();
         $text .= "'>";
         $text .= "<input type='radio'";
         $text .= $this->_getAttributeSet();

         $radioValue = $radioText = $this->_values[$key];
         if (is_array($this->_values[$key])) {
            $radioValue = $this->_values[$key][0];
            $radioText = $this->_values[$key][1];
         }
         $text .= " value='$radioValue'";
         $checked = ($radioValue == $this->getCurrentValue(false)) ? " checked='true'" : "";
         $text .= "$checked/>$radioText</label> ";
         $text .= $this->getBreaks() ? "<br/>" : "";
         $sequence++;
      }
      $this->_attributes["id"] = $id;
      return $text;
   }

   function _tableTag() {
      global $sql;
      $savedValues = $this->_values;
      for ($i=0; $i<count($this->_values); $i++) {
         $query[$this->_values[$i][0]] = $this->_values[$i][1];
      }
      $this->_values = array();
      $where = $query["where"] ? "WHERE ".$query["where"] : "";
      $order = $query["order"] ? " ORDER BY ".$query["order"] : "";
      $limit = $query["limit"] ? " LIMIT ".$query["limit"] : "";
      $sql->db_Select($query["table"], $query["columns"], $where.$order.$limit, false);
      while(false !== $row = $sql->db_Fetch()) {
         $this->addValue($row[0], $row[1]);
      }
      $text = $this->_listTag();
      $this->_values = $savedValues;
      return $text;
   }

   function _textareaTag() {
      global $e107Helper;
      $text .= "<textarea";
      $text .= $this->_getAttributeSet();
      if ($this->_getBBCodes()) {
         $text .= " onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'";
      }
      $text .= ">";
      $text .= $this->getCurrentValue(false);
      $text .= "</textarea>";

      if ($this->_getBBCodes()) {
         if ($e107Helper->isV07()) {
            $text .= "<br/>".display_help($this->getName(), $this->_getBBCodes());
         } else {
            $text .= "<br/>".ren_help($this->_getBBCodes());
         }
      }
      if ($showEmotes) {
         $text .= r_emote();
      }
      return $text;
   }

   function _timeTag($isDatestamp) {
      $id = $this->_attributes["id"];
      $name = $this->_attributes["name"];
      if ($isDatestamp) {
         $time[0] = date("H", $this->getCurrentValue(false));
         $time[1] = date("i", $this->getCurrentValue(false));
      } else {
         $time    = explode(":", $this->getCurrentValue(false));
      }
      $this->_attributes["id"] = $id."_h";
      $this->_attributes["name"] = $name."_h";
      $text .= "<select";
      $text .= $this->_getAttributeSet();
      $text .= ">";
      for($i=0; $i<=23; $i++) {
         $selected = ($i==$time[0]) ? " selected" : "";
         if ($i < 10) {
            $text.= "<option value='0$i'$selected>0$i</option>";
         } else {
            $text.= "<option value='$i'$selected>$i</option>";
         }
      }
      $text.= "</select>&nbsp;:&nbsp;";

      $this->_attributes["id"] = $id."_m";
      $this->_attributes["name"] = $name."_m";
      $text .= "<select";
      $text .= $this->_getAttributeSet();
      $text .= ">";
      for($i=0; $i<=59; $i++) {
         $selected = ($i==$time[1]) ? " selected" : "";
         if ($i < 10) {
            $text.= "<option value='0$i'$selected>0$i</option>";
         } else {
            $text.= "<option value='$i'$selected>$i</option>";
         }
      }
      $text.= "</select>";
      $this->_attributes["id"] = $id;
      $this->_attributes["name"] = $name;
      return $text;
   }

   // *********************************************************************************************
   // Public helper methods
   // *********************************************************************************************

   /*
    * Check to see if this tag is part of a repeating group
    * @return true if tag is part of a repeating group
    */
   function isBatchTag() {
      global $pref;
      return varset($pref[$this->_attributes["id"]."_pref"], $this->_batchTag);
   }

   /*
    * Check to see if the tag has an error associated with it.
    * @return true if tag is in error
    */
   function isInError() {
      return strlen($this->_message[$this->_getIX()]);
   }

   // *********************************************************************************************
   // Validation methods
   // *********************************************************************************************

   /**
    * Validates a tags value
    * <p>Validation consists of the following, in order:</p>
    * <ul>
    * <li>Check for manadory values</li>
    * <li>Specific validation for the tag type (e.g. decimal, numeric, etc.)</li>
    * <li>Common optional validation as defined for the instance of the tag (e.g. minimum length, maximum value)</li>
    * </ul>
    * @param   integer  the mode the form is in
    * @return  true if all performed validation is successful, otherwise false
    */
   function validate($formmode) {
      if ($this->_logger->isTrace()) {
         $this->_logger->trace(HELPER_LOGGER_METHOD_ENTRY, "validate()");
      }

      $value = $this->getCurrentValue(false);
      if ($this->_logger->isDebug()) {
         $this->_logger->debug("validate()", $this->_label."(".$this->getID().") = $value<br>");
      }

      // Simple validation
      if ($this->getMandatory() && (!isset($value) || !strlen($value))) {
         $this->_message[$this->_getIX()] = $this->_formatMessage(HELPER_LAN_ERR_VAL_02);
         return false;
      }

      // Tag type validation - this validation is specific to the type
      $func = "validateTag_".$this->_tagType;
      if (method_exists(new e107HelperTagObj(), $func)) {
         $ret = $this->$func($value, $formmode);
         if (!$ret) {
            return $ret;
         }
      }

      // Common validation
      if ($this->_getMinLen() && (strlen($value) < $this->_getMinLen())) {
         $this->_message[$this->_getIX()] = $this->_formatMessage(HELPER_LAN_ERR_VAL_03, array("min"=>$this->_getMinLen()));
         return false;
      }

      if ($this->_getMaxLen() && (strlen($value) > $this->_getMaxLen())) {
         $this->_message[$this->_getIX()] = $this->_formatMessage(HELPER_LAN_ERR_VAL_04, array("max"=>$this->_getMaxLen()));
         return false;
      }

      if ($this->_getMinVal() && ($value < $this->_getMinVal())) {
         $this->_message[$this->_getIX()] = $this->_formatMessage(HELPER_LAN_ERR_VAL_05, array("min"=>$this->_getMinVal()));
         return false;
      }

      if ($this->_getMaxVal() && ($value > $this->_getMaxVal())) {
         $this->_message[$this->_getIX()] = $this->_formatMessage(HELPER_LAN_ERR_VAL_06, array("max"=>$this->_getMaxVal()));
         return false;
      }

      if ($this->_logger->isTrace()) {
         $this->_logger->trace(HELPER_LOGGER_METHOD_EXIT, "validate()");
      }
      return true;
   }

   /**
    * Validates an HTML color value
    * <p>Valid HTML colour values are 6 characters long strings consisting of A-F, a-f or 0-9.</p>
    * @param   string   the colour value to be validated
    * @param   integer  the mode the form is in
    * @return           true if the value is valid, otherwise false
    */
   function validateTag_color($value, $formmode) {
      if (!preg_match("%"."([A-Fa-f0-9]{6,6})"."%", $value)) {
         $this->_message[$this->_getIX()] = $this->_formatMessage(HELPER_LAN_ERR_VAL_COLOR_01);
         return false;
      }
      return true;
   }

   /**
    * Validates a decimal value.
    * <p>Valid decimals are optional +/- followed by digits 0-9 followed by optional decimal point
    * and futher digits 0-9.</p>
    * @param   string   the value to be validated
    * @param   integer  the mode the form is in
    * @return           true if the value is valid, otherwise false
    */
   function validateTag_decimal($value, $formmode) {
      if (!ereg("^[+-]?[0-9]*\.?[0-9]+$", $value)) {
         $this->_message[$this->_getIX()] = $this->_formatMessage(HELPER_LAN_ERR_VAL_DECIMAL_01);
         return false;
      }
      return true;
   }

   /**
    * Validates a integer value
    * <p>Valid integers are optional +/- followed by digits 0-9.</p>
    * @param   string   the value to be validated
    * @param   integer  the mode the form is in
    * @return           true if the value is valid, otherwise false
    */
   function validateTag_integer($value, $formmode) {
      if (!ereg("^[+-]?[0-9]*$", $value)) {
         $this->_message[$this->_getIX()] = $this->_formatMessage(HELPER_LAN_ERR_VAL_INTEGER_01);
         return false;
      }
      return true;
   }

   /**
    * Validates a numeric value
    * <p>Valid numeric values are digits 0-9.</p>
    * @param   string   the value to be validated
    * @param   integer  the mode the form is in
    * @return           true if the value is valid, otherwise false
    */
   function validateTag_numeric($value, $formmode) {
      if (!ereg("^[0-9]*$", $value)) {
         $this->_message[$this->_getIX()] = $this->_formatMessage(HELPER_LAN_ERR_VAL_NUMERIC_01);
         return false;
      }
      return true;
   }

   /**
    * Validates an upload file
    * @param   string   ignored
    * @param   integer  the mode the form is in
    * @return           true if the value is valid, otherwise false
    */
   function validateTag_file($value, $formmode) {
      global $pref;
      if ($formmode != HELPER_FORM_MODE_DB_UPDATE) {
         $tempfile = $_FILES[$this->getName()]['tmp_name'][$this->_getIX()];
         $filename = strtolower($_FILES[$this->getName()]['name'][$this->_getIX()]);
         $filetype = strtolower($_FILES[$this->getName()]['type'][$this->_getIX()]);
         $filesize = $_FILES[$this->getName()]['size'][$this->_getIX()];
         if (strlen($tempfile) == 0) {
            $this->_message[$this->_getIX()] = $this->_formatMessage(HELPER_LAN_ERR_VAL_UPLOAD_03);
            return false;
         }
         if ($filesize == 0) {
            $this->_message[$this->_getIX()] = $this->_formatMessage(HELPER_LAN_ERR_VAL_UPLOAD_04);
            return false;
         }
   		if (isset($pref['upload_maxfilesize']) && is_numeric($pref['upload_maxfilesize']) && $filesize > $pref['upload_maxfilesize']) {
            $this->_message[$this->_getIX()] = $this->_formatMessage(str_replace("{SIZELIMIT}", $pref['upload_maxfilesize'], HELPER_LAN_ERR_VAL_UPLOAD_07));
            return false;
   		}
         if (is_readable(e_ADMIN.'filetypes.php')) {
            $a_filetypes = trim(file_get_contents(e_ADMIN.'filetypes.php'));
            $a_filetypes = explode(',', $a_filetypes);
            foreach ($a_filetypes as $ftype) {
               $allowed_filetypes[] = '.'.strtolower(trim(str_replace('.', '', $ftype)));
            }
            $fileext1 = substr(strrchr($filename, "."), 1);
            $fileext2 = substr(strrchr($filename, "."), 0); // in case user has left off the . in allowed_filetypes
            if (!in_array($fileext1, $allowed_filetypes) && !in_array($filetype, $allowed_filetypes)) {
               if (!in_array($fileext2, $allowed_filetypes) && !in_array($filetype, $allowed_filetypes)) {
                  $this->_message[$this->_getIX()] = $this->_formatMessage(HELPER_LAN_ERR_VAL_UPLOAD_05." $fileext1 ($filetype) ".HELPER_LAN_ERR_VAL_UPLOAD_06);
                  return false;
               }
            }
         }
      }
      return true;
   }

   /**
    * Porcess an upload file tag
    */
   function processTag_file($formmode) {
      if ($formmode != HELPER_FORM_MODE_DB_UPDATE) {
         $tempfile = $_FILES[$this->getName()]['tmp_name'][$this->_getIX()];
         $tempfilename = $_FILES[$this->getName()]['name'][$this->_getIX()];
         if (is_uploaded_file($tempfile)) {
            $file = $this->getDir().ereg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", $tempfilename)));
            $file = $this->getDir().$tempfilename;
            if (move_uploaded_file($tempfile, $file)) {
               $this->setDefault($file);
               return true;
            } else {
               $this->_message[$this->_getIX()] = $this->_formatMessage(HELPER_LAN_ERR_VAL_UPLOAD_02);
               return false;
            }
         } else {
            $this->_message[$this->_getIX()] = $this->_formatMessage(HELPER_LAN_ERR_VAL_UPLOAD_01);
            return false;
         }
      }
      return true;
   }

   // *********************************************************************************************
   // Private Helper methods
   // *********************************************************************************************

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _getBBCodes() {
      return $this->_bbcodes;
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _isClassOmitted($class) {
      return in_array($class, $this->_omittedClasses);
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _getCallback() {
      return $this->_callback;
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _getCallbackClass() {
      return $this->_callbackClass;
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _getListCallback() {
      return $this->_listCallback;
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _getListCallbackClass() {
      return $this->_listCallbackClass;
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _getCustomHTML() {
      return $this->_html;
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _getParams() {
      return $this->_params;
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _getClass($asAtt=true) {
      if (strlen($this->_class) > 0) {
         if ($asAtt) {
            return " class='".$this->_class."'";
         } else {
            return $this->_class;
         }
      }
      return "";
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _getAttributes() {
      $text = "";
      $keys = array_keys($this->_attributes);
      foreach ($keys as $key) {
         if (in_array($this->_tagType, array("list", "table")) && $key == "name" && isset($this->_attributes["multiple"])) {
            $text .= " $key='".$this->_attributes[$key]."[".$this->_getIX()."][]'";
         } else if (in_array($key, array("name"))) {
            $text .= " $key='".$this->_attributes[$key]."[".$this->_getIX()."]'";
         } else if (in_array($key, array("id"))) {
            $text .= " $key='".$this->_attributes[$key]."_".$this->_getIX()."'";
         } else {
            $text .= " $key='".$this->_attributes[$key]."'";
         }
      }
      return $text;
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _getStyles() {
      if (count($this->_styles) == 0) {
         // No style attributes, return empty string
         return "";
      }
      $text = " style='";
      $keys = array_keys($this->_styles);
      foreach ($keys as $key) {
         $text .= "$key:".$this->_styles[$key].";";
      }
      $text .= "'";
      return $text;
   }

   /*
    * Get the javascript evetn attributes for a tag
    * @return  stringjavascript event attributes for a tag
    * @access private
    */
   function _getJavaScript() {
      $text = "";
      $text .= strlen($this->_load)       ? " onload='".$this->_load             ."'" : "";
      $text .= strlen($this->_unload)     ? " onunload='".$this->_unload         ."'" : "";
      $text .= strlen($this->_click)      ? " onclick='".$this->_click           ."'" : "";
      $text .= strlen($this->_dblclick)   ? " ondblclick='".$this->_dblclick     ."'" : "";
      $text .= strlen($this->_mousedown)  ? " onmousedown='".$this->_mousedown   ."'" : "";
      $text .= strlen($this->_mouseup)    ? " onmouseup='".$this->_mouseup       ."'" : "";
      $text .= strlen($this->_mouseover)  ? " onmouseover='".$this->_mouseover   ."'" : "";
      $text .= strlen($this->_mousemove)  ? " onmousemove='".$this->_mousemove   ."'" : "";
      $text .= strlen($this->_mouseout)   ? " onmouseout='".$this->_mouseout     ."'" : "";
      $text .= strlen($this->_focus)      ? " onfocus='".$this->_focus           ."'" : "";
      $text .= strlen($this->_blur)       ? " onblur='".$this->_blur             ."'" : "";
      $text .= strlen($this->_keypress)   ? " onkeypress='".$this->_keypress     ."'" : "";
      $text .= strlen($this->_keydown)    ? " onkeydown='".$this->_keydown       ."'" : "";
      $text .= strlen($this->_keyup)      ? " onkeyup='".$this->_keyup           ."'" : "";
      $text .= strlen($this->_submit)     ? " onsubmit='".$this->_submit         ."'" : "";
      $text .= strlen($this->_reset)      ? " onreset='".$this->_reset           ."'" : "";
      $text .= strlen($this->_select)     ? " onselect='".$this->_select         ."'" : "";
      $text .= strlen($this->_change)     ? " onchange='".$this->_change         ."'" : "";
      return $text;
   }

   /**
    * Gets the value of the tag as submitted by the user.
    * <p>Takes in to account multi-part tags such as date fields and non-submitted tags such as unchecked checkboxes.</p>
    * @return  the user inputted value of the tag
    * @access private
    */
   function _getUserInput() {
      global $e107Helper;

      if ($this->_logger->isTrace()) {
         $this->_logger->trace(HELPER_LOGGER_METHOD_ENTRY, "_getUserInput()");
      }

      $name = $this->getName();
      if ($this->_logger->isDebug()) {
         $this->_logger->debug(HELPER_LOGGER_VARIABLE_VALUE, "name=$name");
      }

      // Get the value to save references to the $_REQUEST superglobal
      $formvalue = $_REQUEST[$name][$this->_getIX()];
      //debug($formvalue);
      switch ($this->_tagType) {
         case "calendar" :
            $year  = substr($formvalue, 6, 4);
            $month = substr($formvalue, 3, 2);
            $day   = substr($formvalue, 0, 2);
            $value = mktime(0,0,0,$month,$day,$year);
            break;
         case "calendartime" :
            $year  = substr($formvalue, 6, 4);
            $month = substr($formvalue, 3, 2);
            $day   = substr($formvalue, 0, 2);
            $hours = $_REQUEST[$name."_h"][$this->_getIX()];
            $mins  = $_REQUEST[$name."_m"][$this->_getIX()];
            $value = mktime($hours,$mins,0,$month,$day,$year);
            break;
         case "date" :
         case "datestamp" :
            $year  = $name."_year";
            $month = $name."_month";
            $day   = $name."_day";

            if ($type == "date") {
               $value = $_REQUEST[$year][$this->_getIX()]."-".$_REQUEST[$month][$this->_getIX()]."-".$_REQUEST[$day][$this->_getIX()];
              } else {
               $value = mktime(0,0,0,$_REQUEST[$month][$this->_getIX()],$_REQUEST[$day][$this->_getIX()],$_REQUEST[$year][$this->_getIX()]);
              }
              break;
         case "diarycode" :
            $p1 = $_REQUEST[$name."_0"][$this->_getIX()];
            $p2 = $_REQUEST[$name."_1"][$this->_getIX()];
            $p3 = $_REQUEST[$name."_2"][$this->_getIX()];
            $value = "$p1$p2$p3";
            break;
         case "file" :
            if (isset($_FILES[$name]["name"][$this->_getIX()])) {
               if ($this->getNoPath()) {
                  $value = $_FILES[$this->_attributes["name"]]["name"][$this->_getIX()];
               } else {
                  $value = $this->getDir().$_FILES[$this->_attributes["name"]]["name"][$this->_getIX()];
               }
            } else {
               $value = $_REQUEST[$name][$this->_getIX()];
            }
            break;
         case "list" :
            // TODO - fix multi select lists for batch forms
            //if (isset($this->_attributes["multiple"])) {
            //   $formvalue = $_REQUEST[$name];
            //}
            if (is_array($formvalue)) {
               $value = implode(",", $formvalue);
            } else {
               $value = $e107Helper->tp_toDB($formvalue);
            }
            break;
         case "time" :
            $value = $_REQUEST[$name."_h"][$this->_getIX()].":".$_REQUEST[$name."_m"][$this->_getIX()];
            break;
         default: {
            if (is_array($formvalue)) {
               $value = implode(",", $formvalue);
            } else {
               $value = $e107Helper->tp_toDB($formvalue);
            }
         }
      }

      if ($this->_logger->isTrace()) {
         $this->_logger->trace(HELPER_LOGGER_METHOD_EXIT, "_getUserInput()");
         $this->_logger->trace(HELPER_LOGGER_METHOD_RETURN, $value);
      }
      //debug($value);
      return $value;
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _getMaxLen() {
      return $this->_maxLen == "" ? false : $this->_maxLen;
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _getMaxVal() {
      return $this->_maxVal == "" ? false : $this->_maxVal;
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _getMinLen() {
      return $this->_minLen == "" ? false : $this->_minLen;
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _getMinVal() {
      return $this->_minVal == "" ? false : $this->_minVal;
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _getDateFormat() {
      return $this->_dateFormat == "" ? false : $this->_dateFormat;
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _includeBlank() {
      return $this->_includeBlank;
   }

   function _formatMessage($msgText, $params) {
      $keys = array_keys($params);
      foreach ($keys as $key) {
         $msgText = str_replace("<$key>", $params[$key], $msgText);
      }
      return $msgText;
   }
}
?>