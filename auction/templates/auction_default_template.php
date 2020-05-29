<?php

global $sc_style, $auc_shortcodes;

// Template name, as displayed in drop down list of templates
$auc_template_name = "Default";
// Template description, a bit more info about the template
$auc_template_description = "Default template supplied with Auction by bugrain";

// ************************************************************************************************
// Page Templates
// These template variables are passed from the auction code, they must be defined to ensure
// all Auction pages can at least display something

// Auction level
global $AUC_AUCTION_LIST_HEAD;   // header for the application list page
global $AUC_AUCTION_LIST_BODY;   // represents one application, repeated for each application in the list
global $AUC_AUCTION_LIST_FOOT;   // footer for the application list page

// Lot level
global $AUC_LOT_LIST_HEAD;       // header for the auc list page
global $AUC_LOT_LIST_BODY;       // represents one auc, repeated for each auc in the list
global $AUC_LOT_LIST_FOOT;       // footer for the auc list page

global $AUC_LOT_VIEW;            // page displaying an individual auc
global $AUC_LOT_SUBMIT_VIEW;     // page to submit a new auc
global $AUC_LOT_EDIT_VIEW;       // page to edit/update an existing auc

// Bid level
global $AUC_BID_HISTORY_HEAD;    // Header for history of bids for a specific lot
global $AUC_BID_HISTORY_BODY;    // Body for history of bids for a specific lot
global $AUC_BID_HISTORY_FOOT;    // Footer for history of bids for a specific lot

// Bid level
global $AUC_MENU_HEAD;           // Header for auction menu - e.g. auction name
global $AUC_MENU_BODY;           // Body for auction menu - e.g. auction title/last bid
global $AUC_MENU_FOOT;           // Footer auction menu - e.g. closing date

