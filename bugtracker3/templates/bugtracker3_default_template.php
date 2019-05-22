<?php

global $sc_style, $bugtracker3_shortcodes;

// Template name, as displayed in drop down list of templates
$bt3_template_name = "BT3 Default";
// Template description, a bit more info about the template
$bt3_template_description = "Default template supplied with Bugtracker3 by bugrain";

// ************************************************************************************************
// Page Templates
// These template variables are passed from the bugtracker3 code, they must be defined to ensure
// all Bugtracker3 pages can at least display something

// Application level
global $BUG3_APP_LIST_HEAD;      // header for the application list page
global $BUG3_APP_LIST_BODY;      // represents one application, repeated for each application in the list
global $BUG3_APP_LIST_FOOT;      // footer for the application list page

global $BUG3_APP_CHART_HEAD;     // Application statistics chart page header
global $BUG3_APP_CHART_BODY;     // Application statistics chart page body
global $BUG3_APP_CHART_FOOT;     // Application statistics chart page footer

// Bug level
global $BUG3_BUG_LIST_HEAD;      // header for the bug list page
global $BUG3_BUG_LIST_BODY;      // represents one bug, repeated for each bug in the list
global $BUG3_BUG_LIST_FOOT;      // footer for the bug list page

global $BUG3_BUG_VIEW;           // page displaying an individual bug
global $BUG3_BUG_SUBMIT_VIEW;    // page to submit a new bug
global $BUG3_BUG_EDIT_VIEW;      // page to edit/update an existing bug
global $BUG3_BUG_MOVE_VIEW;      // page to move a bug between applications

// 'FEATURE' variables are optional, if not defined the appropriate 'BUG' variable will be used instead
global $BUG3_FEATURE_LIST_HEAD;  // header for the feature request list page
global $BUG3_FEATURE_LIST_BODY;  // represents one feature request, repeated for each bug in the list
global $BUG3_FEATURE_LIST_FOOT;  // footer for the feature request list page

global $BUG3_FEATURE_VIEW;       // page displaying an individual feature request
global $BUG3_FEATURE_SUBMIT_VIEW;// page to submit a new bug
global $BUG3_FEATURE_EDIT_VIEW;  // page to edit/update an existing bug
global $BUG3_FEATURE_MOVE_VIEW;  // page to move a bug between applications

