<?php

// To Do : See e107HelperForm_class.php

/**
 * e107 Static Tag Object Helper class
 * <b>CVS Details:</b>
 * <ul>
 * <li>$Source: e:\_repository\e107_plugins/e107helpers/e107HelperStaticTagObj_class.php,v $</li>
 * <li>$Date: 2007/08/01 23:36:32 $</li>
 * </ul>
 * @author     $Author: Neil $
 * @version    $Revision: 1.4 $
 * @copyright  Released under the terms and conditions of the GNU General Public License (http://gnu.org).
 * @package e107HelperForm
 */

/**
 * A private Helper class for the e107 CMS system.
 * Used by the e107HelperForm class.
 * A static tag is one which cannot submit data to the mid tier (e.g. headers, spans, divs)
 * Each static tag object holds enough information to render the tag on the screen.
 * Note: this class is normally instansiated by the e107HelperForm class.
 *
 * @package e107HelperForm
 */
class e107HelperStaticTagObj {
   /**#@+
    * @access private
    */
   var $_tagType;       // The type of the tag

   var $_ix;            // Index of current instance of this tag (when batch forms are bing used
   var $_name;          // Tag name
   var $_class;         // CSS class(es) for the tag
   var $_text;          // The text for
   var $_paragraphText; // The paragraph text for
   var $_values;        // Array holding value for the tag

   var $_attributes;    // Array of attributes for this tag
   var $_styles;        // Array of style attributes for this tag
   /**#@-*/

   /**
    * Constructor
    */
   function e107HelperStaticTagObj($name, $tagType) {
      $this->_name         = $name;
      $this->_ix           = 0;
      $this->_tagType      = $tagType;
      $this->_class        = "";
      $this->_text         = "";
      $this->_paragraphText= array();
      $this->_attributes   = array();
      $this->_styles       = array();
      $this->_values       = array();
      $this->_batchTag     = false;
   }

   // *********************************************************************************************
   // Public setter methods
   // *********************************************************************************************

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
    * Add CSS class(es).
    * @param $new the CSS class(es) (if more than one, separate by spaces)
    */
   function addCSSClass($new) {
      $this->_class = $new;
   }

   /*
    * Add text
    * @param $new the text
    */
   function addText($new) {
      $this->_text = $new;
   }

   /*
    * Add paragraph text
    * @param $new the text
    */
   function addParagraphText($new) {
      array_push($this->_paragraphText, $new);
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
    * Set a flag to indicate that this field is part of a repeating group
    */
   function setBatchTag($new) {
      $this->_batchTag = $new;
   }

   /*
    * Set the index for the current item (in batch mode)
    * @param   $ix the index value
    */
   function setIX($ix) {
      $this->_ix = $ix;
   }

   // *********************************************************************************************
   // Public getter methods
   // *********************************************************************************************

   /*
    * Get the current value of this tag (looks for user input before returning current value)
    * @param   bool     to indicate if return value should be decorated with HTML value attibute (true, the default) or not (false)
    * @return  string   the value of this tag
    */
   function getValue($asAtt=true) {
      $value = "";

      if ($asAtt) {
         $value = " value='".$this->_values[0]."'";
      } else {
         $value = $this->_values[0];
      }

      return $value;
   }

   /*
    *
    * @param
    * @return
    */
   function getText($ix=false) {
      return $this->_text;
   }

   /*
    *
    * @param
    * @return
    */
   function _getParagraphText($ix=false) {
      if ($ix === false) {
         return $this->_paragraphText;
      } else {
         return $this->_paragraphText($ix);
      }
   }

   function getParagraphTextCount() {
      return count($this->_text);
   }

   // *********************************************************************************************
   // HTML generation methods
   // *********************************************************************************************

   /*
    *
    * @param
    * @return
    */
   function getTag() {
      $text = "";
      switch ($this->_tagType) {
         case "notelist" : {
            $text = "<div";
            $text .= $this->_getClass();
            $text .= $this->_getAttributes();
            $text .= $this->_getStyles();
            $text .= ">";
            $text .= $this->_getText();
            $text .= "<ul>";
            foreach($this->_getParagraphText() as $txt) {
               $text .= "<li>$txt</li>";
            }
            $text .= "</ul>";
            $text .= "</div>";
            break;
         }
         default : {
            $text = "<".$this->_tagType;
            $text .= $this->_getClass();
            $text .= $this->_getAttributes();
            $text .= $this->_getStyles();
            $text .= ">";
            $text .= $this->_getText();
            $text .= "</".$this->_tagType.">";
            break;
         }
      }
      return $text;
   }

   /*
    * Get the current index
    * @return the current index
    */
   function _getIX() {
      return $this->_ix;
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

   // *********************************************************************************************
   // Private helper methods
   // *********************************************************************************************

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _getClass() {
      if (strlen($this->_class) > 0) {
         return " class='".$this->_class."'";
      }
      return "";
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function getName() {
      return " name='".$this->_name."'";
   }

   /*
    *
    * @param
    * @return
    * @access private
    */
   function _getText() {
      return $this->_text;
   }

   function _getAttributeSet() {
      $text .= $this->_getClass();
      $text .= $this->_getAttributes();
      $text .= $this->_getStyles();
      return $text;
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
         $text .= " $key='".$this->_attributes[$key]."'";
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
}
?>