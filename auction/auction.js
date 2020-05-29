/*
+---------------------------------------------------------------+
| Auction by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/auction/auction.js,v $
| $Revision: 1.3 $
| $Date: 2006/12/09 19:01:18 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
e107Helper.logDebug("Loading auction.js");

var auctionHelper = {
   submitBid : function () {
      e107Helper.logEnter("auction.submitBid()");
      e107Helper.message("auctionSubmitBug", "Submitting your bid... please wait.");
      e107HelperAjax.addParm("action", "submitBid");
      e107HelperAjax.addParm("ui_lot_id", document.getElementById("ui_lot_id").value);
      e107HelperAjax.addParm("ui_amount", document.getElementById("ui_amount").value);
      e107HelperAjax.addParm("ui_email", document.getElementById("ui_email").value);
      e107HelperAjax.addParm("ui_name", document.getElementById("ui_name").value);
      e107HelperAjax.addParm("ui_telephone", document.getElementById("ui_telephone").value);
      //e107HelperAjax.addParm("ui_num", document.getElementById("ui_num").value);
      //e107HelperAjax.addParm("ui_verify", document.getElementById("ui_verify").value);
      e107HelperAjax.addParm("popupid", "auctionSubmitBug");
      e107HelperAjax.post("auction_ajax.php");
      e107Helper.logExit("auction.submitBid()");
   },
   deleteBid : function (ts, lotid) {
      e107Helper.logEnter("auction.deleteBid("+ts+","+lotid+")");
      e107HelperAjax.addParm("action", "deleteBid");
      e107HelperAjax.addParm("ui_timestamp", ts);
      e107HelperAjax.addParm("ui_lot_id", lotid);
      e107HelperAjax.post("auction_ajax.php");
      e107Helper.logExit("");
   },
   restoreBid : function (ts, lotid) {
      e107Helper.logEnter("auction.restoreBid("+ts+","+lotid+")");
      e107HelperAjax.addParm("ui_timestamp", ts);
      e107HelperAjax.addParm("ui_lot_id", lotid);
      e107HelperAjax.addParm("action", "restoreBid");
      e107HelperAjax.post("auction_ajax.php");
      e107Helper.logExit("");
   }
}

e107Helper.logDebug("Loaded auction.js");
