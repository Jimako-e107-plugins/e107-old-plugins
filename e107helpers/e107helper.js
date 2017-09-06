/*
 * e107Helper
 * Miscellaneous JS helper object for functions that don't fit anywhere else
 */
var e107Helper = {
   // Useful keycodes
   KEY_TAB        : 9,
   KEY_ENTER      : 13,
   KEY_ESC        : 27,
   KEY_PAGE_UP    : 33,
   KEY_PAGE_DOWN  : 34,
   KEY_END        : 35,
   KEY_HOME       : 36,
   KEY_UP         : 38,
   KEY_DOWN       : 40,

   // Holder for main page HMTL whilst a dialog is displayed
   bodyhtml : "",

   // Log message counter
   logcount : 0,

   /**
    *
    */
   addTextToField : function(txt, fieldid) {
      $(fieldid).value = txt;
      expandit(fieldid+"_box")
   },

   /**
    * Used to confirm an action
    * Normally action is some sort of destroy (e.g. delete row from DB). A Javascript confirm
    * dialog is displayed, if positive response button is selected thenh action is allowed to happen, thenh
    * action being to load the next page (which should effect the destroy)
    * @param   string   the message to be displayed in the confirm dialog
    * @param   string   string representing the URL of the page to load is positive response button selected
    * @return  boolean  true if positive response button selected, otherwise false
    */
   confirmDelete : function (msg, loc){
      if (confirm(msg)) {
         document.location = loc;
         return true;
      } else {
         return false;
      }
   },

   /**
    * Displays a dialog
    * A dialog, in this scenario, is normally a form of some sort. Before the dialog is displayed
    * the page is faded (using CSS opacity). It is up to the caller to call the <code>killDialog</code> function is called
    * when the dialog is completed or cancelled.
    * @param   string   the HTML ID attribute to be given to the dialog (actually the DIV that the dialog is dispalyed in)
    * @param   html     the HTML representing the dialog (form) to be displayed
    * @param   width    the width of the dialog in pixels
    * @param   focus    id of copntrol to be given focus when dialog is loaded
    * @param   key      keyboard handler object, will be attached to the onkeypress, onkeydown and onkeyup events of the dialog DIV
    */
   dialog : function (id, html, width, focus, key) {
      var dialog = document.createElement("DIV");
      dialog.style.visibility    = "hidden";
      dialog.id                  = id;
      dialog.style.position      = 'absolute';
      dialog.style.top           = '25px';
      dialog.innerHTML           = html;
      dialog.style.zIndex        = '9999';
      if (typeof key != undefined && key != null) {
         dialog.onkeydown        = function(ev) { eval(key+"(ev)");};
         //dialog.onkeyup          = function(ev) { eval(key+"(ev)");};
         //dialog.onkeypress       = function(ev) { eval(key+"(ev)");};
      }
      var mask = document.createElement("DIV");
      mask.id                    = id+"_mask";
      mask.style.position        = 'absolute';
      mask.style.top             = '0px';
      mask.style.left            = '0px';
      mask.style.height          = '100%';
      mask.style.width           = (e107HelperBrowser.isIE) ? '110%' : '100%';
      mask.style.backgroundColor = 'black';

      mask.style.zIndex          = '9998';

      document.body.appendChild(mask);
      document.body.appendChild(dialog);

      if (e107HelperBrowser.isIE) {
         mask.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=66)';
      } else {
         mask.style.opacity      = '0.66';
      }

      var vpsize = e107HelperSize.getViewportSize();

      if (typeof width != "undefined" && width != null) {
         dialog.style.width = width + 'px';
      }

      var left = (vpsize.width - dialog.offsetWidth) / 2;
      var top  = (vpsize.height - dialog.offsetHeight) / 3;
      if (e107HelperBrowser.isIE) {
         dialog.style.pixelTop   = top;
         dialog.style.pixelLeft  = left;
      } else {
         dialog.style.top        = top+"px";
         dialog.style.left       = left+"px";
      }

      dialog.style.visibility    = "";
      mask.style.visibility      = "";

      if ($(focus) && $(focus).focus()) {
         $(focus).focus();
      }
   },

   dialogKeyHandler : function(event, cancel_event, ok_event) {
      var ev = e107HelperEvents.getEvent(event);
      var key = e107HelperEvents.getKeyCode(ev);
      var tgt = ev.srcElement;

      switch(key) {
         case e107Helper.KEY_ENTER: {
            if (typeof tgt != "undefined" && typeof tgt.type != "undefined" && tgt.type != "button") {
               eval(ok_event);
               ev.returnValue = false;
            }
            break;
         }
         case e107Helper.KEY_ESC: {
            eval(cancel_event);
            ev.returnValue = false;
            break;
         }
         default:
            // let the system handle the key
            ev.returnValue = true;
            return;
      }
   },

   /**
    * Stores the current page
    * To be used before displaying a dialog to save the current page
    */
   killDialog : function (id) {
      var el = $(id);
      if (el) {
         document.body.removeChild(el)
         el = $(id+"_mask");
         document.body.removeChild(el)
      }
   },

   /**
    * Stores the current page
    * To be used before displaying a dialog to save the current page
    * @deprecated
    */
   storeBodyHTML : function () {
      this.bodyhtml = document.body.innerHTML;
   },

   /**
    * Restores the current page
    * To be used after a dialog has been completed or cancelled to restore the current page
    * @deprecated
    */
   restoreBodyHTML : function() {
      document.body.innerHTML = this.bodyhtml;
   },

   /**
    * Display a 'popup' message
    * Generates a 'popup' message on the current page. The 'popup' cannot be closed by the user, it must be closed programatically.
    * The aim of this 'popup' is to indicate to the user that something is happening (e.g. "Processing, please wait...")
    * @param   string   the HTML ID attribute to be given to the message (actually the DIV that the message is dispalyed in)
    * @param   text     the text of the message to be displayed
    */
   message : function (id, text) {
      var msgdiv1 = document.createElement("DIV");
      var msgdiv2 = document.createElement("DIV");
      var msgdiv3 = document.createElement("DIV");
      var br      = document.createElement("BR");
      var button  = document.createElement("INPUT");
      var msgdiv  = document.createElement("DIV");

      e107HelperStyle.addClass(msgdiv1, "forumheader");
      e107HelperStyle.addClass(msgdiv2, "forumheader2");
      e107HelperStyle.addClass(msgdiv3, "forumheader3");
      e107HelperStyle.addClass(button, "button");

      msgdiv1.style.visibility   = "hidden";
      msgdiv1.style.position     = "absolute";
      msgdiv1.id                 = id;

      msgdiv3.style.margin       = "10px";
      msgdiv3.style.padding      = "10px";

      button.type                = "button";
      button.value               = "OK";
      button.style.textAlign     = "right";

      msgdiv.innerHTML = text;
      msgdiv3.appendChild(msgdiv);
      msgdiv2.appendChild(msgdiv3);
      msgdiv1.appendChild(msgdiv2);
      document.body.appendChild(msgdiv1);
      var vpsize = e107HelperSize.getViewportSize();
      var left = (vpsize.width - msgdiv1.offsetWidth) / 2;
      var top  = (vpsize.height - msgdiv1.offsetHeight) / 3;
      if (e107HelperBrowser.isIE) {
         msgdiv1.style.pixelTop     = top;
         msgdiv1.style.pixelLeft    = left;
      } else {
         msgdiv1.style.top          = top+"px";
         msgdiv1.style.left         = left+"px";
      }
      msgdiv1.style.visibility   = "";
   },

   /**
    * Display a timed 'popup' message (@see e107Helper.message)
    * Additionally, this method will cancel the 'popup' after the sepcified number of milliseconds
    * @param   string   the message text to be displayed
    * @param   integer  the numbner of milliseconds that the message should be displayed for (defaults to 2500 = 2.5 seconds if not supplied)
    */
   timedMessage : function (msg, msecs) {
      this.message("e107HelperTimedMessage", msg)
      if (msecs == null) {
         msecs = 2500;
      }
      var timer = setTimeout(
         function () {
            var el = $("e107HelperTimedMessage");
            el.parentNode.removeChild(el);
         }
         , msecs);
   },

   /**
    * Kills (cancels) a 'popup' message (@see e107Helper.message)
    * Used to kill a 'poup' message once processing has finished
    * @param   string   the HTML ID attribute of the message to be killed
    */
   killmessage : function (id) {
      var elem = $(id)
      if (elem) {
         elem.parentNode.removeChild(elem);
      }
   },

   /**
    * Displays a tooltip
    * A dialog, in this scenario, is normally a form of some sort. Before the dialog is displayed
    * the page is faded (using CSS opacity). It is up to the caller to call the <code>killDialog</code> function is called
    * when the dialog is completed or cancelled.
    * @param   string   the HTML ID attribute to be given to the dialog (actually the DIV that the dialog is dispalyed in)
    * @param   html     the HTML representing the dialog (form) to be displayed
    */
   tooltipTimeoutId : 0,
   tooltipDisplay : function (evt, parent, id, html, clazz, minwidth, maxwidth) {
      //this.log("Entering e107Helper.tooltipDisplay()");
      // Remember some info before setting timeout as this is not available in context that timeout function is run
      var vpsize = e107HelperSize.getViewportSize();
      var mousep = e107HelperEvents.getPosition(evt);

      this.tooltipTimeoutId = setTimeout(function tt() {
         //e107Helper.log("Entering tooltipDisplay.tt()");
         //this.log("parent="+parent);
         //this.log("id="+id);
         //this.log("html="+html);
         //this.log("clazz="+clazz);
         //this.log("minwidth="+minwidth);
         //this.log("maxwidth="+maxwidth);

         if ($(id)) {
            this.log("Leaving e107Helper.tooltipDisplay():already displaying tooltip");
            return;
         }

         evt = e107HelperEvents.getEvent(evt);

         var tooltip = document.createElement("DIV");
         tooltip.style.visibility   = "hidden";
         tooltip.id                 = id;
         tooltip.style.position     = 'absolute';
         tooltip.innerHTML          = unescape(html);
         tooltip.style.zIndex       = '-1'; // effectively hidded, but we can get it's size information for positioning;
         e107HelperStyle.addClass(tooltip, clazz);

         document.body.appendChild(tooltip);

         // Make this themeable
         if (e107HelperBrowser.isIE) {
            tooltip.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=85)';
         } else {
            tooltip.style.opacity      = '0.85';
         }

         var ttsize = e107HelperSize.getElementSize(tooltip);

         // Fiddle with width before positioning
         if (typeof minwidth != "undefined" && minwidth > 0 && ttsize.width < minwidth) {
            tooltip.style.width     = minwidth+"px";
         }

         if (typeof maxwidth != "undefined" && maxwidth > 0 && ttsize.width > maxwidth) {
            tooltip.style.width     = maxwidth+"px";
         }

         var ttsize = e107HelperSize.getElementSize(tooltip);
         // TODO Fairly crude postition calculation, needs tidying up
         ttsize.left = mousep.x - ttsize.width/2;
         ttsize.top  = mousep.y - ttsize.height - 6;
         ttsize.left = ttsize.left < 0 ? 0 : ttsize.left;
         ttsize.top  = ttsize.top < 0 ? 0 : ttsize.top;
         ttsize.left = ttsize.left+ttsize.width > vpsize.width ? vpsize.width-ttsize.width : ttsize.left;
         ttsize.top  = ttsize.top < mousep.scrollY ? mousep.scrollY : ttsize.top;

         if (e107HelperBrowser.isIE) {
            tooltip.style.pixelLeft = ttsize.left;
            tooltip.style.pixelTop  = ttsize.top;
         } else {
            tooltip.style.left      = ttsize.left+"px";
            tooltip.style.top       = ttsize.top+"px";
         }

         tooltip.style.visibility   = "";
         tooltip.style.zIndex       = '9999';

         //this.log(tooltip);
         //e107Helper.log("Leaving e107Helper.tooltipDisplay():displayed tooltip");
      }, 1000);
   },
   tooltipMove : function (evt, id) {
      // TODO - not yet implemented
      var posx=0;
      var posy=0;
      if (e==null) {
         e=window.event;
      }
      if (e.pageX || e.pageY) {
          posx=e.pageX; posy=e.pageY;
      }
      else if (e.clientX || e.clientY) {
         if (document.documentElement.scrollTop) {
            posx=e.clientX+document.documentElement.scrollLeft;
            posy=e.clientY+document.documentElement.scrollTop;
         } else {
            posx=e.clientX+document.body.scrollLeft;
            posy=e.clientY+document.body.scrollTop;
         }
      }
      $("btc").style.top=(posy+10)+"px";
      $("btc").style.left=(posx-20)+"px";
   },
   tooltipDestroy : function (evt, id) {
      //this.log("Entering e107Helper.tooltipDestroy()");
      //this.log("id="+id);
      var tooltip = $(id);

      if (this.tooltipTimeoutId != 0) {
         clearTimeout(this.tooltipTimeoutId);
         this.tooltipTimeoutId = 0;
         //this.log("cleraing tooltip timout");
      }

      if (tooltip) {
         var ttsize = e107HelperSize.getElementSize(tooltip);
         var mousep = e107HelperEvents.getPosition(evt);

         if ((ttsize.left < mousep.x && mousep.x < ttsize.right)
          && (ttsize.top < mousep.y && mousep.y < ttsize.bottom))
         {
            // Mouse is still over 'hotspot', tooltip has most likely caused mouseout as it's covering the hotspot.
            // Don't kill the tooltip yet, transfer the mouseout to the tooltip instead.
            tooltip.onmouseout = function () {e107Helper.tooltipDestroy2(evt, id);};
            tooltip.onclick = function () {e107Helper.tooltipDestroy2(evt, id);};
            return;
         }

         tooltip.parentNode.removeChild(tooltip);
      }
      //this.log("Leaving e107Helper.tooltipDestroy():destroyed tooltip");
      return;
   },
   tooltipDestroy2 : function (evt, id) {
      //this.log("Entering e107Helper.tooltipDestroy():destroyed tooltip");
      //this.log("id="+id);
      var tooltip = $(id);
      tooltip.parentNode.removeChild(tooltip);
      //this.log("Leaving e107Helper.tooltipDestroy():destroyed tooltip");
      return;
   },

   /**
    * setvalue
    * Set the value of a form field
    * @param   string   text to be set
    * @param   string   a value to be used as a delimiter - will append the supplied text to existing text,
    *                   empty string (or not set) to just replace value
    */
   setvalue : function(id, txt, append) {
      if (typeof append == "string" && append.length > 0) {
         if ($(id).value.length > 0) {
            $(id).value = $(id).value+append+txt;
         } else {
            $(id).value = txt;
         }
      } else {
         $(id).value = txt;
      }
   },

   /**
    * rateStars
    */
   rateStars : function(path, prefix, id, what) {
      var src = path+'/star_rating.gif';
      if (what) {
         src = path+'/star_rating_selected.gif';
      }
      for (var i=1; i<=id; i++) {
         var obj = $(prefix+i);
         if (obj) {
            obj.src = src;
         }
      }
   },

   /**
    * editInline
    * Allows a display only fieldto be turned in to an edit field when clicked
    * @param   string   the field type to convert to. Supported types are: text, textarea
    * @param   string   id of the database item to update
    * @param   string   id of the fields container outer container
    * @param   string   javascript function to be called on field update (blur)
    */
   editInline : function(fieldType, itemId, fieldName, jsfunc, prefix, postfix) {
      this.logDebug("editInline(fieldType="+fieldType+", itemId="+itemId+", fieldName="+fieldName+", jsfunc="+jsfunc+")");
      var thespan = "e107helper_"+fieldName;
      var thetextspan = "e107helper_"+fieldName+"_text";
      var thehiddentextspan = "e107helper_"+fieldName+"_hiddentext";
      var el  = $(thehiddentextspan);
      if (!el) {
         el = $(thetextspan);
      }
      var oldText = el.firstChild.nodeValue;
      //var oldText = $(thespan).firstChild.firstChild.nodeValue;
      ////var oldText = $(thespan).firstChild.innerHTML;

      var newId = fieldName+"_input";
      //var commonattribs = "class='tbox' style='width:100%' id='"+newId+"' onblur='"+jsfunc+"(\""+itemId+"\", \""+fieldName+"\", \""+newId+"\", \""+thespan+"\");return false;'";
      var commonattribs = "class='tbox' style='width:100%' id='"+newId+"'";
      var inlineField = "";
      if (prefix.length > 0) {
         inlineField += prefix;
      }
      switch (fieldType) {
         case "textarea" : {
            // Guess the number of rows
            inlineField += "<textarea "+commonattribs+" rows='3' onkeyup='resizeTextArea(this);'></textarea>";
            break;
         }
         case "text" : {
            inlineField += "<input type='text' "+commonattribs+">";
            break;
         }
      }
      if (postfix.length > 0) {
         inlineField += postfix;
      }
      inlineField += "<input type='button' class='button' onclick='"+jsfunc+"(\""+itemId+"\", \""+fieldName+"\", \""+newId+"\", \""+thespan+"\");return false;' value='OK'>";
      inlineField += " ";
      inlineField += "<input type='button' class='button' onclick='e107Helper.editInlineCancel(\""+fieldName+"\");' value='Cancel'>";

      $(thespan).oldHTML = $(thespan).innerHTML;
      $(thespan).innerHTML = inlineField;
      $(newId).value = oldText;
      resizeTextArea($(newId));
      $(newId).focus();
   },

   /**
    * editInlineCancel
    * Cancel an inline edit and restore the original HTML
    * @param   string   id of the fields container outer container
    */
   editInlineCancel : function(fieldName) {
      this.logDebug("editInline(fieldName="+fieldName+")");
      var thespan = $("e107helper_"+fieldName);
      thespan.innerHTML = thespan.oldHTML;
      $("e107helper_"+fieldName+"_a").focus();
   },

   parseForm : function(fieldType, fieldName) {
      this.logDebug("parseForm("+fieldType+", "+fieldName+")");
      //var st = $(inputID).value + '~~|~~' + cellID;
      var newHTML = "<span onclick='e107Helper.editInline(\""+fieldType+"\", \""+fieldName+"\");'>";
      var newId = fieldName+"input";
      newHTML += $(newId).value;
      newHTML += "</span>";
      $(fieldName).innerHTML = newHTML;
   },

   /**
    * Dual list item moving
    * - 1 move all items from left to right
    * - 2 move selected item from left to right
    * - 3 move selected item from right to left
    * - 4 move all items from right to left
    */
   dualListMove : function(type, id) {
      var list = $(id+"_list").value.evalJSON();
      //list.each(function(item, ix) {
      //   alert(item);
      //   alert(ix);
      //});
      var left = $(id+"_left");
      var right = $(id+"_right");
      if (type==1 || type==2) {
         var src = $(id+"_left");
         var tgt = $(id+"_right");
      } else {
         var src = $(id+"_right");
         var tgt = $(id+"_left");
      }
      if (type==2 || type==3) {
         if (src.selectedIndex != -1) {
            var src_value = src.options[src.selectedIndex].value;
            var src_text  = src.options[src.selectedIndex].text;
            tgt.options[tgt.length] = new Option(src_text, src_value, false, false);
            src.remove(src.selectedIndex);
            var current = new Array(0);
            current[0] = "0";
            for (ix=0; ix<right.length; ix++) {
               current[current.length] = right.options[ix].value;
            }
            $(id).value = current.toString();
         }
      } else {
         while (src.length) {
            var src_value = src.options[0].value;
            var src_text  = src.options[0].text;
            tgt.options[tgt.length] = new Option(src_text, src_value, false, false);
            src.remove(0);
         }
         var current = new Array(0);
         current[0] = "0";
         for (ix=0; ix<right.length; ix++) {
            current[current.length] = right.options[ix].value;
         }
         $(id).value = current.toString();
      }
   },

   /**
    * Firebug wrappers
    * Wrappers for firebug calls to allow conditional logging based on log level
    * Requires firebug lite (which is included by e107 Helper) for browsers other than Firefox
    */
   log : function(message) {
      //window.console.log(message);
   },
   logDebug : function(message) {
      //window.console.debug(message);
   },
   logInfo : function(message) {
      //window.console.info(message);
   },
   logWarn : function(message) {
      //window.console.warn(message);
   },
   logError : function(message) {
      //window.console.error(message);
   },
   logTrace : function() {
      //window.console.trace();
   },
   logEnter : function(fname) {
      //window.console.time(fname);
      //window.console.group(fname);
   },
   logExit : function(fname, ret) {
      if (ret == "undefined") {
         ret = "No return value set";
      }
      //window.console.debug(ret);
      //window.console.timeEnd(fname);
      //window.console.groupEnd();
   },
   logTime : function(name) {
      //window.console.time(name);
   },
   logTimeEnd : function(name) {
      //window.console.timeEnd(name);
   },

   /**
    * A doNothing function
    */
   doNothing : function() {
   },

   /**
    * alert
    * Duplicates the Javascript alert functionality - may be expanded to allow alerts to be turned on/off for debugging.
    */
   alert : function(txt) {
      alert(txt);
   }
};

