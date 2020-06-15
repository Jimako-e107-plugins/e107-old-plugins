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
| $Source: e:\_repository\e107_plugins/election/handlers/election_class.php,v $
| $Revision: 1.5 $
| $Date: 2008/02/10 15:20:23 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Include election handlers
require_once(e_PLUGIN."election/handlers/election_constants.php");

// Data Access Objects
require_once(ELECC_HANDLERS_DIR."election_DAO.php");

// Model objects
require_once(ELECC_HANDLERS_DIR."election_election.php");
require_once(ELECC_HANDLERS_DIR."election_candidate.php");
require_once(ELECC_HANDLERS_DIR."election_voter.php");
require_once(ELECC_HANDLERS_DIR."election_user.php");

// Warning and error handling
require_once(ELECC_HANDLERS_DIR."election_status_info.php");

// Include the e107 Helper classes
if (file_exists(e_PLUGIN."e107helpers/e107Helper.php")) {
   $e107HelperIncludeJS = false;
   $incDHTMLCalendarJS = true;
   require_once(e_PLUGIN."e107helpers/e107Helper.php");
} else {
   print "<h1>Fatal error, cannot find e107Helper class.</h1>";
   print "<p>This plugin requires <b>The e107 Helper Project</b> plugin to be installed.</p>";
   print "<p>Please download it from <a href='http://e107coders.org'>http://e107coders.org</a> and try this plugin again.</p>";
   exit;
}

// Load the shortcodes file - template will be loaded when we know which template to load
require_once(ELECC_PLUGIN_DIR."election_shortcodes.php");

/**
 * Class used to control all page generation and workflow aspects of election
 */
class election {
   // URL parameters (array)
   var $url;
   // Main data Access Object
   var $dao;

   /**
    * Constructor
    */
   function election() {
      global $election, $candidate, $electionlist, $candidatelist, $electionUser, $dao;
      $dao = $this->getDAO();

      // Get individual URL parameters, if any, if viewing Election page
      if (basename(e_SELF) == basename(ELECC_SELF) && e_QUERY){
      	// Separate the url parameters - format is mode.id
      	$this->url = explode(".", e_QUERY);

         // Get election and candidate up front where appropriate
         switch ($this->getMode()) {
            case ELECC_CANDIDATES_PAGE :
               $election = $dao->getElection($this->getId());
               $candidatelist = $dao->getCandidateList($election->getId());
               $electionUser = new electionUser($election);
               break;
            case ELECC_CANDIDATE_PAGE :
               $candidate = $dao->getCandidate($this->getId());
               $election = $dao->getElection($candidate->getElectionId());
               $electionUser = new electionUser($election);
               break;
            case ELECC_VOTE_PAGE :
            case ELECC_VOTES_PAGE :
               $election = $dao->getElection($this->getId());
               $candidatelist = $dao->getCandidateList($election->getId());
               $electionUser = new electionUser($election);
               if (isset($_POST["election_vote"]) && isset($_POST["candidate"])) {
                  $this->processVote();
               }
               break;
         }
      } else {
         $electionlist = $dao->getElectionList();
         $electionUser = new electionUser($electionlist);
      }
   }

   /**
    * Get a reference to the DAO object
    */
   function getDAO() {
      if (!isset($this->dao)) {
         $this->dao = new electionDAO();
      }
      return $this->dao;
   }

   /**
    * Get the mode that Election is running in
    */
   function getMode() {
      return $this->url[ELECC_MODE];
   }

   /**
    * Set the mode that Election is running in
    */
   function setMode($mode) {
      $this->url[ELECC_MODE] = $mode;
   }
   /**
    * Get the URL ID parameter
    */
   function getId() {
      return $this->url[ELECC_ID];
   }