// Misc stuff
global $BUG3_FILTER_VIEW;        // page displaying filter options for a user
global $BUG3_NAV_ERROR;          // error page, mainly to hide real pages for users without access if they are trying to 'hack' in using URL parameters
// ************************************************************************************************
if (!isset($BUG3_APP_LIST_HEAD)){
   $BUG3_APP_LIST_HEAD = "
      {BUG3_NAV_BAR}
      {BUG3_SEARCH_BAR}
      <div class='forumheader' style='margin-bottom:2px;'>
      <table summary='{BUG3_APP_LIST_SUMMARY}' style='width:100%;'>
         <tr>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_APP_ICON}</td>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_APP_NAME}</td>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_OWNER}</td>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_BUGS}</td>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_STATUS}</td>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_PRIORITY}</td>
         </tr>
   ";
}
if (!isset($BUG3_APP_LIST_BODY)){
   $BUG3_APP_LIST_BODY = "
      <tr>
         <td class='forumheader3' style='text-align:center;'>{BUG3_APP_ICON=anchor&tooltip}</td>
         <td class='forumheader3' style='text-align:left;'>{BUG3_APP_NAME=anchor}</td>
         <td class='forumheader3' style='text-align:center;'>{BUG3_APP_OWNER=anchor}</td>
         <td class='forumheader3' style='text-align:center;'>{BUG3_APP_BUGS}</td>
         <td class='forumheader3' style='text-align:center;'>{BUG3_APP_STATUS_LIST}</td>
         <td class='forumheader3' style='text-align:center;'>{BUG3_APP_PRIORITY_LIST}</td>
      </tr>
   ";
}
if (!isset($BUG3_APP_LIST_FOOT)){
   $BUG3_APP_LIST_FOOT = "
      </table>
      </div>
   ";
}
if (!isset($BUG3_APP_CHART_HEAD)){
   $BUG3_APP_CHART_HEAD = "
      {BUG3_NAV_BAR}
      {BUG3_SEARCH_BAR}
      <div class='forumheader' style='margin-bottom:2px;'>
      {BUG3_APP_INFO_SHORT}
   ";
}
if (!isset($BUG3_APP_CHART_BODY)){
   $BUG3_APP_CHART_BODY = "
      {BUG3_APP_CHARTS}
   ";
}
if (!isset($BUG3_APP_CHART_FOOT)){
   $BUG3_APP_CHART_FOOT = "
      </div>
   ";
}
if (!isset($BUG3_BUG_LIST_HEAD)){
   $BUG3_BUG_LIST_HEAD = "
      {BUG3_NAV_BAR}
      {BUG3_SEARCH_BAR}
      {BUG3_APP_INFO}
      <div class='forumheader' style='margin-bottom:2px;'>
      <table summary='{BUG3_BUG_LIST_SUMMARY}' style='width:100%;'>
         <tr>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_ID}</td>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_SUMMARY}</td>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_POSTER}</td>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_OWNER}</td>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_STATUS}</td>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_PRIORITY}</td>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_RESOLUTION}</td>
         </tr>
   ";
}
$sc_style['BUG3_BUG_DELETED']['pre']  = "[";
$sc_style['BUG3_BUG_DELETED']['post']  = "]";
if (!isset($BUG3_BUG_LIST_BODY)){
   $BUG3_BUG_LIST_BODY = "
      <tr>
         <td class='forumheader3' style='text-align:center;'>{BUG3_BUG_ID=anchor}</td>
         <td class='forumheader3' style='text-align:left;'>{BUG3_BUG_SUMMARY=anchor&tooltip} {BUG3_BUG_DELETED}<br/>[{BUG3_BUG_CATEGORY_NAME}] <span class='smalltext'>{BUG3_BUG_LAST_UPDATE_DATE_TIME=short}</span></td>
         <td class='forumheader3' style='text-align:center;'>{BUG3_BUG_POSTER=anchor}</td>
         <td class='forumheader3' style='text-align:center;'>{BUG3_BUG_OWNER=anchor}</td>
         <td class='forumheader3' style='text-align:center;'>{BUG3_BUG_STATUS_NAME}</td>
         <td class='forumheader3' style='text-align:center;background-color:{BUG3_BUG_PRIORITY_COLOR}'>{BUG3_BUG_PRIORITY_NAME}</td>
         <td class='forumheader3' style='text-align:center;'>{BUG3_BUG_RESOLUTION_NAME}</td>
      </tr>
   ";
}
if (!isset($BUG3_BUG_LIST_FOOT)){
   $BUG3_BUG_LIST_FOOT = "
      </table>
      </div>
   ";
}
if (!isset($BUG3_BUG_VIEW)){
   $BUG3_BUG_VIEW = "
      {BUG3_NAV_BAR}
      {BUG3_SEARCH_BAR}
      {BUG3_APP_INFO_SHORT}
      {BUG3_BUG}
      {BUG3_BUG_COMMENTS}
   ";
}
if (!isset($BUG3_BUG_SUBMIT_VIEW)){
   $BUG3_BUG_SUBMIT_VIEW = "
      {BUG3_NAV_BAR}
      {BUG3_APP_INFO_SHORT}
      {BUG3_BUG_SUBMIT}
   ";
}
if (!isset($BUG3_BUG_EDIT_VIEW)){
   $BUG3_BUG_EDIT_VIEW = "
      {BUG3_NAV_BAR}
      {BUG3_APP_INFO_SHORT}
      {BUG3_BUG_INFO}
      {BUG3_BUG_EDIT}
      {BUG3_BUG_EDIT_DEVS}
   ";
}
if (!isset($BUG3_BUG_MOVE_VIEW)){
   $BUG3_BUG_MOVE_VIEW = "
      {BUG3_NAV_BAR}
      {BUG3_APP_INFO_SHORT}
      {BUG3_BUG_INFO}
      {BUG3_BUG_MOVE}
   ";
}
if (!isset($BUG3_FEATURE_LIST_HEAD)){
   $BUG3_FEATURE_LIST_HEAD = "
      {BUG3_NAV_BAR}
      {BUG3_SEARCH_BAR}
      {BUG3_APP_INFO_FEATURE}
      <div class='forumheader' style='margin-bottom:2px;'>
      <table summary='{BUG3_BUG_LIST_SUMMARY}' style='width:100%;'>
         <tr>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_ID}</td>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_SUMMARY}</td>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_POSTER}</td>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_STATUS}</td>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_PRIORITY}</td>
            <td class='forumheader2' style='text-align:center;'>{BUG3_LABEL_RESOLUTION}</td>
         </tr>
   ";
}
if (!isset($BUG3_FEATURE_LIST_BODY)){
   $BUG3_FEATURE_LIST_BODY = "
      <tr>
         <td class='forumheader3' style='text-align:center;'>{BUG3_BUG_ID=anchor}</td>
         <td class='forumheader3' style='text-align:left;'>{BUG3_BUG_SUMMARY=anchor&tooltip} {BUG3_BUG_DELETED}<br/><span class='smalltext'>{BUG3_BUG_LAST_UPDATE_DATE_TIME=short}</span></td>
         <td class='forumheader3' style='text-align:center;'>{BUG3_BUG_POSTER=anchor}</td>
         <td class='forumheader3' style='text-align:center;'>{BUG3_BUG_STATUS_NAME}</td>
         <td class='forumheader3' style='text-align:center;background-color:{BUG3_BUG_PRIORITY_COLOR}'>{BUG3_BUG_PRIORITY_NAME}</td>
         <td class='forumheader3' style='text-align:center;'>{BUG3_BUG_RESOLUTION_NAME}</td>
      </tr>
   ";
}
if (!isset($BUG3_FEATURE_LIST_FOOT)){
   $BUG3_FEATURE_LIST_FOOT = "
      </table>
      </div>
   ";
}
if (!isset($BUG3_FEATURE_VIEW)){
   $BUG3_FEATURE_VIEW = "
      {BUG3_NAV_BAR}
      {BUG3_APP_INFO_SHORT_FEATURE}
      {BUG3_FEATURE}
      {BUG3_BUG_COMMENTS}
   ";
}
if (!isset($BUG3_FEATURE_SUBMIT_VIEW)){
   $BUG3_FEATURE_SUBMIT_VIEW = "
      {BUG3_NAV_BAR}
      {BUG3_APP_INFO_SHORT_FEATURE}
      {BUG3_FEATURE_SUBMIT}
   ";
}
if (!isset($BUG3_FEATURE_EDIT_VIEW)){
   $BUG3_FEATURE_EDIT_VIEW = "
      {BUG3_NAV_BAR}
      {BUG3_APP_INFO_SHORT_FEATURE}
      {BUG3_BUG_INFO}
      {BUG3_FEATURE_EDIT}
      {BUG3_BUG_EDIT_DEVS}
   ";
}
if (!isset($BUG3_FEATURE_MOVE_VIEW)){
   $BUG3_FEATURE_MOVE_VIEW = "
      {BUG3_NAV_BAR}
      {BUG3_APP_INFO_SHORT_FEATURE}
      {BUG3_BUG_INFO}
      {BUG3_FEATURE_MOVE}
   ";
}
if (!isset($BUG3_FILTER_VIEW)){
   $BUG3_FILTER_VIEW = "
      {BUG3_NAV_BAR}
      {BUG3_FILTER}
   ";
}
if (!isset($BUG3_NAV_ERROR)){
   $BUG3_NAV_ERROR = "
      <table summary='{BUG3_NAV_ERROR_SUMMARY}' style='width:100%;'>
         <tr>
            <td colspan='3' class='forumheader2' style='text-align:center;'>{BUG3_LAN_MSG_NAV_ERROR}</td>
         </tr>
      </table>
   ";
}