/*
 * e107HelperStyle
 * Helper object for style handling
 */
var e107HelperStyle = {
   addClass : function(el, clazz) {
      if (!this.hasClass(el, clazz)) {
         el.className += (" " + clazz);
      }
   },
   removeClass : function(el, clazz) {
      if (el.className == null) {
         return;
      }
      var list = el.className.split(" ");
      for (var i=0; i<list.length; ++i ) {
         if (list[i] == clazz) {
            list[i] = "";
         }
      }
      el.className = list.join(" ");
   },
   hasClass : function(el, clazz) {
      var list = el.className.split(" ");
      for (var i=0; i<list.length; ++i ) {
         if (list[i] == clazz) {
            return true;
         }
      }
      return false;
   }
}

/*
 * e107HelperSize
 * Helper object for size information
 */
var e107HelperSize = {
   getViewportSize : function() {
      function isMozHorizScollBarShowing() {
         return ((document.body.offsetWidth < window.innerWidth ) && ( document.documentElement.offsetWidth > document.body.offsetWidth));
      }
      return {
          width : document.body.clientWidth,
          height: e107HelperBrowser.isIE ? document.body.clientHeight : window.innerHeight - (isMozHorizScollBarShowing() ? 15 : 0)
      }
   },
   getElementSize : function(elem) {
      var x = (e107HelperBrowser.isIE) ? elem.style.pixelLeft : elem.style.left.replace("px", "");
      var y = (e107HelperBrowser.isIE) ? elem.style.pixelTop  : elem.style.top.replace("px", "");
      var w = elem.offsetWidth;
      var h = elem.offsetHeight;
      var r = parseInt(x)+parseInt(w);
      var b = parseInt(y)+parseInt(h);
      //e107Helper.log("getElementSize("+elem.id+") : x="+x+" y="+y+" w="+w+" h="+h+" r="+r+" b="+b)
      return {
         left   : x,
         top    : y,
         width  : w,
         height : h,
         right  : r,
         bottom : b
      };
   }
}

