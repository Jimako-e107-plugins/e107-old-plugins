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
| $Source: e:\_repository\e107_plugins/election/election_ajax.php,v $
| $Revision: 1.1 $
| $Date: 2006/12/31 16:01:19 $
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
   require_once(e_PLUGIN."election/handlers/election_class.php");
   require_once(ELECC_HANDLERS_DIR."/election_utils.php");

   class electionAjax {

      function electionAjax() {
         extract($_REQUEST); // TODO need to protect this, better not to extract request variables
         switch ($action) {
            case "submitVote" : {
               $this->submitVote($ui_candidate_id, $popupid);
               break;
            }
            case "deleteVote" : {
               $this->voteDeleteRestore(true, $ui_timestamp, $ui_candidate_id);
               break;
            }
            case "restoreVote" : {
               $this->voteDeleteRestore(false, $ui_timestamp, $ui_candidate_id);
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

      function submitVote($candidateid, $popupid) {
         global $elec, $election, $vote, $votelist, $electionUser, $dao, $tp;
         global $election_shortcodes;

         $dao = $election->getDAO();
         $candidate = $dao->getCandidate($candidateid);
         $election = $dao->getElection($candidate->getElectionId());

         $vote = new electionVote(false, $_POST);
         if (false != $status = $vote->validateMe()) {
            $text = "<e107helperajax>";
            $text .= "<response type='killmessage' id='$popupid'></response>";
            $text .= "<response type='alert'><![CDATA[";
            $text .= ELEC_LAN_MSG_VOTE_FAILED."\n";
            for ($i=0; $i<$status->getMessageCount(); $i++) {
               $text .= "".$status->getMessage($i)."\n";
            }
            $text .= "]]></response>";
            $text .= "</e107helperajax>";
            $this->printXML($text);
            return;
         }

            if ($vote->getAmount() < $candidate->getReserve()) {
               $text = "<e107helperajax>";
               $text .= "<response type='killmessage' id='$popupid'></response>";
               $text .= "<response type='alert'><![CDATA[";
               $text .= $tp->toForm(ELEC_LAN_MSG_VOTE_BELOW_RESERVE.election_toCurrency($candidate->getReserve()));
               $text .= "]]></response>";
               $text .= "</e107helperajax>";
               $this->printXML($text);
               return;
            }

         $votelist = $dao->getVoteList($candidateid);
         if (count($votelist) > 0) {
            reset($votelist);
            $topvote = election_getTopVote();
            if ($topvote && $vote->getAmount() <= $topvote->getAmount()) {
               $text = "<e107helperajax>";
               $text .= "<response type='killmessage' id='$popupid'></response>";
               $text .= "<response type='alert'><![CDATA[";
               $text .= $tp->toForm(ELEC_LAN_MSG_VOTE_TOO_LOW.election_toCurrency($topvote->getAmount()));
               $text .= "]]></response>";
               $text .= "</e107helperajax>";
               $this->printXML($text);
               return;
            }
         }

         $status = $dao->addVote($vote);
         if (get_class($status) == "electionStatusInfo") {
            $text = "<e107helperajax>";
            $text .= "<response type='killmessage' id='$popupid'></response>";
            $text .= "<response type='alert'><![CDATA[";
            $text .= ELEC_LAN_MSG_VOTE_FAILED."\n";
            for ($i=0; $i<$status->getMessageCount(); $i++) {
               $text .= $status->getMessage($i)."\n";
               $text .= "(".$status->getAdditionalDetails($i).")\n";
            }
            $text .= "]]></response>";
            $text .= "</e107helperajax>";
            $this->printXML($text);
            return;
         }

         //$election->checkNotifications($election->getId(), ELEC_LAN_NOTIFY_DEV_COMMENT, ELEC_LAN_LABEL_CANDIDATES."...<br/><br/>$comment");

         $electionUser = new electionUser($election);
         array_unshift($votelist, $vote);
         require_once($election->getTemplate($election));
         $text = "<e107helperajax>";
         $text .= "<response type='killmessage' id='$popupid'></response>";
         if (USER) {
            $text .= "<response type='innerhtml' id='election_vote_history'><![CDATA[";
            $text .= $tp->parseTemplate("{ELEC_VOTE_HISTORY=ajax}", FALSE, $election_shortcodes);
            $text .= "]]></response>";
         }
         $text .= "<response type='innerhtml' id='election_last_vote_date_time'><![CDATA[";
         $text .= $tp->parseTemplate("{ELEC_CANDIDATE_LAST_VOTE_DATE_TIME=short}", FALSE, $election_shortcodes);
         $text .= "]]></response>";
         $text .= "<response type='innerhtml' id='election_last_vote_amount'><![CDATA[";
         $text .= $tp->parseTemplate("{ELEC_CANDIDATE_LAST_VOTE_AMOUNT}", FALSE, $election_shortcodes);
         $text .= "]]></response>";
         $text .= "<response type='alert'><![CDATA[";
         $text .= ELEC_LAN_MSG_VOTE_SUCCSESSFUL;
         $text .= "]]></response>";
         $text .= "</e107helperajax>";
         $this->printXML($text);
      }

      function voteDeleteRestore($delete, $ts, $candidateid) {
         global $elec, $election, $vote, $votelist, $electionUser, $dao, $tp;
         global $election_shortcodes;

         $dao = $election->getDAO();
         $candidate = $dao->getCandidate($candidateid);
         $election = $dao->getElection($candidate->getElectionId());
         $vote = $dao->getVote($ts, $candidateid);
         $vote->setDeleted($delete);
         $status = $dao->updateVote($vote);
         if (get_class($status) == "electionStatusInfo") {
            $text = "<e107helperajax>";
            $text .= "<response type='killmessage' id='$popupid'></response>";
            $text .= "<response type='alert'><![CDATA[";
            $text .= ELEC_LAN_MSG_VOTE_UPDATE_FAILED."\n";
            for ($i=0; $i<$status->getMessageCount(); $i++) {
               $text .= $status->getMessage($i)."\n";
               $text .= "(".$status->getAdditionalDetails($i).")\n";
            }
            $text .= "]]></response>";
            $text .= "</e107helperajax>";
            $this->printXML($text);
            return;
         }

         $votelist = $dao->getVoteList($candidateid);
         $electionUser = new electionUser($election);
         require_once($election->getTemplate($election));
         $text = "<e107helperajax>";
         if (USER) {
            $text .= "<response type='innerhtml' id='election_vote_history'><![CDATA[";
            $text .= $tp->parseTemplate("{ELEC_VOTE_HISTORY=ajax}", FALSE, $election_shortcodes);
            $text .= "]]></response>";
         }
         $text .= "<response type='innerhtml' id='election_last_vote_date_time'><![CDATA[";
         $text .= $tp->parseTemplate("{ELEC_CANDIDATE_LAST_VOTE_DATE_TIME=short}", FALSE, $election_shortcodes);
         $text .= "]]></response>";
         $text .= "<response type='innerhtml' id='election_last_vote_amount'><![CDATA[";
         $text .= $tp->parseTemplate("{ELEC_CANDIDATE_LAST_VOTE_AMOUNT}", FALSE, $election_shortcodes);
         $text .= "]]></response>";
         $text .= "</e107helperajax>";
         $this->printXML($text);
      }
   }

   $electionAjax = new electionAjax();
   exit;
