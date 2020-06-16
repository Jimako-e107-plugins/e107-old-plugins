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
| $Source: e:\_repository\e107_plugins/auction/handlers/auction_bid.php,v $
| $Revision: 1.3 $
| $Date: 2008/06/28 05:52:48 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Auction Bid
 */
class auctionBid {
   var $bid;     // row from the database bids table
   var $ui;      // New lot values submitted from client
   var $old;     // Copy of the lot before updates applied
   var $changes; // Saved copy of changes (for reporting after validation)

   /**
    * Constructor
    * @param   a bid row (array) from the database table
    */
   function auctionBid($bid=false, $ui=false) {
      if ($bid) {
         $this->bid = $bid;
      } else {
         $this->bid["auction_bid_timestamp"] = time();
      }
      $this->ui = $ui;
   }

   // Getters
   function getTimestamp() {
      return $this->bid["auction_bid_timestamp"];
   }
   function getLotId() {
      return $this->bid["auction_bid_lot_id"];
   }
   function getBidderId() {
      return $this->bid["auction_bid_bidder_id"];
   }
   function getBidder() {
      //$user = getx_user_data($this->getBidderId());
      $user = e107::user($this->getBidderId());
      return $user["user_name"];
   }
   function getAmount() {
      return $this->bid["auction_bid_amount"];
   }
   function getName() {
      return $this->bid["auction_bid_name"];
   }
   function getEmail() {
      return $this->bid["auction_bid_email"];
   }
   function getTelephone() {
      return $this->bid["auction_bid_telephone"];
   }
   function getDeleted() {
      return $this->bid["auction_bid_deleted"];
   }
   function setDeleted($deleted) {
      $this->bid["auction_bid_deleted"] = $deleted ? 1 : 0;
   }
   function isDeleted() {
      return varset($this->bid["auction_bid_deleted"], 0);
   }

   /**
    * Function to validate the model
    * Validates (including mandatoryness check) all model attributes that have a key prefixed "ui_", other
    * attributes are deemed to have come from the database or other trusted source (i.e. not user input).
    * @return $statusInfo a statusInfo object if there are any warnings or errors, otherwise false
    */
   function validateMe() {
      // Field Validation
      $statusInfo = new auctionStatusInfo(STATUS_WARN);
      if (!isset($this->ui["ui_amount"]) || $this->ui["ui_amount"] == "") {
         $statusInfo->addMissingMandatory(AUC_LAN_LABEL_BID_AMOUNT);
      } elseif (!is_numeric($this->ui["ui_amount"])) {
         $statusInfo->addMessage(AUC_LAN_LABEL_BID_AMOUNT.AUC_LAN_MSG_NUMERIC);
      } elseif (is_float($this->ui["ui_amount"]) && is_float($this->ui["ui_amount"]*(10*2))) {
         $statusInfo->addMessage(AUC_LAN_LABEL_BID_AMOUNT.AUC_LAN_MSG_DEC_PLACES);
      } else {
         $bits = explode(".", $this->ui["ui_amount"]);
         if (count($bits) == 1) {
            // Pounds
            $this->ui["ui_amount"] = $this->ui["ui_amount"]."00";
         } else {
            // Pounds and pence
            $this->ui["ui_amount"] = $bits[0].str_pad($bits[1], 2, "0");
         }
      }
      if (!isset($this->ui["ui_name"]) || $this->ui["ui_name"] =="") {
         $statusInfo->addMissingMandatory(AUC_LAN_LABEL_BID_NAME);
      }
      if (!isset($this->ui["ui_email"]) || $this->ui["ui_email"] =="") {
         $statusInfo->addMissingMandatory(AUC_LAN_LABEL_BID_EMAIL);
      } elseif (is_object(getmxrr)) {
         $ret = validatemail($this->ui["ui_email"]);
         if (!$ret[0]) {
            $statusInfo->addMessage(AUC_LAN_LABEL_BID_EMAIL.AUC_LAN_MSG_INVALID);
         }
      }

      //if (!isset($this->ui["ui_verify"]) || $this->ui["ui_verify"] =="") {
      //   $statusInfo->addMissingMandatory(AUC_LAN_LABEL_SECURITY);
      //} else {
      //   require_once(e_HANDLER."secure_img_handler.php");
      //   $sec_img = new secure_image();
      //   if (!$sec_img->verify_code($this->ui["ui_num"], $this->ui["ui_verify"])) {
      //      $statusInfo->addMessage(AUC_LAN_LABEL_SECURITY.AUC_LAN_MSG_INCORRECT." ".$tp -> toDB($this->ui["ui_num"])." ".$this->ui["ui_verify"]);
      //   }
      //}

      if ($statusInfo->getMessageCount() > 0) {
         return $statusInfo;
      }

      // Save changes before updating
      $this->getChanges();

      // Everything is OK, copy "ui" values as real attributes
      foreach ($this->ui as $key => $value) {
         $bits = split("_", $key, 2);
         if ($bits[0] == "ui") {
            $this->bid["auction_bid_".$bits[1]] = $value;
         }
      }
      $this->bid["auction_bid_bidder_id"] = USER ? USERID : 0;

      return false;
   }

   /**
    * Generates a list of fields that have been updated
    */
   function getChanges($formatted=false) {
      if (!isset($this->changes)) {
         $this->changes = array();
         foreach ($this->ui as $key => $value) {
            $bits = split("_", $key, 2);
            if ($bits[0] == "ui") {
               if ($this->bid["auction_bid_".$bits[1]] != $this->ui["ui_".$bits[1]]) {
                  $this->changes[$bits[1]] = $this->ui["ui_".$bits[1]]." -> ".$this->bid["auction_bid_".$bits[1]];
               }
            }
         }
      }

      if ($formatted) {
         return implode("<br/>", $this->changes);
      } else {
         return implode(",", $this->changes);
      }
   }

}
?>