/*
 * e107HelperEvent
 * Helper object for event handling (onclick, onkeydown, etc.)
 */
var e107HelperEvents = {
   getEvent : function(evt) {
      if (typeof window.event != "undefined") {
         evt = window.event;
      }
      return evt;
   },
   getCharCode : function( evt ) {
      // Old versions of IWB populate keyCode incorrectly.
      var cc = evt.charCode;
      if ( e107HelperBrowser.isIWB ) {
         // for Ctrl+cursor key/Insert/Delete/Home/End/Page Up/Page Down we
         // get cc of 945 instead of 0. The keyCode is correct.
         if ( cc == 945 && evt.type == "keypress" && evt.ctrlKey ) {
            cc = 0;
         }
      }
      return cc;
   },
   getKeyCode : function( evt ) {
      // Old versions of IWB populate keyCode incorrectly.
      var kc = evt.keyCode;
      if ( e107HelperBrowser.isIWB20 ) {
         // The VKs for lowercase should be the same as uppercase
         if ( evt.type == "keyup" ) {
            // kc has flags in high byte
            if ( kc > 255 ) {
               kc &= 0xff;
               if ( 97 <= kc && kc <= 122 ) {
                  kc -= 32;
               }
            }
         } else if ( evt.type == "keydown" ) {
            // This is not perfect e.g. lowercase W is the same as F8
            if ( 97 <= kc && kc <= 122 ) {
               kc -= 32;
            }
         }
      }
      return kc;
   },
   getTarget : function (event) {
      return ( (e107HelperBrowser.isMoz) ? event.target : window.event.srcElement)
   },
   getPosition : function (evt) {
      // IE varies depending on standard compliance mode
      if (e107HelperBrowser.isIE) {
         var doc = ((document.compatMode && document.compatMode == 'CSS1Compat') ? document.documentElement : document.body);
         if (doc) {
            var x       = evt.clientX + doc.scrollLeft;
            var y       = evt.clientY + doc.scrollTop;
            var scrollX = doc.scrollLeft;
            var scrollY = doc.scrollTop;
         }
      } else {
         var x       = evt.pageX;
         var y       = evt.pageY;
         var scrollX = evt.pageX - evt.clientX;
         var scrollY = evt.pageY - evt.clientY;
      }

      //e107Helper.log("getPostion() : evt.screenY="+evt.screenY+", evt.pageY="+evt.pageY+", evt.clientY="+evt.clientY)
      //e107Helper.log("getPostion() : x="+x+" y="+y+" scrollX="+scrollX+" scrollY="+scrollY+", evt.clientX="+evt.clientX+", evt.clientY="+evt.clientY)
      return {x:x, y:y, scrollX:scrollX, scrollY:scrollY};
   },
   boundEvents : [],
   bindHandler : function( target, eventName, handler ) {
      if ( target.addEventListener ) {
         target.addEventListener( eventName, handler, false );
      } else if ( target.attachEvent ) {
         target.attachEvent( "on" + eventName, handler );
      }
      e107HelperEvents.boundEvents.push( arguments );
   },
   unbindHandler : function( target, eventName, handler ) {
      if ( target.removeEventListener ) {
         target.removeEventListener( eventName, handler, false );
      } else if ( target.removeEvent ) {
         target.removeEvent( "on" + eventName, handler );
      }
   },
   dispose : function() {
      for(var i = e107HelperEvents.boundEvents.length - 1; i >= 0; --i ) {
         var be = e107HelperEvents.boundEvents[i];
         if (be[1] != "unload") {
            e107HelperEvents.unbindHandler( be[0], be[1], be[2] );
         }
         be[i] = null;
      }
   }
}

