<?php

global $sc_style, $election_shortcodes;

// Template name, as displayed in drop down list of templates
$election_template_name = "Default";
// Template description, a bit more info about the template
$election_template_description = "Default template supplied with Election by bugrain";

// ************************************************************************************************
// Page Templates
// These template variables are passed from the election code, they must be defined to ensure
// all Election pages can at least display something

// Election level
global $ELEC_ELECTION_LIST_HEAD;    // header for the election list page
global $ELEC_ELECTION_LIST_BODY;    // represents one election, repeated for each election in the list
global $ELEC_ELECTION_LIST_FOOT;    // footer for the election list page

// Candidate level
global $ELEC_CANDIDATE_LIST_HEAD;   // header for the candidate list page
global $ELEC_CANDIDATE_LIST_BODY;   // represents one candidate, repeated for each candidate in the list
global $ELEC_CANDIDATE_LIST_FOOT;   // footer for the candidate list page
global $ELEC_CANDIDATE_VIEW;        // page displaying an individual candidate

// Vote level
global $ELEC_VOTE_FORM_HEAD;        // header for the voting list page
global $ELEC_VOTE_FORM_BODY;        // represents one vote, repeated for each vote allowed in the list
global $ELEC_VOTE_FORM_FOOT;        // footer for the voting list page
global $ELEC_VOTE_VIEW_HEAD;        // header for the users votes listpage
global $ELEC_VOTE_VIEW_BODY;        // represents one vote, repeated for each vote cast in the list
global $ELEC_VOTE_VIEW_FOOT;        // footer for the users votes list page
global $ELEC_VOTES_VIEW;            // page displaying vote summary
global $ELEC_VOTE_FORM_CANDIDATE;   // The layout of the drop down list entry for a candidate on the voting page for a candidate
global $ELEC_VOTE_VIEW_CANDIDATE;   // The layout of a candidate that a user has voted for on the users votes page
global $ELEC_VOTES_LIST_HEAD;       // header for the votes list page
global $ELEC_VOTES_LIST_BODY;       // represents one votes, repeated for each candidate in the list
global $ELEC_VOTES_LIST_FOOT;       // footer for the votes list page

// Misc stuff
global $ELEC_NAV_ERROR;             // error page, mainly to hide real pages for users without access if they are trying to 'hack' in using URL parameters
// ************************************************************************************************
// Status info is used to report back erros after form submission and is used in submit and edit candidate sections
$sc_style['ELEC_STATUS_INFO']['pre']  = "<div class='indent'>";
$sc_style['ELEC_STATUS_INFO']['post'] = "</div>";

if (!isset($ELEC_ELECTION_LIST_HEAD)){
   $ELEC_ELECTION_LIST_HEAD = "
      {ELEC_NAV_BAR}
      {ELEC_SEARCH_BAR}
      <div class='forumheader' style='margin-bottom:2px;'>
      <table summary='{ELEC_ELECTION_LIST_SUMMARY}' style='width:100%;'>
         <tr>
            <td class='forumheader2' style='text-align:center;width:10%'>".ELEC_LAN_ELECTION_ICON."</td>
            <td class='forumheader2' style='text-align:left;width:50%'>".ELEC_LAN_ELECTION_NAME."</td>
            <td class='forumheader2' style='text-align:center;width:10%'>".ELEC_LAN_ELECTION_START_DATE."</td>
            <td class='forumheader2' style='text-align:center;width:10%'>".ELEC_LAN_ELECTION_END_DATE."</td>
            <td class='forumheader2' style='text-align:center;width:10%'>".ELEC_LAN_ELECTION_OWNER."</td>
            <td class='forumheader2' style='text-align:center;width:10%'>".ELEC_LAN_ELECTION_CANDIDATES."</td>
            <td class='forumheader2' style='text-align:center;width:10%'>".ELEC_LAN_ELECTION_VOTERS."</td>
         </tr>
   ";
}
if (!isset($ELEC_ELECTION_LIST_BODY)){
   $ELEC_ELECTION_LIST_BODY = "
      <tr>
         <td class='forumheader3' style='text-align:center;'>{ELEC_ELECTION_ICON=anchor&tooltip}</td>
         <td class='forumheader3' style='text-align:left;'>{ELEC_ELECTION_NAME=anchor}</td>
         <td class='forumheader3' style='text-align:center;'>{ELEC_ELECTION_START_DATE=short}
         <td class='forumheader3' style='text-align:center;'>{ELEC_ELECTION_END_DATE=short}</td>
         <td class='forumheader3' style='text-align:center;'>{ELEC_ELECTION_OWNER=anchor}</td>
         <td class='forumheader3' style='text-align:center;'>{ELEC_ELECTION_CANDIDATES}</td>
         <td class='forumheader3' style='text-align:center;'>{ELEC_ELECTION_VOTERS}</td>
      </tr>
   ";
}
if (!isset($ELEC_ELECTION_LIST_FOOT)){
   $ELEC_ELECTION_LIST_FOOT = "
      </table>
      </div>
   ";
}

