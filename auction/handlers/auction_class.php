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
| $Source: e:\_repository\e107_plugins/auction/handlers/auction_class.php,v $
| $Revision: 1.3 $
| $Date: 2008/06/28 05:49:49 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Include auction handlers
require_once(e_PLUGIN."auction/handlers/auction_constants.php");

// Data Access Objects
require_once(AUCC_HANDLERS_DIR."auction_DAO.php");

// Model objects
require_once(AUCC_HANDLERS_DIR."auction_auction.php");
require_once(AUCC_HANDLERS_DIR."auction_lot.php");
require_once(AUCC_HANDLERS_DIR."auction_bid.php");
require_once(AUCC_HANDLERS_DIR."auction_user.php");

// Warning and error handling
require_once(AUCC_HANDLERS_DIR."auction_status_info.php");

// Include the e107 Helper classes
if (file_exists(e_PLUGIN."e107helpers/e107Helper.php")) {
   $e107HelperIncludeJS = false;
   $incDHTMLCalendarJS = true;
   require_once(e_PLUGIN."e107helpers/e107Helper.php");
} else {
   print "<h1>Fatal error, cannot find e107Helper class.</h1>";
   print "<p>This plugin requires <b>The e107 Helper Project</b> plugin to be installed.</p>";
   print "<p>Please download it from <a href='http://e107coders.org'>http://e107coders.org</a> and try this plugin again.</p>";
   exit;
}

// Load the shortcodes file - template will be loaded when we know which template to load
require_once(AUCC_PLUGIN_DIR."auction_shortcodes.php");

/**
 * Class used to control all page generation and workflow aspects of auction
 */
class auction {
   // URL parameters (array)
   var $url;
   // Main data Access Object
   var $dao;

   /**
    * Constructor
    */
   function auction() {
      global $auc, $lot;
      $dao = $this->getDAO();

      // Get individual URL parameters, if any, if viewing Auction page
      if (basename(e_SELF) == basename(AUCC_SELF) && e_QUERY){
      	// Separate the url parameters - format is mode.id
      	$this->url = explode(".", e_QUERY);

         // Get auction and lot up front where appropriate
         switch ($this->getMode()) {
            case AUCC_LOTS_PAGE :
            case AUCC_SUBMIT_LOT_PAGE :
               $auc = $dao->getAuction($this->getId());
               break;
            case AUCC_LOT_PAGE :
            case AUCC_EDIT_LOT_PAGE :
               $lot = $dao->getLot($this->getId());
               $auc = $dao->getAuction($lot->getAuctionId());
               break;
         }
      }
   }

   /**
    * Get a reference to the DAO object
    */
   function getDAO() {
      if (!isset($this->dao)) {
         $this->dao = new auctionDAO();
      }
      return $this->dao;
   }

   /**
    * Get the mode that Auction is running in
    */
   function getMode() {
      return $this->url[AUCC_MODE];
   }

   /**
    * Get the URL ID parameter
    */
   function getId() {
      return $this->url[AUCC_ID];
   }

