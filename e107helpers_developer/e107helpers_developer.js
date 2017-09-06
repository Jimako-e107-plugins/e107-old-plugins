/*
+---------------------------------------------------------------+
| Election by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/e107helpers_developer/e107helpers_developer.js,v $
| $Revision: 1.1 $
| $Date: 2007/01/10 23:59:06 $
| $Author: Neil $
+---------------------------------------------------------------+
*/

// Instead of just writing the JavaScrip inline, poluting the global namespace, declare
// a variable (with a unique name) and add functions to it
var e107helpers_developerHelper = {
   // function to get the time from the server and display it on part of the page
   // in this case, it will be the DIV whose ID is passed to the JavaScript.
   // In actual fact, we have no idea what the server side PHP will do with this request
   // but we must make sure that the code exists and does something sensible
   getTime : function (id) {
      // use the addParm() function to add name/value pairs that will be sent to the server script
      e107HelperAjax.addParm("action", "getTime");
      e107HelperAjax.addParm("id", id);
      // once the request is set up, call the post() method, passing in the name of our PHP script,
      // to send the request. If the script is in the same folder as the caller then no other information
      // is needed. Relative and absolute URLs can be used if needed.
      e107HelperAjax.post("e107helpers_developer_ajax.php");
   },
   getAlert : function () {
      e107HelperAjax.addParm("action", "getAlert");
      e107HelperAjax.post("e107helpers_developer_ajax.php");
   },
   getPopup : function (id) {
      e107HelperAjax.addParm("action", "getPopup");
      e107HelperAjax.addParm("id", id);
      e107HelperAjax.post("e107helpers_developer_ajax.php");
   },
   getColour : function (colourid, divid) {
      var el = document.getElementById(colourid);
      document.getElementById(divid).innerHTML = "Your favorite colour is: "+el.value;
   }
}
