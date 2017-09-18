<?php
/*
+---------------------------------------------------------------+
| Auction by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/eplayer/eplayer_ajax.php,v $
| $Revision: 1.2 $
| $Date: 2007/01/23 23:57:08 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   ob_start();
   require_once("../../class2.php");
   require_once(e_PLUGIN."eplayer/eplayer_variables.php");
   require_once(e_PLUGIN."eplayer/eplayer_utils.php");
   $e107HelperIncludeJS = false;
   $incDHTMLCalendarJS = false;
   require_once(e_PLUGIN."e107helpers/e107Helper.php");

   class eplayerAjax {

      function eplayerAjax() {
         switch ($_REQUEST["action"]) {
            case "viewer" : {
               $ep_id        = $_REQUEST["ep_id"];
               $ep_div       = $_REQUEST["ep_div"];
               $ep_messageid = $_REQUEST["ep_messageid"];
               $this->viewer($ep_id, $ep_div, $ep_messageid);
               break;
            }
            case "updateField" : {
               $ep_id        = $_REQUEST["ep_id"];
               $ep_field     = $_REQUEST["ep_field"];
               $ep_value     = $_REQUEST["ep_value"];
               $ep_container = $_REQUEST["ep_container"];
               $ep_messageid = $_REQUEST["ep_messageid"];
               $this->updateField($ep_id, $ep_field, $ep_value, $ep_container, $ep_messageid);
               break;
            }
            default : {
               // Do nothing
            }
         }
      }

      function printXML($text) {
         ob_end_clean();
         header('Content-type: text/xml');
         echo $text;
      }

      function updateField($ep_id, $ep_field, $ep_value, $ep_container, $ep_messageid) {
         global $e107Helper, $sql, $tp;

         //$ep_value = $tp->toDB($ep_value);
         $sql->db_Update(EPLAYER_TABLE, "{$ep_field}={$ep_value} WHERE id='{$ep_id}'");

         $text = "<e107helperajax>";
         $text .= "<response type='killmessage' id='$ep_messageid'></response>";
         $text .= "<response type='innerhtml' id='$ep_container'><![CDATA[".mysql_error();
         //$text .= $e107Helper->getInlineEdit("description", $ep_id, $ep_value, "eplayer.updateField", "textarea", "smalltext");
         $text .= "]]></response>";
         $text .= "</e107helperajax>";
         $this->printXML($text);
      }

      function viewer($ep_id, $ep_div, $ep_messageid) {
         global $pref, $sql, $tp;

         $sql->db_Select(EPLAYER_TABLE, "*", "id='$ep_id'");
         list($id, $filename, $title, $category, $datestamp, $description, $icon, $width, $height, $author, $comment, $timestamp, $lastview, $viewcount) = $sql->db_Fetch();
         $sql->db_Select(EPLAYER_CATEGORY_TABLE, "cat_visibility", "cat_id='$category'");
         list($cat_visibility) = $sql->db_Fetch();
         $html = "";
         if (check_class($cat_visibility)) {
            $rawURL = strpos($filename, "?") ? substr($filename, 0, strpos($filename, "?")) : $filename;
            $mediaFunc = "eplayerGet".strtoupper(substr($rawURL, strrpos($rawURL, ".")+1));
            if(!function_exists($mediaFunc)) {
               $mediaFunc = "eplayerGetDefault";
            }
            if ($pref["eplayer_view_show_clip_details"] == EPLAYER_LAN_ADMIN_VPREF_03_3) {
               $html .= $tp->toHTML($description, true)."<hr/>";
            }
            $html .= call_user_func($mediaFunc, $filename, $width, $height, false);
            if ($pref["eplayer_view_show_clip_details"] == EPLAYER_LAN_ADMIN_VPREF_03_4) {
               $html .= "<hr/>".$tp->toHTML($description, true);
            }
         } else {
            $html .= $tp->toHTML(varsettrue($pref["eplayer_view_hidden_text"], EPLAYER_LAN_62, ""), true);
         }

         $text = "<e107helperajax>";
         $text .= "<response type='killmessage' id='$ep_messageid'></response>";
         $text .= "<response type='innerhtml' id='$ep_div'><![CDATA[";
         $text .= $html;
         $text .= "]]></response>";
         $text .= "</e107helperajax>";
         $this->printXML($text);
      }
   }

   $eplayerAjax = new eplayerAjax();
   exit;
?>