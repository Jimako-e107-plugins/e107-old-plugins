/*
+---------------------------------------------------------------+
| Election by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/election/election.js,v $
| $Revision: 1.1 $
| $Date: 2006/12/31 16:01:19 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
e107Helper.logDebug("Loading election.js");

var electionHelper = {
   submitVote : function () {
      e107Helper.logEnter("election.submitVote()");
      e107Helper.message("electionSubmitBug", "Submitting your vote... please wait.");
      e107HelperAjax.addParm("action", "submitVote");
      e107HelperAjax.addParm("ui_candidate_id", document.getElementById("ui_candidate_id").value);
      e107HelperAjax.addParm("ui_amount", document.getElementById("ui_amount").value);
      e107HelperAjax.addParm("ui_email", document.getElementById("ui_email").value);
      e107HelperAjax.addParm("ui_name", document.getElementById("ui_name").value);
      e107HelperAjax.addParm("ui_telephone", document.getElementById("ui_telephone").value);
      //e107HelperAjax.addParm("ui_num", document.getElementById("ui_num").value);
      //e107HelperAjax.addParm("ui_verify", document.getElementById("ui_verify").value);
      e107HelperAjax.addParm("popupid", "electionSubmitBug");
      e107HelperAjax.post("election_ajax.php");
      e107Helper.logExit("election.submitVote()");
   },
   deleteVote : function (ts, candidateid) {
      e107Helper.logEnter("election.deleteVote("+ts+","+candidateid+")");
      e107HelperAjax.addParm("action", "deleteVote");
      e107HelperAjax.addParm("ui_timestamp", ts);
      e107HelperAjax.addParm("ui_candidate_id", candidateid);
      e107HelperAjax.post("election_ajax.php");
      e107Helper.logExit("");
   },
   restoreVote : function (ts, candidateid) {
      e107Helper.logEnter("election.restoreVote("+ts+","+candidateid+")");
      e107HelperAjax.addParm("ui_timestamp", ts);
      e107HelperAjax.addParm("ui_candidate_id", candidateid);
      e107HelperAjax.addParm("action", "restoreVote");
      e107HelperAjax.post("election_ajax.php");
      e107Helper.logExit("");
   }
}

e107Helper.logDebug("Loaded election.js");