// Misc stuff
global $AUC_NAV_ERROR;           // error page, mainly to hide real pages for users without access if they are trying to 'hack' in using URL parameters
// ************************************************************************************************
if (!isset($AUC_AUCTION_LIST_HEAD)){
   $AUC_AUCTION_LIST_HEAD = "
      {AUC_NAV_BAR}
      {AUC_SEARCH_BAR}
      <div class='forumheader' style='margin-bottom:2px;'>
      <table summary='{AUC_AUCTION_LIST_SUMMARY}' style='width:100%;'>
         <tr>
            <td class='forumheader2' style='text-align:center;width:10%'>{AUC_LABEL_AUCTION_ICON}</td>
            <td class='forumheader2' style='text-align:left;width:50%'>{AUC_LABEL_AUCTION_NAME}</td>
            <td class='forumheader2' style='text-align:center;width:10%'>{AUC_LABEL_AUCTION_START_DATE}</td>
            <td class='forumheader2' style='text-align:center;width:10%'>{AUC_LABEL_AUCTION_END_DATE}</td>
            <td class='forumheader2' style='text-align:center;width:10%'>{AUC_LABEL_OWNER}</td>
            <td class='forumheader2' style='text-align:center;width:10%'>{AUC_LABEL_LOTS}</td>
         </tr>
   ";
}
if (!isset($AUC_AUCTION_LIST_BODY)){
   $AUC_AUCTION_LIST_BODY = "
      <tr>
         <td class='forumheader3' style='text-align:center;'>{AUC_AUCTION_ICON=anchor&tooltip}</td>
         <td class='forumheader3' style='text-align:left;'>{AUC_AUCTION_NAME=anchor}</td>
         <td class='forumheader3' style='text-align:center;'>{AUC_AUCTION_START_DATE=short}
         <td class='forumheader3' style='text-align:center;'>{AUC_AUCTION_END_DATE=short}</td>
         <td class='forumheader3' style='text-align:center;'>{AUC_AUCTION_OWNER=anchor}</td>
         <td class='forumheader3' style='text-align:center;'>{AUC_AUCTION_LOTS}</td>
      </tr>
   ";
}
if (!isset($AUC_AUCTION_LIST_FOOT)){
   $AUC_AUCTION_LIST_FOOT = "
      </table>
      </div>
   ";
}
if (!isset($AUC_LOT_LIST_HEAD)){
   $AUC_LOT_LIST_HEAD = "
      {AUC_NAV_BAR}
      {AUC_SEARCH_BAR}
      {AUC_AUCTION_INFO}
      <div class='forumheader' style='margin-bottom:2px;'>
      <table summary='*' style='width:100%;'>
         <tr>
            <td class='forumheader2' style='text-align:center;width:10%;'>{AUC_LABEL_ID}</td>
            <td class='forumheader2' style='text-align:center;width:60%;'>{AUC_LABEL_LOT_TITLE}</td>
            <td class='forumheader2' style='text-align:center;width:20%;'>{AUC_LABEL_BID_DATE_TIME}</td>
            <td class='forumheader2' style='text-align:right;width:10%;'>{AUC_LABEL_BID_AMOUNT}</td>
         </tr>
   ";
}
if (!isset($AUC_LOT_LIST_BODY)){
   $AUC_LOT_LIST_BODY = "
      <tr>
         <td class='forumheader3' style='text-align:center;'>{AUC_LOT_ID=anchor}</td>
         <td class='forumheader3' style='text-align:left;'>{AUC_LOT_TITLE=anchor&tooltip}</td>
         <td class='forumheader3' style='text-align:center;'>{AUC_LOT_LAST_BID_DATE_TIME=short}</td>
         <td class='forumheader3' style='text-align:right;'>{AUC_LOT_LAST_BID_AMOUNT}</td>
      </tr>
   ";
}
if (!isset($AUC_LOT_LIST_FOOT)){
   $AUC_LOT_LIST_FOOT = "
      </table>
      </div>
   ";
}
if (!isset($AUC_LOT_VIEW)){
   $AUC_LOT_VIEW = "
      {AUC_NAV_BAR}
      {AUC_AUCTION_INFO}
      {AUC_LOT}
      {AUC_BID_SUBMIT}
      {AUC_BID_HISTORY}
   ";
}
if (!isset($AUC_LOT_SUBMIT_VIEW)){
   $AUC_LOT_SUBMIT_VIEW = "
      {AUC_NAV_BAR}
      {AUC_AUCTION_INFO}
      {AUC_LOT_SUBMIT}
   ";
}
if (!isset($AUC_LOT_EDIT_VIEW)){
   $AUC_LOT_EDIT_VIEW = "
      {AUC_NAV_BAR}
      {AUC_AUCTION_INFO}
      {AUC_LOT_EDIT}
   ";
}
if (!isset($AUC_BID_HISTORY_HEAD)){
   $AUC_BID_HISTORY_HEAD = "
      <div class='forumheader' style='margin-bottom:2px;'>
      <table summary='*' style='width:100%;'>
         <tr>
            <td colspan='5' class='forumheader2' style='text-align:center;font-weight:bold;'>{AUC_LABEL_BID_HISTORY}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{AUC_LABEL_BID_DATE_TIME}</td>
            <td class='forumheader2'>{AUC_LABEL_BID_BIDDER}</td>
            <td class='forumheader2'>{AUC_LABEL_BID_EMAIL}</td>
            <td class='forumheader2'>{AUC_LABEL_BID_TELEPHONE}</td>
            <td class='forumheader2' style='text-align:right;'>{AUC_LABEL_BID_AMOUNT}</td>
         </tr>
   ";
}
if (!isset($AUC_BID_HISTORY_BODY)){
   $AUC_BID_HISTORY_BODY = "
         <tr>
            <td class='forumheader3'>{AUC_BID_DATE_TIME=short} </td>
            <td class='forumheader3'>{AUC_BID_NAME} {AUC_BID_BIDDER=anchor}</td>
            <td class='forumheader3'>{AUC_BID_EMAIL}</td>
            <td class='forumheader3'>{AUC_BID_TELEPHONE}&nbsp;</td>
            <td class='forumheader3' style='text-align:right;'>{AUC_BID_AMOUNT}</td>
         </tr>
   ";
}
if (!isset($AUC_BID_HISTORY_FOOT)){
   $AUC_BID_HISTORY_FOOT = "
      </table>
      </div>
   ";
}
if (!isset($AUC_MENU_HEAD)){
   $AUC_MENU_HEAD = "
      <table summary='*' style='width:100%;'>
         <tr>
            <td colspan='2' class='forumheader2' style='text-align:center'>{AUC_AUCTION_NAME}</td>
         </tr>
   ";
}
if (!isset($AUC_MENU_BODY)){
   $AUC_MENU_BODY = "
      <tr>
         <td class='forumheader3' style='text-align:center;'><span class='smalltext'>{AUC_LOT_TITLE=anchor&tooltip&truncate=18}</span></td>
         <td class='forumheader3' style='text-align:right;'><span class='smalltext'>{AUC_LOT_LAST_BID_AMOUNT}</span></td>
      </tr>
   ";
}
if (!isset($AUC_MENU_FOOT)){
   $AUC_MENU_FOOT = "
         <tr>
            <td colspan='2' class='smalltext' style='text-align:center'>{AUC_LABEL_AUCTION_END_DATE} : {AUC_AUCTION_END_DATE=short}</td>
         </tr>
      </table>
   ";
}
if (!isset($AUC_NAV_ERROR)){
   $AUC_NAV_ERROR = "
      <table summary='{AUC_NAV_ERROR_SUMMARY}' style='width:100%;'>
         <tr>
            <td colspan='3' class='forumheader2' style='text-align:center;'>{AUC_LAN_MSG_NAV_ERROR}</td>
         </tr>
      </table>
   ";
}

