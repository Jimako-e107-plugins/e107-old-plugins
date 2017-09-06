<?php
/*
+---------------------------------------------------------------+
| Election by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/e107helpers_developer/e107helpers_developer_ajax.php,v $
| $Revision: 1.1 $
| $Date: 2007/01/10 23:59:06 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   ob_start();
   if (isset($_REQUEST["query"])) {
      // Override e107's query string processing
      define(e_QUERY, $_REQUEST["query"]);
      $_REQUEST["action"] = "query";
      $_REQUEST["ajax"] = true;
   }
   require_once("../../class2.php");
   require_once(e_PLUGIN."e107helpers_developer/handlers/e107helpers_developer_class.php");
   require_once(EHDC_HANDLERS_DIR."/e107helpers_developer_utils.php");

   class e107helpers_developerAjax {

      function e107helpers_developerAjax() {
         switch ($_REQUEST["action"]) {
            case "getTime" : {
               $this->getTime($_REQUEST["id"]);
               break;
            }
            case "getAlert" : {
               $this->getAlert();
               break;
            }
            case "getPopup" : {
               $this->getPopup($_REQUEST["id"]);
               break;
            }
            default : {
               // Do nothing
            }
         }
      }

      /**
       * All functions should call this as their last call, passing in the generated XML document.
       * This cleans the ouput buffer before setting an appropriate header for the response and sending the XML
       * document back to the client. This prevents, for example, PHP warnings from breaking the XML document (though
       * it can make it harder to debug - comment out the ob_end_clean() if you're having problems).
       */
      function printXML($xml) {
         ob_end_clean();
         header('Content-type: text/xml');
         echo $xml;
      }

      function getTime($id) {
         $text = "<e107helperajax>";
         $text .= "<response type='innerhtml' id='$id'><![CDATA[";
         $text .= date("r");
         $text .= "]]></response>";
         $text .= "</e107helperajax>";
         $this->printXML($text);
      }

      function getAlert($id) {
         $text = "<e107helperajax>";
         $text .= "<response type='alert'><![CDATA[";
         $text .= date("r");
         $text .= "]]></response>";
         $text .= "</e107helperajax>";
         $this->printXML($text);
      }

      function getPopup($id) {
         $text = "<e107helperajax>";
         $text .= "<response type='dialog' id='e107helper_developer_color'><![CDATA[";
         $text .= "<table class='fcaption' style='margin:10px;border:3px solid red;'>";
         $text .= "<tr>";
         $text .= "<td colspan='2' class='forumheader' style='text-align:center'>";
         $text .= "What&nbsp;is&nbsp;your&nbsp;favourite&nbsp;colour?";
         $text .= "</td>";
         $text .= "</tr>";
         $text .= "<tr>";
         $text .= "<td colspan='2' style='text-align:center'>";
         $text .= "<br/>";
         $text .= "<select class='tbox' id='colour'>";
         $text .= "<option>Red</option>";
         $text .= "<option>Orange</option>";
         $text .= "<option>Yellow</option>";
         $text .= "<option>Green</option>";
         $text .= "<option>Blue</option>";
         $text .= "<option>Indigo</option>";
         $text .= "<option>Violet</option>";
         $text .= "</select>";
         $text .= "<br/><br/>";
         $text .= "</td>";
         $text .= "</tr>";
         $text .= "<tr>";
         $text .= "<td class='forumheader2' style='width:50%;text-align:center;'>";
         $text .= "<input type='button' class='button' onclick='e107helpers_developerHelper.getColour(\"colour\", \"$id\");e107Helper.killDialog(\"e107helper_developer_color\");' value='OK'>";
         $text .= "</td>";
         $text .= "<td class='forumheader2' style='width:50%;text-align:center;'>";
         $text .= "<input type='button' class='button' onclick='e107Helper.killDialog(\"e107helper_developer_color\");' value='Cancel'>";
         $text .= "</td>";
         $text .= "</tr>";
         $text .= "</table>";
         $text .= "]]></response>";
         $text .= "</e107helperajax>";
         $this->printXML($text);
      }
   }

   $e107helpers_developerAjax = new e107helpers_developerAjax();
   exit;
?>