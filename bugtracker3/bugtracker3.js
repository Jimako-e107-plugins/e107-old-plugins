/*
+---------------------------------------------------------------+
| Bugtracker3 by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/bugtracker3/bugtracker3.js,v $
| $Revision: 1.1.2.1 $
| $Date: 2006/11/27 13:00:13 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
e107Helper.log("Loading bugtracker3.js");

var bugtracker3Helper = {
   queryURL : function (query) {
      e107Helper.log("bugtracker3.queryURL("+query+")");
      e107HelperAjax.addParm("query", query);
      e107HelperAjax.post("bugtracker3_ajax.php");
   },
   updateRelation : function () {
      e107Helper.log("bugtracker3.updateRelation()");
      e107Helper.message("bugtracker3UpdateRelation", "Updating/Refreshing relations");
      e107HelperAjax.addParm("action", "updateRelation");
      e107HelperAjax.addParm("reltype", document.getElementById("bugtracker3_rels_relationship").value);
      e107HelperAjax.addParm("relid", document.getElementById("bugtracker3_rels_secondary_id").value);
      e107HelperAjax.addParm("bugid", document.getElementById("bugtracker3_bugid").value);
      e107HelperAjax.addParm("popupid", "bugtracker3UpdateRelation");
      e107HelperAjax.post("bugtracker3_ajax.php");
   },
   deleteRelation : function (relid) {
      e107Helper.log("bugtracker3.deleteRelation("+relid+")");
      e107Helper.message("bugtracker3DeleteRelation", "Deleting/Refreshing relations");
      e107HelperAjax.addParm("action", "deleteRelation");
      e107HelperAjax.addParm("bugid", document.getElementById("bugtracker3_bugid").value);
      e107HelperAjax.addParm("relid", relid);
      e107HelperAjax.addParm("popupid", "bugtracker3DeleteRelation");
      e107HelperAjax.post("bugtracker3_ajax.php");
   },
   addDevComment : function () {
      if (document.getElementById("bugtracker3_devc_comment").value.length > 0) {
         e107Helper.log("bugtracker3.addDevComment()");
         e107Helper.message("bugtracker3AddDevComment", "Adding developer comment");
         e107HelperAjax.addParm("action", "addDevComment");
         e107HelperAjax.addParm("bugid", document.getElementById("bugtracker3_bugid").value);
         e107HelperAjax.addParm("comment", document.getElementById("bugtracker3_devc_comment").value);
         e107HelperAjax.addParm("popupid", "bugtracker3AddDevComment");
         e107HelperAjax.post("bugtracker3_ajax.php");
      } else {
         alert("Nothing to add");
      }
   }
}

e107Helper.log("Loaded bugtracker3.js");