   /**
    * Get the page based on URL parameters
    */
   function generatePage() {
      global $election, $candidate, $electionUser, $dao, $ns, $pref, $tp;

      // TODO would be better shortcoded?
      $pagetitle = "<a class='election_breadcrumb' href='".ELECC_SELF."'>".$pref["election_pagetitle"]."</a>";

      switch ($this->getMode()) {
         case ELECC_CANDIDATES_PAGE : {
            $pagetitle .= $pref["election_separator"]."<a class='election_breadcrumb' href='".ELECC_SELF."?".ELECC_CANDIDATES_PAGE.".".$election->getId()."'>".$election->getName()."</a>";
            $text = $this->generateCandidateList();
            break;
         }
         case ELECC_CANDIDATE_PAGE : {
            $pagetitle .= $pref["election_separator"]."<a class='election_breadcrumb' href='".ELECC_SELF."?".ELECC_CANDIDATES_PAGE.".".$election->getId()."'>".$election->getName()."</a>";
            $pagetitle .= $pref["election_separator"]."<a class='election_breadcrumb' href='".ELECC_SELF."?".ELECC_CANDIDATE_PAGE.".".$candidate->getId()."'>".$candidate->getTitle(ELECC_DB, ELECC_TRUNC)."</a>";
            $text = $this->generateCandidateView();
            break;
         }
         case ELECC_VOTE_PAGE : {
            $pagetitle .= $pref["election_separator"]."<a class='election_breadcrumb' href='".ELECC_SELF."?".ELECC_VOTE_PAGE.".".$election->getId()."'>".$election->getName()."</a>";
            $pagetitle .= $pref["election_separator"];
            if ($dao->hasVoted($election->getId())) {
               $pagetitle .= ELEC_LAN_VOTE_VIEW_NAME;
               $text = $this->viewVotePage();
            } else {
               $pagetitle .= ELEC_LAN_VOTE_NAME;
               $text = $this->generateVoteForm();
            }
            break;
         }
         case ELECC_VOTES_PAGE : {
            $pagetitle .= $pref["election_separator"]."<a class='election_breadcrumb' href='".ELECC_SELF."?".ELECC_VOTES_PAGE.".".$election->getId()."'>".$election->getName()."</a>";
            $pagetitle .= $pref["election_separator"];
            $pagetitle .= ELEC_LAN_VOTES_NAME;
            $text = $this->viewVotesPage();
            break;
         }
         default : {
            $text = $this->generateElectionList();
            break;
         }
      }

      define("e_PAGETITLE", $tp->toRss($pagetitle, false));

      return(array($pagetitle, $text));
   }

   // *********************************************************************************************
   // Front end pages
   // *********************************************************************************************

   /**
    * Get the election list
    */
   function generateElectionList() {
      global $election, $electionlist, $electionStatusInfo, $dao, $electionUser, $tp;
      global $election_shortcodes, $ELEC_ELECTION_LIST_HEAD, $ELEC_ELECTION_LIST_BODY, $ELEC_ELECTION_LIST_FOOT;

      require_once($this->getTemplate());
      $list = "";
      if (count($electionlist) > 0) {
         $list .= $tp->parseTemplate($ELEC_ELECTION_LIST_HEAD, FALSE, $election_shortcodes);
         foreach ($electionlist as $election) {
            if ($electionUser->canViewElection($election->getId())) {
               $list .= $tp->parseTemplate($ELEC_ELECTION_LIST_BODY, FALSE, $election_shortcodes);
            }
         }
      } else {
         $electionStatusInfo = new electionStatusInfo(STATUS_INFO);
         $electionStatusInfo->addMessage(ELEC_LAN_MSG_NO_ELECTIONS, "");
         $list .= $tp->parseTemplate("{ELEC_STATUS_INFO}", FALSE, $election_shortcodes);
         $list .= $tp->parseTemplate($ELEC_ELECTION_LIST_HEAD, FALSE, $election_shortcodes);
      }
      $list .= $tp->parseTemplate($ELEC_ELECTION_LIST_FOOT, FALSE, $election_shortcodes);
      return $list;
   }

   /**
    * Get the candidate list for an election
    */
   function generateCandidateList() {
      global $election, $candidate, $candidatelist, $electionStatusInfo, $dao, $electionUser, $tp;
      global $election_shortcodes, $ELEC_CANDIDATE_LIST_HEAD, $ELEC_CANDIDATE_LIST_BODY, $ELEC_CANDIDATE_LIST_FOOT, $ELEC_NAV_ERROR;

      require_once($this->getTemplate($election));
      if ($electionUser->canViewElection($election->getId())) {
         $list = "";
         if (count($candidatelist) > 0) {
            $list .= $tp->parseTemplate($ELEC_CANDIDATE_LIST_HEAD, FALSE, $election_shortcodes);
            foreach ($candidatelist as $candidate) {
               $list .= $tp->parseTemplate($ELEC_CANDIDATE_LIST_BODY, FALSE, $election_shortcodes);
            }
         } else {
            $electionStatusInfo = new electionStatusInfo(STATUS_INFO);
            $electionStatusInfo->addMessage(ELEC_LAN_MSG_NO_CANDIDATES, "");
            $list .= $tp->parseTemplate("{ELEC_STATUS_INFO}", FALSE, $election_shortcodes);
            $list .= $tp->parseTemplate($ELEC_CANDIDATE_LIST_HEAD, FALSE, $election_shortcodes);
         }
         $list .= $tp->parseTemplate($ELEC_CANDIDATE_LIST_FOOT, FALSE, $election_shortcodes);
      } else {
         $list .= $tp->parseTemplate($ELEC_NAV_ERROR, FALSE, $election_shortcodes);
      }
      return $list;
   }

