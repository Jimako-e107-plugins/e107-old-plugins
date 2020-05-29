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
| $Source: e:\_repository\e107_plugins/auction/handlers/auction_lot.php,v $
| $Revision: 1.3 $
| $Date: 2008/06/28 05:52:48 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Auction Lot
 */
class auctionLot {
   var $lot;                  // An array of lot field values
   var $ui;                   // New lot values submitted from client
   var $old;                  // Copy of the lot before updates applied
   var $changes;              // Saved copy of changes (for reporting after validation)

   /**
    * Constructor
    * @param $lot       a row from the lots table
    * @param $ui        new lot values obtained from client
    * @param $auction   an auction object for the auction that this lot belongs to
    */
   function auctionLot($lot=false, $ui=false, $auction=false) {
      // Set some default values
      $this->lot["auction_lot_auction_id"]   = $auction ? $auction->getId() : 0;

      if ($lot) {
         $this->lot = array_merge($this->lot, $lot);
      }
      $this->ui = $ui;
   }

   function setUI($ui) {
      $this->ui = $ui;
   }

   // Getters
   function getId() {
      return $this->lot["auction_lot_id"];
   }
   function getAuctionId($ui=false) {
      return ($ui && isset($this->ui["ui_auction_id"])) ? $this->ui["ui_auction_id"] : $this->lot["auction_lot_auction_id"];
   }
   function getTitle($ui=false, $truncate=false) {
      $temp = ($ui && isset($this->ui["ui_title"])) ? $this->ui["ui_title"] : $this->lot["auction_lot_title"];
      return $truncate ? substr($temp, 0, 200) : $temp;
   }
   function getDescription($ui=false, $truncate=false) {
      $temp = ($ui && isset($this->ui["ui_description"])) ? $this->ui["ui_description"] : $this->lot["auction_lot_description"];
      return $truncate ? substr($temp, 0, 200) : $temp;
   }
   function getImages($ui=false, $truncate=false) {
      $temp = ($ui && isset($this->ui["ui_images"])) ? $this->ui["ui_images"] : $this->lot["auction_lot_images"];
      return $truncate ? substr($temp, 0, 200) : $temp;
   }
   function getStartDate() {
      return $this->lot["auction_lot_start_date"];
   }
   function getEndDate() {
      return $this->lot["auction_lot_end_date"];
   }
   function getTimestamp() {
      return $this->lot["auction_lot_timestamp"];
   }
   function getPosterId() {
      return $this->lot["auction_lot_poster_id"];
   }
   function getPoster() {
      $user = get_user_data($this->getPosterId());
      return $user["user_name"];
   }
   function getUpdateTimestamp() {
      return $this->lot["auction_lot_timestamp"];
   }
   function getUpdatePosterId() {
      return $this->lot["auction_lot_poster_id"];
   }
   function getReserve($ui=false) {
      return ($ui && isset($this->ui["ui_reserve"])) ? $this->ui["ui_reserve"] : $this->lot["auction_lot_reserve"];
   }
   function getUpdatePoster() {
      $user = get_user_data($this->getPosterId());
      return $user["user_name"];
   }
   function getBids() {
      global $auction;
      $dao = $auction->getDAO();
      return $dao->getBids($this->getId());
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
      if (!isset($this->ui["ui_title"]) || $this->ui["ui_title"] =="") {
         $statusInfo->addMissingMandatory(AUC_LAN_LABEL_LOT_TITLE);
      }
      if (!isset($this->ui["ui_description"]) || $this->ui["ui_description"] =="") {
         $statusInfo->addMissingMandatory(AUC_LAN_LABEL_DESCRIPTION);
      }
      if (!isset($this->ui["ui_reserve"]) || $this->ui["ui_reserve"] == "") {
         $this->ui["ui_reserve"] = 0;
      } elseif (!is_numeric($this->ui["ui_reserve"])) {
         $statusInfo->addMessage(AUC_LAN_LABEL_RESERVE.AUC_LAN_MSG_NUMERIC);
      } elseif (is_float($this->ui["ui_reserve"]) && is_float($this->ui["ui_reserve"]*(10*2))) {
         $statusInfo->addMessage(AUC_LAN_LABEL_RESERVE.AUC_LAN_MSG_DEC_PLACES);
      } else {
         $bits = explode(".", $this->ui["ui_reserve"]);
         if (count($bits) == 1) {
            // Pounds
            $this->ui["ui_reserve"] = $this->ui["ui_reserve"]."00";
         } else {
            // Pounds and pence
            $this->ui["ui_reserve"] = $bits[0].str_pad($bits[1], 2, "0");
         }
      }

      if ($statusInfo->getMessageCount() > 0) {
         return $statusInfo;
      }

      if ($stat = $this->_processUploadedImage()) {
         return $stat;
      }

      // Save changes before updating
      $this->getChanges();

      // Everything is OK, copy "ui" values as real attributes
      foreach ($this->ui as $key => $value) {
         $bits = split("_", $key, 2);
         if ($bits[0] == "ui") {
            $this->lot["auction_lot_".$bits[1]] = $value;
         }
      }

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
               if ($this->lot["auction_lot_".$bits[1]] != $this->ui["ui_".$bits[1]]) {
                  $this->changes[$bits[1]] = $this->ui["ui_".$bits[1]]." -> ".$this->lot["auction_lot_".$bits[1]];
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

   /**
    * Process uploaded file, if there is one
    */
   function _processUploadedImage() {
      $tempfile = $_FILES[AUCC_POST_ARRAY]["tmp_name"]["ui_images"];
      $tempfilename = $_FILES[AUCC_POST_ARRAY]["name"]["ui_images"];
      if (strlen($tempfile) > 0) {
         if (is_uploaded_file($tempfile)) {
            $file = AUCC_LOT_IMAGES_DIR.ereg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($tempfilename))));
            if (move_uploaded_file($tempfile, $file)) {
               $this->lot["auction_lot_images"] = $file;
               return false;
            } else {
               $statusInfo = new auctionStatusInfo(STATUS_WARN);
               $statusInfo->addMessage(AUC_LAN_MSG_UPLOAD_ERROR, AUC_LAN_MSG_UPLOAD_ERROR_MOVE.$file);
               return $statusInfo;
            }
         } else {
            $statusInfo = new auctionStatusInfo(STATUS_WARN);
            $statusInfo->addMessage(AUC_LAN_MSG_UPLOAD_ERROR, AUC_LAN_MSG_UPLOAD_ERROR_UPLOAD.$tempfile);
            return $statusInfo;
         }
      }

      $this->lot["auction_lot_images"] = AUC_LAN_MSG_NO_IMAGE;
      return false;
   }
}
?>