// ************************************************************************************************
// Section Templates
// These template variables have a matching shortcode in the shortcodes file that parse its
// template, they define major sections of a page. Sections can be 'glued' together to make the
// whole page. They are mainly used by the page templates (see above). Makes them globals, too.
global $BUG3_NAV_BAR;                  // Navigation bar
global $BUG3_SEARCH_BAR;               // Search bar

global $BUG3_APP_INFO;                 // Detailed application information
global $BUG3_APP_INFO_SHORT;           // Summary application information
global $BUG3_APP_INFO_FEATURE;         // Alternate detailed application information for 'feature' applications
global $BUG3_APP_INFO_SHORT_FEATURE;   // Alternate summary application information for 'feature' applications
global $BUG3_APP_CHARTS;               // Application statistics charts

global $BUG3_BUG;                      // Detailed bug information
global $BUG3_BUG_COMMENTS;             // Bug comments
global $BUG3_BUG_INFO;                 // Summary bug information
global $BUG3_BUG_SUBMIT;               // Content of the form used to submit a bug
global $BUG3_BUG_EDIT;                 // Content of the form used to edit a bug
global $BUG3_BUG_MOVE;                 // Content of the form used to move a bug between applications
global $BUG3_BUG_EDIT_DEVS;            // Fields only developers (app owner, etc.) can edit/update

global $BUG3_FEATURE;                  // Detailed feature information
global $BUG3_FEATURE_SUBMIT;           // Content of the form used to submit a feature request
global $BUG3_FEATURE_EDIT;             // Content of the form used to edit a feature request
global $BUG3_FEATURE_MOVE;             // Content of the form used to move a feature request between applications

global $BUG3_FILTER;                   // Filter options
// ************************************************************************************************

// Navigation bar
$sc_style['BUG3_NAV_BAR']['pre']  = "<div class='forumheader' style='margin-bottom:2px;text-align:right;'>";
$sc_style['BUG3_NAV_BAR']['post'] = "</div>";

if (!isset($BUG3_NAV_BAR)){
   $BUG3_NAV_BAR = "
      <table style='width:100%;'><tr>
         <td>{BUG3_NAV_BAR_JUMP_LIST=hidefilters}</td>
         <td style='text-align:right;'>
            {BUG3_NAV_BAR_APP_LIST_BUTTON}
            {BUG3_NAV_BAR_BUG_LIST_BUTTON}
            {BUG3_NAV_BAR_MOVE_BUTTON}
            {BUG3_NAV_BAR_EDIT_BUTTON}
            {BUG3_NAV_BAR_SUBMIT_BUTTON}
         </td>
      </tr></table>
   ";
}

