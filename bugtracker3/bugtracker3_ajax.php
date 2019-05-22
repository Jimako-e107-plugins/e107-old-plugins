<?php
/*
+---------------------------------------------------------------+
| Bugtracker3 by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/bugtracker3/bugtracker3_ajax.php,v $
| $Revision: 1.1.2.9 $
| $Date: 2006/11/27 23:38:32 $
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
   require_once(e_PLUGIN."bugtracker3/handlers/bugtracker3_class.php");

   class bugtracker3Ajax {

      function bugtracker3Ajax() {
         extract($_REQUEST); // TODO need to protect this, better not to extract request variables
         switch ($action) {
            case "updateRelation" : {
               $this->updateRelation($bugid, $reltype, $relid, $popupid);
               break;
            }
            case "deleteRelation" : {
               $this->deleteRelation($bugid, $relid, $popupid);
               break;
            }
            case "addDevComment" : {
               $this->addDevComment($bugid, $comment, $popupid);
               break;
            }
            case "query" : {
               global $bugtracker3, $ns, $pref;
               $page = $bugtracker3->generatePage();
               $summenu = $bugtracker3->getMenu();
               header('Content-type: text/xml');
               echo "<e107helperajax>";
               if ($pref["bugtracker3_tooltips"]) {
                  echo "<response type='killmessage' id='".BUGC_TT."'></response>";
               }
               echo "<response type='innerhtml' id='bugtracker3_main_content'><![CDATA[";
               echo $ns->tablerender($page[0], $page[1]);
               echo "]]></response>";
               echo "<response type='innerhtml' id='bugtracker3_summary_menu_content'><![CDATA[";
               echo $summenu[1];
               echo "]]></response>";
               echo "</e107helperajax>";
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

      function updateRelation($bugid, $reltype, $relid, $popupid) {
         global $bug, $dao, $bugtracker3, $bugtracker3_shortcodes, $tp;

         $dao = $bugtracker3->getDAO();
         $dao->addRelationship($bugid, $reltype, $relid);

         $bug = $dao->getBug($bugid);
         $text = "<e107helperajax>";
         $text .= "<response type='killmessage' id='$popupid'></response>";
         $text .= "<response type='innerhtml' id='bugtracker3_relationsdiv'><![CDATA[";
         $text .= $tp->parseTemplate("{BUG3_BUG_RELATED_BUGS_LIST=editmode&allbugs}", FALSE, $bugtracker3_shortcodes);
         $text .= "]]></response>";
         $text .= "</e107helperajax>";
         $this->printXML($text);
      }

      function deleteRelation($bugid, $relid, $popupid) {
         global $bug, $dao, $bugtracker3, $bugtracker3_shortcodes, $tp;

         $dao = $bugtracker3->getDAO();
         $dao->deleteRelationship($bugid, $relid);

         $bug = $dao->getBug($bugid);
         $text = "<e107helperajax>";
         $text .= "<response type='killmessage' id='$popupid'></response>";
         $text .= "<response type='innerhtml' id='bugtracker3_relationsdiv'><![CDATA[";
         $text .= $tp->parseTemplate("{BUG3_BUG_RELATED_BUGS_LIST=editmode&allbugs}", FALSE, $bugtracker3_shortcodes);
         $text .= "]]></response>";
         $text .= "</e107helperajax>";
         $this->printXML($text);
      }

      function addDevComment($bugid, $comment, $popupid) {
         global $app, $bug, $dao, $bugtracker3, $bugtracker3_shortcodes, $tp, $BUG_BUG_DEVELOPER_COMMENTS;

         $dao = $bugtracker3->getDAO();
         $bug = $dao->getBug($bugid);
         $app = $dao->getApp($bug->getApplicationId());
         $dao->addDevComment($bugid, $comment);
         $bugtracker3->checkNotifications($bug->getId(), BUG_LAN_NOTIFY_DEV_COMMENT, BUG_LAN_LABEL_DEVELOPER_COMMENTS."...<br/><br/>$comment");

         $bug = $dao->getBug($bugid);
         $text = "<e107helperajax>";
         $text .= "<response type='killmessage' id='$popupid'></response>";
         $text .= "<response type='innerhtml' id='bugtracker3_devcommentdiv'><![CDATA[";
         $text .= $tp->parseTemplate("{BUG3_BUG_DEVELOPER_COMMENTS}", FALSE, $bugtracker3_shortcodes);
         $text .= "]]></response>";
         $text .= "</e107helperajax>";
         $this->printXML($text);
      }
   }

   $bugtracker3Ajax = new bugtracker3Ajax();
   exit;
?>