   /**
    * Get a specific candidate
    */
   function generateCandidateView() {
      global $elec, $election, $electionlist, $dao, $electionUser, $tp;
      global $election_shortcodes, $ELEC_CANDIDATE_VIEW, $ELEC_NAV_ERROR;

      require_once($this->getTemplate($election));
      if ($electionUser->canViewElection($election->getId())) {
         $text = $tp->parseTemplate($ELEC_CANDIDATE_VIEW, FALSE, $election_shortcodes);
         return $text;
      } else {
         return $tp->parseTemplate($ELEC_NAV_ERROR, FALSE, $election_shortcodes);
      }
   }

   /**
    * Get the vote form for an election
    */
   function generateVoteForm() {
      global $election, $candidate, $candidatelist, $position, $electionStatusInfo, $dao, $electionUser, $tp;
      global $election_shortcodes, $ELEC_VOTE_FORM_HEAD, $ELEC_VOTE_FORM_BODY, $ELEC_VOTE_FORM_FOOT, $ELEC_NAV_ERROR;

      require_once($this->getTemplate($election));
      if ($election->isOpen() && $electionUser->canVoteElection($election->getId())) {
         $form = "<form id='submitauc' method='post' action=".ELECC_SELF."?".ELECC_VOTE_PAGE.".".$election->getId()." enctype='multipart/form-data'>";
         if (count($candidatelist) > 0) {
            $form .= $tp->parseTemplate("{ELEC_STATUS_INFO}", FALSE, $election_shortcodes);
            $form .= $tp->parseTemplate($ELEC_VOTE_FORM_HEAD, FALSE, $election_shortcodes);
            for ($position=1; $position<=$election->getVotesPerPerson(); $position++) {
               $form .= $tp->parseTemplate($ELEC_VOTE_FORM_BODY, FALSE, $election_shortcodes);
            }
         } else {
            $electionStatusInfo = new electionStatusInfo(STATUS_INFO);
            $electionStatusInfo->addMessage(ELEC_LAN_MSG_NO_CANDIDATES, "");
            $form .= $tp->parseTemplate("{ELEC_STATUS_INFO}", FALSE, $election_shortcodes);
            $form .= $tp->parseTemplate($ELEC_VOTE_FORM_HEAD, FALSE, $election_shortcodes);
         }
         $form .= $tp->parseTemplate($ELEC_VOTE_FORM_FOOT, FALSE, $election_shortcodes);
         $form .= "</form>";
      } else {
         $form .= $tp->parseTemplate($ELEC_NAV_ERROR, FALSE, $election_shortcodes);
      }
      return $form;
   }

   /**
    * Get the users votes for an election
    */
   function viewVotePage() {
      global $election, $candidate, $candidatelist, $position, $electionStatusInfo, $dao, $electionUser, $tp;
      global $election_shortcodes, $ELEC_VOTE_VIEW_HEAD, $ELEC_VOTE_VIEW_BODY, $ELEC_VOTE_VIEW_FOOT, $ELEC_NAV_ERROR;

      require_once($this->getTemplate($election));
      if ($electionUser->canVoteElection($election->getId())) {
         $voter = $dao->getVotesForUser(USERID);
         $votes = $voter->getVotes();
         if (count($votes) > 0) {
            $form .= $tp->parseTemplate("{ELEC_STATUS_INFO}", FALSE, $election_shortcodes);
            $form .= $tp->parseTemplate($ELEC_VOTE_VIEW_HEAD, FALSE, $election_shortcodes);
            for ($position=1; $position<=$election->getVotesPerPerson(); $position++) {
                  if ($candidate = $dao->getcandidate($votes[$position-1])) {
                     $form .= $tp->parseTemplate($ELEC_VOTE_VIEW_BODY, FALSE, $election_shortcodes);
                  }
            }
         } else {
            $electionStatusInfo = new electionStatusInfo(STATUS_INFO);
            $electionStatusInfo->addMessage(ELEC_LAN_MSG_NO_VOTES, "");
            $form .= $tp->parseTemplate($ELEC_VOTE_VIEW_HEAD, FALSE, $election_shortcodes);
         }
         $form .= $tp->parseTemplate($ELEC_VOTE_VIEW_FOOT, FALSE, $election_shortcodes);
      } else {
         $form .= $tp->parseTemplate($ELEC_NAV_ERROR, FALSE, $election_shortcodes);
      }
      return $form;
   }

