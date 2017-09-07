<?php

global $sc_style, $scontent_shortcodes;

// Template name, as displayed in drop down list of templates
$scontent_template_name = "Default";
// Template description, a bit more info about the template
$scontent_template_description = "Default template supplied with SimpleContent by bugrain";

// ************************************************************************************************
// Page Templates
// These template variables are passed from the simple_content code, they must be defined to ensure
// all SimpleContent pages can at least display something
global $SCONTENT_GROUP_LIST_HEAD;
global $SCONTENT_GROUP_LIST_BODY;
global $SCONTENT_GROUP_LIST_EMPTY;
global $SCONTENT_GROUP_LIST_FOOT;

global $SCONTENT_CATEGORY_LIST_HEAD;
global $SCONTENT_CATEGORY_LIST_BODY;
global $SCONTENT_CATEGORY_LIST_EMPTY;
global $SCONTENT_CATEGORY_LIST_FOOT;

global $SCONTENT_CATEGORY_VIEW;
global $SCONTENT_CATEGORY_SUBMIT_VIEW;
global $SCONTENT_CATEGORY_EDIT_VIEW;

global $SCONTENT_ITEM_LIST_HEAD;
global $SCONTENT_ITEM_LIST_BODY;
global $SCONTENT_ITEM_LIST_EMPTY;
global $SCONTENT_ITEM_LIST_FOOT;

global $SCONTENT_ITEM_HEAD;
global $SCONTENT_ITEM_BODY;
global $SCONTENT_ITEM_FOOT;

global $SCONTENT_MENU_HEAD;
global $SCONTENT_MENU_BODY;
global $SCONTENT_MENU_FOOT;

// ************************************************************************************************
// Groups
if (!isset($SCONTENT_GROUP_LIST_HEAD)){
   $SCONTENT_GROUP_LIST_HEAD = "
      {SCONTENT_NAV_BAR}
      {SCONTENT_SEARCH_BAR}
      <div class='forumheader'>
   ";
}
if (!isset($SCONTENT_GROUP_LIST_BODY)){
   $SCONTENT_GROUP_LIST_BODY = "
      <div class='forumheader2 scontent_group'>
         <div style='float:left;padding-right:0.5em;'>
         {SCONTENT_GROUP_ICON}
         </div>
         {SCONTENT_GROUP_NAME=anchor}
         <br/>
         <span class='smalltext'>{SCONTENT_GROUP_DESCRIPTION}</span>
      </div>
   ";
}
if (!isset($SCONTENT_GROUP_LIST_EMPTY)){
   $SCONTENT_GROUP_LIST_EMPTY = "<div class='forumheader2'>".SCONTENT_LAN_GROUP_EMPTY."</div>";
}
if (!isset($SCONTENT_GROUP_LIST_FOOT)){
   $SCONTENT_GROUP_LIST_FOOT = "
      </div>
   ";
}
// ************************************************************************************************
// Categories
if (!isset($SCONTENT_CATEGORY_LIST_HEAD)){
   $SCONTENT_CATEGORY_LIST_HEAD = "
      {SCONTENT_NAV_BAR}
      {SCONTENT_SEARCH_BAR}
      <div class='forumheader'>
   ";
}
if (!isset($SCONTENT_CATEGORY_LIST_BODY)){
   $SCONTENT_CATEGORY_LIST_BODY = "
      <div class='forumheader2 scontent_category'>
         {SCONTENT_CATEGORY_ICON}
         {SCONTENT_CATEGORY_NAME=anchor}
         <br/>
         {SCONTENT_CATEGORY_DESCRIPTION}
      </div>
   ";
}
if (!isset($SCONTENT_CATEGORY_LIST_EMPTY)){
   $SCONTENT_CATEGORY_LIST_EMPTY = "<div class='forumheader2'>".SCONTENT_LAN_CATEGORY_EMPTY."</div>";
}
if (!isset($SCONTENT_CATEGORY_LIST_FOOT)){
   $SCONTENT_CATEGORY_LIST_FOOT = "
      </div>
   ";
}