// Search bar
$sc_style['BUG3_SEARCH_BAR']['pre']  = "<div class='forumheader2' style='text-align:right;'>";
$sc_style['BUG3_SEARCH_BAR']['post'] = "</div>";
if (!isset($BUG3_SEARCH_BAR)){
   $BUG3_SEARCH_BAR = "
      <table style='width:100%;'><tr>
         <td>{BUG3_NAV_BAR_FILTER_LIST=showcurrent}</td>
         <td style='text-align:right;'>{BUG3_SEARCH_BAR_SEARCH_FIELD}</td>
      </tr></table>
   ";
}

// Application summary
$sc_style['BUG3_APP_INFO']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['BUG3_APP_INFO']['post'] = "</div>";

if (!isset($BUG3_APP_INFO)){
   $BUG3_APP_INFO = "
      <table summary='{BUG3_APP_SUMMARY}' style='width:100%;'>
         <tr>
            <td class='forumheader2' style='width:10%;text-align:center;'>{BUG3_APP_ICON}</td>
            <td class='forumheader3' style='width:40%'>{BUG3_APP_NAME}</td>
            <td class='forumheader2' style='width:10%'>{BUG3_LABEL_VERSION}</td>
            <td class='forumheader3' style='width:40%'>{BUG3_APP_LATEST_VERSION}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_DESCRIPTION}</td>
            <td colspan='3' class='forumheader3'>{BUG3_APP_DESCRIPTION}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_OWNER}</td>
            <td class='forumheader3'>{BUG3_APP_OWNER=anchor}</td>
            <td class='forumheader2'>{BUG3_LABEL_BUGS}</td>
            <td class='forumheader3'>{BUG3_APP_BUGS}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_CATEGORY}</td>
            <td class='forumheader3'>{BUG3_APP_CATEGORY_LIST=showzero}</td>
            <td class='forumheader2'>{BUG3_LABEL_STATUS}</td>
            <td class='forumheader3'>{BUG3_APP_STATUS_LIST=showzero}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_PRIORITY}</td>
            <td class='forumheader3'>{BUG3_APP_PRIORITY_LIST=showzero}</td>
            <td class='forumheader2'>{BUG3_LABEL_RESOLUTION}</td>
            <td class='forumheader3'>{BUG3_APP_RESOLUTION_LIST=showzero}</td>
         </tr>
      </table>
   ";
}

$sc_style['BUG3_APP_INFO_SHORT']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['BUG3_APP_INFO_SHORT']['post'] = "</div>";

if (!isset($BUG3_APP_INFO_SHORT)){
   $BUG3_APP_INFO_SHORT = "
      <table summary='{BUG3_APP_SUMMARY}' style='width:100%;'>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_APP_NAME}</td>
            <td class='forumheader3'>{BUG3_APP_NAME}</td>
            <td class='forumheader2'>{BUG3_LABEL_VERSION}</td>
            <td class='forumheader3'>{BUG3_APP_LATEST_VERSION}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_DESCRIPTION}</td>
            <td colspan='4' class='forumheader3'>{BUG3_APP_DESCRIPTION}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_OWNER}</td>
            <td colspan='4' class='forumheader3'>{BUG3_APP_OWNER=anchor}</td>
         </tr>
      </table>
   ";
}

$sc_style['BUG3_APP_INFO_FEATURE']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['BUG3_APP_INFO_FEATURE']['post'] = "</div>";

if (!isset($BUG3_APP_INFO_FEATURE)){
   $BUG3_APP_INFO_FEATURE = "
      <table summary='{BUG3_APP_SUMMARY}' style='width:100%;'>
         <tr>
            <td class='forumheader2' style='width:10%'>{BUG3_LABEL_APP_NAME}</td>
            <td class='forumheader3' style='width:40%'>{BUG3_APP_NAME}</td>
            <td class='forumheader2'>{BUG3_LABEL_OWNER}</td>
            <td class='forumheader3'>{BUG3_APP_OWNER=anchor}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_DESCRIPTION}</td>
            <td colspan='3' class='forumheader3'>{BUG3_APP_DESCRIPTION}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_BUGS}</td>
            <td class='forumheader3'>{BUG3_APP_BUGS}</td>
            <td class='forumheader2'>{BUG3_LABEL_STATUS}</td>
            <td class='forumheader3'>{BUG3_APP_STATUS_LIST=showzero}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_PRIORITY}</td>
            <td class='forumheader3'>{BUG3_APP_PRIORITY_LIST=showzero}</td>
            <td class='forumheader2'>{BUG3_LABEL_RESOLUTION}</td>
            <td class='forumheader3'>{BUG3_APP_RESOLUTION_LIST=showzero}</td>
         </tr>
      </table>
   ";
}