   /**
    * Get the candidate list for an election
    */
   function viewVotesPage() {
      global $election, $candidate, $candidatelist, $points, $electionStatusInfo, $dao, $electionUser, $tp;
      global $election_shortcodes, $ELEC_VOTES_LIST_HEAD, $ELEC_VOTES_LIST_BODY, $ELEC_VOTES_LIST_FOOT, $ELEC_NAV_ERROR;

      require_once($this->getTemplate($election));
      if ($electionUser->canViewElectionResults($election->getId())) {
         $voterlist = $dao->getVoterList($election->getId());
         $pointspervote = $election->getPointsPerVote();
         $candidatevotes = array();
         foreach($voterlist as $voter) {
            $votes = $voter->getVotes();
            for ($i=0; $i<count($votes); $i++) {
               $candidatevotes[$votes[$i]] += $pointspervote[$i];
            }
         }
         arsort($candidatevotes);
         $list = "";

         if (count($candidatevotes) > 0) {
            $list .= $tp->parseTemplate($ELEC_VOTES_LIST_HEAD, FALSE, $election_shortcodes);
            foreach ($candidatevotes as $candidateid=>$points) {
               $candidate = $candidatelist[$candidateid];
               $list .= $tp->parseTemplate($ELEC_VOTES_LIST_BODY, FALSE, $election_shortcodes);
            }
         } else {
            $electionStatusInfo = new electionStatusInfo(STATUS_INFO);
            $electionStatusInfo->addMessage(ELEC_LAN_MSG_NO_CANDIDATES, "");
            $list .= $tp->parseTemplate($ELEC_VOTES_LIST_HEAD, FALSE, $election_shortcodes);
         }
         $list .= $tp->parseTemplate($ELEC_VOTES_LIST_FOOT, FALSE, $election_shortcodes);
      } else {
         $list .= $tp->parseTemplate($ELEC_NAV_ERROR, FALSE, $election_shortcodes);
      }
      return $list;
   }

   /**
    * Process a vote submission
    */
   function processVote() {
      global $election, $candidate, $candidatelist, $position, $electionStatusInfo, $dao, $electionUser, $tp;
      $numcandidates = count($candidatelist);
      $votes = $_POST["candidate"];

      // Discard unused votes from the end of the array
      for ($i=$numcandidates; $i>0; $i--) {
         if (strlen($votes[$i]) == 0) {
            unset($votes[$i]);
         } else {
            break;
         }
      }

      // Validation - make sure votes are correctly ordered - don't have to cast all votes but must be cast from position 1 down
      $votingstopped = false;
      for ($i=1; $i<=$numcandidates; $i++) {
         if ($votingstopped && strlen($votes[$i])>0 ) {
            $electionStatusInfo = new electionStatusInfo(STATUS_WARN);
            $electionStatusInfo->addMessage(ELEC_LAN_MSG_VOTE_IN_ORDER, __LINE__);
            return;
         } elseif (strlen($votes[$i])==0) {
            $votingstopped = true;
         }
      }

      // Validation - at least one vote must be cast
      if (strlen($votes[1])==0) {
         $electionStatusInfo = new electionStatusInfo(STATUS_WARN);
         $electionStatusInfo->addMessage(ELEC_LAN_MSG_VOTE_IN_ORDER, __LINE__);
         return;
      }

      // Validation - make sure no two votes are the same
      if (count($votes) != count(array_unique($votes))) {
         $electionStatusInfo = new electionStatusInfo(STATUS_WARN);
         $electionStatusInfo->addMessage(ELEC_LAN_MSG_DUPLICATE_VOTE, __LINE__);
         return;
      }

      // Everything seems to be OK, cast the votes
      if (true === $ret = $dao->castVote($election->getId(), $votes)) {
         $electionStatusInfo = new electionStatusInfo(STATUS_INFO);
         $electionStatusInfo->addMessage(ELEC_LAN_MSG_VOTE_THANKS, __LINE__);
      } else {
         $electionStatusInfo = $ret;
      }

   }

   function _isElectionPage() {
      $election_pages = array(
                     ELECC_CANDIDATES_PAGE,
                     ELECC_CANDIDATE_PAGE,
                   );
      return in_array($this->getMode(), $election_pages);
   }