if (!isset($ELEC_CANDIDATE_LIST_HEAD)){
   $ELEC_CANDIDATE_LIST_HEAD = "
      {ELEC_NAV_BAR}
      {ELEC_SEARCH_BAR}
      {ELEC_ELECTION_INFO}
      <div class='forumheader' style='margin-bottom:2px;'>
      <table summary='*' style='width:100%;'>
         <tr>
            <td class='forumheader2' style='text-align:center;width:10%;'>{ELEC_BUTTON_VOTE}</td>
            <td class='forumheader2' style='text-align:center;width:30%;'>".ELEC_LAN_CANDIDATE_NAME."</td>
            <td class='forumheader2' style='text-align:center;width:30%;'>".ELEC_LAN_CANDIDATE_TITLE."</td>
            <td class='forumheader2' style='text-align:center;width:10%;'>".ELEC_LAN_CANDIDATE_VOTERS."</td>
            <td class='forumheader2' style='text-align:center;width:20%;'>".ELEC_LAN_CANDIDATE_RATING."</td>
         </tr>
   ";
}
if (!isset($ELEC_CANDIDATE_LIST_BODY)){
   $ELEC_CANDIDATE_LIST_BODY = "
      <tr>
         <td class='forumheader3' style='text-align:center;'>{ELEC_CANDIDATE_ICON=anchor&tooltip}</td>
         <td class='forumheader3' style='text-align:left;'>{ELEC_CANDIDATE_NAME=anchor&tooltip}</td>
         <td class='forumheader3' style='text-align:left;'>{ELEC_CANDIDATE_TITLE=anchor&tooltip}</td>
         <td class='forumheader3' style='text-align:center;'>{ELEC_CANDIDATE_VOTERS}</td>
         <td class='forumheader3' style='text-align:center;'>{ELEC_CANDIDATE_RATING_SHORT}</td>
      </tr>
   ";
}
if (!isset($ELEC_CANDIDATE_LIST_FOOT)){
   $ELEC_CANDIDATE_LIST_FOOT = "
      </table>
      </div>
   ";
}

if (!isset($ELEC_CANDIDATE_VIEW)){
   $ELEC_CANDIDATE_VIEW = "
      {ELEC_NAV_BAR}
      {ELEC_ELECTION_INFO}
      {ELEC_CANDIDATE}
      {ELEC_CANDIDATE_COMMENTS}
   ";
}

