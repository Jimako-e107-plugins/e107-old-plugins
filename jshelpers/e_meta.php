<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system
|        Plugin Meta File :  e107_plugins/lightbox/e_meta.php
|        Email: support@free-source.net
|        $Revision: 1.1 $
|        $Date: 2007/10/21 12:43:07 $
|        $Author: Neil $
|        Copyright Corllete Lab ( http://www.clabteam.com ) under GNU GPL License (http://gnu.org)
|        Support Sites : http://www.free-source.net/ | http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined("e107_INIT")) {
   exit;
}

require_once(e_PLUGIN."jshelpers/jshelper.php");
if (varset($jshelper)) {
   $jshelper->_scriptInclude();
}
?>