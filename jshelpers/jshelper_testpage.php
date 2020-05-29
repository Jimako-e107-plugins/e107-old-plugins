<?php
/*
+---------------------------------------------------------------+
| JSHelper by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/jshelpers/jshelper_testpage.php,v $
| $Revision: 1.1 $
| $Date: 2007/10/21 12:43:08 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(HEADERF);

$title   = JSHELPER_LAN_ADMIN_01." - ".JSHELPER_LAN_ADMIN_PAGE_01;
$pageid  = JSHELPER_LAN_ADMIN_PAGE_01;
$text    = "
   <div onclick='new Effect.BlindUp(this, {duration: 8})'>
   Click here if you want this to go slooooow.
   </div>
   ";

$ns->tablerender($title, $text);

require_once(FOOTERF);
?>