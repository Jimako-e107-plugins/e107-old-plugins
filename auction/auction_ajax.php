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
| $Source: e:\_repository\e107_plugins/auction/auction_ajax.php,v $
| $Revision: 1.3 $
| $Date: 2006/12/09 19:01:18 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   ob_start();
   if (isset($_REQUEST["query"])) {
      // Override e107's query string processing
      define(e_QUERY, $_REQUEST["query"]);
      $_REQUEST["action"] = "query";
      $_REQUEST["ajax"] = true;
   }
   require_once("../../class2.php");
   require_once(e_PLUGIN."auction/handlers/auction_class.php");
   require_once(AUCC_HANDLERS_DIR."/auction_utils.php");

   class auctionAjax {

      function auctionAjax() {
         extract($_REQUEST); // TODO need to protect this, better not to extract request variables
         switch ($action) {
            case "submitBid" : {
               $this->submitBid($ui_lot_id, $popupid);
               break;
            }
            case "deleteBid" : {
               $this->bidDeleteRestore(true, $ui_timestamp, $ui_lot_id);
               break;
            }
            case "restoreBid" : {
               $this->bidDeleteRestore(false, $ui_timestamp, $ui_lot_id);
               break;
            }
            default : {
               // Do nothing
            }
         }
      }

      function printXML($text) {
         ob_end_clean();
         header('Content-type: text/xml');
         echo $text;
      }

      function submitBid($lotid, $popupid) {
         global $auction, $auc, $bid, $bidlist, $aucUser, $dao, $tp;
         global $auc_shortcodes;

         $dao = $auction->getDAO();
         $lot = $dao->getLot($lotid);
         $auc = $dao->getAuction($lot->getAuctionId());

         $bid = new auctionBid(false, $_POST);
         if (false != $status = $bid->validateMe()) {
            $text = "<e107helperajax>";
            $text .= "<response type='killmessage' id='$popupid'></response>";
            $text .= "<response type='alert'><![CDATA[";
            $text .= AUC_LAN_MSG_BID_FAILED."\n";
            for ($i=0; $i<$status->getMessageCount(); $i++) {
               $text .= "".$status->getMessage($i)."\n";
            }
            $text .= "]]></response>";
            $text .= "</e107helperajax>";
            $this->printXML($text);
            return;
         }

            if ($bid->getAmount() < $lot->getReserve()) {
               $text = "<e107helperajax>";
               $text .= "<response type='killmessage' id='$popupid'></response>";
               $text .= "<response type='alert'><![CDATA[";
               $text .= $tp->toForm(AUC_LAN_MSG_BID_BELOW_RESERVE.auction_toCurrency($lot->getReserve()));
               $text .= "]]></response>";
               $text .= "</e107helperajax>";
               $this->printXML($text);
               return;
            }

         $bidlist = $dao->getBidList($lotid);
         if (count($bidlist) > 0) {
            reset($bidlist);
            $topbid = auction_getTopBid();
            if ($topbid && $bid->getAmount() <= $topbid->getAmount()) {
               $text = "<e107helperajax>";
               $text .= "<response type='killmessage' id='$popupid'></response>";
               $text .= "<response type='alert'><![CDATA[";
               $text .= $tp->toForm(AUC_LAN_MSG_BID_TOO_LOW.auction_toCurrency($topbid->getAmount()));
               $text .= "]]></response>";
               $text .= "</e107helperajax>";
               $this->printXML($text);
               return;
            }
         }

         $status = $dao->addBid($bid);
         if (get_class($status) == "auctionStatusInfo") {
            $text = "<e107helperajax>";
            $text .= "<response type='killmessage' id='$popupid'></response>";
            $text .= "<response type='alert'><![CDATA[";
            $text .= AUC_LAN_MSG_BID_FAILED."\n";
            for ($i=0; $i<$status->getMessageCount(); $i++) {
               $text .= $status->getMessage($i)."\n";
               $text .= "(".$status->getAdditionalDetails($i).")\n";
            }
            $text .= "]]></response>";
            $text .= "</e107helperajax>";
            $this->printXML($text);
            return;
         }

         //$auction->checkNotifications($auc->getId(), AUC_LAN_NOTIFY_DEV_COMMENT, AUC_LAN_LABEL_LOTS."...<br/><br/>$comment");

         $aucUser = new auctionUser($auc);
         array_unshift($bidlist, $bid);
         require_once($auction->getTemplate($auc));
         $text = "<e107helperajax>";
         $text .= "<response type='killmessage' id='$popupid'></response>";
         if (USER) {
            $text .= "<response type='innerhtml' id='auction_bid_history'><![CDATA[";
            $text .= $tp->parseTemplate("{AUC_BID_HISTORY=ajax}", FALSE, $auc_shortcodes);
            $text .= "]]></response>";
         }
         $text .= "<response type='innerhtml' id='auction_last_bid_date_time'><![CDATA[";
         $text .= $tp->parseTemplate("{AUC_LOT_LAST_BID_DATE_TIME=short}", FALSE, $auc_shortcodes);
         $text .= "]]></response>";
         $text .= "<response type='innerhtml' id='auction_last_bid_amount'><![CDATA[";
         $text .= $tp->parseTemplate("{AUC_LOT_LAST_BID_AMOUNT}", FALSE, $auc_shortcodes);
         $text .= "]]></response>";
         $text .= "<response type='alert'><![CDATA[";
         $text .= AUC_LAN_MSG_BID_SUCCSESSFUL;
         $text .= "]]></response>";
         $text .= "</e107helperajax>";
         $this->printXML($text);
      }

      function bidDeleteRestore($delete, $ts, $lotid) {
         global $auction, $auc, $bid, $bidlist, $aucUser, $dao, $tp;
         global $auc_shortcodes;

         $dao = $auction->getDAO();
         $lot = $dao->getLot($lotid);
         $auc = $dao->getAuction($lot->getAuctionId());
         $bid = $dao->getBid($ts, $lotid);
         $bid->setDeleted($delete);
         $status = $dao->updateBid($bid);
         if (get_class($status) == "auctionStatusInfo") {
            $text = "<e107helperajax>";
            $text .= "<response type='killmessage' id='$popupid'></response>";
            $text .= "<response type='alert'><![CDATA[";
            $text .= AUC_LAN_MSG_BID_UPDATE_FAILED."\n";
            for ($i=0; $i<$status->getMessageCount(); $i++) {
               $text .= $status->getMessage($i)."\n";
               $text .= "(".$status->getAdditionalDetails($i).")\n";
            }
            $text .= "]]></response>";
            $text .= "</e107helperajax>";
            $this->printXML($text);
            return;
         }

         $bidlist = $dao->getBidList($lotid);
         $aucUser = new auctionUser($auc);
         require_once($auction->getTemplate($auc));
         $text = "<e107helperajax>";
         if (USER) {
            $text .= "<response type='innerhtml' id='auction_bid_history'><![CDATA[";
            $text .= $tp->parseTemplate("{AUC_BID_HISTORY=ajax}", FALSE, $auc_shortcodes);
            $text .= "]]></response>";
         }
         $text .= "<response type='innerhtml' id='auction_last_bid_date_time'><![CDATA[";
         $text .= $tp->parseTemplate("{AUC_LOT_LAST_BID_DATE_TIME=short}", FALSE, $auc_shortcodes);
         $text .= "]]></response>";
         $text .= "<response type='innerhtml' id='auction_last_bid_amount'><![CDATA[";
         $text .= $tp->parseTemplate("{AUC_LOT_LAST_BID_AMOUNT}", FALSE, $auc_shortcodes);
         $text .= "]]></response>";
         $text .= "</e107helperajax>";
         $this->printXML($text);
      }
   }

   $auctionAjax = new auctionAjax();
   exit;
?>