   /**
    * Get the page based on URL parameters
    */
   function generatePage() {
      global $auc, $lot, $aucUser, $dao, $ns, $pref, $tp;
      $dao = $this->getDAO();

      // TODO would be better shortcoded?
      $pagetitle = "<a href='".AUCC_SELF."'>".$pref["auction_pagetitle"]."</a>";

      switch ($this->getMode()) {
         case AUCC_LOTS_PAGE : {
            $pagetitle .= $pref["auction_separator"]."<a href='".AUCC_SELF."?".AUCC_LOTS_PAGE.".".$auc->getId()."'>".$auc->getName()."</a>";
            $pagetitle .= $pref["auction_separator"];
            $pagetitle .= AUC_LAN_LOTS_PAGE_NAME;
            $text = $this->generateLotList();
            break;
         }
         case AUCC_LOT_PAGE : {
            $pagetitle .= $pref["auction_separator"]."<a href='".AUCC_SELF."?".AUCC_LOTS_PAGE.".".$auc->getId()."'>".$auc->getName()."</a>";
            $pagetitle .= $pref["auction_separator"]."<a href='".AUCC_SELF."?".AUCC_LOT_PAGE.".".$lot->getId()."'>".$lot->getTitle(AUCC_DB, AUCC_TRUNC)."</a>";
            $pagetitle .= $pref["auction_separator"];
            $pagetitle .= AUC_LAN_VIEW_LOT_PAGE_NAME;
            $text = $this->generateLotView();
            break;
         }
         case AUCC_SUBMIT_LOT_PAGE : {
            $pagetitle .= $pref["auction_separator"]."<a href='".AUCC_SELF."?".AUCC_LOTS_PAGE.".".$auc->getId()."'>".$auc->getName()."</a>";
            $pagetitle .= $pref["auction_separator"];
            $pagetitle .= AUC_LAN_SUBMIT_LOT_PAGE_NAME;
            if (isset($_REQUEST[AUCC_POST_ARRAY])) {
               $ret = $this->lotSubmit();
               if (get_class($ret) == "auctionStatusInfo") {
                  $text = $this->generateLotSubmit($ret);
               } else {
                  $lot = $dao->getLot($ret);
                  //$this->checkNotifications($auc->getId(), AUC_LAN_NOTIFY_NEW, AUC_LAN_LABEL_DESCRIPTION."<br/><br/>".$auc->getDescription());
                  header("location:".e_SELF."?".AUCC_LOTS_PAGE.".".$this->getId());
                  exit;
               }
            } else {
               $text = $this->generateLotSubmit();
            }
            break;
         }
         case AUCC_EDIT_LOT_PAGE : {
            $pagetitle .= $pref["auction_separator"]."<a href='".AUCC_SELF."?".AUCC_LOTS_PAGE.".".$auc->getId()."'>".$auc->getName()."</a>";
            $pagetitle .= $pref["auction_separator"]."<a href='".AUCC_SELF."?".AUCC_LOT_PAGE.".".$lot->getId()."'>".$lot->getTitle(AUCC_DB, AUCC_TRUNC)."</a>";
            $pagetitle .= $pref["auction_separator"];
            $pagetitle .= AUC_LAN_EDIT_LOT_PAGE_NAME;
            if (isset($_REQUEST[AUCC_POST_ARRAY])) {
               $ret = $this->lotUpdate();
               if (get_class($ret) == "auctionStatusInfo") {
                  $text = $this->generateLotEdit($ret);
               } else {
                  //$this->checkNotifications($auc->getId(), AUC_LAN_NOTIFY_EDIT, AUC_LAN_LABEL_CHANGES."<br/><br/>".$auc->getChanges(true));
                  header("location:".e_SELF."?".AUCC_LOT_PAGE.".".$this->getId());
                  exit;
               }
            } else {
               $text = $this->generateLotEdit();
            }
            break;
         }
         default : {
            $pagetitle .= $pref["auction_separator"].AUC_LAN_AUCTIONS_PAGE_NAME;
            $text = $this->generateAuctionList();
            break;
         }
      }

      define("e_PAGETITLE", $tp->toRss($pagetitle, false));

      return(array($pagetitle, $text));
   }

   // *********************************************************************************************
   // Front end pages
   // *********************************************************************************************

   /**
    * Get the auction list
    */
   function generateAuctionList() {
      global $auc, $auclist, $aucStatusInfo, $dao, $aucUser, $tp;
      global $auc_shortcodes, $AUC_AUCTION_LIST_HEAD, $AUC_AUCTION_LIST_BODY, $AUC_AUCTION_LIST_FOOT;

      $dao = $this->getDAO();
      require_once($this->getTemplate());
      $auclist = $dao->getAuctionList();
      $aucUser = new auctionUser($auclist);
      $list = "";
      if (count($auclist) > 0) {
         $list .= $tp->parseTemplate($AUC_AUCTION_LIST_HEAD, FALSE, $auc_shortcodes);
         foreach ($auclist as $auc) {
            if ($aucUser->canViewAuction($auc->getId())) {
               $list .= $tp->parseTemplate($AUC_AUCTION_LIST_BODY, FALSE, $auc_shortcodes);
            }
         }
      } else {
         $aucStatusInfo = new auctionStatusInfo(STATUS_INFO);
         $aucStatusInfo->addMessage(AUC_LAN_MSG_NO_AUCTIONS, "");
         $list .= $tp->parseTemplate("{AUC_STATUS_INFO}", FALSE, $auc_shortcodes);
         $list .= $tp->parseTemplate($AUC_AUCTION_LIST_HEAD, FALSE, $auc_shortcodes);
      }
      $list .= $tp->parseTemplate($AUC_AUCTION_LIST_FOOT, FALSE, $auc_shortcodes);
      return $list;
   }

