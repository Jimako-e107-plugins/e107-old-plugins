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
| $Source: e:\_repository\e107_plugins/yellowpages/yellowpages_shortcodes.php,v $
| $Revision: 1.1.2.2 $
| $Date: 2007/02/07 00:43:57 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
if (!isset($tp)) {
   $tp = new e_parse();
   $tp->e_sc = new e_shortcode();
}
global $yelp_shortcodes;
$yelp_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
/*
// ************************************************************************************************
// Section Templates
// These template shortcodes have a matching variable in the templates file, they define major
// sections of a page. Sections can be 'glued' together to make the whole page.
// ************************************************************************************************
SC_BEGIN YELP_SEARCH_BAR
   global $yelp_shortcodes, $tp, $YELP_SEARCH_BAR;
   return $tp->parseTemplate($YELP_SEARCH_BAR, FALSE, $yelp_shortcodes);
SC_END

SC_BEGIN YELP_CATEGORY_INFO
   global $yelp, $yelp_shortcodes, $tp, $YELP_CATEGORY_INFO;
   if ($yelp->getMode()) {
      return $tp->parseTemplate($YELP_CATEGORY_INFO, FALSE, $yelp_shortcodes);
   } else {
      return "";
   }
SC_END

SC_BEGIN YELP_ITEM_COMMENTS
   global $yelp_shortcodes, $tp, $YELP_ITEM_COMMENTS;
   return $tp->parseTemplate($YELP_ITEM_COMMENTS, FALSE, $yelp_shortcodes);
SC_END

// ******************************************************************************************
// Search
// ******************************************************************************************
SC_BEGIN YELP_SEARCH_BAR_SEARCH_FIELD
   parse_str($parm, $parms);
   $text = "<form method='get' action='../../search.php'>";
   $text .= YELP_LAN_SEARCH;
   $text .= " <input class='tbox search' type='text' name='q' size='20' value='' maxlength='50'/>";
   $text .= "<input type='hidden' name='r' value='0'/>";
   $text .= "<input type='hidden' name='t' value='yellowpages'/>";
   if (array_key_exists("showbutton", $parms)) {
      $text .= "&nbsp;<input type='submit' class='button' name='submit' value='".YELP_LAN_SEARCH_GO."'/>";
   }
   $text .= "</form>";
   return $text;
SC_END

// ******************************************************************************************
// Miscellaneious
// ******************************************************************************************
SC_BEGIN YELP_WELCOME_MESSAGE
   global $pref, $tp;
   $text = $tp->toHTML($pref["yellowpages_welcome_text"], true);
   return $text;
SC_END

// ******************************************************************************************
// Sections
// ******************************************************************************************
SC_BEGIN YELP_SECTION_DESCRIPTION
   global $yelp, $ypSection, $tp;
   parse_str($parm, $parms);
   if (array_key_exists("frontpage", $parms) && $yelp->getMode()) {
      return "";
   }
   $text = "";
   if ($ypSection) {
      $text = $tp->toHTML($ypSection->getDescription(), true);
   }
   return $text;
SC_END

// ******************************************************************************************
// Categories
// ******************************************************************************************
SC_BEGIN YELP_CATEGORY_A2Z
   global $yelp, $ypSection, $ypCategory, $ypCategoryList;
   $text = "";
   $current = "";
   $catid = ($ypCategory) ? $ypCategory->getId() : 0;
   $count = -1;
   foreach ($ypCategoryList as $cat) {
      $char = strtoupper(substr($cat->getName(), 0, 1));
      if ($char != $current) {
         $section = $ypSection ? $ypSection->getURL()."." : "";
         $text .= "<input type='button' class='button' value='$char' onclick='document.location=\"".YELP_SELF."?$section".YELP_CATEGORIES_PAGE.".".$catid.".$char\"'/>";
         //$text .= "<button class='button' onclick='document.location=\"".YELP_SELF."?".YELP_CATEGORIES_PAGE.".".$catid.".$char\"'>$char</button>";
         $current = $char;
         $count++;
      }
   }
   return $count ? $text : "";
SC_END

SC_BEGIN YELP_CATEGORY_NAME
   global $yelp, $ypList, $ypSection, $ypCategory, $e107Helper, $pref, $tp;
   if (!isset($ypCategory)) {
      return "";
   }
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= $yelp->getAnchor(YELP_CATEGORIES_PAGE, $ypCategory->getId());
   }
   $text .= $tp->toHTML($ypCategory->getName(), true);
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN YELP_CATEGORY_CHILD_COUNT
   global $ypCategory, $tp;
   if ($ypCategory->getChildCount()) {
      return "(".$ypCategory->getChildCount().")";
   }
   return "";
SC_END

SC_BEGIN YELP_CATEGORY_ITEM_COUNT
   global $ypCategory, $tp;
   if ($ypCategory->getItemCount()) {
      return $ypCategory->getItemCount();
   }
   return "";
SC_END

SC_BEGIN YELP_CATEGORY_DESCRIPTION
   global $ypCategory, $tp;
   if (!isset($ypCategory)) {
      return "";
   }
   return $tp->toHTML($ypCategory->getDescription(), true);
SC_END

SC_BEGIN YELP_CATEGORY_ICON
   global $yelp, $ypCategory, $pref, $tp;
   parse_str($parm, $parms);
   if (!$ypCategory || "" == $icon = $ypCategory->getIcon()) {
      return "";
   }
   $name = $tp->post_toForm($ypCategory->getName(), true);
   if (array_key_exists("anchor", $parms)) {
      $text .= $yelp->getAnchor(YELP_CATEGORIES_PAGE, $ypCategory->getId());
   }
   $text .= "<img src='".$ypCategory->getIcon()."' title='$name' border='0' alt='$name'/>";
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN YELP_CATEGORY_CHILDREN
   global $yelp, $ypList, $ypCategory, $ypChildren, $e107Helper, $pref;
   if (isset($pref["yellowpages_subcategory_limit"]) && is_numeric($pref["yellowpages_subcategory_limit"]) && $pref["yellowpages_subcategory_limit"] == 0) {
      // No children to display
      return "";
   }
   parse_str($parm, $parms);
   $text = "";
   $separator = "";
   $count = 1;
   foreach ($ypChildren as $cat) {
      if (isset($pref["yellowpages_subcategory_limit"]) && is_numeric($pref["yellowpages_subcategory_limit"]) && $count > $pref["yellowpages_subcategory_limit"]) {
         $text .= $pref["yellowpages_subcategory_limit_post"];
         break;
      }
      $text .= $separator;
      if (array_key_exists("anchor", $parms)) {
      $text .= $yelp->getAnchor(YELP_CATEGORIES_PAGE, $cat->getId());
      }
      $text .= $cat->getName();
      if (array_key_exists("anchor", $parms)) {
         $text .= "</a>";
      }
      if (array_key_exists("childcount", $parms)) {
         if ($cat->getChildCount()) {
            $text .= " (".$cat->getChildCount().")";
         }
      }
      if (array_key_exists("itemcount", $parms)) {
         if ($cat->getItemCount()) {
            $text .= " (".$cat->getItemCount().")";
         }
      }
      $separator = varset($parms["separator"], " - ");
      $count++;
   }
   return $text;
SC_END

// ******************************************************************************************
// Items - Item view page
// ******************************************************************************************
SC_BEGIN YELP_ITEM_VIEW_ITEM_NAME
   global $yelp_shortcodes, $tp;
   return $tp->parseTemplate("{YELP_ITEM_NAME_PRIVATE=$parm}", FALSE, $yelp_shortcodes);
SC_END

SC_BEGIN YELP_ITEM_VIEW_ITEM_DESCRIPTION
   global $yelp_shortcodes, $tp;
   return $tp->parseTemplate("{YELP_ITEM_DESCRIPTION_PRIVATE=$parm}", FALSE, $yelp_shortcodes);
SC_END

SC_BEGIN YELP_ITEM_VIEW_ITEM_CONTACT
   global $yelp_shortcodes, $tp;
   return $tp->parseTemplate("{YELP_ITEM_CONTACT_PRIVATE=$parm}", FALSE, $yelp_shortcodes);
SC_END

SC_BEGIN YELP_ITEM_VIEW_ITEM_TEL1
   global $yelp_shortcodes, $tp;
   return $tp->parseTemplate("{YELP_ITEM_TEL1_PRIVATE=$parm}", FALSE, $yelp_shortcodes);
SC_END

SC_BEGIN YELP_ITEM_VIEW_ITEM_TEL2
   global $yelp_shortcodes, $tp;
   return $tp->parseTemplate("{YELP_ITEM_TEL2_PRIVATE=$parm}", FALSE, $yelp_shortcodes);
SC_END

SC_BEGIN YELP_ITEM_VIEW_ITEM_EMAIL
   global $yelp_shortcodes, $tp;
   return $tp->parseTemplate("{YELP_ITEM_EMAIL_PRIVATE=$parm}", FALSE, $yelp_shortcodes);
SC_END

SC_BEGIN YELP_ITEM_VIEW_ITEM_WEBSITE
   global $yelp_shortcodes, $tp;
   return $tp->parseTemplate("{YELP_ITEM_WEBSITE_PRIVATE=$parm}", FALSE, $yelp_shortcodes);
SC_END

SC_BEGIN YELP_ITEM_VIEW_ITEM_IMAGE
   global $yelp_shortcodes, $tp;
   return $tp->parseTemplate("{YELP_ITEM_IMAGE_PRIVATE=$parm}", FALSE, $yelp_shortcodes);
SC_END

// ******************************************************************************************
// Items - displayed in list, as opposed to on their own view page.
// ******************************************************************************************
SC_BEGIN YELP_ITEM_LIST_ITEM_NAME
   global $yelp_shortcodes, $tp;
   return $tp->parseTemplate("{YELP_ITEM_NAME_PRIVATE=$parm}", FALSE, $yelp_shortcodes);
SC_END

SC_BEGIN YELP_ITEM_LIST_ITEM_DESCRIPTION
   global $yelp_shortcodes, $tp;
   return $tp->parseTemplate("{YELP_ITEM_DESCRIPTION_PRIVATE=$parm}", FALSE, $yelp_shortcodes);
SC_END

SC_BEGIN YELP_ITEM_LIST_ITEM_CONTACT
   global $yelp_shortcodes, $tp;
   return $tp->parseTemplate("{YELP_ITEM_CONTACT_PRIVATE=$parm}", FALSE, $yelp_shortcodes);
SC_END

SC_BEGIN YELP_ITEM_LIST_ITEM_TEL1
   global $yelp_shortcodes, $tp;
   return $tp->parseTemplate("{YELP_ITEM_TEL1_PRIVATE=$parm}", FALSE, $yelp_shortcodes);
SC_END

SC_BEGIN YELP_ITEM_LIST_ITEM_TEL2
   global $yelp_shortcodes, $tp;
   return $tp->parseTemplate("{YELP_ITEM_TEL2_PRIVATE=$parm}", FALSE, $yelp_shortcodes);
SC_END

SC_BEGIN YELP_ITEM_LIST_ITEM_EMAIL
   global $yelp_shortcodes, $tp;
   return $tp->parseTemplate("{YELP_ITEM_EMAIL_PRIVATE=$parm}", FALSE, $yelp_shortcodes);
SC_END

SC_BEGIN YELP_ITEM_LIST_ITEM_WEBSITE
   global $yelp_shortcodes, $tp;
   return $tp->parseTemplate("{YELP_ITEM_WEBSITE_PRIVATE=$parm}", FALSE, $yelp_shortcodes);
SC_END

SC_BEGIN YELP_ITEM_LIST_ITEM_IMAGE
   global $yelp_shortcodes, $tp;
   return $tp->parseTemplate("{YELP_ITEM_IMAGE_PRIVATE=$parm}", FALSE, $yelp_shortcodes);
SC_END


// ******************************************************************************************
// Items - private.
// Should not be referenced in templates - designed to be used by other shortcodes to allow
// different styling based on the type of page (list/view) the item is being displayed on.
// ******************************************************************************************
SC_BEGIN YELP_ITEM_NAME_PRIVATE
   global $yelp, $ypItem, $e107Helper, $pref, $tp, $parm;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= $yelp->getAnchor(YELP_ITEM_PAGE, $ypItem->getId());
   } elseif (array_key_exists("weblink", $parms)) {
      $text .= "<a href='".$ypItem->getWebsite()."'>";
   }
   $text .= $tp->toHTML($ypItem->getName(), true);
   if (array_key_exists("anchor", $parms) || array_key_exists("weblink", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN YELP_ITEM_DESCRIPTION_PRIVATE
   global $ypItem, $tp;
   parse_str($parm, $parms);
   $text = $tp->toHTML($ypItem->getDescription(), true);
   if (array_key_exists("size", $parms)) {
      $text = $tp->html_truncate($text, $parms["size"], "...");
   }
   return $text;
SC_END

SC_BEGIN YELP_ITEM_CONTACT_PRIVATE
   global $ypItem, $tp;
   $text = $tp->toHTML($ypItem->getContactName(), true);
   return $text;
SC_END

SC_BEGIN YELP_ITEM_TEL1_PRIVATE
   global $ypItem, $tp;
   $text = $tp->toHTML($ypItem->getTel1(), true);
   return $text;
SC_END

SC_BEGIN YELP_ITEM_TEL2_PRIVATE
   global $ypItem, $tp;
   $text = $tp->toHTML($ypItem->getTel2(), true);
   return $text;
SC_END

SC_BEGIN YELP_ITEM_EMAIL_PRIVATE
   global $ypItem, $tp;
   $text = $tp->toHTML($ypItem->getEMail(), true);
   return $text;
SC_END

SC_BEGIN YELP_ITEM_WEBSITE_PRIVATE
   global $ypItem, $tp;
   $text = "<a href='".$ypItem->getWebsite()."'>".$tp->toHTML($ypItem->getWebsite(), true)."</a>";
   return $text;
SC_END

SC_BEGIN YELP_ITEM_IMAGE_PRIVATE
   global $ypItem, $tp;
   $text = "";
   if (strlen($ypItem->getImage()) > 0) {
      $text .= "<img src='".$ypItem->getImage()."' alt='".$ypItem->getName()."'/>";
   }
   return $text;
SC_END

// ******************************************************************************************
// Errors and warnings
// ******************************************************************************************
SC_BEGIN YELP_STATUS_INFO
   global $ypStatusInfo;
   $text = "";
   if (isset($ypStatusInfo) && $ypStatusInfo !== false) {
      switch ($ypStatusInfo->getLevel()) {
         case STATUS_INFO :
            $text .= "<img src='".e_IMAGE."fileinspector/file_check.png' border='0' alt='".YELP_LAN_MSG_INFORMATION."'/> ";
            break;
         case STATUS_WARN :
            $text .= "<img src='".e_IMAGE."fileinspector/file_warning.png' border='0' alt='".YELP_LAN_MSG_WARNING."'/> ";
            break;
         case STATUS_ERROR :
            $text .= "<img src='".e_IMAGE."fileinspector/file_uncalc.png' border='0' alt='".YELP_LAN_MSG_ERROR."'/> ";
            break;
         case STATUS_FATAL :
            $text .= "<img src='".e_IMAGE."fileinspector/file_fail.png' border='0' alt='".YELP_LAN_MSG_FATAL."'/> ";
            break;
         case STATUS_DEBUG :
            $text .= "<img src='".e_IMAGE."fileinspector/file_unknown.png' border='0' alt='".YELP_LAN_MSG_DEBUG."'/> ";
            break;
         default :
      }
      $text .= $ypStatusInfo->getLevelDescription();
      for ($i=0; $i < $ypStatusInfo->getMessageCount(); $i++) {
         if ($ypStatusInfo->hasAdditionalDetails($i)) {
            $attributes = " style='cursor:pointer;' onclick='expandit(this);";
         }
         $text .= "<div $attributes'>".$ypStatusInfo->getMessage($i)."</div><div></div>";
         if ($ypStatusInfo->hasAdditionalDetails($i)) {
            $text .= "<div style='display:none;margin-left:10px'>".$ypStatusInfo->getAdditionalDetails($i)."</div>";
         }
      }
   }
   return $text;
SC_END

SC_BEGIN YELP_NAVIGATION_ERROR
   global $yelp;
   return $yelp->getAnchor().YELP_LAN_MSG_NAVIGATION_ERROR."</a>";
SC_END

*/
?>
