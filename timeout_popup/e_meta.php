<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL:$
|     $Revision:$
|     $Id:$
|     $Author:$
+----------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
if (check_class($pref['timePop_class']))
{
   echo "
   <script type='text/javascript'>
   //<![CDATA[
   function timeoutPopup() {
      var forms = document.getElementsByTagName('form');
      var showPopup = false;
      for (var i=0; i<forms.length; i++) {
         showPopup = showPopup || (forms[i].action.indexOf('search.php') == -1);
      }
      if (showPopup && confirm('".$tp->toJS($pref['timePop_message'])."')) {
     		sendInfo('".SITEURLBASE.e_PLUGIN_ABS."timeout_popup/keep_alive.php', 'timeout_popup');
     		window.setTimeout(timeoutPopup, ".($pref['timePop_timeout'] * 1000).");
      }
   }
   window.setTimeout(timeoutPopup, ".($pref['timePop_timeout'] * 1000).");
   //]]>
   </script>\n
   ";
}
?>