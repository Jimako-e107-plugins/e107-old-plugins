/*
+---------------------------------------------------------------+
| SimpleContent by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: K:/CVS_Repository/simple_content/scontent.js,v $
| $Revision: 1.3 $
| $Date: 2008/11/20 19:59:47 $
| $Author: Owner $
+---------------------------------------------------------------+
*/
if (Prototype) {
   var scontent = {
      showFieldLabels: function() {
         $('fieldLabels').innerHTML = scontentHelper.fieldLabels[$('scontent_item_cat_id_0').value];
      }
   }
   document.observe('dom:loaded', function() {
      // Search helper stuff
      var catlist = $('scontent_search_category');
      if (catlist) {
         // Change of category - diaply appropriate field list
         catlist.observe('change', function(ev) {
            $$('.scontent_search_category_fields').each(function(el) {
               if (el.visible()) {
                  new Effect.BlindUp(el, {duration: 0.75});
               }
            });
            if (ev.element().getValue() != ' ') {
               new Effect.BlindDown($('scontent_search_category_'+ev.element().getValue()), {duration: 0.75});
            }
         });
         // Selection of an 'all' in field list
         document.observe('click', function(ev) {
            var el = ev.element();
            if (el.hasClassName('scontent_search_fields_all')) {
               el.siblings().each(function(sib) {
                  sib.disabled = el.checked;
               });
            }
         });
      }

      // Admin page stuff
      if (typeof scontentHelper != "undefined" && scontentHelper.admin && scontentHelper.pageid==10) {
         scontent.showFieldLabels();
         $('scontent_item_cat_id_0').observe('change', scontent.showFieldLabels);
      }
   });
}