   /**
    * Get the lot list for an auction
    */
   function generateLotList() {
      global $auc, $lot, $lotlist, $bidlist, $aucStatusInfo, $dao, $aucUser, $tp;
      global $auc_shortcodes, $AUC_LOT_LIST_HEAD, $AUC_LOT_LIST_BODY, $AUC_LOT_LIST_FOOT, $AUC_NAV_ERROR;
      $dao = $this->getDAO();
      require_once($this->getTemplate($auc));
      $aucUser = new auctionUser($auc);
      if ($aucUser->canViewAuction($auc->getId())) {
         $lotlist = $dao->getLotList($auc->getId());

         $list = "";
         if (count($lotlist) > 0) {
            $list .= $tp->parseTemplate($AUC_LOT_LIST_HEAD, FALSE, $auc_shortcodes);
            foreach ($lotlist as $lot) {
               $bidlist = $dao->getBidList($lot->getId());
               $list .= $tp->parseTemplate($AUC_LOT_LIST_BODY, FALSE, $auc_shortcodes);
            }
         } else {
            $aucStatusInfo = new auctionStatusInfo(STATUS_INFO);
            $aucStatusInfo->addMessage(AUC_LAN_MSG_NO_LOTS, "");
            $list .= $tp->parseTemplate("{AUC_STATUS_INFO}", FALSE, $auc_shortcodes);
            $list .= $tp->parseTemplate($AUC_LOT_LIST_HEAD, FALSE, $auc_shortcodes);
         }
         $list .= $tp->parseTemplate($AUC_LOT_LIST_FOOT, FALSE, $auc_shortcodes);
      } else {
         $list .= $tp->parseTemplate($AUC_NAV_ERROR, FALSE, $auc_shortcodes);
      }
      return $list;
   }

   /**
    * Get a specific lot
    */
   function generateLotView() {
      global $auc, $auc, $auclist, $bidlist, $dao, $aucUser, $tp;
      global $auc_shortcodes, $AUC_LOT_VIEW, $AUC_NAV_ERROR;
      $dao = $this->getDAO();
      require_once($this->getTemplate($auc));
      $aucUser = new auctionUser($auc);
      $bidlist = $dao->getBidList($this->getId());
      if ($aucUser->canViewAuction($auc->getId())) {
         $text = $tp->parseTemplate($AUC_LOT_VIEW, FALSE, $auc_shortcodes);
         return $text;
      } else {
         return $tp->parseTemplate($AUC_NAV_ERROR, FALSE, $auc_shortcodes);
      }
   }

   /**
    * Submit a auc
    * @param $statusInfo statusInfo object for reporting warnings and errors
    */
   function generateLotSubmit($statusInfo=false) {
      global $auc, $lot, $auclist, $dao, $aucUser, $aucStatusInfo, $tp;
      global $auc_shortcodes, $AUC_LOT_SUBMIT_VIEW, $AUC_NAV_ERROR;
      $dao = $this->getDAO();
      require_once($this->getTemplate($auc));
      $aucUser = new auctionUser($auc);
      if ($aucUser->canEditAuction($auc->getId())) {
         $aucStatusInfo = $statusInfo;
         $lot = new auctionLot(false, $_REQUEST[AUCC_POST_ARRAY], $auc);
         return $tp->parseTemplate($AUC_LOT_SUBMIT_VIEW, FALSE, $auc_shortcodes);
      } else {
         return $tp->parseTemplate($AUC_NAV_ERROR, FALSE, $auc_shortcodes);
      }
   }

