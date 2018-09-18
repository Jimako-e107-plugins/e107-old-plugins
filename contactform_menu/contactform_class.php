<?php
/*
+---------------------------------------------------------------+
| Contact Form by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/contactform_menu/contactform_class.php,v $
| $Revision: 1.3.2.10 $
| $Date: 2007/07/31 22:47:56 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
if (!class_exists("ContactForm")) {
   if (file_exists(e_PLUGIN."contactform_menu/languages/".e_LANGUAGE.".php")){
      require_once(e_PLUGIN."contactform_menu/languages/".e_LANGUAGE.".php");
   } else {
      require_once(e_PLUGIN."contactform_menu/languages/English.php");
   }

   require_once(e_PLUGIN."contactform_menu/contactform_constants.php");
   require_once(e_HANDLER."mail.php");

   // Templates
   $query = defset("e_QUERY", "");
   // Page specific (from theme)
   if (file_exists(THEME."contactform_{$query}_template.php")) {
      include_once(THEME."contactform_{$query}_template.php");
   }
   // Theme specific
   if (file_exists(THEME."contactform_template.php")) {
      include_once(THEME."contactform_template.php");
   }
   // Page specific (plugin)
   if (file_exists(e_PLUGIN."contactform_menu/templates/contactform_{$query}_template.php")) {
      include_once(e_PLUGIN."contactform_menu/templates/contactform_{$query}_template.php");
   }
   // Plugin default
   if (file_exists(e_PLUGIN."contactform_menu/templates/contactform_template.php")) {
      include_once(e_PLUGIN."contactform_menu/templates/contactform_template.php");
   }

   // Shortcodes
   include_once(e_PLUGIN."contactform_menu/contactform_shortcodes.php");

   // Include the e107 Helper classes
   if (file_exists(e_PLUGIN."e107helpers/e107Helper.php")) {
      require_once(e_PLUGIN."e107helpers/e107Helper.php");
   } else {
      print "Fatal error, cannot find the required e107 Helper Project plugin";
   }

   class ContactForm {
      var $debug;

      function getMainPage() {
         global $ns, $pref, $tp, $CONTACTFORM_INFO;
         if ($pref["contactform_contact_details"] == 1) {
            if (SITECONTACTINFO && $CONTACTFORM_INFO){
            	$text = $tp->toHTML($CONTACTFORM_INFO, "", "nobreak parse_sc");
            	$ns->tablerender(CONTACTFORM_22, $text);
            }
         }

         switch ($_POST['submit']) {
            case CONTACTFORM_07: {
               $text = $this->sendMail();
               break;
            }
            default: {
               $text = $this->showForm();
               break;
            }
         }
         $ns->tablerender($text[0], $text[1]);

         if ($pref["contactform_contact_details"] == 2) {
            if (SITECONTACTINFO && $CONTACTFORM_INFO){
            	$text = $tp->toHTML($CONTACTFORM_INFO, "", "nobreak parse_sc");
            	$ns->tablerender(CONTACTFORM_22, $text);
            }
         }
      }

      function showForm($msg="") {
         global $contactform_emails, $contactform_page, $contactform_display_message, $contactform_shortcodes, $pref, $sql, $tp, $CONTACTFORM_FORM;

         // Get details for the page we are displaying
         $query = defset("e_QUERY", "");
         if (!$sql->db_Select("contactform_pages", "*", "cf_page_query='$query'", true)) {
            // Invalid query string
            header("location:../../index.php");
         }

         $contactform_page = $sql->db_Fetch();

         // Check that current user can view this page
         if (!check_class($contactform_page["cf_page_userclass"])) {
            header("location:../../index.php");
         }

         // Get e-mails for this page
         $regexp = "(^|,)(".$contactform_page["cf_page_id"].")(,|$)";
         $sql->db_Select("contactform", "*", "page_id REGEXP('$regexp') order by display_order asc", true);
         $contactform_emails = array();
         while ($row = $sql->db_Fetch()){
            $contactform_emails[] = $row;
         }

         // Generate the page
         $contactform_display_message = $msg;
         $page = "<form method='post' action='".e_SELF."?".e_QUERY."'>";
         $page .= $tp->parseTemplate($CONTACTFORM_FORM, FALSE, $contactform_shortcodes);
         $page .= "</form>";

         return array($contactform_page["cf_page_name"], $page);
      }

      function sendMail() {
         global $sql, $pref;

         // Get details for the page we are displaying
         $query = defset("e_QUERY", "");
         if (!$sql->db_Select("contactform_pages", "*", "cf_page_query='$query'", true)) {
            // Invalid query string
            header("location:../../index.php");
         }

         $contactform_page = $sql->db_Fetch();

         // Check mandatory fields have been completed
         $msg = "";
         if (strlen($_POST['id']) == 0) {
            $msg .= " ".CONTACTFORM_00;
         }
         if (strlen($_POST['name']) == 0 && $contactform_page['cf_page_sender_name']==2) {
            $msg .= " ".CONTACTFORM_01;
         }
         if (strlen($_POST['email']) == 0 && $contactform_page['cf_page_sender_email']==2) {
            $msg .= strlen($msg) > 0 ? ", " : "";
            $msg .= " ".CONTACTFORM_02;
         }
         if (strlen($_POST['subject']) == 0 && $contactform_page['cf_page_subject']==2) {
            $msg .= strlen($msg) > 0 ? ", " : "";
            $msg .= " ".CONTACTFORM_03;
         }
         if (strlen($_POST['message']) == 0 && $contactform_page['cf_page_message']==2) {
            $msg .= strlen($msg) > 0 ? ", " : "";
            $msg .= " ".CONTACTFORM_04;
         }

         $cf = new e107HelperCustomField($contactform_page['cf_page_custom']);
         for ($i=0; $i< $cf->count(); $i++) {
            if ($cf->isMandatory($i) && strlen($cf->getPostValue($cf->getName($i))) == 0) {
               $msg .= strlen($msg) > 0 ? ", " : "";
               $msg .= " ".$cf->getName($i);
            }
         }

         if (strlen($msg) > 0) {
            $msg = CONTACTFORM_13."<br>".$msg;
            return $this->showForm($msg);
         }

         // Check validity of fields
         if ($contactform_page['cf_page_sender_email']==2) {
            // Check we can use the validateemail function (it uses stuff not available in windows PHP)
            if (is_object(getmxrr)) {
               $ret = validatemail($_POST['email']);
               if (!$ret[0]) {
                  $msg = CONTACTFORM_21."<br>".$ret[1];
                  return $this->showForm($msg);
               }
            }
         }

         if ($pref["contactform_image_code_verify"] == "Y") {
            require_once(e_HANDLER."secure_img_handler.php");
            $sec_img = new secure_image();
            if (!$sec_img->verify_code($_POST['rand_num'], $_POST['code_verify'])) {
               $msg = CONTACTFORM_24;
               return $this->showForm($msg);
            }
         }

         if (!isset($_POST['subject']) || strlen($_POST['subject']) == 0) {
            $_POST['subject'] = CONTACTFORM_17;
         }
         if (!isset($_POST['email']) || strlen($_POST['email']) == 0) {
            $_POST['email'] = CONTACTFORM_18;
         }
         if (!isset($_POST['name']) || strlen($_POST['name']) == 0) {
            $_POST['name'] = CONTACTFORM_19;
         }
         if (!isset($_POST['message']) || strlen($_POST['message']) == 0) {
            $_POST['message'] = CONTACTFORM_20;
         }

         $sql->db_Select("contactform", "*", "id='".$_POST['id']."'");
         $row = $sql->db_Fetch();
         if ($row) {
            for ($i=1; $i<5; $i++) {
               if (strlen($pref['contactform_custom_'.$i]) > 0) {
                  if (isset($_POST["custom".$i]) && strlen($_POST["custom".$i]) > 0) {
                     $customfields .= $pref["contactform_custom_".$i]." : ".$_POST["custom".$i]."\n";
                  }
               }
            }

            for ($i=0; $i< $cf->count(); $i++) {
               if (strlen($cf->getPostValue($cf->getName($i))) > 0) {
                  $customfields .= $cf->getLabel($i)." : ".$cf->getPostValue($cf->getName($i))."\n";
               }
            }

            $fromMail = varset($_POST["email"], $pref["contactform_default_from_email"]);
            $fromName = varset($_POST["name"], $pref["contactform_default_from_name"]);
            $cc = (isset($_POST["sendtome"])) ? $_POST["email"] : "";
            $to = str_replace("\r\n", ",", $row["email"]);

            $ret = sendemail($to,                                                   // send to e-mail
                             $pref["contactform_subject_prefix"].$_POST["subject"], // subject
                             $customfields.$_POST["message"],                       // message text
                             $row["title"],                                         // to name
                             $_POST["email"],                                       // from e-mail
                             $_POST["name"],                                        // from name
                             false,                                                 // attachments
                             $cc);                                                  // cc

            if (($pref['contactform_track_ip'] == "Y")) {
               $logmessage = CONTACTFORM_28;
               $logmessage .= " ".CONTACTFORM_26." ".$_SERVER['REMOTE_ADDR'].".";
               $logmessage .= " ".CONTACTFORM_27." ".gethostbyaddr($_SERVER['REMOTE_ADDR']).".";
               $logmessage .= " ($ret)";
               $sql->db_Write_log(CONTACTFORM_NAME, $logmessage, CONTACTFORM_NAME);
            }

            if ($pref["contactform_debug"] == "1") {
               $this->debug = "E-Mail: {$row['email']}<br/>Subject: {$pref['contactform_subject_prefix']}{$_POST['subject']}<br/>Message: {$customfields}{$_POST['message']}<br/>Title: {$row['title']}<br/>E-Mail {$_POST['email']}<br/>Name {$_POST['name']}<br/> false<br/>E-Mail: {$_POST['email']}";
            }

            if (!$ret) {
               return $this->showForm(CONTACTFORM_12);
            }
         }

         return $this->showForm($pref["contactform_confirmation_message"]);
      }

      function getAdminMenu() {
         global $pageid;

         $menutitle  = CONTACTFORM_NAME;

         $butname[]  = CONTACTFORM_MENU_00;
         $butlink[]  = "admin_emails.php";
         $butid[]    = CONTACTFORM_MENU_00;

         $butname[]  = CONTACTFORM_MENU_04;
         $butlink[]  = "admin_pages.php";
         $butid[]    = CONTACTFORM_MENU_04;

         $butname[]  = CONTACTFORM_MENU_01;
         $butlink[]  = "admin_config.php";
         $butid[]    = CONTACTFORM_MENU_01;

         $butname[]  = CONTACTFORM_MENU_02;
         $butlink[]  = "admin_fields.php";
         $butid[]    = CONTACTFORM_MENU_02;

         $butname[]  = CONTACTFORM_MENU_03;
         $butlink[]  = "admin_readme.php";
         $butid[]    = CONTACTFORM_MENU_03;

         for ($i=0; $i<count($butname); $i++) {
            $var[$butid[$i]]['text'] = $butname[$i];
            $var[$butid[$i]]['link'] = $butlink[$i];
         };

         show_admin_menu($menutitle, $pageid, $var);
      }

      function getAdminEMailsPage() {
         global $pageid, $e107HelperForm;
         $title   = CONTACTFORM_MENU_00;
         $pageid  = CONTACTFORM_MENU_00;

         // Create a form using the helper classes
         $e107HelperForm->createFormFromXML("forms/emails");

         // Process the form
         $e107HelperForm->processForm(true, true);
         $text = $e107HelperForm->getFormHTML();
         return array($title, $text);
      }

      function getAdminPagesPage() {
         global $pageid, $e107HelperForm;
         $title   = CONTACTFORM_MENU_04;
         $pageid  = CONTACTFORM_MENU_04;

         // Create a form using the helper classes
         $e107HelperForm->createFormFromXML("forms/pages");

         // Process the form
         $e107HelperForm->processForm(true, true);
         $text = $e107HelperForm->getFormHTML();
         return array($title, $text);
      }

      function getAdminPrefsPage() {
         global $pageid, $e107HelperForm;
         $title   = CONTACTFORM_MENU_01;
         $pageid  = CONTACTFORM_MENU_01;

         // Create a form using the helper classes
         $e107HelperForm->createFormFromXML("forms/prefs");

         // Process the form
         $e107HelperForm->processForm(true, true);
         $text = $e107HelperForm->getFormHTML();
         return array($title, $text);
      }

      function getAdminFieldsPage() {
         global $pageid, $e107HelperForm;
         $title   = CONTACTFORM_MENU_02;
         $pageid  = CONTACTFORM_MENU_02;

         // Create a form using the helper classes
         $e107HelperForm->createFormFromXML("forms/fields");

         // Process the form
         $e107HelperForm->processForm(true, true);
         $text = $e107HelperForm->getFormHTML();
         return array($title, $text);
      }

      function getAdminTestPage() {
         global $pageid, $e107HelperForm;
         $title   = CONTACTFORM_MENU_02;
         $pageid  = CONTACTFORM_MENU_02;

         // Create a form using the helper classes
         $e107HelperForm->createFormFromXML("forms/test");

         // Process the form
         $e107HelperForm->processForm(true, true);
         $text = $e107HelperForm->getFormHTML();
         return array($title, $text);
      }

      function getAdminReadmePage() {
         global $pageid, $e107HelperForm;
         $title   = CONTACTFORM_MENU_03;
         $pageid  = CONTACTFORM_MENU_03;
         $text = "";

         $title = CONTACTFORM_NAME." ".CONTACTFORM_VER;
         if (file_exists(e_PLUGIN."updatechecker/updatechecker.php")) {
            require_once(e_PLUGIN."updatechecker/updatechecker.php");
            $text .= updateChecker(CONTACTFORM_NAME, CONTACTFORM_VER, "http://www.bugrain.plus.com/e107plugins/contactform_menu.ver", "|");
         }

         $text .= "
            <div style='padding:5px;'>".
            CONTACTFORM_NAME." ".CONTACTFORM_VER." by bugrain<br>
            <br>
            A plugin for the e107 Website System (http://e107.org)<br>
            <br>
            Released under the terms and conditions of the<br>
            GNU General Public License (http://gnu.org).<br>
            <hr>

            <u>Features:</u>
            <ul>
            <li>Hides e-mail addresses from spammers/robots/etc.</li>
            <li>Secure image enabled ('captcha' support</li>
            <li>IP Address tracking (logged to Admin log)</li>
            <li>Allows for multiple e-mail addresses for different parts of the organisations (sales, marketing, etc.)</li>
            <li>User has the option to copy themselves on the e-mail for their records (admin configurable)</li>
            <li>Admin can set most fields on the form to be hidden or shown. Fields that are shown can be marked as mandatory</li>
            <li>The symbol and colour of the mandatory field marker is configurable</li>
            <li>Unlimited custom fields of different types - text, select, radio button, etc.</li>
            <li>(Deprecated) Up to four custom fields can be added (no longer enabled in the templates by default)</li>
            </ul>

            </div>
            ";
         return array($title, $text);
      }
   }

   global $contactform;
   $contactform = new ContactForm();
}
?>