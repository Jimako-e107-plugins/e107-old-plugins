<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system
|        Plugin Meta File :  e107_plugins/lightbox/e_meta.php
|        Email: support@free-source.net
|        $Revision: 1.1.2.2 $
|        $Date: 2008/08/24 20:49:14 $
|        $Author: Owner $
|        Copyright Corllete Lab ( http://www.clabteam.com ) under GNU GPL License (http://gnu.org)
|        Support Sites : http://www.free-source.net/ | http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined("e107_INIT")) {
   exit;
}

//if (strpos(e_SELF, "admin_") > 0) {
//   // For admin pages
//   print "\n<script type='text/javascript' src='".e_PLUGIN_ABS."e107helpers/e_ajax.js'></script>";
//   print "\n<script type='text/javascript' src='".e_PLUGIN_ABS."e107helpers/firebug/firebugx.js'></script>";
//   print "\n<script type='text/javascript' src='".e_PLUGIN_ABS."e107helpers/prototype/prototype.js'></script>";
//   print "\n<script type='text/javascript' src='".e_PLUGIN_ABS."e107helpers/scriptaculous-js/scriptaculous.js'></script>\n";
//} else {
//   // For main site pages
//   $footer_js[] = e_FILE_ABS.'e_ajax.js';
//   $footer_js[] = e_PLUGIN_ABS."e107helpers/firebug/firebugx.js";
//   $footer_js[] = e_PLUGIN_ABS."e107helpers/prototype/prototype.js";
//   $footer_js[] = e_PLUGIN_ABS."e107helpers/scriptaculous-js/scriptaculous.js";
//}

// include the e107 Helper JavaScript
echo "<script type='text/javascript' src='".e_PLUGIN_ABS."e107helpers/e107helper.js'></script>\n";

// Include DHTML Calendar JavaScript
//TODO do we need to include the DHTML Calendar class if not already included here?
if (!class_exists("DHTML_Calendar")) {
   require_once(e_PLUGIN."e107helpers/calendar/calendar_class.php");
   $temp = new DHTML_Calendar(true);
   echo $temp->load_files();
}

// Make sure the e107 Ajax JavaScript is included
global $footer_js;
$footer_js[] = e_PLUGIN_ABS.'e107helpers/e_ajax.js';

?>