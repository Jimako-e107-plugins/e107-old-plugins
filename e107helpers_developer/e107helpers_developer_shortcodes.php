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
| $Source: e:\_repository\e107_plugins/e107helpers_developer/e107helpers_developer_shortcodes.php,v $
| $Revision: 1.1 $
| $Date: 2007/01/10 23:59:06 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
if (!isset($tp)) {
   $tp = new e_parse();
   $tp->e_sc = new e_shortcode();
}
global $e107helpers_developer_shortcodes;
$e107helpers_developer_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
/*
// ************************************************************************************************
// Section Templates
// These template shortcodes have a matching variable in the templates file, they define major
// sections of a page. Sections can be 'glued' together to make the whole page.
// ************************************************************************************************
SC_BEGIN EHD_NAV_BAR
   global $e107helpers_developer_shortcodes, $pref, $tp, $EHD_NAV_BAR;
   return $tp->parseTemplate($EHD_NAV_BAR, FALSE, $e107helpers_developer_shortcodes);
SC_END

SC_BEGIN EHD_SEARCH_BAR
   global $e107helpers_developer_shortcodes, $pref, $tp, $EHD_SEARCH_BAR;
   return $tp->parseTemplate($EHD_SEARCH_BAR, FALSE, $e107helpers_developer_shortcodes);
SC_END

SC_BEGIN EHD_ELECTION_INFO
   global $e107helpers_developer_shortcodes, $pref, $tp, $EHD_ELECTION_INFO;
   return $tp->parseTemplate($EHD_ELECTION_INFO, FALSE, $e107helpers_developer_shortcodes);
SC_END

SC_BEGIN EHD_CANDIDATE
   global $e107helpers_developer_shortcodes, $pref, $tp, $EHD_CANDIDATE;
   return $tp->parseTemplate($EHD_CANDIDATE, FALSE, $e107helpers_developer_shortcodes);
SC_END

// ******************************************************************************************
// Buttons
// ******************************************************************************************
SC_BEGIN EHD_BUTTON_ELECTIONS_LIST
   global $e107helpers_developer;
   if (isset($e107helpers_developer)) {
      return "<input type='button' class='button' onclick='document.location=\"".EHDC_SELF."\";' value='".EHD_LAN_JUMPLIST_ELECTIONS_LIST."'/>";
   }
   return "";
SC_END

SC_BEGIN EHD_BUTTON_CANDIDATE_LIST
   global $elec, $e107helpers_developer, $candidate;
//   if (isset($candidate)) {
   if (in_array($elec->getMode(), array(EHDC_CANDIDATE_PAGE, EHDC_VOTE_PAGE, EHDC_VOTES_PAGE))) {
      return "<input type='button' class='button' onclick='document.location=\"".EHDC_SELF."?".EHDC_CANDIDATES_PAGE.".".$e107helpers_developer->getId()."\";' value='".EHD_LAN_JUMPLIST_CANDIDATES_LIST."'/>";
   }
   return "";
SC_END

SC_BEGIN EHD_BUTTON_VOTE
   global $elec, $e107helpers_developer, $e107helpers_developerUser, $dao;
   $text = "";
   if (in_array($elec->getMode(), array(EHDC_CANDIDATES_PAGE))) {
      if ($e107helpers_developer->isOpen() && $e107helpers_developerUser->canVoteElection($e107helpers_developer->getId())) {
         if ($dao->hasVoted($e107helpers_developer->getId())) {
            $value = EHD_LAN_JUMPLIST_VOTE_VIEW;
         } else {
            $value = EHD_LAN_JUMPLIST_VOTE;
         }
         $text .= "<input type='button' class='button' onclick='document.location=\"".EHDC_SELF."?".EHDC_VOTE_PAGE.".".$e107helpers_developer->getId()."\";' value='$value'/>";
      }
   }
   return $text;
SC_END

SC_BEGIN EHD_BUTTON_VOTES_PAGE
   global $elec, $e107helpers_developer, $e107helpers_developerUser, $dao;
   if (in_array($elec->getMode(), array(EHDC_CANDIDATE_PAGE, EHDC_CANDIDATES_PAGE, EHDC_VOTE_PAGE))) {
      if ($e107helpers_developerUser->canViewElection($e107helpers_developer->getId())) {
         return "<input type='button' class='button' onclick='document.location=\"".EHDC_SELF."?".EHDC_VOTES_PAGE.".".$e107helpers_developer->getId()."\";' value='".EHD_LAN_JUMPLIST_VOTES_VIEW."'/>";
      }
   }
   return "";
SC_END

SC_BEGIN EHD_BUTTON_VOTE_SUBMIT
   global $tp;
   return "<input type='submit' class='button' name='e107helpers_developer_vote' onclick='return jsconfirm(\"".$tp->toJS(EHD_LAN_MSG_CONFIRM_VOTE)."\");' value='".EHD_LAN_VOTE_SUBMIT."'/>";
SC_END


// ******************************************************************************************
// Jump list
// ******************************************************************************************
SC_BEGIN EHD_NAV_BAR_JUMP_LIST
   global $elec, $e107helpers_developer, $candidate, $dao, $e107helpers_developerlist, $e107helpers_developer, $e107helpers_developerUser, $pref;

   parse_str($parm, $parms);
   $text = EHD_LAN_JUMPLIST_LABEL;
   $text .= "&nbsp;<select class='tbox' onchange='if (this.value!=\"...\") document.location=\"".EHDC_SELF."?\"+this.value;'>";
   $text .= "<option value='...'>".EHD_LAN_JUMPLIST_SELECT."</option>";
   if (!array_key_exists("showvote", $parms)) {
      if ($elec->getMode() == EHDC_CANDIDATES_PAGE) {
         if ($e107helpers_developer->isOpen() && $e107helpers_developerUser->canVoteElection($e107helpers_developer->getId())) {
            $text .= "<option value='".EHDC_VOTE_PAGE.".".$e107helpers_developer->getId()."'>".EHD_LAN_JUMPLIST_VOTE."</option>";
         }
      }
   }
   if (!array_key_exists("hidejumps", $parms)) {
      // Jump to pages
      if (!isset($e107helpers_developerlist)) {
         $text .= "<optgroup class='smallblacktext' label='".EHD_LAN_JUMPLIST_JUMP_TO."'>";
         $text .= "<option value=''>".EHD_LAN_JUMPLIST_ELECTIONS_LIST."</option>";
         // Check to see if user can post candidates to this app
         if (isset($e107helpers_developer)) {
            if ($elec->getMode() != EHDC_CANDIDATES_PAGE) {
               $text .= "<option value='".EHDC_CANDIDATES_PAGE.".".$e107helpers_developer->getId()."'>".EHD_LAN_JUMPLIST_CANDIDATES_LIST."</option>";
            }
         }
         if (in_array($elec->getMode(), array(EHDC_CANDIDATE_PAGE, EHDC_CANDIDATES_PAGE, EHDC_VOTE_PAGE))) {
            if ($e107helpers_developerUser->canViewElection($e107helpers_developer->getId())) {
               $text .= "<option value='".EHDC_VOTES_PAGE.".".$e107helpers_developer->getId()."'>".EHD_LAN_JUMPLIST_VOTES_VIEW."</option>";
            }
         }
         $text .= "</optgroup>";
      }
   }

   // e107helpers_developers
   if (!isset($e107helpers_developerlist)) {
      $e107helpers_developerlist = $dao->getElectionList();
   }
   if (count($e107helpers_developerlist) > 0) {
      $text .= "<optgroup class='smallblacktext' label='".EHD_LAN_JUMPLIST_ELECTIONS."'>";
      foreach ($e107helpers_developerlist as $anauc) {
         if ($e107helpers_developerUser && $e107helpers_developerUser->canViewElection($anauc->getId())) {
            $text .= "<option class='smalltext' value='1.".$anauc->GetId()."'>".$anauc->GetName()."</option>";
         }
      }
      $text .= "</optgroup>";
   }

   // candidates
   if (!array_key_exists("hidecandidates", $parms)) {
      if (isset($e107helpers_developer)) {
         if (!isset($candidatelist)) {
            $candidatelist = $dao->getCandidateList($e107helpers_developer->getId());
         }
         if (count($candidatelist) > 0) {
            $text .= "<optgroup class='smallblacktext' label='".EHD_LAN_JUMPLIST_CANDIDATES."'>";
            foreach ($candidatelist as $acandidate) {
               $text .= "<option class='smalltext' value='2.".$acandidate->GetId()."'>".$acandidate->getName(false, EHDC_TRUNC)."</option>";
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
SC_BEGIN EHD_SEARCH_BAR_SEARCH_FIELD
   parse_str($parm, $parms);
   $text = "<form method='get' action='../../search.php'>";
   $text .= EHD_LAN_SEARCH;
   $text .= " <input class='tbox search' type='text' name='q' size='20' value='' maxlength='50'/>";
   $text .= "<input type='hidden' name='r' value='0'/>";
   $text .= "<input type='hidden' name='t' value='e107helpers_developer'/>";
   if (array_key_exists("showbutton", $parms)) {
      $text .= "&nbsp;<input type='submit' class='button' name='submit' value='".EHD_LAN_SEARCH_GO."'/>";
   }
   $text .= "</form>";
   return $text;
SC_END

// ******************************************************************************************
// Elections
// ******************************************************************************************
SC_BEGIN EHD_ELECTION_ID
   global $e107helpers_developer;
   return $e107helpers_developer->getId();
SC_END

SC_BEGIN EHD_ELECTION_NAME
   global $e107helpers_developer, $e107Helper, $pref;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("hidden", $parms)) {
      $text .= "<input type='hidden' name='".EHDC_POST_ARRAY."[ui_e107helpers_developer_id]' value='".$e107helpers_developer->getId()."'/>";
   }
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".EHDC_SELF."?".EHDC_CANDIDATES_PAGE.".".$e107helpers_developer->getId()."'>";
   }
   $text .= $e107helpers_developer->getName();
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   if (!$e107helpers_developer->isOpen()) {
      if (!$e107helpers_developer->isStarted()) {
         $text .= " [".EHD_LAN_NOT_STARTED."]";
      } elseif ($e107helpers_developer->isFinished()) {
         $text .= " [".EHD_LAN_FINISHED."]";
      } else {
         $text .= " [".EHD_LAN_CLOSED."]";
      }
   }
   return $text;
SC_END

SC_BEGIN EHD_ELECTION_DESCRIPTION
   global $e107helpers_developer, $tp;
   return $tp->toHTML($e107helpers_developer->getDescription(), true);
SC_END

SC_BEGIN EHD_ELECTION_ICON
   global $elec, $e107helpers_developer, $pref, $tp;
   parse_str($parm, $parms);
   if ("" == $icon = $e107helpers_developer->getIcon()) {
      return " ";
   }
   $name = $tp->post_toForm($e107helpers_developer->getName(), true);
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".EHDC_SELF."?".EHDC_CANDIDATES_PAGE.".".$e107helpers_developer->getId()."'>";
   }
   $text .= "<img src='".$e107helpers_developer->getIcon()."' title='$name' border='0' alt='$name'";
   if ($pref["e107helpers_developer_tooltips"] && array_key_exists("tooltip", $parms)) {
      $text .= $elec->getTooltip($e107helpers_developer->getDescription(), $e107helpers_developer->getName());
   }
   $text .= "/>";
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN EHD_ELECTION_START_DATE
   global $e107helpers_developer;
   parse_str($parm, $parms);
   $gen = new convert();
   if (array_key_exists("short", $parms)) {
      $text .= str_replace(" ", "&nbsp;", $gen->convert_date($e107helpers_developer->getStartDate(), "short"));
   } else {
      $text .= $gen->convert_date($e107helpers_developer->getStartDate(), "long");
   }
   return $text;
SC_END

SC_BEGIN EHD_ELECTION_END_DATE
   global $e107helpers_developer;
   parse_str($parm, $parms);
   $gen = new convert();
   if (array_key_exists("short", $parms)) {
      $text .= str_replace(" ", "&nbsp;", $gen->convert_date($e107helpers_developer->getEndDate(), "short"));
   } else {
      $text .= $gen->convert_date($e107helpers_developer->getEndDate(), "long");
   }
   return $text;
SC_END

SC_BEGIN EHD_ELECTION_OWNER
   global $e107helpers_developer;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".e_HTTP."user.php?id.".$e107helpers_developer->getOwnerId()."'>";
   }
   $text .= $e107helpers_developer->getOwner();
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN EHD_ELECTION_CANDIDATES
   global $e107helpers_developer;
   return $e107helpers_developer->getCandidateTotal();
SC_END

SC_BEGIN EHD_ELECTION_VOTES_PER_PERSON
   global $e107helpers_developer, $e107helpers_developerUser, $tp;
   if ($e107helpers_developerUser->canVoteElection($e107helpers_developer->getId())) {
      return str_replace("{votes}", $e107helpers_developer->getVotesPerPerson(), EHD_LAN_MSG_VOTES_PER_PERSON);
   } else {
      return EHD_LAN_MSG_NOT_ELIGIBLE_TO_VOTE;
   }
SC_END

SC_BEGIN EHD_ELECTION_VOTERS
   global $e107helpers_developer, $dao;
   return $dao->getElectionVoterCount($e107helpers_developer->getId());
SC_END

// ******************************************************************************************
// Candidates
// ******************************************************************************************
SC_BEGIN EHD_CANDIDATE_ID
   global $elec, $e107helpers_developer, $candidate, $e107helpers_developerUser, $tp;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms) && $e107helpers_developerUser->canEditElection($e107helpers_developer->getId())) {
      $text .= "<a href='".EHDC_SELF."?".EHDC_EDIT_CANDIDATE_PAGE.".".$candidate->getId()."'>";
   }
   $text .= "#".$candidate->getId();
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN EHD_CANDIDATE_NAME
   global $elec, $e107helpers_developer, $candidate, $pref, $tp;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".EHDC_SELF."?".EHDC_CANDIDATE_PAGE.".".$candidate->getId()."'>";
   }
   $name = $candidate->getName();
   if (array_key_exists("truncate", $parms)) {
      $name = $tp->html_truncate($name, $parms["truncate"], "...");
   }
   if ($pref["e107helpers_developer_tooltips"] && array_key_exists("tooltip", $parms)) {
      $text .= "<span".$elec->getTooltip($candidate->getDescription()).">$name</span>";
   } else {
      $text .= $name;
   }
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN EHD_CANDIDATE_TITLE
   global $elec, $e107helpers_developer, $candidate, $pref, $tp;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".EHDC_SELF."?".EHDC_CANDIDATE_PAGE.".".$candidate->getId()."'>";
   }
   $title = $candidate->getTitle();
   if (array_key_exists("truncate", $parms)) {
      $title = $tp->html_truncate($title, $parms["truncate"], "...");
   }
   if ($pref["e107helpers_developer_tooltips"] && array_key_exists("tooltip", $parms)) {
      $text .= "<span".$elec->getTooltip($candidate->getDescription()).">$title</span>";
   } else {
      $text .= $title;
   }
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN EHD_CANDIDATE_DESCRIPTION
   global $candidate, $tp;
   return $tp->toHTML($candidate->getDescription(), true);
SC_END

SC_BEGIN EHD_CANDIDATE_ICON
   global $elec, $candidate, $pref, $tp;
   parse_str($parm, $parms);
   if ("" == $icon = $candidate->getIcon()) {
      return " ";
   }
   $name = $tp->post_toForm($candidate->getName(), true);
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".EHDC_SELF."?".EHDC_CANDIDATES_PAGE.".".$candidate->getId()."'>";
   }
   $text .= "<img src='".$candidate->getIcon()."' title='$name' border='0' alt='$name'";
   if ($pref["e107helpers_developer_tooltips"] && array_key_exists("tooltip", $parms)) {
      $text .= $elec->getTooltip($candidate->getDescription(), $candidate->getName());
   }
   $text .= "/>";
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN EHD_CANDIDATE_IMAGES
   global $elec, $e107helpers_developer, $candidate, $tp;
   parse_str($parm, $parms);
   if ($candidate->getImages() == EHD_LAN_MSG_NO_IMAGE) {
      return EHD_LAN_IMAGES_NONE;
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
      $text .= "</a><br/>".EHD_LAN_MSG_CLICK_TO_VIEW;
   }
   return $text;
SC_END

SC_BEGIN EHD_CANDIDATE_LINK_DESCRIPTION
   global $candidate;
   return $candidate->getLinkDescription();
SC_END

SC_BEGIN EHD_CANDIDATE_LINK_URL
   global $candidate;
   return $candidate->getLinkURL();
SC_END

SC_BEGIN EHD_CANDIDATE_LINK
   global $candidate, $tp;
   $text = "";
   if (strlen($candidate->getLinkDescription()) > 0 && strlen($candidate->getLinkURL()) > 0) {
      $text .= "<a href='".$candidate->getLinkURL()."'>".$tp->toHTML($candidate->getLinkDescription(), true)."</a>";
   }
   return $text;
SC_END

SC_BEGIN EHD_CANDIDATE_POINTS
   global $points;
   return varset($points, "");
SC_END

SC_BEGIN EHD_CANDIDATE_VOTERS
   global $candidate, $dao;
   return $dao->getCandidateVoterCount($candidate->getId());
SC_END

SC_BEGIN EHD_CANDIDATE_COMMENTS
   global $e107helpers_developer, $candidate, $e107Helper;
   if ($e107helpers_developer->allowComments()) {
      return $e107Helper->getComment("e107helpers_developer", $candidate->getId());
   }
   return "";
SC_END

SC_BEGIN EHD_CANDIDATE_RATING
   global $e107helpers_developer, $candidate, $e107Helper;
   if ($e107helpers_developer->allowRatings()) {
      return $e107Helper->getRating("e107helpers_developer", $candidate->getId());
   }
   return "";
SC_END

SC_BEGIN EHD_CANDIDATE_RATING_SHORT
   global $e107helpers_developer, $candidate, $e107Helper;
   if ($e107helpers_developer->allowRatings()) {
      return $e107Helper->getRating("e107helpers_developer", $candidate->getId(), false, true);
   }
   return "";
SC_END

// ******************************************************************************************
// Voting
// ******************************************************************************************
SC_BEGIN EHD_VOTE_POSITION
   global $position;
   return $position;
SC_END

SC_BEGIN EHD_VOTE_CANDIDATE
   global $position, $candidate, $EHD_VOTE_VIEW_CANDIDATE, $e107helpers_developer_shortcodes, $tp;
   $text = $tp->parseTemplate($EHD_VOTE_VIEW_CANDIDATE, FALSE, $e107helpers_developer_shortcodes);
   return $text;
SC_END

SC_BEGIN EHD_VOTE_CANDIDATE_SELECT
   global $candidate, $candidatelist, $position, $e107helpers_developerUser, $EHD_VOTE_FORM_CANDIDATE, $e107helpers_developer_shortcodes, $tp;
   $text = "<select name='candidate[$position]' class='tbox'>";
   $acandidatelist = $candidatelist;
   $text .= "<option value=''>".EHD_LAN_SELECT."</option>";
   foreach ($acandidatelist as $candidate) {
      if (!$e107helpers_developerUser->isRestricted($candidate->getRestrictionValue(), $candidate->getRestrictionField())) {
         $selected = (isset($_POST["candidate"][$position]) && $_POST["candidate"][$position] == $candidate->getId()) ? " selected='selected'" : "";
         $value = $tp->parseTemplate($EHD_VOTE_FORM_CANDIDATE, FALSE, $e107helpers_developer_shortcodes);
         $text .= "<option value='".$candidate->getId()."'$selected>$value</option>";
      }
   }
   $text .= "</select>";
   return $text;
SC_END

SC_BEGIN EHD_VOTE_RULES
   global $e107helpers_developer, $tp;
   $text = "";
   $text .= "<p>".EHD_LAN_VOTE_RULES_1."</p>";
   $text .= "<p>".EHD_LAN_VOTE_RULES_2."<ul>";
   $pointspervote = $e107helpers_developer->getPointsPerVote();
   for ($i=0; $i<count($pointspervote); $i++) {
      $text .= "<li>".$pointspervote[$i].EHD_LAN_VOTE_RULES_3.($i+1)."</li>";
   }
   $text .= "</ul></p>";
   if (strlen($e107helpers_developer->getRestrictionText()) > 0) {
      $text .= "<p>".EHD_LAN_VOTE_RESTRICT.$e107helpers_developer->getRestrictionText()."</p>";
   }
   return $text;
SC_END

// ******************************************************************************************
// Submit/Edit candidate
// ******************************************************************************************
SC_BEGIN EHD_VOTE_SECURE_IMAGE
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
      $text .= EHD_LAN_SECURITY_ENTER;
   }
   return $text;
SC_END

// ******************************************************************************************
// Errors and warnings
// ******************************************************************************************
SC_BEGIN EHD_STATUS_INFO
   global $e107helpers_developerStatusInfo;
   $text = "";
   if (isset($e107helpers_developerStatusInfo) && $e107helpers_developerStatusInfo !== false) {
      switch ($e107helpers_developerStatusInfo->getLevel()) {
         case STATUS_INFO :
            $text .= "<img src='".e_IMAGE."fileinspector/file_check.png' border='0' alt='".EHD_LAN_MSG_INFORMATION."'/> ";
            break;
         case STATUS_WARN :
            $text .= "<img src='".e_IMAGE."fileinspector/file_warning.png' border='0' alt='".EHD_LAN_MSG_WARNING."'/> ";
            break;
         case STATUS_ERROR :
            $text .= "<img src='".e_IMAGE."fileinspector/file_uncalc.png' border='0' alt='".EHD_LAN_MSG_ERROR."'/> ";
            break;
         case STATUS_FATAL :
            $text .= "<img src='".e_IMAGE."fileinspector/file_fail.png' border='0' alt='".EHD_LAN_MSG_FATAL."'/> ";
            break;
         case STATUS_DEBUG :
            $text .= "<img src='".e_IMAGE."fileinspector/file_unknown.png' border='0' alt='".EHD_LAN_MSG_DEBUG."'/> ";
            break;
         default :
      }
      $text .= $e107helpers_developerStatusInfo->getLevelDescription();
      for ($i=0; $i < $e107helpers_developerStatusInfo->getMessageCount(); $i++) {
         if ($e107helpers_developerStatusInfo->hasAdditionalDetails($i)) {
            $attributes = " style='cursor:pointer;' onclick='expandit(this);";
         }
         $text .= "<div $attributes'>".$e107helpers_developerStatusInfo->getMessage($i)."</div><div></div>";
         if ($e107helpers_developerStatusInfo->hasAdditionalDetails($i)) {
            $text .= "<div style='display:none;margin-left:10px'>".$e107helpers_developerStatusInfo->getAdditionalDetails($i)."</div>";
         }
      }
   }
   return $text;
SC_END

SC_BEGIN EHD_NAV_ERROR
   return "<a href='".EHDC_SELF."'>".EHD_LAN_MSG_NAV_ERROR."</a>";
SC_END

*/
?>
