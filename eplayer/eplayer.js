/*
+---------------------------------------------------------------+
| Auction by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/eplayer/eplayer.js,v $
| $Revision: 1.2 $
| $Date: 2007/01/23 23:59:50 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
//E107Helper.logDebug("Loading eplayer.js");

var eplayer = {
   updateField : function (id, fieldName, field) {
      e107Helper.logEnter("eplayer.updateField(id="+id+", fieldName="+fieldName+", field="+field+")");
      e107Helper.message("eplayerMessage", "... please wait.");
      e107HelperAjax.addParm("ep_messageid", "eplayerMessage");
      e107HelperAjax.addParm("action", "updateField");
      e107HelperAjax.addParm("ep_id", id);
      e107HelperAjax.addParm("ep_field", fieldName);
      e107HelperAjax.addParm("ep_container", field);
      e107HelperAjax.addParm("ep_value", document.getElementById(field).value);
      e107HelperAjax.post("eplayer_ajax.php");
      //e107Helper.logExit("eplayer.updateField()");
   },
   viewer : function (list, divid) {
      //e107Helper.logEnter("eplayer.viewer()");
      if (list.value != "") {
         e107Helper.message("eplayerMessage", "... please wait.");
         e107HelperAjax.addParm("ep_messageid", "eplayerMessage");
         e107HelperAjax.addParm("action", "viewer");
         e107HelperAjax.addParm("ep_id", list.value);
         e107HelperAjax.addParm("ep_div", divid);
         e107HelperAjax.post("eplayer_ajax.php");
      }
      //e107Helper.logExit("eplayer.viewer()");
   }
}

//E107Helper.logDebug("Loaded eplayer.js");