// Make sure restriction text row is not displayed if not active
if (!isset($ELEC_VOTE_FORM_HEAD)){
   $ELEC_VOTE_FORM_HEAD = "
      {ELEC_NAV_BAR}
      <div class='forumheader' style='margin-bottom:2px;'>
      <table summary='*' style='width:100%;'>
         <tr>
            <td class='indent' colspan='2' style='text-align:left;'>{ELEC_VOTE_RULES}</td>
         </tr>
         <tr>
            <td class='forumheader2' style='text-align:center;width:10%'>".ELEC_LAN_VOTE_POSITION."</td>
            <td class='forumheader2' style='text-align:left;'>".ELEC_LAN_VOTE_CANDIDATE."</td>
         </tr>
   ";
}
if (!isset($ELEC_VOTE_FORM_BODY)){
   $ELEC_VOTE_FORM_BODY = "
      <tr>
         <td class='forumheader3' style='text-align:center;'>{ELEC_VOTE_POSITION}</td>
         <td class='forumheader3' style='text-align:left;'>{ELEC_VOTE_CANDIDATE_SELECT}</td>
      </tr>
   ";
}
if (!isset($ELEC_VOTE_FORM_FOOT)){
   $ELEC_VOTE_FORM_FOOT = "
         <tr>
            <td class='forumheader2' colspan='2' style='text-align:center;'>{ELEC_BUTTON_VOTE_SUBMIT}</td>
         </tr>
      </table>
      </div>
   ";
}

if (!isset($ELEC_VOTE_VIEW_HEAD)){
   $ELEC_VOTE_VIEW_HEAD = "
      {ELEC_NAV_BAR}
      <div class='forumheader' style='margin-bottom:2px;'>
      <table summary='*' style='width:100%;'>
         <tr>
            <td class='forumheader2' style='text-align:center;width:10%'>".ELEC_LAN_VOTE_POSITION."</td>
            <td class='forumheader2' style='text-align:left;'>".ELEC_LAN_VOTE_CANDIDATE."</td>
         </tr>
   ";
}
if (!isset($ELEC_VOTE_VIEW_BODY)){
   $ELEC_VOTE_VIEW_BODY = "
      <tr>
         <td class='forumheader3' style='text-align:center;'>{ELEC_VOTE_POSITION}</td>
         <td class='forumheader3' style='text-align:left;'>{ELEC_VOTE_CANDIDATE}</td>
      </tr>
   ";
}
if (!isset($ELEC_VOTE_VIEW_FOOT)){
   $ELEC_VOTE_VIEW_FOOT = "
      </table>
      </div>
   ";
}

if (!isset($ELEC_VOTES_VIEW)){
   $ELEC_VOTES_VIEW = "
      {ELEC_NAV_BAR}
      {ELEC_ELECTION_INFO}
      {ELEC_VOTES}
   ";
}

if (!isset($ELEC_VOTE_FORM_CANDIDATE)){
   $ELEC_VOTE_FORM_CANDIDATE = "{ELEC_CANDIDATE_NAME} ({ELEC_CANDIDATE_TITLE})";
}

if (!isset($ELEC_VOTE_VIEW_CANDIDATE)){
   $ELEC_VOTE_VIEW_CANDIDATE = "
      <div style='float:left;'>{ELEC_CANDIDATE_ICON}</div>&nbsp;&nbsp;{ELEC_CANDIDATE_NAME} - {ELEC_CANDIDATE_TITLE}
      <br/>
      &nbsp;&nbsp;{ELEC_CANDIDATE_DESCRIPTION}
      ";
}

