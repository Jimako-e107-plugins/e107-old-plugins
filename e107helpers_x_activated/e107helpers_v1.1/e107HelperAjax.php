<?php

// To Do : See e107HelperForm_class.php

/**
 * e107 Logger Ajax request handler
 * <b>CVS Details:</b>
 * <ul>
 * <li>$Source: k:\Websites\_repository\e107_plugins/e107helpers/e107HelperAjax.php,v $</li>
 * <li>$Date: 2008/08/24 20:51:27 $</li>
 * </ul>
 * @author     $Author: Owner $
 * @version    $Revision: 1.6.2.1 $
 * @copyright  Released under the terms and conditions of the GNU General Public License (http://gnu.org).
 * @package e107HelperAjax
 */

   /**
    * Request handling code - needs turning in to a class
    */
   ob_start();

   require_once("../../class2.php");
   $e107HelperIncludeJS = false;
   require_once("e107Helper.php");

   $action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";

   $text = "<e107helperajax>";
   //print $action;
   switch ($action) {
      case "refreshImageTag" : {
         $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";
         $base = isset($_REQUEST["base"]) ? $_REQUEST["base"] : "";
         $dir = isset($_REQUEST["dir"]) ? $_REQUEST["dir"] : "";

         $dir .= ($dir == "") ? "" : "/";
         $imagelist = $e107Helper->getFileList($base.$dir);

         $text .= "<response type='innerhtml' id='{$id}_box'><![CDATA[";
         foreach ($imagelist as $key=>$image) {
            $text .= "<a href='javascript:e107Helper.addTextToField(\"$base$dir$image\",\"".$id."\")'>";
            $text .= "<img src='".$base.$dir."$image' style='border:0px' alt='*' /></a> ";
         }
         $text .= "]]></response>";
         break;
      }
      case "rate" : {
         $url = varset($_REQUEST["url"], "");
         $divid = varset($_REQUEST["divid"], "");
         $pluginid = varset($_REQUEST["pluginid"], false);
         $itemid = varset($_REQUEST["itemid"], false);
         $rating = varset($_REQUEST["rating"], false);
         $allowrating = varset($_REQUEST["allowrating"], false);
         $notext = varset($_REQUEST["notext"], false);
         $allstars = varset($_REQUEST["allstars"], false);

         // ********************************************************************************
         // Copied from e107/rate.php
         $qs = explode("^", $url);

         if (!$qs[0] || USER == FALSE || $qs[3] > 10 || $qs[3] < 1 || strpos($qs[2], '://') !== false) {
         	header("location:".e_BASE."index.php");
         	exit;
         }

         $table = $tp->toDB($qs[0]);
         $itemid = intval($qs[1]);
         $returnurl = $tp->toDB($qs[2]);
         $rate = intval($qs[3]);

         if ($sql->db_Select("rate", "*", "rate_table='{$table}' AND rate_itemid='{$itemid}'")) {
         	$row = $sql->db_Fetch();
         	if (strpos($row['rate_voters'], ".".USERID.".") === FALSE) {
         		$rate_voters = $row['rate_voters'].".".USERID.".";
         		$new_rating = $row['rate_rating']+$rate;
         		$sql->db_Update("rate", "rate_votes=rate_votes+1, rate_rating='{$new_rating}', rate_voters='{$rate_voters}' WHERE rate_itemid='{$itemid}' ");
         	}
         } else {
         	$sql->db_Insert("rate", " 0, '{$table}', '{$itemid}', '{$rate}', '1', '.".USERID.".' ");
         }
         // ********************************************************************************

         $text .= "<response type='innerhtml' id='$divid'><![CDATA[";
         $text .= $e107Helper->getRating2($pluginid, $itemid, $allowrating, $notext, $allstars);
         $text .= "]]></response>";
         break;
      }
      case "toggleImage" : {
         $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";
         $img1 = isset($_REQUEST["img1"]) ? $_REQUEST["img1"] : "";
         $img2 = isset($_REQUEST["img2"]) ? $_REQUEST["img2"] : "";

         $text .= "<response type='innerhtml' id='$id'><![CDATA[";
         $text .= "<img src='$img2' border='0' onclick='e107HelperAjax.toggleImage(\"".e_SELF."\", \"$id\", \"$img2\", \"$img1\")'/>";
         $text .= "]]></response>";
         break;
      }
      case "showCustomFields" : {
         $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";
         $customfields = isset($_REQUEST["customfields"]) ? new e107HelperCustomField($_REQUEST["customfields"]) : new e107HelperCustomField("", $id);
         $text .= "<response type='alert'><![CDATA[";
         $text .= $customfields->getAsString(true);
         $text .= $customfields->fieldstring;
         $text .= "]]></response>";
         break;
      }
      case "resetCustomFields" : {
         $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";
         $customfields = isset($_REQUEST["customfields"]) ? new e107HelperCustomField($_REQUEST["customfields"]) : new e107HelperCustomField("", $id);
         // Get new field list
         $text .= "<response type='innerhtml' id='{$id}_div'><![CDATA[";
         $text .= "<table style='display:inline;'>";
         $text .= $customfields->getFieldList();
         $text .= "</table>";
         $text .= "]]></response>";
         break;
      }
      case "addCustomField" : {
         $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";
         $step = isset($_REQUEST["step"]) ? $_REQUEST["step"] : "";
         $fieldtype = isset($_REQUEST["fieldtype"]) ? $_REQUEST["fieldtype"] : "";
         $fieldname = isset($_REQUEST["fieldname"]) ? $_REQUEST["fieldname"] : "";
         $customfields = isset($_REQUEST["customfields"]) ? new e107HelperCustomField($_REQUEST["customfields"], $id) : new e107HelperCustomField("", $id);

         switch ($step) {
            case 1 : {
               $pos_event = "if (document.getElementById(\"{$id}_select.value\") != \"0\"){ e107HelperAjax.addCustomField(\"".e_PLUGIN."e107helpers/e107HelperAjax.php\", \"$id\", 2, document.getElementById(\"{$id}_select\").value); }";

               $body .= HELPER_LAN_CF_FIELD_SELECT_TYPE."<br/>";
               $body .= "<select class='tbox' size='8' id='{$id}_select'>";
               $body .= "<option value='text'>".HELPER_LAN_CF_FIELD_TEXT."</option>";
               $body .= "<option value='textarea'>".HELPER_LAN_CF_FIELD_TEXTAREA."</option>";
               $body .= "<option value='select'>".HELPER_LAN_CF_FIELD_SELECT."</option>";
//               $body .= "<option value='date'>Date</option>";
               $body .= "<option value='checkbox'>".HELPER_LAN_CF_FIELD_CHECKBOX."</option>";
               $body .= "<option value='radio'>".HELPER_LAN_CF_FIELD_RADIO."</option>";
               $body .= "</select>";

               $click_select = "e107HelperAjax.addCustomField(\"".e_SELF."\", \"$id\", 2, document.getElementById(\"{$id}_select\").value);";
               $click_cancel = "e107HelperAjax.addCustomField(\"".e_SELF."\", \"$id\");";

               $text .= $customfields->getDialog($id, $body, "Custom Field", "{$id}_select", $click_cancel, "Cancel", $click_select, "Select");
               break;
            }
            case 2 : {
               // Kill previous dialog
               $text .= "<response type='killdialog' id='{$id}_dialog'>";
               $text .= "</response>";

               $form = $customfields->getForm($id, $fieldtype, $customfields);

               $click_select = "e107HelperAjax.addCustomField(\"".e_SELF."\", \"$id\", 3, document.getElementById(\"{$id}_fieldtype\").value);";
               $click_cancel = "e107HelperAjax.addCustomField(\"".e_SELF."\", \"$id\");";

               $body .= $form[1]."<input type='hidden' id='{$id}_fieldtype' value='$fieldtype'/>";
               //$help = $customfields->getHelp($fieldtype);
               $text .= $customfields->getDialog($id, $body, "Custom Field".$form[0], "{$id}_name", $click_cancel, "Cancel", $click_select, "Add");

               break;
            }
            case 3 : {
               $newfield["fieldtype"] = $fieldtype;

               // Get values for each attribute of the field
               foreach ($_REQUEST as $key => $fieldtype) {
                  if (strpos($key, $id) !== false && strlen($key) > strlen($id)) {
                     $key = substr($key, strlen($id)+1);
                     $newfield["$key"] = $fieldtype;
                  }
               }

               $customfields->addField($newfield["name"], $newfield);

               // Check for mandatory fields
               if ($newfield["name"] == "") {
                  $text .= "<response type='alert' id='{$id}_dialog'><![CDATA[";
                  $text .= HELPER_LAN_ERR_VAL_CUSTOM_01;
                  $text .= "]]></response>";
               } else {
                  // Kill previous dialog
                  $text .= "<response type='killdialog' id='{$id}_dialog'>";
                  $text .= "</response>";

                  // Add this field to the form's hidden custom fields list field
                  $text .= "<response type='setvalue' id='$id'><![CDATA[";
                  $text .= $customfields->getAsString();
                  $text .= "]]></response>";

                  // Add this field to the list of defined custom fields
                  $text .= "<response type='innerhtml' id='{$id}_div'><![CDATA[";
                  $text .= "<table style='display:inline;'>";
                  $text .= $customfields->getFieldList();
                  $text .= "</table>";
                  $text .= "]]></response>";
               }

               break;
            }
            case 10 : {
               $form = $customfields->getForm($id, $fieldtype, $customfields, $fieldname);

               $click_select = "e107HelperAjax.addCustomField(\"".e_SELF."\", \"$id\", 3, document.getElementById(\"{$id}_fieldtype\").value);";
               $click_cancel = "e107HelperAjax.addCustomField(\"".e_SELF."\", \"$id\");";

               $body .= $form[1]."<input type='hidden' id='{$id}_fieldtype' value='$fieldtype'/>";
               $text .= $customfields->getDialog($id, $body, "Custom Field".$form[0], "{$id}_label", $click_cancel, "Cancel", $click_select, "Update");

               break;
            }
            case 20 : {
               if ($customfields->deleteField($fieldname)) {
                  // Update the form's hidden custom fields list field
                  $text .= "<response type='setvalue' id='$id'><![CDATA[";
                  $text .= $customfields->getAsString();
                  $text .= "]]></response>";

                  // Update the list of defined custom fields
                  $text .= "<response type='innerhtml' id='{$id}_div'><![CDATA[";
                  $text .= "<table style='display:inline;'>";
                  $text .= $customfields->getFieldList();
                  $text .= "</table>";
                  $text .= "]]></response>";
               } else {
                  $text .= "<response type='alert'><![CDATA[";
                  $text .= "Failed: ".$fieldname;
                  $text .= "]]></response>";
               }
               break;
            }
            default : {
               // Kill previous dialog
               $text .= "<response type='killdialog' id='{$id}_dialog'>";
               $text .= "</response>";
               break;
            }
         }
         break;
      }
      default : {
         $text .= "<response type='alert''><![CDATA[";
         $text .= "e107HelperAjax - unknown action ($action)";
         $text .= "]]></response>";
      }
   }

   $text .= "</e107helperajax>";

   // Clear output buffer before we populate it with the Ajax response
   ob_end_clean();
   header('Content-type: text/xml');
   print $text;
   exit;
?>