$sc_style['BUG3_APP_INFO_SHORT_FEATURE']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['BUG3_APP_INFO_SHORT_FEATURE']['post'] = "</div>";

if (!isset($BUG3_APP_INFO_SHORT_FEATURE)){
   $BUG3_APP_INFO_SHORT_FEATURE = "
      <table summary='{BUG3_APP_SUMMARY}' style='width:100%;'>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_APP_NAME}</td>
            <td class='forumheader3'>{BUG3_APP_NAME}</td>
            <td rowspan='2' class='forumheader2'>{BUG3_LABEL_DESCRIPTION}</td>
            <td rowspan='2' class='forumheader3'>{BUG3_APP_DESCRIPTION}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_OWNER}</td>
            <td class='forumheader3'>{BUG3_APP_OWNER=anchor}</td>
         </tr>
      </table>
   ";
}

// Application chart
$sc_style['BUG3_APP_CHARTS']['pre']  = "<div class='forumheader' style='text-align:center;'>";
$sc_style['BUG3_APP_CHARTS']['post'] = "</div>";

if (!isset($BUG3_APP_CHARTS)){
   $BUG3_APP_CHARTS = "
      <table summary='{BUG3_APP_SUMMARY}' style='width:100%;'>
         {BUG3_STATUS_INFO}
         <tr>
            <td class='forumheader3' style='text-align:center;'>{BUG3_APP_CHART_STATS_CATEGORIES}</td>
            <td class='forumheader3' style='text-align:center;'>{BUG3_APP_CHART_STATS_PRIORITIES}</td>
         </tr>
         <tr>
            <td class='forumheader3' style='text-align:center;'>{BUG3_APP_CHART_STATS_RESOLUTIONS}</td>
            <td class='forumheader3' style='text-align:center;'>{BUG3_APP_CHART_STATS_STATUSES}</td>
         </tr>
      </table>
   ";
}

// Bug
$sc_style['BUG3_BUG']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['BUG3_BUG']['post'] = "</div>";

if (!isset($BUG3_BUG)){
   $BUG3_BUG = "
      <table summary='{BUG3_BUG_LIST_SUMMARY}' style='width:100%;'>
         <tr>
            <td colspan='6' class='forumheader3'><strong>{BUG3_BUG_ID} [{BUG3_BUG_CATEGORY_NAME}] {BUG3_BUG_SUMMARY}</strong></td>
         </tr>
         <tr>
            <td class='forumheader2' style='width:20%'>{BUG3_LABEL_POSTER}</td>
            <td colspan='2' class='forumheader3'>{BUG3_BUG_POSTER=anchor} {BUG3_BUG_DATE_TIME}</td>
            <td class='forumheader2' style='width:20%'>{BUG3_LABEL_LAST_UPDATE_POSTER}</td>
            <td colspan='2' class='forumheader3'>{BUG3_BUG_LAST_UPDATE_POSTER=anchor} {BUG3_BUG_LAST_UPDATE_DATE_TIME}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_OWNER}</td>
            <td class='forumheader3'>{BUG3_BUG_OWNER=anchor}</td>
            <td class='forumheader2'>{BUG3_LABEL_PRIORITY}</td>
            <td class='forumheader3' style='background-color:{BUG3_BUG_PRIORITY_COLOR}'>{BUG3_BUG_PRIORITY_NAME}</td>
            <td class='forumheader2'>{BUG3_LABEL_FOUND_IN_VERSION}</td>
            <td class='forumheader3'>{BUG3_BUG_FOUND_IN_VERSION}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_STATUS}</td>
            <td class='forumheader3'>{BUG3_BUG_STATUS_NAME}</td>
            <td class='forumheader2'>{BUG3_LABEL_RESOLUTION}</td>
            <td class='forumheader3'>{BUG3_BUG_RESOLUTION_NAME}</td>
            <td class='forumheader2'>{BUG3_LABEL_FIXED_IN_VERSION}</td>
            <td class='forumheader3'>{BUG3_BUG_FIXED_IN_VERSION}</td>
         </tr>
         <tr>
            <td colspan='6' class='forumheader2'>{BUG3_LABEL_DESCRIPTION}</td>
         </tr>
         <tr>
            <td colspan='6' class='forumheader3'>{BUG3_BUG_DESCRIPTION}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_RELATED_BUGS}</td>
            <td colspan='6' class='forumheader3'>{BUG3_BUG_RELATED_BUGS_LIST}</td>
         </tr>
         <tr>
            <td colspan='6' class='forumheader2'>{BUG3_LABEL_DEVELOPER_COMMENTS}</td>
         </tr>
         <tr>
            <td colspan='6' class='forumheader3'>{BUG3_BUG_DEVELOPER_COMMENTS=anchor}</td>
         </tr>
      </table>
   ";
}

$sc_style['BUG3_FEATURE']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['BUG3_FEATURE']['post'] = "</div>";

