<?php
/*
+---------------------------------------------------------------+
| SimpleContent by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:/_repository/e107_plugins/simple_content/scontent_shortcodes.php,v $
| $Revision: 1.1 $
| $Date: 2008/05/26 23:14:52 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
if (!isset($tp)) {
   $tp = new e_parse();
   $tp->e_sc = new e_shortcode();
}
global $scontent_shortcodes;
$scontent_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
/*
// ************************************************************************************************
// Section Templates
// These template shortcodes have a matching variable in the shortcodes file, they define major
// sections of a page. Sections can be 'glued' together to make the whole page.
// ************************************************************************************************
SC_BEGIN SCONTENT_NAV_BAR
   global $scontent_shortcodes, $pref, $tp, $SCONTENT_NAV_BAR;
//   return $tp->parseTemplate($SCONTENT_NAV_BAR, FALSE, $scontent_shortcodes);
SC_END

SC_BEGIN SCONTENT_SEARCH_BAR
   global $scontent_shortcodes, $pref, $tp, $SCONTENT_SEARCH_BAR;
   return $tp->parseTemplate($SCONTENT_SEARCH_BAR, FALSE, $scontent_shortcodes);
SC_END

// ************************************************************************************************
// Shortcodes
// ************************************************************************************************

// ******************************************************************************************
// Navigation bar
// ******************************************************************************************
SC_BEGIN SCONTENT_NAV_BAR_SUBMIT_BUTTON
   global $SimpleContent, $scontent, $scontentUser, $pref;
   if ($SimpleContent->getMode() != SCONTENTC_SUBMIT_LOT_PAGE && isset($scontent) && $scontentUser->canEditSimpleContent($scontent->getId())) {
      $value = SCONTENT_LAN_JUMPLIST_SUBMIT;
      return "<input type='button' class='button' onclick='document.location=\"".SCONTENTC_SELF."?".SCONTENTC_SUBMIT_LOT_PAGE.".".$scontent->getId()."\";' value='$value'/>";
   }
   return "";
SC_END

// ******************************************************************************************
// Search bar
// ******************************************************************************************
SC_BEGIN SCONTENT_SEARCH_BAR_SEARCH_FIELD
   parse_str($parm, $parms);
   $text = "<form method='get' action='../../search.php'>";
   $text .= SCONTENT_LAN_LABEL_SEARCH;
   $text .= " <input class='tbox search' type='text' name='q' size='20' value='' maxlength='50'/>";
   $text .= "<input type='hidden' name='r' value='0'/>";
   $text .= "<input type='hidden' name='t' value='simple_content'/>";
   if (array_key_exists("showbutton", $parms)) {
      $text .= "&nbsp;<input type='submit' class='button' name='submit' value='".SCONTENT_LAN_LABEL_SEARCH_GO."'/>";
   }
   $text .= "</form>";
   return $text;
SC_END

// ******************************************************************************************
// Groups
// ******************************************************************************************
SC_BEGIN SCONTENT_GROUP_NAME
   global $tp;
   parse_str($parm, $parms);
   $sc_group = getcachedvars(SCONTENTC_CACHE_ID_GROUP);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".SCONTENTC_SELF."?".urlencode($sc_group->getName())."'>";
   }
   $text .= $tp->toHTML($sc_group->getName(), true);
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN SCONTENT_GROUP_ICON
   global $tp;
   parse_str($parm, $parms);
   $sc_group = getcachedvars(SCONTENTC_CACHE_ID_GROUP);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".SCONTENTC_SELF."?".urlencode($sc_group->getName())."'>";
   }
   $text .= "<img src='".$sc_group->getIcon()."'/>";
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN SCONTENT_GROUP_DESCRIPTION
   global $e107Helper, $tp;
   parse_str($parm, $parms);
   $sc_group = getcachedvars(SCONTENTC_CACHE_ID_GROUP);
   $text = "";
   $text .= $tp->toHTML($sc_group->getDescription(), true);
   return $text;
SC_END

// ******************************************************************************************
// Categories
// ******************************************************************************************
SC_BEGIN SCONTENT_CATEGORY_NAME
   global $tp;
   parse_str($parm, $parms);
   $sc_group = getcachedvars(SCONTENTC_CACHE_ID_GROUP);
   $sc_cat = getcachedvars(SCONTENTC_CACHE_ID_CATEGORY);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".SCONTENTC_SELF."?".urlencode($sc_group->getName().".".$sc_cat->getName())."'>";
   }
   $text .= $tp->toHTML($sc_cat->getName(), true);
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN SCONTENT_CATEGORY_ICON
   global $tp;
   parse_str($parm, $parms);
   $sc_group = getcachedvars(SCONTENTC_CACHE_ID_GROUP);
   $sc_cat = getcachedvars(SCONTENTC_CACHE_ID_CATEGORY);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".SCONTENTC_SELF."?".urlencode($sc_group->getName().".".$sc_cat->getName())."'>";
   }
   $text .= "<img src='".$sc_cat->getIcon()."'/>";
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN SCONTENT_CATEGORY_DESCRIPTION
   global $e107Helper, $tp;
   parse_str($parm, $parms);
   $sc_cat = getcachedvars(SCONTENTC_CACHE_ID_CATEGORY);
   $text = "";
   $text .= $tp->toHTML($sc_cat->getDescription(), true);
   return $text;
SC_END

// ******************************************************************************************
// Items
// ******************************************************************************************
SC_BEGIN SCONTENT_ITEM_NAME
   global $tp;
   parse_str($parm, $parms);
   $sc_group = getcachedvars(SCONTENTC_CACHE_ID_GROUP);
   $sc_cat = getcachedvars(SCONTENTC_CACHE_ID_CATEGORY);
   $sc_item = getcachedvars(SCONTENTC_CACHE_ID_ITEM);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".SCONTENTC_SELF."?".urlencode($sc_group->getName().".".$sc_cat->getName().".".$sc_item->getName())."'>";
   }
   $text .= $tp->toHTML($sc_item->getName(), true);
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN SCONTENT_ITEM_FIELD_LABEL
   global $e107Helper, $tp;
   $sc_cat = getcachedvars(SCONTENTC_CACHE_ID_CATEGORY);
   $sc_item = getcachedvars(SCONTENTC_CACHE_ID_ITEM);
   parse_str($parm, $parms);
   $tmp = $sc_item->getField($parms["field"]);
   if (strlen($tmp) ==0) {
      return "";
   }
   $text = "";
   $text .= $tp->toHTML($sc_cat->getLabel($parms["field"]), true);
   return $text;
SC_END

SC_BEGIN SCONTENT_ITEM_FIELD_VALUE
   global $e107Helper, $tp;
   $sc_item = getcachedvars(SCONTENTC_CACHE_ID_ITEM);
   parse_str($parm, $parms);
   $tmp = $sc_item->getField($parms["field"]);
   if (strlen($tmp) ==0) {
      return "";
   }
   $text = "";
   $text .= $tp->toHTML($tmp, true);
   return $text;
SC_END

*/
?>
