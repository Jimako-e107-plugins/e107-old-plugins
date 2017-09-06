/*
 * agendaHelper
 * JavaScript object to encapsulate JS for Agenda plugin
 */
var agendaHelper = {
   debug      : 0,
   debugEntry : 1,
   debugExit  : 2,
   setDebug : function (newLevel) {
      this.debug = newLevel;
   },
   addEntryForm : function (evt, ds) {
      if (this.debug & this.debugEntry) alert("agendaHelper.addEntryForm()");
      e107HelperAjax.addParm("action", "addEntryForm");
      e107HelperAjax.addParm("type", document.getElementById("agenda_add").value);
      e107HelperAjax.addParm("date", agendaGetURLParam(3));
      e107Helper.storeBodyHTML();
      e107HelperAjax.post("agendaAjax.php");
   },
   addEntry : function (evt, ds) {
      if (this.debug & this.debugEntry) alert("agendaHelper.addEntry()");
      e107HelperAjax.addParm("action", "addEntry");
      e107HelperAjax.addParm("type", document.getElementById("agenda_addentry_type").value);
      var tags = document.getElementsByTagName("*");
      for (var i=0; i<tags.length; i++) {
         if (typeof tags[i] != "undefined" && typeof tags[i].type != "undefined" && typeof tags[i].name != "undefined" && tags[i].name.substr(0,4)=="agn_") {
            //alert(tags[i].type+" "+tags[i].name+"="+tags[i].value);
            switch (tags[i].type.toLowerCase()) {
               case "radio" : {
                  if (tags[i].checked) {
                     e107HelperAjax.addParm(tags[i].name, tags[i].value);
                  }
                  break;
               }
               case "checkbox" : {
                  if (tags[i].checked) {
                     e107HelperAjax.addParm(tags[i].name, tags[i].value);
                  }
                  break;
               }
               default : {
                  e107HelperAjax.addParm(tags[i].name, tags[i].value);
               }
            }
         }
      }
      //alert(e107HelperAjax.parms.substr(253));
      e107HelperAjax.addParm("messageid", "agenda_addentry");
      e107Helper.message("agenda_addentry", "Please wait...");
      e107HelperAjax.post("agendaAjax.php");
   },
   cancelDialog : function () {
      if (this.debug & this.debugEntry) alert("agendaHelper.cancelDialog()");
      e107Helper.restoreBodyHTML();
   },
   checkFilter : function () {
      var style = "inline";
      var visibility = "";
      var ajaxparm = 0;
      if (document.getElementById("usr_filter_state").checked) {
         style = "none";
         visibility = "hidden";
         ajaxparm = 1;
      }
      var els = document.getElementsByTagName("SPAN");
      for (var i=0; i<els.length; i++) {
         if (els[i].id.substr(0, 20) == "agenda_entry_filter_") {
            els[i].style.display = style;
            els[i].style.visibility = visibility;
         }
      }
      e107HelperAjax.addParm("action", "setUserFilterState");
      e107HelperAjax.addParm("filter", ajaxparm);
      e107HelperAjax.post("agendaAjax.php");
   }
}

