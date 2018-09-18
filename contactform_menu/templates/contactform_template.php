<?php

global $sc_style, $contactform_shortcodes;

if(!$CONTACTFORM_FORM){
   $sc_style['CONTACTFORM_PAGE_NAME']['pre'] = "<tr class='forumheader2'><td colspan='2' style='padding:5px 0px;text-align:center;'>";
   $sc_style['CONTACTFORM_PAGE_NAME']['post'] = "</td></tr>";

   $sc_style['CONTACTFORM_PAGE_DESCRIPTION']['pre'] = "<tr class='forumheader2'><td colspan='2' class='smalltext' style='padding:5px 0px;text-align:center;'>";
   $sc_style['CONTACTFORM_PAGE_DESCRIPTION']['post'] = "</td></tr>";

   $sc_style['CONTACTFORM_SEND_TO']['pre'] = "<tr><td class='forumheader2' style='text-align:right;'>";
   $sc_style['CONTACTFORM_SEND_TO']['post'] = "</td></tr>";

   $sc_style['CONTACTFORM_YOUR_NAME']['pre'] = "<tr><td class='forumheader2' style='text-align:right;'>";
   $sc_style['CONTACTFORM_YOUR_NAME']['post'] = "</td></tr>";

   $sc_style['CONTACTFORM_YOUR_EMAIL']['pre'] = "<tr><td class='forumheader2' style='text-align:right;'>";
   $sc_style['CONTACTFORM_YOUR_EMAIL']['post'] = "</td></tr>";

   $sc_style['CONTACTFORM_SUBJECT']['pre'] = "<tr><td class='forumheader2' style='text-align:right;'>";
   $sc_style['CONTACTFORM_SUBJECT']['post'] = "</td></tr>";

   $sc_style['CONTACTFORM_MESSAGE']['pre'] = "<tr><td class='forumheader2' style='text-align:right;'>";
   $sc_style['CONTACTFORM_MESSAGE']['post'] = "</td></tr>";

   $sc_style['CONTACTFORM_SEND_TO_ME']['pre'] = "<tr><td class='forumheader2' style='text-align:right;'>";
   $sc_style['CONTACTFORM_SEND_TO_ME']['post'] = "</td></tr>";

   $sc_style['CONTACTFORM_CUSTOM_FIELDS']['pre'] = "";
   $sc_style['CONTACTFORM_CUSTOM_FIELDS']['post'] = "";

   $sc_style['CONTACTFORM_CUSTOM_FIELD']['pre'] = "<tr><td class='forumheader2' style='text-align:right;'>";
   $sc_style['CONTACTFORM_CUSTOM_FIELD']['post'] = "</td></tr>";

   $sc_style['CONTACTFORM_OLD_CUSTOM_FIELD']['pre'] = "<tr><td class='forumheader2' style='text-align:right;'>";
   $sc_style['CONTACTFORM_OLD_CUSTOM_FIELD']['post'] = "</td></tr>";

   $sc_style['CONTACTFORM_SECURE_IMAGE']['pre'] = "<tr><td class='forumheader2' style='text-align:right;'>";
   $sc_style['CONTACTFORM_SECURE_IMAGE']['post'] = "</td></tr>";

   $sc_style['CONTACTFORM_MESSAGE_MANDATORY']['pre'] = "<tr class='forumheader2'><td colspan='2' style='text-align:left;'>";
   $sc_style['CONTACTFORM_MESSAGE_MANDATORY']['post'] = "</td></tr>";

   $sc_style['CONTACTFORM_IP_TRACKING']['pre'] = "<tr class='forumheader3'><td colspan='2' style='text-align:left;'>";
   $sc_style['CONTACTFORM_IP_TRACKING']['post'] = "</td></tr>";

   $sc_style['CONTACTFORM_BUTTONS']['pre'] = "<tr class='forumheader'><td colspan='2' style='padding:5px 0px;text-align:center;'>";
   $sc_style['CONTACTFORM_BUTTONS']['post'] = "</td></tr>";

   $sc_style['CONTACTFORM_DISPLAY_MESSAGE']['pre'] = "<div class='fcaption' style='text-align:center;'>";
   $sc_style['CONTACTFORM_DISPLAY_MESSAGE']['post'] = "</div>";

   $sc_style['SITECONTACTINFO']['pre'] = "<tr><td class='forumheader2'>";
   $sc_style['SITECONTACTINFO']['post'] = "</td></tr>";

   $CONTACTFORM_FORM = "
   {CONTACTFORM_DISPLAY_MESSAGE}
   <table summary='Contact Form' class='fborder' style='width:100%;'>
      {CONTACTFORM_PAGE_DESCRIPTION}
      {CONTACTFORM_SEND_TO=readonly&label&field&divider=</td><td class='forumheader3'>}
      {CONTACTFORM_YOUR_NAME=label&field&divider=</td><td class='forumheader3'>}
      {CONTACTFORM_YOUR_EMAIL=label&field&divider=</td><td class='forumheader3'>}
      {CONTACTFORM_SUBJECT=label&field&divider=</td><td class='forumheader3'>}
      {CONTACTFORM_MESSAGE=label&field&divider=</td><td class='forumheader3'>}
      {CONTACTFORM_SEND_TO_ME=label&field&divider=</td><td class='forumheader3'>}
      {CONTACTFORM_CUSTOM_FIELDS=label&field&fieldcss=tbox&pre=<tr><td class='forumheader2' style='text-align:right;'>&divider=</td><td class='forumheader3'>&post=</td></tr>}
      {CONTACTFORM_SECURE_IMAGE=label&field&divider=</td><td class='forumheader3'>}
      {CONTACTFORM_MESSAGE_MANDATORY}
      {CONTACTFORM_BUTTONS}
      {CONTACTFORM_IP_TRACKING=ipaddress&hostname}
   </table>
   ";
}

// Note: SITECONTACTINFO is a core e107 shortcode
if(!$CONTACTFORM_INFO){
   $CONTACTFORM_INFO = "
      <table summary='Contact Details' class='fborder' style='width:100%'>
      {SITECONTACTINFO}
   </table>
   ";
}

?>