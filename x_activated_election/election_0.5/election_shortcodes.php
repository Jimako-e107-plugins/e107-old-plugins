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
| $Source: e:\_repository\e107_plugins/election/election_shortcodes.php,v $
| $Revision: 1.4 $
| $Date: 2008/02/10 15:18:35 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
if (!isset($tp)) {
   $tp = new e_parse();
   $tp->e_sc = new e_shortcode();
}
global $election_shortcodes;
$election_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);

/*
// ************************************************************************************************
// Section Templates
// These template shortcodes have a matching variable in the templates file, they define major
// sections of a page. Sections can be 'glued' together to make the whole page.
// ************************************************************************************************
SC_BEGIN ELEC_NAV_BAR
   global $election_shortcodes, $pref, $tp, $ELEC_NAV_BAR;
   return $tp->parseTemplate($ELEC_NAV_BAR, FALSE, $election_shortcodes);
SC_END

SC_BEGIN ELEC_SEARCH_BAR
   global $election_shortcodes, $pref, $tp, $ELEC_SEARCH_BAR;
   return $tp->parseTemplate($ELEC_SEARCH_BAR, FALSE, $election_shortcodes);
SC_END

SC_BEGIN ELEC_ELECTION_INFO
   global $election_shortcodes, $pref, $tp, $ELEC_ELECTION_INFO;
   return $tp->parseTemplate($ELEC_ELECTION_INFO, FALSE, $election_shortcodes);
SC_END

SC_BEGIN ELEC_CANDIDATE
   global $election_shortcodes, $pref, $tp, $ELEC_CANDIDATE;
   return $tp->parseTemplate($ELEC_CANDIDATE, FALSE, $election_shortcodes);
SC_END

// ******************************************************************************************
// Buttons
// ******************************************************************************************
SC_BEGIN ELEC_BUTTON_ELECTIONS_LIST
   global $election;
   if (isset($election)) {
      return "<input type='button' class='button' onclick='document.location=\"".ELECC_SELF."\";' value='".ELEC_LAN_JUMPLIST_ELECTIONS_LIST."'/>";
   }
   return "";
SC_END

SC_BEGIN ELEC_BUTTON_CANDIDATE_LIST
   global $elec, $election, $candidate;
//   if (isset($candidate)) {
   if (in_array($elec->getMode(), array(ELECC_CANDIDATE_PAGE, ELECC_VOTE_PAGE, ELECC_VOTES_PAGE))) {
      return "<input type='button' class='button' onclick='document.location=\"".ELECC_SELF."?".ELECC_CANDIDATES_PAGE.".".$election->getId()."\";' value='".ELEC_LAN_JUMPLIST_CANDIDATES_LIST."'/>";
   }
   return "";
SC_END

SC_BEGIN ELEC_BUTTON_VOTE
   global $elec, $election, $electionUser, $dao;
   $text = "";
   if (in_array($elec->getMode(), array(ELECC_CANDIDATES_PAGE))) {
      if ($election->isOpen() && $electionUser->canVoteElection($election->getId())) {
         if ($dao->hasVoted($election->getId())) {
            $value = ELEC_LAN_JUMPLIST_VOTE_VIEW;
         } else {
            $value = ELEC_LAN_JUMPLIST_VOTE;
         }
         $text .= "<input type='button' class='button' onclick='document.location=\"".ELECC_SELF."?".ELECC_VOTE_PAGE.".".$election->getId()."\";' value='$value'/>";
      }
   }
   return $text;
SC_END

SC_BEGIN ELEC_BUTTON_VOTES_PAGE
   global $elec, $election, $electionUser, $dao;
   if (in_array($elec->getMode(), array(ELECC_CANDIDATE_PAGE, ELECC_CANDIDATES_PAGE, ELECC_VOTE_PAGE))) {
      if ($electionUser->canViewElectionResults($election->getId())) {
         return "<input type='button' class='button' onclick='document.location=\"".ELECC_SELF."?".ELECC_VOTES_PAGE.".".$election->getId()."\";' value='".ELEC_LAN_JUMPLIST_VOTES_VIEW."'/>";
      }
   }
   return "";
SC_END

SC_BEGIN ELEC_BUTTON_VOTE_SUBMIT
   global $tp;
   return "<input type='submit' class='button' name='election_vote' onclick='return jsconfirm(\"".$tp->toJS(ELEC_LAN_MSG_CONFIRM_VOTE)."\");' value='".ELEC_LAN_VOTE_SUBMIT."'/>";
SC_END


// ******************************************************************************************
// Jump list
// ******************************************************************************************
SC_BEGIN ELEC_NAV_BAR_JUMP_LIST
   global $elec, $election, $candidate, $dao, $electionlist, $election, $electionUser, $pref;

   parse_str($parm, $parms);
   $text = ELEC_LAN_JUMPLIST_LABEL;
   $text .= "&nbsp;<select class='tbox' onchange='if (this.value!=\"...\") document.location=\"".ELECC_SELF."?\"+this.value;'>";
   $text .= "<option value='...'>".ELEC_LAN_JUMPLIST_SELECT."</option>";
   if (!array_key_exists("showvote", $parms)) {
      if ($elec->getMode() == ELECC_CANDIDATES_PAGE) {
         if ($election->isOpen() && $electionUser->canVoteElection($election->getId())) {
            $text .= "<option value='".ELECC_VOTE_PAGE.".".$election->getId()."'>".ELEC_LAN_JUMPLIST_VOTE."</option>";
         }
      }
   }
   if (!array_key_exists("hidejumps", $parms)) {
      // Jump to pages
      if (!isset($electionlist)) {
         $text .= "<optgroup class='smallblacktext' label='".ELEC_LAN_JUMPLIST_JUMP_TO."'>";
         $text .= "<option value=''>".ELEC_LAN_JUMPLIST_ELECTIONS_LIST."</option>";
         // Check to see if user can post candidates to this app
         if (isset($election)) {
            if ($elec->getMode() != ELECC_CANDIDATES_PAGE) {
               $text .= "<option value='".ELECC_CANDIDATES_PAGE.".".$election->getId()."'>".ELEC_LAN_JUMPLIST_CANDIDATES_LIST."</option>";
            }
         }
         if (in_array($elec->getMode(), array(ELECC_CANDIDATE_PAGE, ELECC_CANDIDATES_PAGE, ELECC_VOTE_PAGE))) {
            if ($electionUser->canViewElectionResults($election->getId())) {
               $text .= "<option value='".ELECC_VOTES_PAGE.".".$election->getId()."'>".ELEC_LAN_JUMPLIST_VOTES_VIEW."</option>";
            }
         }
         $text .= "</optgroup>";
      }
   }

   // elections
   if (!isset($electionlist)) {
      $electionlist = $dao->getElectionList();
   }
   if (count($electionlist) > 0) {
      $text .= "<optgroup class='smallblacktext' label='".ELEC_LAN_JUMPLIST_ELECTIONS."'>";
      foreach ($electionlist as $anauc) {
         if ($electionUser && $electionUser->canViewElection($anauc->getId())) {
            $text .= "<option class='smalltext' value='1.".$anauc->GetId()."'>".$anauc->GetName()."</option>";
         }
      }
      $text .= "</optgroup>";
   }

   // candidates
   if (!array_key_exists("hidecandidates", $parms)) {
      if (isset($election)) {
         if (!isset($candidatelist)) {
            $candidatelist = $dao->getCandidateList($election->getId());
         }
         if (count($candidatelist) > 0) {
            $text .= "<optgroup class='smallblacktext' label='".ELEC_LAN_JUMPLIST_CANDIDATES."'>";
            foreach ($candidatelist as $acandidate) {
               $text .= "<option class='smalltext' value='2.".$acandidate->GetId()."'>".$acandidate->getName(false, ELECC_TRUNC)."</option>";
            }
            $text .= "</optgroup>";
         }
      }
   }

   $text .= "</select>";
   return $text;
SC_END

// ******************************************************************************************
// Search
// ******************************************************************************************
SC_BEGIN ELEC_SEARCH_BAR_SEARCH_FIELD
   parse_str($parm, $parms);
   $text = "<form method='get' action='../../search.php'>";
   $text .= ELEC_LAN_SEARCH;
   $text .= " <input class='tbox search' type='text' name='q' size='20' value='' maxlength='50'/>";
   $text .= "<input type='hidden' name='r' value='0'/>";
   $text .= "<input type='hidden' name='t' value='election'/>";
   if (array_key_exists("showbutton", $parms)) {
      $text .= "&nbsp;<input type='submit' class='button' name='submit' value='".ELEC_LAN_SEARCH_GO."'/>";
   }
   $text .= "</form>";
   return $text;
SC_END

// ******************************************************************************************
// Elections
// ******************************************************************************************
SC_BEGIN ELEC_ELECTION_ID
   global $election;
   return $election->getId();
SC_END

SC_BEGIN ELEC_ELECTION_NAME
   global $election, $e107Helper, $pref;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("hidden", $parms)) {
      $text .= "<input type='hidden' name='".ELECC_POST_ARRAY."[ui_election_id]' value='".$election->getId()."'/>";
   }
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".ELECC_SELF."?".ELECC_CANDIDATES_PAGE.".".$election->getId()."'>";
   }
   $text .= $election->getName();
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   if (!$election->isOpen()) {
      if (!$election->isStarted()) {
         $text .= " [".ELEC_LAN_NOT_STARTED."]";
      } elseif ($election->isFinished()) {
         $text .= " [".ELEC_LAN_FINISHED."]";
      } else {
         $text .= " [".ELEC_LAN_CLOSED."]";
      }
   }
   return $text;
SC_END

SC_BEGIN ELEC_ELECTION_DESCRIPTION
   global $election, $tp;
   return $tp->toHTML($election->getDescription(), true);
SC_END

SC_BEGIN ELEC_ELECTION_ICON
   global $elec, $election, $pref, $tp;
   parse_str($parm, $parms);
   if ("" == $icon = $election->getIcon()) {
      return " ";
   }
   $name = $tp->post_toForm($election->getName(), true);
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".ELECC_SELF."?".ELECC_CANDIDATES_PAGE.".".$election->getId()."'>";
   }
   $text .= "<img src='".$election->getIcon()."' title='$name' border='0' alt='$name'";
   if ($pref["election_tooltips"] && array_key_exists("tooltip", $parms)) {
      $text .= $elec->getTooltip($election->getDescription(), $election->getName());
   }
   $text .= "/>";
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN ELEC_ELECTION_START_DATE
   global $election;
   parse_str($parm, $parms);
   $gen = new convert();
   if (array_key_exists("short", $parms)) {
      $text .= str_replace(" ", "&nbsp;", $gen->convert_date($election->getStartDate(), "short"));
   } else {
      $text .= $gen->convert_date($election->getStartDate(), "long");
   }
   return $text;
SC_END

SC_BEGIN ELEC_ELECTION_END_DATE
   global $election;
   parse_str($parm, $parms);
   $gen = new convert();
   if (array_key_exists("short", $parms)) {
      $text .= str_replace(" ", "&nbsp;", $gen->convert_date($election->getEndDate(), "short"));
   } else {
      $text .= $gen->convert_date($election->getEndDate(), "long");
   }
   return $text;
SC_END

SC_BEGIN ELEC_ELECTION_OWNER
   global $election;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".e_HTTP."user.php?id.".$election->getOwnerId()."'>";
   }
   $text .= $election->getOwner();
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN ELEC_ELECTION_CANDIDATES
   global $election;
   return $election->getCandidateTotal();
SC_END

SC_BEGIN ELEC_ELECTION_VOTES_PER_PERSON
   global $election, $electionUser, $tp;
   if ($electionUser->canVoteElection($election->getId())) {
      return str_replace("{votes}", $election->getVotesPerPerson(), ELEC_LAN_MSG_VOTES_PER_PERSON);
   } else {
      return ELEC_LAN_MSG_NOT_ELIGIBLE_TO_VOTE;
   }
SC_END

SC_BEGIN ELEC_ELECTION_VOTERS
   global $election, $dao;
   return $dao->getElectionVoterCount($election->getId());
SC_END

// ******************************************************************************************
// Candidates
// ******************************************************************************************
SC_BEGIN ELEC_CANDIDATE_ID
   global $elec, $election, $candidate, $electionUser, $tp;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms) && $electionUser->canEditElection($election->getId())) {
      $text .= "<a href='".ELECC_SELF."?".ELECC_EDIT_CANDIDATE_PAGE.".".$candidate->getId()."'>";
   }
   $text .= "#".$candidate->getId();
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN ELEC_CANDIDATE_NAME
   global $elec, $election, $candidate, $pref, $tp;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".ELECC_SELF."?".ELECC_CANDIDATE_PAGE.".".$candidate->getId()."'>";
   }
   $name = $candidate->getName();
   if (array_key_exists("truncate", $parms)) {
      $name = $tp->html_truncate($name, $parms["truncate"], "...");
   }
   if ($pref["election_tooltips"] && array_key_exists("tooltip", $parms)) {
      $text .= "<span".$elec->getTooltip($candidate->getDescription()).">$name</span>";
   } else {
      $text .= $name;
   }
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN ELEC_CANDIDATE_TITLE
   global $elec, $election, $candidate, $pref, $tp;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".ELECC_SELF."?".ELECC_CANDIDATE_PAGE.".".$candidate->getId()."'>";
   }
   $title = $candidate->getTitle();
   if (array_key_exists("truncate", $parms)) {
      $title = $tp->html_truncate($title, $parms["truncate"], "...");
   }
   if ($pref["election_tooltips"] && array_key_exists("tooltip", $parms)) {
      $text .= "<span".$elec->getTooltip($candidate->getDescription()).">$title</span>";
   } else {
      $text .= $title;
   }
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN ELEC_CANDIDATE_DESCRIPTION
   global $candidate, $tp;
   return $tp->toHTML($candidate->getDescription(), true);
SC_END

SC_BEGIN ELEC_CANDIDATE_ICON
   global $elec, $candidate, $pref, $tp;
   parse_str($parm, $parms);
   if ("" == $icon = $candidate->getIcon()) {
      return " ";
   }
   $name = $tp->post_toForm($candidate->getName(), true);
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".ELECC_SELF."?".ELECC_CANDIDATES_PAGE.".".$candidate->getId()."'>";
   }
   $text .= "<img src='".$candidate->getIcon()."' title='$name' border='0' alt='$name'";
   if ($pref["election_tooltips"] && array_key_exists("tooltip", $parms)) {
      $text .= $elec->getTooltip($candidate->getDescription(), $candidate->getName());
   }
   $text .= "/>";
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN ELEC_CANDIDATE_IMAGES
   global $elec, $election, $candidate, $tp;
   parse_str($parm, $parms);
   if ($candidate->getImages() == ELEC_LAN_MSG_NO_IMAGE) {
      return ELEC_LAN_IMAGES_NONE;
   }
   if (array_key_exists("maxwidth", $parms) || array_key_exists("maxheight", $parms)) {
      $size = getimagesize($candidate->getImages());
      $w = $size[0];
      $h = $size[1];
      if (array_key_exists("maxwidth", $parms)) {
         $max = $parms["maxwidth"];
         if ($w > $max) {
            $h = intval($h / ($w/$max));
            $w = $max;
         }
      }
      if (array_key_exists("maxheight", $parms)) {
         $max = $parms["maxheight"];
         if ($h > $max) {
            $w = intval($w / ($h/$max));
            $h = $max;
         }
      }
      $attribs = " width='$w' height='$h'";
   }
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".$candidate->getImages()."' target='_blank'>";
   }
   $text .= "<img src='".$candidate->getImages()."'border='0'$attribs>";
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a><br/>".ELEC_LAN_MSG_CLICK_TO_VIEW;
   }
   return $text;
SC_END

SC_BEGIN ELEC_CANDIDATE_LINK_DESCRIPTION
   global $candidate;
   return $candidate->getLinkDescription();
SC_END

SC_BEGIN ELEC_CANDIDATE_LINK_URL
   global $candidate;
   return $candidate->getLinkURL();
SC_END

SC_BEGIN ELEC_CANDIDATE_LINK
   global $candidate, $tp;
   $text = "";
   if (strlen($candidate->getLinkDescription()) > 0 && strlen($candidate->getLinkURL()) > 0) {
      $text .= "<a href='".$candidate->getLinkURL()."'>".$tp->toHTML($candidate->getLinkDescription(), true)."</a>";
   }
   return $text;
SC_END

SC_BEGIN ELEC_CANDIDATE_POINTS
   global $points;
   return varset($points, "");
SC_END

SC_BEGIN ELEC_CANDIDATE_VOTERS
   global $candidate, $dao;
   return $dao->getCandidateVoterCount($candidate->getId());
SC_END

SC_BEGIN ELEC_CANDIDATE_COMMENTS
   global $election, $candidate, $e107Helper;
   if ($election->allowComments()) {
      return $e107Helper->getComment("election", $candidate->getId());
   }
   return "";
SC_END

SC_BEGIN ELEC_CANDIDATE_TOTAL_COMMENTS
   global $election, $candidate, $e107Helper;
   if ($election->allowComments()) {
      return $e107Helper->getCommentTotal("election", $candidate->getId());
   }
   return "";
SC_END

SC_BEGIN ELEC_CANDIDATE_RATING
   global $election, $candidate, $e107Helper;
   if ($election->allowRatings()) {
      return $e107Helper->getRating("election", $candidate->getId());
   }
   return "";
SC_END

SC_BEGIN ELEC_CANDIDATE_RATING_SHORT
   global $election, $candidate, $e107Helper;
   if ($election->allowRatings()) {
      return $e107Helper->getRating("election", $candidate->getId(), false, true);
   }
   return "";
SC_END

// ******************************************************************************************
// Voting
// ******************************************************************************************
SC_BEGIN ELEC_VOTE_POSITION
   global $position;
   return $position;
SC_END

SC_BEGIN ELEC_VOTE_CANDIDATE
   global $position, $candidate, $ELEC_VOTE_VIEW_CANDIDATE, $election_shortcodes, $tp;
   $text = $tp->parseTemplate($ELEC_VOTE_VIEW_CANDIDATE, FALSE, $election_shortcodes);
   return $text;
SC_END

SC_BEGIN ELEC_VOTE_CANDIDATE_SELECT
   global $candidate, $candidatelist, $position, $electionUser, $ELEC_VOTE_FORM_CANDIDATE, $election_shortcodes, $tp;
   $text = "<select name='candidate[$position]' class='tbox'>";
   $acandidatelist = $candidatelist;
   $text .= "<option value=''>".ELEC_LAN_SELECT."</option>";
   foreach ($acandidatelist as $candidate) {
      if (!$electionUser->isRestricted($candidate->getRestrictionValue(), $candidate->getRestrictionField())) {
         $selected = (isset($_POST["candidate"][$position]) && $_POST["candidate"][$position] == $candidate->getId()) ? " selected='selected'" : "";
         $value = $tp->parseTemplate($ELEC_VOTE_FORM_CANDIDATE, FALSE, $election_shortcodes);
         $text .= "<option value='".$candidate->getId()."'$selected>$value</option>";
      }
   }
   $text .= "</select>";
   return $text;
SC_END

SC_BEGIN ELEC_VOTE_RULES
   global $election, $tp;
   $text = "";
   $text .= "<p>".ELEC_LAN_VOTE_RULES_1."</p>";
   $text .= "<p>".ELEC_LAN_VOTE_RULES_2."<ul>";
   $pointspervote = $election->getPointsPerVote();
   for ($i=0; $i<count($pointspervote); $i++) {
      $text .= "<li>".$pointspervote[$i].ELEC_LAN_VOTE_RULES_3.($i+1)."</li>";
   }
   $text .= "</ul></p>";
   if (strlen($election->getRestrictionText()) > 0) {
      $text .= "<p>".ELEC_LAN_VOTE_RESTRICT.$tp->toHTML($election->getRestrictionText(), true)."</p>";
   }
   return $text;
SC_END

SC_BEGIN ELEC_VOTE_RESTRICTION_TEXT
   global $election, $tp;
   $text = "";
   if (strlen($election->getRestrictionText()) > 0) {
      $text .= "<p>".ELEC_LAN_VOTE_RESTRICT.$tp->toHTML($election->getRestrictionText(), true)."</p>";
   }
   return $text;
SC_END

// ******************************************************************************************
// Submit/Edit candidate
// ******************************************************************************************
SC_BEGIN ELEC_VOTE_SECURE_IMAGE
   global $pref;
   require_once(e_HANDLER."secure_img_handler.php");
   $sec_img = new secure_image();
   $text = "";
   parse_str($parm, $parms);
   if (array_key_exists("label", $parms)) {
      $text .= "<input type='hidden' name='ui_num' id='ui_num' value='".$sec_img->random_number."'/>";
      $text .= $sec_img->r_image();
   }
   if (array_key_exists("field", $parms)) {
      $text .= "<input class='tbox' type='text' name='ui_verify' id='ui_verify' size='15' maxlength='20' />";
      $text .= ELEC_LAN_SECURITY_ENTER;
   }
   return $text;
SC_END

// ******************************************************************************************
// Errors and warnings
// ******************************************************************************************
SC_BEGIN ELEC_STATUS_INFO
   global $electionStatusInfo;
   $text = "";
   if (isset($electionStatusInfo) && $electionStatusInfo !== false) {
      switch ($electionStatusInfo->getLevel()) {
         case STATUS_INFO :
            $text .= "<img src='".e_IMAGE."fileinspector/file_check.png' border='0' alt='".ELEC_LAN_MSG_INFORMATION."'/> ";
            break;
         case STATUS_WARN :
            $text .= "<img src='".e_IMAGE."fileinspector/file_warning.png' border='0' alt='".ELEC_LAN_MSG_WARNING."'/> ";
            break;
         case STATUS_ERROR :
            $text .= "<img src='".e_IMAGE."fileinspector/file_uncalc.png' border='0' alt='".ELEC_LAN_MSG_ERROR."'/> ";
            break;
         case STATUS_FATAL :
            $text .= "<img src='".e_IMAGE."fileinspector/file_fail.png' border='0' alt='".ELEC_LAN_MSG_FATAL."'/> ";
            break;
         case STATUS_DEBUG :
            $text .= "<img src='".e_IMAGE."fileinspector/file_unknown.png' border='0' alt='".ELEC_LAN_MSG_DEBUG."'/> ";
            break;
         default :
      }
      $text .= $electionStatusInfo->getLevelDescription();
      for ($i=0; $i < $electionStatusInfo->getMessageCount(); $i++) {
         if ($electionStatusInfo->hasAdditionalDetails($i)) {
            $attributes = " style='cursor:pointer;' onclick='expandit(this);";
         }
         $text .= "<div $attributes'>".$electionStatusInfo->getMessage($i)."</div><div></div>";
         if ($electionStatusInfo->hasAdditionalDetails($i)) {
            $text .= "<div style='display:none;margin-left:10px'>".$electionStatusInfo->getAdditionalDetails($i)."</div>";
         }
      }
   }
   return $text;
SC_END

SC_BEGIN ELEC_NAV_ERROR
   return "<a href='".ELECC_SELF."'>".ELEC_LAN_MSG_NAV_ERROR."</a>";
SC_END

*/
?>