   /**
    * Submit a new lot
    */
   function lotSubmit() {
      global $auc, $lot, $dao, $aucUser, $tp;
      global $auc_shortcodes, $AUC_NAV_ERROR;
      $dao = $this->getDAO();
      require_once($this->getTemplate($auc));
      $aucUser = new auctionUser($auc);
      if ($aucUser->canEditAuction($auc->getId())) {
         $lot = new auctionLot(null, $_REQUEST[AUCC_POST_ARRAY], $auc);
         if ($statusInfo = $lot->validateMe()) {
            return $statusInfo;
         }
         return $dao->submitLot($lot, $auc);
      } else {
         return $tp->parseTemplate($AUC_NAV_ERROR, FALSE, $auc_shortcodes);
      }
   }

   /**
    * Edit a auc
    * @param $aucid      ID of auc to be edited
    * @param $statusInfo statusInfo object for reporting warnings and errors
    */
   function generateLotEdit($statusInfo=false) {
      global $auc, $lot, $auclist, $dao, $aucUser, $aucStatusInfo, $tp;
      global $auc_shortcodes, $AUC_LOT_EDIT_VIEW, $AUC_NAV_ERROR;
      $dao = $this->getDAO();
      require_once($this->getTemplate($auc));
      $aucUser = new auctionUser($auc);
      if ($aucUser->canEditAuction($auc->getId())) {
         $aucStatusInfo = $statusInfo;
         $lot->setUI($_REQUEST[AUCC_POST_ARRAY]);
         return $tp->parseTemplate($AUC_LOT_EDIT_VIEW, FALSE, $auc_shortcodes);
      } else {
         return $tp->parseTemplate($AUC_NAV_ERROR, FALSE, $auc_shortcodes);
      }
   }

   /**
    * Update a auc
    */
   function lotUpdate() {
      global $auc, $lot, $dao, $aucUser, $tp;
      global $auc_shortcodes, $AUC_NAV_ERROR;
      $dao = $this->getDAO();
      require_once($this->getTemplate($auc));
      $aucUser = new auctionUser($auc);
      if ($aucUser->canEditAuction($auc->getId())) {
         $lot->setUI($_REQUEST[AUCC_POST_ARRAY]);
         if ($statusInfo = $lot->validateMe()) {
            return $statusInfo;
         } else {
            return $dao->updateLot($lot);
         }
      } else {
         return $tp->parseTemplate($AUC_NAV_ERROR, FALSE, $auc_shortcodes);
      }
   }

   // *********************************************************************************************
   // Menus
   // *********************************************************************************************

   /**
    * Public menu function
    * @param $which the menu to get - use AUCC_MENU_* constants
    */
   function getMenu($which=AUCC_MENU_SUMMARY) {
      global $auction, $auc, $auclist, $lot, $lotlist, $bidlist, $dao, $aucUser, $tp;
      global $auc_shortcodes, $AUC_MENU_HEAD, $AUC_MENU_BODY, $AUC_MENU_FOOT;
      $dao = $this->getDAO();
      $title = AUC_LAN_AUCTION;
      $auclist = $dao->getAuctionList();
      $text = "";
      require_once($this->getTemplate($auc));
      foreach ($auclist as $auc) {
         if ($auc->isOpen()) {
            $text .= $tp->parseTemplate($AUC_MENU_HEAD, FALSE, $auc_shortcodes);
            $lotlist = $dao->getLotList($auc->getId(), true);
            foreach ($lotlist as $lot) {
               $bidlist = $dao->getBidList($lot->getId(), true);
               $text .= $tp->parseTemplate($AUC_MENU_BODY, FALSE, $auc_shortcodes);
            }
            $text .= $tp->parseTemplate($AUC_MENU_FOOT, FALSE, $auc_shortcodes);
         }
      }
      return array($title, $text);
   }

   function _isAuctionPage() {
      $auc_pages = array(
                     AUCC_LOTS_PAGE,
                     AUCC_LOT_PAGE,
                     AUCC_SUBMIT_LOT_PAGE,
                     AUCC_EDIT_LOT_PAGE
                   );
      return in_array($this->getMode(), $auc_pages);
   }

   // *********************************************************************************************
   // Admin pages
   // *********************************************************************************************