// ************************************************************************************************
// Section Templates
// These template variables have a matching shortcode in the shortcodes file that parse its
// template, they define major sections of a page. Sections can be 'glued' together to make the
// whole page. They are mainly used by the page templates (see above). Makes them globals, too.
global $AUC_NAV_BAR;                  // Navigation bar
global $AUC_SEARCH_BAR;               // Search bar

global $AUC_AUCTION_INFO;             // Detailed application information

global $AUC_LOT;                      // Detailed lot information
global $AUC_LOT_COMMENTS;             // Lot comments
global $AUC_LOT_SUBMIT;               // Content of the form used to submit a auc
global $AUC_LOT_EDIT;                 // Content of the form used to edit a auc

global $AUC_BID_SUBMIT;               // Bid submit form
global $AUC_BID_SUMMARY;              // Bid summary details

// ************************************************************************************************

// Navigation bar
$sc_style['AUC_NAV_BAR']['pre']  = "<div class='forumheader' style='margin-bottom:2px;text-align:right;'>";
$sc_style['AUC_NAV_BAR']['post'] = "</div>";

if (!isset($AUC_NAV_BAR)){
   $AUC_NAV_BAR = "
      <table style='width:100%;'><tr>
         <td>{AUC_NAV_BAR_JUMP_LIST}</td>
         <td style='text-align:right;'>
            {AUC_NAV_BAR_AUCTIONS_LIST_BUTTON}
            {AUC_NAV_BAR_LOT_LIST_BUTTON}
            {AUC_NAV_BAR_EDIT_BUTTON}
            {AUC_NAV_BAR_SUBMIT_BUTTON}
         </td>
      </tr></table>
   ";
}

// Search bar
$sc_style['AUC_SEARCH_BAR']['pre']  = "<div class='forumheader2' style='text-align:right;'>";
$sc_style['AUC_SEARCH_BAR']['post'] = "</div>";
if (!isset($AUC_SEARCH_BAR)){
   $AUC_SEARCH_BAR = "
      <table style='width:100%;'><tr>
         <td style='text-align:right;'>{AUC_SEARCH_BAR_SEARCH_FIELD}</td>
      </tr></table>
   ";
}

// Auction summary information
$sc_style['AUC_AUCTION_INFO']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['AUC_AUCTION_INFO']['post'] = "</div>";

if (!isset($AUC_AUCTION_INFO)){
   $AUC_AUCTION_INFO = "
      <table summary='{AUC_AUCTION_SUMMARY}' style='width:100%;'>
         <tr>
            <td class='forumheader2' style='width:5%;text-align:center;'>{AUC_AUCTION_ICON}</td>
            <td class='forumheader3' style='width:40%'>{AUC_AUCTION_NAME}</td>
            <td>
            <table summary='{AUC_AUCTION_SUMMARY}' style='width:100%;'>
               <tr>
                  <td class='forumheader2' style='width:20%'>{AUC_LABEL_OWNER}</td>
                  <td class='forumheader3' style='width:30%'>{AUC_AUCTION_OWNER=anchor}</td>
                  <td class='forumheader2' style='width:20%'>{AUC_LABEL_AUCTION_START_DATE}</td>
                  <td class='forumheader3' style='width:30%'>{AUC_AUCTION_START_DATE=short}</td>
               </tr>
               <tr>
                  <td class='forumheader2'>{AUC_LABEL_LOTS}</td>
                  <td class='forumheader3'>{AUC_AUCTION_LOTS}</td>
                  <td class='forumheader2'>{AUC_LABEL_AUCTION_END_DATE}</td>
                  <td class='forumheader3'>{AUC_AUCTION_END_DATE=short}</td>
               </tr>
            </table>
            </td>
         </tr>
         <tr>
            <td class='forumheader2'>{AUC_LABEL_DESCRIPTION}</td>
            <td class='forumheader3' colspan='2'>{AUC_AUCTION_DESCRIPTION}</td>
         </tr>
      </table>
   ";
}

