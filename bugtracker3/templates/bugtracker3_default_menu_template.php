<?php

global $sc_style, $bugtracker3_shortcodes;

// Template name, as displayed in drop down list of templates
$bt3_menu_template_name = "BT3 Default";
// Template description, a bit more info about the template
$bt3_menu_template_description = "Default menu template supplied with Bugtracker3 by bugrain";

// ************************************************************************************************
// Menu Templates
// These template variables are passed from the bugtracker3 code, they must be defined to ensure
// all Bugtracker3 menus can at least display something

// Application level
global $BUG3_MENU_SUMMARY;       // Overall summary menu
global $BUG3_MENU_APPLICATION;   // Application summary menu

// ************************************************************************************************
if (!isset($BUG3_MENU_SUMMARY)){
   $BUG3_MENU_SUMMARY = "
      <table summary='*' class='forumheader' style='width:100%;'>
         <tr>
            <td class='forumheader2' style='text-align:left;'>{BUG3_LABEL_APP_TOTAL_ALL}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_APP_TOTAL_ALL}</td>
         </tr>
         <tr>
            <td class='forumheader2' style='text-align:left;'>{BUG3_LABEL_BUG_TOTAL_ALL}</td>
            <td class='forumheader3' style='text-align:right;'>{BUG3_BUG_TOTAL_ALL}</td>
         </tr>
      </table>
   ";
}

if (!isset($BUG3_MENU_APPLICATION)){
   $BUG3_MENU_APPLICATION = "
      <table summary='*' class='forumheader' style='width:100%;'>
         <tr>
            <td class='forumheader2' style='text-align:center;'>{BUG3_APP_ICON}</td>
            <td class='forumheader3'>{BUG3_APP_NAME}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_VERSION}</td>
            <td class='forumheader3'>{BUG3_APP_LATEST_VERSION}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_OWNER}</td>
            <td class='forumheader3'>{BUG3_APP_OWNER=anchor}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_BUGS}</td>
            <td class='forumheader3'>{BUG3_APP_BUGS}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_CATEGORY}</td>
            <td class='forumheader3'>{BUG3_APP_CATEGORY_LIST=separator=<br/>}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_STATUS}</td>
            <td class='forumheader3'>{BUG3_APP_STATUS_LIST=separator=<br/>}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_PRIORITY}</td>
            <td class='forumheader3'>{BUG3_APP_PRIORITY_LIST=separator=<br/>}</td>
         </tr>
         <tr>
            <td class='forumheader2'>{BUG3_LABEL_RESOLUTION}</td>
            <td class='forumheader3'>{BUG3_APP_RESOLUTION_LIST=separator=<br/>}</td>
         </tr>
      </table>
   ";
}
?>