function agendaChangeView() {
   document.location = agendaGetNewURL("view", document.getElementById("agenda_view").value, "", "", "");
}
function agendaSearchPage() {
   document.location = agendaGetNewURL("search", "", "", "", "");
}
function agendaPrintPage() {
   var win = window.open("../../print.php?plugin:agenda.1", "agendaprintwindow", "");
   win.focus();
}
function agendaAddEntry() {
   document.location = agendaGetNewURL("add", "", "", "", document.getElementById("agenda_add").value);
}
function agendaSetFilter() {
   document.location = agendaGetNewURL("filter", "", "", "", "");
}
function agendaRegister() {
   var answer = "";
   if (document.getElementById("agenda_answer0")) {
      var i = 0;
      while (true) {
         if (document.getElementById("agenda_answer"+i)) {
            if (document.getElementById("agenda_answer"+i).checked) {
               answer = document.getElementById("agenda_answer"+i).value;
               break;
            }
         } else {
            alert("You should not see this message but I ran out of radio buttons at index "+i+"!");
            break;
         }
         i++;
      }
   } else {
      answer = document.getElementById("agenda_answer").value;
   }

   if (answer.length > 0) {
      e107HelperAjax.addParm("action", "setUserRegistration");
      e107HelperAjax.addParm("id", agendaGetURLParam(2));
      e107HelperAjax.addParm("answer", answer);
      e107HelperAjax.post("agendaAjax.php");
   }
}
function agendaDeregister(userid) {
   e107HelperAjax.addParm("action", "unsetUserRegistration");
   e107HelperAjax.addParm("id", agendaGetURLParam(2));
   if (typeof userid != "undefined") {
      e107HelperAjax.addParm("userid", userid);
   }
   e107HelperAjax.post("agendaAjax.php");
}
function agendaSubscriptions() {
   var answer = "";
   var els = document.getElementsByTagName("INPUT");
   var subs = Array();
   for (var i=0; i<els.length; i++) {
      if (els[i].type == "checkbox" && els[i].id.substr(0, 16) == "agenda_event_sub") {
         if (els[i].checked) {
            subs[subs.length] = els[i].id.substr(16);
         }
      }
   }
   e107HelperAjax.addParm("action", "setSubscriptions");
   e107HelperAjax.addParm("subs", "0,"+subs.toString());
   e107HelperAjax.post("agendaAjax.php");
}
function agendaEMail(eventid) {
   e107HelperAjax.addParm("action", "agendaEMail");
   e107HelperAjax.addParm("id", eventid);
   e107HelperAjax.addParm("emailTo", document.getElementById("email_to").value);
   e107HelperAjax.addParm("emailSubject", document.getElementById("email_subject").value);
   e107HelperAjax.addParm("emailMessage", document.getElementById("email_message").value);
   e107HelperAjax.post("agendaAjax.php");
}
function agendaFilter() {
   var answer = "";
   var el = document.getElementById("usr_type");
   var types = Array();
   for (var i=0; i<el.options.length; i++) {
      if (el.options[i].selected) {
         types[types.length] = el.options[i].value;
      }
   }

   el = document.getElementById("usr_category");
   var categories = Array();
   for (i=0; i<el.options.length; i++) {
      if (el.options[i].selected) {
         categories[categories.length] = el.options[i].value;
      }
   }

   el = document.getElementById("usr_owner");
   var owners = Array();
   for (i=0; i<el.options.length; i++) {
      if (el.options[i].selected) {
         owners[owners.length] = el.options[i].value;
      }
   }

   e107HelperAjax.addParm("action", "setUserFilterOptions");
   e107HelperAjax.addParm("types", types.toString());
   e107HelperAjax.addParm("categories", categories.toString());
   e107HelperAjax.addParm("owners", owners.toString());
   e107HelperAjax.addParm("completed", document.getElementById("usr_complete").checked ? "Y" : "");
   e107HelperAjax.post("agendaAjax.php");
}
function agendaGetURLParam(num) {
   var query = ''+document.location;
   var parts = query.substring(query.indexOf("?")+1).split(".");
   return  parts[num];
}
function agendaConfirmDelete(thetext, loc){
   if (confirm(thetext)) {
      document.location = loc;
      return true;
   } else {
      return false;
   }
}
function agendaGetURLParamValue(pnew, pcur) {
   if (pnew.length == 0) {
      if (typeof pcur != "undefined") {
         return pcur;
      } else {
         return 0;
      }
   }
   return pnew;
}
function agendaDCodePopulate0(id, val) {
   // Empty list
   var list = document.getElementById(id+"_0");
   list.length = 0;

   // Populate list
   list[list.length] = new Option("[select]","X");
   var thisval = val.substr(0,1);
   var nextval = val.substr(1);
   for (var i=0; i<agendaDiaryCodes[0].length; i++) {
      var bits = agendaDiaryCodes[0][i].split(":");
      list[list.length] = new Option(bits[1],bits[0]);
      if (bits[0] == thisval) {
         list[list.length-1].selected = true;
      }
   }
   if (nextval.length > 0) {
      agendaDCodePopulate1("", id, nextval);
   }
}