   // *********************************************************************************************
   // Admin pages
   // *********************************************************************************************

   /**
    * Get the admin menu
    */
   function getAdminMenu() {
      global $election_adminmenu, $pageid;
      show_admin_menu(ELEC_LAN_ELECTION, $pageid, $election_adminmenu);
   }

   /**
    * Generate the admin preferences page
    */
   function getAdminPage() {
      global $election_adminmenu, $pageid, $e107HelperForm;

      $pageid = e_QUERY ? e_QUERY : 10;
      $title  = ELEC_LAN_ELECTION." :: ".$election_adminmenu["ELECC_ADMIN_PAGE_".$pageid]["text"];
      if ($election_adminmenu["ELECC_ADMIN_PAGE_".$pageid]["form"]) {
         // Create and process a form using the helper classes
         $e107HelperForm->createFormFromXML("forms/prefs_".$pageid);
         $e107HelperForm->processForm(true, true);
         $text = $e107HelperForm->getFormHTML();
      } else {
         include("admin_prefs_$pageid.php");
      }
      $pageid = e_QUERY ? "ELECC_ADMIN_PAGE_".e_QUERY : "ELECC_ADMIN_PAGE_10";
      return array($title, $text);
   }

   /**
    * Format admin page App List Templates drop down
    */
   function formatTemplatesDropDown($params) {
      $templates = array();
      switch ($params["templatetype"]) {
         case ELEC_ADMIN_TEMPLATE_TYPE_APP : {
            $templates['0'] = array('0', ELEC_ADMIN_TEMPLATE_TYPE_USE_GLOBAL);
         }
         case ELEC_ADMIN_TEMPLATE_TYPE_APPS : {
            // TODO get templates from theme folder too?
            $folder = e_PLUGIN."election/templates/";
            $handle = opendir($folder);
            while ($file = readdir($handle)) {
               if (preg_match_all("/^election_(.*)_template\.php$/", $file, $match) != false) {
                  unset($election_template_name);
                  include($folder.$file);
                  if (isset($election_template_name)) {
                     $templates[$match[1][0]] = array($match[1][0], $election_template_name);
                  } else {
                     $templates[$match[1][0]] = array($match[1][0], $match[1][0]);
                  }
               }
            }
            closedir($handle);
            break;
         }
      }
      return $templates;
    }

   /**
    * Format admin page Apps Version drop down
    */
   function electionFormatAppsOwnerDropDown($params) {
      global $sql;
      $owners = array();
      if ($params["includeblank"]) {
         $owners[] = array(0, ELEC_LAN_LABEL_FILTER_OWNER_ALL);
      }
      if ($params["currentuser"]) {
         $owners[] = array(-1, ELEC_LAN_LABEL_FILTER_OWNER_CURRENT);
      }
      if ($sql->db_Select("user", "user_id, user_name, user_login")) {
         while ($row = $sql->db_Fetch()) {
            $owners[] = array($row["user_id"], $row["user_name"]." (".$row["user_login"].")");
         }
      }
      return $owners;
   }

   /**
    * Load the appropriate template
    */
   function getTemplate($election=false) {
      global $pref;

      // Default
      $template = ELECC_PLUGIN_DIR."templates/election_default_template.php";

      // Global
      if (file_exists(ELECC_PLUGIN_DIR."/templates/election_".$pref["election_global_template"]."_template.php")){
         $template = ELECC_PLUGIN_DIR."templates/election_".$pref["election_global_template"]."_template.php";
      }

      // Election specific
      if (false != $election && file_exists(ELECC_PLUGIN_DIR."/templates/election_".$election->getTemplate()."_template.php")){
         $template = ELECC_PLUGIN_DIR."templates/election_".$election->getTemplate()."_template.php";
      }

      return $template;
   }

   function getTooltip($tttext, $caption="", $image=false) {
      global $e107Helper, $pref;
      $tt = "";
      if ($pref["election_tooltips"]) {
         $tt = $e107Helper->getTooltip($tttext, $caption, $this->getTooltipStyles(), ELECC_TT);
         if ($image) {
            $tt = "<img align='top' style='cursor:pointer' src='".e_IMAGE."admin_images/polls_16.png'$tt/>";
         }
      }
      return $tt;
   }
   function getTooltipStyles() {
      return array(
         "caption-style"   => "font-weight:bold;text-align:center;",
         "min-width"       => "150",
         "max-width"       => "300",
      );
   }
}

// An global instance of the election class
global $elec;
$elec = new election();
?>