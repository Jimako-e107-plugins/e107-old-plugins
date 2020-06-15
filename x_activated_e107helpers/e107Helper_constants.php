<?php
/**
 * Constants to be used by applications using the Helper classes
 */
define("HELPER_TITLE",                 "The e107Helper Project");
define("HELPER_VER",                   "1.1b");
define("HELPER_PLUG_FOLDER",           "e107helpers/");

define("HELPER_FORM_TYPE_NO_BUTTONS",  "0");
define("HELPER_FORM_TYPE_E107_PREF",   "1");
define("HELPER_FORM_TYPE_DB_ROW",      "2");

define("HELPER_RESPONSE_FORM_OK",      "formok");
define("HELPER_RESPONSE_ACTION",       "action");
define("HELPER_RESPONSE_ID",           "id");

define("HELPER_BUTTON_CREATE",         "e107helper_submit_create");
define("HELPER_BUTTON_SAVE",           "e107helper_submit_save");
define("HELPER_BUTTON_UPDATE",         "e107helper_submit_update");

define("HELPER_ID_BATCH_GROUP",        "e107helper_batch_group");

define("HELPER_AJAX_MSG_BEGIN",        "<e107helperajax>");
define("HELPER_AJAX_MSG_END",          "</e107helperajax>");

// Admin images
$imagedir = e_IMAGE."admin_images/";
if (!defined('HELPER_ICON_EDIT'))      { define("HELPER_ICON_EDIT", "<img src='".$imagedir."edit_16.png' alt='".HELPER_LAN_EDIT."' title='".HELPER_LAN_EDIT."' style='border:0;cursor:pointer;' />"); }
if (!defined('HELPER_ICON_DELETE'))    { define("HELPER_ICON_DELETE", "<img src='".$imagedir."delete_16.png' alt='".HELPER_LAN_DELETE."' title='".HELPER_LAN_DELETE."' style='border:0;cursor:pointer;' />"); }

// private use?
define("HELPER_FORM_MODE_DISPLAY",     0);
define("HELPER_FORM_MODE_PREF_SAVE",   1);
define("HELPER_FORM_MODE_DB_CREATE",   2);
define("HELPER_FORM_MODE_DB_UPDATE",   3);
define("HELPER_FORM_MODE_DB_EDIT",     4);
define("HELPER_FORM_MODE_DB_DELETE",   5);
define("HELPER_FORM_MODE_DB_PRINT",    6);
define("HELPER_FORM_MODE_DB_VALIDATE", 7);

// Stuff defined by e107 v0.7 we need to define to make things work in 0.617x
global $IMAGES_DIRECTORY;
if (!defined("e_IMAGE_ABS"))          define("e_IMAGE_ABS",         e_HTTP.$IMAGES_DIRECTORY);
if (!defined("e_PLUGIN_ABS"))         define("e_PLUGIN_ABS",        e_HTTP.$PLUGINS_DIRECTORY);
?>