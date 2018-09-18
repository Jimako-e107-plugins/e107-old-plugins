<?php
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
if (!isset($tp)) {
   $tp = new e_parse();
   $tp->e_sc = new e_shortcode();
}
global $contactform_shortcodes;
$contactform_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);

/*

// ---------------------------------------------------------------------------------------------------------------------------------------------------
SC_BEGIN CONTACTFORM_PAGE_NAME
   global $contactform_page;
   return $contactform_page["cf_page_name"];
SC_END

SC_BEGIN CONTACTFORM_PAGE_DESCRIPTION
   global $contactform_page;
   return $contactform_page["cf_page_description"];
SC_END

SC_BEGIN CONTACTFORM_SEND_TO
   global $pref, $sql, $contactform_emails;
   $text = "";
   parse_str($parm, $parms);
   if (array_key_exists("label", $parms)) {
      $text .= CONTACTFORM_00;
      if (count($contactform_emails) > 1) {
         $text .= " <span style='color:#".$pref['contactform_mandatory_color']."'>".$pref['contactform_mandatory_symbol']."</span>";
      }
   }
   if (array_key_exists("divider", $parms)) {
      $text .= $parms["divider"];
   }
   if (array_key_exists("field", $parms)) {
      if (count($contactform_emails) > 1 || !array_key_exists("readonly", $parms)) {
         $text .= "<select class='tbox' name='id' size='1'";
         if ($pref['contactform_send_to_as_colums'] == "Y") {
            $text .= " style='font-family:monospace;font-size:100%;'";
         }
         $text .= ">";
         if (count($contactform_emails) > 1) {
            $text .= "<option value=''>&nbsp;</option>";
         }
         foreach ($contactform_emails as $email){
            extract($email);
            $selected = isset($_POST['id']) && $_POST['id'] == $id ? " selected" : "";
            $text .= "<option value='$id'$selected>";
            if ($pref['contactform_send_to_as_colums'] == "Y") {
               $text .= str_replace(" ", "&nbsp;", str_pad($title, 31, " ")) . $full_name;
            } else {
               $text .= "$title ($full_name)";
            }
            $text .= "</option>";
         }
         $text .= "</select>";
      } else {
         extract($contactform_emails[0]);
         $text .= "<input type='hidden' name='id' value='$id'/>$title ($full_name)";
      }
   }
   return $text;
SC_END

SC_BEGIN CONTACTFORM_YOUR_NAME
   global $contactform_page, $pref;
   if ($contactform_page['cf_page_sender_name'] == 0) {
      return "";
   }
   $text = "";
   parse_str($parm, $parms);
   if (array_key_exists("label", $parms)) {
      $text .= CONTACTFORM_01;
      if ($contactform_page['cf_page_sender_name'] == 2) {
         $text .= " <span style='color:#".$pref['contactform_mandatory_color']."'>".$pref['contactform_mandatory_symbol']."</span>";
      }
   }
   if (array_key_exists("divider", $parms)) {
      $text .= $parms["divider"];
   }
   if (array_key_exists("field", $parms)) {
      $name = USER ? USERNAME : "";
      $name = isset($_POST['name']) ? $_POST['name'] : $name;
      $text .= "<input class='tbox' name='name' type='text' value='$name' maxlength='50' size='50'/>";
   }
   return $text;
SC_END

SC_BEGIN CONTACTFORM_YOUR_EMAIL
   global $contactform_page, $pref;
   if ($contactform_page['cf_page_sender_email'] == 0) {
      return "";
   }
   $text = "";
   parse_str($parm, $parms);
   if (array_key_exists("label", $parms)) {
      $text .= CONTACTFORM_02;
      if ($contactform_page['cf_page_sender_email'] == 2) {
         $text .= " <span style='color:#".$pref['contactform_mandatory_color']."'>".$pref['contactform_mandatory_symbol']."</span>";
      }
   }
   if (array_key_exists("divider", $parms)) {
      $text .= $parms["divider"];
   }
   if (array_key_exists("field", $parms)) {
      $email = USER ? USEREMAIL : "";
      $email = isset($_POST['email']) ? $_POST['email'] : $email;
      $text .= "<input class='tbox' name='email' type='text' value='$email' maxlength='50' size='50'/>";
   }
   return $text;
SC_END

SC_BEGIN CONTACTFORM_SUBJECT
   global $contactform_page, $pref;
   if ($contactform_page['cf_page_subject'] == 0) {
      return "";
   }
   $text = "";
   parse_str($parm, $parms);
   if (array_key_exists("label", $parms)) {
      $text .= CONTACTFORM_03;
      if ($contactform_page['cf_page_subject'] == 2) {
         $text .= " <span style='color:#".$pref['contactform_mandatory_color']."'>".$pref['contactform_mandatory_symbol']."</span>";
      }
   }
   if (array_key_exists("divider", $parms)) {
      $text .= $parms["divider"];
   }
   if (array_key_exists("field", $parms)) {
      $text .= "<input class='tbox' name='subject' type='text' value='".$_POST['subject']."' maxlength='50' size='50'/>";
   }
   return $text;
SC_END

SC_BEGIN CONTACTFORM_MESSAGE
// TODO
//if ($pref['wysiwyg'] && $pref['contactform_htmlarea']) {
//   require_once(e_HANDLER . "tiny_mce/wysiwyg.php");
//   echo wysiwyg("message");
//}
   global $contactform_page, $pref;
   $text = "";
   parse_str($parm, $parms);
   if (array_key_exists("label", $parms)) {
      $text .= CONTACTFORM_04;
      if ($contactform_page['cf_page_message'] == 2) {
         $text .= " <span style='color:#".$pref['contactform_mandatory_color']."'>".$pref['contactform_mandatory_symbol']."</span>";
      }
   }
   if (array_key_exists("divider", $parms)) {
      $text .= $parms["divider"];
   }
   if (array_key_exists("field", $parms)) {
      $text .= "<textarea class='tbox' name='message' rows='10' cols='' style='width:100%'>".$_POST['message']."</textarea>";
   }
   return $text;
SC_END

SC_BEGIN CONTACTFORM_SEND_TO_ME
   global $contactform_page, $pref;
   if ($contactform_page['cf_page_cc'] == 0) {
      return "";
   }
   $text = "";
   parse_str($parm, $parms);
   if (array_key_exists("label", $parms)) {
      $text .= CONTACTFORM_05;
   }
   if (array_key_exists("divider", $parms)) {
      $text .= $parms["divider"];
   }
   if (array_key_exists("field", $parms)) {
      $checked = "";
      if (isset($_POST['sendtome'])) {
         $checked = "checked='true'";
      }
      $text .= "<label for='sendtome'><input type='checkbox' id='sendtome' name='sendtome' value='Y' class='tbox'$checked/>".CONTACTFORM_06."</label>";
   }
   return $text;
SC_END

SC_BEGIN CONTACTFORM_CUSTOM_FIELDS
   global $contactform_page, $pref;
   parse_str($parm, $parms);
   $customfields = new e107HelperCustomField($contactform_page["cf_page_custom"]);
   $text = "";
   for ($i=0; $i<$customfields->count(); $i++) {
      if (array_key_exists("pre", $parms)) {
         $text .= $parms["pre"];
      }
      if (array_key_exists("label", $parms)) {
         $labelcss = "";
         if (array_key_exists("labelcss", $parms)) {
            $labelcss = $parms["labelcss"];
         }
         $text .= $customfields->getLabel($i, $labelcss);
         if ($customfields->ismandatory($i)) {
            $text .= " <span style='color:#".$pref['contactform_mandatory_color']."'>".$pref['contactform_mandatory_symbol']."</span>";
         }
      }
      if (array_key_exists("divider", $parms)) {
         $text .= $parms["divider"];
      }
      if (array_key_exists("field", $parms)) {
         $fieldcss = "";
         if (array_key_exists("fieldcss", $parms)) {
            $fieldcss = $parms["fieldcss"];
         }
         $text .= $customfields->getField($i, $fieldcss);
      }
      if (array_key_exists("post", $parms)) {
         $text .= $parms["post"];
      }
   }
   return $text;
SC_END

SC_BEGIN CONTACTFORM_CUSTOM_FIELD
   global $contactform_page, $pref;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("number", $parms)) {
      $customfields = new e107HelperCustomField($contactform_page["cf_page_custom"]);
      if (array_key_exists("label", $parms)) {
         $text .= $customfields->getLabel($parms["number"]);
      }
      if (array_key_exists("divider", $parms)) {
         $text .= $parms["divider"];
      }
      if (array_key_exists("field", $parms)) {
         $text .= $customfields->getField($parms["number"]);
      }
   }
   return $text;
SC_END

SC_BEGIN CONTACTFORM_OLD_CUSTOM_FIELD
   global $pref;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("number", $parms)) {
      if (strlen($pref['contactform_custom_'.$parms["number"]]) == 0) {
         return "";
      }
      $text = "";
      if (array_key_exists("label", $parms)) {
         $text .= $pref['contactform_custom_'.$parms["number"]];
      }
      if (array_key_exists("divider", $parms)) {
         $text .= $parms["divider"];
      }
      if (array_key_exists("field", $parms)) {
         $text .= "<input class='tbox' name='custom".$parms["number"]."' type='text' value='".$_POST['custom'.$parms["number"]]."' maxlength='50' size='50'/>";
      }
   }
   return $text;
SC_END

SC_BEGIN CONTACTFORM_SECURE_IMAGE
   global $pref;
   if ($pref['contactform_image_code_verify'] != "Y") {
      return "";
   }
   require_once(e_HANDLER."secure_img_handler.php");
   $sec_img = new secure_image();
   $text = "";
   parse_str($parm, $parms);
   if (array_key_exists("label", $parms)) {
      $text .= "<input type='hidden' name='rand_num' value='".$sec_img->random_number."'/>".$sec_img->r_image();
   }
   if (array_key_exists("divider", $parms)) {
      $text .= $parms["divider"];
   }
   if (array_key_exists("field", $parms)) {
      $text .= "&nbsp;<input class='tbox' type='text' name='code_verify' size='15' maxlength='20' /> ";
      $text .= CONTACTFORM_23;
   }
   return $text;
SC_END

SC_BEGIN CONTACTFORM_MESSAGE_MANDATORY
   global $pref;
   if (($pref['contactform_sender_name'] == 2)
    || ($pref['contactform_sender_email'] == 2)
    || ($pref['contactform_subject'] == 2)
    || ($pref['contactform_message'] == 2))
   {
      return str_replace("*", $pref['contactform_mandatory_symbol'], CONTACTFORM_16);
   }
   return "";
SC_END

SC_BEGIN CONTACTFORM_BUTTONS
   global $contactform_shortcodes, $tp;
   $text = "";
   $text .= $tp->parseTemplate("{CONTACTFORM_BUTTON_SUBMIT}", FALSE, $contactform_shortcodes);
   $text .= "&nbsp;";
   $text .= $tp->parseTemplate("{CONTACTFORM_BUTTON_RESET}", FALSE, $contactform_shortcodes);
   return $text;
SC_END

SC_BEGIN CONTACTFORM_BUTTON_SUBMIT
   return "<input class='button' name='submit' type='submit' value='".CONTACTFORM_07."'/>";
SC_END

SC_BEGIN CONTACTFORM_BUTTON_RESET
   return "<input class='button' name='reset' type='reset' value='".CONTACTFORM_08."'/>";
SC_END

SC_BEGIN CONTACTFORM_IP_TRACKING
   global $pref;
   parse_str($parm, $parms);
   $text = "";
   if (($pref['contactform_track_ip'] == "Y")) {
      $text .= CONTACTFORM_25;
      if (array_key_exists("ipaddress", $parms)) {
         $text .= " ".CONTACTFORM_26." ".$_SERVER['REMOTE_ADDR'].".";
      }
      if (array_key_exists("hostname", $parms)) {
         $text .= " ".CONTACTFORM_27." ".gethostbyaddr($_SERVER['REMOTE_ADDR']).".";
      }
   }
   return $text;
SC_END

SC_BEGIN CONTACTFORM_DISPLAY_MESSAGE
   global $contactform_display_message;
   return $contactform_display_message;
SC_END

*/
?>