if (!isset($BUG3_FEATURE)){
   $BUG3_FEATURE = "
      <table summary='{BUG3_BUG_LIST_SUMMARY}' style='width:100%;'>
         <tr>
            <td colspan='6' class='forumheader3'><strong>{BUG3_BUG_ID} [{BUG3_BUG_CATEGORY_NAME}] {BUG3_BUG_SUMMARY}</strong></td>
         </tr>
         <tr>
            <td class='forumheader2' style='width:20%'>{BUG3_LABEL_POSTER}</td>
            <td class='forumheader3'>{BUG3_BUG_POSTER=anchor} {BUG3_BUG_DATE_TIME}</td>
            <td class='forumheader2' style='width:20%'>{BUG3_LABEL_LAST_UPDATE_POSTER}</td>
            <td class='forumheader3'>{BUG3_BUG_LAST_UPDATE_POSTER=anchor} {BUG3_BUG_LAST_UPDATE_DATE_TIME}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_PRIORITY}</td>
            <td class='forumheader3' style='background-color:{BUG3_BUG_PRIORITY_COLOR}'>{BUG3_BUG_PRIORITY_NAME}</td>
            <td class='forumheader2'>{BUG3_LABEL_RESOLUTION}</td>
            <td class='forumheader3'>{BUG3_BUG_RESOLUTION_NAME}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_STATUS}</td>
            <td class='forumheader3'>{BUG3_BUG_STATUS_NAME}</td>
            <td class='forumheader2'>{BUG3_LABEL_FIXED_IN_VERSION}</td>
            <td class='forumheader3'>{BUG3_BUG_FIXED_IN_VERSION}</td>
         </tr>
         <tr>
            <td colspan='6' class='forumheader2'>{BUG3_LABEL_DESCRIPTION}</td>
         </tr>
         <tr>
            <td colspan='6' class='forumheader3'>{BUG3_BUG_DESCRIPTION}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_RELATED_BUGS}</td>
            <td colspan='6' class='forumheader3'>{BUG3_BUG_RELATED_BUGS_LIST}</td>
         </tr>
         <tr>
            <td colspan='6' class='forumheader2'>{BUG3_LABEL_DEVELOPER_COMMENTS}</td>
         </tr>
         <tr>
            <td colspan='6' class='forumheader3'>{BUG3_BUG_DEVELOPER_COMMENTS=anchor}</td>
         </tr>
      </table>
   ";
}

// Bug comments
$sc_style['BUG3_BUG_COMMENTS']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['BUG3_BUG_COMMENTS']['post'] = "</div>";

if (!isset($BUG3_BUG_COMMENTS)){
   $BUG3_BUG_COMMENTS = "
      <table summary='*' style='width:100%;'>
         <tr>
            <td class='forumheader3'>{BUG3_BUG_COMMENTS}</td>
         </tr>
      </table>
   ";
}

// Bug info
$sc_style['BUG3_BUG_INFO']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['BUG3_BUG_INFO']['post'] = "</div>";

if (!isset($BUG3_BUG_INFO)){
   $BUG3_BUG_INFO = "
      <table summary='{BUG3_BUG_LIST_SUMMARY}' style='width:100%;'>
         <tr>
            <td colspan='2' class='forumheader2'><strong>{BUG3_BUG_CATEGORY} ({BUG3_BUG_ID}) {BUG3_BUG_SUMMARY}</strong></td>
         </tr>
         <tr>
            <td class='forumheader2' style='width:20%'>{BUG3_LABEL_POSTER}</td>
            <td class='forumheader3'>{BUG3_BUG_POSTER=anchor} {BUG3_BUG_DATE_TIME}</td>
         </tr>
      </table>
   ";
}

// Status info is used to report back erros after form submission and is used in submit and edit bug sections
$sc_style['BUG3_STATUS_INFO']['pre']  = "<tr><td colspan='3' class='indent'>";
$sc_style['BUG3_STATUS_INFO']['post'] = "</td></tr>";

// Submit bug
$sc_style['BUG3_BUG_SUBMIT']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['BUG3_BUG_SUBMIT']['post'] = "</div>";

if (!isset($BUG3_BUG_SUBMIT)){
   $BUG3_BUG_SUBMIT = "
      <table summary='{BUG3_BUG_LIST_SUMMARY}' style='width:100%;'>
         {BUG3_STATUS_INFO}
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_CATEGORY}</td>
            <td class='forumheader3'>{BUG3_BUG_CATEGORY_EDIT=class=tbox&tooltip}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_PRIORITY}</td>
            <td class='forumheader3'>{BUG3_BUG_PRIORITY_EDIT=class=tbox&tooltip}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_FOUND_IN_VERSION}</td>
            <td class='forumheader3'>{BUG3_BUG_FOUND_IN_VERSION_EDIT=class=tbox&past}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_SUMMARY}</td>
            <td class='forumheader3'>{BUG3_BUG_SUMMARY_EDIT=class=tbox&size=100}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_DESCRIPTION}</td>
            <td class='forumheader3'>{BUG3_BUG_DESCRIPTION_EDIT=class=tbox&rows=8&width=100%}</td>
         </tr>
         <tr>
            <td colspan='2' class='forumheader2' style='text-align:center;'>{BUG3_BUG_SUBMIT_BUTTON}</td>
         </tr>
      </table>
   ";
}