e107HelperEvents.bindHandler(window, "unload", e107HelperEvents.dispose);

/*
 * e107HelperBrowser
 * Helper object to determine the client browser
 */
var e107HelperBrowser = {
   ua       : navigator.userAgent,
   isMoz    : /Gecko/i.test(navigator.userAgent),
   isIE55   : /msie 5\.5/i.test(navigator.userAgent),
   isIE6    : /msie 6/i.test(navigator.userAgent),
   isIE     : /msie/i.test(navigator.userAgent),
   isIWB    : /Gecko/i.test(navigator.userAgent) && (/OS\/2/.test(navigator.platform) || /^Warp/.test(navigator.platform)),
   isIWB20  : /Gecko/i.test(navigator.userAgent) && /^Warp/.test(navigator.platform),
   platform : navigator.platform
}

/*
 * e107HelperColor
 * Helper object for color picker 'widget'
 */
var e107HelperColor = {
   view : function(field,color) {
      var fieldname = 'ColorPreview_' + field;
      if (this.validateColor(color)) {
         $(fieldname).style.backgroundColor = '#' + color;
         $(field).value = color;
      } else {
         alert('Your color-code is not valid');
         $(field).focus();
      }
   },
   set : function(field,string) {
      var color = this.validateColor(string);
      if (color == null) {
         alert('Invalid color code: ' + string);
      }
      else {
         this.view(field,color);
         $(field).value = color;
      }
   },
   validateColor : function(string) {
      string = string || '';
      string = string + "";
      string = string.toUpperCase();
      var chars = '0123456789ABCDEF';
      var out   = '';

      for (var i=0; i<string.length; i++) {
         var schar = string.charAt(i);
         if (chars.indexOf(schar) != -1) {
            out += schar;
         }
      }

      if (out.length != 6) {
         return null;
      }
      return out;
   }
}

