<?php
/*
+---------------------------------------------------------------+
| Trigger by bugrain (www.bugrain.plus.com)
| see plugin.php for version information
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/trigger/trigger_functions.php,v $
| $Revision: 1.2 $
| $Date: 2008/06/28 09:40:30 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
require_once(e_PLUGIN."trigger/trigger_class.php");
function trigger_newspost($data) {
   global $trigger;
   $trigger->triggerNewspost($data);
}
function trigger_subnews($data) {
   global $trigger;
   $trigger->triggerSubnews($data);
}
function trigger_fileupload($data) {
   global $trigger;
   $trigger->triggerFileUpload($data);
}
?>