$sc_style['BUG3_FEATURE_SUBMIT']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['BUG3_FEATURE_SUBMIT']['post'] = "</div>";

if (!isset($BUG3_FEATURE_SUBMIT)){
   $BUG3_FEATURE_SUBMIT = "
      <table summary='{BUG3_BUG_LIST_SUMMARY}' style='width:100%;'>
         {BUG3_STATUS_INFO}
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_CATEGORY}</td>
            <td class='forumheader3'>{BUG3_BUG_CATEGORY_EDIT=class=tbox&tooltip}</td>
            <td class='forumheader2'>{BUG3_LABEL_PRIORITY}</td>
            <td class='forumheader3'>{BUG3_BUG_PRIORITY_EDIT=class=tbox&tooltip}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_SUMMARY}</td>
            <td colspan='3' class='forumheader3'>{BUG3_BUG_SUMMARY_EDIT=class=tbox&size=100}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_DESCRIPTION}</td>
            <td colspan='3' class='forumheader3'>{BUG3_BUG_DESCRIPTION_EDIT=class=tbox&rows=8&width=100%}</td>
         </tr>
         <tr>
            <td colspan='4' class='forumheader2' style='text-align:center;'>{BUG3_BUG_SUBMIT_BUTTON}</td>
         </tr>
      </table>
   ";
}

// Edit bug
$sc_style['BUG3_BUG_EDIT']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['BUG3_BUG_EDIT']['post'] = "</div>";

if (!isset($BUG3_BUG_EDIT)){
   $BUG3_BUG_EDIT = "
      <table summary='{BUG3_BUG_LIST_SUMMARY}' style='width:100%;'>
         {BUG3_STATUS_INFO}
         <tr>
            <td class='forumheader2' style='width:15%'>{BUG3_LABEL_APP_NAME}</td>
            <td colspan='2' class='forumheader3'>{BUG3_APP_NAME=hidden}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_SUMMARY}</td>
            <td class='forumheader3' style='width:42%;'>{BUG3_BUG_SUMMARY}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_SUMMARY_EDIT=class=tbox&size=75}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_FOUND_IN_VERSION}</td>
            <td class='forumheader3'>{BUG3_BUG_FOUND_IN_VERSION}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_FOUND_IN_VERSION_EDIT=class=tbox}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_CATEGORY}</td>
            <td class='forumheader3' >{BUG3_BUG_CATEGORY_NAME}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_CATEGORY_EDIT=class=tbox&tooltip}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_PRIORITY}</td>
            <td class='forumheader3' style='background-color:{BUG3_BUG_PRIORITY_COLOR}'>{BUG3_BUG_PRIORITY_NAME}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_PRIORITY_EDIT=class=tbox&tooltip}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_OWNER}</td>
            <td class='forumheader3'>{BUG3_BUG_OWNER}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_OWNER_EDIT=class=tbox}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_STATUS}</td>
            <td class='forumheader3'>{BUG3_BUG_STATUS_NAME}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_STATUS_EDIT=class=tbox&tooltip}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_RESOLUTION}</td>
            <td class='forumheader3'>{BUG3_BUG_RESOLUTION_NAME}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_RESOLUTION_EDIT=class=tbox&tooltip}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_FIXED_IN_VERSION}</td>
            <td class='forumheader3'>{BUG3_BUG_FIXED_IN_VERSION}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_FIXED_IN_VERSION_EDIT=class=tbox&includeblank}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_DELETED}</td>
            <td class='forumheader3'>{BUG3_BUG_DELETED}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_DELETED_EDIT=class=tbox}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_DESCRIPTION}</td>
            <td colspan='2' class='forumheader3'>{BUG3_BUG_DESCRIPTION_EDIT=class=tbox&rows=10&width=100%}</td>
         </tr>
         <tr>
            <td colspan='3' class='forumheader2' style='text-align:center;'>{BUG3_BUG_UPDATE_BUTTON}</td>
         </tr>
      </table>
   ";
}

$sc_style['BUG3_FEATURE_EDIT']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['BUG3_FEATURE_EDIT']['post'] = "</div>";

