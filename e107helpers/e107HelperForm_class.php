<?php
/**
 * e107 Form Helper class
 * <b>CVS Details:</b>
 * <ul>
 * <li>$Source: e:\_repository\e107_plugins/e107helpers/e107HelperForm_class.php,v $</li>
 * <li>$Date: 2008/05/29 22:04:28 $</li>
 * </ul>
 * @author     $Author: Neil $
 * @version    $Revision: 1.12.2.3 $
 * @copyright  Released under the terms and conditions of the GNU General Public License (http://gnu.org).
 * @package e107HelperForm
 */

/**
 * A Helper class for the e107 CMS system.
 * <p>Aimed at providing methods for creating standard HTML form components.</p>
 * <p>In addition, e107 specific form components (e.g. User Class list) and customized tags (e.g. colour selection pallette) are supported.</p>
 * @package    e107HelperForm
 */
class e107HelperForm {
   /**#@+
    * @access private
    */
   var $_version;                // Form version number
   var $_tags;                   // Array of tag objects
   var $_hiddenTags;             // Array of tag objects
   var $_numTags;                // Number of tag objects currently held

   var $_formTag;                // Opening form tag
   var $_formName;               // Name of the form we are processing
   var $_formType;               // Type of the form we are processing
   var $_formMode;               // The mode (create, edit, etc.) the form is currently being processed for
   var $_formError;              // Boolean flag indicating if the form is in error post submission
   var $_formErrorTop;           // Show form errors at top of form (true) or against each field (false)
   var $_formHTML;               // The entire form HTML
   var $_batchMode;              // Is the form a batch form (repeating fields?) - actually the numnber of repeats of the form, default is 1

   var $_tableStart;             // table style (table HTML tag)

   var $_errorClass;             // error text CSS class
   var $_helpClass;              // help text CSS class
   var $_labelClass;             // label text CSS class
   var $_messageClass;           // message text CSS class
   var $_promptClass;            // prompt text CSS class
   var $_submitStyle;            // style attributes for submit buttons

   var $_errorPrefix;            // Marker text to display before an error message
   var $_prettyPrint;            // newlines character for nice output
   var $_logger;                 // A reference to the logging object

   var $_xmlTag;                 // Current XML tag being processed
   var $_xmlName;                // Name of the current XML tag (== pref or DB column name)
   var $_xmlStyle;               // Name of the current style attribute being processed
   var $_xmlAttribute;           // Name of the current attribute being processed
   var $_xmlDefault;             // Default field value
   var $_xmlKey;                 // Key part of a value when set as a name/value pair (e.g. for OPTION tags)
   var $_xmlEvent;               // Name of the current event being processed
   var $_xmlParam;               // Name of parameter for the callback function
   var $_xmlClass;               // Class for the callback function

   var $_dbFormatCallback;       // User callback function for formatting string
   var $_dbFormatCallbackClass;  // User callback function for formatting string
   var $_dbPrintPageFunc;        // User function for item print page
   var $_dbPrintPageURL;       // User class for item print page
   var $_dbWhereCallback;        // User callback function for DB query
   var $_dbWhereCallbackClass;   // User callback function for DB query
   var $_dbWhereParam;           // User callback function for DB query
   var $_dbData;                 // Database data column(s) to be read for selection list
   var $_dbIndex;                // Database index column used for updates/deletes
   var $_dbIndexValue;           // Database index value used for updates/deletes
   var $_dbOrder;                // Database order for selection list
   var $_dbPattern;              // PHP code to generate string for selection list
   var $_dbStyle;                // Database selection list style
   var $_dbTable;                // Database table to be read/updated
   var $_dbJoin;                 // Database join SQL
   var $_dbWhere;                // Database where clause
   /**#@-*/

   /**
    * Constructor : creates an instance of an e107 Helper Form and initializes private variables
    */
   function __construct() {
      global $pref;
      $this->_logger                = $GLOBALS["e107HelperLoggerFactory"]->getLogger(get_class($this));
      $this->_tags                  = array();
      $this->_hiddenTags            = array();
      $this->_numTags               = 0;
      $this->_formTag               = "";
      $this->_formName              = "";
      $this->_formType              = "";
      $this->_formError             = false;
      $this->_formErrorTop          = false;
      $this->_formHTML              = "";
      $this->_batchMode             = 1;
      $this->_tableStart            = "<table style='width:100%' class='fborder' summary='Input form'>";
      $this->_errorClass            = $pref["helper_style_error_class"];
      $this->_helpClass             = $pref["helper_style_help_class"];
      $this->_labelClass            = $pref["helper_style_label_class"];
      $this->_messageClass          = $pref["helper_style_message_class"];
      $this->_promptClass           = $pref["helper_style_prompt_class"];
      $this->_submitStyle           = $pref["helper_style_submit_style"];
      $this->_errorPrefix           = "* ";
      $this->_prettyPrint           = "\n";
      $this->_xmlTag                = "";
      $this->_xmlName               = "";
      $this->_xmlStyle              = "";
      $this->_xmlAttribute          = "";
      $this->_xmlDefault            = "";
      $this->_xmlKey                = "";
      $this->_xmlEvent              = "";
      $this->_xmlParam              = "";
      $this->_xmlClass              = "";
      $this->_dbFormatCallback      = false;
      $this->_dbFormatCallbackClass = false;
      $this->_dbPrintPageURL        = false;
      $this->_dbWhereCallback       = false;
      $this->_dbWhereCallbackClass  = false;
      $this->_dbWhereParam          = "";
      $this->_dbData                = "";
      $this->_dbIndex               = "";
      $this->_dbIndexValue          = "";
      $this->_dbId                  = "";
      $this->_dbOrder               = "";
      $this->_dbPattern             = "";
      $this->_dbStyle               = "";
      $this->_dbTable               = "";
      $this->_dbWhere               = false;
   }

   // *********************************************************************************************
   // Public creation methods
   // *********************************************************************************************

   /**
    * Creates a form tag from an XML form definition.
    * <p>This method must be called to eanble the form to be correctly built, validated and submitted.</p>
    * <p>It is normally the first method to be called when creating a form using PHP calls.</p>
    * @param string  relative file path and name of the XML file defining the form to create
    * @see processForm()
    * @see getFormHTML()
    */
   function createFormFromXML($xmlFile) {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);
      $xml_parser = xml_parser_create();
      xml_set_object($xml_parser, $this);
      xml_set_element_handler($xml_parser, "startElement", "endElement");
      xml_set_character_data_handler($xml_parser, "cdata");

