<?php
//$_E107['minimal'] = TRUE;

define("e_SELF", ("http://".$_SERVER['HTTP_HOST']) . ($_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_FILENAME']));
$pathinfo = pathinfo(e_SELF);

//require_once("../class2.php");
$jshelper_path     = getcwd()."/";
$jshelper_src_path = getcwd()."/src/";
require_once(getcwd()."/constants.php");
//define("JSHELPER_COOKIEJAR",     "cookiejar");
//define("JSHELPER_FIREBUG",       "firebug");
//define("JSHELPER_LIGHTVIEW",     "lightview");
//define("JSHELPER_PROTOTIP",      "prototip");
//define("JSHELPER_PROTOTYPE",     "prototype");
//define("JSHELPER_PWCWINDOW",     "pwcwindow");
//define("JSHELPER_SCRIPTACULOUS", "scriptaculous");
//define("JSHELPER_TABLEKIT",      "tablekit");
//
//$jshelper_path = Array();
//$jshelper_path[JSHELPER_COOKIEJAR]     = $jshelper_src_path."firebug/firebugx.js";
//$jshelper_path[JSHELPER_FIREBUG]       = $jshelper_src_path."prototype/prototype.js";
//$jshelper_path[JSHELPER_LIGHTVIEW]     = $jshelper_src_path."scriptaculous-js/src/scriptaculous.js";
//$jshelper_path[JSHELPER_PROTOTIP]      = $jshelper_src_path."prototip/js/prototip.js";
//$jshelper_path[JSHELPER_PROTOTYPE]     = $jshelper_src_path."tablekit/tablekit.js";
//$jshelper_path[JSHELPER_PWCWINDOW]     = $jshelper_src_path."CookieJar/cookies.js";
//$jshelper_path[JSHELPER_SCRIPTACULOUS] = $jshelper_src_path."windows_js/javascripts/window.js";
//$jshelper_path[JSHELPER_TABLEKIT]      = $jshelper_src_path."lightview/js/lightview.js";

function echo_gzipped_page() {
   if (headers_sent()){
      $encoding = false;
   } elseif (strpos($_SERVER["HTTP_ACCEPT_ENCODING"], 'x-gzip') !== false) {
      $encoding = 'x-gzip';
   } elseif (strpos($_SERVER["HTTP_ACCEPT_ENCODING"],'gzip') !== false) {
      $encoding = 'gzip';
   } else {
      $encoding = false;
   }

   if ($encoding) {
      $contents = ob_get_contents();
      ob_end_clean();
      header('Content-Encoding: '.$encoding);
      print("\x1f\x8b\x08\x00\x00\x00\x00\x00");
      $size = strlen($contents);
      $contents = gzcompress($contents, 9);
      $contents = substr($contents, 0, $size);
      print($contents);
   } else {
      ob_end_flush();
   }
   exit();
}

ob_start();
ob_implicit_flush(0);

header("last-modified: " . gmdate("D, d M Y H:i:s",mktime(0,0,0,15,2,2004)) . " GMT");
header('Content-type: text/javascript', TRUE);
if (strlen($_SERVER["QUERY_STRING"]) > 0) {
   $qs = explode(",", $_SERVER["QUERY_STRING"]);
   echo "/* ".$_SERVER["HTTP_ACCEPT_ENCODING"]." */\n";
   foreach ($qs as $q) {
      echo "/* q=".$q." */\n";
      if (is_array($jshelper_jspath[$q])) {
         for ($i=0; $i<count($jshelper_jspath[$q]); $i++) {
            echo "/* file=".$jshelper_jspath[$q][$i]." */\n";
            echo file_get_contents($jshelper_jspath[$q][$i]);
            echo "\n";
         }
      } else {
         echo "/* file=".$jshelper_jspath[$q]." */\n";
         echo file_get_contents($jshelper_jspath[$q]);
         echo "\n";
      }
   }
}

echo_gzipped_page();
?>