// ************************************************************************************************
// Items
if (!isset($SCONTENT_ITEM_LIST_HEAD)){
   $SCONTENT_ITEM_LIST_HEAD = "
      {SCONTENT_NAV_BAR}
      {SCONTENT_SEARCH_BAR}
      <div class='forumheader'>
   ";
}
if (!isset($SCONTENT_ITEM_LIST_BODY)){
   $SCONTENT_ITEM_LIST_BODY = "
         <div class='forumheader3 scontent_item'>
            {SCONTENT_ITEM_NAME=anchor}
         </div>
   ";
}
if (!isset($SCONTENT_ITEM_LIST_EMPTY)){
   $SCONTENT_ITEM_LIST_EMPTY = "<div class='forumheader2'>".SCONTENT_LAN_ITEM_LIST_EMPTY."</div>";
}
if (!isset($SCONTENT_ITEM_LIST_FOOT)){
   $SCONTENT_ITEM_LIST_FOOT = "
      </div>
   ";
}
if (!isset($SCONTENT_RELATED_LIST_HEAD)){
   $SCONTENT_RELATED_LIST_HEAD = "
      {SCONTENT_NAV_BAR}
      {SCONTENT_SEARCH_BAR}
      <div class='forumheader'>
         <div class='forumheader2'>".SCONTENT_LAN_ITEM_LIST_RELATED."</div>
   ";
}
if (!isset($SCONTENT_RELATED_LIST_BODY)){
   $SCONTENT_RELATED_LIST_BODY = "
         <div class='forumheader3 scontent_item'>
            {SCONTENT_ITEM_NAME=anchor}
            ({SCONTENT_CATEGORY_NAME=anchor})
         </div>
   ";
}
if (!isset($SCONTENT_RELATED_LIST_EMPTY)){
   $SCONTENT_RELATED_LIST_EMPTY = $SCONTENT_ITEM_LIST_EMPTY;
}
if (!isset($SCONTENT_RELATED_LIST_FOOT)){
   $SCONTENT_RELATED_LIST_FOOT = $SCONTENT_ITEM_LIST_FOOT;
}
if (!isset($SCONTENT_ITEM_HEAD)){
   $SCONTENT_ITEM_HEAD = "
      <div class='forumheader'>
         <table summary='*' style='width:100%;'>
   ";
}
$sc_style['SCONTENT_ITEM_FIELD_LABEL']['pre']  = "<tr><td class='forumheader2 scontent_item_label'>";
$sc_style['SCONTENT_ITEM_FIELD_LABEL']['post'] = "</td>";
$sc_style['SCONTENT_ITEM_FIELD_VALUE']['pre']  = "<td class='forumheader3 scontent_item_field'>";
$sc_style['SCONTENT_ITEM_FIELD_VALUE']['post'] = "</td></tr>";
if (!isset($SCONTENT_ITEM_BODY)){
   $SCONTENT_ITEM_BODY = "
            {SCONTENT_ITEM_FIELD_LABEL=field=1}{SCONTENT_ITEM_FIELD_VALUE=field=1}
            {SCONTENT_ITEM_FIELD_LABEL=field=2}{SCONTENT_ITEM_FIELD_VALUE=field=2}
            {SCONTENT_ITEM_FIELD_LABEL=field=3}{SCONTENT_ITEM_FIELD_VALUE=field=3}
            {SCONTENT_ITEM_FIELD_LABEL=field=4}{SCONTENT_ITEM_FIELD_VALUE=field=4}
            {SCONTENT_ITEM_FIELD_LABEL=field=5}{SCONTENT_ITEM_FIELD_VALUE=field=5}
            {SCONTENT_ITEM_FIELD_LABEL=field=6}{SCONTENT_ITEM_FIELD_VALUE=field=6}
            {SCONTENT_ITEM_FIELD_LABEL=field=7}{SCONTENT_ITEM_FIELD_VALUE=field=7}
            {SCONTENT_ITEM_FIELD_LABEL=field=8}{SCONTENT_ITEM_FIELD_VALUE=field=8}
            {SCONTENT_ITEM_FIELD_LABEL=field=9}{SCONTENT_ITEM_FIELD_VALUE=field=9}
   ";
}
if (!isset($SCONTENT_ITEM_FOOT)){
   $SCONTENT_ITEM_FOOT = "
         </table>
      </div>
   ";
}

// ************************************************************************************************
// Menus
if (!isset($SCONTENT_MENU_HEAD)){
   $SCONTENT_MENU_HEAD = "";
}
if (!isset($SCONTENT_MENU_BODY)){
   $SCONTENT_MENU_BODY = "";
}
if (!isset($SCONTENT_MENU_FOOT)){
   $SCONTENT_MENU_FOOT = "";
}

// ************************************************************************************************
// Section Templates
// These template variables have a matching shortcode in the shortcodes file that parse its
// template, they define major sections of a page. Sections can be 'glued' together to make the
// whole page. They are mainly used by the page templates (see above). Makes them globals, too.
global $SCONTENT_NAV_BAR;                  // Navigation bar
global $SCONTENT_SEARCH_BAR;               // Search bar

// ************************************************************************************************
// Navigation bar
$sc_style['SCONTENT_NAV_BAR']['pre']  = "";
$sc_style['SCONTENT_NAV_BAR']['post'] = "";
if (!isset($SCONTENT_NAV_BAR)){
   $SCONTENT_NAV_BAR = "";
}

// ************************************************************************************************
// Search bar
$sc_style['SCONTENT_SEARCH_BAR']['pre']  = "<div style='float:right;'>";
$sc_style['SCONTENT_SEARCH_BAR']['post'] = "</div><div style='clear:both;'></div>";
if (!isset($SCONTENT_SEARCH_BAR)){
   $SCONTENT_SEARCH_BAR = "{SCONTENT_SEARCH_BAR_SEARCH_FIELD}";
}
?>