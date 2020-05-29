<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system
|        Plugin Meta File :  e107_plugins/lightbox/e_meta.php
|        Email: support@free-source.net
|        $Revision: 1.5 $
|        $Date: 2008/11/16 21:40:34 $
|        $Author: Owner $
|        Copyright Corllete Lab ( http://www.clabteam.com ) under GNU GPL License (http://gnu.org)
|        Support Sites : http://www.free-source.net/ | http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined("e107_INIT")) {
   exit;
}
require_once(e_PLUGIN."jshelpers/jshelper.php");

if (e_QUERY == "jsrequires" || strpos(e_SELF, "jshelpers") > 0) {
   $jshelper->js_require(JSHELPER_PROTOTYPE);
   $jshelper->js_require(JSHELPER_SCRIPTACULOUS);
   $jshelper->js_require(JSHELPER_PROTOTIP);
   $jshelper->js_require(JSHELPER_TABLEKIT);
   $jshelper->js_require(JSHELPER_COOKIEJAR);
   $jshelper->js_include(JSHELPER_JSHELPER); //TODO pref?
}

if (e_QUERY == "jsincludes") {
   $jshelper->js_include(JSHELPER_PROTOTYPE);
   $jshelper->js_include(JSHELPER_SCRIPTACULOUS);
   $jshelper->js_include(JSHELPER_PROTOTIP);
   $jshelper->js_include(JSHELPER_TABLEKIT);
   $jshelper->js_include(JSHELPER_COOKIEJAR);
   $jshelper->js_include(JSHELPER_JSHELPER); //TODO pref?
}

//TODO pref? if (strpos(e_SELF, $ADMIN_DIRECTORY) > 0) {
   $jshelper->js_include(JSHELPER_PROTOTYPE);
   $jshelper->js_include(JSHELPER_SCRIPTACULOUS);
   $jshelper->js_include(JSHELPER_JSHELPER);
//}

if (varset($jshelper)) {
   $jshelper->registerPre("myPre");
   $jshelper->registerPost("myPost");
   $jshelper->registerPost("myPost2", e_PLUGIN."jshelpers/mypostinc.php");
}

function myPre() {
   echo "<!-- my pre -->";
}
function myPost() {
   echo "<!-- my post -->";
}
?>