function agendaDCodePopulate1(evt, id, val) {
   if (evt != "" && evt.type == "keyup") {
      var keyCode =  typeof evt.which == "undefined" ? evt.keyCode : evt.which;
      if (keyCode < 48 && keyCode != 38 && keyCode != 40) {
         // Don"t do anything control key or cursor up/down
         return;
      }
   }
   var list0 = document.getElementById(id+"_0");
   var list1 = document.getElementById(id+"_1");
   var list2 = document.getElementById(id+"_2");
   list1.length = 0;
   list2.length = 0;

   var thisval = val.substr(0,1);
   var nextval = val.substr(1);

   // Populate list
   for (var i=0; i<agendaDiaryCodes[1].length; i++) {
      var bits = agendaDiaryCodes[1][i].split(";");
      if (bits[0] == list0.value) {
         if (list1.length == 0) {
            list1[list1.length] = new Option("[select]","X");
         }
         bits = bits[1].split(":");
         if (bits[1] == "[date]") {
            for (var j=1; j<32; j++) {
               if (j < 10) {
                  list1[list1.length] = new Option("0"+j,"0"+j);
               } else {
                  list1[list1.length] = new Option(j,j);
               }
               if (j == val) {
                  list1[list1.length-1].selected = true;
                  nextval = "";
               }
            }
         } else {
            list1[list1.length] = new Option(bits[1],bits[0]);
            if (bits[0] == thisval) {
               list1[list1.length-1].selected = true;
            }
         }
      }
   }
   if (list1.length > 1) {
      list1.disabled = false;
      list1.style.visibility = "";
   } else {
      list1.disabled = true;
      list1.style.visibility = "hidden";
   }
   list2.disabled = true;
   list2.style.visibility = "hidden";
   if (nextval.length > 0) {
      agendaDCodePopulate2("", id, nextval);
   }
}

function agendaDCodePopulate2(evt, id, val) {
   if (evt != "" && evt.type == "keyup") {
      var keyCode =  typeof evt.which == "undefined" ? evt.keyCode : evt.which;
      if (keyCode < 48 && keyCode != 38 && keyCode != 40) {
         // Don"t do anything control key or cursor up/down
         return;
      }
   }
   // Empty list
   var list0 = document.getElementById(id+"_0");
   var list1 = document.getElementById(id+"_1");
   var list2 = document.getElementById(id+"_2");
   list2.length = 0;

   // Populate list
   for (var i=0; i<agendaDiaryCodes[2].length; i++) {
      var bits = agendaDiaryCodes[2][i].split(";");
      if (bits[0] == list0.value+list1.value) {
         if (list2.length == 0) {
            list2[list2.length] = new Option("[select]","X");
         }
         bits = bits[1].split(":");
         if (bits[1] == "[date]") {
            for (var j=1; j<32; j++) {
               if (j < 10) {
                  list2[list2.length] = new Option("0"+j,"0"+j);
               } else {
                  list2[list2.length] = new Option(j,j);
               }
               if (j == val) {
                  list2[list2.length-1].selected = true;
               }
            }
         } else {
            list2[list2.length] = new Option(bits[1],bits[0]);
            if (bits[0] == val) {
               list2[list2.length-1].selected = true;
            }
         }
      }
   }
   if (list2.length > 1) {
      list2.disabled = "";
      list2.style.visibility = "";
   } else {
      list2.disabled = true;
      list2.style.visibility = "hidden";
   }
}