/*
 * e107HelperAutoSuggest
 * Ajax helper object for auto suggest text fields
 * Based on code from http://gadgetopia.com/autosuggest/
 */
var e107HelperAutoSuggest = {
   suggestions : new Array(), // Array to store suggestions that match the user's input
   urls        : new Array(), // List of URL's that are the Ajax request processors
   inputText   : null,        // The text input by the user.
   highlighted : -1,          // A pointer to the index of the highlighted suggestions item. -1 means nothing highlighted.
   div         : null,        // A div to use to create the dropdown, set in add function

   /**
    * Adds the auto suggest functionality to a text input control.
    * @param   elem  the text input control that is to get auto suggest functionality
    * @param   url   the URL of the Ajax request processor
    */
   add : function(elem, url) {
      if (this.div == null) {
         // First time in so create a hidden DIV which we wil luse to display suggestions
         //this.div                   = document.createElement("DIV");
         //var emptyList              = document.createElement("UL");
         //this.div.id                = "e107helperautosuggest";
         //this.div.style.visibility  = "hidden";
         //this.div.appendChild(emptyList);
         //document.body.appendChild(this.div);
         document.writeln("<div id='e107helperautosuggest' style='height:200px;overflow:scroll;display:none;'><ul></ul></div>");
         this.div = $("e107helperautosuggest");
      }

      e107HelperAutoSuggest.urls[elem.id] = url;

      /**
       * Key down event handler for the input element.
       * Enter                      use the highlighted suggestion, if there is one.
       * Esc                        hide the suggestion dropdown
       * Up/down/page up/page down  Move the highlight up and down in the suggestions.
       * @param   event the event object
       */
      elem.onkeydown = function(event) {
         var ev = e107HelperEvents.getEvent(event);
         var key = e107HelperEvents.getKeyCode(ev);
         var tgt = ev.srcElement;

         switch(key) {
            case e107Helper.KEY_TAB :
//               if (!ev.isAlt && !ev.isCtrl) {
// for Opera
               if (!ev.altKey && !ev.ctrlKey) {
                  // Only do this if tab navigation is to another control on this page
                  e107HelperAutoSuggest.showDiv(false);
                  this.focus();
               }
               break;
            case e107Helper.KEY_ENTER :
               e107HelperAutoSuggest.useSuggestion(tgt);
               e107HelperAutoSuggest.showDiv(false);
               ev.returnValue = false;
               break;
            case e107Helper.KEY_ESC :
               e107HelperAutoSuggest.showDiv(false);
               break;
            case e107Helper.KEY_UP :
               if (e107HelperAutoSuggest.highlighted > 0) {
                  e107HelperAutoSuggest.highlighted--;
               }
               e107HelperAutoSuggest.changeHighlight();
               break;
            case e107Helper.KEY_DOWN :
               if (e107HelperAutoSuggest.highlighted == -1 && e107HelperAutoSuggest.suggestions.length > 0) {
                  e107HelperAutoSuggest.getSuggestions(tgt);
               } else if (e107HelperAutoSuggest.highlighted < (e107HelperAutoSuggest.suggestions.length - 1)) {
                  e107HelperAutoSuggest.highlighted++;
               }
               e107HelperAutoSuggest.changeHighlight();
               break;
            case e107Helper.KEY_HOME :
               if (e107HelperAutoSuggest.highlighted > 0) {
                  e107HelperAutoSuggest.highlighted = 0;
               }
               e107HelperAutoSuggest.changeHighlight();
               break;
            case e107Helper.KEY_END :
               if (e107HelperAutoSuggest.highlighted < e107HelperAutoSuggest.suggestions.length-1) {
                  e107HelperAutoSuggest.highlighted = e107HelperAutoSuggest.suggestions.length-1;
               }
               e107HelperAutoSuggest.changeHighlight();
               break;
         }
      };

      /**
       * Key up event handler for the input element.
       * If there is some text and it has changed from the last time we got a keyup event display a list of suggestions.
       * @param   ev the event Object
       */
      elem.onkeyup = function(evt) {
         var ev = e107HelperEvents.getEvent(evt);
         var key = e107HelperEvents.getKeyCode(ev);
         var tgt = ev.srcElement;

         switch(key) {
            // The control keys were already handled by onkeydown, so do nothing.
            case e107Helper.KEY_ENTER:
            case e107Helper.KEY_ESC:
            case e107Helper.KEY_UP:
            case e107Helper.KEY_DOWN:
            case e107Helper.KEY_PAGE_UP:
            case e107Helper.KEY_PAGE_DOWN:
            case e107Helper.KEY_HOME:
            case e107Helper.KEY_END:
               return;
            default:
               if (this.value.length > 0) {
                  if (this.value != e107HelperAutoSuggest.inputText) {
                     e107HelperAutoSuggest.inputText = this.value;
                     e107HelperAutoSuggest.getSuggestions(tgt);
                  }
               } else {
                  e107HelperAutoSuggest.inputText = "";
                  e107HelperAutoSuggest.showDiv(false);
               }
         }
      };

      /**
       * Insert the highlighted suggestion into the input box, and remove the suggestion dropdown.
       */
      this.useSuggestion = function(tgt) {
         if (this.highlighted > -1) {
            tgt.value = this.suggestions[this.highlighted];
            this.showDiv(false);
         }
      };

      /**
       * Show or hide the DIV used to display suggestions.
       * @param   showit   true to show DIV, false to hide it
       */
      this.showDiv = function(showit) {
         if (showit) {
            e107HelperAutoSuggest.div.style.display      = 'block';
            e107HelperAutoSuggest.div.style.visibility   = '';
         } else {
            e107HelperAutoSuggest.div.style.display      = 'none';
            e107HelperAutoSuggest.div.style.visibility   = 'hidden';
            this.highlighted = -1;
         }
      };

      /**
       * Modify the HTML in the dropdown to move the highlight.
       */
      this.changeHighlight = function() {
         var lis = e107HelperAutoSuggest.div.getElementsByTagName('LI');
         for (i in lis) {
            var li = lis[i];

            if (this.highlighted == i) {
               li.style.backgroundColor = "Highlight";
               li.firstChild.style.color = "HighlightText";
               li.scrollIntoView(false);
            } else {
               if (li.style) {
                  li.style.backgroundColor = "";
                  li.firstChild.style.color = "";
               }
            }
         }
      };

      /**
       * Build the HTML for the dropdown div.
       * @param   tgt   text input control that DIV is to be created for
       */
      this.createDiv = function(tgt) {
         var ul                  = document.createElement('ul');
         ul.style.padding        = "0px";
         ul.style.margin         = "0px";
         ul.style.listStyleType  = "none";

         //Create an array of LI's for the words.
         for (i in this.suggestions) {
            if (!isNaN(i)) {
               var word                = this.suggestions[i].replace(/\s/g, "&nbsp;"); // Convert spaces to non-breaking spaces for display
               var li                  = document.createElement('li');
               var a                   = document.createElement('a');
               a.href                  = "javascript:return false";
               a.id                    = "e107helperautocomplete_"+tgt.id;
               a.style.textDecoration  = "none";
               a.innerHTML             = word;
               li.appendChild(a);
               if (e107HelperAutoSuggest.highlighted == i) {
                  ////li.className = "selected";
               }
               ul.appendChild(li);
            }
         }

         e107HelperAutoSuggest.div.replaceChild(ul,e107HelperAutoSuggest.div.childNodes[0]);

         /**
          * mouseover event handler for the dropdown ul.
          * move the highlighted suggestion with the mouse
          * @param   ev the event Object
          */
         ul.onmouseover = function(evt) {
            //Walk up from target until you find the LI.
            var ev = e107HelperEvents.getEvent(evt);
            var target = ev.srcElement;
            while (target.parentNode && target.tagName.toUpperCase() != 'LI') {
               target = target.parentNode;
            }

            var lis = e107HelperAutoSuggest.div.getElementsByTagName('LI');


            for (i in lis) {
               var li = lis[i];
               if (li == target) {
                  e107HelperAutoSuggest.highlighted = i;
                  break;
               }
            }
            e107HelperAutoSuggest.changeHighlight();
         };

         /**
          * mouseover event handler for the dropdown ul.
          * Insert the clicked suggestion into the text input control
          * @param   ev the event Object
          */
         ul.onclick = function(evt) {
            var ev = e107HelperEvents.getEvent(evt);
            e107HelperAutoSuggest.useSuggestion($(ev.srcElement.id.substring(23)));
            e107HelperAutoSuggest.showDiv(false);
            ev.returnValue = false;
            return false;
         };

         e107HelperAutoSuggest.div.className="tbox";
         e107HelperAutoSuggest.div.style.border = "1px solid";
         e107HelperAutoSuggest.div.style.padding = "4px";
         e107HelperAutoSuggest.div.style.position = 'absolute';

         // Position the DIV in the right place, relative to the text input control
         var x = 0;
         var y = tgt.offsetHeight;

         //Walk up the DOM and add up all of the offset positions.
         while (tgt.offsetParent && tgt.tagName.toUpperCase() != 'BODY') {
            x += tgt.offsetLeft;
            y += tgt.offsetTop;
            tgt = tgt.offsetParent;
         }

         x += tgt.offsetLeft;
         y += tgt.offsetTop;

         e107HelperAutoSuggest.div.style.left = x + 'px';
         e107HelperAutoSuggest.div.style.top = y + 'px';
      };

      /**
       * Get a list of suggestions from the server
       * @param   tgt   the text field control for which suggestions are required
       */
      this.getSuggestions = function(tgt) {
         e107HelperAjax.addParm("action", "getautosuggestions");
         e107HelperAjax.addParm("id", tgt.id);
         e107HelperAjax.addParm("value", tgt.value);
         e107HelperAjax.post(e107HelperAutoSuggest.urls[tgt.id]);
      };
   },

   /**
    * Ajax callback function to set suggested values obtained from server in the dropdown DIV.
    * @param   id             id of the input text control for which suggestions are to be displayed for
    * @param   value          original value of input text field
    * @param   suggestionss   comma seperated list of suggestions to be displayed
    */
   setSuggestions : function(id, value, suggestions) {
      var tgt = $(id);
      // Ensure we have a valid target
      if (typeof tgt != "undefined") {
         // Only process of content of target has not changed
         if (tgt.value == value) {
            suggestions = suggestions.split(",");

            this.suggestions.length = 0;
            for (var i=0; i<suggestions.length; i++) {
               if (suggestions[i].length > 0) {
                  this.suggestions.push(suggestions[i]);
               }
            }

            e107HelperAutoSuggest.createDiv(tgt);
            e107HelperAutoSuggest.showDiv(true);
            e107HelperAutoSuggest.highlighted = 0;
            e107HelperAutoSuggest.changeHighlight();
         }
      }
   }
}

