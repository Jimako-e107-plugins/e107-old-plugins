<?php
/*
+---------------------------------------------------------------+
| yellowpages by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/yellowpages/templates/yellowpages_links_template.php,v $
| $Revision: 1.1.2.1 $
| $Date: 2007/02/07 00:22:14 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
global $sc_style, $yelp_shortcodes;

// Template name, as displayed in drop down list of templates
$yellowpages_template_name = "Links";
// Template description, a bit more info about the template
$yellowpages_template_description = "Links template supplied with Yellow Pages by bugrain. Designed to be used for a simple links directory";
// Some values that help control the overall structure
$yellowpages_template_cat_cols = "4";  // The number of columns for categories display
                                       // $YELP_CATEGORY_LIST_BODY must reflect this to work correctly
$yellowpages_template_item_cols = "4"; // The number of columns for items display
                                       // $YELP_ITEM_LIST_BODY must reflect this to work correctly

// ************************************************************************************************
// Page Templates
// These template variables are passed from the yellowpages code, they must be defined to ensure
// all yellowpages pages can at least display something

// Page level
global $YELP_PAGE_HEAD;             // header for the whole page
global $YELP_PAGE_FOOT;             // footer for the whole apge

// Category level
global $YELP_CATEGORY_LIST_HEAD;    // header for the categories list page
global $YELP_CATEGORY_LIST_BODY;    // represents one categories, repeated for each category in the list
global $YELP_CATEGORY_LIST_FOOT;    // footer for the categories list page
global $YELP_CATEGORY_LIST_PREVIEW; // an individual category in the list

// Item level
global $YELP_ITEM_LIST_HEAD;        // header for the item list page
global $YELP_ITEM_LIST_BODY;        // represents one item, repeated for each category in the list
global $YELP_ITEM_LIST_FOOT;        // footer for the item list page
global $YELP_ITEM_LIST_PREVIEW;     // an individual item in the list

global $YELP_ITEM_VIEW;             // a specific item

// Misc stuff
global $YELP_NAVIGATION_ERROR;      // error page, mainly to hide real pages for users without
                                    // access if they are trying to 'hack' in using URL parameters
// ************************************************************************************************

// Status info is used to report back erros after form submission and is used in submit and edit category sections
$sc_style['YELP_STATUS_INFO']['pre']  = "<div class='indent'>";
$sc_style['YELP_STATUS_INFO']['post'] = "</div>";

$sc_style['YELP_CATEGORY_ITEM_COUNT']['pre']  = " (";
$sc_style['YELP_CATEGORY_ITEM_COUNT']['post'] = ")";

$sc_style['YELP_WELCOME_MESSAGE']['pre']  = "<div class='forumheader2'>";
$sc_style['YELP_WELCOME_MESSAGE']['post'] = "</div><br/>";

$sc_style['YELP_SECTION_DESCRIPTION']['pre']  = "<div class='forumheader2'>";
$sc_style['YELP_SECTION_DESCRIPTION']['post'] = "</div><br/>";

$sc_style['YELP_CATEGORY_A2Z']['pre']  = "<div class='forumheader3' style='text-align:center;'>";
$sc_style['YELP_CATEGORY_A2Z']['post'] = "</div></br/>";

// Page
if (!isset($YELP_PAGE_HEAD)){
   $YELP_PAGE_HEAD = "
      {YELP_SECTION_DESCRIPTION=frontpage}
      {YELP_CATEGORY_A2Z}
      {YELP_CATEGORY_INFO}
   ";
}
if (!isset($YELP_PAGE_FOOT)){
   $YELP_PAGE_FOOT = "
      {YELP_SEARCH_BAR}
   ";
}

// Category list
if (!isset($YELP_CATEGORY_LIST_HEAD)){
   $YELP_CATEGORY_LIST_HEAD = "
      <div class='forumheader' style='margin-bottom:2px;'>
         <table summary='*' style='width:100%;'>
   ";
}
if (!isset($YELP_CATEGORY_LIST_BODY)){
   // Make sure $yellowpages_template_cat_cols is set to reflect this template
   $YELP_CATEGORY_LIST_BODY = "
      <tr>
         <td class='forumheader2' style='width:25%;vertical-align:top;'>{YELP_CATEGORY_LIST_PREVIEW1}</td>
         <td class='forumheader2' style='width:25%;vertical-align:top;'>{YELP_CATEGORY_LIST_PREVIEW2}</td>
         <td class='forumheader2' style='width:25%;vertical-align:top;'>{YELP_CATEGORY_LIST_PREVIEW3}</td>
         <td class='forumheader2' style='width:25%;vertical-align:top;'>{YELP_CATEGORY_LIST_PREVIEW4}</td>
      </tr>
   ";
}
if (!isset($YELP_CATEGORY_LIST_FOOT)){
   $YELP_CATEGORY_LIST_FOOT = "
         </table>
      </div>
   ";
}
if (!isset($YELP_CATEGORY_LIST_PREVIEW)){
   $YELP_CATEGORY_LIST_PREVIEW = "
      <table summary='*' style='width:100%;'>
      <tr>
         <td style='text-align:left;'>
            <div class='forumheader3' style='margin:0px 10px;'>
               <div style='margin-right:10px;float:left;'>{YELP_CATEGORY_ICON}</div>
               {YELP_CATEGORY_NAME=anchor} {YELP_CATEGORY_ITEM_COUNT}
            </div>
            {YELP_CATEGORY_DESCRIPTION}
         </td>
      </tr>
      </table>
   ";
}

// Item list
if (!isset($YELP_ITEM_LIST_HEAD)){
   $YELP_ITEM_LIST_HEAD = "
      <div class='forumheader2' style='text-align:center;'>
         <table summary='*' style='width:100%;'>
   ";
}
if (!isset($YELP_ITEM_LIST_BODY)){
   $YELP_ITEM_LIST_BODY = "
      <tr>
         <td class='forumheader3' style='width:25%;vertical-align:top;'>{YELP_ITEM_LIST_PREVIEW1}</td>
         <td class='forumheader3' style='width:25%;vertical-align:top;'>{YELP_ITEM_LIST_PREVIEW2}</td>
         <td class='forumheader3' style='width:25%;vertical-align:top;'>{YELP_ITEM_LIST_PREVIEW3}</td>
         <td class='forumheader3' style='width:25%;vertical-align:top;'>{YELP_ITEM_LIST_PREVIEW4}</td>
      </tr>
   ";
}
if (!isset($YELP_ITEM_LIST_FOOT)){
   $YELP_ITEM_LIST_FOOT = "
         </table>
      </div><br/>
   ";
}
if (!isset($YELP_ITEM_LIST_PREVIEW)){
   $YELP_ITEM_LIST_PREVIEW = "
      {YELP_ITEM_LIST_ITEM_NAME=weblink}
   ";
}

if (!isset($YELP_NAVIGATION_ERROR)){
   $YELP_NAVIGATION_ERROR = "
      <table summary='*' style='width:100%;'>
         <tr>
            <td colspan='3' class='forumheader2' style='text-align:center;'>{YELP_NAVIGATION_ERROR}</td>
         </tr>
      </table>
   ";
}

// ************************************************************************************************
// Section Templates
// These template variables have a matching shortcode in the shortcodes file that parse its
// template, they define major sections of a page. Sections can be 'glued' together to make the
// whole page. They are mainly used by the page templates (see above). Make them globals, too.
global $YELP_SEARCH_BAR;            // Search bar

global $YELP_CATEGORY_INFO;         // Summary details for a category when a specific category page is being viewed

global $YELP_ITEM_COMMENTS;         // Item comments
// ************************************************************************************************

// Search bar
$sc_style['YELP_SEARCH_BAR']['pre']  = "<div class='forumheader3' style='text-align:right;'>";
$sc_style['YELP_SEARCH_BAR']['post'] = "</div><br/>";

if (!isset($YELP_SEARCH_BAR)){
   $YELP_SEARCH_BAR = "
      <table summary='*' style='width:100%;'><tr>
         <td style='text-align:right;'>{YELP_SEARCH_BAR_SEARCH_FIELD}</td>
      </tr></table>
   ";
}

// Category
$sc_style['YELP_CATEGORY_INFO']['pre']  = "<div class='forumheader2'>";
$sc_style['YELP_CATEGORY_INFO']['post'] = "</div><br/>";

if (!isset($YELP_CATEGORY_INFO)){
   $YELP_CATEGORY_INFO = "
      <div class='forumheader3' style='margin:0px 10px;'>
         <div style='margin-right:10px;float:left;'>{YELP_CATEGORY_ICON}</div>
         {YELP_CATEGORY_NAME}
      </div>
      {YELP_CATEGORY_DESCRIPTION}
   ";
}

// Category comments
$sc_style['YELP_ITEM_COMMENTS']['pre']  = "<div class='forumheader' style='margin-bottom:2px;'>";
$sc_style['YELP_ITEM_COMMENTS']['post'] = "</div>";

if (!isset($YELP_ITEM_COMMENTS)){
   $YELP_ITEM_COMMENTS = "
      <table summary='*' style='width:100%;'>
         <tr>
            <td class='forumheader3'>{YELP_ITEM_COMMENTS}</td>
         </tr>
      </table>
   ";
}
?>