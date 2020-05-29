<?php
define("JSHELPER_COOKIEJAR",           "cookiejar");
define("JSHELPER_FIREBUG",             "firebug");
define("JSHELPER_GROWLER",             "growler");
define("JSHELPER_LIGHTVIEW",           "lightview");
define("JSHELPER_PROTOTIP",            "prototip");
define("JSHELPER_PROTOTYPE",           "prototype");
define("JSHELPER_PROTOTYPE_UI",        "prototype-ui");
define("JSHELPER_PWCWINDOW",           "pwcwindow");
define("JSHELPER_SCRIPTACULOUS",       "scriptaculous");
define("JSHELPER_TABLEKIT",            "tablekit");
define("JSHELPER_TEXTBOXLIST",         "textboxlist");

define("JSHELPER_JSHELPER",            "jshelper");

$jshelper_jspath = Array();
$jshelper_jspath[JSHELPER_COOKIEJAR]         = $jshelper_src_path."CookieJar/cookies.js";
$jshelper_jspath[JSHELPER_FIREBUG]           = $jshelper_src_path."firebug/firebugx.js";
$jshelper_jspath[JSHELPER_LIGHTVIEW]         = $jshelper_src_path."lightview/js/lightview.js";
$jshelper_jspath[JSHELPER_GROWLER]           = $jshelper_src_path."growler/src/Growler.js";
$jshelper_jspath[JSHELPER_PROTOTIP]          = $jshelper_src_path."prototip/js/prototip.js";
$jshelper_jspath[JSHELPER_PROTOTYPE]         = $jshelper_src_path."prototype/prototype.js";
$jshelper_jspath[JSHELPER_PROTOTYPE_UI]      = $jshelper_src_path."prototype-ui/dist/prototype-ui.js";
$jshelper_jspath[JSHELPER_PWCWINDOW]         = $jshelper_src_path."windows_js/javascripts/window.js";
$jshelper_jspath[JSHELPER_SCRIPTACULOUS][0]  = $jshelper_src_path."scriptaculous-js/src/scriptaculous.js";
$jshelper_jspath[JSHELPER_SCRIPTACULOUS][1]  = $jshelper_src_path."scriptaculous-js/src/builder.js";
$jshelper_jspath[JSHELPER_SCRIPTACULOUS][2]  = $jshelper_src_path."scriptaculous-js/src/effects.js";
$jshelper_jspath[JSHELPER_SCRIPTACULOUS][3]  = $jshelper_src_path."scriptaculous-js/src/dragdrop.js";
$jshelper_jspath[JSHELPER_SCRIPTACULOUS][4]  = $jshelper_src_path."scriptaculous-js/src/controls.js";
$jshelper_jspath[JSHELPER_SCRIPTACULOUS][5]  = $jshelper_src_path."scriptaculous-js/src/slider.js";
$jshelper_jspath[JSHELPER_SCRIPTACULOUS][6]  = $jshelper_src_path."scriptaculous-js/src/sound.js";
$jshelper_jspath[JSHELPER_TABLEKIT]          = $jshelper_src_path."tablekit/tablekit.js";
$jshelper_jspath[JSHELPER_TEXTBOXLIST][0]    = $jshelper_src_path."textboxlist/textboxlist.js";
$jshelper_jspath[JSHELPER_TEXTBOXLIST][1]    = $jshelper_src_path."textboxlist/test.js";

$jshelper_jspath[JSHELPER_JSHELPER]          = "jshelper.js";

// Admin - file serving prefs values
define("JSHELPER_FILE_SERVING_NORM",   0);
define("JSHELPER_FILE_SERVING_GZIP",   1);
define("JSHELPER_FILE_SERVING_CONC",   2);
define("JSHELPER_FILE_SERVING_COMB",   3);
?>