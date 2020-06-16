<?php
/*
+---------------------------------------------------------------+
| Auction by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/auction/auction_shortcodes.php,v $
| $Revision: 1.4 $
| $Date: 2008/06/28 05:41:07 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
if (!isset($tp)) {
   $tp = new e_parse();
   $tp->e_sc = new e_shortcode();
}
global $auc_shortcodes;
$auc_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
/*
// ************************************************************************************************
// Section Templates
// These template shortcodes have a matching variable in the shortcodes file, they define major
// sections of a page. Sections can be 'glued' together to make the whole page.
// ************************************************************************************************
SC_BEGIN AUC_NAV_BAR
   global $auc_shortcodes, $pref, $tp, $AUC_NAV_BAR;
   return $tp->parseTemplate($AUC_NAV_BAR, FALSE, $auc_shortcodes);
SC_END

SC_BEGIN AUC_SEARCH_BAR
   global $auc_shortcodes, $pref, $tp, $AUC_SEARCH_BAR;
   return $tp->parseTemplate($AUC_SEARCH_BAR, FALSE, $auc_shortcodes);
SC_END

SC_BEGIN AUC_AUCTION_INFO
   global $auc_shortcodes, $pref, $tp, $AUC_AUCTION_INFO;
   return $tp->parseTemplate($AUC_AUCTION_INFO, FALSE, $auc_shortcodes);
SC_END

SC_BEGIN AUC_LOT
   global $auc_shortcodes, $pref, $tp, $AUC_LOT;
   return $tp->parseTemplate($AUC_LOT, FALSE, $auc_shortcodes);
SC_END

SC_BEGIN AUC_LOT_SUBMIT
   global $auc, $aucUser, $auc_shortcodes, $tp, $AUC_LOT_SUBMIT;
   $text = "";
   if ($aucUser->canEditAuction($auc->getId())) {
      $text .= "<form id='submitauc' method='post' action=".AUCC_SELF."?".AUCC_SUBMIT_LOT_PAGE.".".$auc->getId()." enctype='multipart/form-data'>";
      $text .= $tp->parseTemplate($AUC_LOT_SUBMIT, FALSE, $auc_shortcodes);
      $text .= "</form>";
   } else {
      $text .= $tp->parseTemplate("{AUC_LAN_MSG_NAV_ERROR}", FALSE, $auc_shortcodes);
   }
   return $text;
SC_END

SC_BEGIN AUC_LOT_EDIT
   global $auc, $lot, $aucUser, $auc_shortcodes, $tp, $AUC_LOT_EDIT;
   $text = "";
   if ($aucUser->canEditAuction($auc->getId())) {
      $text .= "<form id='editauc' method='post' action=".AUCC_SELF."?".AUCC_EDIT_LOT_PAGE.".".$lot->getId().">";
      $text .= "<input type='hidden' id='auction_aucid' value='".$auc->getId()."'/>";
      $text .= $tp->parseTemplate($AUC_LOT_EDIT, FALSE, $auc_shortcodes);
      $text .= "</form>";
   } else {
      $text .= $tp->parseTemplate("{AUC_LAN_MSG_NAV_ERROR}", FALSE, $auc_shortcodes);
   }
   return $text;
SC_END

SC_BEGIN AUC_BID_SUBMIT
   global $auc, $auc_shortcodes, $pref, $tp, $AUC_BID_SUBMIT;
   $text = "";
   if ($auc->isOpen()) {
      $text .= "<form>";
      $text .= $tp->parseTemplate($AUC_BID_SUBMIT, FALSE, $auc_shortcodes);
      $text .= "</from>";
   }
   return $text;
SC_END

SC_BEGIN AUC_BID_SUMMARY
   global $auc_shortcodes, $pref, $tp, $AUC_BID_SUMMARY;
   return $tp->parseTemplate($AUC_BID_SUMMARY, FALSE, $auc_shortcodes);
SC_END

SC_BEGIN AUC_BID_HISTORY
   global $auc, $bidlist, $bid, $aucUser, $pref, $tp;
   global $auc_shortcodes, $AUC_BID_HISTORY_HEAD, $AUC_BID_HISTORY_BODY, $AUC_BID_HISTORY_FOOT;
   parse_str($parm, $parms);
   $text = "";
   if (USER) {
      if (!array_key_exists("ajax", $parms)) {
         $text .= "<div id='auction_bid_history'>";
      }
      $text .= $tp->parseTemplate($AUC_BID_HISTORY_HEAD, FALSE, $auc_shortcodes);
   }
   foreach ($bidlist as $bid) {
     if ($aucUser->canEditAuction($auc->getId()) || USER && USERID==$bid->getBidderId()) {
         $text .= $tp->parseTemplate($AUC_BID_HISTORY_BODY, FALSE, $auc_shortcodes);
      }
   }
   if (USER) {
      $text .= $tp->parseTemplate($AUC_BID_HISTORY_FOOT, FALSE, $auc_shortcodes);
      if (!array_key_exists("ajax", $parms)) {
         $text .= "</div>";
      }
   }
   return $text;
SC_END

// ************************************************************************************************
// Shortcodes
// ************************************************************************************************

// Labels - these just get stuff from the language file defined constants
SC_BEGIN AUC_LABEL_AUCTION_NAME
   return AUC_LAN_LABEL_AUCTION_NAME;
SC_END

SC_BEGIN AUC_LABEL_AUCTION_ICON
   return AUC_LAN_LABEL_AUCTION_ICON;
SC_END

SC_BEGIN AUC_LABEL_AUCTION_OPEN
   return AUC_LAN_LABEL_AUCTION_OPEN;
SC_END

SC_BEGIN AUC_LABEL_AUCTION_START_DATE
   return AUC_LAN_LABEL_AUCTION_START_DATE;
SC_END

SC_BEGIN AUC_LABEL_AUCTION_END_DATE
   return AUC_LAN_LABEL_AUCTION_END_DATE;
SC_END

SC_BEGIN AUC_LABEL_AUCTION_TOTAL_ALL
   return AUC_LAN_LABEL_AUCTION_TOTAL_ALL;
SC_END

SC_BEGIN AUC_LABEL_AUC_TOTAL_ALL
   return AUC_LAN_LABEL_AUC_TOTAL_ALL;
SC_END

SC_BEGIN AUC_LABEL_AUCS
   return AUC_LAN_LABEL_AUCS;
SC_END

SC_BEGIN AUC_LABEL_BID_AMOUNT
   return AUC_LAN_LABEL_BID_AMOUNT;
SC_END

SC_BEGIN AUC_LABEL_BID_DATE_TIME
   return AUC_LAN_LABEL_BID_DATE_TIME;
SC_END

SC_BEGIN AUC_LABEL_BID_BIDDER
   return AUC_LAN_LABEL_BID_BIDDER;
SC_END

SC_BEGIN AUC_LABEL_BID_EMAIL
   return AUC_LAN_LABEL_BID_EMAIL;
SC_END

SC_BEGIN AUC_LABEL_LAST_BID_AMOUNT
   return AUC_LAN_LABEL_LAST_BID_AMOUNT;
SC_END

SC_BEGIN AUC_LABEL_LAST_BID_DATE_TIME
   return AUC_LAN_LABEL_LAST_BID_DATE_TIME;
SC_END

SC_BEGIN AUC_LABEL_BID_HISTORY
   global $auc, $aucUser;
   if ($aucUser->canEditAuction($auc->getId())) {
      return AUC_LAN_LABEL_BID_HISTORY;
   } else {
      return AUC_LAN_LABEL_BID_HISTORY_PERSONAL;
   }
SC_END

SC_BEGIN AUC_LABEL_BID_NAME
   return AUC_LAN_LABEL_BID_NAME;
SC_END

SC_BEGIN AUC_LABEL_BID_SUBMIT
   return AUC_LAN_LABEL_BID_SUBMIT;
SC_END

SC_BEGIN AUC_LABEL_BID_SUMMARY
   return AUC_LAN_LABEL_BID_SUMMARY;
SC_END

SC_BEGIN AUC_LABEL_BID_TELEPHONE
   return AUC_LAN_LABEL_BID_TELEPHONE;
SC_END

SC_BEGIN AUC_LABEL_DESCRIPTION
   return AUC_LAN_LABEL_DESCRIPTION;
SC_END

SC_BEGIN AUC_LABEL_LOTS
   return AUC_LAN_LABEL_LOTS;
SC_END

SC_BEGIN AUC_LABEL_RESERVE
   return AUC_LAN_LABEL_RESERVE;
SC_END

SC_BEGIN AUC_LABEL_LOT_TITLE
   return AUC_LAN_LABEL_LOT_TITLE;
SC_END

SC_BEGIN AUC_LABEL_ID
   return AUC_LAN_LABEL_ID;
SC_END

SC_BEGIN AUC_LABEL_IMAGES
   return AUC_LAN_LABEL_IMAGES;
SC_END

SC_BEGIN AUC_LABEL_IMAGES
   return AUC_LAN_LABEL_IMAGES;
SC_END

SC_BEGIN AUC_LABEL_MANDATORY
   return AUC_LAN_LABEL_MANDATORY;
SC_END

SC_BEGIN AUC_LABEL_MANDATORY_SYMBOL
   return AUC_LAN_LABEL_MANDATORY_SYMBOL;
SC_END

SC_BEGIN AUC_LABEL_OWNER
   return AUC_LAN_LABEL_OWNER;
SC_END

SC_BEGIN AUC_LABEL_POSTER
   return AUC_LAN_LABEL_POSTER;
SC_END

SC_BEGIN AUC_LABEL_LAST_UPDATE_POSTER
   return AUC_LAN_LABEL_LAST_UPDATE_POSTER;
SC_END

SC_BEGIN AUC_LABEL_LAST_UPDATE_DATE_TIME
   return AUC_LAN_LABEL_LAST_UPDATE_DATE_TIME;
SC_END

SC_BEGIN AUC_LABEL_DELETED
   return AUC_LAN_LABEL_DELETED;
SC_END

// ******************************************************************************************
// Navigation bar
// ******************************************************************************************
SC_BEGIN AUC_NAV_BAR_SUBMIT_BUTTON
   global $auction, $auc, $aucUser, $pref;
   if ($auction->getMode() != AUCC_SUBMIT_LOT_PAGE && isset($auc) && $aucUser->canEditAuction($auc->getId())) {
      $value = AUC_LAN_JUMPLIST_SUBMIT;
      return "<input type='button' class='button' onclick='document.location=\"".AUCC_SELF."?".AUCC_SUBMIT_LOT_PAGE.".".$auc->getId()."\";' value='$value'/>";
   }
   return "";
SC_END

SC_BEGIN AUC_NAV_BAR_EDIT_BUTTON
   global $auction, $auc, $lot, $auction, $aucUser, $pref;
   if ($auction->getMode() != AUCC_EDIT_LOT_PAGE && $auction->getMode() != AUCC_SUBMIT_LOT_PAGE && isset($lot) && $aucUser->canEditAuction($auc->getId())) {
      $value = AUC_LAN_JUMPLIST_EDIT;
      return "<input type='button' class='button' onclick='document.location=\"".AUCC_SELF."?".AUCC_EDIT_LOT_PAGE.".".$lot->getId()."\";' value='$value'/>";
   }
   return "";
SC_END

SC_BEGIN AUC_NAV_BAR_AUCTIONS_LIST_BUTTON
   global $auction, $auc, $aucUser, $pref;
   if (isset($auc)) {
      return "<input type='button' class='button' onclick='document.location=\"".AUCC_SELF."\";' value='".AUC_LAN_JUMPLISTAUCTIONS_LIST."'/>";
   }
   return "";
SC_END

SC_BEGIN AUC_NAV_BAR_LOT_LIST_BUTTON
   global $auction, $auc, $lot, $aucUser, $pref;
   if (isset($lot)) {
      $value = AUC_LAN_JUMPLIST_AUC_LIST;
      return "<input type='button' class='button' onclick='document.location=\"".AUCC_SELF."?".AUCC_LOTS_PAGE.".".$auc->getId()."\";' value='$value'/>";
   }
   return "";
SC_END

SC_BEGIN AUC_NAV_BAR_JUMP_LIST
   global $auction, $auc, $lot, $dao, $auclist, $auction, $aucUser, $pref;

   parse_str($parm, $parms);
   $text = AUC_LAN_JUMPLIST_LABEL;
   $text .= "&nbsp;<select class='tbox' onchange='if (this.value!=\"...\") document.location=\"".AUCC_SELF."?\"+this.value;'>";
   $text .= "<option value='...'>".AUC_LAN_JUMPLIST_SELECT."</option>";
   if (!array_key_exists("hidejumps", $parms)) {
      // Jump to pages
      if (!isset($auclist)) {
         $text .= "<optgroup class='smallblacktext' label='".AUC_LAN_JUMPLIST_JUMP_TO."'>";
         $text .= "<option value=''>".AUC_LAN_JUMPLISTAUCTIONS_LIST."</option>";
         // Check to see if user can post lots to this app
         if (isset($auc)) {
            if (isset($auc)) {
               $value = AUC_LAN_JUMPLIST_AUC_LIST;
               if ($auction->getMode() != AUCC_LOTS_PAGE) {
                  $text .= "<option value='".AUCC_LOTS_PAGE.".".$auc->getId()."'>$value</option>";
               }
               if ($auction->getMode() != AUCC_EDIT_LOT_PAGE && $auction->getMode() != AUCC_SUBMIT_LOT_PAGE && isset($lot) && $aucUser->canEditAuction($auc->getId())) {
                  $value = AUC_LAN_JUMPLIST_EDIT;
                  $text .= "<option value='".AUCC_EDIT_LOT_PAGE.".".$lot->getId()."'>$value</option>";
               }
            }
            if ($auction->getMode() != AUCC_SUBMIT_LOT_PAGE && $aucUser->canEditAuction($auc->getId())) {
               $value = AUC_LAN_JUMPLIST_SUBMIT;
               $text .= "<option value='".AUCC_SUBMIT_LOT_PAGE.".".$auc->getId()."'>$value</option>";
            }
         }
      }
      $text .= "</optgroup>";
   }

   // auctions
   if (!isset($auclist)) {
      $auclist = $dao->getAuctionList();
   }
   if (count($auclist) > 0) {
      $text .= "<optgroup class='smallblacktext' label='".AUC_LAN_JUMPLIST_AUCTIONS."'>";
      foreach ($auclist as $anauc) {
         if ($aucUser->canViewAuction($anauc->getId())) {
            $text .= "<option class='smalltext' value='1.".$anauc->GetId()."'>".$anauc->GetName()."</option>";
         }
      }
      $text .= "</optgroup>";
   }

   // lots
   if (!array_key_exists("hidelots", $parms)) {
      if (isset($auc)) {
         if (!isset($lotlist)) {
            $lotlist = $dao->getLotList($auc->getId());
         }
         if (count($lotlist) > 0) {
            $text .= "<optgroup class='smallblacktext' label='".AUC_LAN_JUMPLIST_LOTS."'>";
            foreach ($lotlist as $alot) {
               $text .= "<option class='smalltext' value='2.".$alot->GetId()."'>".$alot->getTitle(false, AUCC_TRUNC)."</option>";
            }
            $text .= "</optgroup>";
         }
      }
   }

   $text .= "</select>";
   return $text;
SC_END

// ******************************************************************************************
// Search bar
// ******************************************************************************************
SC_BEGIN AUC_SEARCH_BAR_SEARCH_FIELD
   parse_str($parm, $parms);
   $text = "<form method='get' action='../../search.php'>";
   $text .= AUC_LAN_LABEL_SEARCH;
   $text .= " <input class='tbox search' type='text' name='q' size='20' value='' maxlength='50'/>";
   $text .= "<input type='hidden' name='r' value='0'/>";
   $text .= "<input type='hidden' name='t' value='auction'/>";
   if (array_key_exists("showbutton", $parms)) {
      $text .= "&nbsp;<input type='submit' class='button' name='submit' value='".AUC_LAN_LABEL_SEARCH_GO."'/>";
   }
   $text .= "</form>";
   return $text;
SC_END

// ******************************************************************************************
// Auctions
// ******************************************************************************************
SC_BEGIN AUC_AUCTION_LOTS
   global $auc;
   return $auc->getLotTotal();
SC_END

SC_BEGIN AUC_AUCTION_ID
   global $auc;
   return $auc->getId();
SC_END

SC_BEGIN AUC_AUCTION_NAME
   global $auc, $e107Helper, $pref;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("hidden", $parms)) {
      $text .= "<input type='hidden' name='".AUCC_POST_ARRAY."[ui_auction_id]' value='".$auc->getId()."'/>";
   }
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".AUCC_SELF."?".AUCC_LOTS_PAGE.".".$auc->getId()."'>";
   }
   $text .= $auc->getName();
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   if (!$auc->isOpen()) {
      if ($auc->isFinished()) {
         $text .= " [".AUC_LAN_LABEL_CLOSED."]";
      } else {
         $text .= " [".AUC_LAN_LABEL_NOT_OPEN."]";
      }
   }
   return $text;
SC_END

SC_BEGIN AUC_AUCTION_ICON
   global $auction, $auc, $tp;
   parse_str($parm, $parms);
   if ("" == $icon = $auc->getIcon()) {
      return " ";
   }
   $name = $tp->post_toForm($auc->getName(), true);
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".AUCC_SELF."?".AUCC_LOTS_PAGE.".".$auc->getId()."'>";
   }
   $text .= "<img src='".$auc->getIcon()."' title='$name' border='0' alt='$name'";
   if (array_key_exists("tooltip", $parms)) {
      $text .= $auction->getTooltip($auc->getDescription(), $auc->getName());
   }
   $text .= "/>";
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN AUC_AUCTION_DESCRIPTION
   global $auc, $tp;
   return $tp->toHTML($auc->getDescription(), true);
SC_END

SC_BEGIN AUC_AUCTION_START_DATE
   global $auc;
   parse_str($parm, $parms);
   $gen = new convert();
   if (array_key_exists("short", $parms)) {
      $text .= str_replace(" ", "&nbsp;", $gen->convert_date($auc->getStartDate(), "short"));
   } else {
      $text .= $gen->convert_date($auc->getStartDate(), "long");
   }
   return $text;
SC_END

SC_BEGIN AUC_AUCTION_END_DATE
   global $auc;
   parse_str($parm, $parms);
   $gen = new convert();
   if (array_key_exists("short", $parms)) {
      $text .= str_replace(" ", "&nbsp;", $gen->convert_date($auc->getEndDate(), "short"));
   } else {
      $text .= $gen->convert_date($auc->getEndDate(), "long");
   }
   return $text;
SC_END

SC_BEGIN AUC_AUCTION_OWNER
   global $auc;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".e_HTTP."user.php?id.".$auc->getOwnerId()."'>";
   }
   $text .= $auc->getOwner();
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN AUC_AUCTION_TOTAL_ALL
   global $dao, $auc;
   return $dao->getAuctionCount();
SC_END

// ******************************************************************************************
// Lots
// ******************************************************************************************
SC_BEGIN AUC_LOT_DATE_TIME
   global $lot;
   $gen = new convert();
   parse_str($parm, $parms);
   if (array_key_exists("short", $parms)) {
      return str_replace(" ", "&nbsp;", $gen->convert_date($lot->getTimestamp(), "short"));
   }
   return $gen->convert_date($lot->getTimestamp(), "long");
SC_END

SC_BEGIN AUC_LOT_LAST_UPDATE_DATE_TIME
   global $lot;
   $gen = new convert();
   parse_str($parm, $parms);
   if (array_key_exists("short", $parms)) {
      return str_replace(" ", "&nbsp;", $gen->convert_date($lot->getUpdateTimestamp(), "short"));
   }
   return $gen->convert_date($lot->getUpdateTimestamp(), "long");
SC_END

SC_BEGIN AUC_LOT_DESCRIPTION
   global $lot, $tp;
   return $tp->toHTML($lot->getDescription(), true);
SC_END

SC_BEGIN AUC_LOT_LOTS
   global $auc, $pref, $tp;
   parse_str($parm, $parms);
   $gen = new convert();
   $text = "";
   $text .= "<div id='auction_bidommentdiv'>";
   if (count($comments) > 0) {
      foreach ($comments as $comment) {
         $text .= "<p><strong>";
         $text .= $gen->convert_date($comment->getTimestamp(), "short");
         $text .= "</strong> (";
         if (array_key_exists("anchor", $parms)) {
            $text .= "<a href='".e_HTTP."user.php?id.".$comment->getPoster()."'>";
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
      $text .= AUC_LAN_MSG_NO_DEV_COMMENTS;
   }
   $text .= "</div>";
   return $text;
SC_END

SC_BEGIN AUC_LOT_LOTS_EDIT
   global $auc, $e107Helper, $pref, $tp;
   $text = "";
   $text .= "<hr style='width:75%;'/>";
   $text .= $e107Helper->getTextarea("", "auction_bid_comment", "tbox", "5", "", "100%", $pref['auction_bbcodes'], $pref['auction_emoticons']);
   $text .= "<br/><input class='button' type='button' value='".AUC_LAN_LABEL_ADD_DEV_COMMENT."' onclick='auctionHelper.addBid()'/>";
   return $text;
SC_END

SC_BEGIN AUC_LOT_ID
   global $auction, $auc, $lot, $aucUser, $tp;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms) && $aucUser->canEditAuction($auc->getId())) {
      $text .= "<a href='".AUCC_SELF."?".AUCC_EDIT_LOT_PAGE.".".$lot->getId()."'>";
   }
   $text .= "#".$lot->getId();
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN AUC_LOT_POSTER
   global $lot;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".e_HTTP."user.php?id.".$lot->getPosterId()."'>";
   }
   $text .= $lot->getPoster();
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN AUC_LOT_LAST_UPDATE_POSTER
   global $lot;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".e_HTTP."user.php?id.".$lot->getUpdatePosterId()."'>";
   }
   $text .= $lot->getUpdatePoster();
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN AUC_LOT_TITLE
   global $auction, $auc, $lot, $tp;
   parse_str($parm, $parms);
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".AUCC_SELF."?".AUCC_LOT_PAGE.".".$lot->getId()."'>";
   }
   $title = $lot->getTitle();
   if (array_key_exists("truncate", $parms)) {
      $title = $tp->html_truncate($title, $parms["truncate"], "...");
   }
   if (array_key_exists("tooltip", $parms)) {
      $text .= "<span".$auction->getTooltip($lot->getDescription()).">$title</span>";
   } else {
      $text .= $title;
   }
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a>";
   }
   return $text;
SC_END

SC_BEGIN AUC_LOT_RESERVE
   global $auction, $auc, $lot, $tp;
   parse_str($parm, $parms);
   $text = "";
   $text .= auction_toCurrency($lot->getReserve());
   return $text;
SC_END

SC_BEGIN AUC_LOT_IMAGES
   global $auction, $auc, $lot, $tp;
   parse_str($parm, $parms);
   if ($lot->getImages() == AUC_LAN_MSG_NO_IMAGE) {
      return AUC_LAN_LABEL_IMAGES_NONE;
   }
   if (array_key_exists("maxwidth", $parms) || array_key_exists("maxheight", $parms)) {
      $size = getimagesize($lot->getImages());
      $w = $size[0];
      $h = $size[1];
      if (array_key_exists("maxwidth", $parms)) {
         $max = $parms["maxwidth"];
         if ($w > $max) {
            $h = intval($h / ($w/$max));
            $w = $max;
         }
      }
      if (array_key_exists("maxheight", $parms)) {
         $max = $parms["maxheight"];
         if ($h > $max) {
            $w = intval($w / ($h/$max));
            $h = $max;
         }
      }
      $attribs = " width='$w' height='$h'";
   }
   $text = "";
   if (array_key_exists("anchor", $parms)) {
      $text .= "<a href='".$lot->getImages()."' target='_blank'>";
   }
   $text .= "<img src='".$lot->getImages()."'border='0'$attribs>";
   if (array_key_exists("anchor", $parms)) {
      $text .= "</a><br/>".AUC_LAN_MSG_CLICK_TO_VIEW;
   }
   return $text;
SC_END

SC_BEGIN AUC_LOT_COMMENTS
   global $auc, $e107Helper;
   return $e107Helper->getComment("auctrack3", $auc->getId());
SC_END

// ******************************************************************************************
// Submit/Edit lot
// ******************************************************************************************
SC_BEGIN AUC_LOT_TITLE_EDIT
   global $lot, $tp;
   parse_str($parm, $parms);
   $attributes = "";
   if (array_key_exists("class", $parms)) {
      $attributes .= " class='".$parms["class"]."'";
   }
   if (array_key_exists("size", $parms)) {
      $attributes .= " size='".$parms["size"]."'";
   }
   $text .= "";
   $text .= "<input type='text' name='".AUCC_POST_ARRAY."[ui_title]'$attributes maxlength='255' value='";
   $text .= $tp->toForm($lot->getTitle(AUCC_UI), false);
   $text .= "'/>";
   return $text;
SC_END

SC_BEGIN AUC_LOT_DESCRIPTION_EDIT
   global $lot, $e107Helper, $pref, $tp;
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
   $value = $tp->toForm($lot->getDescription(AUCC_UI), false);
   $text .= $e107Helper->getTextarea($value, "".AUCC_POST_ARRAY."[ui_description]", $parms["class"], $parms["rows"], $parms["cols"], $parms["width"], $pref['auction_bbcodes'], $pref['auction_emoticons']);
   return $text;
SC_END

SC_BEGIN AUC_LOT_RESERVE_EDIT
   global $lot, $tp;
   parse_str($parm, $parms);
   $attributes = "";
   if (array_key_exists("class", $parms)) {
      $attributes .= " class='".$parms["class"]."'";
   }
   if (array_key_exists("size", $parms)) {
      $attributes .= " size='".$parms["size"]."'";
   }
   $text .= "";
   $text .= "<input type='text' name='".AUCC_POST_ARRAY."[ui_reserve]'$attributes maxlength='10' value='";
   $text .= $tp->toForm($lot->getReserve(AUCC_UI), false);
   $text .= "'/>";
   return $text;
SC_END

SC_BEGIN AUC_LOT_IMAGES_SUBMIT
   global $lot, $tp;
   parse_str($parm, $parms);
   $attributes = "";
   if (array_key_exists("class", $parms)) {
      $attributes .= " class='".$parms["class"]."'";
   }
   if (array_key_exists("size", $parms)) {
      $attributes .= " size='".$parms["size"]."'";
   }
   $text .= "";
   $text .= "<input type='file' name='".AUCC_POST_ARRAY."[ui_images]'$attributes maxlength='255' value='";
   $text .= $tp->toForm($lot->getImages(AUCC_UI), false);
   $text .= "'/>";
   return $text;
SC_END

SC_BEGIN AUC_LOT_IMAGES_EDIT
   global $lot, $tp;
   parse_str($parm, $parms);
   $attributes = "";
   if (array_key_exists("class", $parms)) {
      $attributes .= " class='".$parms["class"]."'";
   }
   if (array_key_exists("size", $parms)) {
      $attributes .= " size='".$parms["size"]."'";
   }
   $text .= "";
   $text .= "<select name='".AUCC_POST_ARRAY."[ui_images]'$attributes>";
   $handle=opendir(AUCC_LOT_IMAGES_DIR);
   $text .= "<option value='".AUC_LAN_MSG_NO_IMAGE."'>".AUC_LAN_MSG_NO_IMAGE."</option>";
   while ($file = readdir($handle)) {
      if (!is_dir($folder.$file)) {
         $selected = $lot->getImages() == AUCC_LOT_IMAGES_DIR.$file ? " selected='true'" : "";
         $text .= "<option value='".AUCC_LOT_IMAGES_DIR.$file."'$selected>".$file."</option>";
      }
   }
   closedir($handle);
   $text .= "</select";
   $text .= $tp->toForm($lot->getImages(AUCC_UI), false);
   $text .= "'/>";
   return $text;
SC_END

SC_BEGIN AUC_LOT_SUBMIT_BUTTON
   return "<input type='submit' class='button' value='".AUC_LAN_LABEL_SUBMIT."'/>";
SC_END

SC_BEGIN AUC_LOT_UPDATE_BUTTON
   return "<input type='submit' class='button' value='".AUC_LAN_LABEL_UPDATE."'/>";
SC_END

SC_BEGIN AUC_LOT_TOTAL_ALL
   global $dao, $auc;
   return $dao->getLotCount();
SC_END

SC_BEGIN AUC_LOT_LAST_BID_DATE_TIME
   global $bidlist;
   parse_str($parm, $parms);
   $gen = new convert();
   $text = "<span id='auction_last_bid_date_time'>";
   if (count($bidlist) == 0) {
      $text .= AUC_LAN_MSG_NO_BIDS;
   } else {
      if ($bid = auction_getTopBid()) {
         if (array_key_exists("short", $parms)) {
            $text .= str_replace(" ", "&nbsp;", $gen->convert_date($bid->getTimestamp(), "short"));
         } else {
            $text .= $gen->convert_date($bid->getTimestamp(), "long");
         }
      }
   }
   $text .= "</span>";
   return $text;
SC_END

SC_BEGIN AUC_LOT_LAST_BID_AMOUNT
   global $bidlist;
   $gen = new convert();
   $text = "<span id='auction_last_bid_amount'>";
   if (count($bidlist) == 0) {
      $text .= "";
   } else {
      if ($bid = auction_getTopBid()) {
         $text .= auction_toCurrency($bid->getAmount());
      }
   }
   $text .= "</span>";
   return $text;
SC_END

// ******************************************************************************************
// Bids
// ******************************************************************************************
SC_BEGIN AUC_BID_DATE_TIME
   global $auc, $bid, $aucUser, $tp;
   parse_str($parm, $parms);
   $gen = new convert();
   if (array_key_exists("short", $parms)) {
      $text .= str_replace(" ", "&nbsp;", $gen->convert_date($bid->getTimestamp(), "short"));
   } else {
      $text .= $gen->convert_date($bid->getTimestamp(), "long");
   }
   $text = auction_strikethrough($bid->isDeleted(), $text);
   if ($aucUser->canEditAuction($auc->getId())) {
      if ($bid->isDeleted()) {
         //$text .= "&nbsp;<img type='image' style='cursor:pointer' src='".e_IMAGE."fileinspector/integrity_pass.png' ";
         //$text .= "onclick=\"if (jsconfirm('".$tp->toJS(AUC_LAN_MSG_ARE_YOU_SURE)."')) {auctionHelper.restoreBid(".$bid->getTimestamp().", ".$bid->getLotId().");} \"  ";
         //$text .= "title='".AUC_LAN_LABEL_BID_RESTORE."' style='border:0px'/>";
      } else {
         $text .= "&nbsp;<img type='image' style='cursor:pointer' src='".e_IMAGE."fileinspector/integrity_fail.png' ";
         $text .= "onclick=\"if (jsconfirm('".$tp->toJS(AUC_LAN_MSG_BID_DEL_ARE_YOU_SURE)."')) {auctionHelper.deleteBid(".$bid->getTimestamp().", ".$bid->getLotId().");} \"  ";
         $text .= "title='".AUC_LAN_LABEL_BID_DELETE."' style='border:0px'/>";
      }
   }
   return $text;
SC_END

SC_BEGIN AUC_BID_AMOUNT
   global $bid;
   $text .= auction_toCurrency($bid->getAmount());
   $text = auction_strikethrough($bid->isDeleted(), $text);
   return $text;
SC_END

SC_BEGIN AUC_BID_BIDDER
   global $bid;
   parse_str($parm, $parms);
   $bidderId .= $bid->getBidderId();
   $text = "";
   if ($bidderId > 0) {
      if (array_key_exists("anchor", $parms)) {
         $text .= "<a href='".e_HTTP."user.php?id.".$bid->getBidderId()."'>".$bid->getBidder()."</a>";
      } else {
         $text .= $bid->getBidder();
      }
   }
   $text = auction_strikethrough($bid->isDeleted(), $text);
   return $text;
SC_END

SC_BEGIN AUC_BID_NAME
   global $bid;
   $text .= $bid->getName();
   $text = auction_strikethrough($bid->isDeleted(), $text);
   return $text;
SC_END

SC_BEGIN AUC_BID_EMAIL
   global $bid;
   $text .= $bid->getEmail();
   $text = auction_strikethrough($bid->isDeleted(), $text);
   return $text;
SC_END

SC_BEGIN AUC_BID_TELEPHONE
   global $bid;
   $text .= $bid->getTelephone();
   $text = auction_strikethrough($bid->isDeleted(), $text);
   return $text;
SC_END

SC_BEGIN AUC_BID_AMOUNT_EDIT
   global $auction, $lot;
   parse_str($parm, $parms);
   $text = "<input type='hidden' class='tbox' name='".AUCC_POST_ARRAY."[ui_lot_id]' id='ui_lot_id' value='".$lot->getId()."'/>";
   $text .= "<input type='text' class='tbox' name='".AUCC_POST_ARRAY."[ui_amount]' id='ui_amount' size='12' maxlength='10' value=''/>";
   if (array_key_exists("tooltip", $parms)) {
      $text .= $auction->getTooltip(AUC_LAN_HELP_BID_AMOUNT, AUC_LAN_LABEL_BID_AMOUNT, true);
   }
   return $text;
SC_END

SC_BEGIN AUC_BID_EMAIL_EDIT
   global $auction;
   parse_str($parm, $parms);
   $value = "";
   if (USER) {
      //$user = getx_user_data(USERID);
      $user = e107::user(USERID);
      $value = $user["user_email"];
   }
   $text = "<input type='text' class='tbox' name='".AUCC_POST_ARRAY."[ui_email]' id='ui_email' size='40' maxlength='255' value='$value'/>";
   if (array_key_exists("tooltip", $parms)) {
      $text .= $auction->getTooltip(AUC_LAN_HELP_BID_EMAIL, AUC_LAN_LABEL_BID_EMAIL, true);
   }
   return $text;
SC_END

SC_BEGIN AUC_BID_NAME_EDIT
   global $auction;
   parse_str($parm, $parms);
   if (USER) {
      //$user = getx_user_data(USERID);
      $user = e107::user(USERID);
      $value = $user["user_login"];
   }
   $text = "<input type='text' class='tbox' name='".AUCC_POST_ARRAY."[ui_name]' id='ui_name' size='30' maxlength='255' value='$value'/>";
   if (array_key_exists("tooltip", $parms)) {
      $text .= $auction->getTooltip(AUC_LAN_HELP_BID_NAME, AUC_LAN_LABEL_BID_NAME, true);
   }
   return $text;
SC_END

SC_BEGIN AUC_BID_TELEPHONE_EDIT
   global $auction;
   parse_str($parm, $parms);
   $text = "<input type='text' class='tbox' name='".AUCC_POST_ARRAY."[ui_telephone]' id='ui_telephone' size='15' maxlength='25' value=''/>";
   if (array_key_exists("tooltip", $parms)) {
      $text .= $auction->getTooltip(AUC_LAN_HELP_BID_TELEPHONE, AUC_LAN_LABEL_BID_TELEPHONE, true);
   }
   return $text;
SC_END

SC_BEGIN AUC_BID_SECURE_IMAGE
   global $pref;
   require_once(e_HANDLER."secure_img_handler.php");
   $sec_img = new secure_image();
   $text = "";
   parse_str($parm, $parms);
   if (array_key_exists("label", $parms)) {
      $text .= "<input type='hidden' name='ui_num' id='ui_num' value='".$sec_img->random_number."'/>";
      $text .= $sec_img->r_image();
   }
   if (array_key_exists("field", $parms)) {
      $text .= "<input class='tbox' type='text' name='ui_verify' id='ui_verify' size='15' maxlength='20' />";
      $text .= AUC_LAN_LABEL_SECURITY_ENTER;
   }
   return $text;
SC_END

SC_BEGIN AUC_BID_SUBMIT_BUTTON
   $value = AUC_LAN_LABEL_BID_SUBMIT;
   return "<input type='submit' class='button' onclick='auctionHelper.submitBid();return false;' value='$value'/>";
SC_END

// ******************************************************************************************
// Menus
// ******************************************************************************************
SC_BEGIN AUC_MENU_AUCTION_TITLE
   global $auc, $pref;
   if (isset($auc)) {
      return varset($pref["auction_menu_application_title"], AUC_MENU_AUCTION_TITLE_DEFAULT);
   }
   return "";
SC_END

SC_BEGIN AUC_MENU_SUMMARY_TITLE
   global $pref;
   return varset($pref["auction_menu_summary_title"], AUC_MENU_SUMMARY_TITLE_DEFAULT);
SC_END

// ******************************************************************************************
// Errors and warnings
// ******************************************************************************************
SC_BEGIN AUC_STATUS_INFO
   global $aucStatusInfo;
   $text = "";
   if (isset($aucStatusInfo) && $aucStatusInfo !== false) {
      $text .= $aucStatusInfo->getLevelDescription();
      for ($i=0; $i < $aucStatusInfo->getMessageCount(); $i++) {
         if ($aucStatusInfo->hasAdditionalDetails($i)) {
            $attributes = " style='cursor:pointer;' onclick='expandit(this);";
         }
         $text .= "<div $attributes'>".$aucStatusInfo->getMessage($i)."</div><div></div>";
         if ($aucStatusInfo->hasAdditionalDetails($i)) {
            $text .= "<div style='display:none;margin-left:10px'>".$aucStatusInfo->getAdditionalDetails($i)."</div>";
         }
      }
   }
   return $text;
SC_END

SC_BEGIN AUC_LAN_MSG_NAV_ERROR
   return "<a href='".AUCC_SELF."'>".AUC_LAN_MSG_NAV_ERROR."</a>";
SC_END

*/
?>