if (!isset($ELEC_VOTES_LIST_HEAD)){
   $ELEC_VOTES_LIST_HEAD = "
      {ELEC_NAV_BAR}
      {ELEC_SEARCH_BAR}
      {ELEC_ELECTION_INFO}
      <div class='forumheader' style='margin-bottom:2px;'>
      <table summary='*' style='width:100%;'>
         <tr>
            <td class='forumheader2' style='text-align:center;width:10%;'>".ELEC_LAN_CANDIDATE_POINTS."</td>
            <td class='forumheader2' style='text-align:left;width:90%;'>".ELEC_LAN_CANDIDATE."</td>
         </tr>
   ";
}
if (!isset($ELEC_VOTES_LIST_BODY)){
   $ELEC_VOTES_LIST_BODY = "
      <tr>
         <td class='forumheader3' style='text-align:center;'>{ELEC_CANDIDATE_POINTS}</td>
         <td class='forumheader3' style='text-align:left;'>
            <div style='float:left;'>{ELEC_CANDIDATE_ICON}</div>&nbsp;&nbsp;{ELEC_CANDIDATE_NAME=anchor&tooltip} - {ELEC_CANDIDATE_TITLE}
            <br/>
            &nbsp;&nbsp;{ELEC_CANDIDATE_DESCRIPTION}
         </td>
      </tr>
   ";
}
if (!isset($ELEC_VOTES_LIST_FOOT)){
   $ELEC_VOTES_LIST_FOOT = "
      </table>
      </div>
   ";
}

if (!isset($ELEC_NAV_ERROR)){
   $ELEC_NAV_ERROR = "
      <table summary='*' style='width:100%;'>
         <tr>
            <td colspan='3' class='forumheader2' style='text-align:center;'>{ELEC_NAV_ERROR}</td>
         </tr>
      </table>
   ";
}

// ************************************************************************************************
// Section Templates
// These template variables have a matching shortcode in the shortcodes file that parse its
// template, they define major sections of a page. Sections can be 'glued' together to make the
// whole page. They are mainly used by the page templates (see above). Makes them globals, too.
global $ELEC_NAV_BAR;                  // Navigation bar
global $ELEC_SEARCH_BAR;               // Search bar

global $ELEC_ELECTION_INFO;            // Detailed election information

global $ELEC_CANDIDATE;                // Detailed candidate information
global $ELEC_CANDIDATE_COMMENTS;       // Candidate comments

// ************************************************************************************************

// Navigation bar
$sc_style['ELEC_NAV_BAR']['pre']  = "<div class='forumheader' style='margin-bottom:2px;text-align:right;'>";
$sc_style['ELEC_NAV_BAR']['post'] = "</div>";

if (!isset($ELEC_NAV_BAR)){
   $ELEC_NAV_BAR = "
      <table summary='*' style='width:100%;'><tr>
         <td>{ELEC_NAV_BAR_JUMP_LIST}</td>
         <td style='text-align:right;'>
            {ELEC_BUTTON_ELECTIONS_LIST}
            {ELEC_BUTTON_CANDIDATE_LIST}
            {ELEC_BUTTON_VOTES_PAGE}
         </td>
      </tr></table>
   ";
}

// Search bar
$sc_style['ELEC_SEARCH_BAR']['pre']  = "<div class='forumheader2' style='text-align:right;'>";
$sc_style['ELEC_SEARCH_BAR']['post'] = "</div>";
if (!isset($ELEC_SEARCH_BAR)){
   $ELEC_SEARCH_BAR = "
      <table summary='*' style='width:100%;'><tr>
         <td style='text-align:left;'>{ELEC_BUTTON_VOTE}</td>
         <td style='text-align:right;'>{ELEC_SEARCH_BAR_SEARCH_FIELD}</td>
      </tr></table>
   ";
}

// Election summary information
$sc_style['ELEC_ELECTION_INFO']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['ELEC_ELECTION_INFO']['post'] = "</div>";