if (!isset($BUG3_FEATURE_EDIT)){
   $BUG3_FEATURE_EDIT = "
      <table summary='{BUG3_BUG_LIST_SUMMARY}' style='width:100%;'>
         {BUG3_STATUS_INFO}
         <tr>
            <td class='forumheader2' style='width:15%'>{BUG3_LABEL_APP_NAME}</td>
            <td colspan='2' class='forumheader3'>{BUG3_APP_NAME=hidden}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_SUMMARY}</td>
            <td class='forumheader3' style='width:42%;'>{BUG3_BUG_SUMMARY}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_SUMMARY_EDIT=class=tbox&size=75}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_CATEGORY}</td>
            <td class='forumheader3' >{BUG3_BUG_CATEGORY_NAME}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_CATEGORY_EDIT=class=tbox&tooltip}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_PRIORITY}</td>
            <td class='forumheader3' style='background-color:{BUG3_BUG_PRIORITY_COLOR}'>{BUG3_BUG_PRIORITY_NAME}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_PRIORITY_EDIT=class=tbox&tooltip}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_OWNER}</td>
            <td class='forumheader3'>{BUG3_BUG_OWNER}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_OWNER_EDIT=class=tbox}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_STATUS}</td>
            <td class='forumheader3'>{BUG3_BUG_STATUS_NAME}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_STATUS_EDIT=class=tbox&tooltip}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_RESOLUTION}</td>
            <td class='forumheader3'>{BUG3_BUG_RESOLUTION_NAME}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_RESOLUTION_EDIT=class=tbox&tooltip}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_FIXED_IN_VERSION}</td>
            <td class='forumheader3'>{BUG3_BUG_FIXED_IN_VERSION}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_FIXED_IN_VERSION_EDIT=class=tbox&includeblank}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_DELETED}</td>
            <td class='forumheader3'>{BUG3_BUG_DELETED}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_DELETED_EDIT=class=tbox}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_DESCRIPTION}</td>
            <td colspan='2' class='forumheader3'>{BUG3_BUG_DESCRIPTION_EDIT=class=tbox&rows=10&width=100%}</td>
         </tr>
         <tr>
            <td colspan='3' class='forumheader2' style='text-align:center;'>{BUG3_BUG_UPDATE_BUTTON}</td>
         </tr>
      </table>
   ";
}

// Edit Bug (Developers)
$sc_style['BUG3_BUG_EDIT_DEVS']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['BUG3_BUG_EDIT_DEVS']['post'] = "</div>";

if (!isset($BUG3_BUG_EDIT_DEVS)){
   $BUG3_BUG_EDIT_DEVS = "
      <table summary='{BUG3_BUG_LIST_SUMMARY}' style='width:100%;'>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_RELATED_BUGS}</td>
            <td colspan='2' class='forumheader3' style='text-align:right;'>{BUG3_BUG_RELATED_BUGS_LIST=editmode&allbugs}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_DEVELOPER_COMMENTS}</td>
            <td colspan='2' class='forumheader3'>
               {BUG3_BUG_DEVELOPER_COMMENTS=anchor}
               <div style='text-align:right;'>{BUG3_BUG_DEVELOPER_COMMENTS_EDIT}</div>
            </td>
         </tr>
      </table>
   ";
}

// move bug
$sc_style['BUG3_BUG_MOVE']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['BUG3_BUG_MOVE']['post'] = "</div>";

if (!isset($BUG3_BUG_MOVE)){
   $BUG3_BUG_MOVE = "
      <table summary='{BUG3_BUG_LIST_SUMMARY}' style='width:100%;'>
         {BUG3_STATUS_INFO}
         <tr>
            <td class='forumheader2' style='width:15%'>{BUG3_LABEL_APP_NAME}</td>
            <td class='forumheader3'>{BUG3_APP_NAME}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_APPLICATION_EDIT=class=tbox&size=75}</td>
         </tr>
         <tr>
            <td colspan='3' class='forumheader2' style='text-align:center;'>{BUG3_BUG_MOVE_BUTTON}</td>
         </tr>
      </table>
   ";
}

// Filter
$sc_style['BUG3_FILTER']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['BUG3_FILTER']['post'] = "</div>";

if (!isset($BUG3_FILTER)){
   $BUG3_FILTER = "
      <table summary='// TODO ' style='width:100%;'>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_POSTER}</td>
            <td class='forumheader3'>{BUG3_FILTER_POSTER_LIST=class=tbox}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_OWNER}</td>
            <td class='forumheader3'>{BUG3_FILTER_OWNER_LIST=class=tbox}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_CATEGORY}</td>
            <td class='forumheader3'>{BUG3_FILTER_CATEGORY_LIST=class=tbox}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_PRIORITY}</td>
            <td class='forumheader3'>{BUG3_FILTER_PRIORITY_LIST=class=tbox}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_STATUS}</td>
            <td class='forumheader3'>{BUG3_FILTER_STATUS_LIST=class=tbox}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_RESOLUTION}</td>
            <td class='forumheader3'>{BUG3_FILTER_RESOLUTION_LIST=class=tbox}</td>
         </tr>
      </table>
   ";
}

?>