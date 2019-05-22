<?php
/*
+---------------------------------------------------------------+
| Bugtracker3 by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/bugtracker3/bugtracker3_shortcodes.php,v $
| $Revision: 1.1.2.31 $
| $Date: 2006/12/10 16:04:45 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
if (!isset($tp)) {
   $tp = new e_parse();
   $tp->e_sc = new e_shortcode();
}
global $bugtracker3_shortcodes;
$bugtracker3_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);

/*
// ************************************************************************************************
// Section Templates
// These template shortcodes have a matching variable in the shortcodes file, they define major
// sections of a page. Sections can be 'glued' together to make the whole page.
// ************************************************************************************************
SC_BEGIN BUG3_NAV_BAR
   global $app, $bugtracker3_shortcodes, $pref, $tp, $BUG3_NAV_BAR;
   return $tp->parseTemplate($BUG3_NAV_BAR, FALSE, $bugtracker3_shortcodes);
SC_END

SC_BEGIN BUG3_SEARCH_BAR
   global $app, $bugtracker3_shortcodes, $pref, $tp, $BUG3_SEARCH_BAR;
   return $tp->parseTemplate($BUG3_SEARCH_BAR, FALSE, $bugtracker3_shortcodes);
SC_END

SC_BEGIN BUG3_APP_INFO
   global $app, $bugtracker3_shortcodes, $pref, $tp, $BUG3_APP_INFO;
   return $tp->parseTemplate($BUG3_APP_INFO, FALSE, $bugtracker3_shortcodes);
SC_END

SC_BEGIN BUG3_APP_INFO_SHORT
   global $app, $bugtracker3_shortcodes, $pref, $tp, $BUG3_APP_INFO_SHORT;
   return $tp->parseTemplate($BUG3_APP_INFO_SHORT, FALSE, $bugtracker3_shortcodes);
SC_END

SC_BEGIN BUG3_APP_INFO_FEATURE
   global $app, $bugtracker3_shortcodes, $pref, $tp, $BUG3_APP_INFO_FEATURE;
   return $tp->parseTemplate($BUG3_APP_INFO_FEATURE, FALSE, $bugtracker3_shortcodes);
SC_END

SC_BEGIN BUG3_APP_INFO_SHORT_FEATURE
   global $app, $bugtracker3_shortcodes, $pref, $tp, $BUG3_APP_INFO_SHORT_FEATURE;
   return $tp->parseTemplate($BUG3_APP_INFO_SHORT_FEATURE, FALSE, $bugtracker3_shortcodes);
SC_END

SC_BEGIN BUG3_APP_CHARTS
   global $app, $bugtracker3_shortcodes, $pref, $tp, $BUG3_APP_CHARTS;
   return $tp->parseTemplate($BUG3_APP_CHARTS, FALSE, $bugtracker3_shortcodes);
SC_END

SC_BEGIN BUG3_BUG
   global $app, $bugtracker3_shortcodes, $pref, $tp, $BUG3_BUG;
   return $tp->parseTemplate($BUG3_BUG, FALSE, $bugtracker3_shortcodes);
SC_END

SC_BEGIN BUG3_FEATURE
   global $app, $bugtracker3_shortcodes, $pref, $tp, $BUG3_FEATURE;
   return $tp->parseTemplate($BUG3_FEATURE, FALSE, $bugtracker3_shortcodes);
SC_END

SC_BEGIN BUG3_BUG_INFO
   global $app, $bugtracker3_shortcodes, $pref, $tp, $BUG3_BUG_INFO;
   return $tp->parseTemplate($BUG3_BUG_INFO, FALSE, $bugtracker3_shortcodes);
SC_END

SC_BEGIN BUG3_BUG_SUBMIT
   global $app, $bugtracker3User, $bugtracker3_shortcodes, $tp, $BUG3_BUG_SUBMIT;
   if ($bugtracker3User->canPost($app->getId()) && $app->canPost()) {
      $text = "<form id='submitbug' method='post' action=".BUGC_SELF."?".BUGC_SUBMIT_BUG_PAGE.".".$app->getId().">";
      $text .= $tp->parseTemplate($BUG3_BUG_SUBMIT, FALSE, $bugtracker3_shortcodes);
      $text .= "</form>";
   } else {
      $text .= $tp->parseTemplate("{BUG3_LAN_MSG_NAV_ERROR}", FALSE, $bugtracker3_shortcodes);
   }
   return $text;
SC_END

SC_BEGIN BUG3_BUG_EDIT
   global $app, $bug, $bugtracker3User, $bugtracker3_shortcodes, $tp, $BUG3_BUG_EDIT;
   if ($bugtracker3User->canEdit($app->getID())) {
      $text = "<form id='editbug' method='post' action=".BUGC_SELF."?".BUGC_EDIT_BUG_PAGE.".".$bug->getId().">";
      $text .= "<input type='hidden' id='bugtracker3_bugid' value='".$bug->getId()."'/>";
      $text .= $tp->parseTemplate($BUG3_BUG_EDIT, FALSE, $bugtracker3_shortcodes);
      $text .= "</form>";
   } else {
      $text .= $tp->parseTemplate("{BUG3_LAN_MSG_NAV_ERROR}", FALSE, $bugtracker3_shortcodes);
   }
   return $text;
SC_END

SC_BEGIN BUG3_BUG_MOVE
   global $bug, $bugtracker3_shortcodes, $tp, $BUG3_BUG_MOVE;
   $text = "<form id='movebug' method='post' action=".BUGC_SELF."?".BUGC_MOVE_BUG_PAGE.".".$bug->getId().">";
   $text .= "<input type='hidden' id='bugtracker3_bugid' value='".$bug->getId()."'/>";
   $text .= $tp->parseTemplate($BUG3_BUG_MOVE, FALSE, $bugtracker3_shortcodes);
   $text .= "</form>";
   return $text;
SC_END

SC_BEGIN BUG3_FEATURE_SUBMIT
   global $app, $bugtracker3User, $bugtracker3_shortcodes, $tp, $BUG3_FEATURE_SUBMIT;
   if ($bugtracker3User->canPost($app->getId()) && $app->canPost()) {
      $text = "<form id='submitbug' method='post' action=".BUGC_SELF."?".BUGC_SUBMIT_BUG_PAGE.".".$app->getId().">";
      $text .= $tp->parseTemplate($BUG3_FEATURE_SUBMIT, FALSE, $bugtracker3_shortcodes);
      $text .= "</form>";
   } else {
      $text .= $tp->parseTemplate("{BUG3_LAN_MSG_NAV_ERROR}", FALSE, $bugtracker3_shortcodes);
   }
   return $text;
SC_END

SC_BEGIN BUG3_FEATURE_EDIT
   global $app, $bug, $bugtracker3User, $bugtracker3_shortcodes, $tp, $BUG3_FEATURE_EDIT;
   if ($bugtracker3User->canEdit($app->getID())) {
      $text = "<form id='editbug' method='post' action=".BUGC_SELF."?".BUGC_EDIT_BUG_PAGE.".".$bug->getId().">";
      $text .= "<input type='hidden' id='bugtracker3_bugid' value='".$bug->getId()."'/>";
      $text .= $tp->parseTemplate($BUG3_FEATURE_EDIT, FALSE, $bugtracker3_shortcodes);
      $text .= "</form>";
   } else {
      $text .= $tp->parseTemplate("{BUG3_LAN_MSG_NAV_ERROR}", FALSE, $bugtracker3_shortcodes);
   }
   return $text;
SC_END

SC_BEGIN BUG3_FEATURE_MOVE
   global $bug, $bugtracker3_shortcodes, $tp, $BUG3_FEATURE_MOVE;
   $text = "<form id='movebug' method='post' action=".BUGC_SELF."?".BUGC_MOVE_BUG_PAGE.".".$bug->getId().">";
   $text .= "<input type='hidden' id='bugtracker3_bugid' value='".$bug->getId()."'/>";
   $text .= $tp->parseTemplate($BUG3_FEATURE_MOVE, FALSE, $bugtracker3_shortcodes);
   $text .= "</form>";
   return $text;
SC_END

SC_BEGIN BUG3_BUG_EDIT_DEVS
   global $app, $bug, $bugtracker3User, $bugtracker3_shortcodes, $tp, $BUG3_BUG_EDIT_DEVS;
   if ($bugtracker3User->canEdit($app->getID())) {
      $text = $tp->parseTemplate($BUG3_BUG_EDIT_DEVS, FALSE, $bugtracker3_shortcodes);
   } else {
      $text = "";
   }
   return $text;
SC_END

SC_BEGIN BUG3_FILTER
   global $e107HelperForm;
   $e107HelperForm->createFormFromXML("forms/filters");
   $e107HelperForm->processForm(true, true);
   return $e107HelperForm->getFormHTML();
SC_END

// ************************************************************************************************
// Shortcodes
// ************************************************************************************************

// Labels - these just get stuff from the language file defined constants
SC_BEGIN BUG3_LABEL_APP_NAME
   return BUG_LAN_LABEL_APP_NAME;
SC_END

SC_BEGIN BUG3_LABEL_APP_ICON
   return BUG_LAN_LABEL_APP_ICON;
SC_END

SC_BEGIN BUG3_LABEL_APP_TOTAL_ALL
   return BUG_LAN_LABEL_APP_TOTAL_ALL;
SC_END

SC_BEGIN BUG3_LABEL_BUG_TOTAL_ALL
   return BUG_LAN_LABEL_BUG_TOTAL_ALL;
SC_END

SC_BEGIN BUG3_LABEL_BUGS
   global $app;
   if (isset($app) && $app->getType() == BUGC_APP_TYPE_FEATURES) {
      return BUG_LAN_LABEL_FEATURES;
   }
   return BUG_LAN_LABEL_BUGS;
SC_END

SC_BEGIN BUG3_LABEL_DESCRIPTION
   return BUG_LAN_LABEL_DESCRIPTION;
SC_END

SC_BEGIN BUG3_LABEL_DEVELOPER_COMMENTS
   return BUG_LAN_LABEL_DEVELOPER_COMMENTS;
SC_END

SC_BEGIN BUG3_LABEL_ID
   return BUG_LAN_LABEL_ID;
SC_END

SC_BEGIN BUG3_LABEL_OWNER
   return BUG_LAN_LABEL_OWNER;
SC_END

SC_BEGIN BUG3_LABEL_POSTER
   return BUG_LAN_LABEL_POSTER;
SC_END

SC_BEGIN BUG3_LABEL_LAST_UPDATE_POSTER
   return BUG_LAN_LABEL_LAST_UPDATE_POSTER;
SC_END

SC_BEGIN BUG3_LABEL_LAST_UPDATE_DATE_TIME
   return BUG_LAN_LABEL_LAST_UPDATE_DATE_TIME;
SC_END

SC_BEGIN BUG3_LABEL_CATEGORY
   return BUG_LAN_LABEL_CATEGORY;
SC_END

SC_BEGIN BUG3_LABEL_PRIORITY
   return BUG_LAN_LABEL_PRIORITY;
SC_END

SC_BEGIN BUG3_LABEL_RELATED_BUGS
   global $app;
   if ($app->getType() == BUGC_APP_TYPE_FEATURES) {
      return BUG_LAN_LABEL_RELATED_FEATURES;
   }
   return BUG_LAN_LABEL_RELATED_BUGS;
SC_END

SC_BEGIN BUG3_LABEL_RESOLUTION
   return BUG_LAN_LABEL_RESOLUTION;
SC_END

SC_BEGIN BUG3_LABEL_STATUS
   return BUG_LAN_LABEL_STATUS;
SC_END

SC_BEGIN BUG3_LABEL_SUMMARY
   return BUG_LAN_LABEL_SUMMARY;
SC_END

SC_BEGIN BUG3_LABEL_VERSION
   return BUG_LAN_LABEL_VERSION;
SC_END

SC_BEGIN BUG3_LABEL_FOUND_IN_VERSION
   return BUG_LAN_LABEL_FOUND_IN_VERSION;
SC_END

SC_BEGIN BUG3_LABEL_FIXED_IN_VERSION
   global $app;
   if ($app->getType() == BUGC_APP_TYPE_FEATURES) {
      return BUG_LAN_LABEL_IMPLEMENTED_IN_VERSION;
   }
   return BUG_LAN_LABEL_FIXED_IN_VERSION;
SC_END

SC_BEGIN BUG3_LABEL_DELETED
   return BUG_LAN_LABEL_DELETED;
SC_END

// ******************************************************************************************
// Navigation bar
// ******************************************************************************************
SC_BEGIN BUG3_NAV_BAR_SUBMIT_BUTTON
   global $app, $bugtracker3, $bugtracker3User, $pref;
   if ($bugtracker3->getMode() != BUGC_SUBMIT_BUG_PAGE && isset($app) && $bugtracker3User->canPost($app->getId()) && $app->canPost()) {
      if ($app->getType() == BUGC_APP_TYPE_FEATURES) {
         $value = BUG_LAN_JUMPLIST_SUBMIT_FEATURE;
      } else {
         $value = BUG_LAN_JUMPLIST_SUBMIT;
      }
      if (varset($pref["bugtracker3_ajax"], false)) {
         return "<input type='button' class='button' onclick='bugtracker3Helper.queryURL(\"".BUGC_SUBMIT_BUG_PAGE.".".$app->getId()."\");' value='$value'/>";
      } else {
         return "<input type='button' class='button' onclick='document.location=\"".BUGC_SELF."?".BUGC_SUBMIT_BUG_PAGE.".".$app->getId()."\";' value='$value'/>";
      }
   }
   return "";
SC_END

SC_BEGIN BUG3_NAV_BAR_EDIT_BUTTON
   global $app, $bug, $bugtracker3, $bugtracker3User, $pref;
   if ($bugtracker3->getMode() != BUGC_EDIT_BUG_PAGE && $bugtracker3->getMode() != BUGC_SUBMIT_BUG_PAGE && isset($bug) && $bugtracker3User->canEdit($bug->getApplicationId())) {
      if ($app->getType() == BUGC_APP_TYPE_FEATURES) {
         $value = BUG_LAN_JUMPLIST_EDIT_FEATURE;
      } else {
         $value = BUG_LAN_JUMPLIST_EDIT;
      }
      if (varset($pref["bugtracker3_ajax"], false)) {
         return "<input type='button' class='button' onclick='bugtracker3Helper.queryURL(\"".BUGC_EDIT_BUG_PAGE.".".$bug->getId()."\");' value='$value'/>";
      } else {
         return "<input type='button' class='button' onclick='document.location=\"".BUGC_SELF."?".BUGC_EDIT_BUG_PAGE.".".$bug->getId()."\";' value='$value'/>";
      }
   }
   return "";
SC_END

SC_BEGIN BUG3_NAV_BAR_MOVE_BUTTON
   global $app, $bug, $bugtracker3, $bugtracker3User, $pref;
   if ($bugtracker3->getMode() != BUGC_MOVE_BUG_PAGE && $bugtracker3->getMode() != BUGC_SUBMIT_BUG_PAGE && isset($bug) && $bugtracker3User->canEdit($bug->getApplicationId())) {
      if ($app->getType() == BUGC_APP_TYPE_FEATURES) {
         $value = BUG_LAN_JUMPLIST_MOVE_FEATURE;
      } else {
         $value = BUG_LAN_JUMPLIST_MOVE;
      }
      if (varset($pref["bugtracker3_ajax"], false)) {
         return "<input type='button' class='button' onclick='bugtracker3Helper.queryURL(\"".BUGC_MOVE_BUG_PAGE.".".$bug->getId()."\");' value='$value'/>";
      } else {
         return "<input type='button' class='button' onclick='document.location=\"".BUGC_SELF."?".BUGC_MOVE_BUG_PAGE.".".$bug->getId()."\";' value='$value'/>";
      }
   }
   return "";
SC_END

SC_BEGIN BUG3_NAV_BAR_APP_LIST_BUTTON
   global $app, $bug, $bugtracker3User, $pref;
   if (isset($app) || isset($bug)) {
      if (varset($pref["bugtracker3_ajax"], false)) {
         return "<input type='button' class='button' onclick='bugtracker3Helper.queryURL(\"\");' value='".BUG_LAN_JUMPLIST_APP_LIST."'/>";
      } else {
         return "<input type='button' class='button' onclick='document.location=\"".BUGC_SELF."\";' value='".BUG_LAN_JUMPLIST_APP_LIST."'/>";
      }
   }
   return "";
SC_END

SC_BEGIN BUG3_NAV_BAR_BUG_LIST_BUTTON
   global $app, $bug, $bugtracker3User, $pref;
   if (isset($bug)) {
      if ($app->getType() == BUGC_APP_TYPE_FEATURES) {
         $value = BUG_LAN_JUMPLIST_BUG_LIST_FEATURE;
      } else {
         $value = BUG_LAN_JUMPLIST_BUG_LIST;
      }
      if (varset($pref["bugtracker3_ajax"], false)) {
         return "<input type='button' class='button' onclick='bugtracker3Helper.queryURL(\"".BUGC_BUGS_PAGE.".".$bug->getApplicationId()."\");' value='$value'/>";
      } else {
         return "<input type='button' class='button' onclick='document.location=\"".BUGC_SELF."?".BUGC_BUGS_PAGE.".".$bug->getApplicationId()."\";' value='$value'/>";
      }
   }
   return "";
SC_END

SC_BEGIN BUG3_NAV_BAR_JUMP_LIST
   global $app, $bug, $dao, $applist, $filterlist, $bugtracker3, $bugtracker3User, $pref;

   parse_str($parm, $parms);
   $text = BUG_LAN_JUMPLIST_LABEL;
   if (varset($pref["bugtracker3_ajax"], false)) {
      $text .= "&nbsp;<select class='tbox' onchange='if (this.value!=\"...\") onclick=bugtracker3Helper.queryURL(this.value);'>";
   } else {
      $text .= "&nbsp;<select class='tbox' onchange='if (this.value!=\"...\") document.location=\"".BUGC_SELF."?\"+this.value;'>";
   }
   $text .= "<option value='...'>".BUG_LAN_JUMPLIST_SELECT."</option>";
   if (!array_key_exists("hidejumps", $parms)) {
      // Jump to pages
      $text .= "<optgroup class='smallblacktext' label='".BUG_LAN_JUMPLIST_JUMP_TO."'>";
      if (!isset($applist)) {
         $text .= "<option value=''>".BUG_LAN_JUMPLIST_APP_LIST."</option>";
         // Check to see if user can post bugs to this app
         if (isset($app)) {
            if (isset($bug)) {
               if ($app->getType() == BUGC_APP_TYPE_FEATURES) {
                  $value = BUG_LAN_JUMPLIST_BUG_LIST_FEATURE;
               } else {
                  $value = BUG_LAN_JUMPLIST_BUG_LIST;
               }
               $text .= "<option value='".BUGC_BUGS_PAGE.".".$bug->getApplicationId()."'>$value</option>";
               if ($bugtracker3->getMode() != BUGC_SUBMIT_BUG_PAGE && $bugtracker3->getMode() != BUGC_MOVE_BUG_PAGE && $bugtracker3User->canEdit($app->getId())) {
                  if ($app->getType() == BUGC_APP_TYPE_FEATURES) {
                     $value = BUG_LAN_JUMPLIST_MOVE_FEATURE;
                  } else {
                     $value = BUG_LAN_JUMPLIST_MOVE;
                  }
                  $text .= "<option value='".BUGC_MOVE_BUG_PAGE.".".$bug->getId()."'>$value</option>";
                  if ($app->getType() == BUGC_APP_TYPE_FEATURES) {
                     $value = BUG_LAN_JUMPLIST_EDIT_FEATURE;
                  } else {
                     $value = BUG_LAN_JUMPLIST_EDIT;
                  }
                  $text .= "<option value='".BUGC_EDIT_BUG_PAGE.".".$bug->getId()."'>$value</option>";
               }
            }
            if ($bugtracker3->getMode() != BUGC_SUBMIT_BUG_PAGE && $bugtracker3User->canPost($app->getId()) && $app->canPost()) {
               if ($app->getType() == BUGC_APP_TYPE_FEATURES) {
                  $value = BUG_LAN_JUMPLIST_SUBMIT_FEATURE;
               } else {
                  $value = BUG_LAN_JUMPLIST_SUBMIT;
               }
               $text .= "<option value='".BUGC_SUBMIT_BUG_PAGE.".".$app->getId()."'>$value</option>";
            }
            $text .= "<option value='".BUGC_STATS_PAGE.".".$app->getId()."'>".BUG_LAN_JUMPLIST_STATS."</option>";
         }
      }
      if (USER) {
         $text .= "<option value='".BUGC_FILTER_PAGE."'>".BUG_LAN_JUMPLIST_FILTER."</option>";
      }
      $text .= "</optgroup>";
   }

   // Filters
   if (!array_key_exists("hidefilters", $parms)) {
      if (isset($app)) {
         if (!isset($filterlist)) {
            $filterlist = $dao->getFilterList();
         }
         $text .= "<optgroup class='smallblacktext' label='".BUG_LAN_JUMPLIST_FILTERS."'>";
         if ($bugtracker3User->getFilter()) {
            $text .= "<option class='smalltext' value='".e_QUERY.".0'>".BUG_LAN_JUMPLIST_FILTERS_OFF."</option>";
         }
         foreach ($filterlist as $afilter) {
            if ($afilter->GetId() != $bugtracker3User->getFilter()) {
               $text .= "<option class='smalltext' value='".e_QUERY.".".$afilter->GetId()."'>".$afilter->GetName()."</option>";
            }
         }
         $text .= "</optgroup>";
      }
   }

   // Applications
   if (!isset($applist)) {
      $applist = $dao->getAppList();
   }
   $text .= "<optgroup class='smallblacktext' label='".BUG_LAN_JUMPLIST_APPLICATIONS."'>";
   foreach ($applist as $anapp) {
      if ($bugtracker3User->canViewApp($anapp)) {
         $text .= "<option class='smalltext' value='1.".$anapp->GetId()."'>".$anapp->GetName()."</option>";
      }
   }
   $text .= "</optgroup>";

   // bugs
   if (!array_key_exists("hidebugs", $parms)) {
      if (isset($app)) {
         if (!isset($buglist)) {
            $buglist = $dao->getBugList($app->getId());
         }
         $text .= "<optgroup class='smallblacktext' label='".BUG_LAN_JUMPLIST_BUGS."'>";
         foreach ($buglist as $abug) {
            // TODO add a method to get combine ID and Summary
            $text .= "<option class='smalltext' value='2.".$abug->GetId()."'>#".$abug->GetId()." ".$abug->getSummary(false, BUGC_TRUNC)."</option>";
         }
         $text .= "</optgroup>";
      }
   }

   $text .= "</select>";
   return $text;
SC_END

SC_BEGIN BUG3_NAV_BAR_FILTER_LIST
   global $app, $bug, $dao, $applist, $filterlist, $bugtracker3, $bugtracker3User;

   parse_str($parm, $parms);
   $text = BUG_LAN_FILTERLIST_LABEL;
   //if (varset($pref["bugtracker3_ajax"], false)) {
   //   $text .= "&nbsp;<select class='tbox' onchange='if (this.value!=\"...\") bugtracker3Helper.queryURL(this.value);'>";
   //} else {
      $text .= "&nbsp;<select class='tbox' onchange='if (this.value!=\"...\") document.location=\"".BUGC_SELF."\"+this.value;'>";
   //}
   //$text .= "<option value='...'>".BUG_LAN_JUMPLIST_SELECT."</option>";

   // Filters
//   if (isset($app)) {
      if (!isset($filterlist)) {
         $filterlist = $dao->getFilterList();
      }
      $text .= "<optgroup class='smallblacktext' label='".BUG_LAN_JUMPLIST_FILTERS."'>";
      if (!$bugtracker3User->getFilter()) {
         $selected = " selected='selected'";
      }
      $text .= "<option class='smalltext' value='?".e_QUERY.".0'$selected>".BUG_LAN_JUMPLIST_FILTERS_OFF."</option>";
      $filter = $dao->getFilter($bugtracker3User->getFilter());
      foreach ($filterlist as $afilter) {
         $selected = ($filter && $filter->getId() == $afilter->getId()) ? " selected='selected'" : "";
         $text .= "<option class='smalltext' value='?".e_QUERY.".".$afilter->getId()."'$selected>".$afilter->GetName()."</option>";
      }
      $text .= "</optgroup>";
//   }

   $text .= "</select>";
   if (array_key_exists("showcurrent", $parms) && $filter) {
      $text .= " <span class='smalltext'>".BUG_LAN_LABEL_CURRENT_FILTER." ".$filter->getName()."</span>";
   }
   return $text;
SC_END

// ******************************************************************************************
// Search bar
// ******************************************************************************************
SC_BEGIN BUG3_SEARCH_BAR_SEARCH_FIELD
   parse_str($parm, $parms);
   $text = "<form method='get' action='../../search.php'>";
   $text .= "<div>".BUG_LAN_LABEL_SEARCH;
   $text .= " <input class='tbox search' type='text' name='q' size='20' value='' maxlength='50'/>";
   $text .= "<input type='hidden' name='r' value='0'/>";
   $text .= "<input type='hidden' name='t' value='bugtracker3'/>";
   if (array_key_exists("showbutton", $parms)) {
      $text .= "&nbsp;<input type='submit' class='button' name='submit' value='".BUG_LAN_LABEL_SEARCH_GO."'/>";
   }
   $text .= "</div></form>";
   return $text;
SC_END

// ******************************************************************************************
// Applications
// ******************************************************************************************
SC_BEGIN BUG3_APP_BUGS
   global $app;
   return $app->getBugTotal();
SC_END

SC_BEGIN BUG3_APP_ID
   global $app;
   return $app->getId();
SC_END

SC_BEGIN BUG3_APP_NAME
   global $app, $e107Helper, $pref;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("hidden", $parms)) {
      $text .= "<input type='hidden' name='".BUGC_POST_ARRAY."[ui_application_id]' value='".$app->getId()."'/>";
   }
   if (array_key_exists("anchor", $parms)) {
      if (varset($pref["bugtracker3_ajax"], false)) {
         $text .= "<a href='#' onclick=bugtracker3Helper.queryURL('".BUGC_BUGS_PAGE.".".$app->getId()."');>";
      } else {
         $text .= "<a href='".BUGC_SELF."?".BUGC_BUGS_PAGE.".".$app->getId()."'>";
      }
   }
   $text .= $app->getName();
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN BUG3_APP_ICON
   global $app, $bugtracker3, $tp;
   parse_str($parm, $parms);
   if ("" == $icon = $app->getIcon()) {
      return " ";
   }
   $name = $tp->post_toForm($app->getName(), true);
   if (array_key_exists("anchor", $parms)) {
      if (varset($pref["bugtracker3_ajax"], false)) {
         $text .= "<a href='#' onclick=bugtracker3Helper.queryURL('".BUGC_BUGS_PAGE.".".$app->getId()."');>";
      } else {
         $text .= "<a href='".BUGC_SELF."?".BUGC_BUGS_PAGE.".".$app->getId()."'>";
      }
   }
   $text .= "<img src='".$app->getIcon()."' title='$name' alt='$name'";
   if (array_key_exists("tooltip", $parms)) {
      $text .= $bugtracker3->getTooltip($app->getDescription(), $app->getName());
   }
   $text .= "/>";
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN BUG3_APP_LATEST_VERSION
   global $app;
   return $app->getLatestVersion();
SC_END

SC_BEGIN BUG3_APP_DESCRIPTION
   global $app, $tp;
   return $tp->toHTML($app->getDescription(), true);
SC_END

SC_BEGIN BUG3_APP_OWNER
   global $app;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".e_HTTP."user.php?id.".$app->getOwnerId()."'>";
   }
   $text .= $app->getOwner();
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN BUG3_APP_CATEGORY_LIST
   global $app;
   parse_str($parm, $parms);
   $text = array();
   $keys = array_keys($categoryList = $app->getCategoryList());
   foreach ($keys as $key) {
      if (array_key_exists("showzero", $parms) || ($categoryList[$key]->getCount() > 0)) {
         $text[] = $categoryList[$key]->getCount()." ".$categoryList[$key]->getName();
      }
   }

   return implode(varset($parms["separator"], ", "), $text);
SC_END

SC_BEGIN BUG3_APP_PRIORITY_LIST
   global $app;
   parse_str($parm, $parms);
   $text = array();
   $keys = array_keys($priorityList = $app->getPriorityList());
   foreach ($keys as $key) {
      if (array_key_exists("showzero", $parms) || ($priorityList[$key]->getCount() > 0)) {
         $text[] = $priorityList[$key]->getCount()." ".$priorityList[$key]->getName();
      }
   }

   return implode(varset($parms["separator"], ", "), $text);
SC_END

SC_BEGIN BUG3_APP_RESOLUTION_LIST
   global $app;
   parse_str($parm, $parms);
   $text = array();
   $keys = array_keys($resolutionList = $app->getResolutionList());
   foreach ($keys as $key) {
      if (array_key_exists("showzero", $parms) || ($resolutionList[$key]->getCount() > 0)) {
         $text[] = $resolutionList[$key]->getCount()." ".$resolutionList[$key]->getName();
      }
   }

   return implode(varset($parms["separator"], ", "), $text);
SC_END

SC_BEGIN BUG3_APP_STATUS_LIST
   global $app;
   parse_str($parm, $parms);
   $text = array();
   $keys = array_keys($statusList = $app->getStatusList());
   foreach ($keys as $key) {
      if (array_key_exists("showzero", $parms) || ($statusList[$key]->getCount() > 0)) {
         $text[] = $statusList[$key]->getCount()." ".$statusList[$key]->getName();
      }
   }

   return implode(varset($parms["separator"], ", "), $text);
SC_END

SC_BEGIN BUG3_APP_CHART_STATS_CATEGORIES
   global $app, $e107Helper;
   parse_str($parm, $parms);
   $w = array_key_exists("width", $parms) ? $parms["width"] : 400;
   $h = array_key_exists("height", $parms) ? $parms["height"] : 250;
   return $e107Helper->getChart("charts/stats_category_".$app->getId().".xml", $w, $h);
SC_END

SC_BEGIN BUG3_APP_CHART_STATS_PRIORITIES
   global $app, $e107Helper;
   parse_str($parm, $parms);
   $w = array_key_exists("width", $parms) ? $parms["width"] : 400;
   $h = array_key_exists("height", $parms) ? $parms["height"] : 250;
   return $e107Helper->getChart("charts/stats_priority_".$app->getId().".xml", $w, $h);
SC_END

SC_BEGIN BUG3_APP_CHART_STATS_RESOLUTIONS
   global $app, $e107Helper;
   parse_str($parm, $parms);
   $w = array_key_exists("width", $parms) ? $parms["width"] : 400;
   $h = array_key_exists("height", $parms) ? $parms["height"] : 250;
   return $e107Helper->getChart("charts/stats_resolution_".$app->getId().".xml", $w, $h);
SC_END

SC_BEGIN BUG3_APP_CHART_STATS_STATUSES
   global $app, $e107Helper;
   parse_str($parm, $parms);
   $w = array_key_exists("width", $parms) ? $parms["width"] : 400;
   $h = array_key_exists("height", $parms) ? $parms["height"] : 250;
   return $e107Helper->getChart("charts/stats_status_".$app->getId().".xml", $w, $h);
SC_END

SC_BEGIN BUG3_APP_TOTAL_ALL
   global $dao, $bugtracker3;
   return $dao->getAppCount();
SC_END

// ******************************************************************************************
// Bugs
// ******************************************************************************************
SC_BEGIN BUG3_BUG_DATE_TIME
   global $bug;
   $gen = new convert;
   return $gen->convert_date($bug->getTimestamp(), "long");
SC_END

SC_BEGIN BUG3_BUG_LAST_UPDATE_DATE_TIME
   global $bug;
   $gen = new convert;
   parse_str($parm, $parms);
   if (array_key_exists("short", $parms)) {
      return str_replace(" ", "&nbsp;", $gen->convert_date($bug->getLastUpdateTimestamp(), "short"));
   }
   return $gen->convert_date($bug->getLastUpdateTimestamp(), "long");
SC_END

SC_BEGIN BUG3_BUG_DESCRIPTION
   global $bug, $tp;
   return $tp->toHTML($bug->getDescription(), true);
SC_END

SC_BEGIN BUG3_BUG_DEVELOPER_COMMENTS
   global $bug, $pref, $tp;
   parse_str($parm, $parms);
   $gen = new convert;
   $comments = $bug->getDeveloperComments();
   $text = "";
   $text .= "<div id='bugtracker3_devcommentdiv'>";
   if (count($comments) > 0) {
      foreach ($comments as $comment) {
         $text .= "<p><strong>";
         $text .= $gen->convert_date($comment->getTimestamp(), "short");
         $text .= "</strong> (";
         if (array_key_exists("anchor", $parms)) {
            $text .= "<a href='".e_HTTP."user.php?id.".$comment->getPosterId()."'>";
         }
         $text .= $comment->getPoster();
         if (array_key_exists("anchor", $parms)) {
            $text .= "</a>";
         }
         $text .= ") ";
         $text .= $tp->toHTML($comment->getComment(), true);
         $text .= "</p>";
      }
   } else {
      $text .= BUG_LAN_MSG_NO_DEV_COMMENTS;
   }
   $text .= "</div>";
   return $text;
SC_END

SC_BEGIN BUG3_BUG_DEVELOPER_COMMENTS_EDIT
   global $bug, $e107Helper, $pref, $tp;
   $text = "";
   $text .= "<hr style='width:75%;'/>";
   $text .= $e107Helper->getTextarea("", "bugtracker3_devc_comment", "tbox", "5", "", "100%", $pref['bugtracker3_bbcodes'], $pref['bugtracker3_emoticons']);
   $text .= "<br/><input class='button' type='button' value='".BUG_LAN_LABEL_ADD_DEV_COMMENT."' onclick='bugtracker3Helper.addDevComment()'/>";
   return $text;
SC_END

SC_BEGIN BUG3_BUG_ID
   global $app, $bug, $bugtracker3User, $tp;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms) && $bugtracker3User->canEdit($app->getId())) {
      if (varset($pref["bugtracker3_ajax"], false)) {
         $text .= "<a href='#' onclick=bugtracker3Helper.queryURL('".BUGC_EDIT_BUG_PAGE.".".$bug->getId()."');>";
      } else {
         $text .= "<a href='".BUGC_SELF."?".BUGC_EDIT_BUG_PAGE.".".$bug->getId()."'>";
      }
   }
   $text .= "#".$bug->getId();
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN BUG3_BUG_OWNER
   global $bug;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".e_HTTP."user.php?id.".$bug->getOwnerID()."'>";
   }
   $text .= $bug->getOwner();
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN BUG3_BUG_POSTER
   global $bug;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".e_HTTP."user.php?id.".$bug->getPosterId()."'>";
   }
   $text .= $bug->getPoster();
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN BUG3_BUG_LAST_UPDATE_POSTER
   global $bug;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".e_HTTP."user.php?id.".$bug->getLastUpdatePosterId()."'>";
   }
   $text .= $bug->getLastupdatePoster();
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN BUG3_BUG_CATEGORY_NAME
   global $bug;
   return $bug->getCategoryName();
SC_END

SC_BEGIN BUG3_BUG_PRIORITY_NAME
   global $bug;
   return $bug->getPriorityName();
SC_END

SC_BEGIN BUG3_BUG_FOUND_IN_VERSION
   global $bug;
   return $bug->getFoundInVersion();
SC_END

SC_BEGIN BUG3_BUG_FIXED_IN_VERSION
   global $bug;
   return $bug->getFixedInVersion();
SC_END

SC_BEGIN BUG3_BUG_PRIORITY_COLOR
   global $bug;
   return "#".$bug->getPriorityColor();
SC_END

SC_BEGIN BUG3_BUG_RESOLUTION_NAME
   global $bug;
   return $bug->getResolutionName();
SC_END

SC_BEGIN BUG3_BUG_STATUS_NAME
   global $bug;
   return $bug->getStatusName();
SC_END

SC_BEGIN BUG3_BUG_DELETED
   global $bug;
   return $bug->getDeleted(BUGC_UI)==0 ? "" : BUG_LAN_LABEL_DELETED;
SC_END

SC_BEGIN BUG3_BUG_RELATED_BUGS_LIST
   // TODO make this more themable
   // TODO, need to not wrap in a DIV if getting from AJAX request
   global $app, $bug, $dao, $bugtracker3, $tp;
   parse_str($parm, $parms);
   $relatedList = $dao->getRelatedBugs($bug->getId());
   $text .= "<div id='bugtracker3_relationsdiv'>";

   $text .= "<table style='width:100%;'>";
   if (count($relatedList) > 0) {
      foreach ($relatedList as $related) {
         $text .= "<tr>";
         if ($related->getPrimaryid() == $bug->getId()) {
            $reltxt = $related->getPrimaryRelationshipText();
            $relid = $related->getSecondaryId();
         } else {
            $reltxt = $related->getSecondaryRelationshipText();
            $relid = $related->getPrimaryId();
         }
         if (array_key_exists("editmode", $parms)) {
            $text .= "<td style='width:5%;'>";
            $text .= "<img type='image' style='cursor:pointer' src='".e_IMAGE."admin_images/delete_16.png' ";
            $text .= "onclick=\"if (jsconfirm('".$tp->toJS(BUG_LAN_RELATIONSHIP_DEL_Q.$relid)."')) {bugtracker3Helper.deleteRelation(".$relid.");} \"  ";
            $text .= "title='".BUG_LAN_RELATIONSHIP_DEL."' style='border:0px' /></td>";
         }
         $text .= "<td>$reltxt</td><td>";
         if (varset($pref["bugtracker3_ajax"], false)) {
            $text .= "<a href='#' onclick=bugtracker3Helper.queryURL('2.$relid');>";
         } else {
            $text .= "<a href='".BUGC_SELF."?2.$relid'>";
         }
         $text .= "#$relid</td><td>";
         $relbug = $dao->getBug($relid);
         $text .= $relbug->getSummary();
         $text .= "</td></tr>";
      }
   } else {
      $text .= "<tr><td>".BUG_LAN_MSG_NO_RELATIONSHIPS."</td></tr>";
   }
   $text .= "</table>";

   if (array_key_exists("editmode", $parms)) {
      $text .= "<hr style='width:75%;'/>";
      // TODO Hard coded relationships for now
      $text .= "<select class='tbox' id='bugtracker3_rels_relationship'>";
      $text .= "<option value='0'>".BUG_LAN_RELATION_0."</option>";
      $text .= "<option value='1'>".BUG_LAN_RELATION_1."</option>";
      $text .= "<option value='2'>".BUG_LAN_RELATION_2."</option>";
      $text .= "<option value='3'>".BUG_LAN_RELATION_3."</option>";
      $text .= "</select>";

      $text .= "<select class='tbox' id='bugtracker3_rels_secondary_id'>";
      $buglist = $dao->getBugList($bug->getApplicationId());
      $anapp = $dao->getApp($bug->getApplicationId());
      $text .= "<optgroup class='smallblacktext' label='".$anapp->getName()."'>";
      foreach ($buglist as $abug) {
         if ($abug->getID() != $bug->getId()) {
            $text .= "<option value='".$abug->getID()."'>";
            $text .= "#".$abug->getId()." - ".$temp;
            // TODO add a method to get combine ID and Summary
            $text .= $tp->html_truncate($tp->post_toHTML($abug->getSummary(), true), 20, "");
            $text .= "</option>";
         }
      }
      $text .= "</optgroup>";
      if (array_key_exists("allbugs", $parms)) {
         $applist = $dao->getAppList();
         foreach ($applist as $anapp) {
            $buglist = $dao->getBugList($anapp->getId());
            $text .= "<optgroup class='smallblacktext' label='".$anapp->getName()."'>";
            foreach ($buglist as $abug) {
               if ($abug->getID() != $bug->getId()) {
                  $text .= "<option value='".$abug->getID()."'>";
                  $text .= "#".$abug->getId()." - ".$temp;
                  // TODO add a method to get combine ID and Summary
                  $text .= $tp->html_truncate($tp->toForm($abug->getSummary(), true), 20, "");
                  $text .= "</option>";
               }
            }
            $text .= "</optgroup>";
         }
      }
      $text .= "</select>";
      $text .= "<input class='button' type='button' value='".BUG_LAN_LABEL_ADD_RELATED."' onclick='bugtracker3Helper.updateRelation()'/>";
   }
   $text .= "</div>";
   return $text;
SC_END

SC_BEGIN BUG3_BUG_SUMMARY
   global $bug, $bugtracker3, $tp;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      if (varset($pref["bugtracker3_ajax"], false)) {
         $text .= "<a href='#' onclick=bugtracker3Helper.queryURL('".BUGC_BUG_PAGE.".".$bug->getId()."');>";
      } else {
         $text .= "<a href='".BUGC_SELF."?".BUGC_BUG_PAGE.".".$bug->getId()."'>";
      }
   }
   if (array_key_exists("tooltip", $parms)) {
      $text .= "<span".$bugtracker3->getTooltip($bug->getDescription()).">".$bug->getSummary()."</span>";
   } else {
      $text .= $bug->getSummary();
   }
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN BUG3_BUG_COMMENTS
   global $bug, $e107Helper;
   return $e107Helper->getComment("bugtrack3", $bug->getId());
SC_END

// ******************************************************************************************
// Submit/Edit bug
// ******************************************************************************************
SC_BEGIN BUG3_BUG_APPLICATION_EDIT
   global $app, $bug, $dao, $bugtracker3;
   parse_str($parm, $parms);
   $appList = $dao->getAppList();
   $attributes = "";
   if (array_key_exists("class", $parms)) {
      $attributes .= " class='".$parms["class"]."'";
   }
   $text .= "<select name='".BUGC_POST_ARRAY."[ui_application_id]'$attributes>";
   foreach ($appList as $id => $anapp) {
      $selected = "";
      if (isset($bug) && $id == $bug->getApplicationId(BUGC_UI)) {
         $selected = " selected='selected'";
      }
      $text .= "<option value='$id'$selected>".$anapp->getName()."</option>";
   }
   $text .= "</select>";
   return $text;
SC_END

SC_BEGIN BUG3_BUG_SUMMARY_EDIT
   global $bug, $tp;
   parse_str($parm, $parms);
   $attributes = "";
   if (array_key_exists("class", $parms)) {
      $attributes .= " class='".$parms["class"]."'";
   }
   if (array_key_exists("size", $parms)) {
      $attributes .= " size='".$parms["size"]."'";
   }
   $text .= "";
   $text .= "<input type='text' name='".BUGC_POST_ARRAY."[ui_summary]'$attributes maxlength='255' value='";
   $text .= $tp->toForm($bug->getSummary(BUGC_UI), false);
   $text .= "'/>";
   return $text;
SC_END

SC_BEGIN BUG3_BUG_DESCRIPTION_EDIT
   global $bug, $e107Helper, $pref, $tp;
   parse_str($parm, $parms);
   $attributes = "";
   if (array_key_exists("class", $parms)) {
      $attributes .= " class='".$parms["class"]."'";
   }
   if (array_key_exists("rows", $parms)) {
      $attributes .= " rows='".$parms["rows"]."'";
   }
   if (array_key_exists("cols", $parms)) {
      $attributes .= " cols='".$parms["cols"]."'";
   }
   if (array_key_exists("width", $parms)) {
      $attributes .= " width='".$parms["width"]."'";
   }
   $text .= "";
   $value = $tp->toForm($bug->getDescription(BUGC_UI), false);
   $text .= $e107Helper->getTextarea($value, "".BUGC_POST_ARRAY."[ui_description]", $parms["class"], $parms["rows"], $parms["cols"], $parms["width"], $pref['bugtracker3_bbcodes'], $pref['bugtracker3_emoticons']);
   return $text;
SC_END

SC_BEGIN BUG3_BUG_FOUND_IN_VERSION_EDIT
   global $app, $bug, $dao, $bugtracker3;
   parse_str($parm, $parms);

   if (array_key_exists("past", $parms)) {
      $versionList = $dao->getVersions($app->getId(), $app->getCurrentVersion(), BUGC_BEFORE);
   } else {
      $versionList = $dao->getVersions($app->getId());
   }
   $attributes = "";
   $text .= "";
   if (array_key_exists("class", $parms)) {
      $attributes .= " class='".$parms["class"]."'";
   }
   $text .= "<select name='".BUGC_POST_ARRAY."[ui_found_in_version]'$attributes>";
   foreach ($versionList as $id => $version) {
      $selected = "";
      if (isset($bug) && $id == $bug->getFoundInVersionId(BUGC_UI)) {
         $selected = " selected='selected'";
      }
      $text .= "<option value='$id'$selected>".$version->getVersion()."</option>";
   }
   $text .= "</select>";
   if ($bugtracker3->getMode() == BUGC_EDIT_BUG_PAGE && !array_key_exists($bug->getFoundInVersionId(BUGC_UI), $versionList)) {
      $text .= "&nbsp;<img align='top' type='image' style='cursor:pointer' src='".e_IMAGE."fileinspector/warning.png'> ";
   }
   return $text;
SC_END

SC_BEGIN BUG3_BUG_FIXED_IN_VERSION_EDIT
   global $app, $bug, $dao, $bugtracker3;
   parse_str($parm, $parms);
   $versionList = $dao->getVersions($app->getId());
   $attributes = "";
   $text .= "";
   if (array_key_exists("class", $parms)) {
      $attributes .= " class='".$parms["class"]."'";
   }
   $text .= "<select name='".BUGC_POST_ARRAY."[ui_fixed_in_version]'$attributes>";
   if (array_key_exists("includeblank", $parms)) {
      $selected = $bug->getFoundInVersionId(BUGC_UI)==0 ? "selected='selected'" : "";
      $text .= "<option value='0'$selected> </option>";
   }
   foreach ($versionList as $id => $version) {
      $selected = "";
      if (isset($bug) && $id == $bug->getFixedInVersionId(BUGC_UI)) {
         $selected = " selected='selected'";
      }
      $text .= "<option value='$id'$selected>".$version->getVersion()."</option>";
   }
   $text .= "</select>";
   if ($bugtracker3->getMode() == BUGC_EDIT_BUG_PAGE && !array_key_exists($bug->getFixedInVersionId(BUGC_UI), $versionList) && $bug->getFixedInVersionId(BUGC_UI) != 0) {
      $text .= "&nbsp;<img align='top' type='image' style='cursor:pointer' src='".e_IMAGE."fileinspector/warning.png'> ";
   }
   return $text;
SC_END

SC_BEGIN BUG3_BUG_OWNER_EDIT
   global $app, $bug, $sql;
   parse_str($parm, $parms);
   $attributes = "";
   if (array_key_exists("class", $parms)) {
      $attributes .= " class='".$parms["class"]."'";
   }
   $text .= "<select name='".BUGC_POST_ARRAY."[ui_owner]'$attributes>";
   $sql->db_Select("user", "*", "order by user_name", "no-where"); // TODO move to DAO
   while($row = $sql->db_Fetch()) {
      if (!$row["user_ban"]) {
         $selected = "";
         if (isset($bug) && $row["user_id"] == $bug->getOwnerId(BUGC_UI)) {
            $selected = " selected='selected'";
         }
         $text .= "<option value='".$row["user_id"]."'$selected>".$row["user_name"]."</option>";
      }
   }
   $text .= "</select>";
   return $text;
SC_END

SC_BEGIN BUG3_BUG_CATEGORY_EDIT
   global $app, $bug, $bugtracker3;
   parse_str($parm, $parms);
   $categoryList = $app->getCategoryList();
   $attributes = "";
   if (array_key_exists("class", $parms)) {
      $attributes .= " class='".$parms["class"]."'";
   }
   $text .= "<select name='".BUGC_POST_ARRAY."[ui_category]'$attributes>";
   $tooltip = "";
   foreach ($categoryList as $id => $category) {
      $selected = "";
      if (isset($bug) && $id == $bug->getCategoryId(BUGC_UI)) {
         $selected = " selected='selected'";
      }
      $text .= "<option value='$id'$selected>".$category->getName()."</option>";
      $tooltip .= "&bull;<strong>".$category->getName()."</strong><br/>";
      $tooltip .= "&nbsp;".$category->getDescription()."<br/>";
   }
   $text .= "</select>";
   if (array_key_exists("tooltip", $parms)) {
      $text .= $bugtracker3->getTooltip($tooltip, BUG_LAN_LABEL_CATEGORY, true);
   }
   if ($bugtracker3->getMode() == BUGC_EDIT_BUG_PAGE && !array_key_exists($bug->getCategoryId(BUGC_UI), $categoryList)) {
      $text .= "&nbsp;<img align='top' type='image' style='cursor:pointer' src='".e_IMAGE."fileinspector/warning.png'> ";
   }
   return $text;
SC_END

SC_BEGIN BUG3_BUG_PRIORITY_EDIT
   global $app, $bug, $bugtracker3;
   parse_str($parm, $parms);
   $priorityList = $app->getPriorityList();
   $attributes = "";
   if (array_key_exists("class", $parms)) {
      $attributes .= " class='".$parms["class"]."'";
   }
   $text .= "<select name='".BUGC_POST_ARRAY."[ui_priority]'$attributes>";
   $tooltip = "";
   foreach ($priorityList as $id => $priority) {
      $selected = "";
      if (isset($bug) && $id == $bug->getPriorityId(BUGC_UI)) {
         $selected = " selected='selected'";
      }
      $text .= "<option value='$id'$selected>".$priority->getName()."</option>";
      $tooltip .= "&bull;<strong>".$priority->getName()."</strong><br/>";
      $tooltip .= "&nbsp;".$priority->getDescription()."<br/>";
   }
   $text .= "</select>";
   if (array_key_exists("tooltip", $parms)) {
      $text .= $bugtracker3->getTooltip($tooltip, BUG_LAN_LABEL_PRIORITY, true);
   }
   if ($bugtracker3->getMode() == BUGC_EDIT_BUG_PAGE && !array_key_exists($bug->getPriorityId(BUGC_UI), $priorityList)) {
      $text .= "&nbsp;<img align='top' type='image' style='cursor:pointer' src='".e_IMAGE."fileinspector/warning.png'> ";
   }
   return $text;
SC_END

SC_BEGIN BUG3_BUG_RESOLUTION_EDIT
   global $app, $bug, $bugtracker3;
   parse_str($parm, $parms);
   $resolutionList = $app->getResolutionList();
   $attributes = "";
   if (array_key_exists("class", $parms)) {
      $attributes .= " class='".$parms["class"]."'";
   }
   $text .= "<select name='".BUGC_POST_ARRAY."[ui_resolution]'$attributes>";
   $tooltip = "";
   foreach ($resolutionList as $id => $resolution) {
      $selected = "";
      if (isset($bug) && $id == $bug->getResolutionId(BUGC_UI)) {
         $selected = " selected='selected'";
      }
      $text .= "<option value='$id'$selected>".$resolution->getName()."</option>";
      $tooltip .= "&bull;<strong>".$resolution->getName()."</strong><br/>";
      $tooltip .= "&nbsp;".$resolution->getDescription()."<br/>";
   }
   $text .= "</select>";
   if (array_key_exists("tooltip", $parms)) {
      $text .= $bugtracker3->getTooltip($tooltip, BUG_LAN_LABEL_RESOLUTION, true);
   }
   if ($bugtracker3->getMode() == BUGC_EDIT_BUG_PAGE && !array_key_exists($bug->getResolutionId(BUGC_UI), $resolutionList)) {
      $text .= "&nbsp;<img align='top' type='image' style='cursor:pointer' src='".e_IMAGE."fileinspector/warning.png'> ";
   }
   return $text;
SC_END

SC_BEGIN BUG3_BUG_STATUS_EDIT
   global $app, $bug, $bugtracker3;
   parse_str($parm, $parms);
   $statusList = $app->getStatusList();
   $attributes = "";
   if (array_key_exists("class", $parms)) {
      $attributes .= " class='".$parms["class"]."'";
   }
   $text .= "<select name='".BUGC_POST_ARRAY."[ui_status]'$attributes>";
   $tooltip = "";
   foreach ($statusList as $id => $status) {
      $selected = "";
      if (isset($bug) && $id == $bug->getStatusId(BUGC_UI)) {
         $selected = " selected='selected'";
      }
      $text .= "<option value='$id'$selected>".$status->getName()."</option>";
      $tooltip .= "&bull;<strong>".$status->getName()."</strong><br/>";
      $tooltip .= "&nbsp;".$status->getDescription()."<br/>";
   }
   $text .= "</select>";
   if (array_key_exists("tooltip", $parms)) {
      $text .= $bugtracker3->getTooltip($tooltip, BUG_LAN_LABEL_STATUS, true);
   }
   if ($bugtracker3->getMode() == BUGC_EDIT_BUG_PAGE && !array_key_exists($bug->getStatusId(BUGC_UI), $statusList)) {
      $text .= "&nbsp;<img align='top' type='image' style='cursor:pointer' src='".e_IMAGE."fileinspector/warning.png'> ";
   }
   return $text;
SC_END

SC_BEGIN BUG3_BUG_DELETED_EDIT
   global $bug;
   parse_str($parm, $parms);
   $attributes = "";
   if (array_key_exists("class", $parms)) {
      $attributes .= " class='".$parms["class"]."'";
   }

   $deleted0checked = $bug->getDeleted(BUGC_UI)==0 ? " checked='true'" : "";
   $deleted1checked = $bug->getDeleted(BUGC_UI)==1 ? " checked='true'" : "";
   $text .= "<label for='bugtracker3_deleted0'><input type='radio' name='".BUGC_POST_ARRAY."[ui_deleted]' id='bugtracker3_deleted0' value='0'$deleted0checked/>".BUG_LAN_LABEL_VISIBLE."</label>";
   $text .= "<label for='bugtracker3_deleted1'><input type='radio' name='".BUGC_POST_ARRAY."[ui_deleted]' id='bugtracker3_deleted1' value='1'$deleted1checked/>".BUG_LAN_LABEL_DELETED."</label>";
   return $text;
SC_END

SC_BEGIN BUG3_BUG_SUBMIT_BUTTON
   return "<input type='submit' class='button' value='".BUG_LAN_LABEL_SUBMIT."'/>";
SC_END

SC_BEGIN BUG3_BUG_UPDATE_BUTTON
   return "<input type='submit' class='button' value='".BUG_LAN_LABEL_UPDATE."'/>";
SC_END

SC_BEGIN BUG3_BUG_MOVE_BUTTON
   return "<input type='submit' class='button' value='".BUG_LAN_LABEL_MOVE."'/>";
SC_END

SC_BEGIN BUG3_BUG_TOTAL_ALL
   global $dao, $bugtracker3;
   return $dao->getBugCount();
SC_END

// ******************************************************************************************
// Menus
// ******************************************************************************************
SC_BEGIN BUG3_MENU_APPLICATION_TITLE
   global $app, $pref;
   if (isset($app)) {
      return varset($pref["bugtracker3_menu_application_title"], BUG3_MENU_APPLICATION_TITLE_DEFAULT);
   }
   return "";
SC_END

SC_BEGIN BUG3_MENU_SUMMARY_TITLE
   global $pref;
   return varset($pref["bugtracker3_menu_summary_title"], BUG3_MENU_SUMMARY_TITLE_DEFAULT);
SC_END

// ******************************************************************************************
// Errors and warnings
// ******************************************************************************************
SC_BEGIN BUG3_STATUS_INFO
   global $bugStatusInfo;
   $text = "";
   if (isset($bugStatusInfo) && $bugStatusInfo !== false) {
      $text .= "<div>";
      $text .= $bugStatusInfo->getLevelDescription();
      for ($i=0; $i < $bugStatusInfo->getMessageCount(); $i++) {
         if ($bugStatusInfo->hasAdditionalDetails($i)) {
            $attributes = " style='cursor:pointer;' onclick='expandit(this);";
         }
         $text .= "<div $attributes'>".$bugStatusInfo->getMessage($i)."</div><div></div>";
         if ($bugStatusInfo->hasAdditionalDetails($i)) {
            $text .= "<div style='display:none;margin-left:10px'>".$bugStatusInfo->getAdditionalDetails($i)."</div>";
         }
      }
      $text .= "</div>";
   }
   return $text;
SC_END

SC_BEGIN BUG3_LAN_MSG_NAV_ERROR
   return "<a href='".BUGC_SELF."'>".BUG_LAN_MSG_NAV_ERROR."</a>";
SC_END

*/
?>