/*
 * e107HelperAjax
 * Ajax helper object for JavasCript/HTTP Request communication with the server
 */
var e107HelperAjax = {
   parms : "",
   getRequester : function() {
      // Create an instance of the XML HTTP Request object
      var oXMLHTTP;

      try {
         oXMLHTTP=new ActiveXObject("Msxml2.XMLHTTP")
      } catch (e) {
         try {
            oXMLHTTP=new ActiveXObject("Microsoft.XMLHTTP")
         } catch (e) {
         }
      }

      // Non IE browsers start here.
      if (typeof oXMLHTTP == "undefined") {
         try {
            oXMLHTTP = new XMLHttpRequest();
         } catch (e) {
         }
      }
      return oXMLHTTP;
   },
   post : function(uri, async) {
      //alert("Posting");
      // default to async
      if (typeof async == "undefined") {
         async = true;
      }
//      var req = this.getRequester();
      var req = new XMLHttpRequest();  // Need to ensure e_ajax.php is included as this caters for different browser implementations of XMLHttpRequest
      if (async) {
         req.onreadystatechange = function() {
            // 0 uninitialized   Object created, open not called yet
            // 1 loading         Called open but not send
            // 2 loaded          Called send, got status and headers but not body
            // 3 interactive     Some data received (and available) but not all
            // 4 completed       All the data has been received
            //alert(req.readyState);
            if (req.readyState == 4) {
               e107HelperAjax.responseHandler(req);
            }
         };
      }
      req.open("POST", uri, async);
      req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      //alert(this.parms);
      req.send(this.parms);
      this.parms = "";
      if (!async) {
         this.responseHandler(req);
      }
   },
   addParm : function(name, value) {
      if (this.parms.length > 0){
         this.parms += "&";
      }
      this.parms += escape(name) + "=" + encodeURIComponent(value);
   },
   addParms : function(params) {
      if (this.parms.length > 0){
         this.parms += "&";
      }
      this.parms += params;
   },
   responseHandler : function (req) {
      if (req.responseXML == null) {
         // It's text
      } else if (req.responseXML.getElementsByTagName("e107helperajax").length > 0) {
         // It's an XML message so get a node list represneting a list of all nodes inside the e107helperajax node
         // other nodes outside of e107helperajax will be ignored
         var nodes = req.responseXML.getElementsByTagName("e107helperajax")[0].childNodes;

         // Now process each direct child node, according to it's type attribute
         for (i=0; i<nodes.length ; i++) {

            // Do not process anything other than element nodes
            if (nodes[i].nodeType != 1) {
               //alert("Ignoring nodeType"+nodes[i].nodeType);
               continue;
            }

            // Pick out the nodes we know how to handle
            switch (nodes[i].getAttribute("type")) {
               // A simple Javascript alert
               case "alert" : {
                  alert(nodes[i].firstChild.data);
                  break;
               }
               // An e107Helper dialog box
               case "dialog" : {
                  e107Helper.dialog(nodes[i].getAttribute("id"), nodes[i].firstChild.data, nodes[i].getAttribute("width"), nodes[i].getAttribute("focus"), nodes[i].getAttribute("key"));
                  break;
               }
               // Remove an e107Helper dialog box
               case "killdialog" : {
                  e107Helper.killDialog(nodes[i].getAttribute("id"));
                  break;
               }
               // HTML to be added as the innerhtml property of a page element (replacing what was there)
               case "innerhtml" : {
                  var id = nodes[i].getAttribute("id");
                  var el = $(id);
                  if (el) {
                     var html = nodes[i].firstChild.data.toString();
                     switch (nodes[i].getAttribute("effect")) {
                        case "blind" :
                           var duration = nodes[i].getAttribute("duration") ? nodes[i].getAttribute("duration") : "1.0";
                           new Effect.BlindUp(id,
                           {
                              duration    : duration,
                              afterFinish : function() {
                                 $(id).innerHTML = html;
                                 new Effect.BlindDown(id,
                                 {
                                    duration    : duration,
                                    afterFinish : function() {
                                       html.evalScripts();
                                    }
                                 });
                              }
                           });
                           break;
                        case "swap" :
                           var id2 = $(nodes[i].getAttribute("id2"));
                           var duration = nodes[i].getAttribute("duration") ? nodes[i].getAttribute("duration") : "1.0";
                           id2.innerHTML = html;
                           new Effect.divSwap(id2, id, duration);
                           setTimeout(
                              function() {
                                 html.evalScripts();
                              }, (1000*duration)+1000); // Allow time for DOM to be updated
                           break;
                        case "fade" :
                           var duration = nodes[i].getAttribute("duration") ? nodes[i].getAttribute("duration") : "1.0";
                           new Effect.Fade(id,
                           {
                              duration    : duration,
                              afterFinish : function() {
                                 $(id).innerHTML = html;
                                 new Effect.Appear(id,
                                 {
                                    duration    : duration,
                                    afterFinish : function() {
                                       html.evalScripts();
                                    }
                                 });
                              }
                           });
                           break;
                        default :
                           $(nodes[i].getAttribute("id")).innerHTML = html;
                           html.evalScripts();
                     }
                  }
                  break;
               }
               // Javascript to be evaluated
               case "js" : {
                  // old not used by bugrain! eval(nodes[i].getAttribute("func"));
                  eval(nodes[i].firstChild.data);
                  break;
               }
               // Set the value of a form field
               case "setvalue" : {
                  e107Helper.setvalue(nodes[i].getAttribute("id"), nodes[i].firstChild.data, nodes[i].getAttribute("append"));
                  break;
               }
               // Kills a 'popup' message (@see e107Helper.message)
               case "killmessage" : {
                  e107Helper.killmessage(nodes[i].getAttribute("id"));
                  break;
               }
               // Restores the saved HTML source
               case "restorebody" : {
                  e107Helper.restoreBodyHTML();
                  break;
               }
               // Display a timed 'popup' message (@see e107Helper.message)
               case "timedmessage" : {
                  e107Helper.timedMessage(nodes[i].firstChild.data, nodes[i].getAttribute("msecs"));
                  break;
               }
               // Display a timed 'popup' message (@see e107Helper.message)
               case "autosuggestions" : {
                  e107HelperAutoSuggest.setSuggestions(nodes[i].getAttribute("id"), nodes[i].getAttribute("value"), nodes[i].firstChild.data);
                  break;
               }
               case "transition" : {
                  var id = nodes[i].getAttribute("id");
                  var delay = nodes[i].getAttribute("delay");
                  var el = $(id);
                  if (el) {
                     switch (nodes[i].getAttribute("effect")) {
                        case "appear" : {
                           new Effect.Appear(id);
                           break;
                        }
                        case "blinddown" : {
                           new Effect.BlindDown(id);
                           break;
                        }
                        case "blindup" : {
                           new Effect.BlindUp(id);
                           break;
                        }
                        case "fade" : {
                           new Effect.Fade(id);
                           break;
                        }
                     }
                  }
               }
               default : {
                  // Do nothing
               }
            }
         }
      }
   },
   refreshImageTag : function(el, uri, tagId, base) {
      this.addParm("action", "refreshImageTag");
      this.addParm("id", tagId);
      this.addParm("base", base);
      this.addParm("dir", el.value);
      this.post(uri);
   },
   toggleImage : function(uri, id, img1, img2) {
      this.addParm("action", "toggleImage");
      this.addParm("id", id);
      this.addParm("img1", img1);
      this.addParm("img2", img2);
      this.post(uri);
   },
   rate : function(uri, url, divid, pluginid, itemid, allowrating, notext, allstars, rating) {
      e107Helper.log("action="+"rate");
      e107Helper.log("url="+url);
      e107Helper.log("divid="+divid);
      e107Helper.log("pluginid="+pluginid);
      e107Helper.log("itemid="+itemid);
      e107Helper.log("allowrating="+allowrating);
      e107Helper.log("notext="+notext);
      e107Helper.log("allstars="+allstars);
      e107Helper.log("rating="+rating);
      e107HelperAjax.addParm("action", "rate");
      e107HelperAjax.addParm("url", url);
      e107HelperAjax.addParm("divid", divid);
      e107HelperAjax.addParm("pluginid", pluginid);
      e107HelperAjax.addParm("itemid", itemid);
      e107HelperAjax.addParm("allowrating", allowrating);
      e107HelperAjax.addParm("notext", notext);
      e107HelperAjax.addParm("allstars", allstars);
      e107HelperAjax.addParm("rating", rating);
      e107HelperAjax.post(uri);
   },
   showCustomField : function(uri, id) {
      this.addParm("action", "showCustomFields");
      this.addParm("id", id);
      this.addParm("customfields", $(id).value);
      this.post(uri);
   },
   resetCustomField : function(uri, id) {
      this.addParm("action", "resetCustomFields");
      this.addParm("id", id);
      $(id).value = 'a:1:{s:24:"e107HelperCustomField_id";s:18:"'+id+'";}';
      this.addParm("customfields", $(id).value);
      this.post(uri);
   },
   addCustomField : function(uri, id, step, fieldtype, fieldname) {
      e107Helper.logInfo("uri:"+uri);
      e107Helper.logInfo("id:"+id);
      e107Helper.logInfo("step:"+step);
      e107Helper.logInfo("fieldtype:"+fieldtype);
      e107Helper.logInfo("fieldname:"+fieldname);
      // Create and send message
      this.addParm("action", "addCustomField");
      this.addParm("id", id);
      if (typeof fieldtype != "undefined") {
         this.addParm("fieldtype", fieldtype);
      }
      if (typeof fieldname != "undefined") {
         this.addParm("fieldname", fieldname);
      }
      if ($(id).value != null && $(id).value != "undefined") {
         this.addParm("customfields", $(id).value);
      }
      if (typeof step != "undefined") {
         this.addParm("step", step);
         if (step == 3) {
            // Add values for each attribute of this custom field
            var els = document.getElementsByName(id+"_attrib");
            for (var i=0; i<els.length; i++) {
               if (els[i].type == "checkbox" && !els[i].checked) {
                  this.addParm(els[i].id, "");
               } else {
                  this.addParm(els[i].id, els[i].value);
               }
            }
            if (fieldtype == "select" || fieldtype == "radio") {
               els = document.getElementsByName(id+"_option[]");
               if (fieldtype == "select") {
                  for (var i=0; i<els.length; i++) {
                     this.addParm(els[i].id+i, els[i].value);
                  }
               } else {
                  for (var i=0; i<els.length; i++) {
                     var j = parseInt(i/2);
                     this.addParm(els[i].id+j, els[i].value);
                  }
               }
            }
         }
      }
      this.post(uri);
   }
}

/*
 * Prototyping stuff - not for general use
 */

// ****************************************************************************
// IE emulation stuff for Mozilla based browsers
// ****************************************************************************
if (e107HelperBrowser.isMoz) {
   Event.prototype.__defineSetter__("returnValue",
      function (b) {
         if (!b) {
            this.preventDefault();
         }
         return b;
      }
   );
   Event.prototype.__defineSetter__("cancelBubble",
      function (b) {
         if (b) {
            this.stopPropagation();
         }
         return b;
      }
   );
   Event.prototype.__defineGetter__("srcElement",
      function () {
         var node = this.target;
         while (node.nodeType != 1 && node.nodeType != 9) {
            node = node.parentNode;
         }
         return node;
      }
   );
}

function resizeTextArea(ta) {
   //ta = $(ta);
   var tasize = e107HelperSize.getElementSize(ta);
   if (typeof ta.originalHeight == "undefined") {
      ta.originalHeight = tasize.height;
   }
   if (ta.clientHeight < ta.scrollHeight) {
      ta.style.height = ta.scrollHeight+"px";
   }
}