      if (false != $data = file_get_contents($xmlFile.".xml")) {
         if (!xml_parse($xml_parser, $data, true)) {
             die(sprintf("XML error (%d) : %s at line %d column %d",
                         xml_get_error_code($xml_parser),
                         xml_error_string(xml_get_error_code($xml_parser)),
                         xml_get_current_line_number($xml_parser),
                         xml_get_current_column_number($xml_parser)
                         )
                         );
         }
      } else {
         die("could not open XML input file : ".$xmlFile.".xml");
      }
      xml_parser_free($xml_parser);
      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
   }

   function _translateValue($att, $convert=true) {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);
      if (defined($att)) {
         $att = constant($att);
      }

      // Look for contstant within text, surrounded by { and }
      if (preg_match_all("/{\w*}/", $att, $match)) {
         while (count($match[0]) > 0) {
            $s = array_pop($match[0]);
            $r = substr($s, 1, -1);
            if ($r == "THIS_ID") {
               $att = str_replace($s, $this->_getDBIndexValue(), $att);
            } else if (defined($r)) {
               $att = str_replace($s, constant($r), $att);
            }
         }
      }
      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
      return $convert ? strtolower($att) : $att;
   }

   function startElement($parser, $tag, $attrs) {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);
      global $pref;
      //print "<br>";
      //print "$tag<br>";
      //print_r($attrs);
      //print "<br>";
      $tag = strtolower($tag);
      switch ($tag) {
         case "e107helperform" : {
            $this->_version = $this->_translateValue($attrs["VERSION"]);
            break;
         }
         case "form" : {
            $name    = $this->_translateValue($attrs["NAME"]);
            $type    = $this->_translateValue($attrs["TYPE"]);
            $action  = $this->_translateValue($attrs["ACTION"]);
            $method  = $this->_translateValue($attrs["METHOD"]);
            $target  = $this->_translateValue($attrs["TARGET"]);
            $enctype = $this->_translateValue($attrs["ENCTYPE"]);
            $this->createForm($name, $type, $action, $method, $target, $enctype);
            break;
         }
         case "batch" : {
            $this->_batchMode = $this->_translateValue(varset($pref[$attrs["PREFNAME"]], $attrs["OCCURS"]));
            $name    = HELPER_ID_BATCH_GROUP;
            $type    = "batchitemstart";
            $label   = "";
            $prompt  = "";
            $help    = HELPER_LAN_16;
            $class   = $this->_translateValue($attrs["CLASS"], false);
            $type = $type=="" ? $tag : $type;
            $this->createTag($name, $type, $label, $prompt, $help, $class);
            $this->addEvent($name, "click", "expandit('".HELPER_ID_BATCH_GROUP."_div{ITEMNO}')");
            $this->addStyle($name, "cursor", "pointer");
            $this->_xmlName = $attrs["NAME"];
            $this->_xmlTag = $this->_translateValue($tag, false);
            break;
         }
         case "batchcount" : {
            $name    = $this->_translateValue($attrs["NAME"], false);
            $type    = "integer";
            $label   = HELPER_LAN_BATCH_1;
            $prompt  = HELPER_LAN_BATCH_2;
            $help    = HELPER_LAN_BATCH_3;
            $class   = $this->_translateValue($attrs["CLASS"], false);
            $type = $type=="" ? $tag : $type;
            $this->createTag($name, $type, $label, $prompt, $help, $class);
            $this->setMandatory($name, "true");
            $this->setMinValue($name, "1");
            $this->addAttribute($name, "size", "3");
            $this->setDefault($name, "1");
            $this->_xmlName = $attrs["NAME"];
            $this->_xmlTag = $this->_translateValue($tag, false);
            break;
         }
         case "errorsattop" : {
            $this->setErrorsAtTop($attrs["VALUE"]);
            break;
         }
         // Let all button tags fall through to the generic button tag handler
         case "button" :
         case "submit" :
         {
            $name    = $this->_translateValue($attrs["NAME"]);
            $type    = $this->_translateValue($attrs["TYPE"]);
            $label   = $this->_translateValue($attrs["LABEL"], false);
            $prompt  = $this->_translateValue($attrs["PROMPT"], false);
            $help    = $this->_translateValue($attrs["HELP"], false);
            $class   = $this->_translateValue($attrs["CLASS"], false);
            $type = $type=="" ? $tag : $type;
            //print "..$name, $type, $label, $prompt, $help, $class<br>";
            $this->createButtonTag($name, $type, $label, $prompt, $help, $class);
            $this->_xmlName = $name;
            $this->_xmlTag = $this->_translateValue($tag, false);
            break;
         }
         // Let all tags fall through to the generic tag handler
         case "accesstable" :
         case "autotext" :
         case "button" :
         case "calendar" :
         case "calendartime" :
         case "checkbox" :
         case "color" :
         case "customfields" :
         case "decimal" :
         case "dirlist" :
         case "duallist" :
         case "dualtable" :
         case "file" :
         case "filelist" :
         case "hidden" :
         case "image" :
         case "integer" :
         case "list" :
         case "numeric" :
         case "radio" :
         case "submit" :
         case "table" :
         case "tag" :
         case "text" :
         case "textarea" :
         case "time" :
         {
            $name    = $this->_translateValue($attrs["NAME"]);
            $type    = $this->_translateValue($attrs["TYPE"]);
            $label   = $this->_translateValue($attrs["LABEL"], false);
            $prompt  = $this->_translateValue($attrs["PROMPT"], false);
            $help    = $this->_translateValue($attrs["HELP"], false);
            $class   = $this->_translateValue($attrs["CLASS"], false);
            $type = $type=="" ? $tag : $type;
            //print "..$name, $type, $label, $prompt, $help, $class<br>";
            $this->createTag($name, $type, $label, $prompt, $help, $class);
            $this->_xmlName = $name;
            $this->_xmlTag = $this->_translateValue($tag, false);
            break;
         }
         // Let all static tags fall through to the generic static tag handler
         case "div" :
         case "notelist" :
         case "p" :
         case "span" :
         case "statictag" :
         {
            $name    = $this->_translateValue($attrs["NAME"]);
            $type    = $this->_translateValue($attrs["TYPE"]);
            $text    = $this->_translateValue($attrs["TEXT"], false);
            $class   = $this->_translateValue($attrs["CLASS"], false);
            $type = $type=="" ? $tag : $type;
            //print "..$name, $type, $text, $class<br>";
            $this->createStaticTag($name, $type, $text, $class);
            $this->_xmlName = $attrs["NAME"];
            $this->_xmlTag = $this->_translateValue($tag, false);
            break;
         }
         case "attribute" : {
            $this->_xmlAttribute = $attrs["NAME"];
            $this->_xmlTag = $tag;
            break;
         }
         case "style" : {
            $this->_xmlStyle = $attrs["NAME"];
            $this->_xmlTag = $this->_translateValue($tag, false);
            break;
         }
         case "default" : {
            $var = $this->_translateValue($attrs["VAR"]);
            if ($var != "e107pref") {
               $this->_xmlDefault = $attrs["VAR"];
            }
            $this->_xmlTag = $this->_translateValue($tag, false);
            break;
         }
         case "value" : {
            $this->_xmlKey = $this->_translateValue($attrs["KEY"], false);
            $this->_xmlTag = $this->_translateValue($tag, false);
            break;
         }
         case "event" : {
            $this->_xmlEvent = $attrs["NAME"];
            $this->_xmlTag = $this->_translateValue($tag, false);
            break;
         }
         case "callback" : {
            $this->_xmlClass = $attrs["CLASS"];
            $this->_xmlTag = $this->_translateValue($tag, false);
            break;
         }
         case "listcallback" : {
            $this->_xmlClass = $attrs["CLASS"];
            $this->_xmlTag = $this->_translateValue($tag, false);
            break;
         }
         case "callbackparam" : {
            $this->_xmlParam = $attrs["NAME"];
            $this->_xmlTag = $this->_translateValue($tag, false);
            break;
         }
         case "dbwherecallback" : {
            $this->_xmlClass = $attrs["CLASS"];
            $this->_xmlParam = $attrs["PARAM"];
            $this->_xmlTag = $this->_translateValue($tag, false);
            break;
         }
         case "dbformatcallback" : {
            $this->_xmlClass = $attrs["CLASS"];
            $this->_xmlTag = $this->_translateValue($tag, false);
            break;
         }
         case "dbprintpageurl" : {
            $this->_xmlTag = $this->_translateValue($tag, false);
            break;
         }
         default : {
            $this->_xmlTag = $this->_translateValue($tag, false);
            break;
         }
      }
      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
   }

   function endElement($parser, $name) {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);
      $this->_xmlTag = "";
      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
   }

   function cdata($parser, $cdata) {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);
      global $pref;
      if (strlen($cdata)==0) {
//         return;
      }
      $cdata = $this->_translateValue($cdata, false);
      //if (strlen($this->_xmlTag) > 0) debug($this->_xmlName." ".$this->_xmlTag."..".$this->_xmlName." $cdata");
      switch ($this->_xmlTag) {
         case "dbformatcallback" : {
            $this->setDBFormatCallback($this->_xmlClass, $cdata);
            break;
         }
         case "dbprintpageurl" : {
            $this->setDBPrintPageURL($cdata);
            break;
         }
         case "dbwherecallback" : {
            $this->setDBWhereCallback($this->_xmlClass, $this->_xmlParam, $cdata);
            break;
         }
         case "dbtable" : {
            $this->setDBTable($this->_translateValue($cdata, false));
            break;
         }
         case "index" : {
            $this->setDBIndex($this->_translateValue($cdata, false));
            break;
         }
         case "data" : {
            $this->setDBData($this->_translateValue($cdata, false));
            break;
         }
         case "join" : {
            $this->setDBJoin($this->_translateValue($cdata, false));
            break;
         }
         case "where" : {
            $this->setDBWhere($this->_translateValue($cdata, false));
            break;
         }
         case "order" : {
            $this->setDBOrder($this->_translateValue($cdata, false));
            break;
         }
         case "pattern" : {
            $this->setDBPattern($this->_translateValue($cdata, false));
            break;
         }
         case "liststyle" : {
            $this->setDBStyle($this->_translateValue($cdata, false));
            break;
         }
         case "help" : {
            $this->setHelpClass($this->_translateValue($cdata, false));
            break;
         }
         case "prompt" : {
            $this->setPromptClass($this->_translateValue($cdata, false));
            break;
         }
         case "label" : {
            $this->setLabelClass($this->_translateValue($cdata, false));
            break;
         }
         case "default" : {
            $this->setDefault($this->_xmlName, $this->_translateValue($cdata, false));
            break;
         }
         case "callback" : {
            $this->setCallback($this->_xmlName, $this->_xmlClass, $cdata);
            break;
         }
         case "listcallback" : {
            $this->setListCallback($this->_xmlName, $this->_xmlClass, $cdata);
            break;
         }
         case "callbackparam" : {
            $this->setCallbackParam($this->_xmlName, $this->_xmlParam, $this->_translateValue($cdata, false));
            break;
         }
         case "breaks" : {
            $this->setBreaks($this->_xmlName, $this->_translateValue($cdata, false));
            break;
         }
         case "nopath" : {
            $this->setNoPath($this->_xmlName, $this->_translateValue($cdata, false));
            break;
         }
         case "dir" : {
            $this->setDir($this->_xmlName, $this->_translateValue($cdata, false));
            break;
         }
         case "subdir" : {
            $this->setSubDir($this->_xmlName, $this->_translateValue($cdata, false));
            break;
         }
         case "mandatory" : {
            $this->setMandatory($this->_xmlName, $this->_translateValue($cdata, false));
            break;
         }
         case "minlength" : {
            $this->setMinLength($this->_xmlName, $this->_translateValue($cdata, false));
            break;
         }
         case "maxlength" : {
            $this->setMaxLength($this->_xmlName, $this->_translateValue($cdata, false));
            break;
         }
         case "minvalue" : {
            $this->setMinValue($this->_xmlName, $this->_translateValue($cdata, false));
            break;
         }
         case "maxvalue" : {
            $this->setMaxValue($this->_xmlName, $this->_translateValue($cdata, false));
            break;
         }
         case "includeblank" : {
            $this->setIncludeBlank($this->_xmlName, $this->_translateValue($cdata, false));
            break;
         }
         case "attribute" : {
            $this->addAttribute($this->_xmlName, $this->_xmlAttribute, $this->_translateValue($cdata, false));
            break;
         }
         case "style" : {
            $this->addStyle($this->_xmlName, $this->_xmlStyle, $this->_translateValue($cdata, false));
            break;
         }
         case "event" : {
            $this->addEvent($this->_xmlName, $this->_xmlEvent, $this->_translateValue($cdata, false));
            break;
         }
         case "paragraph" : {
            $this->addParagraphText($this->_xmlName, $this->_translateValue($cdata, false));
            break;
         }
         case "dateformat" : {
            $this->addDateFormat($this->_xmlName, $this->_translateValue($cdata, false));
            break;
         }
         case "bbcodes" : {
            $this->setBBCodes($this->_xmlName, $this->_translateValue($cdata, false));
            break;
         }
         case "omitclass" : {
            $this->omitClass($this->_xmlName, $this->_translateValue($cdata, false));
            break;
         }
         case "value" : {
            if (strlen($this->_xmlKey) > 0) {
               $this->addValue($this->_xmlName, $this->_xmlKey, $this->_translateValue($cdata, false));
               $this->_xmlKey = "";
            } else {
               $this->addValue($this->_xmlName, $this->_translateValue($cdata, false));
            }
            break;
         }
         default : {
            break;
         }
      }
      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
   }

   /**
    * Creates a form tag.
    * <p>This method must be called to eanble the form to be correctly built, validated and submitted.</p>
    * <p>It is normally the first method to be called when creating a form using PHP calls.</p>
    * The <var>$type</var> is an important parameter as it determines what action will be taken when The
    * form has been submitted and validated. Possible values are:</p>
    * <ul>
    * <li>HELPER_FORM_TYPE_E107_PREF<br/>
    * - The data will be added to the e107 preferences array (<var>$pref</var>)</li>
    * <li>HELPER_LAN_FORM_TYPE_DB_CREATE_ROW<br/>
    * - The data will be added to the specified database table as a new row</li>
    * <li>HELPER_LAN_FORM_TYPE_DB_UPD_ROW<br/>
    * - The specified database table will be updated with the data</li>
    * <li>HELPER_LAN_FORM_TYPE_DB_DEL_ROW<br/>
    * - The matching row from the database table will be deleted</li>
    * </ul>
    * <p>The above values are pre-defined for you and should be entered, where required, exactly as they are
    * detailed above.</p>
    * @param string  a unique name used to identify the form
    * @param string  the type of the form, defaults to an e107 Preferences form
    * @param string  form action (URL), defaults to current URL
    * @param string  form method (GET/POST), defaults to POST
    * @param string  form target (optional)
    * @param string  form encoding type (optional)
    * @param string  JavaScript for the onsubmit event (optional)
    * @param string  CSS class(es) (optional)
    */
   function createForm($name, $type=HELPER_FORM_TYPE_E107_PREF, $action="", $method="post", $target="", $enctype="", $onsubmit="", $cssclass="") {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);

      $this->_formName = $name;
      $this->_formType = $type;

      $action  = $action   ? "action='$action'"          : "action='".e_SELF."?".e_QUERY."'";
      $method  = $method   ? " method='$method'"         : " method='post'";
      $target  = $target   ? " target='$target'"         : "";
      $enctype = $enctype  ? " enctype='$enctype'"       : "";
      $onsubmit = $onsubmit ? " onsubmit='$onsubmit'" : "";
      $cssclass = $cssclass ? " class='$cssclass'"    : "";

      $this->_formTag = "<form id='$name' $action$method$target$enctype$onsubmit$cssclass>";
      $this->_formTag .= "<div><input type='hidden' name='".$this->_formName."' value='true'/></div>";

      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
   }

   /**
    * Creates a tag.
    * Creates an instance of a specific tag.
    * @param $name      a unique name so that the tag can be accessed by the calling application
    *                   also used for the name of the tag on the form
    * @param $tagType   the type of the tag to be created, e.g. text, textarea, dropdown, accesstable, etc.
    * @param $label     a label for the tag (optional)
    * @param $prompt    prompt text for the tag (optional)
    * @param $help      help text for the tag (optional)
    * @param $class     the CSS class to be used for this tag (optional)
    * @return           true
    */
   function createTag($name, $tagType, $label="", $prompt="", $help="", $class="") {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);

      // Create the tag object
      $tempTag = new e107HelperTagObj($tagType, $this->_formName);
      $tempTag->addAttribute("name", $name);
      $tempTag->addAttribute("id", $name);

      // Set optional parameter values
      if (strlen($label) > 0) {
         $tempTag->addLabel($label);
      }
      if (strlen($prompt) > 0) {
         $tempTag->addPrompt($prompt);
      }
      if (strlen($help) > 0) {
         $tempTag->addHelp($help);
      }
      if (strlen($class) > 0) {
         $tempTag->addCSSClass($class);
      }

      $tempTag->setBatchTag($this->_batchMode != 1);

      $tempArray = array($name => $tempTag);
      if ($tagType == "hidden") {
         $this->_hiddenTags = array_merge($this->_hiddenTags, $tempArray);
      } else {
         $this->_tags = array_merge($this->_tags, $tempArray);
      }
      $this->numTags = count($this->_tags);

      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
      return true;
   }

   /**
    * Creates a button tag.
    * Creates an instance of a specific button tag.
    * @param $name      a unique name so that the tag can be accessed by the calling application
    *                   also used for the name of the tag on the form
    * @param $tagType   the type of the tag to be created, e.g. button, submit
    * @param $label     a label for the tag (optional)
    * @param $prompt    prompt text for the tag (optional)
    * @param $help      help text for the tag (optional)
    * @param $class     the CSS class to be used for this tag (optional)
    * @return           true if the tag was created OK
    */
   function createButtonTag($name, $tagType, $label="", $prompt="", $help="", $class="") {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);

      // Create the tag object
      $tempTag = new e107HelperButtonTagObj($tagType, $this->_formName);
      $tempTag->addAttribute("name", $name);
      $tempTag->addAttribute("id", $name);

      // Set optional parameter values
      if (strlen($label) > 0) {
         $tempTag->addLabel($label);
      }
      if (strlen($prompt) > 0) {
         $tempTag->addPrompt($prompt);
      }
      if (strlen($help) > 0) {
         $tempTag->addHelp($help);
      }
      if (strlen($class) > 0) {
         $tempTag->addCSSClass($class);
      }
      $tempArray = array($name => $tempTag);
      if ($tagType == "hidden") {
         $this->_hiddenTags = array_merge($this->_hiddenTags, $tempArray);
      } else {
         $this->_tags = array_merge($this->_tags, $tempArray);
      }
      $this->numTags = count($this->_tags);

      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
      return true;
   }

   /**
    * Creates a static tag
    * A static tag is one which does not return data to the server
    * @param $name      a unique name so that the tag can be accessed by the calling application
    *                   also used for the id of the tag on the page
    * @param $tagType   the type of the tag to be created, e.g. H1, SPAN, etc.
    * @param $text      text to be displayed  (optional)
    * @param $class     the CSS class to be used for this tag (optional)
    * @return           true if the tag was created OK
    */
   function createStaticTag($name, $tagType, $text="", $class="") {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);

      $tempTag = new e107HelperStaticTagObj($name, $tagType);
      $tempTag->addAttribute("id", $name);

      // Set optional parameter values
      if (strlen($text) > 0) {
         $tempTag->addText($text);
      }
      if (strlen($class) > 0) {
         $tempTag->addCSSClass($class);
      }
      $tempTag->setBatchTag($this->_batchMode != 1);
      $tempArray = array($name => $tempTag);
      $this->_tags = array_merge($this->_tags, $tempArray);
      $this->numTags = count($this->_tags);

      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
      return true;
   }

   // *********************************************************************************************
   // Public processing methods
   // *********************************************************************************************

   /**
    * The main method to call to process a form.
    * <p>If this is the first call to the form then the HTML will be generated. If the form has been submitted
    * then field validation will take place, if there are errors they will be included in the generated HTML.
    * If no errors are found then the form data will be processed according to the type of form that is being
    * processed (e.g. preferences will be set, database record will be created, updated or deleted).</p>
    * <p>To include the generated HTML in your web page you must call the getFormHTML() method.</p>
    * @see getFormHTML()
    * @param   bool  indicates if prompt text (text below a label) should be shown or not
    * @param   bool  indicates if help text (text below a field) should be shown or not
    * @param   bool  should form fields be blanked after update
    * @return  array an associative array containing:
    *                - formOK => a bool that indicates whether or not the form was successfully processed (true)
    *                            or not (false))
    *                - id => the record ID if a DB insert/update/delete was performed
    *                - action => the action that was performed (e.g. update, create, delete)
    */
   function processForm($showPrompt=false, $showHelp=false, $blankAfterUpdate=true) {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);
      //debug($_POST);
      //debug($_FILES);
      //debug($this->getFormMode());
      $result = array();

      // Has the form been submitted
      if ($this->getFormMode() != HELPER_FORM_MODE_DISPLAY) {
         // Form requires some sort of pre-processing
         switch ($this->getFormMode()) {
            case HELPER_FORM_MODE_PREF_SAVE : {
               global $pref;
               if ($this->validateForm()) {
                  // Form is a set of valid e107 preference values
                  $keys = array_keys($this->_tags);
                  foreach ($keys as $key) {
                     // If it's a tag that can submit data, set it to the e107 preferences array
                     if (is_a($this->_tags[$key], "e107HelperTagObj")) {
                        if (ini_get("magic_quotes_gpc")) {
                           $pref[$key] = stripslashes($this->getCurrentValue($key, 0));
                        } else {
                           $pref[$key] = $this->getCurrentValue($key, 0);
                        }
                     }
                  }
                  save_prefs();
                  $result = array("message"=>HELPER_LAN_03);
               }
               break;
            }
            case HELPER_FORM_MODE_DB_VALIDATE : {
               if ($this->validateForm()) {
                  $result = array("formOK"=>true);
               } else {
                  $result = array("formOK"=>false);
               }
               break;
            }
            case HELPER_FORM_MODE_DB_CREATE : {
               if ($this->validateForm()) {
                  $result = $this->_insertRowToDB();
               }
               break;
            }
            case HELPER_FORM_MODE_DB_UPDATE : {
               if ($this->validateForm()) {
                  $result = $this->_updateRowInDB();
                  if ($result["id"] != 0 && $blankAfterUpdate) {
                     $this->_setTagValuesFromDefault();
                  }
               } else {
                  // Change form mode back to 'edit' mode for re-display of the form
                  $this->setFormMode(HELPER_FORM_MODE_DB_EDIT);
               }
               break;
            }
            case HELPER_FORM_MODE_DB_EDIT : {
               $result = $this->_setTagValuesFromDB($this->_getDBIndexValue());
               break;
            }
            case HELPER_FORM_MODE_DB_DELETE : {
               $result = $this->_deleteRowFromDB();
               break;
            }
            case HELPER_FORM_MODE_DB_PRINT : {
               if ($this->_getDBPrintPageURL()) {
                  //headerx("location:".e_BASE."print.php?plugin:".str_replace("{ID}", $this->_getDBIndexValue(), $this->_getDBPrintPageURL()));
                  $url = e_BASE."print.php?plugin:".str_replace("{ID}", $this->_getDBIndexValue(), $this->_getDBPrintPageURL());
                  e107::redirect($url);
               }
               break;
            }
            default : {
               break;
            }
         }
      } else {
         if ($this->_formType == HELPER_FORM_TYPE_E107_PREF) {
            $result = $this->_setTagValuesFromPrefs();
         }
      }

      $this->generateHTML($showPrompt, $showHelp, $result["message"], varset($result["sql"], false));

      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
      if ($this->_logger->isTrace()) {
         $this->_logger->trace(HELPER_LOGGER_METHOD_RETURN, $this->isFormOK());
      }
      return array(
         HELPER_RESPONSE_FORM_OK=>$this->isFormOK(),
         HELPER_RESPONSE_ACTION=>$result["dbaction"],
         HELPER_RESPONSE_ID=>$result["id"]
      );
   }

   /**
    * Validates the tags on the form.
    * <p>Calls the validation method for each tag.<p>
    * @return bool true if there are no errors on the form, otherwise false
    */
   function validateForm() {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);
      //debug($_POST);
      $upload = array();
      // Process each tag
      $keys = array_keys($this->_tags);

      // For each batch input group
      for ($loop=0; $loop<$this->_batchMode; $loop++) {
         // If this batch group has been submitted
         if ($loop==0 || varset($_POST[HELPER_ID_BATCH_GROUP][$loop], false)) {
            // Process each item in the group
            foreach ($this->_tags as $key=>$tag) {
               // Only process common fields once in 1st iteration
               if ($loop == 0 || $tag->isBatchTag()) {
                  // If it's a tag that can submit data, validate it
                  if (is_a($tag, "e107HelperTagObj")) {
                     $tag->setIX($loop);
                     $this->_formError = !$tag->validate($this->getFormMode()) || $this->_formError;
                  }
                  if ($tag->_tagType == "file") {
                     $upload[$loop] = $tag;
                  }
               }
            }
         }
      }

      // Check for file uploads if no form errors
      if (!$this->_formError && count($upload) > 0) {
         foreach ($upload as $ix=>$tag) {
            $tag->setIX($ix);
            $this->_formError = !$tag->processTag_file($this->getFormMode());
         }
      }

      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
      return !$this->_formError;
   }

   // *********************************************************************************************
   // Public HTML generation methods
   // *********************************************************************************************

   /**
    * Get the generated HTML for the form being processed
    * @return  string   the generated HTML for the form being processed
    */
   function getFormHTML() {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);
      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
      return $this->_formHTML;
   }

   /**
    * Generate the complete HTML for the form, including any error messages
    * @param bool    flag to indicate if prompt text should be shown (<val>true</val>) or not (default is <val>false</val>)
    * @param bool    flag to indicate if help text should be shown (<val>true</val>) or not (default is <val>false</val>)
    * @param mixed   message text to be displayed at the top of the page, defaults to <val>false</val>
    * to indicate no text to display
    */
   function generateHTML($showPrompt=false, $showHelp=false, $message=false, $sql=false) {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);

      // If we're in edit mode, turn of any batch processing
      if ($this->_formMode == HELPER_FORM_MODE_DB_EDIT) {
         $this->_batchMode = 1;
      }

      $text = "";

      // Check for message text
      if ($message) {
         $text .= "<div class='".$this->_messageClass."' style='cursor:pointer;' onclick='expandit(\"helper_sql\");'>$message</div>";
      }
      if ($sql) {
         $text .= "<div class='".$this->_messageClass."' id='helper_sql' style='display:none;'>$sql</div>";
      }

      if ($this->_formType == HELPER_FORM_TYPE_DB_ROW) {
         $text .= $this->generateItemSelection();
      }

      // Generate the form/table header tags
      $text .= $this->_prettyPrint;
      $text .= $this->_formTag.$this->_prettyPrint;

      // Check for errors if to be displayed at the top of the form
      if ($this->isFormInError() && $this->_showErrorsAtTop()) {
         $errtext .= $this->getErrorText();
         // Display the errors
         $text .= "<div>";
         $text .= $this->_tableStart.$this->_prettyPrint;
         $text .= "<tr><td class='".$this->_labelClass." ".$this->_errorClass."' colspan='2'>";
         $text .= HELPER_LAN_ERR_VAL_01."<br/>$errtext";
         $text .= "</td></tr>";
         $text .= "</table></div>".$this->_prettyPrint;
      }

      // Generate table row for each tag
      $keys = array_keys($this->_tags);

      // Process all non-batch group items
      $text .= "<div>";
      $text .= $this->_tableStart.$this->_prettyPrint;
      foreach ($this->_tags as $key=>$tag) {
         if (($this->_batchMode == 1 || (!$tag->isBatchTag())) && $key != HELPER_ID_BATCH_GROUP) {
            if (is_a($tag, "e107HelperTagObj")) {
               if (strlen($tag->getLabel()) > 0) {
                  $text .= $this->getLabelHTML($tag, $showPrompt).$this->_prettyPrint;
                  $text .= $this->getTagHTML($tag, $showHelp, 0).$this->_prettyPrint;
               } else {
                  $text .= $this->getTagHTML($tag, false, $loop, true).$this->_prettyPrint;
               }
            } else if (is_a($tag, "e107HelperStaticTagObj")) {
               $text .= $this->getStaticTagHTML($key, false).$this->_prettyPrint;
            }
         } else {
            //debug($tag);
         }
      }
      $text .= "</table></div>".$this->_prettyPrint;

      // Now process all batch tags for however many groups are required
      if ($this->_batchMode > 1) {
         for ($loop=0; $loop<$this->_batchMode; $loop++) {
            $text .= "<div>";
            $text .= $this->_tableStart.$this->_prettyPrint;
            foreach ($this->_tags as $key=>$tag) {
               if ($tag->isBatchTag() || $key == HELPER_ID_BATCH_GROUP) {
                  $tag->setIX($loop);
                  if ($loop > 0 && $key==HELPER_ID_BATCH_GROUP) {
                     $text .= $this->getTagHTML($tag, $false, $loop, true).$this->_prettyPrint;
                     $text .= "</table></div>".$this->_prettyPrint;
                     $style = ($tag->getValue(false) == $tag->getCurrentValue(false)) ? " style='display:none;'" : "";
                     $text .= "<div id='".HELPER_ID_BATCH_GROUP."_div$loop'$style>";
                     $text .= $this->_tableStart.$this->_prettyPrint;
                  } else {
                     if (is_a($tag, "e107HelperTagObj")) {
                        if (strlen($tag->getLabel()) > 0) {
                           $text .= $this->getLabelHTML($tag, $showPrompt).$this->_prettyPrint;
                           $text .= $this->getTagHTML($tag, $showHelp, $loop).$this->_prettyPrint;
                        } else {
                           $text .= $this->getTagHTML($tag, false, $loop, true).$this->_prettyPrint;
                        }
                     } else if (is_a($tag, "e107HelperStaticTagObj")) {
                        $text .= $this->getStaticTagHTML($key, false).$this->_prettyPrint;
                     }
                  }
               }
            }
            $text .= "</table></div>".$this->_prettyPrint;
         }
      }

      $submit = $this->generateSubmitButtonHTML();
      if (strlen($submit) > 0) {
         $text .= $this->_tableStart.$this->_prettyPrint;
         $text .= $submit;
         $text .= "</table>".$this->_prettyPrint;
      }
      $text .= "<p><input type='hidden' name='e107helper_selected_key' value='".$this->_getDBIndexValue()."'/>";
      $text .= $this->getHiddenTags();
      $text .= "</p></form>".$this->_prettyPrint;
      $text .= "<script type='text/javascript'>if (typeof Form != 'undefined' && Form.focusFirstElement) Form.focusFirstElement($('".$this->_formName."'));</script>".$this->_prettyPrint;
      $this->_formHTML = $text;
      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
   }

   /**
    * Generate the HTML for the selection form.
    * <p>The selection form is the list above the form that details existing database entries and offers
    * buttons to update or delete the selected entry.</p>
    * @return the HTML for the selection list
    */
   function generateItemSelection() {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);
      global $sql2;
      $text = "";
      //$text .= "<div style='text-align:center'>";
      $text .= "<form method='post' action='".e_SELF."?".e_QUERY."' id='e107helperitemselectionform'>";
      $text .= "<table summary='*' style='width:100%;margin-left:auto;margin-right:auto;' class='fborder'>";
      $text .= "<tr><td colspan='2' class='forumheader' style='text-align:center'>";

      $count = $sql2->db_Select($this->_getDBTable(), $this->_getDBIndex().", ".$this->_getDBData(), $this->_getDBJoin()." WHERE ".$this->_getDBWhere()." ORDER BY ".$this->_getDBOrder(), false);
      if ($count == 0) {
         $text .= HELPER_LAN_EMPTY;
      } else {
         $text .= HELPER_LAN_EXISTING."&nbsp;<select name='e107helper_selected_key' class='".$this->_getDBStyle()."'>";
         //$dataCols = count(explode(",", $this->_getDBData()));
         $rows = array();
         while ($row = $sql2->db_Fetch()) {
            $rows[count($rows)] = $row;
         }
         foreach ($rows as $row) {
            $keys = array_values(explode(",", $this->_getDBData()));
            $patt = $this->_getDBPattern();
            if (strlen($patt) == 0) {
               $patt = $this->_getDBData();
            }
            foreach ($keys as $key) {
               $key = trim($key);
               $patt = str_replace("$key", $row[$key], $patt);
            }
            if ($this->_getDBFormatCallback()) {
               if ($this->_getDBFormatCallbackClass()) {
                  if (eval("global "."$".$this->_getDBFormatCallbackClass().";return isset($".$this->_getDBFormatCallbackClass().");")) {
                     // there is a global variable named after the class, call functions of that class to allow use of $this in callbacks
                     $temp = eval("global "."$".$this->_getDBFormatCallbackClass().";return $".$this->_getDBFormatCallbackClass()."->".$this->_getDBFormatCallback()."(\$row);");
                  } else {
                     // No global, just call the method as a static function of the class
                     $temp = call_user_func(array($this->_getDBFormatCallbackClass(), $this->_getDBFormatCallback()), $row);
                  }
               } else {
                  $temp = call_user_func($this->_getDBFormatCallback(), $row);
               }
            } else if (strlen($this->_getDBPattern()) > 0) {
               $patt = eval("\$temp=".$patt.";");
            } else {
               $temp = $patt;
            }
            if ($temp !== false) {
               $text .= "<option value='$row[0]'>$temp</option>";
            }
         }
         $text .= "</select>&nbsp;&nbsp;<input class='button' type='submit' name='e107helper_edit_sel' value='".HELPER_LAN_EDIT."' />";
         $text .= "&nbsp;<input class='button' type='submit' name='e107helper_delete_sel' value='".HELPER_LAN_DELETE."' onclick='return e107Helper.confirmDelete(\"".HELPER_LAN_DELETE_CONFIRM."\", \"".e_SELF."\");' />";
         if ($this->_getDBPrintPageURL() !== false) {
            $text .= "&nbsp;<input class='button' type='submit' name='e107helper_print_sel' value='".HELPER_LAN_PRINT."' />";
         }
      }

      $text .= "</td></tr></table>";
      $text .= "</form>";
      //$text .= "</form></div><br />";
      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
      return $text;
   }

   /**
    * Generate the HTML for the submit button.
    * <p>The actual button generated depends on the form processing mode - create/update/edit/delete.</p>
    * buttons to update or delete the selected entry.</p>
    * @return the HTML for the form submit button
    */
   function generateSubmitButtonHTML() {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);

      if ($this->_formType == HELPER_FORM_TYPE_NO_BUTTONS) {
         return;
      }

      switch ($this->getFormMode()) {
         case HELPER_FORM_MODE_PREF_SAVE : {
            $name = HELPER_BUTTON_SAVE;
            $value = HELPER_LAN_05;
            break;
         }
         case HELPER_FORM_MODE_DB_CREATE : {
            $name = HELPER_BUTTON_CREATE;
            $value = HELPER_LAN_CREATE;
            break;
         }
         case HELPER_FORM_MODE_DB_UPDATE : {
            $name = HELPER_BUTTON_CREATE;
            $value = HELPER_LAN_CREATE;
            break;
         }
         case HELPER_FORM_MODE_DB_EDIT : {
            $name = HELPER_BUTTON_UPDATE;
            $value = HELPER_LAN_UPDATE;
            break;
         }
         case HELPER_FORM_MODE_DB_DELETE : {
            $name = HELPER_BUTTON_CREATE;
            $value = HELPER_LAN_CREATE;
            break;
         }
         default : {
            if ($this->_formType == HELPER_FORM_TYPE_E107_PREF) {
               $name = HELPER_BUTTON_SAVE;
               $value = HELPER_LAN_05;
            } else if ($this->_formType == HELPER_FORM_TYPE_DB_ROW) {
               $name = HELPER_BUTTON_CREATE;
               $value = HELPER_LAN_CREATE;
            } else {
               // Default, caller is supplying own buttons/submit method
            }
            break;
         }
      }
      $this->createTag($name, "submit", "", "", "", "button");
      $this->addValue($name, $value);
      $text .= $this->getTagHTML($this->_tags[$name], false, 1, true);

      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
      return $text;
   }

   /**
    * Get the HTML for an error message for a tag
    * @return  string   the error text for the form
    * @todo    maybe makes top of page error messages in to hyperlinks to jump to field in error
    */
   function getErrorText() {
      $errtext = "";
      $keys = array_keys($this->_tags);
      foreach ($keys as $key) {
         // If it's a tag that can submit data, see if it's in error and report message if it is
         if (is_a($this->_tags[$key], "e107HelperTagObj") && $this->_tags[$key]->isInError()) {
            $id = $this->_tags[$key]->isBatchTag() ? $key."_0" : $key;
            $errtext .= "<span style='cursor:pointer;' onclick='document.getElementById(\"$id\").focus();'>";
            $errtext .= $this->getError($key)."</span><br/>";
         }
      }
      return $errtext;
   }

   /**
    * Get the HTML for an error message for a tag
    * @param   string   the name of the tag
    * @param   bool     return the HTML as a single two column row (true) or just as text (false, default)
    * @return  string   the error message for the tag
    * @todo    maybe makes top of page error messages in to hyperlinks to jump to field in error
    */
   function getError($name, $asRow=false) {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);
      if ($asRow) {
         $text = "<div class='".$this->_errorClass."'>";
      }
      $text .= $this->_errorPrefix." ".$this->_tags[$name]->getError();
      if ($asRow) {
         $text .= "</div>";
      }
      return $text;
      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
   }

   /**
    * Get the help text for a tag
    * @param   object   the tag
    * @return  string   the help text for a tag
    */
   function getHelpHTML($tag) {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);
      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
      return strlen($tag->getHelp()) ? "<br/><span class='".$this->_helpClass."'>".$tag->getHelp()."</span>" : "";
   }

   /**
    * Get the label for a tag
    * @param   object   the tag
    * @param   bool     Should the tags prompt text be included (true) or not (false, default)
    * @return  string   the label for a tag
    */
   function getLabelHTML($tag, $renderPrompt=false) {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);
      $text = "<tr><td class='".$this->_labelClass."'>";
      if ($this->_showErrorsAtTop() && $tag->isInError()) {
         $text .= "<span class='".$this->_errorClass."'>";
      }
      if ($tag->getMandatory()) {
         $text .= "* ";
      }
      $text .= $tag->getLabel();
      if ($this->_showErrorsAtTop() && $tag->isInError()) {
         $text .= "</span>";
      }
      $text .= $renderPrompt ? $this->getPromptHTML($tag) : "";
      $text .= "</td>";
      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
      return $text;
   }

   /**
    * Get the prompt for a tag
    * @param   object   the tag
    * @return  string   the prompt text for a tag
    */
   function getPromptHTML($tag) {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);
      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
      return strlen($tag->getPrompt()) ? "<br/><span class='".$this->_promptClass."'>".$tag->getPrompt()."</span>" : "";
   }

   /**
    * Get the HTML for a tag
    * @param   object   the tag
    * @param   bool     should help text be included (true) or not (false, default)
    * @param   bool     return the HTML as a single two column row (true) or just as text (false, default) -
    *                   normally used for submit buttons
    * @return  string   the HTML for the tag
    */
   function getTagHTML($tag, $renderHelp=false, $ix=1, $oneRow=false) {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);
      $tag->setIX($ix);
      if ($oneRow) {
         $text = "<tr><td class='".$this->_labelClass."' colspan='2' style='".$this->_submitStyle."'>".$tag->getTag($this->getFormMode());
                  if (!$this->_showErrorsAtTop() && $tag->isInError()) {
                     $text .= $this->getError($tag->getName(), true);
                  }
         $text .= $renderHelp ? $this->getHelpHTML($tag) : "";
         $text .= "</td></tr>";
      } else {
         $text = "<td class='".$this->_labelClass."'>".$tag->getTag($this->getFormMode());
                  if (!$this->_showErrorsAtTop() && $tag->isInError()) {
                     $text .= $this->getError($tag->getName(), true);
                  }
         $text .= $renderHelp ? $this->getHelpHTML($tag) : "";
         $text .= "</td></tr>";
      }
      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
      return $text;
   }

   /**
    * Get the HTML for a static tag
    * @param   string   the name of the tag
    * @param   bool     should help text be included (true) or not (false, default)
    * @return  string   the HTML for the static tag
    */
   function getStaticTagHTML($name, $renderHelp=false) {
      eval(HELPER_LOGGER_TRACE_METHOD_ENTRY);
      $text = "<tr><td class='".$this->_labelClass."' colspan='2'>".$this->_tags[$name]->getTag();
      $text .= "</td></tr>";
      eval(HELPER_LOGGER_TRACE_METHOD_EXIT);
      return $text;
   }

   function getHiddenTags() {
      // Generate HTML for each hidden tag
      $keys = array_keys($this->_hiddenTags);
      $text = "";
      foreach ($keys as $key) {
         $text .= $this->_hiddenTags[$key]->getTag();
      }
      return $text;
   }

   // *********************************************************************************************
   // Public setter methods
   // *********************************************************************************************

   /**
    * Add an attribute to the tagType
    * @param $name   a unique reference to a tag that has already been created
    * @param $att    the name of the attribute to set
    * @param $value  a value for the attribute being set
    */
   function addAttribute($name, $att, $value) {
      $this->_tags[$name]->addAttribute($att, $value);
   }

   /**
    * Add an event attribute to the tagType
    * @param $name   a unique reference to a tag that has already been created
    * @param $event  the name of the event to set (without the 'on' prefix)
    * @param $js     the JavaScript to execute when this event occurs
    */
   function addEvent($name, $event, $js) {
      $this->_tags[$name]->addJavaScript($this->_translateValue($event, false), $this->_translateValue($js, false));
   }

   /**
    * Add a style attribute to the tagType
    * @param $name   a unique reference to a tag that has already been created
    * @param $att    the name of the style attribute to set
    * @param $value  a value for the style attribute being set
    */
   function addStyle($name, $att, $value) {
      $this->_tags[$name]->addStyle($att, $value);
   }

   /**
    * Text for a static tag
    * @param $name   a unique reference to a tag that has already been created
    * @param $text   the text to be added
    */
   function addParagraphText($name, $text) {
      $this->_tags[$name]->addParagraphText($text);
   }

   /**
    * Add an value for the tag.
    * Multiple calls to this mthod should be made for tags that can take more than one value (e.g. select tags)
    * @param $name   a unique reference to a tag that has already been created
    * @param $value  a value for the tag
    * @param $text   optional text associated with the value (for use with slect tags, etc.)
    */
   function addValue($name, $value, $text=false) {
      $this->_tags[$name]->addValue($value, $text);
   }

   /**
    * Set the database data columns.
    * @param   string   the value to set
    */
   function setDBData($value) {
      $this->_dbData = $value;
   }

   /**
    * Set the database index.
    * @param   string   the value to set
    */
   function setDBIndex($value) {
      $this->_dbIndex = $value;
   }

   /**
    * Set the database index value.
    * @param   string   the value to set
    */
   function setDBIndexValue($value) {
      $this->_dbIndexValue = $value;
   }

   /**
    * Set the database order.
    * @param   string   the value to set
    */
   function setDBOrder($value) {
      $this->_dbOrder = $value;
   }

   /**
    * Set the PHP eval() string to generate the string for the selection list.
    * @param   string   the value to set
    */
   function setDBPattern($value) {
      $this->_dbPattern = $value;
   }

   /**
    * Set the database selectionlist style.
    * @param   string   the value to set
    */
   function setDBStyle($value) {
      $this->_dbStyle = $value;
   }

   /**
    * Set the database table.
    * @param   string   the value to set
    */
   function setDBTable($value) {
      $this->_dbTable = $value;
   }

   /**
    * Set the database join SQL.
    * @param   string   the value to set
    */
   function setDBJoin($value) {
      $this->_dbJoin = $value;
   }

   /**
    * Set the database where clause.
    * @param   string   the value to set
    */
   function setDBWhere($value) {
      $this->_dbWhere = $value;
   }

   /**
    * Set where errors are displayed
    * @param   bool  true to display errors at the top of the form, false to display belwo the field in error
    */
   function setErrorsAtTop($value) {
      $this->_formErrorTop = $value;
   }

   /**
    * Set the user callback function for string formatting.
    * @param   class   the class to set
    * @param   func    the function to set
    */
   function setDBFormatCallback($class, $func) {
      $this->_dbFormatCallbackClass = $class;
      $this->_dbFormatCallback = $func;
   }

   /**
    * Set the URL to be called to display a printable page of the item.
    * @param   url   the value to set
    */
   function setDBPrintPageURL($url) {
      $this->_dbPrintPageURL = $url;
   }

   /**
    * Set the user callback function for string formatting.
    * @param   string   the value to set
    */
   function setDBWhereCallback($class, $param, $func) {
      $this->_dbWhereCallbackClass = $class;
      $this->_dbWhereParam = $param;
      $this->_dbWhereCallback = $func;
   }

   /**
    * Set the BB Code toolbar.
    * <p>Used to show BB code toolbar for textareas.</p>
    * @param   string   the tag name
    * @param   string   the BB Code value 0=no, 1=yes, 2=yes with tooltips (defaults to false, meaning no toolbar)
    */
   function setBBCodes($name, $value) {
      $this->_tags[$name]->setBBCodes($value);
   }

   /**
    * Set a userclasses to omitted from accesstables
    * @param   string   the tag name
    * @param   string   true/false
    */
   function omitClass($name, $value) {
      $this->_tags[$name]->omitClass($value);
   }

   /**
    * Set the callback function for the tag.
    * @param   string   the tag name
    * @param   string   the callback function name
    */
   function setCallback($name, $class, $func) {
      if (isset($this->_tags[$name])) {
         $this->_tags[$name]->setCallback($class, $func);
      } else {
         $this->_hiddenTags[$name]->setCallback($class, $func);
      }
   }

   /**
    * Set the list callback function for the tag.
    * @param   string   the tag name
    * @param   string   the callback function name
    * @param   string   the callback function name
    */
   function setListCallback($name, $class, $func) {
      if (isset($this->_tags[$name])) {
         $this->_tags[$name]->setListCallback($class, $func);
      } else {
         $this->_hiddenTags[$name]->setListCallback($class, $func);
      }
   }

   /**
    * Set a callback function parameter for the tag.
    * @param   string   the tag name
    * @param   string   the callback function parameter name
    * @param   string   the callback function parameter value
    */
   function setCallbackParam($name, $pname, $pvalue) {
      if (isset($this->_tags[$name])) {
         $this->_tags[$name]->setCallbackParam($pname, $pvalue);
      } else {
         $this->_hiddenTags[$name]->setCallbackParam($pname, $pvalue);
      }
   }

   /**
    * Set the custom HTML to be used to render the tag
    * @param   string   the tag name
    * @param   string   the custom HTML
    */
   function setCustomHTML($name, $value) {
      $this->_tags[$name]->setCustomHTML($value);
   }

   /**
    * Set the default value for the tag.
    * <p>The default value is normally the current preference or database value for the tag.</p>
    * @param   string   the tag name
    * @param   string   the default value
    */
   function setDefault($name, $value) {
      if (isset($this->_tags[$name])) {
         $this->_tags[$name]->setDefault($value);
      } else {
         $this->_hiddenTags[$name]->setDefault($value);
      }
   }

   /**
    * Set the value for the breaks flag for a tag that displays multiple items, e.g. radio buttons
    * @param   string   the tag name
    * @param   string   true or false
    */
   function setBreaks($name, $value) {
      $this->_tags[$name]->setBreaks($value);
   }

   /**
    * Set the flag to indicate if paths should be included in file names
    * @param   string   the tag name
    * @param   string   true or false
    */
   function setNoPath($name, $value) {
      $this->_tags[$name]->setNoPath($value);
   }

   /**
    * Set the value for the Directory for a tag that displays files
    * <p>Sub-directory will be appended to directory when processed.</p>
    * @param   string   the tag name
    * @param   string   the directory name, can be relative directory
    */
   function setDir($name, $value) {
      $this->_tags[$name]->setDir($value);
   }

   /**
    * Set the value for the Help text CSS class
    * @param   string   the CSS class for help text
    */
   function setHelpClass($class) {
      $this->_helpClass = $class;
   }

   /**
    * Set the value for the label text CSS class
    * @param   string   the CSS class for label text
    */
   function setLabelClass($class) {
      $this->_labelClass = $class;
   }

   /**
    * Set the mandatory flag
    * @param $new boolean flag to indicate mandatoriness (sp?)
    */
   function setMandatory($name, $new) {
      $this->_tags[$name]->setMandatory($new);
   }

   /**
    * Set the maximum length for the tag
    * @param string the name of the field to set the length for
    * @param int the maximum length
    */
   function setMaxLength($name, $new) {
      $this->_tags[$name]->setMaxLength($new);
   }

   /**
    * Set the maximum value for the tag
    * @param string the name of the field to set the value for
    * @param int the maximum value
    */
   function setMaxValue($name, $new) {
      $this->_tags[$name]->setMaxValue($new);
   }

   /**
    * Set whether or not a blank entry is required
    * <p>Used for list style tags to allow a 'no-selection' type value</p>
    * @param string the name of the field to set the value for
    * @param boolean set to true if a blank entry is required
    */
   function setIncludeBlank($name, $new) {
      $this->_tags[$name]->setIncludeBlank($new);
   }

   /**
    * Set the minimum length for the field
    * @param string the name of the field to set the length for
    * @param int the minimum length
    */
   function setMinLength($name, $new) {
      $this->_tags[$name]->setMinLength($new);
   }

   /**
    * Set the minimum value for the field
    * @param string the name of the field to set the value for
    * @param int the minimum value
    */
   function setMinValue($name, $new) {
      $this->_tags[$name]->setMinValue($new);
   }

   /**
    * Date format for validating a date field
    * @param $name   a unique reference to a tag that has already been created
    * @param $text   PHP date formatting string (see http://uk2.php.net/manual/en/function.date.php)
    */
   function addDateFormat($name, $text) {
      $this->_tags[$name]->setDateFormat($text);
   }

   /**
    * Set the value for the prompt text CSS class
    * @param   string   the CSS class for prompt text
    */
   function setPromptClass($class) {
      $this->_promptClass = $class;
   }

   /**
    * Set the value for the Sub-directory for a tag that displays files
    * <p>Sub-directory will be appended to directory when processed.</p>
    * @param   string   the tag name
    * @param   string   the directory name, can be relative directory
    */
   function setSubDir($name, $value) {
      $this->_tags[$name]->setSubDir($value);
   }

   /**
    * Set the value for the main form table CSS class
    * @param   string   the CSS class for the main form table
    */
   function setTableStyle($style) {
      $this->_tableStart = $style;
   }

   // *********************************************************************************************
   // Public getter methods
   // *********************************************************************************************

   /**
    * Get the value of a tag - ensure the correctly formatted value is returned for multi-part tags
    * @param   string   the name of the field to get the value for
    * @return  stringthe field value
    */
   function getCurrentValue($name, $ix=0) {
      $this->_tags[$name]->setIX($ix);
      return $this->_tags[$name]->getCurrentValue(false);
   }

   // *********************************************************************************************
   // Private getter methods
   // *********************************************************************************************

   function getFormMode() {
      if (!isset($this->_formMode)) {
         // Set the default processing mode for the form
         $this->_formMode = HELPER_FORM_MODE_DISPLAY;

         // Determine the correct processing mode for the form
         if ($this->_formType == HELPER_FORM_TYPE_E107_PREF) {
            // It's a preferences form
            if ($_REQUEST[$this->_formName]) {
               // Has been submitted
               $this->_formMode = HELPER_FORM_MODE_PREF_SAVE;
            }
         } else {
            // It must be a DB form
            if (isset($_REQUEST[$this->_formName])) {
               // Form has been submitted
               if (isset($_REQUEST[HELPER_BUTTON_CREATE])) {
                  // Add button selected
                  $this->_formMode = HELPER_FORM_MODE_DB_CREATE;
               } else if (isset($_REQUEST[HELPER_BUTTON_UPDATE])) {
                  // Update button selected
                  $this->_formMode = HELPER_FORM_MODE_DB_UPDATE;
               } else {
                  // Just validate form - most likely a custom button so caller will do any post validation data processing
                  $this->_formMode = HELPER_FORM_MODE_DB_VALIDATE;
               }
            } else if (isset($_REQUEST["e107helper_selected_key"])) {
               // Selection list form has been submitted
               if (isset($_REQUEST["e107helper_edit_sel"])) {
                  $this->_formMode = HELPER_FORM_MODE_DB_EDIT;
               } elseif (isset($_REQUEST["e107helper_print_sel"])) {
                  $this->_formMode = HELPER_FORM_MODE_DB_PRINT;
               } elseif (isset($_REQUEST["e107helper_delete_sel"])) {
                  $this->_formMode = HELPER_FORM_MODE_DB_DELETE;
               }
            } else if ($this->_getDBIndexValue()) {
               // We have been supplied with the index to the record to read
               $this->_formMode = HELPER_FORM_MODE_DB_EDIT;
            }
         }
      }
      return $this->_formMode;
   }

   /**
    * Get the database data column names.
    * @return database data column names
    * @access private
    */
   function _getDBData() {
      return $this->_dbData;
   }

   /**
    * Get the database index column name.
    * @return database index column name
    * @access private
    */
   function _getDBIndex() {
      return $this->_dbIndex;
   }

   /**
    * Get the database index value.
    * @return database index value
    * @access private
    */
   function _getDBIndexValue() {
      if (isset($_REQUEST["e107helper_selected_key"])) {
         return $_REQUEST["e107helper_selected_key"];
      }
      return $this->_dbIndexValue;
   }

   /**
    * Get the database result order string.
    * @return database result order string
    * @access private
    */
   function _getDBOrder() {
      return $this->_dbOrder;
   }

   /**
    * Get the database PHP formatting string.
    * @return database PHP formatting string
    * @access private
    */
   function _getDBPattern() {
      return $this->_dbPattern;
   }

   /**
    * Get the style for DB selection list.
    * @return database selection list style
    * @access private
    */
   function _getDBStyle() {
      return $this->_dbStyle;
   }

   /**
    * Get the database table name.
    * @return database table name
    * @access private
    */
   function _getDBTable() {
      return $this->_dbTable;
   }

   /**
    * Get the database join SQL.
    * @return database join SQL
    * @access private
    */
   function _getDBJoin() {
      return $this->_dbJoin;
   }

   /**
    * Get the database data column names.
    * @return database data column names
    * @access private
    */
   function _getDBWhere() {
      if ($this->_getDBWhereCallback()) {
         if ($this->_getDBWhereCallbackClass()) {
            if (eval("global "."$".$this->_getDBWhereCallbackClass().";return isset($".$this->_getDBWhereCallbackClass().");")) {
               // there is a global variable named after the class, call functions of that class to allow use of $this in callbacks
               return eval("global "."$".$this->_getDBWhereCallbackClass().";return $".$this->_getDBWhereCallbackClass()."->".$this->_getDBWhereCallback()."(\"".$this->_getDBWhereParam()."\");");
            } else {
               // No global, just call the method as a static function of the class
               return call_user_func(array($this->_getDBWhereCallbackClass(), $this->_getDBWhereCallback()), $this->_getDBWhereParam() );
            }
         } else {
            return call_user_func($this->_getDBWhereCallback());
         }
      } else {
         if ($this->_dbWhere) {
            return $this->_dbWhere;
         }
      }
      return  "1=1";
   }

   /**
    * Get the user callback function for formatting string.
    * @return user callback function for formatting string
    * @access private
    */
   function _getDBFormatCallback() {
      return $this->_dbFormatCallback;
   }

   /**
    * Get the user callback class for formatting string.
    * @return user callback class for formatting string
    * @access private
    */
   function _getDBFormatCallbackClass() {
      return $this->_dbFormatCallbackClass;
   }

   /**
    * Get the URL for item print page.
    * @return URL for item print page
    * @access private
    */
   function _getDBPrintPageURL() {
      return $this->_dbPrintPageURL;
   }

   /**
    * Get the user callback function for where string.
    * @return user callback function for where string
    * @access private
    */
   function _getDBWhereCallback() {
      return $this->_dbWhereCallback;
   }

   /**
    * Get the user callback class for where string.
    * @return user callback class for where string
    * @access private
    */
   function _getDBWhereCallbackClass() {
      return $this->_dbWhereCallbackClass;
   }

   /**
    * Get the user callback parameters for where string.
    * @return user callback parameters for where string
    * @access private
    */
   function _getDBWhereParam() {
      return $this->_dbWhereParam;
   }

   // *********************************************************************************************
   // Public helper methods
   // *********************************************************************************************

   /**
    * Determine if the form has errors
    * @return  bool  true if the form has errors, otherwise false
    */
   function isFormInError() {
      return $this->_formError;
   }

   /**
    * Determines if the form is clean (has no errors)
    * @return  bool  true if the form is clean, otherwise false
    */
   function isFormOK() {
      return !$this->_formError;
   }

   // *********************************************************************************************
   // Private helper methods
   // *********************************************************************************************

   /**
    * Determines where errors should be displayed
    * @return  bool  true if errors should be displayed at the top of the form, false if they should
    *                be displayed against the field in error
    * @access private
    */
   function _showErrorsAtTop() {
      return $this->_formErrorTop;
   }


   /**
    * Insert a DB row
    * @return  array associative array detailing record id and message to be displayed indicating success or otherwise of DB query
    *                id is zero if insert failed
    */
   function _insertRowToDB() {
      global $e107Helper;
      $mysql = new e107HelperDB();
      $colstr = array();
      $inpstr = array();
      $allTags = array_merge($this->_tags, $this->_hiddenTags);
      $keys = array_keys($allTags);
      $mysql->db_Query("BEGIN");
      $colstr = array();
      $inpstr = array();
      $queries = array();
      $count = 0;

      // For each batch input group
      for ($loop=0; $loop<$this->_batchMode; $loop++) {
         $batchcolstr = array();
         $batchinpstr = array();
         // If this batch group has been submitted
         if ($loop==0 || varset($_POST[HELPER_ID_BATCH_GROUP][$loop], false)) {
            // Process each item in the group
            foreach ($keys as $key) {
               // Only process common non-e107helper fields once in 1st iteration
               if ($key!=HELPER_ID_BATCH_GROUP && ($loop == 0 || $allTags[$key]->isBatchTag())) {
                 if (is_a($allTags[$key], "e107HelperTagObj") && !is_a($allTags[$key], "e107HelperButtonTagObj")) {
                     $allTags[$key]->setIX($loop);
                     if ($allTags[$key]->isBatchTag()) {
                        $batchcolstr[] = $key;
                        $batchinpstr[] = "'".$e107Helper->tp_toDB($allTags[$key]->getCurrentValue(false))."'";
                     } else {
                        $colstr[] = $key;
                        $inpstr[] = "'".$e107Helper->tp_toDB($allTags[$key]->getCurrentValue(false))."'";
                     }
                  }
               }
            }
            $col = array_merge($colstr, $batchcolstr);
            $inp = array_merge($inpstr, $batchinpstr);
            $query = "(".implode(", ", $col).") values (".implode(", ", $inp).")";
            $res = $mysql->db_InsertPart($this->_getDBTable(), $query);
            if ($res === false) {
               // Error, rollback and stop trying any more inserts
               $response = array("id"=>$res, "dbaction"=>HELPER_FORM_MODE_DB_CREATE, "message"=>HELPER_LAN_12." (".mysqli_error().")", "sql"=>$query);
               $mysql->db_Query("ROLLBACK");
               return $response;
            }
            $queries[] = $query;
            $count++;
         }
      }
      $mysql->db_Query("COMMIT");
      $response = array(
                        "id"        => $res,
                        "dbaction"  => HELPER_FORM_MODE_DB_CREATE,
                        "message"   => str_replace("{ITEMS}", $count, HELPER_LAN_17),
                        "sql"       => implode("<br/>", $queries)
                       );
      return $response;
   }

   /**
    * Update a DB row
    * @return  array associative array detailing record id and message to be displayed indicating success or otherwise of DB query
    *                id is zero if update failed
    */
   function _updateRowInDB() {
      global $e107Helper;
      $mysql = new e107HelperDB();
      $inpstr = array();
      $allTags = array_merge($this->_tags, $this->_hiddenTags);
      $keys = array_keys($allTags);

      for ($loop=0; $loop<$this->_batchMode; $loop++) {
         foreach ($keys as $key) {
           if (is_a($allTags[$key], "e107HelperTagObj") && !is_a($allTags[$key], "e107HelperButtonTagObj") && $key!=HELPER_ID_BATCH_GROUP) {
              // Change tag class to return db value
              // Change here to determine if column is numeric or string (i.e. quoted or not)
              $inpstr[] = "$key='".$e107Helper->tp_toDB($allTags[$key]->getCurrentValue(false))."'";
            }
         }
         $sql = implode(", ", $inpstr) . " WHERE ".$this->_getDBIndex()."='".$this->_getDBIndexValue()."'";
         $res = $mysql->db_Update($this->_getDBTable(), $sql);
         if ($res !== false) {
            $response = array("id"=>$this->_getDBIndexValue(), "dbaction"=>HELPER_FORM_MODE_DB_UPDATE, "message"=>HELPER_LAN_10, "sql"=>$sql);
         } else {
            $response = array("id"=>0, "dbaction"=>HELPER_FORM_MODE_DB_UPDATE, "message"=>HELPER_LAN_13." (".mysqli_error().")", "sql"=>$sql);
         }
      }
      return $response;
   }

   /**
    * Delete a DB row
    * @return  array associative array detailing record id and message to be displayed indicating success or otherwise of DB query
    *                id is zero if delete failed
    */
   function _deleteRowFromDB() {
      $mysql = new e107HelperDB();
      $sql = $this->_getDBIndex()."='".$this->_getDBIndexValue()."'";
      $res = $mysql->db_Delete($this->_getDBTable(), $sql);
      if ($res) {
         $response = array("id"=>$this->_getDBIndexValue(), "dbaction"=>HELPER_FORM_MODE_DB_DELETE, "message"=>HELPER_LAN_11, "sql"=>$sql);
      } else {
         $response = array("id"=>0, "dbaction"=>HELPER_FORM_MODE_DB_DELETE, "message"=>HELPER_LAN_14." (".mysqli_error().")", "sql"=>$sql);
      }
      return $response;
   }

   // *********************************************************************************************
   // Private setter methods
   // *********************************************************************************************

   function setFormMode($mode) {
      $this->_formMode = $mode;
   }

   function _setTagValuesFromDB($id) {
      $mysql = new db();
      $count = $mysql->db_Select($this->_getDBTable(), "*", $this->_getDBIndex()."='$id'");
      $row = $mysql->db_Fetch();
      $keys = array_keys($this->_tags);
      foreach ($keys as $key) {
        if (is_a($this->_tags[$key], "e107HelperTagObj")) {
            $this->_tags[$key]->setDefault($row[$key], true);
         }
      }
   }

   function _setTagValuesFromPrefs() {
      global $pref;
      $keys = array_keys($this->_tags);
      foreach ($keys as $key) {
        if (is_a($this->_tags[$key], "e107HelperTagObj")) {
            $this->_tags[$key]->setDefault($pref[$key], true);
         }
      }
   }

   function _setTagValuesFromDefault() {
      $keys = array_keys($this->_tags);
      foreach ($keys as $key) {
         if (is_a($this->_tags[$key], "e107HelperTagObj")) {
            // Make sure we don't pick up user input
            unset($_REQUEST[$this->_tags[$key]->getName()]);
            $this->_tags[$key]->setDefault($this->_tags[$key]->getDefault(false), true);
         }
      }
   }

   // *********************************************************************************************
   // Loggerging related methods
   // *********************************************************************************************

   /**
    * Print this object (for debugging)
    */
   function toString() {
      print "<pre>";
      print_r($this->_tags);
      print "</pre>";
   }

   function printMyPrefs() {
      global $pref;

      if ($this->_logger->isInfo()) {
         $keys = array_keys($this->_tags);
         foreach ($keys as $key) {
            // If it's a tag that can submit data, set it to the e107 preferences array
            if (is_a($this->_tags[$key], "e107HelperTagObj")) {
               if (isset($pref[$key])) {
                  $this->_logger->info(HELPER_DEBUG_VARIABLE_VALUE, "$key = ".$pref[$key]);
               } else {
                  $this->_logger->info(HELPER_DEBUG_VARIABLE_VALUE, "$key = not set");
               }
            }
         }
      }
   }
}
?>