if (!isset($ELEC_ELECTION_INFO)){
   $ELEC_ELECTION_INFO = "
      <table summary='*' style='width:100%;'>
         <tr>
            <td class='forumheader2' style='width:5%;text-align:center;'>{ELEC_ELECTION_ICON}</td>
            <td class='forumheader3' style='width:40%'>{ELEC_ELECTION_NAME}</td>
            <td>
            <table summary='*' style='width:100%;'>
               <tr>
                  <td class='forumheader2' style='width:20%'>".ELEC_LAN_ELECTION_START_DATE."</td>
                  <td class='forumheader3' style='width:30%'>{ELEC_ELECTION_START_DATE=short}</td>
                  <td class='forumheader2' style='width:20%'>".ELEC_LAN_ELECTION_END_DATE."</td>
                  <td class='forumheader3' style='width:30%'>{ELEC_ELECTION_END_DATE=short}</td>
               </tr>
               <tr>
                  <td class='forumheader2'>".ELEC_LAN_ELECTION_CANDIDATES."</td>
                  <td class='forumheader3'>{ELEC_ELECTION_CANDIDATES}</td>
                  <td class='forumheader2'>".ELEC_LAN_ELECTION_VOTERS."</td>
                  <td class='forumheader3'>{ELEC_ELECTION_VOTERS}</td>
               </tr>
            </table>
            </td>
         </tr>
         <tr>
            <td class='forumheader2'>".ELEC_LAN_ELECTION_OWNER."</td>
            <td class='forumheader3' colspan='2'>{ELEC_ELECTION_OWNER=anchor}</td>
         </tr>
         <tr>
            <td class='forumheader2'>".ELEC_LAN_ELECTION_DESCRIPTION."</td>
            <td class='forumheader3' colspan='2'>{ELEC_ELECTION_DESCRIPTION}</td>
         </tr>
         <tr>
            <td class='forumheader2'>".ELEC_LAN_ELECTION_VOTES_PER_PERSON."</td>
            <td class='forumheader3' colspan='2'>{ELEC_ELECTION_VOTES_PER_PERSON}</td>
         </tr>
      </table>
   ";
}

// Candidate
$sc_style['ELEC_CANDIDATE']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['ELEC_CANDIDATE']['post'] = "</div>";

if (!isset($ELEC_CANDIDATE)){
   $ELEC_CANDIDATE = "
      <table summary='*' style='width:100%;'>
         <tr>
            <td colspan='6' class='forumheader3'>{ELEC_CANDIDATE_ICON} <strong>{ELEC_CANDIDATE_NAME}</strong></td>
         </tr>
         <tr>
            <td class='forumheader2' style='width:20%'>".ELEC_LAN_CANDIDATE_NAME."</td>
            <td class='forumheader3'>{ELEC_CANDIDATE_NAME}</td>
            <td class='forumheader2' style='width:20%'>".ELEC_LAN_CANDIDATE_TITLE."</td>
            <td class='forumheader3'>{ELEC_CANDIDATE_TITLE}</td>
         </tr>
         <tr>
            <td class='forumheader2'>".ELEC_LAN_CANDIDATE_DESCRIPTION."</td>
            <td colspan='3' class='forumheader3'>{ELEC_CANDIDATE_DESCRIPTION}</td>
         </tr>
         <tr>
            <td class='forumheader2'>".ELEC_LAN_CANDIDATE_LINK."</td>
            <td colspan='3' class='forumheader3'>{ELEC_CANDIDATE_LINK}</td>
         </tr>
         <tr>
            <td class='forumheader2'>".ELEC_LAN_CANDIDATE_IMAGES."</td>
            <td colspan='3' class='forumheader3'>{ELEC_CANDIDATE_IMAGES=anchor&maxheight=300}</td>
         </tr>
      </table>
      <table summary='*' style='width:100%;'>
         <tr><td class='forumheader2' style='text-align:right;'>{ELEC_CANDIDATE_RATING}</td></tr>
      </table>
   ";
}

// candidate comments
$sc_style['ELEC_CANDIDATE_COMMENTS']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['ELEC_CANDIDATE_COMMENTS']['post'] = "</div>";

if (!isset($ELEC_CANDIDATE_COMMENTS)){
   $ELEC_CANDIDATE_COMMENTS = "
      <table summary='*' style='width:100%;'>
         <tr>
            <td class='forumheader3'>{ELEC_CANDIDATE_COMMENTS}</td>
         </tr>
      </table>
   ";
}
?>