   /**
    * Get the admin menu
    */
   function getAdminMenu() {
      global $auc3_adminmenu, $pageid;
      show_admin_menu(AUC_LAN_AUCTION, $pageid, $auc3_adminmenu);
   }

   /**
    * Generate the admin preferences page
    */
   function getAdminPage() {
      global $auc3_adminmenu, $pageid, $e107HelperForm;

      $pageid = e_QUERY ? e_QUERY : 10;
      $title  = AUC_LAN_AUCTION." :: ".$auc3_adminmenu["AUCC_ADMIN_PAGE_".$pageid]["text"];
      if ($auc3_adminmenu["AUCC_ADMIN_PAGE_".$pageid]["form"]) {
         // Create and process a form using the helper classes
         $e107HelperForm->createFormFromXML("forms/prefs_".$pageid);
         $e107HelperForm->processForm(true, true);
         $text = $e107HelperForm->getFormHTML();
      } else {
         include("admin_prefs_$pageid.php");
      }
      $pageid = e_QUERY ? "AUCC_ADMIN_PAGE_".e_QUERY : "AUCC_ADMIN_PAGE_10";
      return array($title, $text);
   }

   /**
    * Format admin page App List Templates drop down
    */
   function formatTemplatesDropDown($params) {
      $templates = array();
      switch ($params["templatetype"]) {
         case AUC_ADMIN_TEMPLATE_TYPE_APP : {
            $templates['0'] = array('0', AUC_ADMIN_TEMPLATE_TYPE_USE_GLOBAL);
         }
         case AUC_ADMIN_TEMPLATE_TYPE_APPS : {
            // TODO get templates from theme folder too?
            $folder = e_PLUGIN."auction/templates/";
            $handle = opendir($folder);
            while ($file = readdir($handle)) {
               if (preg_match_all("/^auction_(.*)[^menu]_template\.php$/", $file, $match) != false) {
                  unset($auc_template_name);
                  include($folder.$file);
                  if (isset($auc_template_name)) {
                     $templates[$match[1][0]] = array($match[1][0], $auc_template_name);
                  } else {
                     $templates[$match[1][0]] = array($match[1][0], $match[1][0]);
                  }
               }
            }
            closedir($handle);
            break;
         }
      }
      return $templates;
    }

   /**
    * Format admin page Apps Version drop down
    */
   function auctionFormatAppsOwnerDropDown($params) {
      global $sql;
      $owners = array();
      if ($params["includeblank"]) {
         $owners[] = array(0, AUC_LAN_LABEL_FILTER_OWNER_ALL);
      }
      if ($params["currentuser"]) {
         $owners[] = array(-1, AUC_LAN_LABEL_FILTER_OWNER_CURRENT);
      }
      if ($sql->db_Select("user", "user_id, user_name, user_login")) {
         while ($row = $sql->db_Fetch()) {
            $owners[] = array($row["user_id"], $row["user_name"]." (".$row["user_login"].")");
         }
      }
      return $owners;
   }

   /**
    * Load the appropriate template
    */
   function getTemplate($auc=false) {
      global $pref;

      // Default
      $template = AUCC_PLUGIN_DIR."templates/auction_default_template.php";

      // Global
      if (file_exists(AUCC_PLUGIN_DIR."/templates/auction_".$pref["auction_global_template"]."_template.php")){
         $template = AUCC_PLUGIN_DIR."templates/auction_".$pref["auction_global_template"]."_template.php";
      }

      // Auction specific
      if (false != $auc && file_exists(AUCC_PLUGIN_DIR."/templates/auction_".$auc->getTemplate()."_template.php")){
         $template = AUCC_PLUGIN_DIR."templates/auction_".$auc->getTemplate()."_template.php";
      }

      return $template;
   }