// Lot
$sc_style['AUC_LOT']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['AUC_LOT']['post'] = "</div>";

if (!isset($AUC_LOT)){
   $AUC_LOT = "
      <table summary='*' style='width:100%;'>
         <tr>
            <td colspan='6' class='forumheader3'><strong>{AUC_LOT_TITLE}</strong> ({AUC_LOT_ID})</td>
         </tr>
         <tr>
            <td class='forumheader2'>{AUC_LABEL_RESERVE}</td>
            <td colspan='3' class='forumheader3'>{AUC_LOT_RESERVE}</td>
         </tr>
         <tr>
            <td class='forumheader2' style='width:20%'>{AUC_LABEL_POSTER}</td>
            <td class='forumheader3'>{AUC_LOT_POSTER=anchor} {AUC_LOT_DATE_TIME=short}</td>
            <td class='forumheader2' style='width:20%'>{AUC_LABEL_LAST_UPDATE_POSTER}</td>
            <td class='forumheader3'>{AUC_LOT_LAST_UPDATE_POSTER=anchor} {AUC_LOT_LAST_UPDATE_DATE_TIME=short}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{AUC_LABEL_LAST_BID_DATE_TIME}</td>
            <td class='forumheader3'>{AUC_LOT_LAST_BID_DATE_TIME=short}</td>
            <td class='forumheader2'>{AUC_LABEL_LAST_BID_AMOUNT}</td>
            <td class='forumheader3'>{AUC_LOT_LAST_BID_AMOUNT}</td>
         </tr>
         <tr>
            <td colspan='4' class='forumheader2'>{AUC_LABEL_DESCRIPTION}</td>
         </tr>
         <tr>
            <td colspan='4' class='forumheader3'>{AUC_LOT_DESCRIPTION}</td>
         </tr>
         <tr>
            <td colspan='4' class='forumheader2'>{AUC_LABEL_IMAGES}</td>
         </tr>
         <tr>
            <td colspan='4' class='forumheader3'>{AUC_LOT_IMAGES=anchor&maxheight=300}</td>
         </tr>
      </table>
   ";
}

// Bid
$sc_style['AUC_BID_SUBMIT']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['AUC_BID_SUBMIT']['post'] = "</div>";

if (!isset($AUC_BID_SUBMIT)){
   $AUC_BID_SUBMIT = "
      <table summary='*' style='width:70%;'>
         <tr>
            <td colspan='4' class='forumheader2' style='text-align:center;font-weight:bold;'>{AUC_LABEL_BID_SUBMIT}</td>
         </tr>
         <tr>
         <td class='forumheader2' style='width:30%;'>{AUC_LABEL_BID_AMOUNT}{AUC_LABEL_MANDATORY_SYMBOL}</td>
            <td class='forumheader3'>{AUC_BID_AMOUNT_EDIT=tooltip} ({AUC_LABEL_RESERVE} {AUC_LOT_RESERVE})</td>
         </tr>
         <tr>
            <td class='forumheader2' style='width:20%;'>{AUC_LABEL_BID_NAME}{AUC_LABEL_MANDATORY_SYMBOL}</td>
            <td class='forumheader3'>{AUC_BID_NAME_EDIT=tooltip}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{AUC_LABEL_BID_EMAIL}{AUC_LABEL_MANDATORY_SYMBOL}</td>
            <td class='forumheader3'>{AUC_BID_EMAIL_EDIT=tooltip}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{AUC_LABEL_BID_TELEPHONE}</td>
            <td class='forumheader3'>{AUC_BID_TELEPHONE_EDIT=tooltip}</td>
         </tr>
         <!--tr>
            <td class='forumheader2' style='text-align:right;'>{AUC_BID_SECURE_IMAGE=label}</td>
            <td class='forumheader3'>{AUC_BID_SECURE_IMAGE=field}</td>
         </tr-->
         <tr>
            <td colspan='4' class='forumheader2'>{AUC_LABEL_MANDATORY}</td>
         </tr>
         <tr>
            <td colspan='4' class='forumheader2' style='text-align:center'>{AUC_BID_SUBMIT_BUTTON}</td>
         </tr>
      </table>
   ";
}

