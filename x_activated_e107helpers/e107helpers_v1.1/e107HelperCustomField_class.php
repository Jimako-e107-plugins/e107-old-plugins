<?php
/**
 * e107 Custom Field Helper class
 * <b>CVS Details:</b>
 * <ul>
 * <li>$Source: k:\Websites\_repository\e107_plugins/e107helpers/e107HelperCustomField_class.php,v $</li>
 * <li>$Date: 2008/08/24 20:50:21 $</li>
 * </ul>
 * @author     $Author: Owner $
 * @version    $Revision: 1.3.2.1 $
 * @copyright  Released under the terms and conditions of the GNU General Public License (http://gnu.org).
 * @package e107HelperForm
 */

/**
 * A Helper class for the e107 CMS system.
 * <p>Aimed at providing methods for mangaing the custom field control.</p>
 * @package    e107HelperForm
 */
   class e107HelperCustomField {
      var $id;
      var $fields;
      var $fieldstring;

      function e107HelperCustomField($fieldstring="", $id="") {
         if ($fieldstring == "") {
            $this->fieldstring = "";
            $this->fields = array();
            $this->setId($id);
         } else {
            if (ini_get("magic_quotes_gpc")) {
               $this->fieldstring = stripslashes($fieldstring);
            } else {
               $this->fieldstring = $fieldstring;
            }
            $this->fields = unserialize(html_entity_decode($this->fieldstring));
            $this->setId($id);
         }
      }

      function setId($id) {
         if (isset($id) && strlen($id) > 0) {
            // Don't want to set ID to an empty string
            $this->fields["e107HelperCustomField_id"] = $id;
         }
      }

      function addField($id, $field) {
         $this->fields[$id] = $field;
      }

      function count() {
         $count = 0;
         foreach ($this->fields as $key => $value) {
            if (is_array($value)) {
               $count++;
            }
         }
         return $count;
      }

      function getId() {
         return $this->fields["e107HelperCustomField_id"];
      }

      function isMandatory($ix) {
         $ix++; // Increment to bypass id field
         $keys = array_keys($this->fields);
         if (isset($keys[$ix])) {
            return isset($this->fields[$keys[$ix]]["mand"]) && $this->fields[$keys[$ix]]["mand"] != 0;
         }
         return false;
      }

      function getLabel($ix, $class="") {
         $ix++; // Increment to bypass id field
         $keys = array_keys($this->fields);
         if (isset($keys[$ix])) {
            $field = $this->fields[$keys[$ix]];
            $pre = "";
            $post = "";
            if ($class != "") {
               // Theme/template supplied
               $pre = "<span class='{$class}'>";
               $post = "</span>";
            } else if (isset($field["label_class"]) && strlen($field["label_class"]) > 0) {
               // Supplied by custom field definition
               $pre = "<span class='".$field["label_class"]."'>";
               $post = "</span>";
            }

            return $pre.$this->fields[$keys[$ix]]["label"].$post;
         }
         return "";
      }

      function getField($ix, $class="") {
         $ix++; // Increment to bypass id field
         $text = "";
         $keys = array_keys($this->fields);
         if (isset($keys[$ix])) {
            $field = $this->fields[$keys[$ix]];
            if (isset($field["field_class"]) && strlen($field["field_class"]) > 0 && $class == "") {
               $class = $field["field_class"];
            }
            switch ($field["fieldtype"]) {
               case "text" : {
                  $text = "<input type='text' class='$class'";
                  if (isset($field["name"]) && strlen($field["name"]) > 0) {
                     $text .= " value='".$this->getPostValue($field["name"])."'";
                     $text .= " name='".$field["name"]."'";
                  }
                  if (isset($field["size"]) && strlen($field["size"]) > 0) {
                     $text .= " size='".$field["size"]."'";
                  }
                  if (isset($field["maxl"]) && strlen($field["maxl"]) > 0) {
                     $text .= " maxlength='".$field["maxl"]."'";
                  }
                  $text .= "/>";
                  break;
               }
               case "textarea" : {
                  $text = "<textarea class='$class'";
                  if (isset($field["name"]) && strlen($field["name"]) > 0) {
                     $text .= " name='".$field["name"]."'";
                  }
                  if (isset($field["rows"]) && strlen($field["rows"]) > 0) {
                     $text .= " rows='".$field["rows"]."'";
                  }
                  if (isset($field["cols"]) && strlen($field["cols"]) > 0) {
                     $text .= " cols='".$field["cols"]."'";
                  }
                  $text .= ">";
                  $text .= $this->getPostValue($field["name"]);
                  $text .= "</textarea>";
                  break;
               }
               case "select" : {
                  $text = "<select class='$class'";
                  if (isset($field["name"]) && strlen($field["name"]) > 0) {
                     $text .= " name='".$field["name"]."'";
                  }
                  if ($field["row1"]) {
                     $text .= "<option value=''>".$field["row1"]."</option>";
                  }
                  $text .= ">";
                  $count = 0;
                  do {
                     $selected = $this->getPostValue($field["name"]) == $field["option{$count}"] ? " selected='true'" : "";
                     $text .= "<option value='".$field["option{$count}"]."'($selected}>".$field["option{$count}"]."</option>";
                     $count++;
                  } while ($this->getValue($field["name"], "option{$count}") != "");
                  $text .= "</select>";
                  break;
               }
               case "date" : {
                  $text = "<input type='text' class='$class'/>";
                  break;
               }
               case "checkbox" : {
                  $checked = $this->getPostValue($field["name"]) == "" ? "" : " checked='true'";
                  $text = "<input type='checkbox' class='$class'$checked";
                  $text .= " value='".$field["value"]."'";
                  if (isset($field["name"]) && strlen($field["name"]) > 0) {
                     $text .= " name='".$field["name"]."'";
                  }
                  $text .= "/>";
                  if (isset($field["text"]) && strlen($field["text"]) > 0) {
                     $text .= $field["text"];
                  }
                  break;
               }
               case "radio" : {
                  $text = "";
                  $count = 0;
                  $name = "";
                  if (isset($field["name"]) && strlen($field["name"]) > 0) {
                     $name = " name='".$field["name"]."'";
                  }
                  do {
                     $checked = $this->getPostValue($field["name"]) == $field["val{$count}"] ? " checked='true'" : "";
                     $text .= "<input type='radio' class='$class'{$name}{$checked} value='".$field["val{$count}"]."'/>".$field["text{$count}"];
                     $count++;
                  } while ($this->getValue($field["name"], "val{$count}") != "");
               }
            }
         }
         return $text;
      }

      function getName($ix) {
         $ix++; // Increment to bypass id field
         $keys = array_keys($this->fields);
         if (isset($keys[$ix])) {
            return $keys[$ix];
         }
         return "";
      }

      function getValue($id, $name) {
         if (isset($this->fields[$id][$name])) {
            return $this->fields[$id][$name];
         }
         return "";
      }

      function getPostValue($name) {
         if (isset($_POST[$name])) {
            return $_POST[$name];
         }
         return "";
      }

      function deleteField($id) {
         if (isset($this->fields[$id])) {
            unset($this->fields[$id]);
            return true;
         } else {
            return false;
         }
      }

      function getAsString($debug=false) {
         if ($debug) {
            $text1 = "";
            $text2 = "";
            foreach ($this->fields as $key => $value) {
               if (is_array($value)) {
                  $expt = var_export($value, true);
                  $expt = str_replace("\n", " ", $expt);
                  $text2 .= "$key = $expt\n";
               } else {
                  $text1 .= "$key = $value\n";
               }
            }
            //$text = str_replace("array", "array\n'", $text);
            return $text1.$text2;
         }
         return serialize($this->fields);
      }

      function getFieldList($ix) {
         $list = "";
         if ($this->count() > 0) {
            $list .= "<table style='display:inline;width:100%;'>";
            foreach ($this->fields as $key => $value) {
               if (is_array($value)) {
                  $list .= "<tr><td>&bull; $key (".$value["fieldtype"].")</td>";
                  $list .= "<td><a href='javascript:e107HelperAjax.addCustomField(\"".e_PLUGIN."e107helpers/e107HelperAjax.php\", \"".$this->getId()."_$ix\", 10, \"".$value["fieldtype"]."\", \"".$value["name"]."\")'>";
                  $list .= HELPER_ICON_EDIT."</a></td>";
                  $list .= "<td><a href='javascript:if (jsconfirm(\"".HELPER_LAN_15."?\")) {e107HelperAjax.addCustomField(\"".e_PLUGIN."e107helpers/e107HelperAjax.php\", \"".$this->getId()."_$ix\", 20, \"".$value["fieldtype"]."\", \"".$value["name"]."\");}'>";
                  $list .= HELPER_ICON_DELETE."</a></td></tr>"; //<tr><td colspan='3'><hr/></td></tr>";
               }
            }
            $list .= "</table>";
         }
         return $list;
      }


      function getForm($id, $value, $customfields, $fieldname="") {
         $pre = "<tr><td class='forumheader2'>";
         $inter = "</td><td class='forumheader2'>";
         $post = "</td></tr>";

         $readonly = ($fieldname=="") ? "" : " readonly='true'";
         $body = "<form>";
         $body .= "<table style='display:inline;'>";

         $body .= $pre.HELPER_LAN_CF_LABEL_NAME.$inter;
         $body .= "<input id='{$id}_name' name='{$id}_attrib' value='".$customfields->getValue($fieldname, "name")."' type='text' class='tbox'$readonly/>";
         $body .= "<br/>".HELPER_LAN_CF_HELP_NAME.$post;

         $body .= $pre.HELPER_LAN_CF_LABEL_LABEL.$inter;
         $body .= "<input id='{$id}_label' name='{$id}_attrib' value='".$customfields->getValue($fieldname, "label")."' type='text' class='tbox'/>";
         $body .= "<br/>".HELPER_LAN_CF_HELP_LABEL.$post;

         $body .= $pre.HELPER_LAN_CF_LABEL_CSS_FIELD.$inter;
         $body .= "<input id='{$id}_field_class' name='{$id}_attrib' value='".$customfields->getValue($fieldname, "field_class")."' type='text' class='tbox'/>";
         $body .= "<br/>".HELPER_LAN_CF_HELP_CSS_FIELD.$post;

         $body .= $pre.HELPER_LAN_CF_LABEL_CSS_LABEL.$inter;
         $body .= "<input id='{$id}_label_class' name='{$id}_attrib' value='".$customfields->getValue($fieldname, "label_class")."' type='text' class='tbox'/>";
         $body .= "<br/>".HELPER_LAN_CF_HELP_CSS_LABEL.$post;


         switch ($value) {
            case "text" : {
               $header = " : ".HELPER_LAN_CF_FIELD_TEXT;

               $body .= $pre.HELPER_LAN_CF_LABEL_SIZE.$inter;
               $body .= "<input id='{$id}_size' name='{$id}_attrib' value='".$customfields->getValue($fieldname, "size")."' type='text' class='tbox'/>";
               $body .= "<br/>".HELPER_LAN_CF_HELP_SIZE.$post;

               $body .= $pre.HELPER_LAN_CF_LABEL_MAX_LEN.$inter;
               $body .= "<input id='{$id}_maxl' name='{$id}_attrib' value='".$customfields->getValue($fieldname, "maxl")."' type='text' class='tbox'/>";
               $body .= "<br/>".HELPER_LAN_CF_HELP_MAX_LEN.$post;

               $checked = $customfields->getValue($fieldname, "mand")==1 ? " checked='true'" : "";
               $body .= $pre.HELPER_LAN_CF_LABEL_MANDATORY.$inter;
               $body .= "<input id='{$id}_mand' name='{$id}_attrib' value='1' type='checkbox' class='tbox'$checked/>";
               $body .= "<br/>".HELPER_LAN_CF_HELP_MANDATORY.$post;

               break;
            }
            case "textarea" : {
               $header = " : ".HELPER_LAN_CF_FIELD_TEXTAREA;

               $body .= $pre.HELPER_LAN_CF_LABEL_ROWS.$inter;
               $body .= "<input id='{$id}_rows' name='{$id}_attrib' value='".$customfields->getValue($fieldname, "rows")."' type='text' class='tbox'/>";
               $body .= "<br/>".HELPER_LAN_CF_HELP_ROWS.$post;

               $body .= $pre.HELPER_LAN_CF_LABEL_COLS_WIDTH.$inter;
               $body .= "<input id='{$id}_cols' name='{$id}_attrib' value='".$customfields->getValue($fieldname, "cols")."' type='text' class='tbox'/>";
               $body .= "<br/>".HELPER_LAN_CF_HELP_COLS_WIDTH.$post;

               $checked = $customfields->getValue($fieldname, "mand")==1 ? " checked='true'" : "";
               $body .= $pre.HELPER_LAN_CF_LABEL_MANDATORY.$inter;
               $body .= "<input id='{$id}_mand' name='{$id}_attrib' value='1' type='checkbox' class='tbox'$checked/>";
               $body .= "<br/>".HELPER_LAN_CF_HELP_MANDATORY.$post;
               break;
            }
            case "select" : {
               $header = " : ".HELPER_LAN_CF_FIELD_SELECT;

               $body .= $pre.HELPER_LAN_CF_LABEL_FIRST_ROW.$inter;
               $body .= "<input id='{$id}_row1' name='{$id}_attrib' value='".$customfields->getValue($fieldname, "row1")."' type='text' class='tbox'/>";
               $body .= "<br/>".HELPER_LAN_CF_HELP_FIRST_ROW.$post;

               $body .= $pre.HELPER_LAN_CF_LABEL_OPTIONS.$inter;
               $body .= "<div id='select_container' style='white-space:nowrap;'>";
               $count = 0;
               do {
                  $body .= "<span id='selectline' style='white-space:nowrap;'>";
                  $body .= "<input id='{$id}_option' name='{$id}_option[]' value='".$customfields->getValue($fieldname, "option{$count}")."' type='text' class='tbox'/>";
                  if ($count > 0) {
                     $body .= "<input type='button' onclick='this.parentNode.parentNode.removeChild(this.parentNode);' class='button' value='x'>";
                     $body .= "<br/></span>";
                  } else {
                     $body .= "</span><br/>";
                  }
                  $count++;
               } while ($customfields->getValue($fieldname, "option{$count}") != "");
               $body .= "</div>";
               $body .= "<input type='button' onclick='javascript:duplicateHTML(\"selectline\",\"select_container\");' class='button' value='+'>";
               $body .= "<br/>".HELPER_LAN_CF_HELP_OPTIONS.$post;
               break;
            }
            case "date" : {
               $header = " : ".HELPER_LAN_CF_FIELD_DATE;

               $body .= $pre.HELPER_LAN_CF_LABEL_YEAR_FROM.$inter;
               $body .= "<input id='{$id}_yearfrom' name='{$id}_attrib' value='".$customfields->getValue($fieldname, "yearfrom")."' type='text' class='tbox'/>";
               $body .= "<br/>".HELPER_LAN_CF_HELP_YEAR_FROM.$post;

               $body .= $pre.HELPER_LAN_CF_LABEL_YEAR_TO.$inter;
               $body .= "<input id='{$id}_yearto'   name='{$id}_attrib' value='".$customfields->getValue($fieldname, "yearto")."' type='text' class='tbox'/>";
               $body .= "<br/>".HELPER_LAN_CF_HELP_YEAR_TO.$post;

               $checked = $customfields->getValue($fieldname, "mand")==1 ? " checked='true'" : "";
               $body .= $pre.HELPER_LAN_CF_LABEL_MANDATORY.$inter;
               $body .= "<input id='{$id}_mand' name='{$id}_attrib' value='1' type='checkbox' class='tbox'$checked/>";
               $body .= "<br/>".HELPER_LAN_CF_HELP_MANDATORY.$post;
               break;
            }
            case "checkbox" : {
               $header = " : ".HELPER_LAN_CF_FIELD_CHECKBOX;

               $body .= $pre.HELPER_LAN_CF_LABEL_VALUE.$inter;
               $body .= "<input id='{$id}_value' name='{$id}_attrib' value='".$customfields->getValue($fieldname, "value")."' type='text' class='tbox'/>";
               $body .= "<br/>".HELPER_LAN_CF_HELP_VALUE.$post;

               $body .= $pre.HELPER_LAN_CF_LABEL_TEXT.$inter;
               $body .= "<input id='{$id}_text' name='{$id}_attrib' value='".$customfields->getValue($fieldname, "text")."' type='text' class='tbox'/>";
               $body .= "<br/>".HELPER_LAN_CF_HELP_TEXT.$post;
               break;
            }
            case "radio" : {
               $header = " : ".HELPER_LAN_CF_FIELD_RADIO;

               $body .= $pre.HELPER_LAN_CF_LABEL_TEXT_VALUE.$inter;
               $body .= "<div id='select_container' style='white-space:nowrap;'>";
               $count = 0;
               do {
                  $body .= "<span id='selectline' style='white-space:nowrap;'>";
                  $body .= "<input id='{$id}_text' name='{$id}_option[]' value='".$customfields->getValue($fieldname, "text{$count}")."' type='text' class='tbox'/>";
                  $body .= "<input id='{$id}_val'  name='{$id}_option[]' value='".$customfields->getValue($fieldname, "val{$count}")."' type='text' class='tbox'/>";
                  if ($count > 0) {
                     $body .= "<input type='button' onclick='this.parentNode.parentNode.removeChild(this.parentNode);' class='button' value='x'>";
                     $body .= "<br/></span>";
                  } else {
                     $body .= "</span><br/>";
                  }
                  $count++;
               } while ($customfields->getValue($fieldname, "val{$count}") != "");
               $body .= "</div>";
               $body .= "<input type='button' onclick='javascript:duplicateHTML(\"selectline\",\"select_container\");' class='button' value='+'>";
               $body .= "<br/>".HELPER_LAN_CF_HELP_TEXT_VALUE.$post;
               break;
            }
         }
         $body .= "</table>";
         $body .= "</form>";
         return array($header, $body);
      }

      function getDialog($id, $body, $header="", $focus="", $cancel_event="", $cancel_text="Cancel", $ok_event="", $ok_text="Select", $help=false) {

         // Dialog start
         $text .= "<response type='dialog' id='{$id}_dialog' focus='{$focus}' key='e107Helper.dialogKeyHandler'><![CDATA[";
         $text .= "<div style='border:2px outset;padding:1px;'>";
         // Header
         if ($header) {
            $text .= "<div class='forumheader' style='text-align:center;font-size:110%;font-weight:bold;padding:5px;'>$header</div>";
         }
         // Body
         $text .= "<div class='forumheader3' style='padding:15px;'>$body</div>";
         // Help
         $text .= $help ? "<div class='forumheader3 smalltext' style='padding:2px;'>$help</div>" : "";
         // Buttons
         if ($ok_text || $cancel_text) {
            $text .= "<div class='forumheader2' style='text-align:right;padding:5px;'>";
            if ($ok_text) {
               $text .= "<input type='button' class='button' id='{$id}_ok' value='$ok_text' onclick='$ok_event'/>";
            }
            $text .= "&nbsp;";
            if ($cancel_text) {
               $text .= "<input type='button' class='button' value='$cancel_text' onclick='$cancel_event'/>";
            }
            $text .= "<script type='text/javascript'>";
            $text .= "  document.getElementById('{$id}_dialog').onkeypress = function(ev) { e107Helper.dialogKeyHandler(ev, '$cancel_event', '$ok_event');}";
            $text .= "</script>";
            $text .= "</div>";
         }
         // Dialog end
         $text .= "</div>";
         $text .= "]]></response>";
         return $text;
      }

      function getHelp($fieldtype) {
         $help = false;
         switch ($fieldtype) {
            case "text" :
               $help .= "<dt>".HELPER_LAN_CF_LABEL_NAME."</dt>";
               $help .= "<dd>".HELPER_LAN_CF_HELP_NAME."</dd>";
               $help .= "<dt>".HELPER_LAN_CF_LABEL_LABEL."</dt>";
               $help .= "<dd>".HELPER_LAN_CF_HELP_LABEL."</dd>";
               $help .= "<dt>".HELPER_LAN_CF_LABEL_CSS_FIELD."</dt>";
               $help .= "<dd>".HELPER_LAN_CF_HELP_CSS_FIELD."</dd>";
               $help .= "<dt>".HELPER_LAN_CF_LABEL_CSS_LABEL."</dt>";
               $help .= "<dd>".HELPER_LAN_CF_HELP_CSS_LABEL."</dd>";
               $help .= "<dt>".HELPER_LAN_CF_LABEL_SIZE."</dt>";
               $help .= "<dd>".HELPER_LAN_CF_HELP_SIZE."</dd>";
               $help .= "<dt>".HELPER_LAN_CF_LABEL_MAX_LEN."</dt>";
               $help .= "<dd>".HELPER_LAN_CF_HELP_MAX_LEN."</dd>";
               $help .= "<dt>".HELPER_LAN_CF_LABEL_MANDATORY."</dt>";
               $help .= "<dd>".HELPER_LAN_CF_HELP_MANDATORY."</dd>";
               break;
         }
         return $help ? "<dl>$help</dl>" : "";
      }
   }
?>