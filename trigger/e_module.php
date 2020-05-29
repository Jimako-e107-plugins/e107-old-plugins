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
| $Source: e:\_repository\e107_plugins/trigger/e_module.php,v $
| $Revision: 1.2 $
| $Date: 2008/06/28 09:40:29 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
$e_event->register("newspost",   "trigger_newspost",   e_PLUGIN."trigger/trigger_functions.php");
$e_event->register("subnews", "trigger_subnews", e_PLUGIN."trigger/trigger_functions.php");
$e_event->register("fileupload", "trigger_fileupload", e_PLUGIN."trigger/trigger_functions.php");
?>