   /**
    * Check if any notifications are to be sent
    * @aucid if of the auc notifications are for (all notifications are for auc based processing)
    * @type  the notification type, use AUCC_LAN_NOTIFY_* constants
    */
   function checkNotifications($aucid, $type, $additionalinfo="") {
      global $auc, $auc, $dao, $e107Helper, $pref;

      $lot = $dao->getLot($aucid);

      switch ($type) {
         case AUC_LAN_NOTIFY_NEW : {
            $this->_notify(AUC_LAN_NOTIFY_NEW, AUC_LAN_NOTIFY_NEW_MESSAGE, $pref["auction_notify_owner_new"], $pref["auction_notify_poster_new"], $additionalinfo);
            break;
		   }
         case AUC_LAN_NOTIFY_EDIT : {
            $this->_notify(AUC_LAN_NOTIFY_EDIT, AUC_LAN_NOTIFY_EDIT_MESSAGE, $pref["auction_notify_owner_edit"], $pref["auction_notify_poster_edit"], $additionalinfo);
            break;
		   }
         case AUC_LAN_NOTIFY_COMMENT : {
            $this->_notify(AUC_LAN_NOTIFY_COMMENT, AUC_LAN_NOTIFY_COMMENT_MESSAGE, $pref["auction_notify_owner_comment"], $pref["auction_notify_poster_comment"], $additionalinfo);
            break;
		   }
         case AUC_LAN_NOTIFY_DEV_COMMENT : {
            $this->_notify(AUC_LAN_NOTIFY_DEV_COMMENT, AUC_LAN_NOTIFY_DEV_COMMENT_MESSAGE, $pref["auction_notify_owner_dev_comment"], $pref["auction_notify_poster_dev_comment"], $additionalinfo);
            break;
		   }
		}
   }

   function _notify($subject, $message, $ownerpref, $posterpref, $additionalinfo="") {
      global $auc, $auc, $e107Helper;
      $auclink = "<a href='".e_SELF."?".AUCC_LOTS_PAGE.".".$auc->getId()."'>".$auc->getName()."</a>";
      $auclink = "<a href='".e_SELF."?".AUCC_LOT_PAGE.".".$auc->getId()."'>".$auc->getName()."</a>";
      $message = str_replace("{appname}", $auclink, $message);
      $message = str_replace("{lotsummary}", $auclink, $message);
      $message .= "<br/><br/>$additionalinfo";
      if ($ownerpref == AUCC_NOTIFY_KEY_1 || $ownerpref == AUCC_NOTIFY_KEY_3) {
         $e107Helper->sendNotification(array($auc->getOwnerId()), $subject, $message, e_UC_PUBLIC);
      }
      if ($ownerpref == AUCC_NOTIFY_KEY_2 || $ownerpref == AUCC_NOTIFY_KEY_3) {
         require_once(e_HANDLER."mail.php");
         //$user = getx_user_data($auc->getOwnerId());
         $user = e107::user($auc->getOwnerId());
		   sendemail($user["user_email"], $subject, $message);
		}
		// Don't notify auc poster if they are the application owner
		if ($auc->getOwnerId() != $auc->getPosterId()) {
         if ($posterpref == AUCC_NOTIFY_KEY_1 || $posterpref == AUCC_NOTIFY_KEY_3) {
            $e107Helper->sendNotification(array($auc->getPosterId()), $subject, $message, e_UC_PUBLIC);
         }
         if ($posterpref == AUCC_NOTIFY_KEY_2 || $posterpref == AUCC_NOTIFY_KEY_3) {
            require_once(e_HANDLER."mail.php");
            //$user = getx_user_data($auc->getPosterId());
            $user = e107::user($auc->getPosterId());
		      sendemail($user["user_email"], $subject, $message);
		   }
		}
	}

   function getTooltip($tttext, $caption="", $image=false) {
      global $e107Helper, $pref;
      $tt = "";
      if ($pref["auction_tooltips"]) {
         $tt = $e107Helper->getTooltip($tttext, $caption, $this->getTooltipStyles(), AUCC_TT);
         if ($image) {
            $tt = "<img align='top' style='cursor:pointer' src='".e_IMAGE."admin_images/polls_16.png'$tt/>";
         }
      }
      return $tt;
   }
   function getTooltipStyles() {
      return array(
         "caption-style"   => "font-weight:bold;text-align:center;",
         "min-width"       => "150",
         "max-width"       => "300",
      );
   }
}

// An global instance of the auction class
global $auction;
$auction = new auction();
?>