// Bid summary
$sc_style['AUC_BID_SUMMARY']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['AUC_BID_SUMMARY']['post'] = "</div>";

if (!isset($AUC_BID_SUMMARY)){
   $AUC_BID_SUMMARY = "
      <table summary='*' style='width:100%;'>
         <tr>
            <td colspan='4' class='forumheader2' style='text-align:center;font-weight:bold;'>{AUC_LABEL_BID_SUMMARY}</td>
         </tr>
         <tr>
            <td class='forumheader2' style='width:15%;'>{AUC_LABEL_LAST_BID_DATE_TIME}</td>
            <td class='forumheader3' style='width:35%;'>{AUC_LOT_LAST_BID_DATE_TIME=short}</td>
            <td class='forumheader2' style='width:15%;'>{AUC_LABEL_LAST_BID_AMOUNT}</td>
            <td class='forumheader3' style='width:35%;'>{AUC_LOT_LAST_BID_AMOUNT}</td>
         </tr>
      </table>
   ";
}

// lot comments
$sc_style['AUC_LOT_COMMENTS']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['AUC_LOT_COMMENTS']['post'] = "</div>";

if (!isset($AUC_LOT_COMMENTS)){
   $AUC_LOT_COMMENTS = "
      <table summary='*' style='width:100%;'>
         <tr>
            <td class='forumheader3'>{AUC_LOT_COMMENTS}</td>
         </tr>
      </table>
   ";
}

// Status info is used to report back erros after form submission and is used in submit and edit auc sections
$sc_style['AUC_STATUS_INFO']['pre']  = "<div class='indent'>";
$sc_style['AUC_STATUS_INFO']['post'] = "</div>";

// Submit auc
$sc_style['AUC_LOT_SUBMIT']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['AUC_LOT_SUBMIT']['post'] = "</div>";

if (!isset($AUC_LOT_SUBMIT)){
   $AUC_LOT_SUBMIT = "
      <table summary='*' style='width:100%;'>
         {AUC_STATUS_INFO}
         <tr>
            <td class='forumheader2'>{AUC_LABEL_LOT_TITLE}</td>
            <td class='forumheader3'>{AUC_LOT_TITLE_EDIT=class=tbox&size=75}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{AUC_LABEL_DESCRIPTION}</td>
            <td class='forumheader3'>{AUC_LOT_DESCRIPTION_EDIT=class=tbox&width=100%}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{AUC_LABEL_RESERVE}</td>
            <td class='forumheader3'>{AUC_LOT_RESERVE_EDIT=class=tbox}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{AUC_LABEL_IMAGES}</td>
            <td class='forumheader3'>{AUC_LOT_IMAGES_SUBMIT=class=tbox&size=75}</td>
         </tr>
         <tr>
            <td colspan='2' class='forumheader2' style='text-align:center;'>{AUC_LOT_SUBMIT_BUTTON}</td>
         </tr>
      </table>
   ";
}

// Edit auc
$sc_style['AUC_LOT_EDIT']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['AUC_LOT_EDIT']['post'] = "</div>";

if (!isset($AUC_LOT_EDIT)){
   $AUC_LOT_EDIT = "
      <table summary='*' style='width:100%;'>
         {AUC_STATUS_INFO}
         <tr>
            <td class='forumheader2'>{AUC_LABEL_LOT_TITLE}</td>
            <td class='forumheader3'>{AUC_LOT_TITLE_EDIT=class=tbox&size=75}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{AUC_LABEL_DESCRIPTION}</td>
            <td class='forumheader3'>{AUC_LOT_DESCRIPTION_EDIT=class=tbox&rows=10&width=100%}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{AUC_LABEL_RESERVE}</td>
            <td class='forumheader3'>{AUC_LOT_RESERVE_EDIT=class=tbox}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{AUC_LABEL_IMAGES}</td>
            <td class='forumheader3'>{AUC_LOT_IMAGES_EDIT=class=tbox}</td>
         </tr>
         <tr>
            <td colspan='2' class='forumheader2' style='text-align:center;'>{AUC_LOT_UPDATE_BUTTON}</td>
         </tr>
      </table>
   ";
}

?>