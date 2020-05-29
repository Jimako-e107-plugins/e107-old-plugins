var jshelper = {
   /**
    * expandit
    * @param elementOrId - the element or element ID clicked to instiagte the action
    * @param hideCSV     - comma separated list of additional element IDs that are to be hidden
    *                      this is not used by core e107 but kept for compatibility with any plugin/theme that uses it
    */
   expandit: function(elementOrId, hideCSV) {
      folder = (Object.isString(elementOrId)) ? $(elementOrId) : folder=$(elementOrId).next();
      new Effect.toggle(folder, 'slide');
      if (typeof hideCSV != 'undefined') {
         hideCSV.split(",").each(function(id) {
            // No effects - just hide it to avoid animation glitches
            $(id.strip()).hide();
         });
      }
   },
   /**
    * showhideit
    * @param showId  - ID of element to show
    * @param hideId  - ID of element to hide
    */
   showhideit: function (showID, hideID) {
      var showEl = $(showID);
      if (showEl.visible()) {
         return;
      }
      var hideEl = $(hideID);

      new Effect.BlindUp(hideEl, {
         duration: 0.5,
         afterFinish: function () {
            new Effect.BlindDown(showEl, {duration: 0.5});
         }
      });
   },

   /**
    * log
    * @param thing - the thing (string, element, object, etc.) to be logged
    */
   log: function(thing) {
      if (console && console.log) {
         console.log(thing);
      }
   }
}
document.observe("dom:loaded", function() {
   var loc = document.location.href;
   var adminPage = loc.match(/.*\/e107_admin\/.*/); //TODO needs to be pulled in from PHP

   // *************************************************************************
   // Chatbox auto refresh
   // *************************************************************************

   if ($("xchatbox_posts")) {
      function spyonChatBox() {
         setTimeout(function() {
            $("cmessage").observe("keyup", function(ev) {
               if (ev.element().getValue().length > 0 && !chatUpdater.stopped) {
                  chatUpdater.stopped = true;
                  chatUpdater.stop();
               } else if (ev.element().getValue().length == 0 && chatUpdater.stopped) {
                  chatUpdater.stopped = false;
                  chatUpdater.start();
               }
            });
            $("chat_submit").observe("click", function(ev) {
               chatUpdater.stopped = false;
               setTimeout(function() {
                  spyonChatBox();
                  chatUpdater.start();
               }, 2500);
            });
         }, 1500);
      }
      var params = {chat_submit: "Submit", cmessage: ""};
      if ($("chatbox_ajax")) {
         params.chatbox_ajax = $("chatbox_ajax").getValue();
      }
      var chatUpdater = new Ajax.PeriodicalUpdater(
         "chatbox_posts",
         "http://localhost/plugins.e107.org/e107_plugins/chatbox_menu/chatbox_menu.php",
         {
            parameters: params,
            frequency:  1,
            decay:      2,
            onSuccess: function() {
               console.log(new Date()+"jshelper onSuccess");
               spyonChatBox();
            }
         }
      );
   }

   // *************************************************************************
   // JSCaptcha
   // *************************************************************************
   // See if we have a form we need to observe
   //var forms = $w("chatbox searchform")
   var forms = $w("")
   forms.each(function(id) {
      var url = "http://localhost/plugins.e107.org/e107_plugins/jshelpers/ajax_jscaptcha.php";
      var f = $(id);
      if (f) {
         var did = id+"_jscaptcha";
         f.insert({top: new Element("div", {id:did})});
         new Ajax.Updater(did, url, {
            method:"get",
            parameters: "get."+id
         });

         f.observe("submit", function(ev) {
            ev.stop();

            new Ajax.Request(url, {
               method:     "get",
               parameters: "check."+$F(id+'_code')+"."+$F(id+'_verify'),
               onSuccess: function(transport) {
                  if (transport.responseText == "true") {
                     //TODO - duplicate submit button as some forms check for it being submitted and it isn't if you don't actually click it
                     //TODO - what if more none?
                     //TODO - what if more than 1?
                     var subbutton = f.select("input[type=submit]")[0];
                     f.insert({top: new Element("input", {type:"hidden",name:subbutton.name,value:subbutton.value})});
                     f.submit();
                  } else {
                     new Ajax.Updater(did, url, {
                        method:"get",
                        parameters: "get."+id+"."+transport.responseText
                     });
                  }
               }
            });
         });
      }
   });

   // Admin menus
   if (adminPage) {
      $$("[onclick]").each(function (el) {
         el.observe("click", function(ev) {
            new Effect.Pulsate(this);
            new Effect.Highlight(this);
         });
      });
   }

   // Admin form submit
   if (el = $('jshelper_save_prefs')) {
      el.observe('click', function() {
         $('jshelper_admin_page_form').submit();
      });
   }

   // Admin File Serving radio buttons
   $$("input[name=jshelper_file_serving]").each(function (el) {
      el.observe("click", function(ev) {
         var options = {duration: 0.25};
         $(ev.element().id+"_info").show().siblings().invoke('hide');
      });
   })
});

// Redefine some e107's JavaScript functions (from e107.js)
showhideit = function(showID) {
   jshelper.showhideit(showID, hideid);
   hideid = showID; // global e107 variable
}
eover = function(object, over) {
   // Honour what e107 would do
   object.className = over;
   object = $(object);
}
expandit = function(elementOrId, hideCSV) {
   jshelper.expandit(elementOrId, hideCSV);
}
