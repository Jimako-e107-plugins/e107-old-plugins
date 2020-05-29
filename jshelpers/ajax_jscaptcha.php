<?php
/*
+---------------------------------------------------------------+
| PSilo by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Copyright 2007, Neil Harrison (AKA bugrain)
|
| $Source: e:\_repository\e107_plugins/jshelpers/ajax_jscaptcha.php,v $
| $Revision: 1.1 $
| $Date: 2008/02/14 00:59:30 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
ob_start();
require_once("../../class2.php");
$q = explode(".", e_QUERY);
switch ($q[0]) {
   case "get" :
      $text = getSecureImage($q[1], $q[2]);
      break;
   case "check" :
      $text = checkCode($q[1], $q[2]);
      break;
   default:
      $text = e_QUERY;
}
ob_end_clean();
echo $text;
ob_flush();

function getSecureImage($id, $initial="") {
   require_once(e_HANDLER."secure_img_handler.php");
   $sec_img = new secure_image();
   $text = "";
   if ($initial != "") {
      $text .= "Incorrect code<br/>";
   }
   $text .= "<input type='hidden' id='{$id}_code' name='{$id}_code' value='".$sec_img->random_number."'/>";
	$code = $sec_img->create_code();
   $text .= "<img src='./e107_handlers/secure_img_render.php?{$code}' alt='secure image' />";
   $text .= "<input class='tbox' type='text' id='{$id}_verify' name='{$id}_verify' size='15' maxlength='20' /> ";
   return $text;
}

function checkCode($num, $verify) {
   require_once(e_HANDLER."secure_img_handler.php");
   $sec_img = new secure_image();
   return ($sec_img->verify_code($num, $verify)) ? "true" : "false";
}
?>